<?php

include('./include/header.php');
include('./include/config.php');

$db = new ConnectionDB();
$conn = $db->getConnection();

$update_cat_query = "SELECT (`agreement_risk`) FROM `info`";
$update_cat_stmt = mysqli_query($conn, $update_cat_query);
$update_datat1 = mysqli_fetch_assoc($update_cat_stmt);
?>


<div class="row ">
    <div class="col-md-12 text-center">
        <div class="row">
            <div class="col-lg-12">
                <div class="page-title">
                    <h1>Risk Disclosure Agreement
                        <small></small>
                    </h1>
                </div>
            </div>
        </div>


        <div class="col-lg-6 col-lg-offset-3 m-auto">

            <div class="portlet portlet-green">
                <div class="portlet-heading">
                    <div class="portlet-title">
                        <h4>Risk Disclosure Agreement</h4>
                    </div>
                    <div class="clearfix"></div>

                </div>
                <form action="add_tools.php" method="post">


                    <div class="portlet-body">

                        <h4>Description</h4>
                        <textarea type="text" id="textareaMax" class="form-control" rows="14" placeholder="Enter your Description..." maxlength="1000" name="agreement" value="<?php echo $update_datat1['agreement_risk']; ?>"><?php echo $update_datat1['agreement_risk']; ?></textarea>
                        <br>
                        <div class="">
                            <button type="submit" name="agreement_submit" class="btn btn-success btn-block">Save</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

    </div>

    <!-- Blank End -->

    <script>
        // CKEDITOR.replace( 'term_title' );
        CKEDITOR.replace('agreement');
    </script>

    <?php include('./include/footer.php'); ?>