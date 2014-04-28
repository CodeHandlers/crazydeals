<?php session_start();
include("authentication.php");
require_once('../include/conn.php'); 
require_once('../include/settings.inc.php');
include("create_thumbnail.php");

$pathToImages = "../images/products/categories/";
$pathToThumbs = "../images/products/categories/thumbs/";

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}
if($_POST["publish"]) $publish = 1;
else $publish = 0;

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) 
{
$_POST['page_physical_name'] = strtolower(str_replace(" ","-",trim($_POST['page_physical_name']))).".htm";
	if($_POST['robots'] == "noindex,nofollow") $_POST['robots'] = "noindex,nofollow";
	else $_POST['robots'] = "index,follow";

if(isset($_POST['new_page']) && $_POST['new_page'] =="Add New Page")
{	 
	
	
	 $s1_max_orderid = "select max(cat_orderid) as orderid from categories where 1";
	 $q1_max_orderid = mysql_query($s1_max_orderid) or die($s1_max_orderid);
	 $r1_max_orderid = mysql_fetch_array($q1_max_orderid);
	 $orderid = $r1_max_orderid["orderid"];
		 
    $SQL = "INSERT INTO categories set cat_name = '".$_REQUEST["cat_name"]."',title = '".$_REQUEST["cat_name"]."',description = '".$_REQUEST["description"]."',keywords = '".$_REQUEST["keywords"]."',robots = '".$_POST["robots"]."',author = '".$_REQUEST["author"]."',copyright = '".$_REQUEST["copyright"]."',page_physical_name = '".$_POST['page_physical_name']."', cat_create_date = '".date('Y-m-d H:i:s')."',cat_description = '".$_REQUEST["cat_description"]."',cat_orderid = '". $orderid."',cat_product_type = '". $_REQUEST["cat_product_type"]."'";
	$Result1 = mysql_query($SQL) or die($SQL);
	$_REQUEST["code"] = mysql_insert_id();
	if($_FILES['cat_image']['name'] != "")
	 {
		$qr_image="select cat_image from categories where cat_id = '".$_REQUEST["code"]."'";
		$result_image=mysql_query($qr_image) or die($qr_image);
		$row_image=mysql_fetch_array($result_image);
		
		$img_path=$pathToImages.$row_image["cat_image"];
		$thumb_path=$pathToImages.$row_image["cat_image"];
		
		if(is_file("$img_path"))
		{
		   unlink("$img_path"); 
		}
		if(is_file("$thumb_path"))
		{
		   unlink("$thumb_path"); 
		}
			$filename = "";
			$b = "";
			$filename = $_FILES["cat_image"]['name'];	  
			$b=end(explode('.',$filename));
			$filename=rand(1,300000000000000000).".".$b;
						
			$uploadDir = $pathToImages;
			$uploadFile = $uploadDir.$filename;
			print "<pre>";
			if (move_uploaded_file($_FILES["cat_image"]['tmp_name'], $uploadFile))
			{
				$pic=$filename;
				createThumbs($pathToImages,$pathToThumbs,200,$pic);
				$SQL1 ="update `categories` set `cat_image` = '".$pic."' where cat_id = '".$_REQUEST["code"]."'";
				$Result2 = mysql_query($SQL1) or die($SQL1);
			}
		
	 	}
}
else
{
		 
    $SQL = "UPDATE categories set cat_name = '".$_REQUEST["cat_name"]."',title = '".$_REQUEST["cat_name"]."',description = '".$_REQUEST["description"]."',keywords = '".$_REQUEST["keywords"]."',robots = '".$_POST["robots"]."',author = '".$_REQUEST["author"]."',copyright = '".$_REQUEST["copyright"]."',page_physical_name = '".$_POST['page_physical_name']."',cat_description = '".$_REQUEST["cat_description"]."' where cat_id = '".$_REQUEST["code"]."'";
	$Result1 = mysql_query($SQL) or die($SQL);
	$_REQUEST["code"] = $_REQUEST["code"];
	if($_FILES['cat_image']['name'] != "")
	 {
		$qr_image="select cat_image from categories where cat_id = '".$_REQUEST["code"]."'";
		$result_image=mysql_query($qr_image) or die($qr_image);
		$row_image=mysql_fetch_array($result_image);
		
		$img_path=$pathToImages.$row_image["cat_image"];
		$thumb_path=$pathToImages.$row_image["cat_image"];
		
		if(is_file("$img_path"))
		{
		   unlink("$img_path"); 
		}
		if(is_file("$thumb_path"))
		{
		   unlink("$thumb_path"); 
		}
			$filename = "";
			$b = "";
			$filename = $_FILES["cat_image"]['name'];
			echo $filename;	  
			$b=end(explode('.',$filename));
			$filename=rand(1,300000000000000000).".".$b;
						
			$uploadDir = $pathToImages;
			$uploadFile = $uploadDir.$filename;
			print "<pre>";
			if (move_uploaded_file($_FILES["cat_image"]['tmp_name'], $uploadFile))
			{
				$pic=$filename;
				createThumbs($pathToImages,$pathToThumbs,200,$pic);
				$SQL1 ="update `categories` set `cat_image` = '".$pic."' where cat_id = '".$_REQUEST["code"]."'";
				$Result2 = mysql_query($SQL1) or die($SQL1);
			}
		
	 	}
}
  
  if(!$Result1)
   $msg = "Error: ".mysql_error()." - ".mysql_errno();
  else
  { 
	  $insertGoTo = "portfolio-flash-work-contents.php";
	  if (isset($_SERVER['QUERY_STRING'])) {
		$insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
		$insertGoTo .= $_SERVER['QUERY_STRING'];
	  }
  echo "<script language='javascript'>
  		alert('Page saved successfully!');
    	window.location = '".$_SERVER['HTTP_REFERER']."';
  		</script>";  	
	//header(sprintf("Location: %s", $insertGoTo));
  }//END ELSE	
}

