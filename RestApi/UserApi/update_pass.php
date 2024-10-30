<?php
session_start();

ini_set('display_errors', 1);
error_reporting(E_ALL);

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include_once 'config/database.php'; // Adjust the path as per your project structure
include_once 'objects/admin.php'; // Adjust the path and class name

$database = new Database();
$db = $database->getConnection();
$user = new User($db);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents("php://input"));

    if ($data && isset($data->new_password) && isset($data->confirm_password)) {
        $customer_id = $_SESSION['customer_id']; 

       
        $new_password = $data->new_password;
        $confirm_password = $data->confirm_password;

        // Verify the OTP
        if ($user->verifyOTP($customer_id)) {
            if ($new_password === $confirm_password) {
                $new_password = password_hash($new_password, PASSWORD_BCRYPT);

                // Update the user's password
                if ($user->updatePassword($customer_id, $new_password)) {
                    http_response_code(200);
                    echo json_encode(['status' => true, 'message' => 'Password updated successfully']);
                } else {
                    http_response_code(500);
                    echo json_encode(['status' => false, 'message' => 'Password update failed']);
                }
            } else {
                http_response_code(400);
                echo json_encode(['status' => false, 'message' => 'Passwords do not match']);
            }
        } else {
            http_response_code(400);
            echo json_encode(['status' => false, 'message' => 'Invalid OTP']);
        }
    } else {
        http_response_code(400);
        echo json_encode(['status' => false, 'message' => 'Invalid request data']);
    }
}
?>
