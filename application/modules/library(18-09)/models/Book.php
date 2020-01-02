<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
 * Ganga Memorial CMS
 *
 * @author		Vishwajeet Kumar
 * @copyright	Copyright (c) 2019
 */

/**
 * Class Book
 */

class Book extends Base_Model
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
	protected $_primary_key = 'book_p_id';

	/*
	* [get quantity stock value of book list]
	* 
	*/
	public function get_quantity_stock()
	{
		//$this->db->select('*');
		$this->db->select_sum('quantity');
		$this->db->select_sum('stock');
		$this->db->from('books');
        $this->db->where('is_active', '1');
        $this->db->where('deleted', '0');
        return $this->db->get()->row(); 
	}

	/*
	* [get book detail by accession no. of book list]
	* 
	*/
	public function searchBook($book_acc)
    {
    	$this->db->select('*');
    	$this->db->where('accession_no', $book_acc);

    	$query = $this->db->get('books');
    	$result = $query->row();
    	//print_r($result->student_p_id); exit;
    	return $result;

    }

    /*
	* [get book stock ]
	* 
	*/
	public function check_stock($id)
	{
		$this->db->select('stock');
		$this->db->where('book_p_id', $id);
		$this->db->where('stock', '0');

		$query = $this->db->get('books');
   
      	if($query->num_rows() > 0){
        	return true;
      	}else{
       		return false;
      	} 
	}

	/*
	* [update book stock ]
	* 
	*/
	public function updateStock($id)
	{

    	$this->db->select('books.stock');
    	$this->db->from('books');
    	$this->db->join('guest_book_issues', 'guest_book_issues.book_id = books.book_p_id');

    	$query = $this->db->get();
		return $query->row();
	}


	public function get_bio_att($em_id)
    {	
    	$sub_str = substr($em_id, 0, 1);
    	$curr_year = date('Y');
    	$curr_month= date('n');
    	$table = "deviceLogs_".$curr_month."_".$curr_year;
    	$bio = $this->load->database('otherdb', TRUE);
    	$bio->select('*');
	    $bio->from($table);
	    $bio->like('DownloadDate',date('Y-m-d'));
	    $bio->like('UserId',$sub_str);
	    $bio->where('Direction','in');
	    $bio->where('UserId',$em_id);
	    $bio->where('UserId != 1');
	    $bio->order_by('DeviceLogId', 'DESC');/// for out time
	    return $query = $bio->get()->row();
    }

    public function get_book_info($id)
    {
    	$this->db->select('*');
    	$this->db->from('books');
    	$this->db->where('accession_no',$id);
    	$query = $this->db->get();
		return $query->row();
    }
}

/* End of file Book.php */
/* Location: ./application/modules/library/models/Book.php */
