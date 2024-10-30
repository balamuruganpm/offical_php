<?php
session_start();

$user_name = "";

if (isset($_SESSION['u_name'])) {
    $user_name = $_SESSION['u_name'];
}
?>


<!DOCTYPE html>
<html lang="en">

<!-- Added by HTTrack -->
<meta http-equiv="content-type" content="text/html;charset=utf-8" /><!-- /Added by HTTrack -->

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Colour Cash - Admin Theme</title>

    <link rel="icon" href="assets/img/Colorcashlogo.png" type="image/x-icon" heu>
    <!-- GLOBAL STYLES - Include these on every page. -->
    <link href="assets/css/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href='https://fonts.googleapis.com/css?family=Ubuntu:300,400,500,700,300italic,400italic,500italic,700italic' rel="stylesheet" type="text/css">
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800' rel="stylesheet" type="text/css">
    <link href="assets/icons/font-awesome/css/font-awesome.min.css" rel="stylesheet">

    <!-- PAGE LEVEL PLUGIN STYLES -->

    <link href="assets/css/plugins/datatables/datatables.css" rel="stylesheet">


    <!-- ck editor -->
    <script src="https://cdn.ckeditor.com/4.9.2/standard/ckeditor.js"></script>

    <!-- THEME STYLES - Include these on every page. -->
    <link href="assets/css/flex-admin.css" rel="stylesheet">
    <link href="assets/css/plugins.css" rel="stylesheet">
    <link href="assets/css/demo.css" rel="stylesheet">
    <!-- font awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">


    <script src="https://cdn.ckeditor.com/4.9.2/standard/ckeditor.js"></script>


    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>


    <!-- previous $ next  -->
    <link href='https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css' rel='stylesheet' type='text/css'>
    <link href='https://cdn.datatables.net/buttons/2.2.3/css/buttons.dataTables.min.css' rel='stylesheet' type='text/css'>

    <style>
        .navbar-top {
            background-color: rgb(62, 62, 60);
        }
    </style>

    <!-- 
    <style>
        .daterangepicker td.active,
        .daterangepicker td.active:hover {
            background-color: #16a085;
            border-color: #16a085;
            color: #fff;
        }

        .daterangepicker .ranges li.active,
        .daterangepicker .ranges li:hover {
            background: #16a085;
            border: 1px solid #16a085;
            color: #fff;
        }

        .daterangepicker .ranges li {
            color: #16a085;
        }
    </style> -->

</head>

