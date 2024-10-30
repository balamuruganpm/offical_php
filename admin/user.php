<?php
include('./include/header.php');
include('./include/config.php');


$db = new ConnectionDB();

$dbconn = $db->getConnection();


?>

<style>
    table,
    td,
    th {

        text-align: center;
       
    }

    .aligndiv {
        margin-bottom: 30px;
        display: flex;
        justify-content: center;
    }

    input {

        height: 40px;
        width: 350px;
        padding-left: 10px;
        border: 1px solid rgb(106,59,95);
    }

    .mobile_num::-webkit-inner-spin-button,
    .mobile_num::-webkit-outer-spin-button {

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
                <li><i class="fa fa-dashboard"></i> <a href="index">User</a>
                </li>
                <!-- <li class="active">Machineries/Accessories</li> -->
            </ol>
        </div>
    </div>
    <!-- /.col-lg-12 -->
</div>


<div class="row" id="machineries_list">
    <div class="col-lg-12">

        <div class="portlet portlet-default">
            <div class="portlet-heading">
                <div class="portlet-title" style="width: 100%; height: 40px;">
                    <h4><a id="add_new_order" class="btn btn-green btn-sm addUser" data-toggle="modal" data-target="#exampleModal" style="float:right; margin-top:-7px;"><i class="fa fa-plus"></i> Add New User</a></h4>
                </div>
                <div class="clearfix"></div>
            </div>

            <div class="portlet-body">
                <div class="table-responsive" style="text-align: center;">
                    <table id="example-table" class="display dataTable table table-striped table-bordered table-hover table-green profile-table">
                        <thead style="text-align: center;background-color:rgb(64,96,153);">
                            <tr>
                                <th>S.No</th>
                                <th>Name</th>
                                <th>E-mail</th>
                                <th>Mobile Number</th>
                                <th>Status</th>
                                <th>View</th>
                                <th>Delete</th>

                            </tr>
                        </thead>
                        <tbody>

                            <?php
                            $que = "SELECT * FROM bz_customer";
                            $res = $dbconn->query($que);



                            $sno = 1;
                            if (mysqli_num_rows($res) > 0) {

                                while ($row = mysqli_fetch_assoc($res)) {

                                    $userId = $row['bz_cus_id'];
                                    $status = $row['bz_cus_status'];
                                    $name = $row['bz_cus_name'] ;
                            ?>
                                    <tr>
                                        <td><?php echo $sno++ ?></td>
                                        <td><?= $row['bz_cus_name'] ?></td>
                                        <td><?= $row['bz_cus_email'] ?></td>
                                        <td><?= $row['bz_cus_phone'] ?></td>
                                        <td>
                                            <?php
                                            if ($status == 1) {
                                            ?>

                                                <button style="background-color:rgb(105,137,88) ;color: white; border: none; height: 30px; width: 80px; border-radius: 7px;" class="inactive" data-inactive-status="<?= $status ?>" data-user-id="<?= $userId ?>"><b>Active</b></button>
                                            <?php
                                            } else {
                                            ?>
                                                <button style="background-color: rgb(204,81,83) ;color: white;border: none;height: 30px; width: 80px; border-radius: 7px;" class="active_user" data-active-status="<?= $status ?>" data-user-id="<?= $userId ?>"><b>DeActive</b></button>
                                            <?php
                                            }
                                            ?>

                                        </td>
                                        <td style="padding-top: 14px;"><a style="background-color: rgb(166,130,140) ;color: white;border: none;padding:6px 15px 6px 15px ; border-radius: 7px;text-decoration: none; text-align: center;  " class="viewUser"  href="view.php?view_user_id=<?=$userId?>&view_user_name=<?= $name ?>"><span><i style="font-size: 10px; " class="fa-solid fa-eye"></i></span><span>  <b>View</b></span></a></td>
                                        <td><button class="delete_submit" data-userid ="<?= $userId ?>"  style="background-color: rgb(145,176,178) ;color: white;border: none;height: 30px; width: 80px; border-radius: 7px ;" ><span><i style="font-size: 10px;" class="fa-solid fa-trash-can"></i></span><span>  <b>Delete</b></span></button></td>


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

<!-- modal adduser start -->
<div class="modal fade " id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header" style="border: none;">
                <h5 class="modal-title" id="exampleModalLongTitle" style="text-align: center;font-size: 25px; color: rgb(106,59,95);"><b>Add New User</b></h5>
                <!-- <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true" style="cursor: pointer; margin-right: 40px; margin-top: -60px;">X</span>
                            </button> -->
            </div>
            <div class="modal-body">
                <form action="" method="post" id="addFrom">
                    <div class="aligndiv">

                        <input type="text" name="name" id="user_name" onkeyup="nameValidation()" placeholder="Name">
                    </div>
                    <p class="error" id="nameError" style="margin-left: 110px; margin-top: -25px;visibility: hidden; ">Enter name</p>
                    <div class="aligndiv">

                        <input type="email" name="email" id="email" placeholder="E-mail" onkeyup="emailValidation()" >
                    </div>
                    <p class="error" id="emailError" style="margin-left: 110px; margin-top: -25px;visibility: hidden;">enter Email</p>
                    <div class="aligndiv">

                        <input type="number" name="mobile" id="mobile_num" class="mobile_num" placeholder="Mobile number" onkeyup="mobileVerification()">
                    </div>
                    <p class="error" id="mobileError" style="margin-left: 110px; margin-top: -25px; visibility: hidden ;">Enter mobile Number</p>
                    <div class="aligndiv">

                        <input type="password" name="password" id="user_password" placeholder="Password" onkeyup="passVerification()">

                    </div>
                    <p class="error" id="passwordError" style="margin-left: 110px; margin-top: -25px;visibility: hidden;">Enter Password</p>
                    <div style="margin-left: 110px; margin-top: -10px;">
                        <input type="checkbox" onclick="myFunction()" style="border: 1px solid rgb(106,59,95) ; "> Show Password
                    </div>
                    <div class="modal-footer" style="border: none;">
                        <button type="button" class="btn btn-secondary closeModal" data-dismiss="modal" style="background-color: rgb(169,169,169);border: 1px solid rgb(169,169,169);">Close</button>
                        <button type="button" class="btn btn-primary" name="addnewsubmit" id="addnewsubmit" style="background-color: rgb(106,59,95);border: 1px solid rgb(106,59,95);">Submit</button>
                    </div>

                </form>
            </div>

        </div>
    </div>
</div>
<!-- modal adduser end -->




<!-- modal view user start -->
<!-- <div class="modal fade" id="viewUserModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content" style="width: 1200px; margin-left: -290px;">
            <div class="modal-header" style="border: none;">
                <h5 class="modal-title" id="exampleModalLongTitle" style="text-align: center;font-size: 25px; color: rgb(106,59,95);"><b>User Details</b></h5> -->
                <!-- <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true" style="cursor: pointer; margin-right: 40px; margin-top: -60px;">X</span>
                            </button> -->
            <!-- </div>
            <div class="modal-body">
            <div class="portlet-body">
                <div class="table-responsive" style="text-align: center;">
                    <table id="example-table" class="table table-striped table-bordered table-hover table-green">
                        <thead style="text-align: center;background-image: linear-gradient(to right,rgb(93,98,75),rgb(111,137,150));">
                            <tr>
                                <th>S.No</th>
                                <th>Name</th>
                                <th>Wallet balance</th>
                                <th> Betting records</th>
                                <th> Deposit records</th>
                                <th>profit records</th>

                            </tr>
                        </thead>
                        <tbody>
                              <tr>
                                <td></td>
                              </tr>

                        </tbody>
                    </table>
                </div> -->
                <!-- /.table-responsive -->
            <!-- </div>
                    <div class="modal-footer" style="border: none;">
                        <button type="button" class="btn btn-secondary closeModal" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" name="addnewsubmit" id="#addnewsubmit">Submit</button>
                    </div>
            </div>

        </div>
    </div>
</div> -->
<!-- modal view user end -->


<?php
include('./include/footer.php');
?>

<!--Toggle Password Visibility  -->
<script>
    function myFunction() {
        var check_box = document.getElementById('user_password')
        if (check_box.type === 'password') {
            check_box.type = 'text';
        } else {
            check_box.type = 'password';
        }
    }
</script>

<script>
    // delete user
    $(document).on('click', '.delete_submit', function() {

        var user_id = $(this).data('userid')

        var delete_alert = confirm('You confirm to remove user')

        if (delete_alert) {

            $.ajax({

                type: 'post',
                url: 'common.php',
                data: {
                    'user_id': user_id,
                    action: 'delete_user',
                },
                dataType: 'JSON',
                success: function(response) {

                    if (response == 100) {
                        swal("UserDetails", "Delete Sccessfully", "success");
                        setInterval(function() {
                            window.location.reload();
                        }, 2500);
                    } else {
                        swal("UserDetails", "Unable to delete", "error");

                    }
                }

            })

        }
    })

    // AddNew
    $(document).on('click', '.addUser', function() {

        $('#exampleModalLong').modal('toggle');
    })

    // close modal
    $(document).on('click', '.closeModal', function()
     {
        $('#addFrom')[0].reset();
        $('.exampleModal').modal('toggle');

    })


    // activate 
    $(document).on('click', '.inactive', function() {

        var inactive_status = $(this).data('inactive-status');
        var inactive_userid = $(this).data('user-id');
        // alert(userid)

       var inactive_alert = confirm('you confirm to DeActivated user');

       if(inactive_alert)
       {
        $.ajax({
            type: "post",
            url: "common.php",
            data: {
                'status_inactive': inactive_status,
                'user_id': inactive_userid,
                action: 'inActive',
            },
            dataType: "JSON",
            success: function(response) {

                if (response == 120) {
                    swal('User', 'DeActivated successfully', 'success');
                    setInterval(function() {
                        window.location.reload();
                    }, 2000);
                }

            }
        });
       }
    });

// inactivate
    $(document).on('click', '.active_user', function() {

        var active_user_id = $(this).data('user-id');

        var active_alert = confirm('you confirm to Activate user');

       if(active_alert)
       {
        $.ajax({
            type: "post",
            url: "common.php",
            data: {
                'active_user_id': active_user_id,
                action: 'active',
            },
            dataType: "JSON",
            success: function(response) {
                if (response == 150) {
                    swal('User', 'Activated Successfully', 'success');
                    setInterval(function() {

                        window.location.reload();
                    }, 2000);
                }
            }
        });
       }

    })

    
   
    $(document).on('click','#addnewsubmit',function(){

      var add_form = $('#addFrom').serializeArray();

           $.ajax({
            type: "post",
            url: "addviewForm.php",
            data: {
              'addFormData':add_form ,
            },
            dataType: "JSON",
            success: function (response) {
                
                if(response==100)
                {
                  var confirm_alert =  confirm('check your details');
                  if(confirm_alert)
                  {
                    $("#exampleModalLong").modal('#exampleModalLong');
                  }
                  else{
                    window.location.href = 'user.php';
                  }
                }
                else if(response==200)
                {
                    swal('User','Add user successfully' , 'success');
                    setInterval(function()
                    {
                        window.location.href = 'user.php';
                    },2000)
                }
            }
           });

          
    })
</script>