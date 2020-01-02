<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
 * ERP
 *
 * @author		Amit Kumar
 * @copyright	Copyright (c) 2018
 */

/**
 * Class Mdl_working_day
 */

class Mdl_working_day extends Base_Model
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
	protected $_table = 'working_day';
	/**
	 * [$primary_key PRIMARY KEY]
	 * @var string
	 */
	protected $_primary_key = 'wd_p_id';
}

/* End of file Mdl_working_day.php */
/* Location: ./application/modules/office/models/Mdl_working_day.php */