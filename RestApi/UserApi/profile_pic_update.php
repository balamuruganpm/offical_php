<?php
session_start();

ini_set('display_errors', 1);
error_reporting(E_ALL);

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

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['cus_id']) && isset($_FILES['profile_pic'])) {
        $cus_id = $_POST['cus_id'];
        $profile_pic = $_FILES['profile_pic'];

        // Define the target directory and file name
        $target_dir = "../../upload/profile/";
        $target_file = $target_dir . basename($profile_pic["name"]);
        
        // Create the directory if it doesn't exist
        if (!is_dir($target_dir)) {
            mkdir($target_dir, 0755, true);
        }

        // Attempt to move the uploaded file to the target directory
        if (move_uploaded_file($profile_pic["tmp_name"], $target_file)) {
            // Retrieve the existing customer data
            $existingCustomerData = $user->getCustomerData($cus_id);

            if (!$existingCustomerData) {
                http_response_code(404);
                echo json_encode(['status' => false, 'message' => 'Customer not found']);
                exit;
            }

            // Update the bz_cus_profile path in the customer data
            $existingCustomerData['bz_cus_profile'] = str_replace('../../','',$target_file);

            if ($user->update($existingCustomerData)) {
                http_response_code(200);
                echo json_encode(['status' => true, 'message' => 'Customer updated successfully']);
            } else {
                http_response_code(500);
                echo json_encode(['status' => false, 'message' => 'Customer update failed']);
            }
        } else {
            http_response_code(500);
            echo json_encode(['status' => false, 'message' => 'Failed to move uploaded file']);
        }
    } else {
        http_response_code(400);
        echo json_encode(['status' => false, 'message' => 'Required data not provided']);
    }
}
?>
