<?php
include('./include/config.php');

$db = new ConnectionDB();
$conn = $db->getConnection();

if(isset($_POST['save_terms'])){

    $term_description = $_POST['term_description'];

$cat_upt= "UPDATE `info` SET `terms_cons`='$term_description' ";

 $cat_upt_qry=mysqli_query($conn,$cat_upt);
 if($cat_upt_qry==true){
    header('location:terms_cons.php');
 }else{
    echo"not success ";
 }
}
if(isset($_POST['policy_submit'])){

    $privacydescription = $_POST['privacy'];

$cat_upt= "UPDATE `info` SET `privacy_policy`='$privacydescription' ";

// print_r($cat_upt);exit;
 $cat_upt_qry=mysqli_query($conn,$cat_upt);
 if($cat_upt_qry==true){
    header('location:privacy_policy.php');
 }else{
    echo"not success ";
 }
}
if(isset($_POST['about_submit'])){

    $aboutdescription = $_POST['about'];

$cat_upt= "UPDATE `info` SET `about_us`='$aboutdescription' ";

// print_r($cat_upt);exit;
 $cat_upt_qry=mysqli_query($conn,$cat_upt);
 if($cat_upt_qry==true){
    header('location:about_us.php');
 }else{
    echo"not success ";
 }
}

if(isset($_POST['agreement_submit'])){

    $agreementdescription = $_POST['agreement'];

$cat_upt= "UPDATE `info` SET `agreement_risk`='$agreementdescription' ";

// print_r($cat_upt);exit;
 $cat_upt_qry=mysqli_query($conn,$cat_upt);
 if($cat_upt_qry==true){
    header('location:agreement.php');
 }else{
    echo"not success ";
 }
}


?>
