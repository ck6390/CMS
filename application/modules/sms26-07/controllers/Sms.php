<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
 * Ganga Memorial CMS
 *
 * @author		Manoj Kumar
 * @copyright	Copyright (c) 2019
 */

/**
 * Class Sms
 */

class Sms extends Base_Controller
{
	/**
	 * Fees_Controller constructor.
	 */
	public function __construct()
	{
		// controller constructor
		parent::__construct();
		$this->load->model('Mdl_sms', 'mdl_sms');
		$this->load->model('setting/sms_setting', 'mdl_sms_setting');
		$this->load->model('setting/session', 'mdl_session');
		$this->load->model('setting/course_year','mdl_course_year');
		$this->load->model('setting/semester','mdl_semester');
		$this->load->model('setting/branch','mdl_branch');
		$this->load->model('students/student', 'mdl_student');
		$this->load->helper('sms_helper');
	}

	/**
	 * [Fetch all Fee list.]
	 * @param  void
	 * @return view
	 */
	public function index()
	{
		$data['lists'] = $this->mdl_sms->get_all();
		$this->template->set('title', 'SMS List');
		$this->template->load('template', 'contents', 'list', $data);
	}

	/**
	 * [Insert a new Fees record.]
	 * @param  void
	 * @return redirect
	 */
	public function send_sms()
	{	
		
		$this->form_validation->set_rules('session', 'session', 'required|trim');
		$this->form_validation->set_rules('year', 'course Year', 'required|trim');
		$this->form_validation->set_rules('branch[]', 'branch', 'required|trim');
		$this->form_validation->set_rules('sms-for', 'sms for', 'required|trim');
		
			
		if($this->form_validation->run() == false) {
			$this->template->set('title', 'Send SMS');
			$this->template->load('template', 'contents', 'add');
		} else {
			$post = $this->input->post(NULL, TRUE);
			$cleanPost = $this->security->xss_clean($post);

			if($cleanPost['sms-for'] == "student"){
				$studentsList = $cleanPost['student-id'];
				//$i=1;
				foreach($studentsList as $students){
					$this->db->trans_begin();

					$sendSmsStudent = array(
						
						'student_id' => $students,
						'fk_session_id' => $cleanPost['session'],
						'sms_type' => 'Dues Fee',
						'fk_course_year_id' => $cleanPost['year'],
						'message' => $cleanPost['message'] ? $cleanPost['message'] : null,
						'sender_role_id' => $this->session->userdata['roleID'],
					);
					
					$insert_id = $this->db->insert('sms',$sendSmsStudent);
					
					if ($insert_id) {

				        $message = trim($cleanPost['message']);
				       	$student_phone = $this->mdl_student->get($students)->student_sms_no;
				      	
				      	if ($student_phone) {

			                $urlencode = urlencode($message);                    
        					send_sms($student_phone,$urlencode);
						}
				       	
                    }
                  
                    $this->db->trans_complete();
				}
				
			}else{
				
				$branch = $cleanPost['branch'];
				$data1 = array(
					'fk_session_id' => $cleanPost['session'],
					'fk_course_year_id' => $cleanPost['year'],
					'is_active' =>'1',
				);
				
				$students = $this->mdl_sms->get_AllStudents_for_sms($data1,$branch);
				if(!empty($students)){
					foreach($students as $student){ 
						//$this->db->trans_begin();
						$sendSmsStudent = array(
							
							'student_id' => $student->student_p_id,
							'fk_session_id' => $cleanPost['session'],
							'fk_course_year_id' => $cleanPost['year'],
							'message' => $cleanPost['message'] ? $cleanPost['message'] : null,
							'sender_role_id' => $this->session->userdata['roleID'],
						);

						
						//$this->db->insert('sms',$sendSmsStudent);
						//$this->db->trans_complete();
					print_r($sendSmsStudent);
					}	
					exit;	
				}else{
					$this->session->set_flashdata('danger', "Error, Student Not Found!");
				}
			}

			$this->session->set_flashdata('success', "Success, Invoice Generated For Collge Fee!");

			redirect('sms', 'refresh');
		}
	}

	/**
	 * [Fetch Student record from database.]
	 * @param  int $id [primary key]
	 * @return redirect
	 */
	public function get_student_for_sms()
	{
		$session = $_POST['session'];
		$branch = $_POST['branch'];
		$year = $_POST['year'];
		$data1 = array(
				'fk_session_id' => $session,
				'fk_course_year_id' => $year,
				'is_active' =>'1'
		);
		
		$this->db->select('student_p_id, student_unique_id')->from('students')->where($data1);
		$this->db->where_in('fk_branch_id', $branch);

		$query = $this->db->get();
		$result = $query->num_rows() > 0 ? $query->result() : false;
		echo json_encode($result);
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
		if($this->mdl_fee_type->update($data, $id) == true) {
			$this->session->set_flashdata('success', "Success, Activated successfully!");
		} else {
			$this->session->set_flashdata('error', "Error, Can't activate!");
		}
		redirect('accounting/invoices', 'refresh');
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
		if($this->mdl_fee_type->update($data, $id) == true) {
			$this->session->set_flashdata('success', "Success, Deactivated successfully!");
		} else {
			$this->session->set_flashdata('error', "Error, Can't deactivate!");
		}
		redirect('accounting/fee_types', 'refresh');
	}

	/**
	 * [Delete record from list.]
	 * @param  void
	 * @return boolean
	 */
	public function delete()
	{
		$id = $this->input->post('primary_id');
		if($this->mdl_sms->delete($id) == true) {
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
		if($this->mdl_fee_type->force_delete($id) == true) {
			$this->session->set_flashdata('success', 'DELETED!');
		} else {
			$this->session->set_flashdata('error', 'ERROR!');
		}
		redirect('accounting/invoices', 'refresh');
	}

	
}

/* End of file Invoices.php */
/* Location: ./application/modules/accounting/controllers/Invoices.php */