<body>

    <div id="wrapper">

        <!-- begin TOP NAVIGATION -->
        <nav class="navbar-top" role="navigation">

            <!-- begin BRAND HEADING -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle pull-right" data-toggle="collapse" data-target=".sidebar-collapse">
                    <i class="fa fa-bars "></i>
                </button>
                <div class="navbar-brand">
                    <!-- <a href="index.php">
                        <img src="assets/img/flex-admin-logo.png" data-1x="assets/img/flex-admin-logo.png" data-2x="assets/img/flex-admin-logo.png" class="hisrc img-responsive" alt="">
                    </a> -->
                    <span style="color: #fff;margin-left:50px; font-family: sans-serif; ">Colour Cash</span>
                </div>
            </div>
            <!-- end BRAND HEADING -->

            <div class="nav-top">

                <!-- begin LEFT SIDE WIDGETS -->
                <ul class="nav navbar-left">
                    <li class="tooltip-sidebar-toggle">
                        <a href="#" id="sidebar-toggle" data-toggle="tooltip" data-placement="right" title="Sidebar Toggle">
                            <i class="fa fa-bars"></i>
                        </a>
                    </li>
                    <!-- You may add more widgets here using <li> -->
                </ul>

                <ul class="nav navbar-right">

                    <!-- begin MESSAGES DROPDOWN -->
                    <li class="dropdown">


                        <!-- massage start -->
                        <!-- <a href="#" class="messages-link dropdown-toggle" data-toggle="dropdown">
                            <i class="fa fa-envelope"></i>
                            <span class="number">4</span> <i class="fa fa-caret-down"></i>
                        </a> -->



                        <ul class="dropdown-menu dropdown-scroll dropdown-messages">

                            <!-- Messages Dropdown Heading -->
                            <li class="dropdown-header">
                                <i class="fa fa-envelope"></i> 4 New Messages
                            </li>

                            <!-- Messages Dropdown Body - This is contained within a SlimScroll fixed height box. You can change the height using the SlimScroll jQuery features. -->
                            <li id="messageScroll">
                                <ul class="list-unstyled">
                                    <li>
                                        <a href="#">
                                            <div class="row">
                                                <div class="col-xs-2">
                                                    <img class="img-circle" src="#" alt="logoimg">
                                                </div>
                                                <div class="col-xs-10">
                                                    <p>
                                                        <strong>Jane Smith</strong>: Hi again! I wanted to let you know
                                                        that the order...
                                                    </p>
                                                    <p class="small">
                                                        <i class="fa fa-clock-o"></i> 12 minutes ago
                                                    </p>
                                                </div>
                                            </div>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <div class="row">
                                                <div class="col-xs-2">
                                                    <img class="img-circle" src="assets/img/user-profile-2.jpg" alt="">
                                                </div>
                                                <div class="col-xs-10">
                                                    <p>
                                                        <strong>Roddy Austin</strong>: Thanks for the info, if you need
                                                        anything from...
                                                    </p>
                                                    <p class="small">
                                                        <i class="fa fa-clock-o"></i> 3:39 PM
                                                    </p>
                                                </div>
                                            </div>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <div class="row">
                                                <div class="col-xs-2">
                                                    <img class="img-circle" src="assets/img/user-profile-3.jpg" alt="">
                                                </div>
                                                <div class="col-xs-10">
                                                    <p>
                                                        <strong>Stacy Gibson</strong>: Hey, what was the purchase order
                                                        number for the...
                                                    </p>
                                                    <p class="small">
                                                        <i class="fa fa-clock-o"></i> Yesterday at 10:23 AM
                                                    </p>
                                                </div>
                                            </div>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <div class="row">
                                                <div class="col-xs-2">
                                                    <img class="img-circle" src="assets/img/user-profile-4.jpg" alt="">
                                                </div>
                                                <div class="col-xs-10">
                                                    <p>
                                                        <strong>Jeffrey Cortez</strong>: Check out this video I found
                                                        the other day, it's...
                                                    </p>
                                                    <p class="small">
                                                        <i class="fa fa-clock-o"></i> Tuesday at 12:23 PM
                                                    </p>
                                                </div>
                                            </div>
                                        </a>
                                    </li>
                                </ul>
                            </li>

                            <!-- Messages Dropdown Footer -->
                            <li class="dropdown-footer">
                                <a href="mailbox.html">Read All Messages</a>
                            </li>

                        </ul>
                        <!-- /.dropdown-menu -->
                    </li>
                    <!-- end MESSAGES DROPDOWN -->

                    <!-- begin ALERTS DROPDOWN -->
                    <li class="dropdown">
                        <a href="#" class="alerts-link dropdown-toggle" data-toggle="dropdown">
                            <i class="fa fa-bell"></i>
                            <span class="number">9</span><i class="fa fa-caret-down"></i>
                        </a>
                        <ul class="dropdown-menu dropdown-scroll dropdown-alerts">

                            <!-- Alerts Dropdown Heading -->
                            <li class="dropdown-header">
                                <i class="fa fa-bell"></i> 9 New Alerts
                            </li>

                            <!-- Alerts Dropdown Body - This is contained within a SlimScroll fixed height box. You can change the height using the SlimScroll jQuery features. -->
                            <li id="alertScroll">
                                <ul class="list-unstyled">
                                    <li>
                                        <a href="#">
                                            <div class="alert-icon green pull-left">
                                                <i class="fa fa-money"></i>
                                            </div>
                                            Order #2931 Received
                                            <span class="small pull-right">
                                                <strong>
                                                    <em>3 minutes ago</em>
                                                </strong>
                                            </span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <div class="alert-icon blue pull-left">
                                                <i class="fa fa-comment"></i>
                                            </div>
                                            New Comments
                                            <span class="badge blue pull-right">15</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <div class="alert-icon orange pull-left">
                                                <i class="fa fa-wrench"></i>
                                            </div>
                                            Crawl Errors Detected
                                            <span class="badge orange pull-right">3</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <div class="alert-icon yellow pull-left">
                                                <i class="fa fa-question-circle"></i>
                                            </div>
                                            Server #2 Not Responding
                                            <span class="small pull-right">
                                                <strong>
                                                    <em>5:25 PM</em>
                                                </strong>
                                            </span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <div class="alert-icon red pull-left">
                                                <i class="fa fa-bolt"></i>
                                            </div>
                                            Server #4 Crashed
                                            <span class="small pull-right">
                                                <strong>
                                                    <em>3:34 PM</em>
                                                </strong>
                                            </span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <div class="alert-icon green pull-left">
                                                <i class="fa fa-plus-circle"></i>
                                            </div>
                                            New Users
                                            <span class="badge green pull-right">5</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <div class="alert-icon orange pull-left">
                                                <i class="fa fa-download"></i>
                                            </div>
                                            Downloads
                                            <span class="badge orange pull-right">16</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <div class="alert-icon purple pull-left">
                                                <i class="fa fa-cloud-upload"></i>
                                            </div>
                                            Server #8 Rebooted
                                            <span class="small pull-right">
                                                <strong>
                                                    <em>12 hours ago</em>
                                                </strong>
                                            </span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <div class="alert-icon red pull-left">
                                                <i class="fa fa-bolt"></i>
                                            </div>
                                            Server #8 Crashed
                                            <span class="small pull-right">
                                                <strong>
                                                    <em>12 hours ago</em>
                                                </strong>
                                            </span>
                                        </a>
                                    </li>
                                </ul>
                            </li>

                            <!-- Alerts Dropdown Footer -->
                            <li class="dropdown-footer">
                                <a href="#">View All Alerts</a>
                            </li>

                        </ul>
                        <!-- /.dropdown-menu -->
                    </li>
                    <!-- /.dropdown -->
                    <!-- end ALERTS DROPDOWN -->

                    <!-- begin TASKS DROPDOWN -->
                    <li class="dropdown">
                        <!-- massage start -->
                        <!-- <a href="#" class="tasks-link dropdown-toggle" data-toggle=dropdown><i class="fa fa-tasks"></i><span class=number>10</span><i class="fa fa-caret-down"></i> </a> -->
                        <ul class="dropdown-menu dropdown-scroll dropdown-tasks">

                            <!-- Tasks Dropdown Header -->
                            <li class="dropdown-header">
                                <i class="fa fa-tasks"></i> 10 Pending Tasks
                            </li>

                            <!-- Tasks Dropdown Body - This is contained within a SlimScroll fixed height box. You can change the height using the SlimScroll jQuery features. -->
                            <li id="taskScroll">
                                <ul class="list-unstyled">
                                    <li>
                                        <a href="#">
                                            <p>
                                                Software Update 2.1
                                                <span class="pull-right">
                                                    <strong>60%</strong>
                                                </span>
                                            </p>
                                            <div class="progress">
                                                <div class="progress-bar" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 60%;"></div>
                                            </div>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <p>
                                                Server #2 Hardware Upgrade
                                                <span class="pull-right">
                                                    <strong>90%</strong>
                                                </span>
                                            </p>
                                            <div class="progress progress-striped">
                                                <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="90" aria-valuemin="0" aria-valuemax="100" style="width: 90%;"></div>
                                            </div>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <p>
                                                Call Ticket #2032
                                                <span class="pull-right">
                                                    <strong>72%</strong>
                                                </span>
                                            </p>
                                            <div class="progress progress-striped active">
                                                <div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="72" aria-valuemin="0" aria-valuemax="100" style="width: 72%;"></div>
                                            </div>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <p>
                                                Emergency Maintenance
                                                <span class="pull-right">
                                                    <strong>36%</strong>
                                                </span>
                                            </p>
                                            <div class="progress progress-striped">
                                                <div class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow="36" aria-valuemin="0" aria-valuemax="100" style="width: 36%;"></div>
                                            </div>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <p>
                                                Purchase Order #439
                                                <span class="pull-right">
                                                    <strong>52%</strong>
                                                </span>
                                            </p>
                                            <div class="progress progress-striped">
                                                <div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="52" aria-valuemin="0" aria-valuemax="100" style="width: 52%;"></div>
                                            </div>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <p>
                                                March Content Update
                                                <span class="pull-right">
                                                    <strong>14%</strong>
                                                </span>
                                            </p>
                                            <div class="progress">
                                                <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="14" aria-valuemin="0" aria-valuemax="100" style="width: 14%;"></div>
                                            </div>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <p>
                                                Client #42 Data Scrubbing
                                                <span class="pull-right">
                                                    <strong>68%</strong>
                                                </span>
                                            </p>
                                            <div class="progress progress-striped">
                                                <div class="progress-bar" role="progressbar" aria-valuenow="68" aria-valuemin="0" aria-valuemax="100" style="width: 68%;"></div>
                                            </div>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <p>
                                                PHP Upgrade Server #6
                                                <span class="pull-right">
                                                    <strong>85%</strong>
                                                </span>
                                            </p>
                                            <div class="progress">
                                                <div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="85" aria-valuemin="0" aria-valuemax="100" style="width: 85%;"></div>
                                            </div>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <p>
                                                Malware Scan
                                                <span class="pull-right">
                                                    <strong>66%</strong>
                                                </span>
                                            </p>
                                            <div class="progress progress-striped active">
                                                <div class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow="66" aria-valuemin="0" aria-valuemax="100" style="width: 66%;"></div>
                                            </div>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <p>
                                                New Employee Intake
                                                <span class="pull-right">
                                                    <strong>98%</strong>
                                                </span>
                                            </p>
                                            <div class="progress progress-striped active">
                                                <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="14" aria-valuemin="0" aria-valuemax="100" style="width: 98%;"></div>
                                            </div>
                                        </a>
                                    </li>
                                </ul>
                            </li>

                            <!-- Tasks Dropdown Footer -->
                            <li class="dropdown-footer">
                                <a href="#">View All Tasks</a>
                            </li>

                        </ul>

                    </li>
                    <!-- /.dropdown -->
                    <!-- end TASKS DROPDOWN -->

                    <!-- begin USER ACTIONS DROPDOWN -->
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <i class="fa fa-user "></i> <i class="fa fa-caret-down "></i>
                        </a>
                        <ul class="dropdown-menu dropdown-user">
                            <!-- <li>
                                <a href="profile.html">
                                    <i class="fa fa-user"></i> My Profile
                                </a>
                            </li>
                            <li>
                                <a href="mailbox.html">
                                    <i class="fa fa-envelope"></i> My Messages
                                    <span class="badge green pull-right">4</span>
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <i class="fa fa-bell"></i> My Alerts
                                    <span class="badge orange pull-right">9</span>
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <i class="fa fa-tasks"></i> My Tasks
                                    <span class="badge blue pull-right">10</span>
                                </a>
                            </li>
                            <li>
                                <a href="calendar.html">
                                    <i class="fa fa-calendar"></i> My Calendar
                                </a>
                            </li>
                            <li class="divider"></li>
                            <li>
                                <a href="#">
                                    <i class="fa fa-gear"></i> Settings
                                </a>
                            </li> -->
                            <li>
                                <a class="logout_open" href="logout.php">
                                    <i class="fa fa-sign-out"></i> Logout
                                    <strong><?php echo $user_name ?></strong>
                                </a>
                            </li>
                        </ul>
                        <!-- /.dropdown-menu -->
                    </li>
                    <!-- /.dropdown -->
                    <!-- end USER ACTIONS DROPDOWN -->

                </ul>

            </div>

        </nav>

        <nav class="navbar-side" role="navigation">
            <div class="navbar-collapse sidebar-collapse collapse">
                <ul id="side" class="nav navbar-nav side-nav" style="background-color: rgb(140,133,127);">
                    <!-- begin SIDE NAV USER PANEL -->
                    <li class="side-user hidden-xs">
                        <img class="img-circle" src="assets/img/profile-pic.jpg" alt="">
                        <p class="welcome">
                            <i class="fa fa-key"></i> Logged in as
                        </p>
                        <p class="name tooltip-sidebar-logout">


                            <?php echo $user_name  ?><br>
                            <span class="last-name">Logout</span> <a style="color: inherit" class="logout_open" href="#logout" data-toggle="tooltip" data-placement="top" title="Logout"><i class="fa fa-sign-out"></i></a>
                        </p>
                        <div class="clearfix"></div>
                    </li>
                    <!-- end SIDE NAV USER PANEL -->
                    <!-- begin SIDE NAV SEARCH -->
                    <!-- <li class="nav-search">
                        <form role="form">
                            <input type="search" class="form-control" placeholder="Search...">
                            <button class="btn">
                                <i class="fa fa-search"></i>
                            </button>
                        </form>
                    </li> -->
                    <!-- //////////////sales naves Start///////// -->

                    <!-- sales start -->



                    <!-- <li class="panel">
                            <a href="#" data-parent="#side" data-toggle="collapse" class="accordion-toggle" data-target="#charts">
                                 <i class="fa fa-bar-chart-o"></i> Dashboard
                                 <i class="fa fa-caret-down"></i> 
                            </a>
                            <ul class="collapse nav" id="charts">
                                <li>
                                    <a href="#">
                                        <i class="fa fa-angle-double-right"></i> User Management
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <i class="fa fa-angle-double-right"></i> Betting Records
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <i class="fa fa-angle-double-right"></i>Revenue Management
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <i class="fa fa-angle-double-right"></i>Withdrawal Management
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <i class="fa fa-angle-double-right"></i>Bonus Management
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <i class="fa fa-angle-double-right"></i>Game Management
                                    </a>
                                </li>
                                <li>
                                    <a href="banner.php">
                                        <i class="fa fa-angle-double-right"></i>Banner Management
                                    </a>
                                </li>
                                <li>
                                    <a href="product-management.php">
                                        <i class="fa fa-angle-double-right"></i>Product Management
                                    </a>
                                </li>
                            </ul>
                        </li> -->

                    <li>
                        <a href="dashboard.php">
                            <i class="fa fa-bar-chart-o"></i>Dashboard
                        </a>
                    </li>
                    <li>
                        <a href="user.php">
                            <i class="fa fa-users"></i>Users
                        </a>
                    </li>
                    <li>
                        <a href="gamelist.php">
                            <i class="fa-solid fa-gamepad"></i> Game List
                        </a>
                    </li>

                    <!-- <li class="panel">
                            <a href="user.php" data-parent="#side" data-toggle="collapse" class="accordion-toggle" data-target="#charts">
                                 <i class="fa fa-bar-chart-o"></i> Users
                                 <i class="fa fa-caret-down"></i> 
                            </a>
                            <ul class="collapse nav" id="charts">
                                <li>
                                    <a href="create_lead.php">
                                        <i class="fa fa-angle-double-right"></i> New Lead Entry
                                    </a>
                                </li>
                                <li>
                                    <a href="lead_followup.php">
                                        <i class="fa fa-angle-double-right"></i> Lead follow ups
                                    </a>
                                </li>
                                <li>
                                    <a href="closed_lead.php">
                                        <i class="fa fa-angle-double-right"></i> Closed Leads
                                    </a>
                                </li>
                            </ul>
                        </li> -->
                    <li>
                        <a href="betting.php">
                            <i class="fa fa-money"></i>Betting Management
                        </a>
                    </li>
                          <li>
                        <a href="bonus.php">
                        <i class="fa-solid fa-tag"></i> Bonus Management
                        </a>
                    </li>
                    <li>
                     
                         <a href="javascript:;" data-parent="#side" data-toggle="collapse" class="accordion-toggle" data-target="#withdraw">
                                <i class="fa fa-money"></i>Withdrawal Management
                                 <i class="fa fa-caret-down"></i> 
                            </a>
                            <ul class="collapse nav" id="withdraw">
                                <li>
                                    <a href="withdrwal_pending.php">
                                        <i class="fa fa-angle-double-right"></i> Withdrawal Pending
                                    </a>
                                </li>
                                <li>
                                    <a href="withdrawal.php">
                                        <i class="fa fa-angle-double-right"></i> Withdrawal Approved
                                    </a>
                                </li>
                                <li>
                                    <a href="withdraw_reject.php">
                                        <i class="fa fa-angle-double-right"></i> Withdrawal Reject
                                    </a>
                                </li>
                                
                            </ul>
                    </li>
                    <li>
                        <a href="product-management.php">
                            <i class="fa fa-shopping-cart"></i>Product Management
                        </a>
                    </li>
                    <li>
                        <a href="payments.php">
                            <i class="fa fa-calendar"></i>Payments
                        </a>
                    </li>
                    
                    <li>
                        <a href="complaints.php">
                            <i class="fa fa-calendar"></i>Complains & Suggestions
                        </a>
                    </li>
                    
                    <!--<li>-->
                    <!--    <a href="#">-->
                    <!--        <i class="fa fa-calendar"></i>Earnings-->
                    <!--    </a>-->
                    <!--</li>-->
                    <!-- <li>
                        <a href="#">
                            <i class="fa fa-calendar"></i>Referral
                        </a>
                    </li> -->
                    <li class="panel">
                        <a href="javascript:;" data-parent="#side" data-toggle="collapse" class="accordion-toggle" data-target="#csssssss">
                            <i class="fa fa-money" aria-hidden="true"></i> Recharge Management<i class="fa fa-caret-down"></i>
                        </a>
                        <ul class="collapse nav" id="csssssss">
                            <li>
                                <a href="pendingRecharge.php">
                                    <i class="fa fa-angle-double-right"></i> Reacharge Pending
                                </a>
                            </li>
                            <li>
                                <a href="rechargeComplete.php">
                                    <i class="fa fa-angle-double-right"></i> Reacharge Complete
                                </a>
                            </li>
                            <li>
                                <a href="rejectRecharge.php">
                                    <i class="fa fa-angle-double-right"></i> Reacharge Failed
                                </a>
                            </li>
                            
                        </ul>
                    </li>
                    <li class="panel">
                        <a href="javascript:;" data-parent="#side" data-toggle="collapse" class="accordion-toggle" data-target="#cssssss">
                            <i class="fa fa-link" aria-hidden="true"></i> Reports<i class="fa fa-caret-down"></i>
                        </a>
                        <ul class="collapse nav" id="cssssss">
                            <li>
                                <a href="userReport.php">
                                    <i class="fa fa-angle-double-right"></i>User Report
                                </a>
                            </li>
                            <li>
                                <a href="bettingReport.php">
                                    <i class="fa fa-angle-double-right"></i> Betting Report
                                </a>
                            </li>
                            <!-- <li>
                                <a href="referralReport.php">
                                    <i class="fa fa-angle-double-right"></i>Referral Report
                                </a>
                            </li> -->
                            <li>
                                <a href="paymentsReport-User.php">
                                    <i class="fa fa-angle-double-right"></i> Payments Report- User
                                </a>
                            </li>
                            <li>
                                <a href="withdrawalReport.php">
                                    <i class="fa fa-angle-double-right"></i> Withdrawal Report
                                </a>
                            </li>
                            <!--<li>-->
                            <!--    <a href="earningsReport.php">-->
                            <!--        <i class="fa fa-angle-double-right"></i> Earnings Report-->
                            <!--    </a>-->
                            <!--</li>-->
                            <li>
                                <a href="gameReport.php">
                                    <i class="fa fa-angle-double-right"></i> Game Report
                                </a>
                            </li>
                        </ul>
                    </li>

                    <li class="panel">
                        <a href="javascript:;" data-parent="#side" data-toggle="collapse" class="accordion-toggle" data-target="#cssss">
                        <i class="fa-solid fa-house" aria-hidden="true"></i> Home page settings<i class="fa fa-caret-down"></i>
                        </a>
                        <ul class="collapse nav" id="cssss">
                            <li>
                                <a href="banner.php">
                                    <i class="fa fa-angle-double-right"></i>Banner
                                </a>
                            </li>        
                        </ul>
                    </li>



                    <!-- <li>
                        <a href="#">
                            <i class="fa fa-calendar"></i>Notifications
                        </a>

                    </li> -->
                    <!-- <li>
                        <a href="setting.php">
                            <i class="fa fa-gear"></i>Setting <i class="fa fa-caret-down"></i>
                        </a>


                    </li> -->


                    <li class="">   
                        <a class="" href="changepassword.php">
                            <i class="fa fa-key"></i>Change Password
                        </a>
                    </li>

                <li class="panel">
                            <a href="javascript:;" data-parent="#side" data-toggle="collapse" class="accordion-toggle" data-target="#charts">
                                 <i class="fa fa-gear"></i> Settings
                                 <i class="fa fa-caret-down"></i> 
                            </a>
                            <ul class="collapse nav" id="charts">
                                <li>
                                    <a href="about_us.php">
                                        <i class="fa fa-angle-double-right"></i> About Us
                                    </a>
                                </li>
                                <li>
                                    <a href="privacy_policy.php">
                                        <i class="fa fa-angle-double-right"></i> Privacy Policy
                                    </a>
                                </li>
                                <li>
                                    <a href="terms_cons.php">
                                        <i class="fa fa-angle-double-right"></i>Terms And Condition
                                    </a>
                                </li>
                                <li>
                                    <a href="agreement.php">
                                        <i class="fa fa-angle-double-right"></i>Agreement risk
                                    </a>
                                </li>
                                
                            </ul>
                        </li> 





                    <!-- //////////////sales end///////// -->




                </ul>
            </div>
        </nav>


        <div id="page-wrapper" style="border: 1px solid black; ">

            <div class="page-content">