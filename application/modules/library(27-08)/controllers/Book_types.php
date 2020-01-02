<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
 * Ganga Memorial CMS
 *
 * @author		Vishwajeet Kumar
 * @copyright	Copyright (c) 2019
 */

/**
 * Class Book_types
 */

class Book_types extends Base_Controller
{
	/**
	 * Book_types Controller constructor.
	 */
	public function __construct()
	{
		// controller constructor
		parent::__construct();
		$this->load->model('Book_type', 'mdl_Book_type');
		$this->load->module('setting/semesters');
	}

	/**
	 * Fetch all Book_types list.
	 * @return void [load view page]
	 */
	public function index()
	{
		$data['lists'] = $this->mdl_Book_type->get_all();
		$this->template->set('title', 'Book Type List');
		$this->template->load('template', 'contents', 'book_type/book_type_list', $data);
	}

	/**
	 * Insert new record.
	 * @return void [load view page]
	 */
	public function add()
	{
		$this->form_validation->set_rules('book-type', 'Book Type', 'required|trim');

		if($this->form_validation->run() == false) {
			// $data['info'] = $this->mdl_book_category->get();
			$this->template->set('title', 'Add Book Type');
			$this->template->load('template', 'contents', 'book_type/book_type_add');

		} else {
			
			$post = $this->input->post(null, true);
			$cleanPost = $this->security->xss_clean($post);
			$formData = array(
				'book_type' => $cleanPost['book-type'],
				'type_description' => $cleanPost['type-description'] ? $cleanPost['type-description']: 'Null'
			);
			
			// insert to database
			if($this->mdl_Book_type->insert($formData) == true) {

				$this->session->set_flashdata('success', "Success, New book type has been added to Database!");
			} else {
				$this->session->set_flashdata('danger', "Error, Can't added book type!");
			}
			redirect('library/book_types', 'refresh');
		}
	}

	/**
	 * [Edit Book category details]
	 * @param  int $id [primary key]
	 * @return [type]     [description]
	 */
	public function edit($id)
	{
		$this->form_validation->set_rules('book-type', 'Book Type', 'required|trim');

		if($this->form_validation->run() == false) {
			$data['info'] = $this->mdl_Book_type->get($id);
			$this->template->set('title', 'Edit Book Type');
			$this->template->load('template', 'contents', 'book_type/book_type_edit', $data);
		} else {
			$post = $this->input->post(null, true);
			$cleanPost = $this->security->xss_clean($post);
			$formData = array(
				'book_type' => $cleanPost['book-type'],
				'type_description' => $cleanPost['type-description'] ? $cleanPost['type-description']: 'Null'
			);
			// update to database
			if($this->mdl_Book_type->update($formData, $id) == true) {
				$this->session->set_flashdata('success', "Success, Book Type has been updated!");
			} else {
				$this->session->set_flashdata('error', "Error, Can't update the book type!");
			}
			redirect('library/book_types', 'refresh');
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
		if($this->mdl_Book_type->update($data, $id) == true) {
			$this->session->set_flashdata('success', "Success, Activated successfully!");
		} else {
			$this->session->set_flashdata('error', "Error, Can't activate!");
		}
		redirect('library/book_types', 'refresh');
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
		if($this->mdl_Book_type->update($data, $id) == true) {
			$this->session->set_flashdata('success', "Success, Deactivated successfully!");
		} else {
			$this->session->set_flashdata('error', "Error, Can't deactivate!");
		}
		redirect('library/book_types', 'refresh');
	}

	/**
	 * [Delete record from list.]
	 * @param  void
	 * @return boolean
	 */
	public function delete()
	{
		$id = $this->input->post('primary_id');
		if($this->mdl_Book_type->delete($id) == true) {
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
		if($this->mdl_Book_type->force_delete($id) == true) {
			$this->session->set_flashdata('success', 'DELETED!');
		} else {
			$this->session->set_flashdata('error', 'ERROR!');
		}
		redirect('library/book_types', 'refresh');
	}
}

/* End of file Book_types.php */
/* Location: ./application/modules/library/controllers/Book_types.php */
