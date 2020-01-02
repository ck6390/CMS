<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
 * Ganga Memorial CMS
 *
 * @author		Amit Kumar
 * @copyright	Copyright (c) 2019
 */

/**
 * Class Super_admin
 */

class Super_admin extends Base_Controller
{
	/**
	 * Dashboard_Controller constructor.
	 */
	public function __construct()
	{
		// controller constructor
		parent::__construct();
		$this->load->model('S_admin', 'mdl_super_Admin');
		$this->load->model('Employee_attendance', 'mdl_emp_attendance');
		$this->load->model('employees/Employee_leaves', 'mdl_emp_leave');
		$this->load->module('employees');
		$this->load->module('office/leave_type');
		$this->load->module('office/attributes');
		$this->load->model('setting/session', 'mdl_session');
		$this->load->model('setting/general_setting', 'mdl_general_setting');
		$this->load->model('academics/subject', 'mdl_subject');
		$this->load->model('academics/subject_unit', 'mdl_subject_unit');
		$this->load->library('password');

		
	}

	/**
	 * Super Admin Dashboard.
	 * @return void [load view page]
	 */
	public function index()
	{
		$this->template->set('title', 'Super Admin');
		$this->template->load('template', 'contents', 'dashboard');
	}

	/**
	 * Super Admin Dashboard Search for faculty.
	 * @return void [load view page]
	 */
	public function faculty_search()
	{
		$search_item = $this->input->post('search');
		if ($search = $this->mdl_super_Admin->search_faculty($search_item)){
			
			$id = $search->emp_p_id;
			redirect('super_admin/faculty_profile/'.$id, 'refresh');

		}else{

			$this->session->set_flashdata('error', "Error, Please enter correct faculty id!");
			redirect('super_admin', 'refresh');
		}
	}


	/**
	 * Super Admin Dashboard Search for student.
	 * @return void [load view page]
	 */
	public function student_search()
	{
		$search_item = $this->input->post('search');

		if ($search = $this->mdl_super_Admin->searchStudent($search_item)){
		$id = $search->student_p_id;

			redirect('super_admin/faculty_profile/'.$id, 'refresh');

		}else{

			$this->session->set_flashdata('error', "Error, Please enter correct faculty id!");
			redirect('super_admin', 'refresh');
		}
	}

	public function faculty_profile($id){

		$this->template->set('title', 'Student Profile');
		$data['info'] = $this->mdl_employee->get($id);
		$this->template->load('template', 'contents', 'super_admin/faculty_profile',$data);	
	}

	public function emp_leave_request()
	{
		$this->template->set('title', 'Employee Leave Request');
		$data['lists'] = $this->mdl_emp_leave->get_all();
		$this->template->load('template', 'contents', 'super_admin/leave_request_list',$data);
	}

	public function emp_leave_()
	{
		$this->template->set('title', 'Employee Leave Request');
		$data['lists'] = $this->mdl_emp_leave->get_all();
		$this->template->load('template', 'contents', 'super_admin/leave_request_list',$data);
	}



	public function evolution($id)
	{
		$this->template->set('title', 'Employee Leave Request');
		$data['info'] = $this->mdl_employee->get($id);
		$data['lists'] = $this->mdl_super_Admin->emp_all_lecture($id);
		$this->template->load('template', 'contents', 'super_admin/emp_evolution',$data);
	
	}

	public function emp_monthly_attandance($id)
	{
		$this->template->set('title', 'Employee Month Attandance');
		$data['info'] = $this->mdl_employee->get($id);
		$employee_id = $this->mdl_employee->get($id)->employee_id;
		$data['lists'] = $this->mdl_super_Admin->get_emp_monthly_attandance($employee_id);

		$this->template->load('template', 'contents', 'super_admin/emp_monthly_attandence_list',$data);
	}

	public function view_attendance($employeeId,$attandeance_month)
	{
		$this->template->set('title', 'Employee Month Attandance');
		$data['info'] = $this->mdl_employee->get($employeeId);
		$data['lists'] = $this->mdl_emp_attendance->get($attandeance_month);
		$this->template->load('template', 'contents', 'super_admin/emp_attandance_history',$data);
	}

	public function emp_leave_history($id)
	{
		
		$data['lists'] = $this->mdl_emp_leave->emp_leave_applied($id);
		$this->template->set('title', 'Leave History');
		$this->template->load('template', 'contents', 'emp_leave_history', $data);
	}

