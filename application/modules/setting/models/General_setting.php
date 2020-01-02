<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
 * ERP
 *
 * @author		Amit Kumar
 * @copyright	Copyright (c) 2018
 */

/**
 * Class General_setting
 */

class General_setting extends Base_Model
{	
	function __construct()
	{
		// call the model constructor
		parent::__construct();
	}
	protected $_table = 'settings';
	protected $_primary_key = 'inst_p_id';
	
	public function updateInstitute($data,$id)
	{
		$this->db->where('inst_p_id', $id);
		$this->db->update('settings', $data);
		return true;
	}
}

/* End of file General_setting.php */
/* Location: ./application/modules/setting/models/General_setting.php */