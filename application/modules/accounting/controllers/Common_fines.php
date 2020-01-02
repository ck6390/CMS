<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
 * Ganga Memorial CMS
 *
 * @author		Vishwajeet Kumar
 * @copyright	Copyright (c) 2019
 */

/**
 * Class Common_fines
 */

class Common_fines extends Base_Controller
{
	/**
	 * Fees_Controller constructor.
	 */
	public function __construct()
	{
		// controller constructor
		parent::__construct();
		$this->load->model('Common_fine', 'mdl_common_fine');
		$this->load->model('fee_allocate', 'mdl_fee_allocate');
		$this->load->model('students/student', 'mdl_student');
		$this->load->module('setting/semesters');
		$this->load->module('setting/sessions');
		$this->load->module('setting/branches');
		$this->load->module('accounting/fee_groups');
		$this->load->module('accounting/fee_types');
		$this->load->module('setting/course_years');
	}

	/**
	 * [Fetch all Fee list.]
	 * @param  void
	 * @return view
	 */
	public function index()
	{
		$data['lists'] = $this->mdl_common_fine->get_student_fine();
		$this->template->set('title', 'Fee List');
		$this->template->load('template', 'contents', 'common_fines/student_fine_list', $data);
	}

	/**
	 * [Insert a new Fees record.]
	 * @param  void
	 * @return redirect
	 */
	public function add()
	{
		$this->form_validation->set_rules('fee-type', 'fee type', 'required|trim');
		$this->form_validation->set_rules('fee-amount', 'fee amount', 'required|trim');
		$this->form_validation->set_rules('session', 'session', 'required|trim');
		$this->form_validation->set_rules('branch[]', 'branch', 'required|trim');
		$this->form_validation->set_rules('gender[]', 'gender', 'required|trim');
		$this->form_validation->set_rules('hostel', 'hostel', 'required|trim');
			
		if($this->form_validation->run() == false) {
			$this->template->set('title', 'Add Fee');
			$this->template->load('template', 'contents', 'common_fines/common_fine_add');
		} else {
			$post = $this->input->post(NULL, TRUE);
			$cleanPost = $this->security->xss_clean($post);
			
			if($cleanPost['fee-allocated'] == "student"){
				$studentsList = $cleanPost['student-id'];
				foreach($studentsList as $students){
					$this->db->trans_begin();
					for($i=0; $i< count($cleanPost['branch']);$i++){
						$feeAllocatedStudent = array(
						'student_id' => $students,
						'fk_session_id' => $cleanPost['session'],
						'fk_branch_id' => $cleanPost['branch'][$i],
						'fk_fee_group_id' => $cleanPost['fee-group'],
						'fk_fee_type_id' => $cleanPost['fee-type'],
						'fk_course_year_id' =>"",
						'fee_amount' => $cleanPost['fee-amount'],
						'due_amount' => "0.00",
						'remarks' => $cleanPost['description'] ? $cleanPost['description'] : "",
						'created_by' => $this->session->userdata['roleID'], 
					 );
					}
					

					$this->db->insert('invoices',$feeAllocatedStudent);
					$this->db->trans_complete();
				}
			}else{
						
				$data1 = array(
					'fk_session_id' => $cleanPost['session'],
					'hostel_status' => $cleanPost['hostel'],
					'is_active' =>'1'
				);
					
				$branch = $cleanPost['branch'];
				$gender =  $cleanPost['gender'];
				$students = $this->mdl_student->get_all_students($data1,$branch,$gender);
				
				if(!empty($students)){
					foreach($students as $student){ 
						$this->db->trans_begin();
						for($i=0; $i< count($cleanPost['branch']);$i++){
							$feeAllocatedStudent = array(

								'student_id' => $student->student_p_id,
								'fk_session_id' => $cleanPost['session'],
								'fk_branch_id' => $cleanPost['branch'][$i],
								'fk_course_year_id' =>"",
								'fk_fee_group_id' => $cleanPost['fee-group'],
								'fk_fee_type_id' => $cleanPost['fee-type'],
								'fee_amount' => $cleanPost['fee-amount'],
								'due_amount' => "0.00",
								'remarks' => $cleanPost['description'] ? $cleanPost['description'] : null,
								'created_by' => $this->session->userdata['roleID'],
							);
						}
						$this->db->insert('invoices',$feeAllocatedStudent);
						$this->db->trans_complete();
					}			
				}else{
					print_r("Student Not Available");
				}
			}

			$this->session->set_flashdata('success', "Success, Student Fine has been Generated!");
			redirect('accounting/common_fines/students', 'refresh');
		}
	}

