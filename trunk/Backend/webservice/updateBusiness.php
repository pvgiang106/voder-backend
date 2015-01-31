<?php
    $response= array();
    $response['function'] = 'fncUpdateBusiness';
    $screenID = "";
    if($_POST['screenID'] != 'undefined'){
        $screenID = $_POST['screenID'];
    }
    $response['screenID'] = $screenID;
    
    require_once __DIR__ .'/db_connect.php';
    $db= new DB_CONNECT();

    $listBusinessInfo = json_decode($_POST['data'],true);
    $response["responseCode"] = 1;
    $response["msg"] = ""; 
    $recordSuccess = "";
    $recordFail = "";
        
    foreach($listBusinessInfo as $businessInfo){
        $businessID = $businessInfo['businessID'];
        $name = $businessInfo['name'];
        $address = $businessInfo['address'];
        $longtitude= $businessInfo['longtitude'];
        $latitude = $businessInfo['latitude'];
        $sql = " update business set name = '$name', address = '$address', longtitude = '$longtitude', latitude = '$latitude' where businessID = $businessID ";
        $query = mysql_query($sql);
        if($query){
            $recordSuccess .= $businessID.";"; 
        }else {
            $response["responseCode"]=0;    
            $recordFail .= $businessID.";";
        }
    } 
    if($itemFail != ""){
        $response["data"] = substr($recordFail,0,-1);
    }else{
        $response["data"] = substr($recordSuccess,0,-1);
    }
    echo json_encode($response); 
   
?>