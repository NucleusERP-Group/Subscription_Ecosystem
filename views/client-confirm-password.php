<?php
/*
 * Created on Thu May 06 2021
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
require_once('../config/codeGen.php');

if (isset($_POST['ConfirmPassword'])) {
    $error = 0;
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
        $email = $_SESSION['email'];
        $sql = "SELECT * FROM  NucleusSAASERP_Users  WHERE email = '$email'";
        $res = mysqli_query($mysqli, $sql);
        if (mysqli_num_rows($res) > 0) {
            $row = mysqli_fetch_assoc($res);
            if ($new_password != $confirm_password) {
                $err = "Password Does Not Match";
            } else {
                $email = $_SESSION['email'];
                $query = "UPDATE NucleusSAASERP_Users SET  password =? WHERE email =?";
                $stmt = $mysqli->prepare($query);
                $rc = $stmt->bind_param('ss', $new_password, $email);
                $stmt->execute();
                if ($stmt) {
                    $success = "Password Changed" && header("refresh:1; url=client-login.php");
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
        <!-- Content -->
        <div class="main-content position-relative">
            <!-- Main nav -->
            <div class="page-content">
                <div class="min-vh-100 py-5 d-flex align-items-center">
                    <div class="w-100">
                        <div class="row justify-content-center">
                            <div class="col-sm-8 col-lg-6">
                                <div class="card shadow zindex-100 mb-0">
                                    <div class="card-body px-md-5 py-5">
                                        <?php
                                        $email  = $_SESSION['email'];
                                        $ret = "SELECT * FROM  NucleusSAASERP_Users  WHERE email = '$email'";
                                        $stmt = $mysqli->prepare($ret);
                                        $stmt->execute(); //ok
                                        $res = $stmt->get_result();
                                        while ($ml = $res->fetch_object()) {
                                        ?>
                                            <div class="mb-5 text-center">
                                                <h6 class="h3">Howdy <?php echo $ml->name; ?>. Please Enter New Password </h6>
                                            </div>
                                        <?php } ?>
                                        <span class="clearfix"></span>
                                        <form role="form" method="POST">
                                            <div class="form-group">

                                                <div class="form-group mb-4">
                                                    <label class="form-control-label">New Password</label>
                                                    <div class="input-group input-group-merge">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text"><i class="far fa-key"></i></span>
                                                        </div>
                                                        <input required name="new_password" type="password" class="form-control" id="input-password" placeholder="********">
                                                        <div class="input-group-append">
                                                            <span class="input-group-text">
                                                                <a href="#" data-toggle="password-text" data-target="#input-password">
                                                                    <i class="far fa-eye"></i>
                                                                </a>
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="form-control-label">Confirm New Password</label>
                                                    <div class="input-group input-group-merge">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text"><i class="far fa-key"></i></span>
                                                        </div>
                                                        <input required name="confirm_password" type="password" class="form-control" id="input-password-confirm" placeholder="********">
                                                    </div>
                                                </div>
                                                <div class="mt-4"><button type="submit" name="ConfirmPassword" class="btn btn-sm btn-primary btn-icon rounded-pill">
                                                        <span class="btn-inner--text">Reset Password</span>
                                                        <span class="btn-inner--icon"><i class="far fa-user-lock"></i></span>
                                                    </button></div>
                                        </form>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Footer -->
        </div>
    </div>
    <!-- Scripts -->
    <!-- Core JS - includes jquery, bootstrap, popper, in-view and sticky-kit -->
    <?php require_once('../partials/dashboard_scripts.php'); ?>
</body>



</html>