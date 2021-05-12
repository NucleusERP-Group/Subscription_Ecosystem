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
require_once('../partials/analytics.php');
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
                            <div class="col-md-6 d-flex align-items-center justify-content-between justify-content-md-start mb-3 mb-md-0">
                                <!-- Page title + Go Back button -->
                                <div class="d-inline-block">
                                    <h5 class="h4 d-inline-block font-weight-400 mb-0 text-white">Invoices</h5>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Listing -->
                    <div class="card">
                        <!-- Card header -->
                        <div class="card-header actions-toolbar border-0">
                            <div class="actions-search" id="actions-search">
                                <div class="input-group input-group-merge input-group-flush">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-transparent"><i class="far fa-search"></i></span>
                                    </div>
                                    <input type="text" id="SearchInput" onkeyup="search()" class="form-control form-control-flush" placeholder="Type Invoice Number ...">
                                    <div class="input-group-append">
                                        <a href="#" class="input-group-text bg-transparent" data-action="search-close" data-target="#actions-search"><i class="far fa-times"></i></a>
                                    </div>
                                </div>
                            </div>
                            <div class="row justify-content-between align-items-center">

                                <div class="col text-right">
                                    <div class="actions"><a href="#" class="action-item mr-3" data-action="search-open" data-target="#actions-search"><i class="far fa-search"></i></a>
                                        <div class="dropdown mr-3">
                                            <a href="#" class="action-item" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <i class="far fa-filter"></i>
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-right">
                                                <button class="dropdown-item" onclick="sortTable()">
                                                    <i class="far fa-sort-alpha-down"></i>Sort
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Table -->
                        <div class="table-responsive">
                            <table id="DataTable" class="table align-items-center">
                                <thead>
                                    <tr>
                                        <th scope="col">Invoice Code</th>
                                        <th scope="col" class="sort">Subscription Package</th>
                                        <th scope="col" class="sort">Invoiced Amount</th>
                                        <th scope="col" class="sort">Date Invoices</th>
                                        <th scope="col">Manage Invoices</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $ret = "SELECT * FROM `NucleusSAASERP_UserInvoices` WHERE client_id = '$id' OR client_email = '$email' ";
                                    $stmt = $mysqli->prepare($ret);
                                    $stmt->execute(); //ok
                                    $res = $stmt->get_result();
                                    while ($invoices = $res->fetch_object()) {
                                    ?>
                                        <tr>
                                            <td>
                                                <span class="client"><?php echo $invoices->invoice_code; ?></span>
                                            </td>
                                            <td class="order">
                                                <span class="h6 text-sm font-weight-bold mb-0"><?php echo $invoices->package_code; ?></span>
                                                <span class="d-block text-sm text-muted"><?php echo $invoices->package_name; ?></span>
                                            </td>
                                            <td>
                                                <span class="client">Ksh <?php echo $invoices->subscription_amt; ?></span>
                                            </td>
                                            <td>
                                                <span class="client"><?php echo date('d M Y g:ia', strtotime($invoices->created_at)); ?></span>
                                            </td>
                                            <td>

                                                <div class="actions ml-3">
                                                    <?php
                                                    if ($invoices->status != '') {
                                                        /* Nothing */                                                        
                                                    } else {
                                                        echo '
                                                        <a href="#" class="action-item mr-2" data-toggle="tooltip" title="Pay Inoice">
                                                            <i class="far fa-file-invoice-dollar"></i> Pay Invoice
                                                        </a>
                                                        ';
                                                    } ?>
                                                    <a href="client-print-invoice.php?print=<?php echo $invoices->id;?>" class="action-item mr-2" data-toggle="tooltip" title="Print Invoice">
                                                        <i class="far fa-print"></i> Print
                                                    </a>
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