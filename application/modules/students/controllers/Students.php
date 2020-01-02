<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
 * Ganga Memorial CMS
 *
 * @author		Vishwajeet Kumar
 * @copyright	Copyright (c) 2019
 */

/**
 * Class Students
 */

class Students extends Base_Controller
{
	/**
	 * Students_Controller constructor.
	 */
	public function __construct()
	{
		// controller constructor
		parent::__construct();
		
		$this->load->library('file');
		$this->load->model('student', 'mdl_student');
		$this->load->module('setting/branches');
		$this->load->helper('sms_helper');
		$this->load->model('setting/semester','mdl_semester');
		$this->load->model('setting/course_year','mdl_course_year');
		$this->load->model('setting/cast_category','mdl_cast_category');
		$this->load->module('setting/sessions');
		$this->load->module('setting/general_settings');
	}

	/**
	 * [Fetch all student list.]
	 * @param  void
	 * @return view
	 */
	public function index()
	{
		$data['lists'] = $this->mdl_student->get_branch_session();
		$this->template->set('title', 'Student List');
		$this->template->load('template', 'contents', 'students/student_list', $data);
	}

	/**
	 * [Insert a new admin record.]
	 * @param  void
	 * @return redirect
	 */
	public function add()
	{
		$this->form_validation->set_rules('student-id', 'student id', 'required|trim|is_unique[students.student_unique_id]');
		$this->form_validation->set_rules('admission-no', 'Admission Number', 'required|trim|is_unique[students.admission_no]');
		$this->form_validation->set_rules('admission-year', 'admission year', 'required|trim');
		$this->form_validation->set_rules('roll-number', 'roll number', 'required|trim');
		$this->form_validation->set_rules('college-code', 'college code', 'required|trim');
		$this->form_validation->set_rules('branch-code', 'branch code', 'required|trim');
		$this->form_validation->set_rules('admission-date', 'admission date', 'required|trim');
		$this->form_validation->set_rules('cast-category', 'cast category', 'required|trim');
		$this->form_validation->set_rules('branch', 'admission branch', 'required|trim');
		$this->form_validation->set_rules('semester', 'Semester', 'required|trim');
		$this->form_validation->set_rules('session', 'Session', 'required|trim');
		$this->form_validation->set_rules('admission-status', 'Admission Status', 'required|trim');
		$this->form_validation->set_rules('student-name', 'student name', 'required|trim');
		$this->form_validation->set_rules('father-name', 'father name', 'required|trim');
		$this->form_validation->set_rules('mother-name', 'mother name', 'required|trim');
		$this->form_validation->set_rules('dob', 'dob', 'required|trim');
		$this->form_validation->set_rules('gender', 'gender', 'required|trim');
		$this->form_validation->set_rules('student-type', 'Studnt Type', 'required|trim');
		$this->form_validation->set_rules('send_sms', 'sms send', 'required|trim');

		if($this->form_validation->run() == false) {
			$this->template->set('title', 'Add Student');
			$this->template->load('template', 'contents', 'students/student_add');
		} else {
			$post = $this->input->post(null, true);
			$cleanPost = $this->security->xss_clean($post);
			$branch = $this->mdl_branch->get($cleanPost['branch'])->branch_code;
			$formData = array(
				'admission_no' => 	$cleanPost['admission-no'],
				'student_unique_id' => $cleanPost['student-id'],
				'admission_date' => $cleanPost['admission-date'],
				'fk_branch_id' => $cleanPost['branch'],
				'fk_session_id' => $cleanPost['session'],
				'fk_semester_id' => $cleanPost['semester'],
				'admission_status' => $cleanPost['admission-status'],
				'student_full_name' => $cleanPost['student-name'],
				'father_name' => $cleanPost['father-name'],
				'mother_name' => $cleanPost['mother-name'],
				'dob' => $cleanPost['dob'],
				'gender' => $cleanPost['gender'],
				'fk_cast_category' => $cleanPost['cast-category'],
				'login_pin' => '1234',
				'student_sms_no' => $cleanPost['student-sms-no'] ? $cleanPost['student-sms-no'] : null,
				'student_parents_no' => $cleanPost['parents-no'] ? $cleanPost['parents-no']:null,
				'sms_status' => $cleanPost['send_sms'],
			);
			
			// insert to database
			if($this->mdl_student->insert($formData) == true) {
				$this->session->set_flashdata('success', "Success, New Student has been added!");
				if($cleanPost['send_sms']==1){

					$message ="Congratulation ".$cleanPost['student-name']." your Admission is confirmed in GMCP. Branch: ".$branch.", Admission no.- ".$cleanPost['admission-no']." contact on 9473000022 for further query";
					
					$urlencode = urlencode($message);                    
        			send_sms($cleanPost['student-sms-no'],$urlencode);
				}
				
				//$this->sendMessage($cleanPost['student-sms-no'],$message);
				



			} else {
				$this->session->set_flashdata('error', "Error, Can't add new student!");
			}
			redirect('students', 'refresh');
		}
	}

