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


$cus_stmt = $user->checkUser();
$cusCount = $cus_stmt->rowCount();
if ($cusCount == 0) {
    echo json_encode(array("Status" => "Failed", "message" => "Customer Id not found"));
    exit();
}


// set bank details property values
$user->cus_id = $data->cus_id;
$user->comps_and_sug = $data->comps_and_sug;


// insert bank details
$register = $user->insertComplaints();
if ($register) {
    http_response_code(201);
    echo json_encode(['status' => true, 'message' => 'Complaints and Suggestions Send successful']);
    exit();
} else {
    $status = false;
    $msg = 'Something is wrong, please try again!';
    echo json_encode(array("status" => $status, "msg" => $msg));
    exit();
}