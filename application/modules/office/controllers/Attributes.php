<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
 * ERP
 *
 * @author		Amit Kumar
 * @copyright	Copyright (c) 2018
 */

/**
 * Class Attributes
 */

class Attributes extends Base_Controller
{
	/**
	 * Work_shift_Controller constructor.
	 */
	public function __construct()
	{
		// controller constructor
		parent::__construct();
		$this->load->model('Attribute', 'mdl_attribute');
	}

	/**
	 * [Fetch all work shift.]
	 * @param  void
	 * @return view
	 */
	public function index()
	{
		$data['lists'] = $this->mdl_attribute->get_all();
		$this->template->set('title', 'Employee Attribute List');
		$this->template->load('template', 'contents', 'attribute/list', $data);
	}

	/**
	 * [Insert a new work shift.]
	 * @param  void
	 * @return redirect
	 */
	public function add()
	{
		$this->form_validation->set_rules('attribute-name', 'attribute name', 'required|trim');
		$this->form_validation->set_rules('max-score', 'max score', 'required|trim');
		

		if($this->form_validation->run() == false) {
			$this->template->set('title', 'Add Attribute');
			$this->template->load('template', 'contents', 'attribute/add');
		} else {
			$post = $this->input->post(null, true);
			$cleanPost = $this->security->xss_clean($post);
			$formData = array(
				'attribute_name' => $cleanPost['attribute-name'],
				'attribute_max_score' => $cleanPost['max-score'],
			);
			// insert to database
			if($this->mdl_attribute->insert($formData) == true) {
				$this->session->set_flashdata('success', "Success, New Attribute has been added!");
			} else {
				$this->session->set_flashdata('error', "Error, Can't add new attribute!");
			}
			redirect('office/attributes', 'refresh');
		}
	}

	/**
	 * [Edit work shift detail and update.]
	 * @param  int $id [primary key]
	 * @return redirect
	 */
	public function edit($id) 
	{
		$this->form_validation->set_rules('attribute-name', 'attribute name', 'required|trim');
		$this->form_validation->set_rules('max-score', 'max score', 'required|trim');

		if($this->form_validation->run() == false) {
			$data['info'] = $this->mdl_attribute->get($id);
			$this->template->set('title', 'Edit Attribute');
			$this->template->load('template', 'contents', 'attribute/edit', $data);
		} else {
			$post = $this->input->post(null, true);
			$cleanPost = $this->security->xss_clean($post);
			$formData = array(
				'attribute_name' => $cleanPost['attribute-name'],
				'attribute_max_score' => $cleanPost['max-score'],
			);
			// update to database
			if($this->mdl_attribute->update($formData, $id) == true) {
				$this->session->set_flashdata('success', "Success, Attribute has been updated!");
			} else {
				$this->session->set_flashdata('error', "Error, Can't update attribute!");
			}
			redirect('office/attributes', 'refresh');
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
		if($this->mdl_attribute->update($data, $id) == true) {
			$this->session->set_flashdata('success', "Success, Activated successfully!");
		} else {
			$this->session->set_flashdata('error', "Error, Can't activate!");
		}
		redirect('office/attributes', 'refresh');
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
		if($this->mdl_attribute->update($data, $id) == true) {
			$this->session->set_flashdata('success', "Success, Deactivated successfully!");
		} else {
			$this->session->set_flashdata('error', "Error, Can't deactivate!");
		}
		redirect('office/attributes', 'refresh');
	}

	/**
	 * [Delete record from table.]
	 * @param  int $id [primary key]
	 * @return boolean
	 */
	public function delete()
	{
		$id = $this->input->post('primary_id');
		if($this->mdl_attribute->delete($id) == true) {
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
		if($this->mdl_attribute->force_delete($id) == true) {
			$this->session->set_flashdata('success', 'DELETED!');
		} else {
			$this->session->set_flashdata('error', 'ERROR!');
		}
		redirect('office/attributes', 'refresh');
	}
}

/* End of file Attributes.php */
/* Location: ./application/modules/office/controllers/Attributes.php */