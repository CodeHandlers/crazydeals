<?php

if ($_SERVER['HTTP_HOST'] != 'localhost')
{
	$root_path = $_SERVER['DOCUMENT_ROOT'] . "/jizbee/";
	$content_path = $_SERVER['DOCUMENT_ROOT'] . "/jizbee/content/";
	$path = "http://www.infomist.com/jizbee/";
	//$single_path = "https://www.onedollaradvertisement.com";
	$domain_name = "lowebdesign.com";
}
else
{
	$root_path = $_SERVER['DOCUMENT_ROOT'] . "/crazydeals/";
	$content_path = $_SERVER['DOCUMENT_ROOT'] . "/crazydeals/content/";
	$path = "http://localhost/crazydeals/";
	$Google_Map_Key = "ABQIAAAAEbn7FjdfUIp_d9-MbGIwwRRt-kR7vZUScBO7jTVRLQJ7wGmIrRREi4fTb5u53o1_K95pR76iRhNC4g";
	$domain_name = "crazydeals.com";
}
$image_path = $path."images/";
?>