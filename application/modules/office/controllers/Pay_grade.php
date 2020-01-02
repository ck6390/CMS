<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
 * ERP
 *
 * @author		Amit Kumar
 * @copyright	Copyright (c) 2018
 */

/**
 * Class Pay_grade
 */

class Pay_grade extends Base_Controller
{
	/**
	 * Pay_grade_Controller constructor.
	 */
	public function __construct()
	{
		// controller constructor
		parent::__construct();
		$this->load->model('Mdl_pay_grade', 'mdl_pay_grade');
	}

	/**
	 * list
	 * @param $id
	 */
	public function index()
	{
		$data['lists'] = $this->mdl_pay_grade->get_all();
		$this->template->set('title', 'Pay Grade List');
		$this->template->load('template', 'contents', 'pay_grade/list', $data);
	}

	/**
	 * add
	 */
	public function add()
	{
		$this->form_validation->set_rules('grade-name', 'grade', 'required|trim|is_unique[salary_grade.grade_name]');
		$this->form_validation->set_rules('minimum-salary', 'minimum salary', 'required|trim');
		$this->form_validation->set_rules('maximum-salary', 'maximum salary', 'required|trim');

		if($this->form_validation->run() == FALSE)
		{
			$data['lists'] = $this->mdl_pay_grade->get_all();
			$this->template->set('title', 'Add Pay Grade');
			$this->template->load('template', 'contents', 'pay_grade/add', $data);
		}
		else
		{
			
			$post = $this->input->post(NULL, TRUE);
			$cleanPost = $this->security->xss_clean($post);
			$formData = array(
				'grade_name' => $cleanPost['grade-name'],
				'min_salary' => $cleanPost['minimum-salary'],
				'max_salary' => $cleanPost['maximum-salary'],
				'description' => $cleanPost['description'] ? $cleanPost['description']:null
			);
			// insert to database
			if($this->mdl_pay_grade->insert($formData) == true)
			{
				$this->session->set_flashdata('success', 'Success, New pay grade has been added!');
			}
			else
			{
				$this->session->set_flashdata('danger', 'Error, Can\'t add new pay grade!');
			}
			redirect('office/pay_grade', 'refresh');
		}
	}

	/**
	 * edit
	 * @param $id
	 */
	public function edit($id) 
	{
		$this->form_validation->set_rules('grade-name', 'grade', 'required|trim');
		$this->form_validation->set_rules('minimum-salary', 'minimum salary', 'required|trim');
		$this->form_validation->set_rules('maximum-salary', 'maximum salary', 'required|trim');

		if($this->form_validation->run() == FALSE)
		{
			$data['info'] = $this->mdl_pay_grade->get($id);
			$this->template->set('title', 'Edit Pay Grade');
			$this->template->load('template', 'contents', 'pay_grade/edit', $data);
		}
		else
		{
			$post = $this->input->post(NULL, TRUE);
			$cleanPost = $this->security->xss_clean($post);
			$formData = array(
				'grade_name' => $cleanPost['grade-name'],
				'min_salary' => $cleanPost['minimum-salary'],
				'max_salary' => $cleanPost['maximum-salary'],
				'description' => $cleanPost['description'] ? $cleanPost['description']:null
			);
			// update to database
			if($this->mdl_pay_grade->update($formData, $id) == true)
			{
				$this->session->set_flashdata('success', 'Success, Pay grade has been updated!');
			}
			else
			{
				$this->session->set_flashdata('error', 'Error, Can\'t update the pay grade.');
			}
			redirect('office/pay_grade', 'refresh');
		}
	}

	/**
	 * activate
	 * @param $id
	 */
	public function activate($id)
	{
		$data = array(
			'is_active' => '1'
		);
		if($this->mdl_pay_grade->update($data, $id) == true)
		{
			$this->session->set_flashdata('success', 'Success, Activated successfully!');
		}
		else
		{
			$this->session->set_flashdata('success', 'Error, Can\'t activate!');
		}
		redirect('office/pay_grade', 'refresh');
	}

	/**
	 * deactivate
	 * @param $id
	 */
	public function deactivate($id)
	{
		$data = array(
			'is_active' => '0'
		);
		if($this->mdl_pay_grade->update($data, $id) == true)
		{
			$this->session->set_flashdata('success', 'Success, Deactivated successfully!');
		}
		else
		{
			$this->session->set_flashdata('success', 'Error, Can\'t deactivate!');
		}
		redirect('office/pay_grade', 'refresh');
	}

	/**
	 * delete
	 * @param $id
	 */
	public function delete()
	{
		$id = $this->input->post('primary_id');
		if($this->mdl_pay_grade->delete($id) == true)
		{
			echo true;
		}
		else
		{
			echo false;
		}
	}
}

/* End of file Pay_grade.php */
/* Location: ./application/modules/office/controllers/Pay_grade.php */