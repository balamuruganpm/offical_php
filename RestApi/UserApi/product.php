<?php
// ini_set('display_errors', 0);
// error_reporting(E_ALL);
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include_once 'config/database.php';
include_once 'objects/product.php';
include_once 'objects/validate.php';

$datbase = new Database();
$db = $datbase->getConnection();

$product = new Product($db);
$validate = new Validate($db);



$data = json_decode(file_get_contents("php://input"));

if (!empty($data->api_key)) {
    $validate->api_key = $data->api_key;

    $stmt = $validate->getValidate();
    $itemCount = $stmt->rowCount();

    if ($itemCount > 0) {
        $stmt = $product->getAllproducts();
        $itemCount = $stmt->rowCount();
        if ($itemCount > 0) {
            $datas = array();
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                 extract($row);
$row['pro_image'] = 'https://colourcash.com/admin/' . $pro_image;
                
                $datas[] = $row;
            }
            echo json_encode(array("status" => true, "message" => "Get All Products", "Data" => $datas));

        } else {
            http_response_code(400);
            echo json_encode(array("status" => false, "message" => "No Product Found"));
        }
    } else {
        echo json_encode(array("status" => "Failed", "message" => "Api Key Not Match"));
    }
} else {
    echo json_encode(array("status" => "Failed", "message" => "API Key is missing."));
    exit();
}
