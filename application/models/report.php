<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Report extends CI_Model
{	
	/**
	 * Reports
	 * ---------------------------------------
	 * get total donations of the year
	 * - total donations
	 * - total amount 
	 * Donation Breakdown by month
	 * Top three alumni donations
	 * Donations by class
	 *
	 * other;
	 * defaults to current year
	 *
	 */
	
	/**
	 * Donation total for the year
	 * @param  date $year 
	 * @return Donation total for the year
	 */
	
	function total_donations_amount($year)
	{
		// SELECT SUM(donation_amount) FROM donations WHERE YEAR(date_donated) = $year
		$this->load->helper('array');
		$query=$this->db->query("CALL sp_report_year_donation_total('$year')");
		$row = $query->row_array();
		return random_element($row);
	}

	/**
	 * Get dontation count for the year
	 */
	
	function total_donations_count($year)
	{
		$this->load->helper('array');
		$query=$this->db->query("CALL sp_report_year_count($year)");
		$row = $query->row_array();
		return random_element($row);
	
	}

	/**
	 * Get donations break down by payment type
	 */

	function payment_type_overview($year)
	{
		$query=$this->db->query("CALL sp_report_donations_by_type($year)");
		return $query->result_array();
		$this->db->reconnect();
	}

	/**
	 * dontation break down by month
	 */

	function donations_by_monthly_overview($year)
	{
		$query=$this->db->query("CALL sp_report_month_by_donations($year)");
		return $query->result_array(); 
		$this->db->reconnect();
	}

	/**
	 * Get donations broken down by departments
	 */
	 
	function donations_by_department_overview($year)
	{
		$query=$this->db->query("CALL sp_report_donations_by_department($year)");

		return $query->result_array(); 
		$this->db->reconnect();
	}

	/**
	 * Donation totals by class
	 */

	function donations_by_class_overview($year) {
		$query=$this->db->query("CALL sp_report_donations_by_class($year)
		");
		return $query->result_array(); 
	}
	
	function top_three_donators($year)
	{
		$query=$this->db->query("CALL sp_report_top_donators($year)");
		return $query->result_array(); 
		$this->db->reconnect();
	}

	function report_donations_list($year, $month, $department, $graduation_year)
	{
		//$department = str_replace($department,'+',' ');
		$this->db->select('alumni.first_name, alumni.last_name, SUM(donations.donation_amount) AS total');
		$this->db->from('alumni_donations');
		$this->db->join('alumni', 'alumni_donations.student_id = alumni.student_id', 'left'); 
		$this->db->join('donations', 'alumni_donations.donation_id = donations.id', 'left');
		$this->db->where('YEAR(date_donated)', $year);

		if($month !== NULL) { 
			$this->db->where('MONTH(date_donated)', $month); 
		}

		if($department !== NULL ) {	
			$this->db->where('department', $department); 
		}

		if($graduation_year !== NULL ) {
			$this->db->where('graduation_year', $graduation_year); 
		}
		$this->db->group_by('alumni.student_id');
		$query=$this->db->get();
		return $query->result_array();
	}

	function report_donations_sum($year, $month, $department, $graduation_year)
	{
		$this->load->helper('array');
		$this->db->select('SUM(donations.donation_amount) AS total');
		$this->db->from('alumni_donations');
		$this->db->join('alumni', 'alumni_donations.student_id = alumni.student_id', 'left'); 
		$this->db->join('donations', 'alumni_donations.donation_id = donations.id', 'left');
		$this->db->where('YEAR(date_donated)', $year);

		if($month !== NULL) { 
			$this->db->where('MONTH(date_donated)', $month); 
		}

		if($department !== NULL ) {	
			$this->db->where('department', $department); 
		}
		if($graduation_year !== NULL ) {
			$this->db->where('graduation_year', $graduation_year); 
		}

		$query=$this->db->get();
		$row = $query->row_array();
		return random_element($row);
	} 

	// Total Donations Count
	function report_donations_count($year, $month, $department, $graduation_year)
	{
		$this->load->helper('array');
		$this->db->select('count(donations.donation_amount) AS total');
		$this->db->from('alumni_donations');
		$this->db->join('alumni', 'alumni_donations.student_id = alumni.student_id', 'left'); 
		$this->db->join('donations', 'alumni_donations.donation_id = donations.id', 'left');
		$this->db->where('YEAR(date_donated)', $year);

		if($month !== NULL) { 
			$this->db->where('MONTH(date_donated)', $month); 
		}

		if($department !== NULL ) {	
			$this->db->where('department', $department); 
		}
		if($graduation_year !== NULL ) {
			$this->db->where('graduation_year', $graduation_year); 
		}

		$query=$this->db->get();
		$row = $query->row_array();
		return random_element($row);
	} 


	// BY MONTH  
	function report_dontations_by_month($year, $department, $graduation_year) 
	{
		$this->db->select('MONTH(date_donated) AS month, SUM(donation_amount) AS total');
		$this->db->from('alumni_donations');
		$this->db->join('alumni', 'alumni_donations.student_id = alumni.student_id', 'left'); 
		$this->db->join('donations', 'alumni_donations.donation_id = donations.id', 'left');
		$this->db->where('YEAR(date_donated)', $year);

		if($department !== NULL ) {	
			$this->db->where('department', $department); 
		}

		if($graduation_year !== NULL ) {
			$this->db->where('graduation_year', $graduation_year); 
		}
		$this->db->group_by('MONTH(date_donated)');
		$query=$this->db->get();
		return $query->result_array();	
	}

	// BY  DEPARTMENT
	function report_donations_by_department($year, $month, $graduation_year)
	{
		$this->db->select('alumni.department, SUM(alumni.donation_total) AS total');
		$this->db->from('alumni_donations');
		$this->db->join('alumni', 'alumni_donations.student_id = alumni.student_id', 'left'); 
		$this->db->join('donations', 'alumni_donations.donation_id = donations.id', 'left');
		$this->db->where('YEAR(date_donated)', $year);

		if($month !== NULL) { 
			$this->db->where('MONTH(date_donated)', $month); 
		}

		if($graduation_year !== NULL ) {
			$this->db->where('graduation_year', $graduation_year); 
		}

		$this->db->group_by('alumni.department');
		$query=$this->db->get();
		return $query->result_array();	
	}
	
    // BY PAYMENT TYPE 
    function report_donation_by_payment_types($year, $month, $department, $graduation_year)
    {

    	$this->db->select('donations.payment_type, SUM(alumni.donation_total) AS total');
		$this->db->from('alumni_donations');
		$this->db->join('alumni', 'alumni_donations.student_id = alumni.student_id', 'left'); 
		$this->db->join('donations', 'alumni_donations.donation_id = donations.id', 'left');
		$this->db->where('YEAR(date_donated)', $year);

		if($month !== NULL) { 
			$this->db->where('MONTH(date_donated)', $month); 
		}

		if($department !== NULL ) {	
			$this->db->where('department', $department); 
		}
		if($graduation_year !== NULL ) {
			$this->db->where('graduation_year', $graduation_year); 
		}

		$this->db->group_by('donations.payment_type');
		$query=$this->db->get();
		return $query->result_array();	
    }

    // By Gradution Class
    // SELECT alumni.graduation_year, SUM(alumni.donation_total) AS total FROM alumni_donations 
	// LEFT JOIN alumni ON alumni_donations.student_id = alumni.student_id
	// LEFT JOIN donations ON alumni_donations.donation_id = donations.id
	// WHERE YEAR(date_donated) = $year GROUP BY alumni.graduation_year
	
     function report_donation_by_grad_year($year, $month, $department)
    {

    	$this->db->select('alumni.graduation_year, SUM(alumni.donation_total) AS total');
		$this->db->from('alumni_donations');
		$this->db->join('alumni', 'alumni_donations.student_id = alumni.student_id', 'left'); 
		$this->db->join('donations', 'alumni_donations.donation_id = donations.id', 'left');
		$this->db->where('YEAR(date_donated)', $year);

		if($month !== NULL) { 
			$this->db->where('MONTH(date_donated)', $month); 
		}

		if($department !== NULL ) {	
			$this->db->where('department', $department); 
		}

		$this->db->group_by('alumni.graduation_year');
		$query=$this->db->get();
		return $query->result_array();	
    }

}