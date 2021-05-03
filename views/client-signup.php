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

if (isset($_POST['SignUp'])) {
    //Error Handling and prevention of posting double entries
    $error = 0;

    if (isset($_POST['id']) && !empty($_POST['id'])) {
        $id = mysqli_real_escape_string($mysqli, trim($_POST['id']));
    } else {
        $error = 1;
        $err = " ID Cannot Be Empty";
    }
    if (isset($_POST['name']) && !empty($_POST['name'])) {
        $name = mysqli_real_escape_string($mysqli, trim($_POST['name']));
    } else {
        $error = 1;
        $err = "Name Cannot Be Empty";
    }
    if (isset($_POST['email']) && !empty($_POST['email'])) {
        $email = mysqli_real_escape_string($mysqli, trim($_POST['email']));
    } else {
        $error = 1;
        $err = "Email  Cannot Be Empty";
    }

    if (isset($_POST['phone']) && !empty($_POST['phone'])) {
        $phone = mysqli_real_escape_string($mysqli, trim($_POST['phone']));
    } else {
        $error = 1;
        $err = "Phone Cannot Be Empty";
    }

    if (isset($_POST['country']) && !empty($_POST['country'])) {
        $country = mysqli_real_escape_string($mysqli, trim($_POST['country']));
    } else {
        $error = 1;
        $err = "Country Number Cannot Be Empty";
    }

    if (isset($_POST['city']) && !empty($_POST['city'])) {
        $city = mysqli_real_escape_string($mysqli, trim($_POST['city']));
    } else {
        $error = 1;
        $err = "City Cannot Be Empty";
    }

    if (isset($_POST['adr']) && !empty($_POST['adr'])) {
        $adr = mysqli_real_escape_string($mysqli, trim($_POST['adr']));
    } else {
        $error = 1;
        $err = "Adress Cannot Be Empty";
    }

    if (isset($_POST['Login_Password']) && !empty($_POST['Login_Password'])) {
        $Login_Password = mysqli_real_escape_string($mysqli, trim(sha1(md5($_POST['Login_Password']))));
    } else {
        $error = 1;
        $err = "Client Login Password Cannot Be Empty";
    }

    if (isset($_POST['password']) && !empty($_POST['password'])) {
        $password = mysqli_real_escape_string($mysqli, trim(sha1(md5($_POST['password']))));
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

    /* No Filters Because Its Optional */
    $company_name = $_POST['company_name'];

    if (!$error) {
        /* Check If Passwords Match */
        if ($password != $confirm_password) {
            $err = "Passwords Do Not Match";
        } else {
            //prevent Double entries
            $sql = "SELECT * FROM NucleusSAASERP_Users  WHERE  email='$email'  || phone = '$phone' ";
            $res = mysqli_query($mysqli, $sql);
            if (mysqli_num_rows($res) > 0) {
                $row = mysqli_fetch_assoc($res);

                if ($email == $row['email']) {
                    $err =  "A Client Account With That Email   Exists";
                } else {
                    $err =  "A Client Account With That Phone Number Address Exists";
                }
            } else {
                $query = "INSERT INTO NucleusSAASERP_Users (id, name, email, phone, company_name, country, city, adr, password) VALUES(?,?,?,?,?,?,?,?,?)";
                $stmt = $mysqli->prepare($query);
                $rc = $stmt->bind_param('sssssssss', $id, $name, $email, $phone, $company_name, $country, $city, $adr, $password);
                $stmt->execute();
                if ($stmt) {
                    $success = "Client Account Created" && header("refresh:1; url=client-signup.php");
                } else {
                    $info = "Please Try Again Or Try Later";
                }
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

                        <form method="post" enctype="multipart/form-data" role="form">
                            <div class="card-body">
                                <div class="row">
                                    <div class="form-group col-md-4">
                                        <label for="">Module Name</label>
                                        <input type="text" required name="name" class="form-control" id="exampleInputEmail1">
                                        <input type="hidden" required name="id" value="<?php echo $ID; ?>" class="form-control">
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="">Module Number / Code</label>
                                        <input type="text" required name="code" value="<?php echo $a; ?><?php echo $b; ?>" class="form-control">
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="">Course Name</label>
                                        <input type="text" value="<?php echo $course->name; ?>" required name="course_name" class="form-control">
                                    </div>
                                </div>
                                <div class="row">

                                    <div class="form-group col-md-4" style="display:none">
                                        <label for="">Course ID</label>
                                        <input type="text" readonly value="<?php echo $course->id; ?>" required name="course_id" class="form-control">
                                        <input type="text" readonly value="<?php echo $course->faculty_id; ?>" required name="faculty_id" class="form-control">
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label for="">Teaching Duration</label>
                                        <input type="text" required name="course_duration" class="form-control" id="exampleInputEmail1">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="">Number Of Lectures Per Week</label>
                                        <input type="text" required name="lectures_number" class="form-control">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="">Module CAT Weight Percentage</label>
                                        <input type="text" required name="cat_weight_percentage" class="form-control">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="">Module End Exam Weight Percentage</label>
                                        <input type="text" required name="exam_weight_percentage" class="form-control">
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="form-group col-md-12">
                                        <label for="exampleInputPassword1">Module Details</label>
                                        <textarea required name="details" rows="10" class="form-control Summernote"></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer text-right">
                                <button type="submit" name="SignUp" class="btn btn-primary">Add Module</button>
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