	/**
	 * [Edit student details]
	 * @param  int $id [primary key]
	 * @return [type]     [description]
	 */
	public function edit($id)
	{
		$this->form_validation->set_rules('student-name', 'Student Name', 'required|trim');
		$this->form_validation->set_rules('father-name', 'Father Name', 'required|trim');
		$this->form_validation->set_rules('mother-name', 'Mother Name', 'required|trim');
		$this->form_validation->set_rules('dob', 'Date of Birth', 'required|trim');


		$this->form_validation->set_rules('gender', 'Gender', 'required|trim');

		$this->form_validation->set_rules('session', 'Session', 'required|trim');
		$this->form_validation->set_rules('branch', 'Branch', 'required|trim');
		$this->form_validation->set_rules('cast-category', 'cast category', 'required|trim');
		$this->form_validation->set_rules('course-year', 'Course Year', 'required|trim');
		$this->form_validation->set_rules('admission-date', 'Admission date', 'required|trim');

		$this->form_validation->set_rules('admission-number', 'Admission Number', 'required|trim');
		$this->form_validation->set_rules('registration-number', 'Registration Number', 'trim');

		$this->form_validation->set_rules('student-contact', 'Student Contact Number', 'required|trim|regex_match[/^[0-9]{10}$/]');
		$this->form_validation->set_rules('student-contact2', 'Student Contact Number 2', 'trim|regex_match[/^[0-9]{10}$/]');
		$this->form_validation->set_rules('parent-contact', 'parent Contact Number', 'required|trim|regex_match[/^[0-9]{10}$/]');
		$this->form_validation->set_rules('parent-contact2', 'parent Contact Number 2', 'trim|regex_match[/^[0-9]{10}$/]');
		$this->form_validation->set_rules('email', 'Email', 'trim|valid_email');
		$this->form_validation->set_rules('adhar-no', 'Adhar Card Number', 'required|trim|regex_match[/^[0-9]{12}$/]');
		$this->form_validation->set_rules('login-pin', 'Login Pin', 'required|trim|regex_match[/^[0-9]{4}$/]');
		//$this->form_validation->set_rules('left-thumb', 'Left Thumb', 'required');
		// $this->form_validation->set_rules('student-photo', 'Student Photo', 'required');
		// $this->form_validation->set_rules('student-sign', 'Student Sign', 'required');
		$this->form_validation->set_rules('nationality', 'nationality', 'required|trim');
		$this->form_validation->set_rules('blood-grp', 'blood group', 'trim');
		$this->form_validation->set_rules('identification-mark', 'identification mark', 'trim');
		$this->form_validation->set_rules('student-id', 'student id', 'trim');
		$this->form_validation->set_rules('counselor-id', 'Counselor ID', 'required|trim');
		$this->form_validation->set_rules('local-guardian', 'local guardian', 'trim');
		$this->form_validation->set_rules('guardian-relation', 'guardian relation', 'trim');
		$this->form_validation->set_rules('locality', 'locality', 'required|trim');
		$this->form_validation->set_rules('local-post-office', 'local post office', 'required|trim');
		$this->form_validation->set_rules('local-district', 'local district', 'required|trim');
		$this->form_validation->set_rules('local-state', 'local state', 'required|trim');
		$this->form_validation->set_rules('local-pin-code', 'local pin code', 'required|trim|regex_match[/^[0-9]{6}$/]');
		$this->form_validation->set_rules('permanent-locality', 'permanent locality', 'required|trim');
		$this->form_validation->set_rules('permanent-post-office', 'permanent post office', 'required|trim');
		$this->form_validation->set_rules('permanent-district', 'permanent district', 'required|trim');
		$this->form_validation->set_rules('permanent-state', 'permanent state', 'required|trim');
		$this->form_validation->set_rules('permanent-pin-code', 'permanent pin code', 'required|trim|regex_match[/^[0-9]{6}$/]');
		$this->form_validation->set_rules('10th-board-name', '10th board name', 'trim');
		$this->form_validation->set_rules('10th-passing-year', '10th passing year', 'trim');
		$this->form_validation->set_rules('10th-marks', '10th marks', array('trim','min_length[1]','regex_match[/(^\d+|^\d+[.]\d+)+$/]'));
		$this->form_validation->set_rules('12th-marks', '12th marks', array('trim','min_length[1]','regex_match[/(^\d+|^\d+[.]\d+)+$/]'));
		$this->form_validation->set_rules('graduate-marks', 'Graduate marks', array('trim','min_length[1]','regex_match[/(^\d+|^\d+[.]\d+)+$/]'));

				// ^ # the beginning of the string
				// \d+ # digits (0-9) (1 or more times)
				// [.] #   any character of:'.'
				// \d+ #   digits (0-9) (1 or more times)
				// )? # end of grouping
				// $ # before an optional \n, and the end of the string

		
		if($this->form_validation->run() == false) {
			$data['info'] = $this->mdl_student->get($id);
			$this->template->set('title', 'Edit Student');
			$this->template->load('template', 'contents', 'students/student_edit', $data);
		} else {

			$folder = strtolower($_POST['student-id']);
			if (!is_dir("assets/img/students/{$folder}")) {
			 	mkdir("assets/img/students/{$folder}", 0777, true);
			}

			if(!empty($_FILES['left-thumb']['name'])) {
				$config = array(
					'upload_path' => "assets/img/students/{$folder}",
					'log_threshold' => 1,
					'allowed_types' => "jpg|jpeg|png|JPG|JPEG|PNG",
					'max_size' => 3000,
					'encrypt_name' => true,
					'remove_spaces' => true,
					'detect_mime' => true,
					'overwrite' => false
				);
				$this->load->library('upload', $config);
				$this->upload->do_upload('left-thumb');
				$file = $this->upload->data();
				$thumb = $file['file_name'];
			}else{
				$thumb = $this->input->post('previous-thumb');
			}

			if(!empty($_FILES['student-photo']['name'])) {
				$config = array(
					'upload_path' => "assets/img/students/{$folder}",
					'log_threshold' => 1,
					'allowed_types' => "jpg|jpeg|png|JPG|JPEG|PNG",
					'max_size' => 3000,
					'encrypt_name' => true,
					'remove_spaces' => true,
					'detect_mime' => true,
					'overwrite' => false
				);
				$this->load->library('upload', $config);
				$this->upload->do_upload('student-photo');
				$file = $this->upload->data();
				$photo = $file['file_name'];
			}else{
				$photo = $this->input->post('previous-photo');
			}

			if(!empty($_FILES['student-sign']['name'])) {
				$config = array(
					'upload_path' => "assets/img/students/{$folder}",
					'log_threshold' => 1,
					'allowed_types' => "jpg|jpeg|png|JPG|JPEG|PNG",
					'max_size' => 3000,
					'encrypt_name' => true,
					'remove_spaces' => true,
					'detect_mime' => true,
					'overwrite' => false
				);
				$this->load->library('upload', $config);
				$this->upload->do_upload('student-sign');
				$file = $this->upload->data();
				$sign = $file['file_name'];
			}else{
				$sign = $this->input->post('previous-sign');
			}

			$post = $this->input->post(null, true);
			$cleanPost = $this->security->xss_clean($post);			
			if(!empty($cleanPost['final_save'])){
				$final_save = $cleanPost['final_save'];
			}else{
				$final_save = '0';
			}
			$formData = array(
				'final_submit'=>$final_save,
				'admission_no' => $cleanPost['admission-number'],
				'registration_no' => $cleanPost['registration-number'],
				'admission_date' => $cleanPost['admission-date'],
				'fk_session_id' => $cleanPost['session'],
				'fk_branch_id' => $cleanPost['branch'],
				'fk_course_year_id' => $cleanPost['course-year'],
				'fk_cast_category' => $cleanPost['cast-category'],
				'student_full_name' => $cleanPost['student-name'],
				'father_name' => $cleanPost['father-name'],
				'mother_name' => $cleanPost['mother-name'],
				'student_email' => $cleanPost['email'],
				'adhar_number' => $cleanPost['adhar-no'],
				'login_pin' => $cleanPost['login-pin'],
				'student_left_thumb' => $thumb,
				'student_photo' => $photo,
				'student_sign' => $sign,
				'dob' => $cleanPost['dob'],
				'gender' => $cleanPost['gender'],
				'blood_group' => $cleanPost['blood-grp'] ? $cleanPost['blood-grp']:null,
				'identification_mark' => $cleanPost['identification-mark'] ? $cleanPost['identification-mark']:null,
				'student_sms_no' => $cleanPost['student-contact'],
				'student_mobile_2' => $cleanPost['student-contact2'] ? $cleanPost['student-contact2']:null,
				'student_parents_no' => $cleanPost['parent-contact'],
				'parents_mobile_2' => $cleanPost['parent-contact2'] ? $cleanPost['parent-contact2']:null,
				'local_guardian' => $cleanPost['local-guardian'] ? $cleanPost['local-guardian']:null,
				'guardian_relationship' => $cleanPost['guardian-relation'] ? $cleanPost['guardian-relation']:null,
				'nationality' => $cleanPost['nationality'],
				'counselor_id' => $cleanPost['counselor-id'],
				'l_locality' => $cleanPost['locality'],
				'local_post_office' => $cleanPost['local-post-office'],
				'local_district' => $cleanPost['local-district'],
				'local_state' => $cleanPost['local-state'],
				'local_pin_code' => $cleanPost['local-pin-code'],
				'p_locality' => $cleanPost['permanent-locality'],
				'p_post_office' => $cleanPost['permanent-post-office'],
				'p_district' => $cleanPost['permanent-district'],
				'p_state' => $cleanPost['permanent-state'],
				'p_pin_code' => $cleanPost['permanent-pin-code'],
				'hsc_board' => $cleanPost['10th-board-name'],
				'hsc_stream' => $cleanPost['10th-subject-stream'] ? $cleanPost['10th-subject-stream']:null,
				'hsc_passing_year' => $cleanPost['10th-passing-year'],
				'hsc_percentage_marks' => $cleanPost['10th-marks'],
				'ssc_board' => $cleanPost['12th-board-name'] ? $cleanPost['12th-board-name']:null,
				'ssc_stream' => $cleanPost['12th-subject-stream'] ? $cleanPost['12th-subject-stream']:null,
				'ssc_passing_year' => $cleanPost['12th-passing-year'] ? $cleanPost['12th-passing-year']:null,
				'ssc_percentage_marks' => $cleanPost['12th-marks'] ? $cleanPost['12th-marks']:null,
				'graduate_board' => $cleanPost['graduate-board-name'] ? $cleanPost['graduate-board-name']:null,
				'graduate_stream' => $cleanPost['graduate-subject-stream'] ? $cleanPost['graduate-subject-stream']:null,
				'graduate_passing_year' => $cleanPost['graduate-passing-year'] ? $cleanPost['graduate-passing-year']:null,
				'graduate_percentage_marks' => $cleanPost['graduate-marks'] ? $cleanPost['graduate-marks']:null,
				'hsc_marksheet' => $this->input->post('hsc-marksheet') != null ? $cleanPost['hsc-marksheet']:'0',
				'hsc_slc' => $this->input->post('hsc-slc') != null ? $cleanPost['hsc-slc']:'0',
				'hsc_provisional' => $this->input->post('hsc-provisional') != null ? $cleanPost['hsc-provisional']:'0',
				'hsc_migration' => $this->input->post('hsc-migration') != null ? $cleanPost['hsc-migration']:'0',
				'hsc_admit_card' => $this->input->post('hsc-admit-card') != null ? $cleanPost['hsc-admit-card']:'0',
				'ssc_marksheet' => $this->input->post('ssc-marksheet') != null ? $cleanPost['ssc-marksheet']:'0',
				'ssc_slc' => $this->input->post('ssc-clc') != null ? $cleanPost['ssc-clc']:'0',
				'ssc_provisional' => $this->input->post('ssc-provisional') != null ? $cleanPost['ssc-provisional']:'0',
				'ssc_migration' => $this->input->post('ssc-migration') != null ? $cleanPost['ssc-migration']:'0',
				'ssc_admit_card' => $this->input->post('ssc-admit-card') != null ? $cleanPost['ssc-admit-card']:'0',

			);
			//var_dump($formData);
			//die;
			//print_r($formData);exit();
			// update to database
			if($this->mdl_student->update($formData, $id) == true) {
				$this->session->set_flashdata('success', "Success, Student has been updated!");
			} else {
				$this->session->set_flashdata('error', "Error, Can't update the Student!");
			}
			redirect('students', 'refresh');
		}
	}

