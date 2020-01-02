<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
 * Ganga Memorial CMS
 *
 * @author		Vishwajeet Kumar
 * @copyright	Copyright (c) 2019
 */

/**
 * Class Hostel_invoices
 */

class Hostel_invoices extends Base_Controller
{
	/**
	 * Fees_Controller constructor.
	 */
	public function __construct()
	{
		// controller constructor
		parent::__construct();
		$this->load->model('hostel_invoice', 'mdl_hostel_invoice');
		$this->load->model('accounting/payment', 'mdl_payment');
		$this->load->model('setting/session','mdl_session');
		$this->load->model('setting/course_year','mdl_course_year');
		$this->load->model('setting/branch','mdl_branch');
		$this->load->model('accounting/fee_type','mdl_fee_type');
		$this->load->module('setting/semesters');
		
	}

	/**
	 * [Fetch all Fee list.]
	 * @param  void
	 * @return view
	 */
	public function index()
	{
		$data['lists'] = $this->mdl_hostel_invoice->get_hostel_invoice();
		
		
		$this->template->set('title', 'Fee List');
		$this->template->load('template', 'contents', 'invoices/invoice_list', $data);
	}

	/**
	 * [Insert a new Fees record.]
	 * @param  void
	 * @return redirect
	 */
	public function add()
	{	
		
		$this->form_validation->set_rules('session', 'session', 'required|trim');
		$this->form_validation->set_rules('year', 'course Year', 'required|trim');
		$this->form_validation->set_rules('gender', 'gender', 'required|trim');
		$this->form_validation->set_rules('branch[]', 'branch', 'required|trim');
		$this->form_validation->set_rules('fee-amount', 'fee amount', 'required|trim');
		$this->form_validation->set_rules('invoice-for', 'invoice for', 'required|trim');
		
			
		if($this->form_validation->run() == false) {
			$data['lastId'] = $this->mdl_hostel_invoice->get_next_id();
			$this->template->set('title', 'Add Fee');
			$this->template->load('template', 'contents', 'invoices/invoice_add',$data);
		} else {
			$post = $this->input->post(NULL, TRUE);
			$cleanPost = $this->security->xss_clean($post);

			if($cleanPost['invoice-for'] == "student"){
				$studentsList = $cleanPost['student-id'];
				foreach($studentsList as $students){
					$this->db->trans_begin();

					$feeInvoiceStudent = array(
						'student_id' => $students,
						'fk_fee_type_id' => $cleanPost['fee-type'],
						'hostel_charge_month' => $cleanPost['month'],
						'fee_amount' => $cleanPost['fee-amount'],
						'due_amount' => $cleanPost['fee-amount'],
						'created_by' => $this->session->userdata['roleID'],
						'remarks' => $cleanPost['description'] ? $cleanPost['description'] : null
					);
					
					$this->db->insert('hostel_fees',$feeInvoiceStudent);
					$this->db->trans_complete();
					
				}
			}else{
						
				$data1 = array(
					'fk_session_id' => $cleanPost['session'],
					'fk_course_year_id' => $cleanPost['year'],
					'gender' => $cleanPost['gender'],
					'hostel_status' => '1',
					'is_active' =>'1'
				);
					
				$branch = $cleanPost['branch'];
				$students = $this->mdl_hostel_invoice->get_Students_for_invoice($data1,$branch);
				if(!empty($students)){
					foreach($students as $student){ 
						$this->db->trans_begin();
						$feeInvoiceStudent = array(
							
							'student_id' => $student->student_p_id,
							'fk_fee_type_id' => $cleanPost['fee-type'],
							'hostel_charge_month' => $cleanPost['month'],
							'fee_amount' => $cleanPost['fee-amount'],
							'due_amount' => "0.00",
							'late_fine' => "0.00",
							'created_by' => $this->session->userdata['roleID'],
							'remarks' => $cleanPost['description'] ? $cleanPost['description'] : null
						);
						$this->db->insert('hostel_fees',$feeInvoiceStudent);
						$this->db->trans_complete();
						//var_dump($feeInvoiceStudent);
					}	
					//exit;
				}else{
					$this->session->set_flashdata('danger', "Error, Student Not Found!");
				}
			}

			$this->session->set_flashdata('success', "Success, Invoice Generated For Hostel !");

			redirect('hostel/hostel_invoices', 'refresh');
		}
	}

	public function edit($id)
	{
		$this->form_validation->set_rules('month', 'month', 'required|trim');
		

		if($this->form_validation->run() == false) {
			$data['info'] = $this->mdl_hostel_invoice->get($id);
			$this->template->set('title', 'Edit Room');
			$this->template->load('template', 'contents', 'invoices/invoice_edit', $data);
		} else {
			$post = $this->input->post(null, true);
			$cleanPost = $this->security->xss_clean($post);
			$formData = array(
				'hostel_charge_month' => $cleanPost['month'],
				'late_fine' => $cleanPost['late-fine'],
				'paid_status' => $cleanPost['status'],
				'due_amount' => $cleanPost['due_amount'],
			);
			
			// update to database
			if($this->mdl_hostel_invoice->update_invoice($formData, $id) == true) {
				$this->session->set_flashdata('successe', "Success, User has been updated!");
			} else {
				$this->session->set_flashdata('error', "Error, Can't update the user!");
			}
			redirect('hostel/hostel_invoices', 'refresh');
		}
	}
	/**
	 * [Delete record from list.]
	 * @param  void
	 * @return boolean
	 */
	public function delete($id)
	{
		if($this->mdl_hostel_invoice->deletd_hostel_inv($id) == true) {
			$this->session->set_flashdata('success', "Success, deleted successfully!");
		} else {
			$this->session->set_flashdata('error', "Error, Can't delete!");
		}
		redirect('hostel/hostel_invoices', 'refresh');
	}

