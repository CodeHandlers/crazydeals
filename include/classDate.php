<?php
class Date{

	 function mysqlFormat( $date ){
		$yearPos = strrpos($date,"/");
		$str = substr($date,0, $yearPos);
		$year = substr($date, $yearPos + 1);
		$dayPos = strpos($str , "/");
		$day = substr($str,$dayPos + 1 );
		$month = substr($str,0,$dayPos);
		$date = "$year-$month-$day";
		return $date;   
	}
	
	 function mysqlToPicker($date){
		$year = substr($date,0,4);
		$month = substr( $date , 5 , 2);
		$day = substr( $date , 8 , 2);
		$value = "$day/$month/$year";
		return $value; 
	}
	
	function toMysql( $varDate ){
		 if($varDate){
				 $dobParts=explode("/",$varDate);
				 $dob="$dobParts[2]-$dobParts[0]-$dobParts[1]";
				 return $dob;
		 }
	}
	
	function toPicker( $varDate ){
		if( $varDate ){
				 $dobParts=explode("-",$varDate);
				 $dob="$dobParts[1]/$dobParts[2]/$dobParts[0]";
				 return $dob;
		 }	
	
	}
//	function toBritish( $varDate ){
//		$parts = explode("-", $varDate);
		
		 
	
//	}
}
?>