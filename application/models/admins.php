 <?php 

class Admins extends CI_Model
{
	
	/**
	 * Alumni Models
	 * ---------------------------------------
	 * 
	 */
	function get_alumni()
	{
		$query=$this->db->query("SELECT * FROM alumni");
		return $query->result_array();
	}

	function get_alumnus($id)
	{
		$query = $this->db->query("SELECT * FROM alumni WHERE id = $id");
		return $query->first_row('array');
	}
	
	function add_alumni($student_id, $first_name,$last_name,$address, $city, $state, $zip_code, $email, $telephone, $degree, $deparment)
	{
	
		$this->load->helper('array');
		$query=$this->db->query("CALL sp_add_alumni($student_id, '$first_name','$last_name','$address', '$city', '$state', '$zip_code', '$email', '$telephone', '$degree', '$deparment')");
		$row = $query->row_array();
		echo random_element($row);
	}

	function update_alumni($id, $data)
	{
		$this->db->where('id', $id); 
		$this->db->update('alumni', $data);
	}

	/**
	 * Admins Models
	 * ---------------------------------------
	 * get_admin - list all rows in admin table
	 * add_admin - add admin to admin db, stored procedure 
	 * delete_admin - delete admin from database 
	 * 
	 */
	
	function get_admins()
	{
		$query=$this->db->query("SELECT * FROM admin");
		return $query->result_array();
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

	function get_donations() 
	{
		$query = $this->db->query('
			SELECT donations.id, alumni.first_name, alumni.last_name, donations.date_donated, donations.donation_amount FROM alumni_donations 
			LEFT JOIN alumni 
			ON alumni_donations.student_id = alumni.student_id
			LEFT JOIN donations
			ON alumni_donations.donation_id = donations.id
			ORDER BY id DESC
		');
		return $query->result_array();
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

	function alumni_search($terms)
	{
		$this->db->like('first_name',$terms);
		$this->db->or_like('last_name', $terms);
		$this->db->or_like('degree', $terms);
		$this->db->or_like('department', $terms);
		$this->db->or_like('student_id', $terms);
		$this->db->or_like('zip_code', $terms);
		$query = $this->db->get('alumni');
		return $query->result_array(); 
	}

}
?>