	public function leave_request_approval($employeeId,$leaveId)
	{	
		
		$this->form_validation->set_rules('from-date', 'from-date', 'required|trim');
		$this->form_validation->set_rules('to-date', 'to-date', 'required|trim');
		$this->form_validation->set_rules('leave-id', 'leave-id', 'required|trim');
		$this->form_validation->set_rules('description', 'description', 'required|trim');
		if($this->form_validation->run() == false) {

			$data['employeeInfo'] = $this->mdl_employee->get($employeeId);
			$data['leaveInfo'] = $this->mdl_emp_leave->get($leaveId);
			$data['lists'] = $this->mdl_leave_type->get_all();
			$this->template->set('title', 'Apply Leave');
			$this->template->load('template', 'contents', 'emp_leave_approve', $data);

		}else{

			$post = $this->input->post(NULL, TRUE);
			$cleanPost = $this->security->xss_clean($post);
			$formData = array(

				'emp_id' => $employeeId,
				'leave_from' => $cleanPost['from-date'], 
				'leave_to' => $cleanPost['to-date'],
				'fk_leave_type_id' => $cleanPost['leave-id'],
				'is_active' => $cleanPost['permission'],
				'description' => $cleanPost['description'] ? $cleanPost['description'] : "",
				'admin_remark' => $cleanPost['admin-remark'] ? $cleanPost['admin-remark'] : "",

			);
			
			if($this->mdl_emp_leave->update($formData, $leaveId) == true)
			{	
				$this->session->set_flashdata('success', 'Success, Leave Apply Successfully');
			}
			else
			{
				$this->session->set_flashdata('error', 'Error, Can\'t add leave.');
			}
			redirect("super_admin/emp_leave_request", 'refresh');
		}

	}

	public function emp_lecture_history($id)
	{
		$data['lists'] = $this->mdl_employee->employee_lecture_history($id);
		$this->template->set('title', 'Lecture Attandance List');
		$this->template->load('template', 'contents', 'lecture_history', $data);
	}

	public function principal_desk()
	{
		// $this->form_validation->set_rules('day_due_fee', 'day_due_fee', 'required|trim');
		// $this->form_validation->set_rules('month-from', 'month-from', 'required|trim');
		// $this->form_validation->set_rules('month-to', 'month-to', 'required|trim');
		
		if($this->form_validation->run() == false) {
			$this->template->set('title', 'Principal Desk');
			$curr_year = date('Y');
	        $curr_month = date('m');
	        $curr_day = date('d');
			$data['month_attadance'] = $this->mdl_emp_attendance->employee_day_attadance($curr_year,$curr_month);
			$this->template->load('template', 'contents', 'principal_desk',$data);
		}else {
			$post = $this->input->post(null, true);
			$cleanPost = $this->security->xss_clean($post);
			
			$this->template->set('title', 'Principal Desk');
			$this->template->load('template', 'contents', 'principal_desk',$data);
		}
	}

	public function academic_progress()
	{
		$this->form_validation->set_rules('branch', 'branch', 'required|trim');
		$this->form_validation->set_rules('semester', 'semester', 'required|trim');
		$this->form_validation->set_rules('subject-id', 'subject id', 'required|trim');
		
		if($this->form_validation->run() == false) {
			$this->template->set('title', 'Progress Report');
			$this->template->load('template', 'contents', 'academic_progress');
		}else {
			$post = $this->input->post(null, true);
			$cleanPost = $this->security->xss_clean($post);
			$data['lists'] = $this->mdl_super_Admin->academic_lectures_info($_POST["subject-id"],$_POST["semester"],$_POST["branch"]);
			$this->template->set('title', 'Principal Desk');
			$this->template->load('template', 'contents', 'academic_progress',$data);
		}
	}

	public function employee_leave_delete($id)
	{
		if($this->mdl_super_Admin->deletd_employee_leave($id) == true) {
			$this->session->set_flashdata('success', "Success, deleted successfully!");
		} else {
			$this->session->set_flashdata('error', "Error, Can't delete!");
		}
		redirect('super_admin/emp_leave_request', 'refresh');
	}

	public function employees()
	{	
		// $this->load->dbforge();
		// $fields = array(
				// 'view_pass' => array(
						// 'type' => 'VARCHAR',
						// 'constraint' => '100',
						 // 'null' => TRUE,
				// ),
		// );
		// $this->dbforge->add_column('employees', $fields);
		$data['lists'] = $this->mdl_employee->get_all();
		$this->template->set('title', 'Employee List');
		$this->template->load('template', 'contents', 'employee_list', $data);	
	}

