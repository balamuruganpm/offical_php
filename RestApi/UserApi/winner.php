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

$stmt = $user->FetchLastGame();
    $itemCount = $stmt->rowCount();
    if($itemCount > 0){        
        $data = array();
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            
            $user->game_id = $row['bz_game_unique_id'];
            
        }
    }



    $stmt = $user->WinnerColor();
    $itemCount = $stmt->rowCount();
    if($itemCount > 0){        
        $data = array();
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            $color = $row['bz_bet'];
            
            if($color == 'Red'){
                    $user->number = "2,4,6,8,0";
            } else if($color == 'Green'){
                    $user->number = "1,3,7,9,5";
            } else{
                $user->number = "0,5";
            }
        }
    } else{
        $color = '';
        $user->number = "0,1,2,3,4,5,6,7,8,9";
    }
$last_digit = substr($user->game_id, -1);

    $stmt = $user->WinnerNumber();
    $itemCount = $stmt->rowCount();
    if($itemCount > 0){        
        $data = array();
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            $number = $row['bz_bet'];
            
            
        }
    } else{
        $number = $last_digit;
    }



echo json_encode(array("status"=>true, "game_id"=>$user->game_id, "color"=>$color, "number"=>$number));

    
    
