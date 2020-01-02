<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
 * ERP
 *
 * @author		Amit Kumar
 * @copyright	Copyright (c) 2018
 */

/**
 * Class Student_attendance
 */

class Student_attendance extends Base_Model
{	
	function __construct()
	{
		// call the model constructor
		parent::__construct();
	}
	protected $_table = 'student_attendance';
	protected $_primary_key = 'student_attendnce_p_id';
	
	
}

/* End of file Student_attendance.php */
/* Location: ./application/modules/employee/models/Student_attendance.php */