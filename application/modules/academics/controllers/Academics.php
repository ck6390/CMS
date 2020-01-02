<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
 * ganga Memorial CMS
 *
 * @author		Vishwajeet Kumar
 * @copyright	Copyright (c) 2019
 */

/**
 * Class Academics
 */

class Academics extends Base_Controller
{
	/**
	 * Student_promotion_Controller constructor.
	 */
	public function __construct()
	{
		// controller constructor
		parent::__construct();
		$this->load->model('exam', 'mdl_exam');
		$this->load->model('students/student', 'mdl_student');
		$this->load->module('setting/course_years');
		$this->load->module('setting/semesters');
	}

	/**
	 * [Fetch all Student Promotion list.]
	 * @param  void
	 * @return view
	 */
	public function index()
	{
		$data['lists'] = $this->mdl_student->get_branch_session();;
		$this->template->set('title', 'Student Promotion List');
		$this->template->load('template', 'contents', 'student_promotion/promotion_list', $data);
	}

	public function Student_promotions()
	{
		$data['lists'] = $this->mdl_student->get_branch_session();
		$this->template->set('title', 'Student Promotion List');
		$this->template->load('template', 'contents', 'student_promotion/promotion_list', $data);
	}

	public function update_semester($id){
		$academicFeeType = $this->mdl_student->academic_fee_type($id);
		$semester = $_POST['semester'];
		if($academicFeeType->academic_fee_type == "semester"){
			
			$formData = array(
				'fk_semester_id' => $semester,
				'academic_payment_status' => '0'
			);

		}else{
			$formData = array(
				'fk_semester_id' => $semester,
			);
		}

		
		// update to database
		if($this->mdl_student->update($formData, $id) == true) {
			
			echo "<div id=\"toast-container\" class=\"toast-top-right\" aria-live=\"polite\" role=\"alert\"><div class=\"toast toast-success\"><div class=\"toast-message\">Success, updated successfully!</div></div></div>";
		} else {
			$this->session->set_flashdata('error', "Error, Can't update the Student!");
		}		
		
	}
	/**
	 * [Update Student Year for promotion.]
	 * @param  void
	 * @return view
	 */
	public function update_year($id){
		$academicFeeType = $this->mdl_student->academic_fee_type($id);
		$year = $_POST['year'];
		if($academicFeeType->academic_fee_type == "annual"){
			
			$formData = array(
				'fk_course_year_id' => $year,
				'academic_payment_status' => '0'
			);

		}else{
			$formData = array(
				'fk_course_year_id' => $year,
			);
		}
		
		
		// update to database
		if($this->mdl_student->update($formData, $id) == true) {
			
			echo "<div id=\"toast-container\" class=\"toast-top-right\" aria-live=\"polite\" role=\"alert\"><div class=\"toast toast-success\"><div class=\"toast-message\">Success, updated successfully!</div></div></div>";
		} else {
			$this->session->set_flashdata('error', "Error, Can't update the Student!");
		}		
		
	}


	public function student_profile($id)
	{
		$this->template->set('title', 'Student promotion Profile');
		$data['info'] = $this->mdl_student->get_student_profile($id);
		$data['fee_dues'] = $this->mdl_student->get_due_fee_amount($id);
		$data['library_dues'] = $this->mdl_student->get_due_library_fine($id);
		$this->template->load('template', 'contents', 'student_promotion/student_promotion_profile',$data);
	}

	public function exam_add($id)
	{
		$this->form_validation->set_rules('full-name', 'name', 'required|trim');
		$this->form_validation->set_rules('email', 'email', 'required|valid_email|is_unique[users.user_email]');
		$this->form_validation->set_rules('password', 'password', 'required|trim|min_length[8]|max_length[15]');
		$this->form_validation->set_rules('confpass', 'confirm password', 'required|trim|matches[password]');
		$this->form_validation->set_rules('role', 'role', 'required|trim');

		if($this->form_validation->run() == false) {
			$this->template->set('title', 'Add Academic Exam');
			$data['info'] = $this->mdl_student->get($id);
			$this->template->load('template', 'contents', 'exam/exam_add', $data);
		} else {
			$post = $this->input->post(null, true);
			$cleanPost = $this->security->xss_clean($post);
			$formData = array(
				'user_full_name' => $cleanPost['full-name'],
				'user_email' => $cleanPost['email'],
				'password' => $hashed,
				'user_role_id' => $cleanPost['role'],
				'is_developer' => isset($_POST['developer']) ? $cleanPost['developer'] : '0'
			);
			unset($cleanPost['confpass']);
			// insert to database
			if($this->mdl_exam->insert($formData) == true) {
				$this->session->set_flashdata('success', "Success, New user has been added!");
			} else {
				$this->session->set_flashdata('danger', "Error, Can't add new user!");
			}
			redirect('academics', 'refresh');
		}
	}

	/**
	 * [Add Fee / fine]
	 * @param  int $id [primary key]
	 * @return redirect
	 */
	public function student_add_fine($id)
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
			$this->template->load('template', 'contents', 'student_promotion/student_fee_fine',$data);
		} else {

			$post = $this->input->post(null, true);
			$cleanPost = $this->security->xss_clean($post);

			$formData = array(
				'fee_type_id' => $cleanPost['fee-type'],
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
			redirect('academics/student_add_fine/'.$id, 'refresh');
		}
		
	}

	/**
	 * [Class Attendence]
	 * @param  int $id [primary key]
	 * @return redirect
	 */
	public function attendence($id)
	{	
		$this->form_validation->set_rules('full-name', 'name', 'required|trim');
		$this->form_validation->set_rules('email', 'email', 'required|valid_email|is_unique[users.user_email]');
		$this->form_validation->set_rules('password', 'password', 'required|trim|min_length[8]|max_length[15]');
		$this->form_validation->set_rules('confpass', 'confirm password', 'required|trim|matches[password]');
		$this->form_validation->set_rules('role', 'role', 'required|trim');

		if($this->form_validation->run() == false) {
			$this->template->set('title', 'Class Attendence');
			$data['info'] = $this->mdl_student->get($id);
			$data['fee_dues'] = $this->mdl_student->get_due_fee_amount($id);
			$data['library_dues'] = $this->mdl_student->get_due_library_fine($id);
			$this->template->load('template', 'contents', 'student_promotion/student_attendence', $data);
		} else {
			$post = $this->input->post(null, true);
			$cleanPost = $this->security->xss_clean($post);
			$formData = array(
				'user_full_name' => $cleanPost['full-name'],
				'user_email' => $cleanPost['email'],
				'password' => $hashed,
				'user_role_id' => $cleanPost['role'],
				'is_developer' => isset($_POST['developer']) ? $cleanPost['developer'] : '0'
			);
			// insert to database
			if($this->mdl_exam->insert($formData) == true) {
				$this->session->set_flashdata('success', "Success, New user has been added!");
			} else {
				$this->session->set_flashdata('danger', "Error, Can't add new user!");
			}
			redirect('academics', 'refresh');
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
		redirect('academics', 'refresh');
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
		redirect('academics', 'refresh');
	}

	/**
	 * [Delete record from list.]
	 * @param  void
	 * @return boolean
	 */
	public function delete()
	{
		$id = $this->input->post('primary_id');
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
		if($this->mdl_subject->force_delete($id) == true) {
			$this->session->set_flashdata('success', 'DELETED!');
		} else {
			$this->session->set_flashdata('error', 'ERROR!');
		}
		redirect('academics', 'refresh');
	}

}

/* End of file Student_promotions.php */
/* Location: ./application/modules/academics/controllers/Student_promotions.php */