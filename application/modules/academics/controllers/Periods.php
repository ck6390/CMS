<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
 * ganga Memorial CMS
 *
 * @author		Vishwajeet Kumar
 * @copyright	Copyright (c) 2019
 */

/**
 * Class Periods
 */

class Periods extends Base_Controller
{
	/**
	 * Academic Period constructor.
	 */
	public function __construct()
	{
		// controller constructor
		parent::__construct();
		$this->load->model('period', 'mdl_period');
		$this->load->module('setting/semesters');
	}

	/**
	 * [Fetch all Period list.]
	 * @param  void
	 * @return view
	 */
	public function index()
	{
		$data['lists'] = $this->mdl_period->get_all();
		$this->template->set('title', 'Period List');
		$this->template->load('template', 'contents', 'period/period_list', $data);
	}

	/**
	 * [Insert a new period record.]
	 * @param  void
	 * @return redirect
	 */
	public function add()
	{
		$this->form_validation->set_rules('period-name', 'Period Name', 'required|trim|is_unique[periods.period_name]');
		
		if($this->form_validation->run() == false) {
			$this->template->set('title', 'Add Period');
			$this->template->load('template', 'contents', 'period/period_add');
		} else {
			$post = $this->input->post(null, true);
			$cleanPost = $this->security->xss_clean($post);
			$formData = array(
				'period_name' => $cleanPost['period-name'],
				'period_desc' => $cleanPost['description'] ? $cleanPost['description']: Null
			);
			// insert to database
			if($this->mdl_period->insert($formData) == true) {
				$this->session->set_flashdata('success', "Success, New Period has been added!");
			} else {
				$this->session->set_flashdata('error', "Error, Can't add new Period!");
			}
			redirect('academics/periods', 'refresh');
		}
	}

	/**
	 * [Edit period details]
	 * @param  int $id [primary key]
	 * @return [type]     [description]
	 */
	public function edit($id) 
	{
		$this->form_validation->set_rules('period-name', 'Period Name', 'required|trim');
		
		if($this->form_validation->run() == false) {
			$data['info'] = $this->mdl_period->get($id);
			$this->template->set('title', 'Edit Period');
			$this->template->load('template', 'contents', 'period/period_edit', $data);
		} else {
			$post = $this->input->post(null, true);
			$cleanPost = $this->security->xss_clean($post);
			$formData = array(
				'period_name' => $cleanPost['period-name'],
				
				'period_desc' => $cleanPost['description'] ? $cleanPost['description']: Null
			);
			// update to database
			if($this->mdl_period->update($formData, $id) == true) {
				$this->session->set_flashdata('success', "Success, Period has been updated!");
			} else {
				$this->session->set_flashdata('error', "Error, Can't update the period!");
			}
			redirect('academics/periods', 'refresh');
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
		if($this->mdl_period->update($data, $id) == true) {
			$this->session->set_flashdata('success', "Success, Activated successfully!");
		} else {
			$this->session->set_flashdata('error', "Error, Can't activate!");
		}
		redirect('academics/periods', 'refresh');
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
		if($this->mdl_period->update($data, $id) == true) {
			$this->session->set_flashdata('success', "Success, Deactivated successfully!");
		} else {
			$this->session->set_flashdata('error', "Error, Can't deactivate!");
		}
		redirect('academics/periods', 'refresh');
	}

	/**
	 * [Delete record from list.]
	 * @param  void
	 * @return boolean
	 */
	public function delete()
	{
		$id = $this->input->post('primary_id');
		if($this->mdl_period->delete($id) == true) {
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
		if($this->mdl_period->force_delete($id) == true) {
			$this->session->set_flashdata('success', 'DELETED!');
		} else {
			$this->session->set_flashdata('error', 'ERROR!');
		}
		redirect('academics/periods', 'refresh');
	}
}

/* End of file Periods.php */
/* Location: ./application/modules/academics/controllers/Periods.php */