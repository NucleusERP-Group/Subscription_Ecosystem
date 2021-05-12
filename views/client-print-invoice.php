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
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();
require_once('../config/config.php');
require_once('../config/checklogin.php');
require_once('../partials/analytics.php');
client_login();
/* Load Barcode Library And Composer */
require_once('../vendor/autoload.php');
$barcode = new \Com\Tecnick\Barcode\Barcode();

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
                                                        <img src="../public/img/logos/Logo.png" height="150" width="150" />
                                                    </td>
                                                    <td>
                                                        Invoice #: <?php echo $invoice->invoice_code; ?><br />
                                                        Subscription #: <?php echo $invoice->subscription_code; ?><br />
                                                        Created: <?php echo date('d M Y g:ia', strtotime($invoice->created_at)); ?><br />
                                                        Due:
                                                        <?php
                                                        /* All NucleusSaaSERP Invoices Are Due In 20 Days */
                                                        $created_at = date_create(date('y-m-d g:ia', strtotime($invoice->created_at)));
                                                        $due_date = date_add($created_at, date_interval_create_from_date_string('20 days'));
                                                        echo date_format($due_date, 'd M Y g:ia');
                                                        ?>
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
                                                        NucleusSaaS ERP Group.<br />
                                                        120-90125.<br />
                                                        Machakos.
                                                    </td>

                                                    <td>
                                                        <?php echo $invoice->client_name; ?><br />
                                                        <?php echo $invoice->client_email; ?><br />
                                                        <?php echo $client->phone; ?>
                                                    </td>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>

                                    <tr class="heading">
                                        <td>Item</td>

                                        <td>Price</td>
                                    </tr>

                                    <tr class="item">
                                        <td><?php echo $invoice->package_code . " <br> " .  $invoice->package_name; ?> Subscription </td>

                                        <td>Ksh <?php echo $invoice->subscription_amt; ?></td>
                                    </tr>
                                    <tr class="total">
                                        <td></td>

                                        <td>Total: Ksh <?php echo $invoice->subscription_amt; ?></td>
                                    </tr>
                                </table>
                                <div class="text-center">
                                    <h6>Scan To Verify</h6>
                                    <?php
                                    $targetPath = "../public/barcodes/";
                                    if (!is_dir($targetPath)) {
                                        mkdir($targetPath, 0777, true);
                                    }
                                    $code = $invoice->invoice_code;
                                    $created_at = date('d M Y g:ia', strtotime($invoice->created_at));
                                    $due = date_format($due_date, 'd M Y g:ia');
                                    $amount = $invoice->subscription_amt;
                                    $client = $invoice->client_name . " " . $invoice->client_email;
                                    $qrcodedata = "Hello $client, Invoice Code: $code, Created At : $created_at , Due On: $due, Amount Invoiced: Ksh $amount.";
                                    $bobj = $barcode->getBarcodeObj(
                                        'QRCODE,H',
                                        "{$qrcodedata}",
                                        -4,
                                        -4,
                                        'black',
                                        array(-2, -2, -2, -2)
                                    )->setBackgroundColor('white');
                                    $imageData = $bobj->getPngData();
                                    $timestamp = time();
                                    file_put_contents($targetPath . $timestamp . '.png', $imageData);
                                    ?>
                                    <!-- Dump Generated Barcode To Image -->
                                    <img height="150" width="150" src="<?php echo $targetPath . $timestamp; ?>.png">
                                </div>
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