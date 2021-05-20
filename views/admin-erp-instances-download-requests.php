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
                                        <th scope="col">ERP Instance</th>
                                        <th scope="col">Executable Flavours</th>
                                        <th scope="col">Executable Status</th>
                                        <th scope="col">Executable Download Link</th>
                                        <th scope="col">Manage Instance</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $ret = "SELECT * FROM `NucleusSAASERP_ERPInstances`  ";
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
                                            </td>
                                            <td>
                                                <?php 
                                                if($instances->download_link == ''){
                                                    echo "<span class='badge badge-danger'>No Link</span>";
                                                }else{
                                                    echo "<span class='badge badge-success'>Link Available</span>";
                                                }?>
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
                                                                            <label class="form-label">NucleusSaaS ERP Exectables Download  URL</label>
                                                                            <input type="text" required class="form-control" value="<?php echo $instances->download_link; ?>" name="instance_url">
                                                                            <input type="hidden" required value="<?php echo $instances->id; ?>" class="form-control" name="id">
                                                                        </div>
                                                                    </div>
                                                                    <br>
                                                                    <div class="text-right">
                                                                        <button type="submit" name="UpdateInstance" class="btn btn-primary">Save Instance</button>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- End Update -->
                                                <a href="#delete-<?php echo $instances->id; ?>" data-toggle="modal" class='badge badge-pill badge-danger'><i class="fas fa-trash"></i> Delete</a>
                                                <!-- Delete Modal -->
                                                <div class="modal fade" id="delete-<?php echo $instances->id; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModalLabel">CONFIRM DELETE</h5>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body text-center text-danger">
                                                                <h4>Delete This Instance Record?</h4>
                                                                <p>
                                                                    Hey There You Are About To Delete A Client ERP Instance Details. <br>
                                                                    This Operation Is Irrevessible All Clients ERP Data Will Be Deleted.
                                                                </p>
                                                                <button type="button" class="text-center btn btn-success" data-dismiss="modal">No</button>
                                                                <a href="admin-erp-instance.php?delete=<?php echo $instances->id; ?>&subscription_code=<?php echo $instances->subscription_code; ?>" class="text-center btn btn-danger">Yes Delete</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- End Delete Modal -->
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