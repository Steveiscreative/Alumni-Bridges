<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User extends CI_Model
{	
	function __construct()
	{

	}


	public function verify_admin($email, $password)
	{
		$q = $this
			->db
			->where('email', $email)
			->where('pwd', MD5($password) )
			->limit(1)
			->get('admin');

		if($q->num_rows > 0)
		{
			return $q->first_row('array');
		}
		return false;
	}

	public function verify_alumni_pwd($student_id, $password)
	{
		
	}

	public function verify_alumni($student_id, $password)
	{
		$q = $this
				->db
				->where('student_id', $student_id)
				->where('pwd', $password)
				->limit(1)
				->get('alumni');

		if ($q->num_rows > 0) {
			return $q->first_row('array');
		}
		return false;
	}

	public function verify_firsttime_alumni($first_name, $last_name, $student_id)
	{
		$q = $this
				->db
				->where('first_name', $first_name)
				->where('last_name', $last_name)
				->where('student_id', $student_id)
				->limit(1)
				->get('alumni');

		if ($q->num_rows > 0) {
			return $q->first_row('array');
		}

		return false;
	}
	function update_alumni($id, $data)
	{
		
	}
	public function set_password($student_id, $password)
	{
		$this->db->where('student_id', $student_id);
		$this->db->update('alumni', $password);
	}
	
} 
?>