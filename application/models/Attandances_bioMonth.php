<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Attandances_bio extends CI_Model {
    //$bio = "";
    function __construct() {
        parent::__construct();
        
    }

    public function get_bio_att($em_id)
    {
    	$curr_year = date('Y');
    	//$curr_month= date('n');
      $curr_month= '8';
    	$table = "deviceLogs_".$curr_month."_".$curr_year;
    	$bio = $this->load->database('otherdb', TRUE);

    	$bio->select('*');
      $bio->from($table);
      //$bio->like('LogDate',date('Y-m-d')); 
      //$bio->like('LogDate',date('Y-m'));   
      $bio->like('LogDate',date('2019-08'));     
      $bio->where('Direction','in');
      $bio->where('UserId',$em_id);
      $bio->where('UserId != 1');	
	  //$bio->like('LogDate','2019-07-31');	  
      $bio->order_by('DeviceLogId', 'ASC');/// for out time
      $bio->order_by('LogDate', 'DESC');/// for out time
     
      $query = $bio->get()->result();
      //var_dump($em_id);
      return $query;
      //die();
    } 
    
    public function get_bio_att_emp()
    {
    	$bio = $this->load->database('otherdb', TRUE);
    	$bio->select('*');
		  $bio->from('employees');
		  $bio->where('EmployeeId != 0');
		  $bio->where('EmployeeCode != 0');
		  $bio->where('RecordStatus = 1');
		  $bio->where('EmployeeCode != 1');
		  $bio->where('EmployeeName REGEXP "^-?[A-Z a-z ]+$"');
		  return $query = $bio->get()->result();
    }

    public function get_student_lists($id){        
        $this->db->select('S.*');
        $this->db->from('students AS S');
        
       
        //$this->db->join('classes AS C', 'C.id = E.class_id', 'left');
       // $this->db->join('sections AS SE', 'SE.id = E.section_id', 'left');       
        $this->db->where('S.student_p_id', $id);       
        return $this->db->get()->row();
    } 
    public function get_teacher_lists($id){

        $this->db->select('T.*, U.email, U.role_id,T.id AS t_id,(select AY.id from academic_years AS AY where T.school_id = AY.school_id AND AY.is_running = 1) AS academic_year_id');
        $this->db->from('teachers AS T');
        $this->db->join('users AS U', 'U.id = T.user_id', 'left');
        $this->db->where('T.status', 1);       
        $this->db->where('T.id', $id);   
        return $this->db->get()->row();        
    } 

  public function get_employee_lists($id){
      
      $this->db->select('E.*');
      $this->db->from('employees AS E');
      $this->db->join('roles AS R', 'R.role_p_id = E.user_role_id', 'left');    
      $this->db->where('E.is_active', '1');       
      $this->db->where('E.employee_id',$id);              
      return $this->db->get()->row();        
  }
    
   public function get_single_data($condition,$type)
   {
   		switch ($type) {
   			// case 'student':
   			// 	$table = "student_attendances";
   			// 	break;   			
   			// case 'teacher':
   			// 	$table = "teacher_attendances";
   			// 	break;
   			case 'employee':
   				$table = "employee_attendances";
   			break;
   		}
   		$this->db->select('*');
   		$this->db->from($table);
   		$this->db->where($condition);
   		return $this->db->get()->row();
   }


   public function update_attandance($attendance_record,$time,$condition,$type)
   {
   	    switch ($type) {
	   		// case 'student':
	   		// 	$table = "student_attendances";
	   		// 	break;   			
	   		// case 'teacher':
	   		// 	$table = "teacher_attendances";
	   		// 	break;
	   		case 'employee':
   				$table = "employee_attendances";
   			break;
	   	}
   		$this->db->set('attendance_data',$attendance_record);
   		$this->db->set('attendance_time',$time);
   		$this->db->where($condition);
   		//$this->db->where('student_id', $id);
   		return $this->db->update($table);
   }

   public function insert($data,$type){
	   	switch ($type) {
	   		// case 'student':
	   		// 	$table = "student_attendances";
	   		// 	break;   			
	   		// case 'teacher':
	   		// 	$table = "teacher_attendances";
	   		// 	break;
	   		case 'employee':
   				$table = "employee_attendances";
   			break;
	   	}
	   	return $this->db->insert($table,$data); 
   }

   public function get_holiday_list($currentDay){
    
      $this->db->select('event_name,start_date,end_date');
      $this->db->where('end_date>=', $currentDay);
      $query = $this->db->get('holidays');
      $result = $query->result();
      return $result;
  }
}
