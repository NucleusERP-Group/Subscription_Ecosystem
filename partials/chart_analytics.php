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



/* 1. Subscripions Per Package */
$query = "SELECT COUNT(*)  FROM `NucleusSAASERP_UserSubscriptions` WHERE  package_code = 'C0MM001'  ";
$stmt = $mysqli->prepare($query);
$stmt->execute();
$stmt->bind_result($community_version);
$stmt->fetch();
$stmt->close();

$query = "SELECT COUNT(*)  FROM `NucleusSAASERP_UserSubscriptions` WHERE  package_code = 'ENT002'  ";
$stmt = $mysqli->prepare($query);
$stmt->execute();
$stmt->bind_result($enterprise_version);
$stmt->fetch();
$stmt->close();


/* 2. Payments Overview */
$query = "SELECT SUM(subscription_amt)  FROM `NucleusSAASERP_UserInvoices` WHERE  status = 'Paid'  ";
$stmt = $mysqli->prepare($query);
$stmt->execute();
$stmt->bind_result($paid_invoices);
$stmt->fetch();
$stmt->close();

$query = "SELECT SUM(subscription_amt)  FROM `NucleusSAASERP_UserInvoices` WHERE  status = ''  ";
$stmt = $mysqli->prepare($query);
$stmt->execute();
$stmt->bind_result($unpaid_invoices);
$stmt->fetch();
$stmt->close();
