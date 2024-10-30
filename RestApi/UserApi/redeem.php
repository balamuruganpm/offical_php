<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

session_start();

include_once 'config/database.php';
include_once 'objects/redeem_obj.php';

$database = new Database();
$db = $database->getConnection();

$data = json_decode(file_get_contents("php://input"));

$customer_id = $data->customer_id;
$amount = $data->amount;

$redeem = new ReddemAmount($db);
$redeem->customer_id = $customer_id;
$redeem->amount = $amount;

$availablePoint = $redeem->availablePoint();

if ($availablePoint >= $amount) {
    $redeemed = $redeem->Redeem();

    if ($redeemed) {
        $response = array(
            "status" => "Success",
            "message" => "$amount Redeem Request Sent Successfully."
        );

        echo json_encode($response);
    }
} else {
    $response = array(
        "status" => "Failed",
        "message" => "Insufficient Points."
    );

    header("HTTP/1.1 500 Internal Server Error");
    echo json_encode($response);
}
