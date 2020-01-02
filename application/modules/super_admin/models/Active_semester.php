<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
 * Ganga Memorial CMS
 *
 * @author		Manoj Kumar
 * @copyright	Copyright (c) 2019
 */

/**
 * Class Active_semester
 */

class Active_semester extends Base_Model
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
	protected $_primary_key = 'id';
	protected $_table = 'active_semesters';
	
	public function semester_list($id = null)
	{
		$data = array(

				'ASMSTR.deleted' => '0'
		);
		$this->db->select('ASMSTR.*,SMSTR.semester_name,SSN.session_name');
		$this->db->from('active_semesters AS ASMSTR');
		$this->db->join("semesters AS SMSTR", "SMSTR.semester_p_id = ASMSTR.fk_semester_id");
		$this->db->join("sessions AS SSN", "SSN.session_p_id = ASMSTR.fk_session_id");
		$this->db->where($data);
		if($id!= null){
         $this->db->where('ASMSTR.id = "'.$id.'"' );   
        }
		$this->db->order_by('ASMSTR.created_on', 'DESC');
		return $this->db->get()->result();
	}
}

/* End of file Active_semester.php */
/* Location: ./application/modules/super_admin/models/Active_semester.php */
