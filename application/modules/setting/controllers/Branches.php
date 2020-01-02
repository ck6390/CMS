<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
 * Ganga Memorial CMS
 *
 * @author		Vishwajeet Kumar
 * @copyright	Copyright (c) 2019
 */

/**
 * Class Branches
 */

class Branches extends Base_Controller
{
	/**
	 * Branch_Controller constructor.
	 */
	public function __construct()
	{
		// controller constructor
		parent::__construct();
		$this->load->model('branch', 'mdl_branch');
		$this->load->module('setting/semesters');
	}

	/**
	 * [Fetch all branch list.]
	 * @param  void
	 * @return view
	 */
	public function index()
	{
		$data['lists'] = $this->mdl_branch->get_all();
		$this->template->set('title', 'Branch List');
		$this->template->load('template', 'contents', 'branch/branch_list', $data);
	}

	/**
	 * [Insert a new branch record.]
	 * @param  void
	 * @return redirect
	 */
	public function add()
	{
		$this->form_validation->set_rules('branch-name', 'Branch name', 'required|is_unique[branches.branch_name]');
		$this->form_validation->set_rules('branch-code', 'Branch code', 'required|is_unique[branches.branch_code]');

		if($this->form_validation->run() == false) {
			$this->template->set('title', 'Add Branch');
			$this->template->load('template', 'contents', 'branch/branch_add');
		} else {
			$post = $this->input->post(null, true);
			$cleanPost = $this->security->xss_clean($post);
			$formData = array(
				'branch_name' => $cleanPost['branch-name'],
				'branch_code' => strtoupper($cleanPost['branch-code']),
				'description' => $cleanPost['description'] ? $cleanPost['description'] : null
			);

			// insert to database
			if($this->mdl_branch->insert($formData) == true) {
				$this->session->set_flashdata('success', "Success, New Branch has been added!");
			} else {
				$this->session->set_flashdata('danger', "Error, Can't add new Branch!");
			}
			redirect('setting/branches', 'refresh');
		}
	}

	/**
	 * [Edit branch details]
	 * @param  int $id [primary key]
	 * @return [type]     [description]
	 */
	public function edit($id) 
	{
		$this->form_validation->set_rules('branch-name', 'branch name', 'required|trim');
		$this->form_validation->set_rules('branch-code', 'branch code', 'required|trim');

		if($this->form_validation->run() == false) {
			$data['info'] = $this->mdl_branch->get($id);
			$this->template->set('title', 'Edit Branch');
			$this->template->load('template', 'contents', 'branch/branch_edit', $data);
		} else {
			$post = $this->input->post(null, true);
			$cleanPost = $this->security->xss_clean($post);
			$formData = array(
				'branch_name' => $cleanPost['branch-name'],
				'branch_code' => strtoupper($cleanPost['branch-code']),
				'description' => $cleanPost['description'] ? $cleanPost['description'] : null
			);
			// update to database
			if($this->mdl_branch->update($formData, $id) == true) {
				$this->session->set_flashdata('success', "Success, Branch has been updated!");
			} else {
				$this->session->set_flashdata('error', "Error, Can't update the Branch!");
			}
			redirect('setting/branches', 'refresh');
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
		if($this->mdl_branch->update($data, $id) == true) {
			$this->session->set_flashdata('success', "Success, Activated successfully!");
		} else {
			$this->session->set_flashdata('error', "Error, Can't activate!");
		}
		redirect('setting/branches', 'refresh');
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
		if($this->mdl_branch->update($data, $id) == true) {
			$this->session->set_flashdata('success', "Success, Deactivated successfully!");
		} else {
			$this->session->set_flashdata('error', "Error, Can't deactivate!");
		}
		redirect('setting/branches', 'refresh');
	}

	/**
	 * [Delete record from list.]
	 * @param  void
	 * @return boolean
	 */
	public function delete()
	{
		$id = $this->input->post('primary_id');
		if($this->mdl_branch->delete($id) == true) {
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
		if($this->mdl_branch->force_delete($id) == true) {
			$this->session->set_flashdata('success', 'DELETED!');
		} else {
			$this->session->set_flashdata('error', 'ERROR!');
		}
		redirect('setting/branches', 'refresh');
	}

	/**
	 * [Get Branch id by branch code]
	 * @param  int $id [primary key]
	 * @return redirect
	 */
	// public function get_id($branch)
	// {
	// 	print_r($branch); exit;
	// 	$this->db->select('branch_p_id');
	// 	$this->db->where('branch_code', $branch);
	// 	if($query = $this->db->get('branches')){
	// 		return $query->result_array();
	// 	}else{
	// 		return false;
	// 	}

	// }
}

/* End of file Branches.php */
/* Location: ./application/modules/setting/controllers/Branches.php */