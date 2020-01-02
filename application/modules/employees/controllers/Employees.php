<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
 * ERP
 *
 * @author		Amit Kumar
 * @copyright	Copyright (c) 2018
 */

/**
 * Class Employees
 */
class Employees extends Base_Controller
{
	/**
	 * Employee_Controller constructor.
	 */
	public function __construct()
	{
		// controller constructor
		parent::__construct();
		$this->load->model('Mdl_employee', 'mdl_employee');
		$this->load->model('Mdl_salary', 'mdl_salary');
		$this->load->module('office/department');	
		$this->load->module('office/designation');
		$this->load->module('office/employment_type');
		$this->load->module('office/salary_component');
		$this->load->module('office/employee_type');
		$this->load->module('office/Leave_type');
		$this->load->module('academics/lectures');
		$this->load->module('academics/subject_units');
		$this->load->model('Employee_leaves', 'mdl_emp_leave');
		$this->load->model('Student_attendance', 'mdl_student_attendance');
		$this->load->model('setting/cast_category','mdl_cast_category');
		$this->load->model('setting/session','mdl_session');
		$this->load->model('super_admin/mdl_sub_units', 'mdl_sub_unit');
		$this->load->library('file');
		
	}

	/**
	 * [Fetch all employee list.]
	 * @param  void
	 * @return void
	 */
	public function index()
	{	
		
		$data['lists'] = $this->mdl_employee->get_all();
		$this->template->set('title', 'Employee List');
		$this->template->load('template', 'contents', 'list', $data);
	}

	/**
	 * [Insert a new employee record.]
	 * @param  void
	 * @return void
	 */
	public function add()
	{
		/*$get_last_username = $this->mdl_employee->get_last_username();
		var_dump($get_last_username);
		die;*/
		$this->form_validation->set_rules('employee-id', 'employee id', 'required|trim|is_unique[employees.employee_id]');
		$this->form_validation->set_rules('name', 'client name', 'required|trim');
		$this->form_validation->set_rules('department', 'department', 'required|trim');
		$this->form_validation->set_rules('designation', 'designation', 'required|trim');
		$this->form_validation->set_rules('resident-type', 'resident type', 'required|trim');
		$this->form_validation->set_rules('qualification', 'qualification', 'required|trim');
		$this->form_validation->set_rules('cast-category', 'cast category', 'required|trim');
		$this->form_validation->set_rules('experience', 'experience', 'required|trim');
		$this->form_validation->set_rules('prev_org', 'previous organization', 'trim');
		$this->form_validation->set_rules('month-start', 'previous organization start month', 'trim');
		$this->form_validation->set_rules('month-end', 'previous organization start month', 'trim');
		$this->form_validation->set_rules('remarks', 'remarks', 'trim');

		$this->form_validation->set_rules('dob', 'date of birth', 'required|trim');
		$this->form_validation->set_rules('phone', 'phone no.', 'required|trim|regex_match[/^[0-9]{10}$/]');
		$this->form_validation->set_rules('email', 'email id', 'required|trim|valid_email');
		$this->form_validation->set_rules('city', 'city', 'required|trim');
		$this->form_validation->set_rules('state', 'state', 'required|trim');
		$this->form_validation->set_rules('pincode', 'pincode', 'required|trim|regex_match[/^[0-9]{6}$/]');
		$this->form_validation->set_rules('address', 'address', 'required|trim');
		
		$this->form_validation->set_rules('password', 'password', 'required|trim|min_length[8]|max_length[15]');

		$this->form_validation->set_rules('in-time', 'login in time', 'required|trim');
		$this->form_validation->set_rules('out-time', 'log out time', 'required|trim');
		$this->form_validation->set_rules('salary', 'salary', 'trim');
		$this->form_validation->set_rules('working-hour', 'working hour', 'trim');

		$this->form_validation->set_rules('joining-date', 'joining date', 'required|trim');
		$this->form_validation->set_rules('employement-type', 'employement type', 'required|trim');
		$this->form_validation->set_rules('employee-type', 'employee type', 'required|trim');

		$this->form_validation->set_rules('account-name', 'account name', 'trim');
		$this->form_validation->set_rules('account-number', 'account number', 'trim');
		$this->form_validation->set_rules('bank-name', 'bank name', 'trim');
		$this->form_validation->set_rules('ifsc-code', 'IFSC code', 'trim');
		$this->form_validation->set_rules('branch-address', 'branch address', 'trim');
		$this->form_validation->set_rules('pan-number', 'PAN number', 'trim|regex_match[/^([a-zA-Z]{5})(\d{4})([a-zA-Z]{1})$/]');
		$this->form_validation->set_rules('adhar-number', 'Adhar number', 'trim|required|regex_match[/^[0-9]{12}$/]');

		if($this->form_validation->run() == false) {
			
			$this->template->set('title', 'Add Employee');
			$this->template->load('template', 'contents', 'add');
		} else {
			$folder = strtolower($_POST['employee-id']);
			if (!is_dir("assets/img/employees/{$folder}")) {
				mkdir("assets/img/employees/{$folder}", 0777, true);
			}
			// file upload
			$docArray = array(
				'resume' => $_FILES['resume']['name'],
				'id_proof' => $_FILES['id_proof']['name'],
				'joining_letter' => $_FILES['joining_letter']['name'],
				'agreement_letter' => $_FILES['agreement_letter']['name']
			);
			$docConfig = array(
				'upload_path' => "assets/img/employees/{$folder}",
				'log_threshold' => 1,
				'allowed_types' => "pdf|doc|docx|PDF|DOC|DOCX",
				'max_size' => 1000,
				'encrypt_name' => true,
				'remove_spaces' => true,
				'detect_mime' => true,
				'overwrite' => false
			);
			$document = $this->file->fileUpload($docArray, $oldFileArray = null, $docConfig, $folder, $id = null);
			$photoArray = array(
				'photo' => $_FILES['photo']['name'],
				'signature' => $_FILES['signature']['name'],
			);
			$photoConfig = array(
				'upload_path' => "assets/img/employees/{$folder}",
				'log_threshold' => 1,
				'allowed_types' => "jpg|jpeg|png|JPG|JPEG|PNG",
				'max_size' => 1000,
				'encrypt_name' => true,
				'remove_spaces' => true,
				'detect_mime' => true,
				'overwrite' => false
			);
			$photo = $this->file->fileUpload($photoArray, $oldFileArray = null, $photoConfig, $folder, $id = null);
			$this->load->library('password');
			$post = $this->input->post(null, true);
			$cleanPost = $this->security->xss_clean($post);
			$hashed = $this->password->create_hash($cleanPost['password']);
			
			$formData = array(
				'employee_id' => $cleanPost['employee-id'],
				'username' => $cleanPost['employee-id'],
				'emp_name' => $cleanPost['name'],
				'user_role_id' => '8',
				'password' => $hashed,
				'emp_photo' => $photo['photo'],
				'emp_signature' => $photo['signature'],
				'emp_dob' => $cleanPost['dob'],
				'emp_phone' => $cleanPost['phone'],
				'emp_email' => $cleanPost['email'],
				'emp_gender' => $cleanPost['gender'],
				'fk_cast_category' => $cleanPost['cast-category'],
				'emp_marital_status' => $cleanPost['marital-status'] ? $cleanPost['marital-status']:null,
				'emp_religion' => $cleanPost['religion'] ? $cleanPost['religion']:null,
				'emp_blood_group' => $cleanPost['blood-group'] ? $cleanPost['blood-group']:null,
				'emp_city' => $cleanPost['city'],
				'emp_state' => $cleanPost['state'],
				'emp_pincode' => $cleanPost['pincode'],
				'emp_address' => $cleanPost['address'],
				'emp_qualification' => $cleanPost['qualification'],
				'emp_experience' => $cleanPost['experience'],
				'emp_address' => $cleanPost['address'],
				'emp_resident_type' => $cleanPost['resident-type'],
				'emp_department_ID' => $cleanPost['department'],
				'emp_designation_ID' => $cleanPost['designation'],
				'emp_joined_date' => $cleanPost['joining-date'],
				'emp_employment_type' => $cleanPost['employement-type'],
				'emp_type' => $cleanPost['employee-type'],
				'emp_login_time' => $cleanPost['in-time'],
				'emp_logout_time' => $cleanPost['out-time'],
				'emp_working_hour' => $cleanPost['working-hour'],
				'emp_salary' => $cleanPost['salary'],
				'emp_resume' => isset($document['resume']) ? $document['resume']:null,
				'emp_id_proof' => isset($document['id_proof']) ? $document['id_proof']:null,
				'emp_joining_letter' => isset($document['joining_letter']) ? $document['joining_letter']:null,
				'emp_agreement' => isset($document['agreement_letter']) ? $document['agreement_letter']:null,
				'emp_account_name' => $cleanPost['account-name'] ? $cleanPost['account-name']:$cleanPost['name'],
				'emp_account_number' => $cleanPost['account-number'] ? $cleanPost['account-number']:null,
				'emp_bank_name' => $cleanPost['bank-name'] ? $cleanPost['bank-name']:null,
				'emp_ifsc_code' => $cleanPost['ifsc-code'] ? $cleanPost['ifsc-code']:null,
				'emp_branch' => $cleanPost['branch-address'] ? $cleanPost['branch-address']:null,
				'emp_pan' => $cleanPost['pan-number'] ? $cleanPost['pan-number']:null,
				'emp_adhar' => $cleanPost['adhar-number'] ? $cleanPost['adhar-number']:null,
				'emp_prev_organization' => $cleanPost['prev_org'] ? $cleanPost['prev_org']:null,
				'emp_prev_org_from' => $cleanPost['month-start'] ? $cleanPost['month-start']:null,
				'emp_prev_org_to' => $cleanPost['month-end'] ? $cleanPost['month-end']:null,
				'emp_remark' => $cleanPost['remarks'] ? $cleanPost['remarks']:null,
			);

			//var_dump($formData);
			//die;
			// insert to database
			if($this->mdl_employee->insert($formData) == true) {
				$this->session->set_flashdata('success', "Success, New employee has been added!");
			} else {
				$this->session->set_flashdata('error', "Error, Can't add new employee!");
			}
			redirect("employees", "refresh");
		}
	}

