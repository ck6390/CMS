<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
 * Ganga Memorial CMS
 *
 * @author		Vishwajeet Kumar
 * @copyright	Copyright (c) 2019
 */

/**
 * Class Session
 */

class Restriction extends Base_Model
{
	function __construct()
	{
		// call the model constructor
		parent::__construct();
	}
	/**
	 * [$_primary_key PRIMARY KEY]
	 * @var string
	 */
	protected $_primary_key = 'restriction_p_id';
}

/* End of file Session.php */
/* Location: ./application/modules/setting/models/Session.php */
