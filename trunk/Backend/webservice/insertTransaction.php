<?php
    $response= array();
    $response['function'] = 'fncInsertTransaction';
    $screenID = "";
    if($_POST['screenID'] != 'undefined'){
        $screenID = $_POST['screenID'];
    }
    $response['screenID'] = $screenID;
    
    require_once __DIR__ .'/db_connect.php';
    $db= new DB_CONNECT();

    $dataRecive = json_decode($_POST['stringJSON']);

    $businessID = $dataRecive->businessID;
    $customerID = $dataRecive->customerID;
    $totalCost = $dataRecive->totalCost;
    $description = $dataRecive->description;
    $dateTime = date("Y-m-d H:i:s");
    $note = $dataRecive->note;
    $listItem = $dataRecive->listItems;
    $paymentMethod = $dataRecive->paymentMethod;   
    $sql = " insert into transaction value('','$businessID','$customerID','$dateTime','$description','$note','$paymentMethod','$totalCost',0)";
    $query = mysql_query($sql);
    if($query){
        $transactionID = mysql_insert_id();
         foreach($listItem as $itemInfo){
            $itemID = $itemInfo->itemID;
            $quantity = $itemInfo->quantity;
            $sql1 = "select * from item where itemID = $itemID and inactive = 0";
            $query1 = mysql_query($sql1);
            if(mysql_num_rows($query1) > 0){
                $item = mysql_fetch_array($query1,MYSQL_ASSOC);
                $title= $item['title'];
                $description = $item['description']; 
                $image = $item['image']; 
                $price = $item['price'];
                $sql2 = " insert into transaction_detail value('','$transactionID','$itemID','$quantity',0,'$title','$description','$image','$price')";
                $query2 = mysql_query($sql2);  
            }
        }
        $response["responseCode"] = 1;
        $response["msg"] = "Successful";        
        $response["data"] = array("transactionID" => $transactionID);
        echo json_encode($response);        
    }else {
        $response["responseCode"]=0;
        $response["msg"]="Insert transaction fail";
        $response["data"] = null;
        echo json_encode($response);
    }
?>