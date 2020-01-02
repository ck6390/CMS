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

class Stocks extends Base_Controller
{
	/**
	 * Permissions_Controller constructor.
	 */
	public function __construct()
	{
		// controller constructor
		parent::__construct();
		$this->load->model('stock', 'mdl_stock');
	}

	/**
	 * [Fetch all Block list.]
	 * @param  void
	 * @return view
	 */
	public function index()
	{
		$data['lists'] = $this->mdl_stock->get_all();
		$this->template->set('title', 'Stock List');
		$this->template->load('template', 'contents', 'stock/stock_list', $data);
	}

	/**
	 * [Insert a new block record.]
	 * @param  void
	 * @return redirect
	 */
	public function add()
	{
		$this->form_validation->set_rules('stock_name', 'Stock Name', 'required|trim|is_unique[stocks.stock_name]');
		$this->form_validation->set_rules('description', 'description', 'required|trim');
		

		if($this->form_validation->run() == false) {
			$this->template->set('title', 'Add Stock');
			$this->template->load('template', 'contents', 'stock/stock_add');
		} else {
			$post = $this->input->post(null, true);
			$cleanPost = $this->security->xss_clean($post);
			$formData = array(
				'stock_name' => $cleanPost['stock_name'],
				'description' => $cleanPost['description']
			);
			// insert to database
			if($this->mdl_stock->insert($formData) == true) {
				$this->session->set_flashdata('success', "Success, New Hostel Stocks has been added!");
			} else {
				$this->session->set_flashdata('danger', "Error, Can't add new Stocks!");
			}
			redirect('inventry/stocks', 'refresh');
		}
	}

	/**
	 * [Edit buildings details.]
	 * @param  int $id [primary key]
	 * @return redirect
	 */
	public function edit($id)
	{
		$this->form_validation->set_rules('stock_name', 'Stock Name', 'required|trim|is_unique[stocks.stock_name]');
		$this->form_validation->set_rules('description', 'description', 'required|trim');

		if($this->form_validation->run() == false) {
			$data['info'] = $this->mdl_stock->get($id);
			$this->template->set('title', 'Edit Stocks');
			$this->template->load('template', 'contents', 'stock/stock_edit', $data);
		} else {
			$post = $this->input->post(null, true);
			$cleanPost = $this->security->xss_clean($post);
			$formData = array(
				'stock_name' => $cleanPost['stock_name'],
				'description' => $cleanPost['description']
			);
			// update to database
			if($this->mdl_stock->update($formData, $id) == true) {
				$this->session->set_flashdata('success', "Success, Permission has been updated!");
			} else {
				$this->session->set_flashdata('error', "Error, Can't update the permission!");
			}
			redirect('inventry/stocks', 'refresh');
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
		if($this->mdl_stock->update($data, $id) == true) {
			$this->session->set_flashdata('success', "Success, Activated successfully!");
		} else {
			$this->session->set_flashdata('error', "Error, Can't activate!");
		}
		redirect('inventry/stocks', 'refresh');
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
		if($this->mdl_stock->update($data, $id) == true) {
			$this->session->set_flashdata('success', "Success, Deactivated successfully!");
		} else {
			$this->session->set_flashdata('error', "Error, Can't deactivate!");
		}
		redirect('inventry/stocks', 'refresh');
	}

	/**
	 * [Delete record from list.]
	 * @param  void
	 * @return boolean
	 */
	public function delete()
	{
		$id = $this->input->post('primary_id');
		if($this->mdl_stock->delete($id) == true) {
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
		if($this->mdl_stock->force_delete($id) == true) {
			$this->session->set_flashdata('success', 'DELETED!');
		} else {
			$this->session->set_flashdata('error', 'ERROR!');
		}
		redirect('inventry/stocks', 'refresh');
	}

}

/* End of file Blocks.php */
/* Location: ./application/modules/setting/controllers/Blocks.php */