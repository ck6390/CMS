<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
 * Ganga Memorial CMS
 *
 * @author		Vishwajeet Kumar
 * @copyright	Copyright (c) 2019
 */

/**
 * Class Hostel_student
 */

class Hostel_student extends Base_Model
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
	protected $_primary_key = 'room_p_id';

	public function get_all_available_room($buildingId,$blockId,$floorId)
	{
		
	}
}

/* End of file Hostel_student.php */
/* Location: ./application/modules/hostel/models/Hostel_student.php */
