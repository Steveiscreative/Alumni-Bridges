<?php 
class Admin extends CI_Controller
{
	
	function __construct()
	{
		parent::__construct(); 
		$this->load->model('admins');
	}

	/**
	 * Dashboard 
	 * ---------------------------------------
	 */
	
	function dashboard($start=0)
	{	
		$data['alumni']=$this->admins->get_alumni(20,$start);

		// Pagination 
		$this->load->library('pagination');
		$config['base_url']=base_url().'index.php/admin/dashboard';
		$config['total_rows']=$this->admins->get_alumni_count();
		$config['per_page']=20; 
		$this->pagination->initialize($config); 
		$data['pages']=$this->pagination->create_links();

		$this->load->view('inc/header.inc.php');
		$this->load->view('dashboard',$data);
		$this->load->view('inc/footer.inc.php');
	}

	/**
	 * Alumni Controllers
	 * ---------------------------------------
	 */

	function add_alumni()
	{
		if($_POST)
		{
			$student_id =$_POST['student_id']; 
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

			$this->admins->add_alumni($student_id, $first_name,$last_name,$address, $city, $state, $zip_code, $email, $telephone, $degree, $deparment);
			
		} else {
			$data['valid_departments']=$this->admins->get_valid_departments();
			$data['valid_degrees']=$this->admins->get_valid_degrees();
			$this->load->view('inc/header.inc.php');
			$this->load->view('add_alumni', $data);
			$this->load->view('inc/footer.inc.php');
		}

	}

	function alumni_profile($id)
	{

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
				'department'=>$_POST['department']
			);

