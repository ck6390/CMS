<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
 * ERP
 *
 * @author		Amit Kumar
 * @copyright	Copyright (c) 2018
 */

/**
 * Class Attendance
 */

class Attendance extends Base_Controller
{
	/**
	 * Attendance_Controller constructor.
	 */
	public function __construct()
	{
		// controller constructor
		parent::__construct();
		$this->load->model('Mdl_attendance', 'mdl_attendance');
	}

	/**
	 * [Index]
	 * @param  void
	 * @return void
	 */
	public function index()
	{
		// redirect them to the home page because they must be an administrator to view this
		return show_error('You must be an administrator to view this page.');
	}

	/**
	 * [Set attendance for employees by department.]
	 * @param  void
	 * @return void
	 */
	public function set_attendance()
	{
		$data['input_date'] = $this->input->post('date', true);
		$data['dept_id'] = $this->input->post('department-id', true);
		if(!empty($this->input->post('date', true))) {
			$date = DateTime::createFromFormat('d-m-Y', $this->input->post('date', true));
			$data['date'] = $date->format('Y-m-d');
		}
		if($data['dept_id'] == '0') {
			$data['lists'] =  $this->mdl_employee->get_all();
		} else {
			$data['lists'] =  $this->mdl_employee->get_many_by(array( 'emp_department_ID' => $this->input->post('department-id')));
		}
		foreach ($data['lists'] as $employee) {
			$where = array('emp_ID' => $employee->emp_p_id, 'attendance_date' => $data['date']);
			$data['attendance'][] = $this->mdl_attendance->get_by($where);
		}
		$this->template->set('title', 'Employee Attendance');
		$this->template->load('template', 'contents', 'attendance/set_attendance', $data);
	}

	/**
	 * [Save employee attendance.]
	 * @param  void
	 * @return [type] [description]
	 */
	public function save_attendance()
	{
		$attendance_status = $this->input->post('attendance', true);
		$leave_id = $this->input->post('leave', true);
		$employee_id = $this->input->post('employee_id', true);
		$attendance_id = $this->input->post('attendance_id', true);

		$in_time = $this->input->post('in', true);
		$out_time = $this->input->post('out', true);
		if (!empty($attendance_id)) {
			$key = 0;
			foreach ($employee_id as $empID) {
				$data['attendance_date'] = $this->input->post('date', true);
				$data['attendance_status'] = 'A';
				$data['emp_ID'] = $empID;
				if (!empty($leave_id[$key])) {
					$data['leave_type_id'] = $leave_id[$key];
					$data['attendance_status'] = 'L';
				} else {
					$data['leave_type_id'] = null;
				}
				if (!empty($attendance_status)) {
					foreach ($attendance_status as $v_status) {
						if ($empID == $v_status) {
							$data['attendance_status'] = 'P';
							$data['leave_type_id'] = null;
							$data['in_time'] = date("H:i:s", strtotime($in_time[$key]));
							$data['out_time'] = date("H:i:s", strtotime($out_time[$key]));
						}
					}
				}
				$id = $attendance_id[$key];
				if (!empty($id)) {
					$this->db->where('attendance_p_id', $id);
					$this->db->update('attendance', $data);
				} else {
					$this->db->insert('attendance', $data);
				}
				$key++;
			}
		} else {
			$key = 0;
			foreach ($employee_id as $empID) {
				$data['attendance_date'] = $this->input->post('date', true);
				$data['attendance_status'] = 'L';
				$data['emp_ID'] = $empID;
				if (!empty($leave_id[$key])) {
					$data['leave_type_id'] = $leave_id[$key];
					$data['attendance_status'] = 'L';
				} else {
					$data['leave_type_id'] = null;
				}
				if (!empty($attendance_status)) {
					foreach ($attendance_status as $v_status) {
						if ($empID == $v_status) {
							$data['attendance_status'] = 'P';
							$data['leave_type_id'] = null;
							$data['in_time'] = date("H:i:s", strtotime($in_time[$key]));
							$data['out_time'] = date("H:i:s", strtotime($out_time[$key]));
						}
					}
				}
				$this->db->insert('attendance', $data);
				$key++;
			}
		}
		// messages for user
		redirect('attendance/set_attendance', 'refresh');
	}

