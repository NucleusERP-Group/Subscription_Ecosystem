<?php
/*
 * Created on Mon May 17 2021
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

/* Update Mail Settings */
if (isset($_POST['updateMailSettings'])) {
    //Error Handling and prevention of posting double entries
    $error = 0;

    if (isset($_POST['id']) && !empty($_POST['id'])) {
        $id = mysqli_real_escape_string($mysqli, trim($_POST['id']));
    } else {
        $error = 1;
        $err = "ID Cannot Be Empty";
    }

    if (isset($_POST['stmp_sent_from']) && !empty($_POST['stmp_sent_from'])) {
        $stmp_sent_from = mysqli_real_escape_string($mysqli, trim($_POST['stmp_sent_from']));
    } else {
        $error = 1;
        $err = "Sent From  Cannot Be Empty";
    }

    if (isset($_POST['stmp_host']) && !empty($_POST['stmp_host'])) {
        $stmp_host = mysqli_real_escape_string($mysqli, trim($_POST['stmp_host']));
    } else {
        $error = 1;
        $err = "Mail Host Cannot Be Empty";
    }

    if (isset($_POST['stmp_username']) && !empty($_POST['stmp_username'])) {
        $stmp_username = mysqli_real_escape_string($mysqli, trim($_POST['stmp_username']));
    } else {
        $error = 1;
        $err = "Username Cannot Be Empty";
    }

    if (isset($_POST['stmp_password']) && !empty($_POST['stmp_password'])) {
        $stmp_password = mysqli_real_escape_string($mysqli, trim($_POST['stmp_password']));
    } else {
        $error = 1;
        $err = "Password Cannot Be Empty";
    }

    if (!$error) {
        $query = "UPDATE  NucleusSAASERP_MailSettings SET stmp_sent_from = ?, stmp_host = ?, stmp_username = ?, stmp_password =? WHERE id = ?";
        $stmt = $mysqli->prepare($query);
        $rc = $stmt->bind_param('ssSsi', $stmp_sent_from, $stmp_host, $stmp_username, $stmp_password, $id);
        $stmt->execute();
        if ($stmt) {
            $success = "STMP Mailer Settings Updated";
        } else {
            $info = "Please Try Again Or Try Later ";
        }
    }
}

/* Update Sign In With Google  */
if (isset($_POST['updateMailGoogleSettings'])) {
    //Error Handling and prevention of posting double entries
    $error = 0;

    if (isset($_POST['id']) && !empty($_POST['id'])) {
        $id = mysqli_real_escape_string($mysqli, trim($_POST['id']));
    } else {
        $error = 1;
        $err = "ID Cannot Be Empty";
    }

    if (isset($_POST['CLIENT_ID']) && !empty($_POST['CLIENT_ID'])) {
        $CLIENT_ID = mysqli_real_escape_string($mysqli, trim($_POST['CLIENT_ID']));
    } else {
        $error = 1;
        $err = "Client ID Cannot Be Empty";
    }

    if (isset($_POST['CLIENT_SECRET']) && !empty($_POST['CLIENT_SECRET'])) {
        $CLIENT_SECRET = mysqli_real_escape_string($mysqli, trim($_POST['CLIENT_SECRET']));
    } else {
        $error = 1;
        $err = "Client Secret  Cannot Be Empty";
    }

    if (!$error) {

        $query = "UPDATE  NucleusSAASERP_MailSettings SET  CLIENT_ID= ?, CLIENT_SECRET = ? WHERE id = ?";
        $stmt = $mysqli->prepare($query);
        $rc = $stmt->bind_param('ssi', $CLIENT_ID, $CLIENT_SECRET, $id);
        $stmt->execute();
        if ($stmt) {
            $success = "Sign In With Google Settings Updated";
        } else {
            $info = "Please Try Again Or Try Later ";
        }
    }
}
require_once('../partials/dashboard_head.php');
?>