	/**
	 * [Edit employee details]
	 * @param  int $id [primary key]
	 * @return [type]     [description]
	 */
	public function edit($id)
	{
		if($id != null) {
			redirect("employees/edit_personal_details/{$id}", "refresh");
		} else {
			$this->session->set_flashdata('warning', "Error, Employee not found!");
			redirect("employees", "refresh");
		}
	}

	/**
	 * [Edit employee personal detail and update.]
	 * @param  int $id [primary key]
	 * @return void
	 */
	public function edit_personal_details($id)
	{
		$this->form_validation->set_rules('name', 'client name', 'required|trim');
		$this->form_validation->set_rules('dob', 'date of birth', 'required|trim');
		$this->form_validation->set_rules('phone', 'phone no.', 'required|trim|regex_match[/^[0-9]{10}$/]');
		$this->form_validation->set_rules('email', 'email id', 'required|trim|valid_email');
		$this->form_validation->set_rules('city', 'city', 'required|trim');
		$this->form_validation->set_rules('cast-category', 'cast category', 'required|trim');
		$this->form_validation->set_rules('state', 'state', 'required|trim');
		$this->form_validation->set_rules('pincode', 'pincode', 'required|trim|regex_match[/^[0-9]{6}$/]');
		$this->form_validation->set_rules('address', 'address', 'required|trim');
		$this->form_validation->set_rules('alt-phone', 'phone no.', 'trim|regex_match[/^[0-9]{10}$/]');
		$this->form_validation->set_rules('work-phone', 'phone no.', 'trim|regex_match[/^[0-9]{10}$/]');
		$this->form_validation->set_rules('work-email', 'email id', 'trim|valid_email');
		$this->form_validation->set_rules('qualification', 'qualification', 'required|trim');
		$this->form_validation->set_rules('experience', 'experience', 'required|trim');
		$this->form_validation->set_rules('prev_org', 'previous organization', 'trim');
		$this->form_validation->set_rules('father-name', 'father name', 'trim');
		$this->form_validation->set_rules('mother-name', 'mother name', 'trim');
		$this->form_validation->set_rules('month-start', 'previous organization start month', 'trim');
		$this->form_validation->set_rules('month-end', 'previous organization start month', 'trim');
		$this->form_validation->set_rules('remarks', 'remarks', 'trim');
		$this->form_validation->set_rules('pan-number', 'PAN number', 'trim|regex_match[/^([A-Z]{5})(\d{4})([A-Z]{1})$/]');
		$this->form_validation->set_rules('adhar-number', 'Adhar number', 'trim|required|regex_match[/^[0-9]{12}$/]');
		if($this->form_validation->run() == false) {
			$data['info'] = $this->mdl_employee->get($id);
			$this->template->set('title', 'Edit Employee Details');
			$this->template->load('template', 'contents', 'edit', $data);
		} else {
			$photo = '';
			$signature = '';
			if(!empty($_FILES['photo']['name'])) {
				$folder = strtolower($this->mdl_employee->get($id)->employee_id);
				if (is_dir("assets/img/employees/{$folder}")) {
					unlink("assets/img/employees/{$_POST['emp-photo']}");
				} else {
					$this->session->set_flashdata('error', "Error, Image delete error!");
				}
				$config = array(
					'upload_path' => "assets/img/employees/{$folder}",
					'log_threshold' => 1,
					'allowed_types' => "jpg|jpeg|png|JPG|JPEG|PNG",
					'max_size' => 1000,
					'encrypt_name' => true,
					'remove_spaces' => true,
					'detect_mime' => true,
					'overwrite' => false
				);
				$this->load->library('upload', $config);
				$this->upload->do_upload('photo');
				$file = $this->upload->data();
				$photo = "{$folder}/{$file['file_name']}";
			}

			if(!empty($_FILES['signature']['name'])) {
				$folder = strtolower($this->mdl_employee->get($id)->employee_id);
				if (is_dir("assets/img/employees/{$folder}")) {
					unlink("assets/img/employees/{$_POST['emp-signature']}");
				} else {
					$this->session->set_flashdata('error', "Error, Image delete error!");
				}
				$config = array(
					'upload_path' => "assets/img/employees/{$folder}",
					'log_threshold' => 1,
					'allowed_types' => "jpg|jpeg|png|JPG|JPEG|PNG",
					'max_size' => 1000,
					'encrypt_name' => true,
					'remove_spaces' => true,
					'detect_mime' => true,
					'overwrite' => false
				);
				$this->load->library('upload', $config);
				$this->upload->do_upload('signature');
				$file = $this->upload->data();
				$signature = "{$folder}/{$file['file_name']}";
			}

			$post = $this->input->post(null, true);
			$cleanPost = $this->security->xss_clean($post);
			$formData = array(
				'emp_name' => $cleanPost['name'],
				'emp_dob' => $cleanPost['dob'],
				'fk_cast_category' => $cleanPost['cast-category'],
				'emp_gender' => $cleanPost['gender'],
				'emp_religion' => $cleanPost['religion'],
				'emp_marital_status' => $cleanPost['marital-status'],
				'emp_photo' => $photo ? $photo : $_POST['previous-photo'],
				'emp_signature' => $signature ? $signature :  $_POST['previous-signature'],
				'emp_blood_group' => $cleanPost['blood-group'] ? $cleanPost['blood-group']:null,
				'emp_phone' => $cleanPost['phone'],
				'emp_email' => $cleanPost['email'],
				'emp_city' => $cleanPost['city'],
				'emp_state' => $cleanPost['state'],
				'emp_pincode' => $cleanPost['pincode'],
				'emp_address' => $cleanPost['address'],
				'emp_qualification' => $cleanPost['qualification'],
				'emp_experience' => $cleanPost['experience'],
				'father_name' => $cleanPost['father-name'] ? $cleanPost['father-name']:"",
				'mother_name' => $cleanPost['mother-name'] ? $cleanPost['mother-name']:"",
				'work_phone' => $cleanPost['work-phone'] ? $cleanPost['work-phone']:null,
				'work_email' => $cleanPost['work-email'] ? $cleanPost['work-email']:null,
				'emp_adhar' => $cleanPost['adhar-number'] ? $cleanPost['adhar-number']:null,
				'emp_pan' => $cleanPost['pan-number'] ? $cleanPost['pan-number']:null,
				'alternate_phone' => $cleanPost['alt-phone'],
				'emp_prev_organization' => $cleanPost['prev_org'] ? $cleanPost['prev_org']:null,
				'emp_prev_org_from' => $cleanPost['month-start'] ? $cleanPost['month-start']:null,
				'emp_prev_org_to' => $cleanPost['month-end'] ? $cleanPost['month-end']:null,
				'emp_remark' => $cleanPost['remarks'] ? $cleanPost['remarks']:null,
			);

			// update to database
			if($this->mdl_employee->update($formData, $id) == true) {
				$this->session->set_flashdata('success', "Success, Employee details has been updated!");
			} else {
				$this->session->set_flashdata('error', "Error, Can't update employee details!");
			}
			redirect("employees/edit_personal_details/{$id}", 'refresh');
		}
	}

