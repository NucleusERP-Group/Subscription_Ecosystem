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

/* Update User Profile */
if (isset($_POST['UpdateProfile'])) {
    //Error Handling and prevention of posting double entries
    $error = 0;

    if (isset($_SESSION['id']) && !empty($_SESSION['id'])) {
        $id = mysqli_real_escape_string($mysqli, trim($_SESSION['id']));
    } else {
        $error = 1;
        $err = "User ID Cannot Be Empty";
    }

    if (isset($_POST['name']) && !empty($_POST['name'])) {
        $name = mysqli_real_escape_string($mysqli, trim($_POST['name']));
    } else {
        $error = 1;
        $err = "Name Cannot Be Empty";
    }

    if (isset($_POST['phone']) && !empty($_POST['phone'])) {
        $phone = mysqli_real_escape_string($mysqli, trim($_POST['phone']));
    } else {
        $error = 1;
        $err = "Phone Cannot Be Empty";
    }


    if (isset($_POST['email']) && !empty($_POST['email'])) {
        $email = mysqli_real_escape_string($mysqli, trim($_POST['email']));
    } else {
        $error = 1;
        $err = "Email  Cannot Be Empty";
    }

    if (isset($_POST['company_name']) && !empty($_POST['company_name'])) {
        $company_name = mysqli_real_escape_string($mysqli, trim($_POST['company_name']));
    } else {
        $error = 1;
        $err = "Company Name  Cannot Be Empty";
    }

    if (isset($_POST['country']) && !empty($_POST['country'])) {
        $country = mysqli_real_escape_string($mysqli, trim($_POST['country']));
    } else {
        $error = 1;
        $err = "Country  Cannot Be Empty";
    }

    if (isset($_POST['city']) && !empty($_POST['city'])) {
        $city = mysqli_real_escape_string($mysqli, trim($_POST['city']));
    } else {
        $error = 1;
        $err = "City  Cannot Be Empty";
    }

    if (isset($_POST['adr']) && !empty($_POST['adr'])) {
        $adr = mysqli_real_escape_string($mysqli, trim($_POST['adr']));
    } else {
        $error = 1;
        $err = "Address  Cannot Be Empty";
    }

    if (isset($_POST['bio']) && !empty($_POST['bio'])) {
        $bio = mysqli_real_escape_string($mysqli, trim($_POST['bio']));
    } else {
        $error = 1;
        $err = "Bio Cannot Be Empty";
    }

    if (!$error) {

        $query = "UPDATE NucleusSAASERP_Users  SET name =?, phone =?, email =?, company_name =?, country =?, city =?, adr =?, bio =? WHERE id = ?";
        $stmt = $mysqli->prepare($query);
        $rc = $stmt->bind_param('sssssssss', $name, $phone, $email, $company_name, $country, $city, $adr, $bio, $id);
        $stmt->execute();
        if ($stmt) {
            $success = "Hello $name. Your Account Has Been Updated😉.";
        } else {
            $info = "Please Try Again Or Try Later";
        }
    }
}


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
            <?php require_once('../partials/dashboard_main_nav.php');
            /* Logged In Client Session */
            $id = $_SESSION['id'];
            $ret = "SELECT * FROM `NucleusSAASERP_Users` WHERE id = '$id'  ";
            $stmt = $mysqli->prepare($ret);
            $stmt->execute(); //ok
            $res = $stmt->get_result();
            while ($client = $res->fetch_object()) {
                require_once('../config/gravatar.php'); ?>
                <!-- Page content -->
                <div class="page-content">
                    <!-- Page title -->
                    <div class="page-title">
                        <div class="row justify-content-between align-items-center">
                            <div class="col-md-6 d-flex align-items-center justify-content-between justify-content-md-start mb-3 mb-md-0">
                                <!-- Page title + Go Back button -->
                                <div class="d-inline-block">
                                    <h5 class="h4 d-inline-block font-weight-400 mb-0 text-white">Account settings</h5>
                                </div>
                                <!-- Additional info -->
                            </div>
                            <div class="col-md-6 d-flex align-items-center justify-content-between justify-content-md-end">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-4 order-lg-2">
                            <div class="card">
                                <div class="list-group list-group-flush">
                                    <div class="list-group-item">
                                        <div class="media">
                                            <i class="far fa-user"></i>
                                            <div class="media-body ml-3">
                                                <a href="settings.html" class="stretched-link h6 mb-1">Settings</a>
                                                <p class="mb-0 text-sm">Details about your personal information</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="list-group-item">
                                        <div class="media">
                                            <i class="far fa-map-marker-alt"></i>
                                            <div class="media-body ml-3">
                                                <a href="addresses.html" class="stretched-link h6 mb-1">Addresses</a>
                                                <p class="mb-0 text-sm">Faster checkout with saved addresses</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="list-group-item">
                                        <div class="media">
                                            <i class="far fa-credit-card"></i>
                                            <div class="media-body ml-3">
                                                <a href="billing.html" class="stretched-link h6 mb-1">Billing</a>
                                                <p class="mb-0 text-sm">Speed up your shopping experience</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="list-group-item">
                                        <div class="media">
                                            <i class="far fa-file-invoice"></i>
                                            <div class="media-body ml-3">
                                                <a href="payment-history.html" class="stretched-link h6 mb-1">Payment history</a>
                                                <p class="mb-0 text-sm">See previous orders and invoices</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="list-group-item">
                                        <div class="media">
                                            <i class="far fa-bell"></i>
                                            <div class="media-body ml-3">
                                                <a href="notifications.html" class="stretched-link h6 mb-1">Notifications</a>
                                                <p class="mb-0 text-sm">Choose what notification you will receive</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-8 order-lg-1">
                            <!-- Change avatar -->
                            <div class="card bg-gradient-warning hover-shadow-lg border-0">
                                <div class="card-body py-3">
                                    <div class="row row-grid align-items-center">
                                        <div class="col-lg-8">
                                            <div class="media align-items-center">
                                                <a href="#" class="avatar avatar-lg rounded-circle mr-3">
                                                    <img alt="Image placeholder" src="<?php echo $grav_url; ?>">
                                                </a>
                                                <div class="media-body">
                                                    <h5 class="text-white mb-0"><?php echo $client->name; ?></h5>
                                                    <div>
                                                        <a href="https://en.gravatar.com/" target="_blank">
                                                            <span class="text-white">Change avatar</span>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- This Will Be Based On User SubScription Package -->
                                        <!-- <div class="col-auto flex-fill mt-4 mt-sm-0 text-sm-right d-none d-lg-block">
                                            <a href="#" class="btn btn-sm btn-white rounded-pill btn-icon shadow">
                                                <span class="btn-inner--icon"><i class="far fa-fire"></i></span>
                                                <span class="btn-inner--text">Upgrade to Pro</span>
                                            </a>
                                        </div> -->
                                    </div>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-body">
                                    <form method="POST">
                                        <!-- General information -->
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label class="form-control-label">Full Name</label>
                                                    <input name="name" value="<?php echo $client->name; ?>" class="form-control" type="text" placeholder="Enter your first name">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="form-control-label">Email Address</label>
                                                    <input class="form-control" type="email" name="email" value="<?php echo $client->email; ?>" placeholder="name@exmaple.com">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="form-control-label">Phone</label>
                                                    <input class="form-control" type="text" name="phone" value="<?php echo $client->phone; ?>" placeholder="+40-777 245 549">
                                                </div>
                                            </div>
                                        </div>
                                        <hr />
                                        <!-- Address -->
                                        <div class="row">
                                            <div class="col">
                                                <div class="form-group">
                                                    <label class="form-control-label">Company Name</label>
                                                    <input class="form-control" type="text" name="company_name" value="<?php echo $client->company_name; ?>" placeholder="Enter your company name">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col">
                                                <div class="form-group">
                                                    <label class="form-control-label">Address</label>
                                                    <input class="form-control" type="text" name="adr" value="<?php echo $client->adr; ?>" placeholder="Enter your home address">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="form-control-label">City</label>
                                                    <input class="form-control" type="text" name="city" value="<?php echo $client->city; ?>" placeholder="City">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="form-control-label">Country</label>
                                                    <input class="form-control" type="text" name="country" value="<?php echo $client->country; ?>" placeholder="Country">
                                                </div>
                                            </div>
                                        </div>
                                        <hr />
                                        <!-- Description -->
                                        <div class="row">
                                            <div class="col">
                                                <div class="form-group">
                                                    <div class="form-group">
                                                        <label class="form-control-label">Bio</label>
                                                        <textarea class="form-control" name="bio" placeholder="Tell us a few words about yourself" rows="3"><?php echo $client->bio; ?></textarea>
                                                        <small class="form-text text-muted mt-2">You can @mention other users and organizations to link to them.</small>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <hr />
                                        <!-- Save changes buttons -->
                                        <button type="submit" name="UpdateProfile" class="btn btn-sm btn-primary rounded-pill">Save changes</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Footer -->
            <?php require_once('../partials/dashboard_footer.php');
            } ?>
        </div>
    </div>
    <!-- Scripts -->
    <!-- Core JS - includes jquery, bootstrap, popper, in-view and sticky-kit -->
    <?php require_once('../partials/dashboard_scripts.php'); ?>
</body>


</html>