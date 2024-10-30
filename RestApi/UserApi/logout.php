<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");


session_start();


// if (isset($_SESSION['customer_id'])) {

    $_SESSION = array();


    session_destroy();

 
    echo json_encode(array("status" => true, "message" => "Logout Successfully."));
// } else {

//     echo json_encode(array("status" => false, "message" => "User not Login."));
// }
?>
