<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
 * College Management System
 *
 * @author		Amit Kumar
 * @copyright	Copyright (c) 2018
 */

/**
 * Class Sms_setting
 */

class Sms_setting extends Base_Model
{	
	function __construct()
	{
		// call the model constructor
		parent::__construct();
	}
	protected $_table = 'sms_settings';
	protected $_primary_key = 'sms_setting_p_id';
	
	public function check_row()
	{	
		$this->db->from('sms_settings');
		$query = $this->db->get();
		if ($query->num_rows() > 0)
		{
		    $row = $query->row(); 
		    return $row->sms_setting_p_id;
		}else{
			return 0;
		}
	}
}

/* End of file Sms_setting.php */
/* Location: ./application/modules/setting/models/Sms_setting.php */