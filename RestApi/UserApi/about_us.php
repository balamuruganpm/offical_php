<?php
ini_set('display_errors', 0);
error_reporting(E_ALL);

// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

// including necessary files
include_once 'config/database.php';
include_once 'objects/admin.php';
include_once 'objects/validate.php';

// creating database connection
$database = new Database();
$db = $database->getConnection();

// instantiating User and Validate objects
$user = new User($db);
$validate = new Validate($db);

// decoding json input
$data = json_decode(file_get_contents("php://input"));

// checking if API key is provided
if (!empty($data->api_key)) {
    $validate->api_key = $data->api_key;

    // validating API key
    $stmt = $validate->getValidate();
    $itemCount = $stmt->rowCount();

    if ($itemCount > 0) {
        // fetching About Us content
        $stmt = $user->aboutUs();
        $itemCount = $stmt->rowCount();

        if ($itemCount > 0) {
            $about_us_data = array();
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $about_us_data[] = $row['about_us'];
            }
            echo json_encode(array("status" => true, "message" => "About Us", "Data" => $about_us_data));
        } else {
            http_response_code(400);
            echo json_encode(array("status" => false, "message" => "No About Us Found"));
        }
    } else {
        echo json_encode(array("status" => "Failed", "message" => "Api Key Not Match"));
    }
} else {
    echo json_encode(array("status" => "Failed", "message" => "API Key is missing."));
    exit();
}
?>
