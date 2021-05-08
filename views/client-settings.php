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
    if (isset($_POST['email']) && !empty($_POST['email'])) {
        $email = mysqli_real_escape_string($mysqli, trim($_POST['email']));
    } else {
        $error = 1;
        $err = "Email Cannot Be Empty";
    }
    if (isset($_POST['password']) && !empty($_POST['password'])) {
        $password = mysqli_real_escape_string($mysqli, trim($_POST['password']));
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
    if (isset($_POST['id']) && !empty($_POST['id'])) {
        $id = mysqli_real_escape_string($mysqli, trim($_POST['id']));
    } else {
        $error = 1;
        $err = "Account Session ID Cannot Be Empty";
    }


    if (!$error) {
        $id = $_SESSION['id'];
        $sql = "SELECT * FROM  NucleusSAASERP_Users  WHERE id = '$id'";
        $res = mysqli_query($mysqli, $sql);
        if (mysqli_num_rows($res) > 0) {
            $row = mysqli_fetch_assoc($res);
            if ($email != $row['email']) {
                $err =  "Please Enter Correct Account Email";
            } elseif ($password != $row['password']) {
                $err = "Incorrect Account Password";
            } else {
                $query = "UPDATE NucleusSAASERP_Users SET account_status =? WHERE id =?";
                $stmt = $mysqli->prepare($query);
                $rc = $stmt->bind_param('ss', $account_status, $id);
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
    if (isset($_POST['old_password']) && !empty($_POST['old_password'])) {
        $old_password = mysqli_real_escape_string($mysqli, trim(sha1(md5($_POST['old_password']))));
    } else {
        $error = 1;
        $err = "Old Password Cannot Be Empty";
    }
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
        $sql = "SELECT * FROM  NucleusSAASERP_Users  WHERE id = '$id'";
        $res = mysqli_query($mysqli, $sql);
        if (mysqli_num_rows($res) > 0) {
            $row = mysqli_fetch_assoc($res);
            if ($old_password != $row['password']) {
                $err =  "Please Enter Correct Old Password";
            } elseif ($new_password != $confirm_password) {
                $err = "Confirmation Password Does Not Match";
            } else {
                $id = $_SESSION['id'];
                $new_password  = sha1(md5($_POST['new_password']));
                $query = "UPDATE NucleusSAASERP_Users SET  password =? WHERE id =?";
                $stmt = $mysqli->prepare($query);
                $rc = $stmt->bind_param('ss', $new_password, $id);
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
                        <!-- User Profile Partial -->
                        <?php require_once('../partials/dashboard_usersettings.php'); ?>
                        <div class="col-lg-8 order-lg-1">
                            <div class="card">
                                <div class="card-header">
                                    <h5 class=" h6 mb-0">Change password</h5>
                                </div>
                                <div class="card-body">
                                    <form method="post">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label class="form-control-label">Old password</label>
                                                    <input class="form-control" name="old_password" type="password">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="form-control-label">New password</label>
                                                    <input class="form-control" name="new_password" type="password">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="form-control-label">Confirm password</label>
                                                    <input class="form-control" name="confirm_password" type="password">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="mt-4">
                                            <button type="submit" name="change_password" class="btn btn-sm btn-primary rounded-pill">Update password</button>
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
                                                            <h5 class="text-white mt-4">Should we stop now?</h5>
                                                            <p class="text-sm text-sm">All your data will be erased. You will no longer be billed, and your username will be available to anyone.</p>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="form-control-label text-white">You email</label>
                                                            <input class="form-control" required name="email" type="text">
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="form-control-label text-white">To verify, type <span class="font-italic">delete my account</span> below</label>
                                                            <input class="form-control" required type="text">
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="form-control-label text-white">Your password</label>
                                                            <input class="form-control" required name="password" type="password">
                                                        </div>
                                                        <div class="mt-4">
                                                            <button type="submit" name="DeleteAccount" class="btn btn-block btn-sm btn-white text-danger rounded-pill">Delete my account</button>
                                                            <button type="button" class="btn btn-block btn-sm btn-link text-light mt-4" data-dismiss="modal">Not this time</button>
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