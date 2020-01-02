<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
 * Ganga Memorial CMS
 *
 * @author		Vishwajeet Kumar
 * @copyright	Copyright (c) 2019
 */

/**
 * Class fee
 */

class Fee_allocate extends Base_Model
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
	
	protected $_primary_key = 'fee_allocate_p_id';
}

/* End of file Fee.php */
/* Location: ./application/modules/fees/models/Fee.php */