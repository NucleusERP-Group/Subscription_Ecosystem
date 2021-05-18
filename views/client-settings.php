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

/* Delete Account */
if (isset($_POST['DeleteAccount'])) {

    //Change Password
    $error = 0;
    if (isset($_SESSION['email']) && !empty($_SESSION['email'])) {
        $email = mysqli_real_escape_string($mysqli, trim($_SESSION['email']));
    } else {
        $error = 1;
        $err = "Email Cannot Be Empty";
    }
    if (isset($_POST['password']) && !empty($_POST['password'])) {
        $password = mysqli_real_escape_string($mysqli, trim(sha1(md5($_POST['password']))));
    } else {
        $error = 1;
        $err = "Password Cannot Be Empty";
    }
    if (isset($_POST['account_status']) && !empty($_POST['account_status'])) {
        $account_status = mysqli_real_escape_string($mysqli, trim($_POST['account_status']));
    } else {
        $error = 1;
        $err = "Account Status Cannot Be Empty";
    }
    if (isset($_SESSION['id']) && !empty($_SESSION['id'])) {
        $id = mysqli_real_escape_string($mysqli, trim($_SESSION['id']));
    } else {
        $error = 1;
        $err = "Account Session ID Cannot Be Empty";
    }


    if (!$error) {
        $sql = "SELECT * FROM  NucleusSAASERP_Users  WHERE id = '$id' || email = '$email'";
        $res = mysqli_query($mysqli, $sql);
        if (mysqli_num_rows($res) > 0) {
            $row = mysqli_fetch_assoc($res);
            if ($email != $row['email']) {
                $err =  "Please Enter Correct Account Email";
            } elseif ($password != $row['password']) {
                $err = "Incorrect Account Password";
            } else {
                $query = "UPDATE NucleusSAASERP_Users SET account_status =? WHERE id =? || email = ?";
                $stmt = $mysqli->prepare($query);
                $rc = $stmt->bind_param('sss', $account_status, $id, $email);
                $stmt->execute();
                if ($stmt) {
                    $success = "Account Deleted"  && header("refresh:1; url=client-logout.php");;
                } else {
                    $err = "Please Try Again Or Try Later";
                }
            }
        }
    }
}
/* Change Password */
if (isset($_POST['change_password'])) {

    //Change Password
    $error = 0;
    /* if (isset($_POST['old_password']) && !empty($_POST['old_password'])) {
        $old_password = mysqli_real_escape_string($mysqli, trim(sha1(md5($_POST['old_password']))));
    } else {
        $error = 1;
        $err = "Old Password Cannot Be Empty";
    } */
    if (isset($_POST['new_password']) && !empty($_POST['new_password'])) {
        $new_password = mysqli_real_escape_string($mysqli, trim(sha1(md5($_POST['new_password']))));
    } else {
        $error = 1;
        $err = "New Password Cannot Be Empty";
    }
    if (isset($_POST['confirm_password']) && !empty($_POST['confirm_password'])) {
        $confirm_password = mysqli_real_escape_string($mysqli, trim(sha1(md5($_POST['confirm_password']))));
    } else {
        $error = 1;
        $err = "Confirmation Password Cannot Be Empty";
    }

    if (!$error) {
        $id = $_SESSION['id'];
        $email = $_SESSION['email '];
        $sql = "SELECT * FROM  NucleusSAASERP_Users  WHERE id = '$id' || email = '$email'";
        $res = mysqli_query($mysqli, $sql);
        if (mysqli_num_rows($res) > 0) {
            $row = mysqli_fetch_assoc($res);
            if ($new_password != $confirm_password) {
                $err = "Confirmation Password Does Not Match";
            } else {
                $new_password  = sha1(md5($_POST['new_password']));
                $query = "UPDATE NucleusSAASERP_Users SET  password =? WHERE id =? || email = '$email'";
                $stmt = $mysqli->prepare($query);
                $rc = $stmt->bind_param('sss', $new_password, $id, $email);
                $stmt->execute();
                if ($stmt) {
                    $success = "Password Updated.";
                } else {
                    $err = "Please Try Again Or Try Later";
                }
            }
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
            $email = $_SESSION['email'];
            $ret = "SELECT * FROM `NucleusSAASERP_Users` WHERE id = '$id' || email = '$email' ";
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
                                    <h5 class="h4 d-inline-block font-weight-400 mb-0 text-white">Account Settings</h5>
                                </div>
                                <!-- Additional info -->
                            </div>
                            <div class="col-md-6 d-flex align-items-center justify-content-between justify-content-md-end">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <!-- User Profile Partial -->
                        <?php require_once('../partials/dashboard_usersettings.php'); ?>
                        <div class="col-lg-8 order-lg-1">
                            <div class="card">
                                <div class="card-header">
                                    <h5 class=" h6 mb-0">Change Password</h5>
                                </div>
                                <div class="card-body">
                                    <form method="post">
                                        <!-- 
                                            <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label class="form-control-label">Old password</label>
                                                    <input class="form-control" name="old_password" type="password">
                                                </div>
                                            </div>
                                        </div> -->
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="form-control-label">New Password</label>
                                                    <input class="form-control" name="new_password" type="password">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="form-control-label">Confirm Password</label>
                                                    <input class="form-control" name="confirm_password" type="password">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="mt-4">
                                            <button type="submit" name="change_password" class="btn btn-sm btn-primary rounded-pill">Update Password</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-header">
                                    <h5 class=" h6 mb-0">Danger Zone</h5>
                                </div>
                                <div class="card-body">
                                    <!-- Button trigger modal -->
                                    <button type="button" class="btn btn-sm btn-danger rounded-pill" data-toggle="modal" data-target="#modal-delete-account">Delete My Account</button>
                                    <!-- Modal -->
                                    <div class="modal modal-danger fade" id="modal-delete-account" tabindex="-1" role="dialog" aria-labelledby="modal-delete-account" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                            <form class="form-danger" method="POST">
                                                <div class="modal-content">
                                                    <div class="modal-body">
                                                        <div class="text-center">
                                                            <i class="far fa-exclamation-circle fa-3x opacity-8"></i>
                                                            <h5 class="text-white mt-4">Should We Stop Now?</h5>
                                                            <p class="text-sm text-sm">All Your Data Will Be Erased. You Will No Longer Be Billed, And Your Username Will Be Available To Anyone.</p>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="form-control-label text-white">You Email</label>
                                                            <input class="form-control" required value="<?php echo $client->email; ?>" readonly name="email" type="text">
                                                            <input class="form-control" required name="account_status" value="1" type="hidden">
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="form-control-label text-white">To Verify, Type <span class="font-italic">Delete My Account</span> Below</label>
                                                            <input class="form-control" required type="text">
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="form-control-label text-white">Your Password</label>
                                                            <input class="form-control" required name="password" type="password">
                                                        </div>
                                                        <div class="mt-4">
                                                            <button type="submit" name="DeleteAccount" class="btn btn-block btn-sm btn-white text-danger rounded-pill">Delete My Account</button>
                                                            <button type="button" class="btn btn-block btn-sm btn-link text-light mt-4" data-dismiss="modal">Not This Time</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
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