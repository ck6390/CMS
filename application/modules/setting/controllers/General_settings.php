<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
 * ERP
 *
 * @author		Amit Kumar
 * @copyright	Copyright (c) 2018
 */

/**
 * Class General_settings 
 */

class General_settings extends Base_Controller
{
	/**
	 * companys_Controller Constructor.
	 */
	function __construct()
	{
		// call the controller constructor
		parent::__construct();
		$this->load->model('general_setting', 'mdl_general_setting');
		$this->load->module('setting/semesters');
		$this->load->library('file');
	}

	/**
	 * [Fetch all bank list.]
	 * @param  void
	 * @return void
	 */
	public function index()
	{
		$data['lists'] = $this->mdl_general_setting->get_all();
		$this->template->set('title', 'Company List');
		$this->template->load('template', 'contents', 'settings/setting_list', $data);
	}

	/**
	 * [Insert a new company record.]
	 * @param  void
	 * @return void
	 */
	public function add()
	{
		$this->form_validation->set_rules('institute-id', 'institute id', 'required|trim|is_unique[settings.inst_id]');
		$this->form_validation->set_rules('institute-name', 'institute name', 'required|trim');
		$this->form_validation->set_rules('address', 'address', 'required|trim');
		$this->form_validation->set_rules('city', 'city', 'required|trim');
		$this->form_validation->set_rules('state', 'state', 'required|trim');
		$this->form_validation->set_rules('pincode', 'pincode', 'required|trim|regex_match[/^[0-9]{6}$/]');
		$this->form_validation->set_rules('phone-1', 'primary phone', 'required|trim|regex_match[/^[0-9]{10}$/]');
		$this->form_validation->set_rules('phone-2', 'secondary phone', 'regex_match[/^[0-9]{10}$/]');
		$this->form_validation->set_rules('fax', 'fax', 'regex_match[/^[0-9]{10}$/]');
		$this->form_validation->set_rules('email', 'email id', 'required|trim|valid_email');
		
		if($this->form_validation->run() == false) {	
			$data['lastId'] = $this->mdl_general_setting->get_next_id();
			$this->template->set('title', 'Add Institute');
			$this->template->load('template', 'contents', 'settings/setting_add', $data);
		} else {

			if(!empty($_FILES['logo']['name'])) {
				$config = array(
					'upload_path' => "assets/img/institute",
					'log_threshold' => 1,
					'allowed_types' => "jpg|jpeg|png|JPG|JPEG|PNG",
					'max_size' => 1000,
					'encrypt_name' => true,
					'remove_spaces' => true,
					'detect_mime' => true,
					'overwrite' => false
				);
				$this->load->library('upload', $config);
				$this->upload->do_upload('logo');
				$file = $this->upload->data();
				$logo = $file['file_name'];
			}
			$post = $this->input->post(null, true);
			$cleanPost = $this->security->xss_clean($post);
			$formData = array(
				'inst_id' => $cleanPost['institute-id'],
				'inst_name' => $cleanPost['institute-name'],
				'inst_affiliation_no' => $cleanPost['affiliation-no'] ? $cleanPost['affiliation-no']:null, 
				'inst_address' => $cleanPost['address'],
				'inst_city' => $cleanPost['city'],
				'inst_state' => $cleanPost['state'],
				'inst_pincode' => $cleanPost['pincode'],
				'inst_country' => $cleanPost['country'] ? $cleanPost['country']:null,
				'inst_phone' => $cleanPost['phone-1'],
				'inst_phone_2' => $cleanPost['phone-2'] ? $cleanPost['phone-2']:null,
				'inst_fax' => $cleanPost['fax'] ? $cleanPost['fax']:null,
				'inst_email' => $cleanPost['email'],
				'inst_website' => $cleanPost['website'] ? $cleanPost['website']:null,			
				'inst_term' => $cleanPost['terms-condition'] ? $cleanPost['terms-condition']:null,
				'inst_logo' => $logo,
				'grace_time' => $cleanPost['grace_time'],
			);

			// insert to database
			if($this->mdl_general_setting->insert($formData) == true) {
				$this->session->set_flashdata('success', 'Success, New Institute has been added!');
			} else {
				$this->session->set_flashdata('error', 'Error, Can\'t add new institute.');
			}
			redirect('setting/general_settings', 'refresh');
		}
	}

