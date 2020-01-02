<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
 * ERP
 *
 * @author		Amit Kumar
 * @copyright	Copyright (c) 2018
 */

/**
 * Class Working_day
 */

class Working_day extends Base_Controller
{
	/**
	 * Working_day_Controller constructor.
	 */
	public function __construct()
	{
		// controller constructor/**
		parent::__construct();
		$this->load->model('Mdl_working_day', 'mdl_working_day');
	}

	/**
	 * [List all working day.]
	 * @param  void
	 * @return view
	 */
	public function index()
	{
		$data['days'] = $this->mdl_working_day->get_all();
		$this->template->set('title', 'Working Days');
		$this->template->load('template', 'contents', 'working_day/index', $data);
	}

	/**
	 * [Update working day.]
	 * @param  void
	 * @return void 
	 */
	public function save()
	{
		/**
		 * set all flag to deafult value '0'
		 */
		$formData['flag'] = '0';
		$this->mdl_working_day->update_all($formData);
		/**
		 * [$workingDays description]
		 * @var array
		 */
		$workingDays = $this->input->post('working-days');
		$formData['flag'] = '1';
		/**
		 * update to database
		 */
		if($this->mdl_working_day->update_many($formData, $workingDays) == true) {
			$this->session->set_flashdata('success', "Success, Working days has been updated!");
		} else {
			$this->session->set_flashdata('error', "Error, Can't update the working days!");
		}
		redirect('office/working_day', 'refresh');
	}
}

/* End of file Working_day.php */
/* Location: ./application/modules/office/controllers/Working_day.php */
