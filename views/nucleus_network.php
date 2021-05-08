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
                <header class="content-header content-header-small">
                    <h1>
                        NucleusSaaS ERP Global Network
                    </h1>
                    <p>
                        NucleusSaaS ERP operates on a low latency, 100 Gbit worldwide network.
                    </p>
                </header>
            </div>
        </section>

        <!-- Content Row -->
        <section class="content-row">
            <div class="container">
                <div class="column-row">
                    <div class="column-50">
                        <h3>
                            Redundant Infrastructure
                        </h3>
                        <p>
                            We operate one of the most advanced 100 Gbit networks in the world, complete with Anycast support and extensive DDoS protection. All our datacenters are Tier 4 certified and provide advanced fire and intrusion protection combined with enterprise networking hardware to ensure highest availability.
                        </p>
                        <ul class="list-style-icon">
                            <li>
                                <i class="fas fa-check"></i>Redundant network gear
                            </li>
                            <li>
                                <i class="fas fa-check"></i>Systematic double power supply
                            </li>
                            <li>
                                <i class="fas fa-check"></i>Minimum of 200 kVA per UPS device
                            </li>
                            <li>
                                <i class="fas fa-check"></i>Generators with initial autonomy of 48 hours
                            </li>
                            <li>
                                <i class="fas fa-check"></i>Support technicians on site 24/7
                            </li>
                        </ul>
                        <p class="text-color-gray">
                            <small>Our primary locations offer additional advanced features, custom colocation and deployment options perfectly suited for mission critical enterprise services.</small>
                        </p>
                    </div>
                    <div class="column-50">
                        <div class="gallery gallery-slider">
                            <ul>
                                <li>
                                    <a href="../public/uploads/gallery-5.jpg"><img src="../public/uploads/gallery-5-small.jpg" alt=""></a>
                                </li>
                                <li>
                                    <a href="../public/uploads/gallery-6.jpg"><img src="../public/uploads/gallery-6-small.jpg" alt=""></a>
                                </li>
                                <li>
                                    <a href="../public/uploads/gallery-7.jpg"><img src="../public/uploads/gallery-7-small.jpg" alt=""></a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Content Row -->

        <!-- Content Row -->
        <section class="content-row content-row-color">
            <div class="container">
                <header class="content-header">
                    <h2>
                        Looking for a custom solution?
                    </h2>
                    <p>
                        Our technicians can provide you with the best custom made solutions on the market, no matter whether you're a small business or large enterprise.<br><br>
                        <a class="button button-secondary" href="contact.php">
                            <i class="fas fa-envelope icon-left"></i>Get in touch
                        </a>
                    </p>
                </header>
            </div>
        </section>
    </section>
    <!-- Footer -->
    <?php require_once('../partials/_footer.php'); ?>
    <!-- Scripts -->
    <?php require_once('../partials/_scripts.php'); ?>
</body>


</html>