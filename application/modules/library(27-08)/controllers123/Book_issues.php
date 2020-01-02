<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
 * Ganga Memorial CMS
 *
 * @author		Vishwajeet Kumar
 * @copyright	Copyright (c) 2019
 */

/**
 * Class Book_issues
 */

class Book_issues extends Base_Controller
{
	/**
	 * Book_issues Controller constructor.
	 */
	public function __construct()
	{
		// controller constructor
		parent::__construct();
		$this->load->model('book_issue', 'mdl_book_issue');
		//$this->load->model('book_category', 'mdl_book_category');
		$this->load->model('book', 'mdl_book');
		//$this->load->model('fee_type', 'mdl_fee_type');
		//$this->load->model('fee_group', 'mdl_fee_group');
		$this->load->model('students/student', 'mdl_student');
		//$this->load->module('students');
		$this->load->module('accounting/fee_groups');
		$this->load->module('accounting/fee_types');
		$this->load->module('library/book_categories');
		$this->load->module('library/book_issues');
		$this->load->model('library/guest_book','mdl_guest_book');
		$this->load->model('employees/Mdl_employee', 'mdl_employee');

	}

	/**
	 * Fetch all Book_issues list.
	 * @return void [load view page]
	 */
	public function index()
	{
		$data['lists'] = $this->mdl_book_issue->get_issued_book();
		//$data['info'] = $this->mdl_student->get_all();
		$this->template->set('title', 'Issued Book List');
		$this->template->load('template', 'contents', 'book_issue/issue_book_list', $data);
	}

	/**
	 * Guest Issue Book.
	 * @return void [load view page]
	 */
	
	public function guest_book_list()
	{
		$data['lists'] = $this->mdl_guest_book->get_all();
		//$data['info'] = $this->mdl_student->get_all();
		$this->template->set('title', 'Issued Book List');
		$this->template->load('template', 'contents', 'book_issue/guest_book_issue_list', $data);
	}

	public function guest($id)
	{
		$this->form_validation->set_rules('guest-id', 'Guest', 'required|trim');
		$data['info'] = $this->mdl_book->get($id);
		if($this->form_validation->run() == false) {

			
			//print_r($data['info']); exit;
			$this->template->set('title', 'Guest Book Issue');
			$this->template->load('template', 'contents', 'book_issue/guest_book_issue',$data);

		} else {

			$post = $this->input->post(null, true);
			$cleanPost = $this->security->xss_clean($post);

			$issue_date = date('Y-m-d');
			$return_date = date('Y-m-d', strtotime($issue_date. '+ 14 days'));
			$formData = array(
				'book_id' => $id,
				'guest_id' => $cleanPost['guest-id'], 
				'issue_date' => $issue_date,
				'return_date' => $return_date,
				'remarks' => $cleanPost['remarks'] ? $cleanPost['remarks'] : null,
			);

			//print_r($formData);exit;
			//check book stock
			if ($this->mdl_book->check_stock($id) == true){

				$this->session->set_flashdata('error', "Error, No book stock available for issue!");
				redirect('library/book_issues/guest/'.$id, 'refresh');
			}

			// insert to database
			if($this->db->insert('guest_book_issues',$formData)) {

				//update book stock
				$formData1 = array(
					'stock' => $data['info']->stock - '1',
				);
				$this->mdl_book->update($formData1, $id);

				$this->session->set_flashdata('success', "Success, Guest issue a book successfully!");
			} else {
				$this->session->set_flashdata('error', "Error, Can't issue a book!");
			}
			redirect('library/book_issues/guest_book_list', 'refresh');

		}
	}

	public function guest_book_edit($id){

		$this->form_validation->set_rules('book-id', 'book', 'required|trim');
		if($this->form_validation->run() == false) {

			$data['info'] = $this->mdl_guest_book->get($id);
			//print_r($data['info']); exit;
			$this->template->set('title', 'Guest Book Issue');
			$this->template->load('template', 'contents', 'book_issue/guest_book_edit',$data);

		}else{

			$post = $this->input->post(null, true);
			$cleanPost = $this->security->xss_clean($post);

			$issue_date = date('Y-m-d');
			$return_date = date('Y-m-d', strtotime($issue_date. '+ 14 days'));
			$formData = array(

				'book_id' => $cleanPost['book-id'],
			);

			$this->mdl_guest_book->update($formData, $id);

		}
	}

	public function guest_book_return($book_id, $guest_id )
	{
		$returnBook = array(
			'submit_date' => date('Y-m-d'),
			'is_active' => '0'
		);
		
		//var_dump($data['bookStock']);
		$stock = $this->mdl_book->get($book_id)->stock;

		$formData2 = array(
			'stock' => $stock + '1',
		);
		// var_dump($formData2);
		// die();
		if($this->mdl_book_issue->returnBook($returnBook, $guest_id) == true && $this->mdl_book->update($formData2, $book_id)) {

			$this->session->set_flashdata('success', "Success, Return successfully!");
		} else {
			$this->session->set_flashdata('error', "Error, Can't Return!");
		}
			redirect('library/book_issues/guest_book_list', 'refresh');
		
	}

	/**
	 * [Issued Book setting]
	 * @param  int $id [primary key]
	 * @return mixed
	 */
	public function setting()
	{

		$data['lists'] = $this->mdl_book_issue->issued_book_setting();
		//print_r($data['lists']); exit;
		$this->template->set('title', 'Setting');
		$this->template->load('template', 'contents', 'book_issue/issued_book_setting', $data);
	}

	/**
	 * [Issued Book update issue date]
	 * @param  int $id [primary key]
	 * @return mixed
	*/
	public function update_issue_date($id)
	{
		$issueDate = $_POST['issue-date'];
		//print_r($issueDate); exit;
		
		$formData = array(
			'issue_date' => $issueDate,
		);
		//print_r($formData); exit;
		// update to database
		if($this->mdl_book_issue->update($formData, $id) == true) {

			//echo "<div id=\"toast-container\" class=\"toast-top-right\" aria-live=\"polite\" role=\"alert\"><div class=\"toast toast-success\"><div class=\"toast-message\">Success, updated successfully!</div></div></div>";
			$this->session->set_flashdata('success', "Success, updated successfully!");
		} else {
			$this->session->set_flashdata('error', "Error, Can't update the Issue Date!");
		}
		redirect('library/book_issues/setting', 'refresh');
	}

	/**
	 * [Issued Book update return date]
	 * @param  int $id [primary key]
	 * @return mixed
	*/
	public function update_return_date($id)
	{
		$returnDate = $_POST['return-date'];
		
		$formData = array(
			'return_date' => $returnDate,
		);
		//print_r($formData); exit;
		// update to database
		if($this->mdl_book_issue->update($formData, $id) == true) {

			echo "<div id=\"toast-container\" class=\"toast-top-right\" aria-live=\"polite\" role=\"alert\"><div class=\"toast toast-success\"><div class=\"toast-message\">Success, updated successfully!</div></div></div>";
			//$this->session->set_flashdata('success', "Success, updated successfully!");
		} else {
			$this->session->set_flashdata('error', "Error, Can't update the Issue Date!");
		}
		redirect('library/book_issues/setting', 'refresh');
	}
}

/* End of file Book_issues.php */
/* Location: ./application/modules/library/controllers/Book_issues.php */