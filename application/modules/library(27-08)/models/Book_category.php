<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
 * Ganga Memorial CMS
 *
 * @author		Vishwajeet Kumar
 * @copyright	Copyright (c) 2019
 */

/**
 * Class Book category
 */

class Book_category extends Base_Model
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
	
	protected $_table = 'book_categories';
	protected $_primary_key = 'book_category_p_id';
}

/* End of file Book_category.php */
/* Location: ./application/modules/library/models/Book_category.php */
