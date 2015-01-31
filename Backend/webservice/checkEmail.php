<?php
    $response= array();
    $response['function'] = 'fncCheckEmail';
    $screenID = "";
    if($_POST['screenID'] != 'undefined'){
        $screenID = $_POST['screenID'];
    }
    $response['screenID'] = $screenID;
    
    require_once __DIR__ .'/db_connect.php';
    $db= new DB_CONNECT();
    
    $email=$_POST['email'];
    
    $query1 = mysql_query("SELECT * FROM customer WHERE email='$email'");
    $query2 = mysql_query("SELECT * FROM partner WHERE email='$email'");
    if(mysql_num_rows($query1)>=1 || mysql_num_rows($query2)>=1){

        $response["responseCode"]=1;
        $response["msg"]="Email had been register";  
        $response['data']=true;     
        echo json_encode($response);
    } else{
        $response["responseCode"]=0;
        $response["msg"]="Email not register";
        $response['data'] = false;
        echo json_encode($response);
    }

?>