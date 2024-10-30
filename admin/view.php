<?php
include './include/header.php';
include './include/config.php';

$db = new ConnectionDB();
$dbconn = $db->getConnection();

$view_user_id = $_GET['view_user_id'];
$view_user_name = $_GET['view_user_name'];

?>

<style>
    .btn {
        height: 38px;
        width: 140px;
        border-radius: 5px;
        border: 1px solid black;
    }

    table,
    th,
    td {
        text-align: center;
        border: 1px solid white;
        border-collapse: collapse;
        height: 50px;
        width: 1000px;
    }

    th {
        background-color: rgb(179, 190, 208);
        color: rgb(80, 80, 72);
        font-weight: bold;
    }
    #betting_btn{
       background-image: linear-gradient(to top,rgb(169,69,71),rgb(199,182,138));
       color: white;
       border: none;
    }
    #wallet_btn{
        background-image: linear-gradient(to top,rgb(114,66,82),rgb(215,188,167));
       color: white;
       border: none;
    }
    #deposite_btn{
        background-image: linear-gradient(to top,rgb(78,71,102),rgb(199,182,138));
       color: white;
       border: none;
    }
    #profit_btn{
        background-image: linear-gradient(to top,rgb(1,64,45),rgb(199,182,138));
       color: white;
       border: none;
    }
    .btn:hover{
        background-image: linear-gradient(to right,rgb(71,72,128),rgb(181,145,83),rgb(110,59,98));
        color: white;
         border: none;
    }

</style>
<br><br>
<div style="display: flex; gap: 15px;">
    <span><button id="wallet_btn" class="btn" onclick="wallet()">Wallet balance</button></span>
    <span><button id="betting_btn" class="btn" onclick="betting()" >Betting records</button></span>
    <span><button id="deposite_btn" class="btn" onclick="deposite()" >Deposit records</button></span>
    <span><button id="profit_btn" class="btn" onclick="profit()" >Profit records</button></span>
</div><br>


<!-- wallet start  -->
<div id="walletdiv">
    <div class="row">
        <div class="col-lg-12">
            <div class="page-title">
                <ol class="breadcrumb">
                    <li><i class="fa fa-dashboard"></i> <a href="#"> Wallet balance</a>
                    </li>
                    <!-- <li class="active">Machineries/Accessories</li> -->
                </ol>
            </div>
        </div>
        <!-- /.col-lg-12 -->
    </div>

    <div style="display: flex; justify-content:center;">
        <table>
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Wallet Amount</th>
                    <th>Date</th>
                    <th>Time</th>

                </tr>
            </thead>
            <tbody>
                <?php
                $wallet_que = "SELECT * FROM bz_customer WHERE bz_cus_id = '$view_user_id' ";
                $wallet_res = $dbconn->query($wallet_que);

                if ($wallet_res) {
                    if ($wallet_row = mysqli_fetch_assoc($wallet_res)) {
                        // $cus_name = $wallet_row['bz_cus_name'];
                        // $_SESSION['userName'] = $cus_name;
                        // printf($_SESSION['userName']);

                ?>
                        <tr>
                            <td><?= $wallet_row['bz_cus_name'] ?></td>
                            <td><?= $wallet_row['bz_cus_wallet'] ?></td>
                            <td><?= $wallet_row['bz_cus_time'] ?></td>
                            <td><?= $wallet_row['bz_cus_date'] ?></td>
                        </tr>
                <?php

                    }
                }
                ?>
            </tbody>
        </table>
    </div>
</div>
<!-- wallet end -->


<!-- Betting record start -->
<div id="bettingdiv" style="display: none;">
    <div class="row">
        <div class="col-lg-12">
            <div class="page-title">
                <ol class="breadcrumb">
                    <li><i class="fa fa-dashboard"></i><span> <?= $view_user_name ?></span> <a href="#"> Betting records</a>
                    </li>
                    <!-- <li class="active">Machineries/Accessories</li> -->
                </ol>

            </div>
        </div>
        <!-- /.col-lg-12 -->
    </div>

    <div style="display: flex; justify-content:center;">
        <table>
            <thead>
                <tr>

                    <th>Transection ID</th>
                    <th>Deposit Amount</th>
                    <th>Date</th>
                    <th>Time</th>
                </tr>
            </thead>
            <tbody>

                <?php
                $bet_qu = "SELECT COUNT(*) OVER () AS total_betting,
                SUM(bz_spend_amount) OVER () AS spend_amount,
                SUM(bz_win_amount) OVER () AS win_amount
            FROM 
                `bz_participent`
            WHERE 
                `bz_cus_id` = '$view_user_id'";

                $bet_res = $dbconn->query($bet_qu);

                if ($bet_res) {
                    if ($bet_row = mysqli_fetch_assoc($bet_res)) {

                ?>
                        <tr>
                            <td><?= $bet_row['total_betting'] ?></td>
                            <td><?= $bet_row['spend_amount'] ?></td>
                            <td><?= $bet_row['win_amount'] ?></td>
                       
                        </tr>
                <?php

                    }
                }
                ?>

                <!-- <tr>
                    <td><b>-</b></td>
                    <td><b>-</b></td>
                    <td><b>-</b></td>
                    <td><b>-</b></td>
                </tr> -->

            </tbody>
        </table>
        </table>
    </div>
