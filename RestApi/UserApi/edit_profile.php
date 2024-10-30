<?php
session_start();

ini_set('display_errors', 1);
error_reporting(E_ALL);

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include_once 'config/database.php'; // Make sure to adjust the path as per your project structure
include_once 'objects/admin.php'; // Make sure to adjust the path and class name

$database = new Database();
$db = $database->getConnection();
$customer = new User($db); 

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents("php://input"));

    if ($data) {
        if (isset($data->customer_id)) {
            $customer_id = $data->customer_id; 
        } else {
            http_response_code(400);
            echo json_encode(['status' => false, 'message' => 'No customer_id provided for update']);
            exit;
        }

        // Retrieve the existing customer data
        $existingCustomerData = $customer->getCustomerData($customer_id);

        if (!$existingCustomerData) {
            http_response_code(404);
            echo json_encode(['status' => false, 'message' => 'Customer not found']);
        } else {
            // Convert the existingCustomerData array to an object
            $existingCustomerData = (object) $existingCustomerData;

            // Update the fields that are provided
            if (isset($data->first_name)) {
                $existingCustomerData->first_name = $data->first_name;
            }
            if (isset($data->last_name)) {
                $existingCustomerData->last_name = $data->last_name;
            }
            if (isset($data->phone)) {
                $existingCustomerData->phone = $data->phone;
            }
            if (isset($data->email)) {
                $existingCustomerData->email = $data->email;
            }

           
            if ($customer->update((array) $existingCustomerData)) {
                http_response_code(200);
                echo json_encode(['status' => true, 'message' => 'Customer updated successfully']);
            } else {
                http_response_code(500);
                echo json_encode(['status' => false, 'message' => 'Customer update failed']);
            }
        }
    } else {
        http_response_code(400);
        echo json_encode(['status' => false, 'message' => 'Invalid JSON data']);
    }
}
?>
