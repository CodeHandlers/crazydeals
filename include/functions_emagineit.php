<?php
class EmagineIT
{
	function getRssFeeds($type)
	{
		require_once('rss/xml_domit_rss.php');	
		$feeds = $type;
		//echo count($feeds);
		$cacheDir = 'cache/';
		$cacheTime = 3600;
		$stories = array();
		//echo $feeds;
		/*foreach ($feeds as $feed) 
		{*/
			//echo "dasfdsafdsfadf";
			//print_r($feed);
			$rssdoc =& new xml_domit_rss_document($feeds, $cacheDir, $cacheTime);
		//	echo $rssdoc ;
			$totalChannels = $rssdoc->getChannelCount();
			for ($i = 0; $i < $totalChannels; $i++) 
			{
				$currChannel =& $rssdoc->getChannel($i);
				$ctitle = $currChannel->getTitle();
				$cimage = $cimageurl = "";
				$cimage = $currChannel->getImage();
				if (!empty($cimage))
					$cimageurl = $cimage->getUrl();
	
				//get total number of items
				$totalItems = $currChannel->getItemCount();
				
				//loop through each item
				for ($j = 0; $j < $totalItems; $j++) 
				{
					$currItem =& $currChannel->getItem($j);
					
					$date = strtotime($currItem->getPubDate());
					if (!$date)
						$date = strtotime(str_replace(substr($currItem->getPubDate(), -6, 6), "Z", $currItem->getPubDate()));
					if (!$date)
						$date = time();
					$stories[] = array('date' => date("Y-m-d H:i:s", $date),
										'title' => $currItem->getTitle(),
										'link' => $currItem->getLink(),
										'description' => strip_tags($currItem->getDescription()),
										'description_html' => $currItem->getDescription(),
										'PK_ID' => $j,
										'feed_title' => $ctitle,
										'image' => $cimageurl);
				}
			}
		
		/*}*/
		return $stories;
	}
	function display_page_all_news($conn , $type)
	{
	  $sql = "SELECT * FROM news WHERE nstatus = 1 and ntype = '".$type."' order by orderid";
	  $res = mysql_query($sql, $conn) or die(mysql_error());
	  return $res;
	}
	function display_deal_of_the_day()
	{
		$sql = "SELECT * FROM product WHERE prd_dod = 1 and prd_status = 1 order by rand() LIMIT 0,1";
	  	$res = mysql_query($sql) or die(mysql_error());
	  	$row = mysql_fetch_array($res);
		return $row;
	}
	function paypal_info($id)
	{
		$s1_paypal_business_link = "select * from paypalinfo_tbl_cb where 1 and id = '".$id."'";
		$q1_paypal_business_link = mysql_query($s1_paypal_business_link) or die($s1_paypal_business_link);
		$r1_paypal_business_link = mysql_fetch_array($q1_paypal_business_link);
		return $r1_paypal_business_link["txt_value"];
	}
	function authorize_info($id)
	{
		$s1_authorize_business_link = "select * from authorizeinfo_tbl_cb where 1 and authid = '".$id."'";
		$q1_authorize_business_link = mysql_query($s1_authorize_business_link) or die($s1_authorize_business_link);
		$r1_authorize_business_link = mysql_fetch_array($q1_authorize_business_link);
		return $r1_authorize_business_link["authValue"];
	}
	function google_info($id)
	{
		$s1_authorize_business_link = "select * from googleinfo_tbl_cb where 1 and gid = '".$id."'";
		$q1_authorize_business_link = mysql_query($s1_authorize_business_link) or die($s1_authorize_business_link);
		$r1_authorize_business_link = mysql_fetch_array($q1_authorize_business_link);
		return $r1_authorize_business_link["gvalue"];
	}
	function paypal_invoice_no()
	{
		$s1_paypal_business_link = "select max(paypal_id) as invoice from paypal_reply where 1";
		$q1_paypal_business_link = mysql_query($s1_paypal_business_link) or die($s1_paypal_business_link);
		$r1_paypal_business_link = mysql_fetch_array($q1_paypal_business_link);
		return $r1_paypal_business_link["invoice"] + 1;
	}
	function display_page_video()
	{
	  $sql = "SELECT * FROM homepage_images WHERE home_status = 1 order by rand() LIMIT 0,1";
	  $res = mysql_query($sql) or die(mysql_error());
	  $row = mysql_fetch_array($res);
	 /* if(is_file('../videos/'.$row["home_image"]))
	  {*/
	  	return $row["home_image"];
	  /*}*/
	}
	function rss_proper_html($rsshtml)
	{
		$rsshtml = str_replace("&","&amp;",$rsshtml);
		$rsshtml = str_replace("\"","&quot;",$rsshtml);
		$rsshtml = str_replace("<","&lt;",$rsshtml);
		$rsshtml = str_replace(">","&gt;",$rsshtml);
		$rsshtml = str_replace(" ","&nbsp;",$rsshtml);
		$rsshtml = str_replace(" ","&",$rsshtml);
		return $rsshtml;
	}
	function display_page($physical_name, $conn , $where = NULL )
	{
	  $sql = "SELECT * FROM contents WHERE page_physical_name='".$physical_name."' ".$where;
//	  print $sql;
	  $res = mysql_query($sql, $conn) or die(mysql_error());
	  $row = mysql_fetch_array($res);
//	  echo "TEST:- ".$row['cont_header'];
	  return $row;
	}
	function display_homepage_images($path)
	{
		$i = 1;
		$images = '';
	  $sql = "SELECT * FROM homepage_images WHERE 1 and home_status = 1 order by orderid";
	  $res = mysql_query($sql) or die(mysql_error());
	  while($row = mysql_fetch_array($res))
	  {
	  	if($i == 1)
		{
			$images .= "\"".$path."images/".$row["home_image"]."\"";
		}
		else
		{
			$images .= " ,\"".$path."images/".$row["home_image"]."\"";
		}
		$i ++;
	  }
	  return $images;
	}
	function display_buildings_and_appartments_images($path,$page_id,$type)
	{
		$i = 1;
		$images = '';
		$s1_building_image = "select * from buildings_appartments_images where building_image_building_id = '".$page_id."' and type = '".$type."' order by orderid";
		$q1_building_image = mysql_query($s1_building_image) or die($s1_building_image);
		while($r1_building_image = mysql_fetch_array($q1_building_image))
		{
			$building_image = $r1_building_image["building_image"];
			if($i == 1)
			{
				$images .= "\"".$path."images/property/".$building_image."\"";
			}
			else
			{
				$images .= " ,\"".$path."images/property/".$building_image."\"";
			}
			$i ++;
		}
	  return $images;
	}
	function display_homepage_first_image($path)
	{
	  $sql = "SELECT * FROM homepage_images WHERE 1 and home_status = 1 order by orderid LIMIT 0,1";
	  $res = mysql_query($sql) or die(mysql_error());
	  $row = mysql_fetch_array($res);
	  $image = $path."images/".$row["home_image"];
	  return $image;
	}
	function display_page_building_appartment_detail($physical_name, $conn , $type , $where = NULL)
	{
		 $sql = "SELECT * FROM buildings_appartments_detail left outer join property_type on property_type_id = building_property_type left outer join building_type on building_type_id = building_typeid WHERE page_physical_name ='".$physical_name."' and building_status = 1 ".$where;
		  $res = mysql_query($sql, $conn) or die(mysql_error());
		  $row = mysql_fetch_array($res);
		  return $row;
	}
	function display_page_appartment_detail($physical_name, $conn , $type , $where = NULL)
	{
		 $sql = "SELECT * FROM appartment_availability_details left outer join buildings_appartments_detail on building_id = available_building_id  left outer join property_type on property_type_id = building_property_type left outer join building_type on building_type_id = building_typeid WHERE appartment_availability_details.page_physical_name ='".$physical_name."' and available_status = 1 ".$where;
		  $res = mysql_query($sql, $conn) or die(mysql_error());
		  $row = mysql_fetch_array($res);
		  return $row;
	}
	function display_contact_info()
	{
	  $sql = "SELECT * FROM contact_info left outer join countries on countries_id = contact_country  WHERE 1";
	  $res = mysql_query($sql) or die(mysql_error());
	  $row = mysql_fetch_array($res);
	  return $row;
	}
	function adminMailBox( $id ){
		$query = "SELECT * FROM email_tbl_cb WHERE id = '$id'";
		$result = mysql_query($query);
		$mail = mysql_fetch_array($result);
		return $mail;
	}
	function display_password_protected($physical_name, $conn , $where = NULL )
	{
	  $sql = "SELECT * FROM contents WHERE page_physical_name='".$physical_name."' and password_protected = '1' ".$where;
	  $res = mysql_query($sql, $conn) or die(mysql_error());
	  $row = mysql_num_rows($res);
	  return $row;
	}
	function display_page_type($physical_name, $conn , $type , $where = NULL )
	{
	  $sql = "SELECT * FROM news WHERE page_physical_name ='".$physical_name."' and nstatus = 1 and ntype = '".$type."' ".$where;
//	  print $sql;
	  $res = mysql_query($sql, $conn) or die(mysql_error());
	  $row = mysql_fetch_array($res);
//	  echo "TEST:- ".$row['cont_header'];
	  return $row;
	}
	function display_page_newsletter($physical_name, $conn , $type , $where = NULL )
	{
	  $sql = "SELECT * FROM newsletter WHERE page_physical_name ='".$physical_name."' and status = 1 ".$where;
//	  print $sql;
	  $res = mysql_query($sql, $conn) or die(mysql_error());
	  $row = mysql_fetch_array($res);
//	  echo "TEST:- ".$row['cont_header'];
	  return $row;
	}
	function product($physical_name)
	{
	  $sql = "SELECT * FROM product WHERE prd_name ='".$physical_name."' and prd_status = 1 ";
//	  print $sql;
	  $res = mysql_query($sql, $conn) or die(mysql_error());
	  $row = mysql_fetch_array($res);
//	  echo "TEST:- ".$row['cont_header'];
	  return $row;
	}
	function display_page_portfolio($physical_name, $conn , $type , $where = NULL )
	{
	  $sql = "SELECT * FROM funds_access WHERE page_physical_name ='".$physical_name."' and fundaccess_status = 1 ".$where;
//	  print $sql;
	  $res = mysql_query($sql, $conn) or die(mysql_error());
	  $row = mysql_fetch_array($res);
//	  echo "TEST:- ".$row['cont_header'];
	  return $row;
	}
	function display_page_funds($physical_name, $conn , $type , $where = NULL )
	{
	  $sql = "SELECT * FROM property WHERE page_physical_name ='".$physical_name."' and status = 1 ".$where;
//	  print $sql;
	  $res = mysql_query($sql, $conn) or die(mysql_error());
	  $row = mysql_fetch_array($res);
//	  echo "TEST:- ".$row['cont_header'];
	  return $row;
	}
	function display_page_album($physical_name, $conn , $type , $where = NULL )
	{
	  $sql = "SELECT * FROM albums WHERE page_physical_name ='".$physical_name."' and album_status = 1 ".$where;
//	  print $sql;
	  $res = mysql_query($sql, $conn) or die(mysql_error());
	  $row = mysql_fetch_array($res);
//	  echo "TEST:- ".$row['cont_header'];
	  return $row;
	}
	function display_page_type_active($conn , $type , $where = NULL )
	{
	  $sql = "SELECT * FROM news WHERE ntype = '".$type."' and nstatus = 1 ".$where;
//	  print $sql;
	  $res = mysql_query($sql, $conn) or die(mysql_error());
	  //$row = mysql_fetch_array($res);
//	  echo "TEST:- ".$row['cont_header'];
	  return $res;
	}
	function display_main_type($conn , $type , $where = NULL )
	{
	  $sql = "SELECT * FROM news WHERE ntype = '".$type."' and nstatus = 1 and main = 1 ".$where;
	  $res = mysql_query($sql, $conn) or die(mysql_error());
	  $row = mysql_fetch_array($res);
	  return $row;
	}
	function display_main_comment($conn , $type , $where = NULL )
	{
	  $sql = "SELECT * FROM visitor_comments WHERE cmt_status = 1 order by cmt_id desc LIMIT 0,1";
	  $res = mysql_query($sql, $conn) or die(mysql_error());
	  $row = mysql_fetch_array($res);
	  return $row;
	}
	function display_main_image_type($conn , $type , $where = NULL )
	{
	  $sql = "SELECT * FROM header_images WHERE header_picture_type = '".$type."' and header_mv_id in (select mv_id from mv) and header_status = 1 and main = 1 order by rand() LIMIT 0,1";
	  $res = mysql_query($sql, $conn) or die(mysql_error());
	  $row = mysql_fetch_array($res);
	  return $row["header_bigimage"];
	}
	function display_main_image_type_size($image)
	{
	  list($width, $height, $type, $attr) = getimagesize("images/gallery/thumbs/".$image);
	  if($height > $width)
	  {
	  	$height = "3";
	  }
	  else
	  {
	  	$height = "40";
	  }
	  return $height;
	}
	function display_main_video_type($conn , $where = NULL )
	{
	  $sql = "SELECT * FROM header_video WHERE header_status = 1 and main = 1 ".$where;
	  $res = mysql_query($sql, $conn) or die(mysql_error());
	  $row = mysql_fetch_array($res);
	  return $row["header_bigimage"];
	}
	function display_page_physical_name($conn , $type , $where = NULL )
	{
	  $sql = "SELECT * FROM news WHERE ntype = '".$type."' and nstatus = 1 ".$where;
//	  print $sql;
	  $res = mysql_query($sql, $conn) or die(mysql_error());
	  while($row = mysql_fetch_array($res))
	  {
		$page_title = $row["page_physical_name"];
		break;
	  }
	  //echo $page_title;
	  return $page_title;
	}
	function encrypt($plain_text) {
	$key = 'khurram';
	$plain_text = trim($plain_text);
	$iv = substr(md5($key), 0,mcrypt_get_iv_size (MCRYPT_CAST_256,MCRYPT_MODE_CFB));
	$c_t = mcrypt_cfb (MCRYPT_CAST_256, $key, $plain_text, MCRYPT_ENCRYPT, $iv);
	return trim(chop(base64_encode($c_t)));
	}
	
	function decrypt($c_t) {
	$key = 'khurram';
	$c_t =  trim(chop(base64_decode($c_t)));
	$iv = substr(md5($key), 0,mcrypt_get_iv_size (MCRYPT_CAST_256,MCRYPT_MODE_CFB));
	$p_t = mcrypt_cfb (MCRYPT_CAST_256, $key, $c_t, MCRYPT_DECRYPT, $iv);
	return trim(chop($p_t));
	}
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