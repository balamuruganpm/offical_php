<?php

// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

// files needed to connect to database
include_once 'config/database.php';
include_once 'objects/admin.php';
include_once 'objects/validate.php';

//ini_set('error_reporting', 0);
//ini_set('display_errors', 0);   

// get database connection
$database = new Database();
$db = $database->getConnection();

// instantiate user object
$user = new User($db);
$validate = new Validate($db);

$data = json_decode(file_get_contents("php://input"));
date_default_timezone_set('Asia/Calcutta'); 

// set product property values
//$validate->api_key = $data->api_key;

$user->t_id = $_GET['t_id'];
$user->status = 1;

$stmt = $user->GetPayment();
$itemCount = $stmt->rowCount();
if($itemCount > 0){        
    $data = array();
    $i = 1;
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        $bz_amount = $row['total_amt'];
        $user->cus_id = $row['bz_cus_id'];
        
    }
} 

$stmt = $user->userDetail();
$itemCount = $stmt->rowCount();
if($itemCount > 0){        
    $data = array();
    $i = 1;
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        $bz_cus_wallet = $row['bz_cus_wallet'];
        
    }
} 


$user->updated_wallet = $bz_amount + $bz_cus_wallet;

$user->updateWallet();



 
    
    $register = $user->UpdateRecharge();
    if($register){
        $status = true;  
        $msg = 'Payment Successfully Completed!';
        echo json_encode(array("status"=>$status, "msg"=>$msg));
        exit();
    } else{
        $status = false;  
        $msg = 'Something is wrong please try again!';
        echo json_encode(array("status"=>$status, "msg"=>$msg));
        exit();
    }
?>