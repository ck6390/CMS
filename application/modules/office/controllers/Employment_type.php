<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
 * ERP
 *
 * @author		Amit Kumar
 * @copyright	Copyright (c) 2018
 */

/**
 * Class Employment_type
 */

class Employment_type extends Base_Controller
{
	/**
	 * Employment_type_Controller constructor.
	 */
	public function __construct()
	{
		// controller constructor
		parent::__construct();
		$this->load->model('Mdl_employment_type', 'mdl_emp_type');
	}

	/**
	 * [Fetch all bank list.]
	 * @param  void
	 * @return view
	 */
	public function index()
	{
		$data['lists'] = $this->mdl_emp_type->get_all();
		$this->template->set('title', 'Employment Type List');
		$this->template->load('template', 'contents', 'employment_type/list', $data);
	}

	/**
	 * [Insert a new bank record.]
	 * @param  void
	 * @return redirect
	 */
	public function add()
	{
		$this->form_validation->set_rules('type-name', 'employment type name', 'required|trim|is_unique[employment_type.emp_type_name]');

		if($this->form_validation->run() == false) {
			$this->template->set('title', 'Add Employment Type');
			$this->template->load('template', 'contents', 'employment_type/add');
		} else {			
			$post = $this->input->post(null, true);
			$cleanPost = $this->security->xss_clean($post);
			$formData = array(
				'emp_type_name' => $cleanPost['type-name'],
				'description' => $cleanPost['description'] ? $cleanPost['description']:null
			);
			// insert to database
			if($this->mdl_emp_type->insert($formData) == true) {
				$this->session->set_flashdata('success', "Success, New employment type has been added!");
			} else {
				$this->session->set_flashdata('error', "Error, Can't add new employment type!");
			}
			redirect('office/employment_type', 'refresh');
		}
	}

	/**
	 * [Edit bank detail and update.]
	 * @param  int $id [primary key]
	 * @return redirect
	 */
	public function edit($id) 
	{
		$this->form_validation->set_rules('type-name', 'employment type name', 'required|trim');
		if($this->form_validation->run() == false) {
			$data['info'] = $this->mdl_emp_type->get($id);
			$this->template->set('title', 'Edit Employment Type');
			$this->template->load('template', 'contents', 'employment_type/edit', $data);
		} else {
			$post = $this->input->post(null, true);
			$cleanPost = $this->security->xss_clean($post);
			$formData = array(
				'emp_type_name' => $cleanPost['type-name'],
				'description' => $cleanPost['description'] ? $cleanPost['description']:null
			);
			// update to database
			if($this->mdl_emp_type->update($formData, $id) == true) {
				$this->session->set_flashdata('success', "Success, Employment type has been updated!");
			} else {
				$this->session->set_flashdata('error', "Error, Can't update employment type!");
			}
			redirect('office/employment_type', 'refresh');
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
		if($this->mdl_emp_type->update($data, $id) == true) {
			$this->session->set_flashdata('success', "Success, Activated successfully!");
		} else {
			$this->session->set_flashdata('error', "Error, Can't activate!");
		}
		redirect('office/employment_type', 'refresh');
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
		if($this->mdl_emp_type->update($data, $id) == true) {
			$this->session->set_flashdata('success', "Success, Deactivated successfully!");
		} else {
			$this->session->set_flashdata('error', "Error, Can't deactivate!");
		}
		redirect('office/employment_type', 'refresh');
	}

	/**
	 * [Delete record from table.]
	 * @param  int $id [primary key]
	 * @return boolean
	 */
	public function delete()
	{
		$id = $this->input->post('primary_id');
		if($this->mdl_emp_type->delete($id) == true) {
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
		if($this->mdl_emp_type->force_delete($id) == true) {
			$this->session->set_flashdata('success', 'DELETED!');
		} else {
			$this->session->set_flashdata('error', 'ERROR!');
		}
		redirect('office/employment_type', 'refresh');
	}
}

/* End of file Employment_type.php */
/* Location: ./application/modules/office/controllers/Employment_type.php */