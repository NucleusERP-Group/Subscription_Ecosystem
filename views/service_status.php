<?php require_once('../partials/_head.php'); ?>

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
                        Service Status
                    </h1>
                    <p>
                        We continuously monitor our SaaS ERP infrastructure and its related services.
                    </p>
                </header>
                <div class="column-row align-center">
                    <div class="column-66">
                        <div class="tab-group tab-group-switch-style">
                            <div class="tab-item" data-title="Primary Locations">
                                <table class="table-layout-fixed">
                                    <thead>
                                        <tr>
                                            <th>Region</th>
                                            <th>Availability</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>CH-NYC-1</td>
                                            <td>99.95%</td>
                                            <td class="text-color-success">Operational<i class="fas fa-check-circle icon-right"></i></td>
                                        </tr>
                                        <tr>
                                            <td>CH-NYC-2</td>
                                            <td>99.62%</td>
                                            <td class="text-color-success">Operational<i class="fas fa-check-circle icon-right"></i></td>
                                        </tr>
                                        <tr>
                                            <td>CH-FRA-1</td>
                                            <td>100%</td>
                                            <td class="text-color-success">Operational<i class="fas fa-check-circle icon-right"></i></td>
                                        </tr>
                                        <tr>
                                            <td>CH-KE-2</td>
                                            <td>100%</td>
                                            <td class="text-color-success">Operational<i class="fas fa-check-circle icon-right"></i></td>
                                        </tr>
                                        <tr>
                                            <td>CH-KE-3</td>
                                            <td>99.97%</td>
                                            <td class="text-color-error">Peering Outage<i class="fas fa-exclamation-circle icon-right"></i></td>
                                        </tr>
                                        <tr>
                                            <td>CH-TKY-1</td>
                                            <td>100%</td>
                                            <td class="text-color-success">Operational<i class="fas fa-check-circle icon-right"></i></td>
                                        </tr>
                                        <tr>
                                            <td>CH-TKY-2</td>
                                            <td>99.43%</td>
                                            <td class="text-color-warning">DDoS Attack<i class="fas fa-minus-circle icon-right"></i></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="tab-item" data-title="Secondary Locations">
                                <table class="table-layout-fixed">
                                    <thead>
                                        <tr>
                                            <th>Region</th>
                                            <th>Availability</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>CH-LDN-1</td>
                                            <td>99.99%</td>
                                            <td class="text-color-success">Operational<i class="fas fa-check-circle icon-right"></i></td>
                                        </tr>
                                        <tr>
                                            <td>CH-SFA-1</td>
                                            <td>100%</td>
                                            <td class="text-color-success">Operational<i class="fas fa-check-circle icon-right"></i></td>
                                        </tr>
                                        <tr>
                                            <td>CH-SFA-2</td>
                                            <td>99.98%</td>
                                            <td class="text-color-success">Operational<i class="fas fa-check-circle icon-right"></i></td>
                                        </tr>
                                        <tr>
                                            <td>CH-SPA-1</td>
                                            <td>100%</td>
                                            <td class="text-color-success">Operational<i class="fas fa-check-circle icon-right"></i></td>
                                        </tr>
                                        <tr>
                                            <td>CH-DAL-1</td>
                                            <td>99.91%</td>
                                            <td class="text-color-warning">High Latency<i class="fas fa-minus-circle icon-right"></i></td>
                                        </tr>
                                        <tr>
                                            <td>CH-LIS-1</td>
                                            <td>99.98%</td>
                                            <td class="text-color-success">Operational<i class="fas fa-check-circle icon-right"></i></td>
                                        </tr>
                                        <tr>
                                            <td>CH-SDY-1</td>
                                            <td>100%</td>
                                            <td class="text-color-success">Operational<i class="fas fa-check-circle icon-right"></i></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="column-row align-center">
                    <div class="column-50 text-align-center">
                        <p>
                            <small class="text-color-gray">Status updates and incident reports may be delayed up to 30 minutes depending on the technical issue at hand. Please scroll down for past incident reports.</small>
                        </p>
                    </div>
                </div>
            </div>
        </section>
        <!-- Content Row -->
        <section class="content-row">
            <div class="container">
                <div class="column-row align-center">
                    <div class="column-66">
                        <h3>
                            Active Incidents
                        </h3>
                        <hr>
                        <dl>
                            <dt>October 6, 2020</dt>
                            <dd>
                                <p>
                                    <strong>CH-KE-3 DTAG Peering Outage</strong><br>
                                    We're investigating an outage by our peering partner Deutsche Telekom.
                                </p>
                                <p>
                                    <strong>CH-KE-2 Degraded Network Performance</strong><br>
                                    Our network is currently suffering a large DDoS attack impacting core services in our Tokyo Equinix facility. Mitigation in progress.
                                </p>
                            </dd>
                        </dl>
                    </div>
                </div>
            </div>
        </section>
        <!-- Content Row -->
        <section class="content-row content-row-gray">
            <div class="container">
                <div class="column-row align-center">
                    <div class="column-66">
                        <h3>
                            Past Incidents
                        </h3>
                        <hr>
                        <dl>
                            <dt>October 2, 2020</dt>
                            <dd>
                                <p>
                                    <strong>CH-LDN-1 High Latency</strong><br>
                                    We're investigating high latency at our London facility.<br>
                                    <small class="text-color-gray">Resolved at 23:05 UTC</small>
                                </p>
                            </dd>
                            <dt>September 12, 2020</dt>
                            <dd>
                                <p>
                                    <strong>CH-SFA-2 HKIX Peering Outage</strong><br>
                                    We're investigating an outage by our peering partner HKIX.<br>
                                    <small class="text-color-gray">Resolved at 18:45 UTC</small>
                                </p>
                            </dd>

                        </dl>
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