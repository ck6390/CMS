<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
 * Ganga Memorial CMS
 *
 * @author		Manoj Kumar
 * @copyright	Copyright (c) 2019
 */

/**
 * Class Accountant
 */

class Accountant extends Base_Model
{
	function __construct()
	{
		// call the model constructor
		parent::__construct();
	}
	

	public function library_accoutant_due($StudentId,$feeTypeId)
	{
		$data = array(
				
				'BKISU.student_id'=> $StudentId,
				'BKISU.fine_type_id'=> $feeTypeId,
				'BKISU.paid_status !='=> "paid",
				'BKISU.is_active '=> '0',

		);

		$this->db->select('BKISU.*,FT.fee_type_name');
		$this->db->from('book_issues AS BKISU');
		$this->db->join("fee_types AS FT", "FT.fee_type_p_id = BKISU.fine_type_id",'left');
        $this->db->where($data);
       	$query = $this->db->get();
		return $query->result();
	}

	public function student_hostel_accoutant_due($StudentId,$feeTypeId)
	{
		$data = array(
				
				'HFS.student_id'=> $StudentId,
				'HFS.fk_fee_type_id'=> $feeTypeId,
				'HFS.paid_status !='=> "paid",
				'HFS.deleted !=' => '1',

		);

		$this->db->select('HFS.*,FT.fee_type_name');
		$this->db->from('hostel_fees AS HFS');
		$this->db->join("fee_types AS FT", "FT.fee_type_p_id = HFS.fk_fee_type_id",'left');
        $this->db->where($data);
       	$query = $this->db->get();
		return $query->result();
	}


	public function aplicable_fee($id)
	{
		$this->db->select('FTP.fee_type_p_id,FTP.fee_type_name,FTP.fee_group');
		$this->db->from('fee_types AS FTP');
		$this->db->join("hostel_fees AS HFS", "HFS.fk_fee_type_id = FTP.fee_type_p_id",'left');
		$this->db->join("book_issues AS BKISU", "BKISU.fine_type_id = FTP.fee_type_p_id",'left');
		$this->db->join("invoices AS INV", "INV.fk_fee_type_id = FTP.fee_type_p_id",'left');
		$this->db->where('HFS.student_id',$id);
		$this->db->or_where('BKISU.student_id',$id);
		$this->db->or_where('INV.student_id',$id);

		$this->db->distinct();
       	$query = $this->db->get();
		return $query->result();
	}

	public function fee_group($feeGroup)
	{
		$this->db->select('fee_group_name');
		$this->db->from('fee_groups');
		$this->db->where('fee_groups.fee_group_p_id',$feeGroup);
       	return  $this->db->get()->row();
	}

	public function academic_fee_Due_list($StudentId,$feeStructureId)
	{
		$data = array(
				
				'INV.student_id'=> $StudentId,
				'INV.fk_fee_type_id'=> $feeStructureId,
				'INV.paid_status !='=> "paid",
				'INV.deleted !=' => '1',

		);

		$this->db->select('INV.*,FT.fee_type_name,SNS.session_name');
		$this->db->from('invoices AS INV');
		$this->db->join("fee_types AS FT", "FT.fee_type_p_id = INV.fk_fee_type_id",'left');
		$this->db->join("sessions AS SNS", "SNS.session_p_id = INV.fk_session_id",'left');
        $this->db->where($data);
        
       	$query = $this->db->get();
		return $query->result();
	}

	public function accoutant_due_fee_academic($id)
	{		
		$data = array(				
				'INV.student_id'=> $id,
				'INV.paid_status !='=> "paid",
				'INV.deleted !=' => '1'
		);
		$this->db->select('INV.*,FTP.fee_type_name,INV.remarks');
		$this->db->from('invoices AS INV');
		$this->db->join("fee_types AS FTP", "FTP.fee_type_p_id = INV.fk_fee_type_id",'left');
        $this->db->where($data);        
       	$query = $this->db->get();
		return $query->result();
	}

