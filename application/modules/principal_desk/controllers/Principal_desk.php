<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
 * Ganga Memorial CMS
 *
 * @author		Manoj Kumar
 * @copyright	Copyright (c) 2019
 */

/**
 * Class Principal_desk
 */

class Principal_desk extends Base_Controller
{
	/**
	 * Dashboard_Controller constructor.
	 */
	public function __construct()
	{
		// controller constructor
		parent::__construct();
		$this->load->model('super_admin/S_admin', 'mdl_super_Admin');
		$this->load->model('super_admin/Employee_attendance', 'mdl_emp_attendance');
		$this->load->model('employees/Employee_leaves', 'mdl_emp_leave');
		$this->load->module('employees');
		$this->load->module('office/leave_type');
		$this->load->model('setting/general_setting', 'mdl_general_setting');
		$this->load->model('academics/subject', 'mdl_subject');
		$this->load->model('academics/subject_unit', 'mdl_subject_unit');

		
	}

	/**
	 * Principal Dashboard.
	 * @return void [load view page]
	 */
	public function index()
	{
		$this->form_validation->set_rules('month-from', 'Select Date', 'required');
		
		if($this->form_validation->run() == false) {
			$curr_year = date('Y');
        	$curr_month = date('m');
        	//var_dump($_POST["month-from"]);
			$data['month_attadance'] = $this->mdl_emp_attendance->employee_day_attadance($curr_year,$curr_month);
			
			$this->template->set('title', 'Principal Desk');
			$this->template->load('template', 'contents', 'principal_desk',$data);
		}else {
			//var_dump("expression");
			$post = $this->input->post(null, true);
			$cleanPost = $this->security->xss_clean($post);
			
			
			$data['month_attadance'] = $this->mdl_emp_attendance->employee_attadance_onDate($_POST["month-from"]);			
			$data['given_date'] = $_POST["month-from"];
			$this->template->set('title', 'Principal Desk');
			$this->template->load('template', 'contents', 'principal_desk',$data);
		}
	}

	public function academic_progress()
	{
		$this->form_validation->set_rules('branch', 'branch', 'required|trim');
		$this->form_validation->set_rules('semester', 'semester', 'required|trim');
		$this->form_validation->set_rules('subject-id', 'subject id', 'required|trim');
		
		if($this->form_validation->run() == false) {
			$this->template->set('title', 'Progress Report');
			$this->template->load('template', 'contents', 'academic_progress');
		}else {
			$post = $this->input->post(null, true);
			$cleanPost = $this->security->xss_clean($post);
			$formData =  array(
				'LCTRS.fk_semester_id' => $_POST["semester"],
				'LCTRS.fk_subject_id' => $_POST["subject-id"],
				'LCTRS.fk_branch_id' => $_POST["branch"]
			);

			$data['searchData'] = $formData;
			//var_dump($data['searchData']);
			$data['lists'] = $this->mdl_super_Admin->academic_lectures_info($formData);
			/*echo "<pre>";
			print_r($data['lists']);
			die();*/
			$this->template->set('title', 'Principal Desk');
			$this->template->load('template', 'contents', 'academic_progress',$data);
		}
	}
	/*
		Get sujects semester and branch by
		Using ajax
	*/
	public function get_subject_semester_by(){
		$semester = $_POST['semester'];
		$branch = $_POST['branch'];
		$subject =  $this->mdl_super_Admin->get_subject_by_semester($semester,$branch);
		if(!empty($subject)){
			foreach ($subject as $value) {
			echo "<option value='$value->subject_p_id'>".$value->subject_name."-".$value->subject_code."</option>";
			}	
		}else{
			echo "<option>Data not found !</option>";
		}
	}

	
}

/* End of file Principal_desk.php */
/* Location: ./application/modules/principal_desk/controllers/Principal_desk.php */