	/**
	 * [Activate status.]
	 * @param  int $id [primary key]
	 * @return redirect
	 */
	public function activate($id)
	{
		$data = array(
			'is_active' => '1'
		);
		if($this->mdl_student->update($data, $id) == true) {
			$this->session->set_flashdata('success', "Success, Activated successfully!");
		} else {
			$this->session->set_flashdata('error', "Error, Can't activate!");
		}
		redirect('students', 'refresh');
	}

	/**
	 * [Deactivate status.]
	 * @param  int $id [primary key]
	 * @return redirect
	 */
	public function deactivate($id)
	{
		$data = array(
			'is_active' => '0'
		);
		if($this->mdl_student->update($data, $id) == true) {
			$this->session->set_flashdata('success', "Success, Deactivated successfully!");
		} else {
			$this->session->set_flashdata('error', "Error, Can't deactivate!");
		}
		redirect('students', 'refresh');
	}

	/**
	 * [Delete record from list.]
	 * @param  void
	 * @return boolean
	 */
	public function delete()
	{	

		$id = $this->input->post('primary_id');
		var_dump($id);
		
		if($this->mdl_student->delete($id) == true) {
			echo true;
		} else {
			echo false;
		}
	}

	/**
	 * [Delete record permanently from database.]
	 * @param  int $id [primary key]
	 * @return redirect
	 */
	public function force_delete($id)
	{
		if($this->mdl_student->force_delete($id) == true) {
			$this->session->set_flashdata('success', 'DELETED!');
		} else {
			$this->session->set_flashdata('error', 'ERROR!');
		}
		redirect('students', 'refresh');
	}

