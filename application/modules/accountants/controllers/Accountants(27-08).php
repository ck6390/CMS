<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
 * Ganga Memorial CMS
 *
 * @author		Amit Kumar
 * @copyright	Copyright (c) 2019
 */

/**
 * Class Accountants
 */

class Accountants extends Base_Controller
{
	/**
	 * Dashboard_Controller constructor.
	 */
	public function __construct()
	{
		// controller constructor
		parent::__construct();
		$this->load->model('accountant', 'mdl_accountant');
		$this->load->model('debit', 'mdl_debit');
		$this->load->model('students/student', 'mdl_student');
		$this->load->module('setting/branches');
		$this->load->module('accounting/fee_types');
		$this->load->module('setting/payment_modes');
		$this->load->model('setting/debit_purpose','mdl_debit_purpose');
		$this->load->module('setting/semesters');
		$this->load->module('setting/general_settings');
		$this->load->module('setting/sessions');
		$this->load->model('accounting/payment','mdl_payment');
		$this->load->model('library/book_issue','mdl_book_issue');
		$this->load->model('hostel/hostel_invoice','mdl_hostel_invoice');
		$this->load->model('accounting/invoice','mdl_invoice');
	}

	/**
	 * Admin Dashboard.
	 * @return void [load view page]
	 */
	public function index()
	{
		$this->template->set('title', 'Dashboard Accountant');
		$this->template->load('template', 'contents', 'accountants/dashboard_accountant');
	}

	/**
	 * Accountant Dashboard Search for student.
	 * @return void [load view page]
	 */
	public function accountant_search()
	{
		$search_item = $this->input->post('search');

		if ($search = $this->mdl_student->searchStudent($search_item)){
		$id = $search->student_p_id;

			redirect('accountants/student_profile/'.$id, 'refresh');

		}else{

			$this->session->set_flashdata('error', "Error, Please enter correct student id!");
			redirect('accountants', 'refresh');
		}
	}

	/**
	 *Student List For Accountant.
	 * @return void [load view page]
	 */
	public function student_list()
	{	
		$data['lists'] = $this->mdl_student->get_branch_session();
		$this->template->set('title', 'Student List');
		$this->template->load('template', 'contents', 'accountants/student_list', $data);
	}

	/**
	 *
	 * Student Profile For Accountant.
	 * @return void [load view page]
	 */
	public function student_profile($id)
	{
		$this->template->set('title', 'Student Profile');
		$data['info'] = $this->mdl_student->get_student_profile($id);
		$data['fee_dues'] = $this->mdl_student->get_due_fee_amount($id);
		$data['library_dues'] = $this->mdl_student->get_due_library_fine($id);
		$data['hostel_dues'] = $this->mdl_student->get_due_hostel_due($id);
		$data['hostel_room'] = $this->mdl_student->get_due_hostel_room($id);
		$data['hostel_mess'] = $this->mdl_student->get_due_hostel_mess($id);
		$data['fee_types'] = $this->mdl_accountant->aplicable_fee($id);
		//$data['academicFee'] = $this->mdl_accountant->academic_fee($id);
		$this->template->load('template', 'contents', 'accountants/student_profile',$data);
	}

	public function feeduesmodel()
	{	
		$feeTypeId = $_POST["feeTypeId"];
		$StudentId = $_POST["StudentId"];
		$feeGroup = $_POST["feeGroup"];
		$fee_group = $this->mdl_accountant->fee_group($feeGroup);
		
		if($fee_group->fee_group_name == "Admission"){
			
			$result= $this->mdl_accountant->academic_fee_Due_list($StudentId,$feeTypeId);
			foreach($result as $obj)
			{
				echo 	"<tr>
						<td>".$obj->fee_type_name."</td>
					 	<td>".$obj->due_amount."</td>
					 	<td>".$obj->paid_status."</td>
					 	</tr>";
			}
		}elseif($fee_group->fee_group_name == "Library"){
			
			$result= $this->mdl_accountant->library_accoutant_due($StudentId,$feeTypeId);
			foreach($result as $obj)
			{
				echo 	"<tr>
						<td>".$obj->fee_type_name."</td>
					 	<td>".$obj->library_fine."</td>
					 	<td>".$obj->paid_status."</td>
					 	</tr>";
			}
		}elseif($fee_group->fee_group_name == "Hostel"){
			$result= $this->mdl_accountant->student_hostel_accoutant_due($StudentId,$feeTypeId);	
			foreach($result as $obj)
			{
				echo 	"<tr>
						<td>".$obj->fee_type_name." ".$obj->hostel_charge_month."</td>
					 	<td>".$obj->due_amount."</td>
					 	<td>".$obj->paid_status."</td>
					 	</tr>";
			}
		}
		
	}

