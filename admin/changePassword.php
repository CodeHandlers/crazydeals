<?
if(isset($_POST['Submit']))
{
	if(isset($_POST['newpass']))
	{
	$newpass=md5($_POST['newpass']);
	}
	//$userid=$_POST['userid'];
	
	$sqlcon="SELECT * FROM siteadmin WHERE pswd='".md5($_POST['oldpass'])."'";	
	$resultcon= mysql_query($sqlcon) or die(mysql_error());
	if(mysql_num_rows($resultcon)<1)
	{ 
		$msg="Old Password is not correct";
	}
	if(mysql_num_rows($resultcon)>0)
	{
		$sql="UPDATE siteadmin set pswd='".$newpass."', pswd2='$_POST[newpass]', ip='".$_SERVER['REMOTE_ADDR']."'";
	
		$result= mysql_query($sql) or die(mysql_error());
		if($result)
		$msg="Password updated successfully";
		  
	}	
}
?>
<script language="javascript">
function checkblank()
{
	if(document.getElementById("oldpass").value=='')
	{
		alert("Please fill old password field");
		document.getElementById("oldpass").focus();
		return false;
	}
	else 
	if(document.getElementById("newpass").value=='')
	{
		alert("Please fill new password field");
		document.getElementById("newpass").focus();
		return false;
	}
	else if(document.getElementById("confirmpass").value=='')
	{
		alert("Please fill confirm password field");
		document.getElementById("confirmpass").focus();
		return false;
	}
	else if(document.getElementById("confirmpass").value!=document.getElementById("newpass").value)
	{
		alert("New password and confirm password should be same");
		document.getElementById("confirmpass").focus();
		return false;
	}
}
</script>
<form action="" method="post"  name="form1" id="form1">
  <table width="80%"  border="0" align="center" cellpadding="0" cellspacing="0">
    
    <tr>
      <td height="30" colspan="2" align="center" class="smalltext">If you want to change the password, Then please enter the following information </td>
    </tr>
    <tr>
      <td colspan="2" align="center" class="Redsmalltext"><?php echo $msg?></td>
    </tr>
    <tr>
      <td width="31%" height="30" align="right" class="Main_heading3"><span class="smalltext">Old Password: </span></td>
      <td width="69%" align="left" class="EM_data_table_inputarea11"><input name="oldpass" type="password" class="txtField1" id="oldpass" size="30">
      <font class="Redsmalltext">*</font> </td>
    </tr>
    <tr>
      <td height="30" align="right" class="Main_heading3"><span class="smalltext">New Password: </span></td>
      <td align="left" class="EM_data_table_inputarea11"><input name="newpass" type="password" class="txtField1" id="newpass" size="30" maxlength="20">
          <font class="Redsmalltext">*(Max 20 characters) </font></td>
    </tr>
    <tr>
      <td height="30" align="right" class="smalltext">Confirm Password: </td>
      <td align="left" class="EM_data_table_inputarea11"><input name="confirmpass" type="password" class="txtField1" id="confirmpass" size="30" maxlength="20">
          <font class="Redsmalltext">*(Max 20 characters)</font></td>
    </tr>
    <tr>
      <td height="30">&nbsp;</td>
      <td align="left" class="EM_data_table_inputarea11"><input type="submit" name="Submit" value="Update" onClick="return checkblank();">      </td>
    </tr>
  </table>
</form>