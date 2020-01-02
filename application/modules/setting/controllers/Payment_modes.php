<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
 * ganga Memorial CMS
 *
 * @author		Amit Kumar
 * @copyright	Copyright (c) 2019
 */

/**
 * Class Payment_modes
 */

class Payment_modes extends Base_Controller
{
	/**
	 * Pay_grade_Controller constructor.
	 */
	public function __construct()
	{
		// controller constructor
		parent::__construct();
		$this->load->model('payment_mode', 'mdl_pay_mode');
		$this->load->module('setting/semesters');
	}

	/**
	 * [Fetch all payment mode list.]
	 * @param  void
	 * @return view
	 */
	public function index()
	{
		$data['lists'] = $this->mdl_pay_mode->get_all();
		$this->template->set('title', 'Payment Mode List');
		$this->template->load('template', 'contents', 'payment_mode/payment_mode_list', $data);
	}

	/**
	 * [Insert a new payment mode record.]
	 * @param  void
	 * @return redirect
	 */
	public function add()
	{
		$this->form_validation->set_rules('mode-name', 'grade', 'required|trim|is_unique[payment_mode.payment_mode_name]');

		if($this->form_validation->run() == false) {
			$this->template->set('title', 'Add Payment Mode');
			$this->template->load('template', 'contents', 'payment_mode/payment_mode_add');
		} else {
			$post = $this->input->post(null, true);
			$cleanPost = $this->security->xss_clean($post);
			$formData = array(
				'payment_mode_name' => $cleanPost['mode-name'],
				'description' => $cleanPost['description'] ? $cleanPost['description']:null
			);
			// insert to database
			if($this->mdl_pay_mode->insert($formData) == true) {
				$this->session->set_flashdata('success', "Success, New payment mode has been added!");
			} else {
				$this->session->set_flashdata('danger', "Error, Can't add new payment mode!");
			}
			redirect('setting/payment_modes', 'refresh');
		}
	}

	/**
	 * [Edit payment mode detail and update.]
	 * @param  int $id [primary key]
	 * @return redirect
	 */
	public function edit($id) 
	{
		$this->form_validation->set_rules('mode-name', 'grade', 'required|trim');

		if($this->form_validation->run() == false)
		{
			$data['info'] = $this->mdl_pay_mode->get($id);
			$this->template->set('title', 'Edit Payment Mode');
			$this->template->load('template', 'contents', 'payment_mode/payment_mode_edit', $data);
		} else {
			$post = $this->input->post(null, true);
			$cleanPost = $this->security->xss_clean($post);
			$formData = array(
				'payment_mode_name' => $cleanPost['mode-name'],
				'description' => $cleanPost['description'] ? $cleanPost['description']:null
			);
			// update to database
			if($this->mdl_pay_mode->update($formData, $id) == true) {
				$this->session->set_flashdata('success', "Success, Payment mode has been updated!");
			} else {
				$this->session->set_flashdata('error', "Error, Can't update the payment mode!");
			}
			redirect('setting/payment_modes', 'refresh');
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
		if($this->mdl_pay_mode->update($data, $id) == true) {
			$this->session->set_flashdata('success', "Success, Activated successfully!");
		} else {
			$this->session->set_flashdata('error', "Error, Can't activate!");
		}
		redirect('setting/payment_modes', 'refresh');
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
		if($this->mdl_pay_mode->update($data, $id) == true) {
			$this->session->set_flashdata('success', "Success, Deactivated successfully!");
		} else {
			$this->session->set_flashdata('error', "Error, Can't deactivate!");
		}
		redirect('setting/payment_modes', 'refresh');
	}

	/**
	 * [Delete record from list.]
	 * @param  int $id [primary key]
	 * @return boolean
	 */
	public function delete()
	{
		$id = $this->input->post('primary_id');
		if($this->mdl_pay_mode->delete($id) == true) {
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
		if($this->mdl_pay_mode->force_delete($id) == true) {
			$this->session->set_flashdata('success', 'DELETED!');
		} else {
			$this->session->set_flashdata('error', 'ERROR!');
		}
		redirect('setting/payment_modes', 'refresh');
	}
}

/* End of file Payment_modes.php */
/* Location: ./application/modules/setting/controllers/Payment_modes.php */