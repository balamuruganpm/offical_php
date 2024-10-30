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

<div class="row">
    <div class="col-lg-12">


        <div class="page-title">
            <ol class="breadcrumb">
                <li><i class="fa fa-dashboard"></i> <a href="index">Banner Management</a>
                </li>
               
            </ol>
        </div>
    </div>
    
</div>


<!-- banner table start -->
<div class="row" id="machineries_list">
    <div class="col-lg-12">
        <div class="portlet portlet-default">
            <div class="portlet-heading">
                <div class="portlet-title" style="width: 100%; height: 40px;">
                    <h4><a id="add_new_banner" class="btn btn-green btn-sm addUser" data-toggle="modal" data-target="#exampleModal" style="float:right; margin-top:-7px;"><i class="fa fa-plus"></i> Add New Banner </a></h4>
                </div>
                <div class="clearfix"></div>
            </div>

        <div class="portlet-body">
            <div class="table-responsive" style="text-align: center;">
               
                <table id="example-table" class="display dataTable table table-striped table-bordered table-hover table-green profile-table">
                    <thead style="text-align: center;background-color:rgb(64,96,153);">
                        <tr>
                            <th>S.No</th>
                            <th>Banner Name</th>
                            <th>Banner Image</th>
                            <!-- <th>Banner Status</th> -->
                            <th> Date / Time</th>
                            <th>Edit</th>
                            <th>Delete</th>


                        </tr>
                    </thead>
                    <tbody>

                        <?php
                        $que = "SELECT * FROM slider ";
                        $res = $dbconn->query($que);

                        $sno = 1;
                        // print_r($res);

                        if ($res) {

                            while ($row = mysqli_fetch_assoc($res)) {

                                $bannerId = $row['slider_id'];
                               
                               print_r($bannerId);
                        ?>
                                <tr>
                                    <td><?php echo $sno++ ?></td>
                                    <td><?= $row['slider_name'] ?></td>
                                    <td><img src="<?= $row['slider_image'] ?>" alt="pro_image" height="100px" width="170px"></td>
                                    <td><?= $row['slider_create_dt'] ?></td>
                                    <!-- <td><button type="submit" name="uploadbtn" id="uploadbt" class="btns"><i class="fa-solid fa-upload"></i></button></td> -->
                                    <td><button data-toggle="modal" data-target="#editmodal" name="editbtn" id="editbtn" class="btns edit_btn" data-ban_id="<?=$bannerId ?>" data-banname="<?= $row['slider_name'] ?>" data-banimg="<?= $row['slider_image'] ?>" ><i class="fa-solid fa-pen-to-square"></i></button></td>

                                    <td><button name="deletebtn" id="deletebtn" class="btns" data-bannid="<?= $bannerId ?>"><i class="fa-solid fa-trash-can"></i></button></td>

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
<!-- banner table end -->


<!-- banner modal start -->
<div class="modal fade" id="add_banner" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header" style="border: none;">
                <h5 class="modal-title" id="exampleModalLongTitle" style="font-size: 30px;color: rgb(147,150,95);font-family: serif;text-align: center;">ADD New Banner</h5>
                <!-- <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button> -->
            </div>
            <div class="modal-body">
                <style>


                </style>
                <form action="#"  id="addbannerform">
                   
                    <div class="divbox">
                        <label id="label" for="banner_name"> Name </label>
                        <input type="text"  name="banner_name" id="banner_name" class="inpbox form-control">
                    </div>
                    <div class="divbox">
                        <label id="label" for="banner_img">Image </label>
                        <input type="file" name="banner_img" id="banner_img" class="inpbox " >
                    </div>
                    
                </form>
            </div>
            <div class=" modal-footer" style="border: none;">
                <button type="button" class="btn btn-secondary  " data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" style="background-color: rgb(147,150,95);border: none;" name="banner_saved" id="banner_saved">Saved</button>
            </div>
        </div>
    </div>
</div>
<!-- banner modal end -->


<!--edit banner Modal start-->
<div class="modal fade" id="edit_banner" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header" style="border: none;">
                <h5 class="modal-title" id="exampleModalLongTitle" style="font-size: 30px;color: rgb(147,150,95);font-family: serif;text-align: center;">Edit Banner Details</h5>
                <!-- <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button> -->
            </div>
            <div class="modal-body">
                <style>


                </style>
                <form action="#" id="editbanform">
                    <div class="divbox">
                        <!-- <label id="label" for="banner_id">Id </label> -->
                        <input type="hidden" name="banner_id" id="banner_id" readonly class="inpbox">
                    </div>
                    <div class="divbox">
                        <label id="label" for="banner_name"> Name </label>
                        <input type="text"  name="banner_name" id="banner_name" class="inpbox form-control">
                    </div>
                    <div class="divbox">
                        <label id="label" for="banner_img">Image </label>
                        <input type="file" name="banner_img" id="banner_img" class="inpbox " >
                    </div>
                    

                </form>
            </div>
            <div class=" modal-footer" style="border: none;">
                <button type="button" class="btn btn-secondary  " data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" style="background-color: rgb(147,150,95);border: none;" name="prod_saved" id="edit_pro_saved">Saved</button>
            </div>
        </div>
    </div>
</div>
<!--edit banner modal end -->


<?php
include('./include/footer.php');
?>

<script>
  $(document).on('click','#add_new_banner',function(){

      $('#add_banner').modal('toggle');
  })


  $(document).on('click','#banner_saved',function(){

    var add_banner_form = new FormData($('#addbannerform')[0]);

    $.ajax({
        type: "post",
        url: "add-banner.php",
        data: add_banner_form,
        contentType:false,
        processData:false,
       
        dataType: "JSON",
        success: function (response) {
            if(response==100)
                {
                    swal('Add New Banner','Successfully','success');
                    setInterval(function(){
                        window.location.reload();
                    },1500);
                }
                else{
                    swal('Add New Banner','Not-Successfully','error');
                    setInterval(function(){
                        $('#add_banner').modal('toggle');
                    },1500);
                }
                if(response==300)
            {
                swal('Check banner image jsp||png||jpeg',' Edit Banner Not-Successfully','error');
                    setInterval(function(){

                        window.location.href='banner.php'
                    },2500);
            }
        }
    });
  })

  $(document).on('click','#deletebtn',function(){

    var bannerid = $(this).data('bannid');
    alert(bannerid);

    $.ajax({
        type: "post",
        url: "common.php",
        data: {
            "banner_id" : bannerid,
            action : 'delete_banner',
        },
        dataType: "JSON",
        success: function (response) {
            if(response==100)
            {
                swal('Delete','Banner Delete Successfully','success');
                    setInterval(function(){
                        window.location.reload();
                    },1500);
            }
            else{
                    swal('Delete','Banner Not-Successfully','error');
                    setInterval(function(){
                        window.location.href='banner.php'
                    },1500);
                }

        }
    });
  })

  $(document).on('click','#editbtn',function(){

      var bann_id = $(this).data('ban_id');
      var bann_name = $(this).data('banname');
    //   var bann_img = $(this).data('banimg');
    
     
    $('#banner_id').val(bann_id);
    $('#banner_name').val(bann_name);
    // $('#banner_img').val(bann_img);

    $('#edit_banner').modal('toggle');

  })

  $(document).on('click','#edit_pro_saved',function(){
       
      var edit_banner_form = new FormData($('#editbanform')[0])
    
      $.ajax({
        type: "post",
        url: "edit-banner.php",
        data: edit_banner_form,
        contentType:false,
        processData:false,
        dataType: "JSON",
        success: function (response) {

            if(response==100)
            {
                swal('Banner',' Edit Banner Successfully','success');
                    setInterval(function(){
                        window.location.reload();
                    },1500);
            }
            else{
                swal('Banner',' Edit Banner Not-Successfully','error');
                    setInterval(function(){
                        $('#edit_banner').modal('toggle');
                    },1500);
            }
            if(response==300)
            {
                swal('Check banner image jsp||png||jpeg',' Edit Banner Not-Successfully','error');
                    setInterval(function(){
                        window.location.href = 'banner.php'
                    },2500);
            }

            
        }
      });
  })
</script>