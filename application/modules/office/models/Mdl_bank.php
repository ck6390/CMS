<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
 * ERP
 *
 * @author		Amit Kumar
 * @copyright	Copyright (c) 2018
 */

/**
 * Class Mdl_bank
 */

class Mdl_bank extends Base_Model
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
	protected $_table = 'bank_detail';
	/**
	 * [$primary_key PRIMARY KEY]
	 * @var string
	 */
	protected $primary_key = 'bank_p_id';
}

/* End of file Mdl_bank.php */
/* Location: ./application/modules/office/models/Mdl_bank.php */