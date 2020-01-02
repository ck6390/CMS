<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
 * ERP
 *
 * @author		Amit Kumar
 * @copyright	Copyright (c) 2018
 */

/**
 * Class Payrolls
 */

class Payrolls extends Base_Controller
{
	/**
	 * Payrolls_Controller constructor.
	 */
	public function __construct()
	{
		// controller constructor
		parent::__construct();
		$this->load->model('Mdl_payroll', 'mdl_payroll');
		$this->load->module('attendance');
	}

	/**
	 * [Fetch all employee list.]
	 * @param  void
	 * @return null
	 */
	public function index()
	{
		$data[] = null;
		$data['emp_id'] = null;
		$data['dept_id'] = null;
		if($this->input->post('submit')) {
			$this->form_validation->set_rules('department', 'department', 'required|trim');
			$this->form_validation->set_rules('employee', 'employee', 'required|trim');
			if($this->form_validation->run() == true) {
				$post = $this->input->post(null, true);
				$cleanPost = $this->security->xss_clean($post);
				$data['emp_id'] = $cleanPost['employee'];
				$data['dept_id'] = $cleanPost['department'];
				$data['payslips'] = $this->mdl_payroll->get_many_by(array('department_ID' => $cleanPost['department'], 'employee_ID' => $cleanPost['employee']));
			}
		}
		$this->template->set('title', 'Employee Payroll List');
		$this->template->load('template', 'contents', 'list', $data);
	}

	/**
	 * [Create employee monthly salary.]
	 * @param  void
	 * @return null
	 */
	public function make_payment()
	{
		$this->form_validation->set_rules('department', 'department', 'required|trim');
		$this->form_validation->set_rules('employee', 'employee', 'required|trim');
		$this->form_validation->set_rules('month', 'month', 'required|trim');

		$data['departmentID'] = $this->input->post('department', true);
		$data['employeeID'] = $this->input->post('employee', true);
		$data['month'] = $this->input->post('month', true);
		if ($this->form_validation->run() == false) {
			$this->template->set('title', 'Make Payment');
			$this->template->load('template', 'contents', 'make_payment', $data);
		} else {
			//$data['officeWorking'] = $this->mdl_payroll->get_office_working_days($this->input->post('month', true));
			$data['empWorking'] = $this->mdl_payroll->get_employee_working_days($this->input->post('employee', true), $this->input->post('month', true));
			$data['salary'] = $this->mdl_salary->get_by('employee_ID', $this->input->post('employee', true));
			if(!empty($data['salary'])) {
				$data['empSalaryDetails'] = json_decode($data['salary']->component_amount, true);
			} else {
				$this->session->set_flashdata('warning', "Please, set employees salary first!");
				redirect('employees', 'refresh');
			}
			$data['salaryEarningList'] = $this->mdl_salary_component->get_many_by('component_type', 'CR');
			$data['salaryDeductionList'] = $this->mdl_salary_component->get_many_by('component_type', 'DR');
			$data['empSalaryComponent'] = $this->mdl_payroll->get_employee_component( $this->input->post('employee', true));
			$data['employeeDetail'] = $this->mdl_payroll->get_employee_detail($this->input->post('employee', true));
			$data['companyDetail'] = $this->mdl_company->get($data['employeeDetail']->emp_company);
			$data['payroll'] = $this->mdl_payroll->get_by(array('month' => $this->input->post('month', true), 'department_ID' => $this->input->post('department', true), 'employee_ID' =>$this->input->post('employee', true)));
			$this->template->set('title', 'Make Payment');
			$this->template->load('template', 'contents', 'make_payment', $data);
		}
	}

