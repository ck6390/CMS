<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
 * Ganga Memorial CMS
 *
 * @author		Amit Kumar
 * @copyright	Copyright (c) 2019
 */

/**
 * Class Room
 */

class Room extends Base_Model
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


	/*
	* [get toatl value of room list]
	* 
	*/
	public function get_total()
	{
		//$this->db->select('*');
		$this->db->select_sum('total_bed');
		$this->db->select_sum('booked_bed');
		$this->db->select_sum('room_rent');
		$this->db->from('rooms');
             
        return $this->db->get()->row(); 
	}

	public function get_all_available_room($buildingId,$blockId,$floorId)
	{
		
	}
}

/* End of file Room.php */
/* Location: ./application/modules/hostel/models/Room.php */