	/**
	 * [Edit employee job detail and update.]
	 * @param  int $id [primary key]
	 * @return void
	 */
	public function edit_job_details($id)
	{
		$this->form_validation->set_rules('department', 'department', 'required|trim');
		$this->form_validation->set_rules('designation', 'designation', 'required|trim');
		$this->form_validation->set_rules('joining-date', 'joining date', 'required|trim');
		$this->form_validation->set_rules('employement-type', 'employement type', 'required|trim');
		$this->form_validation->set_rules('in-time', 'login in time', 'required|trim');
		$this->form_validation->set_rules('out-time', 'log out time', 'required|trim');
		$this->form_validation->set_rules('salary', 'salary', 'trim');
		$this->form_validation->set_rules('base_salary', 'Base Salary', 'trim');
		$this->form_validation->set_rules('joing_salary', 'Join Salary', 'trim');
		$this->form_validation->set_rules('working-hour', 'working hour', 'trim');
		$this->form_validation->set_rules('employee-type', 'employee type', 'required|trim');
		$this->form_validation->set_rules('resident-type', 'resident type', 'required|trim');
		if($this->form_validation->run() == false) {
			$data['info'] = $this->mdl_employee->get($id);
			$this->template->set('title', 'Edit Employee Details');
			$this->template->load('template', 'contents', 'edit', $data);
		} else {
			$folder = strtolower($this->mdl_employee->get($id)->employee_id);
			if (!is_dir("assets/img/employees/{$folder}")) {
				mkdir("assets/img/employees/{$folder}", 0777, true);
			}
			$newFileArray = array(
				'resume' => !empty($_FILES['resume']['name']) ? $_FILES['resume']['name']:null,
				'id_proof' => !empty($_FILES['id_proof']['name']) ? $_FILES['id_proof']['name']:null,
				'joining_letter' => !empty($_FILES['joining_letter']['name']) ? $_FILES['joining_letter']['name']:null,
				'agreement_letter' => !empty($_FILES['agreement_letter']['name']) ? $_FILES['agreement_letter']['name']:null
			);
			$oldFileArray = array(
				'resume' => !empty($_POST['emp_resume']) ? $_POST['emp_resume']:null,
				'id_proof' => !empty($_POST['emp_id_proof']) ? $_POST['emp_id_proof']:null,
				'joining_letter' => !empty($_POST['emp_joining_letter']) ? $_POST['emp_joining_letter']:null,
				'agreement_letter' => !empty($_POST['emp_agreement']) ? $_POST['emp_agreement']:null
			);
			$config = array(
				'upload_path' => "assets/img/employees/{$folder}",
				'log_threshold' => 1,
				'allowed_types' => "pdf|doc|docx|PDF|DOC|DOCX",
				'max_size' => 1000,
				'encrypt_name' => true,
				'remove_spaces' => true,
				'detect_mime' => true,
				'overwrite' => false
			);
			$document = $this->file->fileUpload($newFileArray, $oldFileArray, $config, $folder, $id);
			$workingDays = null;
			$post = $this->input->post(null, true);
			$cleanPost = $this->security->xss_clean($post);
			
			$prevous_salary = $cleanPost['previous_salary'];
			$new_salary  = $cleanPost['salary'];
			$pre_allowance  = $cleanPost['previous_allowance'];
			$new_allowance  = $cleanPost['allowance'];

			$salary_new = '';
			if($prevous_salary < $new_salary || $pre_allowance < $new_allowance){
				$salary_new = $new_salary;
				$other_allowance  = $new_allowance;
				$formData = array(
					'emp_salary' => $new_salary,
					'allowance' => $new_allowance,
					'employee_id'=>$id
				);
				$re = $this->db->insert('salary_increament', $formData);
			}
			//var_dump($salary_new);
			//var_dump($salary_pre);
			//die;
			$formData = array(
				'emp_department_ID' => $cleanPost['department'],
				'emp_designation_ID' => $cleanPost['designation'],
				'emp_joined_date' => $cleanPost['joining-date'],
				'emp_employment_type' => $cleanPost['employement-type'],
				'emp_working_days' => $workingDays,
				'emp_type' => $cleanPost['employee-type'],
				'emp_login_time' => $cleanPost['in-time'],
				'emp_logout_time' => $cleanPost['out-time'],
				'allowance' => $pre_allowance ? $pre_allowance : "",
				'emp_salary' => $prevous_salary,
				'base_salary' => $cleanPost['base_salary'],
				'joing_salary' => $cleanPost['joing_salary'],
				'emp_resident_type' => $cleanPost['resident-type'],
				'emp_resume' => isset($document['resume']) ? $document['resume']:$_POST['emp_resume'],
				'emp_id_proof' => isset($document['id_proof']) ? $document['id_proof']:$_POST['emp_id_proof'],
				'emp_joining_letter' => isset($document['joining_letter']) ? $document['joining_letter']:$_POST['emp_joining_letter'],
				'emp_agreement' => isset($document['agreement_letter']) ? $document['agreement_letter']:$_POST['emp_agreement']
			);
			//var_dump($formData);
			//die();
			// update to database
			if($this->mdl_employee->update($formData, $id) == true || @$re == true) {
				$this->session->set_flashdata('success', "Success, Employee details has been updated!");
			} else {
				$this->session->set_flashdata('error', "Error, Can't update employee details!");
			}
			redirect("employees/edit_job_details/{$id}", 'refresh');
		}
	}

