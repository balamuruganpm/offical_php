<?php
include('./include/header.php');
include('./include/config.php');

$db = new ConnectionDB();
$conn = $db->getConnection();
$t_id = $_GET['id'];

// Check if the recharge has already been approved
$status_query = "SELECT `bz_status` FROM `bz_recharge_history` WHERE `bz_transection_id`=$t_id";
$status_result = $conn->query($status_query);
$status_row = $status_result->fetch_assoc();
$recharge_status = $status_row['bz_status'];

// Proceed only if the recharge status is not already 'Approved'
if ($recharge_status != '1') {
    // Update the status of the recharge to 'Approved'
    $sql = "UPDATE `bz_recharge_history` SET `bz_status`='1' WHERE `bz_transection_id`=$t_id";
    if ($conn->query($sql) === TRUE) {
        // Fetch customer ID and recharge amount
        $cus_query = "SELECT `bz_cus_id`, `bz_amount` FROM `bz_recharge_history` WHERE `bz_transection_id`=$t_id";
        $cus_result = $conn->query($cus_query);
        $cus_row = $cus_result->fetch_assoc();
        $cus_id = $cus_row['bz_cus_id'];
        $recharge_amount = $cus_row['bz_amount'];

        // Fetch customer's current wallet amount
        $wallet_query = "SELECT `bz_cus_wallet` FROM `bz_customer` WHERE `bz_cus_id`=$cus_id";
        $wallet_result = $conn->query($wallet_query);
        $wallet_row = $wallet_result->fetch_assoc();
        $current_wallet_amount = $wallet_row['bz_cus_wallet'];

        // Calculate new wallet amount
        $new_wallet_amount = $current_wallet_amount + $recharge_amount;

        // Update customer's wallet amount in bz_customer table
        $update_wallet_sql = "UPDATE `bz_customer` SET `bz_cus_wallet`=$new_wallet_amount WHERE `bz_cus_id`=$cus_id";
        if ($conn->query($update_wallet_sql) === TRUE) {
            // Recharge approved successfully
            echo "<script>alert('Recharge Approved Success!');</script>";
            echo "<script>window.location.href ='./pendingRecharge.php';</script>";
        } else {
            echo "Error updating wallet amount: " . $conn->error;
        }
    } else {
        echo "Error updating recharge status: " . $conn->error;
    }
} else {
    echo "<script>alert('Recharge has already been approved!');</script>";
    echo "<script>window.location.href ='./pendingRecharge.php';</script>";
}
?>
