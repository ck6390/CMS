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

class Sales extends Base_Controller
{
	/**
	 * Permissions_Controller constructor.
	 */
	public function __construct()
	{
		// controller constructor
		parent::__construct();
		$this->load->model('sale', 'mdl_sale');
		$this->load->model('students/student', 'mdl_student');
		$this->load->model('payment_mode', 'mdl_pay_mode');
		$this->load->model('inventory', 'mdl_inventory');
		$this->load->module('setting/general_settings');
	}

	/**
	 * [Fetch all Block list.]
	 * @param  void
	 * @return view
	 */
	public function index()
	{
		$data['lists'] = $this->mdl_sale->saleList();
		if(!empty($this->input->post('start_date')) && !empty($this->input->post('end_date'))){
			$from = $this->input->post('start_date');
	        $to = $this->input->post('end_date');
			$data['lists'] =  $this->mdl_sale->searchSale($from,$to); 
		} 
		$this->template->set('title', 'Receipt List');
		$this->template->load('template', 'contents', 'sale/list', $data);
	}

	/**
	 * [Insert a new block record.]
	 * @param  void
	 * @return redirect
	 */
	public function add()
	{  
		$this->form_validation->set_rules('student_id', 'Student id', 'required|trim');
		$this->form_validation->set_rules('sale_on_date', 'Sale Date', 'required|trim');
		$this->form_validation->set_rules('total_price', 'Total Price', 'required|trim');
		$this->form_validation->set_rules('pay_mode', 'Pay Mode', 'required|trim');
		$this->form_validation->set_rules('transaction_no', 'Transaction no', 'required|trim');
		$this->form_validation->set_rules('remark', 'remark');
		if($this->form_validation->run() == false) {
			$this->template->set('title', 'Receipt Add');
			$data['inventories'] = $this->mdl_sale->inventoryList();
			$data['studs'] = $this->mdl_student->get_all();
			$this->template->load('template', 'contents', 'sale/add',$data);
		} else {
			$post = $this->input->post(null, true);
			$sell_info = '';
			$cleanPost = $this->security->xss_clean($post);	
			for ($i=0; $i < count($cleanPost['inventory_id']) ; $i++) { 
				if($cleanPost['quantity']>0){
					$json_data = array(
						'inventory_id' => $cleanPost['inventory_id'][$i],
						'item_id' => $cleanPost['item_id'][$i],
						'item_name' => $cleanPost['item_name'][$i], 
						'quantity' => $cleanPost['quantity'][$i], 
						'unit_price' => $cleanPost['unit_price'][$i], 
						'sub_price' => $cleanPost['sub_price'][$i], 
					);
					$upData = array(
						'available_quantity' => $cleanPost['avquantity'][$i],
					);
					$sell_info[$i] = $json_data;
					$up_data[$cleanPost['inventory_id'][$i]] = $upData;
				}
			}
			$order_info = array(
				'items' => $sell_info,	
			);
			$json_info = json_encode($order_info);			
			$formData = array(
				'sale_on_date' => $cleanPost['sale_on_date'],
				'student_id' => $cleanPost['student_id'],
				'sale_info' =>  $json_info,
				'total_price' =>$cleanPost['total_price'],
				'pay_mode' =>$cleanPost['pay_mode'],
				'transaction_no' =>$cleanPost['transaction_no'],
				'remark' =>$cleanPost['remark']
				
			);
			$data['inventories'] = $this->mdl_sale->inventoryList();
			if($this->mdl_sale->insert($formData) == true) {
				$receiptId = $this->db->insert_id();
				foreach ($up_data as $key => $up_data) {
					$available_data = array('available_quantity' => $up_data['available_quantity']);
					$this->mdl_inventory->update($available_data, $key);
				}
				$this->session->set_flashdata('success', "Success, New Receipt has been added!");
			} else {
				$this->session->set_flashdata('danger', "Error, Can't add new Inventry Stocks!");
			}
			redirect('inventry/sales/receipt_invoice/'.$receiptId, 'refresh');
		}
	}
	/**
	 * [sell view.]
	 * @param  int $id [primary key]
	 * @return redirect
	 */

	public function receipt_invoice($id)
	{
		$data['title'] = "Print Invoice";
		$data['receipt'] = $this->mdl_sale->receipt_invoice_student($id);	
		$this->template->load_invoice('receipt_invoice', 'contents', 'receipt_invoice', $data);	
	}
	
	/**
	 * [sell view.]
	 * @param  int $id [primary key]
	 * @return redirect
	 */
	public function view($id)
	{	
		$data['infos'] = $this->mdl_sale->saleList($id);
		$this->template->set('title', 'Receipt Report');
		$this->template->load('template', 'contents', 'sale/view',$data);
	}

	/**
	 * [Sell Statement.]
	 * @param  int $id [primary key]
	 * @return redirect
	 */

	public function receipt_statement()
	{	
		$this->form_validation->set_rules('student_id', 'student_id', 'required|trim');
		$this->form_validation->set_rules('start_date', 'month-from', 'required|trim');
		$this->form_validation->set_rules('end_date', 'end_date', 'required|trim');
		if($this->form_validation->run() == false) {
			$this->template->set('title', 'Receipt Statement');
			$data['studs'] = $this->mdl_student->get_all();
			$this->template->load('template', 'contents', 'sale/receipt_statement',$data);
		}else {
			$post = $this->input->post(null, true);
			$cleanPost = $this->security->xss_clean($post);
					$student_id = $cleanPost['student_id'];
					$from = $cleanPost['start_date'];
					$to = $cleanPost['end_date'];
			if($student_id!="All" && !empty($student_id) && !empty($from)&& !empty($to)){
				$data['infos'] = $this->mdl_sale->inventrysale($student_id,$from,$to);
			}elseif($student_id =="All" && !empty($student_id) && !empty($from)&& !empty($to))
			{
				$data['infos'] = $this->mdl_sale->inventrysale($student_id,$from,$to);
			}
			$data['studs'] = $this->mdl_student->get_all();
			$this->template->set('title', 'Receipt Statement');
			$this->template->load('template', 'contents', 'sale/receipt_statement',$data);
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

}

/* End of file Blocks.php */
/* Location: ./application/modules/setting/controllers/Blocks.php */