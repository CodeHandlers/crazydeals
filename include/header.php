<?

	if(isset($_REQUEST['login']))

	{

		$qr = "select * from members where mem_username = '".$_REQUEST['topusername']."' AND mem_password1 = '".$_REQUEST['toppassword']."' and mem_status = '1'";

		$res = mysql_query($qr) or die($qr.mysql_error());

		if(mysql_num_rows($res) > 0)

		{

			$row = mysql_fetch_array($res);

			$_SESSION['loggin'] = 'Yes';
			$_SESSION['userid'] = $row['mem_id'];
			$_SESSION['username'] = $row['mem_username'];
			$_SESSION['saddress'] = $row['mem_shipping'];
			echo "<script language='javascript'>

				window.location = '".$path."index.htm';

			 </script>";

		}

		else

		{

			echo "<script language='javascript'>

						alert('Sorry, The username or password is wrong!');

						window.location = '".$path."register.htm';

					 </script>";

		}

	}

?>

<style type="text/css">

<!--

.style1 {color: #FFFF00}

-->

</style>

<div id="topbgcontainer" align="center">

<div id="topheadnew" align="left"><a href="<?=$path?>index.htm"><img src="images/jizbeelogotopnew1.gif" width="371" height="63" border="0" /></a></div>

<div id="topcontainer" align="left">

<div id="topleftlogo"><a href="<?=$path?>index.htm"><img src="<?=$path?>images/jizbeelogo-left.gif" border="0"/></a></div>

<div id="topright"></div>

<!--<div id="topnavigationcontainer"><a href="<?=$path?>index.htm" onmouseout="MM_swapImgRestore()" onmouseover="MM_swapImage('Image1','','<?=$path?>images/home-over.gif',1)"><img src="<?=$path?>images/home.gif" name="Image1" width="62" height="29" border="0" id="Image1" /></a><img src="<?=$path?>images/navseperator1.gif" width="7" height="29" alt="" /><a href="<?=$path?>about-us.htm" onmouseout="MM_swapImgRestore()" onmouseover="MM_swapImage('Image3','','<?=$path?>images/aboutus-over.gif',1)"><img src="<?=$path?>images/aboutus.gif" name="Image3" width="99" height="29" border="0" id="Image3" /></a><img src="<?=$path?>images/navseperator2.gif" width="8" height="29" alt="" /><a href="<?=$path?>news.htm" onmouseout="MM_swapImgRestore()" onmouseover="MM_swapImage('Image5','','<?=$path?>images/news-over.gif',1)"><img src="<?=$path?>images/news.gif" name="Image5" width="88" height="29" border="0" id="Image5" /></a><img src="<?=$path?>images/navseperator3.gif" width="8" height="29" alt="" /><a href="<?=$path?>products.htm" onmouseout="MM_swapImgRestore()" onmouseover="MM_swapImage('Image7','','<?=$path?>images/products-over.gif',1)"><img src="<?=$path?>images/products.gif" name="Image7" width="118" height="29" border="0" id="Image7" /></a><img src="<?=$path?>images/navseperator4.gif" width="7" height="29" alt="" /><a href="<?=$path?>contact.htm" onmouseout="MM_swapImgRestore()" onmouseover="MM_swapImage('Image9','','<?=$path?>images/contactus-over.gif',1)"><img src="<?=$path?>images/contactus.gif" name="Image9" width="122" height="29" border="0" id="Image9" /></a><img src="<?=$path?>images/navseperator5.gif" width="4" height="29" alt="" /><a href="<?=$path?>blog.htm" onmouseout="MM_swapImgRestore()" onmouseover="MM_swapImage('Image11','','<?=$path?>images/blog-over.gif',1)"><img src="<?=$path?>images/blog.gif" name="Image11" width="56" height="29" border="0" id="Image11" /></a><img src="<?=$path?>images/naviright.gif" width="181" height="29" alt="" /></div>-->

<div id="topnavigationcontainer" align="left"><img src="<?=$path?>images/navseperator5.gif" width="71" height="29" alt="" /><a href="<?=$path?>index.htm" onmouseout="MM_swapImgRestore()" onmouseover="MM_swapImage('Image1','','<?=$path?>images/home-over.gif',1)"><img src="<?=$path?>images/home.gif" name="Image1" width="62" height="29" border="0" id="Image1" /></a><img src="<?=$path?>images/navseperator1.gif" width="7" height="29" alt="" /><a href="<?=$path?>about-us.htm" onmouseout="MM_swapImgRestore()" onmouseover="MM_swapImage('Image3','','<?=$path?>images/aboutus-over.gif',1)"><img src="<?=$path?>images/aboutus.gif" name="Image3" width="99" height="29" border="0" id="Image3" /></a><img src="<?=$path?>images/navseperator2.gif" width="8" height="29" alt="" /><a href="<?=$path?>how-its-work.htm" onmouseout="MM_swapImgRestore()" onmouseover="MM_swapImage('Image7','','<?=$path?>images/products-over.gif',1)"><img src="<?=$path?>images/products.gif" name="Image7" width="118" height="29" border="0" id="Image7" /></a><img src="<?=$path?>images/navseperator4.gif" width="7" height="29" alt="" /><a href="<?=$path?>contact.htm" onmouseout="MM_swapImgRestore()" onmouseover="MM_swapImage('Image9','','<?=$path?>images/contactus-over.gif',1)"><img src="<?=$path?>images/contactus.gif" name="Image9" width="122" height="29" border="0" id="Image9" /></a><img src="<?=$path?>images/navseperator5.gif" width="90" height="29" alt="" /><a href="<?=$path?>contact.htm" onmouseout="MM_swapImgRestore()" onmouseover="MM_swapImage('Image11','','<?=$path?>images/blog-over.gif',1)"></a><img src="images/naviright.gif" width="106" height="29" alt="" /></div>

</div>

<div id="topshadow"></div>

<div id="topsearchbarbg" align="center">

	<?

		if(!isset($_SESSION['loggin']))

		{

	?>

  <form action="" method="post" name="frmLogin"><table width="500" border="0" align="center" cellpadding="0" cellspacing="0">

    <tr>

      <!--<td width="188" align="left" class="yellowheadingtext">Quick Search </td>

      <td width="122" align="left" class="yellowheadingtext">Advanced Search</td>

      <td width="69" align="left" class="yellowheadingtext">&nbsp;</td>

      <td width="16" rowspan="2" align="center" class="yellowheadingtext"><img src="<?=$path?>images/searchseperator.gif" width="5" height="39" /></td>

      <td width="166" align="left" class="yellowheadingtext">&nbsp;</td>

      <td width="18" rowspan="2" align="center" class="yellowheadingtext"><img src="<?=$path?>images/searchseperator.gif" width="5" height="39" /></td>-->

      <td width="158" align="left" class="yellowheadingtext" style="padding-left:35px;"><a href="<?=$path?>forget_password.htm"><font color="#FFCC00" style="font-weight:normal; font-size:12px">Forgot your password?</font></a></td>

      <td width="15" rowspan="2" align="center" class="yellowheadingtext"><img src="<?=$path?>images/searchseperator.gif" width="5" height="39" /></td>

	  <td colspan="2" align="left" class="yellowheadingtext">Member Login</td>
      </tr>

    <tr>

      <!--<td align="left"><input name="textfield" type="text" class="bodytext" size="30" /></td>

      <td align="left"><select name="select">

        <option>List Categories</option>

      </select>     </td>

      <td align="left"><a href="#"><img src="<?=$path?>images/searchbtn.gif" width="68" height="22" border="0" /></a></td>-->

      <td align="center" style="padding-left:30px"><a href="<?=$path?>register.htm"><img src="<?=$path?>images/signupbtn.gif" width="158" height="22" border="0" /></a></td>

      <td width="106" align="left"><input name="topusername" type="text" class="bodytext" size="10" /></td>

	  <td width="85" align="left"><input name="toppassword" type="password" class="bodytext" size="10" /></td>

      <td width="141" align="left">&nbsp;

        <input id="signin" name="signin" value="signin" type="image" src="<?=$path?>images/signinbtn.gif" /></td>
    </tr>

  </table>

  <input name="login" value="Login" type="hidden" />

  </form>

  <?

  	}

	else

	{

  ?>

  <table width="500" border="0" cellspacing="0" cellpadding="0">

  <tr>

    <td class="yellowheadingtext" style="padding-left:20px" align="left" ></td>

    <td class="yellowheadingtext" style="padding-left:20px" align="left" >
    <font color="#FFCC00" style="font-weight:normal; text-transform:capitalize;">
    	Welcome <strong><?=$_SESSION['username']?>!</strong>    </font> 
    <font color="#FFCC00" style="font-weight:normal; font-size:10px; text-transform:capitalize;">
	    [<a href="register_edit.htm"><font color="#FFCC00">Edit</font></a>] [<a href="<?=$path?>logout.php"><font color="#FFCC00">Logout</font></a>] <!--<a href="javascript:void(0);" onclick="window.open('<?=$path?>change_password.php','cp','width=500,height=300,scrollbars=no,resizable=no,toolbar=no,menubar=no,copyhistory=no'); "><font color="#FFCC00">Edit</font></a>--><!--| [<a href="<?=$path?>delete.php" onclick="return confirm('Are you sure you want to delete you account?');"><font color="#FFCC00">Delete</font></a>]-->
    </font></td>

  </tr>

</table>

	<?

		}

	?>

</div>

</div>