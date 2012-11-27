 <?php 

class User extends CI_Model
{	
	function admin_login($email, $password)
	{
		$where=array(
			'email'=>$email,
			'pwd'=> md5($password)
		);
		$this->db->select()->from('admin')->where($where);
		$query=$this->db->get();
		return $query->first_row('array');
	}
	
} 
?>