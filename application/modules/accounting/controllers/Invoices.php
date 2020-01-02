<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
 * Ganga Memorial CMS
 *
 * @author		Vishwajeet Kumar
 * @copyright	Copyright (c) 2019
 */

/**
 * Class Invoices
 */

class Invoices extends Base_Controller
{
	/**
	 * Fees_Controller constructor.
	 */
	public function __construct()
	{
		// controller constructor
		parent::__construct();
		$this->load->model('invoice', 'mdl_invoice');
		$this->load->model('payment', 'mdl_payment');
		$this->load->module('setting/sessions');
		$this->load->module('setting/course_years');
		$this->load->module('setting/semesters');
		$this->load->module('setting/branches');
		$this->load->module('accounting/fee_types');
	}

	/**
	 * [Fetch all Fee list.]
	 * @param  void
	 * @return view
	 */
	public function index()
	{
		$data['lists'] = $this->mdl_invoice->get_all_invoice();

		$this->template->set('title', 'Fee List');
		$this->template->load('template', 'contents', 'invoices/invoice_list', $data);
	}

	/**
	 * [Insert a new Fees record.]
	 * @param  void
	 * @return redirect
	 */
	public function college_fee()
	{	
		
		$this->form_validation->set_rules('session', 'session', 'required|trim');
		$this->form_validation->set_rules('year', 'course Year', 'required|trim');
		$this->form_validation->set_rules('branch[]', 'branch', 'required|trim');
		$this->form_validation->set_rules('fee-amount', 'fee amount', 'required|trim');
		$this->form_validation->set_rules('invoice-for', 'invoice for', 'required|trim');
		
			
		if($this->form_validation->run() == false) {
			$this->template->set('title', 'Add Fee');
			$this->template->load('template', 'contents', 'invoices/invoice_add');
		} else {
			$post = $this->input->post(NULL, TRUE);
			$cleanPost = $this->security->xss_clean($post);

			if($cleanPost['invoice-for'] == "student"){
				$studentsList = $cleanPost['student-id'];
				foreach($studentsList as $students){
					$this->db->trans_begin();

					$feeInvoiceStudent = array(
						
						'student_id' => $students,
						'fk_session_id' => $cleanPost['session'],
						'fk_course_year_id' => $cleanPost['year'],
						'fk_fee_type_id' => $cleanPost['fee-type'],
						'fee_amount' => $cleanPost['fee-amount'],
						'due_amount' => "0.00",
						'remarks' => $cleanPost['description'] ? $cleanPost['description'] : null,
						'created_by' => $this->session->userdata['roleID'],
					);
					
					$this->db->insert('invoices',$feeInvoiceStudent);
					$this->db->trans_complete();
				}
				
			}else{
				
				$feestypes = $cleanPost['fee-type'];
				$branch = $cleanPost['branch'];
				$data1 = array(
					'fk_session_id' => $cleanPost['session'],
					'fk_course_year_id' => $cleanPost['year'],
					'is_active' =>'1',
					'academic_payment_status' => '0',
				);
				
				$students = $this->mdl_invoice->get_Students_for_invoice($data1,$branch);
				if(!empty($students)){
					foreach($students as $student){ 
						$this->db->trans_begin();
						$feeInvoiceStudent = array(
							
							'student_id' => $student->student_p_id,
							'fk_session_id' => $cleanPost['session'],
							'fk_course_year_id' => $cleanPost['year'],
							'fk_fee_type_id' => $cleanPost['fee-type'],
							'fee_amount' => $cleanPost['fee-amount'],
							'due_amount' => "0.00",
							'remarks' => $cleanPost['description'] ? $cleanPost['description'] : null,
							'created_by' => $this->session->userdata['roleID'],
						);

						
						$this->db->insert('invoices',$feeInvoiceStudent);
						$this->db->trans_complete();
					}		
				}else{
					$this->session->set_flashdata('danger', "Error, Student Not Found!");
				}
			}


			$this->session->set_flashdata('success', "Success, Invoice Generated For Collge Fee!");

			redirect('accounting/Invoices', 'refresh');
		}
	}

