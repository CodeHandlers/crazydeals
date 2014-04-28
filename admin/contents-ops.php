<?php require_once('../include/conn.php'); ?>
<?php
session_start();
include("../include/settings.inc.php");

//print_r($_POST);

$query_rs_pages = "SELECT * FROM contents WHERE 1 ORDER BY orderid ASC";
$rs_pages = mysql_query($query_rs_pages) or die(mysql_error());
while($row_rs_pages = mysql_fetch_array($rs_pages))
{
 	$s35 = "update contents set orderid = '".$_REQUEST["orderid".$row_rs_pages["id"].""]."' where id = '".$row_rs_pages["id"]."'";
	$q35 = mysql_query($s35) or die($s35); 
}
if(isset($_POST['delete']) && count($_POST['delete'])>0)
{
  foreach($_POST['delete'] as $delete_data)
  { 
  	$s = "delete FROM contents where id = '".$delete_data."'";
  	$q = mysql_query($s) or die($s);
	
  }  
}

if(isset($_POST['status']) && count($_POST['status'])>0)
{
  foreach($_POST['status'] as $status_data)
  { 
	$s1 = "SELECT status FROM contents where id = '".$status_data."'";
  	$q1 = mysql_query($s1) or die($s1);
	$r1 = mysql_fetch_array($q1);
	
	 if($r1["status"] == "1")
	 {
	 	$status = 0;
	 }
	 else
	 {
	 	$status = 1;
	 }
  	 $s = "update contents set status  = '".$status."' where id  = '".$status_data."'";
  	 $q = mysql_query($s) or die($s);
  } 
} 
   echo "<script language='javascript'>
   		alert('Successfully Updated the Records');
   		window.location ='".$_SERVER['HTTP_REFERER']."';
   		 </script>";  
?>