<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
 * Ganga Memorial College
 *
 * @author		Vishwajeet Kumar
 * @copyright	Copyright (c) 2019
 */

/**
 * Class Routines
 */
class Routines extends Base_Controller
{
	/**
	 * Routines_Controller constructor.
	 */
	public function __construct()
	{
		// controller constructor
		parent::__construct();
		$this->load->model('routine', 'mdl_routine');
		$this->load->module('setting/sessions');
		$this->load->module('setting/branches');
		$this->load->module('employees');
		$this->load->module('setting/semesters');
		$this->load->module('academics/subjects');
	}

	/**
	 * [Fetch all routine list.]
	 * @param  void
	 * @return void
	 */
	public function index($id)
	{	
		$data['semester_id'] = $id;
		$data['lists'] = $this->mdl_routine->get_all();
		$data['branches'] = $this->mdl_branch->get_all();
		$this->template->set('title', 'Routine List');
		$this->template->load('template', 'contents', 'routine_list', $data);
	}

	/**
	 * [Insert a new routine record.]
	 * @param  void
	 * @return void
	 */
	public function add()
	{
		$this->form_validation->set_rules('session', 'Session', 'required|trim');
		$this->form_validation->set_rules('branch', 'Branch', 'required|trim');
		$this->form_validation->set_rules('semester', 'Semester', 'required|trim');
		$this->form_validation->set_rules('subject', 'Subject', 'required|trim');
		$this->form_validation->set_rules('teacher', 'Teacher', 'required|trim');
		$this->form_validation->set_rules('days', 'Days', 'required|trim');
		$this->form_validation->set_rules('start-time', 'Start Time', 'required|trim');
		$this->form_validation->set_rules('end-time', 'End Time', 'required|trim');

		if($this->form_validation->run() == false) {
			
			$this->template->set('title', 'Add Routine');
			$this->template->load('template', 'contents', 'routine_add');
		} else {
			
			$post = $this->input->post(null, true);
			$cleanPost = $this->security->xss_clean($post);
			$formData = array(
				'cr_session_id' => $cleanPost['session'],
				'cr_branch_id' => $cleanPost['branch'],
				'cr_semester_id' => $cleanPost['semester'],
				'cr_subject_id' => $cleanPost['subject'],
				'cr_teacher_id' => $cleanPost['teacher'],
				'days' => $cleanPost['days'],
				'start_time' => $cleanPost['start-time'],
				'end_time' => $cleanPost['end-time'],
			);

			// insert to database
			if($this->mdl_routine->insert($formData) == true) {
				$this->session->set_flashdata('success', "Success, New Routine has been added!");
			} else {
				$this->session->set_flashdata('error', "Error, Can't add new routine!");
			}
			redirect("routines/index/{$cleanPost['semester']}", "refresh");
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
		if($this->mdl_employee->update($data, $id) == true) {
			$this->session->set_flashdata('success', "Success, Activated successfully!");
		} else {
			$this->session->set_flashdata('success', "Error, Can't activate!");
		}
		redirect('employees', 'refresh');
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
		if($this->mdl_employee->update($data, $id) == true) {
			$this->session->set_flashdata('success', "Success, Deactivated successfully!");
		} else {
			$this->session->set_flashdata('success', "Error, Can't deactivate!");
		}
		redirect('employees', 'refresh');
	}

	/**
	 * [Delete record from the table.]
	 * @param  void
	 * @return boolean
	 */
	public function delete()
	{
		$id = $this->input->post('primary_id');
		if($this->mdl_employee->delete($id) == true) {
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
		if($this->mdl_employee->force_delete($id) == true) {
			$this->session->set_flashdata('success', 'DELETED!');
		} else {
			$this->session->set_flashdata('error', 'ERROR!');
		}
		redirect('employees', 'refresh');
	}
}

/* End of file Routines.php */
/* Location: ./application/modules/navigations/controllers/Routines.php */
