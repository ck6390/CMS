<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
 * ERP
 *
 * @author      Amit Kumar
 * @copyright   Copyright (c) 2018
 */

/**
 * Class M_pdf
 */

include_once APPPATH.'/third_party/mpdf/mpdf.php';
class M_pdf
{
	/*
	|--------------------------------------------------------------------------
	| PDF Library
	|--------------------------------------------------------------------------
	|
	| mPDF is a PHP library which generates PDF files from UTF-8 encoded HTML.
	|
	*/

    public $param;
    public $pdf;
 
    public function __construct($param = '"en-GB-x","A4","","",10,10,10,10,6,3')
    {
		// constructor
        $this->param =$param;
        $this->pdf = new mPDF($this->param);
    }
}

/* End of file M_pdf.php */
/* Location: ./application/libraries/M_pdf.php */