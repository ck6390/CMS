<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
 * Ganga Memorial CMS
 *
 * @author		Vishwajeet Kumar
 * @copyright	Copyright (c) 2019
 */

/**
 * Class Form Notifications
 */

class Form_notifications extends Base_Controller
{
	/**
	 * Notification_Controller constructor.
	 */
	public function __construct()
	{
		// controller constructor
		parent::__construct();
		$this->load->model('form_notification', 'mdl_notification');
		$this->load->module('accounting/fee_groups');
		$this->load->module('accounting/fee_types');
		$this->load->module('setting/semesters');
		$this->load->module('setting/sessions');
	}

	/**
	 * [Fetch all Notification list.]
	 * @param  void
	 * @return view
	 */
	public function index()
	{
		$data['lists'] = $this->mdl_notification->get_all();
		$this->template->set('title', 'Form Notification List');
		$this->template->load('template', 'contents', 'form_notification/form_notification_list', $data);
	}

	/**
	 * [Insert a new notification record.]
	 * @param  void
	 * @return redirect
	 */
	public function add()
	{
		$this->form_validation->set_rules('fee-group', 'Fee Group', 'required|trim');
		$this->form_validation->set_rules('fee-type', 'Fee Type', 'required|trim');
		$this->form_validation->set_rules('fee', 'Fee', 'required|trim');
		$this->form_validation->set_rules('start-on', 'Start On', 'required|trim');
		$this->form_validation->set_rules('close-on', 'Close On', 'required|trim');
		$this->form_validation->set_rules('semester', 'Semester', 'required|trim');
		$this->form_validation->set_rules('academic-session', 'Academic Session', 'required|trim');

		if($this->form_validation->run() == false) {
			$this->template->set('title', 'Add Form Notification');
			$this->template->load('template', 'contents', 'form_notification/form_notification_add');
		} else {
			$post = $this->input->post(null, true);
			$cleanPost = $this->security->xss_clean($post);
			$formData = array(
				'form_group' => $cleanPost['fee-group'],
				'form_type' => $cleanPost['fee-type'],
				'fee' => $cleanPost['fee'],
				'start_date' => $cleanPost['start-on'],
				'close_date' => $cleanPost['close-on'],
				'semester_ID' => $cleanPost['semester'],
				'session_ID' => $cleanPost['academic-session'],
				'extra_fee_per_subject' => $cleanPost['ex-fee'] ? $cleanPost['ex-fee'] : null,
				'fine_per_days' => $cleanPost['fine-days'] ? $cleanPost['fine-days'] : null,
				'ends_on' => $cleanPost['end-on'] ? $cleanPost['end-on'] : null
			);
			// insert to database
			if($this->mdl_notification->insert($formData) == true) {
				$this->session->set_flashdata('success', "Success, New Notification has been added!");
			} else {
				$this->session->set_flashdata('danger', "Error, Can't add new notification!");
			}
			redirect('academics/form_notifications', 'refresh');
		}
	}

	/**
	 * [Edit Form Notification details]
	 * @param  int $id [primary key]
	 * @return [type]     [description]
	 */
	public function edit($id) 
	{
		$this->form_validation->set_rules('fee-group', 'Fee Group', 'required|trim');
		$this->form_validation->set_rules('fee-type', 'Fee Type', 'required|trim');
		$this->form_validation->set_rules('fee', 'Fee', 'required|trim');
		$this->form_validation->set_rules('start-on', 'Start On', 'required|trim');
		$this->form_validation->set_rules('close-on', 'Close On', 'required|trim');
		$this->form_validation->set_rules('semester', 'Semester', 'required|trim');
		$this->form_validation->set_rules('academic-session', 'Academic Session', 'required|trim');

		if($this->form_validation->run() == false) {
			$data['info'] = $this->mdl_notification->get($id);
			$this->template->set('title', 'Edit Form Notification');
			$this->template->load('template', 'contents', 'form_notification/form_notification_edit', $data);
		} else {
			$post = $this->input->post(null, true);
			$cleanPost = $this->security->xss_clean($post);
			$formData = array(
				'form_group' => $cleanPost['fee-group'],
				'form_type' => $cleanPost['fee-type'],
				'fee' => $cleanPost['fee'],
				'start_date' => $cleanPost['start-on'],
				'close_date' => $cleanPost['close-on'],
				'semester_ID' => $cleanPost['semester'],
				'session_ID' => $cleanPost['academic-session'],
				'extra_fee_per_subject' => $cleanPost['ex-fee'] ? $cleanPost['ex-fee'] : null,
				'fine_per_days' => $cleanPost['fine-days'] ? $cleanPost['fine-days'] : null,
				'ends_on' => $cleanPost['end-on'] ? $cleanPost['end-on'] : null
			);
			// update to database
			if($this->mdl_notification->update($formData, $id) == true) {
				$this->session->set_flashdata('success', "Success, Notification has been updated!");
			} else {
				$this->session->set_flashdata('error', "Error, Can't update the notification!");
			}
			redirect('academics/form_notifications', 'refresh');
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
		if($this->mdl_notification->update($data, $id) == true) {
			$this->session->set_flashdata('success', "Success, Activated successfully!");
		} else {
			$this->session->set_flashdata('error', "Error, Can't activate!");
		}
		redirect('academics/form_notifications', 'refresh');
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
		if($this->mdl_notification->update($data, $id) == true) {
			$this->session->set_flashdata('success', "Success, Deactivated successfully!");
		} else {
			$this->session->set_flashdata('error', "Error, Can't deactivate!");
		}
		redirect('academics/form_notifications', 'refresh');
	}

	/**
	 * [Delete record from list.]
	 * @param  void
	 * @return boolean
	 */
	public function delete()
	{
		$id = $this->input->post('primary_id');
		if($this->mdl_notification->delete($id) == true) {
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
		if($this->mdl_notification->force_delete($id) == true) {
			$this->session->set_flashdata('success', 'DELETED!');
		} else {
			$this->session->set_flashdata('error', 'ERROR!');
		}
		redirect('academics/form_notifications', 'refresh');
	}
}

/* End of file Form_notifications.php */
/* Location: ./application/modules/academics/controllers/Form_notifications.php */