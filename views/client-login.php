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

if (isset($_POST['login'])) {
    /* Error Checking */
    $error = 0;

    if (isset($_POST['email']) && !empty($_POST['email'])) {
        $email = mysqli_real_escape_string($mysqli, trim($_POST['email']));
    } else {
        $error = 1;
        $err = "Email  Cannot Be Empty";
    }

    if (isset($_POST['password']) && !empty($_POST['password'])) {
        $password = mysqli_real_escape_string($mysqli, trim(sha1(md5($_POST['password']))));
    } else {
        $error = 1;
        $err = "Password Cannot Be Empty";
    }

    if (!$error) {
        /* Login Client  */
        $stmt = $mysqli->prepare("SELECT email, password, id  FROM NucleusSAASERP_Users  WHERE email =? AND password =? AND account_status ='0' ");
        $stmt->bind_param('ss', $email, $password); //bind fetched parameters

        $stmt->execute(); //execute bind 
        $stmt->bind_result($email, $password, $id); //bind result

        $rs = $stmt->fetch();
        $_SESSION['id'] = $id;
        $_SESSION['email'] = $email;

        if ($rs) {
            header("location:client-dashboard.php");
        } else {
            $err =  "Incorrect Email Or Password";
        }
    }
}
require_once('../partials/dashboard_head.php');
?>


<body class="application application-offset">

    <!-- Application container -->
    <div class="container-fluid container-application">
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
                                        <div class="mb-5">
                                            <h6 class="h3">Client Login Panel</h6>
                                            <p class="text-muted mb-0">Sign In To Access Client Panel.</p>
                                        </div>
                                        <span class="clearfix"></span>
                                        <form role="form" method="POST">
                                            <div class="form-group">
                                                <label class="form-control-label">Email Address</label>
                                                <div class="input-group input-group-merge">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text"><i class="far fa-user"></i></span>
                                                    </div>
                                                    <input required type="email" name="email" class="form-control" id="input-email">
                                                </div>
                                            </div>
                                            <div class="form-group mb-4">
                                                <div class="d-flex align-items-center justify-content-between">
                                                    <div>
                                                        <label class="form-control-label">Password</label>
                                                    </div>
                                                    <div class="mb-2">
                                                        <a href="client-reset-password.php" class="small text-muted text-underline--dashed border-primary">Lost Password?</a>
                                                    </div>
                                                </div>
                                                <div class="input-group input-group-merge">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text"><i class="far fa-key"></i></span>
                                                    </div>
                                                    <input required type="password" name="password" class="form-control" id="input-password">
                                                    <div class="input-group-append">
                                                        <span class="input-group-text">
                                                            <a href="#" data-toggle="password-text" data-target="#input-password">
                                                                <i class="far fa-eye"></i>
                                                            </a>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="mt-4">
                                                <button type="submit" name="login" class="btn btn-sm btn-primary btn-icon rounded-pill">
                                                    <span class="btn-inner--text">Sign In</span>
                                                    <span class="btn-inner--icon"><i class="far fa-user-lock"></i></span>
                                                </button>
                                                <a href="client-signin-with-google.php" class="btn btn-sm btn-primary btn-icon rounded-pill">
                                                    <span class="btn-inner--text">Sign In With Google</span>
                                                    <span class="btn-inner--icon"><i class="fab fa-google"></i></span>
                                                </a>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="card-footer px-md-5"><small>Not registered?</small>
                                        <a href="client-signup.php" class="small font-weight-bold">Create account</a>
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