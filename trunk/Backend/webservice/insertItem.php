<?php
    $response= array();
    $response['function'] = 'fncInsertItem';
    $screenID = "";
    if($_POST['screenID'] != 'undefined'){
        $screenID = $_POST['screenID'];
    }
    $response['screenID'] = $screenID;
    
    require_once __DIR__ .'/db_connect.php';
    $db= new DB_CONNECT();

    $listMenuID = explode(";",$_POST['listMenuID']);
    $title = $_POST['title'];
    $description = $_POST['description'];
    $image = $_POST['image'];
    $price = $_POST['price'];
    $quantity = $_POST['quantity'];
    
    $sql = " insert into item value('','$title','$description','$image',$price,$quantity,0)";
    $query = mysql_query($sql);
    
    if($query){
        $itemID = mysql_insert_id();
         foreach($listMenuID as $menuID)  {
            $sql1 = "insert into item_detail value('',$menuID,$itemID,0)";
            $query = mysql_query($sql1);
        }
        $response["responseCode"] = 1;
        $response["msg"] = "Successful";        
        $response["data"] = array("itemID" => $itemID);
        echo json_encode($response);        
    }else {
        $response["responseCode"]=0;
        $response["msg"]="Insert Item fail";
        $response["data"] = null;
        echo json_encode($response);
    }
?>