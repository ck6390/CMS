<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
 * ganga Memorial CMS
 *
 * @author		Manoj Kumar
 * @copyright	Copyright (c) 2019
 */

/**
 * Class Lectures
 */

class Lectures extends Base_Controller
{
	/**
	 * Subjects_Controller constructor.
	 */
	public function __construct()
	{
		// controller constructor
		parent::__construct();
		$this->load->model('Lecture', 'mdl_lecture');
		$this->load->module('employees');
		$this->load->model('office/Mdl_department', 'mdl_dept');
		$this->load->module('setting/semesters');
		$this->load->module('setting/branches');
		$this->load->module('academics/subjects');
		$this->load->module('academics/periods');
	}

	/**
	 * [Fetch all Subject list.]
	 * @param  void
	 * @return view
	 */
	public function index()
	{
		$data['lists'] = $this->mdl_lecture->get_all_permanent_lecture();
		$this->template->set('title', 'Lecture List');
		$this->template->load('template', 'contents', 'lectures/lecture_list', $data);
	}

	/**
	 * [Insert a new fee Subject record.]
	 * @param  void
	 * @return redirect
	 */
	public function add()
	{
		$this->form_validation->set_rules('employee-id', 'Faculty', 'required|trim');
		$this->form_validation->set_rules('branch-id', 'Branch', 'required|trim');
		$this->form_validation->set_rules('semester-id', 'Semester', 'required|trim');
		$this->form_validation->set_rules('subject-id', 'Subject', 'required|trim');
		$this->form_validation->set_rules('period-id', 'Period', 'required|trim');
		$this->form_validation->set_rules('start-date', 'start date', 'required|trim');
		$this->form_validation->set_rules('start-date', 'end date', 'required|trim');
		
		

		if($this->form_validation->run() == false) {
			$this->template->set('title', 'Add Lecture');
			$this->template->load('template', 'contents', 'lectures/lecture_add');
		} else {
			$post = $this->input->post(null, true);
			$cleanPost = $this->security->xss_clean($post);
			$formData = array(
				'employee_id' => $cleanPost['employee-id'],
				'fk_branch_id' => $cleanPost['branch-id'],
				'fk_semester_id' => $cleanPost['semester-id'],
				'fk_subject_id' => $cleanPost['subject-id'],
				'fk_period_id' => $cleanPost['period-id'],
				'start_date' => $cleanPost['start-date'],
				'end_date' => $cleanPost['end-date'],
			);
			// print_r($formData);
			// exit;
			// insert to database
			if($this->mdl_lecture->insert($formData) == true) {
				$this->session->set_flashdata('success', "Success, New Lecture has been added!");
			} else {
				$this->session->set_flashdata('danger', "Error, Can't add new Lecture!");
			}
			redirect('academics/lectures', 'refresh');
		}
	}

	/**
	 * [Edit subject details]
	 * @param  int $id [primary key]
	 * @return [type]     [description]
	 */
	public function edit($id) 
	{
		$this->form_validation->set_rules('employee-id', 'Faculty', 'required|trim');
		$this->form_validation->set_rules('branch-id', 'Branch', 'required|trim');
		$this->form_validation->set_rules('semester-id', 'Semester', 'required|trim');
		$this->form_validation->set_rules('subject-id', 'Subject', 'required|trim');
		$this->form_validation->set_rules('period-id', 'Period', 'required|trim');
		
		if($this->form_validation->run() == false) {
			$data['info'] = $this->mdl_lecture->get($id);
			$this->template->set('title', 'Edit Lecture');
			$this->template->load('template', 'contents', 'lectures/lecture_edit', $data);
		} else {
			$post = $this->input->post(null, true);
			$cleanPost = $this->security->xss_clean($post);
			$formData = array(
				'employee_id' => $cleanPost['employee-id'],
				'fk_branch_id' => $cleanPost['branch-id'],
				'fk_semester_id' => $cleanPost['semester-id'],
				'fk_subject_id' => $cleanPost['subject-id'],
				'fk_period_id' => $cleanPost['period-id'],
			);
			// update to database
			if($this->mdl_lecture->update($formData, $id) == true) {
				$this->session->set_flashdata('success', "Success, Lecture has been updated!");
			} else {
				$this->session->set_flashdata('error', "Error, Can't update the Lecture!");
			}
			redirect('academics/lectures', 'refresh');
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