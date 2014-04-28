<?php session_start();
include("authentication.php");
require_once('../include/conn.php'); 
require_once('../include/settings.inc.php');
include("../include/functions_emagineit.php");
$obj = new EmagineIT();

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}
if($_POST["publish"]) $publish = 1;
else $publish = 0;

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) 
{
	if(isset($_POST['new_page']) && $_POST['new_page'] =="Add New Page")
	{
		
		
			$_POST['page_physical_name'] = str_replace(" ","-",strtolower(trim($_POST['page_physical_name']))).".htm";
			if($_POST['robots'] == "noindex,nofollow") $_POST['robots'] = "noindex,nofollow";
			else $_POST['robots'] = "index,follow";
			if($_REQUEST["left"] == "on")
			{
				$left = "1";
			}
			else
			{
				$left = "0";
			}
			if($_REQUEST["footer"] == "on")
			{
				$footer = "1";
			}
			else
			{
				$footer = "0";
			}
			
			if($_REQUEST["have_child_pages"] == "on")
			{
				$have_child_pages = "1";
			}
			else
			{
				$have_child_pages = "0";
			}
			
			
			
				 $s1_max_orderid = "select max(orderid) as orderid from contents where 1";
				 $q1_max_orderid = mysql_query($s1_max_orderid) or die($s1_max_orderid);
				 $r1_max_orderid = mysql_fetch_array($q1_max_orderid);
				 $orderid = $r1_max_orderid["orderid"] + 1;
				$SQL = "insert into contents set content_title = '".$_REQUEST['content_title']."' ,content_desc = '".addslashes($_REQUEST["content_desc"])."', content_desc_fr = '".addslashes($_REQUEST["content_desc_fr"])."', title = '".$_REQUEST["content_type"]."',description = '".addslashes($_REQUEST["description"])."',keywords = '".$_REQUEST["keywords"]."',author = '".$_REQUEST["author"]."',robots = '".$_REQUEST["robots"]."',copyright = '".$_REQUEST["copyright"]."',show_on_footer = '".$footer."',show_on_sitemap = '".$left."',page_physical_name = '".$_POST['page_physical_name']."',page_create_date = '".date('Y-m-d h:i:s')."',orderid = '".$orderid."', google_analytics = '".$_REQUEST["google_analytics"]."',header_image_title='".$_REQUEST['header_image_title']."',header_image_text = '".$_REQUEST["header_image_text"]."',have_child_pages='".$have_child_pages."', content_title_fr = '".$_REQUEST['content_title_fr']."'";
				
				$Result1 = mysql_query($SQL) or die($SQL);
				$_REQUEST["code"] = mysql_insert_id();
			if($_FILES['header_image']['name'] != "")
	 {
		$qr_image="select header_image from contents where id = '".$_REQUEST["code"]."'";
		$result_image=mysql_query($qr_image) or die($qr_image);
		$row_image=mysql_fetch_array($result_image);
		$img_path="../images/".$row_image["header_image"];	
		if(is_file("$img_path"))
		{
		   unlink("$img_path"); 
		}
			$filename = "";
			$b = "";
			$filename = $_FILES["header_image"]['name'];	  
			$b=end(explode('.',$filename));
			$filename=rand(1,300000000000000000).".".$b;
						
			$uploadDir = "../images/";
			$uploadFile = $uploadDir.$filename;
			print "<pre>";
			if (move_uploaded_file($_FILES["header_image"]['tmp_name'], $uploadFile))
			{
				$pic=$filename;
				
				$SQL1 ="update `contents` set `header_image` = '".$pic."' where id = '".$_REQUEST["code"]."'";
				$Result2 = mysql_query($SQL1) or die($SQL1);
			}
		
	 }	 	
					
				 if($_REQUEST["header_image_default"] == 'on')
				{
						$s1_updt_default_image = "update contents set header_image_default = 0 where 1";
						$q1_updt_default_image = mysql_query($s1_updt_default_image) or die($s1_updt_default_image);
						
						$s2_updt_default_image = "update contents set header_image_default = 1 where 1 and id = '".mysql_insert_id()."'";
						$q2_updt_default_image = mysql_query($s2_updt_default_image) or die($s2_updt_default_image);	
					}
		
		
		
	}
	else
	{
		
				$_POST['page_physical_name'] = str_replace(" ","-",strtolower(trim($_POST['page_physical_name']))).".htm";
				if($_POST['robots'] == "noindex,nofollow") $_POST['robots'] = "noindex,nofollow";
				else $_POST['robots'] = "index,follow";
				if($_REQUEST["left"] == "on")
				{
					$left = "1";
				}
				else
				{
					$left = "0";
				}
				if($_REQUEST["footer"] == "on")
				{
					$footer = "1";
				}
				else
				{
					$footer = "0";
				}
				
				if($_REQUEST["have_child_pages"] == "on")
			{
				$have_child_pages = "1";
			}
			else
			{
				$have_child_pages = "0";
			}
				
									  
					 if($_FILES['header_image']['name'] != "")
	 				{
		$qr_image="select header_image from contents where id = '".$_REQUEST["code"]."'";
		$result_image=mysql_query($qr_image) or die($qr_image);
		$row_image=mysql_fetch_array($result_image);
		$img_path="../images/".$row_image["header_image"];	
		if(is_file("$img_path"))
		{
		   unlink("$img_path"); 
		}
			$filename = "";
			$b = "";
			$filename = $_FILES["header_image"]['name'];	  
			$b=end(explode('.',$filename));
			$filename=rand(1,300000000000000000).".".$b;
						
			$uploadDir = "../images/";
			$uploadFile = $uploadDir.$filename;
			print "<pre>";
			if (move_uploaded_file($_FILES["header_image"]['tmp_name'], $uploadFile))
			{
				$pic=$filename;
				
				$SQL1 ="update `contents` set `header_image` = '".$pic."' where id = '".$_REQUEST["code"]."'";
				$Result2 = mysql_query($SQL1) or die($SQL1);
			}
		
	 }	 
					 
					 
					 
					 if($_REQUEST["header_image_default"] == 'on')
					 {
						$s1_updt_default_image = "update contents set header_image_default = 0 where 1";
						$q1_updt_default_image = mysql_query($s1_updt_default_image) or die($s1_updt_default_image);
						
						$s2_updt_default_image = "update contents set header_image_default = 1 where 1 and id = '".$_REQUEST["code"]."'";
						$q2_updt_default_image = mysql_query($s2_updt_default_image) or die($s2_updt_default_image);	
					 }
					 
					
					//echo $_REQUEST['content_desc'];
					
					 
					$SQL =  "UPDATE contents set content_title = '".$_REQUEST['content_title']."' ,content_desc = '".addslashes($_REQUEST["content_desc"])."', content_desc_fr = '".addslashes($_REQUEST["content_desc_fr"])."', title = '".$_REQUEST["content_type"]."',description = '".addslashes($_REQUEST["description"])."',keywords = '".$_REQUEST["keywords"]."',author = '".$_REQUEST["author"]."',robots = '".$_REQUEST["robots"]."',copyright = '".$_REQUEST["copyright"]."',show_on_footer = '".$footer."',show_on_sitemap = '".$left."',page_physical_name = '".$_POST['page_physical_name']."',google_analytics = '".addslashes($_REQUEST["google_analytics"])."',header_image_title='".$_REQUEST['header_image_title']."',header_image_text = '".$_REQUEST["header_image_text"]."',have_child_pages='".$have_child_pages."', content_title_fr = '".$_REQUEST['content_title_fr']."' where id = '".$_REQUEST["code"]."'";
					$Result1 = mysql_query($SQL) or die(mysql_error());
			
			
			
			
			
	}
	 
	  if(!$Result1)
	   $msg = "Error: ".mysql_error()." - ".mysql_errno();
	  else
	  { 
		  $insertGoTo = "contents.php";
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
$s1 = "select * from contents where id = '".$_REQUEST["code"]."'";
$q1 = mysql_query($s1) or die($s1);
$row_sel = mysql_fetch_array($q1);
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>
<?=$site_name?>
- Admin Panel</title>
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
	function change_status(type)
	{
		if(type == '1')
		{
			document.getElementById("email_details").style.display = 'inline';
		}
		else
		if(type == '0')
		{
			document.getElementById("email_details").style.display = 'none';
		}
	}
</script>
<script type="text/javascript" src="sdmenu/sdmenu.js"></script>
<script language="javascript" type="text/javascript" src="../include/validate.js"></script>
<script type="text/javascript" src="<?=$path?>js/jsapi.js"></script>
<script type="text/javascript" src="ckeditor/ckeditor.js"></script>
<link href="css/styleer.css" rel="stylesheet" type="text/css">
<link href="css/stylesheet.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" type="text/css" href="sdmenu/sdmenu.css" />
<link href="<?=$path?>css/styler.css" rel="stylesheet" type="text/css" />
<script language="javascript" src="<?=$path?>js/globale_jsfile.js" type="text/javascript"></script>
<script language="javascript" type="text/javascript">
function change_language(typ)
{
	//alert(typ);
	if(typ == 'show_en')
	{
		document.getElementById("show_ja").style.display = "none";
		document.getElementById("show_en").style.display = "none";
		document.getElementById("main_body_ajax_show_post_top").style.display = "inline";
		setTimeout("document.getElementById('main_body_ajax_show_post_top').style.display = 'none';", 2000);
		setTimeout("document.getElementById('show_en').style.display = 'inline';", 2000);
		document.getElementById("language").value = 'en';
	}
	else
	if(typ == 'show_ja')
	{
		document.getElementById("show_ja").style.display = "none";
		document.getElementById("show_en").style.display = "none";
		document.getElementById("main_body_ajax_show_post_top").style.display = "inline";
		setTimeout("document.getElementById('main_body_ajax_show_post_top').style.display = 'none';", 2000);
		setTimeout("document.getElementById('show_ja').style.display = 'inline';", 2000);
		document.getElementById("language").value = 'ja';
	}
	//alert(document.getElementById("language").value);
}
</script>
</head>
<body >
<table width="1100" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td width="1100"><img src="<?=$path?>images/spacer.gif" width="100" height="25" /></td>
  </tr>
  <tr>
    <td><table border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td><img src="<?=$path?>images/index_03.gif" width="46" height="57" alt="" /></td>
          <td><img src="<?=$path?>images/index_04.gif" width="1008" height="57" alt="" /></td>
          <td><img src="<?=$path?>images/index_05.gif" width="46" height="57" alt="" /></td>
        </tr>
        <tr>
          <td background="<?=$path?>images/index_07.gif"><img src="<?=$path?>images/spacer.gif" width="46" height="100" /></td>
          <td valign="top" bgcolor="#FFFFFF"><table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td>&nbsp;</td>
              </tr>
              <tr>
                <td align="left" valign="top" ><table width="100%"  border="0" cellspacing="0" cellpadding="0">
                    <tr>
                      <td width="16%" valign="top"><table width="80%"  border="0" cellpadding="0" cellspacing="0">
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
                      <td width="84%" valign="top"><table width="99%" border="0" align="center" cellpadding="0" cellspacing="0">
                          <tr>
                            <td height="233" valign="top" class="blueBarborder2"><table width="100%"  border="0" cellspacing="0" cellpadding="0">
                                <tr>
                                  <td height="31" class="blueBarborder"><table width="97%"  border="0" align="center" cellpadding="0" cellspacing="0">
                                      <tr>
                                        <td class="blackTxt"><a href="home.php" class="blackTxt"><?=$domain_name?> - Admin Panel Home</a></td>
                                      </tr>
                                    </table></td>
                                </tr>
                                <tr>
                                  <td height="202" valign="top" bgcolor="#dbedf1"><table width="98%"  border="0" align="center" cellpadding="0" cellspacing="0">
                                      <tr>
                                        <td height="8"><img src="images/spacer.gif" width="1" height="1"></td>
                                      </tr>
                                      <tr>
                                        <td><?php
if(isset($include_page) && $include_page !=NULL)
 include($include_page);
else
{ 
?>
                                          <form name="RTEDemo" action="<?php echo $editFormAction; ?>" method="post" onSubmit="return submitForm();" enctype="multipart/form-data">
                                            <table width="100%" align="left" cellpadding="0" cellspacing="0">
                                              <tr valign="baseline">
                                                <td colspan="3" align="center" nowrap class="Redsmalltext"><strong><?php echo $msg?></strong></td>
                                              </tr>
                                              <tr>
                                                <td colspan="3" valign="top"><div id="show_en">
                                                    <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                                      <tr valign="baseline">
                                                        <td colspan="3" align="left" valign="top" nowrap class="smalltext">&nbsp;</td>
                                                      </tr>
                                                      <tr valign="baseline">
                                                        <td width="141" align="left" nowrap class="smalltext"><strong>Page Name:</strong></td>
                                                        <td colspan="2"><input type="text" name="page_physical_name" id="page_physical_name" value="<?php echo $_POST['page_physical_name']?$_POST['page_physical_name']:str_replace(".htm","",$row_sel['page_physical_name']);?>" size="45" maxlength="255">
                                                          <span>.htm</span> </td>
                                                      </tr>
                                                      <tr valign="baseline">
                                                        <td colspan="3" align="left" valign="top" nowrap class="smalltext">&nbsp;</td>
                                                      </tr>
                                                      <tr valign="baseline">
                                                        <td width="141" align="left" nowrap class="smalltext"><strong>Header Image : </strong></td>
                                                        <td colspan="2"><? 			if(is_file("../images/".$row_sel["header_image"]))

			{

			$b=end(explode('.',$row_sel["header_image"]));

			if($b == 'swf')

			{

			?>
                                                          <object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=7,0,19,0" width="400">
                                                            <param name="movie" value="../images/<?=$row_sel["header_image"]?>" />
                                                            <param name="quality" value="high" />
                                                            <param name="wmode" value="transparent" />
                                                            <embed src="../images/<?=$row_sel["header_image"]?>" wmode="transparent" quality="high" pluginspage="http://www.macromedia.com/go/getflashplayer"  type="application/x-shockwave-flash" width="400"></embed>
                                                          </object>
                                                          <br />
                                                          <?

			  }

			  else

			  {?>
                                                          <img src="../images/<?=$row_sel["header_image"]?>" alt="" width="400"/> <br />
                                                          <?

			  }

			   }?>
                                                          <input id="header_image" name="header_image" type="file" class="txtField1" size="48"/>
                                                          &nbsp;&nbsp;<span class="smalltext">Make it default:</span>&nbsp;
                                                          <input type="checkbox" name="header_image_default" id="header_image_default" <?=$row_sel["header_image_default"]==1?"checked=checked":""?> /></td>
                                                      </tr>
                                                      <tr valign="baseline">
                                                        <td colspan="3" align="left" valign="top" nowrap class="smalltext">&nbsp;</td>
                                                      </tr>
                                                      <tr valign="baseline">
                                                        <td width="141" align="left" nowrap class="smalltext"><strong>Header Image Title : </strong></td>
                                                        <td colspan="2"><input type="text" name="header_image_title" value="<?php echo $_POST['header_image_title']?$_POST['header_image_title']:$row_sel['header_image_title'];?>" size="45">                                                        </td>
                                                      </tr>
                                                      <tr valign="baseline">
                                                        <td colspan="3" align="left" valign="top" nowrap class="smalltext">&nbsp;</td>
                                                      </tr>
                                                      <tr valign="baseline">
                                                        <td align="left" nowrap class="smalltext" valign="top"><strong>Header Image Text : </strong></td>
                                                        <td colspan="2"><textarea type="text" name="header_image_text" rows="5" cols="62"><?=$_POST['header_image_text']?$_POST['header_image_text']:$row_sel['header_image_text']?>
</textarea></td>
                                                      </tr>
                                                      <tr valign="baseline">
                                                        <td colspan="3" align="left" valign="top" nowrap class="smalltext">&nbsp;</td>
                                                      </tr>
                                                      <tr valign="baseline">
                                                        <td width="141" align="left" nowrap class="smalltext"><strong>Content Title : </strong></td>
                                                        <td colspan="2"><input type="text" name="content_title" value="<?php echo $_POST['content_title']?$_POST['content_title']:$row_sel['content_title'];?>" size="45" onKeyUp="keyup(this,'txttitle');">                                                        </td>
                                                      </tr>
                                                      <tr valign="baseline">
                                                        <td colspan="3" align="left" valign="top" nowrap class="smalltext">&nbsp;</td>
                                                      </tr>
                                                      <tr valign="baseline">
                                                        <td align="left" nowrap class="smalltext"><strong>Danish Content Title</strong></td>
                                                        <td colspan="2"><input name="content_title_fr" type="text" id="content_title_fr" onKeyUp="keyup(this,'txttitle');" value="<?php echo $_POST['content_title_fr']?$_POST['content_title_fr']:$row_sel['content_title_fr'];?>" size="45"></td>
                                                      </tr>
                                                      <tr valign="baseline">
                                                        <td align="left" nowrap class="smalltext">&nbsp;</td>
                                                        <td colspan="2">&nbsp;</td>
                                                      </tr>
                                                      <tr valign="baseline">
                                                        <td width="141" align="left" nowrap class="smalltext"><strong>Title : </strong></td>
                                                        <td colspan="2"><input type="text" name="content_type" value="<?php echo $_POST['title']?$_POST['title']:$row_sel['title'];?>" size="45" onKeyUp="keyup(this,'txttitle');">                                                        </td>
                                                      </tr>
                                                      <tr valign="baseline">
                                                        <td colspan="3" align="left" valign="top" nowrap class="smalltext">&nbsp;</td>
                                                      </tr>
                                                      <tr valign="baseline">
                                                        <td align="right" valign="top" nowrap class="smalltext">&nbsp;</td>
                                                        <td align="left" valign="top" nowrap class="smalltext" colspan="2"><span class="Redsmalltext">&gt;&gt;</span> Show On SiteMap
                                                          <input type="checkbox" name="left" id="left" <?=$row_sel['show_on_sitemap']==1?"checked=checked":""?>>
                                                          &nbsp;&nbsp;&nbsp;&nbsp;<span class="Redsmalltext">&gt;&gt;</span> Show on Footer&nbsp;&nbsp;
                                                          <input type="checkbox" name="footer" id="footer" <?=$row_sel['show_on_footer']==1?"checked=checked":""?>>
                                                          &nbsp;&nbsp;&nbsp;&nbsp;<span class="Redsmalltext">&gt;&gt;</span> Have Child Pages
                                                          <input type="checkbox" name="have_child_pages" id="have_child_pages" <?=$row_sel['have_child_pages']==1?"checked=checked":""?>>                                                        </td>
                                                      </tr>
                                                      <tr valign="baseline">
                                                        <td colspan="3" align="left" valign="top" nowrap class="smalltext">&nbsp;</td>
                                                      </tr>
                                                      <tr valign="baseline">
                                                        <td colspan="3" align="left" valign="top" nowrap class="smalltext">&nbsp;</td>
                                                      </tr>
                                                      <tr valign="baseline">
                                                        <td align="left" valign="top">&nbsp;</td>
                                                        <td align="left" valign="top" nowrap class="smalltext"><span class="Redsmalltext">&gt;&gt;</span> Description for Site Map and Meta Tags<br>
                                                          <textarea name="description" cols="32" rows="5" id="description"><?php echo $_POST['description']?$_POST['description']:$row_sel['description'];?></textarea></td>
                                                        <td align="left" valign="top" nowrap class="smalltext"><span class="Redsmalltext">&gt;&gt;</span> Keywords for this page<br>
                                                          <textarea name="keywords" cols="22" rows="5" id="keywords"><?php echo $_POST['keywords']?$_POST['keywords']:$row_sel['keywords']?></textarea></td>
                                                      </tr>
                                                      <tr valign="baseline">
                                                        <td colspan="3" align="left" valign="top" nowrap class="smalltext"><strong>Robots : </strong></td>
                                                      </tr>
                                                      <tr valign="baseline">
                                                        <td align="right" valign="top" nowrap class="smalltext">&nbsp;</td>
                                                        <td colspan="2"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                                                            <tr>
                                                              <td align="left" valign="top" nowrap class="smalltext"><b>Index</b>&nbsp;
                                                                <input   <?php if (!(strcmp($row_sel['robots'],"index,nofollow"))) {echo "checked=\"checked\"";} ?> name="robots" type="radio" value="index,nofollow" />
                                                                &nbsp;&nbsp;&nbsp;&nbsp;<b>Follow</b>&nbsp;
                                                                <input   <?php if (!(strcmp($row_sel['robots'],"noindex,follow"))) {echo "checked=\"checked\"";} ?> name="robots" type="radio" value="noindex,follow" />
                                                                &nbsp;&nbsp;&nbsp;&nbsp;<b>Disallow</b>&nbsp;
                                                                <input  <?php if (!(strcmp($row_sel['robots'],"noindex,nofollow"))) {echo "checked=\"checked\"";} ?> name="robots" type="radio" value="noindex,nofollow" />
                                                                &nbsp;&nbsp;&nbsp;&nbsp;<b>Allow</b>&nbsp;
                                                                <input  <?php if (!(strcmp($row_sel['robots'],"index,follow"))) {echo "checked=\"checked\"";} ?> name="robots" type="radio" value="index,follow" /></td>
                                                            </tr>
                                                          </table></td>
                                                      </tr>
                                                      <tr valign="baseline">
                                                        <td colspan="3" align="left" valign="top" nowrap class="smalltext">&nbsp;</td>
                                                      </tr>
                                                      <tr valign="baseline">
                                                        <td colspan="3" align="left" valign="top" nowrap class="smalltext"><strong>Content text : </strong></td>
                                                      </tr>
                                                      <tr valign="baseline">
                                                        <td colspan="3" align="left" valign="top" nowrap class="smalltext">&nbsp;</td>
                                                      </tr>
                                                      <tr valign="baseline">
                                                        <td colspan="3" align="center" valign="top" nowrap class="smalltext"><?php
															if (!(isset($_POST["content_desc"]))) {
																$content = stripslashes($row_sel['content_desc']);
															} else {
																$content = stripslashes($_POST["content_desc"]);
															}
 													  ?>
                                                      <textarea id="content_desc" name="content_desc"><?=$content?></textarea>
                                                      <script type="text/javascript">
															CKEDITOR.replace( 'content_desc' );
 													  </script>
                                                      </td>
                                                      </tr>
                                                      <tr valign="baseline">
                                                        <td align="center" valign="top" nowrap class="smalltext">&nbsp;</td>
                                                        <td colspan="2">&nbsp;</td>
                                                      </tr>
                                                      <tr valign="baseline">
                                                        <td align="left" nowrap class="smalltext" valign="top"><strong>Google Analytics : </strong></td>
                                                        <td colspan="2"><textarea type="text" name="google_analytics" rows="5" cols="62"><?=$_POST['google_analytics']?$_POST['google_analytics']:$row_sel['google_analytics']?>
</textarea></td>
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
                                                        <td colspan="3" align="left" valign="top" nowrap class="smalltext">&nbsp;</td>
                                                      </tr>
                                                    </table>
                                                  </div></td>
                                              </tr>
                                              <tr valign="baseline">
                                                <td nowrap align="right">&nbsp;</td>
                                                <td colspan="2"><input name="submit" type="submit" value="Save Page">
                                                  <input name="language" type="hidden" id="language" value="en">
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
							?>
                                        </td>
                                      </tr>
                                    </table></td>
                                </tr>
                              </table></td>
                          </tr>
                        </table></td>
                    </tr>
                  </table></td>
              </tr>
            </table></td>
          <td background="<?=$path?>images/index_21.gif"><img src="<?=$path?>images/spacer.gif" width="46" height="100" /></td>
        </tr>
        <tr>
          <td><img src="<?=$path?>images/index_37.gif" width="46" height="48" alt="" /></td>
          <td background="<?=$path?>images/index-over_38.gif">&nbsp;</td>
          <td><img src="<?=$path?>images/index_40.gif" width="47" height="48" alt="" /></td>
        </tr>
      </table></td>
  </tr>
  <tr>
    <td><img src="<?=$path?>images/index_41.gif" width="1100" height="52" alt="" /></td>
  </tr>
</table>
</body>
</html>
