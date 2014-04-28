<?php
session_start();
include("authentication.php");
require_once('../include/conn.php');
require_once('../include/settings.inc.php');
include("../include/functions_emagineit.php");
	$obj = new EmagineIT();
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<META NAME="ROBOTS" CONTENT="NOARCHIVE">
<META NAME="ROBOTS" CONTENT="NOINDEX">
<META NAME="ROBOTS" CONTENT="NOIMAGEINDEX">
<META NAME="ROBOTS" CONTENT="NOFOLLOW">
<title><?=$domain_name?> - Admin Panel</title>
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

<!--



function MM_preloadImages() { //v3.0
  var d=document; if(d.images){ if(!d.MM_p) d.MM_p=new Array();
    var i,j=d.MM_p.length,a=MM_preloadImages.arguments; for(i=0; i<a.length; i++)
    if (a[i].indexOf("#")!=0){ d.MM_p[j]=new Image; d.MM_p[j++].src=a[i];}}
}
//-->

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
<link href="css/styleer.css" rel="stylesheet" type="text/css">
<link href="css/stylesheet.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" type="text/css" href="sdmenu/sdmenu.css" />
<link href="<?=$path?>css/viterumCSS.css" rel="stylesheet" type="text/css" />
<script language="javascript" src="<?=$path?>js/globale_jsfile.js" type="text/javascript"></script>
</head>

<body>
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
        <td valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td><? include("../include/admin_header.php");?></td>
          </tr>
      
      <tr>
        <td align="left" valign="top"><table width="100%"  border="0" cellspacing="0" cellpadding="0">
              
              <tr>
                <td width="10%" valign="top">
				<table width="80%"  border="0" cellpadding="0" cellspacing="0">
                  <tr>
                    <td>
					<table width="80%"  border="0" cellspacing="0" cellpadding="0">
                      
                      <tr><td valign="top"><?php include("leftnavigation.php");?></td></tr>
                    </table>				</td>
                  </tr>
                  <tr>
                    <td height="6"><img src="images/spacer.gif" width="1" height="1"></td>
                  </tr>
                </table></td>
                <td width="84%" valign="top">
                  <table width="98%"  border="0" align="center" cellpadding="0" cellspacing="0">
                    <tr>
                      <td  valign="top" class="blueBarborder2"><table width="100%"  border="0" cellspacing="0" cellpadding="0">
                          <tr>
                            <td height="31" class="blueBarborder"><table width="97%"  border="0" align="center" cellpadding="0" cellspacing="0">
                                <tr>
                                  <td class="blackTxt">Main Site Pages</td>
                                </tr>
                            </table></td>
                          </tr>
                          <tr>
                            <td valign="top"><table width="98%"  border="0" align="center" cellpadding="0" cellspacing="0">

                                <tr>
                                  <td><table width="100%"  border="0" align="center" cellpadding="0" cellspacing="0">
                                      <tr>
                                        <td width="19%" class="blueBarborder5"><table width="95%"  border="0" align="center" cellpadding="5" cellspacing="0">
                                            <tr>
                                              <td width="20%" align="center"><img src="images/b_edit.png" width="16" height="16"></td>
                                              </tr>
                                            
                                        </table></td>
                                        <td width="81%" valign="middle"><table width="95%"  border="0" align="center" cellpadding="5" cellspacing="0">
                                            <tr>
                                              <td><?
													$s1_st_pgs = "select * from contents where 1 order by orderid";
													$q1_st_pgs = mysql_query($s1_st_pgs) or die($s1_st_pgs);
													while($r1_st_pgs = mysql_fetch_array($q1_st_pgs))
													{?>
													<a href="contents.php?vu=<?=$r1_st_pgs['content_title']?>&code=<?=$r1_st_pgs['id']?>" class="grayLink"><?=$r1_st_pgs["content_title"]?></a><b style="color:#CCCCCC"> | </b>
													<? }
												?></td>
                                              </tr>
                                            
                                        </table></td>
                                        </tr>
                                      
                                  </table></td>
                                </tr>
                            </table>
                            </td>
                          </tr>
                      </table></td>
                    </tr>
                 </table>
				<br>
				<table width="98%"  border="0" align="center" cellpadding="0" cellspacing="0">
                    <tr>
                      <td  valign="top" class="blueBarborder2"><table width="100%"  border="0" cellspacing="0" cellpadding="0">
                          <tr>
                            <td height="31" class="blueBarborder"><table width="97%"  border="0" align="center" cellpadding="0" cellspacing="0">
                                <tr>
                                  <td class="blackTxt">Administrator</td>
                                </tr>
                            </table></td>
                          </tr>
                          <tr>
                            <td valign="top"><table width="98%"  border="0" align="center" cellpadding="0" cellspacing="0">

                                <tr>
                                  <td><table width="100%"  border="0" align="center" cellpadding="0" cellspacing="0">
                                      <tr>
                                        <td width="19%" class="blueBarborder5"><table width="95%"  border="0" align="center" cellpadding="5" cellspacing="0">
                                            <tr>
                                              <td width="20%" align="center"><img src="images/b_edit.png" width="16" height="16"></td>
                                              </tr>
                                            
                                        </table></td>
                                        <td width="81%" valign="middle"><table width="95%"  border="0" align="center" cellpadding="5" cellspacing="0">
                                            <tr>
                                              <td>
													<a href="container.php?vu=changepassword" class="grayLink">Change Password/Account Info</a></td>
                                              </tr>
                                            
                                        </table></td>
                                        </tr>
                                      
                                  </table></td>
                                </tr>
                            </table>
                            </td>
                          </tr>
                      </table></td>
                    </tr>
                  </table>
<br>
</td>
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