	/**
	 * [Edit employee salary detail and update.]
	 * @param  int $id [primary key]
	 * @return void
	 */
	public function edit_salary_details($id)
	{
		$this->form_validation->set_rules('salary-type', 'salary type', 'required|trim');

		if($this->form_validation->run() == false) {
			$data['info'] = $this->mdl_employee->get($id);
			$data['salary'] = $this->mdl_salary->get_by('employee_ID', $id);
			if(!empty($data['salary'])) {
				$data['empSalaryDetails'] = json_decode($data['salary']->component, TRUE);
				$data['empSalaryAmountDetails'] = json_decode($data['salary']->component_amount, TRUE);
			}

			$data['salaryEarningList'] = $this->mdl_salary_component->get_many_by(array('component_type' => 'CR', 'is_active' => '1'));
			$data['salaryDeductionList'] = $this->mdl_salary_component->get_many_by(array('component_type' => 'DR', 'is_active' => '1'));
			$this->template->set('title', 'Edit Employee Details');
			$this->template->load('template', 'contents', 'edit', $data);
		} else {
			$components = $this->mdl_salary_component->get_all();
			$credit_id = $this->input->post('credit');
			$debit_id = $this->input->post('debit');

			$total_ctc_amt = 0;
			$total_payable_amt = 0;
			$total_deduct_amt =0;
			$basic_salary = $this->input->post(1);

			// check credit salary
			for($i=0; $i<sizeof($credit_id); $i++) {
				if($_POST[$credit_id[$i]] == 0) continue;

				$data['component_id'][] = $credit_id[$i];
				$data['value'][] = $_POST[$credit_id[$i]];
				$data['amount'][] = $_POST['amount'.$credit_id[$i]];
			}

			// check debit salary
			for($j=0; $j<sizeof($debit_id); $j++) {
				if($_POST[$debit_id[$j]] == 0) continue;

				$data['component_id'][] = $debit_id[$j];
				$data['value'][] = $_POST[$debit_id[$j]];
				$data['amount'][] = $_POST['amount'.$debit_id[$j]];
			}
			$salaryDetails = array();
			for($k=0; $k< sizeof($data['component_id']); $k++) {
				$salaryDetails[$data['component_id'][$k]] = $data['value'][$k];
			}
			$salaryAmtDetails = array();
			for($k=0; $k< sizeof($data['component_id']); $k++) {
				$salaryAmtDetails[$data['component_id'][$k]] = $data['amount'][$k];
			}
			for($k=0; $k< sizeof($data['component_id']); $k++) {
				$componentID[] = $data['component_id'][$k];
			}
			// save component
			foreach($components as $key => $value) {
				if(in_array($value->component_p_id, $componentID)) {
					$componentData['component_ID'] = $value->component_p_id;
					$componentData['employee_ID'] = $id;

					$result = $this->db->get_where('component', array(
						'employee_ID' => $id,
						'component_ID' => $value->component_p_id,
					))->row();
					if(empty($result)) {
						$this->db->insert('component', $componentData);
					}
				} else {
					$this->db->delete('component', array('component_ID' => $value->component_p_id, 'employee_ID' => $id));
				}
			}

			$post = $this->input->post(null, true);
			$cleanPost = $this->security->xss_clean($post);
			$formData = array(
				'employee_ID' => $id,
				'salary_type' => $cleanPost['salary-type'],
				'total_payable' => $cleanPost['total_payable'],
				'total_deduction' => $cleanPost['total_deduction'],
				'total_ctc' => $cleanPost['total_ctc'],
				'basic' => $cleanPost['basic'],
				'gross' => $cleanPost['gross'],
				'component' => json_encode($salaryDetails),
				'component_amount' => json_encode($salaryAmtDetails),
			);

			$salary_id = $this->input->post('salary-id');
			if($salary_id != null) {
				// update data
				if($this->mdl_salary->update($formData, $salary_id) == true) {
					$this->session->set_flashdata('success', "Success, Employee salary details has been updated!");
				} else {
					$this->session->set_flashdata('error', "Error, Can't update employee salary details!");
				}
			} else {
				// insert data
				if($this->mdl_salary->insert($formData) == true) {
					$this->session->set_flashdata('success', "Success, Employee salary details has been updated!");
				} else {
					$this->session->set_flashdata('error', "Error, Can't update employee salary details!");
				}
			}
			redirect("employees/edit_salary_details/{$id}", 'refresh');
		}
	}

