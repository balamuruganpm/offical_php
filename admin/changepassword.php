<?php
include('./include/header.php');
include('./include/config.php');

$db = new ConnectionDB();
$conn = $db->getConnection();


?>
   <script src="sweetalert2.min.js"></script>
    <link rel="stylesheet" href="sweetalert2.min.css">
<!-- begin MAIN PAGE CONTENT -->

        <!-- begin PAGE TITLE ROW -->
        <div class="row">
            <div class="col-lg-12">
                <div class="page-title">
                    <h1>Change Password</h1>
                </div>
             <div class="card col-lg-9">

                 
             <?php

$id = $_SESSION["u_name"];

if(count($_POST)>0) {
$result = mysqli_query($conn,"SELECT * from `admin_user` WHERE admin_name='" . $id . "'");
$row=mysqli_fetch_array($result);
if($_POST["old_pass"] == $row["admin_password"] && $_POST["new_pass"] == $_POST["confirm_pass"] ) {
mysqli_query($conn,"UPDATE `admin_user` set `admin_password`='" . $_POST["new_pass"] . "' WHERE admin_name='" . $id . "'");
?>

<script>
swal("", "<?php echo 'Password Changed Sucessfully' ;?>", "success");
</script>

<?php
} else{?>


<script>
 swal("", "<?php echo 'Password is not correct' ;?>", "error");
</script>
<?php
}
}
?>
    
             <form action="" method="post">
                 <div class="mb-3">
                     <label for="old_pass" class="form-label">Enter Your Old Password</label>
                     <input type="password" class="form-control" name="old_pass" id="old_pass" placeholder="Old Password">
                 </div>
                 <div class="mb-3">
                     <label for="new_pass" class="form-label">Enter Your New Password</label>
                     <input type="password" class="form-control" name="new_pass" id="new_pass" placeholder="New Password">
                 </div>
                 <div class="mb-3">
                     <label for="confirm_pass" class="form-label">Enter Your Confirm New Password</label>
                     <input type="password" class="form-control" name="confirm_pass" id="confirm_pass" placeholder="Confirm New Password">
                 </div>
                 <br>
                 <div class="mb-3">
                     <input type="submit" class="form-control btn btn-primary" name="submit" value="Change Password">
                 </div>
             </form>
             </div>
</div>
            
        </div>

<?php
include("include/footer.php");
?>
