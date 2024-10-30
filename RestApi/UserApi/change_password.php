<?php

// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

// files needed to connect to database
include_once 'config/database.php';
include_once 'objects/login.php';
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

// set product property values
$validate->api_key = $data->api_key;

$user->cus_id = $data->cus_id;
$user->password = $data->password;


//validate api key
 $stmt = $validate->getValidate();
    $itemCount = $stmt->rowCount();

    if($itemCount > 0){
        
    } else{
        echo json_encode(array("Status" => "Failed", "message" => "Api Key Not Match"));
        exit();
    }

//exit();
 
    
    $register = $user->change_password();
    if($register){
        $status = true;  
        $msg = 'Password Successfully Updated!';
        echo json_encode(array("status"=>$status, "msg"=>$msg));
        exit();
    } else{
        $status = false;  
        $msg = 'Something is wrong please try again!';
        echo json_encode(array("status"=>$status, "msg"=>$msg));
        exit();
    }
?>