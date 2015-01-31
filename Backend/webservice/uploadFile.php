<?php
    require_once __DIR__ .'/config.php';    
    require_once __DIR__ .'/db_connect.php';
    
    $response= array();
    $response['function'] = 'fncUploadFile';
    $screenID = "";
    if($_POST['screenID'] != 'undefined'){
        $screenID = $_POST['screenID'];
    }
    $response['screenID'] = $screenID;
    
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
                    
    $objectName = $_POST['objectName'];
    $idRecord = $_POST['idRecord'];
    $baseString = $_POST['baseString'];
    $extFile = $_POST['extFile'];
    $fieldName = $_POST['fieldName'];   
    
    
    $filePath = '../image/'.$objectName.'_'.$fieldName.'_'.$idRecord.'.'.$extFile;
    $witeImage = base64_to_file($baseString,$filePath);
    $urlDb = 'image/'.$objectName.'_'.$fieldName.'_'.$idRecord.'.'.$extFile;
    
    $data = array(
        "objectName" => $objectName,
        "idRecord" => $idRecord,
        "fieldName" => $fieldName,
        "urlImage" => BASE_PATH.$urlDb    
    );
        
    $idTable = $mapTableID[$objectName];
    $sql = "update ".$objectName." set ".$fieldName." = '".$urlDb."' where ".$idTable." = ".$idRecord;
    $query = mysql_query($sql);
    if($query){
        $response["responseCode"]=1;
        $response["msg"]="Upload Image Successful";  
        $response['data']= $data ;     
        echo json_encode($response);
    } else{
        $response["responseCode"]=0;
        $response["msg"]="Upload image fail";
        $response['data'] = false;
        echo json_encode($response);
    }
    
    function base64_to_file( $base64_string, $output_file ) {
        $ifp = fopen( $output_file, "wb" ); 
        fwrite( $ifp, base64_decode( $base64_string) ); 
        fclose( $ifp ); 
    }
?>