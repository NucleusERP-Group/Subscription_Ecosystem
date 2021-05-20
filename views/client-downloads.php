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
                            <div class="col-md-12 d-flex align-items-center justify-content-between justify-content-md-start mb-3 mb-md-0">
                                <!-- Page title + Go Back button -->
                                <div class="d-inline-block">
                                    <h5 class="h4 d-inline-block font-weight-400 mb-0 text-white">Request For A Customized Android, iOS, Linux And Windows Execuatbles.</h5>
                                    <p class="d-inline-block font-weight-400 mb-0 text-white">
                                        NucleusSaaS ERPs are available in Android, iOs applications, windows 32 and 64 bit desktop applications and linux (debian based distributions) applications.
                                    </p>
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
                                        <th scope="col">Subscription Code</th>
                                        <th scope="col" class="sort">Package Details</th>
                                        <th scope="col">ERP Instance</th>
                                        <th scope="col">Request An Executable</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $ret = "SELECT * FROM `NucleusSAASERP_ERPInstances` WHERE client_id = '$id' OR client_email = '$email' ";
                                    $stmt = $mysqli->prepare($ret);
                                    $stmt->execute(); //ok
                                    $res = $stmt->get_result();
                                    while ($instances = $res->fetch_object()) {
                                    ?>

                                        <tr>
                                            <td>
                                                <?php echo $instances->subscription_code; ?>
                                            </td>
                                            <td class="order">
                                                <span class="h6 text-sm font-weight-bold mb-0"><?php echo $instances->package_code; ?></span>
                                                <span class="d-block text-sm text-muted"><?php echo $instances->package_name; ?></span>
                                            </td>
                                            <td>
                                                <a href="<?php echo $instances->instance_url; ?>" class="badge badge-pill badge-primary" target="_blank">
                                                    <i class="fas fa-external-link-alt"></i>
                                                    Access ERP Instance
                                                </a>
                                            </td>
                                            <td>
                                                <a href="#dowloads-<?php echo $instances->id; ?>" class="badge badge-pill badge-success" data-toggle="modal">
                                                    <i class="fas fa-download"></i>
                                                    Request Download
                                                </a>
                                            </td>
                                            <!-- Request For A Download -->
                                            <div class="modal fade" id="dowloads-<?php echo $instances->id; ?>">
                                                <div class="modal-dialog modal-dialog-centered" role="document">
                                                    <div class=" modal-content">
                                                        <div class="modal-header">
                                                            <h4 class="modal-title">Configure Your Download Flavour</h4>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <!-- Add Module Form -->
                                                            <form method="post" enctype="multipart/form-data" role="form">
                                                                <div class="card-body">
                                                                    <div class="row">
                                                                        <div class="form-group col-md-12">
                                                                            <label for="">Desktop Application Platorm</label>
                                                                            <select class="form-control" name="desktop_platform">
                                                                                <option>Select Operating System</option>
                                                                                <option>Windows Operating System</option>
                                                                                <option>Linux Operating System</option>
                                                                                <option>Mac Operating System</option>
                                                                            </select>
                                                                            <!-- Hidden Values -->
                                                                            <input type="hidden" required name="id" value="<?php echo $ID; ?>" class="form-control">
                                                                            <input type="hidden" required name="client_id" value="<?php echo $client->id; ?>" class="form-control">
                                                                            <input type="hidden" required name="client_name" value="<?php echo $client->name; ?>" class="form-control">
                                                                            <input type="hidden" required name="client_email" value="<?php echo $client->email; ?>" class="form-control">
                                                                            <input type="hidden" required name="trans_code" value="<?php echo $paycode; ?>" class="form-control">
                                                                            <input type="hidden" required name="subscription_id" value="<?php echo $invoice->subscription_id; ?>" class="form-control">
                                                                            <input type="hidden" required name="subscription_code" value="<?php echo $invoice->subscription_code; ?>" class="form-control">
                                                                            <input type="hidden" required name="package_code" value="<?php echo $invoice->package_code; ?>" class="form-control">
                                                                            <input type="hidden" required name="package_name" value="<?php echo $invoice->package_name; ?>" class="form-control">
                                                                            <input type="hidden" required name="amount" value="<?php echo $invoice->subscription_amt; ?>" class="form-control">
                                                                            <!-- Update On User Subscriptions -->
                                                                            <input type="hidden" required name="payment_status" value="Paid" class="form-control">
                                                                            <!-- Update On User Invoices -->
                                                                            <input type="hidden" required name="status" value="Paid" class="form-control">
                                                                            <input type="hidden" required name="invoice_id" value="<?php echo $invoice->id; ?>" class="form-control">
                                                                            <!-- Notification Details -->
                                                                            <input type="hidden" name="notification_from" value="Invoice Payment">
                                                                            <input type="hidden" name="notification_details" value="Hello, <?php echo $client->name; ?>. You Have Successfully Paid Invoiced Subscription For This Package: <?php echo $invoice->package_code . " " . $invoice->package_name; ?>">
                                                                            <!-- Mail To Client -->
                                                                            <input type="hidden" name="subject" value="Invoice #:<?php echo $invoice->invoice_code; ?> Payment">
                                                                            <input type="hidden" name="message" value="Hello, <?php echo $client->name; ?>, I hope you’re well!. You have successfully paid Ksh <?php echo $invoice->subscription_amt; ?> for  subscribed package :<b><?php echo $invoice->package_code . " " . $invoice->package_name; ?></b>.
                                                                    Kindly proceed to view your attached paid invoice on Invoices Tab on your dashboard.<br>
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
                                                                        <div class="form-group col-md-12">
                                                                            <label for="">Mobile Application Platform</label>
                                                                            <select class="form-control" name="mobile_platform">
                                                                                <option>Android </option>
                                                                                <option>iOs</option>
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="card-footer text-right">
                                                                    <button type="submit" name="requestForDownload" class="btn btn-primary">Submit</button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                        <div class="modal-footer justify-content-between">
                                                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- End Request -->
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