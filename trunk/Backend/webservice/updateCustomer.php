<?php
    $response= array();
    $response['function'] = 'fncUpdateCustomer';
    $screenID = "";
    if($_POST['screenID'] != 'undefined'){
        $screenID = $_POST['screenID'];
    }
    $response['screenID'] = $screenID;
    
    require_once __DIR__ .'/db_connect.php';
    $db= new DB_CONNECT();

    $listCustomerInfo = json_decode($_POST['data'],true);
    $response["responseCode"] = 1;
    $response["msg"] = ""; 
    $recordSuccess = "";
    $recordFail = "";
        
    foreach($listCustomerInfo as $customerInfo){
        $customerID = $customerInfo['customerID'];
        $firstName = $customerInfo['firstName'];
        $lastName = $customerInfo['lastName'];
        $phone= $customerInfo['phone'];
        $password = $customerInfo['password'];
        $birthday = date('Y-m-d',$customerInfo['birthday']);
        $address = $customerInfo['address'];
        $sql = " update customer set firstName = '$firstName, lastName = '$lastName', phone = '$phone', password = '$password', birthday = '$birthday', address = '$address' where customerID = $customerID ";
        $query = mysql_query($sql);
        if($query){
            $recordSuccess .= $customerID.";"; 
        }else {
            $response["responseCode"]=0;    
            $recordFail .= $customerID.";";
        }
    } 
    if($itemFail != ""){
        $response["data"] = substr($recordFail,0,-1);
    }else{
        $response["data"] = substr($recordSuccess,0,-1);
    }
    echo json_encode($response); 
   
?>