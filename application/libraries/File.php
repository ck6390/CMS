<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
 * Ganga Memorial CMS
 *
 * @author      Amit Kumar
 * @copyright   Copyright (c) 2018
 */

/**
 * Class File_upload
 */

class File
{
	/*
	|--------------------------------------------------------------------------
	| Misc Library
	|--------------------------------------------------------------------------
	|
	| This Library handles miscellaneous functions for the application.
	|
	*/

	protected $CI;

	public function __construct()
	{
		// constructor
		$this->CI =& get_instance();
	}

	/**
	 * Re-Uploading students documents.
	 * @param  array  $newFile [new uploaded files]
	 * @param  array  $oldFile [old uploaded files]
	 * @param  array  $config  [configuration array]
	 * @param  string $folder  [folder name]
	 * @param  int    $id  	   [primary key]
	 * @return array  $name
	 */
	function fileUpload($newFile, $oldFile, $config, $folder, $id)
	{
		$name = '';
		$this->CI->load->library('upload');
		foreach ($newFile as $newFileKey => $newFilevalue) {
			if($oldFile != null) {
				foreach ($oldFile as $oldFileKey => $oldFilevalue) {
					if(!empty($newFilevalue) && !empty($oldFilevalue)) {
						if($newFileKey == $oldFileKey) {
							if(file_exists("assets/img/students/{$oldFilevalue}")) {
								unlink("assets/img/students/{$oldFilevalue}");
							}
						}
					}
				}
			}
			
			if(!empty($newFilevalue)) {
				$config['file_name'] = $newFileKey;
				$this->CI->upload->initialize($config);
				print_r($newFileKey);
				if($this->CI->upload->do_upload($newFileKey)) {
					$data = $this->CI->upload->data();
					$name[$newFileKey] = "{$folder}/{$data['file_name']}";
				} else {
					$error = $this->CI->upload->display_errors();
					$this->CI->session->set_flashdata('warning', "$error");
					if($id == null) {
						redirect("students/add", "refresh");
					} else {
						redirect("students/edit/{$id}", "refresh");
					}
				}
			}
		}
		return $name;
	}
}

/* End of file Misc.php */
/* Location: ./application/libraries/Misc.php */