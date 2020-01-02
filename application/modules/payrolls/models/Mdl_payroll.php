<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
 * ERP
 *
 * @author		Amit Kumar
 * @copyright	Copyright (c) 2018
 */

/**
 * Class Mdl_payroll
 */

class Mdl_payroll extends Base_Model
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
	protected $_table = 'payroll';
	/**
	 * [$primary_key PRIMARY KEY]
	 * @var string
	 */
	protected $primary_key = 'payroll_p_id';

	/**
	 * Fetch all holiday list for a year-month.
	 * @param  int $id [primary-key]
	 * @return mixed
	 */
	public function get_employee_detail($id) {
		if ($id != null) {
			$query = $this->db
				->select('employees.*, departments.dept_name, designations.desg_name')
				->join('departments', 'employees.emp_department_ID = departments.dept_p_id', 'inner')
				->join('designations', 'employees.emp_designation_ID = designations.desg_p_id', 'inner')
				->where('employees.emp_p_id', $id);
			return $query->get('employees')->row();
		} else {
			error_log('Error, Undefined variabled: $yymm');
			return false;
		}
	}

	/**
	 * Get office all working days for a month.
	 * @param  string $inputMonth [month]
	 * @return mixed|array
	 */
	public function get_office_working_days($inputMonth) {
		$month = date('m', strtotime($inputMonth));
		$year = date('Y', strtotime($inputMonth));
		$yymm = $year . '-' . $month;

		$totalDays = cal_days_in_month(CAL_GREGORIAN, $month, $year);
		$weekly_off[] = null;
		$query = $this->db->get_where('working_day', array('flag' => '0'));
		if($query != null) {
			foreach ($query->result() as $row) {
				$weekly_off[] = $row->position;
			}
		}
		$countDays = $this->countDays($month, $year, $weekly_off);
		$publicHolidays = $this->_publicHolidays($yymm);

		$data['totalDays'] = cal_days_in_month(CAL_GREGORIAN, $month, $year);
		$data['workingDays'] = $countDays - $publicHolidays;
		$data['weeklyOff'] = $totalDays - $countDays;
		$data['holidays'] = $publicHolidays;
		return $data;
	}

	/**
	 * Get employee all working days for a month.
	 * @param  int $id [employee-id]
	 * @param  string $inputMonth [month]
	 * @return mixed|array
	 */
	public function get_employee_working_days($id, $inputMonth) {
		$month = date('m', strtotime($inputMonth));
		$year = date('Y', strtotime($inputMonth));
		$yymm = $year . '-' . $month;

		$weekly_off[] = NULL;
		$query = $this->db->select('emp_working_days')->get_where('employees', array('emp_p_id' => $id))->row();
		$emp_working_days = json_decode($query->emp_working_days);
		if($emp_working_days != null) {
			foreach ($emp_working_days as $row) {
				if($row->flag == 0) {
					$weekly_off[] = $row->position;
				}
			}
		}
		$totalDays = cal_days_in_month(CAL_GREGORIAN, $month, $year);
		$countDays = $this->_countDays($month, $year, $weekly_off);
		$publicHolidays = $this->_publicHolidays($yymm);

		$data['totalDays'] = $totalDays;
		$data['weeklyOff'] = $totalDays - $countDays;
		$data['holidays'] = $publicHolidays;

		$data['presentDays'] = $this->db->select('count(`attendance_p_id`) AS present_days')->from('attendance')->where(array('emp_ID' => $id, 'attendance_status' => 'P'))->like('attendance_date', $yymm)->get()->row();
		$data['absentDays'] = $this->db->select('count(`attendance_p_id`) AS absent_days')->from('attendance')->where(array('emp_ID' => $id, 'attendance_status' => 'L'))->like('attendance_date', $yymm)->get()->row();
		$data['unpaidLeave'] = $this->db->select('count(`attendance_p_id`) AS unpaid_leave')->from('attendance')->join('leave_type', 'attendance.leave_type_id = leave_type.leave_p_id', 'inner')->where(array('emp_ID' => $id, 'attendance.attendance_status' => 'L', 'leave_type.salary_deduct' => '1'))->like('attendance_date', $yymm)->get()->row();
		$data['deductionValue'] = $this->db->select('sum(`deduction_value`) AS deduction_value')->from('attendance')->join('leave_type', 'attendance.leave_type_id = leave_type.leave_p_id', 'inner')->where(array('emp_ID' => $id, 'attendance.attendance_status' => 'L', 'leave_type.salary_deduct' => '1'))->like('attendance_date', $yymm)->get()->row();
		return $data;
	}

	private function _countDays($month, $year, $ignore) {
		$count = 0;
		$counter = mktime(0, 0, 0, $month, 1, $year);
		while (date("n", $counter) == $month) {
			if (in_array(date("w", $counter), $ignore) == false) {
				$count++;
			}
			$counter = strtotime("+1 day", $counter);
		}
		return $count;
	}

	private function _publicHolidays($yymm) {
		$query = $this->db->select_sum('days')->from('holidays')->like('start_date', $yymm)->get()->row();
		return $query->days;
	}

	/**
	 * Get all component of employee salary.
	 * @param  int $id [primary key]
	 * @return mixed|array
	 */
	public function get_employee_component($id) {
		if ($id != null) {
			$query = $this->db
				->select('component_ID')
				->get_where('component', array('component.employee_ID' => $id));
			foreach($query->result() as $row) {
   				$component_array[] = $row->component_ID;
			}
			return $component_array;
		} else {
			error_log('Error, Undefined variabled: $id');
			return false;
		}
	}
}

/* End of file Mdl_payroll.php */
/* Location: ./application/modules/payrolls/models/Mdl_payroll.php */
