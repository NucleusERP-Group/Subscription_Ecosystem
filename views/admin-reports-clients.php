<?php
/*
 * Created on Mon May 17 2021
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
                                    <h5 class="h4 d-inline-block font-weight-400 mb-0 text-white">NucleusSaaS ERP Clients Reports</h5>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <br>
                <!-- Listing -->
                <div class="card">
                    <div class="table-responsive card-body">
                        <table id="ReportsDataTable" class="table ">
                            <thead>
                                <tr>
                                    <th scope="col">Name</th>
                                    <th scope="col" class="sort">Contacts & Address</th>
                                    <th scope="col" class="sort">Company Details</th>
                                    <th scope="col" class="sort">Account Status</th>
                                    <th scope="col" class="sort">Date Joined</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                /* Load All NucleusSaaS ERP Users Except Logged In Admin */
                                $ret = "SELECT * FROM `NucleusSAASERP_Users` ";
                                $stmt = $mysqli->prepare($ret);
                                $stmt->execute(); //ok
                                $res = $stmt->get_result();
                                while ($users = $res->fetch_object()) {
                                ?>

                                    <tr>
                                        <td>
                                            <?php echo $users->name; ?>
                                        </td>
                                        <td class="order">
                                            <span class="d-block text-sm text-muted"><?php echo $users->email; ?></span>
                                            <span class="d-block text-sm text-muted"><?php echo $users->phone; ?></span>
                                            <span class="d-block text-sm text-muted"><?php echo $users->adr; ?></span>
                                        </td>
                                        <td class="order">
                                            <span class="d-block text-sm text-muted"><?php echo $users->company_name; ?></span>
                                        </td>
                                        <td>
                                            <?php
                                            if ($users->account_status == '0') {
                                                echo "<span class='badge badge-pill badge-success'>Active</span>";
                                            } else {
                                                echo "<span class='badge badge-pill badge-danger'>Deleted</span>";
                                            } ?>
                                        </td>
                                        <td>
                                            <span class="client"><?php echo date('d M Y g:ia', strtotime($users->joined_on)); ?></span>
                                        </td>
                                    </tr>
                                <?php
                                } ?>
                            </tbody>
                        </table>
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