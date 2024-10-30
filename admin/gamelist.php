<?php
include('./include/header.php');
include('./include/config.php');

$db = new ConnectionDB();
$dbconn = $db->getConnection();

$dateFilter = " 1 ";

if($_SERVER['REQUEST_METHOD'] === 'POST')
{
      $mindate = $_POST['min'];
      $maxdate = $_POST['max'];

      if($mindate && $maxdate)
      {
          $minDate = date('Y-m-d' , strtotime($mindate));
          $maxDate = date('Y-m-d' , strtotime($maxdate . '+1 day'));
          $dateFilter .= "AND bz_payment_date BETWEEN '$minDate' AND '$maxDate' ";
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
                <li><i class="fa fa-dashboard"></i> <a href="index">Game List</a>
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
                        <button class="btn btn-success" type="submit" id="subbtn" >Submit</button>
                    </td>
                </form>
                <form action="refresh.php" method="post">
                    <td>
                        &nbsp;
                        <button class="btn btn-info" name="refresh_game_list" id="refreshbtn"><i class="fa fa-refresh"></i></button>
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
                <?php

// Assuming you have already established a database connection ($dbconn)

// API Request
$api_url = "https://colourcash.com/RestApi/UserApi/bet_list.php";
$api_key = "CC@2024";
$api_data = array("api_key" => $api_key);

$options = array(
    'http' => array(
        'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
        'method'  => 'POST',
        'content' => http_build_query($api_data),
    ),
);

$context  = stream_context_create($options);
$response = file_get_contents($api_url, false, $context);

// Check if API request was successful
if ($response === FALSE) {
    die('Error occurred while fetching data from API');
}

// Decode the JSON response
$data = json_decode($response, true);

// Check if the JSON decoding was successful
if ($data === null) {
    die('Error decoding JSON response');
}

// Check if the API response contains the expected data structure
if (isset($data['status']) && $data['status'] == 'success' && isset($data['game']) && is_array($data['game'])) {

    $payment_history = $data['game'];

    // Table Structure
    echo '<table id="payment-table" class="table table-striped table-bordered table-hover table-green payment_table">
            <thead style="text-align: center;background-color:rgb(64,96,153);">
                <tr>
                    <th>S.No</th>
                    <th>GameID</th>
                    <th>Amount</th>
                    <th>Join Color</th>
                </tr>
            </thead>
            <tbody>';

    // Loop through payment history
    $sno = 1;
    foreach ($payment_history as $row) {

        // Display table row
        echo '<tr>
                <td>' . $sno++ . '</td>
                <td>' . $row['GameID'] . '</td>
                <td>' . $row['Amount'] . '</td>
                <td>' . $row['Join_color'] . '</td>
            </tr>';
    }

    // Close table
    echo '</tbody></table>';

} else {
    // Handle the case where the API response does not contain the expected data
    echo 'Invalid API response format';
}

?>



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