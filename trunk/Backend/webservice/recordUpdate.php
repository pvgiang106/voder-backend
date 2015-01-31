<?php
    $response= array();
    $response['function'] = 'fncRecordUpdate';
    $screenID = "";
    if($_POST['screenID'] != 'undefined'){
        $screenID = $_POST['screenID'];
    }
    $response['screenID'] = $screenID;
    
    require_once __DIR__ .'/db_connect.php';
    $db= new DB_CONNECT();

    switch($_POST['table']){
        case 'bank_type':
			$bankTypeID = $_POST['bankTypeID'];
            $sql = "update bank_type set ";
            if($_POST['name'] != 'undefined'){
                $name = $_POST['name'];
                $sql .= "name = '$name',";
            }
            if($_POST['number'] != 'undefined'){
                $number = $_POST['number'];
                $sql .= "number = '$number',";
            }
			if($_POST['bsb'] != 'undefined'){
                $bsb = $_POST['bsb'];
                $sql .= "bsb = '$bsb',";
            }
            if($_POST['partnerID'] != 'undefined'){
                $partnerID = $_POST['partnerID'];
                $sql .= "partnerID = $partnerID',";
            }
            $sql = substr($sql,0,-1);
            $sql .= " where bankTypeID = $bankTypeID ";
            $query = mysql_query($sql);
            if($query){
                $response["responseCode"] = 1;
                $response["msg"] = "Update bank_type Successful";
                $response['data'] = $query;     
                echo json_encode($response);
            }else {
                $response["responseCode"]=0;
                $response["msg"]="Update infomation fail";
                $response['data'] = array("bankTypeID" => $bankTypeID);
                echo json_encode($response);
            }
            break;
        case 'card_type':
			$cardTypeID = $_POST['cardTypeID'];
            $sql = "update card_type set ";
            if($_POST['name'] != 'undefined'){
                $name = $_POST['name'];
                $sql .= "name = '$name',";
            }
            if($_POST['number'] != 'undefined'){
                $number = $_POST['number'];
                $sql .= "number = '$number',";
            }
			if($_POST['ccv'] != 'undefined'){
                $ccv = $_POST['ccv'];
                $sql .= "ccv = '$ccv',";
            }
			if($_POST['expire_date'] != 'undefined'){
                $expire_date = date('Y-m-d',$_POST['expire_date']);
                $sql .= "expire_date = '$expire_date',";
            }
            if($_POST['customerID'] != 'undefined'){
                $customerID = $_POST['customerID'];
                $sql .= "customerID = $customerID',";
            }
            $sql = substr($sql,0,-1);
            $sql .= " where cardTypeID = $cardTypeID ";
            $query = mysql_query($sql);
            if($query){
                $response["responseCode"] = 1;
                $response["msg"] = "Update card_type Successful";
                $response['data'] = array("cardTypeID" => $cardTypeID);     
                echo json_encode($response);
            }else {
                $response["responseCode"]=0;
                $response["msg"]="Update infomation fail";
                $response['data'] = $query;
                echo json_encode($response);
            }
            break;
        case 'partner':
            $partnerID = $_POST['partnerID'];
            $sql = "update partner set ";
            if($_POST['firstName'] != 'undefined'){
                $firstName = $_POST['firstName'];
                $sql .= "firstName = '$firstName',";
            }
            if($_POST['lastName'] != 'undefined'){
                $lastName = $_POST['lastName'];
                $sql .= " lastName = '$lastName',";
            }
            if($_POST['email'] != 'undefined'){
                 $email = $_POST['email'];
                $sql .= " email = '$email',";
            }
            if($_POST['phone'] != 'undefined'){
                $phone = $_POST['phone'];
                $sql .= " phone = '$phone',";
            }
            if($_POST['password'] != 'undefined'){
                $password = $_POST['password'];
                $sql .= " password = '$password',";
            }
            if($_POST['birthday'] != 'undefined'){
                $birthday = date('Y-m-d',$_POST['birthday']);
                $sql .= " birthday = '$birthday',";
            }
            if($_POST['address'] != 'undefined'){
                $address = $_POST['address'];
                $sql .= " address = '$address',";
            }
            if($_POST['image'] != 'undefined'){
                $image = $_POST['image'];
                $sql .= " image = '$image',";
            }
          
            $sql = substr($sql,0,-1);
            $sql .= " where partnerID = $partnerID ";
            $query = mysql_query($sql);
            if($query){
                $response["responseCode"] = 1;
                $response["msg"] = "Update partner Successful";
                $response['data'] = array("partnerID" => $partnerID);     
                echo json_encode($response);
            }else {
                $response["responseCode"]=0;
                $response["msg"]="Update infomation fail";
                $response['data'] = $query;
                echo json_encode($response);
            }
            break;
        case 'customer':
            $customerID = $_POST['customerID'];
            $sql = "update customer set ";
            if($_POST['firstName'] != 'undefined'){
                $firstName = $_POST['firstName'];
                $sql .= "firstName = '$firstName',";
            }
            if($_POST['lastName'] != 'undefined'){
                $lastName = $_POST['lastName'];
                $sql .= " lastName = '$lastName',";
            }
            if($_POST['email'] != 'undefined'){
                 $email = $_POST['email'];
                $sql .= " email = '$email',";
            }
            if($_POST['phone'] != 'undefined'){
                $phone = $_POST['phone'];
                $sql .= " phone = '$phone',";
            }
            if($_POST['password'] != 'undefined'){
                $password = $_POST['password'];
                $sql .= " password = '$password',";
            }
            if($_POST['birthday'] != 'undefined'){
                $birthday = date('Y-m-d',$_POST['birthday']);
                $sql .= " birthday = '$birthday',";
            }
            if($_POST['address'] != 'undefined'){
                $address = $_POST['address'];
                $sql .= " address = '$address',";
            }
            if($_POST['image'] != 'undefined'){
                $image = $_POST['image'];
                $sql .= " image = '$image',";
            } 
            
            $sql = substr($sql,0,-1);
            $sql .= " where customerID = $customerID ";
            $query = mysql_query($sql);
            if($query){
                $response["responseCode"] = 1;
                $response["msg"] = "Update customer Successful";
                $response['data'] = array("customerID" => $customerID);     
                echo json_encode($response);
            }else {
                $response["responseCode"]=0;
                $response["msg"]="Update infomation fail";
                $response['data'] = $query;
                echo json_encode($response);
            }
            break;
        case 'business':
            $businessID = $_POST['businessID'];
            $sql = "update business set ";
            if($_POST['partnerID'] != 'undefined'){
                $partnerID = $_POST['partnerID'];
                $sql .= "partnerID = '$partnerID',";
            }
            if($_POST['name'] != 'undefined'){
                $name = $_POST['name'];
                $sql .= " name = '$name',";
            }
            if($_POST['address'] != 'undefined'){
                $address = $_POST['address'];
                $sql .= " address = '$address',";
            }
            if($_POST['longtitude'] != 'undefined'){
                 $longtitude = $_POST['longtitude'];
                $sql .= " longtitude = $longtitude,";
            }
            if($_POST['latitude'] != 'undefined'){
                $latitude = $_POST['latitude'];
                $sql .= " latitude = $latitude,";
            }
            if($_POST['image'] != 'undefined'){
                $image = $_POST['image'];
                $sql .= " image = '$image',";
            }           
                       
            $sql = substr($sql,0,-1);
            $sql .= " where businessID = $businessID ";
            $query = mysql_query($sql);
            if($query){
                $response["responseCode"] = 1;
                $response["msg"] = "Update business Successful";
                $response['data'] = array("businessID" => $businessID);     
                echo json_encode($response);
            }else {
                $response["responseCode"]=0;
                $response["msg"]="Update infomation fail";
                $response['data'] = $query;
                echo json_encode($response);
            }
            break;
        case 'menu':
            $menuID = $_POST['menuID'];
            $sql = "update menu set ";
            if($_POST['businessID'] != 'undefined'){
                $businessID = $_POST['businessID'];
                $sql .= "businessID = $businessID,";
            }
            if($_POST['groupName'] != 'undefined'){
                $groupName = $_POST['groupName'];
                $sql .= "groupName = '$groupName',";
            }
            $sql = substr($sql,0,-1);
            $sql .= " where menuID = $menuID ";
            $query = mysql_query($sql);
            if($query){
                $response["responseCode"] = 1;
                $response["msg"] = "Update menu Successful";
                $response['data'] = array("menuID" => $menuID);     
                echo json_encode($response);
            }else {
                $response["responseCode"]=0;
                $response["msg"]="Update infomation fail";
                $response['data'] = $query;
                echo json_encode($response);
            }
            break;
        case 'item':
            $itemID = $_POST['itemID'];
            $sql = "update item set ";
            
            if($_POST['title'] != 'undefined'){
                $title = $_POST['title'];
                $sql .= " title = '$title',";
            }
            if($_POST['description'] != 'undefined'){
                $description = $_POST['description'];
                $sql .= " description = '$description',";
            }
            if($_POST['image'] != 'undefined'){
                $image = $_POST['image'];
                $sql .= " image = '$image',";
            }
            if($_POST['price'] != 'undefined'){
                $price = $_POST['price'];
                $sql .= "price = $price,";
            }
            if($_POST['quantity'] != 'undefined'){
                 $quantity = $_POST['quantity'];
                $sql .= " quantity = $quantity,";
            }
            
           
                       
            $sql = substr($sql,0,-1);
            $sql .= " where itemID = $itemID ";
            $query = mysql_query($sql);
            if($query){
                $response["responseCode"] = 1;
                $response["msg"] = "Update item Successful";
                $response['data'] = array("itemID" => $itemID);     
                echo json_encode($response);
            }else {
                $response["responseCode"]=0;
                $response["msg"]="Update infomation fail";
                $response['data'] = $query;
                echo json_encode($response);
            }
            break;
        case 'item_detail':
			$itemDetailID = $_POST['itemDetailID'];
            $sql = "update item_detail set ";
            
            if($_POST['itemID'] != 'undefined'){
                $itemID = $_POST['itemID'];
                $sql .= " itemID = $itemID,";
            }
            if($_POST['menuID'] != 'undefined'){
                $menuID = $_POST['menuID'];
                $sql .= " menuID = $menuID,";
            }
          
            $sql = substr($sql,0,-1);
            $sql .= " where itemDetailID = $itemDetailID ";
            $query = mysql_query($sql);
            if($query){
                $response["responseCode"] = 1;
                $response["msg"] = "Update item_detail Successful";
                $response['data'] = array("itemDetailID" => $itemDetailID);     
                echo json_encode($response);
            }else {
                $response["responseCode"]=0;
                $response["msg"]="Update infomation fail";
                $response['data'] = $query;
                echo json_encode($response);
            }
            break;
        case 'transaction':
			$transactionID = $_POST['transactionID'];
            $sql = "update transaction set ";
            if($_POST['businessID'] != 'undefined'){
                $businessID = $_POST['businessID'];
                $sql .= "businessID = $businessID,";
            }
            if($_POST['customerID'] != 'undefined'){
                $customerID = $_POST['customerID'];
                $sql .= " customerID = $customerID,";
            }
            if($_POST['dateTime'] != 'undefined'){
                 $dateTime = date('Y-m-d H:i:s',$_POST['dateTime']);
                $sql .= " dateTime = '$dateTime',";
            }
            if($_POST['description'] != 'undefined'){
                $description = $_POST['description'];
                $sql .= " description = '$description',";
            }
            if($_POST['note'] != 'undefined'){
                $note = $_POST['note'];
                $sql .= " note = '$note',";
            }
            if($_POST['paymentMethod'] != 'undefined'){
                $paymentMethod = $_POST['paymentMethod'];
                $sql .= " paymentMethod = '$paymentMethod',";
            }
            if($_POST['totalCost'] != 'undefined'){
                $totalCost = $_POST['totalCost'];
                $sql .= " totalCost = '$totalCost',";
            }

            $sql = substr($sql,0,-1);
            $sql .= " where transactionID = $transactionID ";
            $query = mysql_query($sql);
            if($query){
                $response["responseCode"] = 1;
                $response["msg"] = "Update transaction Successful";
                $response['data'] = array("transactionID" => $transactionID);     
                echo json_encode($response);
            }else {
                $response["responseCode"]=0;
                $response["msg"]="Update infomation fail";
                $response['data'] = $query;
                echo json_encode($response);
            }
            break;
        case 'transaction_detail':
			$transactionDetailID = $_POST['transactionDetailID'];
            $sql = "update transaction_detail set ";
            if($_POST['transactionID'] != 'undefined'){
                $transactionID = $_POST['transactionID'];
                $sql .= "transactionID = $transactionID,";
            }
            if($_POST['itemID'] != 'undefined'){
                $itemID = $_POST['itemID'];
                $sql .= " itemID = $itemID,";
            }
            if($_POST['quantity'] != 'undefined'){
                 $quantity = $_POST['quantity'];
                $sql .= " quantity = $quantity,";
            }
            if($_POST['description'] != 'undefined'){
                $description = $_POST['description'];
                $sql .= " description = '$description',";
            }
            if($_POST['title'] != 'undefined'){
                $title = $_POST['title'];
                $sql .= " title = '$title',";
            }
            if($_POST['image'] != 'undefined'){
                $image = $_POST['image'];
                $sql .= " image = '$image',";
            }
            if($_POST['price'] != 'undefined'){
                $price = $_POST['price'];
                $sql .= " price = $price,";
            }

            $sql = substr($sql,0,-1);
            $sql .= " where transactionDetailID = $transactionDetailID ";
            $query = mysql_query($sql);
            if($query){
                $response["responseCode"] = 1;
                $response["msg"] = "Update transaction_detail Successful";
                $response['data'] = array("transactionDetailID" => $transactionDetailID);     
                echo json_encode($response);
            }else {
                $response["responseCode"]=0;
                $response["msg"]="Update infomation fail";
                $response['data'] = $query;
                echo json_encode($response);
            }
            break;
        default:
			$response["responseCode"]=0;
			$response["msg"]="No found table name";
			$response['data'] = false;
			echo json_encode($response);
            break;
        
    }    
?>