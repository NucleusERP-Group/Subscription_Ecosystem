<?php
/*
 * Created on Mon May 10 2021
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

/* Purchase Subscriptions */
if (isset($_POST['PurchasePackage'])) {
    //Error Handling and prevention of posting double entries
    $error = 0;
    if (isset($_POST['id']) && !empty($_POST['id'])) {
        $id = mysqli_real_escape_string($mysqli, trim($_POST['id']));
    } else {
        $error = 1;
        $err = "ID Cannot Be Empty";
    }

    if (isset($_POST['subscription_code']) && !empty($_POST['subscription_code'])) {
        $subscription_code = mysqli_real_escape_string($mysqli, trim($_POST['subscription_code']));
    } else {
        $error = 1;
        $err = "Subscription Code Cannot Be Empty";
    }

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
        $err = "Package Name  Cannot Be Empty";
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

    if (isset($_POST['date_subscribed']) && !empty($_POST['date_subscribed'])) {
        $date_subscribed = mysqli_real_escape_string($mysqli, trim($_POST['date_subscribed']));
    } else {
        $error = 1;
        $err = "Date Subscribed Cannot Be Empty";
    }

    if (isset($_POST['payment_status']) && !empty($_POST['payment_status'])) {
        $payment_status = mysqli_real_escape_string($mysqli, trim($_POST['payment_status']));
    } else {
        $error = 1;
        $err = "Payment Status  Cannot Be Empty";
    }

    $payment_amt = mysqli_real_escape_string($mysqli, trim($_POST['payment_amt']));

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
    /* Status */
    $status = 'Active';

    if (!$error) {
        /* Prevent Double Entries */
        $sql = "SELECT * FROM  NucleusSAASERP_UserSubscriptions WHERE  subscription_code = '$subscription_code' && package_code = '$package_code'   ";
        $res = mysqli_query($mysqli, $sql);
        if (mysqli_num_rows($res) > 0) {
            $row = mysqli_fetch_assoc($res);
            if ($subscription_code == $row['subscription_code'] || $package_code == $row['package_code']) {
                $err =  "A Subscription With This Code:  $subscription_code Exists For This Package: $package_code";
            }
        } else {
            /* No Error Or Duplicate */
            $query = "INSERT INTO NucleusSAASERP_UserSubscriptions  (id, subscription_code, package_code, package_name, client_id, client_name, client_email, date_subscribed, payment_status, payment_amt, status) VALUES (?,?,?,?,?,?,?,?,?,?,?)";
            /* Notify User */
            $notif = "INSERT INTO NucleusSAASERP_UserNotifications (client_id, client_email, notification_from, notification_details) VALUES(?,?,?,?)";
            $stmt = $mysqli->prepare($query);
            $notifstmt = $mysqli->prepare($notif);
            $rc = $stmt->bind_param('sssssssssss', $id, $subscription_code, $package_code, $package_name, $client_id, $client_name, $client_email, $date_subscribed, $payment_status, $payment_amt, $status);
            $rc = $notifstmt->bind_param('ssss', $client_id, $client_email, $notification_from, $notification_details);
            $stmt->execute();
            $notifstmt->execute();
            /* Load Mailer */
            require_once('../config/mailer_config.php');
            if ($stmt && $notifstmt && $mail->send()) {
                $success = "Subscription  Added. Proceed To Pay";
            } else {
                $info = "Please Try Again Or Try Later ";
            }
        }
    }
}
/* Cancel Subscription */
if (isset($_POST['CancelSubscription'])) {
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
        /* Prevent Double Entries */
        
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
                $success = "Subscription  Cancelled.";
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
                                    <h5 class="h4 d-inline-block font-weight-400 mb-0 text-white">NucleusSaaS ERP Subscription Packages </h5>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Project cards -->
                    <div class="row">
                        <?php
                        $ret = "SELECT * FROM `NucleusSAASERP_Packages` ";
                        $stmt = $mysqli->prepare($ret);
                        $stmt->execute(); //ok
                        $res = $stmt->get_result();
                        while ($packages = $res->fetch_object()) {
                        ?>
                            <div class="col-xl-6 col-lg-6 col-sm-6">
                                <div class="card hover-shadow-lg">
                                    <div class="card-body text-center"><span class="avatar avatar-lg hover-translate-y-n3">
                                            <?php
                                            /* Sort Image Icons Based On Subscription Packages */
                                            if ($packages->package_code == 'C0MM001') {
                                                echo '<img alt="Image placeholder" src="../public/img/icons/communities.svg" class="">';
                                            } else {
                                                echo '<img alt="Image placeholder" src="../public/img/icons/enterprise.svg" class="">';
                                            } ?>
                                        </span>
                                        <h5 class="h6 my-4"><a href="#package-<?php echo $packages->id; ?>" data-toggle="modal">
                                                <?php echo $packages->package_name; ?></a>
                                            <br>
                                            Monthly Subscription Payment: Ksh <?php echo $packages->package_monthly_price; ?>
                                            <br>
                                            Yearly Subscription Payment: Ksh <?php echo $packages->package_yearly_price; ?>
                                        </h5>
                                        <!-- Package Details -->
                                        <div class="modal fade" id="package-<?php echo $packages->id; ?>" tabindex="-1" role="dialog" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-body">
                                                        <!-- Project name -->
                                                        <div class="form-group">
                                                            <label class="form-control-label">
                                                                <?php echo $packages->package_name; ?> Features
                                                            </label>
                                                        </div>
                                                        <!-- Project description -->
                                                        <div class="form-group">
                                                            <label class="form-control-label mb-0">
                                                                <?php echo $packages->package_details; ?>
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Package Details -->
                                        <span class="clearfix"></span>
                                        <?php
                                        if ($packages->package_status = 'Active') {
                                            echo "<span class='badge badge-pill badge-success'>Package Status: $packages->package_status</span>";
                                        } else {
                                            echo "
                                        <span class='badge badge-pill badge-warning'>Package Status:$packages->package_status</span>
                                        ";
                                        } ?>
                                    </div>

                                    <div class="card-footer">
                                        <div class="actions d-flex justify-content-between px-4">
                                            <form method="POST">
                                                <!-- Hidden Values -->
                                                <input type="hidden" name="id" value="<?php echo $ID; ?>">
                                                <input type="hidden" name="subscription_code" value="<?php echo $a . "" . $b; ?>">
                                                <input type="hidden" name="package_code" value="<?php echo $packages->package_code; ?>">
                                                <input type="hidden" name="package_name" value="<?php echo $packages->package_name; ?>">
                                                <input type="hidden" name="client_id" value="<?php echo $client->id; ?>">
                                                <input type="hidden" name="client_name" value="<?php echo $client->name; ?>">
                                                <input type="hidden" name="client_email" value="<?php echo $client->email; ?>">
                                                <input type="hidden" name="date_subscribed" value="<?php echo date('d M Y'); ?>">
                                                <input type="hidden" name="payment_status" value="Pending">
                                                <input type="hidden" name="payment_amt" value="<?php echo $packages->package_monthly_price; ?>">
                                                <!-- Notification Details -->
                                                <input type="hidden" name="notification_from" value="Package Subscription">
                                                <input type="hidden" name="notification_details" value="Hello, <?php echo $client->name; ?>. Kindly Proceed To Pay For Your <?php echo $packages->package_code . " " . $packages->package_name; ?>
                                                Subscription Payment In Invoices Tab On Your Dashboard.">
                                                <!-- Mail To Client -->
                                                <input type="hidden" name="subject" value="Package Subscription">
                                                <input type="hidden" name="message" value="Hello, <?php echo $client->name; ?>. Kindly Proceed To Pay For Your <b><?php echo $packages->package_code . " " . $packages->package_name; ?></b>
                                                Subscription Payment In Invoices Tab On Your Dashboard.">

                                                <button type="submit" name="PurchasePackage" class="action-item">
                                                    <i class="far fa-shopping-cart"></i>
                                                    Subscribe Package
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php
                        } ?>
                    </div>
                    <br>
                    <h5 class="text-left"> My NucleusSaaS ERP Subscribed Packages</h5>
                    <div class="row">
                        <?php
                        $ret = "SELECT * FROM `NucleusSAASERP_UserSubscriptions` WHERE client_id = '$client->id' AND status ='Active' ";
                        $stmt = $mysqli->prepare($ret);
                        $stmt->execute(); //ok
                        $res = $stmt->get_result();
                        while ($subscribed_packages = $res->fetch_object()) {
                        ?>
                            <div class="col-xl-6 col-lg-6 col-sm-6">
                                <div class="card hover-shadow-lg">
                                    <div class="card-body text-center"><span class="avatar avatar-lg hover-translate-y-n3">
                                            <?php
                                            /* Sort Image Icons Based On Subscription Packages */
                                            if ($subscribed_packages->package_code == 'C0MM001') {
                                                echo '<img alt="Image placeholder" src="../public/img/icons/communities.svg" class="">';
                                            } else {
                                                echo '<img alt="Image placeholder" src="../public/img/icons/enterprise.svg" class="">';
                                            } ?>
                                        </span>
                                        <h5 class="h6 my-4">
                                            <?php echo $subscribed_packages->package_name; ?>
                                            <hr>
                                            Subscription Code: <?php echo $subscribed_packages->subscription_code; ?>
                                            <br>
                                            Subscription Payment: Ksh <?php echo $subscribed_packages->payment_amt; ?>
                                            <br>
                                            Subscribed On:  <?php echo  $subscribed_packages->date_subscribed; ?>
                                            <br>
                                            Subscription Expiriy On: <?php echo  $subscribed_packages->subscription_expiriry; ?>
                                            <br>

                                        </h5>
                                        <!-- Package Details -->
                                        <span class="clearfix"></span>
                                        <?php
                                        if ($subscribed_packages->payment_status == 'Paid') {
                                            echo "<span class='badge badge-pill badge-success'>Package Payment: $subscribed_packages->payment_status</span>";
                                        } else {
                                            echo "
                                        <span class='badge badge-pill badge-warning'>Package Payment:$subscribed_packages->payment_status</span>
                                        ";
                                        } ?>
                                    </div>

                                    <div class="card-footer">
                                        <div class="actions d-flex justify-content-between px-4">
                                            <form method="POST">
                                                <!-- Hidden Values -->
                                                <input type="hidden" name="id" value="<?php echo $subscribed_packages->id; ?>">
                                                <input type="hidden" name="client_id" value="<?php echo $subscribed_packages->client_id; ?>">
                                                <input type="hidden" name="client_name" value="<?php echo $subscribed_packages->client_name; ?>">
                                                <input type="hidden" name="client_email" value="<?php echo $subscribed_packages->client_email; ?>">

                                                <input type="hidden" name="status" value="Cancelled">
                                                <!-- Notification Details -->
                                                <input type="hidden" name="notification_from" value="Package Subscription">
                                                <input type="hidden" name="notification_details" value="Hello, <?php echo $subscribed_packages->client_name; ?>. You Have Cancelled Your <b><?php echo $subscribed_packages->package_code . " " . $subscribed_packages->package_name; ?></b> Subscription.">
                                                <!-- Mail To Client -->
                                                <input type="hidden" name="subject" value="Package Subscription">
                                                <input type="hidden" name="message" value="Hello, <?php echo $subscribed_packages->client_name; ?>. You Have Cancelled Your <b><?php echo $subscribed_packages->package_code . " " . $subscribed_packages->package_name; ?></b> Subscription.">
                                                <button type="submit" name="CancelSubscription" class="action-item">
                                                    <i class="far fa-calendar-times"></i>
                                                    Cancel Package Subscription
                                                </button>
                                            </form>
                                            <!-- Prompt User To Cancel Subscription -->

                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php
                        } ?>
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