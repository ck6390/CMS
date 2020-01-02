<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
 * Ganga Memorial CMS
 *
 * @author		Amit Kumar
 * @copyright	Copyright (c) 2019
 */

/**
 * Class Floors
 */

class Floors extends Base_Controller
{
	/**
	 * Floors_Controller Constructor.
	 */
	public function __construct()
	{
		// controller constructor
		parent::__construct();
		$this->load->model('floor', 'mdl_floor');
		$this->load->model('Building', 'mdl_building');
		$this->load->module('setting/semesters');
	}

	/**
	 * [Fetch all floor list.]
	 * @param  void
	 * @return view
	 */
	public function index()
	{
		$data['lists'] = $this->mdl_floor->get_all();
		$this->template->set('title', 'Floor List');
		$this->template->load('template', 'contents', 'floor/floor_list', $data);
	}

	/**
	 * [Insert a new floor record.]
	 * @param  void
	 * @return redirect
	 */
	public function add()
	{
		$this->form_validation->set_rules('floor-name', 'Floor Name', 'required|trim');
		$this->form_validation->set_rules('building-name', 'Building Name', 'required|trim');
		$this->form_validation->set_rules('block-name', 'Block Name', 'required|trim');

		if($this->form_validation->run() == false) {
			$data['floors'] = $this->mdl_floor->get_all();
			$this->template->set('title', 'Add Floor');
			$this->template->load('template', 'contents', 'floor/floor_add', $data);
		} else {
			$post = $this->input->post(null, true);
			$cleanPost = $this->security->xss_clean($post);
			$formData = array(
				'floor_name' => $cleanPost['floor-name'],
				'building_id' => $cleanPost['building-name'],
				'block_id' => $cleanPost['block-name'],
				'description' => $cleanPost['floor-description'] ? $cleanPost['floor-description'] : null
			);
			
			// insert to database
			if($this->mdl_floor->insert($formData) == true) {
				$this->session->set_flashdata('success', "Success, New Hostel Floor has been added!");
			} else {
				$this->session->set_flashdata('danger', "Error, Can't add new Hostel Floor!");
			}
			redirect('setting/floors', 'refresh');
		}
	}

	/**
	 * [Edit role details.]
	 * @param  int $id [primary key]
	 * @return redirect
	 */
	public function edit($id)
	{
		$this->form_validation->set_rules('floor-name', 'Floor name', 'required|trim');
		$this->form_validation->set_rules('building-name', 'Building Name', 'required|trim');
		$this->form_validation->set_rules('block-name', 'Block name', 'required|trim');

		if($this->form_validation->run() == false) {
			$data['info'] = $this->mdl_floor->get($id);
			$this->template->set('title', 'Edit Floor');
			$this->template->load('template', 'contents', 'floor/floor_edit', $data);
		} else {
			$post = $this->input->post(null, true);
			$cleanPost = $this->security->xss_clean($post);
			$formData = array(
				'floor_name' => $cleanPost['floor-name'],
				'block_id' => $cleanPost['block-name'],
				'building_id' => $cleanPost['building-name'],
				'description' => $cleanPost['floor-description'] ? $cleanPost['floor-description'] : null
			);
			
			// update to database
			if($this->mdl_floor->update($formData, $id) == true) {
				$this->session->set_flashdata('success', "Success, Hostel Floor has been updated!");
			} else {
				$this->session->set_flashdata('danger', "Error, Can't update the Hostel floor!");
			}
			redirect('setting/floors', 'refresh');
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
		if($this->mdl_floor->update($data, $id) == true) {
			$this->session->set_flashdata('success', "Success, Activated successfully!");
		} else {
			$this->session->set_flashdata('error', "Error, Can't activate!");
		}
		redirect('setting/floors', 'refresh');
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
		if($this->mdl_floor->update($data, $id) == true) {
			$this->session->set_flashdata('success', "Success, Deactivated successfully!");
		} else {
			$this->session->set_flashdata('error', "Error, Can't deactivate!");
		}
		redirect('setting/floors', 'refresh');
	}

	/**
	 * [Delete record from list.]
	 * @param  void
	 * @return boolean
	 */
	public function delete()
	{
		$id = $this->input->post('primary_id');
		if($this->mdl_floor->delete($id) == true) {
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
		if($this->mdl_floor->force_delete($id) == true) {
			$this->session->set_flashdata('success', 'DELETED!');
		} else {
			$this->session->set_flashdata('error', 'ERROR!');
		}
		redirect('setting/floors', 'refresh');
	}

	
	/**
	 * [Get floor list by Blocks.]
	 * @param  int $id [primary key]
	 * @return mixed
	 */
	public function get_floor_list_by_block($id)
	{
		$query = $this->db->select('floor_p_id, floor_name')->from('floors')->where(array(
                'block_id' => $id,
                'is_active' =>'1'
            ))->get();
		$result = $query->num_rows() > 0 ? $query->result() : false;
		echo json_encode($result);
	}
}

/* End of file Floors.php */
/* Location: ./application/modules/setting/controllers/Floors.php */