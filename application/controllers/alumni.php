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
		$this->form_validation->set_rules('email', 'student_id', 'required|is_unique[alumni.student_id]');
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

	function firsttime()
	{
		$this->load->library('form_validation');
		$data['res']=0;
		$this->form_validation->set_rules('pwd','Password', 'required|min_length[6]');
		$this->form_validation->set_rules('verify_pwd','Verify Password', 'required|min_length[6]|matches[pwd]');

		$this->form_validation->set_rules('first_name','First Name', 'required');
		$this->form_validation->set_rules('last_name','Last Name', 'required');

		$this->form_validation->set_rules('student_id','Student ID', 'required|numeric');


		$first_name = $this->input->post('first_name');
		$last_name = $this->input->post('last_name');
		$student_id= $this->input->post('student_id');
		$password= $this->input->post('pwd');


		if ($this->form_validation->run() !== false) {
			$this->load->model('user'); 

			$result = $this
						->user
						->verify_firsttime_alumni(
							$first_name, 
							$last_name, 
							$student_id
						);

			$pwd_array=array(
				'pwd' => MD5($password)
			); 

			if( $result !== false ) 
			{
				$data['res'] = 2;
				$this
				->user
				->set_password(
					$student_id, 
					$pwd_array
				);
				//redirect('alumni/');

			} else {
				$data['res'] = 1;
			}

		}

		$this->load->view('alumni_views/layout/header.php');
		$this->load->view('alumni_views/firsttime.php',$data);
		$this->load->view('alumni_views/layout/footer.php');	
	}

	function logout(){
		session_destroy();
		redirect(base_url().'index.php/admin/');
	}

	function directory($start=0)
	{
		
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

		$data['alumni']=$this->alumnus->alumni(10,$start, $graduation_year, $degree, $department);
		// $data['socialMedia']=$this->admins->get_alumni_social_media($student_id);

		// Pagination 
		$this->load->library('pagination');
		$config['base_url']=base_url().'index.php/alumni/directory';
		if ($_GET) {
			$config['total_rows']=$this->alumnus->alumniResultCount($graduation_year, $degree, $department);
		} else {
			$config['total_rows']=$this->alumnus->alumni_count();
		}
		

		$config['per_page']=10; 
		$this->pagination->initialize($config); 
		$data['pages']=$this->pagination->create_links();

		$data['valid_departments']=$this->admins->get_valid_departments();
		$data['valid_degrees']=$this->admins->get_valid_degrees();
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
		$data['valid_departments']=$this->admins->get_valid_departments();
		$data['valid_degrees']=$this->admins->get_valid_degrees();
		
		$this->load->view('alumni_views/layout/header.php');
		$this->load->view('alumni_views/directory.php',$data);
		$this->load->view('alumni_views/layout/sidebar.php');
		$this->load->view('alumni_views/layout/footer.php');
	}

	function profile($id)
	{
		$data['success'] = 0;
		// Get Student ID 
		$query=$this->db->query("SELECT student_id FROM alumni where id = $id");
		$data=$query->first_row('array');
		$student_id = $data['student_id'];

		$q=$this->db->query("SELECT COUNT(1) AS total from social_media where student_id = $student_id ");
		$check=$q->first_row('array');
		$social_check=$check['total'];

		if ($_POST) {
			
			$alumni_data=array(
				'first_name'=>$_POST['first_name'],
				'last_name'=>$_POST['last_name'],
				'street'=>$_POST['street'],
				'city'=>$_POST['city'],
				'state'=>$_POST['state'], 
				'zip_code'=>$_POST['zip_code'],
				'email'=>$_POST['email'],
				'telephone'=>$_POST['telephone'],
			);

			/**
			 * Check to see if social media row exist, if not insert, else update
			 */
			
			if ($social_check == 0 ) {

				$social_array=array(
					'student_id'=>$student_id,
					'twitter' =>$_POST['twitter'], 
					'facebook'=>$_POST['facebook'], 
					'linkedin'=>$_POST['linkedin']);

				$this->alumnus->add_social_media($social_array);

			} else {
				$social_array=array(
				'twitter' =>$_POST['twitter'], 
				'facebook'=>$_POST['facebook'], 
				'linkedin'=>$_POST['linkedin']
				);
				$this->alumnus->update_social_media($student_id, $social_array);
			}
			

			$this->alumnus->update_alumnus($id, $alumni_data);
			$data['success'] = 1;
		}

		

		// Pass Data to View
		$data['socialMedia']=$this->alumnus->get_alumni_social_media($student_id);
		$data['valid_social_media']=$this->admins->get_all_social_media();
		$data['alumni']=$this->alumnus->get_alumnus($id);

		// Load Views 
		$this->load->view('alumni_views/layout/header.php');
		$this->load->view('alumni_views/profile.php',$data);
		$this->load->view('alumni_views/layout/sidebar.php');
		$this->load->view('alumni_views/layout/footer.php');
	}

}
