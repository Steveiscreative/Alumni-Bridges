<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Reports extends CI_Controller
{
	function __construct()
	{
		parent::__construct(); 
		$this->load->model('report');
	}

	/**
	 * Default page shows state for the current year
	 */
	
	function index()
	{
		/**
		 *  IF the session role_id isn't set, 
		 *  THEN redirect to the login screen
		 */
		
		/*
		if (!isset($_SESSION['role_id']) ) {
			redirect(base_url().'index.php/admin/');
		}
		*/
	
		/*
		 * IF the session role_id is less than or equal to 1
		 * THEN redirect to alumni section 
		 */
		/*
		 if ($_SESSION['role_id'] <= 1) {
			redirect(base_url().'index.php/alumni/');
		}
		*/

		/**
		 * Get the current year
		 * This is used to generate an up to date report 
		 */
		
		date_default_timezone_set('America/New_York');
		$getCurrentYear = date("Y"); 

		$data['year']= $getCurrentYear; 
		
		
		$data['donation_count']=$this->report->total_donations_count($getCurrentYear); 
		$data['payment_type_overview']=$this->report->payment_type_overview($getCurrentYear); 
		
		$data['top_donators']=$this->report->top_three_donators($getCurrentYear); 
		$data['department_donations']=$this->report->donations_by_department_overview($getCurrentYear); 
		$data['class_donations']=$this->report->donations_by_class_overview($getCurrentYear);
		$data['monthly_overview']=$this->report->donations_by_monthly_overview($getCurrentYear);
		$data['donation_total']=$this->report->total_donations_amount($getCurrentYear);

		// Load Views 
		$this->load->view('admin_views/layout/header.php');
		$this->load->view('admin_views/reports/overview.php',$data);
		$this->load->view('admin_views/layout/sidebar.php');
		$this->load->view('admin_views/layout/footer.php');

	}

	/**
	 * [report description]
	 * @return [type] [description]
	 */
	
	function report() 
	{
		/**
		 *  IF the session role_id isn't set, 
		 *  THEN redirect to the login screen
		 */
		
		/*
		if (!isset($_SESSION['role_id']) ) {
			redirect(base_url().'index.php/admin/');
		}
		*/
	
		/*
		 * IF the session role_id is less than or equal to 1
		 * THEN redirect to alumni section 
		 */
		/*
		 if ($_SESSION['role_id'] <= 1) {
			redirect(base_url().'index.php/alumni/');
		}
		*/

		if($_GET)
		{
			/**
			 * Set Year 
			 */
			if(!isset($_GET['year']) || empty($_GET['year'])) {
				date_default_timezone_set('America/New_York');
				$year = date("Y"); 
			} else {
				$year = $_GET['year'];
			}

			/**
			 * Set department
			 */
			if(!isset($_GET['department']) || empty($_GET['department'])) {
				$department = NULL;
			} else {
				$department = $_GET['department']; 
			}

			/**
			 * Set Graduation Year
			 */

			if(!isset($_GET['graduation_year']) || empty($_GET['graduation_year'])) {
				$graduation_year = NULL; 
			} else {
				$graduation_year = $_GET['graduation_year']; 
			}
			
			/**
			 * Set month
			 */

			if(!isset($_GET['month']) || empty($_GET['month'])){
				$month = NULL; 
			} else {
				$month = $_GET['month']; 
			}

			$data['donators'] = $this->report->report_donations_list($year, $month, $department, $graduation_year);
			$data['total_donations']=$this->report->report_donations_sum($year, $month, $department, $graduation_year);
			$data['month']=$this->report->report_dontations_by_month($year, $department, $graduation_year);
			$data['count']=$this->report->report_donations_count($year, $month, $department, $graduation_year);
			$data['department']=$this->report->report_donations_by_department($year, $month, $graduation_year);
			$data['payment_type']=$this->report->report_donation_by_payment_types($year, $month, $department, $graduation_year); 
			$data['grad_year']=$this->report->report_donation_by_grad_year($year, $month, $department); 		
		}

		/**
		 * Load Views
		 */
		
		$this->load->view('admin_views/layout/header.php');
		$this->load->view('admin_views/reports/report.php',$data);
		$this->load->view('admin_views/layout/sidebar.php');
		$this->load->view('admin_views/layout/footer.php');
	
		
	}

}

?>