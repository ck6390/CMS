<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
 * Ganga Memorial CMS
 *
 * @author		Amit Kumar
 * @copyright	Copyright (c) 2019
 */

/**
 * Class Employee_attendance
 */

class Employee_attendance extends Base_Model
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
	protected $_primary_key = 'id';
	
	public function get_holiday($currentDay){
		
 		//var_dump($currentDay);
 		$this->db->select('event_name');
 		$this->db->where('start_date<=', $currentDay);
		$this->db->where('end_date>=', $currentDay);
		$query = $this->db->get('holidays');
		$result = $query->result();
    	return $result;
	}

	public function get_office_leave($currentDay,$employee_id){
		
 		
 		$this->db->select('fk_leave_type_id');
 		$this->db->where('leave_from<=', $currentDay);
		$this->db->where('leave_to>=', $currentDay);
		$this->db->where('emp_id',$employee_id);
		$this->db->where('status',1);
		$query = $this->db->get('employee_leaves');
		$result = $query->result();
    	return $result;
	}
	public function employee_day_attadance($curr_year,$curr_month)
	{
		$this->db->select('EA.*,E.emp_name');
		$this->db->join('employees AS E','E.employee_id = EA.employee_id');
 		$this->db->where('EA.month', $curr_month);
		$this->db->where('EA.year', $curr_year);
		$query = $this->db->get('employee_attendances AS EA');
		$result = $query->result();
    	return $result;
	}

	public function employee_attadance_onDate($date)
	{
		$this->db->select('EA.*,E.emp_name');
		$this->db->join('employees AS E','E.employee_id = EA.employee_id');
 		$this->db->where("EA.attendance_data LIKE '%$date%'");
		$query = $this->db->get('employee_attendances AS EA');
		$result = $query->result();
    	return $result;
	}
	// public function employee_day_attadance($curr_year,$curr_month)
	// {
		// $this->db->select('*');
 		// $this->db->where('month', $curr_month);
		// $this->db->where('year', $curr_year);
		// $query = $this->db->get('employee_attendances');
		// $result = $query->result();
    	// return $result;
	// }

	// public function employee_attadance_onDate($date)
	// {
		// $this->db->select('*');
 		// $this->db->where("attendance_data LIKE '%$date%'");
		// $query = $this->db->get('employee_attendances');
		// $result = $query->result();
    	// return $result;
	// }

	public function employee_info($id)
	{
		$this->db->select('E.emp_p_id');
        $this->db->from('employees AS E');   
        $this->db->where('E.is_active', '1');       
        $this->db->where('E.employee_id',$id);       
       
        return $this->db->get()->row();
	}
	
	public function update_status($emp_id,$is_active,$lev_id){
		$this->db->set('status', $is_active);
		$this->db->where('emp_id',$emp_id);
		$this->db->where('emp_leave_id',$lev_id);
		$this->db->update('employee_leaves');
	}
}

/* End of file Employee_attendance.php */
/* Location: ./application/modules/super_admin/models/Employee_attendance.php */
