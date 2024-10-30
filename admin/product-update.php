<?php
include('./include/config.php');

$db = new ConnectionDB();
$dbconn = $db->getConnection();

date_default_timezone_set('Asia/Calcutta');




      $id = $_POST['pro_id'];     
      $name = $_POST['pro_name'];
      $img = $_FILES['pro_img'];
      $disc = $_POST['pro_disc'];
      $price = $_POST['pro_price'];
      $brand = $_POST['pro_brand'];
      $modalno = $_POST['pro_mod_no'];

      $file_size = $_FILES['pro_img']['size'];

      $file_name = $_FILES['pro_img']['name'];
      $ext = explode('.', $file_name);
      $ext1 = end($ext);

      $created_dt = date('Y-m-d  H:i:s' );

      if($file_size == 0)
      {
         $update_que = "UPDATE products SET pro_name='$name', pro_desc='$disc', pro_price='$price' , brand='$brand',modal_no='$modalno' ,created_dt='$created_dt' WHERE pro_id ='$id' " ;
         $update_res = $dbconn->query($update_que);

         if($update_que)
         {
            echo 100 ;
         }
         else
         {
            echo 200 ;
         }
      }
      elseif($ext1=='jpg' || $ext1=='png' || $ext1=='jpeg')
      {
         
       $files = 'assets/img/uploade';

        $newfile_ext = $name.'.'.$ext1;
      
        $file_upload = $files . '/' . $newfile_ext;

        $file_tempname = $_FILES['pro_img']['tmp_name'];


        move_uploaded_file($file_tempname,$file_upload);

        $que = "UPDATE products SET pro_name='$name', pro_image='$file_upload' ,pro_desc='$disc', pro_price='$price' , brand='$brand',modal_no='$modalno' ,created_dt='$created_dt' WHERE pro_id ='$id' " ;
        $res = $dbconn->query($que);
      

        if($res)
        {
            echo 100 ;
        }
        else{
            echo 200;
        }

      }
      else{
         // echo 200;
      }
    


?>