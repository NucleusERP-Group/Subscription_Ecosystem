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
$ret = "SELECT * FROM `NucleusSAASERP_Users` WHERE id = '$id' OR email = '$email'  ";
$stmt = $mysqli->prepare($ret);
$stmt->execute(); //ok
$res = $stmt->get_result();
while ($client = $res->fetch_object()) {
    require_once('../config/gravatar.php');
?>
    <nav class="navbar navbar-main navbar-expand-lg navbar-dark bg-primary navbar-border" id="navbar-main">
        <div class="container-fluid">
            <!-- Brand + Toggler (for mobile devices) -->
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar-main-collapse" aria-controls="navbar-main-collapse" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <!-- User's navbar -->
            <div class="navbar-user d-lg-none ml-auto">
                <ul class="navbar-nav flex-row align-items-center">
                    <li class="nav-item">
                        <a href="#" class="nav-link nav-link-icon sidenav-toggler" data-action="sidenav-pin" data-target="#sidenav-main"><i class="far fa-bars"></i></a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link nav-link-icon" data-action="omnisearch-open" data-target="#omnisearch"><i class="far fa-search"></i></a>
                    </li>

                    <li class="nav-item dropdown dropdown-animate">
                        <a class="nav-link nav-link-icon" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="far fa-bell"></i></a>
                        <div class="dropdown-menu dropdown-menu-right dropdown-menu-lg dropdown-menu-arrow p-0">
                            <div class="py-3 px-3">
                                <h5 class="heading h6 mb-0">Notifications</h5>
                            </div>
                            <div class="list-group list-group-flush">
                                <?php
                                $ret = "SELECT * FROM `NucleusSAASERP_UserNotifications` WHERE client_id = '$id' OR client_email = '$email' ORDER BY `NucleusSAASERP_UserNotifications`.`created_at` DESC LIMIT 3 ";
                                $stmt = $mysqli->prepare($ret);
                                $stmt->execute(); //ok
                                $res = $stmt->get_result();
                                while ($notif = $res->fetch_object()) {
                                ?>
                                    <a href="#" class="list-group-item list-group-item-action">
                                        <div class="d-flex align-items-center" data-toggle="tooltip" data-placement="right" data-title="<?php echo date('d M Y g:ia', strtotime($notif->created_at)); ?>">
                                            <div>
                                                <span class="avatar bg-primary text-white rounded-circle"><?php $notifdetails = "$notif->notification_from";
                                                                                                            echo substr($notifdetails, 0, 4); ?></span>
                                            </div>
                                            <div class="flex-fill ml-3">
                                                <div class="h6 text-sm mb-0"><?php echo $notif->notification_from; ?> <small class="float-right text-muted"><?php echo date('d M Y g:ia', strtotime($notif->created_at)); ?></small></div>
                                                <p class="text-sm lh-140 mb-0">
                                                    <?php echo $notif->notification_details; ?>
                                                </p>
                                            </div>
                                        </div>
                                    </a>
                                <?php } ?>

                            </div>
                            <div class="py-3 text-center">
                                <a href="client-notifications.php" class="link link-sm link--style-3">View all notifications</a>
                            </div>
                        </div>
                    </li>

                    <li class="nav-item dropdown dropdown-animate">
                        <a class="nav-link pr-lg-0" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <span class="avatar avatar-sm rounded-circle">
                                <img alt="Image placeholder" src="<?php echo $grav_url; ?>">
                            </span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-sm dropdown-menu-right dropdown-menu-arrow">
                            <h6 class="dropdown-header px-0">Hi, <?php echo $client->name; ?>!</h6>
                            <a href="client-profile.php" class="dropdown-item">
                                <i class="far fa-user"></i>
                                <span>My profile</span>
                            </a>
                            <a href="client-settings.php" class="dropdown-item">
                                <i class="far fa-cog"></i>
                                <span>Settings</span>
                            </a>
                            <a href="client-billing.php" class="dropdown-item">
                                <i class="far fa-credit-card"></i>
                                <span>Billing</span>
                            </a>
                            <a href="client-cancelled-packages.php" class="dropdown-item">
                                <i class="far fa-calendar-times"></i>
                                <span>Cancelled Packages</span>
                            </a>
                            <div class="dropdown-divider"></div>
                            <a href="client-logout.php" class="dropdown-item">
                                <i class="far fa-sign-out-alt"></i>
                                <span>Logout</span>
                            </a>
                        </div>
                    </li>
                </ul>
            </div>
            <!-- Navbar nav -->
            <div class="collapse navbar-collapse navbar-collapse-fade" id="navbar-main-collapse">
                <ul class="navbar-nav ml-lg-auto align-items-center d-none d-lg-flex">
                    <li class="nav-item">
                        <a href="#" class="nav-link nav-link-icon sidenav-toggler" data-action="sidenav-pin" data-target="#sidenav-main"><i class="far fa-bars"></i></a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link nav-link-icon" data-action="omnisearch-open" data-target="#omnisearch"><i class="far fa-search"></i></a>
                    </li>
                    <li class="nav-item dropdown dropdown-animate">
                        <a class="nav-link nav-link-icon" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="far fa-bell"></i></a>
                        <div class="dropdown-menu dropdown-menu-right dropdown-menu-lg dropdown-menu-arrow p-0">
                            <div class="py-3 px-3">
                                <h5 class="heading h6 mb-0">Notifications</h5>
                            </div>
                            <div class="list-group list-group-flush">
                                <?php
                                $ret = "SELECT * FROM `NucleusSAASERP_UserNotifications` WHERE client_id = '$id' OR client_email = '$email'  ORDER BY `NucleusSAASERP_UserNotifications`.`created_at` DESC LIMIT 3 ";
                                $stmt = $mysqli->prepare($ret);
                                $stmt->execute(); //ok
                                $res = $stmt->get_result();
                                while ($notif = $res->fetch_object()) {
                                ?>
                                    <a href="#" class="list-group-item list-group-item-action">
                                        <div class="d-flex align-items-center" data-toggle="tooltip" data-placement="right" data-title="<?php echo date('d M Y g:ia', strtotime($notif->created_at)); ?>">
                                            <div>
                                                <span class="avatar bg-primary text-white rounded-circle"><?php $notifdetails = "$notif->notification_from";
                                                                                                            echo substr($notifdetails, 0, 4); ?></span>
                                            </div>
                                            <div class="flex-fill ml-3">
                                                <div class="h6 text-sm mb-0"><?php echo $notif->notification_from; ?> <small class="float-right text-muted"><?php echo date('d M Y g:ia', strtotime($notif->created_at)); ?></small></div>
                                                <p class="text-sm lh-140 mb-0">
                                                    <?php echo $notif->notification_details; ?>
                                                </p>
                                            </div>
                                        </div>
                                    </a>
                                <?php } ?>
                            </div>
                            <div class="py-3 text-center">
                                <a href="client-notifications.php" class="link link-sm link--style-3">View all notifications</a>
                            </div>
                        </div>
                    </li>
                    <li class="nav-item dropdown dropdown-animate">
                        <a class="nav-link pr-lg-0" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <div class="media media-pill align-items-center">
                                <span class="avatar rounded-circle">
                                    <img alt="Image placeholder" src="<?php echo $grav_url; ?>">
                                </span>
                                <div class="ml-2 d-none d-lg-block">
                                    <span class="mb-0 text-sm  font-weight-bold"><?php echo $client->name; ?></span>
                                </div>
                            </div>
                        </a>
                        <div class="dropdown-menu dropdown-menu-sm dropdown-menu-right dropdown-menu-arrow">
                            <h6 class="dropdown-header px-0">Hi, <?php echo $client->name; ?>!</h6>
                            <a href="client-profile.php" class="dropdown-item">
                                <i class="far fa-user"></i>
                                <span>My profile</span>
                            </a>
                            <a href="client-settings.php" class="dropdown-item">
                                <i class="far fa-cog"></i>
                                <span>Settings</span>
                            </a>
                            <a href="client-billing.php" class="dropdown-item">
                                <i class="far fa-credit-card"></i>
                                <span>Billing</span>
                            </a>
                            <a href="client-cancelled-packages.php" class="dropdown-item">
                                <i class="far fa-calendar-times"></i>
                                <span>Cancelled Subscriptions</span>
                            </a>
                            <div class="dropdown-divider"></div>
                            <a href="client-logout.php" class="dropdown-item">
                                <i class="far fa-sign-out-alt"></i>
                                <span>Logout</span>
                            </a>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <!-- Omnisearch -->
    <div id="omnisearch" class="omnisearch">
        <div class="container">
            <!-- Search form -->
            <form class="omnisearch-form">
                <div class="form-group">
                    <div class="input-group input-group-merge input-group-flush">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="far fa-search"></i></span>
                        </div>
                        <input type="text" class="form-control" placeholder="Type and hit enter ...">
                    </div>
                </div>
            </form>
            <div class="omnisearch-suggestions">
                <h6 class="heading">Search Suggestions</h6>
                <div class="row">
                    <div class="col-sm-6">
                        <ul class="list-unstyled mb-0">
                            <li>
                                <a class="list-link" href="client-profile.php">
                                    <i class="far fa-search"></i>
                                    <span>Profile & Settings</span>
                                </a>
                            </li>
                            <li>
                                <a class="list-link" href="client-billing.php">
                                    <i class="far fa-search"></i>
                                    <span>Billings & Billing History</span>
                                </a>
                            </li>
                            <li>
                                <a class="list-link" href="client-subscriptions.php">
                                    <i class="far fa-search"></i>
                                    <span>Subscriptions</span>
                                </a>
                            </li>
                            <li>
                                <a class="list-link" href="client-erp-instance.php">
                                    <i class="far fa-search"></i>
                                    <span>ERP Instance</span>
                                </a>
                            </li>
                            <li>
                                <a class="list-link" href="client-invoices.php">
                                    <i class="far fa-search"></i>
                                    <span>Invoices</span>
                                </a>
                            </li>
                            <li>
                                <a class="list-link" href="client-api-keys.php">
                                    <i class="far fa-search"></i>
                                    <span>Market Place API Keys</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php } ?>