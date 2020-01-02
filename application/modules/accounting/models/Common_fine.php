<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
 * Ganga Memorial CMS
 *
 * @author		Vishwajeet Kumar
 * @copyright	Copyright (c) 2019
 */

/**
 * Class Common_fine
 */

class Common_fine extends Base_Model
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
	protected $_table = 'invoices';
	protected $_primary_key = 'invoice_p_id';


	public function get_fee_allocated_student($id)
	{	
		

		$this->db->select('student_id');
		$this->db->from("fee_allocates");
		$this->db->join("fee_types", "fee_types.fee_type_p_id = fee_allocates.fee_type_id");
		$this->db->where('fee_type_p_id',$id);
		$query = $this->db->get();

		return $query->row();
	}

	public function get_student_fine()
	{
		$this->db->select('*');
		$this->db->from("invoices");
		$this->db->join("fee_types", "fee_types.fee_type_p_id = invoices.fk_fee_type_id");
		$this->db->where('fk_fee_group_id','2');
		$this->db->where('invoices.deleted!=','1');
		$query = $this->db->get();

		return $query->result();	
	}

	public function student_fine_list()
	{
		$this->db->select('*');
		$this->db->from("invoices");
		$this->db->where('fk_fee_type_id','25');
		$query = $this->db->get();

		return $query->result();
	}
}

/* End of file fee_type.php */
/* Location: ./application/modules/setting/models/fee_type.php */