<?php
    $response= array();
    $response['function'] = 'fncLogin';
    $screenID = "";
    if($_POST['screenID'] != 'undefined'){
        $screenID = $_POST['screenID'];
    }
    $response['screenID'] = $screenID;
    
    require_once __DIR__ .'/db_connect.php';
	require_once __DIR__ .'/config.php';
    $db= new DB_CONNECT();
    
    $email=$_POST['email'];
    $password=$_POST['password'];

    $query1 = mysql_query("SELECT * FROM customer WHERE email='$email' and password='$password'");
    $query2 = mysql_query("SELECT * FROM partner WHERE email='$email' and password='$password'");
    if(mysql_num_rows($query1)==1){
        $customer = mysql_fetch_array($query1);
        $response["responseCode"]=1;
        $response["msg"]="Successful";
        $arrCustomer = array(); 
        $arrCustomer['id'] = $customer['customerID'];
        $arrCustomer['firstName'] = $customer['firstName'];
        $arrCustomer['lastName'] = $customer['lastName'];
        $arrCustomer['email'] = $customer['phone'];
		$arrCustomer['phone'] = $customer['lastName'];
        $arrCustomer['image'] = BASE_PATH.$customer['image'];
        $arrCustomer['role'] = 2;      
        $response['data']=$arrCustomer;     
        echo json_encode($response);
    }else if(mysql_num_rows($query2)==1){
    
        $partner = mysql_fetch_array($query2);
        $response["responseCode"]=1;
        $response["msg"]="Successful";
        $arrCustomer = array(); 
        $arrCustomer['id'] = $partner['partnerID'];
        $arrCustomer['firstName'] = $partner['firstName'];
        $arrCustomer['lastName'] = $partner['lastName'];
        $arrCustomer['email'] = $partner['email'];
		$arrCustomer['phone'] = $partner['phone'];
		$arrCustomer['image'] = BASE_PATH.$partner['image'];
        $arrCustomer['role'] = $partner['role'];
		
        $response['data']=$arrCustomer;     
        echo json_encode($response);
    }else
    {
        $response["responseCode"]=0;
    	$response["msg"]="email or password incorrect";
        $response['data'] = false;
    	echo json_encode($response);
    }


?>