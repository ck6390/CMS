<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
 * ganga Memorial CMS
 *
 * @author		Vishwajeet Kumar
 * @copyright	Copyright (c) 2019
 */

/**
 * Class Subject_units
 */

class Subject_units extends Base_Controller
{
	/**
	 * Subjects_Controller constructor.
	 */
	public function __construct()
	{
		// controller constructor
		parent::__construct();
		$this->load->model('subject_unit'	, 'mdl_unit');
		$this->load->model('subject', 'mdl_subject');
		$this->load->module('setting/semesters');
	}

	/**
	 * [Fetch all Subject list.]
	 * @param  void
	 * @return view
	 */
	public function index()
	{
		$data['lists'] = $this->mdl_unit->get_all();
		$this->template->set('title', 'Subject List');
		$this->template->load('template', 'contents', 'subject_unit/subject_unit_list', $data);
	}

	/**
	 * [Insert a new fee Subject record.]
	 * @param  void
	 * @return redirect
	 */
	public function add()
	{
		$this->form_validation->set_rules('unit-number', 'unit number', 'required|trim|is_unique[subject_units.unit_number]');
		$this->form_validation->set_rules('description', 'description', 'trim');

		if($this->form_validation->run() == false) {
			$this->template->set('title', 'Add Unit');
			$this->template->load('template', 'contents', 'subject_unit/subject_unit_add');
		} else {
			$post = $this->input->post(null, true);
			$cleanPost = $this->security->xss_clean($post);
			$formData = array(
				'unit_number' => $cleanPost['unit-number'],
				'description' => $cleanPost['description'] ? $cleanPost['description'] : "",
				
			);
			// insert to database
			if($this->mdl_unit->insert($formData) == true) {
				$this->session->set_flashdata('success', "Success, New Unit has been added!");
			} else {
				$this->session->set_flashdata('danger', "Error, Can't add new Unit!");
			}
			redirect('academics/subject_units', 'refresh');
		}
	}

	/**
	 * [Edit subject details]
	 * @param  int $id [primary key]
	 * @return [type]     [description]
	 */
	public function edit($id) 
	{
		$this->form_validation->set_rules('unit-number', 'unit number', 'required|trim');
		$this->form_validation->set_rules('description', 'description', 'trim');

		if($this->form_validation->run() == false) {
			$data['info'] = $this->mdl_unit->get($id);
			$this->template->set('title', 'Edit Subject');
			$this->template->load('template', 'contents', 'subject_unit/subject_unit_edit', $data);
		} else {
			$post = $this->input->post(null, true);
			$cleanPost = $this->security->xss_clean($post);
			$formData = array(
				'unit_number' => $cleanPost['unit-number'],
				'description' => $cleanPost['description'] ? $cleanPost['description'] : "",
				
			);
			
			// update to database
			if($this->mdl_unit->update($formData, $id) == true) {
				$this->session->set_flashdata('success', "Success, Unit has been updated!");
			} else {
				$this->session->set_flashdata('error', "Error, Can't update the unit!");
			}
			redirect('academics/subject_units', 'refresh');
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
		if($this->mdl_subject->update($data, $id) == true) {
			$this->session->set_flashdata('success', "Success, Activated successfully!");
		} else {
			$this->session->set_flashdata('error', "Error, Can't activate!");
		}
		redirect('academics/subjects', 'refresh');
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
		if($this->mdl_subject->update($data, $id) == true) {
			$this->session->set_flashdata('success', "Success, Deactivated successfully!");
		} else {
			$this->session->set_flashdata('error', "Error, Can't deactivate!");
		}
		redirect('academics/subjects', 'refresh');
	}

	/**
	 * [Delete record from list.]
	 * @param  void
	 * @return boolean
	 */
	public function delete()
	{
		$id = $this->input->post('primary_id');
		if($this->mdl_subject->delete($id) == true) {
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
		if($this->mdl_subject->force_delete($id) == true) {
			$this->session->set_flashdata('success', 'DELETED!');
		} else {
			$this->session->set_flashdata('error', 'ERROR!');
		}
		redirect('academics/subjects', 'refresh');
	}
}

/* End of file Subject_units.php */
/* Location: ./application/modules/academics/controllers/Subject_units.php */