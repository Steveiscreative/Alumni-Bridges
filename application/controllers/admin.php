<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin extends CI_Controller
{
	
	function __construct()
	{
		parent::__construct(); 
		$this->load->model('admins');
		$this->load->helper(array('form', 'url'));
		session_start();
	}


	function index()
	{
		$this->load->library('form_validation');

		// Form Validation 
		$this->form_validation->set_rules('email', 'Email Address', 'required|valid_email');
		$this->form_validation->set_rules('pwd','Password', 'required|min_length[6]');

		$email = $this->input->post('email');
		$password = $this->input->post('pwd');

		if ($this->form_validation->run() !== false) {
			$this->load->model('user'); 
			$result = $this
						->user
						->verify_admin(
							$email, 
							$password
						);

			if( $result !== false ) 
			{
				$_SESSION['email'] = $email;
				$_SESSION['role_id']= $result['role_id'];
				$_SESSION['id'] = $result['id'];
				redirect('admin/dashboard/');
			}

		}

		$this->load->view('admin_views/layout/header.php');
		$this->load->view('admin_views/admin_login.php');
		$this->load->view('admin_views/layout/footer.php');
	}

	function logout(){
		session_destroy();
		redirect(base_url().'index.php/admin/');
	}

	/**
	 * Alumni Controllers
	 * ---------------------------------------
	 * 1) Dashboard - Display all alumni in database 
	 * 2) Add Alumni 
	 * 3) Alumni Profile - Update Alumni Profile
	 * 4) Delete Alumni
	 */
	
	function dashboard($start=0)
	{	
		if (!isset($_SESSION['role_id']) ) {
			redirect(base_url().'index.php/admin/');
		}

		if($_GET)
		{
			$orderby=$_GET['orderby'];
			$order=$_GET['order']; 
		} else {
			$orderby='id';
			$order='desc'; 
		}

		$data['alumni']=$this->admins->get_alumni(20,$start, $orderby, $order);

		// Pagination 
		$this->load->library('pagination');
		$config['base_url']=base_url().'index.php/admin/dashboard';
		$config['total_rows']=$this->admins->get_alumni_count();
		$config['per_page']=10; 
		$this->pagination->initialize($config); 
		$data['pages']=$this->pagination->create_links();
		
		$this->load->view('admin_views/layout/header.php');
		$this->load->view('admin_views/dashboard.php',$data);
		$this->load->view('admin_views/layout/sidebar.php');
		$this->load->view('admin_views/layout/footer.php');
	}

	function add_alumni()
	{
		if (!isset($_SESSION['role_id']) ) {
			redirect(base_url().'index.php/admin/');
		}

		$data['valid_departments']=$this->admins->get_valid_departments();
		$data['valid_social_media']=$this->admins->get_all_social_media();
		$data['valid_degrees']=$this->admins->get_valid_degrees();
		if($_POST)
		{
			$student_id=$_POST['student_id']; 
			$first_name=$_POST['first_name'];
			$last_name=$_POST['last_name'];
			$address=$_POST['street'];
			$city=$_POST['city'];
			$state=$_POST['state']; 
			$zip_code=$_POST['zip_code'];
			$email=$_POST['email'];
			$telephone=$_POST['telephone'];
			$degree=$_POST['degree'];
			$deparment=$_POST['school_department'];
			$graduation_year=$_POST['graduation_year'];

			$data['results']=$this->admins->add_alumni($student_id, $first_name,$last_name,$address, $city, $state, $zip_code, $email, $telephone, $degree, $deparment,$graduation_year);
			$this->load->view('admin_views/layout/header.php');
			$this->load->view('admin_views/alumni/add.php',$data);
			$this->load->view('admin_views/layout/sidebar.php');
			$this->load->view('admin_views/layout/footer.php');

		} else {
			$this->load->view('admin_views/layout/header.php');
			$this->load->view('admin_views/alumni/add.php',$data);
			$this->load->view('admin_views/layout/sidebar.php');
			$this->load->view('admin_views/layout/footer.php');
		}

	}

	function alumni_profile($id)
	{
		if (!isset($_SESSION['role_id']) ) {
			redirect(base_url().'index.php/admin/');
		}
		// Get Student ID
		$query=$this->db->query("SELECT student_id FROM alumni where id = $id");
		$data=$query->first_row('array');
		$student_id = $data['student_id'];

		// // Social Sites
		// $socialSitesQ=$this->db->query("SELECT social_media FROM valid_social_media");
		// $socialSites=$socialSitesQ->result_array();

		// // Check For Student ID in social_media table 
		// $socialCheckQ=$this->db->query("SELECT COUNT(1) AS check_id FROM social_media WHERE student_id = $student_id ");
		// $sCheckResult=$socialCheckQ->first_row('array');
		// $sCheck = $sCheckResult['check_id'];

		$data['success']=0; 
		if($_POST)
		{	
			$alumni_data=array(
				'first_name'=>$_POST['first_name'],
				'last_name'=>$_POST['last_name'],
				'street'=>$_POST['street'],
				'city'=>$_POST['city'],
				'state'=>$_POST['state'], 
				'zip_code'=>$_POST['zip_code'],
				'email'=>$_POST['email'],
				'telephone'=>$_POST['telephone'],
				'degree'=>$_POST['degree'],
				'department'=>$_POST['department'],
				'graduation_year'=>$_POST['graduation_year']
			);

			// Social Media Arrau
			// foreach($socialSites as $site) {
			// 	$site["social_media"]=$_POST['$site["social_media"]'];
			// }
			

			$data['success']=1;
			$this->admins->update_alumni($id, $alumni_data);

		}

			// Pass Info to views
			$data['valid_departments']=$this->admins->get_valid_departments();
			$data['socialMedia']=$this->admins->get_alumni_social_media($student_id);
			$data['valid_social_media']=$this->admins->get_all_social_media();
			$data['valid_degrees']=$this->admins->get_valid_degrees();
			$data['alumni']=$this->admins->get_alumnus($id);

			// Load Views 
			$this->load->view('admin_views/layout/header.php');
			$this->load->view('admin_views/alumni/edit.php',$data);
			$this->load->view('admin_views/layout/sidebar.php');
			$this->load->view('admin_views/layout/footer.php');
	}
	
	//http://ellislab.com/codeigniter/user-guide/libraries/file_uploading.html
	
	function mass_import()
	{

		if (!isset($_SESSION['role_id']) ) {
			redirect(base_url().'index.php/admin/');
		}

        $this->load->library('csvreader');
        $config['upload_path'] = './csv/';
		$config['allowed_types'] = 'text/plain|text/csv|csv|text/comma-separated-values|application/csv|application/excel|application/vnd.ms-excel|application/vnd.msexcel|text/anytext';
		$config['max_size'] = '5000';
		$config['file_name'] = 'upload' . time();

		$this->load->library('upload', $config);

		//$csvFile = $_POST["userfile"]; 

		if ( ! $this->upload->do_upload())
		{
			$error = array('error' => $this->upload->display_errors());

			$this->load->view('admin_views/layout/header.php');
			$this->load->view('admin_views/alumni/mass-import.php',$error);
			$this->load->view('admin_views/layout/sidebar.php');
			$this->load->view('admin_views/layout/footer.php');
		}
		else
		{
			$upload_data = $this->upload->data();
			$result=$this->csvreader->parse_file($upload_data['full_path']);

			foreach ($result as $alumni) {
    			$this->admins->add_alumni_massImport($alumni['student_id'], $alumni['first_name'],$alumni['last_name'], $alumni['address'], $alumni['city'], $alumni['state'], $alumni['zip_code'], $alumni['email'], $alumni['telephone'], $alumni['degree'], $alumni['department'],$alumni['graduation_year']);
    		}

    		$this->load->view('admin_views/layout/header.php');
			$this->load->view('admin_views/alumni/upload_success.php');
			$this->load->view('admin_views/layout/sidebar.php');
			$this->load->view('admin_views/layout/footer.php');
		}
	}

	function deletealumni($id)
	{
		$this->admins->delete_alumni($id);
		redirect(base_url().'index.php/admin/dashboard');
	}


	/**
	 * Admin Controllers
	 * ---------------------------------------
	 */
	
	function manage_admins($start=0)
	{
		if (!isset($_SESSION['role_id']) ) {
			redirect(base_url().'index.php/admin/');
		}
		// Get Admin Info
		$data['admins']=$this->admins->get_admins(25, $start);

		// Pagination 
		$this->load->library('pagination');
		$config['base_url']=base_url().'index.php/admin/manage_admins';
		$config['total_rows']=$this->admins->get_admin_count();
		$config['per_page']=10; 
		$this->pagination->initialize($config); 
		$data['pages']=$this->pagination->create_links();

		// Load Views 
		$this->load->view('admin_views/layout/header.php');
		$this->load->view('admin_views/admin/view_all.php',$data);
		$this->load->view('admin_views/layout/sidebar.php');
		$this->load->view('admin_views/layout/footer.php');
	}

	function add_admin()
	{
		if (!isset($_SESSION['role_id']) ) {
			redirect(base_url().'index.php/admin/');
		}

		if($_POST)
		{
			$email = $_POST['email'];
			$first_name=$_POST['first_name'];
			$last_name=$_POST['last_name'];
			$pwd = $_POST['pwd'];
			$role = $_POST['role_id'];

			$data['results']=$this->admins->add_admin($email,$first_name, $last_name, $pwd,$role);

			$this->load->view('admin_views/layout/header.php');
			$this->load->view('admin_views/admin/add.php',$data);
			$this->load->view('admin_views/layout/sidebar.php');
			$this->load->view('admin_views/layout/footer.php');
		}
		else {
			$data['role']=$this->admins->get_roles();
			$this->load->view('admin_views/layout/header.php');
			$this->load->view('admin_views/admin/add.php',$data);
			$this->load->view('admin_views/layout/sidebar.php');
			$this->load->view('admin_views/layout/footer.php');
		}
	}

	

	function admin_profile($id)
	{	
		if (!isset($_SESSION['role_id']) ) {
			redirect(base_url().'index.php/admin/');
		}

		$this->load->helper('security');
		$data['success']=0;  

		if($_POST) 
		{
			/**
			 * If pwd remained empty the keep current password, 
			 * else, update to new password
			 */
			
			if(!empty($_POST['pwd'])) {
				$password = do_hash($_POST['pwd'],'md5');
			} else { 
				$query = $this->db->query("SELECT pwd FROM admin WHERE id = $id");
				$data = $query->first_row('array');
				$password = $data['pwd'];
			}

			$data_admin=array(
				'email'=>$_POST['email'],
				'first_name'=>$_POST['first_name'],
				'last_name'=>$_POST['last_name'],
				'pwd'=> $password,
				'role_id'=>$_POST['role_id']
			);

			$this->admins->update_admin($id,$data_admin);
			$data['success'] = 1;
		}
		$data['role']=$this->admins->get_roles();
		$data['user_role']=$this->admins->get_user_role($id);
		$data['admin']=$this->admins->get_admin($id);

		$this->load->view('admin_views/layout/header.php');
		$this->load->view('admin_views/admin/edit.php',$data);
		$this->load->view('admin_views/layout/sidebar.php');
		$this->load->view('admin_views/layout/footer.php');
	}

	function deleteadmin($id)
	{
		$this->admins->delete_admin($id);
		redirect(base_url().'index.php/admin/manage_admins', 'refresh');
	}

	/**
	 * Social Media Controllers
	 * ---------------------------------------
	 */
	
	function social_media() 
	{
		if (!isset($_SESSION['role_id']) ) {
			redirect(base_url().'index.php/admin/');
		}

		$data['social_media']=$this->admins->get_all_social_media();
		$this->load->view('admin_views/layout/header.php');
		$this->load->view('admin_views/social-media/view_all.php',$data);
		$this->load->view('admin_views/layout/sidebar.php');
		$this->load->view('admin_views/layout/footer.php');
	}

	function add_socialmedia()
	{
		$data['success']=0;

		if($_POST)
		{
			$social_media = $_POST['social_media'];
			$this->admins->add_social_media($social_media);
			//redirect(base_url().'index.php/admin/social_media/');
			
			$query=$this->db->query("SELECT 1 AS socialCount FROM valid_social_media where social_media = '$social_media'");
			$data=$query->first_row('array');
			$socialCheck = $data['socialCount'];

			if ($socialCheck == 1) {
				$data['success']=0;
			} else {
				$data['success']=1;
			}
			
		}
		
		$this->load->view('admin_views/layout/header.php');
		$this->load->view('admin_views/social-media/add.php', $data);
		$this->load->view('admin_views/layout/sidebar.php');
		$this->load->view('admin_views/layout/footer.php');

	}

	/**
	 * Degrees Controllers
	 * ---------------------------------------
	 */

	function degrees()
	{
		if (!isset($_SESSION['role_id']) ) {
			redirect(base_url().'index.php/admin/');
		}

		$data['valid_degrees']=$this->admins->get_valid_degrees(); 
		$this->load->view('admin_views/layout/header.php');
		$this->load->view('admin_views/degrees/view_all.php',$data);
		$this->load->view('admin_views/layout/sidebar.php');
		$this->load->view('admin_views/layout/footer.php');
	}

	function add_degree()
	{
		if (!isset($_SESSION['role_id']) ) {
			redirect(base_url().'index.php/admin/');
		}

		if($_POST)
		{
			$degree = $_POST['degree'];
			$data['results']=$this->admins->add_valid_degree($degree);
			$this->load->view('admin_views/layout/header.php');
			$this->load->view('admin_views/degrees/add.php', $data);
			$this->load->view('admin_views/layout/sidebar.php');
			$this->load->view('admin_views/layout/footer.php');
		} else {
			$this->load->view('admin_views/layout/header.php');
			$this->load->view('admin_views/degrees/add.php');
			$this->load->view('admin_views/layout/sidebar.php');
			$this->load->view('admin_views/layout/footer.php');
		}
	}

	function degree($id)
	{	
		if (!isset($_SESSION['role_id']) ) {
			redirect(base_url().'index.php/admin/');
		}

		$data['success'] = 0;

		if($_POST) 
		{	$data=array(
				'degree' => $_POST['degree']); 
			$this->admins->update_degree($id,$data);
			$data['success'] = 1;
		}

		$data['valid_degree']=$this->admins->get_valid_degree($id);
		$this->load->view('admin_views/layout/header.php');
		$this->load->view('admin_views/degrees/edit.php', $data);
		$this->load->view('admin_views/layout/sidebar.php');
		$this->load->view('admin_views/layout/footer.php');

	}

	function deletedegree($id)
	{
		$this->admins->delete_valid_degree($id);
		$data['redirect_url']=base_url()."index.php/admin/degrees";
		$this->load->view('help/redirect.php',$data);
	}

	/**
	 * Department Controllers 
	 * ---------------------------------------
	 */

	function departments()
	{
		if (!isset($_SESSION['role_id']) ) {
			redirect(base_url().'index.php/admin/');
		}

		$data['valid_departments'] = $this->admins->get_valid_departments();
		$this->load->view('admin_views/layout/header.php');
		$this->load->view('admin_views/departments/view_all.php',$data);
		$this->load->view('admin_views/layout/sidebar.php');
		$this->load->view('admin_views/layout/footer.php');
	}

	function add_department()
	{
		if (!isset($_SESSION['role_id']) ) {
			redirect(base_url().'index.php/admin/');
		}

		$this->load->helper('array');

		if($_POST)
		{

			$department=$_POST['department'];
			$data['results']=$this->admins->add_valid_department($department);

			$this->load->view('admin_views/layout/header.php');
			$this->load->view('admin_views/departments/add.php', $data);
			$this->load->view('admin_views/layout/sidebar.php');
			$this->load->view('admin_views/layout/footer.php');
			
		}

		$this->load->view('admin_views/layout/header.php');
		$this->load->view('admin_views/departments/add.php');
		$this->load->view('admin_views/layout/sidebar.php');
		$this->load->view('admin_views/layout/footer.php');
	}

	function department($id)
	{	
		if (!isset($_SESSION['role_id']) ) {
			redirect(base_url().'index.php/admin/');
		}

		$data['success'] = 0;

		if($_POST) 
		{	$data=array(
				'department' => $_POST['department']); 
			$this->admins->update_department($id,$data);
			$data['success'] = 1;
		}

		$data['valid_department']=$this->admins->get_valid_department($id);
		$this->load->view('admin_views/layout/header.php');
		$this->load->view('admin_views/departments/edit.php', $data);
		$this->load->view('admin_views/layout/sidebar.php');
		$this->load->view('admin_views/layout/footer.php');

	}
	

	function deletedepartment($id)
	{
		$this->admins->delete_valid_department($id); 
		$data['redirect_url']= base_url()."index.php/admin/departments";
		$this->load->view('help/redirect.php',$data);
	}

	/**
	 * Donations
	 * ---------------------------------------
	 */
	
	function donations($start=0)
	{
		if (!isset($_SESSION['role_id']) ) {
			redirect(base_url().'index.php/admin/');
		}

		$data['donations']=$this->admins->get_donations(25, $start);

		// Pagination
		$this->load->library('pagination');
		$config['base_url']=base_url().'index.php/admin/donations';
		$config['total_rows']=$this->admins->get_donation_count();
		$config['per_page']=25; 
		$this->pagination->initialize($config); 
		$data['pages']=$this->pagination->create_links();

		// Load Views
		$this->load->view('admin_views/layout/header.php');
		$this->load->view('admin_views/donations/view_all.php',$data);
		$this->load->view('admin_views/layout/sidebar.php');
		$this->load->view('admin_views/layout/footer.php');

	}
	
	function add_donation($id)
	{
		if (!isset($_SESSION['role_id'])) {
			redirect(base_url().'index.php/admin/');
		}

		if($_POST)
		{
			$student_id = $_POST['student_id'];
			$donation_amount = $_POST['donation_amount'];
			$payment_type = $_POST['payment_type'];
			$donation_date = $_POST['donation_date'];

			$this->admins->add_donations($student_id,$donation_amount, $payment_type, $donation_date);
			$data['redirect_url']= base_url()."index.php/admin/donations";
			$this->load->view('help/redirect.php', $data);

			//redirect(base_url().'index.php/admin/donations/');
		} else {
		
			$data['valid_payment_type']=$this->admins->get_payment_types();
			$data['alumni']=$this->admins->get_alumnus($id);

			$this->load->view('admin_views/layout/header.php');
			$this->load->view('admin_views/donations/add.php',$data);
			$this->load->view('admin_views/layout/sidebar.php');
			$this->load->view('admin_views/layout/footer.php');
		}
		
	}

	/**
	 * Search
	 * ---------------------------------------
	 */
	
	function search($start=0)
	{
		if (!isset($_SESSION['role_id'])) {
			redirect(base_url().'index.php/admin/');
		}

		$q = $_GET['q'];

		if( !isset($_GET['graduation_year']) || empty($_GET['graduation_year']) )
		{
			$graduation_year = NULL;
		} else {
			$graduation_year = $_GET['graduation_year'] ;
		}

		if( !isset($_GET['degree']) || empty($_GET['degree']) )
		{
			$degree = NULL; 
		} else {
			$degree = $_GET['degree'];
		}
		
		if( !isset($_GET['department']) || empty($_GET['department']) )
		{
			$department = NULL;
		} else {
			$department = $_GET['department'];
		}
		
		$data['alumni']=$this->admins->alumni_search($q, $department, $degree, $graduation_year, 5 , $start);


		$this->load->view('admin_views/layout/header.php');
		$this->load->view('admin_views/dashboard.php',$data);
		$this->load->view('admin_views/layout/sidebar.php');
		$this->load->view('admin_views/layout/footer.php');
	}

	/**
	 * Email Listing
	 * 
	 */
	
	function email_list()
	{
		if (!isset($_SESSION['role_id'])) {
			redirect(base_url().'index.php/admin/');
		}

		if( !isset($_GET['degree']) || empty($_GET['degree']) )
		{
			$degree = NULL;
		} else {
			$degree = $_GET['degree'] ;
		}

		if( !isset($_GET['graduation_year']) || empty($_GET['graduation_year']) )
		{
			$graduation_year = NULL; 
		} else {
			$graduation_year = $_GET['graduation_year'];
		}
		
		if( !isset($_GET['zip_code']) || empty($_GET['zip_code']) )
		{
			$zip_code = NULL;
		} else {
			$zip_code = $_GET['zip_code'];
		}

		$data['email']=$this->admins->alumni_email_list($degree, $graduation_year, $zip_code);
		$data['valid_degrees']=$this->admins->get_valid_degrees();

		$this->load->view('admin_views/layout/header.php');
		$this->load->view('admin_views/email/list.php', $data);
		$this->load->view('admin_views/layout/sidebar.php');
		$this->load->view('admin_views/layout/footer.php');
	}


}