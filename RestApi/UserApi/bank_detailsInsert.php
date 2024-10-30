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

// get database connection
$database = new Database();
$db = $database->getConnection();

// instantiate user object
$user = new User($db);

$data = json_decode(file_get_contents("php://input"));
date_default_timezone_set('Asia/Calcutta');

// set user property values
$user->cus_id = $data->cus_id;

$stmt = $user->checkAccount();
$itemCount = $stmt->rowCount();

if ($itemCount > 0) {
    $user->cus_id = $data->cus_id;
    $user->holder_name = $data->holder_name;
    $user->bank_name = $data->bank_name;
    $user->ac_no = $data->ac_no;
    $user->branch_name = $data->branch_name;
    $user->bank_ifsc = $data->bank_ifsc;
    $user->swift_code = $data->swift_code;
    $user->account_type = $data->account_type;
    
    $register2 = $user->updateAccount();
    if ($register2) {
        http_response_code(200);
        echo json_encode(['status' => true, 'message' => 'Account Detail Updated successful']);
        exit();
    } else {
        $status = false;
        $msg = 'Something is wrong, please try again!';
        http_response_code(401);
        echo json_encode(array("status" => $status, "msg" => $msg));
        exit();
    }
    
   
}

$cus_stmt = $user->checkUser();
$cusCount = $cus_stmt->rowCount();
if ($cusCount == 0) {
    echo json_encode(array("Status" => "Failed", "message" => "Customer Id not found"));
    exit();
}


// set bank details property values
$user->cus_id = $data->cus_id;
$user->holder_name = $data->holder_name;
$user->bank_name = $data->bank_name;
$user->ac_no = $data->ac_no;
$user->branch_name = $data->branch_name;
$user->bank_ifsc = $data->bank_ifsc;
$user->swift_code = $data->swift_code;
$user->account_type = $data->account_type;

// insert bank details
$register = $user->insertAccount();
if ($register) {
    http_response_code(200);
    echo json_encode(['status' => true, 'message' => 'Account Detail Insert successful']);
    exit();
} else {
    $status = false;
    $msg = 'Something is wrong, please try again!';
    echo json_encode(array("status" => $status, "msg" => $msg));
    exit();
}
