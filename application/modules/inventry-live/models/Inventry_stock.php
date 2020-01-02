<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
 * Ganga Memorial CMS
 *
 * @author		Amit Kumar
 * @copyright	Copyright (c) 2019
 */

/**
 * Class Block
 */

class Inventry_stock extends Base_Model
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
	protected $_table = 'inventry_stocks';
	protected $_primary_key = 'id';
	 public function inventory()
    {   
        //die();
        $this->db->select("IS.*,S.stock_name,S.id AS sid");
        $this->db->from("inventry_stocks AS IS");
        $this->db->join("stocks AS S", 'IS.stock_id = S.id');
        $query = $this->db->get();
        return $query->result();
    }

    public function sellInfo()
    {
    	$this->db->select('*');
    	$this->db->from('student_inventries');
    	$query = $this->db->get();
		return $query->result();
    }
	public function inventorySellReport($id)
	{
		$this->db->select('SI.*,S.student_full_name');
		$this->db->join('students AS S','S.student_unique_id = SI.student_id');
		$this->db->like('SI.sell_info', '"inventry_id":"'.$id.'"');
		//$this -> db -> where_in( parent_id, decoded($parent_id) ); #Try this
		//$this->db->where(json_decode('SI.sell_info'), $id);
		$this->db->from("student_inventries AS SI");
    	$query = $this->db->get();
		return $query->result();

	}

	public function searchInventory($from,$to)
    {   
        //die();
        $this->db->select("IS.*,S.stock_name");
        $this->db->from("inventry_stocks AS IS");
        $this->db->join("stocks AS S", 'IS.stock_id = S.id');
        $this->db->where('IS.stock_on_date >=', date('Y-m-d', strtotime($from)));
		$this->db->where('IS.stock_on_date <=', date('Y-m-d', strtotime($to)));
        $query = $this->db->get();
        return $query->result();
    }

    public function inventryStock($stock_id,$from,$to)
    {   
        $this->db->select("IS.*,S.stock_name,S.id AS sid");
        $this->db->from("inventry_stocks AS IS");
        $this->db->join("stocks AS S", 'IS.stock_id = S.id','left');
        $this->db->where('IS.stock_on_date >=', date('Y-m-d', strtotime($from)));
        $this->db->where('IS.stock_on_date <=', date('Y-m-d', strtotime($to)));
        if($stock_id!="All"){
         $this->db->where('IS.stock_id = "'.$stock_id.'"' );   
        }
        return $query = $this->db->get()->result();
    }
    
}

/* End of file Block.php */
/* Location: ./application/modules/setting/models/Block.php */