<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
 * ganga Memorial CMS
 *
 * @author		Vishwajeet Kumar
 * @copyright	Copyright (c) 2019
 */

/**
 * Class Subjects
 */

class Subjects extends Base_Controller
{
	/**
	 * Subjects_Controller constructor.
	 */
	public function __construct()
	{
		// controller constructor
		parent::__construct();
		$this->load->model('subject', 'mdl_subject');
		$this->load->model('students/student', 'mdl_student');
		$this->load->module('setting/branches');
		$this->load->module('setting/semesters');
	}

	/**
	 * [Fetch all Subject list.]
	 * @param  void
	 * @return view
	 */
	public function index()
	{
		$data['lists'] = $this->mdl_subject->get_all();
		$this->template->set('title', 'Subject List');
		$this->template->load('template', 'contents', 'subjects/subject_list', $data);
	}

	/**
	 * [Fetch all Student Promotion list.]
	 * @param  void
	 * @return view
	*/
	public function promotion()
	{
		$data['lists'] = $this->mdl_student->get_all();
		$this->template->set('title', 'Student List');
		$this->template->load('template', 'contents', 'student_promotion/promotion_list', $data);
	}

	/**
	 * [Insert a new fee Subject record.]
	 * @param  void
	 * @return redirect
	 */
	public function add()
	{
		$this->form_validation->set_rules('subject-name', 'Subject Name', 'required|trim');
		$this->form_validation->set_rules('subject-id', 'Subject ID', 'required|is_unique[subjects.subject_code]');
		$this->form_validation->set_rules('branch', 'Branch', 'required|trim');
		$this->form_validation->set_rules('semester', 'Semester', 'required|trim');
		$this->form_validation->set_rules('full-marks-internal', 'Full Marks Internal', 'trim');
		$this->form_validation->set_rules('pass-marks-internal', 'Pass Marks Internal', 'trim');
		$this->form_validation->set_rules('full-marks-external', 'Full Marks External', 'trim');
		$this->form_validation->set_rules('pass-marks-external', 'Pass Marks External', 'trim');

		if($this->form_validation->run() == false) {
			$this->template->set('title', 'Add Subject');
			$this->template->load('template', 'contents', 'subjects/subject_add');
		} else {
			$post = $this->input->post(null, true);
			$cleanPost = $this->security->xss_clean($post);
			$formData = array(
				'subject_name' => $cleanPost['subject-name'],
				'subject_code' => $cleanPost['subject-id'],
				'fk_branch_id' => $cleanPost['branch'],
				'fk_semester_id' => $cleanPost['semester'],
				'full_marks_internal' => $cleanPost['full-marks-internal']?$cleanPost['full-marks-internal']:"",
				'full_marks_external' => $cleanPost['full-marks-external']?$cleanPost['full-marks-external']:"",
				'pass_marks_internal' => $cleanPost['pass-marks-internal']?$cleanPost['pass-marks-internal']:"",
				'pass_marks_external' => $cleanPost['pass-marks-external']?$cleanPost['pass-marks-external']:""
			);
			// insert to database
			if($this->mdl_subject->insert($formData) == true) {
				$this->session->set_flashdata('success', "Success, New Subject has been added!");
			} else {
				$this->session->set_flashdata('danger', "Error, Can't add new Subject!");
			}
			redirect('academics/subjects', 'refresh');
		}
	}

	/**
	 * [Edit subject details]
	 * @param  int $id [primary key]
	 * @return [type]     [description]
	 */
	public function edit($id) 
	{
		$this->form_validation->set_rules('subject-name', 'Subject Name', 'required|trim');
		$this->form_validation->set_rules('subject-id', 'Subject ID', 'required|trim');
		$this->form_validation->set_rules('branch', 'Branch', 'required|trim');
		$this->form_validation->set_rules('semester', 'Semester', 'required|trim');
		$this->form_validation->set_rules('full-marks-internal', 'Full Marks Internal', 'trim');
		$this->form_validation->set_rules('pass-marks-internal', 'Pass Marks Internal', 'trim');
		$this->form_validation->set_rules('full-marks-external', 'Full Marks External', 'trim');
		$this->form_validation->set_rules('pass-marks-external', 'Pass Marks External', 'trim');

		if($this->form_validation->run() == false) {
			$data['info'] = $this->mdl_subject->get($id);
			$this->template->set('title', 'Edit Subject');
			$this->template->load('template', 'contents', 'subjects/subject_edit', $data);
		} else {
			$post = $this->input->post(null, true);
			$cleanPost = $this->security->xss_clean($post);
			$formData = array(
				'subject_name' => $cleanPost['subject-name'],
				'subject_code' => $cleanPost['subject-id'],
				'fk_branch_id' => $cleanPost['branch'],
				'fk_semester_id' => $cleanPost['semester'],
				'full_marks_internal' => $cleanPost['full-marks-internal']?$cleanPost['full-marks-internal']:"",
				'full_marks_external' => $cleanPost['full-marks-external']?$cleanPost['full-marks-external']:"",
				'pass_marks_internal' => $cleanPost['pass-marks-internal']?$cleanPost['pass-marks-internal']:"",
				'pass_marks_external' => $cleanPost['pass-marks-external']?$cleanPost['pass-marks-external']:""
			);
			// update to database
			if($this->mdl_subject->update($formData, $id) == true) {
				$this->session->set_flashdata('success', "Success, User has been updated!");
			} else {
				$this->session->set_flashdata('error', "Error, Can't update the user!");
			}
			redirect('academics/subjects', 'refresh');
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
		if($this->mdl_subject->update($data, $id) == true) {
			$this->session->set_flashdata('success', "Success, Activated successfully!");
		} else {
			$this->session->set_flashdata('error', "Error, Can't activate!");
		}
		redirect('academics/subjects', 'refresh');
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
		if($this->mdl_subject->update($data, $id) == true) {
			$this->session->set_flashdata('success', "Success, Deactivated successfully!");
		} else {
			$this->session->set_flashdata('error', "Error, Can't deactivate!");
		}
		redirect('academics/subjects', 'refresh');
	}

	/**
	 * [Delete record from list.]
	 * @param  void
	 * @return boolean
	 */
	public function delete()
	{
		$id = $this->input->post('primary_id');
		if($this->mdl_subject->delete($id) == true) {
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
		redirect('academics/subjects', 'refresh');
	}
}

/* End of file Subjects.php */
/* Location: ./application/modules/academics/controllers/Subjects.php */