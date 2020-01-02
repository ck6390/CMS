<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
 * Ganga Memorial CMS
 *
 * @author		Amit Kumar
 * @copyright	Copyright (c) 2019
 */

/**
 * Class Activity
 */

class Activity extends Base_Model
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
	protected $_primary_key = 'activity_p_id';
	
	
}

/* End of file Activity.php */
/* Location: ./application/modules/super_admin/models/Activity.php */
