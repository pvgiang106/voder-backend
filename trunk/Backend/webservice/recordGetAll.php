<?php
    $response= array();
    $response['function'] = 'fncGetRecord';
    $screenID = "";
    if($_POST['screenID'] != 'undefined'){
        $screenID = $_POST['screenID'];
    }
    $response['screenID'] = $screenID;
    
    require_once __DIR__ .'/config.php'; 
    require_once __DIR__ .'/db_connect.php';
    $db= new DB_CONNECT();
    $mapTableID = array(
                        "bank_type" => "bankTypeID",
                        "business" => "businessID",
                        "card_type" => "cardTypeID",
                        "customer" => "customerID",
                        "item" => "itemID",
                        "item_detail" => "itemDetailID",
                        "menu" => "menuID",
                        "partner" => "partnerID",
                        "transaction" => "transactionID",
                        "transaction_detail" => "TransactionDetailID"
    
                    );
    $table = $_POST['table'];
    $idTable = $mapTableID[$table];
    $limit = $_POST['limit'];
    $sql = "select * from $table where inactive = 0 order by $idTable DESC";
    if($limit >0){
        $sql .= " limit $limit";
    }
    $query = mysql_query($sql);
    if(mysql_num_rows($query) > 0){
        $response["responseCode"] = 1;
        $response["msg"] = "Successful";
        $response["data"] = array();
        while($row = mysql_fetch_array($query,MYSQL_ASSOC)){
            if(isset($row['image'])){
                $row['image'] = BASE_PATH.$row['image'];
            }
            if(isset($row['birthday'])){
                $row['birthday'] = strtotime($row['birthday']);
            }
            if(isset($row['expire_date'])){
                $row['expire_date'] = strtotime($row['expire_date']);
            }
            if(isset($row['dateTime'])){
                $row['dateTime'] = strtotime($row['dateTime']);
            }
            array_push($response["data"], $row);
        }
        echo json_encode($response);
    }else {
        $response["responseCode"]=0;
        $response["msg"]="No record found";
        $response["data"] = null;
        echo json_encode($response);
    }
?>