<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
 * Ganga Memorial CMS
 *
 * @author		Vishwajeet Kumar
 * @copyright	Copyright (c) 2019
 */

/**
 * Class Course_year
 */

class Course_year extends Base_Model
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
	protected $_primary_key = 'course_year_p_id';
}

/* End of file Course_year.php */
/* Location: ./application/modules/setting/models/Course_year.php */
