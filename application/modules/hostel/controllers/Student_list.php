<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
 * Ganga Memorial CMS
 *
 * @author		Amit Kumar
 * @copyright	Copyright (c) 2019
 */

/**
 * Class Student_list
 */

class Student_list extends Base_Controller
{
	/**
	 * Students_Controller constructor.
	 */
	public function __construct()
	{
		// controller constructor
		parent::__construct();
		$this->load->model('student', 'mdl_student');
	}

	/**
	 * Fetch all Students list.
	 * @return void [load view page]
	 */
	public function index()
	{
		$data['lists'] = $this->mdl_student->get_all();
		$this->template->set('title', 'Student Hostel List');
		$this->template->load('template', 'contents', 'student_hostel/student_hostel_list', $data);
	}

	public function profile($id)
	{
		$this->template->set('title', 'Hostel Student Profile');
		$data['info'] = $this->mdl_student->get($id);
		$this->template->load('template', 'contents', 'student_hostel/student_hostel_profile',$data);
	}

	public function fee_fine($id)
	{	
		$this->template->set('title', 'Student Fee/Fine');
		$data['info'] = $this->mdl_student->get($id);
		$data['lists'] = $this->mdl_student->get_fine_list($id);

		$this->template->load('template', 'contents', 'student_hostel/student_hostel_fee_fine_add',$data);
	}
}

/* End of file Student_list.php */
/* Location: ./application/modules/hostel/controllers/Student_list.php */