	public function accoutant_due_fee_hostel($id)
	{
		$data = array(
				
				'HFS.student_id'=> $id,
				'HFS.paid_status !='=> "paid",
				'HFS.deleted !=' => '1'

		);
		$this->db->select('HFS.*,FT.fee_type_name');
		$this->db->from('hostel_fees AS HFS');
		$this->db->join("fee_types AS FT", "FT.fee_type_p_id = HFS.fk_fee_type_id",'left');
        $this->db->where($data);
        
       	$query = $this->db->get();
		return $query->result();
	}

	public function accoutant_due_fee_library($id)
	{
		$data = array(
				
				'BKISU.student_id'=> $id,
				'BKISU.paid_status !='=> "paid",

		);
		$this->db->select('BKISU.*,FT.fee_type_name');
		$this->db->from('book_issues AS BKISU');
		$this->db->join("fee_types AS FT", "FT.fee_type_p_id = BKISU.fine_type_id",'left');
        $this->db->where($data);
        
       	$query = $this->db->get();
		return $query->result();
	}

	public function student_academic_fee_paid($feeData,$fee_type)
	{
		$this->db->where('invoice_p_id',$fee_type);
		$this->db->update('invoices',$feeData);
	}

	public function student_hostel_fee_paid($feeData,$fee_type)
	{
		$this->db->where('hostel_fee_p_id',$fee_type);
		$this->db->update('hostel_fees',$feeData);
	}

	public function student_library_fee_paid($feeData,$fee_type)
	{
		$this->db->where('book_issue_p_id',$fee_type);
		$this->db->update('book_issues',$feeData);
	}

	public function student_accoutant_due_total($id)
	{
		$data = array(
				
				'student_p_id'=> $id,
				'INV.paid_status !='=> "paid",

		);
		
		$this->db->select_sum('INV.due_amount');
		$this->db->from('invoices AS INV');
		$this->db->join("students AS ST", "ST.student_p_id = INV.student_id",'left');
		$this->db->join("fee_types AS FT", "FT.fee_type_p_id = INV.fk_fee_type_id",'left');
        $this->db->where($data);
        
       	return $this->db->get()->row(); 
	}

	/*
	* [payment history student in admin]
	* 
	*/
	public function payment_history_student($id)
	{	
		$data = array(
				
				'PMNT.student_id'=> $id,

		);
		$this->db->select("PMNT.*");
		$this->db->from('payments AS PMNT'); 
		
		$this->db->join('students AS ST', 'ST.student_p_id = PMNT.student_id', 'left');
		
		$this->db->where($data);
		$query= $this->db->get();
    	$result=$query->result();
		return $result;
	}

	public function payment_invoice_student($id)
	{
		$data = array(
				
				'PMNT.payment_p_id'=> $id,

		);
		$this->db->select("PMNT.*,ST.student_unique_id,ST.student_full_name,ST.admission_no,PMDS.payment_mode_name");
		$this->db->from('payments AS PMNT'); 
		$this->db->join('students AS ST', 'ST.student_p_id = PMNT.student_id', 'left');
		$this->db->join('payment_mode AS PMDS', 'PMDS.payment_mode_p_id = PMNT.payment_mode', 'left');
		$this->db->where($data);
		return $this->db->get()->row();  
	}


	public function hostel_fee_due($id)
	{
		$data = array(
			
			'HFS.fk_fee_type_id'=> $id,
			'HFS.paid_status !=' => "paid",
			'HFS.deleted !=' => '1'

		);

		$this->db->select("HFS.*,FT.fee_type_name,ST.student_unique_id,ST.student_full_name");
		$this->db->from('hostel_fees AS HFS'); 
		
		$this->db->join('students AS ST', 'ST.student_p_id = HFS.student_id', 'left');
		$this->db->join("fee_types AS FT", "FT.fee_type_p_id = HFS.fk_fee_type_id",'left');
		$this->db->where($data);
		$query= $this->db->get();
    	$result=$query->result();
		return $result;
	}


