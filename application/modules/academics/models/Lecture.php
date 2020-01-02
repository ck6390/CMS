<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
 * ERP
 *
 * @author		Amit Kumar
 * @copyright	Copyright (c) 2018
 */

/**
 * Class Lecture
 */

class Lecture extends Base_Model
{	
	function __construct()
	{
		// call the model constructor
		parent::__construct();
	}
	protected $_table = 'lectures';
	protected $_primary_key = 'lecture_p_id';
	

	public function get_details($id)
	{
		$this->db->select('LCTR.*,BRNCH.branch_code,SMSTR.semester_name,EMP.username,EMP.emp_name,PRD.period_name,SBJCT.subject_code,SBJCT.subject_name');
		$this->db->from('lectures AS LCTR');
    	$this->db->join("sessions AS SNS", "SNS.session_p_id = LCTR.fk_session_id");
    	$this->db->join("branches AS BRNCH", "BRNCH.branch_p_id = LCTR.fk_branch_id");
    	$this->db->join("semesters AS SMSTR", "SMSTR.semester_p_id = LCTR.fk_semester_id");
    	$this->db->join("employees AS EMP", "EMP.emp_p_id = LCTR.employee_id");
    	$this->db->join("periods AS PRD", "PRD.period_p_id = LCTR.fk_period_id");
    	$this->db->join("subjects AS SBJCT", "SBJCT.subject_p_id = LCTR.fk_subject_id");
    	$this->db->where('LCTR.lecture_p_id', $id);
    	$query = $this->db->get();
    	$result = $query->row();
    	//print_r($result->student_p_id); exit;
    	return $result;
	}

	public function student_list($branch,$semester)
	{
		$data = array(

			'fk_branch_id' => $branch,
			'fk_semester_id' => $semester,
			'is_active' => '1',
			'deleted' => '0'
		);
		$this->db->select("student_p_id,student_unique_id,student_full_name,student_roll");
		$this->db->from("students");
		$this->db->where($data);
		$query = $this->db->get();
		return $query->result();
	}


	public function emp_lectures_schedules($id)
	{	
		
		$data = array(

			'employee_id' => $id,
			'start_date <=' => date('Y-m-d'),
			'end_date >=' => date('Y-m-d'),
			'lecture_category' => "permanent",
			'is_active !=' => '0'
		);

		$this->db->select("*");
		$this->db->from("lectures");
		$this->db->where($data);
		$query = $this->db->get();
		return $query->result();
	}

	public function emp_temp_lectures_schedules($id)
	{	
		
		$data = array(

			'employee_id' => $id,
			'start_date <=' => date('Y-m-d'),
			'end_date >=' => date('Y-m-d'),
			'lecture_category' => "temporary",
			'is_active !=' => '0'
		);

		$this->db->select("*");
		$this->db->from("lectures");
		$this->db->where($data);
		$query = $this->db->get();
		return $query->result();
	}

	public function get_all_temprory_lecture()
	{

		$this->db->select("*");
		$this->db->from("lectures");
		$this->db->where("lecture_category","temporary");
		$this->db->where("is_active",'1');
		$this->db->where("deleted",'0');
		$query = $this->db->get();
		return $query->result();
	}

	public function get_all_permanent_lecture()
	{

		$this->db->select("*");
		$this->db->from("lectures");
		$this->db->where("lecture_category","permanent");
		$this->db->where("is_active",'1');
		$this->db->where("deleted",'0');
		$query = $this->db->get();
		return $query->result();
	}
}

/* End of file Mdl_lecture.php */
/* Location: ./application/modules/employee/models/Mdl_lecture.php */