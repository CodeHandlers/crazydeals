<?php require_once('../include/conn.php');
session_start();
	$query_rs_pages = "SELECT * FROM categories WHERE 1 ORDER BY sort_order ASC";
	$rs_pages = mysql_query($query_rs_pages) or die(mysql_error());
	while($row_rs_pages = mysql_fetch_array($rs_pages))
	{
		$s35 = "update categories set sort_order = '".$_REQUEST["orderid".$row_rs_pages["cat_id"].""]."' where cat_id = '".$row_rs_pages["cat_id"]."'";
		$q35 = mysql_query($s35) or die($s35); 
	}
	if(isset($_POST['delete']) && count($_POST['delete'])>0)
	{
	  foreach($_POST['delete'] as $delete_data)
	  {
	  	$s1 = "select * FROM categories where cat_id = '".$delete_data."'";
		$q1 = mysql_query($s1) or die($s1);
		$r1 = mysql_fetch_array($q1);
		 
	  	 if(is_file("../images/products/categories/".$r1["cat_image"]))
		 {
		 	unlink("../images/products/categories/".$r1["cat_image"]);
		 }	 
		 $s = "delete FROM categories where cat_id = '".$delete_data."'";
		 $q = mysql_query($s) or die($s);
	  }  
	}
	
	if(isset($_POST['status']) && count($_POST['status'])>0)
	{
	  foreach($_POST['status'] as $status_data)
	  { 
		
		$s1 = "SELECT category_isActive FROM categories where cat_id = '".$status_data."'";
		$q1 = mysql_query($s1) or die($s1);
		$r1 = mysql_fetch_array($q1);
		
		 if($r1["category_isActive"] == "1")
		 {
			$status = 0;
		 }
		 else
		 {
			$status = 1;
		 }
		 $s = "update categories set category_isActive  = '".$status."' where cat_id  = '".$status_data."'";
		 $q = mysql_query($s) or die($s);
	
	  } 
	}
echo "<script language='javascript'>
		alert('Record has been updated successfully!');	
		window.location = '".$_SERVER['HTTP_REFERER']."';
	  </script>";
?>