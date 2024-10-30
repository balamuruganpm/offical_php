<?php

include ('./include/config.php');

date_default_timezone_set('Asia/Kolkata');

$db = new ConnectionDB();
$dbconn = $db->getConnection();

 $addform = $_POST['addFormData'];
//  print_r($addform);

 $name = $addform[0]['value'];
 $email = $addform[1]['value'];
 $mobileNumber = $addform[2]['value'];
 $password = $addform[3]['value'];

if( $name==="" || $email==="" || $mobileNumber==="" || $password==="")
{
    echo 100;
    
}
else{

    $user_time = date('H:i:s');
    $user_date = date('Y-m-d');
    $que = "INSERT INTO bz_customer ( bz_cus_name , bz_cus_email , bz_cus_phone , bz_cus_password , bz_cus_date , bz_cus_time ) Value ( '$name' , '$email' , '$mobileNumber' , '$password' ,'$user_time','$user_date' ) ";
    $res = $dbconn->query($que);

    if($res)
    {
        echo 200;
    }
    else{
        echo 500;
    }
}

?>