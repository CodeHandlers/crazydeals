<?php
# FileName="Connection_php_mysql.htm"
# Type="MYSQL"
# HTTP="true"
if ($_SERVER['HTTP_HOST'] != 'localhost')
{
	$hostname_dbconn = "inform3.fatcowmysql.com";
	$rating_dbname = "jizbee";
	$username_dbconn = "hassan";
	$password_dbconn = "itlogin2k";
	/*$hostname_dbconn = "www.lowebdesign.com";
	$rating_dbname = "lowebdes_jizbee";
	$username_dbconn = "lowebdes_LotemH";
	$password_dbconn = ">It)5{lV2|th";*/
	/*if($_SERVER['SERVER_PORT'] == '80')
	{	
		header( "HTTP/1.1 301 Moved Permanently" ); 						
		$single_redirect = $single_path.$_SERVER['REQUEST_URI'];
		//echo $single_redirect;
		header("Location: $single_redirect");
	}*/
}
else
{
	$hostname_dbconn = "localhost";
	$rating_dbname = "crazydeal";
	$username_dbconn = "root";
	$password_dbconn = "";
}
$conn = mysql_pconnect($hostname_dbconn, $username_dbconn, $password_dbconn) or (mysql_error());
mysql_select_db($rating_dbname,$conn) or die(mysql_error()); 

include("settings.inc.php");
?>