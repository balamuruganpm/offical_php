<?php

include('./include/header.php');
include('./include/config.php');

$db = new ConnectionDB();
$conn = $db->getConnection();

$update_cat_query = "SELECT (`privacy_policy`) FROM `info`";
$update_cat_stmt = mysqli_query($conn, $update_cat_query);
$update_datat1 = mysqli_fetch_assoc($update_cat_stmt);
?>


<div class="row ">
    <div class="col-md-12 text-center">
        <div class="row">
            <div class="col-lg-12">
                <div class="page-title">
                    <h1>Privacy and Policy
                        <small></small>
                    </h1>
                </div>
            </div>
        </div>


        <div class="col-lg-6 col-lg-offset-3 m-auto">

            <div class="portlet portlet-green">
                <div class="portlet-heading">
                    <div class="portlet-title">
                        <h4>Privacy and Policy</h4>
                    </div>
                    <div class="clearfix"></div>

                </div>
                <form action="add_tools.php" method="post">


                    <div class="portlet-body">

                        <h4>Description</h4>
                        <textarea type="text" id="textareaMax" class="form-control" rows="14" placeholder="Enter your Description..." maxlength="1000" name="privacy" value="<?php echo $update_datat1['privacy_policy']; ?>"><?php echo $update_datat1['privacy_policy']; ?></textarea>
                        <br>
                        <div class="">
                            <button type="submit" name="policy_submit" class="btn btn-success btn-block">Save</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

    </div>

    <!-- Blank End -->

    <script>
        // CKEDITOR.replace( 'term_title' );
        CKEDITOR.replace('privacy');
    </script>

    <?php include('./include/footer.php'); ?>