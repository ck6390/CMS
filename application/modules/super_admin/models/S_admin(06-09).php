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

	public function academic_lectures_info($subject,$semester,$branch)
	{
		$this->db->select('*');
    	$this->db->from("lectures AS LCTRS");
    	$this->db->join("student_attendance AS STAD ", "STAD.lecture_schedule_id = LCTRS.lecture_p_id");
    	$this->db->where('LCTRS.fk_subject_id', $subject);
    	$this->db->where('fk_branch_id', $branch);
    	$this->db->where('fk_semester_id', $semester);
    	$this->db->group_by('STAD.unit');
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
		$this->db->select('*')
    			->from("lectures")
    			->where($data);

    	$query = $this->db->get();
    	$result = $query->result();
    	return $result;
	}


	
}

/* End of file S_admin.php */
/* Location: ./application/modules/super_admin/models/S_admin.php */
