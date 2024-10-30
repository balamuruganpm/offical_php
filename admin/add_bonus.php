<?php
include('./include/header.php');
include('./include/config.php');

$db = new ConnectionDB();
$conn = $db->getConnection();

?>


<!-- begin PAGE TITLE ROW -->
<div class="row">
    <div class="col-lg-12">
        <div class="page-title">
            <h1>Add Bonus</h1>
        </div>
    </div>
    <!-- /.col-lg-12 -->
</div>

<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-body">
                <form action="" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="">Bonus Code</label>
                        <input type="text" name="b_code" class="form-control" value="">
                    </div>
                    <div class="form-group">
                        <label for="">Bonus Discount</label>
                        <input type="text" name="b_disc" class="form-control" value="">
                    </div>
                    <div class="form-group">
                        <label for="">Created Date</label>
                        <input type="date" name="date" class="form-control" value="">
                    </div>

            
                    <div class="form-group">
                        <button class="btn btn-primary" type="submit" name="add_bonus" value="submit">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- /.col-lg-12 -->
<?php
if (isset($_POST['add_bonus'])) {
    $b_code = $_POST['b_code'];
    $b_disc = $_POST['b_disc'];
    $date = $_POST['date'];

    // Prepare and execute the SQL query to insert the new bonus record
    $sql = "INSERT INTO `bonus` (`b_code`, `b_disc`, `created_dt`) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sss", $b_code, $b_disc, $date);

    if ($stmt->execute()) {
        echo "<script>alert('Data Inserted successfully!');</script>";
        echo "<script>window.location.href ='bonus.php';</script>";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}

include('./include/footer.php');
?>