	/**
	 * [Edit employee bank detail and update.]
	 * @param  int $id [primary key]
	 * @return redirect
	 */
	public function edit_bank_details($id)
	{
		$this->form_validation->set_rules('account-name', 'account name', 'required|trim');
		$this->form_validation->set_rules('account-number', 'account number', 'required|trim');
		$this->form_validation->set_rules('bank-name', 'bank name', 'required|trim');
		$this->form_validation->set_rules('ifsc-code', 'IFSC code', 'required|trim');
		$this->form_validation->set_rules('branch-address', 'branch address', 'required|trim');
		


		if($this->form_validation->run() == false) {
			$data['info'] = $this->mdl_employee->get($id);
			$this->template->set('title', 'Edit Employee Details');
			$this->template->load('template', 'contents', 'employees/edit', $data);
		} else {
			$post = $this->input->post(null, true);
			$cleanPost = $this->security->xss_clean($post);
			$formData = array(
				'emp_account_name' => $cleanPost['account-name'],
				'emp_account_number' => $cleanPost['account-number'],
				'emp_bank_name' => $cleanPost['bank-name'],
				'emp_ifsc_code' => $cleanPost['ifsc-code'],
				'emp_branch' => $cleanPost['branch-address'],
				
			);
			// update to database
			if($this->mdl_employee->update($formData, $id) == true) {
				$this->session->set_flashdata('success', "Success, Employee details has been updated!");
			} else {
				$this->session->set_flashdata('error', "Error, Can't update employee details!");
			}
			redirect("employees/edit_bank_details/{$id}", 'refresh');
		}
	}

	/**
	 * [Edit employee login credential detail and update.]
	 * @param  int $id [primary key]
	 * @return redirect
	 */
	public function edit_login_details($id)
	{
		$this->form_validation->set_rules('username', 'username', 'required|trim');
		$this->form_validation->set_rules('password', 'password', 'required|trim|min_length[4]|max_length[15]');


		if($this->form_validation->run() == false) {
			$data['info'] = $this->mdl_employee->get($id);
			$this->template->set('title', 'Edit Employee Details');
			$this->template->load('template', 'contents', 'employees/edit', $data);
		} else {
			$this->load->library('password');
			$post = $this->input->post(NULL, TRUE);
			$cleanPost = $this->security->xss_clean($post);
			$hashed = $this->password->create_hash($cleanPost['password']);
			$formData = array(
				'employee_id' => $cleanPost['username'],
				'view_pass' => $cleanPost['display-password'],
				'password' => $hashed
			);
			// update to database
			if($this->mdl_employee->update($formData, $id) == true) {
				$this->session->set_flashdata('success', "Success, Employee password has been updated!");
			} else {
				$this->session->set_flashdata('error', "Error, Can't update employee password!");
			}
			redirect("employees", 'refresh');
		}
	}

