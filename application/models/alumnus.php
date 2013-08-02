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

	/*
		Count all results
	 */

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
	 * Update Alumni Account
	 * Returns store procedure message
	 */
	
	function update_alumnus($student_id, $first_name, $last_name, $street, $city, $state, $zip_code, $email, $telephone, $twitter, $facebook, $linkedin)
	{
		$this->load->helper('array');
		$query=$this->db->query("CALL sp_update_alumni_account($student_id,'$first_name', '$last_name', '$street', '$city','$state','$zip_code','$email', '$telephone', '$twitter', '$facebook', '$linkedin')"); 
		$row=$query->row_array();
		return random_element($row);
	}

	/**
	 * Get Social Media that belong to alumni with alumni_id
	 */
	function get_alumni_social_media($student_id)
	{
		$query=$this->db->query("SELECT * from social_media WHERE student_id=$student_id");
		return $query->result_array(); 
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