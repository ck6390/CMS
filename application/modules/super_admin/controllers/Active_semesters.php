<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
 * Ganga Memorial CMS
 *
 * @author		Manoj Kumar
 * @copyright	Copyright (c) 2019
 */

/**
 * Class Active_semesters
 */

class Active_semesters extends Base_Controller
{
	/**
	 * Dashboard_Controller constructor.
	 */
	public function __construct()
	{
		// controller constructor
		parent::__construct();
		$this->load->model('super_admin/Active_semester', 'mdl_active_semester');
		$this->load->model('setting/session', 'mdl_session');
		
		
	}

	/**
	 * Activity Dashboard.
	 * @return void [load view page]
	 */
	public function index()
	{
		$this->form_validation->set_rules('session-id', 'session', 'required|trim');
		$this->form_validation->set_rules('semester-id', 'semester', 'required|trim');
		$this->form_validation->set_rules('start-date', 'start date', 'required|trim');
		$this->form_validation->set_rules('end-date', 'end date', 'required|trim');

		if($this->form_validation->run() == false) {
			$data['lists'] = $this->mdl_active_semester->semester_list();
			$this->template->set('title', 'Active Semester');
			$this->template->load('template', 'contents', 'active_semester/add',$data);
		} else {
			$post = $this->input->post(NULL, TRUE);
			$cleanPost = $this->security->xss_clean($post);
			$formData = array(
				'fk_semester_id' => $cleanPost['semester-id'],
				'fk_session_id' => $cleanPost['session-id'],
				'startDt' => $cleanPost['start-date'],
				'endDt' => $cleanPost['end-date'],
			);
			
			// print_r($formData);
			// exit;
			// insert to database
			if($this->mdl_active_semester->insert($formData) == true) {
				$this->session->set_flashdata('success', "Success, New Semester has been added!");
			} else {
				$this->session->set_flashdata('danger', "Error, Can't add!");
			}
			redirect('super_admin/active_semesters', 'refresh');
		}
	}
	/**
	 * [Edit buildings details.]
	 * @param  int $id [primary key]
	 * @return redirect
	 */
	public function edit($id)
	{
		$this->form_validation->set_rules('session-id', 'session', 'required|trim');
		$this->form_validation->set_rules('semester-id', 'semester', 'required|trim');
		$this->form_validation->set_rules('start-date', 'start date', 'required|trim');
		$this->form_validation->set_rules('end-date', 'end date', 'required|trim');
		if($this->form_validation->run() == false) {
			$data['info'] = $this->mdl_active_semester->get($id);
			$data['edit'] = '1';
			$data['lists'] = $this->mdl_active_semester->semester_list();
			$this->template->set('title', 'Active Semester Edit');
			$this->template->load('template', 'contents', 'active_semester/edit', $data);
		} else {
			$post = $this->input->post(NULL, TRUE);
			$cleanPost = $this->security->xss_clean($post);
			$formData = array(
				'fk_semester_id' => $cleanPost['semester-id'],
				'fk_session_id' => $cleanPost['session-id'],
				'startDt' => $cleanPost['start-date'],
				'endDt' => $cleanPost['end-date'],
			);
			if($this->mdl_active_semester->update($formData, $id) == true) {
				$this->session->set_flashdata('success', "Success, Active Semester has been updated!");
			} else {
				$this->session->set_flashdata('error', "Error, Can't updated!");
			}
			$data['lists'] = $this->mdl_active_semester->semester_list();
			redirect("super_admin/active_semesters", 'refresh');

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
		if($this->mdl_active_semester->update($data, $id) == true) {
			$this->session->set_flashdata('success', "Success, Activated successfully!");
		} else {
			$this->session->set_flashdata('success', "Error, Can't activate!");
		}
		redirect('super_admin/active_semesters', 'refresh');
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
		if($this->mdl_active_semester->update($data, $id) == true) {
			$this->session->set_flashdata('success', "Success, Deactivated successfully!");
		} else {
			$this->session->set_flashdata('success', "Error, Can't deactivate!");
		}
		redirect('super_admin/active_semesters', 'refresh');
	}
	
}

/* End of file active_semesters.php */
/* Location: ./application/modules/super_admin/controllers/active_semesters.php */
