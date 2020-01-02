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

class Inventory extends Base_Model
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
	protected $_table = 'inventories';
	protected $_primary_key = 'id';
	 public function inventory($id= null)
    {   
        $this->db->select("IS.*,I.item_name,I.id AS itemId,PMD.payment_mode_name");
        $this->db->from("inventories AS IS");
        $this->db->order_by('IS.id','DESC');
        $this->db->join("items AS I", 'IS.item_id = I.id');
        $this->db->join('payment_mode AS PMD', 'PMD.payment_mode_p_id = IS.pay_mode', 'left');
        if($id!= null){
         $this->db->where('IS.id = "'.$id.'"' );   
        }
        $query = $this->db->get();
        return $query->result();
    }

    public function searchInventory($from,$to)
    {   
        $this->db->select("IS.*,I.item_name,I.id AS itemId,PMD.payment_mode_name");
        $this->db->from("inventories AS IS");
        $this->db->order_by('IS.id','DESC');
        $this->db->join("items AS I", 'IS.item_id = I.id');
        $this->db->join('payment_mode AS PMD', 'PMD.payment_mode_p_id = IS.pay_mode', 'left');
        $this->db->where('IS.item_on_date >=', date('Y-m-d', strtotime($from)));
        $this->db->where('IS.item_on_date <=', date('Y-m-d', strtotime($to)));
        $query = $this->db->get();
        return $query->result();
    }

    public function inventoryReport($id)
    {
        $this->db->select('SI.*,S.student_full_name,S.admission_no,PMD.payment_mode_name');
        $this->db->from("sales AS SI");
        $this->db->join('payment_mode AS PMD', 'PMD.payment_mode_p_id = SI.pay_mode', 'left');
        $this->db->join('students AS S','S.student_unique_id = SI.student_id');
        $this->db->like('SI.sale_info', '"inventory_id":"'.$id.'"');
        $query = $this->db->get();
        return $query->result();

    }

    public function inentry_statement($item_id,$from,$to)
    {   
        $this->db->select("IS.*,I.item_name,I.id AS itemId,PMD.payment_mode_name");
        $this->db->from("inventories AS IS");
        //$this->db->order_by('IS.id','DESC');
        $this->db->join("items AS I", 'IS.item_id = I.id');
        $this->db->join('payment_mode AS PMD', 'PMD.payment_mode_p_id = IS.pay_mode', 'left');
        $this->db->where('IS.item_on_date >=', date('Y-m-d', strtotime($from)));
        $this->db->where('IS.item_on_date <=', date('Y-m-d', strtotime($to)));
        if($item_id!="All"){
         $this->db->where('IS.item_id = "'.$item_id.'"' );   
        }
        $query = $this->db->get();
        return $query->result();

    }
    
}

/* End of file Block.php */
/* Location: ./application/modules/setting/models/Block.php */