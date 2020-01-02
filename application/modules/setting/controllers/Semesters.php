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

class Semesters extends Base_Controller
{
	/**
	 * Semester_Controller constructor.
	 */
	public function __construct()
	{
		// controller constructor
		parent::__construct();
		$this->load->model('Semester', 'mdl_semester');
	}

	/**
	 * [Fetch all semester list.]
	 * @param  void
	 * @return view
	 */
	public function index()
	{
		$data['lists'] = $this->mdl_semester->get_all();
		$this->template->set('title', 'Semester List');
		$this->template->load('template', 'contents', 'semester/semester_list', $data);
	}

	/**
	 * [Insert a new Semester record.]
	 * @param  void
	 * @return redirect
	 */
	public function add()
	{
		$this->form_validation->set_rules('semester-name', 'Semester Name', 'required|trim|is_unique[semesters.semester_name]');

		if($this->form_validation->run() == false) {
			$this->template->set('title', 'Add Semester');
			$this->template->load('template', 'contents', 'semester/semester_add');
		} else {
			$post = $this->input->post(null, true);
			$cleanPost = $this->security->xss_clean($post);
			$formData = array(
				'semester_name' => $cleanPost['semester-name'],
				'description' => $cleanPost['description'] ? $cleanPost['description'] : null
			);
			
			// insert to database
			if($this->mdl_semester->insert($formData) == true) {
				$this->session->set_flashdata('success', "Success, New Semester has been added!");
			} else {
				$this->session->set_flashdata('danger', "Error, Can't add new Semester!");
			}
			redirect('setting/semesters', 'refresh');
		}
	}

	/**
	 * [Edit semester details]
	 * @param  int $id [primary key]
	 * @return [type]     [description]
	 */
	public function edit($id) 
	{
		$this->form_validation->set_rules('semester-name', 'semester name', 'required|trim');

		if($this->form_validation->run() == false) {
			$data['info'] = $this->mdl_semester->get($id);
			$this->template->set('title', 'Edit Semester');
			$this->template->load('template', 'contents', 'semester/semester_edit', $data);
		} else {
			$post = $this->input->post(null, true);
			$cleanPost = $this->security->xss_clean($post);
			$formData = array(
				'semester_name' => $cleanPost['semester-name'],
				'description' => $cleanPost['description'] ? $cleanPost['description'] : null
			);
			// update to database
			if($this->mdl_semester->update($formData, $id) == true) {
				$this->session->set_flashdata('successe', "Success, Semester has been updated!");
			} else {
				$this->session->set_flashdata('error', "Error, Can't update the semester!");
			}
			redirect('setting/semesters', 'refresh');
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
		if($this->mdl_semester->update($data, $id) == true) {
			$this->session->set_flashdata('success', "Success, Activated successfully!");
		} else {
			$this->session->set_flashdata('error', "Error, Can't activate!");
		}
		redirect('setting/semesters', 'refresh');
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
		if($this->mdl_semester->update($data, $id) == true) {
			$this->session->set_flashdata('success', "Success, Deactivated successfully!");
		} else {
			$this->session->set_flashdata('error', "Error, Can't deactivate!");
		}
		redirect('setting/semesters', 'refresh');
	}

	/**
	 * [Delete record from list.]
	 * @param  void
	 * @return boolean
	 */
	public function delete()
	{
		$id = $this->input->post('primary_id');
		if($this->mdl_semester->delete($id) == true) {
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
		if($this->mdl_semester->force_delete($id) == true) {
			$this->session->set_flashdata('success', 'DELETED!');
		} else {
			$this->session->set_flashdata('error', 'ERROR!');
		}
		redirect('setting/semesters', 'refresh');
	}
}

/* End of file Semesters.php */
/* Location: ./application/modules/setting/controllers/Semesters.php */