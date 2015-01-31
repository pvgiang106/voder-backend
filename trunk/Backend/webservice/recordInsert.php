<?php
    $response= array();
    $response['function'] = 'fncRecordInsert';
    $screenID = "";
    if($_POST['screenID'] != 'undefined'){
        $screenID = $_POST['screenID'];
    }
    $response['screenID'] = $screenID;
    
    require_once __DIR__ .'/db_connect.php';
    $db= new DB_CONNECT();
    
    switch($_POST['table']){
        case 'bank_type':
            $name = $_POST['name'];
            $number = $_POST['number'];
            $bsb = $_POST['bsb'];
            $partnerID = $_POST['partnerID'];
               
            $sql = "insert into bank_type value('','$name','$number','$bsb',$partnerID,0)";
            $query = mysql_query($sql);
            
            if($query){
                $response["responseCode"] = 1;
                $response["msg"] = "Successful";
                $response['data'] =  array("bankTypeID" => mysql_insert_id());    
                echo json_encode($response);
            }else {               
                $response["responseCode"]=0;
                $response["msg"]="Fail insert bank_type";
                $response['data'] = null;
                echo json_encode($response);
            }
            break;
        case 'card_type':
            $name = $_POST['name'];
            $number = $_POST['number'];
            $expire_date = "";
            if($_POST['expire_date'] != 'undefined'){
              $expire_date = date('Y-m-d',$_POST['expire_date']);
            }
            $ccv = $_POST['ccv'];
            $customerID = $_POST['customerID'];
            
            $sql = "insert into card_type value('','$name','$number','$expire_date','$ccv',$customerID,0)";
            $query = mysql_query($sql);
            
            if($query){
                $response["responseCode"] = 1;
                $response["msg"] = "Successful";
                $response['data'] =  array("cardTypeID" => mysql_insert_id());    
                echo json_encode($response);
            }else {               
                $response["responseCode"]=0;
                $response["msg"]="Fail insert card_type";
                $response['data'] = null;
                echo json_encode($response);
            }
            break;
        case 'partner':
            $firstName = $_POST['firstName'];
            $lastName = $_POST['lastName'];
            $email = $_POST['email'];   
            $password = $_POST['password'];
            $phone = $_POST['phone'];
            $birthday = "";
            if($_POST['birthday'] != 'undefined'){
               $birthday = date('Y-m-d',$_POST['birthday']); 
            }            
            $address = $_POST['address'];
            $image = $_POST['image'];
            $role = 1;
            //check if email registed
            $query1 = mysql_query("SELECT * FROM customer WHERE email='$email'");
            $query2 = mysql_query("SELECT * FROM partner WHERE email='$email'");
            if(mysql_num_rows($query1)>=1 || mysql_num_rows($query2)>=1){
        
                $response["responseCode"]=1;
                $response["msg"]="Email had been register";  
                $response['data']=array("partnerID" => 0);     
                echo json_encode($response);
                break;
            }else{
                $sql = "insert into partner value('','$firstName','$lastName','$email','$password','$phone','$birthday','$address','$image',$role,0,0)";
                $query = mysql_query($sql);
                
                if($query){
                    $response["responseCode"] = 1;
                    $response["msg"] = "Successful";
                    $response['data'] =  array("partnerID" => mysql_insert_id());     
                    echo json_encode($response);
                }else {               
                    $response["responseCode"]=0;
                    $response["msg"]="email or password incorrect";
                    $response['data'] = null;
                    echo json_encode($response);
                }
                break;
            }
               
        case 'customer':
            $firstName = $_POST['firstName'];
            $lastName = $_POST['lastName'];
            $email = $_POST['email'];
            $phone = $_POST['phone'];
            $password = $_POST['password'];
            $birthday = "";
            if($_POST['birthday'] != 'undefined'){
               $birthday = date('Y-m-d',$_POST['birthday']); 
            }  
            $address = $_POST['address'];
            $image = $_POST['image'];
            $query1 = mysql_query("SELECT * FROM customer WHERE email='$email'");
            $query2 = mysql_query("SELECT * FROM partner WHERE email='$email'");
            if(mysql_num_rows($query1)>=1 || mysql_num_rows($query2)>=1){
        
                $response["responseCode"]=1;
                $response["msg"]="Email had been register";  
                $response['data']=array("customerID" => 0);     
                echo json_encode($response);
                break;
            }else{
                $sql =  "insert into customer value('','$firstName','$lastName','$email','$phone','$password','$birthday','$address','$image',0,0)";  
                $query = mysql_query($sql);
                if($query){
                    $response["responseCode"] = 1;
                    $response["msg"] = "Successful";
                    $response['data'] = array("customerID" => mysql_insert_id());      
                    echo json_encode($response);
                }else {
                    $response["responseCode"]=0;
                    $response["msg"]="email or password incorrect";
                    $response['data'] = $query;
                    echo json_encode($response);
                }
                break;
            }
        case 'business':
            $partnerID = $_POST['partnerID'];
            $name = $_POST['name'];
            $address = $_POST['address'];
            $longtitude = $_POST['longtitude'];   
            $latitude = $_POST['latitude'];
            $image = $_POST['image'];
             
            $sql = "insert into business value('',$partnerID,'$name','$address',$longtitude,$latitude,'$image',0)";  
            $query = mysql_query($sql);
            if($query){
                $response["responseCode"] = 1;
                $response["msg"] = "Successful";
                $response['data'] = array("businessID" => mysql_insert_id());       
                echo json_encode($response);
            }else {
                $response["responseCode"]=0;
                $response["msg"]="Insert buisiness fail";
                $response['data'] = $query;
                echo json_encode($response);
            }
            break;
        case 'menu':
            $businessID = $_POST['businessID'];
            $groupName = $_POST['groupName'];
             
            $sql = "insert into menu value('',$businessID,'$groupName',0)";  
            $query = mysql_query($sql);
            if($query){
                $response["responseCode"] = 1;
                $response["msg"] = "Successful";
                $response['data'] = array("menuID" => mysql_insert_id());     
                echo json_encode($response);
            }else {
                $response["responseCode"]=0;
                $response["msg"]="Insert menu fail";
                $response['data'] = $query;
                echo json_encode($response);
            }
            break;
        case 'item':
            $title = $_POST['title'];
            $description = $_POST['description'];
            $image = $_POST['image'];
            $price = $_POST['price'];
            $quantity = $_POST['quantity'];
            
            $sql = "insert into item value('','$title','$description','$image',$price,$quantity,0)";
            $query = mysql_query($sql);
            if($query){
                $response["responseCode"] = 1;
                $response["msg"] = "Successful";
                $response['data'] = array("itemID" => mysql_insert_id());      
                echo json_encode($response);
            }else {
                $response["responseCode"]=0;
                $response["msg"]="Insert item fail";
                $response['data'] = $query;
                echo json_encode($response);
            }
            break;
        case 'item_detail':
            $menuID = $_POST['menuID'];
            $itemID = $_POST['itemID'];
            
            $sql = "insert into item_detail value('',$menuID,$itemID,0)";
            $query = mysql_query($sql);
            if($query){
                $response["responseCode"] = 1;
                $response["msg"] = "Successful";
                $response['data'] = array("itemDetailID" => mysql_insert_id());       
                echo json_encode($response);
            }else {
                $response["responseCode"]=0;
                $response["msg"]="Insert item_deltail fail";
                $response['data'] = $query;
                echo json_encode($response);
            }
            break;
        case 'transaction':
            $businessID = $_POST['businessID'];
            $customerID = $_POST['customerID'];
            $dateTime = date('Y-m-d H:i:s',$_POST['dateTime']);
            $description = $_POST['description'];
            $note = $_POST['note'];
            $paymentMethod = $_POST['paymentMethod'];
            $totalCost = $_POST['totalCost'];
            
            $sql = "insert into transaction value('',$businessID,'$name',$customerID,'$dateTime','$note','$paymentMethod',$totalCost,0)";  
            $query = mysql_query($sql);
            if($query){
                $response["responseCode"] = 1;
                $response["msg"] = "Successful";
                $response['data'] = array("transactionID" => mysql_insert_id());     
                echo json_encode($response);
            }else {
                $response["responseCode"]=0;
                $response["msg"]="Insert transaction fail";
                $response['data'] = $query;
                echo json_encode($response);
            }
            break;
        case 'transaction_detail':
            $transactionID = $_POST['transactionID'];
            $itemID = $_POST['itemID'];
            $title = $_POST['title'];
            $description = $_POST['description'];
            $image = $_POST['image'];
            $price = $_POST['price'];
            $quantity = $_POST['quantity'];
            
            $sql = "insert into transaction_detail value('',$transactionID,$itemID,$customerID,$quantity,0,'$title',$description,'$image',$price)";  
            $query = mysql_query($sql);
            if($query){
                $response["responseCode"] = 1;
                $response["msg"] = "Successful";
                $response['data'] = array("transactionDetailID" => mysql_insert_id());      
                echo json_encode($response);
            }else {
                $response["responseCode"]=0;
                $response["msg"]="Insert buisinetransaction_detailss fail";
                $response['data'] = $query;
                echo json_encode($response);
            }
            break;
        default:
            $response["responseCode"]=0;
            $response["msg"]="Not found table";
            $response['data'] = null;
            break;
        
    }   
    
?>