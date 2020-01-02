<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
 * Ganga Memorial CMS
 *
 * @author		Amit Kumar
 * @copyright	Copyright (c) 2019
 */

/**
 * Class Employee_leave
 */

class Employee_leave extends Base_Model
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
	protected $_primary_key = 'emp_leave_id';
	
	
}

/* End of file Employee_leave.php */
/* Location: ./application/modules/super_admin/models/Employee_leave.php */
