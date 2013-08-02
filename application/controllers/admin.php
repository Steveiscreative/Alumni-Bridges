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
		/**
		 *  This function is for login controller for the admin section of the site.
		 *  The system
		 */
		
		$this->load->library('form_validation');
		$data['res'] = 0;

		/**
		 * The system validates the two fields, Email Address and Passwords
		 * IF the Email address isn't filled out and isn't an email address
		 * OR the password isn't fill out or isn't 6 characters
		 * THEN the system will return an error message 
		 */
		
		$this->form_validation->set_rules('email', 'Email Address', 'required|valid_email');
		$this->form_validation->set_rules('pwd','Password', 'required|min_length[6]');
		$email = $this->input->post('email');
		$password = $this->input->post('pwd');

		/**
		 * IF the form validation reqiurements are met, 
		 * THEN verify the user in the database
		 * Verification returns false if the credintials don't match 
		 * IF the credentials match then session starts and forwards admin to the admin dashboard
		 */
		
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
			} else {
				$data['res'] = 1;
			}
		}

		/**
		 * Load View (Frontend Interface)
		 */
		
		$this->load->view('admin_views/layout/header.php');
		$this->load->view('admin_views/admin_login.php', $data);
		$this->load->view('admin_views/layout/footer.php');
	}

	/**
	 * logout destroys the session 
	 * AND directs the admin to login screen
	 */
	
	function logout(){
		session_destroy();
		redirect(base_url().'index.php/admin/');
	}


	/**
	 * Admin Dashboard
	 * Controllers
	 */
	
	function dashboard($start=0)
	{	

		/**
		 *  IF the session role_id isn't set, 
		 *  THEN redirect to the login screen
		 */
		
		if (!isset($_SESSION['role_id']) ) {
			redirect(base_url().'index.php/admin/');
		}

		/**
		 * IF the session role_id is less than or equal to 1
		 * THEN redirect to alumni section 
		 */
		
		if ($_SESSION['role_id'] <= 1) {
			redirect(base_url().'index.php/alumni/');
		}

		/**
		 * IF $_GET method is performed
		 * THEN set these the values
		 *
		 * IF no $_GET method, then set default values
		 * 
		 */
		
		if($_GET)
		{
			$orderby=$_GET['orderby'];
			$order=$_GET['order']; 
		} else {
			$orderby='id';
			$order='desc'; 
		}

		/**
		 * Get alumni data with the get_alumni() function
		 * See application/models/admins.php file.
		 */
		
		$data['alumni']=$this->admins->get_alumni(20,$start, $orderby, $order);

		// Pagination function
		$this->load->library('pagination');
		$config['base_url']=base_url().'index.php/admin/dashboard';
		$config['total_rows']=$this->admins->get_alumni_count();
		$config['per_page']=10; 
		$this->pagination->initialize($config); 
		$data['pages']=$this->pagination->create_links();

		/**
		 * Load View (Frontend Interface)
		 */
		
		$this->load->view('admin_views/layout/header.php');
		$this->load->view('admin_views/dashboard.php',$data);
		$this->load->view('admin_views/layout/sidebar.php');
		$this->load->view('admin_views/layout/footer.php');
	}

	/**
	 * Add Alumni Controllers
	 * This is used to add an alumni 
	 */
	
	function add_alumni()
	{
		/**
		 *  IF the session role_id isn't set, 
		 *  THEN redirect to the login screen
		 */
		
		if (!isset($_SESSION['role_id']) ) {
			redirect(base_url().'index.php/admin/');
		}

		/**
		 * IF the session role_id is less than or equal to 1
		 * THEN redirect to alumni section 
		 */
		
		if ($_SESSION['role_id'] <= 1) {
			redirect(base_url().'index.php/alumni/');
		}

		/**
		 * Get valid department rows with the get_valid_departments() model
		 * Get valid social media rows with the get_all_social_media() model
		 * Get valid degrees rows with the get_valid_degrees() model
		 * See application/models/admins.php file.
		 */
		
		$data['valid_departments']=$this->admins->get_valid_departments();
		$data['valid_social_media']=$this->admins->get_all_social_media();
		$data['valid_degrees']=$this->admins->get_valid_degrees();

		/**
		 * IF alumni info is $_POST
		 * THEN take then set values
		 */
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

			/**
			 * Preforms insert with add_alumni model
			 * add_alumni model CALLS sp_add_alumni
			 * See application/models/admins.php file.
			 */

			$data['results']=$this->admins->add_alumni($student_id, $first_name,$last_name,$address, $city, $state, $zip_code, $email, $telephone, $degree, $deparment,$graduation_year);

			/**
			 * Load interface
			 * With results of insert
			 */
			
			$this->load->view('admin_views/layout/header.php');
			$this->load->view('admin_views/alumni/add.php',$data);
			$this->load->view('admin_views/layout/sidebar.php');
			$this->load->view('admin_views/layout/footer.php');

		} else {

			/**
			 * IF form not submitted 
			 * THEN return interface w/o results info
			 */
			
			$this->load->view('admin_views/layout/header.php');
			$this->load->view('admin_views/alumni/add.php',$data);
			$this->load->view('admin_views/layout/sidebar.php');
			$this->load->view('admin_views/layout/footer.php');
		}
	}

	/**
	 * Alumni profile is used to update information of an alumni
	 */
	
	function alumni_profile($id)
	{
		/**
		 *  IF the session role_id isn't set, 
		 *  THEN redirect to the login screen
		 */
		
		if (!isset($_SESSION['role_id']) ) {
			redirect(base_url().'index.php/admin/');
		}

		/**
		 * IF the session role_id is less than or equal to 1
		 * THEN redirect to alumni section 
		 */
		
		if ($_SESSION['role_id'] <= 1) {
			redirect(base_url().'index.php/alumni/');
		}

		/**
		 * Get student_id of current profile
		 */
		
		$query=$this->db->query("SELECT student_id FROM alumni where id = $id");
		$data=$query->first_row('array');
		$student_id = $data['student_id'];

		/**
		 * Get valid department rows with the get_valid_departments() model
		 * Get valid social media rows with the get_all_social_media() model
		 * Get valid degrees rows with the get_valid_degrees() model
		 * Get alumni's information
		 * See application/models/admins.php file.
		 */
		
		$data['valid_departments']=$this->admins->get_valid_departments();
		$data['valid_degrees']=$this->admins->get_valid_degrees();
		$data['socialMedia']=$this->admins->get_alumni_social_media($student_id);
		$data['valid_social_media']=$this->admins->get_all_social_media();
		$data['alumni']=$this->admins->get_alumnus($id);


		/**
		 * Update Alumni
		 * Success Status
		 */
		
		$data['success']=0; 
		/**
		 * IF $_POST alumni set values
		 */
		if($_POST)
		{	
				$student_id = $_POST['student_id'];
				$first_name = $_POST['first_name'];
				$last_name = $_POST['last_name'];
				$pwd =  $_POST['pwd'];
				$street= $_POST['street'];
				$city= $_POST['city'];
				$state=$_POST['state']; 
				$zip_code=$_POST['zip_code'];
				$email=$_POST['email'];
				$telephone=$_POST['telephone'];
				$degree=$_POST['degree'];
				$department =$_POST['department'];
				$graduation_year =$_POST['graduation_year'];

			$data['success']=1;

			/**
			 * IF PASSWORD IS EMPTY OR NOT SET = NULL 
			 */
			
			if( empty($pwd) || !isset($pwd))
			{
				$pwd = 'NULL'; 
			}

			/**
			 * Update alumni information with the updata_alumni model
			 * See application/models/admins.php file.
			 */
			
			$data['results']=$this->admins->update_alumni1($student_id,$first_name,$last_name, $pwd, $street, $city, $state, $zip_code, $email, $telephone, $degree, $department, $graduation_year);

			//redirect(base_url().'index.php/admin/alumni_profile/'.$id);

		} 

			
			/**
			 * Load interface
			 */
			
			$this->load->view('admin_views/layout/header.php');
			$this->load->view('admin_views/alumni/edit.php',$data);
			$this->load->view('admin_views/layout/sidebar.php');
			$this->load->view('admin_views/layout/footer.php');

	}
	
	
	/**
	 * Mass Import via CSV 
	 * -----------------------------
	 * CSV first row must have the name of the column
	 */
	function mass_import()
	{

		/**
		 *  IF the session role_id isn't set, 
		 *  THEN redirect to the login screen
		 */
		
		if (!isset($_SESSION['role_id']) ) {
			redirect(base_url().'index.php/admin/');
		}

		/**
		 * IF the session role_id is less than or equal to 1
		 * THEN redirect to alumni section 
		 */
		
		if ($_SESSION['role_id'] <= 1) {
			redirect(base_url().'index.php/alumni/');
		}

		/**
		 * Load CodeIgnitor csvReader Library
		 */
		
        $this->load->library('csvreader');

        /**
         * CSV upload configuration 
         */
        
        $config['upload_path'] = './csv/';
		$config['allowed_types'] = 'text/plain|text/csv|csv|text/comma-separated-values|application/csv|application/excel|application/vnd.ms-excel|application/vnd.msexcel|text/anytext	';
		$config['max_size'] = '5000';
		$config['file_name'] = 'upload' . time();
		$this->load->library('upload', $config);

		/**
		 * IF upload errors return errors
		 * ELSE read the CSV, and foreach row preform add_alumni_massImport() model
		 * 
		 */
		
		if ( ! $this->upload->do_upload() )
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

	/**
	 * Delete Alumni from database
	 * See application/models/admins.php file.
	 */
	
	function deletealumni($id)
	{
		/**
		 *  IF the session role_id isn't set, 
		 *  THEN redirect to the login screen
		 */
		
		if (!isset($_SESSION['role_id']) ) {
			redirect(base_url().'index.php/admin/');
		}

		/**
		 * IF the session role_id is less than or equal to 1
		 * THEN redirect to alumni section 
		 */
		
		if ($_SESSION['role_id'] <= 1) {
			redirect(base_url().'index.php/alumni/');
		}
		
		$this->admins->delete_alumni($id);
		redirect(base_url().'index.php/admin/dashboard');
	}


	/**
	 * Manage Admins Controller
	 * 
	 */
	
	function manage_admins($start=0)
	{
		/**
		 *  IF the session role_id isn't set, 
		 *  THEN redirect to the login screen
		 */
		
		if (!isset($_SESSION['role_id']) ) {
			redirect(base_url().'index.php/admin/');
		}

		/**
		 * IF the session role_id is less than or equal to 1
		 * THEN redirect to alumni section 
		 */
		
		if ($_SESSION['role_id'] <= 1) {
			redirect(base_url().'index.php/alumni/');
		}

		/**
		 * Get all admins information
		 */
		
		$data['admins']=$this->admins->get_admins(25, $start);

		/**
		 * CodeIgnitor Pagination
		 */
		
		$this->load->library('pagination');
		$config['base_url']=base_url().'index.php/admin/manage_admins';
		$config['total_rows']=$this->admins->get_admin_count();
		$config['per_page']=10; 
		$this->pagination->initialize($config); 
		$data['pages']=$this->pagination->create_links();

		/**
		 * Load interface
		 */
		
		$this->load->view('admin_views/layout/header.php');
		$this->load->view('admin_views/admin/view_all.php',$data);
		$this->load->view('admin_views/layout/sidebar.php');
		$this->load->view('admin_views/layout/footer.php');
	}

	/**
	 * Admin Admin 
	 */
	function add_admin()
	{
		/**
		 *  IF the session role_id isn't set, 
		 *  THEN redirect to the login screen
		 */
		
		if (!isset($_SESSION['role_id']) ) {
			redirect(base_url().'index.php/admin/');
		}

		/**
		 * IF the session role_id is less than or equal to 1
		 * THEN redirect to alumni section 
		 */
		
		if ($_SESSION['role_id'] <= 1) {
			redirect(base_url().'index.php/alumni/');
		}

		/**
		 * IF $_POST
		 * THEN set the values
		 */
		
		if($_POST)
		{
			$email = $_POST['email'];
			$first_name=$_POST['first_name'];
			$last_name=$_POST['last_name'];
			$pwd = $_POST['pwd'];
			$role = $_POST['role_id'];

			$data['results']=$this->admins->add_admin($email,$first_name, $last_name, $pwd,$role);

			/**
			 * Load interface
			 */
			
			$this->load->view('admin_views/layout/header.php');
			$this->load->view('admin_views/admin/add.php',$data);
			$this->load->view('admin_views/layout/sidebar.php');
			$this->load->view('admin_views/layout/footer.php');
		}
		else {

			/**
			 * Load interface
			 */
			
			$data['role']=$this->admins->get_roles();
			$this->load->view('admin_views/layout/header.php');
			$this->load->view('admin_views/admin/add.php',$data);
			$this->load->view('admin_views/layout/sidebar.php');
			$this->load->view('admin_views/layout/footer.php');
		}
	}

	
	/**
	 * Admin_profile is used to update an admins information
	 */
	function admin_profile($id)
	{	
		/**
		 *  IF the session role_id isn't set, 
		 *  THEN redirect to the login screen
		 */
		
		if (!isset($_SESSION['role_id']) ) {
			redirect(base_url().'index.php/admin/');
		}

		/**
		 * IF the session role_id is less than or equal to 1
		 * THEN redirect to alumni section 
		 */
		
		if ($_SESSION['role_id'] <= 1) {
			redirect(base_url().'index.php/alumni/');
		}

		/**
		 * Load CodeIgniter security helper
		 */
		$this->load->helper('security');
		$data['success']=0;  

		if($_POST) 
		{
			/**
			 * IF pwd field remains empty then keep current password, 
			 * ELSE, update to new password
			 */
			
			if(empty($_POST['pwd'])) {
				$password = do_hash($_POST['pwd'],'md5');
			} else { 
				$query = $this->db->query("SELECT pwd FROM admin WHERE id = $id");
				$data = $query->first_row('array');
				$password = $data['pwd'];
			}

				$email=$_POST['email'];
				$first_name=$_POST['first_name'];
				$last_name=$_POST['last_name'];
				$pwd= $password;
				$role=$_POST['role_id'];


			$data['results']=$this->admins->update_admin($id, $email, $first_name, $last_name, $pwd, $role);
			$data['success'] = 1;
		}

		/**
		 * Get roles rows with the get_roles model
		 * Get the current admins role with get_user_role model
		 * Get admin's information get_valid_degrees() model
		 * Get alumni's information
		 * See application/models/admins.php file.
		 */
			
		$data['role']=$this->admins->get_roles();
		$data['user_role']=$this->admins->get_user_role($id);
		$data['admin']=$this->admins->get_admin($id);

		/**
		 * Load interface
		 */
		
		$this->load->view('admin_views/layout/header.php');
		$this->load->view('admin_views/admin/edit.php',$data);
		$this->load->view('admin_views/layout/sidebar.php');
		$this->load->view('admin_views/layout/footer.php');
	}

	function deleteadmin($id)
	{
		/**
		 *  IF the session role_id isn't set, 
		 *  THEN redirect to the login screen
		 */
		
		if (!isset($_SESSION['role_id']) ) {
			redirect(base_url().'index.php/admin/');
		}

		/**
		 * IF the session role_id is less than or equal to 1
		 * THEN redirect to alumni section 
		 */
		
		if ($_SESSION['role_id'] <= 1) {
			redirect(base_url().'index.php/alumni/');
		}

		/**
		 * delete_admin uses delete_admin() 
		 * model to delete admin 
		 */
		
		$this->admins->delete_admin($id);
		redirect(base_url().'index.php/admin/manage_admins', 'refresh');
	}

	
	/**
	 * Social Media list all social media sites in the database.
	 */
	function social_media() 
	{
		/**
		 *  IF the session role_id isn't set, 
		 *  THEN redirect to the login screen
		 */
		
		if (!isset($_SESSION['role_id']) ) {
			redirect(base_url().'index.php/admin/');
		}

		/**
		 * IF the session role_id is less than or equal to 1
		 * THEN redirect to alumni section 
		 */
		
		if ($_SESSION['role_id'] <= 1) {
			redirect(base_url().'index.php/alumni/');
		}

		/**
		 * Get Social Media rows 
		 */
		
		$data['social_media']=$this->admins->get_all_social_media();

		/**
		 * Load interface
		 */
		
		$this->load->view('admin_views/layout/header.php');
		$this->load->view('admin_views/social-media/view_all.php',$data);
		$this->load->view('admin_views/layout/sidebar.php');
		$this->load->view('admin_views/layout/footer.php');
	}

	/**
	 * Add Social Media
	 */
	
	function add_socialmedia()
	{
		/**
		 *  IF the session role_id isn't set, 
		 *  THEN redirect to the login screen
		 */
		
		if (!isset($_SESSION['role_id']) ) {
			redirect(base_url().'index.php/admin/');
		}

		/**
		 * IF the session role_id is less than or equal to 1
		 * THEN redirect to alumni section 
		 */
		
		if ($_SESSION['role_id'] <= 1) {
			redirect(base_url().'index.php/alumni/');
		}

		$data['success']=0;
		/**
		 * IF $_POST 
		 * THEN 
		 */
		if($_POST)
		{
			$social_media = $_POST['social_media'];
			$data['results']=$this->admins->add_social_media($social_media);
		}

		/**
		 * Load interface
		 */
		
		$this->load->view('admin_views/layout/header.php');
		$this->load->view('admin_views/social-media/add.php', $data);
		$this->load->view('admin_views/layout/sidebar.php');
		$this->load->view('admin_views/layout/footer.php');

	}

	/**
	 * Degrees Controllers
	 * 
	 */

	function degrees()
	{

		/**
		 *  IF the session role_id isn't set, 
		 *  THEN redirect to the login screen
		 */
		
		if (!isset($_SESSION['role_id']) ) {
			redirect(base_url().'index.php/admin/');
		}

		/**
		 * IF the session role_id is less than or equal to 1
		 * THEN redirect to alumni section 
		 */
		
		if ($_SESSION['role_id'] <= 1) {
			redirect(base_url().'index.php/alumni/');
		}
		/**
		 * Get degrees in the valid_degrees table
		 */
		$data['valid_degrees']=$this->admins->get_valid_degrees(); 

		/**
		 * Load interface
		 */
		
		$this->load->view('admin_views/layout/header.php');
		$this->load->view('admin_views/degrees/view_all.php',$data);
		$this->load->view('admin_views/layout/sidebar.php');
		$this->load->view('admin_views/layout/footer.php');
	}

	function add_degree()
	{
		/**
		 *  IF the session role_id isn't set, 
		 *  THEN redirect to the login screen
		 */
		
		if (!isset($_SESSION['role_id']) ) {
			redirect(base_url().'index.php/admin/');
		}

		/**
		 * IF the session role_id is less than or equal to 1
		 * THEN redirect to alumni section 
		 */
		
		if ($_SESSION['role_id'] <= 1) {
			redirect(base_url().'index.php/alumni/');
		}

		/**
		 * IF $_POST then set degree
		 * 
		 */
		if($_POST)
		{
			$degree = $_POST['degree'];

			/**
			 * Add degree value using add_valid_degree()
			 */
			
			$data['results']=$this->admins->add_valid_degree($degree);

			/**
			 * Load interface
			 */
			
			$this->load->view('admin_views/layout/header.php');
			$this->load->view('admin_views/degrees/add.php', $data);
			$this->load->view('admin_views/layout/sidebar.php');
			$this->load->view('admin_views/layout/footer.php');

		} else {

			/**
			 * Load interface
			 */

			$this->load->view('admin_views/layout/header.php');
			$this->load->view('admin_views/degrees/add.php');
			$this->load->view('admin_views/layout/sidebar.php');
			$this->load->view('admin_views/layout/footer.php');

		}
	}
	/**
	 * Degree Controller is used to update degree name
	 */
	function degree($id)
	{	
		/**
		 *  IF the session role_id isn't set, 
		 *  THEN redirect to the login screen
		 */
		
		if (!isset($_SESSION['role_id']) ) {
			redirect(base_url().'index.php/admin/');
		}

		/**
		 * IF the session role_id is less than or equal to 1
		 * THEN redirect to alumni section 
		 */
		
		if ($_SESSION['role_id'] <= 1) {
			redirect(base_url().'index.php/alumni/');
		}

		/**
		 * Get Current Valid of Degree based on ID
		 */
		
		$data['valid_degree']=$this->admins->get_valid_degree($id);

		/**
		 * IF $_POST set value and update into database
		 */
		if($_POST) 
		{	

			$degree = $_POST['degree'];
			$data['results']=$this->admins->update_degree($id,$degree);
		}

		

		/**
		 * Load interface
		 */
			
		$this->load->view('admin_views/layout/header.php');
		$this->load->view('admin_views/degrees/edit.php', $data);
		$this->load->view('admin_views/layout/sidebar.php');
		$this->load->view('admin_views/layout/footer.php');

	}

	function deletedegree($id)
	{
		/**
		 *  IF the session role_id isn't set, 
		 *  THEN redirect to the login screen
		 */
		
		if (!isset($_SESSION['role_id']) ) {
			redirect(base_url().'index.php/admin/');
		}

		/**
		 * IF the session role_id is less than or equal to 1
		 * THEN redirect to alumni section 
		 */
		
		if ($_SESSION['role_id'] <= 1) {
			redirect(base_url().'index.php/alumni/');
		}

		/**
		 * Delete degree using delete_valid_degree() model
		 */
		
		$this->admins->delete_valid_degree($id);

		/**
		 * redirect to main degree pages
		 */
		
		$data['redirect_url']=base_url()."index.php/admin/degrees";
		$this->load->view('help/redirect.php',$data);
	}

	/**
	 * Department Controllers 
	 * ---------------------------------------
	 */

	function departments()
	{
		/**
		 *  IF the session role_id isn't set, 
		 *  THEN redirect to the login screen
		 */
		
		// if (!isset($_SESSION['role_id']) ) {
		// 	redirect(base_url().'index.php/admin/');
		// }

		/**
		 * IF the session role_id is less than or equal to 1
		 * THEN redirect to alumni section 
		 */
		
		// if ($_SESSION['role_id'] <= 1) {
		// 	redirect(base_url().'index.php/alumni/');
		// }

		/**
		 * Get all departments using the get_valid_departments
		 */

		$data['valid_departments'] = $this->admins->get_valid_departments();

		/**
		 * Load interface
		 */
		
		$this->load->view('admin_views/layout/header.php');
		$this->load->view('admin_views/departments/view_all.php',$data);
		$this->load->view('admin_views/layout/sidebar.php');
		$this->load->view('admin_views/layout/footer.php');
	}

	function add_department()
	{
		/**
		 *  IF the session role_id isn't set, 
		 *  THEN redirect to the login screen
		 */
		$data['results'] = NULL; 
		
		if (!isset($_SESSION['role_id']) ) {
			redirect(base_url().'index.php/admin/');
		}

		/**
		 * IF the session role_id is less than or equal to 1
		 * THEN redirect to alumni section 
		 */
		
		if ($_SESSION['role_id'] <= 1) {
			redirect(base_url().'index.php/alumni/');
		}

		$this->load->helper('array');

		if($_POST)
		{

			$department=$_POST['department'];
			$data['results']=$this->admins->add_valid_department($department);
		}

		/**
		 * Load interface
		 */
		$this->load->view('admin_views/layout/header.php');
		$this->load->view('admin_views/departments/add.php', $data);
		$this->load->view('admin_views/layout/sidebar.php');
		$this->load->view('admin_views/layout/footer.php');
	}

	/**
	 * Department controller
	 * is used to update a department
	 */
	
	function department($id)
	{	
		/**
		 *  IF the session role_id isn't set, 
		 *  THEN redirect to the login screen
		 */
		
		// if (!isset($_SESSION['role_id']) ) {
		// 	redirect(base_url().'index.php/admin/');
		// }

		/**
		 * IF the session role_id is less than or equal to 1
		 * THEN redirect to alumni section 
		 */
		
		// if ($_SESSION['role_id'] <= 1) {
		// 	redirect(base_url().'index.php/alumni/');
		// }

		if($_POST) 
		{	

			$department = $_POST['department'];
			$data['results']=$this->admins->update_department($id,$department);
		}

		/**
		 * Get current department name
		 */
		
		$data['valid_department']=$this->admins->get_valid_department($id);

		/**
		 * Load interface
		 */
		
		$this->load->view('admin_views/layout/header.php');
		$this->load->view('admin_views/departments/edit.php', $data);
		$this->load->view('admin_views/layout/sidebar.php');
		$this->load->view('admin_views/layout/footer.php');

	}
	

	function deletedepartment($id)
	{
		/**
		 * Get department name based on ID. 
		 */
		$query = $this->db->query("SELECT department FROM valid_departments WHERE id = $id");
		$data = $query->first_row('array');
		$department = $data['department'];

		$this->admins->delete_valid_department($department); 

		/**
		 * Redirect 
		 */
		
		$data['redirect_url']= base_url()."index.php/admin/departments";
		$this->load->view('help/redirect.php',$data);
	}

	/**
	 * Donations
	 * ---------------------------------------
	 */
	
	function donations($start=0)
	{
		/**
		 *  IF the session role_id isn't set, 
		 *  THEN redirect to the login screen
		 */
		
		if (!isset($_SESSION['role_id']) ) {
			redirect(base_url().'index.php/admin/');
		}

		/**
		 * IF the session role_id is less than or equal to 1
		 * THEN redirect to alumni section 
		 */
		
		if ($_SESSION['role_id'] <= 1) {
			redirect(base_url().'index.php/alumni/');
		}

		/**
		 * Get all of the donations in the database
		 */
		
		$data['donations']=$this->admins->get_donations(25, $start);

		// Pagination
		$this->load->library('pagination');
		$config['base_url']=base_url().'index.php/admin/donations';
		$config['total_rows']=$this->admins->get_donation_count();
		$config['per_page']=25; 
		$this->pagination->initialize($config); 
		$data['pages']=$this->pagination->create_links();

		/**
		 * Load interface
		 */
		
		$this->load->view('admin_views/layout/header.php');
		$this->load->view('admin_views/donations/view_all.php',$data);
		$this->load->view('admin_views/layout/sidebar.php');
		$this->load->view('admin_views/layout/footer.php');

	}
	
	function add_donation($id)
	{
		/**
		 *  IF the session role_id isn't set, 
		 *  THEN redirect to the login screen
		 */
		
		if (!isset($_SESSION['role_id']) ) {
			redirect(base_url().'index.php/admin/');
		}

		/**
		 * IF the session role_id is less than or equal to 1
		 * THEN redirect to alumni section 
		 */
		
		if ($_SESSION['role_id'] <= 1) {
			redirect(base_url().'index.php/alumni/');
		}
		/**
		 * Get alumn information and payment_type information for dropdown
		 */
			
		$data['valid_payment_type']=$this->admins->get_payment_types();
		$data['alumni']=$this->admins->get_alumnus($id);

		/**
		 * IF $_POST, then set value and enter into database  
		 */
		
		if($_POST)
		{
			$student_id = $_POST['student_id'];
			$donation_amount = $_POST['donation_amount'];
			$payment_type = $_POST['payment_type'];
			$donation_date = $_POST['donation_date'];
			$data['results']=$this->admins->add_donations($student_id,$donation_amount, $payment_type, $donation_date);
		} 

			$this->load->view('admin_views/layout/header.php');
			$this->load->view('admin_views/donations/add.php',$data);
			$this->load->view('admin_views/layout/sidebar.php');
			$this->load->view('admin_views/layout/footer.php');
		
	}

	/**
	 * Search
	 * ---------------------------------------
	 */
	
	function search($start=0)
	{
		/**
		 *  IF the session role_id isn't set, 
		 *  THEN redirect to the login screen
		 */
		
		if (!isset($_SESSION['role_id']) ) {
			redirect(base_url().'index.php/admin/');
		}

		/**
		 * IF the session role_id is less than or equal to 1
		 * THEN redirect to alumni section 
		 */
		
		if ($_SESSION['role_id'] <= 1) {
			redirect(base_url().'index.php/alumni/');
		}

		/**
		 * $_GET query value 
		 */

		$q = $_GET['q'];

		/**
		 * IF graduation_year is not set or empty 
		 * THEN set to null
		 * ELSE set $_GET value
		 */
		
		if( !isset($_GET['graduation_year']) || empty($_GET['graduation_year']) )
		{
			$graduation_year = NULL;
		} else {
			$graduation_year = $_GET['graduation_year'] ;
		}

		/**
		 * IF degree is not set or empty 
		 * THEN set to null
		 * ELSE set $_GET value
		 */
		
		if( !isset($_GET['degree']) || empty($_GET['degree']) )
		{
			$degree = NULL; 
		} else {
			$degree = $_GET['degree'];
		}

		/**
		 * IF department is not set or empty 
		 * THEN set to null
		 * ELSE set $_GET value
		 */
		
		if( !isset($_GET['department']) || empty($_GET['department']) )
		{
			$department = NULL;
		} else {
			$department = $_GET['department'];
		}
		
		/**
		 * Return Results
		 * 
		 */
		
		$data['alumni']=$this->admins->alumni_search($q, $department, $degree, $graduation_year, 5 , $start);

		/**
		 * Load interface 
		 */
		
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
		/**
		 *  IF the session role_id isn't set, 
		 *  THEN redirect to the login screen
		 */
		
		if (!isset($_SESSION['role_id']) ) {
			redirect(base_url().'index.php/admin/');
		}

		/**
		 * IF the session role_id is less than or equal to 1
		 * THEN redirect to alumni section 
		 */
		
		if ($_SESSION['role_id'] <= 1) {
			redirect(base_url().'index.php/alumni/');
		}

		/**
		 * IF degree is not set or empty 
		 * THEN set to null
		 * ELSE set $_GET value
		 */

		if( !isset($_GET['degree']) || empty($_GET['degree']) )
		{
			$degree = NULL;
		} else {
			$degree = $_GET['degree'] ;
		}

		/**
		 * IF graduation_year is not set or empty 
		 * THEN set to null
		 * ELSE set $_GET value
		 */
		
		if( !isset($_GET['graduation_year']) || empty($_GET['graduation_year']) )
		{
			$graduation_year = NULL; 
		} else {
			$graduation_year = $_GET['graduation_year'];
		}
		
		/**
		 * IF zip_code is not set or empty 
		 * THEN set to null
		 * ELSE set $_GET value
		 */
		
		if( !isset($_GET['zip_code']) || empty($_GET['zip_code']) )
		{
			$zip_code = NULL;
		} else {
			$zip_code = $_GET['zip_code'];
		}

		/**
		 * Load interface 
		 */
		
		$data['email']=$this->admins->alumni_email_list($degree, $graduation_year, $zip_code);
		$data['valid_degrees']=$this->admins->get_valid_degrees();
		$this->load->view('admin_views/layout/header.php');
		$this->load->view('admin_views/email/list.php', $data);
		$this->load->view('admin_views/layout/sidebar.php');
		$this->load->view('admin_views/layout/footer.php');
	}


}