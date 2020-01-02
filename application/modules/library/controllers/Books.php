<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
 * Ganga Memorial CMS
 *
 * @author		Amit Kumar
 * @copyright	Copyright (c) 2019
 */

/**
 * Class Books
 */

class Books extends Base_Controller
{
	/**
	 * Books Controller constructor.
	 */
	public function __construct()
	{
		// controller constructor
		parent::__construct();
		$this->load->model('book', 'mdl_book');
		$this->load->model('Book_type', 'mdl_Book_type');
		$this->load->model('Book_source', 'mdl_book_source');
		$this->load->module('library/book_categories');
	}

	/**
	 * Fetch all Books list.
	 * @return void [load view page]
	 */
	public function index()
	{
		$data['lists'] = $this->mdl_book->get_all();
		$this->template->set('title', 'Book List');
		$this->template->load('template', 'contents', 'book/book_list', $data);
	}

	/**
	 * Insert new record.
	 * @return void [load view page]
	 */
	public function add()
	{
		$this->form_validation->set_rules('accession-no', 'Accession Number', 'required|trim|is_unique[books.accession_no]');
		$this->form_validation->set_rules('call-no', 'Call Number', 'required|trim');
		$this->form_validation->set_rules('book-type', 'Book Type', 'trim');
		$this->form_validation->set_rules('book-source', 'Book Source', 'trim');
		$this->form_validation->set_rules('book-name', 'Book name', 'required|trim');
		$this->form_validation->set_rules('quantity', 'Book Quantity', 'required|trim|regex_match[/^[0-9]+$/]');
		$this->form_validation->set_rules('book-category', 'Book Category', 'trim');
		$this->form_validation->set_rules('author-name', 'Author Name', 'required|trim');
		$this->form_validation->set_rules('price', 'Price', 'required|trim');
		$this->form_validation->set_rules('isbn-no', 'ISBN Number', 'required|trim');

		$this->form_validation->set_rules('edition', 'edition', 'required|trim');
		$this->form_validation->set_rules('bill-no', 'bill no', 'required|trim');
		$this->form_validation->set_rules('publisher', 'publisher', 'required|trim');
		$this->form_validation->set_rules('stream', 'stream', 'required|trim');
		$this->form_validation->set_rules('language', 'language', 'required|trim');
		$this->form_validation->set_rules('total-page', 'total page', 'required|trim');
		$this->form_validation->set_rules('place', 'place', 'required|trim');
		$this->form_validation->set_rules('publication', 'publication', 'required|trim');

		if($this->form_validation->run() == false) {
			
			$this->template->set('title', 'Add Book');
			$this->template->load('template', 'contents', 'book/book_add');

		} else {
			
			$post = $this->input->post(null, true);
			$cleanPost = $this->security->xss_clean($post);
			$formData = array(
				'accession_no' => $cleanPost['accession-no'],
				'call_no' => $cleanPost['call-no'],
				'book_category_id' => $cleanPost['book-category'],
				'book_type_id' => $cleanPost['book-type'],
				'book_source_id' => $cleanPost['book-source'],
				'book_name' => $cleanPost['book-name'],
				'author_name' => $cleanPost['author-name'],
				'quantity' => $cleanPost['quantity'] ? $cleanPost['quantity']: 'Null',
				'stock' => $cleanPost['quantity'],
				'place' => $cleanPost['place'],
				'month' => $cleanPost['month'] ? $cleanPost['month']: 'Null',
				'publication' => $cleanPost['publication'],
				'publisher' => $cleanPost['publisher'],
				'volume' => $cleanPost['volume'] ? $cleanPost['volume']: 'Null',
				'edition' => $cleanPost['edition'],
				'total_page' => $cleanPost['total-page'],
				'price' => $cleanPost['price'],
				'isbn_no' => $cleanPost['isbn-no'],
				'csir_no' => $cleanPost['csir-no'] ? $cleanPost['csir-no']: 'Null',
				'language' => $cleanPost['language'],
				'course' => $cleanPost['course'] ? $cleanPost['course']: 'Null',
				'stream' => $cleanPost['stream'],
				'bill_no' => $cleanPost['bill-no'],
				'remarks' => $cleanPost['remarks'] ? $cleanPost['remarks']:'Null',
				'description' => $cleanPost['book-description'] ? $cleanPost['book-description']:'Null'
			);
			
			// insert to database
			if($this->mdl_book->insert($formData) == true) {

				$this->session->set_flashdata('success', "Success, New book has been added to Database!");
			} else {
				$this->session->set_flashdata('danger', "Error, Can't added book!");
			}
			redirect('library/books', 'refresh');
		}
	}

