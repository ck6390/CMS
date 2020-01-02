<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
 * Ganga Memorial CMS
 *
 * @author		Amit Kumar
 * @copyright	Copyright (c) 2019
 */

/**
 * Class Blocks
 */

class Blocks extends Base_Controller
{
	/**
	 * Permissions_Controller constructor.
	 */
	public function __construct()
	{
		// controller constructor
		parent::__construct();
		$this->load->model('block', 'mdl_block');
		$this->load->model('Building', 'mdl_building');
		$this->load->module('setting/semesters');
	}

	/**
	 * [Fetch all Block list.]
	 * @param  void
	 * @return view
	 */
	public function index()
	{
		$data['lists'] = $this->mdl_block->get_all();
		$this->template->set('title', 'Block List');
		$this->template->load('template', 'contents', 'block/block_list', $data);
	}

	/**
	 * [Insert a new block record.]
	 * @param  void
	 * @return redirect
	 */
	public function add()
	{
		$this->form_validation->set_rules('block-id', 'Block Id', 'required|trim|is_unique[blocks.block_id]');
		$this->form_validation->set_rules('block-name', 'Block Name', 'required|trim');
		$this->form_validation->set_rules('building-name', 'Building Name', 'required|trim');
		

		if($this->form_validation->run() == false) {
			$data['lastId'] = $this->mdl_block->get_next_id();
			$this->template->set('title', 'Add Block');
			$this->template->load('template', 'contents', 'block/block_add',$data);
		} else {
			$post = $this->input->post(null, true);
			$cleanPost = $this->security->xss_clean($post);
			$formData = array(
				'block_name' => $cleanPost['block-name'],
				'building_id' => $cleanPost['building-name'],
				'discription' => $cleanPost['block-description']
			);
			// insert to database
			if($this->mdl_block->insert($formData) == true) {
				$this->session->set_flashdata('success', "Success, New Hostel Blocks has been added!");
			} else {
				$this->session->set_flashdata('danger', "Error, Can't add new Hostel Blocks!");
			}
			redirect('setting/blocks', 'refresh');
		}
	}

	/**
	 * [Edit buildings details.]
	 * @param  int $id [primary key]
	 * @return redirect
	 */
	public function edit($id)
	{
		$this->form_validation->set_rules('block-name', 'Block Name', 'required|trim');
		$this->form_validation->set_rules('building-name', 'Building Name', 'required|trim');

		if($this->form_validation->run() == false) {
			$data['info'] = $this->mdl_block->get($id);
			$this->template->set('title', 'Edit Blocks');
			$this->template->load('template', 'contents', 'block/block_edit', $data);
		} else {
			$post = $this->input->post(null, true);
			$cleanPost = $this->security->xss_clean($post);
			$formData = array(
				'block_name' => $cleanPost['block-name'],
				'building_id' => $cleanPost['building-name'],
				'discription' => $cleanPost['block-description']
			);
			// update to database
			if($this->mdl_block->update($formData, $id) == true) {
				$this->session->set_flashdata('success', "Success, Permission has been updated!");
			} else {
				$this->session->set_flashdata('error', "Error, Can't update the permission!");
			}
			redirect('setting/blocks', 'refresh');
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
		if($this->mdl_block->update($data, $id) == true) {
			$this->session->set_flashdata('success', "Success, Activated successfully!");
		} else {
			$this->session->set_flashdata('error', "Error, Can't activate!");
		}
		redirect('setting/blocks', 'refresh');
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
		if($this->mdl_block->update($data, $id) == true) {
			$this->session->set_flashdata('success', "Success, Deactivated successfully!");
		} else {
			$this->session->set_flashdata('error', "Error, Can't deactivate!");
		}
		redirect('setting/blocks', 'refresh');
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

	/**
	 * [Get block list by Buildings.]
	 * @param  int $id [primary key]
	 * @return mixed
	 */
	public function get_block_list_by_building($id)
	{

		$query = $this->db->select('block_p_id,, block_name')->from('blocks')->where(array(
                'building_id' => $id,
                'is_active' =>'1'
            ))->get();
		$result = $query->num_rows() > 0 ? $query->result() : false;
		//var_dump($result);
		echo json_encode($result);
	}

}

/* End of file Blocks.php */
/* Location: ./application/modules/setting/controllers/Blocks.php */