<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
 * ERP
 *
 * @author		Amit Kumar
 * @copyright	Copyright (c) 2018
 */

/**
 * Class Roles
 */

class Roles extends Base_Controller
{
	/**
	 * Roles_Controller Constructor.
	 */
	public function __construct()
	{
		// controller constructor
		parent::__construct();
		$this->load->model('role', 'mdl_role');
	}

	/**
	 * [Fetch all roles list.]
	 * @param  void
	 * @return view
	 */
	public function index()
	{
		$data['lists'] = $this->mdl_role->get_all();
		$this->template->set('title', 'Role List');
		$this->template->load('template', 'contents', 'role/list', $data);
	}

	/**
	 * [Insert a new role record.]
	 * @param  void
	 * @return redirect
	 */
	public function add()
	{
		$this->form_validation->set_rules('role-name', 'role name', 'required|trim|is_unique[roles.role_name]');

		if($this->form_validation->run() == false) {
			$data['permissions'] = $this->mdl_permission->get_all();
			$this->template->set('title', 'Add Role');
			$this->template->load('template', 'contents', 'role/add', $data);
		} else {
			$post = $this->input->post(null, true);
			$cleanPost = $this->security->xss_clean($post);
			$formData = array(
				'role_name' => $cleanPost['role-name'],
				'description' => $cleanPost['description'] ? $cleanPost['description'] : null
			);
			$permissions = $this->input->post('permission');
			// insert to database
			if($this->mdl_role->insert_role($formData, $permissions) == true) {
				$this->session->set_flashdata('success', "Success, New role has been added!");
			} else {
				$this->session->set_flashdata('danger', "Error, Can't add new role!");
			}
			redirect('admin/roles', 'refresh');
		}
	}

	/**
	 * [Edit role details.]
	 * @param  int $id [primary key]
	 * @return redirect
	 */
	public function edit($id)
	{
		$this->form_validation->set_rules('role-name', 'role name', 'required|trim');

		if($this->form_validation->run() == false) {
			$data['info'] = $this->mdl_role->get($id);
			$data['permissions'] = $this->mdl_permission->get_all();
			$data['role_permissions'] = $this->mdl_role->get_permission_by_role($id);
			$this->template->set('title', 'Edit Role');
			$this->template->load('template', 'contents', 'role/edit', $data);
		} else {
			$post = $this->input->post(null, true);
			$cleanPost = $this->security->xss_clean($post);
			$formData = array(
				'role_name' => $cleanPost['role-name'],
				'description' => $cleanPost['description'] ? $cleanPost['description'] : null
			);
			$permissions = $this->input->post('permission');
			// update to database
			if($this->mdl_role->update_role($formData, $permissions, $id) == true) {
				$this->session->set_flashdata('success', "Success, Role has been updated!");
			} else {
				$this->session->set_flashdata('danger', "Error, Can't update the role!");
			}
			redirect('admin/roles', 'refresh');
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
		if($this->mdl_role->update($data, $id) == true) {
			$this->session->set_flashdata('success', "Success, Activated successfully!");
		} else {
			$this->session->set_flashdata('error', "Error, Can't activate!");
		}
		redirect('admin/roles', 'refresh');
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
		if($this->mdl_role->update($data, $id) == true) {
			$this->session->set_flashdata('success', "Success, Deactivated successfully!");
		} else {
			$this->session->set_flashdata('error', "Error, Can't deactivate!");
		}
		redirect('admin/roles', 'refresh');
	}

	/**
	 * [Delete record from list.]
	 * @param  void
	 * @return boolean
	 */
	public function delete()
	{
		$id = $this->input->post('primary_id');
		if($this->mdl_role->delete($id) == true) {
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
		if($this->mdl_role->force_delete($id) == true) {
			$this->session->set_flashdata('success', 'DELETED!');
		} else {
			$this->session->set_flashdata('error', 'ERROR!');
		}
		redirect('admin/roles', 'refresh');
	}
}

/* End of file Roles.php */
/* Location: ./application/modules/admin/controllers/Roles.php */