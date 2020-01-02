<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
 * Ganga Memorial CMS
 *
 * @author		Vishwajeet Kumar
 * @copyright	Copyright (c) 2019
 */

/**
 * Class Fee_groups
 */

class Fee_groups extends Base_Controller
{
	/**
	 * Fees_Controller constructor.
	 */
	public function __construct()
	{
		// controller constructor
		parent::__construct();
		$this->load->model('fee_group', 'mdl_fee_group');
		$this->load->module('setting/semesters');
	}

	/**
	 * [Fetch all Fee list.]
	 * @param  void
	 * @return view
	 */
	public function index()
	{
		$data['lists'] = $this->mdl_fee_group->get_all();
		$this->template->set('title', 'Fee List');
		$this->template->load('template', 'contents', 'fee_group/fee_group_list', $data);
	}

	/**
	 * [Insert a new Fees record.]
	 * @param  void
	 * @return redirect
	 */
	public function add()
	{
		$this->form_validation->set_rules('group-title', 'group title', 'required|trim|is_unique[fee_groups.fee_group_name]');

		if($this->form_validation->run() == false) {
			$this->template->set('title', 'Add Fee');
			$this->template->load('template', 'contents', 'fee_group/fee_group_add');
		} else {
			$post = $this->input->post(NULL, TRUE);
			$cleanPost = $this->security->xss_clean($post);
			$formData = array(
				'fee_group_name' => $cleanPost['group-title'],
				'description' => $cleanPost['description'] ? $cleanPost['description']:"null",
			);
			// insert to database
			if($this->mdl_fee_group->insert($formData) == true) {
				$this->session->set_flashdata('success', "Success, New fee group has been added!");
			} else {
				$this->session->set_flashdata('danger', "Error, Can't add new fee group!");
			}
			redirect('accounting/fee_groups', 'refresh');
		}
	}

	/**
	 * [Edit fee details]
	 * @param  int $id [primary key]
	 * @return [type]     [description]
	 */
	public function edit($id) 
	{
		$this->form_validation->set_rules('group-title', 'group title', 'required|trim');

		if($this->form_validation->run() == false) {
			$data['info'] = $this->mdl_fee_group->get($id);
			$this->template->set('title', 'Edit User');
			$this->template->load('template', 'contents', 'fee_group/fee_group_edit', $data);
		} else {
			$post = $this->input->post(null, true);
			$cleanPost = $this->security->xss_clean($post);
			$formData = array(
				'fee_group_name' => $cleanPost['group-title'],
				'description' => $cleanPost['description'] ? $cleanPost['description']:"null",
			);
			// update to database
			if($this->mdl_fee_group->update($formData, $id) == true) {
				$this->session->set_flashdata('success', "Success, fee group has been updated!");
			} else {
				$this->session->set_flashdata('error', "Error, Can't update the fee group!");
			}
			redirect('accounting/fee_groups', 'refresh');
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
		if($this->mdl_fee_group->update($data, $id) == true) {
			$this->session->set_flashdata('success', "Success, Activated successfully!");
		} else {
			$this->session->set_flashdata('error', "Error, Can't activate!");
		}
		redirect('accounting/fee_groups', 'refresh');
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
		if($this->mdl_fee_group->update($data, $id) == true) {
			$this->session->set_flashdata('success', "Success, Deactivated successfully!");
		} else {
			$this->session->set_flashdata('error', "Error, Can't deactivate!");
		}
		redirect('accounting/fee_groups', 'refresh');
	}

	/**
	 * [Delete record from list.]
	 * @param  void
	 * @return boolean
	 */
	public function delete()
	{
		$id = $this->input->post('primary_id');
		if($this->mdl_user->delete($id) == true) {
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
		if($this->mdl_user->force_delete($id) == true) {
			$this->session->set_flashdata('success', 'DELETED!');
		} else {
			$this->session->set_flashdata('error', 'ERROR!');
		}
		redirect('accounting/fee_groups', 'refresh');
	}
}

/* End of file Fee_group.php */
/* Location: ./application/modules/setting/controllers/Fee_group.php */