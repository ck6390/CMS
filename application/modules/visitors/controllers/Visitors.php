<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
 * Ganga Memorial CMS
 *
 * @author		Manoj Kumar
 * @copyright	Copyright (c) 2019
 */

/**
 * Class Visitors
 */

class Visitors extends Base_Controller
{
	/**
	 * Fees_Controller constructor.
	 */
	public function __construct()
	{
		// controller constructor
		parent::__construct();
		$this->load->model('visitor', 'mdl_visitor');
		$this->load->model('admin/role', 'mdl_role');
		$this->load->model('admin/user', 'mdl_user');
		
	}

	/**
	 * [Fetch all Fee list.]
	 * @param  void
	 * @return view
	 */
	public function index()
	
	{	
		
		$data['lists'] = $this->mdl_visitor->get_all();
		$this->template->set('title', 'Visitor List');
		$this->template->load('template', 'contents', 'list', $data);
	}

	/**
	 * [Insert a new Fees record.]
	 * @param  void
	 * @return redirect
	 */
	public function add()
	{	
		
		$this->form_validation->set_rules('name', 'name', 'required|trim');
		$this->form_validation->set_rules('phone', 'phone', 'required|trim');
		$this->form_validation->set_rules('comming-from', 'comming from', 'required|trim');
		$this->form_validation->set_rules('to-meet', 'to-meet', 'required|trim');
		$this->form_validation->set_rules('user-role', 'user-role', 'required|trim');
		
		
			
		if($this->form_validation->run() == false) {
			$this->template->set('title', 'Add Visitor Info');
			$this->template->load('template', 'contents', 'add');
		} else {
			$post = $this->input->post(NULL, TRUE);
			$cleanPost = $this->security->xss_clean($post);

			$formData = array(
						
				'name' => $cleanPost['name'],
				'phone' => $cleanPost['phone'],
				'comming_from' => $cleanPost['comming-from'],
				'to_meet' => $cleanPost['to-meet'],
				'discription' => $cleanPost['message'] ? $cleanPost['message'] : null,
				
			);


			// insert to database
			if($this->mdl_visitor->insert($formData) == true) {

				$this->session->set_flashdata('success', "Success, Visitor Info has been added !");
			} else {
				$this->session->set_flashdata('danger', "Error, Can't added !");
			}
			redirect('visitors', 'refresh');
		}
	}

	/**
	 * [Fetch Student record from database.]
	 * @param  int $id [primary key]
	 * @return redirect
	 */
	public function userList($id)
	{
		$role_id = $id;

		switch ($role_id) {
		    case "8":
		        $list = $this->mdl_visitor->employee_list($role_id);
		        break;
		    case "10":
		        $list = $this->mdl_visitor->student_list();
		        break;
		    default:
		        $list = $this->mdl_visitor->administrator_list($role_id);
		}
		
		echo json_encode($list);
	}
	
	/**
	 * [Delete record from list.]
	 * @param  void
	 * @return boolean
	 */
	public function delete()
	{
		$id = $this->input->post('primary_id');
		if($this->mdl_visitor->delete($id) == true) {
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
		if($this->mdl_visitor->force_delete($id) == true) {
			$this->session->set_flashdata('success', 'DELETED!');
		} else {
			$this->session->set_flashdata('error', 'ERROR!');
		}
		redirect('visitors', 'refresh');
	}

	
}

/* End of file Invoices.php */
/* Location: ./application/modules/accounting/controllers/Invoices.php */