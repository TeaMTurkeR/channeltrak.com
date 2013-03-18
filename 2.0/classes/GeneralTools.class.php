<?php

require_once 'DB.class.php';

class GeneralTools {

	public function get_string_between($string, $start, $end){
		$string = " ".$string;
		$beginning = strpos($string,$start);
		if ($beginning == 0) return "";
		$beginning += strlen($start);   

		$isEnding = strpos($string, $end, $beginning);

		if ( $isEnding == false) {

			return substr($string, $beginning);

		} else {

			$ending = $isEnding - $beginning;
			return substr($string, $beginning, $ending);

		}
	}
	
	
}

?>