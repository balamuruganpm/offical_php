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

// print_r($data);

// set product property values
$validate->api_key = $data->api_key;
$user->game_id = $data->game_id;
$user->cus_id = $data->cus_id;

$stmt = $user->MyBet();
    $itemCount = $stmt->rowCount();
    if($itemCount > 0){        
        $data = array();
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            $type = $row['bz_game_type'];
            $bz_bet = $row['bz_bet'];
            $bz_spend_amount = $row['bz_spend_amount'];
            
            $data[] = array("type"=>$type, "bet"=>$bz_bet, "amount"=>$bz_spend_amount);
        }
    } 
    else{
        $data = array();
    }

echo json_encode(array("status"=>true, "mybet"=>$data));


    
    
