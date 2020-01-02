<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
 * Ganga Memorial CMS
 *
 * @author		Vishwajeet Kumar
 * @copyright	Copyright (c) 2019
 */

/**
 * Class Semesters
 */

class Cast_categories extends Base_Controller
{
	/**
	 * Semester_Controller constructor.
	 */
	public function __construct()
	{
		// controller constructor
		parent::__construct();
		$this->load->model('Cast_category', 'mdl_cast_category');
		$this->load->dbforge();
	}

	/**
	 * [Fetch all semester list.]
	 * @param  void
	 * @return view
	 */
	public function index()
	{	
		$data['lists'] = $this->mdl_cast_category->get_all();
		$this->template->set('title', 'Cast Categories List');
		$this->template->load('template', 'contents', 'cast_category/cast_category_list', $data);
	}

	/**
	 * [Insert a new Semester record.]
	 * @param  void
	 * @return redirect
	 */
	public function add()
	{
		$this->form_validation->set_rules('cast-category', 'cast category', 'required|trim|is_unique[cast_categories.cast_category]');

		if($this->form_validation->run() == false) {
			$this->template->set('title', 'Add Cast Category');
			$this->template->load('template', 'contents', 'cast_category/cast_category_add');
		} else {
			$post = $this->input->post(null, true);
			$cleanPost = $this->security->xss_clean($post);
			$formData = array(
				'cast_category' => $cleanPost['cast-category'],
				'description' => $cleanPost['description'] ? $cleanPost['description'] : null
			);
			// print_r($formData);
			// exit;
			// insert to database
			if($this->mdl_cast_category->insert($formData) == true) {
				$this->session->set_flashdata('success', "Success, New Cast Category has been added!");
			} else {
				$this->session->set_flashdata('danger', "Error, Can't add new Cast Category!");
			}
			redirect('setting/cast_categories', 'refresh');
		}
	}

	/**
	 * [Edit semester details]
	 * @param  int $id [primary key]
	 * @return [type]     [description]
	 */
	public function edit($id) 
	{
		$this->form_validation->set_rules('cast-category', 'cast category', 'required|trim');

		if($this->form_validation->run() == false) {
			$data['info'] = $this->mdl_cast_category->get($id);
			$this->template->set('title', 'Edit Cast Category');
			$this->template->load('template', 'contents', 'cast_category/cast_category_edit', $data);
		} else {
			$post = $this->input->post(null, true);
			$cleanPost = $this->security->xss_clean($post);
			$formData = array(
				'cast_category' => $cleanPost['cast-category'],
				'description' => $cleanPost['description'] ? $cleanPost['description'] : null
			);

			// print_r($formData);
			// exit;

			// update to database
			if($this->mdl_cast_category->update($formData, $id) == true) {
				$this->session->set_flashdata('successe', "Success, Semester has been updated!");
			} else {
				$this->session->set_flashdata('error', "Error, Can't update the semester!");
			}
			redirect('setting/cast_categories', 'refresh');
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
		if($this->mdl_cast_category->update($data, $id) == true) {
			$this->session->set_flashdata('success', "Success, Activated successfully!");
		} else {
			$this->session->set_flashdata('error', "Error, Can't activate!");
		}
		redirect('setting/cast_categories', 'refresh');
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
		if($this->mdl_cast_category->update($data, $id) == true) {
			$this->session->set_flashdata('success', "Success, Deactivated successfully!");
		} else {
			$this->session->set_flashdata('error', "Error, Can't deactivate!");
		}
		redirect('setting/cast_categories', 'refresh');
	}

	/**
	 * [Delete record from list.]
	 * @param  void
	 * @return boolean
	 */
	public function delete()
	{
		$id = $this->input->post('primary_id');
		if($this->mdl_cast_category->delete($id) == true) {
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
		if($this->mdl_cast_category->force_delete($id) == true) {
			$this->session->set_flashdata('success', 'DELETED!');
		} else {
			$this->session->set_flashdata('error', 'ERROR!');
		}
		redirect('setting/cast_categories', 'refresh');
	}
}

/* End of file cast_categories.php */
/* Location: ./application/modules/setting/controllers/cast_categories.php */