<?php
require_once('../include/conn.php');
include("../include/settings.inc.php");

if (!function_exists("GetSQLValueString")) 
{
	function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
	{
	  $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;
	
	  $theValue = function_exists("mysql_real_escape_string") ? mysql_real_escape_string($theValue) : mysql_escape_string($theValue);
	
	  switch ($theType) {
		case "text":
		  $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
		  break;    
		case "long":
		case "int":
		  $theValue = ($theValue != "") ? intval($theValue) : "NULL";
		  break;
		case "double":
		  $theValue = ($theValue != "") ? "'" . doubleval($theValue) . "'" : "NULL";
		  break;
		case "date":
		  $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
		  break;
		case "defined":
		  $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
		  break;
	  }
	  return $theValue;
	}
}
//echo "dfsaf";
$currentPage = $_SERVER["PHP_SELF"];

$maxRows_rs_pages = 20;
$pageNum_rs_pages = 0;
if (isset($_GET['pageNum_rs_pages'])) {
  $pageNum_rs_pages = $_GET['pageNum_rs_pages'];
}
$startRow_rs_pages = $pageNum_rs_pages * $maxRows_rs_pages;

//mysql_select_db($database_conn, $conn);
$query_rs_pages = "SELECT * FROM sub_categories WHERE 1 and sub_cat_cat_id = '".$_REQUEST["for"]."' ORDER BY sub_cat_orderid ASC";


$query_limit_rs_pages = sprintf("%s LIMIT %d, %d", $query_rs_pages, $startRow_rs_pages, $maxRows_rs_pages);
$rs_pages = mysql_query($query_limit_rs_pages) or die(mysql_error());
$new_sel = mysql_num_rows($rs_pages);
$row_rs_pages = mysql_fetch_assoc($rs_pages);

if (isset($_GET['totalRows_rs_pages'])) {
  $totalRows_rs_pages = $_GET['totalRows_rs_pages'];
} else {
  $all_rs_pages = mysql_query($query_rs_pages);
  $totalRows_rs_pages = mysql_num_rows($all_rs_pages);
}
$totalPages_rs_pages = ceil($totalRows_rs_pages/$maxRows_rs_pages)-1;