	/**
	 * [Activate status.]
	 * @param  int $id [primary key]
	 * @return redirect
	 */
	public function activate($id)
	{
		$data = array(
			'is_active' => '1'
		);
		if($this->mdl_employee->update($data, $id) == true) {
			$this->session->set_flashdata('success', "Success, Activated successfully!");
		} else {
			$this->session->set_flashdata('success', "Error, Can't activate!");
		}
		redirect('employees', 'refresh');
	}

	/**
	 * [Deactivate status.]
	 * @param  int $id [primary key]
	 * @return redirect
	 */
	public function deactivate($id)
	{
		$data = array(
			'is_active' => '0'
		);
		if($this->mdl_employee->update($data, $id) == true) {
			$this->session->set_flashdata('success', "Success, Deactivated successfully!");
		} else {
			$this->session->set_flashdata('success', "Error, Can't deactivate!");
		}
		redirect('employees', 'refresh');
	}

	/**
	 * [Delete record from the table.]
	 * @param  void
	 * @return boolean
	 */
	public function delete()
	{
		$id = $this->input->post('primary_id');
		if($this->mdl_employee->delete($id) == true) {
			echo true;
		} else {
			echo false;
		}
	}

	/**
	 * [Delete record permanently from database.]
	 * @param  int $id [primary key]
	 * @return redirect
	 */
	public function force_delete($id)
	{
		if($this->mdl_employee->force_delete($id) == true) {
			$this->session->set_flashdata('success', 'DELETED!');
		} else {
			$this->session->set_flashdata('error', 'ERROR!');
		}
		redirect('employees', 'refresh');
	}

	/**
	 * [Get designation list by department.]
	 * @param  int $id [primary key]
	 * @return mixed
	 */
	public function get_designation_list_by_department($id)
	{
		$query = $this->db->select('desg_p_id, desg_name')->from('designations')->where('dept_ID', $id)->get();
		$result = $query->num_rows() > 0 ? $query->result() : false;
		echo json_encode($result);
	}


	public function profile($id)
	{
		$data['info'] = $this->mdl_employee->get($id);
		//$data['lectures_schedules'] = $this->mdl_lecture->emp_lectures_schedules($id);
		//$data['temp_lecture'] = $this->mdl_lecture->emp_temp_lectures_schedules($id);
		//print_r($data['temp_lecture']);
		$this->template->set('title', 'Employee List');
		$this->template->load('template', 'contents', 'employee_profile', $data);
	}


	public function student_zone($id)
	{	

		$this->form_validation->set_rules('employee-id', 'employee', 'required|trim');
		$this->form_validation->set_rules('semester-id', 'semester', 'required|trim');
		$this->form_validation->set_rules('session-id', 'session', 'required|trim');
		$this->form_validation->set_rules('branch-id', 'branch', 'required|trim');
		$this->form_validation->set_rules('period-id', 'period', 'required|trim');
		$this->form_validation->set_rules('subject-id', 'subject', 'required|trim');
		$this->form_validation->set_rules('unit-id', 'unit', 'required|trim');
		$this->form_validation->set_rules('start-date', 'start date', 'required|trim');
		$this->form_validation->set_rules('attndnce-date', 'attandance date', 'required|trim');

		if($this->form_validation->run() == false) {
			$data['info'] = $this->mdl_employee->get($id);
			$this->template->set('title', 'Student Zone');
			$this->template->load('template', 'contents', 'employee_student_zone', $data);
		} else {			
			$post = $this->input->post(NULL, TRUE);
			$cleanPost = $this->security->xss_clean($post);
			$check_unique = $this->mdl_employee->check_unique_data($cleanPost);
			if(empty($check_unique)){	
				$lists =  $this->mdl_lecture->student_list($cleanPost['branch-id'],$cleanPost['semester-id']);				
				foreach($lists as $liss){					
					$attendance[] = array(
						'student_id' => $liss->student_p_id,
						'attance_status' => "A"
					);					
				}
				$formData = array(
					'employee_id' => $id,
					'fk_session_id' => $cleanPost['session-id'],
					'fk_semester_id' => $cleanPost['semester-id'],
					'super_unit_id' => $cleanPost['subject-unitLct'],
					'fk_branch_id' => $cleanPost['branch-id'],
					'fk_period_id' => $cleanPost['period-id'],
					'fk_subject_id' => $cleanPost['subject-id'],
					'unit' => $cleanPost['unit-id'],
					'student_attandance' => json_encode($attendance),
					'lacture_date' => date("Y-m-d", strtotime($cleanPost['attndnce-date'])),
					//'attandanceDt' => $cleanPost['attndnce-date'],
					'engaged_of_faculty' => $cleanPost['engaged'] ? $cleanPost['engaged'] : $cleanPost['employee-id'],
				);

				
				// var_dump($formData);
				// die();
				$formData2 = array(
					'updated_by' => $id,
					'startDt' => $cleanPost['start-date'],
				);

				$this->mdl_sub_unit->update($formData2, $cleanPost['subject-unitLct']);
					
				if($cleanPost['end-date'] != ""){
					$formData3 = array(
						'updated_by' => $id,
						'endDt' => $cleanPost['end-date'],
						'status' => '0'
					);

					$this->mdl_sub_unit->update($formData3, $cleanPost['subject-unitLct']);
				}
				// print_r($formData);
				// print_r($formData2);
				// exit;
				// update to database
				if($this->db->insert('lectures',$formData)) {
					$this->session->set_flashdata('success', "Success, Employee lecture has been attended!");
				} else {
					$this->session->set_flashdata('error', "Error, Can't attend employee lecture!");
				}			
				redirect("employees/lecture_student_attadance/{$id}/{$this->db->insert_id()}", 'refresh');
			}else{
				$this->session->set_flashdata('error', "Error, Already attendance completed.!");
				redirect("employees/student_zone/{$id}", 'refresh');
			}
		}
	}

	

