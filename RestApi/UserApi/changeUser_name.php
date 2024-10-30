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
$validate->api_key = $data->api_key;

$user->cus_id = $data->cus_id;
$user->name = $data->name;




//validate api key
 $stmt = $validate->getValidate();
    $itemCount = $stmt->rowCount();

    if($itemCount > 0){
        
    } else{
        echo json_encode(array("Status" => "Failed", "message" => "Api Key Not Match"));
        exit();
    }

//exit();
 
    
    $register = $user->updateUsername();
    if($register){
        http_response_code(201);
        echo json_encode(['status' => true, 'message' => 'Username Change successful']);
        exit();
    } else{
        $status = false;  
        $msg = 'Something is wrong please try again!';
        echo json_encode(array("status"=>$status, "msg"=>$msg));
        exit();
    }
?>