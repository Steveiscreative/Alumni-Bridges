x <?php 

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
		$query=$this->db->query("SELECT SUM(donation_amount) AS donation_amount FROM donations WHERE YEAR(date_donated) = $year");
		$row = $query->row_array();
		return random_element($row);
	}

	function total_donations_count($year)
	{
		$this->load->helper('array');
		$query=$this->db->query("SELECT COUNT(donation_amount) FROM donations WHERE YEAR(date_donated) = $year");
		$row = $query->row_array();
		return random_element($row);
	}

	function payment_type_overview($year)
	{
		$query=$this->db->query("SELECT payment_type, SUM(donation_amount) AS total FROM donations WHERE YEAR(date_donated) = $year GROUP BY payment_type");
		return $query->result_array();
	}

	/**
	 * dontation break down by month
	 */

	function donations_by_monthly_overview($year)
	{
		$query=$this->db->query("SELECT MONTH(date_donated) AS month, SUM(donation_amount) AS total FROM donations WHERE YEAR(date_donated) = $year GROUP BY MONTH(date_donated)");
		return $query->result_array(); 
	}
	 
	function donations_by_department_overview($year)
	{
		$query=$this->db->query("SELECT alumni.department, SUM(alumni.donation_total) AS total FROM alumni_donations 
			LEFT JOIN alumni ON alumni_donations.student_id = alumni.student_id
			LEFT JOIN donations ON alumni_donations.donation_id = donations.id
			WHERE YEAR(date_donated) = $year GROUP BY alumni.department");

		return $query->result_array(); 
	}

	function donations_by_class_overview($year) {
		$query=$this->db->query("SELECT alumni.graduation_year, SUM(alumni.donation_total) AS total FROM alumni_donations 
			LEFT JOIN alumni ON alumni_donations.student_id = alumni.student_id
			LEFT JOIN donations ON alumni_donations.donation_id = donations.id
	 		WHERE YEAR(date_donated) = $year GROUP BY alumni.graduation_year
		");
		return $query->result_array(); 
	}
	
	function top_three_donators($year)
	{
		$query=$this->db->query("SELECT alumni.first_name, alumni.last_name, SUM(donations.donation_amount) AS total FROM alumni_donations 
			LEFT JOIN alumni ON alumni_donations.student_id = alumni.student_id
			LEFT JOIN donations ON alumni_donations.donation_id = donations.id
			WHERE YEAR(donations.date_donated) = $year
			GROUP BY alumni.student_id ORDER BY donations.donation_amount DESC 
			LIMIT 0, 3");
		return $query->result_array(); 
	}


	// SELECT alumni.first_name, alumni.last_name, SUM(donations.donation_amount) AS total FROM alumni_donations 
	// 		LEFT JOIN alumni ON alumni_donations.student_id = alumni.student_id
	// 		LEFT JOIN donations ON alumni_donations.donation_id = donations.id
	// 		WHERE YEAR(date_donated) = 2102
	// 		AND MONTH(date_donated) = 06
	// 		AND department = 'Fine Arts'

	function graduation_year_list()
	{
		$query=$this->db->query("SELECT DISTINCT graduation_year FROM alumni ORDER BY graduation_year ASC");
		return $query->result_array(); 
	}

	function report_donations_list($year, $month, $department, $graduation_year)
	{
		/*
		$this->db->select("alumni.first_name, alumni.last_name, SUM(donations.donation_amount) AS total");
		$this->db->join('alumni', 'alumni_donations.student_id = alumni.student_id', 'left'); 
		$this->db->join('donations', 'alumni_donations.donation_id = donations.id', 'left');
		$this->db->where('YEAR(date_donated)', $year); 

		if($month !== 0)
		{
			$this->db->where('MONTH(date_donated)', $month);
		}

		if($department !== 0)
		{
			$this->db->where('department', $department);
		}

		if($graduation_year !== 0)
		{
			$this->db->where('graduation_year', $graduation_year);
		}
		$query=$this->db->get();
		return $query->result_array();
		*/
		$sql = "SELECT alumni.first_name, alumni.last_name, SUM(donations.donation_amount) AS total FROM alumni_donations";
		$sql .= "LEFT JOIN alumni ON alumni_donations.student_id = alumni.student_id";
		$sql .=	"LEFT JOIN donations ON alumni_donations.donation_id = donations.id";
		$sql .=	"WHERE YEAR(date_donated) =".$year;
		if($month !== 0) {
			$sql .= "AND MONTH(date_donated) =".$month;	
		}

		if($department !== 0) {
			$sql .= "AND department =".$department;
		}

		if($graduation_year !== 0) {
			$sql .= "AND graduation_year =".$graduation_year;
		}
		$query=$this->db->query($sql);
		return $query->result_array();
	}

	function reports_donation_total() 
	{
		
	} 
    
	

}