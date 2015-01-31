<?php
    $respone=array();
    $response['function'] = 'fncResetPassword';
    $screenID = "";
    if($_POST['screenID'] != 'undefined'){
        $screenID = $_POST['screenID'];
    }
    $response['screenID'] = $screenID;
    
    $email=$_POST['email'];
    require_once __DIR__ .'/db_connect.php';
    $db = new DB_CONNECT();
    
    $sql = mysql_query("select * from customer where email='$email'") ;
	$sql2 = mysql_query("select * from partner where email='$email'") ;
    if (mysql_num_rows($sql) == 1 || mysql_num_rows($sql2) == 1) {
		if(mysql_num_rows($sql) == 1 ){
			$row = mysql_fetch_array($sql);
			$passReset = rand_string(6);
			$passEndcode = md5($passReset);

				$to = $email;
				$subject = "Reset password";
				$txt = "Hi ".$row['firstName']." ".$row['lastName']."\n\n";
				$txt .= "Your new password : ".$passReset;
				$headers = "From: webmaster@example.com" . "\r\n" ;

				mail($to,$subject,$txt,$headers);
			$reset = mysql_query("update customer set password = '$passEndcode' where email = '$email'") ;
			
			$response["responseCode"] = 1;
			$response["msg"] = "Reset password successful";

			echo json_encode($response);
		}else{
			$row = mysql_fetch_array($sql2);
			$passReset = rand_string(6);
			$passEndcode = md5($passReset);

				$to = $email;
				$subject = "Reset password";
				$txt = "Hi ".$row['firstName']." ".$row['lastName']."\n\n";
				$txt .= "Your new password : ".$passReset;
				$headers = "From: webmaster@example.com" . "\r\n" ;

				mail($to,$subject,$txt,$headers);
			$reset = mysql_query("update partner set password = '$passEndcode' where email = '$email'") ;
			
			$response["responseCode"] = 1;
			$response["msg"] = "Reset password successful";

			echo json_encode($response);
		}
	}else {
    $response["responseCode"]=0;
    $response["msg"]="failed reset not found email";
    echo json_encode($response);
    }
    //create random string
    function rand_string( $length ) {
    $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
    $size = strlen( $chars );
    for( $i = 0; $i < $length; $i++ ) {
    $str .= $chars[ rand( 0, $size - 1 ) ];
     }
    return $str;
    }

?>