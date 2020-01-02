<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Temaplate View
 * Create by Amit Kumar
 * https://twitter.com/amitaldo
 * Github: https://github.com/akamit21
 * 2018
 * 
 */

class Template
{
	/*
	|--------------------------------------------------------------------------
	| Template Library
	|--------------------------------------------------------------------------
	|
	| This Library handles view part for the application and
	| loads custom layout page
	|
	*/

	var $template_data = array();
	
	/**
	 * Create content in template
	 *
	 * @param $content_area
	 * @param $template-variable
	 * @return void
	 */
	public function set($content_area, $value)
	{
		$this->template_data[$content_area] = $value;
	}
	
	/**
	 * Load template
	 *
	 * @param $template
	 * @param $name
	 * @param $view
	 * @param $view_data
	 * @return false
	 */
	public function load($template = '', $name ='', $view = '' , $view_data = array(), $return = FALSE)
	{
		$this->CI =& get_instance();
		$this->set($name , $this->CI->load->view($view, $view_data, TRUE));
		$this->CI->load->view('layouts/'.$template, $this->template_data);
	}

	/**
	 * Load Invoice template
	 *
	 * @param $template
	 * @param $name
	 * @param $view
	 * @param $view_data
	 * @return false
	 */
	public function load_invoice($template = '', $name ='', $view = '' , $view_data = array(), $return = FALSE)
	{
		$this->CI =& get_instance();
		$this->set($name , $this->CI->load->view($view, $view_data, TRUE));
		$this->CI->load->view($template, $this->template_data);
	}
}

/* End of file Template.php */
/* Location: ./application/libraries/Template.php */