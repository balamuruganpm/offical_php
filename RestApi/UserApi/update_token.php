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


// get database connection
$database = new Database();
$db = $database->getConnection();

// instantiate user object
$user = new User($db);
$validate = new Validate($db);

$data = json_decode(file_get_contents("php://input"));

// set product property values
$validate->api_key = $data->api_key;
$user->phone = $data->phone;
$user->token = $data->token;
//validate api key
 $stmt = $validate->getValidate();
    $itemCount = $stmt->rowCount();

    if($itemCount > 0){
        
    } else{
        echo json_encode(array("Status" => "Failed", "message" => "Api Key Not Match"));
        exit();
    }

    $query = $user->updateToken();

    if($query){
        $status = true;
        $msg = 'Token Updated Successfully!';
    }
     else{
        $status = false;
        $msg = 'Token Not Updated!';
     }
  
   
    
        echo json_encode(array("status"=>$status, "msg"=>$msg));
?>