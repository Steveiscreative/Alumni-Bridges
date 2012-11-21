 <?php 

class Admins extends CI_Model
{
	
	/**
	 * Alumni Models
	 * ---------------------------------------
	 * 
	 */
	function get_alumni($num=20, $start=0)
	{

		$query=$this->db->query("SELECT * FROM alumni LIMIT $start, $num");
		return $query->result_array();
	}

	function get_alumni_count()
	{
		$this->db->select('id')->from('alumni'); 
		$query = $this->db->get(); 
		return $query->num_rows(); 
	}

	function get_alumnus($id)
	{
		$query = $this->db->query("SELECT * FROM alumni WHERE id = $id");
		return $query->first_row('array');
	}

	
	function add_alumni($student_id, $first_name,$last_name,$address, $city, $state, $zip_code, $email, $telephone, $degree, $deparment, $graduation_year)
	{
	
		$this->load->helper('array');
		$query=$this->db->query("CALL sp_add_alumni($student_id, '$first_name','$last_name','$address', '$city', '$state', '$zip_code', '$email', '$telephone', '$degree', '$deparment', '$graduation_year')");
		$row = $query->row_array();
		echo random_element($row);
	}

	function update_alumni($id, $data)
	{
		$this->db->where('id', $id); 
		$this->db->update('alumni', $data);
	}

	function delete_alumni($id)
	{
		$query = $this->db->query("CALL sp_delete_alumni($id)");
	}

	/**
	 * Social Media Models 
	 * ---------------------------------------
	 * 1) get all social media
	 * 2) Add New Social Media Column
	 * 3) Alumni Add Social Media
	 * 
	 */
	function get_all_social_media()
	{
		$query=$this->db->query("SELECT * FROM valid_social_media");
		return $query->result_array(); 
	}
	
	function add_social_media($social_media)
	{
		$ValidSM =$this->db->query("INSERT INTO valid_social_media (social_media) VALUES ('$social_media')");
		$tableSM = strtolower($social_media);
		$tableSM = str_replace(' ', '_', $tableSM);
		$query=$query=$this->db->query("ALTER TABLE social_media ADD $tableSM VARCHAR(150) AFTER student_id");
	}

	function get_alumni_social_media($student_id)
	{
		$query=$this->db->query("SELECT * from social_media WHERE student_id = $student_id");
		return $query->result_array(); 
	}

	function delete_social_media($social_media)
	{
		$tableSM = strtolower($social_media);
		$tableSM = str_replace(' ', '_', $tableSM);
		$this->db->query("DELETE FROM valid_social_media WHERE social_media = $social_media");
		$this->db->query("ALTER TABLE social_media DROP COLUMN $tableSM");
	}

	/**
	 * Admins Models
	 * ---------------------------------------
	 * get_admin - list all rows in admin table
	 * add_admin - add admin to admin db, stored procedure 
	 * delete_admin - delete admin from database 
	 * 
	 */
	
	function get_admins($num=20, $start=0)
	{
		$query=$this->db->query("SELECT * FROM admin LIMIT $start, $num");
		return $query->result_array();
	}

	function get_admin_count()
	{
		$query=$this->db->query("SELECT * FROM admin");
		return $query->num_rows();
	}

	function get_admin($id)
	{
		$query = $this->db->query("SELECT * FROM admin WHERE id = $id");
		return $query->first_row('array');
	}

	
	function add_admin($email, $first_name, $last_name, $pwd, $role)
	{
		$this->load->helper('array');
		$query=$this->db->query("CALL sp_add_admin('$email', '$first_name', '$last_name', '$pwd', $role)");
		$row = $query->row_array();
		echo random_element($row);
	}

	function update_admin($id,$data)
	{
		$this->db->where('id', $id); 
		$this->db->update('admin',$data);
	}

	function delete_admin($id)
	{
		$query = $this->db->query("CALL sp_delete_admin($id)");
	}


	/**
	 * Donation Models
	 * ---------------------------------------
	 */