	/**
	 * [student profile.]
	 * @param  int $id [primary key]
	 * @return redirect
	 */
	public function profile($id)
	{	
		$this->template->set('title', 'Student Profile');
		$data['info'] = $this->mdl_student->get_student_profile($id);
		$data['fee_dues'] = $this->mdl_student->get_due_fee_amount($id);
		$data['library_dues'] = $this->mdl_student->get_due_library_fine($id);
		$this->template->load('template', 'contents', 'students/student_profile',$data);
	}

	/**
	 * [List of fee / fine on student.]
	 * @param  int $id [primary key]
	 * @return redirect
	 */
	public function fee_fine($id)
	{	
		$this->template->set('title', 'Student Fee/Fine');
		$data['info'] = $this->mdl_student->get($id);
		$data['lists'] = $this->mdl_student->get_fine_list($id);
		$data['fee_dues'] = $this->mdl_student->get_due_fee_amount($id);
		$data['library_dues'] = $this->mdl_student->get_due_library_fine($id);

		$this->template->load('template', 'contents', 'students/student_fee_fine_add',$data);
	}

	/**
	 * [Add fee/ fine on student.]
	 * @param  int $id [primary key]
	 * @return redirect
	 */
	public function add_fine($id)
	{	
		$this->form_validation->set_rules('fee-type', 'fee type', 'required|trim');
		$this->form_validation->set_rules('fee-group', 'fee group', 'required|trim');
		$this->form_validation->set_rules('amount', 'fee amount', 'required|trim');
		$this->form_validation->set_rules('due-on', 'due on', 'required|trim');

		if($this->form_validation->run() == false) {

			$data['info'] = $this->mdl_student->get($id);
			$data['lists'] = $this->mdl_student->get_fine_list($id);
			$data['fee_dues'] = $this->mdl_student->get_due_fee_amount($id);
			$data['library_dues'] = $this->mdl_student->get_due_library_fine($id);

			$this->template->set('title', 'Student Fee/Fine');
			$this->template->load('template', 'contents', 'students/student_fee_fine_add',$data);

		} else {
			
			$post = $this->input->post(null, true);
			$cleanPost = $this->security->xss_clean($post);

			$formData = array(
				'fee_type_id' => 	$cleanPost['fee-type'],
				'student_id' => $id,
				'fine_amount' => $cleanPost['amount'],
				'due_date' => $cleanPost['due-on'],
				'remarks' => $cleanPost['remarks'] ? $cleanPost['remarks'] : null,
				'created_by' => $this->session->userdata['roleID'],
			);

			// insert to database
			if($this->db->insert('fee_allocates',$formData)) {
				$this->session->set_flashdata('success', "Success, New Fine has been added!");
			} else {
				$this->session->set_flashdata('error', "Error, Can't add new Fine!");
			}
			redirect('students/add_fine/'.$id, 'refresh');
		}
		
	}

