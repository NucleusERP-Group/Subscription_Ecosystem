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
require_once('../vendor/autoload.php');

use Dompdf\Dompdf;

$barcode = new \Com\Tecnick\Barcode\Barcode();


$dompdf = new Dompdf();
$$id = $_SESSION['id'];
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
        /* Date Invoice Created */
        $created_at = date('d M Y g:ia', strtotime($invoice->created_at));
        $created = date_create(date('y-m-d g:ia', strtotime($invoice->created_at)));
        /* Due Date */
        $due_date = date_add($created, date_interval_create_from_date_string('20 days'));
        $due = date_format($due_date, 'd M Y g:ia');

        /* Convert Logo To Base64 Image */
        $path = '../public/img/logos/Logo.png';
        $type = pathinfo($path, PATHINFO_EXTENSION);
        $data = file_get_contents($path);
        $base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);

        /* Generate QR Code */
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

        /* Convert This QR Code To Base 64 Image */
        $qrpath = $targetPath . $timestamp . '.png';
        $qrtype = pathinfo($path, PATHINFO_EXTENSION);
        $qrdata = file_get_contents($qrpath);
        $qrbase64 = 'data:image/' . $qrtype . ';base64,' . base64_encode($qrdata);

        /* Payment Status */
        if ($invoice->status == 'Paid') {
            $payment_status = '<span class="badge badge-pill badge-success">Paid</span>';
        } else {
            $payment_status = '<span class="badge badge-pill badge-danger">UnPaid</span>';
        } 

        $html = '
        <!DOCTYPE html>
        <html>
            <head>
                <meta charset="utf-8" />
                
                <title> Invoice #' . $invoice->invoice_code . '</title>
                <style>
                    .invoice-box {
                        margin: auto;
                        padding: 30px;
                        border: 1px solid #eee;
                        box-shadow: 0 0 10px rgba(0, 0, 0, 0.15);
                        font-size: 16px;
                        line-height: 24px;
                        font-family: "Helvetica Neue", "Helvetica", Helvetica, Arial, sans-serif;
                        color: #555;
                    }

                    .invoice-box table {
                        width: 100%;
                        line-height: inherit;
                        text-align: left;
                    }

                    .invoice-box table td {
                        padding: 5px;
                        vertical-align: top;
                    }

                    .invoice-box table tr td:nth-child(2) {
                        text-align: right;
                    }

                    .invoice-box table tr.top table td {
                        padding-bottom: 20px;
                    }

                    .invoice-box table tr.top table td.title {
                        font-size: 45px;
                        line-height: 45px;
                        color: #333;
                    }

                    .invoice-box table tr.information table td {
                        padding-bottom: 40px;
                    }

                    .invoice-box table tr.heading td {
                        background: #eee;
                        border-bottom: 1px solid #ddd;
                        font-weight: bold;
                    }

                    .invoice-box table tr.details td {
                        padding-bottom: 20px;
                    }

                    .invoice-box table tr.item td {
                        border-bottom: 1px solid #eee;
                    }

                    .invoice-box table tr.item.last td {
                        border-bottom: none;
                    }

                    .invoice-box table tr.total td:nth-child(2) {
                        border-top: 2px solid #eee;
                        font-weight: bold;
                    }

                    @media only screen and (max-width: 600px) {
                        .invoice-box table tr.top table td {
                            width: 100%;
                            display: block;
                            text-align: center;
                        }

                        .invoice-box table tr.information table td {
                            width: 100%;
                            display: block;
                            text-align: center;
                        }
                    }

                    /** RTL **/
                    .invoice-box.rtl {
                        direction: rtl;
                        font-family: Tahoma, "Helvetica Neue", "Helvetica", Helvetica, Arial, sans-serif;
                    }

                    .invoice-box.rtl table {
                        text-align: right;
                    }

                    .invoice-box.rtl table tr td:nth-child(2) {
                        text-align: left;
                    }
                    .center {
                        text-align: center;
                      }
                </style>
            </head>

            <body>
                <div class="invoice-box">
                    <table cellpadding="0" cellspacing="0">
                        <tr class="top">
                            <td colspan="2">
                                <table>
                                    <tr>
                                        <td class="title">
                                            <img src="' . $base64 . '" height="150" width="150" />
                                        </td>

                                        <td>
                                            Invoice #: ' . $invoice->invoice_code . '<br />
                                            Created: ' . $created_at . '<br />
                                            Due: ' . $due . ' <br/ >
                                            Payment Status: '.$payment_status. '
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
                                            ' . $invoice->client_name . '<br />
                                            ' . $invoice->client_email . '<br />
                                            ' . $client->phone . '
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
                            <td>' . $invoice->package_code . '<br>' . $invoice->package_name . ' Subscription </td>

                            <td>Ksh ' . $invoice->subscription_amt . '</td>
                        </tr>

                        <tr class="total">
                            <td></td>

                            <td>Total: Ksh ' . $invoice->subscription_amt . '</td>
                        </tr>
                    </table>
                    <br>
                    <br>
                    <br>
                    <br>
                    <div class="center">
                        <h6>Scan To Verify</h6>
                        <img src="' . $qrbase64 . '" width="200px" height="200px">
                    </div>
                </div>
            </body>
        </html>
';
        $dompdf = new Dompdf();
        $dompdf->load_html($html);
        $dompdf->set_paper('A4');
        $dompdf->set_option('isHtml5ParserEnabled', true);
        $dompdf->render();
        $dompdf->stream("$invoice->invoice_code", array("Attachment" => 1));
        $options = $dompdf->getOptions();
        $options->setDefaultFont('');
        $dompdf->setOptions($options);
    }
}
