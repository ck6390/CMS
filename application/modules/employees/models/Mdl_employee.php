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
		$data = array(

			'is_active=' =>'1',
			'deleted=' =>'0',
			'emp_type' => '2',
		);
		$this->db->select('emp_p_id,username,emp_name');
		$this->db->from('employees');

		$this->db->where($data);
		$this->db->or_where('emp_type', '3');
		$this->db->or_where('emp_type', '5');

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

	public function check_unique_data($data){
		//var_dump($data);
		//die();
		$this->db->select('lecture_p_id');
		$this->db->where('employee_id',$data['employee-id']);
		$this->db->where('fk_session_id',$data['session-id']);
		$this->db->where('fk_semester_id',$data['semester-id']);
		$this->db->where('fk_branch_id',$data['branch-id']);
		$this->db->where('fk_period_id',$data['period-id']);
		$this->db->where('fk_period_id',$data['period-id']);
		$this->db->where('fk_subject_id',$data['subject-id']);
		$this->db->where('unit',$data['unit-id']);
		$this->db->where('lacture_date',date('Y-m-d'));
		$this->db->from('lectures');
		return $this->db->get()->result();
	}
}

/* End of file Mdl_employee.php */
/* Location: ./application/modules/employee/models/Mdl_employee.php */