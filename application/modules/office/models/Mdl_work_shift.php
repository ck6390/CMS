<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
 * ERP
 *
 * @author		Amit Kumar
 * @copyright	Copyright (c) 2018
 */

/**
 * Class Mdl_work_shift
 */

class Mdl_work_shift extends Base_Model
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
	protected $_primary_key = 'shift_p_id';
	/**
	 * [$primary_key PRIMARY KEY]
	 * @var string
	 */
	protected $_table = 'work_shift';
}

/* End of file Mdl_work_shift.php */
/* Location: ./application/modules/office/models/Mdl_work_shift.php */