<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
 * Ganga Memorial CMS
 *
 * @author		Amit Kumar
 * @copyright	Copyright (c) 2019
 */

/**
 * Class Allotted Room
 */

class Allotted_room extends Base_Model
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
	protected $_primary_key = 'allotted_room_p_id';

	public function update_status($allotted_room_p_id,$is_active){
		$this->db->set('status', $is_active);
		$this->db->where('allotted_room_p_id',$allotted_room_p_id);
		$this->db->update('allotted_rooms');
	}

	public function get_alloted(){
		$this->db->select('*');
		$this->db->where('is_active = "1"');
		return $this->db->get('allotted_rooms')->result();
	}
}

/* End of file Allotted_room.php */
/* Location: ./application/modules/hostel/models/Allotted_room.php */
