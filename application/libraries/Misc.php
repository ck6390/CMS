<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
 * ERP
 *
 * @author      Amit Kumar
 * @copyright   Copyright (c) 2018
 */

/**
 * Class Misc
 */

class Misc
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
	public $variable;
	public $skey = 'EP8UHMv3b0InvtG3J5ioSqV77H63B0tt'; // you can change it

	public function __construct()
	{
		// constructor
		$this->CI =& get_instance();
	}

	/**
	 * Get class name from route/url
	 */
	function _getClassName()
	{
		return $this->CI->router->class;
	}

	function _getMethodName()
	{
		return $this->CI->router->method;
	}

	function encode($string)
	{
		$data = base64_encode($string);
		$data = str_replace(array('+', '/', '='), array('-', '_', ''), $data);
		return $data;
	}

	function decode($string)
	{
		$data = str_replace(array('-', '_'), array('+', '/'), $string);
		$mod4 = strlen($data) % 4;
		if ($mod4) {
			$data .= substr('====', $mod4);
		}
		return base64_decode($data);
	}


	function isEditPage()
	{
		return $this->_getMethodName()=="view"?true:false;
	}

	function btnSaveText()
	{
		$className=$this->_getClassName();
		return $this->_getMethodName()=='add'?'add '.$className:'edit '.$className;
	}

	function userField()
	{
		return $this->_getMethodName()=="add"?'enabled':'disabled';
	}

	function isInClass($items)
	{
		return in_array($this->getClassName(), $items);
	}

	function getShortText($str,$len=100)
	{
		if (strlen($str) > $len)
		{
			return mb_substr($str, 0, $len, 'UTF-8').' ...';
		}
		else
		{
			return $str;
		}
	}

	function startsWith($haystack, $needle)
	{
		$length = strlen($needle);
		return (substr($haystack, 0, $length) === $needle);
	}

	function endsWith($haystack, $needle)
	{
		$length = strlen($needle);
		if ($length == 0) {
			return true;
		}
		return (substr($haystack, -$length) === $needle);
	}

	function budDateToChrsDate($date, $delimits = '-', $delimit = '') {
		if ($date == "") return "";
		if ($delimit == '') $delimit = $delimits;
		list($m, $d, $y) = explode($delimits, $date);
		return $d . $delimit . $m . $delimit . $y;
	}

	function chrsDateToBudDate($date, $delimits = '-', $delimit = '') {
		if ($date == "") return "";
		if ($delimit == '') $delimit = $delimits;
		list($y, $m, $d) = explode($delimits, $date);
		return $d . $delimit . $m . $delimit . $y;
	}

	/**
	 * [reformatDate description]
	 * @param  string|date $strdate [input date]
	 * @param  string $mask [date mask]
	 * @return mixed
	 */
	function reformatDate($strdate, $mask="d/m/Y")
	{
		return (date($mask, strtotime($strdate)));
	}

	function reformatDate2($strdate)
	{
		return (date('D, d M, Y h:i A', substr($strdate,0,10)));
	}

	function getFullDate($strdate)
	{
		$day_arr=array("Sunday","Monday","Tuesday","Wednesday","Thursday","Friday","Saturday");
		$month_arr=array(
			"0" => "", "1" => "January", "2" => "February", "3" => "March",
			"4" => "April", "5" => "May", "6" => "June",
			"7" => "July", "8" => "August", "9" => "September",
			"10" => "October", "11" => "November", "12" => "December"
		);
		$strdate = strtotime($strdate);
		$Date = "Day ".$day_arr[date("w",$strdate)];
		$Date.= "at ".date("j",$strdate);
		$Date.= " ".$month_arr[date("n",$strdate)];
		$Date.= " .".(date("and",$strdate)+543);
		return $Date;
	}

	//////////////////////////////////////////////////////////////////////
	// PARA: Date Should In YYYY-MM-DD Format
	// RESULT FORMAT:
	// '%y Year %m Month %d Day %h Hours %i Minute %s Seconds' => 1 Year 3 Month 14 Day 11 Hours 49 Minute 36 Seconds
	// '%y Year %m Month %d Day'            =>  1 Year 3 Month 14 Days
	// '%m Month %d Day'                    =>  3 Month 14 Day
	// '%d Day %h Hours'                    =>  14 Day 11 Hours
	// '%d Day'                             =>  14 Days
	// '%h Hours %i Minute %s Seconds'      =>  11 Hours 49 Minute 36 Seconds
	// '%i Minute %s Seconds'               =>  49 Minute 36 Seconds
	// '%h Hours                            =>  11 Hours
	// '%a Days                             =>  468 Days
	//////////////////////////////////////////////////////////////////////
	function dateDifference($date_1 , $date_2 )
	{
		$datetime1 = date_create($date_1);
		$datetime2 = date_create($date_2);

		$interval = date_diff($datetime1, $datetime2);

		$unit = array(
			'year' => 'Year',
			'month' => 'Month',
			'day' => 'Day',
			'hours' => 'Hours',
			'minutes' => 'Minutes',
			'seconds' => 'Seconds'
		);
		$text = "";
		if ($interval->y > 0) $text .= " %y $unit[year] ";
		if ($interval->m > 0) $text .= " %m $unit[month] ";
		if ($interval->d > 0) $text .= " %d $unit[day] ";
		if ($interval->h > 0) $text .= " %h $unit[hours]";
		if ($interval->i > 0) $text .= " %i $unit[minutes]";
		if ($interval->s > 0
			&& $interval->i == 0
			&& $interval->h == 0
			&& $interval->d == 0
			&& $interval->m == 0
			&& $interval->y == 0) $text .= " %s $unit[seconds]";

		return $interval->format($text);
	}




    function get_week_days() {
        
        return array(
            
            'Monday' => 'Monday',
            'Tuesday' => 'Tuesday',
            'Wednesday' => 'Wednesday',
            'Thursday' => 'Thursday',
            'Friday' => 'Friday',
            'Saturday' => 'Saturday',
            'Sunday' => 'Sunday'
        );
    }

    function convertToIndianCurrency($number) {
	    $no = round($number);
	    $decimal = round($number - ($no = floor($number)), 2) * 100;    
	    $digits_length = strlen($no);    
	    $i = 0;
	    $str = array();
	    $words = array(
	        0 => '',
	        1 => 'One',
	        2 => 'Two',
	        3 => 'Three',
	        4 => 'Four',
	        5 => 'Five',
	        6 => 'Six',
	        7 => 'Seven',
	        8 => 'Eight',
	        9 => 'Nine',
	        10 => 'Ten',
	        11 => 'Eleven',
	        12 => 'Twelve',
	        13 => 'Thirteen',
	        14 => 'Fourteen',
	        15 => 'Fifteen',
	        16 => 'Sixteen',
	        17 => 'Seventeen',
	        18 => 'Eighteen',
	        19 => 'Nineteen',
	        20 => 'Twenty',
	        30 => 'Thirty',
	        40 => 'Fourty',
	        50 => 'Fifty',
	        60 => 'Sixty',
	        70 => 'Seventy',
	        80 => 'Eighty',
	        90 => 'Ninety');
	    $digits = array('', 'Hundred', 'Thousand', 'Lakh', 'Crore');
	    while ($i < $digits_length) {
	        $divider = ($i == 2) ? 10 : 100;
	        $number = floor($no % $divider);
	        $no = floor($no / $divider);
	        $i += $divider == 10 ? 1 : 2;
	        if ($number) {
	            $plural = (($counter = count($str)) && $number > 9) ? 's' : null;            
	            $str [] = ($number < 21) ? $words[$number] . ' ' . $digits[$counter] . $plural : $words[floor($number / 10) * 10] . ' ' . $words[$number % 10] . ' ' . $digits[$counter] . $plural;
	        } else {
	            $str [] = null;
	        }  
	    }
	    
	    $Rupees = implode(' ', array_reverse($str));
	    $paise = ($decimal) ? "And" . ($words[$decimal - $decimal%10]) ." " .($words[$decimal%10])  ." Paise ": '';
	    return ($Rupees ?  $Rupees. 'Rupees ' : '') . $paise . " Only";
	}



    function isWeekend($date) {
    	return in_array(date("l"), ["Saturday", "Sunday"]);
    	//return (date('N', strtotime($date)) >= 6);
	    // $weekDay = date('w', strtotime($date));
	    // return ($weekDay == 0 || $weekDay == 6);
	}

	function isThisDayAWeekend($date) {

    $timestamp = strtotime($date);

    $weekday= date("l", $timestamp );

    //if ($weekday =="Saturday" OR $weekday =="Sunday") { return true; } 
    if ($weekday =="Sunday") { return true; } 
    else {return false; }

}

	function hostelFine($date)
	{
		
		$pastDate = date_parse_from_format("Y-m-d", $date);
		$pastDate["month"];
		//$pastDate["year"];
		//var_dump($pastDate["year"]);
		$currentDate = date('Y-m-d');
		$currentmonth = date_parse_from_format("Y-m-d", $currentDate);
		//$currentmonth['year']
		$Date =date('Y-m-01');
		$firstFineDate = date('Y-m-d', strtotime($Date. ' + 10 days')); 

		$secondFineDate = date('Y-m-d', strtotime($Date. ' + 15 days')); 

		$thirdFineDate =date('Y-m-d', strtotime($Date. ' + 20 days')); 

		$fourthFineDate = date('Y-m-d', strtotime($Date. ' + 25 days')); 
		if($pastDate["year"] <= $currentmonth['year']){
			if($pastDate["month"] > $currentmonth["month"]){
				return 0.00;
			}
			elseif ($pastDate["month"] < $currentmonth["month"]){
			    return 400.00;
			}elseif($currentDate >= $firstFineDate && $currentDate < $secondFineDate){
			    return 100.00; 
			}elseif($currentDate >= $secondFineDate && $currentDate < $thirdFineDate){
				return 200.00;
			}elseif($currentDate >= $thirdFineDate && $currentDate < $fourthFineDate){
				return 300.00;
			}elseif($currentDate > $fourthFineDate){
				return 400.00;
			}
		}else{
			return 0.00;
		}
		
		
		
		$pastDate = date_parse_from_format("Y-m", $date);
		
	}

	function get_months()
	{
		return array(
		    '01'=>'January',
		    '02'=>'February',
		    '03'=>'March',
		    '04'=>'April',
		    '05'=>'May',
		    '06'=>'June',
		    '07'=>'July ',
		    '08'=>'August',
		    '09'=>'September',
		    '10'=>'October',
		    '11'=>'November',
		    '12'=>'December',
		);
	}	
}

/* End of file Misc.php */
/* Location: ./application/libraries/Misc.php */
