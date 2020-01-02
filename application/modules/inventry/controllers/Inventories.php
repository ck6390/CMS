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

class Inventories extends Base_Controller
{
	/**
	 * Permissions_Controller constructor.
	 */
	public function __construct()
	{
		parent::__construct();
		$this->load->model('inventory', 'mdl_inventory');
		$this->load->model('item', 'mdl_item');
		$this->load->model('payment_mode', 'mdl_pay_mode');
		$this->load->library('upload');
		$this->load->module('setting/general_settings');
	}

	/**
	 * [Fetch all Block list.]
	 * @param  void
	 * @return view
	 */
	public function index()
	{ 
		$data['lists'] = $this->mdl_inventory->inventory(); 
		if(!empty($this->input->post('start_date')) && !empty($this->input->post('end_date'))){
			$from = $this->input->post('start_date');
	        $to = $this->input->post('end_date');
			$data['lists'] =  $this->mdl_inventory->searchInventory($from,$to); 
		} 
		$this->template->set('title', 'Inventory List');
		$this->template->load('template', 'contents', 'inventory/list', $data);
	}

	/**
	 * [Insert a new block record.]
	 * @param  void
	 * @return redirect
	 */
	public function add()
	{ 
		//die();
		$this->form_validation->set_rules('item_on_date', 'Item on date', 'required|trim');
		$this->form_validation->set_rules('item_id', 'Item name', 'required|trim');
		$this->form_validation->set_rules('quantity', 'quantity', 'required|trim');
		$this->form_validation->set_rules('purchase_price', 'Purchase Price', 'required|trim');
		$this->form_validation->set_rules('sale_price', 'Sale Price', 'required|trim');
		$this->form_validation->set_rules('total_amount', 'Total Amount', 'required|trim');
		$this->form_validation->set_rules('pay_mode', 'Pay Mode', 'required|trim');
		$this->form_validation->set_rules('transaction_no', 'Transaction no', 'required|trim');
		$this->form_validation->set_rules('pay_mode', 'Pay Mode', 'required|trim');
		$this->form_validation->set_rules('agency_name', 'Agency Name', 'required|trim');
		$this->form_validation->set_rules('remark', 'remark');
		$this->form_validation->set_rules('bill_add', 'bill add');
		
		if($this->form_validation->run() == false) {
			$this->template->set('title', 'Add Inventory');
			$data['items'] = $this->mdl_item->get_all();
			$this->template->load('template', 'contents', 'inventory/add',$data);
		} else {
			if(!empty($_FILES['bill_add']['name'])) {
				$config = array(
				'upload_path' => "assets/img/inventory",
				'log_threshold' => 1,
				'allowed_types' => "jpeg|jpg|png|pdf|PDF|JPG|JPEG|PNG",
				'max_size' => 300,
				'encrypt_name' => true,
				'remove_spaces' => true,
				'detect_mime' => true,
				'overwrite' => false
			);

			$this->load->library('upload', $config);
			$this->upload->initialize($config);
			if($this->upload->do_upload('bill_add')){
    			$file = $this->upload->data();
    			$thumb = $file['file_name'];
			}	
		   }
 
			$post = $this->input->post(null, true);
			$cleanPost = $this->security->xss_clean($post);
			$formData = array(
				'item_on_date' => $cleanPost['item_on_date'],
				'item_id' => $cleanPost['item_id'],
				'quantity' => $cleanPost['quantity'],
				'available_quantity' => $cleanPost['quantity'],
				'purchase_price' => $cleanPost['purchase_price'],
				'sale_price' => $cleanPost['sale_price'],
				'total_amount' => $cleanPost['total_amount'],
				'pay_mode' => $cleanPost['pay_mode'],
				'transaction_no' => $cleanPost['transaction_no'],
				'agency_name' => $cleanPost['agency_name'],
				'bill_ref_no' => $cleanPost['bill_ref_no'],
				'remark' => $cleanPost['remark'],
				'bill_add' => isset($thumb)? $thumb : ''
			);
			if($this->mdl_inventory->insert($formData) == true) {
				$this->session->set_flashdata('success', "Success, New Inventory has been added!");
			} else {
				$this->session->set_flashdata('danger', "Error, Can't add new Inventry Stocks!");
			}
			redirect('inventry/inventories', 'refresh');
		}
	}

	/**
	 * [Inventory Report.]
	 * @param  int $id [primary key]
	 * @return redirect
	 */
	public function inventryReport($id)
	{	
		$data['inventories'] = $this->mdl_inventory->inventory($id);
		$data['reports'] = $this->mdl_inventory->inventoryReport($id);
		$this->template->set('title', 'Inventory Report');
		$this->template->load('template', 'contents', 'inventory/report',$data);
	}

	/**
	 * [Inventory Statement.]
	 * @param  int $id [primary key]
	 * @return redirect
	 */

	public function inentry_statement()
	{	
		$this->form_validation->set_rules('item_id', 'item id', 'required|trim');
		$this->form_validation->set_rules('start_date', 'month-from', 'required|trim');
		$this->form_validation->set_rules('end_date', 'end_date', 'required|trim');
		if($this->form_validation->run() == false) {
			$this->template->set('title', 'Inventory Statement');
			$data['items'] = $this->mdl_item->get_all();
			$this->template->load('template', 'contents', 'inventory/inentry_statement',$data);
		}else {
			$data['items'] = $this->mdl_item->get_all();
			$post = $this->input->post(null, true);
			$cleanPost = $this->security->xss_clean($post);
					$item_id = $cleanPost['item_id'];
					$from = $cleanPost['start_date'];
					$to = $cleanPost['end_date'];
			if($item_id!="All" && !empty($item_id) && !empty($from)&& !empty($to)){
				$data['infos'] = $this->mdl_inventory->inentry_statement($item_id,$from,$to);
				//var_dump($data['infos']);
			}elseif($item_id =="All" && !empty($item_id) && !empty($from)&& !empty($to))
			{
				$data['infos'] = $this->mdl_inventory->inentry_statement($item_id,$from,$to);
				//var_dump($data['infos']);
			}
			
			$this->template->set('title', 'Inventory Statement');
			$this->template->load('template', 'contents', 'inventory/inentry_statement',$data);
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
		if($this->mdl_inventory->update($data, $id) == true) {
			$this->session->set_flashdata('success', "Success, Activated successfully!");
		} else {
			$this->session->set_flashdata('error', "Error, Can't activate!");
		}
		redirect('inventry/inventry_stocks', 'refresh');
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
		if($this->mdl_inventory->update($data, $id) == true) {
			$this->session->set_flashdata('success', "Success, Deactivated successfully!");
		} else {
			$this->session->set_flashdata('error', "Error, Can't deactivate!");
		}
		redirect('inventry/inventry_stocks', 'refresh');
	}

	/**
	 * [Delete record from list.]
	 * @param  void
	 * @return boolean
	 */
	public function delete()
	{
		$id = $this->input->post('primary_id');
		if($this->mdl_inventory->delete($id) == true) {
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
		if($this->mdl_inventory->force_delete($id) == true) {
			$this->session->set_flashdata('success', 'DELETED!');
		} else {
			$this->session->set_flashdata('error', 'ERROR!');
		}
		redirect('inventry/inventry_stocks', 'refresh');
	}

	
}

/* End of file Blocks.php */
/* Location: ./application/modules/setting/controllers/Blocks.php */