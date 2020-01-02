<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
 * ERP
 *
 * @author		Amit Kumar
 * @copyright	Copyright (c) 2018
 */

/**
 * Class Bank
 */

class Bank extends Base_Controller
{
	/**
	 * Department_Controller constructor.
	 */
	public function __construct()
	{
		// controller constructor
		parent::__construct();
		$this->load->model('Mdl_bank', 'mdl_bank');
	}

	/**
	 * [Fetch all bank list.]
	 * @param  void
	 * @return view
	 */
	public function index()
	{
		$data['lists'] = $this->mdl_bank->get_all();
		$this->template->set('title', 'Bank List');
		$this->template->load('template', 'contents', 'bank/list', $data);
	}
    
	/**
	 * [Insert a new bank record.]
	 * @param  void
	 * @return redirect
	 */
	public function add()
	{
		$this->form_validation->set_rules('bank-name', 'bank name', 'required|trim');
		$this->form_validation->set_rules('account-name', 'account name', 'required|trim');
		$this->form_validation->set_rules('account-number', 'account number', 'required|trim|is_unique[bank_detail.account_number]');
		$this->form_validation->set_rules('ifsc-code', 'IFSC code', 'required|trim');

		if($this->form_validation->run() == false) {
			$this->template->set('title', 'Add Bank');
			$this->template->load('template', 'contents', 'bank/add');
		} else {
			$post = $this->input->post(null, true);
			$cleanPost = $this->security->xss_clean($post);
			$formData = array(
				'bank_name' => $cleanPost['bank-name'],
				'account_name' => $cleanPost['account-name'],
				'account_number' => $cleanPost['account-number'],
				'ifsc_code' => $cleanPost['ifsc-code'],
				'address' => $cleanPost['address'] ? $cleanPost['address']:null,
				'description' => $cleanPost['description'] ? $cleanPost['description']:null
			);
			// insert to database
			if($this->mdl_bank->insert($formData) == true) {
				$this->session->set_flashdata('success', "Success, New bank has been added!");
			} else {
				$this->session->set_flashdata('error', "Error, Can't add new bank!");
			}
			redirect('office/bank', 'refresh');
		}
	}

	/**
	 * [Edit bank detail and update.]
	 * @param  int $id [primary key]
	 * @return redirect
	 */
	public function edit($id) 
	{
		$this->form_validation->set_rules('bank-name', 'bank name', 'required|trim');
		$this->form_validation->set_rules('account-name', 'account name', 'required|trim');
		$this->form_validation->set_rules('account-number', 'account number', 'required|trim');
		$this->form_validation->set_rules('ifsc-code', 'IFSC code', 'required|trim');

		if($this->form_validation->run() == false) {
			$data['info'] = $this->mdl_bank->get($id);
			$this->template->set('title', 'Edit Bank Detail');
			$this->template->load('template', 'contents', 'bank/edit', $data);
		} else {
			$post = $this->input->post(null, true);
			$cleanPost = $this->security->xss_clean($post);
			$formData = array(
				'bank_name' => $cleanPost['bank-name'],
				'account_name' => $cleanPost['account-name'],
				'account_number' => $cleanPost['account-number'],
				'ifsc_code' => $cleanPost['ifsc-code'],
				'address' => $cleanPost['address'] ? $cleanPost['address']:null,
				'description' => $cleanPost['description'] ? $cleanPost['description']:null
			);
			// update to database
			if($this->mdl_bank->update($formData, $id) == true) {
				$this->session->set_flashdata('success', "Success, Bank detail has been updated!");
			} else {
				$this->session->set_flashdata('error', "Error, Can't update bank detail!");
			}
			redirect('office/bank', 'refresh');
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
		if($this->mdl_bank->update($data, $id) == true) {
			$this->session->set_flashdata('success', "Success, Activated successfully!");
		} else {
			$this->session->set_flashdata('error', "Error, Can't activate!");
		}
		redirect('office/bank', 'refresh');
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
		if($this->mdl_bank->update($data, $id) == true) {
			$this->session->set_flashdata('success', "Success, Deactivated successfully!");
		} else {
			$this->session->set_flashdata('error', "Error, Can't deactivate!");
		}
		redirect('office/bank', 'refresh');
	}

	/**
	 * [Delete record from table.]
	 * @param  int $id [primary key]
	 * @return boolean
	 */
	public function delete()
	{
		$id = $this->input->post('primary_id');
		if($this->mdl_bank->delete($id) == true) {
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
		if($this->mdl_bank->force_delete($id) == true) {
			$this->session->set_flashdata('success', 'DELETED!');
		} else {
			$this->session->set_flashdata('error', 'ERROR!');
		}
		redirect('office/bank', 'refresh');
	}
}

/* End of file Bank.php */
/* Location: ./application/modules/office/controllers/Bank.php */	