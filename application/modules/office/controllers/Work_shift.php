<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
 * ERP
 *
 * @author		Amit Kumar
 * @copyright	Copyright (c) 2018
 */

/**
 * Class Work_shift
 */

class Work_shift extends Base_Controller
{
	/**
	 * Work_shift_Controller constructor.
	 */
	public function __construct()
	{
		// controller constructor
		parent::__construct();
		$this->load->model('Mdl_work_shift', 'mdl_work_shift');
	}

	/**
	 * [Fetch all work shift.]
	 * @param  void
	 * @return view
	 */
	public function index()
	{
		$data['lists'] = $this->mdl_work_shift->get_all();
		$this->template->set('title', 'Work Shift List');
		$this->template->load('template', 'contents', 'work_shift/list', $data);
	}

	/**
	 * [Insert a new work shift.]
	 * @param  void
	 * @return redirect
	 */
	public function add()
	{
		$this->form_validation->set_rules('shift-name', 'shift name', 'required|trim|is_unique[work_shift.shift_name]');
		$this->form_validation->set_rules('start-time', 'shift start time', 'required|trim');
		$this->form_validation->set_rules('end-time', 'shift end time', 'required|trim');

		if($this->form_validation->run() == false) {
			$this->template->set('title', 'Add Work Shift');
			$this->template->load('template', 'contents', 'work_shift/add');
		} else {
			$post = $this->input->post(null, true);
			$cleanPost = $this->security->xss_clean($post);
			$formData = array(
				'shift_name' => $cleanPost['shift-name'],
				'shift_start' => $cleanPost['start-time'],
				'shift_end' => $cleanPost['end-time'],
				'description' => $cleanPost['description'] ? $cleanPost['description']:null
			);
			// insert to database
			if($this->mdl_work_shift->insert($formData) == true) {
				$this->session->set_flashdata('success', "Success, New work shift has been added!");
			} else {
				$this->session->set_flashdata('error', "Error, Can't add new work shift!");
			}
			redirect('office/work_shift', 'refresh');
		}
	}

	/**
	 * [Edit work shift detail and update.]
	 * @param  int $id [primary key]
	 * @return redirect
	 */
	public function edit($id) 
	{
		$this->form_validation->set_rules('shift-name', 'shift name', 'required|trim');
		$this->form_validation->set_rules('start-time', 'shift start time', 'required');
		$this->form_validation->set_rules('end-time', 'shift end time', 'required');

		if($this->form_validation->run() == false) {
			$data['info'] = $this->mdl_work_shift->get($id);
			$this->template->set('title', 'Edit Work Shift');
			$this->template->load('template', 'contents', 'work_shift/edit', $data);
		} else {
			$post = $this->input->post(null, true);
			$cleanPost = $this->security->xss_clean($post);
			$formData = array(
				'shift_name' => $cleanPost['shift-name'],
				'shift_start' => $cleanPost['start-time'],
				'shift_end' => $cleanPost['end-time'],
				'description' => $cleanPost['description'] ? $cleanPost['description']:null
			);
			// update to database
			if($this->mdl_work_shift->update($formData, $id) == true) {
				$this->session->set_flashdata('success', "Success, Work shift detail has been updated!");
			} else {
				$this->session->set_flashdata('error', "Error, Can't update work shift detail!");
			}
			redirect('office/work_shift', 'refresh');
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
		if($this->mdl_work_shift->update($data, $id) == true) {
			$this->session->set_flashdata('success', "Success, Activated successfully!");
		} else {
			$this->session->set_flashdata('error', "Error, Can't activate!");
		}
		redirect('office/work_shift', 'refresh');
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
		if($this->mdl_work_shift->update($data, $id) == true) {
			$this->session->set_flashdata('success', "Success, Deactivated successfully!");
		} else {
			$this->session->set_flashdata('error', "Error, Can't deactivate!");
		}
		redirect('office/work_shift', 'refresh');
	}

	/**
	 * [Delete record from table.]
	 * @param  int $id [primary key]
	 * @return boolean
	 */
	public function delete()
	{
		$id = $this->input->post('primary_id');
		if($this->mdl_work_shift->delete($id) == true) {
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
		if($this->mdl_work_shift->force_delete($id) == true) {
			$this->session->set_flashdata('success', 'DELETED!');
		} else {
			$this->session->set_flashdata('error', 'ERROR!');
		}
		redirect('office/work_shift', 'refresh');
	}
}

/* End of file Work_shift.php */
/* Location: ./application/modules/office/controllers/Work_shift.php */