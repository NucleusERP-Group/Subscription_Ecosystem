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
                        NucleusSaaS ERP Client Login
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
                            <div class="form-row">
                                <label for="form-email">Email Address</label>
                                <input id="form-email" type="text" name="email">
                            </div>
                            <div class="form-row">
                                <label for="form-password">Password</label>
                                <input id="form-password" type="password" name="password">
                            </div>
                            <div class="form-row">
                                <input id="form-login" type="checkbox" name="login" checked>
                                <label for="form-login">Save my login session on this computer</label>
                            </div>
                            <div class="form-row">
                                <button class="button-secondary"><i class="fas fa-lock icon-left"></i>Confirm</button>
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
                            New to NucleusSaaS ERP Ecosystem?<br>
                            <a href="client-signup.php">Create Account<i class="fas fa-angle-right icon-right"></i></a>
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