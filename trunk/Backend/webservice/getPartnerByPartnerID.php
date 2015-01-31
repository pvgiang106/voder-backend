<?php
    $response= array();
    $response['function'] = 'fncGetPartnerByPartnerID';
    $screenID = "";
    if($_POST['screenID'] != 'undefined'){
        $screenID = $_POST['screenID'];
    }
    $response['screenID'] = $screenID;
    
    require_once __DIR__ .'/config.php';
    require_once __DIR__ .'/db_connect.php';
    $db= new DB_CONNECT();

    $partnerID = $_POST['partnerID'];
    $sql = " select * from partner where partnerID = $partnerID and inactive = 0 ";
    $query = mysql_query($sql);
    if(mysql_num_rows($query) > 0){
        $row = mysql_fetch_array($query,MYSQL_ASSOC);
        $row['image'] = BASE_PATH.$row['image'];
        $row['birthday'] = strtotime($row['birthday']);
        $response["responseCode"] = 1;
        $response["msg"] = "Successful";        
        $response["data"] = $row;
    }else {
        $response["responseCode"]=0;
        $response["msg"]="No record found";
        $response["data"] = null;
        
    }
    
    echo json_encode($response);
?>