	public function academic_fee_all_due()
	{
		$data = array(			
			'INV.paid_status !=' => "paid",
			'INV.deleted !=' => '1'
		);
		$this->db->select("INV.*,FTPS.fee_type_name,FTPS.fee_type_amount,ST.student_unique_id,ST.student_full_name,SS.session_name");
		$this->db->from('invoices AS INV'); 
		$this->db->join('students AS ST', 'ST.student_p_id = INV.student_id', 'left');
		$this->db->join("fee_types AS FTPS", "FTPS.fee_type_p_id = INV.fk_fee_type_id",'left');
		$this->db->join('sessions AS SS','SS.session_p_id = INV.fk_session_id');
		$this->db->where('ST.admission_status!=','pending');
		$this->db->where($data);
		$this->db->order_by('INV.invoice_p_id','DESC');
		$query= $this->db->get();
    	$result=$query->result();
		return $result;
	}


	public function library_fee_all_due()
	{
		$data = array(
			
			'BKISU.paid_status !=' => "paid",
			'BKISU.is_active ' => '0'
		);

		$this->db->select("BKISU.*,FT.fee_type_name,ST.student_unique_id,ST.student_full_name");
		$this->db->from('book_issues AS BKISU'); 
		$this->db->join('students AS ST', 'ST.student_p_id = BKISU.student_id', 'left');
		$this->db->join("fee_types AS FT", "FT.fee_type_p_id = BKISU.fine_type_id",'left');
		$this->db->where($data);
		$query= $this->db->get();
    	$result=$query->result();
		return $result;	
	}

	public function academic_total_dues()
	{
		$this->db->select_sum("due_amount");
		$this->db->from('invoices'); 
		
		$this->db->where('paid_status !=', "paid");
		$query= $this->db->get();
    	return $query->row()->due_amount;
		
	}

	public function library_total_dues()
	{	
		$data = array(
			
			'paid_status !=' => "paid",
			'is_active ' => '0'
		);
		
		$this->db->select_sum("library_fine");
		$this->db->from('book_issues'); 
		$this->db->where($data);
		$query= $this->db->get();
    	return $query->row()->library_fine;
		
	}

	/**
	 * [Get General Receipt]
	 * @param  int $id [primary key]
	 * @return mixed
	 */
	public function getGeneralReceipt($id)
	{
        $this->db->select('payments.*, payment_mode.payment_mode_name');
        $this->db->from('payments');
        $this->db->join('payment_mode', 'payment_mode.payment_mode_p_id = payments.payment_mode');

        $this->db->where('payments.student_id',$id);
        $query = $this->db->get();
        return $query->result();
	}

	/**
	 * [Get Offline payment]
	 * @param  int $id [primary key]
	 * @return mixed
	 */
	public function getPayment($id)
	{
        $this->db->select('offline_payments.*, payment_mode.payment_mode_name');
        $this->db->from('offline_payments');
        $this->db->join('payment_mode', 'payment_mode.payment_mode_p_id = offline_payments.pay_mode_id');

        $this->db->where('offline_payments.student_id',$id);
        $query = $this->db->get();
        return $query->result();
	}

	public function hostel_fee_between_dates($monthFrom,$monthTo,$account_type)
	{	$firstDate = date('Y-m-d', strtotime($monthFrom));
		$lastDate = date('Y-m-d', strtotime($monthTo));
		$this->db->select("PMNT.*,ST.student_unique_id,ST.student_full_name,ST.fk_branch_id");
		$this->db->from('payments AS PMNT');
		$this->db->join('students AS ST', 'ST.student_p_id = PMNT.student_id', 'left');
		$this->db->like('PMNT.fee_types_id', 'hs');
		$this->db->where("DATE_FORMAT(PMNT.created_on,'%Y-%m-%d')>=", $firstDate.' 00:00:00');
		$this->db->where("DATE_FORMAT(PMNT.created_on,'%Y-%m-%d')<=", $lastDate.' 23:59:59');
		if($account_type!="All"){
			$this->db->where('PMNT.created_by',$account_type);
		}		
		$query = $this->db->get();
        return $query->result();
	}

