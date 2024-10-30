<?php
include('./include/config.php');

date_default_timezone_set('Asia/Calcutta');


$db = new ConnectionDB();
$dbconn =  $db->getConnection();

$id = $_POST['pro_id'] ;  
$name = $_POST['pro_name'];
$img = $_FILES['pro_img'];
$disc = $_POST['pro_disc'];
$price = $_POST['pro_price'];
$brand = $_POST['pro_brand'];
$modalno = $_POST['pro_mod_no'];

// print_r($img);


$file_name = $_FILES['pro_img']['name'];
$ext = explode('.',$file_name);
$ext1 = end($ext);

if($ext1=='jpg' || $ext1=='png' || $ext1=='jpeg')
{
    $folder_path = 'assets/img/uploade';
    $new_file_ext = $name . '.' . $ext1;
    $new_img_path = $folder_path . '/' . $new_file_ext;
    
    $file_tmp_name = $_FILES['pro_img']['tmp_name'];

    move_uploaded_file($file_tmp_name,$new_img_path);

    $created_date_time = date("Y-m-d  H:i:s");

    $insert_que = "INSERT INTO products ( pro_name, pro_image , pro_desc , pro_price , brand , modal_no , created_dt ) VALUES ( '$name' , '$new_img_path' , '$disc' ,'$price' , '$brand ' ,'$modalno' ,'$created_date_time' )  ";
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
    print_r("<script>
    alert('Image this formate only  png/jpg/jpeg ');
    window.location.href = 'product-management.php' ;
    </script>");
}

?>