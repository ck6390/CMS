<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
 * Ganga Memorial CMS
 *
 * @author		Vishwajeet Kumar
 * @copyright	Copyright (c) 2019
 */

/**
 * Class Hostel_Invoice
 */

class Hostel_Invoice extends Base_Model
{	
	function __construct()
	{
		// call the model constructor
		parent::__construct();
	}
	/**
	 * [$primary_key PRIMARY KEY]
	 * @var string
	 */
	protected $_table = 'hostel_fees';
	protected $_primary_key = 'hostel_fee_p_id';

	public function get_hostel_invoice()
	{
		$this->db->select('HFS.*,ST.student_unique_id,ST.student_p_id,SS.session_name,CY.course_year_name,FT.fee_type_name,BRN.branch_code');
        $this->db->from('hostel_fees AS HFS'); 
        $this->db->join('students AS ST', 'ST.student_p_id = HFS.student_id', 'left');
        $this->db->join('sessions AS SS', 'SS.session_p_id = ST.fk_session_id', 'left');
        $this->db->join('course_years AS CY', 'CY.course_year_p_id = ST.fk_course_year_id', 'left');
        $this->db->join('fee_types AS FT', 'FT.fee_type_p_id = HFS.fk_fee_type_id', 'left');
        $this->db->join('branches AS BRN', 'BRN.branch_p_id = ST.fk_branch_id', 'left');
        $this->db->order_by('HFS.hostel_fee_p_id', 'DESC');
        $this->db->where('HFS.paid_status !=', 'paid');
        $this->db->where('HFS.deleted !=', '1');
        
        return $this->db->get()->result(); 
	}

	public function update_invoice($data,$id){
		
		$this->db->where('hostel_fee_p_id', $id);
    	$this->db->update('hostel_fees', $data);
    	return true;
	}
	
	public function deletd_hostel_inv($id){
		
		$data = array(
			'is_active' => '0',
			'deleted' => '1'
		);

		$this->db->where('hostel_fee_p_id', $id);
    	$this->db->update('hostel_fees', $data);
    	return true;
		
	}
	
	public function get_Students_for_invoice($data,$branch)
	{
		$this->db->select("student_p_id");
		$this->db->where($data);
		$this->db->where_in('fk_branch_id', $branch);
		$query = $this->db->get('students');
    	$result = $query->result();
		return $result;
	} 

	public function get_hostel_invoice_info($id)
	{	

		$this->db->select('INV.*,ST.student_unique_id,ST.student_p_id,ST.father_name,ST.registration_no,ST.student_full_name,ST.admission_date,ST.student_full_name,SS.session_name,CY.course_year_name,FT.fee_type_name,BRN.branch_code,SMST.semester_name');
        $this->db->from('invoices AS INV'); 
        $this->db->join('students AS ST', 'ST.student_p_id = INV.student_id', 'left');
        $this->db->join('sessions AS SS', 'SS.session_p_id = INV.fk_session_id', 'left');
        $this->db->join('course_years AS CY', 'CY.course_year_p_id = INV.fk_course_year_id', 'left');
        $this->db->join('fee_types AS FT', 'FT.fee_type_p_id = INV.fk_fee_type_id', 'left');
        $this->db->join('branches AS BRN', 'BRN.branch_p_id = ST.fk_branch_id', 'left');
        $this->db->join('semesters AS SMST', 'SMST.semester_p_id = ST.fk_semester_id', 'left');
        $this->db->where('invoice_p_id',$this->session->userdata['roleID']);
             
        return $this->db->get()->row(); 
	}
	
	public function invoice_payment($id)
	{
		$this->db->select("*");
		$this->db->from('payments'); 
		$this->db->join('invoices AS INV', 'INV.invoice_p_id = payments.invoice_id', 'left');
		$this->db->join('fee_structures AS FS', 'FS.fee_structure_p_id = INV.fk_fee_structure_id', 'left');
		$this->db->where('payments.invoice_id', $id);
		$query=$this->db->get();
    	$result=$query->result();
		return $result;
	}

	public function invoice_payment_student_hostel($id)
	{	
		$data = array(
				
				'PMNT.student_id'=> $id,
				'INV.paid_status !='=> "unpaid",

		);

		$this->db->select("PMNT.*,INV.invoice_id,FT.fee_type_name");
		$this->db->from('payments AS PMNT'); 
		$this->db->join('invoices AS INV', 'INV.invoice_p_id = PMNT.invoice_id', 'left');
		$this->db->join('students AS ST', 'ST.student_p_id = INV.student_id', 'left');
		$this->db->join('fee_types AS FT', 'FT.fee_type_p_id = INV.fk_fee_type_id', 'left');
		$this->db->where($data);

		$query= $this->db->get();
    	$result=$query->result();
		return $result;
	}

	
}

/* End of file Invoice.php */
/* Location: ./application/modules/accounting/models/Invoice.php */