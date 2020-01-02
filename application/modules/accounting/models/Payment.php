<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
 * ERP
 *
 * @author		Manoj Kumar
 * @copyright	Copyright (c) 2018
 */

/**
 * Class Purchase
 */

class Payment extends Base_Model
{	
	function __construct()
	{
		// call the model constructor
		parent::__construct();
		
	}
	protected $_primary_key = 'payment_p_id';


	function payable_amount($id){

		$this->db->select_sum('paid_amount');
		$this->db->join('invoices','invoices.invoice_p_id = payments.invoice_id');
		$this->db->where('payments.invoice_id',$id);
		$result = $this->db->get('payments')->row();  
		return $result->paid_amount;
	}

	 /////////GET NAME BY TABLE NAME AND ID/////////////
    function get_type_name_by_id($type, $type_id = '', $field = 'name')
    {
        if ($type_id != '') {
            $l = $this->db->get_where($type, array(
                $type . '_p_id' => $type_id
            ));
            $n = $l->num_rows();
            if ($n > 0) {
                return $l->row()->$field;
            }
        }
    }

}

/* End of file Payment.php */
/* Location: ./application/modules/purchases/models/Payment.php */