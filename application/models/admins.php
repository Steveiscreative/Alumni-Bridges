<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admins extends CI_Model
{	
	
	/**
	 * Get All Alumni and return as array 
	 */
	
	function get_alumni($num=20, $start=0, $orderby, $order)
	{
		$query=$this->db->query("SELECT * FROM alumni ORDER BY $orderby $order LIMIT $start, $num ");
		return $query->result_array();
	}

	/**
	 * Get alumni count, 
	 * used of pagination
	 */
	
	function get_alumni_count()
	{
		$this->db->select('id')->from('alumni'); 
		$query = $this->db->get(); 
		return $query->num_rows(); 
	}

	/**
	 * Get single alumni information
	 */
	
	function get_alumnus($id)
	{
		$query = $this->db->query("SELECT * FROM alumni WHERE id = $id");
		return $query->first_row('array');
	}

	/**
	 * Add alumni into database, 
	 * This uses Stored procedure, sp_add_alumni
	 * Returns stored procudure message
	 */
	
	function add_alumni($student_id, $first_name,$last_name,$address, $city, $state, $zip_code, $email, $telephone, $degree, $deparment, $graduation_year)
	{
	
		$this->load->helper('array');
		$query=$this->db->query("CALL sp_add_alumni($student_id, '$first_name','$last_name','$address', '$city', '$state', '$zip_code', '$email', '$telephone', '$degree', '$deparment', '$graduation_year')");
		$row = $query->row_array();
		return random_element($row);
	}

	/**
	 * Mass Alumni Import
	 * This uses Stored procedure, sp_add_alumni
	 * Returns stored procudure message
	 */
	
	function add_alumni_massImport($student_id, $first_name,$last_name,$address, $city, $state, $zip_code, $email, $telephone, $degree, $deparment, $graduation_year)
	{
		$this->load->helper('array');
		$query=$this->db->query("CALL sp_add_alumni($student_id, '$first_name','$last_name','$address', '$city', '$state', '$zip_code', '$email', '$telephone', '$degree', '$deparment', '$graduation_year')");
		$row = $query->row_array();
		return random_element($row);
		$this->db->reconnect();
	}

	/**
	 * Update alumni information 
	 */

	function update_alumni1($student_id,$first_name,$last_name, $pwd, $street, $city, $state, $zip_code, $email, $telephone, $degree, $deparment, $graduation_year ) 
	{
		$this->load->helper('array');
		$query=$this->db->query("CALL sp_update_alumni($student_id, '$first_name','$last_name','$pwd','$street', '$city', '$state', '$zip_code', '$email', '$telephone', '$degree', '$deparment', '$graduation_year')");
		$row = $query->row_array();
		return random_element($row);
		$this->db->reconnect();
	}
	/**
	 * Delete alumni
	 * This uses Stored procedure, sp_delete_alumni
	 */

	function delete_alumni($id)
	{
		$query = $this->db->query("CALL sp_delete_alumni($id)");
	}


	/**
	 * Get all social media in valid social media table
	 */
	
	function get_all_social_media()
	{
		$query=$this->db->query("SELECT * FROM valid_social_media");
		return $query->result_array(); 
	}
	
	/**
	 * Add new social media to valid_social_media 
	 * AND add new column to social_media table
	 * this uses the sp_add_social_media stored procudure
	 */
	function add_social_media($social_media)
	{
		$this->load->helper('array');
		$query = $this->db->query("CALL sp_add_social_media('$social_media')");
		$row = $query->row_array();
		return random_element($row);
	}

	/**
	 * Get an alumni's social media rows
	 */
	
	function get_alumni_social_media($student_id)
	{
		$query=$this->db->query("SELECT * from social_media WHERE student_id = $student_id");
		return $query->result_array(); 
	}

	/**
	 * Delete social media from valid_social_media table 
	 * AND DELETE drop that column
	 */

	function delete_social_media($social_media)
	{
		$tableSM = strtolower($social_media);
		$tableSM = str_replace(' ', '_', $tableSM);
		$this->db->query("DELETE FROM valid_social_media WHERE social_media = $social_media");
		$this->db->query("ALTER TABLE social_media DROP COLUMN $tableSM");
	}

	/**
	 * GEt all admins in the admins table
	 */
	
	function get_admins($num=20, $start=0)
	{
		$query=$this->db->query("SELECT * FROM admin LIMIT $start, $num");
		return $query->result_array();
	}
	/**
	 * Get count of all admin in the admin table 
	 */
	function get_admin_count()
	{
		$query=$this->db->query("SELECT * FROM admin");
		return $query->num_rows();
	}

	/**
	 * get admin information based on ID
	 */
	
	function get_admin($id)
	{
		$query = $this->db->query("SELECT * FROM admin WHERE id = $id");
		return $query->first_row('array');
	}

	/**
	 * Add admin to database with sp_add_admin stored procedure
	 */
	
	function add_admin($email, $first_name, $last_name, $pwd, $role)
	{
		$this->load->helper('array');
		$query=$this->db->query("CALL sp_add_admin('$email', '$first_name', '$last_name', '$pwd', $role)");
		$row = $query->row_array();
		return random_element($row);
	}

	/**
	 * Updata admin information 
	 */

	function update_admin($id, $email, $first_name, $last_name, $pwd, $role)
	{
		$this->load->helper('array');
		$query=$this->db->query("CALL sp_update_admin($id, '$email', '$first_name', '$last_name', '$pwd', $role)");
		$row = $query->row_array();
		return random_element($row);
	}

	/**
	 * Delete admin 
	 */
	
	function delete_admin($id)
	{
		$query = $this->db->query("CALL sp_delete_admin($id)");
	}


	/**
	 * Return all donations 
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

	/**
	 * Get donation count
	 */
	
	function get_donation_count()
	{
		$query= $this->db->query('SELECT id FROM alumni_donations');
		return $query->num_rows();
	}

	/**
	 * Add dontations into database
	 * returns stored procedures result
	 */

	function add_donations($student_id,$donation_amount, $payment_type, $date_donated)
	{
		$this->load->helper('array');	
		$query=$this->db->query("CALL sp_add_donations($student_id, '$donation_amount', '$payment_type', '$date_donated')");
		$row = $query->row_array();
		return random_element($row);
	}

	/**
	 * Get all Payment types in valid_payment_type table
	 */
	
	function get_payment_types()
	{
		$query=$this->db->query("SELECT * FROM valid_payment_type");
		return $query->result_array();
	}

	/**
	 * Get all valid degrees in valid_degree table
	 */

	function get_valid_degrees()
	{
		$query=$this->db->query("SELECT * FROM valid_degrees");
		return $query->result_array();
		$this->db->reconnect();
	}

	/**
	 * Get valid degree
	 * Returns row based on id
	 */

	function get_valid_degree($id)
	{
		$query = $this->db->query("SELECT * FROM valid_degrees WHERE id = $id");
		return $query->first_row('array');
	}

	/**
	 * add valid degree to valid degree table
	 * uses sp_add_valid_degree stored procedure
	 * returns store procedure results
	 */

	function add_valid_degree($degree)
	{
		$this->load->helper('array');
		$query = $this->db->query("CALL sp_add_valid_degree('$degree')");
		$row = $query->row_array();
		return random_element($row);
	}

	/**
	 * Update degree
	 */
	
	function update_degree($id,$degree)
	{
		$this->load->helper('array');
		$query=$this->db->query("CALL sp_update_valid_degree($id,'$degree')");
		$row = $query->row_array();
		return random_element($row); 
	}

	/**
	 * Delete valid degree
	 */

	function delete_valid_degree($id)
	{
		$this->db->query("DELETE FROM valid_degrees WHERE id = $id");
	}
	
	/**
	 * Add valid department to department table
	 */
	
	function add_valid_department($department)
	{
		$this->load->helper('array');
		$query=$this->db->query("CALL sp_add_valid_department('$department')");
		$row = $query->row_array();
		return random_element($row); 
	}

	/**
	 * Delete valid department and 
	 * return stored procedure results
	 */
	
	function delete_valid_department($department)
	{
		$this->db->query("CALL sp_delete_valid_department('$department')");
	}

	/**
	 * Get valid departments from valid_departments table
	 */

	function get_valid_departments()
	{
		$query=$this->db->query("SELECT * FROM valid_departments");
		return $query->result_array();
		$this->db->reconnect();
	}

	/**
	 * Return valid department where $id 
	 */
	
	function get_valid_department($id)
	{
		$query = $this->db->query("SELECT * FROM valid_departments WHERE id = $id");
		return $query->first_row('array');
	}

	/**
	 * Update department
	 */
	
	function update_department($id,$department)
	{
		$this->load->helper('array');
		$query=$this->db->query("CALL sp_update_valid_department($id,'$department')");
		$row = $query->row_array();
		return random_element($row); 
	}

	/**
	 * Search
	 * ---------------------------------------
	 */

	function alumni_search($q, $department, $degree, $graduation_year, $num=20, $start=0)
	{
		
		$this->db->like("CONCAT(first_name, ' ', last_name)",$q);
		$this->db->or_like("student_id",$q);

		/**
		 * If $degree is not null 
		 *  add where clause 
		 */
		
		if($degree !== NULL) {
			$this->db->where('degree', $degree);
		}

		/**
		 * If $department is not null 
		 *  add where clause 
		 */

		if($department !== NULL) {
			$this->db->where('department', $department);
		}

		/**
		 * If $gradution_year is not null 
		 *  add where clause 
		 */
		
		if($graduation_year !== NULL) { 
			$this->db->where('graduation_year', $graduation_year);
		}

		$query = $this->db->get('alumni');
		return $query->result_array(); 
	}

	/**
	 * Email Listing
	 * ---------------------------------------
	 * 
	 */
	
	function alumni_email_list($degree, $graduation_year, $zip_code )
	{
		$this->db->select('email');
		$this->db->from('alumni');
		if($degree !== NULL)
		{
			$this->db->where('degree', $degree);
		}

		if($graduation_year !== NULL)
		{
			$this->db->where('graduation_year', $graduation_year);
		}

		if($zip_code !== NULL)
		{
			$this->db->where('zip_code', $zip_code);
		}

		$query = $this->db->get();
		return $query->result_array(); 
	}

	/**
	 * Roles
	 * ---------------------------------------
	 */
	
	function get_roles() 
	{
		$query=$this->db->query("SELECT * FROM role");
		return $query->result_array();
	}
	
	function get_user_role($id)
	{
		$query = $this->db->query("SELECT * FROM admin WHERE id = $id");
		return $query->first_row('array');
	}
} 
?>