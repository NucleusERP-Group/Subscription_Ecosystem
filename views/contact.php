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
                        Contact Us
                    </h1>
                    <p>
                        Send us a message and our team will be in touch very soon.
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
                                <select name="type">
                                    <option selected>General Inquiries</option>
                                    <option>Abuse or DMCA Report</option>
                                </select>
                            </div>
                            <div class="form-row">
                                <div class="column-row">
                                    <div class="column-50">
                                        <label for="form-name">Full Name</label>
                                        <input id="form-name" type="text" name="name">
                                    </div>
                                    <div class="column-50">
                                        <label for="form-email">Email Address</label>
                                        <input id="form-email" type="text" name="email">
                                    </div>
                                </div>
                            </div>
                            <div class="form-row">
                                <label for="form-subject">Subject</label>
                                <input id="form-subject" type="text" name="subject">
                            </div>
                            <div class="form-row">
                                <label for="form-message">Message</label>
                                <textarea id="form-message" name="message" cols="10" rows="10"></textarea>
                            </div>
                            <div class="form-row">
                                <input id="form-newsletter" type="checkbox" name="newsletter" checked>
                                <label for="form-newsletter">Subscribe to our monthly newsletter</label>
                            </div>
                            <div class="form-row">
                                <button type="submit" class="button-secondary"><i class="fas fa-envelope icon-left"></i>Send Message</button>
                            </div>
                        </form>
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