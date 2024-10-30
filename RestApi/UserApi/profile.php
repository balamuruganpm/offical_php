<?php
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
$customer = new User($db);

$data = json_decode(file_get_contents("php://input"));

if ($data) {
    if (isset($data->customer_id)) {
        $customer_id = $data->customer_id;
    } else {
        http_response_code(400);
        echo json_encode(['status' => false, 'message' => 'No customer_id provided for update']);
        exit;
    }

    $CustomerData = $customer->getCustomerData($customer_id);

    if (!$CustomerData) {
        http_response_code(404);
        echo json_encode(['status' => false, 'message' => 'Customer not found']);
    } else {
        echo json_encode(array("status" => true, "message" => "User Profile.", "data" => $CustomerData));
    }
} else {
    http_response_code(400);
    echo json_encode(['status' => false, 'message' => 'Invalid JSON data']);
}
?>
