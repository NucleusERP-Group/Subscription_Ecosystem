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
/* Add Package */
if (isset($_POST['PurchasePackage'])) {
    //Error Handling and prevention of posting double entries
    $error = 0;
    if (isset($_POST['id']) && !empty($_POST['id'])) {
        $id = mysqli_real_escape_string($mysqli, trim($_POST['id']));
    } else {
        $error = 1;
        $err = "ID Cannot Be Empty";
    }

    if (isset($_POST['package_code']) && !empty($_POST['package_code'])) {
        $package_code = mysqli_real_escape_string($mysqli, trim($_POST['package_code']));
    } else {
        $error = 1;
        $err = "Package Code Cannot Be Empty";
    }

    if (isset($_POST['package_name']) && !empty($_POST['package_name'])) {
        $package_name = mysqli_real_escape_string($mysqli, trim($_POST['package_name']));
    } else {
        $error = 1;
        $err = "Package Name Cannot Be Empty";
    }

    if (isset($_POST['package_details']) && !empty($_POST['package_details'])) {
        $package_details = mysqli_real_escape_string($mysqli, trim($_POST['package_details']));
    } else {
        $error = 1;
        $err = "Package Details  Cannot Be Empty";
    }

    if (isset($_POST['package_monthly_price ']) && !empty($_POST['package_monthly_price '])) {
        $package_monthly_price  = mysqli_real_escape_string($mysqli, trim($_POST['package_monthly_price ']));
    } else {
        $error = 1;
        $err = "Packet Monthly Price  Cannot Be Empty";
    }

    if (isset($_POST['package_yearly_price']) && !empty($_POST['package_yearly_price'])) {
        $package_yearly_price = mysqli_real_escape_string($mysqli, trim($_POST['package_yearly_price']));
    } else {
        $error = 1;
        $err = "Package Yearly Price  Cannot Be Empty";
    }

    if (isset($_POST['package_status']) && !empty($_POST['package_status'])) {
        $package_status = mysqli_real_escape_string($mysqli, trim($_POST['package_status']));
    } else {
        $error = 1;
        $err = "Package Status  Cannot Be Empty";
    }
    

    if (!$error) {
        /* Prevent Double Entries */
        $sql = "SELECT * FROM  NucleusSAASERP_Packages WHERE   package_code = '$package_code'    ";
        $res = mysqli_query($mysqli, $sql);
        if (mysqli_num_rows($res) > 0) {
            $row = mysqli_fetch_assoc($res);
            if ($package_code == $row['package_code']) {
                $err =  "A Subscription Package  With This Code:  $package_code Exists.";
            }
        } else {
            /* No Error Or Duplicate */
            $query = "INSERT INTO NucleusSAASERP_Packages  (id, package_code, package_name, package_details, package_monthly_price, package_yearly_price, package_status ) VALUES (?,?,?,?,?,?,?)";
            $stmt = $mysqli->prepare($query);
            $rc = $stmt->bind_param('sssssss', $id, $package_code, $package_name, $package_details, $package_monthly_price, $package_yearly_price, $package_status);
            $stmt->execute();
            if ($stmt) {
                $success = "Subscription Package Added";
            } else {
                $info = "Please Try Again Or Try Later ";
            }
        }
    }
}

/* Update Package */

