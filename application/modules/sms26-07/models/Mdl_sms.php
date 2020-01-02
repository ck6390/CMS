<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
 * Ganga Memorial CMS
 *
 * @author		Manoj Kumar
 * @copyright	Copyright (c) 2019
 */

/**
 * Class Mdl_sms
 */

class Mdl_sms extends Base_Model
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
	
	protected $_table = 'sms';
	protected $_primary_key = 'sms_p_id';

	public function get_AllStudents_for_sms($data,$branch)
	{
		$this->db->select("student_p_id");
		
		$this->db->where($data);
		$this->db->where_in('fk_branch_id', $branch);
		$query = $this->db->get('students');
    	$result = $query->result();
		return $result;
	} 

	
}

/* End of file Mdl_sms.php */
/* Location: ./application/modules/sms/models/Mdl_sms.php */