<?php
session_start();

// Required headers for CORS
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");


include_once 'config/database.php';
include_once 'objects/admin.php';
include_once 'objects/validate.php';

$database = new Database();
$db = $database->getConnection();

$user = new User($db);
$validate = new Validate($db);


$data = json_decode(file_get_contents("php://input"));

if (!empty($data->api_key)) {
    $validate->api_key = $data->api_key;

    $stmt = $validate->getValidate();
    $itemCount = $stmt->rowCount();

    if ($itemCount > 0) {
     
        if (!empty($data->phone) && !empty($data->password)) {
            $user->bz_cus_phone = $data->phone;
            $user->bz_cus_password = $data->password;

            $stmt = $user->phoneCheck();
            $itemCount = $stmt->rowCount();
            if ($itemCount > 0) {
                
                $stmt = $user->loginCheck();
                $itemCount = $stmt->rowCount();
    
                if ($itemCount > 0) {
                    $datas = array();
                    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                        $_SESSION['bz_cus_id'] = $row['bz_cus_id'];
                        $_SESSION['bz_cus_name'] = $row['bz_cus_name'];
                        $_SESSION['bz_cus_email'] = $row['bz_cus_email'];
                        $_SESSION['bz_cus_phone'] = $row['bz_cus_phone'];
    
                        extract($row);
                        $e = $row;
                        array_push($datas, $e);
    
                        // Send a success response
                        echo json_encode(array("status" => true, "message" => "User login successful.", "data" => $row));
                    }
                } else {
                    // Send a failed login response
                    echo json_encode(array("status" => "Failed", "message" => "User acsess Denied!"));
                }
            }else{
                http_response_code(400); 
                echo json_encode(array("status" => false, "message" => "Mobile Number Not Register."));
            }

           
        } else {
            // Missing phone or password in JSON data
            echo json_encode(array("status" => "Failed", "message" => "phone and password are required fields."));
        }
    } else {
        // Invalid API Key
        echo json_encode(array("status" => "Failed", "message" => "Api Key Not Match"));
    }
} else {
    // Missing API Key in JSON data
    echo json_encode(array("status" => "Failed", "message" => "API Key is missing."));
    exit();
}
?>
