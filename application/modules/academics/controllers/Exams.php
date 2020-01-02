<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
 * Ganga Memorial CMS
 *
 * @author		Vishwajeet Kumar
 * @copyright	Copyright (c) 2019
 */

/**
 * Class Exams
 */

class Exams extends Base_Controller
{
	/**
	 * Form_Controller constructor.
	 */
	public function __construct()
	{
		// controller constructor
		parent::__construct();
		$this->load->model('exam', 'mdl_exam');
	}

	/**
	 * [Fetch all exam list.]
	 * @param  void
	 * @return view
	 */
	public function index()
	{
		$data['lists'] = $this->mdl_exam->get_all();
		$this->template->set('title', 'Exam List');
		$this->template->load('template', 'contents', 'exam/exam_list', $data);
	}

	/**
	 * [Insert a new exam record.]
	 * @param  void
	 * @return redirect
	 */
	public function add()
	{
		$this->form_validation->set_rules('full-name', 'name', 'required|trim');
		$this->form_validation->set_rules('email', 'email', 'required|valid_email|is_unique[users.user_email]');
		$this->form_validation->set_rules('password', 'password', 'required|trim|min_length[8]|max_length[15]');
		$this->form_validation->set_rules('confpass', 'confirm password', 'required|trim|matches[password]');
		$this->form_validation->set_rules('role', 'role', 'required|trim');

		if($this->form_validation->run() == false) {
			$this->template->set('title', 'Add Exam');
			$this->template->load('template', 'contents', 'exam/exam_add');
		} else {
			$post = $this->input->post(null, true);
			$cleanPost = $this->security->xss_clean($post);
			$formData = array(
				'user_full_name' => $cleanPost['full-name'],
				'user_email' => $cleanPost['email'],
				'password' => $hashed,
				'user_role_id' => $cleanPost['role'],
				'is_developer' => isset($_POST['developer']) ? $cleanPost['developer'] : '0'
			);
			unset($cleanPost['confpass']);
			// insert to database
			if($this->mdl_exam->insert($formData) == true) {
				$this->session->set_flashdata('success', "Success, New user has been added!");
			} else {
				$this->session->set_flashdata('danger', "Error, Can't add new user!");
			}
			redirect('exams', 'refresh');
		}
	}

	/**
	 * [Edit exam details]
	 * @param  int $id [primary key]
	 * @return [type]     [description]
	 */
	public function edit($id) 
	{
		$this->form_validation->set_rules('full-name', 'full name', 'required|trim');
		$this->form_validation->set_rules('email', 'email', 'required|trim|valid_email');
		$this->form_validation->set_rules('role', 'role', 'required|trim');

		if($this->form_validation->run() == false) {
			$data['info'] = $this->mdl_exam->get($id);
			$this->template->set('title', 'Edit Exam');
			$this->template->load('template', 'contents', 'exam/exam_edit', $data);
		} else {
			$post = $this->input->post(null, true);
			$cleanPost = $this->security->xss_clean($post);
			$formData = array(
				'user_full_name' => $cleanPost['full-name'],
				'user_email' => $cleanPost['email'],
				'user_role_id' => $cleanPost['role'],
				'is_developer' => isset($_POST['developer']) ? $cleanPost['developer'] : '0'
			);
			// update to database
			if($this->mdl_exam->update($formData, $id) == true) {
				$this->session->set_flashdata('successe', "Success, User has been updated!");
			} else {
				$this->session->set_flashdata('error', "Error, Can't update the user!");
			}
			redirect('exams', 'refresh');
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
		if($this->mdl_exam->update($data, $id) == true) {
			$this->session->set_flashdata('success', "Success, Activated successfully!");
		} else {
			$this->session->set_flashdata('error', "Error, Can't activate!");
		}
		redirect('exams', 'refresh');
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
		if($this->mdl_exam->update($data, $id) == true) {
			$this->session->set_flashdata('success', "Success, Deactivated successfully!");
		} else {
			$this->session->set_flashdata('error', "Error, Can't deactivate!");
		}
		redirect('exams', 'refresh');
	}

	/**
	 * [Delete record from list.]
	 * @param  void
	 * @return boolean
	 */
	public function delete()
	{
		$id = $this->input->post('primary_id');
		if($this->mdl_exam->delete($id) == true) {
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
		if($this->mdl_exam->force_delete($id) == true) {
			$this->session->set_flashdata('success', 'DELETED!');
		} else {
			$this->session->set_flashdata('error', 'ERROR!');
		}
		redirect('exams', 'refresh');
	}
}

/* End of file Exams.php */
/* Location: ./application/modules/academics/controllers/Exams.php */