	public function fooding_fee_between_dates($monthFrom,$monthTo,$account_type)
	{	
		$firstDate = date('Y-m-d', strtotime($monthFrom));
		$lastDate = date('Y-m-d', strtotime($monthTo));
		$this->db->select("PMNT.*,ST.student_unique_id,ST.student_full_name,ST.fk_branch_id");
		$this->db->from('payments AS PMNT');
		$this->db->join('students AS ST', 'ST.student_p_id = PMNT.student_id', 'left');
		$this->db->like('PMNT.fee_types_id', 'hs');
		$this->db->where("DATE_FORMAT(PMNT.created_on,'%Y-%m-%d')>=", $firstDate.' 00:00:00');
		$this->db->where("DATE_FORMAT(PMNT.created_on,'%Y-%m-%d')<=", $lastDate.' 23:59:59');
		if($account_type!="All"){
			$this->db->where('PMNT.created_by',$account_type);
		}
		$query = $this->db->get();
        return $query->result();
	}

	public function library_fee_between_dates($monthFrom,$monthTo,$account_type)
	{	
		$firstDate = date('Y-m-d', strtotime($monthFrom));
		$lastDate = date('Y-m-d', strtotime($monthTo));
		$this->db->select("PMNT.*,BKISU.fine_type_id,BKISU.library_fine,ST.student_unique_id,ST.student_full_name,ST.fk_branch_id");
		$this->db->from('payments AS PMNT');
		$this->db->join('students AS ST', 'ST.student_p_id = PMNT.student_id', 'left');
		$this->db->join('book_issues AS BKISU', 'BKISU.student_id = PMNT.student_id', 'left');
		$this->db->like('PMNT.fee_types_id', 'li');
		$this->db->where('BKISU.paid_status','paid');
		$this->db->where("DATE_FORMAT(PMNT.created_on,'%Y-%m-%d')>=", $firstDate.' 00:00:00');
		$this->db->where("DATE_FORMAT(PMNT.created_on,'%Y-%m-%d')<=", $lastDate.' 23:59:59');
		if($account_type!="All"){
			$this->db->where('PMNT.created_by',$account_type);
		}
		$query = $this->db->get();
        return $query->result();
	}

	public function academic_fee_between_dates($monthFrom,$monthTo,$account_type)
	{	
		$firstDate = date('Y-m-d', strtotime($monthFrom));
		$lastDate = date('Y-m-d', strtotime($monthTo));
		$this->db->select("PMNT.*,INV.fk_fee_type_id,INV.fee_amount,ST.student_unique_id,ST.student_full_name,ST.fk_branch_id");
		$this->db->from('payments AS PMNT');
		$this->db->join('students AS ST', 'ST.student_p_id = PMNT.student_id', 'left');
		$this->db->join('invoices AS INV', 'INV.student_id = PMNT.student_id', 'left');
		$this->db->like('PMNT.fee_types_id', 'ac');
		$this->db->where('INV.paid_status','paid');
		$this->db->where("DATE_FORMAT(PMNT.created_on,'%Y-%m-%d')>=", $firstDate.' 00:00:00');
		$this->db->where("DATE_FORMAT(PMNT.created_on,'%Y-%m-%d')<=", $lastDate.' 23:59:59');
		if($account_type!="All"){
			$this->db->where('PMNT.created_by',$account_type);
		}
		$query = $this->db->get();
        return $query->result();
	}


	public function accountant_day_statement()
	{
        $currentDate = date('Y-m-d');
		$this->db->select("PMNT.*,ST.student_unique_id,ST.student_full_name,ST.fk_branch_id");
		$this->db->from('payments AS PMNT');
		$this->db->join('students AS ST', 'ST.student_p_id = PMNT.student_id', 'left');
		$this->db->like('PMNT.created_on', $currentDate);
		$query = $this->db->get();
        return $query->result();
	}

	public function accountant_debit_statement()
	{
        $currentDate = date('Y-m-d');
		$this->db->select("DBT.*");
		$this->db->from('debits AS DBT');
		$this->db->like('DBT.created_on', $currentDate);
		$query = $this->db->get();
        return $query->result();
	}


