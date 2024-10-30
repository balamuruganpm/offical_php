<?php
include('./include/header.php');
include('./include/config.php');

$db = new ConnectionDB();
$dbconn = $db->getConnection();


?>
<style>
    .btns {
        border: 1px solid black;
        height: 40px;
        width: 60px;
        text-align: center;
        border-radius: 5px;
    }

    #deletebtn {
        border: none;
        background-color: rgb(186, 62, 62);
        color: white;
    }

    #editbtn {
        border: none;
        background-color: rgb(201, 200, 133);
        color: white;
    }

    .inpbox {
        height: 40px;
        width: 250px;
        margin-left: 80px;
        /* display: flex;
                       align-items: center; */

    }

    .divbox {

        align-items: center;
        display: flex;
        gap: 10px;
        margin-bottom: 25px;
        margin-left: 20px;
        align-items: center;

    }

    #label {
        width: 100px;
        display: inline-block;

    }

    input {
        padding-left: 10px;
    }
    #pro_price::-webkit-inner-spin-button,#pro_price::-webkit-inner-spin-button{
        display: none;
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
                <li><i class="fa fa-dashboard"></i> <a href="index">Product Management</a>
                </li>
               
            </ol>
        </div>
    </div>
    <!-- /.col-lg-12 -->
</div>
<!--  -->

