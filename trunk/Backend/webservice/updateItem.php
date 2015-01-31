<?php
    $response= array();
    $response['function'] = 'fncUpdateItem';
    $screenID = "";
    if($_POST['screenID'] != 'undefined'){
        $screenID = $_POST['screenID'];
    }
    $response['screenID'] = $screenID;
    
    require_once __DIR__ .'/db_connect.php';
    $db= new DB_CONNECT();

    $listItemInfo = json_decode(stripslashes($_POST['data']),true);

    $response["responseCode"] = 1;
    $response["msg"] = ""; 
    $itemSuccess = "";
    $itemFail = "";
        
    foreach($listItemInfo as $itemInfo){
        $listMenuID = explode(";",$itemInfo['listMenuID']);
        $itemID = $itemInfo['itemID'];
        $title = $itemInfo['title'];
        $description = $itemInfo['description'];
//        $image = $itemInfo['image'];
        $price = $itemInfo['price'];
        $quantity = $itemInfo['quantity'];
        $sql = " update item set title = '$title', description = '$description', price = '$price', quantity = '$quantity' where itemID = $itemID ";
        $query = mysql_query($sql);
        if($query){
            mysql_query(" delete from item_detail where itemID = $itemID ");
            foreach($listMenuID as $menuID)  {
                $sql = "insert into item_detail value('',$menuID,$itemID,0)";
                $query = mysql_query($sql);
             } 
            $itemSuccess .= $itemID.";"; 
        }else {
            $response["responseCode"]=0;    
            $itemFail .= $itemID.";";
        }
    } 
    if($itemFail != ""){
        $response["data"] = substr($itemFail,0,-1);
    }else{
        $response["data"] = substr($itemSuccess,0,-1);
    }
    echo json_encode($response); 
   
?>