</div>
<!-- Betting record end -->

<!-- Deposit records start  -->
<div id="depositediv" style="display: none;">
    <div class="row">
        <div class="col-lg-12">
            <div class="page-title">
                <ol class="breadcrumb">
                    <li><i class="fa fa-dashboard"></i><span> <?= $view_user_name ?></span> <a href="#"> Deposit records</a>
                    </li>
                    <!-- <li class="active">Machineries/Accessories</li> -->
                </ol>

            </div>
        </div>
        <!-- /.col-lg-12 -->
    </div>

    <div style="display: flex; justify-content:center;">
        <table>
            <thead>
                <tr>

                    <th>Transection ID</th>
                    <th>Deposit Amount</th>
                    <th>Date</th>
                    <th>Time</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $deposit_que = "SELECT * FROM bz_recharge_history WHERE bz_cus_id = '$view_user_id' ";
                $deposit_res = $dbconn->query($deposit_que);
                // print_r($deposit_res);

                if ($deposit_res) {

                    while ($deposit_row = mysqli_fetch_assoc($deposit_res)) {
                ?>
                        <tr>
                            <td><?= $deposit_row['bz_transection_id'] ?></td>
                            <td><?= $deposit_row['bz_amount'] ?></td>
                            <td><?= $deposit_row['bz_date'] ?></td>
                            <td><?= $deposit_row['bz_time'] ?></td>
                        </tr>
                    <?php

                    }
                    ?>
                    <tr>
                        <td><b>-</b></td>
                        <td><b>-</b></td>
                        <td><b>-</b></td>
                        <td><b>-</b></td>
                    </tr>

                <?php

                }


                ?>
            </tbody>
        </table>
    </div>
</div>
<!-- Deposit records end -->

<!-- Profit record start -->
<div id="profitdiv" style="display: none;">
    <div class="row">
        <div class="col-lg-12">
            <div class="page-title">
                <ol class="breadcrumb">
                    <li><i class="fa fa-dashboard"></i><span> <?= $view_user_name ?></span> <a href="#"> Profit records</a>
                    </li>
                    <!-- <li class="active">Machineries/Accessories</li> -->
                </ol>

            </div>
        </div>
        <!-- /.col-lg-12 -->
    </div>

    <div style="display: flex; justify-content:center;">
        <table>
            <thead>
                <tr>

                    <th>Transection ID</th>
                    <th>Deposit Amount</th>
                    <th>Date</th>
                    <th>Time</th>
                </tr>
            </thead>
            <tbody>


                <tr>
                    <td><b>-</b></td>
                    <td><b>-</b></td>
                    <td><b>-</b></td>
                    <td><b>-</b></td>
                </tr>

            </tbody>
        </table>
    </div>
</div>
<!-- profit record end -->


<?php
include './include/footer.php';
?>

<script>
    function wallet() {
        var walletid = document.getElementById('walletdiv');
       if(walletid.style.display == 'none')
       {
         walletid.style.display = 'block'
       }
       else{
        walletid.style.display = 'none'
       }  
    }
    function betting() {
        var bettingdiv = document.getElementById('bettingdiv');
       if(bettingdiv.style.display == 'block')
       {
        bettingdiv.style.display = 'none'
       }
       else{
        bettingdiv.style.display = 'block'
       }  
    }
    function deposite() {
        var depositediv = document.getElementById('depositediv');
       if(depositediv.style.display == 'block')
       {
        depositediv.style.display = 'none'
       }
       else{
        depositediv.style.display = 'block'
       }  
    }
    function profit() {
        var walletid = document.getElementById('profitdiv');
       if(profitdiv.style.display == 'block')
       {
        profitdiv.style.display = 'none'
       }
       else{
        profitdiv.style.display = 'block'
       }  
    }

</script>