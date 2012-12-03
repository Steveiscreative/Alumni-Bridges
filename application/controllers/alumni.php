<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Alumni extends CI_Controller
{
	
	function __construct()
	{
		parent::__construct(); 
		$this->load->model('alumnus');
		$this->load->model('admins');
		$this->load->helper(array('form', 'url'));
		session_start();
	}

	/**
	 * 
	 */
	function index()
	{
		$this->load->library('form_validation');

		// Form Validation 
		$this->form_validation->set_rules('email', 'student_id', 'required');
		$this->form_validation->set_rules('pwd','Password', 'required|min_length[6]');

		$email = $this->input->post('student_id');
		$password = $this->input->post('pwd');

		if ($this->form_validation->run() !== false) {
			$this->load->model('user'); 

			$result = $this
						->user
						->verify_alumni(
							$email, 
							$password
						);

			if( $result !== false ) 
			{
				$_SESSION['student_id'] = $email;
				$_SESSION['role_id']= $result['role_id'];
				redirect($base_url().'index.php/alumni/directory');
			}

		}

		$this->load->view('alumni_views/layout/header.php');
		$this->load->view('alumni_views/login.php');
		$this->load->view('alumni_views/layout/footer.php');
	}

	function logout(){
		session_destroy();
		redirect(base_url().'index.php/admin/');
	}

	function directory($start=0)
	{
		if($_GET)
		{
			$orderby=$_GET['orderby'];
			$order=$_GET['order']; 
		} else {
			$orderby='id';
			$order='desc'; 
		}

		$data['alumni']=$this->alumnus->alumni(10,$start, $orderby, $order);
		// $data['socialMedia']=$this->admins->get_alumni_social_media($student_id);

		// Pagination 
		$this->load->library('pagination');
		$config['base_url']=base_url().'index.php/alumni/directory';
		$config['total_rows']=$this->alumnus->alumni_count();
		$config['per_page']=10; 
		$this->pagination->initialize($config); 
		$data['pages']=$this->pagination->create_links();

		$this->load->view('alumni_views/layout/header.php');
		$this->load->view('alumni_views/directory.php',$data);
		$this->load->view('alumni_views/layout/sidebar.php');
		$this->load->view('alumni_views/layout/footer.php');
	}

	function search($start=0)
	{
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
		
		$data['alumni']=$this->alumnus->search($q, $department, $degree, $graduation_year, 5 , $start);

		$this->load->view('alumni_views/layout/header.php');
		$this->load->view('alumni_views/directory.php',$data);
		$this->load->view('alumni_views/layout/sidebar.php');
		$this->load->view('alumni_views/layout/footer.php');
	}

	function alumni_profile($student_id)
	{

	}

}
