 <?php 

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
		$query=$this->db->query("SELECT SUM(donation_amount) FROM donations WHERE YEAR(date_donated) = $year");
		return $query->result_array();
	}

	function total_donations_count($year)
	{
		$query=$this->db->query("SELECT SUM(donation_amount) FROM donations WHERE YEAR(date_donated) = $year");
		return $query->result_array();
	}

	function payment_type_overview($year)
	{
		$query=$this->db->query("SELECT payment_type, COUNT(payment_type) FROM donations WHERE YEAR(date_donated) = $year GROUP BY payment_type");
		return $query->result_array();
	}

	/**
	 * dontation break down by month
	 */

	function donations_by_monthly_overview($year)
	{
		$query=$this->db->query("SELECT MONTH(date_donated), SUM(donation_amount) FROM donations WHERE YEAR(date_donated) = $year GROUP BY MONTH(date_donated)");
		return $query->result_array(); 
	}

	
	 // Get Payment Count By type 
	 // SELECT payment_type, COUNT(payment_type) FROM donations WHERE YEAR(date_donated) = 2012 GROUP BY payment_type 

	 // Get donation total by type
	 //SELECT payment_type, SUM(donation_amount) AS total FROM donations WHERE YEAR(date_donated) = 2012 GROUP BY payment_type;
	 
	function donations_by_department_breakdown($year)
	{
		$query=$this->db->query("SELECT alumni.department, SUM(alumni.donation_total) FROM alumni_donations 
			LEFT JOIN alumni ON alumni_donations.student_id = alumni.student_id
			LEFT JOIN donations ON alumni_donations.donation_id = donations.id
			WHERE YEAR(date_donated) = $year GROUP BY alumni.department");

		return $query->result_array(); 
	}
	
	function top_three_donators($year)
	{
		$query=$this->db->query("SELECT alumni.student_id, alumni.first_name, alumni.last_name, SUM(donations.donation_amount) FROM alumni_donations 
			LEFT JOIN alumni ON alumni_donations.student_id = alumni.student_id
			LEFT JOIN donations ON alumni_donations.donation_id = donations.id
			WHERE YEAR(donations.date_donated) = $year
			GROUP BY alumni.student_id ORDER BY donations.donation_amount DESC 
			LIMIT 0, 3");
		return $query->result_array(); 
	}


    // GET Top Three Donators 
	

}