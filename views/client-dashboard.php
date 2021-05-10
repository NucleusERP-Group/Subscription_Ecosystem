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
                    <div class="col-xl-8 col-md-6">
                        <div class="card card-fluid">
                            <div class="card-header">
                                <h6 class="mb-0">Active Subscriptions</h6>
                            </div>
                            <div class="card-body">
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4 col-md-6">
                        <div class="card card-fluid">
                            <div class="card-body text-center d-flex flex-column justify-content-center">
                                <h5 class="mb-4">NucleusSaaSERP APIs Status</h5>
                                <div class="progress-circle progress-lg mx-auto" id="progress-5" data-progress="50" data-text="98" data-textclass="h1" data-color="warning"></div>
                                <div class="d-flex mt-4">
                                    <div class="col">
                                        <span class="d-block badge badge-dot badge-lg h6">
                                            <i class="bg-danger"></i>30 not sent
                                        </span>
                                        <span class="d-block badge badge-dot badge-lg h6">
                                            <i class="bg-success"></i>68 success
                                        </span>
                                    </div>
                                    <div class="col">
                                        <span class="d-block badge badge-dot badge-lg h6">
                                            <i class="bg-warning"></i>38 opened
                                        </span>
                                        <span class="d-block badge badge-dot badge-lg h6">
                                            <i class="bg-danger"></i>SMTP error
                                        </span>
                                    </div>
                                </div>
                                <a href="#" class="btn btn-block btn-secondary mt-auto">Open insights</a>
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