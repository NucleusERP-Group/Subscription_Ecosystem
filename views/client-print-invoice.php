<?php
/*
 * Created on Wed May 12 2021
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
                /* Load Specific Invoice Details */
                $print = $_GET['print'];
                $ret = "SELECT * FROM `NucleusSAASERP_UserInvoices` WHERE id = '$print' ";
                $stmt = $mysqli->prepare($ret);
                $stmt->execute(); //ok
                $res = $stmt->get_result();
                while ($invoice = $res->fetch_object()) {
            ?>

                    <!-- Page content -->
                    <div class="page-content">
                        <!-- Page title -->
                        <div class="page-title">
                            <div class="row justify-content-between align-items-center">
                                <div class="col-md-6 d-flex align-items-center justify-content-between justify-content-md-start mb-3 mb-md-0">
                                    <div class="d-inline-block">
                                        <h5 class="h4 d-inline-block font-weight-400 mb-0 text-white">Invoice <?php echo $invoice->invoice_code; ?></h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Listing -->
                        <div class="card">
                            <!-- Card header -->
                            <div class="invoice-box col-md-12 col-sm-12 col-xl-12">
                                <table cellpadding="0" cellspacing="0">
                                    <tr class="top">
                                        <td colspan="2">
                                            <table>
                                                <tr>
                                                    <td class="title">
                                                        <img src="https://www.sparksuite.com/images/logo.png" style="width: 100%; max-width: 300px" />
                                                    </td>
                                                    <td>
                                                        Invoice #: 123<br />
                                                        Created: January 1, 2015<br />
                                                        Due: February 1, 2015
                                                    </td>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>

                                    <tr class="information">
                                        <td colspan="2">
                                            <table>
                                                <tr>
                                                    <td>
                                                        Sparksuite, Inc.<br />
                                                        12345 Sunny Road<br />
                                                        Sunnyville, CA 12345
                                                    </td>

                                                    <td>
                                                        Acme Corp.<br />
                                                        John Doe<br />
                                                        john@example.com
                                                    </td>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>

                                    <tr class="heading">
                                        <td>Payment Method</td>

                                        <td>Check #</td>
                                    </tr>

                                    <tr class="details">
                                        <td>Check</td>

                                        <td>1000</td>
                                    </tr>

                                    <tr class="heading">
                                        <td>Item</td>

                                        <td>Price</td>
                                    </tr>

                                    <tr class="item">
                                        <td>Website design</td>

                                        <td>$300.00</td>
                                    </tr>

                                    <tr class="item">
                                        <td>Hosting (3 months)</td>

                                        <td>$75.00</td>
                                    </tr>

                                    <tr class="item last">
                                        <td>Domain name (1 year)</td>

                                        <td>$10.00</td>
                                    </tr>

                                    <tr class="total">
                                        <td></td>

                                        <td>Total: $385.00</td>
                                    </tr>
                                </table>
                            </div>

                        </div>
                    </div>
                    <!-- Footer -->
            <?php require_once('../partials/dashboard_footer.php');
                }
            } ?>
        </div>
    </div>
    <!-- Scripts -->
    <?php require_once('../partials/dashboard_scripts.php'); ?>
</body>



</html>