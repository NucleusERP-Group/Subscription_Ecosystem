<?php
/*
 * Created on Sat May 15 2021
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
require_once('../config/codeGen.php');
client_login();

/* Update Client Account */
if (isset($_POST['UpdateClient'])) {
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
            $success = "$name Account Has Been Updated 😉.";
        } else {
            $info = "Please Try Again Or Try Later";
        }
    }
}

/* Delete Client Account */
if (isset($_GET['delete'])) {
    $delete = $_GET['delete'];
    $adn = "DELETE FROM NucleusSAASERP_Users WHERE id=?";
    $stmt = $mysqli->prepare($adn);
    $stmt->bind_param('s', $delete);
    $stmt->execute();
    $stmt->close();
    if ($stmt) {
        $success = "Deleted" && header("refresh:1; url=admin-clients");
    } else {
        $info = "Please Try Again Or Try Later";
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
                                    <h5 class="h4 d-inline-block font-weight-400 mb-0 text-white">NucleusSaaS ERP Clients</h5>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <br>
                <!-- Listing -->
                <div class="card">
                    <div class="table-responsive card-body">
                        <table id="AdminDashboardDataTables" class="table ">
                            <thead>
                                <tr>
                                    <th scope="col">Name</th>
                                    <th scope="col" class="sort">Contacts & Address</th>
                                    <th scope="col" class="sort">Account Status</th>
                                    <th scope="col" class="sort">Date Joined</th>
                                    <th scope="col" class="sort">Manage Clients</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                /* Load All NucleusSaaS ERP Users Except Logged In Admin */
                                $ret = "SELECT * FROM `NucleusSAASERP_Users` WHERE id !='$id'  ";
                                $stmt = $mysqli->prepare($ret);
                                $stmt->execute(); //ok
                                $res = $stmt->get_result();
                                while ($users = $res->fetch_object()) {
                                    /* User Gravatar Url */
                                    $email_id = $users->email;
                                    $default = "";
                                    $size = 300;
                                    $grav_url = "https://www.gravatar.com/avatar/" . md5(strtolower(trim($email_id))) . "?d=" . urlencode($default) . "&s=" . $size;
                                ?>

                                    <tr>
                                        <td>
                                            <a href="#user-<?php echo $users->id; ?>" data-toggle="modal">
                                                <?php echo $users->name; ?>
                                            </a>
                                        </td>
                                        <td class="order">
                                            <span class="d-block text-sm text-muted"><?php echo $users->email; ?></span>
                                            <span class="d-block text-sm text-muted"><?php echo $users->phone; ?></span>
                                            <span class="d-block text-sm text-muted"><?php echo $users->adr; ?></span>
                                        </td>
                                        <td>
                                            <?php
                                            if ($users->account_status == '0') {
                                                echo "<span class='badge badge-pill badge-success'>Active</span>";
                                            } else {
                                                echo "<span class='badge badge-pill badge-danger'>Deleted</span>";
                                            } ?>
                                        </td>
                                        <td>
                                            <span class="client"><?php echo date('d M Y g:ia', strtotime($users->joined_on)); ?></span>
                                        </td>
                                        <td>
                                            <a href="#update-user-<?php echo $users->id; ?>" data-toggle="modal" class="badge badge-pill badge-warning">
                                                <i class="fas fa-edit"></i> Update User
                                            </a>
                                            <a href="#delete-user-<?php echo $users->id; ?>" data-toggle="modal" class="badge badge-pill badge-danger">
                                                <i class="fas fa-trash"></i> Delete
                                            </a>
                                        </td>
                                        <!-- End User Details -->
                                        <!-- Update User -->
                                        <div class="modal fade" id="update-user-<?php echo $users->id; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-lg">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title text-center" id="exampleModalLabel">Update <?php echo $users->name; ?></h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form method="POST">
                                                            <!-- General information -->
                                                            <div class="row">
                                                                <div class="col-md-12">
                                                                    <div class="form-group">
                                                                        <label class="form-control-label">Full Name</label>
                                                                        <input name="name" value="<?php echo $users->name; ?>" class="form-control" type="text" placeholder="Enter your first name">
                                                                        <input name="id" value="<?php echo $users->id; ?>" class="form-control" type="hidden" placeholder="Enter your first name">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-md-6">
                                                                    <div class="form-group">
                                                                        <label class="form-control-label">Email Address</label>
                                                                        <input class="form-control" type="email" name="email" value="<?php echo $users->email; ?>" placeholder="name@exmaple.com">
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <div class="form-group">
                                                                        <label class="form-control-label">Phone</label>
                                                                        <input class="form-control" type="text" name="phone" value="<?php echo $users->phone; ?>" placeholder="+40-777 245 549">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <hr />
                                                            <!-- Address -->
                                                            <div class="row">
                                                                <div class="col">
                                                                    <div class="form-group">
                                                                        <label class="form-control-label">Company Name</label>
                                                                        <input class="form-control" type="text" name="company_name" value="<?php echo $users->company_name; ?>" placeholder="Enter your company name">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col">
                                                                    <div class="form-group">
                                                                        <label class="form-control-label">Address</label>
                                                                        <input class="form-control" type="text" name="adr" value="<?php echo $users->adr; ?>" placeholder="Enter your home address">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-md-6">
                                                                    <div class="form-group">
                                                                        <label class="form-control-label">City</label>
                                                                        <input class="form-control" type="text" name="city" value="<?php echo $users->city; ?>" placeholder="City">
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <div class="form-group">
                                                                        <label class="form-control-label">Country</label>
                                                                        <input class="form-control" type="text" name="country" value="<?php echo $users->country; ?>" placeholder="Country">
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
                                                                            <textarea class="form-control summernote" name="bio" placeholder="Tell us a few words about yourself" rows="3"><?php echo $users->bio; ?></textarea>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <hr />
                                                            <!-- Save changes buttons -->
                                                            <button type="submit" name="UpdateClient" class="btn btn-sm btn-primary rounded-pill">Save Changes</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- End Update Package -->
                                        <!-- Delete Package -->
                                        <div class="modal fade" id="delete-user-<?php echo $users->id; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">CONFIRM DELETE</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body text-center text-danger">
                                                        <h4>Delete <?php echo $user->name; ?> ?</h4>
                                                        <p>
                                                            Hey There You Are About To Delete A User Account Details.
                                                            This Operation Is Irrevessible All Subscriptions, Payments, Credit / Debit Cards, ERP Instances And Invoices Linked To This User Will Be Deleted.
                                                        </p>
                                                        <button type="button" class="text-center btn btn-success" data-dismiss="modal">No</button>
                                                        <a href="admin-clients?delete=<?php echo $users->id; ?>" class="text-center btn btn-danger">Yes Delete User Account</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- End Delete User -->
                                        <div class="modal fade" id="user-<?php echo $users->id; ?>" tabindex="-1" role="dialog" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-body">
                                                        <div class="card">
                                                            <div class="card-head">
                                                                <h5 class="card-title text-center"><?php echo $users->name; ?> Profile</h5>
                                                            </div>
                                                            <div class="row align-items-center">
                                                                <div class="col-auto">
                                                                    <a href="#" class="img-responsive">
                                                                        <img alt="Image placeholder" src="<?php echo $grav_url; ?>" width="50" height="50">
                                                                    </a>
                                                                </div>
                                                                <br>
                                                                <div class="col ml-md-n2">
                                                                    <p class="d-block h6 mb-0">Full Name : <?php echo $users->name; ?></p>
                                                                    <p class="d-block h6 mb-0">Mobile : <?php echo $users->phone; ?></p>
                                                                    <p class="d-block h6 mb-0">Email : <?php echo $users->email; ?></p>
                                                                    <p class="d-block h6 mb-0">Country : <?php echo $users->country; ?></p>
                                                                    <p class="d-block h6 mb-0">City : <?php echo $users->city; ?></p>
                                                                    <p class="d-block h6 mb-0">Company : <?php echo $users->company_name; ?></p>
                                                                    <p class="d-block h6 mb-0">Address : <?php echo $users->adr; ?></p>
                                                                    <h6 class="d-block h6 mb-0">Bio</h6>
                                                                    <div class="d-block h6 mb-0"><?php echo $users->bio; ?></div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </tr>
                                <?php
                                } ?>
                            </tbody>
                        </table>
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