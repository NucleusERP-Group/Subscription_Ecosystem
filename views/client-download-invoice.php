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
        $html = '
        <!DOCTYPE html>
        <html>
            <head>
                <meta charset="utf-8" />
                
                <title> Invoice #' .$invoice->invoice_code. '</title>
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
                                        
                                        </td>

                                        <td>
                                            Invoice #:'.$invoice->invoice_code.'<br />
                                            Created:'.$created_at.'<br />
                                            Due: '.$due.'
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
                                            '.$invoice->client_name.'<br />
                                            '.$invoice->client_email.'<br />
                                            '.$client->phone.'
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
                            <td>'.$invoice->package_code.'<br>'. $invoice->package_name.' Subscription </td>

                            <td>Ksh '.$invoice->subscription_amt.'</td>
                        </tr>

                        <tr class="total">
                            <td></td>

                            <td>Total: Ksh '.$invoice->subscription_amt.'</td>
                        </tr>
                    </table>
                </div>
            </body>
        </html>
';
        $dompdf = new Dompdf();
        $dompdf->load_html($html);
        //$dompdf->set_paper('A4','landscape');
        $dompdf->set_paper('A4');
        $dompdf->set_option('isHtml5ParserEnabled', true);
        $dompdf->render();
        $dompdf->stream("$invoice->invoice_code", array("Attachment" => 1));
    }
}
