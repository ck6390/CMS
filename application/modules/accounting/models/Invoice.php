<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
 * Ganga Memorial CMS
 *
 * @author		Vishwajeet Kumar
 * @copyright	Copyright (c) 2019
 */

/**
 * Class Invoice
 */

class Invoice extends Base_Model
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
	protected $_primary_key = 'invoice_p_id';

	public function get_all_invoice()
	{
		$this->db->select('INV.*,ST.student_unique_id,SS.session_name,CY.course_year_name,FTP.fee_type_name,BRN.branch_code');
        $this->db->from('invoices AS INV'); 
        $this->db->join('students AS ST', 'ST.student_p_id = INV.student_id', 'left');
        $this->db->join('sessions AS SS', 'SS.session_p_id = INV.fk_session_id', 'left');
        $this->db->join('course_years AS CY', 'CY.course_year_p_id = INV.fk_course_year_id', 'left');
        $this->db->join('fee_types AS FTP', 'FTP.fee_type_p_id = INV.fk_fee_type_id', 'left');
        $this->db->join('branches AS BRN', 'BRN.branch_p_id = ST.fk_branch_id', 'left');
        $this->db->order_by('INV.invoice_p_id', 'DESC');
        $this->db->where('INV.paid_status !=', "paid");
        $this->db->where('INV.deleted !=', '1');
        
        return $this->db->get()->result(); 

	}

	public function get_Students_for_invoice($data,$branch)
	{
		$this->db->select("student_p_id");
		
		$this->db->where($data);
		$this->db->where_in('fk_branch_id', $branch);
		$query=$this->db->get('students');
    	$result=$query->result();
		return $result;
	} 

	public function get_invoice_info($id)
	{	

		$this->db->select('INV.*,ST.student_unique_id,ST.student_p_id,ST.father_name,ST.registration_no,ST.student_full_name,ST.admission_date,SS.session_name,CY.course_year_name,FS.fee_structure_title,FS.fee_structure_p_id,BRN.branch_code,SMST.semester_name');
        $this->db->from('invoices AS INV'); 
        $this->db->join('students AS ST', 'ST.student_p_id = INV.student_id', 'left');
        $this->db->join('sessions AS SS', 'SS.session_p_id = INV.fk_session_id', 'left');
        $this->db->join('course_years AS CY', 'CY.course_year_p_id = INV.fk_course_year_id', 'left');
        $this->db->join('fee_structures AS FS', 'FS.fee_structure_p_id = INV.fk_fee_structure_id', 'left');
        //$this->db->join('fee_structures AS FS', 'FS.fee_structure_p_id = INV.fk_fee_type_id', 'left');
        $this->db->join('branches AS BRN', 'BRN.branch_p_id = ST.fk_branch_id', 'left');
        $this->db->join('semesters AS SMST', 'SMST.semester_p_id = ST.fk_semester_id', 'left');
        $this->db->where('invoice_p_id',$id);
             
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

	
}

/* End of file Invoice.php */
/* Location: ./application/modules/accounting/models/Invoice.php */