<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
 * ERP
 *
 * @author		Manoj Kumar
 * @copyright	Copyright (c) 2018
 */

/**
 * Class Holiday_list
 */

class Holiday_list extends Base_Controller
{
	/**
	 * Department_Controller constructor.
	 */
	public function __construct()
	{
		// controller constructor
		parent::__construct();
		$this->load->model('Mdl_holiday_list', 'mdl_holiday');
	}

	/**
	 * [Fetch all holiday list.]
	 * @param  void
	 * @return void
	 */
	public function index()
	{
		$data['lists'] = $this->mdl_holiday->get_all();
		$this->template->set('title', 'Holiday List');
		$this->template->load('template', 'contents', 'holiday/list', $data);
	}

	/**
	 * [Insert a new bank record.]
	 * @param  void
	 * @return void
	 */
	public function add()
	{
		$this->form_validation->set_rules('event-name', 'holiday/event name', 'required|trim');
		$this->form_validation->set_rules('start-date', 'start date', 'required|trim');
		$this->form_validation->set_rules('end-date', 'end date', 'required|trim');

		if($this->form_validation->run() == false) {
			$this->template->set('title', 'Add Holiday/Event');
			$this->template->load('template', 'contents', 'holiday/add');
		} else {
			$post = $this->input->post(null, true);
			$cleanPost = $this->security->xss_clean($post);
			$diff = strtotime($cleanPost['start-date']) - strtotime($cleanPost['end-date']);
			// 1 day = 24 hours
			// 24 * 60 * 60 = 86400 seconds

			$days = abs(round($diff / 86400));
			$formData = array(
				'event_name' => $cleanPost['event-name'],
				'start_date' => $cleanPost['start-date'],
				'end_date' => $cleanPost['end-date'],
				'days' => $days + 1,
				'description' => $cleanPost['description'] ? $cleanPost['description']:null
			);

			
			// insert to database
			if($this->mdl_holiday->insert($formData) == true) {
				$this->session->set_flashdata('success', "Success, New holiday/event has been added!");
			} else {
				$this->session->set_flashdata('error', "Error, Can't add new holiday/event!");
			}
			redirect('office/holiday_list', 'refresh');
		}
	}

	/**
	 * [Edit bank detail and update.]
	 * @param  int $id [primary key]
	 * @return redirect
	 */
	public function edit($id)
	{
		$this->form_validation->set_rules('event-name', 'holiday/event name', 'required|trim');
		$this->form_validation->set_rules('start-date', 'start date', 'required|trim');
		$this->form_validation->set_rules('end-date', 'end date', 'required|trim');

		if($this->form_validation->run() == false) {
			$data['info'] = $this->mdl_holiday->get($id);
			$this->template->set('title', 'Edit Holiday/Event');
			$this->template->load('template', 'contents', 'holiday/edit', $data);
		} else {
			$post = $this->input->post(null, true);
			$cleanPost = $this->security->xss_clean($post);
			$formData = array(
				'event_name' => $cleanPost['event-name'],
				'start_date' => $cleanPost['start-date'],
				'end_date' => $cleanPost['end-date'],
				'description' => $cleanPost['description'] ? $cleanPost['description']:null
			);
			// update to database
			if($this->mdl_holiday->update($formData, $id) == true) {
				$this->session->set_flashdata('success', "Success, Holiday/Event detail has been updated!");
			} else {
				$this->session->set_flashdata('error', "Error, Can't update holiday/event detail!");
			}
			redirect('office/holiday_list', 'refresh');
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
		if($this->mdl_holiday->update($data, $id) == true) {
			$this->session->set_flashdata('success', "Success, Activated successfully!");
		} else {
			$this->session->set_flashdata('error', "Error, Can't activate!");
		}
		redirect('office/holiday_list', 'refresh');
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
		if($this->mdl_holiday->update($data, $id) == true) {
			$this->session->set_flashdata('success', "Success, Deactivated successfully!");
		} else {
			$this->session->set_flashdata('error', "Error, Can't deactivate!");
		}
		redirect('office/holiday_list', 'refresh');
	}

	/**
	 * [Delete record from table.]
	 * @return boolean
	 */
	public function delete()
	{
		$id = $this->input->post('primary_id');
		if($this->mdl_holiday->delete($id) == true) {
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
		if($this->mdl_holiday->force_delete($id) == true) {
			$this->session->set_flashdata('success', 'DELETED!');
		} else {
			$this->session->set_flashdata('error', 'ERROR!');
		}
		redirect('office/holiday_list', 'refresh');
	}
}

/* End of file Bank.php */
/* Location: ./application/modules/office/controllers/Bank.php */
