<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
 * ERP
 *
 * @author		Amit Kumar
 * @copyright	Copyright (c) 2018
 */

/**
 * Class Mdl_employee
 */

class Mdl_employee extends Base_Model
{	
	function __construct()
	{
		// call the model constructor
		parent::__construct();
	}
	/**
	 * [$_table TABLE NAME]
	 * @var string
	 */
	protected $_table = 'employees';
	/**
	 * [$primary_key PRIMARY KEY]
	 * @var string
	 */
	protected $_primary_key = 'emp_p_id';


	
	public function engaged_of_Faculty()
	{	
		$this->db->select('emp_p_id,username,emp_name');
		$this->db->from('employees');
		return $this->db->get()->result();

	}

	public function employee_lecture_history($id)
	{	
		
		$this->db->select('*');
		$this->db->from('lectures');
		$this->db->where('employee_id',$id);
		$this->db->order_by('created_on', 'DESC');
		return $this->db->get()->result();

	}

	public function subject_unit_list($id)
	{
		$this->db->select('ESU.*,SUB.subject_name,SUB.subject_code,SU.unit_number,EMP.employee_id,EMP.emp_name,');
		$this->db->from('emp_subject_units AS ESU');
		$this->db->join("subjects AS SUB", "SUB.subject_p_id = ESU.fk_subject_id");
		$this->db->join("subject_units AS SU", "SU.subject_unit_p_id = ESU.unit_id");
		$this->db->join("employees AS EMP", "EMP.emp_p_id = ESU.fk_emp_id");
		$this->db->where('ESU.fk_emp_id',$id);
		$this->db->order_by('ESU.created_on', 'DESC');
		return $this->db->get()->result();

		
	}
}

/* End of file Mdl_employee.php */
/* Location: ./application/modules/employee/models/Mdl_employee.php */