	function get_donations($num=20, $start=0) 
	{
		$query = $this->db->query("
			SELECT donations.id, alumni.first_name, alumni.last_name, donations.date_donated, donations.donation_amount FROM alumni_donations 
			LEFT JOIN alumni 
			ON alumni_donations.student_id = alumni.student_id
			LEFT JOIN donations
			ON alumni_donations.donation_id = donations.id
			ORDER BY id DESC LIMIT $start, $num
		");
		return $query->result_array();
	}

	function get_donation_count()
	{
		$query= $this->db->query('SELECT id FROM alumni_donations');
		return $query->num_rows();
	}

	function add_donations($student_id,$donation_amount, $payment_type, $date_donated)
	{
		$this->load->helper('array');	
		$this->db->query("CALL sp_add_donations($student_id, $donation_amount, '$payment_type', '$date_donated')");
	}

	function get_payment_types()
	{
		$query=$this->db->query("SELECT * FROM valid_payment_type");
		return $query->result_array();
	}


	/**
	 * Degree Models
	 * ---------------------------------------
	 */

	function get_valid_degrees()
	{
		$query=$this->db->query("SELECT * FROM valid_degrees");
		return $query->result_array();
	}

	function get_valid_degree($id)
	{
		$query = $this->db->query("SELECT * FROM valid_degrees WHERE id = $id");
		return $query->first_row('array');
	}

	function add_valid_degree($degree)
	{
		$this->load->helper('array');
		$query = $this->db->query("CALL sp_add_valid_degree('$degree')");
		$row = $query->row_array();
		echo random_element($row);
	}

	function delete_valid_degree($id)
	{
		$this->db->query("DELETE FROM valid_degrees WHERE id = $id");
	}

	/**
	 * Department Models
	 * ---------------------------------------
	 */

	function add_valid_department($department)
	{
		$this->db->query("CALL sp_add_valid_department('$department')");
	}

	function delete_valid_department($department)
	{
		$this->load->helper('array');
		$query = $this->db->query("CALL sp_delete_valid_department('$department')");
		$row = $query->row_array();
		$message =random_element($row); 
	}

	function get_valid_departments()
	{
		$query=$this->db->query("SELECT * FROM valid_departments");
		return $query->result_array();
	}

	function get_valid_department($id)
	{
		$query = $this->db->query("SELECT * FROM valid_departments WHERE id = $id");
		return $query->first_row('array');
	}

	function update_department($id,$data)
	{
		$this->db->where('id', $id); 
		$this->db->update('valid_departments',$data);
	}

	/**
	 * Search
	 * ---------------------------------------
	 */

	function alumni_search($q, $department, $degree, $graduation_year, $num=20, $start=0)
	{
		$this->db->like('first_name',$q);
		$this->db->or_like('last_name', $q);
		$this->db->or_like('degree', $degree);
		$this->db->or_like('department', $department);
		$this->db->or_like('graduation_year', $graduation_year);
		$this->db->or_like('student_id', $q);
		$this->db->or_like('zip_code', $q);
		$this->db->limit($num,$start);
		$query = $this->db->get('alumni');

		return $query->result_array(); 
	}

	function advanced_search($school, $degree, $year)
	{
		// Advanced Search

		/**
		 * Advanced Search 
		 * ---------------------------------------
		 * school department
		 * degree
		 * year
		 */
		$this->db->like('degree', $degree);
		$this->db->or_like('');

	}



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
	
	function report_total_donations($year)
	{
		// SELECT SUM(donation_amount) FROM donations WHERE YEAR(date_donated) = $year
		$query=$this->db->query();
		return result_array();
	}

	/**
	 * dontation break down by month
	 */

	function donations_by_month_breakdown($year)
	{
		// SELECT MONTH(date_donated), SUM(donation_amount) FROM donations WHERE YEAR(date_donated) = $year GROUP BY MONTH(date_donated)
	}

	function donations_by_department_breakdown($year)
	{
		// SELECT MONTH(date_donated), SUM(donation_amount) FROM donations WHERE YEAR(date_donated) = $year GROUP BY MONTH(date_donated)
	}
	
	function report_donations_count($year)
	{
		// SELECT COUNT(donation_amount) FROM donations WHERE YEAR(date_donated) = $year
	}


	/**
	 * GET Top Three Donators 
	 * 
	 * SELECT alumni.student_id, alumni.first_name, alumni.last_name, SUM(donations.donation_amount) FROM alumni_donations 
	 * LEFT JOIN alumni 
	 * ON alumni_donations.student_id = alumni.student_id
	 * LEFT JOIN donations
	 * ON alumni_donations.donation_id = donations.id
	 * GROUP BY alumni.student_id
	 * ORDER BY donations.donation_amount DESC 
	 * LIMIT 0, 3
	 */

}

?>
