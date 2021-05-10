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


$id = $_SESSION['id'];
$email = $_SESSION['email'];
$ret = "SELECT * FROM `NucleusSAASERP_Users` WHERE id = '$id' OR email = '$email' ";
$stmt = $mysqli->prepare($ret);
$stmt->execute(); //ok
$res = $stmt->get_result();
while ($client = $res->fetch_object()) {
    require_once('../config/gravatar.php');
?>
    <div class="sidenav" id="sidenav-main">
        <!-- Sidenav header -->
        <div class="sidenav-header d-flex align-items-center">
            <a class="navbar-brand" href="client-dashboard.php">
                <img src="../public/img/logos/header-light.png" class="navbar-brand-img" alt="...">
            </a>
            <div class="ml-auto">
                <!-- Sidenav toggler -->
                <div class="sidenav-toggler sidenav-toggler-dark d-md-none" data-action="sidenav-unpin" data-target="#sidenav-main">
                    <div class="sidenav-toggler-inner">
                        <i class="sidenav-toggler-line bg-white"></i>
                        <i class="sidenav-toggler-line bg-white"></i>
                        <i class="sidenav-toggler-line bg-white"></i>
                    </div>
                </div>
            </div>
        </div>
        <!-- User mini profile -->
        <div class="sidenav-user d-flex flex-column align-items-center justify-content-between text-center">
            <!-- Avatar -->
            <div>
                <a href="#" class="avatar rounded-circle avatar-xl">
                    <img alt="Image placeholder" src="<?php echo $grav_url; ?>" class="">
                </a>
                <div class="mt-4">
                    <h5 class="mb-0 text-white"><?php echo $client->name; ?></h5>
                    <span class="d-block text-sm text-white opacity-8 mb-3"><?php echo $client->email; ?></span>
                </div>
            </div>

        </div>
        <!-- Application nav -->
        <div class="nav-application clearfix">
            <a href="client-dashboard.php" class="btn btn-square text-sm active">
                <span class="btn-inner--icon d-block"><i class="far fa-home fa-2x"></i></span>
                <span class="btn-inner--icon d-block pt-2">Home</span>
            </a>
            <a href="client-subscriptions.php" class="btn btn-square text-sm">
                <span class="btn-inner--icon d-block"><i class="far fa-project-diagram fa-2x"></i></span>
                <span class="btn-inner--icon d-block pt-2">Subscriptions</span>
            </a>
            <a href="client-invoices.php" class="btn btn-square text-sm">
                <span class="btn-inner--icon d-block"><i class="far fa-tasks fa-2x"></i></span>
                <span class="btn-inner--icon d-block pt-2">Invoices</span>
            </a>
            <a href="client-erp-instance.php" class="btn btn-square text-sm">
                <span class="btn-inner--icon d-block"><i class="far fa-columns fa-2x"></i></span>
                <span class="btn-inner--icon d-block pt-2">ERP Instace</span>
            </a>
            <a href="client-api-keys.php" class="btn btn-square text-sm">
                <span class="btn-inner--icon d-block"><i class="far fa-cogs fa-2x"></i></span>
                <span class="btn-inner--icon d-block pt-2">API Keys</span>
            </a>
            <a href="client-logout.php" class="btn btn-square text-sm">
                <span class="btn-inner--icon d-block"><i class="far fa-power-off fa-2x"></i></span>
                <span class="btn-inner--icon d-block pt-2">Log Out</span>
            </a>
        </div>

    </div>
<?php } ?>