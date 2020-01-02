<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
 * ERP
 *
 * @author		Amit Kumar
 * @copyright	Copyright (c) 2018
 */

/**
 * Class Mdl_pay_grade
 */

class Mdl_pay_grade extends Base_Model
{	
	function __construct()
	{
		// call the model constructor
		parent::__construct();
	}
	protected $_table = 'salary_grade';
	protected $primary_key = 'grade_p_id';
}

/* End of file Mdl_pay_grade.php */
/* Location: ./application/modules/office/models/Mdl_pay_grade.php */