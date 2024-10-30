<?php

if (isset($_POST['refresh'])) {

    header('location:userReport.php');
}



if (isset($_POST['refresh_payment'])) {

    header('location:paymentsReport-user.php');
}

if (isset($_POST['refresh_withdra'])) {

    header('location:withdrawalReport.php');
}
if (isset($_POST['refresh_bonus'])) {

    header('location:bonus.php');
}

?>