	public function emp_edit($id)
	{

		$this->form_validation->set_rules('password', 'password', 'required|trim|min_length[4]|max_length[15]');

		if($this->form_validation->run() == false) {
			$data['info'] = $this->mdl_employee->get($id);
			$this->template->set('title', 'Change Password');
			$this->template->load('template', 'contents', 'emp_login_details', $data);
		} else {
			$this->load->library('password');
			$post = $this->input->post(NULL, TRUE);
			$cleanPost = $this->security->xss_clean($post);
			$hashed = $this->password->create_hash($cleanPost['password']);
			$formData = array(
				'password' => $hashed,
				'view_pass' => $cleanPost['password']
			);

			// update to database
			if($this->mdl_employee->update($formData, $id) == true) {
				$this->session->set_flashdata('success', "Success, Employee password has been updated!");
			} else {
				$this->session->set_flashdata('error', "Error, Can't update employee password!");
			}
			redirect("super_admin/employees", 'refresh');
		}	
	}


	public function employee_delete($id)
	{
		if($this->mdl_super_Admin->delete_employee($id) == true) {
			$this->session->set_flashdata('success', "Success, deleted successfully!");
		} else {
			$this->session->set_flashdata('error', "Error, Can't delete!");
		}
		redirect('super_admin/employees', 'refresh');
	}


	public function student_branch_attandance()
	{
		$this->form_validation->set_rules('semester-id', 'semester', 'required|trim');
		$this->form_validation->set_rules('branch-id', 'branch', 'required|trim');
		$this->form_validation->set_rules('session-id', 'session', 'required|trim');
		$this->form_validation->set_rules('start-date', 'start date', 'required|trim');
		$this->form_validation->set_rules('end-date', 'end date', 'required|trim');

		if($this->form_validation->run() == false) {

			$this->template->set('title', 'Student Attandance Branch Wise');
			$this->template->load('template', 'contents', 'branch_student_attandance');
		} else {

			
			$post = $this->input->post(NULL, TRUE);
			$cleanPost = $this->security->xss_clean($post);

			$formData = array(
				'fk_session_id' => $cleanPost['session-id'],
				'fk_semester_id' => $cleanPost['semester-id'],
				'fk_branch_id' => $cleanPost['branch-id'],
				'lacture_date >=' => $cleanPost['start-date'],
				'lacture_date <=' => $cleanPost['end-date']

			);

			$this->template->set('title', 'Student Attandance Branch Wise');
			$data['lists'] = $this->mdl_super_Admin->student_attandance_report($formData);
			$this->template->load('template', 'contents', 'branch_student_attandance',$data);
		}
	}


	public function student_subject_attandance()
	{
		$this->form_validation->set_rules('semester-id', 'semester', 'required|trim');
		$this->form_validation->set_rules('branch-id', 'branch', 'required|trim');
		$this->form_validation->set_rules('subject-id', 'subject', 'required|trim');
		$this->form_validation->set_rules('session-id', 'session', 'required|trim');
		$this->form_validation->set_rules('start-date', 'start date', 'required|trim');
		$this->form_validation->set_rules('end-date', 'end date', 'required|trim');

		if($this->form_validation->run() == false) {

			$this->template->set('title', 'Student Attandance Subject Wise');
			$this->template->load('template', 'contents', 'subject_student_attandance');
		} else {

			
			$post = $this->input->post(NULL, TRUE);
			$cleanPost = $this->security->xss_clean($post);

			$formData = array(
				'fk_session_id' => $cleanPost['session-id'],
				'fk_semester_id' => $cleanPost['semester-id'],
				'fk_subject_id' => $cleanPost['subject-id'],
				'fk_branch_id' => $cleanPost['branch-id'],
				'lacture_date >=' => $cleanPost['start-date'],
				'lacture_date <=' => $cleanPost['end-date']

			);

			$this->template->set('title', 'Student Attandance Subject Wise');
			$data['lists'] = $this->mdl_super_Admin->student_attandance_report($formData);
			$this->template->load('template', 'contents', 'subject_student_attandance',$data);
		}
	}


}

/* End of file Super_admin.php */
/* Location: ./application/modules/super_admin/controllers/Super_admin.php */