	/**
	 * [Edit Books details]
	 * @param  int $id [primary key]
	 * @return [type]     [description]
	 */
	public function edit($id)
	{
		$this->form_validation->set_rules('accession-no', 'Accession Number', 'required|trim');
		$this->form_validation->set_rules('call-no', 'Call Number', 'required|trim');
		$this->form_validation->set_rules('book-type', 'Book Type', 'trim');
		$this->form_validation->set_rules('book-source', 'Book Source', 'trim');
		$this->form_validation->set_rules('book-name', 'Book name', 'required|trim');
		$this->form_validation->set_rules('book-category', 'Book Category', 'trim');
		$this->form_validation->set_rules('author-name', 'Author Name', 'required|trim');
		$this->form_validation->set_rules('price', 'Price', 'required|trim');
		$this->form_validation->set_rules('isbn-no', 'ISBN Number', 'required|trim');

		if($this->form_validation->run() == false) {
			$data['info'] = $this->mdl_book->get($id);
			$this->template->set('title', 'Edit Book Details');
			$this->template->load('template', 'contents', 'book/book_edit', $data);
		} else {
			
			//internally operation to update book stock
			$pre_quantity = $this->input->post('prev-quantity');
			$pre_stock = $this->input->post('prev-stock');
			$quantity = $this->input->post('quantity');
			if ($quantity > $pre_quantity) {

				$diff = $quantity - $pre_quantity;
				$stock = $diff + $pre_stock;
			}else{
				
				$diff = $pre_quantity - $quantity;
				$stock = $pre_stock - $diff;
			}

			$post = $this->input->post(null, true);
			$cleanPost = $this->security->xss_clean($post);
			$formData = array(
				'accession_no' => $cleanPost['accession-no'],
				'call_no' => $cleanPost['call-no'],
				'book_category_id' => $cleanPost['book-category'] ? $cleanPost['book-category'] : 'null',
				'book_type_id' => $cleanPost['book-type'] ? $cleanPost['book-type'] :'null',
				'book_source_id' => $cleanPost['book-source'] ? $cleanPost['book-source'] : 'null',
				'book_name' => $cleanPost['book-name'],
				'author_name' => $cleanPost['author-name'],
				'quantity' => $cleanPost['quantity'] ? $cleanPost['quantity']: 'Null',
				'stock' => $stock,
				'place' => $cleanPost['place'] ? $cleanPost['place']: 'Null',
				'month' => $cleanPost['month'] ? $cleanPost['month']: 'Null',
				'publication' => $cleanPost['publication'] ? $cleanPost['publication']: 'Null',
				'publisher' => $cleanPost['publisher'] ? $cleanPost['publisher']: 'Null',
				'volume' => $cleanPost['volume'] ? $cleanPost['volume']: 'Null',
				'edition' => $cleanPost['edition'] ? $cleanPost['edition']: 'Null',
				'total_page' => $cleanPost['total-page'] ? $cleanPost['total-page']:'Null',
				'price' => $cleanPost['price'],
				'isbn_no' => $cleanPost['isbn-no'],
				'csir_no' => $cleanPost['csir-no'] ? $cleanPost['csir-no']: 'Null',
				'language' => $cleanPost['language'] ? $cleanPost['language']: 'Null',
				'course' => $cleanPost['course'] ? $cleanPost['course']: 'Null',
				'stream' => $cleanPost['stream'] ? $cleanPost['stream']: 'Null',
				'bill_no' => $cleanPost['bill-no'] ? $cleanPost['bill-no']: 'Null',
				'remarks' => $cleanPost['remarks'] ? $cleanPost['remarks']:'Null',
				'description' => $cleanPost['book-description'] ? $cleanPost['book-description']:'Null'
			);
			// update to database
			if($this->mdl_book->update($formData, $id) == true) {
				$this->session->set_flashdata('success', "Success, Book has been updated!");
			} else {
				$this->session->set_flashdata('error', "Error, Can't update the book!");
			}
			redirect('library/books', 'refresh');
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
		if($this->mdl_book->update($data, $id) == true) {
			$this->session->set_flashdata('success', "Success, Activated successfully!");
		} else {
			$this->session->set_flashdata('error', "Error, Can't activate!");
		}
		redirect('library/books', 'refresh');
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
		if($this->mdl_book->update($data, $id) == true) {
			$this->session->set_flashdata('success', "Success, Deactivated successfully!");
		} else {
			$this->session->set_flashdata('error', "Error, Can't deactivate!");
		}
		redirect('library/books', 'refresh');
	}

	/**
	 * [Delete record from list.]
	 * @param  void
	 * @return boolean
	 */
	public function delete()
	{
		$id = $this->input->post('primary_id');
		if($this->mdl_book->delete($id) == true) {
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
		if($this->mdl_book->force_delete($id) == true) {
			$this->session->set_flashdata('success', 'DELETED!');
		} else {
			$this->session->set_flashdata('error', 'ERROR!');
		}
		redirect('library/books', 'refresh');
	}

	/**
	 * [Get book list by Book Category.]
	 * @param  int $id [primary key]
	 * @return mixed
	 */
	public function get_book_list_by_group($id)
	{
		$query = $this->db->select('book_p_id, book_name,')->from('books')->where(array(
                'book_category_id' => $id,
                'is_active' =>'1'
            ))->get();
		$result = $query->num_rows() > 0 ? $query->result() : false;
		echo json_encode($result);
	}

	/**
	 * [Get book title, stock, call no. list by Book.]
	 * @param  int $id [primary key]
	 * @return mixed
	 */
	public function get_book_detail($id)
	{
		$query = $this->db->select('book_p_id, book_name, call_no, author_name, course, stream, stock')->from('books')->where(array(
                'accession_no' => $id,
                'is_active' =>'1'
            ))->get();
		$result = $query->num_rows() > 0 ? $query->row() : false;
		echo json_encode($result);
	}

	public function get_book_stock($bookId){

		$bookId = $_POST['bookID'];
		//$data=$this->mdl_room->get_all_available_room($buildingId,$blockId,$floorId);
		$query = $this->db->select('book_p_id')->from('books')->where(array(
				'book_p_id' => $bookId,
                'is_active' =>'1'
            ))->get();
		$result = $query->num_rows() > 0 ? $query->result() : false;

		if($result!=null){

			foreach($result as $bookList)
			{
				if($bookList->book_p_id==$bookId){
					$query_book = $this->db->select('book_p_id, book_name,,quantity,stock')->from('books')->where(array(
                'book_p_id' => $bookId,
                'is_active' =>'1'
            ))->get();

			$result_book = $query_book->num_rows() > 0 ? $query_book->result() : false;
			echo json_encode($result_book);
				}
			}
		}
	}

	public function verify_library_student()
	{
		$studentId = $_POST['student_id'];
		$result = $this->mdl_book->get_student_record_bio($studentId);
		if($studentId == "1140000") //@$result->UserId)
      	{
      		echo $studentId;
      	}
	}
}

/* End of file Books.php */
/* Location: ./application/modules/library/controllers/Books.php */
