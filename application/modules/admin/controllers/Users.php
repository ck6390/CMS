<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
 * ERP
 *
 * @author		Amit Kumar
 * @copyright	Copyright (c) 2018
 */

/**
 * Class Users
 */

class Users extends Base_Controller
{
	/**
	 * Users_Controller constructor.
	 */
	public function __construct()
	{
		// controller constructor
		parent::__construct();
		$this->load->model('user', 'mdl_user');
	}

	/**
	 * [Fetch all admin list.]
	 * @param  void
	 * @return view
	 */
	public function index()
	{
		$data['lists'] = $this->mdl_user->get_all();
		$this->template->set('title', 'User List');
		$this->template->load('template', 'contents', 'user/list', $data);
	}

	/**
	 * [Insert a new admin record.]
	 * @param  void
	 * @return redirect
	 */
	public function add()
	{
		$this->form_validation->set_rules('full-name', 'name', 'required|trim');
		$this->form_validation->set_rules('email', 'email', 'required|valid_email|is_unique[users.user_email]');
		$this->form_validation->set_rules('password', 'password', 'required|trim|min_length[8]|max_length[15]');
		$this->form_validation->set_rules('confpass', 'confirm password', 'required|trim|matches[password]');
		$this->form_validation->set_rules('role', 'role', 'required|trim');

		if($this->form_validation->run() == false) {
			$this->template->set('title', 'Add User');
			$this->template->load('template', 'contents', 'user/add');
		} else {
			$this->load->library('password');
			$post = $this->input->post(null, true);
			$cleanPost = $this->security->xss_clean($post);
			$hashed = $this->password->create_hash($cleanPost['password']);
			$formData = array(
				'user_full_name' => $cleanPost['full-name'],
				'user_email' => $cleanPost['email'],
				'password' => $hashed,
				'user_role_id' => $cleanPost['role'],
				'is_developer' => isset($_POST['developer']) ? $cleanPost['developer'] : '0'
			);
			unset($cleanPost['confpass']);
			// insert to database
			if($this->mdl_user->insert($formData) == true) {
				$this->session->set_flashdata('success', "Success, New user has been added!");
			} else {
				$this->session->set_flashdata('danger', "Error, Can't add new user!");
			}
			redirect('admin/users', 'refresh');
		}
	}

	/**
	 * [Edit employee details]
	 * @param  int $id [primary key]
	 * @return [type]     [description]
	 */
	public function edit($id) 
	{
		$this->form_validation->set_rules('full-name', 'full name', 'required|trim');
		$this->form_validation->set_rules('email', 'email', 'required|trim|valid_email');
		$this->form_validation->set_rules('role', 'role', 'required|trim');
		$this->form_validation->set_rules('password', 'password', 'required|trim|min_length[8]|max_length[16]');
		$this->form_validation->set_rules('confpass', 'confirm password', 'required|trim|matches[password]');
		if($this->form_validation->run() == false) {
			$data['info'] = $this->mdl_user->get($id);
			$this->template->set('title', 'Edit User');
			$this->template->load('template', 'contents', 'user/edit', $data);
		} else {
			$this->load->library('password');
			$post = $this->input->post(null, true);
			$cleanPost = $this->security->xss_clean($post);
			$hashed = $this->password->create_hash($cleanPost['password']);
			$formData = array(
				'user_full_name' => $cleanPost['full-name'],
				'user_email' => $cleanPost['email'],
				'user_role_id' => $cleanPost['role'],
				'password' => $hashed,
				'is_developer' => isset($_POST['developer']) ? $cleanPost['developer'] : '0'
			);
		
			// update to database
			if($this->mdl_user->update($formData, $id) == true) {
				$this->session->set_flashdata('successe', "Success, User has been updated!");
			} else {
				$this->session->set_flashdata('error', "Error, Can't update the user!");
			}
			redirect('admin/users', 'refresh');
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
		if($this->mdl_user->update($data, $id) == true) {
			$this->session->set_flashdata('success', "Success, Activated successfully!");
		} else {
			$this->session->set_flashdata('error', "Error, Can't activate!");
		}
		redirect('admin/users', 'refresh');
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
		if($this->mdl_user->update($data, $id) == true) {
			$this->session->set_flashdata('success', "Success, Deactivated successfully!");
		} else {
			$this->session->set_flashdata('error', "Error, Can't deactivate!");
		}
		redirect('admin/users', 'refresh');
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
		redirect('admin/users', 'refresh');
	}
}

/* End of file Users.php */
/* Location: ./application/modules/admin/controllers/Users.php */