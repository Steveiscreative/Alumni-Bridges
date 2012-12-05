<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Alumnus extends CI_Model
{

	/**
	 * Get All Alumni
	 */
	function alumni($num=20, $start=0, $graduation_year, $degree, $department)
	{
		$this->db->select('*'); 
		$this->db->join('social_media','alumni.student_id = social_media.student_id', 'left');
		if($degree !== NULL) {
			$this->db->where('degree', $degree);
		}

		if($department !== NULL) {
			$this->db->where('department', $department);
		}

		if($graduation_year !== NULL) { 
			$this->db->where('graduation_year', $graduation_year);
		}
		$query=$this->db->get("alumni");
		return $query->result_array();
	}

	function alumniResultCount($graduation_year, $degree, $department)
	{
		$this->db->select('*'); 
		$this->db->join('social_media','alumni.student_id = social_media.student_id', 'left');
		if($degree !== NULL) {
			$this->db->where('degree', $degree);
		}

		if($department !== NULL) {
			$this->db->where('department', $department);
		}

		if($graduation_year !== NULL) { 
			$this->db->where('graduation_year', $graduation_year);
		}
		$query=$this->db->get("alumni");
		return $query->num_rows(); 
	}

	/**
	 * Get Alumni Profile
	 */
	function get_alumnus($id)
	{
		$this->db->select('*');
		$this->db->join('social_media','alumni.student_id = social_media.student_id', 'left');
		$this->db->where('alumni.id', $id);
		$query=$this->db->get('alumni');
		return $query->first_row('array');
	}

	function alumni_count()
	{
		$this->db->select('id')->from('alumni'); 
		$query = $this->db->get(); 
		return $query->num_rows(); 
	}

	/**
	 * [update_alumni description]
	 */
	function update_alumnus($id, $data)
	{
		$this->db->where('id', $id); 
		$this->db->update('alumni', $data);
	}

	/**
	 * [get_alumni_social_media description]
	 */
	function get_alumni_social_media($student_id)
	{
		$query=$this->db->query("SELECT * from social_media WHERE student_id=$student_id");
		return $query->result_array(); 
	}

	function social_check($student_id){
		$this->db->select('COUNT(1) AS total');
		$this->db->from('social_media');
		$this->db->where('student_id', $student_id);
		$query=$this->db->get();
		return $query->result_array(); 
	}

	function add_social_media($data)
	{
		$this->db->insert('social_media', $data);
	}

	function update_social_media($student_id, $data)
	{
		$this->db->where('student_id', $student_id); 
		$this->db->update('social_media', $data);
	}

	/**
	 * Filter
	 */
	function alumni_filter($department, $degree, $graduation_year)
	{
		if($degree !== NULL) {
			$this->db->where('degree', $degree);
		}

		if($department !== NULL) {
			$this->db->where('department', $department);
		}

		if($graduation_year !== NULL) { 
			$this->db->where('graduation_year', $graduation_year);
		}

		$query = $this->db->get('alumni');
		return $query->result_array(); 
	}

	/**
	 * Search Alumni
	 */
	function search($q, $department, $degree, $graduation_year, $num=20, $start=0)
	{	

		$this->db->join('social_media','alumni.student_id = social_media.student_id', 'left');
		$this->db->like("CONCAT(first_name, ' ', last_name)",$q);

		if($degree !== NULL) {
			$this->db->where('degree', $degree);
		}

		if($department !== NULL) {
			$this->db->where('department', $department);
		}

		if($graduation_year !== NULL) { 
			$this->db->where('graduation_year', $graduation_year);
		}

		$query=$this->db->get("alumni");
		return $query->result_array(); 
	}


}