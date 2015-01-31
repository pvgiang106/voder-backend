<?php
    $response= array();
    $response['function'] = 'fncSearchBusiness';
    $screenID = "";
    if($_POST['screenID'] != 'undefined'){
        $screenID = $_POST['screenID'];
    }
    $response['screenID'] = $screenID;
    
    require_once __DIR__ .'/db_connect.php';
    $db= new DB_CONNECT();

    $name = $_POST['name'];
    $limit = $_POST['limit'];
    $sql = " select * from business where name like '%$name%' and inactive = 0 ";
    if($limit != 0){
        $sql .= " limit $limit";
    }
    $query = mysql_query($sql);
    if(mysql_num_rows($query) > 0){
        $response["responseCode"] = 1;
        $response["msg"] = "Successful";        
        $response["data"] = array();
        
        while($row = mysql_fetch_array($query,MYSQL_ASSOC)){
            array_push($response["data"],$row);
        }
        echo json_encode($response);
    }else {
        $response["responseCode"]=0;
        $response["msg"]="No record found";
        $response["data"] = null;
        echo json_encode($response);
    }
?>