			$this->admins->update_alumni($id, $alumni_data);

		} 

			$data['valid_departments']=$this->admins->get_valid_departments();
			$data['valid_degrees']=$this->admins->get_valid_degrees();
			$data['alumni']=$this->admins->get_alumnus($id);

			$this->load->view('inc/header.inc.php');
			$this->load->view('update_alumni',$data);
			$this->load->view('inc/footer.inc.php');
	}


	/**
	 * Admin Controllers
	 * ---------------------------------------
	 */
	
	function manage_admins($start=0)
	{
		$data['admins']=$this->admins->get_admins(25, $start);

		// Pagination 
		$this->load->library('pagination');
		$config['base_url']=base_url().'index.php/admin/manage_admins';
		$config['total_rows']=$this->admins->get_admin_count();
		$config['per_page']=25; 
		$this->pagination->initialize($config); 
		$data['pages']=$this->pagination->create_links();

		$this->load->view('inc/header.inc.php');
		$this->load->view('administrators',$data);
		$this->load->view('inc/footer.inc.php');
	}

	function add_admin()
	{
		if($_POST)
		{
			$email = $_POST['email'];
			$first_name=$_POST['first_name'];
			$last_name=$_POST['last_name'];
			$pwd = $_POST['pwd'];
			$role = $_POST['role'];

			$this->admins->add_admin($email,$first_name, $last_name, $pwd,$role);
		}
		else {
			$this->load->view('inc/header.inc.php');
			$this->load->view('add_admin');
			$this->load->view('inc/footer.inc.php');
		}
	}

	function deletealumni($id)
	{
		$this->admins->delete_alumni($id);
		redirect(base_url().'index.php/admin/dashboard');
	}

	function admin_profile($id)
	{	
		
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
				'role_id'=>$_POST['role_id']);

			$this->admins->update_admin($id,$data_admin);
			$data['success'] = 1;
		}

		$data['admin']=$this->admins->get_admin($id);
		$this->load->view('inc/header.inc.php');
		$this->load->view('update_admin',$data);
		$this->load->view('inc/footer.inc.php');
	}

	function deleteadmin($id)
	{
		$this->admins->delete_admin($id);
		redirect(base_url().'index.php/admin/manage_admins');
	}

	/**
	 * Degrees Controllers
	 * ---------------------------------------
	 */

	function degrees()
	{
		$data['valid_degrees']=$this->admins->get_valid_degrees(); 
		$this->load->view('inc/header.inc.php');
		$this->load->view('degrees', $data);
		$this->load->view('inc/footer.inc.php');
	}

	function add_degree()
	{
		if($_POST)
		{
			$degree = $_POST['degree'];
			$this->admins->add_valid_degree($degree);
		}
		
		$this->load->view('inc/header.inc.php');
		$this->load->view('add_degree');
		$this->load->view('inc/footer.inc.php');

	}

	function deletedegree($id)
	{
		$this->admins->delete_valid_degree($id);
		redirect(base_url().'index.php/admin/degrees');
	}

	/**
	 * Department Controllers 
	 * ---------------------------------------
	 */

	function departments()
	{
		$data['valid_departments'] = $this->admins->get_valid_departments();

		$this->load->view('inc/header.inc.php'); 
		$this->load->view('departments', $data); 
		$this->load->view('inc/footer.inc.php');
	}

	function add_department()
	{
		$this->load->helper('array');
		if($_POST)
		{
			$department=$_POST['department'];
			$this->admins->add_valid_department($department);
		}

		$this->load->view('inc/header.inc.php');
		$this->load->view('add_department');
		$this->load->view('inc/footer.inc.php');
	}

	function department($id)
	{	
		$data['success'] = 0;

		if($_POST) 
		{	$data=array(
				'department' => $_POST['department']); 
			$this->admins->update_department($id,$data);
			$data['success'] = 1;
		}

		$data['valid_department']=$this->admins->get_valid_department($id);
		$this->load->view('inc/header.inc.php');
		$this->load->view('update_department',$data);
		$this->load->view('inc/footer.inc.php');

	}
	

	function deletedepartment($id)
	{
		$this->admins->delete_valid_department($id); 
		redirect(base_url().'index.php/admin/departments');
	}

	/**
	 * Donations
	 * ---------------------------------------
	 */
	
	function donations($start=0)
	{
		$data['donations']=$this->admins->get_donations(25, $start);

		// Pagination
		$this->load->library('pagination');
		$config['base_url']=base_url().'index.php/admin/donations';
		$config['total_rows']=$this->admins->get_donation_count();
		$config['per_page']=25; 
		$this->pagination->initialize($config); 
		$data['pages']=$this->pagination->create_links();

		$this->load->view('inc/header.inc.php'); 
		$this->load->view('donations', $data);
		$this->load->view('inc/footer.inc.php'); 

	}
	
	function add_donation($id)
	{
		if($_POST)
		{
			$student_id = $_POST['student_id'];
			$donation_amount = $_POST['donation_amount'];
			$payment_type = $_POST['payment_type'];
			$donation_date = $_POST['donation_date'];

			$this->admins->add_donations($student_id,$donation_amount, $payment_type, $donation_date);
			redirect(base_url().'index.php/admin/donations');
		}
		else {
			$data['valid_payment_type']=$this->admins->get_payment_types();
			$data['alumni']=$this->admins->get_alumnus($id);
			$this->load->view('inc/header.inc.php');
			$this->load->view('add_donation', $data);
			$this->load->view('inc/footer.inc.php');
		}
	}

	/**
	 * Search
	 * ---------------------------------------
	 */
	
	function search($start=0)
	{
		$terms = $_GET['q'];
		$data['alumni']=$this->admins->alumni_search($terms, 5 ,$start);

		// Pagination 
		$this->load->library('pagination');
		$config['base_url']=base_url().'index.php/admin/search';
		//$config['page_query_string'] = TRUE;
		$config['per_page']=5; 
		$this->pagination->initialize($config); 
		$data['pages']=$this->pagination->create_links();

		$this->load->view('inc/header.inc.php');
		$this->load->view('dashboard', $data);
		$this->load->view('inc/footer.inc.php');
	}

	/**
	 * Reports 
	 * ---------------------------------------
	 */



}