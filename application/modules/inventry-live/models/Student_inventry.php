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

class Student_inventry extends Base_Model
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
    protected $_table = 'student_inventries';
    protected $_primary_key = 'id'; 

    public function get_student()
    {   

        $this->db->select("S.*");
        $this->db->from("students AS S");
        $this->db->where('is_active','1');
        $query = $this->db->get();
       
        return $query->result();
    }
     public function get_student_details()
    {   

        $this->db->select("ST.student_full_name,ST.admission_no,ST.student_unique_id");
        $this->db->from("students AS ST");
        $this->db->join("sessions", "sessions.session_p_id = ST.fk_session_id");
        $this->db->join("branches", "branches.branch_p_id = ST.fk_branch_id");
        $this->db->join("semesters", "semesters.semester_p_id = ST.fk_semester_id");
        $this->db->join("student_inventries", "student_inventries.student_id = ST.student_unique_id");
        //$this->db->where('is_active','1');
        $query = $this->db->get();
        return $query->result();
    }
   
    public function invStocks()
    {   
        
        $this->db->select("INV.*,STO.id AS sid,STO.stock_name");
        $this->db->from("inventry_stocks as INV");
        $this->db->join('stocks AS STO',"STO.id = INV.stock_id");
        $this->db->where("INV.available_quantity != '0'");
        $query = $this->db->get();
        return $query->result();
    }

    public function searchSell($from,$to)
    {   
        //die();
        $this->db->select("SI.*");
        $this->db->from("student_inventries AS SI");
        $this->db->where('sell_on_date BETWEEN "'. date('Y-m-d', strtotime($from)). '" and "'. date('Y-m-d', strtotime($to)).'"');
        $query = $this->db->get();
        return $query->result();
    }

    public function inventrySell($student_id,$from,$to)
    {   
        $this->db->select("SI.*");
        $this->db->from("student_inventries AS SI");
        $this->db->where('SI.sell_on_date >=', date('Y-m-d', strtotime($from)));
        $this->db->where('SI.sell_on_date <=', date('Y-m-d', strtotime($to)));
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
        $this->db->select("RI.*,ST.student_unique_id,ST.student_full_name,ST.admission_no");
        $this->db->from('student_inventries AS RI'); 
        $this->db->join('students AS ST', 'ST.student_unique_id = RI.student_id', 'left');
        // $this->db->join('payment_mode AS PMDS', 'PMDS.payment_mode_p_id = PMNT.payment_mode', 'left');
        $this->db->where($data);
        return $this->db->get()->row();  
    }
}

/* End of file Block.php */
/* Location: ./application/modules/setting/models/Block.php */