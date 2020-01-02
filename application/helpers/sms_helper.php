<?php

if(!defined('BASEPATH')) exit('No direct script access allowed');
/**

 * Codeigniter-SMS-API : Codeigniter Library to Send SMS

**/
function get_sms_gateway()
{
	$ci = & get_instance();
    $ci->db->select('S.*');
    $ci->db->from('sms_settings AS S');
    return $ci->db->get()->row();
}
function send_sms($number,$message_body,$return='0')
{
	
    //var_dump($setting);
	//Gateway URl
	$smsGatewayUrl='http://66.70.200.49';
	//api element
	$apiElement='/rest/services/sendSMS/sendGroupSms';
	//Your authentication key
	$authKey= get_sms_gateway()->auth_key;
	//Your message to send, Add URL encoding here.
	$message=$message_body;
	//Sender ID
	$senderId=get_sms_gateway()->sender_id;
	//Define route 
	$routeId='1';
	//Multiple mobiles numbers separated by comma
	$mobileNumber=$number;
	//SMS content type
	$smsContentType='unicode';
	//api parameters
	$api_params=$apiElement.'?AUTH_KEY='.$authKey.'&message='.$message.'&senderId='.$senderId.'&routeId='.$routeId.'&mobileNos='.$mobileNumber.'&smsContentType='.$smsContentType;
	$smsgatewaydata=$smsGatewayUrl.$api_params;
	$url = $smsgatewaydata;
	//var_dump($url);
	//die();
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_POST, false);
	curl_setopt($ch, CURLOPT_URL, urldecode($url));
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); $output = curl_exec($ch);
	curl_close($ch);
	if(!$output)
	{
		$output = file_get_contents($smsgatewaydata);
	}
	if($return == '1')
	{
		return $output;
	}
	else
	{
		return true; 
	}

}

	///

	function check_sms(){
		$url = "http://66.70.200.49/rest/services/sendSMS/getClientRouteBalance?AUTH_KEY=".get_sms_gateway()->auth_key."&clientName=".get_sms_gateway()->sender_id.'"';
		//var_dump($url);
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_POST, false);
		curl_setopt($ch, CURLOPT_URL, urldecode($url));
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); $output = curl_exec($ch);
		curl_close($ch);
		// if($output)
		// {
			return $output;
		// }else{
			// return 0;
		// }
	}


	if (!function_exists('get_holidays')) {
	    function get_holidays($start_date,$end_date) {
	    	//var_dump($start_date,$end_date);
	        $ci = & get_instance();
	        $ci->db->select('*');
	        // $ci->db->where("HD.start_date BETWEEN '$start_date' AND '$end_date'");    
	        $ci->db->or_where("HD.start_date BETWEEN '$start_date' AND '$end_date'");
	        $ci->db->or_where("HD.end_date BETWEEN '$start_date' AND '$end_date'");
	        return $ci->db->get('holidays AS HD')->result();
	    }
	}

	//Get all Sunday of the year
if (!function_exists('getSundays')) {
	function getSundays($start_date,$end_date){ 
		$startDate = new DateTime($start_date);
		$endDate = new DateTime($end_date);

		$sundays = array();

		while ($startDate <= $endDate) {
		    if ($startDate->format('w') == 0) {
		        $sundays[] = $startDate->format('Y-m-d');
		    }

		    $startDate->modify('+1 day');
		}
		return  $sundays;		
	}
}

if (!function_exists('getStudents')) {
	function getStudents($student){ 
		 $ci = & get_instance();
	        $ci->db->select('*');
	        $ci->db->where("admission_status != 'junk'");
	        $ci->db->where("is_active = '1'");
	        $ci->db->where("student_p_id ='$student'");
	        return $ci->db->get('students')->row();
	}
}

if (!function_exists('get_increament')) {
	function get_increament($emp_id,$start_date=null){ 
		 $ci = & get_instance();
	        $ci->db->select('*');
	        $ci->db->order_by('created_on','DESC');
	        $ci->db->limit(1);
	        $ci->db->where("employee_id",$emp_id);      
	        if(!empty($start_date)){
	       	 	$ci->db->where("DATE_FORMAT(created_on,'%Y-%c') <=" ,date('Y-m',strtotime($start_date)));      
	        }
	        //$ci->db->like('student_attandance','"student_id":"'.$st_id.'"');
	        return $ci->db->get('salary_increament')->row();
	}
}

if (!function_exists('get_financial_year')) {
	function get_financial_year(){ 
		$ci = & get_instance();
	    $ci->db->select('*');
	    $ci->db->where("status",'1');  
	    $ci->db->where("is_active",'1');  
	    return $ci->db->get('financial_years')->row();
	}
}