// For data retrieval
$s1 = "select * from categories where cat_id = '".$_REQUEST["code"]."'";
$q1 = mysql_query($s1) or die($s1);
$row_sel = mysql_fetch_array($q1); 	
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>Jizbee.com - Admin Panel</title>
<META NAME="ROBOTS" CONTENT="NOARCHIVE">
<META NAME="ROBOTS" CONTENT="NOINDEX">
<META NAME="ROBOTS" CONTENT="NOIMAGEINDEX">
<META NAME="ROBOTS" CONTENT="NOFOLLOW">
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">

<style type="text/css">
<!--
body {
	margin-left: 0px;
	margin-top: 0px;
	margin-right: 0px;
	margin-bottom: 0px;
}
-->
</style>
<script language="JavaScript" type="text/JavaScript">
function MM_preloadImages() { //v3.0
  var d=document; if(d.images){ if(!d.MM_p) d.MM_p=new Array();
    var i,j=d.MM_p.length,a=MM_preloadImages.arguments; for(i=0; i<a.length; i++)
    if (a[i].indexOf("#")!=0){ d.MM_p[j]=new Image; d.MM_p[j++].src=a[i];}}
}
	// <![CDATA[
	var myMenu;
	window.onload = function() {
		myMenu = new SDMenu("my_menu");
		myMenu.init();
	};
	// ]]>
	function confirm_delete(filname)
	{
		if(confirm('Are you sure you want to delete this file!') == true)
		{
			document.location.href='delete_client_photo.php?photo='+filname+'&type'; 
			return true;
		}
		else
		{
			return false;
		}
	}
</script>
<script type="text/javascript" src="sdmenu/sdmenu.js"></script>
<script language="javascript" type="text/javascript" src="../include/validate.js"></script>

<link href="css/styleer.css" rel="stylesheet" type="text/css">
<link href="css/stylesheet.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" type="text/css" href="sdmenu/sdmenu.css" />
<link href="<?=$path?>css/styler.css" rel="stylesheet" type="text/css" />
</head>

<body>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td align="left" valign="top"><? include("../include/admin_header.php");?></td>
      </tr>
	  <tr>
        <td align="left" valign="top">&nbsp;</td>
      </tr>
      <tr>
        <td align="center" valign="top">
		<table width="90%"  border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td width="20%" valign="top"><table width="80%"  border="0" cellpadding="0" cellspacing="0">
                  <tr>
                    <td><table width="80%"  border="0" cellspacing="0" cellpadding="0">
                      
                      <tr>
                        <td valign="top"><?php include("leftnavigation.php");?></td>
                      </tr>
                    </table></td>
                  </tr>
                  <tr>
                    <td height="6"><img src="images/spacer.gif" width="1" height="1"></td>
                  </tr>
                  
                  
                </table></td>
                <td width="80%" valign="top"><table width="98%"  border="0" align="center" cellpadding="0" cellspacing="0">
                  <tr>
                    <td height="233" valign="top" class="blueBarborder2"><table width="100%"  border="0" cellspacing="0" cellpadding="0">
                      <tr>
                        <td height="31" class="blueBarborder"><table width="97%"  border="0" align="center" cellpadding="0" cellspacing="0">
                          <tr>
                            <td class="blackTxt">Jizbee.com - Admin Panel</td>
                          </tr>
                        </table></td>
                      </tr>
                      <tr>
                        <td height="202" valign="top" bgcolor="#dbedf1"><table width="98%"  border="0" align="center" cellpadding="0" cellspacing="0">
                          <tr>
                            <td height="8"><img src="images/spacer.gif" width="1" height="1"></td>
                          </tr>
                          <tr>
                            <td>
