<?php session_start(); 
	
	include("authentication.php");
	
	require_once('../include/conn.php'); 
	
	require_once('../include/settings.inc.php');
	
	require_once('../include/functions_emagineit.php');
	
	require_once('../include/class.html2text.inc');
	
	$obj = new EmagineIT();
	
	?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<link rel="stylesheet" type="text/css" href="<?=$path?>/style.css">
<title>
<?=$domain_name?>
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
	
	</script>
<script type="text/javascript" src="sdmenu/sdmenu.js"></script>
<script language="javascript" type="text/javascript" src="../include/validate.js"></script>
<script language="javascript" type="text/javascript" src="calender/calendarcontrol.js"></script>
<link href="calender/CalendarControl.css" rel="stylesheet" type="text/css">
<link href="css/styleer.css" rel="stylesheet" type="text/css">
<link href="css/stylesheet.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" type="text/css" href="sdmenu/sdmenu.css" />
<link href="<?=$path?>css/viterumCSS.css" rel="stylesheet" type="text/css" />
<script language="javascript" src="<?=$path?>js/globale_jsfile.js" type="text/javascript"></script>
</head>
<body >
<table width="1100" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td width="1100"><img src="<?=$path?>images/spacer.gif" width="100" height="25" /></td>
  </tr>
  <tr>
    <td><table border="0" cellspacing="0" cellpadding="0" width="100%">
        <tr>
          <td><img src="<?=$path?>images/index_03.gif" width="46" height="57" alt="" /></td>
          <td><img src="<?=$path?>images/index_04.gif" width="1008" height="57" alt="" /></td>
          <td><img src="<?=$path?>images/index_05.gif" width="46" height="57" alt="" /></td>
        </tr>
        <tr>
          <td background="<?=$path?>images/index_07.gif"><img src="<?=$path?>images/spacer.gif" width="46" height="100" /></td>
          <td valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td>&nbsp;</td>
              </tr>
              <tr>
                <td align="left" valign="top"><table width="100%"  border="0" cellspacing="0" cellpadding="0">
                    <tr>
                      <td width="10%" valign="top"><table width="80%"  border="0" cellspacing="0" cellpadding="0">
                          <tr>
                            <td valign="top"><?php include("leftnavigation.php");?></td>
                          </tr>
                        </table></td>
                      <td width="84%" valign="top"><table width="99%"  border="0" align="center" cellpadding="0" cellspacing="0">
                          <tr>
                            <td height="233" valign="top" class="blueBarborder2"><table width="100%"  border="0" cellspacing="0" cellpadding="0">
                                <tr>
                                  <td height="31" class="blueBarborder"><table width="97%"  border="0" align="center" cellpadding="0" cellspacing="0">
                                      <tr>
                                        <td class="blackTxt">
                                        	<a href="home.php" class="blackTxt"><?=$domain_name?> - Admin Panel Home</a>
                                        </td>
                                      </tr>
                                    </table></td>
                                </tr>
                                <tr>
                                  <td height="202" valign="top" bgcolor="#dbedf1"><table width="100%"  border="0" align="center" cellpadding="0" cellspacing="0">
                                      <tr>
                                        <td height="8"><img src="images/spacer.gif" width="1" height="1"></td>
                                      </tr>
                                      <tr>
                                        <td align="center" valign="top">
										<?php
											if(isset($_GET['vu']) && $_GET['vu'] != NULL) //INCLUDE THE PAGE BASED ON QUERY STRING
											{
												switch($_GET['vu']) 
												{
													case "changepassword":
														include ("changePassword.php");
														break;
													case "viewcontents":
														include ("viewcontents.php");
														break;
													case "viewcategories":
														include ("view-categories.php");
														break;
												}
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
          <td background="<?=$path?>images/index-over_38.gif"></td>
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
