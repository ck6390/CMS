<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
 * Ganga Memorial CMS
 *
 * @author		Amit Kumar
 * @copyright	Copyright (c) 2019
 */

/**
 * Class Allotted_rooms
 */

class Allotted_rooms extends Base_Controller
{
	/**
	 * Allotted_rooms_Controller constructor.
	 */
	public function __construct()
	{
		// controller constructor
		parent::__construct();
		$this->load->model('students/student', 'mdl_student');
		$this->load->model('allotted_room', 'mdl_allotted_room');
		$this->load->model('hostel/room','mdl_room');
		$this->load->model('hostel/Building','mdl_building');
	}

	/**
	 * Fetch all Allotted_room list.
	 * @return void [load view page]
	 */
	public function index()
	{
		$data['lists'] = $this->mdl_allotted_room->get_alloted();
		//var_dump($data);
		$this->template->set('title', 'Allotted Room List');
		$this->template->load('template', 'contents', 'allotted_room/allotted_room_list', $data);
	}

	/**
	 * Insert new record.
	 * @return void [load view page]
	 */
	public function add($id)
	{
		$this->form_validation->set_rules('student-id', 'student id', 'required|trim');
		$this->form_validation->set_rules('building-name', 'building name', 'required|trim');
		$this->form_validation->set_rules('block-name', 'block name', 'required|trim');
		$this->form_validation->set_rules('floor-number', 'floor number', 'required|trim');
		$this->form_validation->set_rules('room-id', 'room number', 'required|trim');
		$this->form_validation->set_rules('room-rent', 'room rent', 'required|trim');
		$this->form_validation->set_rules('security-money', 'security money', 'required|trim');
		$this->form_validation->set_rules('allotment-date', 'booking date', 'required|trim');
		$this->form_validation->set_rules('send-sms', 'send sms', 'required|trim');
		if($this->form_validation->run() == false) {
			$data['info'] = $this->mdl_student->get($id);
			$this->template->set('title', 'Add Allotted Room');
			$this->template->load('template', 'contents', 'allotted_room/allotted_room_add',$data);

		} else {
			
			$post = $this->input->post(null, true);
			$cleanPost = $this->security->xss_clean($post);
			$formData = array(
				'student_id' => $cleanPost['student-id'],
				'building_id' => $cleanPost['building-name'],
				'block_id' => $cleanPost['block-name'],
				'floor_id' => $cleanPost['floor-number'],
				'room_id' => $cleanPost['room-id'],
				'booking_bed' => '1',
				'room_rent' => $cleanPost['room-rent'],
				'security_money' => $cleanPost['security-money'],
				'booking_date' => $cleanPost['allotment-date'],
				'send_sms' => $cleanPost['send-sms'],
				
			);
			
			// insert to database
			if($this->mdl_allotted_room->insert($formData) == true) {
				// update booked bed to room database
				$roomId = $cleanPost['room-id'];
				$formData1 = array(
					'booked_bed' => $cleanPost['booked-bed'] + '1',
				);
				$this->mdl_room->update($formData1, $roomId); 

				// update room status to student database
				$studentId = $cleanPost['student-id'];
				$formData2 = array(
					'hostel_status' => '1',
				);
				$this->mdl_student->update($formData2, $studentId); 

				$this->session->set_flashdata('success', "Success, New room has been alocated to Student!");
			} else {
				$this->session->set_flashdata('danger', "Error, Can't allocated room!");
			}
			redirect('hostel/allotted_rooms', 'refresh');
		}
	}

	/**
	 * [Edit Allotted rooms details]
	 * @param  int $id [primary key]
	 * @return [type]     [description]
	 */
	public function edit($id)
	{
		$this->form_validation->set_rules('room-number', 'room number', 'required|trim');
		$this->form_validation->set_rules('building-name', 'building name', 'required|trim');
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
				'block_id' => $cleanPost['building-name'],
				'floor_id' => $cleanPost['floor-number'],
				'no_of_bed' => $cleanPost['bed-number'],
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

	public function room_status($id)
	{
		$allotted_room_p_id = $this->uri->segment(4);
		$status =  $this->uri->segment(5);
		//die;
		if($status == "0"){
			$is_active = "1";
		}else{
			$is_active = "0";
		}
		if($this->mdl_allotted_room->update_status($allotted_room_p_id,$is_active) == true) {
			$this->session->set_flashdata('success', "Success, Status update");
		} else {
			$this->session->set_flashdata('danger', "Error, Can't add!");
		}
		redirect('hostel/allotted_rooms', 'refresh');		
	}
}

/* End of file Allotted_rooms.php */
/* Location: ./application/modules/hostel/controllers/Allotted_rooms.php */