	public function academic_fee_dues()
	{

		$feeStructureId = $_POST["feeStructureId"];
		$StudentId = $_POST["StudentId"];
		$result = $this->mdl_accountant->academic_fee_Due_list($StudentId,$feeStructureId);	
		foreach($result as $obj)
		{
			echo 	"<tr>
					<td>".$obj->fee_structure_title."</td>
				 	<td>".$obj->session_name."</td>
				 	<td>".$obj->fee_structure_type."</td>
				 	<td>".$obj->due_amount."</td>
				 	<td>".$obj->paid_status."</td>
				 	</tr>";
		}	
	}


	public function fee_deposit($id)
	{	
		$this->form_validation->set_rules('fee-type[]', 'fee-type', 'required|trim');
		$this->form_validation->set_rules('payble-amount', 'total amount', 'required|trim');
		$this->form_validation->set_rules('pay-method', 'payment method', 'required|trim');
		$this->form_validation->set_rules('paid-fee[]', 'paid fee', 'required|trim');
		$this->form_validation->set_rules('full-fee[]', 'full fee', 'required|trim');

		if($this->form_validation->run() == false) {
			$this->template->set('title', 'Student Payment');
			
			$data['info'] = $this->mdl_student->get_student_profile($id);
			$data['academicFeeList'] = $this->mdl_accountant->accoutant_due_fee_academic($id);
			$data['hostelFeeList'] = $this->mdl_accountant->accoutant_due_fee_hostel($id);

			$data['libraryFeeList'] = $this->mdl_accountant->accoutant_due_fee_library($id);
			$this->template->load('template', 'contents', 'accountants/alldues',$data);
		} else {

			$transcation_number = strtoupper(bin2hex(random_bytes(5)));
			
			$post = $this->input->post(null, true);
			$cleanPost = $this->security->xss_clean($post);
			
			$feeList = implode(',', $cleanPost['fee-type']); 
			//print_r($cleanPost['fee-type']);
			
			$table_lenth = $cleanPost['table_data'];

			
					
			for($i=0; $i<$table_lenth; $i++){

				$fee_info[] = array(
					'fee_id' => $cleanPost['fee-type'][$i],
					'amount' => $cleanPost['paid-fee'][$i]
				); 

				$length = strlen($cleanPost['fee-type'][$i]);
				$result = substr($cleanPost['fee-type'][$i], 0, 2);
				$paid_fee = $cleanPost['paid-fee'][$i];
				$full_fee = $cleanPost['full-fee'][$i];

				$balance = $cleanPost['full-fee'][$i]-$cleanPost['paid-fee'][$i];
				
				if($balance == '0'){
					$paid_status = "paid";
				}elseif($balance < $full_fee && $balance > '0'){
					$paid_status = "partial";
				}else{
					$paid_status = "Unpaid";
				}
				
				if($result == "ac"){
					$result1 = substr($cleanPost['fee-type'][$i], 2, $length);
					$paid_fees = $this->mdl_invoice->get($result1)->due_amount;
					$feeData = array(
						'due_amount' => $paid_fees+$paid_fee,
						'paid_status' => $paid_status,
					);
					$this->mdl_accountant->student_academic_fee_paid($feeData,$result1);
				}elseif($result == "hs"){
					$result1 = substr($cleanPost['fee-type'][$i], 2, $length);
					$paid_fees = $this->mdl_hostel_invoice->get($result1)->due_amount;
					$lateFine = $this->mdl_hostel_invoice->get($result1)->late_fine;
					if($lateFine == 0){
						$feeData = array(
							'due_amount' => $paid_fees+$paid_fee,
							'late_fine' => $cleanPost['late-fine'][$i],
							'paid_status' => $paid_status,
						);
						
					}else{
						$feeData = array(
							'due_amount' => $paid_fees+$paid_fee,
							'paid_status' => $paid_status,
						);
					}
					$this->mdl_accountant->student_hostel_fee_paid($feeData,$result1);
				}elseif(($result == "li")){
					$result1 = substr($cleanPost['fee-type'][$i], 2, $length);
					$paid_fine = $this->mdl_book_issue->get($result1)->library_fine;
					$feeData = array(
						'library_fine' => $paid_fee+$paid_fine,
						'paid_status' => $paid_status,
					);
					$this->mdl_accountant->student_library_fee_paid($feeData,$result1);
				}
			//print_r($feeData);
			}
			//exit;
			$formData = array(
				'student_id' => $id,
				'payment_id' => $transcation_number,
				'fee_types_id' => $feeList,
				'fee_info' => json_encode($fee_info),
				'paid_amount' => $cleanPost['payble-amount'],
				'payment_mode' => $cleanPost['pay-method'],
				'reference_no' => $cleanPost['reference-no'] ? $cleanPost['reference-no'] : "null"	,
				'created_on'   => date('Y-m-d H:i:s'),
				'created_by' => $this->session->userdata['roleID'],
			);

			if($this->mdl_payment->insert($formData) == true) {
				$this->session->set_flashdata('success', "Success, New Payment has been added!");
				$paymentId = $this->db->insert_id();
			} else {
				$this->session->set_flashdata('danger', "Error, Can't payment!");
			}
			redirect('accountants/payment_invoice/'.$paymentId, 'refresh');
		}

	}


