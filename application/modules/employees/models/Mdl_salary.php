<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
 * ERP
 *
 * @author		Amit Kumar
 * @copyright	Copyright (c) 2018
 */

/**
 * Class Mdl_salary
 */

class Mdl_salary extends Base_Model
{	
	function __construct()
	{
		// call the model constructor
		parent::__construct();
	}
	protected $_table = 'salary';
	protected $primary_key = 'salary_p_id';
	
}

/* End of file Mdl_salary.php */
/* Location: ./application/modules/employee/models/Mdl_salary.php */