	/**
	 * [Save employee month's salary.]
	 * @return [type] [description]
	 */
	public function save_payroll()
	{
		$this->form_validation->set_rules('payment-method', 'payment method', 'trim|required');
		if ($this->form_validation->run() == true) {
			$post = $this->input->post(null, true);
			$cleanPost = $this->security->xss_clean($post);

			$emp_id = $cleanPost['employee-id'];
			$month = $cleanPost['salary-month'];
			// check duplicate payroll
			$payroll_id = $this->mdl_payroll->get_by(array('employee_ID' => $emp_id, 'month' => $month))->payroll_p_id;
			// employee department id
			$employee_dept_id = $this->mdl_employee->get_by('emp_p_id', $emp_id)->emp_department_ID;
			$salaryData = array(
				'month' => $month,
				'employee_ID' => $emp_id,
				'department_ID' => $employee_dept_id,
				'gross_salary' => $cleanPost['gross-salary'],
				'deduction' => $cleanPost['deduction'],
				'net_salary' => $cleanPost['net-salary'],
				'fine_deduction' => $cleanPost['fine-deduction'] ? $cleanPost['fine-deduction']:0.00,
				'bonus' => $cleanPost['bonus'] ? $cleanPost['bonus']:0.00,
				'net_payment' => $cleanPost['payment-amount'],
				'payment_method' => $cleanPost['payment-method'],
				'comment' => $cleanPost['comment'],
				'provident_fund' => $cleanPost['provident-fund'],
				'esic_employer' => $cleanPost['esic-employer-contribution'],
				'esic_employee' => $cleanPost['esic-employee-contribution'],
				'monthly_ctc' => $cleanPost['net-ctc'],
			);

			// validation check @emp_id and @month
			if($emp_id && $month) {
				// validation check
				if($payroll_id) {
					// update data
					$this->db->where('payroll_p_id', $payroll_id);
					$this->db->update('payroll', $salaryData);
					$paySlipID = $payroll_id;
				} else {
					// insert data
					$this->db->insert('payroll', $salaryData);
					$paySlipID = $this->db->insert_id();
				}
			} else {
				// redirect with error
				$this->message->norecord_found('admin/payroll/employee/');
			}
			$this->employeePaySlip($emp_id, $month, $paySlipID);
		} else {
			$error = validation_errors();
			echo $error;
		}
	}

	public function employeePaySlip($emp_id, $month, $paySlipID)
	{
		$data['officeWorking'] = $this->mdl_payroll->get_office_working_days($month);
		$data['empWorking'] = $this->mdl_payroll->get_employee_working_days($emp_id, $month);
		$data['salary'] = $this->mdl_salary->get_by('employee_ID', $emp_id);
		if(!empty($data['salary']->component)) {
			$data['empSalaryDetails'] = json_decode($data['salary']->component, true);
		} else {
			redirect('payrolls/make_payment', 'refresh');
		}
		$data['salaryEarningList'] = $this->mdl_salary_component->get_many_by('component_type', 'CR');
		$data['salaryDeductionList'] = $this->mdl_salary_component->get_many_by('component_type', 'DR');
		$data['empSalaryComponent'] = $this->mdl_payroll->get_employee_component($emp_id);
		$data['employeeDetail'] = $this->mdl_payroll->get_employee_detail($emp_id);
		$data['payroll'] = $this->mdl_payroll->get($paySlipID);

		$this->template->set('title', 'Employee Payslip');
		$this->template->load('template', 'contents', 'employee_payslip', $data);
		// constructor
		//load mPDF library
		//$pdfFilePath = "output_pdf_name.pdf";
		// $this->load->library('m_pdf');
		//
      //  //generate the PDF from the given html
		// $this->m_pdf->pdf->WriteHTML($html);
		//
      //   //download it.
		// $this->m_pdf->pdf->Output($pdfFilePath, "D");
	}

	/**
	 * [Get employee list by department.]
	 * @param  int $id [primary key]
	 * @return mixed
	 */
	public function get_employee_list_by_department($id)
	{
		$query = $this->db->select('emp_p_id, emp_name')->from('employees')->where('emp_department_ID', $id)->get();
		$result = $query->num_rows() > 0 ? $query->result() : false;
		echo json_encode($result);
	}
}

/* End of file Payrolls.php */
/* Location: ./application/modules/payrolls/controllers/Payrolls.php */
