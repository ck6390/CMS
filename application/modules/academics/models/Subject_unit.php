<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
 * Ganga Memorial CMS
 *
 * @author		Vishwajeet Kumar
 * @copyright	Copyright (c) 2019
 */

/**
 * Class Subject_unit
 */

class Subject_unit extends Base_Model
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
	protected $_primary_key = 'subject_unit_p_id';

	public function subject_unit_list($id)
	{
		$this->db->select('*');
		$this->db->from('subject_units');
		$this->db->where('fk_subject_id',$id);
		$query = $this->db->get();
		return $query->result();
	}
}

/* End of file Subject_unit.php */
/* Location: ./application/modules/academics/models/Subject_unit.php */