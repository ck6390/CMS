<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
 * Ganga Memorial CMS
 *
 * @author		Amit Kumar
 * @copyright	Copyright (c) 2019
 */

/**
 * Class Buildings
 */

class Buildings extends Base_Controller
{
	/**
	 * Building_Controller constructor.
	 */
	public function __construct()
	{
		// controller constructor
		parent::__construct();
		$this->load->model('Building', 'mdl_building');
		$this->load->module('setting/semesters');
	}

	/**
	 * [Fetch all Buildings list.]
	 * @param  void
	 * @return view
	 */
	public function index()
	{
		$data['lists'] = $this->mdl_building->get_all();
		$this->template->set('title', 'Building List');
		$this->template->load('template', 'contents', 'building/building_list', $data);
	}

	/**
	 * [Insert a new building record.]
	 * @param  void
	 * @return redirect
	 */
	public function add()
	{
		$this->form_validation->set_rules('building-name', 'Building Name', 'required|trim');

		if($this->form_validation->run() == false) {
			$this->template->set('title', 'Add Building');
			$this->template->load('template', 'contents', 'building/building_add');
		} else {
			$post = $this->input->post(null, true);
			$cleanPost = $this->security->xss_clean($post);
			$formData = array(
				'building_name' => $cleanPost['building-name'],
				'description' => $cleanPost['building-description']
			);
			// insert to database
			if($this->mdl_building->insert($formData) == true) {
				$this->session->set_flashdata('success', "Success, New Hostel Building has been added!");
			} else {
				$this->session->set_flashdata('danger', "Error, Can't add new Hostel Building!");
			}
			redirect('setting/buildings', 'refresh');
		}
	}

	/**
	 * [Edit buildings details.]
	 * @param  int $id [primary key]
	 * @return redirect
	 */
	public function edit($id)
	{
		$this->form_validation->set_rules('building-name', 'Building Name', 'required|trim');

		if($this->form_validation->run() == false) {
			$data['info'] = $this->mdl_building->get($id);
			$this->template->set('title', 'Edit Building');
			$this->template->load('template', 'contents', 'building/building_edit', $data);
		} else {
			$post = $this->input->post(null, true);
			$cleanPost = $this->security->xss_clean($post);
			$formData = array(
				'building_name' => $cleanPost['building-name'],
				'description' => $cleanPost['building-description']
			);
			// update to database
			if($this->mdl_building->update($formData, $id) == true) {
				$this->session->set_flashdata('success', "Success, Hostel building has been updated!");
			} else {
				$this->session->set_flashdata('error', "Error, Can't update the Hostel building!");
			}
			redirect('setting/buildings', 'refresh');
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
		if($this->mdl_building->update($data, $id) == true) {
			$this->session->set_flashdata('success', "Success, Activated successfully!");
		} else {
			$this->session->set_flashdata('error', "Error, Can't activate!");
		}
		redirect('setting/buildings', 'refresh');
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
		if($this->mdl_building->update($data, $id) == true) {
			$this->session->set_flashdata('success', "Success, Deactivated successfully!");
		} else {
			$this->session->set_flashdata('error', "Error, Can't deactivate!");
		}
		redirect('setting/buildings', 'refresh');
	}

	/**
	 * [Delete record from list.]
	 * @param  void
	 * @return boolean
	 */
	public function delete()
	{
		$id = $this->input->post('primary_id');
		if($this->mdl_building->delete($id) == true) {
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
		if($this->mdl_building->force_delete($id) == true) {
			$this->session->set_flashdata('success', 'DELETED!');
		} else {
			$this->session->set_flashdata('error', 'ERROR!');
		}
		redirect('setting/buildings', 'refresh');
	}
}

/* End of file Buildings.php */
/* Location: ./application/modules/setting/controllers/Buildings.php */