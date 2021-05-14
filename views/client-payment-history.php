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
require_once('../config/codeGen.php');
require_once('../config/checklogin.php');
client_login();

/* Delete Credit Cards */
if (isset($_GET['delete'])) {
    $delete = $_GET['delete'];
    $adn = "DELETE FROM NucleusSAASERP_UsersCards WHERE card_id=?";
    $stmt = $mysqli->prepare($adn);
    $stmt->bind_param('s', $delete);
    $stmt->execute();
    $stmt->close();
    if ($stmt) {
        $success = "Card Record Deleted" && header("refresh:1; url=client-billing.php");
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
            <?php require_once('../partials/dashboard_main_nav.php'); ?>
            <!-- Page content -->
            <div class="page-content">
                <!-- Page title -->
                <div class="page-title">
                    <div class="row justify-content-between align-items-center">
                        <div class="col-md-6 d-flex align-items-center justify-content-between justify-content-md-start mb-3 mb-md-0">
                            <!-- Page title + Go Back button -->
                            <div class="d-inline-block">
                                <h5 class="h4 d-inline-block font-weight-400 mb-0 text-white">Linked Cards Usage History</h5>
                            </div>
                            <!-- Additional info -->
                        </div>
                        <div class="col-md-6 d-flex align-items-center justify-content-between justify-content-md-end">
                        </div>
                    </div>
                </div>
                <!-- Nav -->
                <ul class="nav nav-dark nav-tabs nav-overflow">
                    <li class="nav-item">
                        <a href="client-billing.php" class="nav-link">
                            <i class="far fa-credit-card mr-2"></i>Cards
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="client-payment-history.php" class="nav-link active">
                            <i class="far fa-file-invoice mr-2"></i>History
                        </a>
                    </li>
                </ul>
                <div class="row">
                    <!-- User Profile Partial -->
                    <?php require_once('../partials/dashboard_usersettings.php'); ?>
                    <div class="col-lg-8 order-lg-1">
                        <!-- Payment history -->
                        <div class="card">
                            <!-- Card header -->
                            <div class="card-header actions-toolbar border-0">
                                <div class="actions-search" id="actions-search">
                                    <div class="input-group input-group-merge input-group-flush">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text bg-transparent"><i class="far fa-search"></i></span>
                                        </div>
                                        <input type="text" id="SearchInput" onkeyup="search()" class="form-control form-control-flush" placeholder="Type and hit enter ...">
                                        <div class="input-group-append">
                                            <a href="#" class="input-group-text bg-transparent" data-action="search-close" data-target="#actions-search"><i class="far fa-times"></i></a>
                                        </div>
                                    </div>
                                </div>
                                <div class="row justify-content-between align-items-center">
                                    <div class="col">
                                        <h6 class="d-inline-block mb-0">Linked Cards Payments History</h6>
                                    </div>
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
                                <table id="DataTable" class="table table-hover align-items-center">
                                    <thead>
                                        <tr>
                                            <th scope="col">Date</th>
                                            <th scope="col">Code</th>
                                            <th scope="col">Used card</th>
                                            <th scope="col">Amount</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $id = $_SESSION['id'];
                                        $email = $_SESSION['email'];
                                        $ret = "SELECT * FROM `NucleusSAASERP_SubscriptionsPayments` WHERE client_id = '$id'  OR client_email = '$email' ";
                                        $stmt = $mysqli->prepare($ret);
                                        $stmt->execute(); //ok
                                        $res = $stmt->get_result();
                                        while ($payments = $res->fetch_object()) {
                                        ?>
                                            <tr>
                                                <td>
                                                    <i class="far fa-calendar-alt mr-2"></i>
                                                    <span class="h6 text-sm"><?php echo date('M d Y g:ia', strtotime($payments->created_at));?></span>
                                                </td>
                                                <td><?php echo $payments->trans_code;?></td>
                                                <td><i class="far fa-credit-card mr-2"></i><?php echo $payments->cc_number;?></td>
                                                <td>Ksh <?php echo $payments->amount;?></td>
                                            </tr>
                                        <?php
                                        } ?>
                                    </tbody>
                                </table>
                            </div>
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