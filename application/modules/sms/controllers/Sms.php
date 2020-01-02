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
		$this->load->model('employees/Mdl_employee', 'mdl_employee');
		$this->load->model('visitors/visitor', 'mdl_visitor');
		$this->load->model('admin/role', 'mdl_role');
		$this->load->model('admin/user', 'mdl_user');
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
		// $this->load->dbforge();
		// $fields = array(
  //       		'receiver_type' => array(
		// 	        			'type' => 'int',
		// 	        			'constraint' => '10',
		// 	        		),
        		
		// );
		// $this->dbforge->add_column('sms', $fields);
		

		// $fields = array(
  //                   'student_id' => array(
  //                                    'name' => 'receiver_id',
  //                                    'type' => 'INT',
  //                                   ),
		// );
		// $this->dbforge->modify_column('sms', $fields);

		// $this->form_validation->set_rules('session', 'session', 'required|trim');
		// $this->form_validation->set_rules('year', 'course Year', 'required|trim');
		// $this->form_validation->set_rules('branch[]', 'branch', 'required|trim');
		// $this->form_validation->set_rules('sms-for', 'sms for', 'required|trim');
		
			
		// if($this->form_validation->run() == false) {
		// 	$this->template->set('title', 'Send SMS');
		// 	$this->template->load('template', 'contents', 'add');
		// } else {
		// 	$post = $this->input->post(NULL, TRUE);
		// 	$cleanPost = $this->security->xss_clean($post);

		// 	if($cleanPost['sms-for'] == "receiver"){
		// 		$reciverList = $cleanPost['receiver-id'];
		// 		//$i=1;
		// 		foreach($reciverList as $receiver){
		// 			$this->db->trans_begin();

		// 			$sendSmsStudent = array(
		// 				//'receiver_type' => 
		// 				'student_id' => $students,
		// 				'fk_session_id' => $cleanPost['session'],
		// 				'sms_type' => 'Dues Fee',
		// 				'fk_course_year_id' => $cleanPost['year'],
		// 				'message' => $cleanPost['message'] ? $cleanPost['message'] : null,
		// 				'sender_role_id' => $this->session->userdata['roleID'],
		// 			);
					
		// 			$insert_id = $this->db->insert('sms',$sendSmsStudent);
					
		// 			if ($insert_id) {

		// 		        $message = trim($cleanPost['message']);
		// 		       	$student_phone = $this->mdl_student->get($students)->student_sms_no;
				      	
		// 		      	if ($student_phone) {

		// 	                $urlencode = urlencode($message);                    
  //       					send_sms($student_phone,$urlencode);
		// 				}
				       	
  //                   }
                  
  //                   $this->db->trans_complete();
		// 		}
				
		// 	}else{
				
		// 		$branch = $cleanPost['branch'];
		// 		$data1 = array(
		// 			'fk_session_id' => $cleanPost['session'],
		// 			'fk_course_year_id' => $cleanPost['year'],
		// 			'is_active' =>'1',
		// 		);
				
		// 		$students = $this->mdl_sms->get_AllStudents_for_sms($data1,$branch);
		// 		if(!empty($students)){
		// 			foreach($students as $student){ 
		// 				//$this->db->trans_begin();
		// 				$sendSmsStudent = array(
							
		// 					'student_id' => $student->student_p_id,
		// 					'fk_session_id' => $cleanPost['session'],
		// 					'fk_course_year_id' => $cleanPost['year'],
		// 					'message' => $cleanPost['message'] ? $cleanPost['message'] : null,
		// 					'sender_role_id' => $this->session->userdata['roleID'],
		// 				);

						
		// 				//$this->db->insert('sms',$sendSmsStudent);
		// 				//$this->db->trans_complete();
		// 			print_r($sendSmsStudent);
		// 			}	
		// 			exit;	
		// 		}else{
		// 			$this->session->set_flashdata('danger', "Error, Student Not Found!");
		// 		}
		// 	}

		// 	$this->session->set_flashdata('success', "Success, Invoice Generated For Collge Fee!");

		// 	redirect('sms', 'refresh');
		// }




		$this->form_validation->set_rules('user-role', 'receiver type', 'required|trim');
		$this->form_validation->set_rules('message', 'message', 'required|trim');
		$this->form_validation->set_rules('sms-for', 'sms for', 'required|trim');
		
			
		if($this->form_validation->run() == false) {
			$this->template->set('title', 'Send SMS');
			$this->template->load('template', 'contents', 'add');
		} else {
			$post = $this->input->post(NULL, TRUE);
			$cleanPost = $this->security->xss_clean($post);

			if($cleanPost['sms-for'] == "receiver"){
				$reciverList = $cleanPost['receiver-id'];
				//$i=1;
				foreach($reciverList as $receiver){
					$this->db->trans_begin();

					$sendSmsStudent = array(
						'receiver_type' => $cleanPost['user-role'],
						'receiver_id' => $receiver,
						'message' => $cleanPost['message'],
						'sender_role_id' => $this->session->userdata['roleID'],
					);
					
					$insert_id = $this->db->insert('sms',$sendSmsStudent);
					
					if ($insert_id) {

				        $message = trim($cleanPost['message']);
				        if($cleanPost['user-role']==10){
				        	$receiver_phone = $this->mdl_student->get($receiver)->student_sms_no;
				        }elseif($cleanPost['user-role']==8){
				        	$receiver_phone = $this->mdl_employee->get($receiver)->emp_phone;
				        }
				       
				      	if ($receiver_phone) {

			                $urlencode = urlencode($message);                    
        					send_sms($receiver_phone,$urlencode);
						}
				       	
                    }
                  
                    $this->db->trans_complete();
				}
				
			}else{
				
				if($cleanPost['user-role']==10){

					$data = array(
						'is_active' => '1',
						'user_role_id' => $cleanPost['user-role'],
						'fk_semester_id' => $cleanPost['semester']
					); 
				    $reciverList = $this->mdl_sms->get_AllStudent_for_sms($data,$cleanPost['branch']);		     
				}elseif($cleanPost['user-role']==8){
					$data = array(
						'is_active' => '1',
					); 
				    $reciverList = $this->mdl_sms->get_AllEmp_for_sms($data);
		        }
				
				
				if(!empty($reciverList)){
					foreach($reciverList as $receiver){ 
						
						$receiver_id ="";
						if(!empty($receiver->student_p_id)){
							$receiver_id =	$receiver->student_p_id;
							$receiver_phone = $this->mdl_student->get($receiver_id)->student_sms_no;					
						}else{
							$receiver_id =	$receiver->emp_p_id;
							$receiver_phone = $this->mdl_employee->get($receiver_id)->emp_phone;
						}

						$sendSmsStudent = array(
							'receiver_type' => $cleanPost['user-role'],
							'receiver_id' => $receiver_id,
							'message' => $cleanPost['message'],
							'sender_role_id' => $this->session->userdata['roleID'],
						);

						$insert_id = $this->db->insert('sms',$sendSmsStudent);
					
						if ($insert_id) {

					        $message = trim($cleanPost['message']);
					       
					      	if ($receiver_phone) {

				                $urlencode = urlencode($message);                    
	        					send_sms($receiver_phone,$urlencode);
							}
					       	
	                    }
	                 // print_r($receiver_phone);
	                    //$this->db->trans_complete();
					}	
						
				}else{
					$this->session->set_flashdata('danger', "Error, Student Not Found!");
				}
			}
			//exit;
			$this->session->set_flashdata('success', "Success, Sms has been sent");

			redirect('sms', 'refresh');
		}
	}

	public function general_sms(){
		$this->form_validation->set_rules('message', 'message', 'required|trim');
		$this->form_validation->set_rules('number', 'Number', 'required|trim');		
			
		if($this->form_validation->run() == false) {
			$this->template->set('title', 'Send SMS');
			$this->template->load('template', 'contents', 'general-sms');
		} else {
			$post = $this->input->post(NULL, TRUE);
			$cleanPost = $this->security->xss_clean($post);
			$number_split = str_replace(" ", ",", $cleanPost['number']);
			//var_dump($number_implode);
			//die();
			$sendSmsStudent = array(
				'general_number' => $number_split,
				'message' => $cleanPost['message'],
				'sender_role_id' => $this->session->userdata['roleID'],
			);						
			$insert_id = $this->db->insert('sms',$sendSmsStudent);
			$urlencode = urlencode($cleanPost['message']);                    
        	if(send_sms($number_split,$urlencode)){
        		$this->session->set_flashdata('success', "Success, Sms has been sent");
        	}else{
        		$this->session->set_flashdata('error', "Error, Sms can't be send.");
        	}        	
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
		// $session = $_POST['session'];
		// $branch = $_POST['branch'];
		// $year = $_POST['year'];
		// $data1 = array(
		// 		'fk_session_id' => $session,
		// 		'fk_course_year_id' => $year,
		// 		'is_active' =>'1'
		// );
		
		// $this->db->select('student_p_id, student_unique_id')->from('students')->where($data1);
		// $this->db->where_in('fk_branch_id', $branch);

		// $query = $this->db->get();
		// $result = $query->num_rows() > 0 ? $query->result() : false;
		// echo json_encode($result);
		// 
		


		$branch = $_POST['branch'];
		//var_dump($branch);
		$semester = $_POST['semester'];
		$data1 = array(
				'fk_semester_id'=>$semester,
				'is_active' =>'1'
		);
		
		$this->db->select('student_p_id, student_unique_id')->from('students')->where($data1);
		$this->db->where_in('fk_branch_id', $branch);

		$query = $this->db->get();
		$result = $query->num_rows() > 0 ? $query->result() : false;
		echo json_encode($result);
	}

	public function empList($id){

		$list = $this->mdl_visitor->employee_list($id);
		echo json_encode($list);
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