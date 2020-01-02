<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
 * ERP
 *
 * @author		Amit Kumar
 * @copyright	Copyright (c) 2018
 */

/**
 * Class Permissions
 */

class Permissions extends Base_Controller
{
	/**
	 * Permissions_Controller constructor.
	 */
	public function __construct()
	{
		// controller constructor
		parent::__construct();
		$this->load->model('Permission', 'mdl_permission');
	}

	/**
	 * [Fetch all permission list.]
	 * @param  void
	 * @return view
	 */
	public function index()
	{
		$data['lists'] = $this->mdl_permission->get_all();
		$this->template->set('title', 'Permission List');
		$this->template->load('template', 'contents', 'permission/list', $data);
	}

	/**
	 * [Insert a new permission record.]
	 * @param  void
	 * @return redirect
	 */
	public function add()
	{
		$this->form_validation->set_rules('permission-value', 'permission value', 'required|trim|is_unique[permissions.permission_name]');
		$this->form_validation->set_rules('display-name', 'display name', 'required|trim');
		$this->form_validation->set_rules('module-name', 'module name', 'required|trim');

		if($this->form_validation->run() == false) {
			$this->template->set('title', 'Add Permission');
			$this->template->load('template', 'contents', 'permission/add');
		} else {
			$post = $this->input->post(null, true);
			$cleanPost = $this->security->xss_clean($post);
			$formData = array(
				'permission_name' => $cleanPost['permission-value'],
				'module_name' => $cleanPost['module-name'],
				'display_name' => $cleanPost['display-name']
			);
			// insert to database
			if($this->mdl_permission->insert($formData) == true) {
				$this->session->set_flashdata('success', "Success, New permission has been added!");
			} else {
				$this->session->set_flashdata('danger', "Error, Can't add new permission!");
			}
			redirect('admin/permissions', 'refresh');
		}
	}

	/**
	 * [Edit permission details.]
	 * @param  int $id [primary key]
	 * @return redirect
	 */
	public function edit($id) 
	{
		$this->form_validation->set_rules('permission-value', 'permission value', 'required|trim');
		$this->form_validation->set_rules('display-name', 'display name', 'required|trim');
		$this->form_validation->set_rules('module-name', 'module name', 'required|trim');

		if($this->form_validation->run() == false) {
			$data['info'] = $this->mdl_permission->get($id);
			$this->template->set('title', 'Edit Permission');
			$this->template->load('template', 'contents', 'permission/edit', $data);
		} else {
			$post = $this->input->post(null, true);
			$cleanPost = $this->security->xss_clean($post);
			$formData = array(
				'permission_name' => $cleanPost['permission-value'],
				'module_name' => $cleanPost['module-name'],
				'display_name' => $cleanPost['display-name']
			);
			// update to database
			if($this->mdl_permission->update($formData, $id) == true) {
				$this->session->set_flashdata('successe', "Success, Permission has been updated!");
			} else {
				$this->session->set_flashdata('error', "Error, Can't update the permission!");
			}
			redirect('admin/permissions', 'refresh');
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
		if($this->mdl_permission->update($data, $id) == true) {
			$this->session->set_flashdata('success', "Success, Activated successfully!");
		} else {
			$this->session->set_flashdata('error', "Error, Can't activate!");
		}
		redirect('admin/permissions', 'refresh');
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
		if($this->mdl_permission->update($data, $id) == true) {
			$this->session->set_flashdata('success', "Success, Deactivated successfully!");
		} else {
			$this->session->set_flashdata('error', "Error, Can't deactivate!");
		}
		redirect('admin/permissions', 'refresh');
	}

	/**
	 * [Delete record from list.]
	 * @param  void
	 * @return boolean
	 */
	public function delete()
	{
		$id = $this->input->post('primary_id');
		if($this->mdl_permission->delete($id) == true) {
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
		if($this->mdl_permission->force_delete($id) == true) {
			$this->session->set_flashdata('success', 'DELETED!');
		} else {
			$this->session->set_flashdata('error', 'ERROR!');
		}
		redirect('admin/permissions', 'refresh');
	}
}

/* End of file Permissions.php */
/* Location: ./application/modules/admin/controllers/Permissions.php */