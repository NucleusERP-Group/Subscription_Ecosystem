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
/* Sign Up */
if (isset($_POST['signIn'])) {
    //Error Handling and prevention of posting double entries
    $error = 0;

    if (isset($_POST['id']) && !empty($_POST['id'])) {
        $id = mysqli_real_escape_string($mysqli, trim($_POST['id']));
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
        $err = "Applicant Email  Cannot Be Empty";
    }

    if (isset($_POST['new_password']) && !empty($_POST['new_password'])) {
        $new_password = mysqli_real_escape_string($mysqli, trim(sha1(md5($_POST['new_password']))));
    } else {
        $error = 1;
        $err = " Password  Cannot Be Empty";
    }

    if (isset($_POST['confirm_password']) && !empty($_POST['confirm_password'])) {
        $confirm_password = mysqli_real_escape_string($mysqli, trim(sha1(md5($_POST['confirm_password']))));
    } else {
        $error = 1;
        $err = "Confirm Password Cannot Be Empty";
    }


    if (!$error) {
        /* Check If Passwords Match */
        if ($new_password != $confirm_password) {
            $err = "Passwords Do Not Match";
        } else {

            /* Prevent Double Entries */
            $sql = "SELECT * FROM  NucleusSAASERP_Users WHERE  email = '$email' && phone = '$phone'  ";
            $res = mysqli_query($mysqli, $sql);
            if (mysqli_num_rows($res) > 0) {
                $row = mysqli_fetch_assoc($res);
                if ($email == $row['email'] || $phone == $row['phone']) {
                    $err =  "A Client With This Email:  $email Or  This Phone Number: $phone Already Exists";
                }
            } else {
                /* No Error Or Duplicate */
                $query = "INSERT INTO NucleusSAASERP_Users  (id, name, phone, email, password) VALUES (?,?,?,?,?)";
                $stmt = $mysqli->prepare($query);
                $rc = $stmt->bind_param('sssss', $id, $name, $phone, $email, $new_password);
                $stmt->execute();
                if ($stmt) {
                    $success = "Hello $name. Your Account Has Been Created, Proceed To Login";
                } else {
                    $info = "Please Try Again Or Try Later";
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
                                        <div class="mb-5">
                                            <h6 class="h3">Client Sign Up Panel</h6>
                                            <p class="text-muted mb-0">Sign Up To Access Client Panel.</p>
                                        </div>
                                        <span class="clearfix"></span>
                                        <form role="form" method="POST">
                                            <div class="form-group">
                                                <label class="form-control-label">Full Name</label>
                                                <div class="input-group input-group-merge">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text"><i class="far fa-user"></i></span>
                                                    </div>
                                                    <input required type="text" name="name" class="form-control">
                                                    <!-- Hide This -->
                                                    <input required type="hidden" name="id" value="<?php echo $ID; ?>" class="form-control">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="form-control-label">Phone Number</label>
                                                <div class="input-group input-group-merge">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text"><i class="far fa-phone"></i></span>
                                                    </div>
                                                    <input required type="text" name="phone" class="form-control">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="form-control-label">Email address</label>
                                                <div class="input-group input-group-merge">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text"><i class="far fa-envelope"></i></span>
                                                    </div>
                                                    <input required type="email" name="email" class="form-control" id="input-email" placeholder="name@example.com">
                                                </div>
                                            </div>
                                            <div class="form-group mb-4">
                                                <label class="form-control-label">Password</label>
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
                                                <label class="form-control-label">Confirm password</label>
                                                <div class="input-group input-group-merge">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text"><i class="far fa-key"></i></span>
                                                    </div>
                                                    <input required name="confirm_password" type="password" class="form-control" id="input-password-confirm" placeholder="********">
                                                </div>
                                            </div>
                                            <div class="my-4">
                                                <div class="custom-control custom-checkbox mb-3">
                                                    <input required type="checkbox" class="custom-control-input" id="check-terms">
                                                    <label class="custom-control-label" for="check-terms">I agree to the <a href="#">terms and conditions</a></label>
                                                </div>
                                                <div class="custom-control custom-checkbox">
                                                    <input required type="checkbox" class="custom-control-input" id="check-privacy">
                                                    <label class="custom-control-label" for="check-privacy">I agree to the <a href="#">privacy policy</a></label>
                                                </div>
                                            </div>
                                            <div class="mt-4"><button type="submit" name="signIn" class="btn btn-sm btn-primary btn-icon rounded-pill">
                                                    <span class="btn-inner--text">Sign In</span>
                                                    <span class="btn-inner--icon"><i class="far fa-user-check"></i></span>
                                                </button></div>
                                        </form>

                                    </div>
                                    <div class="card-footer px-md-5"><small>Registered?</small>
                                        <a href="client-login.php" class="small font-weight-bold">Sign In</a>
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