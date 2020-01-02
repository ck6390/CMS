<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
 * ERP
 *
 * @author		Amit Kumar
 * @copyright	Copyright (c) 2018
 */

/**
 * Class Mdl_salary_component
 */

class Mdl_salary_component extends Base_Model
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
	protected $_table = 'salary_component';
	/**
	 * [$primary_key PRIMARY KEY]
	 * @var string
	 */
	protected $_primary_key = 'component_p_id';
}

/* End of file Mdl_salary_component.php */
/* Location: ./application/modules/office/models/Mdl_salary_component.php */