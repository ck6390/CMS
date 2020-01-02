<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
 * ERP
 *
 * @author		Amit Kumar
 * @copyright	Copyright (c) 2018
 */

/**
 * Class Department
 */

class Department extends Base_Controller
{
	/**
	 * Department_Controller constructor.
	 */
	public function __construct()
	{
		// controller constructor
		parent::__construct();
		$this->load->model('Mdl_department', 'mdl_dept');
	}

	/**
	 * [Fetch all department list.]
	 * @param  void
	 * @return view
	 */
	public function index()
	{
		$data['lists'] = $this->mdl_dept->get_all();
		$this->template->set('title', 'Department List');
		$this->template->load('template', 'contents', 'department/list', $data);
	}
    
	/**
	 * [Insert a new department record.]
	 * @param  void
	 * @return redirect
	 */
	public function add()
	{
		$this->form_validation->set_rules('department-name', 'department name', 'required|trim|is_unique[departments.dept_name]');

		if($this->form_validation->run() == false) {
			$this->template->set('title', 'Add Department');
			$this->template->load('template', 'contents', 'department/add');
		} else {
			$post = $this->input->post(null, true);
			$cleanPost = $this->security->xss_clean($post);
			$formData = array(
				'dept_name' => $cleanPost['department-name'],
				'description' => $cleanPost['description'] ? $cleanPost['description']:null
			);
			// insert to database
			if($this->mdl_dept->insert($formData) == true) {
				$this->session->set_flashdata('success', "Success, New department has been added!");
			} else {
				$this->session->set_flashdata('error', "Error, Can't add new department!");
			}
			redirect('office/department', 'refresh');
		}
	}

	/**
	 * [Edit department detail and update.]
	 * @param  int $id [primary key]
	 * @return redirect
	 */
	public function edit($id) 
	{
		$this->form_validation->set_rules('department-name', 'department name', 'required|trim');

		if($this->form_validation->run() == false) {
			$data['info'] = $this->mdl_dept->get($id);
			$this->template->set('title', 'Edit Department');
			$this->template->load('template', 'contents', 'department/edit', $data);
		} else {
			$post = $this->input->post(null, true);
			$cleanPost = $this->security->xss_clean($post);
			$formData = array(
				'dept_name' => $cleanPost['department-name'],
				'description' => $cleanPost['description'] ? $cleanPost['description']:null
			);
			// update to database
			if($this->mdl_dept->update($formData, $id) == true) {
				$this->session->set_flashdata('success', "Success, Department has been updated!");
			} else {
				$this->session->set_flashdata('error', "Error, Can't update the department!");
			}
			redirect('office/department', 'refresh');
		}
	}
	
	/**
	 * [Activate status.]
	 * @param  int $id [primary key]
	 * @return redirect
	 */
	public function activate($id)
	{
		if($this->mdl_dept->activate_department($id) == true) {
			$this->session->set_flashdata('success', "Success, Activated successfully!");
		} else {
			$this->session->set_flashdata('error', "Error, Can't activate!");
		}
		redirect('office/department', 'refresh');
	}

	/**
	 * [Deactivate status.]
	 * @param  int $id [primary key]
	 * @return redirect
	 */
	public function deactivate($id)
	{
		if($this->mdl_dept->deactivate_department($id) == true) {
			$this->session->set_flashdata('success', "Success, Deactivated successfully!");
		} else {
			$this->session->set_flashdata('error', "Error, Can't deactivate!");
		}
		redirect('office/department', 'refresh');
	}

	/**
	 * [Delete record from table.]
	 * @param  int $id [primary key]
	 * @return boolean
	 */
	public function delete()
	{
		$id = $this->input->post('primary_id');
		if($this->mdl_dept->delete_department($id) == true) {
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
		if($this->mdl_dept->force_delete($id) == true) {
			$this->session->set_flashdata('success', 'DELETED!');
		} else {
			$this->session->set_flashdata('error', 'ERROR!');
		}
		redirect('office/department', 'refresh');
	}
}

/* End of file Department.php */
/* Location: ./application/modules/office/controllers/Department.php */	