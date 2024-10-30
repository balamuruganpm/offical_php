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
// require 'libs/firebase_vendor/autoload.php';
// use Kreait\Firebase\Factory;


// $factory = (new Factory())->withProjectId('blazebet-2eaf1')->withDatabaseUri('https://blazebet-2eaf1-default-rtdb.asia-southeast1.firebasedatabase.app/');
// $firedata = $factory->createDatabase();


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
$user->cus_id = $data->cus_id;
$user->game_id = $data->game_id;
$user->amount = $data->amount;
$user->no_or_color = $data->no_or_color;
$user->game_type = $data->game_type;
$user->adddate = date('Y-m-d H:i:s');

if($user->game_type == 'Number'){

    if($user->no_or_color == 0){
        $user->color = "Red";
    }
    else if($user->no_or_color == 1){
        $user->color = "Green";
    }
    else if($user->no_or_color == 2){
        $user->color = "Red";
    }
    else if($user->no_or_color == 3){
        $user->color = "Green";
    }
    else if($user->no_or_color == 4){
        $user->color = "Red";
    }
    else if($user->no_or_color == 5){
        $user->color = "Green";
    }
    else if($user->no_or_color == 6){
        $user->color = "Red";
    }
    else if($user->no_or_color == 7){
        $user->color = "Green";
    }
    else if($user->no_or_color == 8){
        $user->color = "Red";
    }
    else if($user->no_or_color == 9){
        $user->color = "Green";
    } 
        
}
else{
    $user->color = $user->no_or_color;
}

$stmt = $user->userDetail();
    $itemCount = $stmt->rowCount();
    if($itemCount > 0){        
        $data = array();
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            $wallet = $row['bz_cus_wallet'];
        }
    } 

//$stmt = $user->lastGame();
//    $itemCount = $stmt->rowCount();
//    if($itemCount > 0){        
//        $data = array();
//        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
//            $wallet = $row['bz_cus_wallet'];
//        }
//    } 


//exit();
if($wallet >= $user->amount){
    $query = $user->AddGame();

        if($query){
            $last = $db->lastInsertId();
            $postData = [
                'UserID' => $user->cus_id,
                'GameID' => $user->game_id,
                'Amount' => $user->amount,
                'number_color' => $user->no_or_color,
                'game_type' => $user->game_type,
                'join_color' => $user->color,
            ];
            
            // $updates = [
            //     'game/'.$last => $postData,
            // ];
            
            // $firedata->getReference() // this is the root reference
            // ->update($updates);
            
            $user->updated_wallet = $wallet - $user->amount;
            $user->game_name = 'Color Prediction';
            $user->payment_type = 'Debit';
            $user->updateWallet();
            $user->AddHistory();
            echo json_encode(array("status"=>true, "msg"=>"Successfully Added!"));
        } else{
            echo json_encode(array("status"=>false, "msg"=>"Something is wrong please try again!"));
        }
}
else{
    echo json_encode(array("status"=>false, "msg"=>"Wallet balance is low!"));
}


    
    
