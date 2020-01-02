<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
 * ERP
 *
 * @author		Manoj Kumar
 * @copyright	Copyright (c) 2018
 */

/**
 * Class Mdl_sub_units
 */

class Mdl_sub_units extends Base_Model
{	
	function __construct()
	{
		// call the model constructor
		parent::__construct();
	}
	protected $_table = 'emp_subject_units';
	protected $_primary_key = 'emp_subject_unit_p_id';
	
	public function employee_lecture_units($data)
	{
		$this->db->select("unit_id");
		$this->db->from("emp_subject_units");
		$this->db->where($data);
		$query = $this->db->get();
		return $query->result();
	}

	public function get_unit_details($data)
	{
		$this->db->select("start_date");
		$this->db->from("emp_subject_units");
		$this->db->where($data);
		$query = $this->db->get();
		return $query->row();
	}
}

/* End of file Mdl_sub_units.php */
/* Location: ./application/modules/employee/models/Mdl_sub_units.php */