<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
 * Ganga Memorial CMS
 *
 * @author		Vishwajeet Kumar
 * @copyright	Copyright (c) 2019
 */

/**
 * Class Course Years
 */

class Course_years extends Base_Controller
{
	/**
	 * Course_years Controller constructor.
	 */
	public function __construct()
	{
		// controller constructor
		parent::__construct();
		$this->load->model('course_year', 'mdl_course_year');
		$this->load->module('setting/semesters');
	}

	/**
	 * Fetch all course year list.
	 * @return void [load view page]
	 */
	public function index()
	{
		$data['lists'] = $this->mdl_course_year->get_all();
		$this->template->set('title', 'Course Year List');
		$this->template->load('template', 'contents', 'course_year/list', $data);
	}

	/**
	 * Insert new record.
	 * @return void [load view page]
	 */
	public function add()
	{
		$this->form_validation->set_rules('course-year', 'Course year', 'required|trim|is_unique[course_years.course_year_name]');

		if($this->form_validation->run() == false) {
			$this->template->set('title', 'Add Course Year');
			$this->template->load('template', 'contents', 'course_year/add');
		} else {
			$post = $this->input->post(null, true);
			$cleanPost = $this->security->xss_clean($post); 
			$formData = array(
				'course_year_name' => $cleanPost['course-year'],
				'description' => $cleanPost['description'] ? $cleanPost['description'] : null
			);
			
			//var_dump($formData); exit();
			// insert to database
			if($this->mdl_course_year->insert($formData) == true) {
				$this->session->set_flashdata('success', "Success, New Year of Course has been added!");
			} else {
				$this->session->set_flashdata('danger', "Error, Can't add new year!");
			}
			redirect('setting/Course_years', 'refresh');
		}
	}

	/**
	 * Edit record and update.
	 * @param  int $id [primary key]
	 * @return void [load view page]
	 */
	public function edit($id)
	{
		$this->form_validation->set_rules('course-year', 'Course year', 'required|trim');
		

		if($this->form_validation->run() == false) {
			$data['info'] = $this->mdl_course_year->get($id);
			$this->template->set('title', 'Edit Course Year');
			$this->template->load('template', 'contents', 'course_year/edit', $data);
		} else {
			$post = $this->input->post(null, true);
			$cleanPost = $this->security->xss_clean($post); 
			$formData = array(
				'course_year_name' => $cleanPost['course-year'],
				'description' => $cleanPost['description'] ? $cleanPost['description'] : null
			);
			
			// update to database
			if($this->mdl_course_year->update($formData, $id) == true) {
				$this->session->set_flashdata('success', "Success, Course Year has been updated!");
			} else {
				$this->session->set_flashdata('error', "Error, Can't update the Course Year!");
			}
			redirect('setting/Course_years', 'refresh');
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
		if($this->mdl_course_year->update($data, $id) == true) {
			$this->session->set_flashdata('success', "Success, Activated successfully!");
		} else {
			$this->session->set_flashdata('error', "Error, Can't activate!");
		}
		redirect('setting/Course_years', 'refresh');
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
		if($this->mdl_course_year->update($data, $id) == true) {
			$this->session->set_flashdata('success', "Success, Deactivated successfully!");
		} else {
			$this->session->set_flashdata('error', "Error, Can't deactivate!");
		}
		redirect('setting/Course_years', 'refresh');
	}

	/**
	 * [Delete record from list.]
	 * @param  void
	 * @return boolean
	 */
	public function delete()
	{
		$id = $this->input->post('primary_id');
		if($this->mdl_course_year->delete($id) == true) {
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
		if($this->mdl_course_year->force_delete($id) == true) {
			$this->session->set_flashdata('success', 'DELETED!');
		} else {
			$this->session->set_flashdata('error', 'ERROR!');
		}
		redirect('setting/Course_years', 'refresh');
	}
}

/* End of file Course_years.php */
/* Location: ./application/modules/setting/controllers/Course_years.php */