	/**
	 * [Edit fee details]
	 * @param  int $id [primary key]
	 * @return [type]     [description]
	 */
	public function edit($id) 
	{
		$this->form_validation->set_rules('fee-type', 'fee type', 'required|trim');
		$this->form_validation->set_rules('fee-group', 'fee group', 'required|trim');
		$this->form_validation->set_rules('fee-amount', 'fee amount', 'required|trim');
		$this->form_validation->set_rules('fee_schedule', 'fee schedule', 'required|trim');


		if($this->form_validation->run() == false) {
			$data['info'] = $this->mdl_fee_type->get($id);
			$this->template->set('title', 'Edit Fee Type');
			$this->template->load('template', 'contents', 'common_fines/common_fine_edit', $data);
		} else {
			$post = $this->input->post(null, true);
			$cleanPost = $this->security->xss_clean($post);
			$formData = array(
				'fee_type_name' => $cleanPost['fee-type'],
				'fee_type_amount' => $cleanPost['fee-amount'],
				'fee_group' => $cleanPost['fee-group'],
				'fee_year_id' => $cleanPost['fee-year'],
				'description' => $cleanPost['description'] ? $cleanPost['description'] : null
			);

			// update to database
			if($this->mdl_fee_type->update($formData, $id) == true) {
				$this->session->set_flashdata('successe', "Success, Fee Type has been updated!");
			} else {
				$this->session->set_flashdata('error', "Error, Can't update the fee type!");
			}
			redirect('common_fines', 'refresh');
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
		if($this->mdl_common_fine->update($data, $id) == true) {
			$this->session->set_flashdata('success', "Success, Activated successfully!");
		} else {
			$this->session->set_flashdata('error', "Error, Can't activate!");
		}
		redirect('common_fines', 'refresh');
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
		if($this->mdl_common_fine->update($data, $id) == true) {
			$this->session->set_flashdata('success', "Success, Deactivated successfully!");
		} else {
			$this->session->set_flashdata('error', "Error, Can't deactivate!");
		}
		redirect('common_fines', 'refresh');
	}

	/**
	 * [Delete record from list.]
	 * @param  void
	 * @return boolean
	 */
	public function delete()
	{
		$id = $this->input->post('primary_id');
		if($this->mdl_common_fine->delete($id) == true) {
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
		if($this->mdl_common_fine->force_delete($id) == true) {
			$this->session->set_flashdata('success', 'DELETED!');
		} else {
			$this->session->set_flashdata('error', 'ERROR!');
		}
		redirect('common_fines', 'refresh');
	}

	/**
	 * [Student Fine List record .]
	 * @param  int $id [primary key]
	 * @return redirect
	 */
	public function students()
	{
		$data['lists'] = $this->mdl_common_fine->get_student_fine();

		$this->template->set('title', 'Fee List');
		$this->template->load('template', 'contents', 'common_fines/student_fine_list', $data);
	
	}


	public function get_student_list()
	{
		$session = $_POST['session'];
		$branch = $_POST['branch'];
		$gender = $_POST['gender'];
		$hostel = $_POST['hostel'];
		
		$data1 = array(
				'fk_session_id' => $session,
				'hostel_status' => $hostel,
				'is_active' =>'1'
		);
		
		$this->db->select('student_p_id, student_unique_id')->from('students')->where($data1);
		$this->db->where_in('fk_branch_id', $branch);
		$this->db->where_in('gender', $gender);
		$query = $this->db->get();
		$result = $query->num_rows() > 0 ? $query->result() : false;
		echo json_encode($result);
	}

}

/* End of file fee_types.php */
/* Location: ./application/modules/setting/controllers/fee_types.php */	