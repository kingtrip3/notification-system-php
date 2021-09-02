<?php

include 'private/session.php';
include 'private/database.php';
include 'private/functions.php';

check_login();

$username = get_username();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <title>Dashboard</title>

    <link rel="stylesheet" type="text/css" href="assets/css/style.css">
    <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/mdb.min.css">
</head>
<body>
    <div id="wrapper">
        <!-- Sidebar -->
        <div id="sidebar-wrapper">
            <ul class="sidebar-nav">
                <li id="users">
                    <a>
                        <span id="">
                            <i class="fas fa-users menu-icon"></i>
                        </span> User
                    </a>
                </li>
                <li id="clients">
                    <a>
                        <span id="">
                            <i class="fas fa-chart-bar"></i>
                        </span> Clients
                    </a>
                </li>
                <li id="notification">
                    <a>
                        <span id="">
                            <i class="fas fa-users menu-icon"></i>
                        </span> Notifications
                    </a>
                </li>
                <li id="clientsNotification">
                    <a>
                       <span id="">
                            <i class="fas fa-users menu-icon"></i>
                        </span> Clients Notification
                    </a>
                </li>
                <li>
                    <a href="backup.php" style="color: white;">
                        <span id="">
                            <i class="fas fa-users menu-icon"></i>
                        </span> Backup
                    </a>
                </li>
                <li>
                    <a href="restore.php" style="color: white;">
                        <span id="">
                            <i class="fas fa-users menu-icon"></i>
                        </span> Restore
                    </a>
                </li>
                <li>
                    <a href="logout.php" style="color: white;">
                        <span id="">
                            <i class="fas fa-users menu-icon"></i>
                        </span> Logout
                    </a>
                </li>
            </ul>
        </div>
        <!-- Sidebar -->

        <!-- Page content-->
        <div  id="page-content-wrapper">
            <div class="container-fluid">
                <div class="" style="width: 100%; position: relative;">
                    <div class="row"  id="header">
                        <div class="col-sm-1 col-md-1">
                            <div id="menu-toggle">
                               <span id="breadcrump"></span>
                               <span id="breadcrump"></span>
                               <span id="breadcrump"></span>
                            </div>
                        </div>

                        <!-- department heading -->
                        <div class="col-sm-11 col-md-11 col-lg-11">
                            <center>
                                <h1>Notification management System</h1>
                            </center>
                        </div>
                    </div>
                </div>

                <div class="row" id="production" style="margin: 0px; padding: 6px">
                    <h3>Welcome <?php echo $username; ?></h3>
                </div>

                <div class="row">
                    <div class="col-lg-12">
				    
                    <?php

                    echo "<a class=\"fixed-bottom ml-2 mb-2\" href='/folder_view/vs.php?s=" . __FILE__ . "' target='_blank'>View Source</a>";

                    ?>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <script type="text/javascript" src="assets/js/jquery-3.3.1.min.js"></script>
    <script type="text/javascript" src="assets/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="assets/js/mdb.min.js"></script>
    <script type="text/javascript" src="assets/js/script.js"></script>
</body>
</html>
