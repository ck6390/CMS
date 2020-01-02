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

class Restrictions extends Base_Controller
{
	/**
	 * Session_Controller constructor.
	 */
	public function __construct()
	{
		// controller constructor
		parent::__construct();
		$this->load->model('Restriction', 'mdl_restriction');
		/*$this->load->module('setting/semesters');*/
	}

	/**
	 * Fetch all session list.
	 * @return void [load view page]
	 */
	public function index()
	{
		$data['lists'] = $this->mdl_restriction->get_all();
		$this->template->set('title', 'Restriction List');
		$this->template->load('template', 'contents', 'restriction/restriction_list', $data);
	}

	/**
	 * Insert new record.
	 * @return void [load view page]
	 */
	public function add()
	{
		$this->form_validation->set_rules('restriction', 'Restriction', 'required|trim');
		$this->form_validation->set_rules('description', 'Description', 'required|trim');

		if($this->form_validation->run() == false) {
			$this->template->set('title', 'Add Restriction');
			$this->template->load('template', 'contents', 'restriction/restriction_add');
		} else {
			$post = $this->input->post(null, true);
			$cleanPost = $this->security->xss_clean($post); 
			$formData = array(
				'restriction' => $cleanPost['restriction'],
				'description' => $cleanPost['description']
				/*'session_end' => $cleanPost['session-end'],
				'description' => $cleanPost['description'] *//*? $cleanPost['description'] : null*/

			);
			//var_dump($formData); exit();
			// insert to database
			if($this->mdl_restriction->insert($formData) == true) {
				$this->session->set_flashdata('success', "Success, New Restriction has been added!");
			} else {
				$this->session->set_flashdata('danger', "Error, Can't add new Restriction!");
			}
			redirect('setting/restrictions', 'refresh');
		}
	}

	/**
	 * Edit record and update.
	 * @param  int $id [primary key]
	 * @return void [load view page]
	 */
	public function edit($id)
	{
		$this->form_validation->set_rules('restriction', 'Restriction', 'required|trim');
		$this->form_validation->set_rules('description', 'Description', 'required|trim');

		if($this->form_validation->run() == false) {
			$data['info'] = $this->mdl_restriction->get($id);
			$this->template->set('title', 'Edit Restriction');
			$this->template->load('template', 'contents', 'restriction/restriction_edit', $data);
		} else {
			$post = $this->input->post(null, true);
			$cleanPost = $this->security->xss_clean($post); 
			$formData = array(
				/*'session_name' => $cleanPost['session-start'] .'-'. $cleanPost['session-end'],*/
				'restriction' => $cleanPost['restriction'],
				'description' => $cleanPost['description'],
				/*'description' => $cleanPost['description'] ? $cleanPost['description'] : null*/
			);
			
			// update to database
			if($this->mdl_restriction->update($formData, $id) == true) {
				$this->session->set_flashdata('success', "Success, Restriction has been updated!");
			} else {
				$this->session->set_flashdata('error', "Error, Can't update the Restriction!");
			}
			redirect('setting/restrictions', 'refresh');
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
		if($this->mdl_restriction->update($data, $id) == true) {
			$this->session->set_flashdata('success', "Success, Activated successfully!");
		} else {
			$this->session->set_flashdata('error', "Error, Can't activate!");
		}
		redirect('setting/restrictions', 'refresh');
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
		if($this->mdl_restriction->update($data, $id) == true) {
			$this->session->set_flashdata('success', "Success, Deactivated successfully!");
		} else {
			$this->session->set_flashdata('error', "Error, Can't deactivate!");
		}
		redirect('setting/restrictions', 'refresh');
	}

	/**
	 * [Delete record from list.]
	 * @param  void
	 * @return boolean
	 */
	public function delete()
	{
		$id = $this->input->post('primary_id');
		if($this->mdl_restriction->delete($id) == true) {
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
		if($this->mdl_restriction->force_delete($id) == true) {
			$this->session->set_flashdata('success', 'DELETED!');
		} else {
			$this->session->set_flashdata('error', 'ERROR!');
		}
		redirect('setting/restrictions', 'refresh');
	}
}

/* End of file Sessions.php */
/* Location: ./application/modules/sessions/controllers/Sessions.php */
