<?php
include('./include/header.php');
include('./include/config.php');


$db = new ConnectionDB();
$conn = $db->getConnection();

?>

<div class="row">
    <div class="col-lg-12">
        <div class="page-title">
            <h1>Dashboard
                <small>Content Overview</small>
            </h1>
            <ol class="breadcrumb">
                <li class="active"><i class="fa fa-dashboard"></i> Dashboard</li>
                <li class="pull-right">
                    <!-- <div id="reportrange" class="btn btn-green btn-square date-picker">
                        <i class="fa fa-calendar"></i>
                        <span class="date-range"></span> <i class="fa fa-caret-down"></i>
                    </div> -->
                </li>
            </ol>
        </div>
    </div>
</div>


<?php 

$TotalUser = "SELECT * FROM `bz_customer` ";
$TotalUsers_result = mysqli_query($conn, $TotalUser);
$TotalUsers = mysqli_num_rows($TotalUsers_result);

$TotalBetting = "SELECT * FROM `bz_participent`";
$TotalBetting_result = mysqli_query($conn, $TotalBetting);
$TotalBetting = mysqli_num_rows($TotalBetting_result);


$TotalWithdrawal = "SELECT * FROM `bz_withdrwal` WHERE `bz_status`=1";
$TotalWithdrawal_result = mysqli_query($conn, $TotalWithdrawal);
$TotalWithdrawal = mysqli_num_rows($TotalWithdrawal_result);

$TotalWithdrawal_pending = "SELECT * FROM `bz_withdrwal` WHERE `bz_status`=0";
$TotalWithdrawal_result_pending = mysqli_query($conn, $TotalWithdrawal_pending);
$TotalWithdrawal_pendings = mysqli_num_rows($TotalWithdrawal_result_pending);

$TotalWithdrawal_reject = "SELECT * FROM `bz_withdrwal` WHERE `bz_status`=2";
$TotalWithdrawal_result_reject = mysqli_query($conn, $TotalWithdrawal_reject);
$TotalWithdrawal_rejects = mysqli_num_rows($TotalWithdrawal_result_reject);

$Totalrecharge = "SELECT * FROM `bz_recharge_history` WHERE `bz_status`=1";
$Totalrecharge_result = mysqli_query($conn, $Totalrecharge);
$Totalrecharge = mysqli_num_rows($Totalrecharge_result);

$Totalrecharge_pending = "SELECT * FROM `bz_recharge_history` WHERE `bz_status`=0";
$Totalrecharge_result_pending = mysqli_query($conn, $Totalrecharge_pending);
$Totalrecharge_pendings = mysqli_num_rows($Totalrecharge_result_pending);

$Totalrecharge_reject = "SELECT * FROM `bz_recharge_history` WHERE `bz_status`=2";
$Totalrecharge_result_reject = mysqli_query($conn, $Totalrecharge_reject);
$Totalrecharge_rejects = mysqli_num_rows($Totalrecharge_result_reject);

$TotalGameList = "SELECT * FROM `bz_color_prediction`";
$TotalGameList_result = mysqli_query($conn, $TotalGameList);
$TotalGameList = mysqli_num_rows($TotalGameList_result);


$TotalSlider = "SELECT * FROM `slider`";
$TotalSlider_result = mysqli_query($conn, $TotalSlider);
$TotalSlider = mysqli_num_rows($TotalSlider_result);


$TotalProduct = "SELECT * FROM `products`";
$TotalProduct_result = mysqli_query($conn, $TotalProduct);
$TotalProduct = mysqli_num_rows($TotalProduct_result);

?>

