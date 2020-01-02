<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
 * Ganga Memorial CMS
 *
 * @author		Amit Kumar
 * @copyright	Copyright (c) 2019
 */

/**
 * Class S_admin
 */

class S_admin extends Base_Model
{
	function __construct()
	{
		// call the model constructor
		parent::__construct();
	}
	

	public function search_faculty($search_item)
	{
		$this->db->select('emp_p_id');
    	$this->db->where('username', $search_item);
    	$query = $this->db->get('employees');
    	$result = $query->row();
    	return $result;
	}

	public function get_faculty_profile()
	{
		
	}

	public function get_emp_monthly_attandance($id)
	{
		$this->db->select('*');
    	$this->db->where('employee_id', $id);
    	$query = $this->db->get('employee_attendances');
    	$result = $query->result();
    	return $result;
		
	}

	// public function academic_lectures_info($data)
	// {	
		// $this->db->select('*');
    	// $this->db->from("lectures AS LCTRS");
    	// $this->db->where($data);
    	// $this->db->group_by('LCTRS.unit');
    	// $query = $this->db->get();
    	// $result = $query->result();
    	// return $result;
	// }
	public function academic_lectures_info($data)
	{	
		$this->db->select('LCTRS.*,ESU.startDt,ESU.endDt,count(LCTRS.unit) as count_unit,S.subject_name,SEM.semester_name,BR.branch_code,ESU.lecture_required');
		$this->db->join('emp_subject_units AS ESU','ESU.emp_subject_unit_p_id=LCTRS.super_unit_id');
		$this->db->join('subjects AS S','S.subject_p_id=LCTRS.fk_subject_id');
		$this->db->join('semesters AS SEM','SEM.semester_p_id=LCTRS.fk_semester_id');
		$this->db->join('branches AS BR','BR.branch_p_id=LCTRS.fk_branch_id');
		//$this->db->join('emp_subject_units AS ESU','ESU.fk_subject_id=S.subject_p_id');
    	$this->db->from("lectures AS LCTRS");
    	$this->db->where($data);
    	$this->db->group_by('LCTRS.unit');
    	$query = $this->db->get();
    	$result = $query->result();
    	return $result;
	}
	
	public function count_subject_unit($unit)
	{
		$this->db->from('student_attendance');
		$this->db->where('unit', $unit);
		$query = $this->db->get();
		return $query->num_rows();
	}

	public function deletd_employee_leave($id)
	{
		$data = array(
			'is_active' => '0',
			'deleted' => '1'
		);

		$this->db->where('emp_leave_id', $id);
    	$this->db->update('employee_leaves', $data);
    	return true;
	}

	public function delete_employee($id)
	{
		$data = array(
			'is_active' => '0',
			'deleted' => '1'
		);

		$this->db->where('emp_p_id', $id);
    	$this->db->update('employees', $data);
    	return true;
	}

	public function emp_all_lecture($id)
	{
		$this->db->select('lecture_student_attendance');
    	$this->db->from("student_attendance");
    	$this->db->where('faculty_id', $id);
    	$query = $this->db->get();
    	$result = $query->result();
    	return $result;
	}

	public function student_attandance_report($data)
	{	
		//var_dump($data);
		$this->db->select('*')
    			->from("lectures")
    			->where($data);
    	$query = $this->db->get();
    	$result = $query->result();
    	return $result;
	}

	public function student_attandance_date($studentid,$dateRange)
	{	

		$this->db->select('*')
    			->from("lectures")
    			->like('student_attandance','"student_id":"'.$studentid.'"')
    			->where($dateRange)
    			->order_by('lacture_date', 'DESC');
    	$query = $this->db->get();
    	$result = $query->result();
    	return $result;
	}
	public function get_subject_by_semester($semester,$branch){	
    	$this->db->select('*');
    	$this->db->from("subjects");
    	$this->db->where('fk_branch_id', $branch);
    	$this->db->where('fk_semester_id', $semester);
    	$query = $this->db->get();
    	$result = $query->result();
    	return $result;
	}
	
}

/* End of file S_admin.php */
/* Location: ./application/modules/super_admin/models/S_admin.php */
