<?php
/*
 * Created on Tue May 11 2021
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

$id = $_SESSION['id'];
$email = $_SESSION['email'];

/* Active Subscriptions */
$query = "SELECT COUNT(*)  FROM `NucleusSAASERP_UserSubscriptions` WHERE client_id = '$id' AND status = 'Active'  ";
$stmt = $mysqli->prepare($query);
$stmt->execute();
$stmt->bind_result($ActiveSubscriptions);
$stmt->fetch();
$stmt->close();

/* Cancelled Subscriptions */
$query = "SELECT COUNT(*)  FROM `NucleusSAASERP_UserSubscriptions` WHERE client_id = '$id' AND status = 'Cancelled'  ";
$stmt = $mysqli->prepare($query);
$stmt->execute();
$stmt->bind_result($StalledSubscriptions);
$stmt->fetch();
$stmt->close();

/* Unpaid Invoices */
$query = "SELECT COUNT(*)  FROM `NucleusSAASERP_SubscriptionsPayments` WHERE client_id = '$id' AND status = 'Unpaid'  ";
$stmt = $mysqli->prepare($query);
$stmt->execute();
$stmt->bind_result($UnpaidInvoices);
$stmt->fetch();
$stmt->close();

/* Linked Cards */
$query = "SELECT COUNT(*)  FROM `NucleusSAASERP_UsersCards` WHERE card_holder_id = '$id' ";
$stmt = $mysqli->prepare($query);
$stmt->execute();
$stmt->bind_result($LinkedCards);
$stmt->fetch();
$stmt->close();

/* Pending Payments */
$query = "SELECT COUNT(*)  FROM `NucleusSAASERP_SubscriptionsPayments` WHERE client_id = '$id' AND status = 'Unpaid'  ";
$stmt = $mysqli->prepare($query);
$stmt->execute();
$stmt->bind_result($PendingPayments);
$stmt->fetch();
$stmt->close();

/* Paid Invoices */
$query = "SELECT SUM(amount)  FROM `NucleusSAASERP_SubscriptionsPayments` WHERE client_id = '$id' AND status = 'Paid'  ";
$stmt = $mysqli->prepare($query);
$stmt->execute();
$stmt->bind_result($Payments);
$stmt->fetch();
$stmt->close();