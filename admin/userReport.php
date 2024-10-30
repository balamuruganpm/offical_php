<?php
include('./include/header.php');
include('./include/config.php');

$db = new ConnectionDB();
$dbconn = $db->getConnection();


// $date_que = "SELECT * FROM bz_customer" ;




// Initialize $dateFilter variable
$dateFilter = " 1 ";

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $minDate = $_POST['min'];
    $maxDate = $_POST['max'];

    // Validate and sanitize the input
    // You can add your validation and sanitization logic here

    // Create the date filter for the SQL query
    if ($minDate && $maxDate) {
        $minDate = date("Y-m-d", strtotime($minDate));
        $maxDate = date("Y-m-d", strtotime($maxDate . ' +1 day'));
        $dateFilter .= " AND bz_cus_time BETWEEN '$minDate' AND '$maxDate' ";
    }
}

?>


<style>
    /* thead, */
    /* th {
        text-align: center;
    }

    .btns {
        border: none;
        height: 40px;
        width: 100px;
        border-radius: 10px;

    }

    #pdf {
        background-image: url(https://www.pngall.com/wp-content/uploads/2/Downloadable-PDF-Button-PNG-High-Quality-Image.png);
        background-repeat: no-repeat;
        background-size: 90px 35px;
        box-shadow: 1px 1px;

    }

    #excel {
        background-image: url(https://blog.testproject.io/wp-content/uploads/2016/04/excel-logo-410x148.png);
        background-repeat: no-repeat;
        background-size: 70px 35px;
        box-shadow: 1px 1px green;
    }

    #csv {
        background-image: url(https://cdn0.iconfinder.com/data/icons/file-formats-flat-colorful-1/2048/1772_-_CSV-1024.png);
        background-repeat: no-repeat;
        background-size: 60px 40px;
        box-shadow: 1px 1px rgb(57, 72, 169);


    } */
    #subbtn{
        border: none;
        background-color: rgb(157,118,145);
    }
    #subbtn:hover{
        background-color: none;
    }
    #refreshbtn{
        border: none;
       background-color:  rgb(43,113,114);
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
                <li><i class="fa fa-dashboard"></i> <a href="index">User Report</a>
                </li>
                
            </ol>
        </div>
    </div>
  
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
                        <button class="btn btn-success" type="submit" id="subbtn" >Submit</button>
                    </td>
                </form>
                <form action="refresh.php" method="post">
                    <td>
                        &nbsp;
                        <button class="btn btn-info" name="refresh" id="refreshbtn"><i class="fa fa-refresh"></i></button>
                    </td>
                </form>
            </tr>
        </tbody>
    </table>
</div>
<br>
<br>
<!-- filter date end -->
<div class="row" id="machineries_list">
    <div class="col-lg-12">

        <!-- <div class="portlet portlet-default">
            <div class="portlet-heading">
                <div class="portlet-title" style="width: 100%; height: 40px;">
                    <h4><a id="add_new_order" class="btn btn-green btn-sm addUser" data-toggle="modal" data-target="#exampleModal" style="float:right; margin-top:-7px;"><i class="fa fa-plus"></i> Add New</a></h4>
                </div>
                <div class="clearfix"></div>
            </div> -->

        <?php
        $que = "SELECT * FROM bz_customer WHERE $dateFilter ORDER BY bz_cus_name ASC";
        $res = $dbconn->query($que);
        ?>
        <div class="portlet-body">
            <div class="table-responsive" style="text-align: center;">
                <table id="user-table" class="table table-striped table-bordered table-hover table-green">
                    <thead style="text-align: center;background-color:rgb(64,96,153);">
                        <tr>
                            <th>S.No</th>
                            <th>Name</th>
                            <th>E-mail</th>
                            <th>Mobile Number</th>
                            <th>Wallet Balance</th>
                            <th>Date</th>
                            <th>Time</th>


                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $sno = 1;
                        if (mysqli_num_rows($res) > 0) {

                            while ($row = mysqli_fetch_assoc($res)) {

                                $userId = $row['bz_cus_id'];
                                $status = $row['bz_cus_status'];
                                $name = $row['bz_cus_name'];
                        ?>
                                <tr>
                                    <td><?php echo $sno++ ?></td>
                                    <td><?= $row['bz_cus_name'] ?></td>
                                    <td><?= $row['bz_cus_email'] ?></td>
                                    <td><?= $row['bz_cus_phone'] ?></td>
                                    <td><?= $row['bz_cus_wallet'] ?></td>
                                    
                                    <td><?= $row['bz_cus_time'] ?></td>
                                    <td><?= $row['bz_cus_date'] ?></td>


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

<?php
include('./include/footer.php')
?>
