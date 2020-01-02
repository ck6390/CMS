<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/* * *****************Welcome.php**********************************
 * @product name    : Global School Management System Pro
 * @type            : Class
 * @class name      : Welcome
 * @description     : This is default class of the application.  
 * @author          : Codetroopers Team   
 * @url             : https://themeforest.net/user/codetroopers      
 * @support         : yousuf361@gmail.com 
 * @copyright       : Codetroopers Team   
 * ********************************************************** */
class Attandance_bioMonth extends CI_Controller {
    /*     * **************Function index**********************************
     * @type            : Function
     * @function name   : index
     * @description     : this function load login view page            
     * @param           : null; 
     * @return          : null 
     * ********************************************************** */
    function __construct()
    {
        parent::__construct();
        
        $this->load->model('Attandances_bio','m_bio_att');  

    }

    public function index() {        
        
        $employee = $this->m_bio_att->get_bio_att_emp();//bio data
        // var_dump($employee);
        // die();
        $curr_year = date('Y');
        $curr_month = '08';
        //$curr_month = date('m');
        $curr_day = date('d');        
        foreach ($employee as $emp) {
           //$id_bio = '';
           $sub_str = substr($emp->EmployeeCode, 0, 1);
           $id = substr($emp->EmployeeCode, 1);
           $em_id = $emp->EmployeeCode;
           //var_dump($sub_str);
          //die();
            if($sub_str == '3'){
               	$type = 'employee';
               	$result_att = $this->m_bio_att->get_employee_lists($id); 
                  $condition = array(                    
                      'month' => $curr_month,
                      'year' => $curr_year,
                      //'employee_id' =>'31011'
                      'employee_id' =>@$result_att->employee_id
                  ); 
               
      	        $data = $condition;
      	        if (!empty($result_att)) {                  
      	            $attendance = $this->m_bio_att->get_single_data($condition,$type);
      	        }
  	            $bio_att_year = date('Y');
                $bio_att_month = date('m');
                //$bio_att_month = '08';
  	            $bio_att_day = date('d');
  	            $today = date('Y-m-d');
  	            $time = date("h:i:s a");
  	            $no_of_days = cal_days_in_month(CAL_GREGORIAN, $bio_att_month,$bio_att_year);
  	            $attend = array();
  	            for ($i=1; $no_of_days >= $i; $i++) {
  	                
  	                $attend[] = array('day'=>$i,'attendance'=>'','attendance_date'=>'','attendance_time'=>'','out_time'=>'');
  	                
  	            }
  	            if (empty($attendance)) {
  	                $data['employee_id'] = $result_att->employee_id; 
  	                        $data['status'] = '1';
  	                        $data['created_at'] = date('Y-m-d H:i:s');
  	                        $data['attendance_data'] = json_encode($attend);
  	              $this->m_bio_att->insert($data,$type);                          
  	            }else{
  	            	var_dump($attendance);
  	               $this->update_atten($em_id,$attendance,$condition,$type);
  	            } 
            }
        }
        die();     
        echo "<h1 style='text-align:center;'>Employee Attendance Updated.</h1>";
    }

    public function update_atten($em_id,$attendance,$condition,$type)
    { 
      //var_dump($em_id);

      $result = $this->m_bio_att->get_bio_att($em_id);//bio data 
      //$result = $this->m_bio_att->get_bio_att('31011'); 
	    //echo "<pre>";
      //var_dump($result);  
      // die();                                  
      $attendance_data = $attendance->attendance_data;
      $attendance_data_decode = json_decode($attendance_data);
      //var_dump($attendance_data_decode);
      
      $attend = array();  
      $today = date('Y-m-d'); 
     /* if($em_id == @$result->UserId)
      //if($em_id == "31011")
      {     //var_dump($result->LogDate);          
          $bio_att_day = date('d',strtotime($result->LogDate));
          $today = date('Y-m-d',strtotime($result->LogDate));
          $time = date("h:i:sa",strtotime($result->LogDate));
          $out_time = date("h:i:sa",strtotime($result->LogDate));  
          
          $status = "P"; //P for present  
         var_dump($out_time);
        // die(); 
      }else{
         $bio_att_day = date('d');
         $today = date('Y-m-d');
         $time = ""; 
         $status = "A"; //P for present
         
        
      } */     
      //echo "<PRe>";
      //print_r($result);
      $attend_blank = array();
      $no_of_days = 31;
      for ($i=1; $no_of_days >= $i; $i++) {
          if($i < 10){
            $j = '0'.$i;
          }else{
            $j = $i;
          }
          $today = date('Y-08-'.$j);
            
            $attend_blank[$today] = array('day'=>$i,'attendance'=>'A','attendance_date'=>$today,'attendance_time'=>'','out_time'=>'');
        }


      $dateArray = array();
      if(!empty($result)){
        foreach ($result as $key_res => $res) {
          $bio_att_day = date('d',strtotime($res->LogDate));
           //if(empty($res->attendance_time)){
            $today = date('Y-m-d',strtotime($res->LogDate));
            $time = date("h:i:sa",strtotime($res->LogDate));
            $out_time = date("h:i:sa",strtotime($res->LogDate));  
            $status = "P";
           
            if(in_array($today, $dateArray)){
              $tempArray = $attend[$today];
              $attend[$today] = array('day'=>$tempArray['day'],'attendance'=>$status,'attendance_date'=>$today,'attendance_time'=>$tempArray['attendance_time'],'out_time'=>$out_time);
            }else{
               $attend[$today] = array('day'=>$bio_att_day,'attendance'=>$status,'attendance_date'=>$today,'attendance_time'=>$time,'out_time'=>'');
            }
            $dateArray[$key_res]= $today;
       
      }
      }


      //echo "<PRe>";
      //print_r($attend);
      //print_r($attend_blank);
      //$final_array = array_merge($attend,$attend_blank);
      foreach ($attend_blank as $key_blank => $blank) {
          if(array_key_exists($key_blank, $attend)){
            $final_array[$key_blank] = $attend[$key_blank];
          }else{
            $final_array[$key_blank] = $blank;
          }
      }
      //print_r($final_array);
      echo $attendance_record = json_encode(array_values($final_array));  
     die;


      //*/var_dump($today);
      /*foreach ($attendance_data_decode as $att_data) {
        // var_dump($out_time);
        // die();
        if($att_data->day == $bio_att_day){
      /// for out time  check 'attendance_time' 
            if(empty($att_data->attendance_time)){
            $attend[] = array('day'=>$bio_att_day,'attendance'=>$status,'attendance_date'=>$today,'attendance_time'=>$time,'out_time'=>'');
            }else{
              $attend[] = array('day'=>$bio_att_day,'attendance'=>$status,'attendance_date'=>$today,'attendance_time'=>$att_data->attendance_time,'out_time'=>$out_time);
            }
          }else{
              $attend[] = $att_data;
          }
      }
      
      $attendance_record = json_encode($attend); */ 
      //var_dump($condition);  

      //$this->m_bio_att->update_attandance($attendance_record,$time,$condition,$type);
      $em_id = substr($em_id, 1); 
     // $data['attendance_data'] = json_encode($attend);
      $data['attendance_data'] = $attendance_record;
      $this->db->where('employee_id',$em_id);
      $this->db->where('month','08');
      $this->db->where('year','2019');
      $this->db->update('employee_attendances',$data);
      //$this->m_bio_att->update_attandance($data); 
       //die;
    }


}