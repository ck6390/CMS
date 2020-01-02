<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
 * ERP
 *
 * @author		Manoj Kumar
 * @copyright	Copyright (c) 2018
 */

/**
 * Class Designation
 */

class Designation extends Base_Controller
{
	/**
	 * Designation_Controller constructor.
	 */
	public function __construct()
	{
		// controller constructor
		parent::__construct();
		$this->load->model('Mdl_designation', 'mdl_desg');
		$this->load->model('office/Mdl_department', 'mdl_dept');
		//$this->load->module('office/department');
		
	}

	/**
	 * [Fetch all designation list.]
	 * @param  void
	 * @return view
	 */
	public function index()
	{
		$data['lists'] = $this->mdl_desg->get_all();
		$this->template->set('title', 'Designation List');
		$this->template->load('template', 'contents', 'designation/list', $data);
	}
	
	/**
	 * [Insert a new salary component record.]
	 * @param  void
	 * @return redirect
	 */
	public function add()
	{
		$this->form_validation->set_rules('designation-name', 'designation name', 'required|trim');
		$this->form_validation->set_rules('department', 'department', 'required|trim');

		if($this->form_validation->run() == false) {
			$this->template->set('title', ' Add Designation');
			$this->template->load('template', 'contents', 'designation/add');
		} else {
			$post = $this->input->post(null, true);
			$cleanPost = $this->security->xss_clean($post);
			$formData = array(
				'dept_id' => $cleanPost['department'],
				'desg_name' => $cleanPost['designation-name'],
				'description' => $cleanPost['description'] ? $cleanPost['description']:null
			);
			// insert to database
			if($this->mdl_desg->insert($formData) == true) {
				$this->session->set_flashdata('success', "Success, New designation has been added!");
			} else {
				$this->session->set_flashdata('error', "Error, Can\'t add new designation.");
			}
			redirect('office/designation', 'refresh');
		}
	}

	/**
	 * [Edit salary component detail and update.]
	 * @param  int $id [primary key]
	 * @return redirect
	 */
	public function edit($id) 
	{
		$this->form_validation->set_rules('designation-name', 'designation name', 'required|trim');

		if($this->form_validation->run() == false)
		{
			$data['info'] = $this->mdl_desg->get($id);
			$this->template->set('title', 'Edit Designation');
			$this->template->load('template', 'contents', 'designation/edit', $data);
		} else {
			$post = $this->input->post(null, true);
			$cleanPost = $this->security->xss_clean($post);
			$formData = array(
				'dept_id' => $cleanPost['department'],
				'desg_name' => $cleanPost['designation-name'],
				'description' => $cleanPost['description'] ? $cleanPost['description']:null
			);
			// update to database
			if($this->mdl_desg->update($formData, $id) == true) {
				$this->session->set_flashdata('successe', "Success, Designation has been updated!");
			} else {
				$this->session->set_flashdata('error', "Error, Can't update the designation!");
			}
			redirect('office/designation', 'refresh');
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
		if($this->mdl_desg->update($data, $id) == true) {
			$this->session->set_flashdata('success', "Success, Activated successfully!");
		} else {
			$this->session->set_flashdata('error', "Error, Can't activate!");
		}
		redirect('office/designation', 'refresh');
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
		if($this->mdl_desg->update($data, $id) == true) {
			$this->session->set_flashdata('success', "Success, Deactivated successfully!");
		} else {
			$this->session->set_flashdata('error', "Error, Can't deactivate!");
		}
		redirect('office/designation', 'refresh');
	}

	/**
	 * [Delete record from table.]
	 * @param  int $id [primary key]
	 * @return boolean
	 */
	public function delete()
	{
		$id = $this->input->post('primary_id');
		if($this->mdl_desg->delete_department($id) == true) {
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
		if($this->mdl_desg->force_delete($id) == true) {
			$this->session->set_flashdata('success', 'DELETED!');
		} else {
			$this->session->set_flashdata('error', 'ERROR!');
		}
		redirect('office/designation', 'refresh');
	}
}

/* End of file Designation.php */
/* Location: ./application/modules/office/controllers/Designation.php */	