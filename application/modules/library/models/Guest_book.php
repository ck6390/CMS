<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
 * Ganga Memorial CMS
 *
 * @author		Vishwajeet Kumar
 * @copyright	Copyright (c) 2019
 */

/**
 * Class Guest_book
 */

class Guest_book extends Base_Model
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
	
	protected $_table = 'guest_book_issues';
	protected $_primary_key = 'guest_p_id';
}

/* End of file Guest_book.php */
/* Location: ./application/modules/library/models/Guest_book.php */
