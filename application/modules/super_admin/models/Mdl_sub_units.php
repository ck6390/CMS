<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
 * ERP
 *
 * @author		Manoj Kumar
 * @copyright	Copyright (c) 2018
 */

/**
 * Class Mdl_sub_units
 */

class Mdl_sub_units extends Base_Model
{	
	function __construct()
	{
		// call the model constructor
		parent::__construct();
	}
	protected $_table = 'emp_subject_units';
	protected $_primary_key = 'emp_subject_unit_p_id';
	
	public function employee_lecture_units($data)
	{
		$this->db->select("unit_id");
		$this->db->from("emp_subject_units");
		$this->db->where($data);
		$query = $this->db->get();
		return $query->result();
	}

	public function get_unit_details($data)
	{
		$this->db->select("start_date");
		$this->db->from("emp_subject_units");
		$this->db->where($data);
		$query = $this->db->get();
		return $query->row();
	}

	public function subject_unit_list()
	{	
		$data = array(

				'ESU.is_active' => '1',
				'ESU.deleted' => '0'
		);
		$this->db->select('ESU.*,SUB.subject_name,SUB.subject_code,SU.unit_number,BRNCH.branch_code,BRNCH.branch_name,SMSTR.semester_name');
		$this->db->from('emp_subject_units AS ESU');
		$this->db->join("subjects AS SUB", "SUB.subject_p_id = ESU.fk_subject_id");
		$this->db->join("subject_units AS SU", "SU.subject_unit_p_id = ESU.unit_id");
		$this->db->join("branches AS BRNCH", "BRNCH.branch_p_id = ESU.fk_branch_id");
		$this->db->join("semesters AS SMSTR", "SMSTR.semester_p_id = ESU.fk_semester_id");
		$this->db->where($data);
		$this->db->order_by('ESU.created_on', 'DESC');
		return $this->db->get()->result();
	}
}

/* End of file Mdl_sub_units.php */
/* Location: ./application/modules/employee/models/Mdl_sub_units.php */