$queryString_rs_pages = "";
if (!empty($_SERVER['QUERY_STRING'])) {
  $params = explode("&", $_SERVER['QUERY_STRING']);
  $newParams = array();
  foreach ($params as $param) {
    if (stristr($param, "pageNum_rs_pages") == false && 
        stristr($param, "totalRows_rs_pages") == false) {
      array_push($newParams, $param);
    }
  }
  if (count($newParams) != 0) {
    $queryString_rs_pages = "&" . htmlentities(implode("&", $newParams));
  }
}
$queryString_rs_pages = sprintf("&totalRows_rs_pages=%d%s", $totalRows_rs_pages, $queryString_rs_pages);
//echo "dfsaf".$new_sel;
?><link href="css/styleer.css" rel="stylesheet" type="text/css">
<link href="css/stylesheet.css" rel="stylesheet" type="text/css">
<style type="text/css">
<!--
.style1 
{
	font: 12px verdana, arial, sans-serif; 
	color: #999999;
	text-decoration: none; 	
	line-height: normal;

}
.style2 {font: 12px verdana, arial, sans-serif; color: #999999; text-decoration: none; line-height: normal; font-family: Verdana, Arial, Helvetica, sans-serif; }
-->
</style>
<script>
function chkec_all(numrow,chkid)
{
	//alert(chkid);
	//alert(numrow);
	if(chkid == "1")
	{
		var i = "1";
		var j = numrow;
		while(i<=j)
		{
			document.getElementById("status"+i+"").checked = true;
			i ++;
		}
	}
	else
	if(chkid == "2")
	{
		var i = "1";
		var j = numrow;
		while(i<=j)
		{
			document.getElementById("status"+i+"").checked = false;
			i ++;
		}
	}
	else
	if(chkid == "3")
	{
		var i = "1";
		var j = numrow;
		while(i<=j)
		{
			document.getElementById("delete"+i+"").checked = true;
			i ++;
		}
	}
	else
	if(chkid == "4")
	{
		var i = "1";
		var j = numrow;
		while(i<=j)
		{
			document.getElementById("delete"+i+"").checked = false;
			i ++;
		}
	}
	return true;
}
</script>
<form action="subcategories-ops.php" method="post" name="form1" id="form1" onsubmit="return confirm('Are you sure you want to delete selected Categories?');">
<table width="98%" align="center" cellpadding="2" cellspacing="0" class="displaytable">
  <tr class="blackTxt">
    <td colspan="4" bgcolor="#FFFFFF" class="title-L3page-red-lg">Manage SubCategories (<?=$_REQUEST["vuu"]?>)</td>
	<td colspan="3" align="center" bgcolor="#990000" class="style1"><a href="subcategories-contents.php?vu=Add New Page&for=<?=$_REQUEST["for"]?>"><font size="+1">Add New SubCategory of <?=$_REQUEST["vuu"]?></font></a></td>
  </tr>
  <tr class="blackTxt">
    <td colspan="7" bgcolor="#FFFFFF" class="blackTxt style1">&nbsp;</td>
    </tr>
  <tr class="blackTxt">
	<td width="14%" align="center" bgcolor="#FFFFFF" class="style2" ><strong>Title</strong> </td>
	<td width="14%" align="center" bgcolor="#FFFFFF" class="style2" ><strong>turn on/off display</strong> </td>
	<td width="13%" align="center" bgcolor="#FFFFFF"><span class="style1"><strong>Edit</strong></span></td>
	<td width="14%" align="center" bgcolor="#FFFFFF"><span class="style1"><strong>Updated Date</strong></span></td>
	<td width="6%" align="center" bgcolor="#FFFFFF"><span class="style1"><strong>Order No</strong></span></td>
	<td colspan="2" align="center" bgcolor="#FFFFFF"><span class="style1"><strong>Action</strong></span></td>
    </tr>
	<tr>
    <td colspan="5" class="blackChal">&nbsp;</td>
    <td width="16%" align="center" bgcolor="#CCCCCC" class="smalltext">turn on/off display</td>
    <td width="23%" align="center" bgcolor="#CCCCCC" class="smalltext">Delete</td>
  </tr>
  <?php 
  
  $entri = 0;
			$su = "SELECT * FROM sub_categories WHERE 1 ORDER BY sub_cat_orderid ASC";
			$qu = mysql_query($su) or die($su);
			while($ru = mysql_fetch_array($qu))
			{
				if($ru["sub_cat_orderid"] >= "1")
				{
					$entri = 1;
					break;
				}
			}
			
  $highlight_cell = "'highlight_cell'";
  $highlight_cell2 = "'style1'";
  $ij = 1;
  do {
  		$s_title = $row_rs_pages["sub_cat_name"];
		$s_id = $row_rs_pages["sub_cat_id"];
		$s_date = $row_rs_pages["sub_cat_modify_date"];
		
  ?>
    <tr class="style1" <?php echo 'onmouseover="this.className='.$highlight_cell.'" onmouseout="this.className='.$highlight_cell2.'"'?>>
      
	  <td class="style1" style="padding-left:10px"><?=$s_title?></td>
	   <td align="center"><?=$row_rs_pages['sub_cat_status']=="1"?"<span style='color:green;'><b>Active</b></span>":"<span style='color:red;'><b>In-active</b></span>"?></td>
	  <td align="center"><a href="subcategories-contents.php?vu=<?php echo $s_title; ?>&code=<?php echo $s_id; ?>&for=<?=$_REQUEST["for"]?>"><img src="images/b_edit.png" alt="Edit" border="0" /> </a></td>
	 
	   <td align="center"><?=date('F dS, Y',strtotime($s_date))?></td>
      <td align="center"><input id="orderid<?=$s_id;?>" name="orderid<?=$s_id;?>" value="<?=$entri==0?$ij:$row_rs_pages['sub_cat_orderid'];?>" size="5" class="txtField1"/></td>
	   <td align="center" bgcolor="#CCCCCC"><input name="status[]" id="status<?=$ij?>" type="checkbox" value="<?=$s_id?>" /></td>
      <td align="center" bgcolor="#CCCCCC"><input name="delete[]" id="delete<?=$ij?>" type="checkbox" value="<?=$s_id?>" /></td>
    </tr>
    <?php $ij++;} while ($row_rs_pages = mysql_fetch_assoc($rs_pages)); ?>
	
	<tr>
      <td colspan="5" align="right" style="padding-right:20px" bgcolor="#FFFFFF"><input name="for" id="for" value="<?=$_REQUEST["for"]?>" type="hidden" /></td>
	  <td bgcolor="#FFFFFF" style="font-size:9px"><span onclick="return chkec_all(<?= $new_sel?>,1);" style="cursor:pointer; color:#0000FF; font-weight:bold">Check All</span> | <span onclick="return chkec_all(<?= $new_sel?>,2);" style="cursor:pointer;color:#0000FF; font-weight:bold">Uncheck All</span></td><td bgcolor="#FFFFFF" style="font-size:9px"><span onclick="return chkec_all(<?= $new_sel?>,3);" style="cursor:pointer; color:#0000FF; font-weight:bold">Check All</span> | <span onclick="return chkec_all(<?= $new_sel?>,4);" style="cursor:pointer;color:#0000FF; font-weight:bold">Uncheck All</span></td>
    </tr>
    <tr>
      <td colspan="7" align="right" style="padding-right:20px" bgcolor="#FFFFFF" class="text2"><input name="Submit" type="submit" value="Update"></td>
    </tr>
</table>

<table border="0" width="50%" align="center">
  <tr>
    <td width="23%" align="center"><?php if ($pageNum_rs_pages > 0) { // Show if not first page ?>
          <a href="<?php printf("%s?pageNum_rs_pages=%d%s", $currentPage, 0, $queryString_rs_pages); ?>"><img src="First.gif" border=0></a>
          <?php } // Show if not first page ?>
    </td>
    <td width="31%" align="center"><?php if ($pageNum_rs_pages > 0) { // Show if not first page ?>
          <a href="<?php printf("%s?pageNum_rs_pages=%d%s", $currentPage, max(0, $pageNum_rs_pages - 1), $queryString_rs_pages); ?>"><img src="Previous.gif" border=0></a>
          <?php } // Show if not first page ?>
    </td>
    <td width="23%" align="center"><?php if ($pageNum_rs_pages < $totalPages_rs_pages) { // Show if not last page ?>
          <a href="<?php printf("%s?pageNum_rs_pages=%d%s", $currentPage, min($totalPages_rs_pages, $pageNum_rs_pages + 1), $queryString_rs_pages); ?>"><img src="Next.gif" border=0></a>
          <?php } // Show if not last page ?>
    </td>
    <td width="23%" align="center"><?php if ($pageNum_rs_pages < $totalPages_rs_pages) { // Show if not last page ?>
          <a href="<?php printf("%s?pageNum_rs_pages=%d%s", $currentPage, $totalPages_rs_pages, $queryString_rs_pages); ?>"><img src="Last.gif" border=0></a>
          <?php } // Show if not last page ?>
    </td>
  </tr>
</table>
</form>
<?php
mysql_free_result($rs_pages);
?>
