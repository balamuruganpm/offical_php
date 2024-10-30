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
$bonus = new User($db);

$data = json_decode(file_get_contents("php://input"));
// error_log(print_r($data, true));
if ($data) {
    if (isset($data->cus_id)) {
        $bonus->cus_id = $data->cus_id;  // Set the cus_id property
    } else {
        http_response_code(400);
        echo json_encode(['status' => false, 'message' => 'No customer_id provided for update']);
        exit;
    }

    $bonusDetails = $bonus->getBonus();  // Removed the argument from getAccount

    if (!$bonusDetails) {
        http_response_code(404);
        echo json_encode(['status' => false, 'message' => 'Account Detail not found']);
    } else {
        echo json_encode(array("status" => true, "message" => "Bonus Details.", "data" => $bonusDetails));
    }
} else {
    http_response_code(400);
    echo json_encode(['status' => false, 'message' => 'Invalid JSON data']);
}
?>
