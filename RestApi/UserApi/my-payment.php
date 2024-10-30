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
$user->game_id = $data->game_id;
$user->cus_id = $data->cus_id;

$stmt = $user->MyPayment();
    $itemCount = $stmt->rowCount();
    if($itemCount > 0){        
        $data = array();
        $i = 1;
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            $bz_amount = $row['bz_amount'];
            $bz_game = $row['bz_game'];
            $bz_payment_date = $row['bz_payment_date'];
            $payment_type = $row['payment_type'];
            
            $date = date("d M Y h:iA", strtotime($bz_payment_date));
            
            $data[] = array("id"=>$i++, "amount"=>$bz_amount, "payment_type"=>$payment_type, "type"=>$bz_game, "date"=>$date);
        }
    } 
    else{
        $data = array();
    }

echo json_encode(array("status"=>true, "mybet"=>$data));


    
    
