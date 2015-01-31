<?php
    $response= array();
    $response['function'] = 'fncGetTransactionByBusinessID';
    $screenID = "";
    if($_POST['screenID'] != 'undefined'){
        $screenID = $_POST['screenID'];
    }
    $response['screenID'] = $screenID;
    
    require_once __DIR__ .'/db_connect.php';
    $db= new DB_CONNECT();

    $businessID = $_POST['businessID'];
    $startTime = $_POST['startTime'];
	$endTime = $_POST['endTime'];
    $sql1 = " select * from transaction where businessID = $businessID and inactive = 0 ";
    if($startTime != 'undefined' && $endTime != 'undefined'){
        $startDate = date('Y-m-d',$startTime);
        $endDate = date('Y-m-d',$endTime);
        $sql1 .= " and dateTime between '$startDate' and '$endDate' ";
    }
    $query1 = mysql_query($sql1);
    if(mysql_num_rows($query1) > 0){
        $response["responseCode"] = 1;
        $response["msg"] = "Successful";        
        $response["data"] = array();
        while($row1 = mysql_fetch_array($query1,MYSQL_ASSOC)){
            $transaction = array();
            $transaction['businessID'] = $row1['businessID'];
            $transaction['customers'] = array();
            $transaction['dateTime'] = strtotime($row1['dateTime']);
            $transaction['description'] = $row1['description'];
            $transaction['note'] = $row1['note'];
            $transaction['paymentMethod'] = $row1['paymentMethod'];
            $transaction['totalCost'] = $row1['totalCost'];
            $transaction['items'] = array();
            
            $transactionID = $row1['transactionID'];
            $sql2 = " select * from transaction_detail where transactionID = $transactionID";
            $query2 = mysql_query($sql2);
            if(mysql_num_rows($query2)>0){
                while($row2 = mysql_fetch_array($query2,MYSQL_ASSOC)){
                    array_push($transaction['items'], $row2);                    
                }                
            }
			
			$customerID = $row1['customerID'];
            $sql3 = " select * from customer where customerID = $customerID";
            $query3 = mysql_query($sql3);
            if(mysql_num_rows($query3)>0){
                while($row3 = mysql_fetch_array($query3,MYSQL_ASSOC)){
                    array_push($transaction['customers'], $row3);                    
                }                
            }
            array_push($response['data'],$transaction);
        }
        echo json_encode($response);
    }else {
        $response["responseCode"]=0;
        $response["msg"]="No record found";
        $response["data"] = null;
        echo json_encode($response);
    }
?>