	public function lecture_student_attadance($employeeId,$lectureId){

		$this->form_validation->set_rules('student_id[]', 'student', 'required|trim');
		
		$this->form_validation->set_rules('attendance[]', 'attendance', 'required|trim');
		//$this->form_validation->set_rules('unit-id', 'unit', 'required|trim');
		if($this->form_validation->run() == false) {

			//$data['info'] = $this->mdl_lecture->get_details($lectureId);
			
			$data['info'] = $value = $this->mdl_lecture->get_details($lectureId);
			
			
			$att = json_decode($value->student_attandance, true);
			foreach ($att as $at) {
				$lists[] = array(

					'student_p_id' =>  $at['student_id'],
					'student_unique_id' => $this->mdl_student->get($at['student_id'])->student_unique_id,
					'student_roll' => $this->mdl_student->get($at['student_id'],'ASC')->student_roll,
					'student_full_name' => $this->mdl_student->get($at['student_id'])->student_full_name,
					'attandance' => $at['attance_status']
				);
			}

			$data['lists'] = $lists;
			
			$this->template->set('title', 'Lecture Attandance');
			$this->template->load('template', 'contents', 'edit_lecture_attadance', $data);
		}else{

			$post = $this->input->post(NULL, TRUE);
			$cleanPost = $this->security->xss_clean($post);
			
			for($i = 0; $i < count($cleanPost['student_id']); $i++){

				$attendance[] = array(

								'student_id' => $cleanPost['student_id'][$i],
								'attance_status' => $cleanPost['attendance'][$i]
								
							);
				
			}
			
			$formData = array(
							
							//'unit' => $cleanPost['unit-id'],
							'student_attandance' => json_encode($attendance),
						);
			
			
			
			//insert to database
			if($this->mdl_lecture->update($formData, $lectureId))
			{	
				$this->session->set_flashdata('success', 'Success, Student Attandence has been added!');
			}
			else
			{
				$this->session->set_flashdata('error', 'Error, Can\'t add Attandance.');
			}
			redirect("employees/profile/{$employeeId}", 'refresh');
			
		}
	}


	public function lecture_history($id)
	{
		$data['lists'] = $this->mdl_employee->employee_lecture_history($id);
		$this->template->set('title', 'Lecture Attandance List');
		$this->template->load('template', 'contents', 'lecture_history', $data);
	}

	public function apply_leave($id)
	{
		//die();
		$this->form_validation->set_rules('from-date', 'from-date', 'required|trim');
		$this->form_validation->set_rules('to-date', 'to-date', 'required|trim');
		$this->form_validation->set_rules('leave-id', 'leave-id', 'required|trim|callback_check_leave');
		$this->form_validation->set_rules('description', 'description', 'required|trim');
		if($this->form_validation->run() == false) {

			$data['info'] = $this->mdl_employee->get($id);
			//$data['lists'] = $this->mdl_leave_type->get_all();
			$data['lists'] = $this->mdl_emp_leave->leaveList();
			$this->template->set('title', 'Apply Leave');
			$this->template->load('template', 'contents', 'employee_leave', $data);

		}else{

			$post = $this->input->post(NULL, TRUE);
			$cleanPost = $this->security->xss_clean($post);
			$formData = array(
				'emp_id' => $id,
				'leave_from' => $cleanPost['from-date'], 
				'leave_to' => $cleanPost['to-date'],
				'fk_leave_type_id' => $cleanPost['leave-id'],
				'description' => $cleanPost['description'],

			);
			if($this->db->insert($formData)== true)
			{	
				$this->session->set_flashdata('success', 'Success, Leave Apply Successfully');
			}
			else
			{
				$this->session->set_flashdata('error', 'Error, Can\'t add leave.');
			}
			redirect("employees/profile/{$id}", 'refresh');
		}
	}

	public function check_leave()
   {             
       $post = $this->input->post(null, true);
		$clean_post = $this->security->xss_clean($post);
		$leaveId = $clean_post['leave-id'];
		$fromDate = date('Y-m-d', strtotime($clean_post['from-date']));
		$toDate = date('Y-m-d', strtotime($clean_post['to-date']));
		//$sql = "SELECT RI.inventory as inventory, price FROM rmrateinventory AS RI WHERE RI.room_id = '$rmId' AND ((`bookingDate` >= '$checkin' AND `bookingDate` < '$checkout')) AND RI.deleted ='0' AND RI.is_active='1'";
		$query = $this->db->query($sql);
		if($query->row())
        {
            $this->form_validation->set_message('check_inventory', 'Inventory is already exist for selected date range');
            return FALSE;
        }
        return TRUE;
   }

	public function leave_history($id)
	{
		
		$data['lists'] = $this->mdl_emp_leave->emp_leave_applied($id);
		$this->template->set('title', 'Leave History');
		$this->template->load('template', 'contents', 'emp_leave_history', $data);
	}

