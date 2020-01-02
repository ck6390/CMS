<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
 * Ganga Memorial CMS
 *
 * @author		Amit Kumar
 * @copyright	Copyright (c) 2019
 */

/**
 * Class Activity
 */

class Activities extends Base_Controller
{
	/**
	 * Dashboard_Controller constructor.
	 */
	public function __construct()
	{
		// controller constructor
		parent::__construct();
		$this->load->model('Activity', 'mdl_activity');
		
		
	}

	/**
	 * Activity Dashboard.
	 * @return void [load view page]
	 */
	public function index()
	{
		$this->template->set('title', 'Activity');
		$data['lists'] = $this->mdl_activity->get_all();
		$this->template->load('template', 'contents', 'activity/list',$data);
	}

	/**
	 * Super Admin Dashboard Search for faculty.
	 * @return void [load view page]
	 */
	public function add()
	{
		$this->form_validation->set_rules('activity-name', 'activity name', 'required|trim');
		$this->form_validation->set_rules('activity-amount', 'activity amount', 'required|trim');

		if($this->form_validation->run() == false) {
			$this->template->set('title', 'Add Fee');
			$this->template->load('template', 'contents', 'activity/add');
		} else {
			$post = $this->input->post(NULL, TRUE);
			$cleanPost = $this->security->xss_clean($post);
			$formData = array(
				'activity_name' => $cleanPost['activity-name'],
				'amount' => $cleanPost['activity-amount'],
				'description' => $cleanPost['description'] ? $cleanPost['description']:" ",
			);
			
			// insert to database
			if($this->mdl_activity->insert($formData) == true) {
				$this->session->set_flashdata('success', "Success, New Activity has been added!");
			} else {
				$this->session->set_flashdata('danger', "Error, Can't add new fee group!");
			}
			redirect('super_admin/activities', 'refresh');
		}
	}


	
}

/* End of file Activity.php */
/* Location: ./application/modules/super_admin/controllers/Activity.php */
