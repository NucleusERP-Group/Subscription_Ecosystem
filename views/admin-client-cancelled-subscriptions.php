<?php
/*
 * Created on Sun May 16 2021
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
client_login();

/* Restore Client Subscription  */
if (isset($_POST['RestoreSubscription'])) {
    //Error Handling and prevention of posting double entries
    $error = 0;
    if (isset($_POST['id']) && !empty($_POST['id'])) {
        $id = mysqli_real_escape_string($mysqli, trim($_POST['id']));
    } else {
        $error = 1;
        $err = "ID Cannot Be Empty";
    }

    if (isset($_POST['status']) && !empty($_POST['status'])) {
        $status = mysqli_real_escape_string($mysqli, trim($_POST['status']));
    } else {
        $error = 1;
        $err = "Status  Cannot Be Empty";
    }

    if (isset($_POST['client_id']) && !empty($_POST['client_id'])) {
        $client_id = mysqli_real_escape_string($mysqli, trim($_POST['client_id']));
    } else {
        $error = 1;
        $err = "Client ID  Cannot Be Empty";
    }

    if (isset($_POST['client_name']) && !empty($_POST['client_name'])) {
        $client_name = mysqli_real_escape_string($mysqli, trim($_POST['client_name']));
    } else {
        $error = 1;
        $err = "Client Name  Cannot Be Empty";
    }

    if (isset($_POST['client_email']) && !empty($_POST['client_email'])) {
        $client_email = mysqli_real_escape_string($mysqli, trim($_POST['client_email']));
    } else {
        $error = 1;
        $err = "Client Email  Cannot Be Empty";
    }


    /* Notifications */
    if (isset($_POST['notification_from']) && !empty($_POST['notification_from'])) {
        $notification_from = mysqli_real_escape_string($mysqli, trim($_POST['notification_from']));
    } else {
        $error = 1;
        $err = "Notification From  Cannot Be Empty";
    }

    if (isset($_POST['notification_details']) && !empty($_POST['notification_details'])) {
        $notification_details = mysqli_real_escape_string($mysqli, trim($_POST['notification_details']));
    } else {
        $error = 1;
        $err = "Notification Details  Cannot Be Empty";
    }

    if (!$error) {

        /* No Error Or Duplicate */
        $query = "UPDATE  NucleusSAASERP_UserSubscriptions SET status = ? WHERE id = ?";
        /* Notify User */
        $notif = "INSERT INTO NucleusSAASERP_UserNotifications (client_id, client_email, notification_from, notification_details) VALUES(?,?,?,?)";
        $stmt = $mysqli->prepare($query);
        $notifstmt = $mysqli->prepare($notif);
        $rc = $stmt->bind_param('ss', $status, $id);
        $rc = $notifstmt->bind_param('ssss', $client_id, $client_email, $notification_from, $notification_details);
        $stmt->execute();
        $notifstmt->execute();
        /* Load Mailer */
        require_once('../config/mailer_config.php');
        if ($stmt && $notifstmt && $mail->send()) {
            $success = "Subscription Restored";
        } else {
            $info = "Please Try Again Or Try Later ";
        }
    }
}
require_once('../partials/dashboard_head.php');
?>

