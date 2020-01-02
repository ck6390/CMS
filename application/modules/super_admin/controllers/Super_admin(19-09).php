<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
 * Ganga Memorial CMS
 *
 * @author		Manoj Kumar
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
		$this->load->model('students/student', 'mdl_student');
		$this->load->model('setting/branch', 'mdl_branch');
		$this->load->model('setting/semester', 'mdl_semester');
		$this->load->model('academics/subject', 'mdl_subject');
		$this->load->model('Employee_attendance', 'mdl_emp_attendance');
		$this->load->model('employees/Employee_leaves', 'mdl_emp_leave');
		$this->load->model('employees/mdl_employee','mdl_employee');
		$this->load->model('office/mdl_employee_type', 'mdl_empe_type');	
		$this->load->model('office/mdl_employment_type', 'mdl_emp_type');
		$this->load->model('office/mdl_department', 'mdl_dept');
		$this->load->model('office/mdl_designation', 'mdl_desg');

		$this->load->model('mdl_sub_units', 'mdl_sub_unit');
		$this->load->model('office/mdl_leave_type','mdl_leave_type');
		//$this->load->model('office/attributes');
		$this->load->model('office/mdl_department','emp_department');
		$this->load->model('office/mdl_designation','emp_designation');
		$this->load->model('setting/session', 'mdl_session');
		$this->load->model('setting/general_setting', 'mdl_general_setting');
		$this->load->model('academics/subject', 'mdl_subject');
		$this->load->model('academics/subject_unit', 'mdl_subject_unit');
		$this->load->model('academics/period', 'mdl_period');
		$this->load->model('academics/lecture', 'mdl_lecture');

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
		//var_dump($data['info']);
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
		$this->load->dbforge();
		// $fields = array(
		// 		'view_pass' => array(
		// 				'type' => 'VARCHAR',
		// 				'constraint' => '100',
		// 				 'null' => TRUE,
		// 		),
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
		//$this->form_validation->set_rules('end-date', 'end date', 'required|trim');

		if($this->form_validation->run() == false) {

			$this->template->set('title', 'Student Attandance Branch Wise');
			$this->template->load('template', 'contents', 'branch_student_attandance');
		} else {

			
			$post = $this->input->post(NULL, TRUE);
			$cleanPost = $this->security->xss_clean($post);

			if(!empty($cleanPost['end-date'])){

				$formData = array(

					'fk_session_id' => $cleanPost['session-id'],
					'fk_semester_id' => $cleanPost['semester-id'],
					'fk_branch_id' => $cleanPost['branch-id'],
					'lacture_date >=' => $cleanPost['start-date'],
					'lacture_date <=' => $cleanPost['end-date']

				);

			}else{

				$formData = array(

					'fk_session_id' => $cleanPost['session-id'],
					'fk_semester_id' => $cleanPost['semester-id'],
					'fk_branch_id' => $cleanPost['branch-id'],
					'lacture_date ' => $cleanPost['start-date'],

				);
				
			}


			$report = array(
				'fk_session_id' => $cleanPost['session-id'],
				'fk_semester_id' => $cleanPost['semester-id'],
				'fk_branch_id' => $cleanPost['branch-id'],
				'start_date' => $cleanPost['start-date'],
				'end_date' => $cleanPost['end-date']

			);

			$data['report'] = $report;
			$this->template->set('title', 'Student Attandance Branch Wise');
			$data['lists'] = $this->mdl_super_Admin->student_attandance_report($formData);
			//var_dump($data['lists']);
			//$lactureDate = array();
			foreach($data['lists'] as $key => $value){
				$lactureDate[]=  $value->lacture_date;
			}
			$data['workingDays'] = array_unique($lactureDate);
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
		//$this->form_validation->set_rules('end-date', 'end date', 'required|trim');

		if($this->form_validation->run() == false) {

			$this->template->set('title', 'Student Attandance Subject Wise');
			$this->template->load('template', 'contents', 'subject_student_attandance');
		} else {

			
			$post = $this->input->post(NULL, TRUE);
			$cleanPost = $this->security->xss_clean($post);

			

			if(!empty($cleanPost['end-date'])){

				$formData = array(
					'fk_session_id' => $cleanPost['session-id'],
					'fk_semester_id' => $cleanPost['semester-id'],
					'fk_subject_id' => $cleanPost['subject-id'],
					'fk_branch_id' => $cleanPost['branch-id'],
					'lacture_date >=' => $cleanPost['start-date'],
					'lacture_date <=' => $cleanPost['end-date']

				);

			}else{

				$formData = array(
					'fk_session_id' => $cleanPost['session-id'],
					'fk_semester_id' => $cleanPost['semester-id'],
					'fk_subject_id' => $cleanPost['subject-id'],
					'fk_branch_id' => $cleanPost['branch-id'],
					'lacture_date =' => $cleanPost['start-date']
				);
			}

			

			$this->template->set('title', 'Student Attandance Subject Wise');
			$data['lists'] = $this->mdl_super_Admin->student_attandance_report($formData);

			foreach ($data['lists']  as $key => $value) {
				$employee = $value->employee_id;
			}
			
			$report = array(
				'fk_session_id' => $cleanPost['session-id'],
				'fk_subject_id' => $cleanPost['subject-id'],
				'employee_id' => $employee,
				'fk_semester_id' => $cleanPost['semester-id'],
				'fk_branch_id' => $cleanPost['branch-id'],
				'start_date' => $cleanPost['start-date'],
				'end_date' => $cleanPost['end-date']

			);

			$data['report'] = $report;
			$this->template->load('template', 'contents', 'subject_student_attandance',$data);
		}
	}

	public function subject_unit()
	{
		
		$this->form_validation->set_rules('unit-id', 'unit', 'required|trim');
		$this->form_validation->set_rules('lecture-req', 'lecture req', 'required|trim');
		$this->form_validation->set_rules('subject-id', 'subject', 'required|trim');
		$this->form_validation->set_rules('branch-id', 'branch', 'required|trim');
		$this->form_validation->set_rules('semester-id', 'semester', 'required|trim');
		
		if($this->form_validation->run() == false) {
			$data['unit_list'] = $this->mdl_sub_unit->subject_unit_list();

			$this->template->set('title', 'Student Unit List');
			$this->template->load('template', 'contents', 'subject_unit/add',$data);
		} else {
			
			$post = $this->input->post(NULL, TRUE);
			$cleanPost = $this->security->xss_clean($post);
			$formData = array(
				'unit_id' => $cleanPost['unit-id'],
				'fk_branch_id' => $cleanPost['branch-id'],
				'fk_semester_id' => $cleanPost['semester-id'],
				'fk_subject_id' => $cleanPost['subject-id'],
				'lecture_required' => $cleanPost['lecture-req'],
				'created_by' => $this->session->userdata['roleID'],
			);

			// print_r($formData);
			// exit;
			// update to database
			if($this->mdl_sub_unit->insert($formData)==true) {
				$this->session->set_flashdata('success', "Success, Subject Unit For lecture has been added!");
			} else {
				$this->session->set_flashdata('error', "Error, Can't add unit lecture!");
			}
			redirect("super_admin/subject_unit", 'refresh');
		}
	}

	public function subject_unit_edit($sub_unit_id)
	{
		$this->form_validation->set_rules('extra-lecture', 'extra lecture', 'required|trim');
		$this->form_validation->set_rules('lecture-required', 'required lecture', 'required|trim');
		$this->form_validation->set_rules('unit-id', 'unit', 'required|trim');
		$this->form_validation->set_rules('subject-id', 'subject', 'required|trim');

		if($this->form_validation->run() == false) {

			$data['info'] = $this->mdl_sub_unit->get($sub_unit_id);
			$this->template->set('title', 'Student Unit Edit');
			$this->template->load('template', 'contents', 'subject_unit/edit', $data);
		} else {
			
			$post = $this->input->post(NULL, TRUE);
			$cleanPost = $this->security->xss_clean($post);
			$formData = array(
				'extra_lecture' => $cleanPost['extra-lecture'],
				'created_by' => $this->session->userdata['roleID'],
			);

			// print_r($formData);
			// exit;
			// update to database
			if($this->mdl_sub_unit->update($formData,$sub_unit_id)==true) {
				$this->session->set_flashdata('success', "Success, Subject Unit For lecture has been updated!");
			} else {
				$this->session->set_flashdata('error', "Error, Can't updated!");
			}
			redirect("super_admin/subject_unit", 'refresh');
		}
	}

	public function student_attandance()
	{

		$this->form_validation->set_rules('studentid','studentid', 'required|trim');
		$this->form_validation->set_rules('start-date','start-date', 'required|trim');
		
		if($this->form_validation->run() == false) {

			$this->template->set('title', 'Student Attandance Branch Wise');
			$this->template->load('template', 'contents', 'student_attandanceDateWise');
		}else{

			
			$post = $this->input->post(NULL, TRUE);
			$cleanPost = $this->security->xss_clean($post);
			
			$search = $this->mdl_student->searchStudent($cleanPost['studentid']);
			$id = $search->student_p_id;
			
			$this->template->set('title', 'Student Attandance Branch Wise');

			if(!empty($cleanPost['end-date'])){

				$dateRange = array(

					'lacture_date >=' => $cleanPost['start-date'],
					'lacture_date <=' => $cleanPost['end-date'],

				);
			}else{

				$dateRange = array(

					'lacture_date' => $cleanPost['start-date'],
				);
			}

			//var_dump($dateRange);
			//die();
			$data['lists'] = $lists = $this->mdl_super_Admin->student_attandance_date($id,$dateRange);
			// echo "<PRE>";
			// print_r($data['lists']);
			// die();
			foreach ($lists as $key => $value) {
				$att = json_decode($value->student_attandance, true);
				foreach ($att as $at) {
					if($id == $at['student_id']){
						$student_id = $at['student_id'];
						$att_status = $at['attance_status'];
					}
					//var_dump($student_id);
					//var_dump($att_status);
				}


				$result[$value->lecture_p_id]['date'] = $value->lacture_date; 
				$result[$value->lecture_p_id]['unit'] = $value->unit; 
				$result[$value->lecture_p_id]['student_id'] = $student_id; 
				$result[$value->lecture_p_id]['att_status'] = $att_status; 
				$result[$value->lecture_p_id]['name'] = $this->mdl_student->get($student_id)->student_full_name; 
				$result[$value->lecture_p_id]['uniqueId'] = $this->mdl_student->get($student_id)->student_unique_id;
				$result[$value->lecture_p_id]['branch_code'] = $this->mdl_branch->get($value->fk_branch_id)->branch_code; 
				$result[$value->lecture_p_id]['semester_name'] = $this->mdl_semester->get($value->fk_semester_id)->semester_name; 
				$result[$value->lecture_p_id]['subject_name'] = $this->mdl_subject->get($value->fk_subject_id)->subject_name; 

				$result[$value->lecture_p_id]['period_name'] = $this->mdl_period->get($value->fk_period_id)->period_name; 
			}
			if(!empty($result)){
				$data['result'] = $result;	
			}
			
			$this->template->load('template', 'contents', 'student_attandanceDateWise',$data);
		}
	}


	public function edit_lecture_attandance($employeeId,$lectureId)
	{
		$this->form_validation->set_rules('student_id[]', 'student', 'required|trim');
		
		$this->form_validation->set_rules('attendance[]', 'attendance', 'required|trim');
		//$this->form_validation->set_rules('unit-id', 'unit', 'required|trim');
		if($this->form_validation->run() == false) {

			$data['info'] = $value = $this->mdl_lecture->get_details($lectureId);
			
			
			$att = json_decode($value->student_attandance, true);
			foreach ($att as $at) {
				$lists[] = array(

					'student_p_id' =>  $at['student_id'],
					'student_unique_id' => $this->mdl_student->get($at['student_id'])->student_unique_id,
					'student_roll' => $this->mdl_student->get($at['student_id'])->student_roll,
					'student_full_name' => $this->mdl_student->get($at['student_id'])->student_full_name,
					'attandance' => $at['attance_status']
				);
			}

			$data['lists'] = $lists;
			//var_dump($data['lists']);
			$this->template->set('title', 'Lecture Attandance');
			$this->template->load('template', 'contents', 'edit_lecture_attadance', $data);
		}else{

			$post = $this->input->post(NULL, TRUE);
			$cleanPost = $this->security->xss_clean($post);
			
			for($i = 0; $i < count($cleanPost['student_id']); $i++){

				$attendance[] = array(

								'student_id' => $cleanPost['student_id'][$i],
								'attance_status' => $cleanPost['attendance'][$i]
								
							);
				
			}
			
			$formData = array(
							
							//'unit' => $cleanPost['unit-id'],
							'student_attandance' => json_encode($attendance),
						);
			
			
			// var_dump($formData);
			// exit;
			//insert to database
			if($this->mdl_lecture->update($formData, $lectureId))
			{	
				$this->session->set_flashdata('success', 'Success, Student Attandence has been added!');
			}
			else
			{
				$this->session->set_flashdata('error', 'Error, Can\'t add Attandance.');
			}
			redirect("super_admin/emp_lecture_history/{$employeeId}", 'refresh');
			
		}
	}
}

/* End of file Super_admin.php */
/* Location: ./application/modules/super_admin/controllers/Super_admin.php */
