<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * 
 * Create by Amit Kumar
 * 
 * @link http://github.com/akamit21/Codeigniter3-HMVC-RBAC-Login-Module
 * @copyright Copyright (c) 2018, Amit Kumar <https://twitter.com/amitaldo>
 */

/**
 * Class Base_Controller
 */
class Base_Controller extends MX_Controller
{
	/**
	 * Base_Controller constructor.
	 */
	public function __construct()
	{
		// controller constructor
		parent::__construct();
		// auth library
		$this->load->library('auth');
		// user authentication [if user is logged in or not]
		$this->auth->authenticate();
		// check route access [check if user is authorized to view this page or not]
		//$this->auth->route_access();
		// miscaellaneous library
		$this->load->library('misc');
		// form error deliminiters
		$this->form_validation->set_error_delimiters('<span class="label label-danger">', '</span>');
		
		// modules
		$this->load->module('admin/users');
		$this->load->module('admin/roles');
		$this->load->module('admin/permissions');
		// $this->load->module('setting/branches');
		 $this->load->module('setting/semesters');
		// $this->load->module('setting/sessions');
		//$this->load->module('students');
		// $this->load->module('academics');
		// $this->load->module('academics/subjects');
		// $this->load->module('academics/periods');
		// $this->load->module('academics/lectures');
		// $this->load->module('academics/subject_units');
		// $this->load->module('setting/course_years');
		// $this->load->module('setting/buildings');
		// $this->load->module('setting/floors');
		// $this->load->module('setting/general_settings');
		// $this->load->module('hostel/rooms');
		// $this->load->module('hostel/hostel_invoices');
		// $this->load->module('hostel/allotted_rooms');
		// $this->load->module('setting/blocks');
		//$this->load->module('accounting/fee_groups');
		//$this->load->module('accounting/fee_types');
		//$this->load->module('accounting/fee_structures');
		//$this->load->module('setting/payment_modes');
		//$this->load->module('library/book_categories');
		// $this->load->module('library/book_sources');
		//$this->load->module('library/books');
		//$this->load->module('library/book_issues');
		// $this->load->module('accounting/invoices');
		// $this->load->module('employees');
		// $this->load->module('office/department');
		// $this->load->module('office/designation');
		// $this->load->module('office/pay_grade');
		// $this->load->module('office/salary_component');
		// $this->load->module('office/employment_type');
		// $this->load->module('office/work_shift');
		// $this->load->module('office/leave_type');
		// $this->load->module('office/bank');
		// $this->load->module('office/payment_mode');
		// $this->load->module('office/holiday_list');
		// $this->load->module('routines');
		// $this->load->module('office/attributes');

	}
}