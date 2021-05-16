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

/* Configure ERP Instance */
if (isset($_POST['addInstance'])) {
    //Error Handling and prevention of posting double entries
    $error = 0;
    if (isset($_POST['package_code']) && !empty($_POST['package_code'])) {
        $package_code = mysqli_real_escape_string($mysqli, trim($_POST['package_code']));
    } else {
        $error = 1;
        $err = "Package Code Cannot Be Empty";
    }

    if (isset($_POST['package_name']) && !empty($_POST['package_name'])) {
        $package_name = mysqli_real_escape_string($mysqli, trim($_POST['package_name']));
    } else {
        $error = 1;
        $err = "Package Name Cannot Be Empty";
    }

    if (isset($_POST['instance_status']) && !empty($_POST['instance_status'])) {
        $instance_status = mysqli_real_escape_string($mysqli, trim($_POST['instance_status']));
    } else {
        $error = 1;
        $err = "Instance  Status  Cannot Be Empty";
    }

    if (isset($_POST['subscription_code']) && !empty($_POST['subscription_code'])) {
        $subscription_code = mysqli_real_escape_string($mysqli, trim($_POST['subscription_code']));
    } else {
        $error = 1;
        $err = "Subscription Code  Cannot Be Empty";
    }

    if (isset($_POST['client_id']) && !empty($_POST['client_id'])) {
        $client_id = mysqli_real_escape_string($mysqli, trim($_POST['client_id']));
    } else {
        $error = 1;
        $err = "Client ID  Cannot Be Empty";
    }

    if (isset($_POST['client_email']) && !empty($_POST['client_email'])) {
        $client_email = mysqli_real_escape_string($mysqli, trim($_POST['client_email']));
    } else {
        $error = 1;
        $err = "Client Email  Cannot Be Empty";
    }

    if (isset($_POST['instance_url']) && !empty($_POST['instance_url'])) {
        $instance_url = mysqli_real_escape_string($mysqli, trim($_POST['instance_url']));
    } else {
        $error = 1;
        $err = "Instance URL  Cannot Be Empty";
    }

    if (!$error) {
        $query = "INSERT INTO NucleusSAASERP_ERPInstances  (client_id, client_email, instance_url, package_code, package_name, subscription_code) VALUES (?,?,?,?,?,?)";
        $instancestatus = "UPDATE NucleusSAASERP_UserSubscriptions SET instance_status = ? WHERE  subscription_code = ? ";
        $stmt = $mysqli->prepare($query);
        $instancestmt = $mysqli->prepare($instancestatus);
        $rc = $stmt->bind_param('ssssss', $client_id, $client_email, $instance_url, $package_code, $package_name, $subscription_code);
        $rc = $instancestmt->bind_param('ss', $instance_status, $subscription_code);
        /* To Do:  Mail User */
        $stmt->execute();
        $instancestmt->execute();
        if ($stmt && $instancestmt) {
            $success = "Subscription ERP Instance Configured.";
        } else {
            $info = "Please Try Again Or Try Later ";
        }
    }
}


