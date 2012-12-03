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

	}

	public function set_password($student_id, $password)
	{

	}
	
} 
?>