	/**
	 * [Update status of admission.]
	 * @param  int $id [primary key]
	 * @return redirect
	 */
	public function update_admission_status($id)
	{

		$status = $_POST['status'];
		//print_r($status); exit;
		$formData = array(
			'admission_status' => $status,
		);
		// update to database
		if($this->mdl_student->update($formData, $id) == true) {
			
			echo "<div id=\"toast-container\" class=\"toast-top-right\" aria-live=\"polite\" role=\"alert\"><div class=\"toast toast-success\"><div class=\"toast-message\">Success, updated successfully!</div></div></div>";
		} else {
			$this->session->set_flashdata('error', "Error, Can't update the Student!");
		}		
	}

	/**
	 * [Attach file for student]
	 * @param  int $id [primary key]
	 * @return redirect
	 */
	public function attach_file($id)
	{

		$this->form_validation->set_rules('file-title', 'File title', 'required|trim');
		$this->form_validation->set_rules('date', 'Date', 'required|trim');

		if($this->form_validation->run() == false){

			$data['info'] = $this->mdl_student->get_student_profile($id);
			$data['lists'] = $this->mdl_student->getAttachFile($id);
			$data['fee_dues'] = $this->mdl_student->get_due_fee_amount($id);
			$data['library_dues'] = $this->mdl_student->get_due_library_fine($id);

			$this->template->set('title', 'Student Attach File');
			$this->template->load('template', 'contents', 'students/student_attach_file',$data);

		} else {

			$folder = strtolower($_POST['student-id']);
			if (!is_dir("assets/img/attach_file/{$folder}")) {
			 	mkdir("assets/img/attach_file/{$folder}", 0777, true);
			}

			if(!empty($_FILES['attach-file']['name'])) {
				$config = array(
					'upload_path' => "assets/img/attach_file/{$folder}",
					'log_threshold' => 1,
					'allowed_types' => "jpg|jpeg|png|JPG|JPEG|PNG|pdf|PDF|doc|docx",
					'max_size' => 2000,
					'encrypt_name' => true,
					'remove_spaces' => true,
					'detect_mime' => true,
					'overwrite' => false
				);
				$this->load->library('upload', $config);
				$this->upload->do_upload('attach-file');
				$file = $this->upload->data();
				$attach_file = $file['file_name'];
			}else{
				$attach_file = $this->input->post('previous-file');
			}

			$post = $this->input->post(null, true);
			$cleanPost = $this->security->xss_clean($post);

			$formData = array(
				'student_id' => $id,
				'file_title' => $cleanPost['file-title'],
				'file' => $attach_file,
				'date' => $cleanPost['date'],
				'description' => $cleanPost['description'] ? $cleanPost['description'] : null,
				'created_by' => $this->session->userdata['roleID'],
			);

			// insert to database
			if($this->db->insert('attach_files',$formData)) {
				$this->session->set_flashdata('success', "Success, New File has been added!");
			} else {
				$this->session->set_flashdata('error', "Error, Can't add new File!");
			}
			redirect('students/attach_file/'.$id, 'refresh');
		}
		
	}

