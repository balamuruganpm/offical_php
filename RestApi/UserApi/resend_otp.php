<?php

error_reporting(0);
session_start();

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include_once 'config/database.php';
include_once 'objects/admin.php'; // Assuming your User class is in the admin.php file

$database = new Database();
$db = $database->getConnection();

$user = new User($db); // Instantiate the User class


    if ($_SESSION['email']) {

        if ($user->resetPassOTP($_SESSION['email'])) {
            http_response_code(400);
            echo json_encode(array("status" => false, "message" => "OTP Send Success"));
        } else {
            http_response_code(500);
            echo json_encode(['status' => false, 'message' => 'Failed to send OTP']);
            exit;
        }
    } else {
        http_response_code(400);
            echo json_encode(array("status" => false, "message" => "You First Click Send OTP"));
    }

