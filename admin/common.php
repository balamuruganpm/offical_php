<?php
include('./include/config.php');

$db = new ConnectionDB();
$dbconn = $db->getConnection();

$action = $_POST['action'];



if($action == 'delete_user')
{
    $userId = $_POST['user_id'];

    $del_que = " DELETE FROM bz_customer WHERE bz_cus_id = '$userId' ";
    $del_res = $dbconn->query($del_que);


if($del_res)
{
    echo 100;
}
else
{
    echo 200;
}
}

if($action == 'inActive'){

    // $inActive_status = $_POST['status_inactive'];
    $inActive_userId = $_POST['user_id'];

    $inactive = 0 ;
    $update_inactive_que = "UPDATE bz_customer SET bz_cus_status = '$inactive' WHERE bz_cus_id = '$inActive_userId'  ";
    $update_inactive_res = $dbconn->query($update_inactive_que);

    if($update_inactive_res)
    {
        echo 120;
    }
    else{
        echo 200;
    }


}

if($action == 'active')
{
    $active_userid = $_POST['active_user_id'];
    
    $active_status = 1;
    $update_active_que = "UPDATE bz_customer SET bz_cus_status = '$active_status' WHERE bz_cus_id = '$active_userid'  ";
    $update_active_res = $dbconn->query($update_active_que);
    if($update_active_res)
    {
        echo 150;
    }
    else{
        echo 200;
    }

}
if($action == 'product_delete')
{
     $productId = $_POST['productid'];
    //  print_r($productId);

     $pro_sel = "SELECT pro_image FROM products WHERE pro_id = '$productId' ";
     $pro_result = $dbconn->query($pro_sel);

     $row = mysqli_fetch_assoc($pro_result);
     $pro_image = $row['pro_image'];

     if(file_exists($pro_image))
     {
        unlink($pro_image); 
     }
     
     $pro_del = "DELETE FROM products WHERE pro_id = '$productId' ";
     $pro_res = $dbconn->query($pro_del);

     if($pro_res)
     {
            echo 100;
     }
     else{
        echo 200;
     }
}
if($action == 'delete_banner')
{
    $bannerid = $_POST['banner_id'];

    $sel_que = "SELECT slider_image FROM slider WHERE slider_id = '$bannerid' ";
    $sel_res = $dbconn->query($sel_que);

    $ban_row = mysqli_fetch_assoc($sel_res);
    $ban_img = $ban_row['slider_image'];

    if(file_exists($ban_img))
    {
        unlink($ban_img);
    }

    $del_que = "DELETE FROM slider WHERE slider_id = '$bannerid' ";
    $del_res = $dbconn->query($del_que);

    if($del_res)
    {
        echo 100;
    }
    else{
        echo 200;
    }

}



?>