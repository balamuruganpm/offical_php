<?php

include('./include/config.php');
date_default_timezone_set('Asia/Calcutta');

$db = new ConnectionDB();
$dbconn = $db->getConnection();

$banner_id = $_POST['banner_id'];
$banner_name = $_POST['banner_name'];
$banner_img = $_FILES['banner_img'];

$banner_file_name = $_FILES['banner_img']['name'];
$ext = explode('.',$banner_file_name);
$ext1 = end($ext);

$banner_file_size = $_FILES['banner_img']['size'];

$created_dt = date("Y-m-d  H:i:s");

if($banner_file_size == 0)
{
    $update_que = "UPDATE slider SET slider_name = '$banner_name' ,slider_create_dt = '$created_dt'  WHERE slider_id = '$banner_id' ";
    $update_res = $dbconn->query($update_que);

    if($update_res)
    {
        echo 100;
    }
    else{
        echo 200;
    }
}
elseif($ext1=='jpg' || $ext1=='jpeg' || $ext1=='png')
{

    // print_r('xzkcbzhgc');
    $folder_img_path = 'assets/img/uploade';
    $folder_name_ext = $banner_name . '.' . $ext1;
    $folder_new_path = $folder_img_path . '/' . $folder_name_ext;

    $tmp_name = $_FILES['banner_img']['tmp_name'];

    move_uploaded_file($tmp_name,$folder_new_path);

    $ban_update_que = "UPDATE slider SET slider_name = '$banner_name' , slider_image = '$folder_new_path' ,slider_create_dt = '$created_dt'  WHERE slider_id = '$banner_id' ";
    $ban_update_res = $dbconn->query($ban_update_que);

    if($ban_update_res)
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