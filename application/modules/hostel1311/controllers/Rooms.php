<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
 * Ganga Memorial CMS
 *
 * @author		Amit Kumar
 * @copyright	Copyright (c) 2019
 */

/**
 * Class Rooms
 */

class Rooms extends Base_Controller
{
	/**
	 * Rooms_Controller constructor.
	 */
	public function __construct()
	{
		// controller constructor
		parent::__construct();
		$this->load->model('room', 'mdl_room');
		$this->load->model('setting/building','mdl_building');
		$this->load->model('setting/block','mdl_block');
		$this->load->model('setting/floor','mdl_floor');
	}

	/**
	 * Fetch all room list.
	 * @return void [load view page]
	 */
	public function index()
	{
		$data['lists'] = $this->mdl_room->get_all();
		$this->template->set('title', 'Room List');
		$this->template->load('template', 'contents', 'room/room_list', $data);
	}

	/**
	 * Insert new record.
	 * @return void [load view page]
	 */
	public function add()
	{
		$this->form_validation->set_rules('room-number', 'room number', 'required|trim|is_unique[rooms.room_number]');
		$this->form_validation->set_rules('building-name', 'building name', 'trim');
		$this->form_validation->set_rules('block-name', 'block name', 'trim');
		$this->form_validation->set_rules('floor-number', 'floor number', 'trim');
		$this->form_validation->set_rules('bed-number', 'bed number', 'required|trim');
		$this->form_validation->set_rules('room-rent', 'room rent', 'required|trim');
		if($this->form_validation->run() == false) {

			$this->template->set('title', 'Add Room');
			$this->template->load('template', 'contents', 'room/room_add');

		} else {
			
			$post = $this->input->post(null, true);
			$cleanPost = $this->security->xss_clean($post);
			$formData = array(
				'room_number' => $cleanPost['room-number'],
				'building_id' => $cleanPost['building-name'],
				'block_id' => $cleanPost['block-name'],
				'floor_id' => $cleanPost['floor-number'],
				'total_bed' => $cleanPost['bed-number'],
				'room_rent' => $cleanPost['room-rent'],
			);
			
			// insert to database
			if($this->mdl_room->insert($formData) == true) {
				$this->session->set_flashdata('success', "Success, New Room has been added!");
			} else {
				$this->session->set_flashdata('danger', "Error, Can't add new rooms!");
			}
			redirect('hostel/rooms', 'refresh');
		}
	}

	/**
	 * [Edit room details]
	 * @param  int $id [primary key]
	 * @return [type]     [description]
	 */
	public function edit($id)
	{
		$this->form_validation->set_rules('room-number', 'room number', 'required|trim');
		$this->form_validation->set_rules('block-name', 'block name', 'trim');
		$this->form_validation->set_rules('building-name', 'building name', 'trim');
		$this->form_validation->set_rules('floor-number', 'floor number', 'trim');
		$this->form_validation->set_rules('bed-number', 'floor number', 'required|trim');
		$this->form_validation->set_rules('room-rent', 'room rent', 'required|trim');

		if($this->form_validation->run() == false) {
			$data['info'] = $this->mdl_room->get($id);
			$this->template->set('title', 'Edit Room');
			$this->template->load('template', 'contents', 'room/room_edit', $data);
		} else {
			$post = $this->input->post(null, true);
			$cleanPost = $this->security->xss_clean($post);
			$formData = array(
				'room_number' => $cleanPost['room-number'],
				'building_id' => $cleanPost['building-name'],
				'block_id' => $cleanPost['block-name'],
				'floor_id' => $cleanPost['floor-number'],
				'total_bed' => $cleanPost['bed-number'],
				'room_rent' => $cleanPost['room-rent'],
			);
			// update to database
			if($this->mdl_room->update($formData, $id) == true) {
				$this->session->set_flashdata('successe', "Success, User has been updated!");
			} else {
				$this->session->set_flashdata('error', "Error, Can't update the user!");
			}
			redirect('hostel/rooms', 'refresh');
		}
	}

	/**
	 * [Activate status.]
	 * @param  int $id [primary key]
	 * @return redirect
	 */
	public function activate($id)
	{
		$data = array(
			'is_active' => '1'
		);
		if($this->mdl_room->update($data, $id) == true) {
			$this->session->set_flashdata('success', "Success, Activated successfully!");
		} else {
			$this->session->set_flashdata('error', "Error, Can't activate!");
		}
		redirect('hostel/rooms', 'refresh');
	}

	/**
	 * [Deactivate status.]
	 * @param  int $id [primary key]
	 * @return redirect
	 */
	public function deactivate($id)
	{
		$data = array(
			'is_active' => '0'
		);
		if($this->mdl_room->update($data, $id) == true) {
			$this->session->set_flashdata('success', "Success, Deactivated successfully!");
		} else {
			$this->session->set_flashdata('error', "Error, Can't deactivate!");
		}
		redirect('hostel/rooms', 'refresh');
	}

	/**
	 * [Delete record from list.]
	 * @param  void
	 * @return boolean
	 */
	public function delete()
	{
		$id = $this->input->post('primary_id');
		if($this->mdl_user->delete($id) == true) {
			echo true;
		} else {
			echo false;
		}
	}

	/**
	 * [Delete record permanently from database.]
	 * @param  int $id [primary key]
	 * @return redirect
	 */
	public function force_delete($id)
	{
		if($this->mdl_user->force_delete($id) == true) {
			$this->session->set_flashdata('success', 'DELETED!');
		} else {
			$this->session->set_flashdata('error', 'ERROR!');
		}
		redirect('hostel/rooms', 'refresh');
	}


	public function get_booked_bed($roomId)
	{
		$query_room = $this->db->select('room_p_id,booked_bed')->from('rooms')->where(array(
                'room_p_id' => $roomId,
                'is_active' =>'1'
            ))->get();

			$result_room = $query_room->num_rows() > 0 ? $query_room->result() : false;
			echo json_encode($result_room);
	}
	/**
	 * [Get room list by floor id .]
	 * @param  int $id [primary key]
	 * @return redirect
	 */
	public function get_room_list_by_floor(){

		$buildingId = $_POST['buildingID'];
		$blockId = $_POST['blockID'];
		$floorId = $_POST['floorID'];
		//$data=$this->mdl_room->get_all_available_room($buildingId,$blockId,$floorId);
		$query = $this->db->select('block_p_id')->from('blocks')->where(array(
                'building_id' => $buildingId,
                'is_active' =>'1'
            ))->get();
		$result = $query->num_rows() > 0 ? $query->result() : false;

		if($result!=null){

			foreach($result as $blockList)
			{
				if($blockList->block_p_id==$blockId){
					$query_room = $this->db->select('room_p_id, room_number,,total_bed,booked_bed')->from('rooms')->where(array(
                'floor_id' => $floorId,
                'is_active' =>'1'
            ))->get();

			$result_room = $query_room->num_rows() > 0 ? $query_room->result() : false;
			echo json_encode($result_room);
				}
			}
		}

		
	}
}

/* End of file Rooms.php */
/* Location: ./application/modules/hostel/controllers/Rooms.php */
