<?php

defined('BASEPATH') OR exit('No direct script access allowed');



/*

 * @author		Amit Kumar

 * @copyright	Copyright (c) 2018

 */



/**

 * Class Main

 */



class Main extends CI_Controller

{



	public function __construct()

	{

		// controller constructor

		parent::__construct();

		$this->load->library('auth');

		$this->form_validation->set_error_delimiters('<div class="custom-label label-danger">', '</div>');		

		

	}



	/**

	 * login

	 */

	public function index()

	{

		$this->CI =& get_instance();

		$this->CI->load->view('index_login');

	}



	public function login($roll_id = null)

	{

		$zitmz_23_view_load = @file_get_contents($this->config->item('api_url').$this->config->item('licence_key'));		

		//var_dump($zitmz_23_view_load);

		//die;

		$ajx_dat_23 = json_decode($zitmz_23_view_load,true);

		if($ajx_dat_23['status'] == $this->config->item('status')){

			if(strtotime($ajx_dat_23['end_date']) >= strtotime(date('Y-m-d'))){

				$data = array();		

				if($_POST) {

					$xder = $ajx_dat_23['status'];				

					$end_date = $ajx_dat_23['end_date'];				

					$data = $this->auth->login($_POST,$xder,$end_date);

				}

				$data['roll_id'] = $roll_id;

				return $this->auth->showLoginForm($data);

			}else{

				$data['roll_id'] = $roll_id;

				$this->session->set_flashdata('error', $ajx_dat_23['exp_msg']);

				return $this->auth->showLoginForm($data);

			}

		}else{

			$data['roll_id'] = $roll_id;

			$this->session->set_flashdata('error', "Invalid API");

			return $this->auth->showLoginForm($data);

		}

		

	}



	/**

	 * logout

	 */

	public function logout()

	{

        $this->auth->logout();

        redirect('main');

    }



}

