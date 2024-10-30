<?php

// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

// files needed to connect to database
include_once '../config/database.php';
include_once '../objects/admin.php';
include_once '../objects/validate.php';

//ini_set('error_reporting', 0);
//ini_set('display_errors', 0);   


$database = new Database();
$db = $database->getConnection();


$user = new User($db);
$validate = new Validate($db);

$data = json_decode(file_get_contents("php://input"));

$validate->api_key = $data->api_key;


 $stmt = $validate->getValidate();
    $itemCount = $stmt->rowCount();

    if($itemCount > 0){
        
    } else{
        echo json_encode(array("Status" => "Failed", "message" => "Api Key Not Match"));
        exit();
    }


    $stmt = $user->aboutUs();
    $itemCount = $stmt->rowCount();
    if($itemCount > 0){        
        $datas = array();
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            $about = $row['content'];
   
            echo json_encode(array("about"=>$about));
        }
    } 
    else{
        $datas = array();
        echo json_encode(array("status"=>"Failed", "message"=>"No Data Available"));
    }


  
   
    
        
?>