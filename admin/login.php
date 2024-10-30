<?php
session_start();
include('./include/config.php');

$dbConn = new ConnectionDB();

$db = $dbConn->getConnection();


if(isset($_POST['submit']))
{
   
    $user_email = $_REQUEST['email'];
    $user_password = $_REQUEST['password'];


    
    $que = "SELECT * FROM admin_user WHERE admin_email = '$user_email' AND admin_password = '$user_password'  ";
    $res = $db->query($que);
   
  

    // print_r(mysqli_num_rows($res));

    if(mysqli_num_rows($res) > 0) 
    {
        
        
        $row = $res->fetch_assoc();
     
            $admin_name = $row['admin_name'];

             $_SESSION['u_name'] = $admin_name;

             header('location:dashboard.php');
 
         
       
    }
    else{

        $msg = 'Missmatch-Error';
       print_r("<script>
       window.location.href = 'index.php?ret_msg=".$msg."' ;
       </script>");


    }
}

?>