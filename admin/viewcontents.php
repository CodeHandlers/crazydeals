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

$query_rs_pages = "SELECT * FROM contents WHERE 1 and parent_id='0' ORDER BY orderid ASC";
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
?>
<link href="css/styleer.css" rel="stylesheet" type="text/css">
<link href="css/stylesheet.css" rel="stylesheet" type="text/css">
<style type="text/css">
<!--
.style1 {
	font: 12px verdana, arial, sans-serif;
	color: #999999;
	text-decoration: none;
	line-height: normal;
}
.style2 {
	font: 12px verdana, arial, sans-serif;
	color: #999999;
	text-decoration: none;
	line-height: normal;
	font-family: Verdana, Arial, Helvetica, sans-serif;
}
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
<form action="contents-ops.php" method="post" name="form1" id="form1">
  <table width="100%" align="center" cellpadding="2" cellspacing="0" class="displaytable">
    <tr class="blackTxt">
      <td colspan="5" bgcolor="#FFFFFF" class="title-L3page-red-lg">Manage Pages</td>
      <td colspan="3" align="center" bgcolor="#990000" class="style1"><a href="contents.php?vu=Add New Page"><font size="+1">Add New Page</font></a></td>
    </tr>
    <tr class="blackTxt">
      <td colspan="8" bgcolor="#FFFFFF" class="blackTxt style1">&nbsp;</td>
    </tr>
    <tr class="blackTxt">
      <td width="21%" align="center" bgcolor="#FFFFFF" class="style2" ><strong>Title</strong> </td>
      <td width="13%" align="center" bgcolor="#FFFFFF" class="style2" ><strong>Physical Name</strong> </td>
      <td width="11%" align="center" bgcolor="#FFFFFF" class="style2" ><strong>turn on/off display</strong> </td>
      <td width="12%" align="center" bgcolor="#FFFFFF" class="style2" ><strong>Update date</strong> </td>
      <td width="4%" align="center" bgcolor="#FFFFFF"><span class="style1"><strong>Edit</strong></span></td>
      <td width="9%" align="center" bgcolor="#FFFFFF"><span class="style1"><strong>Order No</strong></span></td>
      <td colspan="2" align="center" bgcolor="#FFFFFF"><span class="style1"><strong>Action</strong></span></td>
    </tr>
    <tr>
      <td colspan="6" class="blackChal">&nbsp;</td>
      <td width="15%" align="center"  class="smalltext">turn on/off display</td>
      <td width="15%" align="center"  class="smalltext">Delete</td>
    </tr>
    <?php 
  $entri = 0;
			$su = "SELECT * FROM contents WHERE 1 and parent_id='0' ORDER BY orderid ASC";
			$qu = mysql_query($su) or die($su);
			while($ru = mysql_fetch_array($qu))
			{
				if($ru["orderid"] >= "1")
				{
					$entri = 1;
					break;
				}
			}
			
  $highlight_cell = "'highlight_cell'";
  $highlight_cell2 = "'style1'";
  $ij = 1;
  do {
  			$s_title = $row_rs_pages["content_title"];
			$s_page_name = $row_rs_pages["page_physical_name"];
			$s_id = $row_rs_pages["id"];
			//$s_date = $row_rs_pages["sdate"];
  ?>
    <tr class="style1" <?php echo 'onmouseover="this.className='.$highlight_cell.'" onmouseout="this.className='.$highlight_cell2.'"'?>>
      <td class="style1" style="padding-left:10px"><?=$s_title?></td>
      <td class="style1" style="padding-left:10px"><a href="<?=$path.$s_page_name?>" class="copyright_link" target="_blank">
        <?=$s_page_name?>
        </a></td>
      <td align="center"><?=$row_rs_pages['status']=="1"?"<span style='color:green;'><b>Active</b></span>":"<span style='color:red;'><b>In-active</b></span>"?></td>
      <td align="center"><?=date('M d, Y',strtotime($row_rs_pages['page_modify_date']))?>
        <br />
        <?=date('h:i A',strtotime($row_rs_pages['page_modify_date']))?></td>
      <td align="center"><a href="contents.php?vu=<?=$s_title?>&code=<?=$s_id?>"><img src="images/b_edit.png" alt="Edit" border="0" /> </a></td>
      <td align="center" bgcolor="#CCCCCC"><input id="orderid<?=$s_id;?>" name="orderid<?=$s_id;?>" value="<?=$entri==0?$ij:$row_rs_pages['orderid'];?>" size="5" class="bodytext" style="text-align:center;"/></td>
      <td align="center" bgcolor="#CCCCCC"><input name="status[]" id="status<?=$ij?>" type="checkbox" value="<?=$s_id?>" /></td>
      <td align="center" bgcolor="#CCCCCC"><input name="delete[]" id="delete<?=$ij?>" type="checkbox" value="<?=$s_id?>" /></td>
    </tr>
    <tr>
      <td colspan="8" align="right" height="5" bgcolor="#FFFFFF" class="text2"></td>
    </tr>
    <?php $ij++;} while ($row_rs_pages = mysql_fetch_assoc($rs_pages)); ?>
    <tr>
      <td colspan="6" align="right" style="padding-right:20px" bgcolor="#FFFFFF"><input name="for" id="for" value="<?=$_REQUEST["for"]?>" type="hidden" /></td>
      <td bgcolor="#FFFFFF" style="font-size:10px"><span onclick="return chkec_all(<?= $new_sel?>,1);" style="cursor:pointer; color:#0000FF; font-weight:bold">Check All</span> | <span onclick="return chkec_all(<?= $new_sel?>,2);" style="cursor:pointer;color:#0000FF; font-weight:bold">Uncheck All</span></td>
      <td bgcolor="#FFFFFF" style="font-size:10px"><span onclick="return chkec_all(<?= $new_sel?>,3);" style="cursor:pointer; color:#0000FF; font-weight:bold">Check All</span> | <span onclick="return chkec_all(<?= $new_sel?>,4);" style="cursor:pointer;color:#0000FF; font-weight:bold">Uncheck All</span></td>
    </tr>
    <tr>
      <td colspan="8" align="right" style="padding-right:20px" bgcolor="#FFFFFF" class="text2"><input name="Submit" type="submit" value="Update"></td>
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
