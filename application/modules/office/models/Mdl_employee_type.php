<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
 * ERP
 *
 * @author		Amit Kumar
 * @copyright	Copyright (c) 2018
 */

/**
 * Class Mdl_employee_type
 */

class Mdl_employee_type extends Base_Model
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
	protected $_table = 'employee_type';
	/**
	 * [$primary_key PRIMARY KEY]
	 * @var string
	 */
	protected $_primary_key = 'employee_type_p_id';
}

/* End of file Mdl_employee_type.php */
/* Location: ./application/modules/office/models/Mdl_employee_type.php */