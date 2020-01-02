<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
 * ganga Memorial CMS
 *
 * @author		Amit Kumar
 * @copyright	Copyright (c) 2019
 */

/**
 * Class payment_mode
 */

class payment_mode extends Base_Model
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
	protected $_table = 'payment_mode';
	/**
	 * [$primary_key PRIMARY KEY]
	 * @var string
	 */
	protected $_primary_key = 'payment_mode_p_id';
}

/* End of file payment_mode.php */
/* Location: ./application/modules/setting/models/payment_mode.php */