	/**
	 * [Edit fee details]
	 * @param  int $id [primary key]
	 * @return [type]     [description]
	 */
	public function edit($id) 
	{
		$this->form_validation->set_rules('paid-status', 'paid-status', 'required|trim');
		$this->form_validation->set_rules('due-amount', 'due-amount', 'required|trim');
		$this->form_validation->set_rules('fee-amount', 'fee amount', 'required|trim');
		//$this->form_validation->set_rules('fee_schedule', 'fee schedule', 'required|trim');


		if($this->form_validation->run() == false) {
			$data['info'] = $this->mdl_invoice->get($id);
			$this->template->set('title', 'Edit Fee Type');
			$this->template->load('template', 'contents', 'invoices/invoice_edit', $data);
		} else {
			$post = $this->input->post(null, true);
			$cleanPost = $this->security->xss_clean($post);
			$formData = array(
				'paid_status' => $cleanPost['paid-status'],
				//'fee_type_amount' => $cleanPost['fee-amount'],
				'due_amount' => $cleanPost['due-amount'],
			);
			// print_r($formData);
			// exit;
			// update to database
			if($this->mdl_invoice->update($formData, $id) == true) {
				$this->session->set_flashdata('successe', "Success, Fee Type has been updated!");
			} else {
				$this->session->set_flashdata('error', "Error, Can't update the fee type!");
			}
			redirect('accounting/Invoices', 'refresh');
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
		if($this->mdl_fee_type->update($data, $id) == true) {
			$this->session->set_flashdata('success', "Success, Activated successfully!");
		} else {
			$this->session->set_flashdata('error', "Error, Can't activate!");
		}
		redirect('accounting/invoices', 'refresh');
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
		if($this->mdl_fee_type->update($data, $id) == true) {
			$this->session->set_flashdata('success', "Success, Deactivated successfully!");
		} else {
			$this->session->set_flashdata('error', "Error, Can't deactivate!");
		}
		redirect('accounting/fee_types', 'refresh');
	}

	/**
	 * [Delete record from list.]
	 * @param  void
	 * @return boolean
	 */
	public function delete()
	{
		$id = $this->input->post('primary_id');
		if($this->mdl_invoice->delete($id) == true) {
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
		if($this->mdl_fee_type->force_delete($id) == true) {
			$this->session->set_flashdata('success', 'DELETED!');
		} else {
			$this->session->set_flashdata('error', 'ERROR!');
		}
		redirect('accounting/invoices', 'refresh');
	}

	/**
	 * [Fetch Student record from database.]
	 * @param  int $id [primary key]
	 * @return redirect
	 */
	public function get_student_for_Invoice()
	{
		$session = $_POST['session'];
		$branch = $_POST['branch'];
		$year = $_POST['year'];
		$data1 = array(
				'fk_session_id' => $session,
				'fk_course_year_id' => $year,
				'academic_payment_status' => '0',
				'is_active' =>'1'
		);
		
		$this->db->select('student_p_id, student_unique_id')->from('students')->where($data1);
		$this->db->where_in('fk_branch_id', $branch);

		$query = $this->db->get();
		$result = $query->num_rows() > 0 ? $query->result() : false;
		echo json_encode($result);
	}

	/**
	 * [fetch semester fee.]
	 * @param  void
	 * @return view
	 */
	public function get_semester_fee(){
		$session = $_POST['session'];
		$year = $_POST['year'];
		$semester = $_POST['semester'];
		$feestypes = $_POST['feestypes'];
		$data1 = array(
				'session_ID' => $session,
				'course_year' => $year,
				'fk_semester_id' => $semester,
				'fee_structure_type' => $feestypes,
				'is_active' =>'1'
		);
		$this->db->select('semester_fee,total_fee,fee_structure_p_id')->from('fee_structures')->where($data1);

		$query = $this->db->get();
		$result = $query->num_rows() > 0 ? $query->row() : false;
		echo json_encode($result);
	}

	/**
	 * [fetch semester fee.]
	 * @param  void
	 * @return view
	 */
	public function get_annual_fee(){
		$session = $_POST['session'];
		$year = $_POST['year'];
		$feestypes = $_POST['feestypes'];
		$data1 = array(
				'session_ID' => $session,
				'course_year' => $year,
				'fee_structure_type' => $feestypes,
				'is_active' =>'1'
		);
		$this->db->select('*')->from('fee_structures')->where($data1);

		$query = $this->db->get();
		$result = $query->num_rows() > 0 ? $query->row() : false;
		echo json_encode($result);
	}

	public function view($id){
		$data['info'] = $this->mdl_invoice->get_invoice_info($id);
		
		$this->template->set('title', 'View Invoice');
		$this->template->load('template', 'contents', 'invoices/invoice_view', $data);
	}

	/**
	 * [Fetch Single Invoice Payment records.]
	 * @param  void
	 * @return view
	 */

	public function payment($id){


		$this->form_validation->set_rules('payment-id', 'Payment Entry', 'required|trim|is_unique[payments.payment_id]');
		$this->form_validation->set_rules('payment-date', 'Payment Date', 'required|trim');
		$this->form_validation->set_rules('pay-amount', 'Payable Amount', 'required|trim');
		$this->form_validation->set_rules('pay-method', 'Payment Method', 'required|trim');		

		if($this->form_validation->run() == FALSE)
		{
				$data['lastId'] = $this->mdl_payment->get_next_id();
				$data['info'] = $this->mdl_invoice->get_invoice_info($id);
				$data['payment_history'] = $this->mdl_invoice->invoice_payment($id);
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
				'invoice_id' => $id,
				'payment_date' => $cleanPost['payment-date'],
				'paid_amount' => $paidAmount,
				'payment_mode' => $cleanPost['pay-method'],
				'reference_no' => $cleanPost['reference-no'] ? $cleanPost['reference-no']:null,
			);
			
			if($paidAmount == $dueAmount){
					$invoicePayment = array(
						'paid_status' => 'paid',
						'due_amount' => $balanceAmount,
					);

			}elseif($paidAmount > 0  && $paidAmount < $dueAmount){
					
					$invoicePayment = array(
						'paid_status' => 'partialy paid',
						'due_amount' => $balanceAmount,
					);
			}
			
			//insert to database
			if($this->mdl_payment->insert($formData) == true && $this->mdl_invoice->update($invoicePayment, $id) == true)
			{	
				
				$this->session->set_flashdata('success', 'Success, Payment has been added!');
			}
			else
			{
				$this->session->set_flashdata('error', 'Error, Can\'t add  payment.');
			}
			redirect('accounting/invoices', 'refresh');
		}

		
	}

	public function print_invoice($id)
	{
		$data['info'] = $this->mdl_invoice->get_invoice_info($id);

		$data['title'] = "Print Invoice";
		
		$this->template->load_invoice('invoice_print', 'contents', 'invoice_print', $data);
	}
	
}

/* End of file Invoices.php */
/* Location: ./application/modules/accounting/controllers/Invoices.php */