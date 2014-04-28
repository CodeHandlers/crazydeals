<?php
//include('../include/SiteState.php') ;
//$obj_st = new SiteState() ;
?>

<script language="javascript">
function logout(){
	if( confirm("Are you sure you want to logout") ) 
		  window.location = "logout.php" ;
}
</script>
<table width="80%"  border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td><table width="80%"  border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td height="31" class="blueBarborder"><table width="97%"  border="0" align="center" cellpadding="0" cellspacing="0">
          <tr>
            <td align="center" class="blackTxt">Settings Menu </td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td  class="blueBarborder2" valign="top">
		
<div style="float: left" id="my_menu" class="sdmenu">
    <div>
        <span>Manage Pages</span>
		<a href="container.php?vu=viewcontents">Manage Pages/Add New</a>
		<?
			$s1_st_pgs = "select * from contents where 1 order by orderid";
			$q1_st_pgs = mysql_query($s1_st_pgs) or die($s1_st_pgs);
			while($r1_st_pgs = mysql_fetch_array($q1_st_pgs))
			{?>
			<a href="contents.php?vu=<?=$r1_st_pgs['content_title']?>&code=<?=$r1_st_pgs['id']?>" class="grayLink"><?=$r1_st_pgs["content_title"]?></a>
			<? }
		?>
	</div>
	<div>
        <span>Manage Categories</span>
		<a href="container.php?vu=viewcategories">Manage Categories/Add New</a>
		<?
			$s1_st_pgs = "select * from categories where 1 ORDER BY `categories`.`sort_order` ASC";
			$q1_st_pgs = mysql_query($s1_st_pgs) or die($s1_st_pgs);
			while($r1_st_pgs = mysql_fetch_array($q1_st_pgs))
			{?>
			<a href="categories-contents.php?vu=<?=$r1_st_pgs['cat_name']?>&code=<?=$r1_st_pgs['cat_id']?>" class="grayLink"><?=$r1_st_pgs["cat_name"]?></a>
			<? }
		?>
	</div>
	<div>
        <span>Administrator</span>
		<a href="container.php?vu=invoices">Manage Invoices</a>
		<a href="container.php?vu=Paypall Info">Paypal Account Infomation</a>
        <a href="container.php?vu=Google Info">Google Account Infomation</a>
        <a href="container.php?vu=Authorize Info">Authorize Account Infomation</a>
		<a href="container.php?vu=Homepage_images" class="grayLink">Homepage Videos Info</a>
		<a href="container.php?vu=email" class="grayLink">Set Email Body</a>
        <a href="container.php?vu=changepassword"  class="grayLink">Change Password</a>
	</div>
</div>		
		
		</td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td height="6"><img src="images/spacer.gif" width="1" height="1" /></td>
  </tr>
  <tr>
    <td bgcolor="#dbedf1" class="blueBarborder2"><table width="98%"  border="0" align="center" cellpadding="4" cellspacing="0">
      <tr>
        <td class="black2">Administrator</td>
      </tr>
      <tr>
        <td class="bodyText">Copyright @ 2014 <?=$domain_name?>. All Rights Reserved. Privacy Policy</td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td align="right"><a href="javascript:logout()"><img src="images/logout.jpg" width="53" height="19" border="0" /></a></td>
  </tr>
  <tr>
    <td align="right">&nbsp;</td>
  </tr>
</table>