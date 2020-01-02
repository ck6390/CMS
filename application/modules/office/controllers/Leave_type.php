<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
 * ERP
 *
 * @author		Amit Kumar
 * @copyright	Copyright (c) 2018
 */

/**
 * Class Leave_type
 */

class Leave_type extends Base_Controller
{
	/**
	 * Leave_type_Controller constructor.
	 */
	public function __construct()
	{
		// controller constructor
		parent::__construct();
		$this->load->model('Mdl_leave_type', 'mdl_leave_type');
	}

	/**
	 * [Fetch all leave type list.]
	 * @param  void
	 * @return view
	 */
	public function index()
	{
		$data['lists'] = $this->mdl_leave_type->get_all();
		$this->template->set('title', 'Leave Type List');
		$this->template->load('template', 'contents', 'leave_type/list', $data);
	}

	/**
	 * [Insert a new leave type record.]
	 * @param  void
	 * @return redirect
	 */
	public function add()
	{
		$this->form_validation->set_rules('leave-name', 'leave name', 'required|trim');
		$this->form_validation->set_rules('leave-code', 'leave code', 'required|trim');
		$this->form_validation->set_rules('leave-limit', 'leave limit', 'required|trim');
		if($this->form_validation->run() == false) {
			$this->template->set('title', 'Add Leave Type');
			$this->template->load('template', 'contents', 'leave_type/add');
		} else {
			$post = $this->input->post(null, true);
			$cleanPost = $this->security->xss_clean($post);
			$formData = array(
				'leave_name' => $cleanPost['leave-name'],
				'leave_code' => $cleanPost['leave-code'],
				'leave_limit' => $cleanPost['leave-limit'],
				'salary_deduct' => $cleanPost['salary-deduct'],
				'deduction_value' => $cleanPost['deduction-value'] ? $cleanPost['deduction-value']:0.0,
				'description' => isset($_POST['description']) ? $cleanPost['description']:null
			);
			// insert to database
			if($this->mdl_leave_type->insert($formData) == true) {
				$this->session->set_flashdata('success', "Success, New leave type has been added!");
			} else {
				$this->session->set_flashdata('danger', "Error, Can't add new leave type!");
			}
			redirect('office/leave_type', 'refresh');
		}
	}

	/**
	 * [Edit leave type detail and update.]
	 * @param  int $id [primary key]
	 * @return redirect
	 */
	public function edit($id) 
	{
		$this->form_validation->set_rules('leave-name', 'leave name', 'required|trim');
		$this->form_validation->set_rules('leave-code', 'leave code', 'required|trim');
		$this->form_validation->set_rules('leave-limit', 'leave limit', 'required|trim');

		if($this->form_validation->run() == false) {
			$data['info'] = $this->mdl_leave_type->get($id);
			$this->template->set('title', 'Edit Leave Type');
			$this->template->load('template', 'contents', 'leave_type/edit', $data);
		} else {
			$post = $this->input->post(null, true);
			$cleanPost = $this->security->xss_clean($post);
			$formData = array(
				'leave_name' => $cleanPost['leave-name'],
				'leave_code' => $cleanPost['leave-code'],
				'leave_limit' => $cleanPost['leave-limit'],
				'salary_deduct' => $cleanPost['salary-deduct'],
				'deduction_value' => $cleanPost['deduction-value'] ? $cleanPost['deduction-value']:0.0,
				'description' => isset($_POST['description']) ? $cleanPost['description']:null
			);

			// update to database
			if($this->mdl_leave_type->update($formData, $id) == true) {
				$this->session->set_flashdata('successe', "Success, Leave type has been updated!");
			} else {
				$this->session->set_flashdata('error', "Error, Can't update the leave type!");
			}
			redirect('office/leave_type', 'refresh');
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
		if($this->mdl_leave_type->update($data, $id) == true) {
			$this->session->set_flashdata('success', "Success, Activated successfully!");
		} else {
			$this->session->set_flashdata('error', "Error, Can't activate!");
		}
		redirect('office/leave_type', 'refresh');
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
		if($this->mdl_leave_type->update($data, $id) == true) {
			$this->session->set_flashdata('success', "Success, Deactivated successfully!");
		} else {
			$this->session->set_flashdata('error', "Error, Can't deactivate!");
		}
		redirect('office/leave_type', 'refresh');
	}

	/**
	 * [Delete record from list.]
	 * @param  int $id [primary key]
	 * @return boolean
	 */
	public function delete()
	{
		$id = $this->input->post('primary_id');
		if($this->mdl_leave_type->delete($id) == true) {
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
		if($this->mdl_leave_type->force_delete($id) == true) {
			$this->session->set_flashdata('success', 'DELETED!');
		} else {
			$this->session->set_flashdata('error', 'ERROR!');
		}
		redirect('office/leave_type', 'refresh');
	}
}

/* End of file Leave_type.php */
/* Location: ./application/modules/office/controllers/Leave_type.php */