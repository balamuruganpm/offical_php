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

date_default_timezone_set("Asia/Calcutta");

// get database connection
$database = new Database();
$db = $database->getConnection();

// instantiate user object
$user = new User($db);
$validate = new Validate($db);

$data = json_decode(file_get_contents("php://input"));

// set product property values
$validate->api_key = $data->api_key;
$user->cus_id = $data->cus_id;

$stmt = $user->MyWithPayment();
    $itemCount = $stmt->rowCount();
    if($itemCount > 0){        
        $data = array();
        $i = 1;
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            $bz_amount = $row['bz_amount'];
            $bz_date = $row['bz_date'];
            $bz_time = $row['bz_time'];
            $bz_status = $row['bz_status'];
            
            if($bz_status == 0){
                $st = 'Pending';
            } else if($bz_status == 1){
                $st = 'Completed';
            }else{
                $st = 'Rejected';
            }
            
            $date = date("d M Y", strtotime($bz_date));
            $time = date("d M Y", strtotime($bz_time));
            
            $data[] = array("amount"=>$bz_amount, "date"=>$date, "time"=>$time, "payment_status"=>$st);
        }
    } 
    else{
        $data = array();
    }

echo json_encode(array("status"=>true, "List"=>$data));


    
    
