<?php
include('./include/header.php');
include('./include/config.php');

$db = new ConnectionDB();
$dbconn = $db->getConnection();

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

$prev = isset($_GET['prev']) ? $_GET['prev'] : null;
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
                <li><i class="fa fa-dashboard"></i> <a href="index">Bonus Management</a>
                </li>
                <!-- <li class="active">Machineries/Accessories</li> -->
            </ol>
        </div>
    </div>
    <!-- /.col-lg-12 -->
</div>
<!--  -->
<?php
if ($prev == null) {
    echo '<a href="bonus.php?prev=p1" class="btn btn-primary">previous changes</a>';
}else{
    
    echo '<a href="bonus.php" class="btn btn-warning">Back</a>';
} ?>
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
                        <button class="btn btn-info" name="refresh_bonus" id="refreshbtn"><i class="fa fa-refresh"></i></button>
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

        <div class="portlet portlet-default">
            <div class="portlet-heading">
                <div class="portlet-title" style="width: 100%; height: 40px;">
                    <h4><a id="add_new_order" class="btn btn-green btn-sm addBonus" href="add_bonus.php" style="float:right; margin-top:-7px;"><i class="fa fa-plus"></i> Add New</a></h4>
                </div>
                <div class="clearfix"></div>
            </div>

            <div class="portlet-body">
                <div class="table-responsive" style="text-align: center;">
                    <table id="payment-table" class="table table-striped table-bordered table-hover table-green payment_table">
                        <thead style="text-align: center;background-color:rgb(64,96,153);">
                            <tr>
                                <th>S.No</th>
                                <th>Bonus Code</th>
                                <th>Bonus Discount</th>
                                <!-- <th>Status</th> -->
                                <th>Create Date</th>
                                <?php if ($prev !== null) {
                                    echo '<th>Update Date</th>';
                                } ?>
                                <?php if ($prev == null) {
                                    echo ' <th>Action</th>';
                                } ?>

                            </tr>
                        </thead>
                        <tbody>

                            <?php
                            if ($prev !== null) {
                                $que = "SELECT * FROM `bonus` WHERE b_status = 1 AND $dateFilter";
                            } else {

                                $que = "SELECT * FROM `bonus` WHERE b_status = 0 AND $dateFilter";
                            }

                            $res = $dbconn->query($que);



                            $sno = 1;
                            if (mysqli_num_rows($res) > 0) {

                                while ($row = mysqli_fetch_assoc($res)) {

                                    $id = $row['b_id'];

                            ?>

                                    <tr>
                                        <td><?php echo $sno++ ?></td>
                                        <td><?= $row['b_code'] ?></td>
                                        <td><?= $row['b_disc'] ?>%</td>
                                        <!-- <td><?= $row['b_status'] ?></td> -->
                                        <td> <?= date('d-m-Y', strtotime($row['created_dt'])); ?></td>
                                        <?php if ($prev !== null) {
                                            echo '<td>';
                                            echo date('d-m-Y', strtotime($row['update_dt']));
                                            echo '</td>';
                                        } ?>
                                        <?php if ($prev == null) {
                                            echo '<td>';
                                            echo '<a href="bonus_edit.php?edit=' . $id . '"><i class="fa fa-edit btn btn-primary"></i></a>';
                                          
                                            echo '</td>';
                                        } ?>
                                    </tr>



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

<!-- modal adduser start -->
<div class="modal fade " id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header" style="border: none;">
                <h5 class="modal-title" id="exampleModalLongTitle" style="text-align: center;font-size: 25px; color: rgb(106,59,95);"><b>Add New Bonus</b></h5>

            </div>
            <div class="modal-body">
                <form action="" method="post" id="addFrom">


                </form>
            </div>

        </div>
    </div>
</div>
<!-- modal adduser end -->
<?php
include('./include/footer.php');
?>