	/**
	 * [Delete record permanently from database.]
	 * @param  int $id [primary key]
	 * @return redirect
	 */
	public function force_delete($id)
	{
		if($this->mdl_hostel_invoice->force_delete($id) == true) {
			$this->session->set_flashdata('success', 'DELETED!');
		} else {
			$this->session->set_flashdata('error', 'ERROR!');
		}
		redirect('hostel/hostel_invoices', 'refresh');
	}

	/**
	 * [Fetch Student record from database.]
	 * @param  int $id [primary key]
	 * @return redirect
	 */
	public function student_hostel_for_Invoice()
	{
		$session = $_POST['session'];
		$branch = $_POST['branch'];
		$year = $_POST['year'];
		$gender = $_POST['gender'];
		$data1 = array(
				'fk_session_id' => $session,
				'fk_course_year_id' => $year,
				'gender' => $gender,
				'hostel_status' => '1',
				'is_active' =>'1'
		);
		
		$this->db->select('student_p_id, student_unique_id')->from('students')->where($data1);
		$this->db->where_in('fk_branch_id', $branch);

		$query = $this->db->get();
		$result = $query->num_rows() > 0 ? $query->result() : false;
		echo json_encode($result);
	}

	public function get_fee_structure()
	{
		$session = $_POST['session'];
		$year = $_POST['year'];
		$data1 = array(
				'session_ID' => $session,
				'course_year' => $year,
				'is_active' =>'1'
		);
		$this->db->select('*')->from('fee_structures')->where($data1);

		$query = $this->db->get();
		$result = $query->num_rows() > 0 ? $query->result() : false;
		echo json_encode($result);
		
	}

	public function view_hostel_invoice($id){
		$data['info'] = $this->mdl_hostel_invoice->get_hostel_invoice_info($id);
		$this->template->set('title', 'View Invoice');
		$this->template->load('template', 'contents', 'invoices/invoice_view', $data);
	}

	/**
	 * [Fetch Single Invoice Payment records.]
	 * @param  void
	 * @return view
	 */

	public function hostel_invoice_payment($invoice_id,$student_id){


		$this->form_validation->set_rules('payment-id', 'Payment Entry', 'required|trim|is_unique[payments.payment_id]');
		$this->form_validation->set_rules('payment-date', 'Payment Date', 'required|trim');
		$this->form_validation->set_rules('pay-amount', 'Payable Amount', 'required|trim');
		$this->form_validation->set_rules('pay-method', 'Payment Method', 'required|trim');		

		if($this->form_validation->run() == FALSE)
		{
				$data['lastId'] = $this->mdl_payment->get_next_id();
				$data['info'] = $this->mdl_hostel_invoice->get_hostel_invoice_info($invoice_id);
				$data['payment_history'] = $this->mdl_hostel_invoice->invoice_payment($invoice_id);
				$this->template->set('title', 'Invoice Payment');
				$this->template->load('template', 'contents', 'invoices/invoice_payment',$data);
		}
		else
		{    
			$post = $this->input->post(NULL, TRUE);
			$cleanPost = $this->security->xss_clean($post);
			$dueAmount = $cleanPost['due-balance'];
			$paidAmount = $cleanPost['pay-amount'];
			$balanceAmount = $dueAmount - $paidAmount;
			
			$formData = array(
				'payment_id' => $cleanPost['payment-id'],
				'invoice_id' => $invoice_id,
				'student_id' => $student_id,
				'payment_date' => $cleanPost['payment-date'],
				'paid_amount' => $paidAmount,
				'payment_mode' => $cleanPost['pay-method'],
				'reference_no' => $cleanPost['reference-no'] ? $cleanPost['reference-no']:null,
			);

			if($paidAmount == $dueAmount){
					$invoicePayment = array(
						'paid_status' => 'paid',
						'due_amount' => $balanceAmount,
						'hostel_room_due' => $balanceAmount,
						
					);

			}elseif($paidAmount > 0  && $paidAmount < $dueAmount){
					
					$invoicePayment = array(
						'paid_status' => 'partialy paid',
						'due_amount' => $balanceAmount,
					);
			}
			
			//insert to database
			if($this->mdl_payment->insert($formData) == true && $this->mdl_invoice->update($invoicePayment, $invoice_id) == true)
			{	
				
				$this->session->set_flashdata('success', 'Success, Payment has been added!');
			}
			else
			{
				$this->session->set_flashdata('error', 'Error, Can\'t add  payment.');
			}
			redirect('hostel/hostel_invoices', 'refresh');
		}

		
	}

	public function h_print($id)
	{
		$data['info'] = $this->mdl_hostel_invoice->get_hostel_invoice_info($id);

		$data['title'] = "Print Invoice";
		
		$this->template->load_invoice('hostel_invoice_print', 'contents', 'hostel_invoice_print', $data);
	}
	
}

/* End of file Invoices.php */
/* Location: ./application/modules/accounting/controllers/Invoices.php */