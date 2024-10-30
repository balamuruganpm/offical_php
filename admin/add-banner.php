<?php
include('./include/config.php');

date_default_timezone_set('Asia/Calcutta');

$db = new ConnectionDB();
$dbconn = $db->getConnection();


$name = $_POST['banner_name'];
$img = $_FILES['banner_img'];

$file_name = $_FILES['banner_img']['name'];
$ext = explode('.',$file_name);
$ext1 = end($ext);

if($ext1=='jpg' || $ext1=='png' || $ext1=='jpeg')
{
    $file_path_folder = 'assets/img/uploade';
    $file_name_ext = $name . '.' . $ext1;
    $file_new_path = $file_path_folder . '/' . $file_name_ext;

    $tmp_name = $_FILES['banner_img']['tmp_name'];

    move_uploaded_file($tmp_name,$file_new_path);

    $created_dt = date("Y-m-d  H:i:s");

    $insert_que = "INSERT INTO slider ( slider_name , slider_image , slider_create_dt ) VALUES ( '$name' , '$file_new_path' , '$created_dt' )";
    $insert_res = $dbconn->query($insert_que);

    if($insert_res)
    {
        echo 100;
    }
    else{
        echo 200;
    }
}
else{
    echo 300;
}


?>