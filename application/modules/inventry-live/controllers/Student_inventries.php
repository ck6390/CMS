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

class Student_inventries extends Base_Controller
{
	/**
	 * Permissions_Controller constructor.
	 */
	public function __construct()
	{
		// controller constructor
		parent::__construct();
		$this->load->model('Student_inventry', 'mdl_stu_inventry');
		$this->load->model('stock', 'mdl_stock');
		$this->load->model('inventry_stock', 'mdl_inventry_stock');
		$this->load->model('payment_mode', 'mdl_pay_mode');
		$this->load->module('setting/general_settings');
	}

	/**
	 * [Fetch all Block list.]
	 * @param  void
	 * @return view
	 */
	public function index()
	{
		//$inventory = $this->mdl_stu_inventry->inventoryStocks();
       //var_dump($inventory);die();
		$studs = $this->mdl_stu_inventry->get_student();
		//var_dump($studs); 
		foreach($studs as $stud) {
			$stu[$stud->student_unique_id] = $stud->student_full_name;
		  }
		$data['stu'] = $stu;
		$data['lists'] = $this->mdl_stu_inventry->get_all();
		if(!empty($this->input->post('start_date')) && !empty($this->input->post('end_date'))){
			$from = $this->input->post('start_date');
	        $to = $this->input->post('end_date');
			$data['lists'] =  $this->mdl_stu_inventry->searchSell($from,$to); 
		}  
		$this->template->set('title', 'Receipt List');
		$this->template->load('template', 'contents', 'student_inventry/list', $data);
	}

	/**
	 * [Insert a new block record.]
	 * @param  void
	 * @return redirect
	 */
	public function add()
	{  
		//die();
		$this->form_validation->set_rules('student_id', 'Student id', 'required|trim');
		$this->form_validation->set_rules('sell_on_date', 'Sell Date', 'required|trim');
		$this->form_validation->set_rules('total_price', 'Total Price', 'required|trim');
		$this->form_validation->set_rules('pay_mode', 'Pay Mode', 'required|trim');
		$this->form_validation->set_rules('transaction_no', 'Transaction no', 'required|trim');
		$this->form_validation->set_rules('remark', 'remark');
		if($this->form_validation->run() == false) {
			$this->template->set('title', 'Receipt Add');
			$data['inventries'] = $this->mdl_stu_inventry->invStocks();
			$data['studs'] = $this->mdl_stu_inventry->get_student();
			$this->template->load('template', 'contents', 'student_inventry/add',$data);
		} else {
			$post = $this->input->post(null, true);
			$sell_info = '';
			$cleanPost = $this->security->xss_clean($post);	
			//var_dump(count($cleanPost['stock_id']));die();
			for ($i=0; $i < count($cleanPost['inventry_id']) ; $i++) { 
				if($cleanPost['quantity']>0){
					$json_data = array(
						'inventry_id' => $cleanPost['inventry_id'][$i],
						'stock_id' => $cleanPost['stock_id'][$i],
						'stock_name' => $cleanPost['stock_name'][$i], 
						'quantity' => $cleanPost['quantity'][$i], 
						'unit_price' => $cleanPost['unit_price'][$i], 
						'sub_price' => $cleanPost['sub_price'][$i], 
					);
					$upData = array(
						'available_quantity' => $cleanPost['avquantity'][$i],
					);
					// echo $cleanPost['inventry_id'][$i];
					$sell_info[$i] = $json_data;
					$up_data[$cleanPost['inventry_id'][$i]] = $upData;
				}
			}
			//var_dump($up_data);
			$order_info = array(
				'items' => $sell_info,
				'total_price' =>$cleanPost['total_price'],
				'pay_mode' =>$cleanPost['pay_mode'],
				'transaction_no' =>$cleanPost['transaction_no'],
				'remark' =>$cleanPost['remark']
			);
			$json_info = json_encode($order_info);			
			$formData = array(
				'sell_on_date' => $cleanPost['sell_on_date'],
				'student_id' => $cleanPost['student_id'],
				'sell_info' =>$json_info
				
			);
			/*echo "<PRe>";
			print_r($_POST);*/
			/*foreach ($variable as $key => $value) {
				# code...
			}*/
			
			$data['inventries'] = $this->mdl_stu_inventry->invStocks();
			//var_dump($data['inventries']);
			//if()
			if($this->mdl_stu_inventry->insert($formData) == true) {
				$receiptId = $this->db->insert_id();
				foreach ($up_data as $key => $up_data) {
					$available_data = array('available_quantity' => $up_data['available_quantity']);
					$this->mdl_inventry_stock->update($available_data, $key);
				}
				$this->session->set_flashdata('success', "Success, New Receipt has been added!");
			} else {
				$this->session->set_flashdata('danger', "Error, Can't add new Inventry Stocks!");
			}
			redirect('inventry/student_inventries/receipt_invoice/'.$receiptId, 'refresh');
		}
	}
	/**
	 * [sell view.]
	 * @param  int $id [primary key]
	 * @return redirect
	 */

	public function receipt_invoice($id)
	{
		//
		//die('aaaa');
		$data['title'] = "Print Invoice";
		$data['receipt'] = $this->mdl_stu_inventry->receipt_invoice_student($id);	
		// var_dump($data['receipt']);die();
		$this->template->load_invoice('receipt_invoice', 'contents', 'receipt_invoice', $data);	
	}
	
	/**
	 * [sell view.]
	 * @param  int $id [primary key]
	 * @return redirect
	 */
	public function view($id)
	{	
		$students = $this->mdl_stu_inventry->get_student_details($id);
		//var_dump($students);
		foreach ($students as $student) {
			$s_array[$student->student_unique_id] = $student->student_full_name;
			$add_array[$student->student_unique_id] = $student->admission_no;
		}
		$data['stud_name']=$s_array;
		$data['stud_add']=$add_array;
		$this->template->set('title', 'Receipt Report');
		$data['info'] = $this->mdl_stu_inventry->get($id);
		$this->template->load('template', 'contents', 'student_inventry/view',$data);
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
			$data['studs'] = $this->mdl_stu_inventry->get_student();
			//var_dump($data);
			$this->template->load('template', 'contents', 'student_inventry/receipt_statement',$data);
		}else {
			$studs= $this->mdl_stu_inventry->get_student();
			foreach($studs as $stud) {
			$stu[$stud->student_unique_id] = $stud->student_full_name;
			$add[$stud->student_unique_id] = $stud->admission_no;
			  }
			   $data['stu'] = $stu;
			   $data['add'] = $add;
			$post = $this->input->post(null, true);
			$cleanPost = $this->security->xss_clean($post);
					$student_id = $cleanPost['student_id'];
					$from = $cleanPost['start_date'];
					$to = $cleanPost['end_date'];
			if($student_id!="All" && !empty($student_id) && !empty($from)&& !empty($to)){
				$data['infos'] = $this->mdl_stu_inventry->inventrySell($student_id,$from,$to);
				//var_dump($data['infos']);
			}elseif($student_id =="All" && !empty($student_id) && !empty($from)&& !empty($to))
			{
				$data['infos'] = $this->mdl_stu_inventry->inventrySell($student_id,$from,$to);
			}
			$data['studs']= $this->mdl_stu_inventry->get_student();
			$this->template->set('title', 'Receipt Statement');
			$this->template->load('template', 'contents', 'student_inventry/receipt_statement',$data);
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