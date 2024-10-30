<?php 

include('./include/header.php');
include('./include/config.php');

$db = new ConnectionDB();
$conn = $db->getConnection();

$update_cat_query = "SELECT (`terms_cons`) FROM `info`";
$update_cat_stmt = mysqli_query($conn, $update_cat_query);
$update_datat1 = mysqli_fetch_assoc($update_cat_stmt);
?>
<!-- /.navbar-side -->
<!-- end SIDE NAVIGATION -->


<div class="row">
    <div class="col-lg-12">
        <div class="page-title">
            <h1>Terms and Condition
                <small></small>
            </h1>
        </div>
    </div>
</div>


<div class="col-lg-6 col-lg-offset-3">

    <div class="portlet portlet-green">
        <div class="portlet-heading">
            <div class="portlet-title">
                <h4>Terms and Condition</h4>
            </div>
            <div class="clearfix"></div>

        </div>
        <form action="add_tools.php" method="post">

            <div class="portlet-body">

                <h4>Description</h4>
                <textarea type="text" id="textareaMax" class="form-control" rows="14" placeholder="Enter your Description..." maxlength="1000" name="term_description" value="<?php echo $update_datat1['terms_cons']; ?>"><?php echo $update_datat1['terms_cons']; ?></textarea>
                <br>




                <div class="">
                    <button type="submit" name="save_terms" class="btn btn-green btn-block">Save</button>
                </div>
            </div>
        </form>
    </div>
</div>




<script>
    CKEDITOR.replace('term_description');
</script>
<?php include('./include/footer.php'); ?>