	public function accountant_invoice_breakUp($id)
	{	
		$data['title'] = "Print Invoice";
		$data['info'] = $this->mdl_student->get_student_profile($id);
		$data['lists'] = $this->mdl_accountant->student_accoutant_due_fee($id);
		$data['totalDue'] = $this->mdl_accountant->student_accoutant_due_total($id);	
		$this->template->load_invoice('accountant_invoice_breakup', 'contents', 'accountant_invoice_breakup', $data);
	}

	/**
	 *[payment history for student.]
	 * @param  int $id [primary key]
	 * @return redirect
	 */
	
	public function payment_history($id)
	{
		$this->template->set('title', 'Student Fee/Fine');
		$data['info'] = $this->mdl_student->get($id);
		$data['payment_history'] = $this->mdl_accountant->payment_history_student($id);
		

		$this->template->load('template', 'contents', 'accountants/student_payment_history',$data);
	}
	public function payment_invoice($id)
	{
		$data['title'] = "Print Invoice";
		$data['payment_invoice'] = $this->mdl_accountant->payment_invoice_student($id);	
		
		$this->template->load_invoice('accountant_invoice', 'contents', 'accountant_invoice', $data);	
	}


	public function hostel_room_due($id)
	{	
		$data['title'] = "Hostel Dues List";
		$data['lists'] = $this->mdl_accountant->hostel_fee_due($id);
		$this->template->load('template', 'contents', 'accountants/student_hostel_room_dues',$data);
	}

	public function hostel_fooding_due($id)
	{	
		$data['title'] = "Hostel Fooding List";
		$data['lists'] = $this->mdl_accountant->hostel_fee_due($id);

		$this->template->load('template', 'contents', 'accountants/student_hostel_fooding_dues',$data);
	}

	public function academic_fee_due()
	{	
		$data['title'] = "Hostel Fooding List";
		$data['lists'] = $this->mdl_accountant->academic_fee_all_due();
		$this->template->load('template', 'contents', 'accountants/academic_fee_dues',$data);
	}

	public function library_fee_due()
	{	
		$data['title'] = "Library Due List";
		$data['lists'] = $this->mdl_accountant->library_fee_all_due();
		$this->template->load('template', 'contents', 'accountants/library_fee_dues',$data);
	}
	

	public function day_statement()
	{	
		$this->form_validation->set_rules('day_due_fee', 'day_due_fee', 'required|trim');
		$this->form_validation->set_rules('month-from', 'month-from', 'required|trim');
		$this->form_validation->set_rules('month-to', 'month-to', 'required|trim');
		
		if($this->form_validation->run() == false) {
			$this->template->set('title', 'Student Payment');
			$data['lists'] = $this->mdl_accountant->accountant_day_statement();
			$this->template->load('template', 'contents', 'accountants/day_dues_report',$data);
		}else {
			$post = $this->input->post(null, true);
			$cleanPost = $this->security->xss_clean($post);
			
			if($cleanPost['day_due_fee'] == "hostel"){

				$data['fee'] = $this->mdl_accountant->hostel_fee_between_dates($_POST["month-from"],$_POST["month-to"]);
				
			}elseif($cleanPost['day_due_fee'] == "fooding"){

				$data['fee'] = $this->mdl_accountant->fooding_fee_between_dates($_POST["month-from"],$_POST["month-to"]);

			}elseif($cleanPost['day_due_fee'] == "library"){

				$data['library_fee'] = $this->mdl_accountant->library_fee_between_dates($_POST["month-from"],$_POST["month-to"]);
			}elseif($cleanPost['day_due_fee'] == "academic_fee"){

				$data['academic_fee'] = $this->mdl_accountant->academic_fee_between_dates($_POST["month-from"],$_POST["month-to"]);

			}elseif($cleanPost['day_due_fee'] == "all"){
				$data['lists'] = $this->mdl_accountant->accountant_day_statement_between_dates($_POST["month-from"],$_POST["month-to"]);

			}
			
			$this->template->set('title', 'Student Payment');
			$this->template->load('template', 'contents', 'accountants/day_dues_report',$data);
		}
	}

