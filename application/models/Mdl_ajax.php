<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Mdl_ajax extends CI_Model {

    function __construct() {
        parent::__construct();
        
    }

    public function get_all_unit()
    {
    	$this->db->select('subject_unit_p_id');
        $this->db->from('subject_units');           
        return $this->db->get()->result();
    }

    public function unit_onSubject($subject_id)
    {	
    	$data = array(
    		'fk_subject_id' => $subject_id
    	);
    	$this->db->select('unit_id');
        $this->db->from('emp_subject_units');
        $this->db->where($data);
        return $this->db->get()->result();
    }

    public function subject_subAtt_record($data,$studentsId)
    {
        $this->db->select('*');
        $this->db->from('lectures');
        $this->db->where($data);
        $this->db->like('student_attandance', $studentsId);
        return $this->db->get()->result();   
    }

    public function subject_lists($data)
    {
        $this->db->select('subject_p_id,subject_code,subject_name');
        $this->db->from('subjects');
        $this->db->where($data);
        return $this->db->get()->result(); 
    }

    public function lecture_units($data)
    {
        $this->db->select('ESU.unit_id,SU.unit_number')
                ->from('emp_subject_units AS ESU')
                ->join('subject_units AS SU', 'SU.subject_unit_p_id = ESU.unit_id')
                ->where($data)
                ->where('ESU.status','1')
                ->order_by('unit_id','ASC');
        return $this->db->get()->result(); 
    }

    public function lecture_unit_details($data)
    {
        $this->db->select('ESU.unit_id,ESU.lecture_required,ESU.emp_subject_unit_p_id,ESU.extra_lecture,ESU.startDt')
                ->from('emp_subject_units AS ESU')
                ->where($data);
        return $this->db->get()->row();
    }
}