<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
 * Ganga Memorial CMS
 *
 * @author		Vishwajeet Kumar
 * @copyright	Copyright (c) 2019
 */

/**
 * Class Branch
 */

class cast_category extends Base_Model
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
	
	protected $_table = 'cast_categories';	
	protected $_primary_key = 'cast_category_p_id';


	/**
	 * [Get Branch id by branch code]
	 * @param  int $id [primary key]
	 * @return redirect
	 */

}

/* End of file Branch.php */
/* Location: ./application/modules/setting/models/Branch.php */