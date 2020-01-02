<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
 * Ganga Memorial CMS
 *
 * @author		Vishwajeet Kumar
 * @copyright	Copyright (c) 2019
 */

/**
 * Class Book Issue
 */

class Book_issue extends Base_Model
{
	function __construct()
	{
		// call the model constructor
		parent::__construct();
	}
	/**
	 * [$primary_key PRIMARY KEY]
	 * @var string
	 */
	protected $_primary_key = 'book_issue_p_id';

	/**
	 * [Get the history of issued book]
	 * @param  int $id [primary key]
	 * @return mixed
	 */
	

	public function get_issued_book()
	{
		$this->db->select('book_issues.*,books.book_name,students.student_full_name,student_unique_id,admission_no');
		$this->db->from("book_issues");	
		$this->db->join("books", "books.book_p_id = book_issues.acc_no");
		$this->db->join("students", "students.student_p_id = book_issues.student_id");
		//$this->db->join("book_categories", "book_categories.book_category_p_id = book_issues.b_category_id");
		
		$query = $this->db->get();
		//var_dump($query); die();
		return $query->result();
		
	}

	public function active_issued_book($id)
	{
		$this->db->select('book_issues.*,books.book_name,books.book_p_id');
		$this->db->from("book_issues");	
		$this->db->join("books", "books.accession_no = book_issues.acc_no");
		$this->db->where('book_issues.is_active !=', "0");
		$this->db->where('book_issues.student_id',$id);
		
		$query = $this->db->get();

		//var_dump($query); die();
		return $query->result();
	} 

	public function student_active_book($id)
	{
		$this->db->select('book_issues.*,books.book_name');
		$this->db->from("book_issues");	
		$this->db->join("books", "books.accession_no = book_issues.acc_no");
		$this->db->where('book_issues.is_active !=', "0");
		$this->db->where('book_issues.book_issue_p_id',$id);
		//$this->db->where('book_issues.student_id',$id);
		$query = $this->db->get();

		//var_dump($query); die();
		return $query->row();
	} 

	/**
	 * [Issued Book Date Setting]
	 * @param  int $id [primary key]
	 * @return mixed
	 */
	public function issued_book_setting()
	{
		$this->db->select('book_issues.issue_date,return_date,book_issue_p_id,books.book_name,students.student_full_name,student_unique_id,student_p_id,admission_no');
		$this->db->where('book_issues.is_active', '1');
		$this->db->from("book_issues");
		$this->db->join("books", "books.accession_no = book_issues.acc_no");
		$this->db->join("students", "students.student_p_id = book_issues.student_id");
		
		$query = $this->db->get();
		//var_dump($query); die();
		return $query->result();
		
	}

	/**
	 * [Get mannual issued book by student]
	 * @param  int $id [primary key]
	 * @return mixed
	 */
	public function get_mannual_book_history($id)
	{
		$this->db->select('book_issues.*,students.student_full_name,student_unique_id,admission_no');
		$this->db->from("book_issues");	
		$this->db->join("books", "books.book_p_id = book_issues.book_id");
		$this->db->join("students", "students.student_p_id = book_issues.student_id");
		
		$this->db->where('student_p_id',$id);
		$this->db->where('book_issues.issue_mode','mannual');
		$query = $this->db->get();
		//var_dump($query); die();
		return $query->result();
		
	}

	/**
	 * [Get issued book by student]
	 * @param  int $id [primary key]
	 * @return mixed
	 */
	public function get_issued_book_list($id)
	{
		$this->db->select('book_issues.*,books.call_no,books.book_name');
		$this->db->from("book_issues");	
		$this->db->join("books", "books.accession_no = book_issues.acc_no");
		//$this->db->join("students", "students.student_p_id = book_issues.student_id");
		$this->db->where('student_id',$id);
		//$this->db->where('book_issues.issue_mode','biometric');
		$query = $this->db->get();
		//var_dump($query); die();
		return $query->result();
		
	}

	/**
	 * [Get issued book by guest]
	 * @param  int $id [primary key]
	 * @return mixed
	 */
	public function guest_issued_book()
	{
		$this->db->select('guest_book_issues.*, books.book_name,accession_no,call_no');
		$this->db->from("guest_book_issues");	
		$this->db->join("books", "books.book_p_id = guest_book_issues.book_id");
		
		$this->db->where('accession_no',$id);
		$query = $this->db->get();
		//var_dump($query); die();
		return $query->result();
		
	}

	/**
	 * [Check book status return or not]
	 * @param  int $id [primary key]
	 * @return mixed
	 */
	public function check_status($book_id, $id)
	{

		$this->db->select('*');
    	//$this->db->from('admin');
    	$this->db->where('acc_no',$book_id);
    	$this->db->where('student_id',$id);
    	$this->db->where('is_active','1');
    	$query=$this->db->get('book_issues');
   
      	if($query->num_rows()>0){
        	return true;
      	}else{
       		return false;
      	}
	}

	/**
	 * [Check book limit return or not]
	 * @param  int $id [primary key]
	 * @return mixed
	 */
	public function checkBookLimit($id)
	{

		$this->db->select('*');
    	//$this->db->from('admin');
    	$this->db->where('student_id',$id);
    	$this->db->where('is_active','1');
    	$query = $this->db->get('book_issues');
    	//sprint_r($query); exit;
   
      	if ($query->num_rows() == 2) {
        	return true;
      	}else{
       		return false;
      	}
	}

	/**
	 * [Get return the book by studnt]
	 * @param  int $id [primary key]
	 * @return mixed
	 */
	public function bookReturn($id)
	{
		
		$this->db->select('BKS.*, ST.student_p_id,ST.student_full_name,ST.student_unique_id,ST.student_photo,ST.student_sign,ST.admission_no,BK.stock,BK.quantity,BK.book_name,FT.fee_type_amount');
		$this->db->from('book_issues AS BKS');
		$this->db->join('books AS BK', 'BK.book_p_id = BKS.acc_no');
		$this->db->join('students AS ST', 'ST.student_p_id = BKS.student_id');
		$this->db->join('fee_types AS FT', 'FT.fee_type_p_id = BKS.fine_type_id');
		
		$this->db->where('BKS.book_issue_p_id',$id);
		$query = $this->db->get();
		return $query->row();
		
	}

	/**
	 * [Check book status for return or not]
	 * @param  int $id [primary key]
	 * @return mixed
	 */
	public function returnBook($returnBook, $id)
	{

    	$this->db->where('guest_p_id', $id);
        $this->db->update('guest_book_issues',$returnBook);
        return true;
	}


	public function total_issue_book()
	{
		$this->db->select('*');
		$this->db->from('book_issues');
        $this->db->where('is_active', '1');
        return $this->db->get()->num_rows(); 
	}
	
}

/* End of file Book_issue.php */
/* Location: ./application/modules/library/models/Book_issue.php */
