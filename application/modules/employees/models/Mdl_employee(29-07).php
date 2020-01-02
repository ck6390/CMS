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
}

/* End of file Mdl_employee.php */
/* Location: ./application/modules/employee/models/Mdl_employee.php */