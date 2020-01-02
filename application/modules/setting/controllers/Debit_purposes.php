<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
 * ganga Memorial CMS
 *
 * @author		Manoj Kumar
 * @copyright	Copyright (c) 2019
 */

/**
 * Class Debit_purposes
 */

class Debit_purposes extends Base_Controller
{
	/**
	 * Pay_grade_Controller constructor.
	 */
	public function __construct()
	{
		// controller constructor
		parent::__construct();
		$this->load->model('debit_purpose', 'mdl_debit_purpose');
	}

	/**
	 * [Fetch all payment mode list.]
	 * @param  void
	 * @return view
	 */
	public function index()
	{
		$data['lists'] = $this->mdl_debit_purpose->get_all();
		$this->template->set('title', 'Debit Purpose List');
		$this->template->load('template', 'contents', 'debit_purpose/list', $data);
	}

	/**
	 * [Insert a new payment mode record.]
	 * @param  void
	 * @return redirect
	 */
	public function add()
	{
		$this->form_validation->set_rules('purpose-name', 'purpose', 'required|trim|is_unique[debit_purpose.purpose_name]');

		if($this->form_validation->run() == false) {
			$this->template->set('title', 'Add Debit Purpose');
			$this->template->load('template', 'contents', 'debit_purpose/add');
		} else {
			$post = $this->input->post(null, true);
			$cleanPost = $this->security->xss_clean($post);
			$formData = array(
				'purpose_name' => $cleanPost['purpose-name'],
				'description' => $cleanPost['description'] ? $cleanPost['description']:null
			);
			// insert to database
			if($this->mdl_debit_purpose->insert($formData) == true) {
				$this->session->set_flashdata('success', "Success, New payment mode has been added!");
			} else {
				$this->session->set_flashdata('danger', "Error, Can't add new payment mode!");
			}
			redirect('setting/debit_purposes', 'refresh');
		}
	}

	/**
	 * [Edit payment mode detail and update.]
	 * @param  int $id [primary key]
	 * @return redirect
	 */
	public function edit($id) 
	{
		$this->form_validation->set_rules('purpose-name', 'purpose', 'required|trim');

		if($this->form_validation->run() == false)
		{
			$data['info'] = $this->mdl_debit_purpose->get($id);
			$this->template->set('title', 'Edit Debit Purpose');
			$this->template->load('template', 'contents', 'debit_purpose/edit', $data);
		} else {
			$post = $this->input->post(null, true);
			$cleanPost = $this->security->xss_clean($post);
			$formData = array(
				'purpose_name' => $cleanPost['purpose-name'],
				'description' => $cleanPost['description'] ? $cleanPost['description']:null
			);
			// update to database
			if($this->mdl_debit_purpose->update($formData, $id) == true) {
				$this->session->set_flashdata('success', "Success, Debit Purpose has been updated!");
			} else {
				$this->session->set_flashdata('error', "Error, Can't update the debit purpose!");
			}
			redirect('setting/debit_purposes', 'refresh');
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
		if($this->mdl_debit_purpose->update($data, $id) == true) {
			$this->session->set_flashdata('success', "Success, Activated successfully!");
		} else {
			$this->session->set_flashdata('error', "Error, Can't activate!");
		}
		redirect('setting/debit_purposes', 'refresh');
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
		if($this->mdl_debit_purpose->update($data, $id) == true) {
			$this->session->set_flashdata('success', "Success, Deactivated successfully!");
		} else {
			$this->session->set_flashdata('error', "Error, Can't deactivate!");
		}
		redirect('setting/debit_purposes', 'refresh');
	}

	/**
	 * [Delete record from list.]
	 * @param  int $id [primary key]
	 * @return boolean
	 */
	public function delete()
	{
		$id = $this->input->post('primary_id');
		if($this->mdl_debit_purpose->delete($id) == true) {
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
		if($this->mdl_debit_purpose->force_delete($id) == true) {
			$this->session->set_flashdata('success', 'DELETED!');
		} else {
			$this->session->set_flashdata('error', 'ERROR!');
		}
		redirect('setting/debit_purposes', 'refresh');
	}
}

/* End of file debit_purposes.php */
/* Location: ./application/modules/setting/controllers/debit_purposes.php */