	/**
	 * [Edit companies detail and update.]
	 * @param  int $id [primary key]
	 * @return void
	 */
	public function edit($id)
	{

		$this->form_validation->set_rules('institute-name', 'institute name', 'required|trim');
		$this->form_validation->set_rules('address', 'address', 'required|trim');
		$this->form_validation->set_rules('city', 'city', 'required|trim');
		$this->form_validation->set_rules('state', 'state', 'required|trim');
		$this->form_validation->set_rules('pincode', 'pincode', 'required|trim|regex_match[/^[0-9]{6}$/]');
		$this->form_validation->set_rules('phone-1', 'primary phone', 'required|trim|regex_match[/^[0-9]{10}$/]');
		$this->form_validation->set_rules('phone-2', 'secondary phone', 'regex_match[/^[0-9]{10}$/]');
		$this->form_validation->set_rules('fax', 'fax', 'regex_match[/^[0-9]{10}$/]');
		$this->form_validation->set_rules('email', 'email id', 'required|trim|valid_email');
		
		if($this->form_validation->run() == false) {
			$data['info'] = $this->mdl_general_setting->get($id);
			$this->template->set('title', 'Edit institute');
			$this->template->load('template', 'contents', 'settings/setting_edit', $data);
		} else {
			
			if(!empty($_FILES['logo']['name'])) {
				$config = array(
					'upload_path' => "assets/img/institute",
					'log_threshold' => 1,
					'allowed_types' => "jpg|jpeg|png|JPG|JPEG|PNG",
					'max_size' => 1000,
					'encrypt_name' => true,
					'remove_spaces' => true,
					'detect_mime' => true,
					'overwrite' => false
				);
				$this->load->library('upload', $config);
				$this->upload->do_upload('logo');
				$file = $this->upload->data();
				$logo = $file['file_name'];
			}else{
				$logo = $this->input->post('previous-logo');
			}
			
			$post = $this->input->post(NULL, TRUE);
			$cleanPost = $this->security->xss_clean($post);
			$formData = array(

				'inst_name' => $cleanPost['institute-name'],
				'inst_affiliation_no' => $cleanPost['affiliation-no'] ? $cleanPost['affiliation-no']:null, 
				'inst_address' => $cleanPost['address'],
				'inst_city' => $cleanPost['city'],
				'inst_state' => $cleanPost['state'],
				'inst_pincode' => $cleanPost['pincode'],
				'inst_country' => $cleanPost['country'] ? $cleanPost['country']:null,
				'inst_phone' => $cleanPost['phone-1'],
				'inst_phone_2' => $cleanPost['phone-2'] ? $cleanPost['phone-2']:null,
				'inst_fax' => $cleanPost['fax'] ? $cleanPost['fax']:null,
				'inst_email' => $cleanPost['email'],
				'inst_website' => $cleanPost['website'] ? $cleanPost['website']:null,			
				'inst_term' => $cleanPost['terms-condition'] ? $cleanPost['terms-condition']:null,
				'inst_logo' => $logo,
				'grace_time' => $cleanPost['grace_time'],
			);

			
			// insert to database
			if($this->mdl_general_setting->updateInstitute($formData, $id) == true) {
				$this->session->set_flashdata('success', 'Success, Institute detail has been updated!');
			} else {
				$this->session->set_flashdata('error', 'Error, Can\'t update new institute.');
			}
			redirect('setting/general_settings', 'refresh');
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
		if($this->mdl_general_setting->update($data, $id) == true) {
			$this->session->set_flashdata('success', "Success, Activated successfully!");
		} else {
			$this->session->set_flashdata('error', "Error, Can't activate!");
		}
		redirect('setting/general_settings', 'refresh');
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
		if($this->mdl_general_setting->update($data, $id) == true) {
			$this->session->set_flashdata('success', "Success, Deactivated successfully!");
		} else {
			$this->session->set_flashdata('error', "Error, Can't deactivate!");
		}
		redirect('setting/general_settings', 'refresh');
	}

	/**
	 * [Delete record from table.]
	 * @param  int $id [primary key]
	 * @return boolean
	 */
	public function delete()
	{
		$id = $this->input->post('primary_id');
		if($this->mdl_general_setting->delete($id) == true) {
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
		if($this->mdl_general_setting->force_delete($id) == true) {
			$this->session->set_flashdata('success', 'DELETED!');
		} else {
			$this->session->set_flashdata('error', 'ERROR!');
		}
		redirect('setting/general_settings', 'refresh');
	}
}

/* End of file Companies.php */
/* Location: ./application/modules/companies/controllers/Companies.php */