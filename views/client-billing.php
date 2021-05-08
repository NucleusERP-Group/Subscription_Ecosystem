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
require_once('../config/codeGen.php');
require_once('../config/checklogin.php');
client_login();

/* Add Card */
if (isset($_POST['addCard'])) {
    //Error Handling and prevention of posting double entries
    $error = 0;

    if (isset($_POST['card_id']) && !empty($_POST['card_id'])) {
        $card_id = mysqli_real_escape_string($mysqli, trim($_POST['card_id']));
    } else {
        $error = 1;
        $err = "Card ID Cannot Be Empty";
    }

    if (isset($_POST['card_holder_id']) && !empty($_POST['card_holder_id'])) {
        $card_holder_id = mysqli_real_escape_string($mysqli, trim($_POST['card_holder_id']));
    } else {
        $error = 1;
        $err = "Card Holder ID Cannot Be Empty";
    }

    if (isset($_POST['card_holder_name']) && !empty($_POST['card_holder_name'])) {
        $card_holder_name = mysqli_real_escape_string($mysqli, trim($_POST['card_holder_name']));
    } else {
        $error = 1;
        $err = "Card Holder Name Cannot Be Empty";
    }

    if (isset($_POST['card_holder_email']) && !empty($_POST['card_holder_email'])) {
        $card_holder_email = mysqli_real_escape_string($mysqli, trim($_POST['card_holder_email']));
    } else {
        $error = 1;
        $err = "Card Holder Email Cannot Be Empty";
    }

    if (isset($_POST['card_name']) && !empty($_POST['card_name'])) {
        $card_name = mysqli_real_escape_string($mysqli, trim($_POST['card_name']));
    } else {
        $error = 1;
        $err = "Card Name Cannot Be Empty";
    }

    if (isset($_POST['card_number']) && !empty($_POST['card_number'])) {
        $card_number = mysqli_real_escape_string($mysqli, trim($_POST['card_number']));
    } else {
        $error = 1;
        $err = "Card Number Cannot Be Empty";
    }

    if (isset($_POST['card_exp_date']) && !empty($_POST['card_exp_date'])) {
        $card_exp_date = mysqli_real_escape_string($mysqli, trim($_POST['card_exp_date']));
    } else {
        $error = 1;
        $err = "Card Expiry Date Cannot Be Empty";
    }

    if (isset($_POST['card_cvv']) && !empty($_POST['card_cvv'])) {
        $card_cvv = mysqli_real_escape_string($mysqli, trim($_POST['card_cvv']));
    } else {
        $error = 1;
        $err = "Card CVV Cannot Be Empty";
    }

    if (!$error) {
        /* Check Card Types  */
        $cardtype = array(
            "visa"       => "/^4[0-9]{12}(?:[0-9]{3})?$/",
            "mastercard" => "/^5[1-5][0-9]{14}$/",
        );

        if (preg_match($cardtype['visa'], $card_number) && preg_match($cardtype['mastercard'], $card_number)) {
            /* Prevent Double Entries */
            $sql = "SELECT * FROM  NucleusSAASERP_UsersCards WHERE  card_number = '$card_number' && card_cvv = '$card_cvv' ";
            $res = mysqli_query($mysqli, $sql);
            if (mysqli_num_rows($res) > 0) {
                $row = mysqli_fetch_assoc($res);
                if ($card_number == $row['card_number'] && $card_cvv == $row['card_cvv']) {
                    $err =  "Credit Card With This Number:  $card_number And This CVV: $card_cvv Already Exists";
                }
            } else {
                /* No Error Or Duplicate */
                $query = "INSERT INTO NucleusSAASERP_UsersCards  (card_id, card_holder_id, card_holder_name, card_holder_email, card_name, card_number, card_exp_date, card_cvv) VALUES (?,?,?,?,?,?,?,?)";
                $stmt = $mysqli->prepare($query);
                $rc = $stmt->bind_param('ssssssss', $card_id, $card_holder_id, $card_holder_name, $card_holder_email, $card_name, $card_number, $card_exp_date, $card_cvv);
                $stmt->execute();
                if ($stmt) {
                    $success = "$card_name Added.";
                } else {
                    $info = "Please Try Again Or Try Later";
                }
            }
        } else {
            $err = "Incorrect Credit Card Number Or Unsupported Credit Card Vendor";
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
            <?php
            require_once('../partials/dashboard_main_nav.php');
            /* Logged In Client Session */
            $id = $_SESSION['id'];
            $ret = "SELECT * FROM `NucleusSAASERP_Users` WHERE id = '$id'  ";
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
                                    <h5 class="h4 d-inline-block font-weight-400 mb-0 text-white">Billing</h5>
                                </div>
                                <!-- Additional info -->
                            </div>
                            <div class="col-md-6 d-flex align-items-center justify-content-between justify-content-md-end">
                            </div>
                        </div>
                    </div>
                    <!-- Nav -->
                    <ul class="nav nav-dark nav-tabs nav-overflow">
                        <li class="nav-item">
                            <a href="client-billing.php" class="nav-link active">
                                <i class="far fa-credit-card mr-2"></i>Cards
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="client-payment-history.php" class="nav-link">
                                <i class="far fa-file-invoice mr-2"></i>History
                            </a>
                        </li>
                    </ul>
                    <div class="row">
                        <!-- User Profile Partial -->
                        <?php require_once('../partials/dashboard_usersettings.php'); ?>
                        <div class="col-lg-8 order-lg-1">
                            <div class="card">
                                <div class="card-header">
                                    <span class="h6">Summary</span>
                                </div>
                                <div>
                                    <ul class="list-group list-group-flush">
                                        <!-- Load This Based On User Subscription -->
                                        <li class="list-group-item">
                                            <div class="row align-items-center">
                                                <div class="col-sm-4"><small class="h6 text-sm mb-3 mb-sm-0">Plan</small></div>
                                                <div class="col-sm-5">
                                                    <strong>Free</strong> Plan, Unlimited Public Repositories.
                                                </div>
                                                <div class="col-sm-3 text-sm-right">
                                                    <a href="#" class="btn btn-sm btn-primary rounded-pill mt-3 mt-sm-0">Upgrade</a>
                                                </div>
                                            </div>
                                        </li>

                                        <li class="list-group-item">
                                            <div class="row">
                                                <div class="col-sm-4"><small class="h6 text-sm mb-3 mb-sm-0">My Credit Or Debit Cards</small></div>
                                                <div class="col-sm-8">
                                                    <?php
                                                    /* Load Credit Card Based On The Logged In User */
                                                    $id = $_SESSION['id'];
                                                    $ret = "SELECT * FROM `NucleusSAASERP_UsersCards` WHERE card_holder_id = '$id'  ";
                                                    $stmt = $mysqli->prepare($ret);
                                                    $stmt->execute(); //ok
                                                    $res = $stmt->get_result();
                                                    while ($card = $res->fetch_object()) {
                                                    ?>
                                                        <div class="row mb-3">
                                                            <div class="col-9">
                                                                <?php echo $card->card_name . " " . $card->card_number . " Expiry: " . $card->card_exp_date; ?>
                                                            </div>
                                                            <div class="col-3 actions text-right">
                                                                <a href="client-billing.php?delete=<?php echo $card->card_id; ?>" class="action-item" data-toggle="tooltip" data-original-title="Remove card">
                                                                    <i class="far fa-trash-alt"></i>
                                                                </a>
                                                            </div>
                                                        </div>
                                                    <?php
                                                    } ?>
                                                </div>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <!-- Attach a new card -->
                            <div class="card">
                                <div class="card-header">
                                    <div class="row">
                                        <div class="col-5 col-lg-8">
                                            <span class="h6">Add New Card</span>
                                            <p class="text-muted text-sm mt-2 mb-0 d-none d-lg-block">Safe Money Transfer Using Your Bank Account. We support Mastercard, Visa, PayPal and Stripe.</p>
                                        </div>
                                        <div class="col-7 col-lg-4 text-right">
                                            <img alt="Image placeholder" src="../public/assets/img/icons/cards/mastercard.png" width="40" class="mr-2">
                                            <img alt="Image placeholder" src="../public/assets/img/icons/cards/visa.png" width="40" class="mr-2">
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <form method="POST">
                                        <div class="row mt-3">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label class="form-control-label">Card Number</label>
                                                    <div class="input-group input-group-merge">
                                                        <input type="text" class="form-control" name="card_number" data-mask="0000 0000 0000 0000">
                                                        <div class="input-group-append">
                                                            <span class="input-group-text"><i class="far fa-credit-card"></i></span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="form-control-label">Card Name</label>
                                                    <input type="text" class="form-control" name="card_name">
                                                    <!-- Hidden Values -->
                                                    <input type="hidden" class="form-control" value="<?php echo $client->id; ?>" name="card_holder_id">
                                                    <input type="hidden" class="form-control" value="<?php echo $client->name; ?>" name="card_holder_name">
                                                    <input type="hidden" class="form-control" value="<?php echo $client->email; ?>" name="card_holder_email">
                                                    <input type="hidden" class="form-control" value="<?php echo $ID; ?>" name="card_id">
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label class="form-control-label">Expiry Date</label>
                                                    <input type="text" class="form-control" name="card_exp_date" data-mask="00/00" placeholder="MM/YY">
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label class="form-control-label">Card CVV</label>
                                                    <div class="input-group input-group-merge">
                                                        <input type="text" class="form-control" name="card_cvv" data-mask="000">
                                                        <div class="input-group-append">
                                                            <span class="input-group-text"><i class="far fa-question-circle"></i></span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="text-right">
                                            <button type="submit" name="addCard" class="btn btn-sm btn-primary rounded-pill">Save card</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <!-- Add money using PayPal -->
                            <!-- <div class="card">
                            <div class="card-header">
                                <div class="row">
                                    <div class="col-5 col-lg-8">
                                        <span class="h6">Top up with PayPal</span>
                                        <p class="text-sm text-muted mt-2 mb-0 d-none d-lg-block">Pay your order using the most known and secure platform for online money transfers. You will be redirected to PayPal to finish complete your purchase.</p>
                                    </div>
                                    <div class="col-7 col-lg-4 text-right">
                                        <img alt="Image placeholder" src="../../assets/img/icons/cards/paypal-256x160.png" width="40">
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <form>
                                    <div class="btn-group btn-group-toggle d-flex" data-toggle="buttons">
                                        <label class="btn btn-sm btn-secondary flex-fill">
                                            <input type="radio" name="options" id="checkboxButton3"> $10
                                        </label>
                                        <label class="btn btn-sm btn-secondary flex-fill">
                                            <input type="radio" name="options" id="checkboxButton4"> $25
                                        </label>
                                        <label class="btn btn-sm btn-secondary flex-fill">
                                            <input type="radio" name="options" id="checkboxButton5"> $50
                                        </label>
                                        <label class="btn btn-sm btn-secondary flex-fill">
                                            <input type="radio" name="options" id="checkboxButton6"> $100
                                        </label>
                                    </div>
                                    <div class="text-right mt-3">
                                        <a href="#" class="btn btn-sm btn-primary rounded-pill">Pay with PayPal</a>
                                    </div>
                                </form>
                            </div>
                        </div> -->
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