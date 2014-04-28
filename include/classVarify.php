<?php

class varify{

	

	function search($value , $table, $conn, $path){

	

		$query = "SELECT * FROM $table 

				  WHERE encId='".$value."' AND expire=0 LIMIT 1"; // 0 = NOT EXPIRED, 1 = EXPIRED

	

		$result = mysql_query($query, $conn) or die(mysql_error());

		$data = mysql_fetch_array($result);

		$num = mysql_num_rows($result);

		if($num==1)

		{

			//EMAIL TO CUSTOMER AND SEND THE USERNAME/PASSWORD

			//UPDATE MEMBERS TABLE AND SET expire=1

			$query = "update $table set expire=1 , mem_status=1 where encId = '$value'";

			mysql_query($query) or die(mysql_error());			

			//REDIRECT TO THANKS PAGE

			

			$s_email = "SELECT * FROM `email_tbl_cb` where id = 8";

			$q_email = mysql_query($s_email, $conn) or die(mysql_error());

			$r_email = mysql_fetch_array($q_email);

			

			$message = $r_email['email_body'];

			$subject = $r_email['email_subject'];

			$internal_email = $r_email['email_add'];

			if($data['mem_customerName'] == '')
			{
				$name = $data['mem_username'];
			}
			else
			{
				$name = $data['mem_customerName']." ".$data['mem_lastName'];
			}
			$message = str_replace("CUST_NAME", $name, $message);

			$message = str_replace("CUST_EMAIL", $data['mem_email'], $message);

			$message = str_replace("CUST_PSWD", $data['mem_password1'], $message);

			

			/*$message = "Mr/Mrs! ".$data['memName']."! <br><br>

							Your login information is as follow <br>

							username: ".$data['email']."<br>

							password:".$data['field2']."<br>

							<a href='".$path."login.html'>Click Here to login</a>

							<br>

							<br><br>Chalbasy Team";*/

		

			$to 			= $data['mem_email'];

			

			/*$s_adminemail 	= "SELECT * FROM `admin_setting` where config_id = 7";

			$q_adminemail 	= mysql_query($s_adminemail, $conn) or die(mysql_error());

			$r_adminemail 	= mysql_fetch_array($q_adminemail);

			$admin_email = $r_adminemail['config_value'];*/

			

			$from 			= "".$domain_name." <".$internal_email.">";

			$headers  = "";

			$headers .= "MIME-Version: 1.0\r\n"; 

			$headers .= "Content-type: text/html;charset=iso-8859-1\r\n";

			$headers .= "From: ".$from."\r\n";

			$headers .= "Reply-To: ".$internal_email."\r\n";

			//$headers .= "Bcc: ".$admin_email."\n";

			$headers .= "X-Priority: 1\r\n"; 

			$headers .= "X-MSMail-Priority: High\r\n"; 

			$headers .= "X-Mailer: Just My Server";

			

			

			mail("$to","$subject","$message","$headers"); 						  
			echo "<script>window.location='confirmation-page.htm';</script>";
			/*echo "<script> alert('Congratualations registration completed successfully! Please check your email.');</script>";*/

			echo "<script>window.location.replace('confirmation-page.htm')</script>";

		 }

		 else  echo "<script>window.location.replace('sorry.html')</script>";

	}

	

	function authentication( $value , $redirect ){

			$query = "SELECT encId FROM members WHERE mem_id = $_SESSION[memberID]";

			$result = mysql_query($query) or die(mysql_error());

			$data = mysql_fetch_row($result);

			if( $data[0]!=$value )

			echo "<script> alert('authentication fail, you are not allowed to access this page');

						window.location.replace('" . $redirect . "')</script>"; 

	}

}

?>