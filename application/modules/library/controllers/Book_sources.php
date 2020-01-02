<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
 * Ganga Memorial CMS
 *
 * @author		Vishwajeet Kumar
 * @copyright	Copyright (c) 2019
 */

/**
 * Class Book_sources
 */

class Book_sources extends Base_Controller
{
	/**
	 * Book_sources Controller constructor.
	 */
	public function __construct()
	{
		// controller constructor
		parent::__construct();
		$this->load->model('Book_source', 'mdl_book_source');
		$this->load->module('setting/semesters');
	}

	/**
	 * Fetch all Book_sources list.
	 * @return void [load view page]
	 */
	public function index()
	{
		$data['lists'] = $this->mdl_book_source->get_all();
		$this->template->set('title', 'Book Source List');
		$this->template->load('template', 'contents', 'book_source/book_source_list', $data);
	}

	/**
	 * Insert new record.
	 * @return void [load view page]
	 */
	public function add()
	{
		$this->form_validation->set_rules('book-source', 'Book Source', 'required|trim');

		if($this->form_validation->run() == false) {
			// $data['info'] = $this->mdl_book_category->get();
			$this->template->set('title', 'Add Book Source');
			$this->template->load('template', 'contents', 'book_source/book_source_add');

		} else {
			
			$post = $this->input->post(null, true);
			$cleanPost = $this->security->xss_clean($post);
			$formData = array(
				'source_name' => $cleanPost['book-source'],
				'source_description' => $cleanPost['source-description'] ? $cleanPost['source-description']:'Null'
			);
			
			// insert to database
			if($this->mdl_book_source->insert($formData) == true) {

				$this->session->set_flashdata('success', "Success, New book source has been added to Database!");
			} else {
				$this->session->set_flashdata('danger', "Error, Can't added book source!");
			}
			redirect('library/book_sources', 'refresh');
		}
	}

	/**
	 * [Edit Book category details]
	 * @param  int $id [primary key]
	 * @return [type]     [description]
	 */
	public function edit($id)
	{
		$this->form_validation->set_rules('book-source', 'Book Source', 'required|trim');

		if($this->form_validation->run() == false) {
			$data['info'] = $this->mdl_book_source->get($id);
			$this->template->set('title', 'Edit Book Source');
			$this->template->load('template', 'contents', 'book_source/book_source_edit', $data);
		} else {
			$post = $this->input->post(null, true);
			$cleanPost = $this->security->xss_clean($post);
			$formData = array(
				'source_name' => $cleanPost['book-source'],
				'source_description' => $cleanPost['source-description'] ? $cleanPost['source-description']:'Null'
			);
			// update to database
			if($this->mdl_book_source->update($formData, $id) == true) {
				$this->session->set_flashdata('success', "Success, Book source has been updated!");
			} else {
				$this->session->set_flashdata('error', "Error, Can't update the book source!");
			}
			redirect('library/book_sources', 'refresh');
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
		if($this->mdl_book_source->update($data, $id) == true) {
			$this->session->set_flashdata('success', "Success, Activated successfully!");
		} else {
			$this->session->set_flashdata('error', "Error, Can't activate!");
		}
		redirect('library/book_sources', 'refresh');
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
		if($this->mdl_book_source->update($data, $id) == true) {
			$this->session->set_flashdata('success', "Success, Deactivated successfully!");
		} else {
			$this->session->set_flashdata('error', "Error, Can't deactivate!");
		}
		redirect('library/book_sources', 'refresh');
	}

	/**
	 * [Delete record from list.]
	 * @param  void
	 * @return boolean
	 */
	public function delete()
	{
		$id = $this->input->post('primary_id');
		if($this->mdl_book_source->delete($id) == true) {
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
		if($this->mdl_book_source->force_delete($id) == true) {
			$this->session->set_flashdata('success', 'DELETED!');
		} else {
			$this->session->set_flashdata('error', 'ERROR!');
		}
		redirect('library/book_sources', 'refresh');
	}
}

/* End of file Book_sources.php */
/* Location: ./application/modules/library/controllers/Book_sources.php */