<div class="row">
        <div class="col-lg-3 col-sm-6" >
            <div class="circle-tile" >
                <a href="user.php">
                <!-- background-color:rgb(24,131,175); -->
                    <div class="circle-tile-heading " style="background-color:rgb(24,131,175);" >  
                        <i class="fa fa-users fa-fw fa-3x"></i>
                    </div>
                </a>
                <div class="circle-tile-content " style="background-image: linear-gradient(to right,rgb(24,131,175),rgb(138,166,169),rgb(24,131,175)); border-top-left-radius: 50px; border-bottom-right-radius: 50px;">
                    <div class="circle-tile-description text-faded">
                    <b>User Management</b>
                    </div>
                    <div class="circle-tile-number text-faded">
                        <?=$TotalUsers?>
                        <span id="sparklineA"></span>
                    </div>
                    <a href="user.php" class="circle-tile-footer" style=" border-bottom-right-radius: 160px; width: 270px; border: none;">More Info <i class="fa fa-chevron-circle-right"></i></a>
                </div>
            </div>
        </div> 
        <div class="col-lg-3 col-sm-6" >
            <div class="circle-tile" >
                <a href="betting.php">
                    <div class="circle-tile-heading " style="background-color:rgb(118,88,140);" >
                        <i class="fa fa-users fa-fw fa-3x"></i>
                    </div>
                </a>
                <div class="circle-tile-content " style="background-image: linear-gradient(to right,rgb(118,88,140),rgb(138,166,169),rgb(118,88,140));border-top-left-radius: 50px; border-bottom-right-radius: 50px;">
                    <div class="circle-tile-description text-faded">
                   <b> Betting Records</b>
                    </div>
                    <div class="circle-tile-number text-faded">
                        <?=$TotalBetting?>
                        <span id="sparklineA"></span>
                    </div>
                    <a href="betting.php" class="circle-tile-footer" style=" border-bottom-right-radius: 160px; width: 270px; border: none;">More Info <i class="fa fa-chevron-circle-right"></i></a>
                </div>
            </div>
        </div> 
        <!--<div class="col-lg-3 col-sm-6" >-->
        <!--    <div class="circle-tile" >-->
        <!--        <a href="#">-->
        <!--            <div class="circle-tile-heading " style="background-color:rgb(80,109,79);" >-->
        <!--                <i class="fa fa-users fa-fw fa-3x"></i>-->
        <!--            </div>-->
        <!--        </a>-->
        <!--        <div class="circle-tile-content " style="background-image: linear-gradient(to right,rgb(80,109,79),rgb(138,166,169),rgb(80,109,79));border-top-left-radius: 50px; border-bottom-right-radius: 50px;">-->
        <!--            <div class="circle-tile-description text-faded">-->
        <!--            <b>Revenue Management</b>-->
        <!--            </div>-->
        <!--            <div class="circle-tile-number text-faded">-->
        <!--                0-->
        <!--                <span id="sparklineA"></span>-->
        <!--            </div>-->
        <!--            <a href="#" class="circle-tile-footer" style=" border-bottom-right-radius: 160px; width: 270px; border: none;">More Info <i class="fa fa-chevron-circle-right"></i></a>-->
        <!--        </div>-->
        <!--    </div>-->
        <!--</div> -->
        <div class="col-lg-3 col-sm-6" >
            <div class="circle-tile" >
                <a href="withdrawal.php">
                    <div class="circle-tile-heading " style="background-color:rgb(189,57,86);" >
                        <i class="fa fa-users fa-fw fa-3x"></i>
                    </div>
                </a>
                <div class="circle-tile-content " style="background-image: linear-gradient(to right,rgb(189,57,86),rgb(138,166,169),rgb(189,57,86));border-top-left-radius: 50px; border-bottom-right-radius: 50px;">
                    <div class="circle-tile-description text-faded">
                    <b>Withdrawal Management</b>
                    </div>
                    <div class="circle-tile-number text-faded">
                        <?=$TotalWithdrawal?>
                        <span id="sparklineA"></span>
                    </div>
                    <a href="withdrawal.php" class="circle-tile-footer" style=" border-bottom-right-radius: 160px; width: 270px; border: none;">More Info <i class="fa fa-chevron-circle-right"></i></a>
                </div>
            </div>
        </div> 
        <!--<div class="col-lg-3 col-sm-6" >-->
        <!--    <div class="circle-tile" >-->
        <!--        <a href="#">-->
        <!--            <div class="circle-tile-heading " style="background-color:rgb(153,222,53);" >-->
        <!--                <i class="fa fa-users fa-fw fa-3x"></i>-->
        <!--            </div>-->
        <!--        </a>-->
        <!--        <div class="circle-tile-content " style="background-image: linear-gradient(to right,rgb(153,222,53),rgb(138,166,169),rgb(153,222,53));border-top-left-radius: 50px; border-bottom-right-radius: 50px;">-->
        <!--            <div class="circle-tile-description text-faded">-->
        <!--           <b> Bonus Management</b>-->
        <!--            </div>-->
        <!--            <div class="circle-tile-number text-faded">-->
        <!--                0-->
        <!--                <span id="sparklineA"></span>-->
        <!--            </div>-->
        <!--            <a href="#" class="circle-tile-footer" style=" border-bottom-right-radius: 160px; width: 270px; border: none;">More Info <i class="fa fa-chevron-circle-right"></i></a>-->
        <!--        </div>-->
        <!--    </div>-->
        <!--</div> -->
        <div class="col-lg-3 col-sm-6" >
            <div class="circle-tile" >
                <a href="#">
                    <div class="circle-tile-heading " style="background-color:rgb(182,133,38);" >
                        <i class="fa fa-users fa-fw fa-3x"></i>
                    </div>
                </a>
                <div class="circle-tile-content " style="background-image: linear-gradient(to right,rgb(182,133,38),rgb(138,166,169),rgb(182,133,38));border-top-left-radius: 50px; border-bottom-right-radius: 50px;">
                    <div class="circle-tile-description text-faded">
                    <b>Game Management</b>
                    </div>
                    <div class="circle-tile-number text-faded">
                        <?=$TotalGameList?>
                        <span id="sparklineA"></span>
                    </div>
                    <a href="#" class="circle-tile-footer" style=" border-bottom-right-radius: 160px; width: 270px; border: none;">More Info <i class="fa fa-chevron-circle-right"></i></a>
                </div>
            </div>
        </div> 
        <div class="col-lg-3 col-sm-6" >
            <div class="circle-tile" >
                <a href="banner.php">
                    <div class="circle-tile-heading " style="background-color:rgb(78,73,54);" >
                        <i class="fa fa-users fa-fw fa-3x"></i>
                    </div>
                </a>
                <div class="circle-tile-content " style="background-image: linear-gradient(to right,rgb(78,73,54),rgb(138,166,169),rgb(78,73,54));border-top-left-radius: 50px; border-bottom-right-radius: 50px;">
                    <div class="circle-tile-description text-faded">
                    <b>Banner Management</b>
                    </div>
                    <div class="circle-tile-number text-faded">
                       <?=$TotalSlider?>
                        <span id="sparklineA"></span>
                    </div>
                    <a href="banner.php" class="circle-tile-footer" style=" border-bottom-right-radius: 160px; width: 270px; border: none;">More Info <i class="fa fa-chevron-circle-right"></i></a>
                </div>
            </div>
        </div> 
        <div class="col-lg-3 col-sm-6" >
            <div class="circle-tile" >
                <a href="product-management.php">
                
                    <div class="circle-tile-heading " style="background-color:rgb(0,50,99);" >  
                        <i class="fa fa-users fa-fw fa-3x"></i>
                    </div>
                </a>
                <div class="circle-tile-content " style="background-image: linear-gradient(to right,rgb(0,50,99),rgb(138,166,169),rgb(0,50,99)); border-top-left-radius: 50px; border-bottom-right-radius: 50px;">
                    <div class="circle-tile-description text-faded">
                    <b>Product Management</b>
                    </div>
                    <div class="circle-tile-number text-faded">
                        <?=$TotalProduct?>
                        <span id="sparklineA"></span>
                    </div>
                    <a href="product-management.php" class="circle-tile-footer" style=" border-bottom-right-radius: 160px; width: 270px; border: none;">More Info <i class="fa fa-chevron-circle-right"></i></a>
                </div>
            </div>
        </div> 
        <div class="col-lg-3 col-sm-6" >
            <div class="circle-tile" >
                <a href="withdrawal.php">
                    <div class="circle-tile-heading " style="background-color:rgb(189,57,86);" >
                        <i class="fa fa-users fa-fw fa-3x"></i>
                    </div>
                </a>
                <div class="circle-tile-content " style="background-image: linear-gradient(to right,rgb(189,57,86),rgb(138,166,169),rgb(189,57,86));border-top-left-radius: 50px; border-bottom-right-radius: 50px;">
                    <div class="circle-tile-description text-faded">
                    <b>Withdrawal Pendings</b>
                    </div>
                    <div class="circle-tile-number text-faded">
                        <?=$TotalWithdrawal_pendings?>
                        <span id="sparklineA"></span>
                    </div>
                    <a href="withdrwal_pending.php" class="circle-tile-footer" style=" border-bottom-right-radius: 160px; width: 270px; border: none;">More Info <i class="fa fa-chevron-circle-right"></i></a>
                </div>
            </div>
        </div> 
        <div class="col-lg-3 col-sm-6" >
            <div class="circle-tile" >
                <a href="withdrawal.php">
                    <div class="circle-tile-heading " style="background-color:rgb(189,57,86);" >
                        <i class="fa fa-users fa-fw fa-3x"></i>
                    </div>
                </a>
                <div class="circle-tile-content " style="background-image: linear-gradient(to right,rgb(189,57,86),rgb(138,166,169),rgb(189,57,86));border-top-left-radius: 50px; border-bottom-right-radius: 50px;">
                    <div class="circle-tile-description text-faded">
                    <b>Withdrawal Rejected</b>
                    </div>
                    <div class="circle-tile-number text-faded">
                        <?=$TotalWithdrawal_rejects?>
                        <span id="sparklineA"></span>
                    </div>
                    <a href="withdraw_reject.php" class="circle-tile-footer" style=" border-bottom-right-radius: 160px; width: 270px; border: none;">More Info <i class="fa fa-chevron-circle-right"></i></a>
                </div>
            </div>
        </div> 
        <div class="col-lg-3 col-sm-6" >
            <div class="circle-tile" >
                <a href="withdrawal.php">
                    <div class="circle-tile-heading " style="background-color:rgb(189,57,86);" >
                        <i class="fa fa-users fa-fw fa-3x"></i>
                    </div>
                </a>
                <div class="circle-tile-content " style="background-image: linear-gradient(to right,rgb(189,57,86),rgb(138,166,169),rgb(189,57,86));border-top-left-radius: 50px; border-bottom-right-radius: 50px;">
                    <div class="circle-tile-description text-faded">
                    <b>Recharge Rejected</b>
                    </div>
                    <div class="circle-tile-number text-faded">
                        <?=$Totalrecharge_rejects?>
                        <span id="sparklineA"></span>
                    </div>
                    <a href="rejectRecharge.php" class="circle-tile-footer" style=" border-bottom-right-radius: 160px; width: 270px; border: none;">More Info <i class="fa fa-chevron-circle-right"></i></a>
                </div>
            </div>
        </div> 
        <div class="col-lg-3 col-sm-6" >
            <div class="circle-tile" >
                <a href="withdrawal.php">
                    <div class="circle-tile-heading " style="background-color:rgb(189,57,86);" >
                        <i class="fa fa-users fa-fw fa-3x"></i>
                    </div>
                </a>
                <div class="circle-tile-content " style="background-image: linear-gradient(to right,rgb(189,57,86),rgb(138,166,169),rgb(189,57,86));border-top-left-radius: 50px; border-bottom-right-radius: 50px;">
                    <div class="circle-tile-description text-faded">
                    <b>Recharge Pending</b>
                    </div>
                    <div class="circle-tile-number text-faded">
                        <?=$Totalrecharge_pendings?>
                        <span id="sparklineA"></span>
                    </div>
                    <a href="pendingRecharge.php" class="circle-tile-footer" style=" border-bottom-right-radius: 160px; width: 270px; border: none;">More Info <i class="fa fa-chevron-circle-right"></i></a>
                </div>
            </div>
        </div> 
        <div class="col-lg-3 col-sm-6" >
            <div class="circle-tile" >
                <a href="withdrawal.php">
                    <div class="circle-tile-heading " style="background-color:rgb(189,57,86);" >
                        <i class="fa fa-users fa-fw fa-3x"></i>
                    </div>
                </a>
                <div class="circle-tile-content " style="background-image: linear-gradient(to right,rgb(189,57,86),rgb(138,166,169),rgb(189,57,86));border-top-left-radius: 50px; border-bottom-right-radius: 50px;">
                    <div class="circle-tile-description text-faded">
                    <b>Recharge Complete</b>
                    </div>
                    <div class="circle-tile-number text-faded">
                        <?=$Totalrecharge?>
                        <span id="sparklineA"></span>
                    </div>
                    <a href="rechargeComplete.php" class="circle-tile-footer" style=" border-bottom-right-radius: 160px; width: 270px; border: none;">More Info <i class="fa fa-chevron-circle-right"></i></a>
                </div>
            </div>
        </div> 
       
        
        
        
             
         
</div>

<?php
include('./include/footer.php');
?>