	public function send_sms()
	{
		$data['title'] = "Send Due Sms";
		$this->template->load('template', 'contents', 'accountants/send_sms',$data);	

		//generate url
				$url = site_url();
				$link = '<a href="' . $url . '">' . $url . '</a>';
	
				$this->load->library('email');
				$this->load->library('sendmail');
					
				$message = $this->sendmail->sendRegister($this->input->post('clinicName'),$this->input->post('email'),$this->input->post('password'),$link);
				$to_email = $this->input->post('email');
				$this->email->from($this->config->item('register'), 'Account Login Credential ' . $this->input->post('clinicName')); //from sender, title email
				$this->email->to($to_email);
				$this->email->subject('Account Login User Id/Password');
				$this->email->message($message);
				$this->email->set_mailtype("html");			
				if($this->email->send())
				{
					
					$message = $this->input->post('clinicName').',Your account has been registered with us.<br/>Your login credential is USER ID: '.$this->input->post('email').' and PASSWORD: '.$this->input->post('password').'.<br/>Please use this user id and password to login to your dashboard at <a href="http://mas.startuppillar.in/index.php/auth/login">Appointment System Dashboard</a>';
					if($this->sendMessage($this->input->post('phone'), $message) == true)
					{
						$this->session->set_flashdata('success', "Success, Register Successfully!");
					}					
				}	
	}


	//send SMS
	public function sendMessage($phone, $message)
	{
		$message_body = urlencode($message);
		if(sendSMS($phone, $message_body))
		{
			return true;
		}
	}

	/**
	 * [Generated Receipt for student]
	 * @param  int $id [primary key]
	 * @return redirect
	 */
	public function general_receipt($id)
	{

		$this->form_validation->set_rules('receipt-title', 'receipt title', 'required|trim');

		$this->form_validation->set_rules('semester', 'semester', 'trim');
		$this->form_validation->set_rules('remarks', 'remarks', 'trim');
		$this->form_validation->set_rules('amount', 'Amount', array('required', 'trim','min_length[1]','regex_match[/(^\d+|^\d+[.]\d+)+$/]'));
		$this->form_validation->set_rules('payment-mode', 'Payment Mode', 'required|trim');

		if($this->form_validation->run() == false){
			$data['info'] = $this->mdl_student->get_student_profile($id);
			$this->template->set('title', 'Student General Receipt');
			$this->template->load('template', 'contents', 'accountants/student_general_receipt',$data);
		} else {

			
			$transcation_number = strtoupper(bin2hex(random_bytes(5)));
			$post = $this->input->post(null, true);
			$cleanPost = $this->security->xss_clean($post);

			$formData = array(
				'student_id' => $id,
				'payment_id' => $transcation_number,
				'fk_semester_id' => $cleanPost['semester'] ? $cleanPost['semester']:" ",
				'other_fee' => $cleanPost['receipt-title'],
				'fee_types_id' => "other",
				'paid_amount' => $cleanPost['amount'],
				'payment_mode' => $cleanPost['payment-mode'],
				'reference_no' => $cleanPost['remarks'] ? $cleanPost['remarks'] : " ",
				'created_on'   => date('Y-m-d H:i:s'),
				'created_by'   => $this->session->userdata['roleID'],
			);
			
			// insert to database
			if($this->db->insert('payments',$formData)) {
				$this->session->set_flashdata('success', "Success, New Receipt Generated successfully!");
				$paymentId = $this->db->insert_id();
			} else {
				$this->session->set_flashdata('error', "Error, Can't generate new receipt!");
			}
			redirect('accountants/payment_invoice/'.$paymentId, 'refresh');
		}
	}

