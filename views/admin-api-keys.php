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
/* Add API Key */
if (isset($_POST['AddAPIKey'])) {
    //Error Handling and prevention of posting double entries
    $error = 0;

    if (isset($_POST['api_key']) && !empty($_POST['api_key'])) {
        $api_key = mysqli_real_escape_string($mysqli, trim($_POST['api_key']));
    } else {
        $error = 1;
        $err = "API Key Cannot Be Empty";
    }

    if (isset($_POST['status']) && !empty($_POST['status'])) {
        $status = mysqli_real_escape_string($mysqli, trim($_POST['status']));
    } else {
        $error = 1;
        $err = "API Key Status Cannot Be Empty";
    }

    $details = $_POST['details'];

    if (!$error) {
        /* Prevent Double Entries */
        $sql = "SELECT * FROM  NucleusSAASERP_APIKeys WHERE   api_key = '$api_key'    ";
        $res = mysqli_query($mysqli, $sql);
        if (mysqli_num_rows($res) > 0) {
            $row = mysqli_fetch_assoc($res);
            if ($api_key == $row['api_key']) {
                $err =  "Key Already Exists";
            }
        } else {
            /* No Error Or Duplicate */
            $query = "INSERT INTO NucleusSAASERP_APIKeys  (api_key, status, details) VALUES (?,?,?)";
            $stmt = $mysqli->prepare($query);
            $rc = $stmt->bind_param('sss', $api_key, $status, $details);
            $stmt->execute();
            if ($stmt) {
                $success = "Key Added";
            } else {
                $info = "Please Try Again Or Try Later ";
            }
        }
    }
}

/* Update API Key */
if (isset($_POST['UpdateAPIKey'])) {
    //Error Handling and prevention of posting double entries
    $error = 0;

    if (isset($_POST['api_key']) && !empty($_POST['api_key'])) {
        $api_key = mysqli_real_escape_string($mysqli, trim($_POST['api_key']));
    } else {
        $error = 1;
        $err = "API Key Cannot Be Empty";
    }

    if (isset($_POST['status']) && !empty($_POST['status'])) {
        $status = mysqli_real_escape_string($mysqli, trim($_POST['status']));
    } else {
        $error = 1;
        $err = "API Key Status Cannot Be Empty";
    }

    if (isset($_POST['id']) && !empty($_POST['id'])) {
        $id = mysqli_real_escape_string($mysqli, trim($_POST['id']));
    } else {
        $error = 1;
        $err = "API Key ID Cannot Be Empty";
    }

    $details = $_POST['details'];

    if (!$error) {

        $query = "UPDATE  NucleusSAASERP_APIKeys SET api_key = ?, status = ?, details = ? WHERE id = ?";
        $stmt = $mysqli->prepare($query);
        $rc = $stmt->bind_param('ssss', $api_key, $status, $details, $id);
        $stmt->execute();
        if ($stmt) {
            $success = "Key Updated";
        } else {
            $info = "Please Try Again Or Try Later ";
        }
    }
}

