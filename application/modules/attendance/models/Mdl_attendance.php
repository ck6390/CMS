<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
 * ERP
 *
 * @author		Amit Kumar
 * @copyright	Copyright (c) 2018
 */

/**
 * Class Mdl_attendance
 */

class Mdl_attendance extends Base_Model
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
	protected $_table = 'attendance';
	/**
	 * [$primary_key PRIMARY KEY]
	 * @var string
	 */
	protected $primary_key = 'attendance_p_id';

	/**
	 * Fetch all holiday list for a year-month.
	 * @param  date|string $yymm [year-month]
	 * @return mixed
	 */
	public function get_public_holidays($yymm)
	{
		if ($yymm != null) {
			$this->db->select('holidays.*', false)->from('holidays')->like('start_date', $yymm);
			return $this->db->get()->result();
		} else {
			error_log('Error, Undefined variabled: $yymm');
			return false;
		}
	}

	/**
	 * Fetch employee attendance report.
	 * @param  int $employee_id [employee-id]
	 * @param  string $sdate
	 * @param  string $flag
	 * @return array
	 */
	public function attendance_report_by_empid($employee_id = NULL, $sdate = NULL, $flag = NULL)
	{
		$query = $this->db
			->select('attendance.attendance_date, attendance.attendance_status', FALSE)
			->select('employees.emp_name', FALSE)
			->from('attendance')
			->join('employees', 'attendance.emp_ID  = employees.emp_p_id', 'left')
			->where('attendance.emp_ID', $employee_id)
			->where('attendance.attendance_date', $sdate);
		$result = $query->get()->result();
		if (empty($result)) {
			$val['attendance_status'] = $flag;
			$val['attendance_date'] = $sdate;
			$result[] = (object) $val;
		}
		// } else {
		// 	if ($result[0]->attendance_status == 0) {
		// 		if ($flag == 'H') {
		// 			$result[0]->attendance_status = 'H';
		// 		}
		// 	}
		// }
		return $result;
	}
}

/* End of file Mdl_attendance.php */
/* Location: ./application/modules/attendance/models/Mdl_attendance.php */
