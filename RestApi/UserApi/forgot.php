<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

session_start();

include_once 'config/database.php';
include_once 'objects/admin.php';

require 'Twilio/autoload.php';

$accountSid = '';
$authToken = '';

$twilio = new Twilio\Rest\Client($accountSid, $authToken);

$database = new Database();
$db = $database->getConnection();
$user = new User($db); 

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents("php://input"));

    if (!empty($data->phone)) {
        $phone = $data->phone;

        if ($user->phoneExists($phone)) {
            $otp = mt_rand(100000, 999999);

            if ($user->updateOtp($phone, $otp)) {

                // $phone = $data->phone;

                // $message = $twilio->messages
                // ->create(
                //     $phone,
                //     [
                //         'from' => '+18564729759',
                //         'body' => "Your OTP is: $otp",
                //     ]
                // );

  
                // if ($message->sid) {
                    echo json_encode(array("status" => true, "message" => "OTP sent via SMS."));
                // } else {
                    // echo json_encode(array("status" => false, "message" => "SMS could not be sent."));
                // }
            } else {
                echo json_encode(array("status" => false, "message" => "Unable to update OTP in the database."));
            }
        } else {
            echo json_encode(array("status" => false, "message" => "Phone number not registered."));
        }
    } else {
        echo json_encode(array("status" => false, "message" => "Phone number not provided in the request."));
    }
}

?>
