<?php
/*
 * Created on Tue May 11 2021
 *
 * The MIT License (MIT)
 * Copyright (c) 2021 MartDevelopers Inc
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy of this software
 * and associated documentation files (the "Software"), to deal in the Software without restriction,
 * including without limitation the rights to use, copy, modify, merge, publish, distribute, sublicense,
 * and/or sell copies of the Software, and to permit persons to whom the Software is furnished to do so,
 * subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in all copies or substantial
 * portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED
 * TO THE WARRANTIES OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL
 * THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT,
 * TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.
 */

session_start();
require_once('../config/config.php');
require_once('../config/checklogin.php');
require_once('../config/codeGen.php');
client_login();

/* Clear Notifications */
if (isset($_GET['clear_notification'])) {
    $id = $_GET['clear_notification'];
    $adn = "DELETE FROM NucleusSAASERP_UserNotifications  WHERE  id =?";
    $stmt = $mysqli->prepare($adn);
    $stmt->bind_param('s', $id);
    $stmt->execute();
    $stmt->close();
    if ($stmt) {
        $success = "Cleared" && header("refresh:1; url=client-notifications.php");
    } else {
        $info = "Please Try Again Or Try Later";
    }
}
require_once('../partials/dashboard_head.php');
?>

<body class="application application-offset">
    <!-- Application container -->
    <div class="container-fluid container-application">
        <!-- Sidenav -->
        <?php require_once('../partials/dashboard_sidenav.php'); ?>
        <!-- Content -->
        <div class="main-content position-relative">
            <!-- Main nav -->
            <?php
            require_once('../partials/dashboard_main_nav.php');
            $id = $_SESSION['id'];
            $email = $_SESSION['email'];
            $ret = "SELECT * FROM `NucleusSAASERP_Users` WHERE id = '$id' OR email = '$email' ";
            $stmt = $mysqli->prepare($ret);
            $stmt->execute(); //ok
            $res = $stmt->get_result();
            while ($client = $res->fetch_object()) {
            ?>
                <!-- Page content -->
                <div class="page-content">
                    <!-- Page title -->
                    <div class="page-title">
                        <div class="row justify-content-between align-items-center">
                            <div class="col-md-6 d-flex align-items-center justify-content-between justify-content-md-start mb-3 mb-md-0">
                                <!-- Page title + Go Back button -->
                                <div class="d-inline-block">
                                    <h5 class="h4 d-inline-block font-weight-400 mb-0 text-white">Notifications</h5>
                                </div>
                                <!-- Additional info -->
                            </div>
                            <div class="col-md-6 d-flex align-items-center justify-content-between justify-content-md-end">
                            </div>
                        </div>
                    </div>
                    <!-- Stats -->
                    <br>
                    <div class="col-md-12 col-lg-12 col-sm-12">
                        <!-- Notifications -->
                        <div class="card card-fluid">
                            <div class="list-group list-group-flush">
                                <?php
                                $ret = "SELECT * FROM `NucleusSAASERP_UserNotifications` WHERE client_id = '$id' OR client_email = '$email'  ";
                                $stmt = $mysqli->prepare($ret);
                                $stmt->execute(); //ok
                                $res = $stmt->get_result();
                                while ($notif = $res->fetch_object()) {
                                ?>
                                    <?php

                                    $rowperpage = 3;

                                    /* Counting All Notifications */
                                    $allcount_query = "SELECT count(*) AS allcount FROM NucleusSAASERP_UserNotifications WHERE client_id = '$id' OR client_email = '$email' ORDER BY `NucleusSAASERP_UserNotifications`.`created_at` DESC ";
                                    $allcount_result = mysqli_query($mysqli, $allcount_query);
                                    $allcount_fetch = mysqli_fetch_array($allcount_result);
                                    $allcount = $allcount_fetch['allcount'];

                                    /* Load First 8 Notificatons */
                                    $query = "SELECT * FROM  NucleusSAASERP_UserNotifications WHERE client_id = '$id' OR client_email = '$email' ORDER BY `NucleusSAASERP_UserNotifications`.`created_at` DESC  LIMIT 0, $rowperpage ";
                                    $result = mysqli_query($mysqli, $query);

                                    while ($row = mysqli_fetch_array($result)) {

                                        $id = $row['id'];
                                        $notifdetails = $row['notification_from'];
                                        $created_at = $row['created_at'];
                                        $notification_details = $row['notification_details'];

                                    ?>
                                        <div id="notification_<?php echo $id; ?>">
                                            <a href="#clear-notification-<?php echo $id; ?>" data-toggle="modal" class="list-group-item list-group-item-action">
                                                <div class="d-flex align-items-center" data-toggle="tooltip" data-placement="right" data-title="<?php echo date('d M Y g:ia', strtotime($created_at)); ?>">
                                                    <div>
                                                        <span class="avatar bg-primary text-white rounded-circle">
                                                            <?php echo substr($notifdetails, 0, 4); ?>
                                                        </span>
                                                    </div>
                                                    <div class="flex-fill ml-3">
                                                        <div class="h6 text-sm mb-0"><?php echo $notifdetails; ?> <small class="float-right text-muted"><?php echo date('d M Y g:ia', strtotime($created_at)); ?></small></div>
                                                        <p class="text-sm lh-140 mb-0">
                                                            <?php echo $notification_details; ?>
                                                        </p>
                                                    </div>
                                                </div>
                                            </a>
                                            <!-- Confirm Clear -->
                                            <div class="modal fade" id="clear-notification-<?php echo $id; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel">CONFIRM DELETE</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body text-center text-danger">
                                                            <h4>Clear Notification ?</h4>
                                                            <br>
                                                            <button type="button" class="text-center btn btn-success" data-dismiss="modal">No</button>
                                                            <a href="client-notifications.php?clear_notification=<?php echo $id; ?>" class="text-center btn btn-danger"> Clear Notification </a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                <?php }
                                } ?>
                            </div>
                            <div class="card-footer py-2 text-center">
                                <a href="#" class="text-sm text-muted font-weight-bold">Load More</a>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Footer -->
            <?php require_once('../partials/dashboard_footer.php');
            } ?>
        </div>
    </div>
    <!-- Scripts -->
    <?php require_once('../partials/dashboard_scripts.php'); ?>
</body>


</html>