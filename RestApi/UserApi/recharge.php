<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
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

// get database connection
$database = new Database();
$db = $database->getConnection();

// instantiate user object
$user = new User($db);
$validate = new Validate($db);

$data = json_decode(file_get_contents("php://input"));
date_default_timezone_set('Asia/Calcutta'); 

// set product property values
$validate->api_key = $data->api_key;

$user->cus_id = $data->cus_id;
$user->amount = $data->amount;
$user->date = date('Y-m-d');
$user->time = date('H:i:s');
$user->t_id = $data->cus_id.date('ymd').date('His');

//validate api key
$stmt = $validate->getValidate();
$itemCount = $stmt->rowCount();

if($itemCount == 0) {
    echo json_encode(array("status" => "Failed", "message" => "Api Key Not Match"));
    exit();
}

// Check the recharge count for the user
$userRechargeCount = $user->getRechargeCount($data->cus_id);
if($userRechargeCount === false) {
    // Handle database error or user not found
    $status = false;  
    $msg = 'Failed to retrieve recharge count for the user.';
    echo json_encode(array("status"=>$status, "msg"=>$msg));
    exit();
}

$maxRechargeCount = 3;

// Apply bonus code based on recharge count
$bonusCode = '';
switch($userRechargeCount) {
    case 0:
        $bonusCode = 'WELCOME50';
        break;
    case 1:
        $bonusCode = 'WELCOME25';
        break;
    case 2:
        $bonusCode = 'WELCOME10';
        break;
    default:
        // No bonus code for subsequent recharges
        break;
}

// Set bonus code in the user object
$user->bonus_code = $bonusCode;
$bonusPercent = $user->getBonuspercent($user->bonus_code);
if($bonusPercent === false) {
    // Handle database error or bonus code not found
    $status = false;  
    $msg = 'Failed to retrieve Bonus percentage.';
    echo json_encode(array("status"=>$status, "msg"=>$msg));
    exit();
}
$user->bonusPercent = $bonusPercent;

// Proceed with recharge
$register = $user->Recharge();
if($register) {
    $status = true;  
    $msg = 'Process The Payment!';
    echo json_encode(array("status"=>$status, "msg"=>$msg, "success_link"=>"https://teckzy.in/colorcash/RestApi/UserApi/success?t_id=".$user->t_id, "failed_link"=>"https://teckzy.in/colorcash/RestApi/UserApi/failed?t_id=".$user->t_id));
    exit();
} else {
    $status = false;  
    $msg = 'Something is wrong please try again!';
    echo json_encode(array("status"=>$status, "msg"=>$msg));
    exit();
}
?>
