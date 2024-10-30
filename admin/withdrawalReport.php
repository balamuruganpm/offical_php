<?php
include('./include/header.php');
include('./include/config.php');

$db = new ConnectionDB();
$dbconn = $db->getConnection();

$dateFilter = " 1 ";

if($_SERVER['REQUEST_METHOD']==='POST')
{
    $mindate = $_POST['min'];
    $maxdate = $_POST['max'];

    if($mindate && $maxdate)
    {
        $minDate = date('Y-m-d',strtotime($mindate));
        $maxDate = date('Y-m-d',strtotime($maxdate.' +1 day'));
        $dateFilter .= "AND bz_date BETWEEN '$minDate' AND '$maxDate' ";
    }
}
?>

<style>
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
                <li><i class="fa fa-dashboard"></i> <a href="index">Withdraw Report</a>
                </li>
                
            </ol>
        </div>
    </div>
  
</div>
<!--  -->

<!-- date filter start  -->
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
                        <button class="btn btn-info" name="refresh_withdra" id="refreshbtn"><i class="fa fa-refresh"></i></button>
                    </td>
                </form>
            </tr>
        </tbody>
    </table>
</div>
<!-- date filter end -->

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
                    <table id="withdra-table" class="table table-striped table-bordered table-hover table-green">
                        <thead style="text-align: center;background-color:rgb(64,96,153);">
                            <tr>
                                <th>S.No</th>
                                <th>Name</th>
                                <th>Withdra Amount</th>
                                <th>Date</th>
                                <th>Time</th>
                                <th>Status</th>
                               

                            </tr>
                        </thead>
                        <tbody>

                            <?php
                            $que = "SELECT * FROM bz_withdrwal WHERE $dateFilter ";
                            $res = $dbconn->query($que);



                            $sno = 1;
                            if (mysqli_num_rows($res) > 0) {

                                while ($row = mysqli_fetch_assoc($res)) {

                                    $userId = $row['bz_cus_id'];

                                    $user_que = "SELECT bz_cus_name FROM bz_customer WHERE bz_cus_id='$userId' ";
                                    $user_res = $dbconn->query($user_que);

                                  

                                   if($user_res)
                                   {
                                    if($user_row = mysqli_fetch_assoc($user_res))
                                    {
                                        $username = $user_row['bz_cus_name'];
                                    }
                                    
                                   }
                                   
                                   $id = $row['bz_withdrwal_id'];
                            ?>
                          
                                    <tr>
                                        <td><?php echo $sno++ ?></td>
                                        <td><?= $user_row['bz_cus_name'] ?></td>
                                        <td><?= $row['bz_amount'] ?></td>
                                        <td><?= $row['bz_date'] ?></td>
                                        <td><?= $row['bz_time'] ?></td>
                                        <td>
                                            <?php
                                           $statusButtonClass = ($row['bz_status'] == 1) ? 'btn btn-success statu' : 'btn btn-primary statu';
                                           $statusButtonText = ($row['bz_status'] == 1) ? 'Approved' : 'Request';
                                           
                                           if ($row['bz_status'] == 2 && $row['bz_status'] == 2) {
                                               $statusButtonClass = 'btn btn-danger statu';
                                               $statusButtonText = 'Rejected';
                                           }
                                           
                                           echo '<button class="' . $statusButtonClass . '" data-profile-id="' . $id . '">' . $statusButtonText . '</button>';
                                           
                                        ?>
                                        </td>
                                       

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
include('./include/footer.php');
?>