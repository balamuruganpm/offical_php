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
if ($itemCount > 0) {
    $data = array();
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {

        $status = true;
        $msg = 'Redirect to Home page';
        $date = $row['bz_color_date'];
        $time = $row['bz_color_time'];
        $bz_time_slot = $row['bz_time_slot'];

        //            $date = date($date);

        // Calculate the new date and time by adding 3 minutes to the current time
$newDate = date("Y-m-d H:i:s", strtotime($date . " +3 minutes"));

$current_time = date('Y-m-d H:i:s');

$start_datetime = new DateTime($current_time);
$end_datetime = new DateTime($newDate);

$diff = $start_datetime->diff($end_datetime);

if ($current_time < $newDate) {
    // Calculate the remaining time in seconds
    $time = $diff->s + $diff->i * 60 + $diff->h * 3600; // Convert minutes and hours to seconds
} else {
    $time = 0;
}

$data[] = array(
    "game_id" => $row['bz_game_unique_id'],
    "time_left" => $time 
);

    }
}

echo json_encode(array("status" => true, "data" => $data));
