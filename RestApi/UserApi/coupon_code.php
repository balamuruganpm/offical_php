<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

session_start();

include_once 'config/database.php';
include_once 'objects/qrcode_obj.php';

$database = new Database();
$db = $database->getConnection();

$data = json_decode(file_get_contents("php://input"));

$customer_id = $data->customer_id;
$coupon_id = $data->coupon_id;

$coupon = new CouponCode($db);
$coupon->customer_id = $customer_id;
$coupon->coupon_id = $coupon_id;




$couponCheck = $coupon->couponCheck();
if($couponCheck){
    if ($couponCheck->rowCount() > 0) {
        $stmt = $coupon->scanQR();
        if ($stmt) {
            if ($stmt->rowCount() > 0) {
               
                $response = array(
                    "status" => "Success",
                    "message" => "Coupon successfully redeemed."
                );
                // header("HTTP/1.1 200 OK");
                echo json_encode($response);
            } else {
              
                $response = array(
                    "status" => "Failed",
                    "message" => "Coupon is invalid or has already been redeemed."
                );
                // header("HTTP/1.1 400 Bad Request");
                echo json_encode($response);
            }
        } else {
        
            $response = array(
                "status" => "Failed",
                "message" => "Coupon is invalid or has already been redeemed."
            );
            // header("HTTP/1.1 500 Internal Server Error");
            echo json_encode($response);
        }
    }else{
        $response = array(
            "status" => "Failed",
            "message" => "Coupon Code Worng."
        );
        // header("HTTP/1.1 500 Internal Server Error");
        echo json_encode($response);
    }
    
}else{
    $response = array(
        "status" => "Failed",
        "message" => "Coupon Code Worng."
    );
    header("HTTP/1.1 500 Internal Server Error");
    echo json_encode($response);
}


