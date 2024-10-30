<?php

// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");


use PHPMailer\PHPMailer\PHPMailer;

require_once 'phpmailer/Exception.php';
require_once 'phpmailer/PHPMailer.php';
require_once 'phpmailer/SMTP.php';

$mail = new PHPMailer(true);

// files needed to connect to database
include_once 'config/database.php';
include_once 'objects/login.php';
include_once 'objects/validate.php';


// get database connection
$database = new Database();
$db = $database->getConnection();

// instantiate user object
$user = new User($db);
$validate = new Validate($db);

$data = json_decode(file_get_contents("php://input"));

// set product property values
$validate->api_key = $data->api_key;
$user->phone = $data->phone;
$email = $data->email;
$user->email = $data->email;
//validate api key
 $stmt = $validate->getValidate();
    $itemCount = $stmt->rowCount();

    if($itemCount > 0){
        
    } else{
        echo json_encode(array("Status" => "Failed", "message" => "Api Key Not Match"));
        exit();
    }

    $otp = rand('1000', '9999');
    
    $stmt = $user->EmailExists();
    $itemCount = $stmt->rowCount();
    if($itemCount == 0){ 
         
	$mail->SMTPDebug=0;

	try{
		$mail->isSMTP();
		$mail->Host = 'smtp.gmail.com';
		$mail->SMTPAuth = "true";
		$mail->Username = 'careers.reconnects@gmail.com';
		$mail->Password = 'kpitzwdhinbxduye';
		$mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
		$mail->Port = '587';

		$mail->setFrom('careers.reconnects@gmail.com');
		$mail->addAddress($email);

		$mail->isHTML(true);
		$mail->Subject = 'Veroification Otp From - BlazeBet';
		$mail->Body = "Your One Time Password (OTP) is $otp please dont share with anyone.";

		$mail->send();
		$alert = '<div class="alert-success">
					<span>Message Sent! Thank you contacting us.</span>
					</div>';
	}catch(Exception $e){
		$alert = '<div class="alert-error">
					<span>'.$e ->getMessage().'</span>
					</div>';
	}
  
   echo json_encode(array("status"=>true, "msg"=>"Otp Generated Successfully!", "phone"=>$user->phone, "otp"=>$otp));
    } else{
       echo json_encode(array("status"=>false, "msg"=>"Email Id Already Exist!"));
    
    }
        
?>