	/**
	 * [Employee attendance report]
	 * @param  void
	 * @return mixed
	 */
	public function attendance_report()
	{
		$data[] = null;
		$this->form_validation->set_rules('month', 'month', 'required|trim');
		$this->form_validation->set_rules('department-id', 'department', 'required|trim');

		if($this->input->post('submit')) {
			if($this->form_validation->run() == false) {
				$this->template->set('title', 'Employee Attendance Report');
				$this->template->load('template', 'contents', 'attendance/attendance_report');
			} else {
				$department_id = $this->input->post('department-id', true);
				$attendance_month = $this->input->post('month', true);

				$month = date('m', strtotime($attendance_month));
				$year = date('Y', strtotime($attendance_month));
				$yymm = $year . '-' . $month;
				$mdy = '01-' . $month . '-' . $year;

				$num = cal_days_in_month(CAL_GREGORIAN, $month, $year);
				if($department_id == '0') {
					$data['employee'] = $this->mdl_employee->get_all();
				} else {
					$data['employee'] = $this->mdl_employee->get_many_by('emp_department_ID', $department_id);
				}
				$day = date('d', strtotime($attendance_month));
				for ($i = 1; $i <= $num; $i++) {
					$data['dates'][] = $i;
				}
				/* $holidays = $this->db->get_where('working_day', array(
					'flag' => '0'
				))->result(); */

				$public_holidays = $this->mdl_attendance->get_public_holidays($yymm);
				//tbl calendar days holiday
				if(!empty($public_holidays)) {
					foreach ($public_holidays as $public_holiday) {
						for ($k = 1; $k <= $num; $k++) {
							if ($k >= 1 && $k <= 9) {
								$sDate = $yymm . '-' . '0' . $k;
							} else {
								$sDate = $yymm . '-' . $k;
							}
							if ($public_holiday->start_date == $sDate && $public_holiday->end_date == $sDate) {
								$p_holidays[] = $sDate;
							}
							if ($public_holiday->start_date == $sDate) {
								for ($j = $public_holiday->start_date; $j <= $public_holiday->end_date; $j++) {
									$p_holidays[] = $j;
								}
							}
						}
					}
				}
				foreach ($data['employee'] as $k_employee => $v_employee) {
					/* if($v_employee->emp_working_days != NULL) {
						$offDays = json_decode($v_employee->emp_working_days);
					} */
					$offDays = json_decode($v_employee->emp_working_days);
					$key = 1;
					$x = 0;
					for ($i = 1; $i <= $num; $i++) {
						if ($i >= 1 && $i <= 9) {
							$sDate = $yymm . '-' . '0' . $i;
						} else {
							$sDate = $yymm . '-' . $i;
						}

						$day_name = date('l', strtotime("+$x days", strtotime($year . '-' . $month . '-' . $key)));
						if (!empty($offDays)) {
							foreach ($offDays as $offDay) {
								if ($offDay->name == $day_name && $offDay->flag == 0) {
									$flag = 'H';
								}
							}
						}
						/* if (!empty($holidays)) {
							foreach ($holidays as $holiday) {
								if ($holiday->day_name == $day_name) {
									$flag = 'H';
								}
							}
						} */
						if (!empty($p_holidays)) {
							foreach ($p_holidays as $p_holiday) {
								if ($p_holiday == $sDate) {
									$flag = 'H';
								}
							}
						}
						if (!empty($flag)) {
							$data['attendance'][$k_employee][] = $this->mdl_attendance->attendance_report_by_empid($v_employee->emp_p_id, $sDate, $flag);
						} else {
							$data['attendance'][$k_employee][] = $this->mdl_attendance->attendance_report_by_empid($v_employee->emp_p_id, $sDate);
						}
						$key++;
						$flag = '';
					}
				}
				$data['attendance-month'] = $this->input->post('month', true);
				$data['dept_name'] = $this->mdl_dept->get($department_id);
				$data['month'] = date('01-m-Y', strtotime($mdy));
			}
		}
		$this->template->set('title', 'Employee Attendance Report');
		$this->template->load('template', 'contents', 'attendance/attendance_report', $data);
	}
}

/* End of file Attendance.php */
/* Location: ./application/modules/attendance/controllers/Attendance.php */
