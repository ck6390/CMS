<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
 * Ganga Memorial CMS
 *
 * @author		Vishwajeet Kumar
 * @copyright	Copyright (c) 2019
 */

/**
 * Class Sessions
 */

class Sessions extends Base_Controller
{
	/**
	 * Session_Controller constructor.
	 */
	public function __construct()
	{
		// controller constructor
		parent::__construct();
		$this->load->model('session', 'mdl_session');
		$this->load->module('setting/semesters');
	}

	/**
	 * Fetch all session list.
	 * @return void [load view page]
	 */
	public function index()
	{
		$data['lists'] = $this->mdl_session->get_all();
		$this->template->set('title', 'Session List');
		$this->template->load('template', 'contents', 'session/session_list', $data);
	}

	/**
	 * Insert new record.
	 * @return void [load view page]
	 */
	public function add()
	{
		$this->form_validation->set_rules('session-start', 'session start date', 'required|trim|is_unique[sessions.session_name]');
		$this->form_validation->set_rules('session-end', 'session end date', 'required|trim');

		if($this->form_validation->run() == false) {
			$this->template->set('title', 'Add Session');
			$this->template->load('template', 'contents', 'session/session_add');
		} else {
			$post = $this->input->post(null, true);
			$cleanPost = $this->security->xss_clean($post); 
			$formData = array(
				'session_name' => $cleanPost['session-start'] .'-'. $cleanPost['session-end'],
				'session_start' => $cleanPost['session-start'],
				'session_end' => $cleanPost['session-end'],
				'description' => $cleanPost['description'] ? $cleanPost['description'] : null

			);
			//var_dump($formData); exit();
			// insert to database
			if($this->mdl_session->insert($formData) == true) {
				$this->session->set_flashdata('success', "Success, New Session has been added!");
			} else {
				$this->session->set_flashdata('danger', "Error, Can't add new Session!");
			}
			redirect('setting/sessions', 'refresh');
		}
	}

	/**
	 * Edit record and update.
	 * @param  int $id [primary key]
	 * @return void [load view page]
	 */
	public function edit($id)
	{
		$this->form_validation->set_rules('session-start', 'Session Start Date', 'required|trim');
		$this->form_validation->set_rules('session-end', 'Session End Date', 'required|trim');

		if($this->form_validation->run() == false) {
			$data['info'] = $this->mdl_session->get($id);
			$this->template->set('title', 'Edit Session');
			$this->template->load('template', 'contents', 'session/session_edit', $data);
		} else {
			$post = $this->input->post(null, true);
			$cleanPost = $this->security->xss_clean($post); 
			$formData = array(
				'session_name' => $cleanPost['session-start'] .'-'. $cleanPost['session-end'],
				'session_start' => $cleanPost['session-start'],
				'session_end' => $cleanPost['session-end'],
				'description' => $cleanPost['description'] ? $cleanPost['description'] : null
			);
			
			// update to database
			if($this->mdl_session->update($formData, $id) == true) {
				$this->session->set_flashdata('success', "Success, Session has been updated!");
			} else {
				$this->session->set_flashdata('error', "Error, Can't update the session!");
			}
			redirect('setting/sessions', 'refresh');
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
		if($this->mdl_session->update($data, $id) == true) {
			$this->session->set_flashdata('success', "Success, Activated successfully!");
		} else {
			$this->session->set_flashdata('error', "Error, Can't activate!");
		}
		redirect('setting/sessions', 'refresh');
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
		if($this->mdl_session->update($data, $id) == true) {
			$this->session->set_flashdata('success', "Success, Deactivated successfully!");
		} else {
			$this->session->set_flashdata('error', "Error, Can't deactivate!");
		}
		redirect('setting/sessions', 'refresh');
	}

	/**
	 * [Delete record from list.]
	 * @param  void
	 * @return boolean
	 */
	public function delete()
	{
		$id = $this->input->post('primary_id');
		if($this->mdl_session->delete($id) == true) {
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
		if($this->mdl_session->force_delete($id) == true) {
			$this->session->set_flashdata('success', 'DELETED!');
		} else {
			$this->session->set_flashdata('error', 'ERROR!');
		}
		redirect('setting/sessions', 'refresh');
	}
}

/* End of file Sessions.php */
/* Location: ./application/modules/sessions/controllers/Sessions.php */