<body class="application application-offset">

    <!-- Application container -->
    <div class="container-fluid container-application">
        <!-- Sidenav -->
        <?php require_once('../partials/admin_dashboard_sidenav.php'); ?>
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
                                    <h5 class="h4 d-inline-block font-weight-400 mb-0 text-white">Cancelled & Pending Restoration Subscriptions</h5>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Listing -->
                    <div class="card">
                        <div class="table-responsive card-body">
                            <table id="AdminDashboardDataTables" class="table align-items-center">
                                <thead>
                                    <tr>
                                        <th scope="col">Client Details</th>
                                        <th scope="col" class="sort">Package Details</th>
                                        <th scope="col" class="sort">Subscription Code</th>
                                        <th scope="col" class="sort">Date Subscribed</th>
                                        <th scope="col" class="sort">Expiriry Date</th>
                                        <th scope="col">Payment Status</th>
                                        <th scope="col">Subscription Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $ret = "SELECT * FROM `NucleusSAASERP_UserSubscriptions` WHERE status !='Active' ";
                                    $stmt = $mysqli->prepare($ret);
                                    $stmt->execute(); //ok
                                    $res = $stmt->get_result();
                                    while ($subscriptions = $res->fetch_object()) {
                                    ?>

                                        <tr>
                                            <td class="order">
                                                <span class="h6 text-sm font-weight-bold mb-0"><?php echo $subscriptions->client_name; ?></span>
                                                <span class="d-block text-sm text-muted"><?php echo $subscriptions->client_email; ?></span>
                                            </td>
                                            <td class="order">
                                                <span class="h6 text-sm font-weight-bold mb-0"><?php echo $subscriptions->package_code; ?></span>
                                                <span class="d-block text-sm text-muted"><?php echo $subscriptions->package_name; ?></span>
                                                <span class="d-block text-sm text-muted">Ksh <?php echo $subscriptions->payment_amt; ?></span>
                                            </td>
                                            <td>
                                                <span class="client"><?php echo $subscriptions->subscription_code; ?></span>
                                            </td>
                                            <td>
                                                <span class="client"><?php echo date('d M Y', strtotime($subscriptions->date_subscribed)); ?></span>
                                            </td>
                                            <td>
                                                <span class="client"><?php echo date('d M Y', strtotime($subscriptions->subscription_expiriry)); ?></span>
                                            </td>
                                            <td>
                                                <?php
                                                if ($subscriptions->payment_status == 'Paid') {
                                                    echo "<span class='badge badge-pill badge-success'>Paid</span>";
                                                } else {
                                                    echo "<span class='badge badge-pill badge-warning'>UnPaid</span>";
                                                } ?>
                                            </td>
                                            <td>
                                                <?php
                                                if ($subscriptions->status == 'Cancelled') {
                                                    echo "<span class='badge badge-pill badge-success'>Cancelled</span>";
                                                } else {
                                                    echo "<a href='#restore-$subscriptions->id' data-toggle='modal' class='badge badge-pill badge-warning'>Restore Subscription</a>";
                                                } ?>
                                                <form method="POST">
                                                    <!-- Hidden Values -->
                                                    <input type="hidden" name="id" value="<?php echo $subscriptions->id; ?>">
                                                    <input type="hidden" name="client_name" value="<?php echo $subscriptions->client_name; ?>">
                                                    <input type="hidden" name="client_email" value="<?php echo $subscriptions->client_email; ?>">
                                                    <input type="hidden" name="client_id" value="<?php echo $subscriptions->client_id; ?>">

                                                    <input type="hidden" name="status" value="Active">
                                                    <!-- Notification Details -->
                                                    <input type="hidden" name="notification_from" value="Package Subscription">
                                                    <input type="hidden" name="notification_details" value="Hello, <?php echo $subscriptions->client_name; ?>. Your Cancelled Subscription  <b><?php echo $subscriptions->subscription_code . "" . $subscriptions->package_code . "-" . $subscriptions->package_name; ?></b> Has Been Restored Successfully.">
                                                    <!-- Mail To Client -->
                                                    <input type="hidden" name="subject" value="Package Subscription">
                                                    <input type="hidden" name="message" value="Hello, <?php echo $subscriptions->client_name; ?>. 
                                                    Your Cancelled Subscription  For <b><?php echo $subscriptions->subscription_code . " " . $subscriptions->package_code . "-" . $subscriptions->package_name; ?></b> has been restored successfully.<br>
                                                    Don’t hesitate to reach out if you have any questions.<br><br><br><br><br>
                                                    Kind Regards,<br>
                                                    <b>NucleusSaaS ERP Group</b><br>
                                                    <i>
                                                        Deploy your business operations and services on our fully redundant, 
                                                        high performance Software As Service Enterprise Resource Planning platform
                                                        and benefit from its high reliability, security and enterprise feature set.
                                                    </i>">
                                                    <div class="modal fade" id="restore-<?php echo $subscriptions->id; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="exampleModalLabel">CONFIRM RESTORATION</h5>
                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body text-center text-danger">
                                                                    <h4>Restore Subscribed Package</h4>
                                                                    <br>
                                                                    <button type="button" class="text-center btn btn-success" data-dismiss="modal">No</button>
                                                                    <input type="submit" name="RestoreSubscription" class="text-center btn btn-danger" value="Restore Subsciption">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </form>
                                            </td>
                                        </tr>

                                    <?php
                                    } ?>
                                </tbody>
                            </table>
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