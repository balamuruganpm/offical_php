<?php
include('./include/header.php');
include('./include/config.php');

$db = new ConnectionDB();
$conn = $db->getConnection();

$dateFilter = " 1 ";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $mindate = $_POST['min'];
    $maxdate = $_POST['max'];

    if ($mindate && $maxdate) {
        $minDate = date('Y-m-d', strtotime($mindate));
        $maxDate = date('Y-m-d', strtotime($maxdate . '+1 day'));
        $dateFilter .= "AND bz_payment_date BETWEEN '$minDate' AND '$maxDate' ";
    }
}
?>

<style>
    #subbtn {
        border: none;
        background-color: rgb(157, 118, 145);
    }

    #subbtn:hover {
        background-color: none;
    }

    #refreshbtn {
        border: none;
        background-color: rgb(43, 113, 114);
    }
</style>

<div class="row">
    <div class="col-lg-12">
        <div class="page-title">
            <a href="dashboard.php">
                <h1>Dashboard
                    <small>Content Overview</small>
                </h1>
            </a>

        </div>
    </div>
</div>

<!--  -->
<div class="row">
    <div class="col-lg-12">
        <div class="page-title">
            <ol class="breadcrumb">
                <li><i class="fa fa-dashboard"></i> <a href="index">Complains & Suggestions</a>
                </li>
                <!-- <li class="active">Machineries/Accessories</li> -->
            </ol>
        </div>
    </div>
    <!-- /.col-lg-12 -->
</div>
<!--  -->

<!-- filter date start -->
<div class="filter">
    <table border="0" cellspacing="5" cellpadding="5">
        <tbody>
            <tr>
                <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                    <td style="font-size:18px;font-weight:16px;font-weight: bold;font-family: serif;">Minimum date: </td><br>
                    <td><input class="form-control" type="date" id="min" name="min"></td>
                    <td style="font-size:18px; font-weight:16px;font-weight: bold;font-family: serif;">Maximum date: </td><br>
                    <td><input class="form-control" type="date" id="max" name="max"></td>
                    <td>
                        &nbsp;
                        <button class="btn btn-success" type="submit" id="subbtn">Submit</button>
                    </td>
                </form>
                <form action="refresh.php" method="post">
                    <td>
                        &nbsp;
                        <a href="complaints.php" class="btn btn-info"><i class="fa fa-refresh"></i></a>
                        <!-- <button class="btn btn-info" name="refresh_payment" id="refreshbtn"><i class="fa fa-refresh"></i></button> -->
                    </td>
                </form>
            </tr>
        </tbody>
    </table>
</div>
<br>

<!-- filter date end -->
<br><br>
<div class="row" id="machineries_list">
    <div class="col-lg-12">

        <!-- <div class="portlet portlet-default">
            <div class="portlet-heading">
                <div class="portlet-title" style="width: 100%; height: 40px;">
                    <h4><a id="add_new_order" class="btn btn-green btn-sm addUser" data-toggle="modal" data-target="#exampleModal" style="float:right; margin-top:-7px;"><i class="fa fa-plus"></i> Add New</a></h4>
                </div>
                <div class="clearfix"></div>
            </div> -->

        <div class="portlet-body">
            <div class="table-responsive" style="text-align: center;">
                <table id="payment-table" class="table table-striped table-bordered table-hover table-green payment_table">
                    <thead style="text-align: center;background-color:rgb(64,96,153);">
                        <tr>
                            <th>S.No</th>
                            <th>Customer Name</th>
                            <th>Complains & Suggestions</th>
                            <th>Reply</th>
                            <th>Msg Date</th>

                        </tr>
                    </thead>
                    <tbody>

                        <?php
                        $que = "SELECT a.*,b.bz_cus_name FROM `complaints` AS a JOIN `bz_customer` AS b ON a.`cus_id` = b.`bz_cus_id` WHERE $dateFilter";
                        $res = $conn->query($que);



                        $sno = 1;
                        if (mysqli_num_rows($res) > 0) {

                            while ($row = mysqli_fetch_assoc($res)) {


                        ?>

                                <tr>
                                    <td><?php echo $sno++ ?></td>
                                    <td><?= $row['bz_cus_name'] ?></td>
                                    <td><?= $row['comps_and_suggs'] ?></td>
                                    <td><?php if ($row['reply_msg'] !== NULL) {
                                            echo $row['reply_msg'];
                                        } else {
                                           echo '<button type="button" class="btn btn-success" data-toggle="modal" data-target="#exampleModalCenter' . $row['comp_id'] . '">
           Reply
      </button>';

                                        }  ?></td>
                                    <td><?= $row['creat_dt'] ?></td>



                                </tr>

                                <div class="modal fade" id="exampleModalCenter<?= $row['comp_id'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLongTitle">Reply Message</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="" method="post" enctype="multipart/form-data">
                                                    <h4 for="">Reply</h4>

                                                    <div class="form-group">
                                                        <input type="hidden" name="comp_id" value="<?= $row['comp_id'] ?>">
                                                        <textarea name="reply" class="form-control" id="" cols="70" rows="5" placeholder="Enter Your Reply"></textarea>
                                                    </div>

                                                    <div class="form-group">
                                                        <button class="btn btn-success" type="submit" name="send_reply" value="submit">Submit</button>
                                                    </div>
                                                </form>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

                                            </div>
                                        </div>
                                    </div>
                                </div>

                        <?php
                            }
                        }

                        ?>


                    </tbody>
                </table>
            </div>
            <!-- /.table-responsive -->
        </div>
        <!-- /.portlet-body -->
    </div>
    <!-- /.portlet -->

</div>
<!-- /.col-lg-12 -->

</div>


<?php

if (isset($_POST['send_reply'])) {

    $id = $_POST['comp_id'];
    $reply = $_POST['reply'];


    $sql = "UPDATE `complaints` SET `reply_msg`='$reply' WHERE comp_id = $id";
    if (mysqli_query($conn, $sql)) {

        echo "<script>window.location.href ='complaints.php';</script>";

    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
}


include('./include/footer.php');
?>