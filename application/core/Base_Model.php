<?php
/**
 * A base model with a series of CRUD functions (powered by CI's query builder)
 *
 * Create by Amit Kumar
 *
 * @link http://github.com/akamit21/Codeigniter3-HMVC-RBAC-Login-Module
 * @copyright Copyright (c) 2018, Amit Kumar <https://twitter.com/amitaldo>
 */

class Base_Model extends CI_Model
{
	/* --------------------------------------------------------------
	 * VARIABLES
	 * ------------------------------------------------------------ */

	/**
	 * This is model's default database table.
	 * Automatically guessed by pluralising the model name.
	 * [$_table]
	 * @var string
	 */
	protected $_table;

	/**
	 * This is model's default primary key or unique identifier.
	 * Used by the get(), update() and delete() functions.
	 * [$primary_key]
	 * @var [type]
	 */
	protected $_primary_key;

	/**
	 * This is model's default status key or status identifier.
	 * Used by the get() to fetch only active data.
	 * [$status_key]
	 * @var string
	 */
	protected $_status_key = 'is_active';

	/**
	 * [$_is_inactive]
	 * @var string
	 */
	protected $_is_inactive = '0';

	/**
	 * [$_is_active]
	 * @var string
	 */
	protected $_is_active = '1';

	/**
	 * This is model's deleted data status key or status identifier.
	 * Used by the get() to fetch only not deleted data.
	 * [$soft_delete_key]
	 * @var string
	 */
	protected $_soft_delete_key = 'deleted';

	/**
	 * [$_deleted]
	 * @var string
	 */
	protected $_deleted = '1';

	/**
	 * [$_not_deleted]
	 * @var string
	 */
	protected $_not_deleted = '0';

	/**
	 * Support for soft deletes and this is model's 'deleted' key
	 * [$soft_delete]
	 * @var boolean
	 */
	protected $_soft_delete = true;

	/**
	 * [$_temporary_with_deleted]
	 * @var string
	 */
	protected $_view_deleted = false;


	/* --------------------------------------------------------------
	 * GENERIC METHODS
	 * ------------------------------------------------------------ */

	/**
	 * Initialise the model, tie into the CodeIgniter superobject and
	 * try our best to guess the table name.
	 */
	public function __construct()
	{
		parent::__construct();
		$this->load->helper('inflector');
		$this->_fetch_table();
	}

	/**
	 * Fetch a single record based on the primary key. Returns an object.
	 * @param  int $primary_value [primary key]
	 * @return mixed
	 */
	public function get($primary_value)
	{
		return $this->get_by($this->_primary_key, $primary_value);
	}
	/**
	 * Fetch a single record based on the primary key multiple column fields. Returns an object.
	 * @param  int $primary_value [primary key]
	 * @return mixed
	 */
	public function get_fields($primary_value,$fields_name)
	{
		$where = func_get_args();
		if ($this->_soft_delete && $this->_view_deleted) {
			$this->db->where($this->_soft_delete_key, $this->_deleted);
		}
		$this->db->select($fields_name);
		$this->db->where($this->_primary_key, $primary_value);		
		return $this->db->get($this->_table)->row();
	}
	/**
	 * Fetch a single record based on an arbitrary WHERE call. Can be
	 * any valid value to $this->db->where().
	 * @param  void
	 * @return mixed
	 */
	public function get_by()
	{
		$where = func_get_args();
		if ($this->_soft_delete && $this->_view_deleted) {
			$this->db->where($this->_soft_delete_key, $this->_deleted);
		}
		$this->_set_where($where);
		return $this->db->get($this->_table)->row();
	}

	/**
	 * Fetch an array of records based on an array of primary values.
	 * @param  array $values [primary key array]
	 * @return mixed
	 */
	public function get_many($values)
	{
		$this->db->where_in($this->primary_key, $values);
		return $this->get_all();
	}

	/**
	 * Fetch an array of records based on an arbitrary WHERE call.
	 * @param  void
	 * @return mixed
	 */
	public function get_many_by()
	{
		$where = func_get_args();
		$this->_set_where($where);
		return $this->get_all();
	}

	/**
	 * Fetch all the records in the table. Can be used as a generic call
	 * to $this->db->get() with scoped methods.
	 * @return array [returns array of data]
	 */
	public function get_all()
	{	
		if ($this->_soft_delete && $this->_view_deleted) {
			$this->db->where($this->_soft_delete_key, $this->_deleted);
		} else {
			$this->db->where($this->_soft_delete_key, $this->_not_deleted);
		}

		return $this->db->get($this->_table)->result();

	}

	/**
	 * Insert a new row into the table. $data should be an associative array
	 * of data to be inserted. Returns newly created ID.
	 * @param  array $data [form input data]
	 * @return boolean
	 */
	public function insert($data)
	{
		if ($data != null) {
			$this->db->insert($this->_table, $data);
			if($this->db->affected_rows() != 1) {
				error_log('Error, Unable to insert data in table.');
				return false;
			}
			return true;
		} else {
			error_log('Error, Undefined variabled: $data');
			return false;
		}
	}

