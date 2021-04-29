<?php
require_once('../partials/_head.php'); ?>

<body class="footer-dark">
    <!-- Header -->
    <header id="header" class="header-dynamic header-shadow-scroll">
        <div class="container">
            <a class="logo" href="index.html">
                <img src="img/logos/header-light.png" alt="">
            </a>
            <nav>
                <ul class="nav-primary">
                    <li>
                        <a href="home.html">Products</a>
                        <ul>
                            <li>
                                <a href="products-cloud-hosting.html">Cloud Hosting</a>
                            </li>
                            <li>
                                <a href="products-cloud-servers.html">Cloud Servers</a>
                                <ul>
                                    <li>
                                        <a href="products-developer-cloud.html">Developer Cloud</a>
                                    </li>
                                    <li>
                                        <a href="products-custom-cloud.html">Custom Cloud</a>
                                    </li>
                                </ul>
                            </li>
                            <li>
                                <a href="products-dedicated-cloud.html">Dedicated Cloud</a>
                            </li>
                            <li>
                                <a href="products-block-storage.html">Block Storage</a>
                            </li>
                            <li>
                                <a href="products-anycast-dns.html">Anycast DNS</a>
                            </li>
                            <li>
                                <a href="products-ssl-certificates.html">SSL Certificates</a>
                            </li>
                            <li>
                                <a href="products-domain-names.html">Domain Names</a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="features.html">Features</a>
                        <ul>
                            <li>
                                <a href="index.html">Demos</a>
                                <ul>
                                    <li>
                                        <a href="home.html">Default</a>
                                    </li>
                                    <li>
                                        <a href="home-large-slider.html">Large Slider</a>
                                    </li>
                                    <li>
                                        <a href="home-light-header.html">Light Header</a>
                                    </li>
                                    <li>
                                        <a href="home-single-page.html">Single Page</a>
                                    </li>
                                    <li>
                                        <a href="home-light-slider.html">Light Slider</a>
                                    </li>
                                    <li>
                                        <a href="home-product-slider.html">Product Slider</a>
                                    </li>
                                    <li>
                                        <a href="home-user-onboarding.html">User Onboarding</a>
                                    </li>
                                    <li>
                                        <a href="home-domain-search.html">Domain Search</a>
                                    </li>
                                    <li>
                                        <a href="home-custom-color.html">Custom Color</a>
                                    </li>
                                </ul>
                            </li>
                            <li>
                                <a href="elements-other.html">Elements</a>
                                <ul>
                                    <li>
                                        <a href="blog-sidebar.html">Blog Sidebar</a>
                                    </li>
                                    <li>
                                        <a href="elements-columns.html">Column Rows</a>
                                    </li>
                                    <li>
                                        <a href="elements-sliders.html">Content Sliders</a>
                                    </li>
                                    <li>
                                        <a href="elements-pricing.html">Pricing Options</a>
                                    </li>
                                    <li>
                                        <a href="elements-masonry.html">Masonry Grid</a>
                                    </li>
                                    <li>
                                        <a href="elements-forms.html">Form Inputs</a>
                                    </li>
                                    <li>
                                        <a href="elements-tabs.html">Tab Groups</a>
                                    </li>
                                    <li>
                                        <a href="elements-galleries.html">Galleries</a>
                                    </li>
                                    <li>
                                        <a href="elements-other.html">Other</a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="network.html">Network</a>
                    </li>
                    <li>
                        <a href="about.html">Company</a>
                        <ul>
                            <li>
                                <a href="blog.html">Blog</a>
                            </li>
                            <li>
                                <a href="contact.html">Contact</a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a class="button button-secondary" href="client-login.html">
                            <i class="fas fa-lock icon-left"></i>Client Login
                        </a>
                    </li>
                </ul>
                <ul class="nav-secondary">
                    <li>
                        <a href="contact.html"><i class="fas fa-phone icon-left"></i>+1 800 123 456</a>
                    </li>
                    <li>
                        <a href="contact.html"><i class="fas fa-comment icon-left"></i>Support Chat</a>
                    </li>
                    <li>
                        <a href="knowledge-base.html"><i class="fas fa-question-circle icon-left"></i>Knowledge Base</a>
                    </li>
                    <li>
                        <a href="service-status.html"><i class="fas fa-check icon-left"></i>Service Status</a>
                    </li>
                </ul>
            </nav>
        </div>
    </header>
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
                        <form class="form-full-width" method="get" action="https://demo.serifly.com/cloudhub/html/contact.html">
                            <div class="form-row">
                                <select name="type">
                                    <option value="general" selected>General Inquiries</option>
                                    <option value="abuse">Abuse or DMCA Report</option>
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
                                <button class="button-secondary"><i class="fas fa-envelope icon-left"></i>Send Message</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>
        <!-- Content Row -->
        <section class="content-row content-row-gray">
            <div class="container">
                <div class="column-row align-center text-align-center">
                    <div class="column-33">
                        <i class="fas fa-life-ring icon-feature"></i>
                        <h3>
                            Customer Support
                        </h3>
                        <p>
                            Please submit a ticket through our client portal to contact us if you are already a customer.
                        </p>
                        <p>
                            <a href="#customer-support">Open a Ticket<i class="fas fa-angle-right icon-right"></i></a>
                        </p>
                    </div>
                    <div class="column-33">
                        <i class="fas fa-comments icon-feature"></i>
                        <h3>
                            IRC Community
                        </h3>
                        <p>
                            Chat with our IRC community to learn more about cloud hosting, management and networking.
                        </p>
                        <p>
                            <a href="#irc-community">Connect to IRC<i class="fas fa-angle-right icon-right"></i></a>
                        </p>
                    </div>
                    <div class="column-33">
                        <i class="fas fa-exclamation-triangle icon-feature"></i>
                        <h3>
                            Bounty Program
                        </h3>
                        <p>
                            We are dedicated to keep our platform secure and offer a bounty for every reported security issue.
                        </p>
                        <p>
                            <a href="#bounty-program">Report a Bug<i class="fas fa-angle-right icon-right"></i></a>
                        </p>
                    </div>
                </div>
            </div>
        </section>
        <!-- Content Row -->
        <section class="content-row content-row-color">
            <div class="container">
                <header class="content-header">
                    <h2>
                        Interested in visiting us?
                    </h2>
                    <p>
                        Please schedule an appointment with our sales team if you're interested in visiting one of our branches, datacenters or meeting with our team of technicians in person.<br><br>
                        <a class="button button-secondary" href="about.html">
                            <i class="fas fa-globe icon-left"></i>Global Branches
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