<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Duesfee
{
	protected $CI;
	public function __construct()
	{
		// constructor
		$this->CI =& get_instance();
	}

	
	public function academicDue($studentId)
	{	

		$data = array(
				
				'INV.student_id'=> $studentId,
				'INV.paid_status !='=> "paid",
				'INV.deleted !=' => '1'

		);
		$this->CI->db->select('INV.*,FTP.fee_type_name,INV.remarks');
		$this->CI->db->from('invoices AS INV');
		$this->CI->db->join("fee_types AS FTP", "FTP.fee_type_p_id = INV.fk_fee_type_id",'left');
        $this->CI->db->where($data);
        
       	$query = $this->CI->db->get();
		return $query->result();
	}


	public function hostelRoomDue($studentId)
	{
		$this->CI->db->select("hostel_charge_month,late_fine,due_amount,fee_amount,paid_status");
		$this->CI->db->from('hostel_fees');
		$this->CI->db->where('student_id', $studentId);
		$this->CI->db->where('paid_status !=', "paid");
		$this->CI->db->where('deleted !=', "1");
		$this->CI->db->where('fk_fee_type_id =', 17);
		$query = $this->CI->db->get();
        return $query->result();
	}


	public function hostelMessDue($studentId)
	{
		$this->CI->db->select("hostel_charge_month,late_fine,due_amount,fee_amount,paid_status")
				->from('hostel_fees')
				->where('student_id', $studentId)
				->where('paid_status !=', "paid")
				->where('deleted !=', "1")
				->where('fk_fee_type_id =', 18);
		$query = $this->CI->db->get();
        return $query->result();
	}



}

/* End of file Sendmail.php */
/* Location: ./application/libraries/Sendmail.php */