<?php
if(isset($include_page) && $include_page !=NULL)
 include($include_page);
else
{ 
?>							
			<form name="RTEDemo" action="<?php echo $editFormAction; ?>" method="post" enctype="multipart/form-data">
                              <table width="98%" align="left">
                                <tr valign="baseline">
                                  <td colspan="3" align="center" nowrap class="Redsmalltext">
								  <strong><?php echo $msg?></strong></td>                                  </tr>
								  <tr valign="baseline">
                                  <td colspan="3" align="left" valign="top" nowrap class="smalltext">&nbsp;</td>
                                  </tr>
								  <tr valign="baseline">
                                  <td width="141" align="left" nowrap class="smalltext"><strong>Page Name:</strong></td>
                                  <td colspan="2">
<input type="text" name="page_physical_name" id="page_physical_name" value="<?php echo $_POST['page_physical_name']?$_POST['page_physical_name']:str_replace(".htm","",$row_sel['page_physical_name']);?>" size="45" maxlength="255"><span>.htm</span>                                  </td>
                                </tr>
								 <tr valign="baseline">
                                  <td colspan="3" align="left" valign="top" nowrap class="smalltext">&nbsp;</td>
                                  </tr>
								  <tr valign="baseline">
                                  <td width="165" align="left" nowrap class="smalltext"><strong>Category Title</strong></td>
                                  <td width="659" colspan="2">
<input type="text" name="cat_name" value="<?php echo $_POST['cat_name']?$_POST['cat_name']:$row_sel['cat_name'];?>" size="45"></td>
                                </tr>
								
								<tr>
       								<td colspan="3" align="left" valign="top" nowrap class="smalltext">&nbsp;</td>
                                  </tr>
								  <tr valign="baseline">
                                  <td width="165" align="left" nowrap class="smalltext"><strong>Category Image : </strong></td>
                                  <td colspan="2">
<? if(is_file("../images/products/categories/thumbs/".$row_sel["cat_image"]))
			{?><input id="delete" name="delete" type="button" value="Delete" class="txtField1" onclick="document.location.href='popupimage-ops.php?code=<?=$_REQUEST["code"]?>&type=Categories'"/><br /><img src="../images/products/categories/thumbs/<?=$row_sel["cat_image"]?>" width="100"><br /><? }?><input id="cat_image" name="cat_image" type="file" class="txtField1" size="48"/></td>
                                </tr>
								
                                <tr valign="baseline">
                                  <td colspan="3" align="left" valign="top" nowrap class="smalltext">&nbsp;</td>
                                  </tr>
								  <tr>
								<td colspan="3" align="left" valign="top" nowrap class="smalltext">
                           <table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr valign="baseline">
                                 
                                  <td align="center" colspan="2" valign="top" nowrap class="smalltext"><span class="Redsmalltext">&gt;&gt;</span> Description for Site Map and Meta Tags<br>
                                    <textarea name="description" cols="32" rows="5" id="description"><?php echo $_POST['description']?$_POST['description']:$row_sel['description'];?></textarea></td>
                                  <td width="463" align="left" valign="top" nowrap class="smalltext"><span class="Redsmalltext">&gt;&gt;</span> Keywords for this page<br>
                                    <textarea name="keywords" cols="32" rows="5" id="keywords"><?php echo $_POST['keywords']?$_POST['keywords']:$row_sel['keywords']?></textarea></td>
                                </tr>
</table></td></tr>
                                <tr><td colspan="3"></td></tr>
                                <tr valign="baseline">
                                  <td colspan="3" align="left" valign="top" nowrap class="smalltext"><strong>Robots : </strong></td>
                                  </tr>
                                <tr valign="baseline">
                                  <td align="right" valign="top" nowrap class="smalltext">&nbsp;</td>
                                  <td colspan="2"><table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td align="left" valign="top" nowrap class="smalltext"><b>Index</b>&nbsp;
                                    <input   <?php if (!(strcmp($row_sel['robots'],"index,nofollow"))) {echo "checked=\"checked\"";} ?> name="robots" type="radio" value="index, nofollow" />&nbsp;&nbsp;&nbsp;&nbsp;<b>Follow</b>&nbsp;<input   <?php if (!(strcmp($row_sel['robots'],"noindex,follow"))) {echo "checked=\"checked\"";} ?> name="robots" type="radio" value="noindex,follow" />&nbsp;&nbsp;&nbsp;&nbsp;<b>Disallow</b>&nbsp;<input  <?php if (!(strcmp($row_sel['robots'],"noindex,nofollow"))) {echo "checked=\"checked\"";} ?> name="robots" type="radio" value="noindex,nofollow" />&nbsp;&nbsp;&nbsp;&nbsp;<b>Allow</b>&nbsp;<input  <?php if (!(strcmp($row_sel['robots'],"index,follow"))) {echo "checked=\"checked\"";} ?> name="robots" type="radio" value="index,follow" /></td>
  </tr>
</table>
</td>
                                 
                                </tr>
								<tr valign="baseline">
                                  <td align="left" valign="top" nowrap class="smalltext">&nbsp;</td>
                                  <td colspan="2">&nbsp;</td>
                                </tr>
								
								  <tr valign="baseline">
                                  <td width="165" align="left" valign="top" nowrap class="smalltext"><strong>Category Description : </strong></td>
                                  <td colspan="2">
<textarea name="cat_description" cols="75" rows="9"><?=$_POST['cat_description']?$_POST['cat_description']:$row_sel['cat_description']?></textarea></td>
                                </tr>
								<tr valign="baseline">
                                  <td align="left" valign="top" nowrap class="smalltext">&nbsp;</td>
                                  <td colspan="2">&nbsp;</td>
                                </tr>
								  <tr valign="baseline">
                                  <td width="165" align="left" valign="top" nowrap class="smalltext"><strong>Product Deal Type : </strong></td>
                                  <td colspan="2">
								  <select name="cat_product_type" id="cat_product_type">
								  <?
								  		$s1_prd_type = "select * from product_type where 1";
										$q1_prd_type = mysql_query($s1_prd_type) or die($s1_prd_type);
										while($r1_prd_type = mysql_fetch_array($q1_prd_type))
										{
										
								  ?>
								  <option value="<?=$r1_prd_type["product_type_id"]?>" <?=$r1_prd_type["product_type_id"]==$row_sel["cat_product_type"]?"selected=selected":""?>><?=$r1_prd_type["product_type_name"]?></option>
								  <?
								  		}
								  ?>
								  </select></td>
                                </tr>
								<tr valign="baseline">
                                  <td align="left" valign="top" nowrap class="smalltext">&nbsp;</td>
                                  <td colspan="2">&nbsp;</td>
                                </tr>
                                <tr valign="baseline">
                                  <td align="left" nowrap class="smalltext"><strong>Author : </strong></td>
                                  <td colspan="2"><input type="text" name="author" value="<?php echo $_POST['author']?$_POST['author']:$row_sel['author'];?>" size="32"></td>
                                </tr>
								<tr valign="baseline">
                                  <td align="left" valign="top" nowrap class="smalltext">&nbsp;</td>
                                  <td colspan="2">&nbsp;</td>
                                </tr>
                                <tr valign="baseline">
                                  <td align="left" nowrap class="smalltext"><strong>Copyright : </strong></td>
                                  <td colspan="2"><input type="text" name="copyright" value="<?php echo $_POST['copyright']?$_POST['copyright']:$row_sel['copyright'];?>" size="32"></td>
                                </tr>
								<tr valign="baseline">
                                  <td align="left" valign="top" nowrap class="smalltext">&nbsp;</td>
                                  <td colspan="2">&nbsp;</td>
                                </tr>
                                <tr valign="baseline">
                                  <td nowrap align="right">&nbsp;</td>
                                  <td colspan="2">
								  <input name="submit" type="submit" value="Save Page">
             					  <input name="code" type="hidden" id="code" value="<?php echo $_REQUEST['code']?>" />
              					  <input name="new_page" type="hidden" id="code" value="<?php echo $_REQUEST['vu']?>" />	
								  </td>
                                </tr>
								<tr valign="baseline">
                                  <td colspan="3" align="left" valign="top" nowrap class="smalltext">&nbsp;</td>
                                  </tr>
                              </table>
                              <input type="hidden" name="MM_insert" value="form1">
                            </form>
							<?php
							}
							?>							</td>
                          </tr>
                        </table></td>
                      </tr>
                    </table></td>
                  </tr>
                </table></td>
              </tr>
            </table>
</td></tr>
             <tr>
        <td align="left" valign="top"><? include("../include/admin_footer.php");?></td>
      </tr>
            </table>
</body>
</html>