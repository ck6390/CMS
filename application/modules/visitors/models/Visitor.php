<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
 * Ganga Memorial CMS
 *
 * @author		Manoj Kumar
 * @copyright	Copyright (c) 2019
 */

/**
 * Class Visitor
 */

class Visitor extends Base_Model
{	
	function __construct()
	{
		// call the model constructor
		parent::__construct();
	}
	/**
	 * [$primary_key PRIMARY KEY]
	 * @var string
	 */
	
	protected $_table = 'visitors';
	protected $_primary_key = 'visitor_p_id';

	public function employee_list($roleId)
	{
		$query = $this->db->select('emp_p_id, emp_name, employee_id')->from('employees')->where('user_role_id', $roleId)->get();
		$result = $query->num_rows() > 0 ? $query->result() : false;
		return $result;
	} 

	public function student_list()
	{
		$query = $this->db->select('student_p_id, student_unique_id, student_full_name')->from('students')->get();
		$result = $query->num_rows() > 0 ? $query->result() : false;
		return $result;
	}

	public function administrator_list($roleId)
	{
		$query = $this->db->select('user_p_id, user_full_name,role_name')
				->from('users')
				->join('roles','roles.role_p_id = users.user_role_id')
				->where('users.user_role_id', $roleId)
				->get();
		$result = $query->num_rows() > 0 ? $query->result() : false;
		return $result;
	} 
	
}

/* End of file Mdl_sms.php */
/* Location: ./application/modules/sms/models/Mdl_sms.php */