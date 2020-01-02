<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
 * Ganga Memorial CMS
 *
 * @author		Amit Kumar
 * @copyright	Copyright (c) 2019
 */

/**
 * Class Hostel_student
 */

class Hostel_student extends Base_Controller
{
	/**
	 * Hostel_student constructor.
	 */
	public function __construct()
	{
		// controller constructor
		parent::__construct();
		$this->load->model('students/student', 'mdl_student');
		//$this->load->library('DuesFee');
	}

	/**
	 * Fetch all Students list.
	 * @return void [load view page]
	 */
	public function index()
	{
		$data['lists'] = $this->mdl_student->get_branch_session();
		$this->template->set('title', 'Student Hostel List');
		$this->template->load('template', 'contents', 'student_hostel/student_hostel_list', $data);
	}

	/**
	 * Profile of hostel student.
	 * @return void [load view page]
	 */
	public function profile($id)
	{
		$this->template->set('title', 'Hostel Student Profile');
		$data['info'] = $this->mdl_student->get_student_profile($id);
		$data['hostel_dues'] = $this->duesfee->hostelRoomDue($id);
		$data['hostel_mess'] = $this->duesfee->hostelMessDue($id);
		$this->template->load('template', 'contents', 'student_hostel/student_hostel_profile',$data);
	}

	/**
	 * Add fee/fine for hostel student.
	 * @return void [load view page]
	 */
	public function fee_fine($id)
	{	
		$this->form_validation->set_rules('fee-type', 'Fee Type', 'required|trim');
		$this->form_validation->set_rules('fee-group', 'Fee Group', 'required|trim');
		$this->form_validation->set_rules('amount', 'Fee Amount', 'required|trim');
		$this->form_validation->set_rules('due-on', 'Due On', 'required|trim');

		if($this->form_validation->run() == false) {

			$data['info'] = $this->mdl_student->get($id);
			$data['lists'] = $this->mdl_student->get_fine_list($id);
			$data['hostel_dues'] = $this->mdl_student->get_due_hostel_due($id);
			$data['hostel_room'] = $this->mdl_student->get_due_hostel_room($id);
			$data['hostel_mess'] = $this->mdl_student->get_due_hostel_mess($id);

			$this->template->set('title', 'Student Fee/Fine');
			$this->template->load('template', 'contents', 'student_hostel/student_hostel_fee_fine_add',$data);
		} else {

			$post = $this->input->post(null, true);
			$cleanPost = $this->security->xss_clean($post);

			$formData = array(
				'fee_type_id' => $cleanPost['fee-type'],
				'student_id' => $id,
				'fine_amount' => $cleanPost['amount'],
				'due_date' => $cleanPost['due-on'],
				'remarks' => $cleanPost['remarks'] ? $cleanPost['remarks'] : null,
				'created_by' => $this->session->userdata['roleID'],
			);

			// insert to database
			if($this->db->insert('fee_allocates',$formData)) {
				$this->session->set_flashdata('success', "Success, New Fine has been added!");
			} else {
				$this->session->set_flashdata('error', "Error, Can't add new Fine!");
			}
			redirect('hostel/hostel_student/fee_fine/'.$id, 'refresh');
		}
			
	}

	/**
	 * [payment history for hostel student.]
	 * @param  int $id [primary key]
	 * @return redirect
	 */
	public function payment_history($id)
	{
		$this->template->set('title', 'Student Fee/Fine');
		$data['info'] = $this->mdl_student->get_student_profile($id);
		$data['payment_history'] = $this->mdl_hostel_invoice->invoice_payment_student_hostel($id);
		
		$data['lists'] = $this->mdl_student->student_hostel_payment_history($id);
		$this->template->load('template', 'contents', 'student_hostel/student_hostel_payment_history',$data);
	}

	/**
	 * de-allot hostel room for hostel student.
	 * @return void [load view page]
	 */
	public function de_allote_room($student_id)
	{
		$de_allote_room = array(
			'is_active' => '0',
			'checkout_date' => date('Y-m-d'),

		);
		$roomId = $this->mdl_student->get_student_alloted_room($student_id);

		$roomId->room_id;
		$booked_bed = array(

			'booked_bed' => $roomId->booked_bed - '1'
		);
		
		
		$formData2 = array(
			'hostel_status' => '0'
		);

		$this->mdl_student->update($formData2, $student_id); 

		if($this->mdl_room->update($booked_bed, $roomId->room_id) == true && $this->mdl_allotted_room->update($de_allote_room, $roomId->allotted_room_p_id)) {
			$this->session->set_flashdata('success', "Success, student De-alloted Room successfully!");
		} else {
			$this->session->set_flashdata('error', "Error, Can't deactivate!");
		}
		redirect('hostel/rooms', 'refresh');
	}
}

/* End of file Hostel_student.php */
/* Location: ./application/modules/hostel/controllers/Hostel_student.php */
