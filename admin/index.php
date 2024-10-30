
<!DOCTYPE html>
<html lang="en">

<!-- Added by HTTrack -->
<meta http-equiv="content-type" content="text/html;charset=utf-8" /><!-- /Added by HTTrack -->

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Colour-Cash</title>

    

    <!-- GLOBAL STYLES -->
    <link href="assets/css/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href='https://fonts.googleapis.com/css?family=Ubuntu:300,400,500,700,300italic,400italic,500italic,700italic' rel="stylesheet" type="text/css">
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800' rel="stylesheet" type="text/css">
    <link href="assets/icons/font-awesome/css/font-awesome.min.css" rel="stylesheet">

    <!-- PAGE LEVEL PLUGIN STYLES -->

    <!-- THEME STYLES -->
    <link href="assets/css/flex-admin.css" rel="stylesheet">
    <link href="assets/css/plugins.css" rel="stylesheet">

    <!-- THEME DEMO STYLES -->
    <link href="assets/css/demo.css" rel="stylesheet">

    <!--[if lt IE 9]>
    <script src="js/html5shiv.js"></script>
    <script src="js/respond.min.js"></script>
    <![endif]-->


    <style>
        .login{
            background-image: linear-gradient(to right,rgb(91,101,128),rgb(175,192,148),rgb(91,101,128) );
        }
       
       
    </style>

</head>

<body class="login">

    <div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">

                <div class="login-banner text-center">
                    <h1 style="color: rgb(94,104,128);"><i class="fa fa-gears" ></i><b>Admin</b></h1>
                </div>
         
              
                 <?php
                 if(isset($_GET['ret_msg']))
                 {
                    ?>
                         <p class="alert  alert-danger" style="text-align: center;">E-mail & Password Missmatch Error</p>
                    <?php

                 }
                 ?>
                   
              

                <div class="portlet portlet-green" style="border: solid rgb(100,111,130);">
                    <div class="portlet-heading login-heading" style="  background-color:rgb(100,111,130);">
                        <div class="portlet-title">
                            <h4><strong>Login to Colour-Cash Admin!</strong>
                            </h4>
                        </div>

                        <!-- <div class="portlet-widgets">
                            <button class="btn btn-white btn-xs"><i class="fa fa-plus-circle"></i>New User</button>
                        </div> -->
                        <div class="clearfix"></div>
                    </div>

                    <div class="portlet-body">

                        <form accept-charset="UTF-8" action="login.php" method="post" role="form">

                            <fieldset>
                                <div class="form-group">
                                    <input class="form-control" placeholder="E-mail" name="email" type="text">
                                </div>
                                <div class="form-group">
                                    <input class="form-control" placeholder="Password" name="password" type="password" id="login_pass" value="">
                                </div>
                                <div class="checkbox">
                                    <label>
                                        <input style="border:1px solid rgb(91,101,128);" name="remember" type="checkbox" onclick="checkbox_function()" value="Remember Me">Remember Me
                                    </label>
                                </div>
                                <br>
                                <!-- <a href="index.html" class="btn btn-lg btn-green btn-block">Sign In</a> -->
                                <button type="submit" name="submit"  class="btn btn-lg btn-green btn-block " style=" border:solid rgb(100,111,130); background-color:rgb(100,111,130); ">Login</button>
                            </fieldset>
                            <!-- <br>
                            <p class="small">
                                <a href="#">Forgot your password?</a>
                            </p> -->
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- GLOBAL SCRIPTS -->
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/js/plugins/bootstrap/bootstrap.min.js"></script>
    <script src="assets/js/plugins/slimscroll/jquery.slimscroll.min.js"></script>
    <!-- HISRC Retina Images -->
    <script src="assets/js/plugins/hisrc/hisrc.js"></script>

    <!-- PAGE LEVEL PLUGIN SCRIPTS -->

    <!-- THEME SCRIPTS -->
    <script src="assets/js/flex.js"></script>


    <script>
    function checkbox_function() {
        var check_box = document.getElementById('login_pass')
        if (check_box.type === 'password') {
            check_box.type = 'text';
        } else {
            check_box.type = 'password';
        }
    }
</script>

</body>

</html>

 












