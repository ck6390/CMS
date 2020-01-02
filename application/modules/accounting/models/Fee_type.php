<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
 * Ganga Memorial CMS
 *
 * @author		Vishwajeet Kumar
 * @copyright	Copyright (c) 2019
 */

/**
 * Class fee_type
 */

class Fee_type extends Base_Model
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
	protected $_primary_key = 'fee_type_p_id';


	public function get_fee_allocated_student($id)
	{
		$this->db->select('student_id');
		$this->db->from("fee_allocates");
		$this->db->join("fee_types", "fee_types.fee_type_p_id = fee_allocates.fee_type_id");
		$this->db->where('fee_type_p_id',$id);
		$query = $this->db->get();

		return $query->row();
	}

	
}

/* End of file fee_type.php */
/* Location: ./application/modules/setting/models/fee_type.php */