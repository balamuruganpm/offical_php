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

$stmt = $user->FetchWinnerList();
    $itemCount = $stmt->rowCount();
    if($itemCount > 0){        
        $data = array();
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            
            $game_id = $row['bz_game_unique_id'];
            $bz_win_number = $row['bz_win_number'];
            $bz_win_color = $row['bz_win_color'];
            
            $new_game_id = substr($game_id, -3);
            
            if($bz_win_number == '0'){
                $number = '?';
            } else{
                $number = "$bz_win_number";
            } 
            if($bz_win_color == ''){
                $color = 'Orange';
            } else{
                $color = $bz_win_color;
            }
            
            
            $data[] = array("game_id"=>$new_game_id, "number"=>$number, "color"=>$color);
            
            $datas = array_reverse($data);
            
            
            
           
        }
    } else{
        $datas = array();
    } 
    
    echo json_encode(array("status"=>true, "winner_list"=>$datas));
