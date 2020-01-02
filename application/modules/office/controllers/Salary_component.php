<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
 * ERP
 *
 * @author		Amit Kumar
 * @copyright	Copyright (c) 2018
 */

/**
 * Class Salary_component
 */

class Salary_component extends Base_Controller
{
	/**
	 * Salary_component_Controller constructor.
	 */
	public function __construct()
	{
		// controller constructor
		parent::__construct();
		$this->load->model('Mdl_salary_component', 'mdl_salary_component');
	}

	/**
	 * [Fetch all salary component list.]
	 * @param  void
	 * @return view
	 */
	public function index()
	{
		$data['lists'] = $this->mdl_salary_component->get_all();
		$this->template->set('title', 'Salary Component List');
		$this->template->load('template', 'contents', 'salary_component/list', $data);
	}

	/**
	 * [Insert a new salary component record.]
	 * @param  void
	 * @return redirect
	 */
	public function add()
	{
		$this->form_validation->set_rules('component-name', 'component name', 'required|trim|is_unique[salary_component.component_name]');
		$this->form_validation->set_rules('component-type', 'component type', 'required|trim');
		$this->form_validation->set_rules('value-type', 'component value type', 'required|trim');

		if($this->form_validation->run() == false) {
			$this->template->set('title', 'Add Salary Component');
			$this->template->load('template', 'contents', 'salary_component/add');
		} else {			
			$post = $this->input->post(null, true);
			$cleanPost = $this->security->xss_clean($post);
			$formData = array(
				'component_name' => $cleanPost['component-name'],
				'component_type' => $cleanPost['component-type'],
				'payable_amount' => $this->input->post('payable-amount') != null ? $cleanPost['payable-amount']:'0',
				'cost_to_company' => $this->input->post('ctc') != null ? $cleanPost['ctc']:'0',
				'value_type' => $cleanPost['value-type'],
				'description' => $cleanPost['description'] ? $cleanPost['description']:null
			);
			// insert to database
			if($this->mdl_salary_component->insert($formData) == true) {
				$this->session->set_flashdata('success', "Success, New salary component has been added!");
			} else {
				$this->session->set_flashdata('danger', "Error, Can't add new salary component!");
			}
			redirect('office/salary_component', 'refresh');
		}
	}

	/**
	 * [Edit salary component detail and update.]
	 * @param  int $id [primary key]
	 * @return redirect
	 */
	public function edit($id) 
	{
		$this->form_validation->set_rules('component-name', 'employment status', 'required|trim');
		if($this->form_validation->run() == false) {
			$data['info'] = $this->mdl_salary_component->get($id);
			$this->template->set('title', 'Edit Salary Component');
			$this->template->load('template', 'contents', 'salary_component/edit', $data);
		} else {
			$post = $this->input->post(null, true);
			$cleanPost = $this->security->xss_clean($post);
			$formData = array(
				'component_name' => $cleanPost['component-name'],
				'component_type' => $cleanPost['component-type'],
				'payable_amount' => $this->input->post('payable-amount') != null ? $cleanPost['payable-amount']:'0',
				'cost_to_company' => $this->input->post('ctc') != null ? $cleanPost['ctc']:'0',
				'value_type' => $cleanPost['value-type'],
				'description' => $cleanPost['description'] ? $cleanPost['description']:null
			);
			// update to database
			if($this->mdl_salary_component->update($formData, $id) == true) {
				$this->session->set_flashdata('success', "Success, Salary component has been updated!");
			} else {
				$this->session->set_flashdata('error', "Error, Can't update the salary component!");
			}
			redirect('office/salary_component', 'refresh');
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
		if($this->mdl_salary_component->update($data, $id) == true) {
			$this->session->set_flashdata('success', "Success, Activated successfully!");
		} else {
			$this->session->set_flashdata('error', "Error, Can't activate!");
		}
		redirect('office/salary_component', 'refresh');
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
		if($this->mdl_salary_component->update($data, $id) == true) {
			$this->session->set_flashdata('success', "Success, Deactivated successfully!");
		} else {
			$this->session->set_flashdata('error', "Error, Can't deactivate!");
		}
		redirect('office/salary_component', 'refresh');
	}

	/**
	 * [Delete record from table.]
	 * @param  int $id [primary key]
	 * @return boolean
	 */
	public function delete()
	{
		$id = $this->input->post('primary_id');
		if($this->mdl_salary_component->delete($id) == true) {
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
		if($this->mdl_salary_component->force_delete($id) == true) {
			$this->session->set_flashdata('success', 'DELETED!');
		} else {
			$this->session->set_flashdata('error', 'ERROR!');
		}
		redirect('office/salary_component', 'refresh');
	}
}

/* End of file Salary_component.php */
/* Location: ./application/modules/office/controllers/Salary_component.php */