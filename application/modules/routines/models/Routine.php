<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
 * Ganga Memorial College
 *
 * @author		Vishwajeet Kumar	
 * @copyright	Copyright (c) 2019
 */

/**
 * Class Routine
 */

class Routine extends Base_Model
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
	protected $_table = 'routines';
	/**
	 * [$primary_key PRIMARY KEY]
	 * @var string
	 */
	protected $_primary_key = 'routine_p_id';

	public function get_routines_by_day($day, $semesterId, $branchId){

		$this->db->select('R.*');
        $this->db->from('routines AS R');
        //$this->db->join('subjects AS S', 'S.subject_p_id = R.cr_subject_id', 'left');
        //$this->db->join('employees AS EMP', 'EMP.emp_p_id = R.cr_teacher_id', 'left');
        $this->db->where('R.days', $day);
        $this->db->where('R.cr_semester_id', $semesterId);
        $this->db->where('R.cr_branch_id', $branchId);
        $this->db->order_by("R.routine_p_id", "ASC");
       	return $this->db->get()->result();
	}
}

/* End of file Routine.php */
/* Location: ./application/modules/navigations/models/Routine.php */