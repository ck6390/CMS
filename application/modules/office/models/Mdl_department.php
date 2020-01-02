<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
 * ERP
 *
 * @author		Amit Kumar
 * @copyright	Copyright (c) 2018
 */

/**
 * Class Mdl_department
 */

class Mdl_department extends Base_Model
{	
	function __construct()
	{
		// call the model constructor
		parent::__construct();
	}
	/**
	 * [$_table TABLE NAME]
	 * @var string
	 */
	protected $_table = 'departments';
	/**
	 * [$primary_key PRIMARY KEY]
	 * @var string
	 */
	protected $_primary_key = 'dept_p_id';

	/**
	 * [Activate department and its designation.]
	 * @param  int $primary_value [primary]
	 * @return boolean
	 */
	public function activate_department($id)
	{
		if ($id != null) {
			$this->db->trans_begin();
			$data = array('is_active' => '1');
			$this->db->where('dept_p_id', $id)->set($data)->update('departments');
			if($this->db->affected_rows() == 1) {
				$this->db->where('dept_ID', $id)->set($data)->update('designations');
			}
			$this->db->trans_complete();

			if ($this->db->trans_status() == false) {
				$this->db->trans_rollback();
			} else {
				$this->db->trans_commit();
				return true;
			}
		} else {
			error_log('Error, Undefined variabled: $id');
			return false;
		}
	}

	/**
	 * [Deactivate department and its designation.]
	 * @param  int $primary_value [primary]
	 * @return boolean
	 */
	public function deactivate_department($id)
	{
		if ($id != null) {
			$this->db->trans_begin();
			$data = array('is_active' => '0');
			$this->db->where('dept_p_id', $id)->set($data)->update('departments');
			if($this->db->affected_rows() == 1) {
				$this->db->where('dept_ID', $id)->set($data)->update('designations');
			}
			$this->db->trans_complete();

			if ($this->db->trans_status() == false) {
				$this->db->trans_rollback();
			} else {
				$this->db->trans_commit();
				return true;
			}
		} else {
			error_log('Error, Undefined variabled: $id');
			return false;
		}
	}

	/**
	 * [Delete department and its designation.]
	 * @param  int $primary_value [primary]
	 * @return boolean
	 */
	public function delete_department($id)
	{
		if ($id != null) {
			$this->db->trans_begin();
			$data = array('deleted' => '1', 'is_active' => '0');
			$this->db->where('dept_p_id', $id)->set($data)->update('departments');
			if($this->db->affected_rows() == 1) {
				$this->db->where('dept_ID', $id)->set($data)->update('designations');
			}
			$this->db->trans_complete();

			if ($this->db->trans_status() == false) {
				$this->db->trans_rollback();
			} else {
				$this->db->trans_commit();
				return true;
			}
		} else {
			error_log('Error, Undefined variabled: $id');
			return false;
		}
	}
}

/* End of file Mdl_department.php */
/* Location: ./application/modules/office/models/Mdl_department.php */