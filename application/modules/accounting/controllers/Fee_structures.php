<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
 * Ganga Memorial CMS
 *
 * @author		Vishwajeet Kumar
 * @copyright	Copyright (c) 2019
 */

/**
 * Class Fee_structure
 */

class Fee_structures extends Base_Controller
{
	/**
	 * Fee_structure_Controller constructor.
	 */
	public function __construct()
	{
		// controller constructor
		parent::__construct();
		$this->load->model('fee_structure', 'mdl_structure');
	}

	/**
	 * [Fetch all Fee Structure list.]
	 * @param  void
	 * @return view
	 */
	public function index()
	{
		$data['lists'] = $this->mdl_structure->get_all();
		$this->template->set('title', 'Fee Structure List');
		$this->template->load('template', 'contents', 'fee_structures/list', $data);
	}

	/**
	 * [Insert a new fee structure record.]
	 * @param  void
	 * @return redirect
	 */
	public function add()
	{	
		$this->form_validation->set_rules('fee-title', 'fee structure', 'required|trim');
		$this->form_validation->set_rules('session', 'session', 'required|trim');
		$this->form_validation->set_rules('total-fee', 'total fee', 'required|trim');

		if($this->form_validation->run() == false) {
		$this->template->set('title', 'Add Fee Structure');
		$this->template->load('template', 'contents', 'fee_structures/add');
		} else {
			$post = $this->input->post(null, true);
			$cleanPost = $this->security->xss_clean($post);
			
			$formData = array(
				'fee_structure_title' => $cleanPost['fee-title'],
				'session_ID' => $cleanPost['session'],
				'course_year' => $cleanPost['year']?$cleanPost['year']:$cleanPost['course-year'],
				'tution_fee' => $this->input->post('tution')?$this->input->post('tution'):'0.00',
				'admission_fee' => $this->input->post('admission')?$this->input->post('admission'):'0.00',
				'library_fee' => $this->input->post('library')?$this->input->post('library'):'0.00',  
				'magazine_fee' =>  $this->input->post('magazine')?$this->input->post('magazine'):'0.00', 
				'exam_fee_internal' => $this->input->post('exam')?$this->input->post('exam'):'0.00',
				'sports_fee' => $this->input->post('sports')?$this->input->post('sports'):'0.00',
				'medical_exam_fee' => $this->input->post('medical')?$this->input->post('medical'):'0.00',
				'developement_fee' => $this->input->post('development')?$this->input->post('development'):'0.00',
				'miscellaneous_fee' => $this->input->post('miscellaneous')?$this->input->post('miscellaneous'):'0.00',
				'fk_semester_id' => $this->input->post('semester-id')?$this->input->post('semester-id'):'0.00',
				'semester_fee' => $this->input->post('semester')?$this->input->post('semester'):'0.00',
				'fee_structure_type' => $cleanPost['fee-type'],
				'other_fee' => $cleanPost['other-fee']?$cleanPost['other-fee']:'0.00' ,			
				'total_fee' => $cleanPost['total-fee'],	
			);
			// insert to database
			if($this->mdl_structure->insert($formData) == true) {
				$this->session->set_flashdata('success', "Success, New Fee Structure has been added!");
			} else {
				$this->session->set_flashdata('danger', "Error, Can't add new fee structure!");
			}
			redirect('accounting/fee_structures', 'refresh');
		}
	}