	public function accountant_day_statement_between_dates($monthFrom,$monthTo,$account_type)
	{	
		$this->db->select("PMNT.*,ST.student_unique_id,ST.student_full_name,ST.fk_branch_id");
		$this->db->from('payments AS PMNT');
		$this->db->join('students AS ST', 'ST.student_p_id = PMNT.student_id', 'left');
		
		$this->db->where('PMNT.created_on >=', date('Y-m-d', strtotime($monthFrom)).' 00:00:00');
		$this->db->where('PMNT.created_on <=', date('Y-m-d', strtotime($monthTo)).' 23:59:59');
		if($account_type!="All"){
			$this->db->where('PMNT.created_by',$account_type);
		}
		$query = $this->db->get();
        return $query->result();
	}

	public function accountant_debit_statement_between_dates($purpose=null,$monthFrom,$monthTo,$account_type)
	{	
		$purposes = '';
		if ($purpose == '19') {
			$purposes == '';
		}else{
			$purposes=$purpose;
		}
		$this->db->select("DBT.*");
		$this->db->from('debits AS DBT');
		if(!empty($purposes)){
			$this->db->where('DBT.purpose', $purposes);
		}
		$this->db->where('DBT.created_on >=', date('Y-m-d', strtotime($monthFrom)).' 00:00:00');
		$this->db->where('DBT.created_on <=', date('Y-m-d', strtotime($monthTo)).' 23:59:59');
		if($account_type!="All"){
			$this->db->where('PMNT.created_by',$account_type);
		}
		$query = $this->db->get();
        return $query->result();
	}

	public function accountant_day_statement_total()
	{
		$currentDate = date('Y-m-d');
		$this->db->select_sum('paid_amount');
		$this->db->from('payments');
		$this->db->like('created_on', $currentDate);
		$query = $this->db->get()->row();
		return $query->paid_amount;
       
	}



	public function day_statement_academic_fee($id)
	{
		$this->db->select("fk_fee_type_id,fee_amount,due_amount");
		$this->db->from('invoices'); 
		$this->db->where('invoice_p_id',$id);
		$query= $this->db->get();
    	return $query->row();
	}

	public function day_statement_hostel_fee($id)
	{
		$this->db->select("fk_fee_type_id,hostel_charge_month,late_fine,fee_amount");
		$this->db->from('hostel_fees'); 
		$this->db->where('hostel_fee_p_id',$id);
		$query= $this->db->get();
    	return $query->row();
	}

	public function day_statement_library_fee($id)
	{
		$this->db->select("fine_type_id,library_fine");
		$this->db->from('book_issues'); 
		$this->db->where('book_issue_p_id',$id);
		$query= $this->db->get();
    	return $query->row();
	}

	public function student_book_info($id)
	{
		$this->db->select("return_date,fine_type_id");
		$this->db->from('book_issues');
		$this->db->where('student_id', $id);
		$this->db->where('paid_status !=', "paid");
		$query = $this->db->get();
        return $query->result();
	}

	public function student_hostel_due_info($id)
	{
		$this->db->select("hostel_charge_month,late_fine,due_amount,fee_amount,paid_status");
		$this->db->from('hostel_fees');
		$this->db->where('student_id', $id);
		$this->db->where('paid_status !=', "paid");
		$this->db->where('deleted !=', "1");
		$this->db->where('fk_fee_type_id =', 17);
		$query = $this->db->get();
        return $query->result();
	}

	public function student_hostel_messinfo($id)
	{
		$this->db->select("hostel_charge_month,late_fine,due_amount,fee_amount,paid_status");
		$this->db->from('hostel_fees');
		$this->db->where('student_id', $id);
		$this->db->where('paid_status !=', "paid");
		$this->db->where('deleted !=', "1");
		$this->db->where('fk_fee_type_id =', 18);
		$query = $this->db->get();
        return $query->result();
	}

}

/* End of file Accountant.php */
/* Location: ./application/modules/hostel/models/Accountant.php */
