<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
 * Ganga Memorial CMS
 *
 * @author      Amit Kumar
 * @copyright   Copyright (c) 2019
 */

/**
 * Class Block
 */

class Sale extends Base_Model
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
    protected $_table = 'sales';
    protected $_primary_key = 'id'; 

     public function inventoryList()
    {   
        
        $this->db->select("INV.*,I.item_name");
        $this->db->from("inventories as INV");
        $this->db->join('items AS I',"I.id = INV.item_id");
        $this->db->where("INV.available_quantity != '0'");
        $query = $this->db->get();
        return $query->result();
    }

     public function saleList($id = null)
    {   
        $this->db->select("SI.*,S.student_full_name,S.admission_no,PMD.payment_mode_name");
        $this->db->from("sales as SI");
        $this->db->join('students AS S',"S.student_unique_id = SI.student_id");
        $this->db->join('payment_mode AS PMD', 'PMD.payment_mode_p_id = SI.pay_mode', 'left');
        if($id != null){
        $this->db->where('SI.id= "'.$id.'"');
        }
        $query = $this->db->get();
        return $query->result();
    }
    
    public function searchSale($from,$to)
    {   
        //die();
        $this->db->select("SI.*,S.student_full_name,S.admission_no,PMD.payment_mode_name");
        $this->db->from("sales AS SI");
        $this->db->join('students AS S',"S.student_unique_id = SI.student_id", 'left');
        $this->db->join('payment_mode AS PMD', 'PMD.payment_mode_p_id = SI.pay_mode', 'left');
        $this->db->where('sale_on_date BETWEEN "'. date('Y-m-d', strtotime($from)). '" and "'. date('Y-m-d', strtotime($to)).'"');
        $query = $this->db->get();
        return $query->result();
    }

    public function inventrysale($student_id,$from,$to)
    {   
        $this->db->select("SI.*,S.student_full_name,S.admission_no,PMD.payment_mode_name");
        $this->db->from("sales AS SI");
        $this->db->join('students AS S',"S.student_unique_id = SI.student_id", 'left');
        $this->db->join('payment_mode AS PMD', 'PMD.payment_mode_p_id = SI.pay_mode', 'left');
        $this->db->where('SI.sale_on_date >=', date('Y-m-d', strtotime($from)));
        $this->db->where('SI.sale_on_date <=', date('Y-m-d', strtotime($to)));
        if($student_id!="All"){
         $this->db->where('SI.student_id = "'.$student_id.'"' );   
        }
        return $query = $this->db->get()->result();
    }

    public function receipt_invoice_student($id)
    {
        $data = array(
                'RI.id'=> $id,
        );
        $this->db->select("RI.*,ST.student_unique_id,ST.student_full_name,ST.admission_no,PMDS.payment_mode_name");
        $this->db->from('sales AS RI'); 
        $this->db->join('students AS ST', 'ST.student_unique_id = RI.student_id', 'left');
        $this->db->join('payment_mode AS PMDS', 'PMDS.payment_mode_p_id = RI.pay_mode', 'left');
        $this->db->where($data);
        return $this->db->get()->row();  
    }
}

/* End of file Block.php */
/* Location: ./application/modules/setting/models/Block.php */