/* Delete API Key */
if (isset($_GET['delete'])) {
    $delete = $_GET['delete'];
    $adn = "DELETE FROM NucleusSAASERP_APIKeys WHERE id=?";
    $stmt = $mysqli->prepare($adn);
    $stmt->bind_param('s', $delete);
    $stmt->execute();
    $stmt->close();
    if ($stmt) {
        $success = "Deleted" && header("refresh:1; url=admin-api-keys.php");
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
                                    <h5 class="h4 d-inline-block font-weight-400 mb-0 text-white">NucleusSaaS ERP Instances API Keys</h5>
                                </div>
                            </div>
                            <div class="col-md-6 d-flex align-items-center justify-content-between justify-content-md-end">
                                <div class="actions actions-dark d-inline-block">
                                    <a href="#add-apikey" data-toggle="modal" class="action-item ml-md-4">
                                        <i class="far fa-plus mr-2"></i>Add API Keys
                                    </a>
                                    <!-- Add Package Modal -->
                                    <div class="modal fade" id="add-apikey" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-lg">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title text-center" id="exampleModalLabel">Create New Subscription Package</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <form method="POST">
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <label class="form-label">API Key</label>
                                                                <input type="text" required class="form-control" name="api_key">
                                                                <input type="hidden" required value="<?php echo $ID; ?>" class="form-control" name="id">
                                                            </div>
                                                            <div class="col-md-6">
                                                                <label class="form-label">API Key Status</label>
                                                                <select class="form-control" name="status">
                                                                    <option>Active</option>
                                                                    <option>Revoked</option>
                                                                </select>
                                                            </div>
                                                            <div class="col-md-12">
                                                                <label class="form-label">API Key Details</label>
                                                                <textarea type="text" required class="form-control summernote" name="details"><</textarea>
                                                            </div>
                                                        </div>
                                                        <br>
                                                        <div class="text-right">
                                                            <button type="submit" name="AddAPIKey" class="btn btn-primary">Save API Key</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- End Add Package Modal -->
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Listing -->
                    <div class="card">
                        <!-- Table -->
                        <div class="table-responsive card-body">
                            <table id="AdminDashboardDataTables" class="table align-items-center">
                                <thead>
                                    <tr>
                                        <th scope="col" class="sort">API Key</th>
                                        <th scope="col" class="sort">Key Status</th>
                                        <th scope="col" class="sort">Key Details</th>
                                        <th scope="col">Date Created</th>
                                        <th scope="col">Manage Keys</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $ret = "SELECT * FROM `NucleusSAASERP_APIKeys` ";
                                    $stmt = $mysqli->prepare($ret);
                                    $stmt->execute(); //ok
                                    $res = $stmt->get_result();
                                    while ($apiKeys = $res->fetch_object()) {
                                    ?>
                                        <tr>
                                            <td>
                                                <?php echo $apiKeys->api_key; ?>
                                            </td>
                                            <td>
                                                <?php
                                                if ($apiKeys->status = 'Active') {
                                                    echo "<span class='badge badge-pill badge-success'>Active</span>";
                                                } else {
                                                    echo "<span class='badge badge-pill badge-danger'>Revoked</span>";
                                                }
                                                ?>
                                            </td>
                                            <td>
                                                <?php echo $apiKeys->details; ?>
                                            </td>
                                            <td>
                                                <?php echo date('d M Y g:ia', strtotime($apiKeys->created_at)); ?>
                                            </td>
                                            <td>
                                                <a href="#update-<?php echo $apiKeys->id; ?>" data-toggle="modal" class='badge badge-pill badge-warning'><i class="fas fa-edit"></i> Edit</a>
                                                <!-- Update Instance -->
                                                <div class="modal fade" id="update-<?php echo $apiKeys->id; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModalLabel">Update API Keys</h5>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <form method="POST">
                                                                    <div class="row">
                                                                        <div class="col-md-6">
                                                                            <label class="form-label">API Key</label>
                                                                            <input type="text" required class="form-control" value="<?php echo $apiKeys->api_key; ?>" name="api_key">
                                                                            <input type="hidden" required value="<?php echo $apiKeys->id; ?>" class="form-control" name="id">
                                                                        </div>
                                                                        <div class="col-md-6">
                                                                            <label class="form-label">API Key Status</label>
                                                                            <select class="form-control" name="status">
                                                                                <option><?php echo $apiKeys->status; ?></option>
                                                                                <option>Active</option>
                                                                                <option>Revoked</option>
                                                                            </select>
                                                                        </div>
                                                                        <div class="col-md-12">
                                                                            <label class="form-label">API Key Details</label>
                                                                            <textarea type="text" required class="form-control summernote" name="details"><?php echo $apiKeys->details; ?></textarea>
                                                                        </div>
                                                                    </div>
                                                                    <br>
                                                                    <div class="text-right">
                                                                        <button type="submit" name="UpdateAPIKey" class="btn btn-primary">Save API Key</button>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- End Update -->
                                                <a href="#delete-<?php echo $apiKeys->id; ?>" data-toggle="modal" class='badge badge-pill badge-danger'><i class="fas fa-trash"></i> Delete</a>
                                                <!-- Delete Modal -->
                                                <div class="modal fade" id="delete-<?php echo $apiKeys->id; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModalLabel">CONFIRM DELETE</h5>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body text-center text-danger">
                                                                <h4>Delete This API Key Record?</h4>
                                                                <p>
                                                                    Hey There You Are About To Delete An API Key. <br>
                                                                    This Operation Is Irrevessible.
                                                                </p>
                                                                <button type="button" class="text-center btn btn-success" data-dismiss="modal">No</button>
                                                                <a href="admin-api-keys.php?delete=<?php echo $apiKeys->id; ?>" class="text-center btn btn-danger">Yes Delete</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- End Delete Modal -->
                                            </td>
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