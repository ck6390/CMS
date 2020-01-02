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

class Inventry_stocks extends Base_Controller
{
	/**
	 * Permissions_Controller constructor.
	 */
	public function __construct()
	{
		// controller constructor
		parent::__construct();
		$this->load->model('inventry_stock', 'mdl_inventry_stock');
		$this->load->model('Student_inventry', 'mdl_stu_inventry');
		$this->load->model('stock', 'mdl_stock');
		$this->load->model('payment_mode', 'mdl_pay_mode');
		$this->load->model('payment_mode', 'mdl_pay_mode');
		$this->load->module('setting/general_settings');
		$this->load->library('upload');

	}

	/**
	 * [Fetch all Block list.]
	 * @param  void
	 * @return view
	 */
	public function index()
	{ 
		$data['lists'] = $this->mdl_inventry_stock->inventory(); 
		if(!empty($this->input->post('start_date')) && !empty($this->input->post('end_date'))){
			$from = $this->input->post('start_date');
	        $to = $this->input->post('end_date');
			$data['lists'] =  $this->mdl_inventry_stock->searchInventory($from,$to); 
		} 
		$this->template->set('title', 'Inventory List');
		$this->template->load('template', 'contents', 'inventry_stock/list', $data);
	}

	/**
	 * [Insert a new block record.]
	 * @param  void
	 * @return redirect
	 */
	public function add()
	{ 
		$this->form_validation->set_rules('stock_on_date', 'Stock on date', 'required|trim');
		$this->form_validation->set_rules('stock_id', 'Stock name', 'required|trim');
		$this->form_validation->set_rules('quantity', 'quantity', 'required|trim');
		$this->form_validation->set_rules('purchase_price', 'Purchase Price', 'required|trim');
		$this->form_validation->set_rules('sell_price', 'Sell Price', 'required|trim');
		$this->form_validation->set_rules('total_amount', 'Total Amount', 'required|trim');
		$this->form_validation->set_rules('pay_mode', 'Pay Mode', 'required|trim');
		$this->form_validation->set_rules('transaction_no', 'Transaction no', 'required|trim');
		$this->form_validation->set_rules('pay_mode', 'Pay Mode', 'required|trim');
		$this->form_validation->set_rules('agency_name', 'Agency Name', 'required|trim');
		$this->form_validation->set_rules('remark', 'remark', 'required|trim');
		$this->form_validation->set_rules('bill_add', 'bill add');
		
		if($this->form_validation->run() == false) {
			$this->template->set('title', 'Add Inventry Stock');
			$data['stocks'] = $this->mdl_stock->get_all();
			$this->template->load('template', 'contents', 'inventry_stock/add',$data);
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
    			//var_dump($thumb);die();
			}	
		   }
 
			$post = $this->input->post(null, true);
			$cleanPost = $this->security->xss_clean($post);
			$formData = array(
				'stock_on_date' => $cleanPost['stock_on_date'],
				'stock_id' => $cleanPost['stock_id'],
				'quantity' => $cleanPost['quantity'],
				'available_quantity' => $cleanPost['quantity'],
				'purchase_price' => $cleanPost['purchase_price'],
				'sell_price' => $cleanPost['sell_price'],
				'total_amount' => $cleanPost['total_amount'],
				'pay_mode' => $cleanPost['pay_mode'],
				'transaction_no' => $cleanPost['transaction_no'],
				'agency_name' => $cleanPost['agency_name'],
				'bill_ref_no' => $cleanPost['bill_ref_no'],
				'remark' => $cleanPost['remark'],
				'bill_add' => isset($thumb)? $thumb : ''
			);
			if($this->mdl_inventry_stock->insert($formData) == true) {
				$this->session->set_flashdata('success', "Success, New Inventry Stocks has been added!");
			} else {
				$this->session->set_flashdata('danger', "Error, Can't add new Inventry Stocks!");
			}
			redirect('inventry/inventry_stocks', 'refresh');
		}
	}

	/**
	 * [Inventory Report.]
	 * @param  int $id [primary key]
	 * @return redirect
	 */
	public function inventryReport($id)
	{	
		//var_dump($id);
		$in_id = $id;
		$data['inventories'] = $this->mdl_inventry_stock->get($id);
		//var_dump($data['inventories']);
		$stocks = $this->mdl_stock->get_all();
		foreach($stocks as $stock) {
				$s_array[$stock->id] = $stock->stock_name;
		
		}
		$data['s_array'] = $s_array;
		$data['info'] = $this->mdl_stu_inventry->get($id);
		$data['sell_info'] = $this->mdl_inventry_stock->inventorySellReport($id);
		$this->template->set('title', 'Sell view');
		$this->template->load('template', 'contents', 'inventry_stock/report',$data);
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
		if($this->mdl_inventry_stock->update($data, $id) == true) {
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
		if($this->mdl_inventry_stock->update($data, $id) == true) {
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
		if($this->mdl_inventry_stock->delete($id) == true) {
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
		if($this->mdl_inventry_stock->force_delete($id) == true) {
			$this->session->set_flashdata('success', 'DELETED!');
		} else {
			$this->session->set_flashdata('error', 'ERROR!');
		}
		redirect('inventry/inventry_stocks', 'refresh');
	}

	/**
	 * [Inventory Statement.]
	 * @param  int $id [primary key]
	 * @return redirect
	 */

	public function inentry_statement()
	{	
		$this->form_validation->set_rules('stock_id', 'day_due_fee', 'required|trim');
		$this->form_validation->set_rules('start_date', 'month-from', 'required|trim');
		$this->form_validation->set_rules('end_date', 'end_date', 'required|trim');
		if($this->form_validation->run() == false) {
			$this->template->set('title', 'Inventory Statement');
			$data['stocks'] = $this->mdl_inventry_stock->inventory();
			$this->template->load('template', 'contents', 'inventry_stock/inentry_statement',$data);
		}else {
			$data['stocks'] = $this->mdl_inventry_stock->inventory();
			$post = $this->input->post(null, true);
			$cleanPost = $this->security->xss_clean($post);
					$stock_id = $cleanPost['stock_id'];
					$from = $cleanPost['start_date'];
					$to = $cleanPost['end_date'];
			if($stock_id!="All" && !empty($stock_id) && !empty($from)&& !empty($to)){
				$data['infos'] = $this->mdl_inventry_stock->inventryStock($stock_id,$from,$to);
			}elseif($stock_id =="All" && !empty($stock_id) && !empty($from)&& !empty($to))
			{
				$data['infos'] = $this->mdl_inventry_stock->inventryStock($stock_id,$from,$to);
			}
			
			$this->template->set('title', 'Inventory Statement');
			$this->template->load('template', 'contents', 'inventry_stock/inentry_statement',$data);
		}
	}

}

/* End of file Blocks.php */
/* Location: ./application/modules/setting/controllers/Blocks.php */