<body class="application application-offset">

    <!-- Application container -->
    <div class="container-fluid container-application">
        <!-- Sidenav -->
        <?php require_once('../partials/admin_dashboard_sidenav.php'); ?>
        <!-- Content -->
        <div class="main-content position-relative">
            <!-- Main nav -->
            <?php
            require_once('../partials/dashboard_main_nav.php');
            $id = $_SESSION['id'];
            $email = $_SESSION['email'];
            $ret = "SELECT * FROM `NucleusSAASERP_Users` WHERE id = '$id' OR email = '$email' ";
            $stmt = $mysqli->prepare($ret);
            $stmt->execute(); //ok
            $res = $stmt->get_result();
            while ($client = $res->fetch_object()) {
            ?>
                <!-- Page content -->
                <div class="page-content">
                    <!-- Page title -->
                    <div class="page-title">
                        <div class="row justify-content-between align-items-center">
                            <div class="col-md-6 d-flex align-items-center justify-content-between justify-content-md-start mb-3 mb-md-0">
                                <!-- Page title + Go Back button -->
                                <div class="d-inline-block">
                                    <h5 class="h4 d-inline-block font-weight-400 mb-0 text-white">System Settings</h5>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Listing -->
                    <div class="card">
                        <!-- Table -->
                        <div class="table-responsive card-body">
                            <nav>
                                <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                    <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">STMP Mail Settings</a>
                                    <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false">Google Oauth Settings</a>
                                </div>
                            </nav>
                            <div class="tab-content" id="nav-tabContent">
                                <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                                    <br>
                                    <form method="POST">
                                        <div class="row">
                                            <?php
                                            $ret = "SELECT * FROM `NucleusSAASERP_MailSettings`  ";
                                            $stmt = $mysqli->prepare($ret);
                                            $stmt->execute(); //ok
                                            $res = $stmt->get_result();
                                            while ($settings = $res->fetch_object()) {
                                            ?>
                                                <div class="col-md-6">
                                                    <label class="form-label">STMP Sent Mail From</label>
                                                    <input type="text" required class="form-control" value="<?php echo $settings->stmp_sent_from; ?>" name="stmp_sent_from">
                                                    <input type="hidden" required value="<?php echo $settings->id; ?>" class="form-control" name="id">
                                                </div>
                                                <div class="col-md-6">
                                                    <label class="form-label">STMP Host</label>
                                                    <input type="text" required class="form-control" value="<?php echo $settings->stmp_host; ?>" name="stmp_host">
                                                </div>
                                                <div class="col-md-6">
                                                    <label class="form-label">STMP Username</label>
                                                    <input type="text" required class="form-control" value="<?php echo $settings->stmp_username; ?>" name="stmp_username">
                                                </div>
                                                <div class="col-md-6">
                                                    <label class="form-label">STMP Password</label>
                                                    <input type="password" required class="form-control" value="<?php echo $settings->stmp_password; ?>" name="stmp_password">
                                                </div>
                                            <?php
                                            } ?>
                                        </div>
                                        <br>
                                        <div class="text-right">
                                            <button type="submit" name="updateMailSettings" class="btn btn-primary">Update STMP Mailer Configurations</button>
                                        </div>
                                    </form>
                                </div>
                                <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
                                    <br>
                                    <form method="POST">
                                        <div class="row">
                                            <?php
                                            $ret = "SELECT * FROM `NucleusSAASERP_MailSettings`  ";
                                            $stmt = $mysqli->prepare($ret);
                                            $stmt->execute(); //ok
                                            $res = $stmt->get_result();
                                            while ($oAuth = $res->fetch_object()) {
                                            ?>
                                                <div class="col-md-12">
                                                    <label class="form-label">Oauth Client ID</label>
                                                    <input type="text" required class="form-control" value="<?php echo $oAuth->CLIENT_ID; ?>" name="CLIENT_ID">
                                                    <input type="hidden" required value="<?php echo $oAuth->id; ?>" class="form-control" name="id">
                                                </div>
                                                <div class="col-md-12">
                                                    <label class="form-label">Oauth Client Secret</label>
                                                    <input type="text" required class="form-control" value="<?php echo $oAuth->CLIENT_SECRET; ?>" name="CLIENT_SECRET">
                                                </div>
                                            <?php
                                            } ?>
                                        </div>
                                        <br>
                                        <div class="text-right">
                                            <button type="submit" name="updateMailGoogleSettings" class="btn btn-primary">Update Google Oauth Settings</button>
                                        </div>
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
    <?php require_once('../partials/dashboard_scripts.php'); ?>
</body>



</html>