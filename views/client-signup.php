<?php
require_once('../partials/_head.php'); ?>

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