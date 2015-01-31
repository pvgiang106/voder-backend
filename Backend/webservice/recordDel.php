<?php
    $response= array();
    $response['function'] = 'fncRecordDel';
    $screenID = "";
    if($_POST['screenID'] != 'undefined'){
        $screenID = $_POST['screenID'];
    }
    $response['screenID'] = $screenID;
    
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
    $id = $_POST['id'];
    $table = $_POST['table'];
    $idTable = $mapTableID[$table];
    $query = mysql_query("update $table set inactive = 1 where $idTable = $id");
    if($query){
        $response["responseCode"] = 1;
        $response["msg"] = "Successful";
        $response['data'] = array($idTable => $id);     
        echo json_encode($response);
    }else {
        $response["responseCode"]=0;
        $response["msg"]="email or password incorrect";
        $response['data'] = $query;
        echo json_encode($response);
    }
?>