	/**
	 * Insert multiple rows into the table. Returns an array of multiple IDs.
	 * @param  array $data [form input data]
	 * @return boolean
	 */
	public function insertMany($data)
	{
		if ($data != null) {
			$ids = array();
			foreach ($data as $key => $row) {
				$ids[] = $this->insert($row, ($key == count($data) - 1));
			}
			return $ids;
		} else {
			error_log('Error, Undefined variabled: $data');
			return false;
		}
	}

	/**
	 * Updated a record based on the primary value.
	 * @param  array $data [form input data]
	 * @param  int $primary_value [primary key]
	 * @return boolean
	 */
	public function update($data, $primary_value)
	{
		if ($data != null) {
			$this->db->where($this->_primary_key, $primary_value)->set($data)->update($this->_table);
			if($this->db->affected_rows() != 1) {
				error_log('Error, Unable to update data in table.');
				return false;
			}
			return true;
		} else {
			error_log('Error, Undefined variabled: $data');
			return false;
		}
	}

	/**
	 * Update many records, based on an array of primary values.
	 * @param  array $data [form input data]
	 * @param  int $primary_values [primary key]
	 * @return boolean
	 */
	public function updateMany($data, $primary_values)
	{
		if ($data !== false) {
			$this->db->where_in($this->_primary_key, $primary_values)->set($data)->update($this->_table);
			if($this->db->affected_rows() == 0) {
				error_log('Error, Unable to update data in table.');
				return false;
			}
			return true;
		} else {
			return false;
		}
	}

	/**
	 * Updated a record based on an arbitrary WHERE clause.
	 * @param  void
	 * @return boolean
	 */
	public function update_byy()
	{
		$args = func_get_args();
		$data = array_pop($args);
		if ($data !== false) {
			$this->_set_where($args);
			$result = $this->db->set($data)->update($this->_table);
			return $result;
		} else {
			return false;
		}
	}

	/**
	 * Update all records
	 * @param  array $data [form input data]
	 * @return mixed
	 */
	public function updateAll($data)
	{
		return $this->db->set($data)->update($this->_table);
	}

	/**
	 * Delete a row from the table by the primary value
	 * @param  int $primary_value [primary key]
	 * @return boolean
	 */
	public function delete($primary_value)
	{
		if ($primary_value != null) {
			$this->db->where($this->_primary_key, $primary_value);
			if ($this->_soft_delete) {
				$this->db->update($this->_table, array($this->_soft_delete_key => '1', $this->_status_key => '0'));
				if($this->db->affected_rows() != 1) {
					error_log('Error, Unable to update row in table.');
					return false;
				}
				return true;
			} else {
				$this->db->delete($this->_table);
				if($this->db->affected_rows() != 1) {
					error_log('Error, Unable to delete row in table.');
					return false;
				}
				return true;
			}
		} else {
			error_log('Error, Undefined variabled: $primary_value');
			return false;
		}
	}

	/**
	 * Delete a row from the database table by an arbitrary WHERE clause
	 */
	public function delete_by()
	{
		$where = func_get_args();
		$this->_set_where($where);
		if ($this->soft_delete)
		{
			$this->db->update($this->_table, array($this->soft_delete_key => '1', $this->status_key => '0'));
			if($this->db->affected_rows() != 1)
			{
				error_log('Error, Unable to update row in table.');
				return false;
			}
			return true;
		}
		else
		{
			$this->db->delete($this->_table);
			if($this->db->affected_rows() != 1)
			{
				error_log('Error, Unable to delete row in table.');
				return false;
			}
			return true;
		}
	}
	/**
	 * Delete many rows from the database table by multiple primary values
	 */
	public function delete_many($primary_values)
	{
		if ($primary_values != NULL)
		{
			$primary_values = $this->trigger('before_delete', $primary_values);
			$this->db->where_in($this->primary_key, $primary_values);
			if ($this->soft_delete)
			{
				$this->db->update($this->_table, array( $this->soft_delete_key => '1', $this->status_key => '0'));
				if($this->db->affected_rows() != 1)
				{
					error_log('Error, Unable to update rows in table.');
					return false;
				}
				return true;
			}
			else
			{
				$this->db->delete($this->_table);
				if($this->db->affected_rows() != 1)
				{
					error_log('Error, Unable to delete rows in table.');
					return false;
				}
				return true;
			}
		}
		else
		{
			error_log('Error, Undefined variabled: $primary_values');
			return false;
		}
	}

	/**
	 * Delete a row permanently from the table by the primary value
	 * @param  int $primary_value [primary key]
	 * @return boolean
	 */
	public function force_delete($primary_value)
	{
		if ($primary_value != null) {
			$this->db->where($this->primary_key, $primary_value);
			$this->db->delete($this->_table);
			if($this->db->affected_rows() != 1) {
				error_log('Error, Unable to delete row in table.');
				return false;
			}
			return true;
		} else {
			error_log('Error, Undefined variabled: $primary_value');
			return false;
		}
	}

