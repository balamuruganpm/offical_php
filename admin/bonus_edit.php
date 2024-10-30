<?php
include('./include/header.php');
include('./include/config.php');

$db = new ConnectionDB();
$conn = $db->getConnection();


$id=$_GET['edit'];
$sql="SELECT * FROM `bonus` WHERE b_id = $id";
$res=mysqli_query($conn,$sql);
$row=mysqli_fetch_assoc($res);
$b_code=$row['b_code'];
$b_disc=$row['b_disc'];

?>

<!-- begin PAGE TITLE ROW -->
<div class="row">
    <div class="col-lg-12">
        <div class="page-title">
            <h1>Edit Bonus</h1>
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
                        <input type="text" name="b_code" class="form-control" value="<?=$b_code?>">
                    </div>
                    <div class="form-group">
                        <label for="">Bonus Discount</label>
                        <input type="text" name="b_disc" class="form-control" value="<?=$b_disc?>">
                    </div>
                    <div class="form-group">
                        <button class="btn btn-primary" type="submit" name="update_bonus" value="submit">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?php
if (isset($_POST['update_bonus'])) {
    $b_code = $_POST['b_code'];
    $b_disc = $_POST['b_disc'];
    $b_status = 1;
    $update_dt = date("Y-m-d");

    // Prepare and execute the update query
    $sql = "UPDATE `bonus` SET `b_code` = ?, `b_disc` = ?, `update_dt` = ? WHERE b_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssi", $b_code, $b_disc, $update_dt, $id);

    if ($stmt->execute()) {
        echo "<script>alert('Data Updated successfully!');</script>";
        echo "<script>window.location.href = 'bonus.php';</script>";
    } else {
        echo "Error: " . $stmt->error;
    }
}

include('./include/footer.php');
?>