	public function student_on_lecture()
	{
		$lectureId = $_POST["lectureId"];
		//print_r($bookIssueId);
		$data['lecture_info']= $this->mdl_lecture->get($lectureId);
		//print_r($data);
		foreach ($data as  $obj) 
		{	
			$subject = $obj->fk_subject_id;
			$periodId = $obj->fk_period_id;
			$unit = $this->mdl_unit->get($obj->unit)->unit_number;
			$semester = $obj->fk_semester_id;
			$branch = $obj->fk_branch_id;
			$all_students = json_decode($obj->student_attandance); 
			$present_student = 0;
			$total_student = 0;

			foreach($all_students as $student){
				 $total_student = $total_student+1;
			}

			foreach($all_students as $student){

				if($student->attance_status =="P"){
					$present_student = $present_student+1;
				}
			}

			$present_present = ($present_student/$total_student)*100;
			$present_stud = $present_student." ( ".number_format((float)$present_present, 2, '.', '')."% ) ";

			$absent = $total_student - $present_student;
			$absent_present = ($absent/$total_student)*100;
			$absent_stud = $absent." ( ".number_format((float)$absent_present, 2, '.', '')."% ) ";

			echo "<table class='table table-striped table-bordered table-hover'>
				<tbody>
					<tr>
						<td> <strong>Faculty Info</strong></td>
		 				<td><strong>".$this->mdl_employee->get($obj->employee_id)->emp_name." - [ ".$this->mdl_employee->get($obj->employee_id)->employee_id." ]</strong></td>
		 			</tr>
					
		 			<tr>
						<td><strong>Subject </strong></td>
		 				<td><strong>".$this->mdl_subject->get($subject)->subject_name." - [ ".$this->mdl_subject->get($subject)->subject_code." ]</strong></td>
		 			</tr>
		 			<tr>
						<td><strong>Unit</strong></td>
		 				<td><strong>".$unit."</strong></td>
		 			</tr>
		 			<tr>
						<td> <strong>Period</strong> </td>
		 				<td><strong>".$this->mdl_period->get($periodId)->period_name."</strong></td>
		 			</tr>
		 			<tr>
						<td> <strong>Branch</strong></td>
		 				<td><strong>".$this->mdl_branch->get($branch)->branch_code."</strong></td>
		 			</tr>
		 			<tr>
						<td> <strong>Semester</strong></td>
		 				<td><strong>".$this->mdl_semester->get($semester)->semester_name ."</strong></td>
		 			</tr>
		 			<tr>
						<td> <strong>Present Student</strong></td>
		 				<td><strong>".$present_stud."</strong></td>
		 			</tr>
		 			<tr>
						<td> <strong>Absent Student</strong></td>
		 				<td><strong>".$absent_stud."</strong></td>
		 			</tr>
		 			<tr>
						<td> <strong>Total Student</strong></td>
		 				<td><strong>".$total_student."</strong></td>
		 			</tr>
				</tbody>
			</table>
			<table class='table table-striped table-bordered table-hover'>
								<thead>
									<tr>
										<th>Sr No.</th>
										<th>ROLL NUMBER</th>
										<th>STUDENT ID</th>
										<th>STUDENT NAME</th>
										<th>ATTENDANCE</th>
									</tr>
								</thead>
								<tbody>";

			
				$i=0;
				foreach ($all_students as $student){ $i++;
					echo 	"<tr>
										<td>".$i."</td>
										<td>".$this->mdl_student->get($student->student_id)->student_roll."</td>
										<td>".$this->mdl_student->get($student->student_id)->student_unique_id."</td>
										<td>".$this->mdl_student->get($student->student_id)->student_full_name."</td>
										<td>".$student->attance_status."</td>
										
									</tr>";
				}
				echo "</tbody>
								<tfoot>
									<tr>
										<th>Sr No.</th>
										<th>ROLL NUMBER</th>
										<th>STUDENT ID</th>
										<th>STUDENT NAME</th>
										<th>ATTENDANCE</th>
									</tr>
								</tfoot>
							</table>";
		}
	}


	public function subject_unit($id)
	{
		

		$this->form_validation->set_rules('employee-id', 'employee', 'required|trim');
		$this->form_validation->set_rules('start-date', 'start date', 'required|trim');
		$this->form_validation->set_rules('unit-id', 'unit', 'required|trim');
		$this->form_validation->set_rules('subject-id', 'subject', 'required|trim');
		


		if($this->form_validation->run() == false) {
			$data['info'] = $this->mdl_employee->get($id);
			$data['unit_list'] = $this->mdl_employee->subject_unit_list($id);
			$this->template->set('title', 'Student Unit List');
			$this->template->load('template', 'contents', 'subject_unit/add', $data);
		} else {
			
			$post = $this->input->post(NULL, TRUE);
			$cleanPost = $this->security->xss_clean($post);
			$formData = array(
				'fk_emp_id' => $id,
				'unit_id' => $cleanPost['unit-id'],
				'fk_subject_id' => $cleanPost['subject-id'],
				'start_date' => $cleanPost['start-date'],
			);

			// print_r($formData);
			// exit;
			// update to database
			if($this->mdl_sub_unit->insert($formData)==true) {
				$this->session->set_flashdata('success', "Success, Subject Unit For lecture has been added!");
			} else {
				$this->session->set_flashdata('error', "Error, Can't attend unit lecture!");
			}
			redirect("super_admin/subject_unit/{$id}", 'refresh');
		}
	}

	public function subject_unit_edit($emp_id,$sub_unit_id)
	{
		$this->form_validation->set_rules('employee-id', 'employee', 'required|trim');
		$this->form_validation->set_rules('start-date', 'start date', 'required|trim');
		$this->form_validation->set_rules('unit-id', 'unit', 'required|trim');
		$this->form_validation->set_rules('subject-id', 'subject', 'required|trim');

		if($this->form_validation->run() == false) {
			$data['emp_info'] = $this->mdl_employee->get($emp_id);
			$data['info'] = $this->mdl_sub_unit->get($sub_unit_id);
			$this->template->set('title', 'Student Unit Edit');
			$this->template->load('template', 'contents', 'subject_unit/edit', $data);
		} else {
			
			$post = $this->input->post(NULL, TRUE);
			$cleanPost = $this->security->xss_clean($post);
			$formData = array(
				'end_date' => $cleanPost['end-date'],
				'is_active' => '0'
			);

			// print_r($formData);
			// exit;
			// update to database
			if($this->mdl_sub_unit->update($formData,$sub_unit_id)==true) {
				$this->session->set_flashdata('success', "Success, Subject Unit For lecture has been updated!");
			} else {
				$this->session->set_flashdata('error', "Error, Can't updated!");
			}
			redirect("super_admin/subject_unit/{$emp_id}", 'refresh');
		}
	}

}

/* End of file Employees.php */
/* Location: ./application/modules/employees/controllers/Employees.php */