	/**
	 * [Generated Receipt for student]
	 * @param  int $id [primary key]
	 * @return redirect
	 */
	public function offline_payment($id)
	{

		$this->form_validation->set_rules('fee-group', 'Fee Group', 'required|trim');
		$this->form_validation->set_rules('payment-title', 'Payment Title', 'required|trim');
		$this->form_validation->set_rules('amount', 'Amount', array('required', 'trim','min_length[1]','regex_match[/(^\d+|^\d+[.]\d+)+$/]'));
		$this->form_validation->set_rules('payment-mode', 'Payment Mode', 'required|trim');
		$this->form_validation->set_rules('date', 'Date', 'required|trim');

		if($this->form_validation->run() == false){

			$data['info'] = $this->mdl_student->get_student_profile($id);
			$data['lists'] = $this->mdl_accountant->getPayment($id);
			//print_r($data['lists']); exit;
			$data['fee_dues'] = $this->mdl_student->get_due_fee_amount($id);
			$data['library_dues'] = $this->mdl_student->get_due_library_fine($id);

			$this->template->set('title', 'Student General Receipt');
			$this->template->load('template', 'contents', 'accountants/student_offline_payment',$data);
		} else {

			$post = $this->input->post(null, true);
			$cleanPost = $this->security->xss_clean($post);

			$formData = array(
				'student_id' => $id,
				'fee_group_id' => $cleanPost['fee-group'],
				'payment_title' => $cleanPost['payment-title'],
				'amount' => $cleanPost['amount'],
				'pay_mode_id' => $cleanPost['payment-mode'],
				'date' => $cleanPost['date'],
				'ref_no' => $cleanPost['ref-cheque-no'] ? $cleanPost['ref-cheque-no'] : null,
				'description' => $cleanPost['description'] ? $cleanPost['description'] : null,
				'created_by' => $this->session->userdata['roleID'],
			);

			// insert to database
			if($this->db->insert('offline_payments',$formData)) {
				$this->session->set_flashdata('success', "Success, Offline payment Entry Successful!");
			} else {
				$this->session->set_flashdata('error', "Error, Can't entry offline payment!");
			}
			redirect('accountants/offline_payment/'.$id, 'refresh');
		}
	}

	public function debit()
	{
		$this->form_validation->set_rules('pay-to', 'pay-to', 'required|trim');
		$this->form_validation->set_rules('purpose', 'purpose', 'required|trim');
		$this->form_validation->set_rules('payble-amount', 'total amount', 'required|trim');
		$this->form_validation->set_rules('pay-method', 'payment method', 'required|trim');
		$this->form_validation->set_rules('remarks', 'remarks', 'trim');
		$this->form_validation->set_rules('reference-no', 'reference no', 'trim');
		
		if($this->form_validation->run() == false) {
			$this->template->set('title', 'Debit');
			$this->template->load('template', 'contents', 'accountants/debit');
		} else {

			$transcation_number = strtoupper(bin2hex(random_bytes(5)));
			$post = $this->input->post(null, true);
			$cleanPost = $this->security->xss_clean($post);
			
			$formData = array(
				'debit_id' => $transcation_number,
				'paid_to' => $cleanPost['pay-to'],
				'purpose' => $cleanPost['purpose'],
				'amount' => $cleanPost['payble-amount'],
				'fk_peyment_mode_id' => $cleanPost['pay-method'],
				'payment_mode_reference' => $cleanPost['reference-no'] ? $cleanPost['reference-no'] : " "	,
				'remarks' => $cleanPost['remarks'] ? $cleanPost['remarks'] : " "	,
				'created_on'   => date('Y-m-d H:i:s'),
				'created_by' => $this->session->userdata['roleID'],
			);
			
			
			if($this->mdl_debit->insert($formData) == true) {
				$this->session->set_flashdata('success', "Success, New Debit Voucher has been generated!");
				$debit_id = $this->db->insert_id();
			} else {
				$this->session->set_flashdata('danger', "Error, Can't debit!");
			}
			redirect('accountants/debit_invoice/'.$debit_id, 'refresh');
		}
	}

	public function debit_invoice($id)
	{
		$data['title'] = "Debit Invoice";
		$data['debit_invoice'] = $this->mdl_debit->get($id);
		$this->template->load_invoice('debit_invoice', 'contents', 'debit_invoice', $data);	
	}

	public function debit_statement()
	{	
		$this->form_validation->set_rules('purpose', 'purpose', 'required|trim');
		$this->form_validation->set_rules('month-from', 'month-from', 'required|trim');
		$this->form_validation->set_rules('month-to', 'month-to', 'required|trim');
		
		if($this->form_validation->run() == false) {
			$this->template->set('title', 'Debit Satement');
			$data['lists'] = $this->mdl_accountant->accountant_debit_statement();
			$this->template->load('template', 'contents', 'accountants/debit_statement',$data);
		}else {
			$post = $this->input->post(null, true);
			$cleanPost = $this->security->xss_clean($post);
			
			$data['lists'] = $this->mdl_accountant->accountant_debit_statement_between_dates($_POST["purpose"],$_POST["month-from"],$_POST["month-to"]);
			$this->template->set('title', 'Student Payment');
			$this->template->load('template', 'contents', 'accountants/debit_statement',$data);
		}
	}


}

/* End of file Accountants.php */
/* Location: ./application/modules/accountants/controllers/Accountants.php */