	/**
	 * [Edit fee structure details]
	 * @param  int $id [primary key]
	 * @return [type]     [description]
	 */
	public function edit($id) 
	{	
		$this->form_validation->set_rules('fee-title', 'fee structure', 'required|trim');
		$this->form_validation->set_rules('session', 'session', 'required|trim');
		$this->form_validation->set_rules('year', 'course year', 'required|trim');
		$this->form_validation->set_rules('tution-fee', 'tution fee', 'required|trim');
		$this->form_validation->set_rules('admission-fee', 'admission fee', 'required|trim');
		$this->form_validation->set_rules('library-fee', 'library fee', 'required|trim');
		$this->form_validation->set_rules('magazine-fee', 'magazine fee', 'required|trim');
		$this->form_validation->set_rules('exam-fee', 'exam fee internal', 'required|trim');
		$this->form_validation->set_rules('sports-fee', 'sports fee', 'required|trim');
		$this->form_validation->set_rules('medical-exam-fee', 'medical exam fee', 'required|trim');
		$this->form_validation->set_rules('development-fee', 'development fee', 'required|trim');
		$this->form_validation->set_rules('miscellaneous-fee', 'miscellaneous fee', 'required|trim');
		$this->form_validation->set_rules('total-fee', 'total fee', 'required|trim');
		if($this->form_validation->run() == false) {
			$data['info'] = $this->mdl_structure->get($id);
			$this->template->set('title', 'Edit Fee Structure');
			$this->template->load('template', 'contents', 'fee_structures/edit', $data);
		} else {
			$post = $this->input->post(null, true);
			$cleanPost = $this->security->xss_clean($post);
			
			$formData = array(
				'fee_structure_title' => $cleanPost['fee-title'],
				'session_ID' => $cleanPost['session'],
				'course_year' => $cleanPost['year'],
				'tution_fee' => $cleanPost['tution-fee'],
				'admission_fee' => $cleanPost['admission-fee'],
				'library_fee' => $cleanPost['library-fee'],
				'magazine_fee' => $cleanPost['magazine-fee'],
				'exam_fee_internal' => $cleanPost['exam-fee'],
				'sports_fee' => $cleanPost['sports-fee'],
				'medical_exam_fee' => $cleanPost['medical-exam-fee'],
				'developement_fee' => $cleanPost['development-fee'],
				'miscellaneous_fee' => $cleanPost['miscellaneous-fee'],
				'other_fee' => $cleanPost['other-fee']?$cleanPost['other-fee']:'0.00' ,
				'semester_fee' => $cleanPost['semester-fee']?$cleanPost['other-fee']:'0.00' ,
				'total_fee' => $cleanPost['total-fee'],	
			);
			
			// update to database
			if($this->mdl_structure->update($formData, $id) == true) {
				$this->session->set_flashdata('successe', "Success, Fee Structure has been updated!");
			} else {
				$this->session->set_flashdata('error', "Error, Can't update the fee structure!");
			}
			redirect('accounting/fee_structures', 'refresh');
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
		if($this->mdl_structure->update($data, $id) == true) {
			$this->session->set_flashdata('success', "Success, Activated successfully!");
		} else {
			$this->session->set_flashdata('error', "Error, Can't activate!");
		}
		redirect('accounting/fee_structures', 'refresh');
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
		if($this->mdl_structure->update($data, $id) == true) {
			$this->session->set_flashdata('success', "Success, Deactivated successfully!");
		} else {
			$this->session->set_flashdata('error', "Error, Can't deactivate!");
		}
		redirect('accounting/fee_structures', 'refresh');
	}

	/**
	 * [Delete record from list.]
	 * @param  void
	 * @return boolean
	 */
	public function delete()
	{
		$id = $this->input->post('primary_id');
		if($this->mdl_structure->delete($id) == true) {
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
		if($this->mdl_structure->force_delete($id) == true) {
			$this->session->set_flashdata('success', 'DELETED!');
		} else {
			$this->session->set_flashdata('error', 'ERROR!');
		}
		redirect('accounting/fee_structures', 'refresh');
	}

	/**
	 * [Get all fee type for annual fee.]
	 * @param  int $id [primary key]
	 * @return mixed
	 */
	public function get_fee()
	{	
		$groupID = '1';
		$year = $_POST['year'];
		$query = $this->db->select('fee_type_p_id,fee_type_name,fee_type_amount,fee_year_id')->from('fee_types')->where(array(
                'fee_group' => $groupID,
                'fee_year_id' => $year,
                'is_active' =>'1'
            ));
		$query = $this->db->or_where("fee_group", '3');
		$query = $this->db->get();
		$result = $query->num_rows() > 0 ? $query->result() : false;
		echo json_encode($result);
	}

	/**
	 * [Get all fee type for Semester fee.]
	 * @param  int $id [primary key]
	 * @return mixed
	 */
	public function get_semester_fee()
	{
		$semestersFee = $_POST['semestersFee'];
		$query = $this->db->select('fee_type_name,fee_type_amount')->from('fee_types')->where(array(
                'is_active' =>'1',
                'fee_type_p_id'=> $semestersFee

            ));
		$query = $this->db->get();
		$result = $query->num_rows() > 0 ? $query->result() : false;
		echo json_encode($result);
	}
}

/* End of file Fee_structures.php */
/* Location: ./application/modules/fee_structures/controllers/Fee_structures.php */