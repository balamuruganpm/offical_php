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
$data = json_decode(file_get_contents("php://input"));

if($data){
    if(isset($data->pro_name)){
        $pro_name =$data->pro_name;
    }else {
        http_response_code(400);
        echo json_encode(['status' => false, 'message' => 'Product Name not found']);
    }

    $pro_data = $product->getProductsByname($pro_name);
    if(!$pro_data){
        http_response_code(400);
        echo json_encode(['status' => false, 'message' => 'Product not found']);
    }else{
        echo json_encode(['status' => true, 'message' => 'Product details', "data" => $pro_data]);
    }

}else {
    http_response_code(400);
    echo json_encode(['status' => false, 'message' => 'Invalid JSON data']);
}


?>