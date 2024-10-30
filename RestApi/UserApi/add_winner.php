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

require 'libs/firebase_vendor/autoload.php';
use Kreait\Firebase\Factory;


$factory = (new Factory())->withProjectId('blazebet-2eaf1')->withDatabaseUri('https://blazebet-2eaf1-default-rtdb.asia-southeast1.firebasedatabase.app/');
$firedata = $factory->createDatabase();

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
            
            $game_id = $row['bz_game_unique_id'];
            $user->game_id = $row['bz_game_unique_id'];
            $date = $row['bz_color_date'];
            $bz_win_color = $row['bz_win_color'];
            $newDate = date("Y-m-d H:i:s",strtotime($date." +30 second"));
            
            $current_time = date('Y-m-d H:i:s');
            
            $start_datetime = new DateTime($current_time); 
            $diff = $start_datetime->diff(new DateTime($newDate)); 
            if($current_time < $newDate){
                $time = $diff->s;
                
                if($time <= 5 && $bz_win_color == ''){
                    
                    
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
                
                
                    $stmt = $user->WinnerNumber();
                    $itemCount = $stmt->rowCount();
                    if($itemCount > 0){        
                        $data = array();
                        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                            $number = $row['bz_bet'];
                            
                            
                        }
                    } else{
                        $number = '';
                    }
                    
                    $user->win_number = $number;
                    $user->win_color= $color;
                    
                    $user->UpdateGame();
                
                   echo json_encode(array("status"=>true, "game_id"=>$user->game_id, "color"=>$color, "number"=>$number)); 
                    
                } else{
                    echo "aleady added";
                }
                
                
            } else{
                echo $time = '0';
            
            }
            
           
        }
    } 
   
    
    echo json_encode(array("status"=>true, "msg"=>$msg, "game_id"=>"$game"));
