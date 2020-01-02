<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
 * ganga Memorial CMS
 *
 * @author		Manoj Kumar
 * @copyright	Copyright (c) 2019
 */

/**
 * Class Debit_purpose
 */

class Debit_purpose extends Base_Model
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
	protected $_table = 'debit_purpose';
	/**
	 * [$primary_key PRIMARY KEY]
	 * @var string
	 */
	protected $_primary_key = 'debit_purpose_p_id';
}

/* End of file debit_purpose.php */
/* Location: ./application/modules/setting/models/debit_purpose.php */