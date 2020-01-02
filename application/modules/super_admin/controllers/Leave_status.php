<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
 * Ganga Memorial CMS
 *
 * @author		Manoj Kumar
 * @copyright	Copyright (c) 2019
 */

/**
 * Class Leave_status
 */

class Leave_status extends Base_Controller
{
	/**
	 * Dashboard_Controller constructor.
	 */
	public function __construct()
	{
		// controller constructor
		parent::__construct();
		$this->load->model('Activity', 'mdl_activity');
		$this->load->model('super_admin/S_admin', 'mdl_super_Admin');
		$this->load->model('office/mdl_leave_type','mdl_leave_type');	
		$this->load->model('employees/mdl_employee','mdl_employee');
		$this->load->model('office/mdl_employee_type', 'mdl_empe_type');
		$this->load->model('office/mdl_department', 'mdl_dept');
		$this->load->model('office/mdl_designation', 'mdl_desg');
		$this->load->model('employees/Employee_leaves', 'mdl_emp_leave');
		
		
	}

	/**
	 * Leave status.
	 * @return void [load view page]
	 */
	public function index()
	{
		$this->form_validation->set_rules('search-faculty', 'from-date', 'required|trim');
		if($this->form_validation->run() == false) {

			$this->template->set('title', 'Employee Leave Status');
			$this->template->load('template', 'contents', 'leave_status/search_employee');
		}else{
			
			$post = $this->input->post(NULL, TRUE);
			$cleanPost = $this->security->xss_clean($post);
			$search_item = $cleanPost['search-faculty'];
			if ($search = $this->mdl_super_Admin->search_faculty($search_item)){
				
				$id = $search->emp_p_id;
				redirect('super_admin/leave_status/employee/'.$id, 'refresh');

			}else{

				$this->session->set_flashdata('error', "Error, Please enter correct faculty id!");
				redirect('super_admin/leave_status', 'refresh');
			}
		}
	}

	public function employee($id)
	{
		
		$this->form_validation->set_rules('from-date', 'from-date', 'required|trim');
		$this->form_validation->set_rules('to-date', 'to-date', 'required|trim');
		$this->form_validation->set_rules('leave-id', 'leave-id', 'required|trim');
		$this->form_validation->set_rules('description', 'description', 'required|trim');
		if($this->form_validation->run() == false) {
			$data['info'] = $this->mdl_employee->get($id);
			$data['lists'] = $this->mdl_leave_type->get_all();			
			$this->template->set('title', 'Apply Leave');
			$this->template->load('template', 'contents', 'leave_status/employee_leave', $data);
		}else{
			
			$post = $this->input->post(NULL, TRUE);
			$cleanPost = $this->security->xss_clean($post);

			$cl = 0;	
			$cl_consumed='';	
			$per_month_leave='';
			$leave_month = '';	
			$lists = $this->mdl_leave_type->get($cleanPost['leave-id']);
			//echo $lists->leave_limit;
			//die;
			//foreach ($data['lists'] as $value) {
				$cl_consumed .= get_cl($id,$cleanPost['leave-id']);
				$per_month_leave .= number_format((float)$lists->leave_limit/12,2,'.','');	
			//}	
			$session_year = get_financial_year()->start_year.'-'.get_financial_year()->start_month."-01";
			$prevoius_month = date('m',strtotime($session_year.' - 1 month'));
			$current_month =  date('m',strtotime($cleanPost['from-date']));	
			$current_year =   date('Y',strtotime($cleanPost['from-date']));
			if($current_year == get_financial_year()->start_year){
				$leave_month = $current_month - $prevoius_month;
			}else{
				$leave_month = $current_month + $prevoius_month;
			}		
			$start_date = strtotime($cleanPost['from-date']); 
			$end_date = strtotime( $cleanPost['to-date']); 
			$cl = ($end_date - $start_date)/60/60/24 + 1;
			$availble_leave = ($leave_month*$per_month_leave)-$cl_consumed;
			if($availble_leave >= $cl){			
				$formData = array(
					'emp_id' => $id,
					'leave_from' => $cleanPost['from-date'], 
					'leave_to' => $cleanPost['to-date'],
					'fk_leave_type_id' => $cleanPost['leave-id'],
					'description' => $cleanPost['description'],

				);
				if($this->db->insert('employee_leaves',$formData))
				{	
					$this->session->set_flashdata('success', 'Success, Leave Apply Successfully');
					redirect("super_admin/emp_leave_request", 'refresh');
				}
				else
				{
					$this->session->set_flashdata('error', 'Error, Can\'t add leave.');
					redirect("super_admin/emp_leave_request", 'refresh');
				}
			}else{
				$this->session->set_flashdata('error', 'Error, Your leave should be less than available leave. (Av.Leave - '.$availble_leave.' - Request Leave - '.$cl.')');
				redirect("super_admin/leave_status/employee/".$id, 'refresh');
			}
			
		}
	}

}

/* End of file Activity.php */
/* Location: ./application/modules/super_admin/controllers/Activity.php */
