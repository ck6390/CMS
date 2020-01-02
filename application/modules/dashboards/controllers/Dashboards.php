<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
 * Ganga Memorial CMS
 *
 * @author		Amit Kumar
 * @copyright	Copyright (c) 2019
 */

/**
 * Class Dashboard
 */

class Dashboards extends Base_Controller
{
	/**
	 * Dashboard_Controller constructor.
	 */
	public function __construct()
	{
		// controller constructor
		parent::__construct();
		$this->load->model('students/student', 'mdl_student');
		$this->load->module('library/books');
		$this->load->model('library/book_issue','mdl_book_issue');
		$this->load->model('hostel/room','mdl_room');
		$this->load->model('setting/building','mdl_building');
		$this->load->model('setting/block','mdl_block');
		$this->load->model('setting/floor','mdl_floor');
		$this->load->model('setting/semester','mdl_semester');
	}

	/**
	 * Admin Dashboard.
	 * @return void [load view page]
	 */
	public function index()
	{	
		$this->template->set('title', 'Dashboard Admin');
		$this->template->load('template', 'contents', 'dashboards/dashboard_admin');
	}

	/**
	 * Admin Dashboard Search for student.
	 * @return void [load view page]
	 */
	public function admin_search()
	{
		$search_item = $this->input->post('search');

		if ($search = $this->mdl_student->searchStudent($search_item)){
			$id = $search->student_p_id;

			redirect('students/profile/'.$id, 'refresh');

		}else{

			$this->session->set_flashdata('error', "Error, Please enter correct student id!");
			redirect('dashboards', 'refresh');
		}
	}

	/**
	 * Hostel Dashboard.
	 * @return void [load view page]
	 */
	public function hostel()
	{
		$data['lists'] = $this->mdl_room->get_all();
		$data['info'] = $this->mdl_room->get_total();
		//print_r($data['info']); exit;
		$this->template->set('title', 'Dashboard Hostel');
		$this->template->load('template', 'contents', 'dashboards/dashboard_hostel', $data);
	}

	/**
	 * Hostel Dashboard Search for student.
	 * @return void [load view page]
	 */
	public function hostel_search()
	{
		$search_item = $this->input->post('search');

		if ($search = $this->mdl_student->searchStudent($search_item)){
		$id = $search->student_p_id;

			redirect('hostel/hostel_student/profile/'.$id, 'refresh');

		}else{

			$this->session->set_flashdata('error', "Error, Please enter correct student id!");
			redirect('dashboards/hostel', 'refresh');
		}
	}

	/**
	 * Library Dashboard.
	 * @return void [load view page]
	 */
	public function library()
	{
		
		$data['lists'] = $this->mdl_book->get_quantity_stock();
		//print_r($data['lists']);
		//$data['lists'] = $this->mdl_book_issue->total_issue_book();
		//print_r($data); exit;
		$this->template->set('title', 'Dashboard Library');
		$this->template->load('template', 'contents', 'dashboards/dashboard_library', $data);
	}

	/**
	 * Library Dashboard Search for student.
	 * @return void [load view page]
	 */
	public function library_search()
	{
		$search_item = $this->input->post('search');

		if ($search = $this->mdl_student->searchStudent($search_item)){
		$id = $search->student_p_id;

			redirect('library/library_student/profile/'.$id, 'refresh');

		}else{

			$this->session->set_flashdata('error', "Error, Please enter correct student id!");
			redirect('dashboards/library', 'refresh');
		}
	}

	/**
	 * Guest Book Search for issue.
	 * @return void [load view page]
	 */
	public function guest_issue()
	{
		$book_acc = $this->input->post('accession_search');

		if ($search = $this->mdl_book->searchBook($book_acc)){
		$id = $search->book_p_id;
		
			redirect('library/book_issues/guest/'.$id, 'refresh');

		}else{

			$this->session->set_flashdata('error', "Error, Please enter correct accession no.!");
			redirect('dashboards/library', 'refresh');
		}
	}

	/**
	 * Academic Dashboard.
	 * @return void [load view page]
	 */
	public function academic()
	{
		$this->template->set('title', 'Dashboard Academic');
		$this->template->load('template', 'contents', 'dashboards/dashboard_academic');
	}

	/**
	 * Academic Dashboard Search for student.
	 * @return void [load view page]
	 */
	public function academic_search()
	{
		$search_item = $this->input->post('search');

		if ($search = $this->mdl_student->searchStudent($search_item)){
		$id = $search->student_p_id;

			redirect('academics/student_profile/'.$id, 'refresh');

		}else{

			$this->session->set_flashdata('error', "Error, Please enter correct student id!");
			redirect('dashboards/academic', 'refresh');
		}
	}
}

/* End of file Dashboards.php */
/* Location: ./application/modules/hostels/controllers/Dashboards.php */
