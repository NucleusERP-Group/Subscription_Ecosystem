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
/* Load Barcode Library And Composer */
require_once('../vendor/autoload.php');
$barcode = new \Com\Tecnick\Barcode\Barcode();
/* Generate A QR Code To Verify The Transaction */
$targetPath = "../public/barcodes/";
if (!is_dir($targetPath)) {
    mkdir($targetPath, 0777, true);
}
$code = $invoice->invoice_code;
$created_at = date('d M Y g:ia', strtotime($invoice->created_at));
$due = date_format($due_date, 'd M Y g:ia');
$amount = $invoice->subscription_amt;
$client_details = $invoice->client_name . " " . $invoice->client_email;
$qrcodedata = "Hello $client_details, Invoice Code: $code, Created At : $created_at , Due On: $due, Amount Invoiced: Ksh $amount.";
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
/* Add Invoice Payment */

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
                            <div id="PrintInvoice">
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
                                                            echo date_format($due_date, 'd M Y g:ia'); ?>
                                                            <br />
                                                            <?php
                                                            if ($invoice->status == 'Paid') {
                                                                echo "Payment Status: <span class='badge badge-pill badge-success'>Paid</span>";
                                                            } else {
                                                                echo "Payment Status: <span class='badge badge-pill badge-danger'>UnPaid</span>";
                                                            } ?>
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
                                    <br>
                                    <div class="text-center">
                                        <h6>Scan To Verify</h6>
                                        <!-- Dump Generated Barcode To Image -->
                                        <img src="<?php echo $targetPath . $timestamp; ?>.png" width="150px" height="150px">
                                    </div>
                                </div>
                            </div>
                            <br>
                            <div class="card-footer">
                                <div class="actions text-center">
                                    <button id="print" class="action-item" onclick="printContent('PrintInvoice');">
                                        <i class="far fa-print"></i>
                                        Print
                                    </button>
                                    <a href="client-download-invoice.php?print=<?php echo $invoice->id; ?>" target="_blank" class="action-item">
                                        <i class="far fa-download"></i> Download PDF
                                    </a>
                                    <?php
                                    if ($invoice->status == 'Paid') {
                                        echo
                                        "
                                            <a href='client-payment-history.php' class='action-item'>
                                                <i class='far fa-download'></i> View Payment Records
                                            </a>
                                        ";
                                    } else {
                                        echo
                                        "
                                            <a href='#pay-invoice-$invoice->id' data-toggle='modal' class='action-item'>
                                                <i class='far fa-plus'></i> Add Payment
                                            </a>
                                        ";
                                    } ?>
                                    <!-- Add Payment Modal -->
                                    <div class="modal fade" id="pay-invoice-<?php echo $invoice->id; ?>">
                                        <div class="modal-dialog  modal-lg">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h4 class="modal-title">Fill All Required Values </h4>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <!-- Add Module Form -->
                                                    <form method="post" enctype="multipart/form-data" role="form">
                                                        <div class="card-body">
                                                            <div class="row">
                                                                <div class="form-group col-md-4">
                                                                    <!-- Hidden Values -->
                                                                    <input type="hidden" required name="id" value="<?php echo $ID; ?>" class="form-control">
                                                                    <input type="hidden" required name="client_id" value="<?php echo $client->id; ?>" class="form-control">
                                                                    <input type="hidden" required name="client_name" value="<?php echo $client->name; ?>" class="form-control">
                                                                    <input type="hidden" required name="client_email" value="<?php echo $client->email; ?>" class="form-control">
                                                                    <input type="hidden" required name="trans_code" value="<?php echo $paycde; ?>" class="form-control">
                                                                    <input type="hidden" required name="subscription_id" value="<?php echo $invoice->subscription_id; ?>" class="form-control">
                                                                    <input type="hidden" required name="package_code" value="<?php echo $invoice->package_code; ?>" class="form-control">
                                                                    <input type="hidden" required name="package_name" value="<?php echo $invoice->package_name; ?>" class="form-control">
                                                                    <input type="hidden" required name="amount" value="<?php echo $invoice->subscription_amt; ?>" class="form-control">
                                                                    <!-- Update On User Subscriptions -->
                                                                    <input type="hidden" required name="payment_status" value="Paid" class="form-control">
                                                                    <!-- Update On User Invoices -->
                                                                    <input type="hidden" required name="status" value="Paid" class="form-control">

                                                                </div>
                                                                <div class="form-group col-md-12">
                                                                    <label for="">Credit / Debit Card Number</label>
                                                                    <select class="form-control" name="cc_number">
                                                                        <option>Select Credit / Debit Card</option>
                                                                        <?php
                                                                        $ret = "SELECT * FROM `NucleusSAASERP_UsersCards` WHERE card_holder_id = '$id' OR card_holder_email = '$email'   ";
                                                                        $stmt = $mysqli->prepare($ret);
                                                                        $stmt->execute(); //ok
                                                                        $res = $stmt->get_result();
                                                                        while ($card = $res->fetch_object()) {
                                                                        ?>
                                                                            <option><?php echo $card->card_number; ?></option>
                                                                        <?php
                                                                        } ?>
                                                                    </select>
                                                                </div>

                                                            </div>

                                                        </div>
                                                        <div class="card-footer text-right">
                                                            <button type="submit" name="paySubscription" class="btn btn-primary">Add Module</button>
                                                        </div>
                                                    </form>
                                                </div>
                                                <div class="modal-footer justify-content-between">
                                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
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