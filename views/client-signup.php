<?php
/*
 * Created on Sat May 01 2021
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
include('../config/config.php');
include('../config/codeGen.php');

if (isset($_POST['Sign Up'])) {
    //Error Handling and prevention of posting double entries
    $error = 0;

    if (isset($_POST['id']) && !empty($_POST['id'])) {
        $id = mysqli_real_escape_string($mysqli, trim($_POST['id']));
    } else {
        $error = 1;
        $err = "Client ID Cannot Be Empty";
    }
    if (isset($_POST['name']) && !empty($_POST['name'])) {
        $name = mysqli_real_escape_string($mysqli, trim($_POST['name']));
    } else {
        $error = 1;
        $err = "Name Cannot Be Empty";
    }
    if (isset($_POST['']) && !empty($_POST['Client_phone_no'])) {
        $Client_phone_no = mysqli_real_escape_string($mysqli, trim($_POST['Client_phone_no']));
    } else {
        $error = 1;
        $err = "Client Phone Number Cannot Be Empty";
    }

    if (isset($_POST['Client_gender']) && !empty($_POST['Client_gender'])) {
        $Client_gender = mysqli_real_escape_string($mysqli, trim($_POST['Client_gender']));
    } else {
        $error = 1;
        $err = "Client Gender Cannot Be Empty";
    }

    if (isset($_POST['Client_email']) && !empty($_POST['Client_email'])) {
        $Client_email = mysqli_real_escape_string($mysqli, trim($_POST['Client_email']));
    } else {
        $error = 1;
        $err = "Client Email Cannot Be Empty";
    }

    if (isset($_POST['Client_location']) && !empty($_POST['Client_location'])) {
        $Client_location = mysqli_real_escape_string($mysqli, trim($_POST['Client_location']));
    } else {
        $error = 1;
        $err = "Client Location Number Cannot Be Empty";
    }
    /* Client Auth Details */
    if (isset($_POST['Login_id']) && !empty($_POST['Login_id'])) {
        $Login_id = mysqli_real_escape_string($mysqli, trim($_POST['Login_id']));
    } else {
        $error = 1;
        $err = "Client Login ID Number Cannot Be Empty";
    }

    if (isset($_POST['Login_Password']) && !empty($_POST['Login_Password'])) {
        $Login_Password = mysqli_real_escape_string($mysqli, trim(sha1(md5($_POST['Login_Password']))));
    } else {
        $error = 1;
        $err = "Client Login Password Cannot Be Empty";
    }

    $Login_Rank = 'Client';

    if (!$error) {
        //prevent Double entries
        $sql = "SELECT * FROM Clients  WHERE  Client_email='$Client_email'  || Client_phone_no = '$Client_phone_no' ";
        $res = mysqli_query($mysqli, $sql);
        if (mysqli_num_rows($res) > 0) {
            $row = mysqli_fetch_assoc($res);

            if ($Client_email == $row['Client_email']) {
                $err =  "A Client Account With That Phone Number  Exists";
            } else {
                $err =  "A Client Account With That Email Address Exists";
            }
        } else {
            $query = "INSERT INTO Clients (Client_id, Client_name, Client_login_id, Client_phone_no, Client_gender, Client_email, Client_location) VALUES(?,?,?,?,?,?,?)";
            $auth = "INSERT INTO Login (Login_id, Login_user_name, Login_email, Login_Password,  Login_Rank) VALUES(?,?,?,?,?)";

            $stmt = $mysqli->prepare($query);
            $authstmt = $mysqli->prepare($auth);

            $rc = $stmt->bind_param('sssssss', $Client_id, $Client_name, $Login_id, $Client_phone_no, $Client_gender, $Client_email, $Client_location);
            $rc = $authstmt->bind_param('sssss', $Login_id, $Client_name, $Client_email, $Login_Password, $Login_Rank);

            $stmt->execute();
            $authstmt->execute();

            if ($stmt && $authstmt) {
                $success = "Added" && header("refresh:1; url=index.php");
            } else {
                $info = "Please Try Again Or Try Later";
            }
        }
    }
}
require_once('../partials/_head.php');
?>

<body class="footer-dark">
    <!-- Header -->
    <?php require_once('../partials/_header.php'); ?>
    <!-- Content -->
    <section id="content">
        <!-- Content Row -->
        <section class="content-row content-row-color content-row-clouds">
            <div class="container">
                <header class="content-header content-header-small content-header-uppercase">
                    <h1>
                        NucleusSaaS ERP Client Sign Up
                    </h1>
                    <p>
                        Our customer portal uses 128-bit encryption. Your details are safe.
                    </p>
                </header>
            </div>
        </section>
        <!-- Content Row -->
        <section class="content-row">
            <div class="container">
                <div class="column-row align-center">
                    <div class="column-50">

                        <form class="form-full-width" method="POST">
                            <div class="text-center">
                                <h3>Personal Information</h3>
                            </div>
                            <div class="form-row">

                                <label for="form-email">Full Name</label>
                                <input id="form-email" type="text" name="name">
                            </div>
                            <div class="form-row">
                                <label for="form-email">Email Address</label>
                                <input id="form-email" type="email" name="email">
                            </div>
                            <div class="form-row">
                                <label for="form-email">Phone Number</label>
                                <input id="form-email" type="text" name="phone">
                            </div>
                            <hr>
                            <div class="text-center">
                                <h3>Billing Address</h3>
                            </div>
                            <div class="form-row">
                                <label>Company Name (Optional)</label>
                                <input type="text" name="company_name">
                            </div>
                            <div class="form-row">
                                <label>Country</label>
                                <input type="text" name="country">
                            </div>
                            <div class="form-row">
                                <label>City</label>
                                <input type="text" name="city">
                            </div>
                            <div class="form-row">
                                <label>Street Address</label>
                                <input type="text" name="adr">
                            </div>
                            <hr>
                            <div class="text-center">
                                <h3>Account Security</h3>
                            </div>
                            <div class="form-row">
                                <label for="form-password">Password</label>
                                <input id="form-password" type="password" name="password">
                            </div>
                            <div class="form-row">
                                <label for="form-password">Confirm Password</label>
                                <input id="form-password" type="password" name="confirm_password">
                            </div>

                            <div class="form-row">
                                <button type="submit" name="Sign Up" class="button-secondary"><i class="fas fa-user-check icon-left"></i>Sign Up</button>
                                <button class="button-secondary"><i class="fab fa-google icon-left"></i>Sign Up Using Google</button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </section>
        <!-- Content Row -->
        <section class="content-row content-row-gray">
            <div class="container">
                <div class="column-row align-center">
                    <div class="column-50 text-align-center">
                        <p class="text-color-gray">
                            Having troubles logging into your account?<br>
                            <a href="client-reset-password.php">Password Reset<i class="fas fa-angle-right icon-right"></i></a>
                        </p>
                        <p class="text-color-gray">
                            Already a NucleusSaaS ERP Member?<br>
                            <a href="client-login.php">Sign In<i class="fas fa-angle-right icon-right"></i></a>
                        </p>
                    </div>
                </div>
            </div>
        </section>
    </section>
    <!-- Footer -->
    <?php require_once('../partials/_footer.php'); ?>
    <!-- Scripts -->
    <?php require_once('../partials/_scripts.php'); ?>
</body>

</html>