<?php session_start();
require_once('../include/conn.php'); 
require_once('../include/settings.inc.php');
include("../include/functions_emagineit.php");
	$obj = new EmagineIT();

$loginFormAction = $_SERVER['PHP_SELF'];
if (isset($_GET['accesscheck'])) 
{
  $_SESSION['PrevUrl'] = $_GET['accesscheck'];
}
if (isset($_POST['username'])) 
{
	//echo "enter";
  $loginUsername=$_POST['username'];
  $password=md5($_POST['pswd']);

  $MM_fldUserAuthorization = "";
  $MM_redirectLoginSuccess = "home.php";
  $MM_redirectLoginFailed = "index.php?verify=".md5("1");
  $MM_redirecttoReferrer = false;
  //mysql_select_db($database_conn, $conn);
  
  $LoginRS__query="SELECT login, pswd FROM siteadmin WHERE login='".$loginUsername."' AND pswd='".$password."'";
  $LoginRS = mysql_query($LoginRS__query) or die($LoginRS__query);
  $loginFoundUser = mysql_num_rows($LoginRS);
  //echo $loginFoundUser;
  if ($loginFoundUser) 
  {
     $loginStrGroup = "";  
    //declare two session variables and assign them
    $_SESSION['MM_Username'] = $loginUsername;
    $_SESSION['MM_UserGroup'] = $loginStrGroup;

    if (isset($_SESSION['PrevUrl']) && false) 
	{
      $MM_redirectLoginSuccess = $_SESSION['PrevUrl'];	
    }
	//echo $MM_redirectLoginSuccess;
	echo"<script>document.location.href='$MM_redirectLoginSuccess';</script>";
   // header("Location: " . $MM_redirectLoginSuccess );
  }
  else 
  {
  	echo"<script>document.location.href='$MM_redirectLoginFailed';</script>";
    //header("Location: ". $MM_redirectLoginFailed );
  }
}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
    <title><?=$domain_name?> - Admin Panel</title>
   <META NAME="ROBOTS" CONTENT="NOARCHIVE">
	<META NAME="ROBOTS" CONTENT="NOINDEX">
	<META NAME="ROBOTS" CONTENT="NOIMAGEINDEX">
	<META NAME="ROBOTS" CONTENT="NOFOLLOW">
</head>
<link href="<?=$path?>css/viterumCSS.css" rel="stylesheet" type="text/css" />
<link href="css/styleer.css" rel="stylesheet" type="text/css">
<script language="javascript" src="<?=$path?>js/globale_jsfile.js" type="text/javascript"></script>
</head>
<body onload="javascript:document.form1.username.focus();">
<table width="1100" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td width="1100"><img src="<?=$path?>images/spacer.gif" width="100" height="25" /></td>
  </tr>
  <tr>
    <td><table border="0" cellspacing="0" cellpadding="0" align="center">
      <tr>
        <td><img src="<?=$path?>images/index_03.gif" width="46" height="57" alt="" /></td>
        <td><img src="<?=$path?>images/index_04.gif" width="1008" height="57" alt="" /></td>
        <td><img src="<?=$path?>images/index_05.gif" width="46" height="57" alt="" /></td>
      </tr>
      <tr>
        <td background="<?=$path?>images/index_07.gif"><img src="<?=$path?>images/spacer.gif" width="46" height="100" /></td>
        <td valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0" align="center">
          <tr>
            <td><? include("../include/admin_header.php");?></td>
          </tr>
  <tr>
    <td><table width="100%" height="400" border="0" cellspacing="0" cellpadding="0" align="center">
			
          <tr>
            <td style="padding-left:10px; padding-right:10px">
			<form id="form1" name="form1" method="post" action="<?php echo $loginFormAction; ?>">
              <br />
              <table width="30%" align="center" class="displaytable">
                <tr>
                  <td colspan="2">&nbsp;</td>
                </tr>
                <tr>
                  <td colspan="2" style="color:#FF0000; font-family:Arial, Helvetica, sans-serif; font-size:10px; font-weight:normal;" align="center"><?php echo ($_REQUEST['verify']==md5("1")?"Login failed! Please check User name/ Password.":"")?>
                      <?php if($_GET["noLogin"]) echo "Please login to continue"; ?>                  </td>
                </tr>
                <tr>
                  <td class="title-info">User name:</td>
                  <td><input name="username" type="text" class="bodytext" id="username" maxlength="20" /></td>
                </tr>
                <tr>
                  <td class="title-info">Password:</td>
                  <td><input name="pswd" type="password" class="bodytext" id="pswd" maxlength="20" /></td>
                </tr>
                <tr>
                  <td>&nbsp;</td>
                  <td><input name="Submit" type="submit" value="Submit" class="buttonstyle"/></td>
                </tr>
              </table>
            </form></td>
          </tr>
          <tr>
            <td>&nbsp;</td>
          </tr>
</table></td>
      
  </tr>
 </table></td>
        <td background="<?=$path?>images/index_21.gif"><img src="<?=$path?>images/spacer.gif" width="46" height="100" /></td>
      </tr>
      <tr>
        <td><img src="<?=$path?>images/index_37.gif" width="46" height="48" alt="" /></td>
        <td background="<?=$path?>images/index-over_38.gif" class="copyrights">Copyright @ 2014, All rights reserved</td>
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

