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

class Items extends Base_Controller
{
	/**
	 * Permissions_Controller constructor.
	 */
	public function __construct()
	{
		// controller constructor
		parent::__construct();
		$this->load->model('item', 'mdl_item');
	}

	/**
	 * [Fetch all Block list.]
	 * @param  void
	 * @return view
	 */
	public function index()
	{
		$data['lists'] = $this->mdl_item->get_all();
		$this->template->set('title', 'Item List');
		$this->template->load('template', 'contents', 'item/list', $data);
	}

	/**
	 * [Insert a new block record.]
	 * @param  void
	 * @return redirect
	 */
	public function add()
	{
		$this->form_validation->set_rules('item_name', 'Item Name', 'required|trim|is_unique[items.item_name]');
		$this->form_validation->set_rules('description', 'description');
		if($this->form_validation->run() == false) {
			$this->template->set('title', 'Add Items');
			$this->template->load('template', 'contents', 'item/add');
		} else {
			$post = $this->input->post(null, true);
			$cleanPost = $this->security->xss_clean($post);
			$formData = array(
				'item_name' => $cleanPost['item_name'],
				'description' => $cleanPost['description']
			);
			// insert to database
			if($this->mdl_item->insert($formData) == true) {
				$this->session->set_flashdata('success', "Success, New item has been added!");
			} else {
				$this->session->set_flashdata('danger', "Error, Can't add new Items!");
			}
			redirect('inventry/items', 'refresh');
		}
	}

	/**
	 * [Edit buildings details.]
	 * @param  int $id [primary key]
	 * @return redirect
	 */
	public function edit($id)
	{
		$this->form_validation->set_rules('item_name', 'Item Name', 'required|trim|is_unique[items.item_name]');
		$this->form_validation->set_rules('description', 'description');

		if($this->form_validation->run() == false) {
			$data['info'] = $this->mdl_item->get($id);
			$this->template->set('title', 'Edit Items');
			$this->template->load('template', 'contents', 'item/edit', $data);
		} else {
			$post = $this->input->post(null, true);
			$cleanPost = $this->security->xss_clean($post);
			$formData = array(
				'item_name' => $cleanPost['item_name'],
				'description' => $cleanPost['description']
			);
			// update to database
			if($this->mdl_item->update($formData, $id) == true) {
				$this->session->set_flashdata('success', "Success, Item has been updated!");
			} else {
				$this->session->set_flashdata('error', "Error, Can't update the permission!");
			}
			redirect('inventry/items', 'refresh');
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
		if($this->mdl_item->update($data, $id) == true) {
			$this->session->set_flashdata('success', "Success, Activated successfully!");
		} else {
			$this->session->set_flashdata('error', "Error, Can't activate!");
		}
		redirect('inventry/items', 'refresh');
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
		if($this->mdl_item->update($data, $id) == true) {
			$this->session->set_flashdata('success', "Success, Deactivated successfully!");
		} else {
			$this->session->set_flashdata('error', "Error, Can't deactivate!");
		}
		redirect('inventry/items', 'refresh');
	}

	/**
	 * [Delete record from list.]
	 * @param  void
	 * @return boolean
	 */
	public function delete()
	{
		$id = $this->input->post('primary_id');
		if($this->mdl_item->delete($id) == true) {
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
		if($this->mdl_item->force_delete($id) == true) {
			$this->session->set_flashdata('success', 'DELETED!');
		} else {
			$this->session->set_flashdata('error', 'ERROR!');
		}
		redirect('inventry/items', 'refresh');
	}

}

/* End of file Blocks.php */
/* Location: ./application/modules/setting/controllers/Blocks.php */