<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
 * ERP
 *
 * @author		Amit Kumar
 * @copyright	Copyright (c) 2018
 */

/**
 * Class Role
 */

class Role extends Base_Model
{	
	function __construct()
	{
		// call the model constructor
		parent::__construct();
	}
	/**
	 * [$primary_key PRIMARY KEY]
	 * @var string
	 */
	protected $_primary_key = 'role_p_id';

	/**
	 * Insert role into the table and role permission.
	 * @param  array $data [form input data]
	 * @param  array $permission [form input data]
	 * @return boolean
	 */
	public function insert_role($data, $permissions)
	{
		if ($data != null) {
			$this->db->trans_begin();
			$this->db->insert('roles', $data);
			if($this->db->affected_rows() == 1) {
				$lastID = $this->db->insert_id();
			}
			
			foreach ($permissions as $permission) {
				$this->db->insert('role_permission', array('role_ID' => $lastID, 'permission_ID' => $permission));
			}

			$this->db->trans_complete();
			if ($this->db->trans_status() == false) {
				$this->db->trans_rollback();
			} else {
				$this->db->trans_commit();
				return true;
			}
		} else {
			error_log('Error, Undefined variabled: $data');
			return false;
		}
	}

	/**
	 * Get all permissions assigned to a role.
	 * @param  int $id [primary key]
	 * @return mixed
	 */
	public function get_permission_by_role($id)
	{
		if ($id != null) {
			return $this->db->select('permission_ID')->where('role_ID', $id)->get('role_permission')->result();
		} else {
			error_log('Error, Undefined variabled: $id');
			return false;
		}
	}

	/**
	 * Update role into the table and role permission.
	 * @param  array $data [form input data]
	 * @param  array $permission [form input data]
	 * @param  int $id [primary key]
	 * @return boolean
	 */
	public function update_role($data, $permissions, $id)
	{
		if ($id != null) {
			$this->db->trans_begin();

			$this->db->where('role_p_id', $id)->set($data)->update('roles');
			$this->db->where('role_ID', $id)->delete('role_permission');
			foreach ($permissions as $permission) {
				$this->db->insert('role_permission', array('role_ID' => $id, 'permission_ID' => $permission));
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

/* End of file Role.php */
/* Location: ./application/modules/admin/roles/models/Role.php */