	/**
	 * Truncates the table
	 */
	public function truncate()
	{
		return $this->db->truncate($this->_table);
	}
	/* --------------------------------------------------------------
	 * UTILITY METHODS
	 * ------------------------------------------------------------ */
	/**
	 * Retrieve and generate a form_dropdown friendly array
	 */
	public function dropdown()
	{
		$args = func_get_args();
		if(count($args) == 2) {
			list($key, $value) = $args;
		} else {
			$key = $this->_primary_key;
			$value = $args[0];
		}
		$result = $this->db->select(array($key, $value))->where($this->_status_key, $this->_is_active)->get($this->_table)->result();
		$options = array();
		$options[''] = "== Please select one option ==";
		foreach ($result as $row) {
			$options[$row->{$key}] = $row->{$value};
		}
		return $options;
	}

	/**
	 * Fetch a count of rows based on an arbitrary WHERE call.
	 */
	public function count_by()
	{
		if ($this->soft_delete && $this->_temporary_with_deleted != '1') {
			$this->db->where($this->soft_delete_key, $this->_temporary_only_deleted);
		}
		$where = func_get_args();
		$this->_set_where($where);
		return $this->db->count_all_results($this->_table);
	}

	/**
	 * Fetch a total count of rows, disregarding any previous conditions
	 */
	public function count_all()
	{
		if ($this->soft_delete && $this->_temporary_with_deleted != '1') {
			$this->db->where($this->soft_delete_key, $this->_temporary_only_deleted);
		}
		return $this->db->count_all($this->_table);
	}

	/**
	 * Return the next auto increment of the table. Only tested on MySQL.
	 */
	public function get_next_id()
	{
		return (int) $this->db->select('AUTO_INCREMENT')
			->from('information_schema.TABLES')
			->where('TABLE_NAME', $this->_table)
			->where('TABLE_SCHEMA', $this->db->database)->get()->row()->AUTO_INCREMENT;
	}

	/**
	 * Getter for the table name
	 */
	public function table()
	{
		return $this->_table;
	}

	/* --------------------------------------------------------------
	 * GLOBAL SCOPES
	 * ------------------------------------------------------------ */
	/**
	 * Don't care about soft deleted rows on the next call
	 */
	public function with_deleted()
	{
		$this->_temporary_with_deleted = '1';
		return $this;
	}
	/**
	 * Only get deleted rows on the next call
	 */
	public function only_deleted()
	{
		$this->_temporary_only_deleted = '1';
		return $this;
	}

	/* --------------------------------------------------------------
	 * INTERNAL METHODS
	 * ------------------------------------------------------------ */
	/**
	 * Guess the table name by pluralising the model name
	 */
	private function _fetch_table()
	{
		if ($this->_table == null) {
			$this->_table = plural(preg_replace('/(_m|_model)?$/', '', strtolower(get_class($this))));
		}
	}

	/**
	 * Guess the primary key for current table
	 */
	private function _fetch_primary_key()
	{
		if($this->primary_key == null) {
			$this->primary_key = $this->db->query("SHOW KEYS FROM `".$this->_table."` WHERE Key_name = 'PRIMARY'")->row()->Column_name;
		}
	}

	/**
	 * Set WHERE parameters, cleverly
	 * @param  mixed $params [parameters]
	 * @return mixed
	 */
	protected function _set_where($params)
	{
		if (count($params) == 1 && is_array($params[0])) {
			foreach ($params[0] as $field => $filter) {
				if (is_array($filter)) {
					$this->db->where_in($field, $filter);
				} else {
					if (is_int($field)) {
						$this->db->where($filter);
					} else {
						$this->db->where($field, $filter);
					}
				}
			}
		}
		else if (count($params) == 1) {
			$this->db->where($params[0]);
		} else if(count($params) == 2) {
			if (is_array($params[1])) {
				$this->db->where_in($params[0], $params[1]);
			} else {
				$this->db->where($params[0], $params[1]);
			}
		} else if(count($params) == 3) {
			$this->db->where($params[0], $params[1], $params[2]);
		} else {
			if (is_array($params[1])) {
				$this->db->where_in($params[0], $params[1]);
			} else {
				$this->db->where($params[0], $params[1]);
			}
		}
	}

	/**
	 * get single value from table by id
	 * @param  mixed $params [parameters]
	 * @return mixed
	 */

	function get_single_value_by_id($table_name, $primary_id = '', $coloumn_value)
    {	

		if ($primary_id != '') {
			$table_row = $this->db->get_where($table_name."s", array(
                $table_name . '_p_id' => $primary_id
            ));
            return $table_row->row()->$coloumn_value;
            
            
        }
    }


    /**
	 * Fetch all the records with single coloumn value in the table. Can be used as a generic call
	 * to $this->db->get() with scoped methods.
	 * @return array [returns array of data]
	 */
	public function get_all_with_single_coloumn($value)
	{	
		if ($this->_soft_delete && $this->_view_deleted) {
			$this->db->where($this->_soft_delete_key, $this->_deleted);
		} else {
			$this->db->where($this->_soft_delete_key, $this->_not_deleted);
		}
		$this->db->select($value);
		return $this->db->get($this->_table)->result();

	}

	
}
