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

class Financial_years extends Base_Controller
{
	/**
	 * Session_Controller constructor.
	 */
	public function __construct()
	{
		// controller constructor
		parent::__construct();
		$this->load->model('Financial_year', 'mdl_financial_year');
		/*$this->load->module('setting/semesters');*/
	}

	/**
	 * Fetch all session list.
	 * @return void [load view page]
	 */
	public function index()
	{
		
		$data['lists'] = $this->mdl_financial_year->get_all();
		//var_dump($data['lists']);
		//die();
		$this->template->set('title', 'Financial year List');
		$this->template->load('template', 'contents', 'financial_year/financial_year_list', $data);
	}

	/**
	 * Insert new record.
	 * @return void [load view page]
	 */
	public function add()
	{
		$this->form_validation->set_rules('start_year', 'Start Year', 'required|trim');
		$this->form_validation->set_rules('end_year', 'End Year', 'required|trim');	 
		$this->form_validation->set_rules('start_month', 'Start Month', 'required|trim');
		$this->form_validation->set_rules('end_month', 'End Month', 'required|trim');

		if($this->form_validation->run() == false) {
			$this->template->set('title', 'Add Financial_year');
			$this->template->load('template', 'contents', 'financial_year/financial_year_add');
		} else {
			$post = $this->input->post(null, true);
			$cleanPost = $this->security->xss_clean($post); 
			$formData = array(
				/*'session_name' => $cleanPost['session-start'] .'-'. $cleanPost['session-end'],*/
				'start_year' => $cleanPost['start_year'],
				'end_year' => $cleanPost['end_year'],
				'start_month' => $cleanPost['start_month'],
				'end_month' => $cleanPost['end_month'],
/*				'description' => $cleanPost['description'] ? $cleanPost['description'] : null*/

			);
			//var_dump($formData); exit();
			// insert to database
			if($this->mdl_financial_year->insert($formData) == true) {
				$this->session->set_flashdata('success', "Success, New record has been added!");
			} else {
				$this->session->set_flashdata('danger', "Error, Can't add new record!");
			}
			redirect('setting/financial_years', 'refresh');
		}
	}

	/**
	 * Edit record and update.
	 * @param  int $id [primary key]
	 * @return void [load view page]
	 */
	public function edit($id)
	{
		$this->form_validation->set_rules('start_year', ' Start Year', 'required|trim');
		$this->form_validation->set_rules('end_year', ' End Year', 'required|trim');
		$this->form_validation->set_rules('start_month', ' Start Month', 'required|trim');
		$this->form_validation->set_rules('end_month', ' End Month', 'required|trim');

		if($this->form_validation->run() == false) {
			$data['info'] = $this->mdl_financial_year->get($id);
			$this->template->set('title', 'Edit Financial Year');
			$this->template->load('template', 'contents', 'financial_year/financial_year_edit', $data);
		} else {
			$post = $this->input->post(null, true);
			$cleanPost = $this->security->xss_clean($post); 
			$formData = array(
				/*'session_name' => $cleanPost['session-start'] .'-'. $cleanPost['session-end'],*/
				'start_year' => $cleanPost['start_year'],
				'end_year' => $cleanPost['end_year'],
				'start_month' => $cleanPost['start_month'],
				'end_month' => $cleanPost['end_month'],
/*				'description' => $cleanPost['description'] ? $cleanPost['description'] : null*/
			);
			
			// update to database
			if($this->mdl_financial_year->update($formData, $id) == true) {
				$this->session->set_flashdata('success', "Success, data has been updated!");
			} else {
				$this->session->set_flashdata('error', "Error, Can't update the data!");
			}
			redirect('setting/financial_years', 'refresh');
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
		if($this->mdl_financial_year->update($data, $id) == true) {
			$this->session->set_flashdata('success', "Success, Activated successfully!");
		} else {
			$this->session->set_flashdata('error', "Error, Can't activate!");
		}
		redirect('setting/financial_years', 'refresh');
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
		if($this->mdl_financial_year->update($data, $id) == true) {
			$this->session->set_flashdata('success', "Success, Deactivated successfully!");
		} else {
			$this->session->set_flashdata('error', "Error, Can't deactivate!");
		}
		redirect('setting/financial_years', 'refresh');
	}

	/**
	 * [Delete record from list.]
	 * @param  void
	 * @return boolean
	 */
	public function delete()
	{
		$id = $this->input->post('primary_id');
		if($this->mdl_financial_year->delete($id) == true) {
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
		if($this->mdl_financial_year->force_delete($id) == true) {
			$this->session->set_flashdata('success', 'DELETED!');
		} else {
			$this->session->set_flashdata('error', 'ERROR!');
		}
		redirect('setting/financial_years', 'refresh');
	}
}

/* End of file Sessions.php */
/* Location: ./application/modules/sessions/controllers/Sessions.php */
