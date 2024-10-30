<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
// database connection will be here
// database connection will be here
session_start();
// files needed to connect to database
include_once 'config/database.php';
include_once 'objects/dashboard_obj.php';
// get database connection
$database = new Database();
$db = $database->getConnection();
// instantiate user object

$data = json_decode(file_get_contents("php://input"));

$customer_id =$data->customer_id;

$user = new Dashboard($db);


// if (isset($data->customer_id)) {
    $user->customer_id = $data->customer_id;    

    $stmt = $user->transection_history();
    $itemCount = $stmt->rowCount();
    if($itemCount > 0){
        $transection = array();
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            // $product_id = $row['product_id'];
            $transection[] = array(
                "transection_id" => $row['transection_id'],
                "amount" => $row['amount'],
                "transection_type" => $row['transection_type'],
                "customer_id" => $row['customer_id'],
                "transection_date" => $row['transection_date'],
                "transection_status" => ($row['transection_status'] == 0 ? 'Received' : 'Pending')
                
            );
        }
    }
    else{
        $transection[] = array();
    }


    $stmt = $user->earning_point();
    $itemCount = $stmt->rowCount();
    if($itemCount > 0){
        $earning_point = array();
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            
            $earning_point[] = array(
         
                "total_amount" => $row['total_amount']
           
            );
        }
    }
    else{
        $earning_point[] = array();
    }

    $stmt = $user->reedmed_point();
    $itemCount = $stmt->rowCount();
    if($itemCount > 0){
        $reedmed_point = array();
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            // $product_id = $row['product_id'];
            $reedmed_point[] = array(
              
                "total_amount" => $row['total_amount']
      
            );
        }
    }
    else{
        $reedmed_point[] = array();
    }

    $stmt = $user->avaliable_point();
    $itemCount = $stmt->rowCount();
    if($itemCount > 0){
        $avaliable_point = array();
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            // $product_id = $row['product_id'];
            $avaliable_point[] = array(
              
                "balance" => $row['balance']
      
            );
        }
    }
    else{
        $avaliable_point[] = array();
    }

    if (!empty($transection) && isset($transection[0]['customer_id'])) {
        echo json_encode(array(
            "status" => true,
            "msg" => "Dashboard complete data!",
            "customer_id" => $customer_id,
            "earning_point" => $earning_point,
            "reedmed_point" => $reedmed_point,
            "available_point" => $avaliable_point,
            "transection_history" => $transection
        ));
    } else {
        echo json_encode(array(
            "status" => true,
            "msg" => "Dashboard complete data!",
            "customer_id" => $customer_id,
            "earning_point" => ($earning_point[0]['total_amount'] !== null ? $earning_point[0]['total_amount'] : array()),
            "reedmed_point" => ($reedmed_point[0]['total_amount'] !== null ? $reedmed_point[0]['total_amount'] : array()),
            "avaliable_point" => ($avaliable_point[0]['balance'] !== null ? $avaliable_point[0]['balance'] : array()),
            "transection_history" => array() 
            
        ), JSON_UNESCAPED_UNICODE);
    }
// } else {

//     echo json_encode(array(
//         "status" => false,
//         "msg" => "customer_id is not set in the POST data."
//     ));
// }
   
    
    
?>