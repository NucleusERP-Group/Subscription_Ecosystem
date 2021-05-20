<?php
/*
 * Created on Thu May 20 2021
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

/* Update ERP Instance - Add Download Link */
if (isset($_POST['AddDownloadLink'])) {
    //Error Handling and prevention of posting double entries
    $error = 0;

    /* ERP Instance Details */
    if (isset($_POST['download_link']) && !empty($_POST['download_link'])) {
        $download_link = mysqli_real_escape_string($mysqli, trim($_POST['download_link']));
    } else {
        $error = 1;
        $err = "Download Link Cannot Be Empty";
    }

    if (isset($_POST['id']) && !empty($_POST['id'])) {
        $id = mysqli_real_escape_string($mysqli, trim($_POST['id']));
    } else {
        $error = 1;
        $err = "Instance ID  Cannot Be Empty";
    }

    /* Client Details */
    if (isset($_POST['client_id']) && !empty($_POST['client_id'])) {
        $client_id = mysqli_real_escape_string($mysqli, trim($_POST['client_id']));
    } else {
        $error = 1;
        $err = "Client ID Cannot Be Empty";
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
        /* Add Download Link */
        $query = "UPDATE  NucleusSAASERP_ERPInstances SET download_link = ? WHERE id = ?";
        /* Notify User */
        $notif = "INSERT INTO NucleusSAASERP_UserNotifications (client_id, client_email, notification_from, notification_details) VALUES(?,?,?,?)";
        /* Prepare Download Link */
        $stmt = $mysqli->prepare($query);
        /* Prepapare Notification */
        $notifstmt = $mysqli->prepare($notif);

        /* Bind Download Link */
        $rc = $stmt->bind_param('ss', $download_link, $id);
        /* Bind Notification */
        $rc = $notifstmt->bind_param('ssss', $client_id, $client_email, $notification_from, $notification_details);

        /* Execute Download Link */
        $stmt->execute();
        /* Execute Notification */
        $notifstmt->execute();

        /* Load Mailer */
        require_once('../config/mailer_config.php');

        if ($stmt && $notif && $mail->send()) {
            $success = "Executables Download Links Shared.";
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
                            <div class="col-md-12 d-flex align-items-center justify-content-between justify-content-md-start mb-3 mb-md-0">
                                <!-- Page title + Go Back button -->
                                <div class="d-inline-block">
                                    <h5 class="h4 d-inline-block font-weight-400 mb-0 text-white">NucleusSaaS ERP Instances With Requested Executables</h5>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Listing -->
                    <div class="card">
                        <!-- Table -->
                        <div class="table-responsive card-body">
                            <table id="AdminDashboardDataTables" class="table align-items-center">
                                <thead>
                                    <tr>
                                        <th scope="col" class="sort">Package Details</th>
                                        <th scope="col">Executable Flavours</th>
                                        <th scope="col">Executable Download Link</th>
                                        <th scope="col">Manage Instance</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    /* Only Load ERP Instances Which Clients Has Requested For Download Links */
                                    $ret = "SELECT * FROM `NucleusSAASERP_ERPInstances`  WHERE has_download_request = 'Yes' ";
                                    $stmt = $mysqli->prepare($ret);
                                    $stmt->execute(); //ok
                                    $res = $stmt->get_result();
                                    while ($instances = $res->fetch_object()) {
                                    ?>

                                        <tr>
                                            <td class="order">
                                                <span class="h6 text-sm font-weight-bold mb-0"><?php echo $instances->package_code; ?></span>
                                                <span class="d-block text-sm text-muted"><?php echo $instances->package_name; ?></span>
                                            </td>
                                            <td class="order">
                                                <span class="d-block text-sm text-muted">Desktop Platform: <?php echo $instances->desktop_platform; ?></span>
                                                <span class="d-block text-sm text-muted">Mobile Platform: <?php echo $instances->mobile_platform; ?></span>
                                                <?php
                                                if ($instances->download_link == '') {
                                                    echo "Executable Status: <span class='badge badge-danger'>No Link</span>";
                                                } else {
                                                    echo "Executable Status: <span class='badge badge-success'>Link Available</span>";
                                                } ?>
                                            </td>
                                            <td>
                                                <a href="<?php echo $instances->download_link; ?>" class="badge badge-pill badge-primary" target="_blank">
                                                    <i class="fas fa-external-link-alt"></i>
                                                    Open Download Link
                                                </a>
                                            </td>
                                            <td>
                                                <a href="#update-<?php echo $instances->id; ?>" data-toggle="modal" class='badge badge-pill badge-warning'><i class="fas fa-edit"></i> Edit</a>
                                                <!-- Update Instance -->
                                                <div class="modal fade" id="update-<?php echo $instances->id; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModalLabel">Update / Add ERP Instance Download Links</h5>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <form method="POST">
                                                                    <div class="row">
                                                                        <div class="col-md-12">
                                                                            <label class="form-label">NucleusSaaS ERP Exectables Download URL</label>
                                                                            <input type="text" required class="form-control" value="<?php echo $instances->download_link; ?>" name="download_link">
                                                                            <input type="hidden" required value="<?php echo $instances->id; ?>" class="form-control" name="id">
                                                                            <!-- Client Details -->
                                                                            <input type="hidden" required name="client_name" value="<?php echo $client->name; ?>" class="form-control">
                                                                            <input type="hidden" required name="client_email" value="<?php echo $client->email; ?>" class="form-control">
                                                                            <input type="hidden" required name="client_id" value="<?php echo $client->id; ?>" class="form-control">
                                                                            <!-- Notification Details -->
                                                                            <input type="hidden" name="notification_from" value="NucleusSaaS ERP Executables">
                                                                            <input type="hidden" name="notification_details" value="Hello, <?php echo $client->name; ?>. Your request for executables versions of NucleusSaaS ERP, is being configured. Come back after 24 Hours to get your requested executables.">
                                                                            <!-- Mail To Client -->
                                                                            <input type="hidden" name="subject" value="NucleusSaaS ERP Executables Download Request Approval.">
                                                                            <input type="hidden" name="message" value="Hello, <?php echo $client->name; ?>, <br> We hope you’re well!. We have received your download request for <b><?php echo $instances->package_code . " " . $instances->package_name; ?></b> executables</b> and 
                                                                            our hardworking team has generated those executables flavours for you. To access your download links, navigate to <b>Downloads</b> on your client portal and click <b>Download</b> on the <b>NucleusSaaS ERP Instances</b>.<br>
                                                                            Don’t hesitate to reach out if you have any questions.<br><br><br><br><br>
                                                                            Kind Regards,<br>
                                                                            <b>NucleusSaaS ERP Group</b><br>
                                                                            <i>
                                                                                Deploy your business operations and services on our fully redundant, 
                                                                                high performance Software As Service Enterprise Resource Planning platform
                                                                                and benefit from its high reliability, security and enterprise feature set.
                                                                            </i>
                                                                            ">
                                                                        </div>
                                                                    </div>
                                                                    <br>
                                                                    <div class="text-right">
                                                                        <button type="submit" name="AddDownloadLink" class="btn btn-primary">Save Url</button>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
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