<?php
ini_set('display_errors', 0);
error_reporting(E_ALL);
session_start(); // Enable session handling
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include_once 'config/database.php';
include_once 'objects/admin.php';

$database = new Database();
$db = $database->getConnection();

$user = new User($db);

$data = json_decode(file_get_contents("php://input"));

// Step 1: Handle OTP Sending
if (!isset($data->otp)) {
    // If OTP is not provided, send it
    if (isset($data->cus_name) && isset($data->phone) && isset($data->email)) {
        $user->bz_cus_name = $data->cus_name;
        $user->bz_cus_phone = $data->phone;
        $user->bz_cus_email = $data->email;

        // Check if the phone or email already exists
        $stmt = $user->phoneCheck();
        if ($stmt->rowCount() > 0) {
            http_response_code(400);
            echo json_encode(array("status" => false, "message" => "Mobile Number Already Exists."));
            exit;
        }

        $stmt = $user->emailCheck();
        if ($stmt->rowCount() > 0) {
            http_response_code(400);
            echo json_encode(array("status" => false, "message" => "Email Id Already Exists."));
            exit;
        }

        // Generate and store the OTP in the session
        $otp = rand(100000, 999999);
        $_SESSION['otp'] = $otp;
        $_SESSION['email'] = $data->email;

        // Send the OTP via email
        if ($user->sendOTP($data->email, $otp)) {
            http_response_code(200);
            echo json_encode(array("status" => true, "message" => "OTP Sent Successfully"));
        } else {
            http_response_code(500);
            echo json_encode(['status' => false, 'message' => 'Failed to send OTP']);
        }
    } else {
        http_response_code(400);
        echo json_encode(['status' => false, 'message' => 'Incomplete data']);
    }
} else {
    // Step 2: Handle OTP Validation and User Registration
    if (isset($data->email) && isset($data->otp) && isset($data->password) && isset($data->c_password) && isset($data->w_password)) {
        // Retrieve OTP from session
        $stored_otp = $_SESSION['otp'] ?? null;

        if ($data->otp == $stored_otp) {
            // Proceed with user registration
            $user->bz_cus_name = $data->cus_name;
            $user->bz_cus_phone = $data->phone;
            $user->bz_cus_email = $data->email;
            $user->bz_cus_password = $data->password;
            $user->c_password = $data->c_password;
            $user->w_password = $data->w_password;

            if ($user->bz_cus_password !== $user->c_password) {
                http_response_code(400);
                echo json_encode(array("status" => false, "message" => "Password Does Not Match."));
            } else {
                $res = $user->Register();
                if ($res) {
                    // Fetch the user data to include in the response
                    $userData = $user->getUserByEmail($user->bz_cus_email);
                    if ($userData) {
                        http_response_code(201);
                        echo json_encode(['status' => true, 'message' => 'Registration successful', 'data' => $userData]);
                    } else {
                        http_response_code(500);
                        echo json_encode(['status' => false, 'message' => 'Failed to fetch user data']);
                    }
                } else {
                    http_response_code(500);
                    echo json_encode(['status' => false, 'message' => 'Registration Failed']);
                }
            }
        } else {
            http_response_code(400);
            echo json_encode(array("status" => false, "message" => "Invalid OTP"));
        }
    } else {
        http_response_code(400);
        echo json_encode(array("status" => false, "message" => "Incomplete data"));
    }
}