<!--  -->
<div class="row" id="machineries_list">
    <div class="col-lg-12">
        <div class="portlet portlet-default">
            <div class="portlet-heading">
                <div class="portlet-title" style="width: 100%; height: 40px;">
                    <h4><a id="add_new_product" class="btn btn-green btn-sm addUser" data-toggle="modal" data-target="#exampleModal" style="float:right; margin-top:-7px;"><i class="fa fa-plus"></i> Add New Product </a></h4>
                </div>
                <div class="clearfix"></div>
            </div>

        <div class="portlet-body">
            <div class="table-responsive" style="text-align: center;">
               
                <table id="example-table" class="display dataTable table table-striped table-bordered table-hover table-green profile-table">
                    <thead style="text-align: center;background-color:rgb(64,96,153);">
                        <tr>
                            <th>S.No</th>
                            <th>Product Name</th>
                            <th>Product Image</th>
                            <th>Product Discription</th>
                            <th>Product Price</th>
                            <th>Brand</th>
                            <th>Modal No</th>
                            <th>Date / Time</th>
                            <th>Edit</th>
                            <th>Delete</th>


                        </tr>
                    </thead>
                    <tbody>

                        <?php
                        $que = "SELECT * FROM products ";
                        $res = $dbconn->query($que);

                        $sno = 1;

                        if ($res) {

                            while ($row = mysqli_fetch_assoc($res)) {

                                $productId = $row['pro_id'];
                        ?>
                                <tr>
                                    <td><?php echo $sno++ ?></td>
                                    <td><?= $row['pro_name'] ?></td>
                                    <td><img src="<?= $row['pro_image'] ?>" alt="pro_image" height="100px" width="100px"></td>
                                    <td><?= $row['pro_desc'] ?></td>
                                    <td><?= $row['pro_price'] ?></td>
                                    <td><?= $row['brand'] ?></td>
                                    <td><?= $row['modal_no'] ?></td>
                                    <td><?=$row['created_dt']?></td>
                                    <!-- <td><button type="submit" name="uploadbtn" id="uploadbt" class="btns"><i class="fa-solid fa-upload"></i></button></td> -->
                                    <td><button data-toggle="modal" data-target="#editmodal" name="editbtn" id="editbtn" class="btns edit_btn" data-prod_id="<?= $productId ?>" data-proname="<?= $row['pro_name'] ?>" data-proimg="<?= $row['pro_image'] ?>" data-prodesc="<?= $row['pro_desc'] ?>" data-proprice="<?= $row['pro_price'] ?>" data-probrand="<?= $row['brand'] ?>" data-promodalno="<?= $row['modal_no'] ?>"><i class="fa-solid fa-pen-to-square"></i></button></td>
                                    <td><button name="deletebtn" id="deletebtn" class="btns" data-productid="<?= $productId ?>"><i class="fa-solid fa-trash-can"></i></button></td>

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


<!--edit product Modal start-->
<div class="modal fade" id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header" style="border: none;">
                <h5 class="modal-title" id="exampleModalLongTitle" style="font-size: 30px;color: rgb(147,150,95);font-family: serif;text-align: center;">Edit Product Details</h5>
                <!-- <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button> -->
            </div>
            <div class="modal-body">
                <style>


                </style>
                <form action="product-update.php" method="post" id="formvalues">
                    <div class="divbox">
                        <!-- <label id="label" for="pro_id">Id </label> -->
                        <input type="hidden" name="pro_id" id="pro_id" readonly class="inpbox">
                    </div>
                    <div class="divbox">
                        <label id="label" for="pro_name"> Name </label>
                        <input type="text"  name="pro_name" id="pro_name" class="inpbox form-control">
                    </div>
                    <div class="divbox">
                        <label id="label" for="pro_img">Image </label>
                        <input type="file" name="pro_img" id="pro_img" class="inpbox " >
                    </div>
                    <div class="divbox">
                        <label id="label" for="pro_disc"> Discription </label>
                        <input type="text" name="pro_disc" id="pro_disc" class="inpbox form-control">
                    </div>
                    <div class="divbox">
                        <label id="label" for="pro_price"> Price </label>
                        <input type="number" name="pro_price" id="pro_price" class="inpbox form-control">
                    </div>
                    <div class="divbox">
                        <label id="label" for="pro_brand">Brand </label>
                        <input type="text" name="pro_brand" id="pro_brand" class="inpbox form-control">
                    </div>
                    <div class="divbox">
                        <label id="label" for="pro_mod_no">Modal No </label>
                        <input type="text" name="pro_mod_no" id="pro_mod_no" class="inpbox form-control">
                    </div>

                </form>
            </div>
            <div class=" modal-footer" style="border: none;">
                <button type="button" class="btn btn-secondary  " data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" style="background-color: rgb(147,150,95);border: none;" name="prod_saved" id="prod_saved">Saved</button>
            </div>
        </div>
    </div>
</div>
<!--edit product modal end -->

</div>
<!--  -->

</div>




<!-- add new product Modal start-->
<div class="modal fade" id="add_product" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header" style="border: none;">
                <h5 class="modal-title" id="exampleModalLongTitle" style="font-size: 30px;color: rgb(147,150,95);font-family: serif;text-align: center;">Add New Product</h5>
                <!-- <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button> -->
            </div>
            <div class="modal-body">
                <style>


                </style>
                <form action="" id="addprodform">
                    <!-- <div class="divbox">
                        <label id="label" for="pro_id">Id </label>
                        <input type="hidden" name="pro_id" id="pro_id" readonly class="inpbox">
                    </div> -->
                    <div class="divbox">
                        <label id="label" for="pro_name"> Name </label>
                        <input type="text"  name="pro_name" id="pro_name" class="inpbox form-control">
                    </div>
                    <div class="divbox">
                        <label id="label" for="pro_img">Image </label>
                        <input type="file" name="pro_img" id="pro_img" class="inpbox " >
                    </div>
                    <div class="divbox">
                        <label id="label" for="pro_disc"> Discription </label>
                        <input type="text" name="pro_disc" id="pro_disc" class="inpbox form-control">
                    </div>
                    <div class="divbox">
                        <label id="label" for="pro_price"> Price </label>
                        <input type="number" name="pro_price" id="pro_price" class="inpbox form-control">
                    </div>
                    <div class="divbox">
                        <label id="label" for="pro_brand">Brand </label>
                        <input type="text" name="pro_brand" id="pro_brand" class="inpbox form-control">
                    </div>
                    <div class="divbox">
                        <label id="label" for="pro_mod_no">Modal No </label>
                        <input type="text" name="pro_mod_no" id="pro_mod_no" class="inpbox form-control">
                    </div>

                </form>
            </div>
            <div class=" modal-footer" style="border: none;">
                <button type="button" class="btn btn-secondary  " data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" style="background-color: rgb(147,150,95);border: none;" name="prod_saved" id="add_produ">Add Product</button>
            </div>
        </div>
    </div>
</div>
<!--add new product modal end -->






<?php
include('./include/footer.php');
?>
<script>
    $(document).on('click', '#deletebtn', function() {

        var product_id = $(this).data('productid');
        // alert(product_id);

        $.ajax({
            type: 'post',
            url: 'common.php',
            data: {
                'productid': product_id,
                action: 'product_delete',
            },
            dataType: 'JSON',
            success: function(response) {
                if (response == 100) {
                    swal('Delete', 'Product Delete Successfully', 'success');
                    setInterval(function() {
                        window.location.reload();
                    }, 1500);
                } else {
                    swal('Delete', 'Product Delete Not-Successfull', 'error');
                    setInterval(function() {
                        window.location.href = 'product-management.php';
                    }, 2000);
                }
            }

        })

    })

    $(document).on('click', '.edit_btn', function() {

        var produ_id = $(this).data('prod_id');
        var produ_name = $(this).data('proname');
        // var produ_imag = $(this).data('proimg');
        var produ_desc = $(this).data('prodesc');
        var produ_price = $(this).data('proprice');
        var produ_brand = $(this).data('probrand');
        var produ_modno = $(this).data('promodalno');

        $("#exampleModalLong #pro_id").val(produ_id);
        $('#exampleModalLong #pro_name').val(produ_name);
        // $('#exampleModalLong #pro_img').val(produ_imag);
        $('#exampleModalLong #pro_disc').val(produ_desc);
        $('#exampleModalLong #pro_price').val(produ_price);
        $('#exampleModalLong #pro_brand').val(produ_brand);
        $('#exampleModalLong #pro_mod_no').val(produ_modno);

        $('#exampleModalLong ').modal('toggle');
    })


    $(document).on('click', '#prod_saved', function() {

        // var form_data = $('#formvalues').serializeArray();
        var form_data = new FormData($('#formvalues')[0]);
        // alert(form_data)

        $.ajax({
            type: "post",
            url: "product-update.php",
            data: form_data,
            contentType: false,
            processData: false,
            dataType: "JSON",
            success: function(response) {
                if (response == 100) {
                    swal('Product', 'Update Successfully', 'success');
                    setInterval(function() {
                        window.location.reload();
                    }, 1500);
                } else {
                    swal('Product', 'Update Not-Successfull', 'error');
                    setInterval(function() {
                        window.location.reload();
                    }, 1500);
                }
            }
        });
    })



    $(document).on('click','#add_new_product',function(){
        $('#add_product').modal('toggle');
    })


    $(document).on('click','#add_produ',function(){

        var add_product_form = new FormData($('#addprodform')[0])

        $.ajax({
            type: "post",
            url: "add-to-product.php",
            data: add_product_form,
            contentType:false,
            processData:false,
            dataType: "JSON",
            success: function (response) {
                if(response==100)
                {
                    swal('Add New Product','Successfully','success');
                    setInterval(function(){
                        window.location.reload();
                    },1500);
                }
                else{
                    swal('Add New Product','Not-Successfully','error');
                    setInterval(function(){
                        $('#add_product').modal('toggle');
                    },1500);
                }
            }
        });
    })
</script>