if (!function_exists('get_emp_by_leaves')) {
	function get_emp_by_leaves($emp_id,$start_year=null,$end_year=null,$start_month=null,$end_month=null,$cl=null,$lwp=null){
		$financial_year_start = $start_year.'-'.$start_month;
		$financial_year_end = $end_year.'-'.$end_month;
		$ci = & get_instance();
	    $ci->db->select('emp_id');
	    $ci->db->where("emp_id",$emp_id);      
	    $ci->db->where("status",1); 
	    if(!empty($cl)){
	    	$ci->db->where("fk_leave_type_id",$cl); 
	    }
	    if(!empty($lwp)){
	    	$ci->db->where("fk_leave_type_id",$lwp); 
	    }
	    if(!empty($start_year)){
	       	$ci->db->where("DATE_FORMAT(leave_from,'%Y-%c') >=" ,date('Y-m',strtotime($financial_year_start)));      
	    }
	    if(!empty($end_year)){
	       	$ci->db->where("DATE_FORMAT(leave_to,'%Y-%c') <=" ,date('Y-m',strtotime($financial_year_end)));      
	    }
	    return $ci->db->get('employee_leaves')->row();
	}
}

if (!function_exists('get_student_ratio')) {
	function get_student_ratio($emp_id,$start_year=null,$end_year=null,$start_month=null,$end_month=null){
		$financial_year_start = $start_year.'-'.$start_month;
		$financial_year_end = $end_year.'-'.$end_month;
		$ci = & get_instance();
	    $ci->db->select('student_attandance');
	    $ci->db->where("employee_id",$emp_id);      
	    $ci->db->where("lecture_p_id != 0");      
	    $ci->db->where("is_active",'1'); 	   
	    if(!empty($start_year)){
	       	$ci->db->where("DATE_FORMAT(lacture_date,'%Y-%c') >=" ,date('Y-m',strtotime($financial_year_start)));      
	    }
	    if(!empty($end_year)){
	       	$ci->db->where("DATE_FORMAT(lacture_date,'%Y-%c') <=" ,date('Y-m',strtotime($financial_year_end)));      
	    }
	    return $ci->db->get('lectures')->result();
	}
}

if (!function_exists('getEmployeeAttendances')) {
	function getEmployeeAttendances($employee_id,$in_time,$out_time){ 
		$ci = & get_instance();
		$financial_year = get_financial_year();
		$month = '07'; //$financial_year->start_month;
		$year = $financial_year->start_year;
		$yearNext = $year + 1; 

		//$in_time = new DateTime($info->emp_login_time);
		//$out_time = new DateTime($info->emp_logout_time);
		$in_time = new DateTime($in_time);
		$out_time = new DateTime($out_time);
		//$out_time = '15:30:00';

		$query = $ci->db->query("SELECT * FROM `employee_attendances` WHERE ((month >= 07 and year = $year) OR (month <= 06 and year = $yearNext)) AND `status` = '1' AND `employee_id` = '$employee_id'");
		$result = $query->result();
		$p_count = 0;
		$count = 0;
		$perAttendance = 0;
		if(!empty($result)){
			foreach ($result as $res) {
				$attendance_data = $res->attendance_data;
					if(!empty($attendance_data)){
						foreach (json_decode($attendance_data, true) as $attendance) {
							if( $attendance['attendance'] == "P" ){
								$p_count = $p_count+1;
								$dailyInTime = new DateTime($attendance['attendance_time']);
	                   			$dailyOutTime = new DateTime($attendance['out_time']);
								$lateInTimeDiff = $in_time->diff($dailyInTime);
								$beforeOutTimeDiff = $out_time->diff($dailyOutTime);

								if($dailyInTime > $in_time ){
									$count = $count +1;
								}elseif($dailyOutTime < $out_time ){
									$count = $count +1;
								}
							}

						}
					}
			}
		}
		if(!empty($p_count)){
		$ontime = ($p_count - $count);
			return $perAttendance = ((($ontime/$p_count)*100));
		}
		return $perAttendance;
	}
}

if (!function_exists('get_account_user')) {
	function get_account_user($role_id){ 
		$ci = & get_instance();
	    $ci->db->select('*');
	    $ci->db->where("user_role_id",$role_id);  
	    $ci->db->where("is_active",'1');  
	    return $ci->db->get('users')->result();
	}
}

if (!function_exists('get_restrication')) {
	function get_restrication($id=null){ 
		$ci = & get_instance();
	    $ci->db->select('*');  
	    $ci->db->where("is_active",'1');  
	    if(!empty($id)){
	    	$ci->db->where("restriction_p_id",$id); 
	    } 
	    return $ci->db->get('restrictions')->result();
	}
}

if(!function_exists('get_cl')){
	function get_cl($emp_id = null, $leave_id=null){
		$ci = & get_instance();
		$consumed_leave = $ci->mdl_emp_leave->emp_consumed_leave($emp_id,$leave_id);		
		$cl = 0;
		foreach ($consumed_leave as $obj) {
			$start_date = strtotime($obj->leave_from); 
			$end_date = strtotime($obj->leave_to); 
			$cl += ($end_date - $start_date)/60/60/24 + 1;
		} 
		return $cl;
		//echo  $cl;
	}
}