/* Delete Subscription */
if (isset($_GET['delete'])) {
    $delete = $_GET['delete'];
    $adn = "DELETE FROM NucleusSAASERP_UserSubscriptions WHERE id=?";
    $stmt = $mysqli->prepare($adn);
    $stmt->bind_param('s', $delete);
    $stmt->execute();
    $stmt->close();
    if ($stmt) {
        $success = "Deleted" && header("refresh:1; url=admin-client-subscriptions.php");
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
                                    <h5 class="h4 d-inline-block font-weight-400 mb-0 text-white">Clients Subscriptions</h5>
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
                                        <th scope="col" class="sort">Subscription Details</th>
                                        <th scope="col">Client Details</th>
                                        <th scope="col" class="sort">Package Details</th>
                                        <th scope="col">Manage</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $ret = "SELECT * FROM `NucleusSAASERP_UserSubscriptions` WHERE status ='Active' ";
                                    $stmt = $mysqli->prepare($ret);
                                    $stmt->execute(); //ok
                                    $res = $stmt->get_result();
                                    while ($subscriptions = $res->fetch_object()) {
                                    ?>

                                        <tr>
                                            <td>
                                                <span class="client"><?php echo $subscriptions->subscription_code; ?></span>
                                                <span class="d-block text-sm text-muted">Subscribed On:<?php echo date('d M Y', strtotime($subscriptions->date_subscribed)); ?></span>
                                                <span class="d-block text-sm text-muted">Valid Till :<?php echo date('d M Y', strtotime($subscriptions->subscription_expiriry)); ?></span>
                                                <span class="d-block text-sm text-muted">Payment Status:
                                                    <?php
                                                    if ($subscriptions->payment_status == 'Paid') {
                                                        echo "<span class='badge badge-pill badge-success'>Paid</span>";
                                                    } else {
                                                        echo "<span class='badge badge-pill badge-warning'>UnPaid</span>";
                                                    } ?>
                                                </span>

                                            </td>
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
                                                <?php
                                                /* Only Configure SUbscriptions With No ERP Instance */
                                                if ($subscriptions->instance_status == '') {
                                                    echo
                                                    "
                                                <a href='#configure-$subscriptions->id' data-toggle='modal' class='badge badge-pill badge-success'>Configure ERP Instance</a>
                                                ";
                                                } else {
                                                    /* Nothing */
                                                }
                                                ?>
                                                <!-- Configure ERP Instance -->
                                                <div class="modal fade" id="configure-<?php echo $subscriptions->id; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModalLabel">Configure ERP Instance For Subscription Code : <?php echo $subscriptions->subscription_code; ?></h5>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <form method="POST">
                                                                    <div class="row">
                                                                        <div class="col-md-12">
                                                                            <label class="form-label">NucleusSaaS ERP Instance URL</label>
                                                                            <input type="text" required class="form-control" name="instance_url ">
                                                                            <input type="hidden" required value="<?php echo $subscriptions->client_id; ?>" class="form-control" name="client_id">
                                                                            <input type="hidden" required value="<?php echo $subscriptions->client_email; ?>" class="form-control" name="client_email">
                                                                            <input type="hidden" required value="<?php echo $subscriptions->client_name; ?>" class="form-control" name="client_name">
                                                                            <input type="hidden" required value="<?php echo $subscriptions->package_code; ?>" class="form-control" name="package_code ">
                                                                            <input type="hidden" required value="<?php echo $subscriptions->subscription_code; ?>" class="form-control" name="subscription_code">
                                                                            <input type="hidden" required value="<?php echo $subscriptions->package_name; ?>" class="form-control" name="package_name">
                                                                            <input type="hidden" required value="Has Instance" class="form-control" name="instance_status">
                                                                        </div>
                                                                    </div>
                                                                    <br>
                                                                    <div class="text-right">
                                                                        <button type="submit" name="addInstance" class="btn btn-primary">Save Instance</button>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- End Configuration -->
                                                <a href="#delete-<?php echo $subscriptions->id; ?>" data-toggle="modal" class='badge badge-pill badge-danger'>Delete</a>
                                                <!-- Delete Modal -->
                                                <div class="modal fade" id="delete-<?php echo $subscriptions->id; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModalLabel">CONFIRM DELETE</h5>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body text-center text-danger">
                                                                <h4>Delete This Subscription Record?</h4>
                                                                <p>
                                                                    Hey There You Are About To Delete A Client Subscription Details. <br>
                                                                    This Operation Is Irrevessible All Payments, <br>
                                                                    Invoices And ERP Instances Linked To This Card Will Be Deleted.
                                                                </p>
                                                                <button type="button" class="text-center btn btn-success" data-dismiss="modal">No</button>
                                                                <a href="admin-client-subscriptions.php?delete=<?php echo $subscriptions->id; ?>" class="text-center btn btn-danger">Yes Delete</a>
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