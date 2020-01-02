<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
 * ERP
 *
 * @author		Manoj Kumar
 * @copyright	Copyright (c) 2018
 */

/**
 * Class Debit
 */

class Debit extends Base_Model
{	
	function __construct()
	{
		// call the model constructor
		parent::__construct();
		
	}
	protected $_primary_key = 'debit_p_id';

}

/* End of file Payment.php */
/* Location: ./application/modules/purchases/models/Payment.php */