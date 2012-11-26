<?php 

class Reports extends CI_Controller
{
	function __construct()
	{
		parent::__construct(); 
		$this->load->model('report');
	}

	function index()
	{
		/**
		 * Get the current year
		 * This is used to generate an up to date report 
		 */
		date_default_timezone_set('America/New_York');
		$getCurrentYear = date("Y"); 

		$data['year']= $getCurrentYear; 
		$data['donation_total']=$this->report->total_donations_amount($getCurrentYear); 
		$data['donation_count']=$this->report->total_donations_count($getCurrentYear); 
		$data['payment_type_overview']=$this->report->payment_type_overview($getCurrentYear); 
		$data['monthly_overview']=$this->report->donations_by_monthly_overview($getCurrentYear);
		$data['top_donators']=$this->report->top_three_donators($getCurrentYear); 
		$data['department_donations']=$this->report->donations_by_department_overview($getCurrentYear); 
		$data['class_donations']=$this->report->donations_by_class_overview($getCurrentYear);

		// Load Views 
		$this->load->view('inc/header.inc.php');
		$this->load->view('reports_overview',$data);
		$this->load->view('inc/footer.inc.php');

	}

	function report() 
	{
		if($_GET)
		{
			if(!isset($_GET['year']) || empty($_GET['year'])) {
				date_default_timezone_set('America/New_York');
				$year = date("Y"); 
			} else {
				$year = $_GET['year'];
			}

			if(!isset($_GET['department']) || empty($_GET['department'])) {
				$department = NULL;
			} else {
				$department = $_GET['department']; 
			}

			if(!isset($_GET['graduation_year']) || empty($_GET['graduation_year'])) {
				$graduation_year = NULL; 
			} else {
				$graduation_year = $_GET['graduation_year']; 
			}

			if(!isset($_GET['month']) || empty($_GET['month'])){
				$month = NULL; 
			} else {
				$month = $_GET['month']; 
			}

			$data['donators'] = $this->report->report_donations_list($year, $month, $department, $graduation_year);
			$data['total_donations']=$this->report->report_donations_sum($year, $month, $department, $graduation_year);

		}
		$this->load->view('inc/header.inc.php');
		$this->load->view('report',$data);
		$this->load->view('inc/footer.inc.php');
	
		
	}

}

?>