	public function roll($id)
	{
		$this->form_validation->set_rules('student-id', 'student id', 'required|trim');
		$this->form_validation->set_rules('roll', 'roll', 'trim');

		if($this->form_validation->run() == false){
			$this->template->set('title', 'Student Roll');
			$data['info'] = $this->mdl_student->get($id);
			$this->template->load('template', 'contents', 'students/student_roll_add',$data);
		} else {
		

			$post = $this->input->post(null, true);
			$cleanPost = $this->security->xss_clean($post);
			$formData = array(
				'student_roll' => $cleanPost['roll'] ? $cleanPost['roll'] : "",
			);
			
			if($this->mdl_student->update($formData, $id) == true) {
				$this->session->set_flashdata('success', "Success, Student has been updated!");
			} else {
				$this->session->set_flashdata('error', "Error, Can't update the Student!");
			}
			redirect('students', 'refresh');
		}

	}

	// to send message to student
	public function sendMessage($phone, $message)
	{		
		$message_body = urlencode($message);
		if(sendSMS($phone, $message_body))
		{
			return true;
		}
	}

	public function set_restrication(){
		$s_id = $_POST['student_id'];
		$formData = array(
			'is_restericated' => implode($_POST['restrication'], ",")
		);
			
		if($this->mdl_student->update($formData, $s_id)) {
			$this->session->set_flashdata('success', "Success, Student has been updated!");			
		} else {
			$this->session->set_flashdata('error', "Error, Can't update the Student!");
		}
		redirect('students');
	}

	public function get_student_restrication(){
		$student = $this->mdl_student->get_fields($_POST['s_id'],array('is_restericated'));
		//var_dump($student->is_restericated);
		if($student->is_restericated == null){
			echo "0";
		}else{
			echo $student->is_restericated;
		}
	}
	/**
	 * [print student profile.]
	 * @param  int $id [primary key]
	 * @return redirect
	 */
	public function print_profile($id)
	{	
		$this->template->set('title', 'Student Profile');
		$data['info'] = $this->mdl_student->get_student_profile($id);
		$data['fee_dues'] = $this->mdl_student->get_due_fee_amount($id);
		$data['library_dues'] = $this->mdl_student->get_due_library_fine($id);
		$this->template->load('template', 'contents', 'students/print_profile',$data);
	}
}

/* End of file Students.php */
/* Location: ./application/modules/students/controllers/Students.php */
