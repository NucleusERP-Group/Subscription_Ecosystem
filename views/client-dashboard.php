<?php
/*
 * Created on Sat May 08 2021
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
            <?php require_once('../partials/dashboard_main_nav.php'); ?>
            <!-- Page content -->
            <div class="page-content">
                <!-- Page title -->
                <?php require_once('../partials/dashboard_ml.php'); ?>
                <div class="row">
                    <div class="col-xl-4 col-md-6">
                        <div class="card card-stats">
                            <!-- Card body -->
                            <div class="card-body">
                                <div class="row">
                                    <div class="col">
                                        <h6 class="text-muted mb-1">Active Subscriptions</h6>
                                        <span class="h3 font-weight-bold mb-0 ">7.500</span>
                                    </div>
                                    <div class="col-auto">
                                        <div class="progress-circle progress-sm" id="progress-circle-1" data-progress="40" data-text="40%" data-color="info"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4 col-md-6">
                        <div class="card card-stats">
                            <!-- Card body -->
                            <div class="card-body">
                                <div class="row">
                                    <div class="col">
                                        <h6 class="text-muted mb-1">Cancelled Subscriptions</h6>
                                        <span class="h3 font-weight-bold mb-0 ">34</span>
                                    </div>
                                    <div class="col-auto">
                                        <div class="progress-circle progress-sm" id="progress-circle-2" data-progress="60" data-text="60%" data-color="dark"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4 col-md-6">
                        <div class="card card-stats">
                            <!-- Card body -->
                            <div class="card-body">
                                <div class="row">
                                    <div class="col">
                                        <h6 class="text-muted mb-1">Unpaid Invoices</h6>
                                        <span class="h3 font-weight-bold mb-0 ">68</span>
                                    </div>
                                    <div class="col-auto">
                                        <div class="progress-circle progress-sm" id="progress-circle-3" data-progress="80" data-text="80%" data-color="danger"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4 col-md-6">
                        <div class="card card-stats">
                            <!-- Card body -->
                            <div class="card-body">
                                <div class="row">
                                    <div class="col">
                                        <h6 class="text-muted mb-1">Linked Cards</h6>
                                        <span class="h3 font-weight-bold mb-0 ">68</span>
                                    </div>
                                    <div class="col-auto">
                                        <div class="progress-circle progress-sm" id="progress-circle-3" data-progress="80" data-text="80%" data-color="danger"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4 col-md-6">
                        <div class="card card-stats">
                            <!-- Card body -->
                            <div class="card-body">
                                <div class="row">
                                    <div class="col">
                                        <h6 class="text-muted mb-1">Pending Payments</h6>
                                        <span class="h3 font-weight-bold mb-0 ">68</span>
                                    </div>
                                    <div class="col-auto">
                                        <div class="progress-circle progress-sm" id="progress-circle-3" data-progress="80" data-text="80%" data-color="danger"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4 col-md-6">
                        <div class="card card-stats">
                            <!-- Card body -->
                            <div class="card-body">
                                <div class="row">
                                    <div class="col">
                                        <h6 class="text-muted mb-1">Paid Payments</h6>
                                        <span class="h3 font-weight-bold mb-0 ">68</span>
                                    </div>
                                    <div class="col-auto">
                                        <div class="progress-circle progress-sm" id="progress-circle-3" data-progress="80" data-text="80%" data-color="danger"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Subscription Payments Overview -->

                    <!-- Linked Cards Overview -->
                    <div class="col-xl-6 col-md-6">
                        <div class="card">
                            <div class="card-header">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <h6 class="mb-0">Linked Credit And Debit Cards Overview</h6>
                                    </div>
                                </div>
                            </div>
                            <div class="list-group list-group-flush">
                                <?php
                                /* Load Credit Card Based On The Logged In User */
                                $id = $_SESSION['id'];
                                $email = $_SESSION['email'];
                                $ret = "SELECT * FROM `NucleusSAASERP_UsersCards` WHERE card_holder_id = '$id' OR card_holder_email = '$email' LIMIT 3  ";
                                $stmt = $mysqli->prepare($ret);
                                $stmt->execute(); //ok
                                $res = $stmt->get_result();
                                while ($card = $res->fetch_object()) {
                                ?>
                                    <a href="client-billing.php" class="list-group-item list-group-item-action">
                                        <div class="media align-items-center">
                                            <div class="mr-3">
                                                <?php
                                                if ($card->card_name == 'Visa') {
                                                    echo '<img alt="Image placeholder" src="../public/assets/img/icons/cards/visa.png" width="40" class="mr-2">';
                                                } else {
                                                    echo '<img alt="Image placeholder" src="../public/assets/img/icons/cards/mastercard.png" width="40" class="mr-2">';
                                                } ?>
                                            </div>
                                            <div class="media-body">
                                                <h6 class="text-sm d-block text-limit mb-0"><?php echo  $card->card_number; ?></h6>
                                                <span class="d-block text-sm text-muted">Card CVV: <?php echo $card->card_cvv; ?></span>
                                            </div>
                                            <div class="media-body text-right">
                                                <span class="text-sm text-dark font-weight-bold ml-3">
                                                    Expiry: <?php echo $card->card_exp_date; ?>
                                                </span>
                                            </div>
                                        </div>
                                    </a>
                                <?php
                                } ?>

                            </div>
                        </div>
                    </div>
                    <!-- Active Subscriptions Overview -->
                    <div class="col-xl-6 col-md-6">
                        <div class="card">
                            <div class="card-header">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <h6 class="mb-0">Active Subscription Packages Overview</h6>
                                    </div>
                                </div>
                            </div>
                            <div class="list-group list-group-flush">
                                <?php
                                $ret = "SELECT * FROM `NucleusSAASERP_UserSubscriptions` WHERE client_id = '$id' || client_email = '$email' AND status ='Active' LIMIT 3 ";
                                $stmt = $mysqli->prepare($ret);
                                $stmt->execute(); //ok
                                $res = $stmt->get_result();
                                while ($subscribed_packages = $res->fetch_object()) {
                                ?>
                                    <a href="client-subscriptions.php" class="list-group-item list-group-item-action">
                                        <div class="media align-items-center">
                                            <div class="mr-3">
                                                <?php
                                                /* Sort Image Icons Based On Subscription Packages */
                                                if ($subscribed_packages->package_code == 'C0MM001') {
                                                    echo '<img alt="Image placeholder" src="../public/img/icons/communities.svg" class="avatar">';
                                                } else {
                                                    echo '<img alt="Image placeholder" src="../public/img/icons/enterprise.svg" class="avatar">';
                                                } ?>
                                            </div>
                                            <div class="media-body">
                                                <h6 class="text-sm d-block text-limit mb-0"><?php echo $subscribed_packages->package_code . " " . $subscribed_packages->package_name; ?></h6>
                                                <span class="d-block text-sm text-muted">Subscription Code: <span class="text-success"><?php echo $subscribed_packages->subscription_code; ?></span></span>
                                                <?php
                                                if ($subscribed_packages->payment_status == 'Paid') {
                                                    echo "<span class='badge badge-pill badge-success'>Payment Status: $subscribed_packages->payment_status</span>";
                                                } else {
                                                    echo "<span class='badge badge-pill badge-warning'>Payment Status: $subscribed_packages->payment_status</span>";
                                                } ?>
                                            </div>
                                            <div class="media-body text-right">
                                                <span class="text-sm text-dark font-weight-bold ml-3">
                                                    Ksh <?php echo $subscribed_packages->payment_amt; ?>
                                                </span>
                                            </div>
                                        </div>
                                    </a>
                                <?php
                                } ?>
                            </div>
                        </div>
                    </div>

                </div>
                <!-- Footer -->
                <?php require_once('../partials/dashboard_footer.php'); ?>
            </div>
        </div>
        <!-- Scripts -->
        <?php require_once('../partials/dashboard_scripts.php'); ?>

</body>



</html>