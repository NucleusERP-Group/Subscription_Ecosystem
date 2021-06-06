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
                                    <h5 class="h4 d-inline-block font-weight-400 mb-0 text-white">Subscribed Clients Invoices</h5>
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
                                        <th scope="col">Number</th>
                                        <th scope="col" class="sort">Package</th>
                                        <th scope="col" class="sort">Invoiced Amount</th>
                                        <th scope="col" class="sort">Date Invoiced</th>
                                        <th scope="col" class="sort">Due Date</th>
                                        <th scope="col">Payment Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $ret = "SELECT * FROM `NucleusSAASERP_UserInvoices` ORDER BY `NucleusSAASERP_UserInvoices`.`created_at` ASC ";
                                    $stmt = $mysqli->prepare($ret);
                                    $stmt->execute(); //ok
                                    $res = $stmt->get_result();
                                    while ($invoices = $res->fetch_object()) {
                                        /* Date Invoice Created */
                                        $created_at = date('d M Y ', strtotime($invoices->created_at));
                                        $created = date_create(date('y-m-d ', strtotime($invoices->created_at)));
                                        /* Due Date */
                                        $due_date = date_add($created, date_interval_create_from_date_string('20 days'));
                                        $due = date_format($due_date, 'd M Y');
                                    ?>

                                        <tr>
                                            <td>
                                                <a href="admin-view-invoice?print=<?php echo $invoices->id; ?>" data-toggle="tooltip" title="View Invoice Details">
                                                    <span class="client"><?php echo $invoices->invoice_code; ?></span>
                                                </a>
                                            </td>
                                            <td class="order">
                                                <span class="h6 text-sm font-weight-bold mb-0"><?php echo $invoices->package_code; ?></span>
                                                <span class="d-block text-sm text-muted"><?php echo $invoices->package_name; ?></span>
                                            </td>
                                            <td>
                                                <span class="client">Ksh <?php echo $invoices->subscription_amt; ?></span>
                                            </td>
                                            <td>
                                                <span class="client"><?php echo $created_at; ?></span>
                                            </td>
                                            <td>
                                                <span class="client"><?php echo $due; ?></span>
                                            </td>
                                            <td>
                                                <?php
                                                if ($invoices->status == 'Paid') {
                                                    echo "<span class='badge badge-pill badge-success'>Paid</span>";
                                                } else {
                                                    echo "<span class='badge badge-pill badge-warning'>UnPaid</span>";
                                                } ?>
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