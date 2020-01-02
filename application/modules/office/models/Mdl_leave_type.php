<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
 * ERP
 *
 * @author		Amit Kumar
 * @copyright	Copyright (c) 2018
 */

/**
 * Class Mdl_leave_type
 */

class Mdl_leave_type extends Base_Model
{	
	function __construct()
	{
		// call the model constructor
		parent::__construct();
	}
	/**
	 * [$_table TABLE NAME]
	 * @var string
	 */
	protected $_primary_key = 'leave_p_id';
	/**
	 * [$primary_key PRIMARY KEY]
	 * @var string
	 */
	protected $_table = 'leave_type';
}

/* End of file Mdl_leave_type.php */
/* Location: ./application/modules/office/models/Mdl_leave_type.php */