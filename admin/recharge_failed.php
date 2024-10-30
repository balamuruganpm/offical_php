<?php
include('./include/header.php');
include('./include/config.php');

$db = new ConnectionDB();
$conn = $db->getConnection();
$t_id = $_GET['id'];
// echo $t_id;

 $sql = "UPDATE `bz_recharge_history` SET `bz_status`='2' WHERE `bz_transection_id`=$t_id";
        if ($conn->query($sql) === TRUE) {
            echo "<script>alert('Recharge Approvel Rejected!');</script>";
            echo "<script>window.location.href ='./pendingRecharge.php';</script>";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }

?>