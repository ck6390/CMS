<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
 * Ganga Memorial CMS
 *
 * @author		Vishwajeet Kumar
 * @copyright	Copyright (c) 2019
 */

/**
 * Class Student
 */

class Student extends Base_Model
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
	protected $_primary_key = 'student_p_id';

	/*
	* [get student detail by student unique id]
	* 
	*/
    public function searchStudent($search_item)
    {
    	$this->db->select('student_p_id');
    	$this->db->where('student_unique_id', $search_item);

    	$query = $this->db->get('students');
    	$result = $query->row();
    	//print_r($result->student_p_id); exit;
    	return $result;

    }

    /*
	* [get branch, session name by students table]
	* 
	*/
    public function get_branch_session()
    {
    	$this->db->select("students.student_p_id,students.admission_no,students.student_roll,students.registration_no,students.fk_semester_id,students.fk_course_year_id,student_unique_id,student_full_name,students.is_active,admission_status,hostel_status, sessions.session_name, branches.branch_code,students.final_submit");
    	$this->db->from("students");
    	$this->db->join("sessions", "sessions.session_p_id = students.fk_session_id");
    	$this->db->join("branches", "branches.branch_p_id = students.fk_branch_id");
    	$this->db->where('students.deleted !=','1');
    	$this->db->order_by('student_unique_id', 'ASC');
    	$query = $this->db->get();
		return $query->result();
    }

    /*
	* [get student profile details]
	* 
	*/
    public function get_student_profile($id)
    {	

    	$this->db->select("ST.*, sessions.session_name, branches.branch_code, semesters.semester_name ");
    	$this->db->from("students AS ST");
    	$this->db->join("sessions", "sessions.session_p_id = ST.fk_session_id");
    	$this->db->join("branches", "branches.branch_p_id = ST.fk_branch_id");
    	$this->db->join("semesters", "semesters.semester_p_id = ST.fk_semester_id");
    	$this->db->where('student_p_id',$id);
    	$query = $this->db->get();
		return $query->row();
    }
 	/*
	* [get student hostel details]
	* 
	*/
    public function get_student_alloted_room($id)
    {
    	$data = array(
    		'student_id'=> $id,
    		'ARMS.is_active' => '1'
    	);

    	$this->db->select("ARMS.room_id,ARMS.allotted_room_p_id,RM.booked_bed");
    	$this->db->from("allotted_rooms AS ARMS");
    	$this->db->join("rooms AS RM", "RM.room_p_id = ARMS.room_id");
    	$this->db->where($data);
    	$query = $this->db->get();
		return $query->row();
    }
    /*
	* [get student details from students table]
	* 
	*/
    public function get_all_students($data,$branch,$gender)
	{
		$this->db->select("student_p_id");
		
		$this->db->where($data);
		$this->db->where_in('fk_branch_id', $branch);
		$this->db->where_in('gender', $gender);

		$query=$this->db->get('students');
    	$result=$query->result();
		return $result;
	}

	/*
	* [Fine List of Student on fee/fine add]
	* 
	*/
	public function get_fine_list($id)
	{
		$this->db->select('fee_type_p_id,fee_type_name,fine_amount,remarks,due_date');
		$this->db->from("fee_types");	
		$this->db->join("fee_allocates", "fee_allocates.fee_type_id = fee_types.fee_type_p_id");
		$this->db->join("students", "students.student_p_id = fee_allocates.student_id");
		
		$this->db->where('student_p_id',$id);
		$query = $this->db->get();
		return $query->result();
	}

	/*
	* [due fee of Student on his/her profile]
	* 
	*/

	public function get_due_fee_amount($id)
	{	
		$data = array(
			'student_id' => $id,
			'INV.paid_status !=' => "paid", 
			'INV.deleted !=' => '1'
		);


		$this->db->select('fee_amount,due_amount');
		$this->db->from('invoices AS INV');
		//$this->db->join("students AS ST", "ST.student_p_id = INV.student_id",'left');
		$this->db->where($data);
             
        return $this->db->get()->row(); 
	}

	/*
	* [Library Fine of Student on his/her profile]
	* 
	*/

	public function get_due_library_fine($id)
	{
		$this->db->select_sum('library_fine');
		$this->db->from('book_issues AS BKIS');
		$this->db->join("students AS ST", "ST.student_p_id = BKIS.student_id",'left');
		$this->db->where('student_p_id',$id);
		$this->db->where('paid_status !=','paid');
             
        return $this->db->get()->row(); 
	}

	public function get_due_hostel_due($id)
	{	
		//var_dump($id);
		$data = array(

			'HFS.student_id'=>$id,
			'HFS.paid_status !=' => "paid", 
			'HFS.deleted !=' => '1'
			
		);
		$this->db->select_sum('fee_amount');
		$this->db->from('hostel_fees AS HFS');
		$this->db->where($data);
             
        return $this->db->get()->row(); 
	}

	/*
	* [hostel room due of Student on his/her hostel profile]
	* 
	*/

	public function get_due_hostel_room($id)
	{
		$data = array(

			'student_id'=>$id,
			'fk_fee_type_id' =>'17',
			'HFS.deleted !=' => '1'
		);
		$this->db->select_sum('fee_amount');
		$this->db->from('hostel_fees AS HFS');
		//$this->db->join("students AS ST", "ST.student_p_id = HFS.student_id",'left');
		$this->db->where($data);
             
        return $this->db->get()->row(); 
	}

	/*
	* [hostel mess due of Student on his/her hostel profile]
	* 
	*/

	public function get_due_hostel_mess($id)
	{
		$data = array(

			'student_p_id'=>$id,
			'fk_fee_type_id' =>'18',
			'HFS.deleted !=' => '1'
		);
		$this->db->select_sum('fee_amount');
		$this->db->from('hostel_fees AS HFS');
		$this->db->join("students AS ST", "ST.student_p_id = HFS.student_id",'left');
		$this->db->where($data);
             
        return $this->db->get()->row(); 
	}

	
	public function student_hostel_payment_history($id)
	{	
		$data = array(
				
				'student_p_id'=> $id,
				'INV.paid_status !='=> "paid",

		);

		$this->db->select('INV.*,FT.fee_type_name');
		$this->db->from('invoices AS INV');
		$this->db->join("students AS ST", "ST.student_p_id = INV.student_id",'left');
		$this->db->join("allotted_rooms AS ARMS", "ARMS.allotted_room_p_id = INV.student_id",'left');
		$this->db->join("fee_types AS FT", "FT.fee_type_p_id = INV.fk_fee_type_id",'left');
        $this->db->where($data);
        
       $query = $this->db->get();
		return $query->result();
	}

	

	public function student_payment_history_unpaid_admin($id)
	{
		$data = array(
				
				'PMNT.student_id'=> $id,
				'INV.paid_status !='=> "paid",

		);

		$this->db->select("INV.*,FT.fee_type_name");
		$this->db->from('payments AS PMNT'); 
		$this->db->join('invoices AS INV', 'INV.invoice_p_id = PMNT.invoice_id', 'left');
		$this->db->join('students AS ST', 'ST.student_p_id = INV.student_id', 'left');
		$this->db->join('fee_types AS FT', 'FT.fee_type_p_id = INV.fk_fee_type_id', 'left');
		$this->db->where($data);

		$query= $this->db->get();
    	$result=$query->result();
		return $result;
	}

	/**
	 * [Check admission status]
	 * @param  int $id [primary key]
	 * @return mixed
	 */
	public function checkAdmissionStatus($id)
	{

		$this->db->select('admission_status');
    	$this->db->where('student_p_id',$id);
    	$this->db->where('admission_status', 'pending');
    	$this->db->where('is_active','1');

    	$query = $this->db->get('students');
   
      	if($query->num_rows() > 0) {
        	return true;
      	}else{
       		return false;
      	}
	}

	/**
	 * [Check Academic Payment Status]
	 * @param  int $id [primary key]
	 * @return mixed
	 */
	public function academic_fee_type($id)
	{
		$this->db->select('academic_fee_type');
		$this->db->from('students'); 
		$this->db->where('student_p_id',$id);
       	return $this->db->get()->row(); 
         
	}

	/**
	 * [Get Attach File]
	 * @param  int $id [primary key]
	 * @return mixed
	 */
	public function getAttachFile($id)
	{
		$this->db->select('*');
		$this->db->from('attach_files');

		$this->db->where('student_id',$id);
		$query = $this->db->get();
		//var_dump($query); die();
		return $query->result();
         
	}
}

/* End of file Student.php */
/* Location: ./application/modules/students/models/Student.php */