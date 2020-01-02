<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
 * ERP
 *
 * @author		Amit Kumar
 * @copyright	Copyright (c) 2018
 */

/**
 * Class Employee_leaves
 */

class Employee_leaves extends Base_Model
{	
	function __construct()
	{
		// call the model constructor
		parent::__construct();
	}
	protected $_table = 'employee_leaves';
	protected $_primary_key = 'emp_leave_id';

	public function leaveList()
	{
		$this->db->select('*');
		$this->db->from('leave_type');
		$this->db->where('is_active = "1"');
		$query = $this->db->get();
		return $query->result();
	}
	
	public function emp_leave_applied($id)
	{
		$this->db->select('*');
		$this->db->from('employee_leaves');
		$this->db->where('emp_id',$id);
		$query = $this->db->get();
		return $query->result();


	}

	public function emp_consumed_leave($employeeId,$leaveTypeid)
	{	
		//var_dump($leaveTypeid);
		$data = array(
			'emp_id' => $employeeId,
			'fk_leave_type_id' => $leaveTypeid,
			'is_active' => '1',
		);
		$financial_year = get_financial_year();
		//var_dump($financial_year);
		$year = $financial_year->start_year;
		$yearNext = $year + 1; 
		$start_date = $year."-07-01";
		$end_date = $yearNext."-06-30";
		
		$this->db->select('*');
		$this->db->from('employee_leaves');
		$this->db->where($data);
		$this->db->where("leave_from BETWEEN '$start_date' AND '$end_date'");
	    $this->db->where("leave_to BETWEEN '$start_date' AND '$end_date'");
	    
		$query = $this->db->get();
		return $query->result();
	}
}

/* End of file Employee_leaves.php */
/* Location: ./application/modules/employee/models/Employee_leaves.php */