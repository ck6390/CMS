<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
 * Ganga Memorial CMS
 *
 * @author		Vishwajeet Kumar
 * @copyright	Copyright (c) 2019
 */

/**
 * Class Fee_types
 */

class Fee_types extends Base_Controller
{
	/**
	 * Fees_Controller constructor.
	 */
	public function __construct()
	{
		// controller constructor
		parent::__construct();
		$this->load->model('fee_type', 'mdl_fee_type');
		$this->load->model('fee_allocate', 'mdl_fee_allocate');
		$this->load->module('accounting/fee_groups');
	}

	/**
	 * [Fetch all Fee list.]
	 * @param  void
	 * @return view
	 */
	public function index()
	{
		$data['lists'] = $this->mdl_fee_type->get_all();
		$this->template->set('title', 'Fee List');
		$this->template->load('template', 'contents', 'fee_type/fee_type_list', $data);
	}

	/**
	 * [Insert a new Fees record.]
	 * @param  void
	 * @return redirect
	 */
	public function add()
	{
		$this->form_validation->set_rules('fee-type', 'fee type', 'required|trim|is_unique[fee_types.fee_type_name]');
		$this->form_validation->set_rules('fee-amount', 'fee amount', 'trim');
		$this->form_validation->set_rules('fee-group', 'fee group', 'required|trim');
		$this->form_validation->set_rules('description', 'descriptiont', 'trim');
		
			
		if($this->form_validation->run() == false) {
			$this->template->set('title', 'Add Fee');
			$this->template->load('template', 'contents', 'fee_type/fee_type_add');
		} else {
			$post = $this->input->post(NULL, TRUE);
			$cleanPost = $this->security->xss_clean($post);
			$formData = array(
				'fee_type_name' => $cleanPost['fee-type'],
				'fee_group' => $cleanPost['fee-group'],
				'fee_type_amount' => $cleanPost['fee-amount'] ? $cleanPost['fee-amount'] :" ",
				'description' => $cleanPost['description'] ? $cleanPost['description'] : null
			);
				
			// insert to database
			if($this->mdl_fee_type->insert($formData) == true) {
				
				$this->session->set_flashdata('success', "Success, New Fee Type has been added!");
			} else {
				$this->session->set_flashdata('danger', "Error, Can't add new Session!");
			}
			redirect('accounting/fee_types', 'refresh');
		}
	}

	/**
	 * [Edit fee details]
	 * @param  int $id [primary key]
	 * @return [type]     [description]
	 */
	public function edit($id) 
	{
		$this->form_validation->set_rules('fee-type', 'fee type', 'required|trim');
		$this->form_validation->set_rules('fee-amount', 'fee amount', 'trim');
		$this->form_validation->set_rules('fee-group', 'fee group', 'required|trim');
		$this->form_validation->set_rules('description', 'description', 'trim');

		if($this->form_validation->run() == false) {
			$data['info'] = $this->mdl_fee_type->get($id);
			$this->template->set('title', 'Edit Fee Type');
			$this->template->load('template', 'contents', 'fee_type/fee_type_edit', $data);
		} else {
			$post = $this->input->post(null, true);
			$cleanPost = $this->security->xss_clean($post);
			$formData = array(
				'fee_type_name' => $cleanPost['fee-type'],
				'fee_group' => $cleanPost['fee-group'],
				'fee_type_amount' => $cleanPost['fee-amount'],
				'description' => $cleanPost['description'] ? $cleanPost['description'] : null
			);
			
			// update to database
			if($this->mdl_fee_type->update($formData, $id) == true) {
				$this->session->set_flashdata('successe', "Success, Fee Type has been updated!");
			} else {
				$this->session->set_flashdata('error', "Error, Can't update the fee type!");
			}
			redirect('accounting/fee_types', 'refresh');
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
		if($this->mdl_fee_type->update($data, $id) == true) {
			$this->session->set_flashdata('success', "Success, Activated successfully!");
		} else {
			$this->session->set_flashdata('error', "Error, Can't activate!");
		}
		redirect('setting/fee_types', 'refresh');
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
		if($this->mdl_fee_type->update($data, $id) == true) {
			$this->session->set_flashdata('success', "Success, Deactivated successfully!");
		} else {
			$this->session->set_flashdata('error', "Error, Can't deactivate!");
		}
		redirect('setting/fee_types', 'refresh');
	}

	/**
	 * [Delete record from list.]
	 * @param  void
	 * @return boolean
	 */
	public function delete()
	{
		$id = $this->input->post('primary_id');
		if($this->mdl_fee_type->delete($id) == true) {
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
		if($this->mdl_fee_type->force_delete($id) == true) {
			$this->session->set_flashdata('success', 'DELETED!');
		} else {
			$this->session->set_flashdata('error', 'ERROR!');
		}
		redirect('setting/fee_types', 'refresh');
	}

	/**
	 * [Get feeType list by Fee Group.]
	 * @param  int $id [primary key]
	 * @return mixed
	 */
	public function get_feeType_list_by_group($id)
	{
		$query = $this->db->select('fee_type_p_id, fee_type_name, fee_type_amount')->from('fee_types')->where(array(
                'fee_group' => $id,
                'is_active' =>'1'
            ))->get();
		$result = $query->num_rows() > 0 ? $query->result() : false;
		echo json_encode($result);
	}


	/**
	 * [Get feeType list by Fee Group.]
	 * @param  int $id [primary key]
	 * @return mixed
	 */
	public function get_feeType_amount($id)
	{
		$query = $this->db->select('fee_type_p_id, fee_type_amount')->from('fee_types')->where(array(
                'fee_type_p_id' => $id,
                'is_active' =>'1'
            ))->get();
		$result = $query->num_rows() > 0 ? $query->row() : false;
		echo json_encode($result);
	}
}

/* End of file fee_types.php */
/* Location: ./application/modules/setting/controllers/fee_types.php */