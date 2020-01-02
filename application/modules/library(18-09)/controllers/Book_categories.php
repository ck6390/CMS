<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
 * Ganga Memorial CMS
 *
 * @author		Amit Kumar
 * @copyright	Copyright (c) 2019
 */

/**
 * Class Book_categories
 */

class Book_categories extends Base_Controller
{
	/**
	 * Book_categories Controller constructor.
	 */
	public function __construct()
	{
		// controller constructor
		parent::__construct();
		$this->load->model('book_category', 'mdl_book_category');
		$this->load->module('setting/semesters');
	}

	/**
	 * Fetch all Book_categories list.
	 * @return void [load view page]
	 */
	public function index()
	{
		$data['lists'] = $this->mdl_book_category->get_all();
		$this->template->set('title', 'Book Category List');
		$this->template->load('template', 'contents', 'book_category/book_category_list', $data);
	}

	/**
	 * Insert new record.
	 * @return void [load view page]
	 */
	public function add()
	{
		$this->form_validation->set_rules('category-name', 'Category name', 'required|trim');

		if($this->form_validation->run() == false) {
			// $data['info'] = $this->mdl_book_category->get();
			$this->template->set('title', 'Add Book Category');
			$this->template->load('template', 'contents', 'book_category/book_category_add');

		} else {
			
			$post = $this->input->post(null, true);
			$cleanPost = $this->security->xss_clean($post);
			$formData = array(
				'category_name' => $cleanPost['category-name'],
				'description' => $cleanPost['category-description'] ? $cleanPost['category-description']:'Null'
			);
			
			// insert to database
			if($this->mdl_book_category->insert($formData) == true) {

				$this->session->set_flashdata('success', "Success, New book category has been alocated to Database!");
			} else {
				$this->session->set_flashdata('danger', "Error, Can't added book category!");
			}
			redirect('library/book_categories', 'refresh');
		}
	}

	/**
	 * [Edit Book category details]
	 * @param  int $id [primary key]
	 * @return [type]     [description]
	 */
	public function edit($id)
	{
		$this->form_validation->set_rules('category-name', 'Category Name', 'required|trim');

		if($this->form_validation->run() == false) {
			$data['info'] = $this->mdl_book_category->get($id);
			$this->template->set('title', 'Edit Book category');
			$this->template->load('template', 'contents', 'book_category/book_category_edit', $data);
		} else {
			$post = $this->input->post(null, true);
			$cleanPost = $this->security->xss_clean($post);
			$formData = array(
				'category_name' => $cleanPost['category-name'],
				'description' => $cleanPost['category-description'] ? $cleanPost['category-description']:'Null'
			);
			// update to database
			if($this->mdl_book_category->update($formData, $id) == true) {
				$this->session->set_flashdata('success', "Success, Book Category has been updated!");
			} else {
				$this->session->set_flashdata('error', "Error, Can't update the book category!");
			}
			redirect('library/book_categories', 'refresh');
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
		if($this->mdl_book_category->update($data, $id) == true) {
			$this->session->set_flashdata('success', "Success, Activated successfully!");
		} else {
			$this->session->set_flashdata('error', "Error, Can't activate!");
		}
		redirect('library/book_categories', 'refresh');
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
		if($this->mdl_book_category->update($data, $id) == true) {
			$this->session->set_flashdata('success', "Success, Deactivated successfully!");
		} else {
			$this->session->set_flashdata('error', "Error, Can't deactivate!");
		}
		redirect('library/book_categories', 'refresh');
	}

	/**
	 * [Delete record from list.]
	 * @param  void
	 * @return boolean
	 */
	public function delete()
	{
		$id = $this->input->post('primary_id');
		if($this->mdl_book_category->delete($id) == true) {
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
		if($this->mdl_book_category->force_delete($id) == true) {
			$this->session->set_flashdata('success', 'DELETED!');
		} else {
			$this->session->set_flashdata('error', 'ERROR!');
		}
		redirect('library/book_categories', 'refresh');
	}
}

/* End of file Book_categories.php */
/* Location: ./application/modules/library/controllers/Book_categories.php */