/* Delete Package */

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
                                    <h5 class="h4 d-inline-block font-weight-400 mb-0 text-white">Subscription Packages</h5>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Listing -->
                    <div class="card">
                        <div class="table-responsive card-body">
                            <table id="AdminDashboardDataTables" class="table ">
                                <thead>
                                    <tr>
                                        <th scope="col">Package Code</th>
                                        <th scope="col" class="sort">Package Name</th>
                                        <th scope="col" class="sort">Monthly Price</th>
                                        <th scope="col" class="sort">Yearly Price</th>
                                        <th scope="col" class="sort">Package Status</th>
                                        <th scope="col" class="sort">Manage Packages</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $ret = "SELECT * FROM `NucleusSAASERP_Packages`  ";
                                    $stmt = $mysqli->prepare($ret);
                                    $stmt->execute(); //ok
                                    $res = $stmt->get_result();
                                    while ($packages = $res->fetch_object()) {
                                    ?>

                                        <tr>
                                            <td>
                                                <a href="#package-<?php echo $packages->id; ?>" data-toggle="modal">
                                                    <?php echo $packages->package_code; ?>
                                                </a>
                                            </td>
                                            <td class="order">
                                                <span class="d-block text-sm text-muted"><?php echo $packages->package_name; ?></span>
                                            </td>
                                            <td>
                                                <span class="client">Ksh <?php echo $packages->package_monthly_price; ?></span>
                                            </td>
                                            <td>
                                                <span class="client">Ksh <?php echo $packages->package_yearly_price; ?></span>
                                            </td>
                                            <td>
                                                <?php
                                                if ($packages->package_status == 'Active') {
                                                    echo "<span class='badge badge-pill badge-success'>Active</span>";
                                                } else {
                                                    echo "<span class='badge badge-pill badge-warning'>InActive</span>";
                                                } ?>
                                            </td>
                                            <td>
                                                <a href="#update-package-<?php echo $packages->id; ?>" data-toggle="modal" class="badge badge-pill badge-warning">
                                                    <i class="fas fa-edit"></i> Update
                                                </a>
                                                <a href="#delete-package-<?php echo $packages->id; ?>" data-toggle="modal" class="badge badge-pill badge-danger">
                                                    <i class="fas fa-trash"></i> Delete
                                                </a>
                                            </td>
                                            <!-- Package Details -->
                                            <div class="modal fade" id="package-<?php echo $packages->id; ?>" tabindex="-1" role="dialog" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-body">
                                                            <div class="card">
                                                                <div class="card-head">
                                                                    <h5 class="card-title text-center"><?php echo $packages->package_code . " " . $packages->package_name; ?> Features</h5>
                                                                </div>
                                                                <ul class="list-group list-group-flush">
                                                                    <li class="list-group-item"><?php echo $packages->package_details; ?></li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- End Package Details -->
                                            <!-- Update Package -->
                                            <div class="modal fade" id="update-package-<?php echo $packages->id; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-lg">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title text-center" id="exampleModalLabel">Update <?php echo $packages->package_code  . " " . $packages->package_name; ?></h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form method="POST">
                                                                <div class="row">
                                                                    <div class="col-md-6">
                                                                        <label class="form-label">Package Code</label>
                                                                        <input type="text" value="<?php echo $packages->package_code; ?>" class="form-control" name="package_code">
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <label class="form-label">Package Name</label>
                                                                        <input type="text" value="<?php echo $packages->package_name; ?>" class="form-control" name="package_name">
                                                                    </div>
                                                                </div>
                                                                <br>
                                                                <div class="row">
                                                                    <div class="col-md-4">
                                                                        <label class="form-label">Package Monthly Payment (Ksh)</label>
                                                                        <input type="text" value="<?php echo $packages->package_monthly_price; ?>" class="form-control" name="package_monthly_price">
                                                                    </div>
                                                                    <div class="col-md-4">
                                                                        <label class="form-label">Package Yearly Payment (Ksh)</label>
                                                                        <input type="text" value="<?php echo $packages->package_yearly_price; ?>" class="form-control" name="package_yearly_price">
                                                                    </div>
                                                                    <div class="col-md-4">
                                                                        <label class="form-label">Package Status</label>
                                                                        <select name="package_status" class="form-control">
                                                                            <option><?php echo $packages->package_status; ?></option>
                                                                            <option>Active</option>
                                                                            <option>InActive</option>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                <br>
                                                                <div class="row">
                                                                    <div class="col-md-12">
                                                                        <label class="form-label">Package Features</label>
                                                                        <textarea type="text" class="form-control summernote" rows="4" name="package_details"><?php echo $packages->package_details; ?></textarea>
                                                                    </div>
                                                                </div>
                                                                <br>
                                                                <div class="text-right">
                                                                    <button type="submit" name="UpdatePackage" class="btn btn-primary">Update Package</button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- End Update Package -->
                                            <!-- Delete Package -->
                                            <div class="modal fade" id="delete-package-<?php echo $packages->id; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel">CONFIRM DELETE</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body text-center text-danger">
                                                            <h4>Delete <?php echo $packages->package_code . "<br>" . $packages->package_name; ?> ?</h4>
                                                            <p>
                                                                Hey There You Are About To Delete A Subscription Package.
                                                                This Operation Is Irrevessible All Subscriptions, Payments And Invoices Linked To This Package Will Be Deleted.
                                                            </p>
                                                            <button type="button" class="text-center btn btn-success" data-dismiss="modal">No</button>
                                                            <a href="admin-subscriptions.php?delete=<?php echo $packages->id; ?>" class="text-center btn btn-danger">Yes Delete Package</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- End Delete Package -->
                                        </tr>
                                    <?php
                                    } ?>
                                </tbody>
                            </table>
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