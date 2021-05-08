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
require_once('../config/checklogin.php');
client_login();
require_once('../partials/dashboard_head.php');
?>

<body class="application application-offset">
    <!-- Chat modal -->
    <!-- Customizer modal -->
    <div class="modal fade fixed-right" id="modal-chat" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-vertical" role="document">
            <div class="modal-content">
                <div class="modal-header align-items-center">
                    <div class="modal-title">
                        <h6 class="mb-0">Chat</h6>
                        <span class="d-block text-sm">3 new conversations</span>
                    </div>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="scrollbar-inner">
                    <!-- Chat contacts -->
                    <div class="list-group list-group-flush">
                        <a href="#" class="list-group-item list-group-item-action">
                            <div class="d-flex align-items-center" data-toggle="tooltip" data-placement="right" data-title="">
                                <div>
                                    <div class="avatar-parent-child">
                                        <img alt="Image placeholder" src="../assets/img/theme/light/team-1-800x800.jpg" class="avatar  rounded-circle">
                                        <span class="avatar-child avatar-badge bg-warning"></span>
                                    </div>
                                </div>
                                <div class="flex-fill ml-3">
                                    <h6 class="text-sm mb-0">John Sullivan</h6>
                                    <p class="text-sm mb-0">
                                        Working remotely
                                    </p>
                                </div>
                            </div>
                        </a>
                        <a href="#" class="list-group-item list-group-item-action">
                            <div class="d-flex align-items-center" data-toggle="tooltip" data-placement="right" data-title="">
                                <div>
                                    <div class="avatar-parent-child">
                                        <img alt="Image placeholder" src="../assets/img/theme/light/team-2-800x800.jpg" class="avatar  rounded-circle">
                                        <span class="avatar-child avatar-badge bg-warning"></span>
                                    </div>
                                </div>
                                <div class="flex-fill ml-3">
                                    <h6 class="text-sm mb-0">Heather Wright</h6>
                                    <p class="text-sm mb-0">
                                        Working remotely
                                    </p>
                                </div>
                            </div>
                        </a>
                        <a href="#" class="list-group-item list-group-item-action">
                            <div class="d-flex align-items-center" data-toggle="tooltip" data-placement="right" data-title="">
                                <div>
                                    <div class="avatar-parent-child">
                                        <img alt="Image placeholder" src="../assets/img/theme/light/team-3-800x800.jpg" class="avatar  rounded-circle">
                                        <span class="avatar-child avatar-badge bg-warning"></span>
                                    </div>
                                </div>
                                <div class="flex-fill ml-3">
                                    <h6 class="text-sm mb-0">James Lewis</h6>
                                    <p class="text-sm mb-0">
                                        Working remotely
                                    </p>
                                </div>
                            </div>
                        </a>
                        <a href="#" class="list-group-item list-group-item-action">
                            <div class="d-flex align-items-center" data-toggle="tooltip" data-placement="right" data-title="">
                                <div>
                                    <div class="avatar-parent-child">
                                        <img alt="Image placeholder" src="../assets/img/theme/light/team-4-800x800.jpg" class="avatar  rounded-circle">
                                        <span class="avatar-child avatar-badge bg-warning"></span>
                                    </div>
                                </div>
                                <div class="flex-fill ml-3">
                                    <h6 class="text-sm mb-0">Martin Gray</h6>
                                    <p class="text-sm mb-0">
                                        Working remotely
                                    </p>
                                </div>
                            </div>
                        </a>
                        <a href="#" class="list-group-item list-group-item-action">
                            <div class="d-flex align-items-center" data-toggle="tooltip" data-placement="right" data-title="">
                                <div>
                                    <div class="avatar-parent-child">
                                        <img alt="Image placeholder" src="../assets/img/theme/light/team-5-800x800.jpg" class="avatar  rounded-circle">
                                        <span class="avatar-child avatar-badge bg-warning"></span>
                                    </div>
                                </div>
                                <div class="flex-fill ml-3">
                                    <h6 class="text-sm mb-0">John Snow</h6>
                                    <p class="text-sm mb-0">
                                        Working remotely
                                    </p>
                                </div>
                            </div>
                        </a>
                        <a href="#" class="list-group-item list-group-item-action">
                            <div class="d-flex align-items-center" data-toggle="tooltip" data-placement="right" data-title="">
                                <div>
                                    <div class="avatar-parent-child">
                                        <img alt="Image placeholder" src="../assets/img/theme/light/team-1-800x800.jpg" class="avatar  rounded-circle">
                                        <span class="avatar-child avatar-badge bg-warning"></span>
                                    </div>
                                </div>
                                <div class="flex-fill ml-3">
                                    <h6 class="text-sm mb-0">John Michael</h6>
                                    <p class="text-sm mb-0">
                                        Working remotely
                                    </p>
                                </div>
                            </div>
                        </a>
                        <a href="#" class="list-group-item list-group-item-action">
                            <div class="d-flex align-items-center" data-toggle="tooltip" data-placement="right" data-title="">
                                <div>
                                    <div class="avatar-parent-child">
                                        <img alt="Image placeholder" src="../assets/img/theme/light/team-2-800x800.jpg" class="avatar  rounded-circle">
                                        <span class="avatar-child avatar-badge bg-warning"></span>
                                    </div>
                                </div>
                                <div class="flex-fill ml-3">
                                    <h6 class="text-sm mb-0">Monroe Parker</h6>
                                    <p class="text-sm mb-0">
                                        Working remotely
                                    </p>
                                </div>
                            </div>
                        </a>
                        <a href="#" class="list-group-item list-group-item-action">
                            <div class="d-flex align-items-center" data-toggle="tooltip" data-placement="right" data-title="">
                                <div>
                                    <div class="avatar-parent-child">
                                        <img alt="Image placeholder" src="../assets/img/theme/light/team-3-800x800.jpg" class="avatar  rounded-circle">
                                        <span class="avatar-child avatar-badge bg-warning"></span>
                                    </div>
                                </div>
                                <div class="flex-fill ml-3">
                                    <h6 class="text-sm mb-0">Danielle Levin</h6>
                                    <p class="text-sm mb-0">
                                        Working remotely
                                    </p>
                                </div>
                            </div>
                        </a>
                        <a href="#" class="list-group-item list-group-item-action">
                            <div class="d-flex align-items-center" data-toggle="tooltip" data-placement="right" data-title="">
                                <div>
                                    <div class="avatar-parent-child">
                                        <img alt="Image placeholder" src="../assets/img/theme/light/team-4-800x800.jpg" class="avatar  rounded-circle">
                                        <span class="avatar-child avatar-badge bg-warning"></span>
                                    </div>
                                </div>
                                <div class="flex-fill ml-3">
                                    <h6 class="text-sm mb-0">Jesse Stevens</h6>
                                    <p class="text-sm mb-0">
                                        Working remotely
                                    </p>
                                </div>
                            </div>
                        </a>
                        <a href="#" class="list-group-item list-group-item-action">
                            <div class="d-flex align-items-center" data-toggle="tooltip" data-placement="right" data-title="">
                                <div>
                                    <div class="avatar-parent-child">
                                        <img alt="Image placeholder" src="../assets/img/theme/light/team-5-800x800.jpg" class="avatar  rounded-circle">
                                        <span class="avatar-child avatar-badge bg-warning"></span>
                                    </div>
                                </div>
                                <div class="flex-fill ml-3">
                                    <h6 class="text-sm mb-0">John Snow</h6>
                                    <p class="text-sm mb-0">
                                        Working remotely
                                    </p>
                                </div>
                            </div>
                        </a>
                        <a href="#" class="list-group-item list-group-item-action">
                            <div class="d-flex align-items-center" data-toggle="tooltip" data-placement="right" data-title="">
                                <div>
                                    <div class="avatar-parent-child">
                                        <img alt="Image placeholder" src="../assets/img/theme/light/team-1-800x800.jpg" class="avatar  rounded-circle">
                                        <span class="avatar-child avatar-badge bg-warning"></span>
                                    </div>
                                </div>
                                <div class="flex-fill ml-3">
                                    <h6 class="text-sm mb-0">John Sullivan</h6>
                                    <p class="text-sm mb-0">
                                        Working remotely
                                    </p>
                                </div>
                            </div>
                        </a>
                        <a href="#" class="list-group-item list-group-item-action">
                            <div class="d-flex align-items-center" data-toggle="tooltip" data-placement="right" data-title="">
                                <div>
                                    <div class="avatar-parent-child">
                                        <img alt="Image placeholder" src="../assets/img/theme/light/team-2-800x800.jpg" class="avatar  rounded-circle">
                                        <span class="avatar-child avatar-badge bg-warning"></span>
                                    </div>
                                </div>
                                <div class="flex-fill ml-3">
                                    <h6 class="text-sm mb-0">Heather Wright</h6>
                                    <p class="text-sm mb-0">
                                        Working remotely
                                    </p>
                                </div>
                            </div>
                        </a>
                        <a href="#" class="list-group-item list-group-item-action">
                            <div class="d-flex align-items-center" data-toggle="tooltip" data-placement="right" data-title="">
                                <div>
                                    <div class="avatar-parent-child">
                                        <img alt="Image placeholder" src="../assets/img/theme/light/team-3-800x800.jpg" class="avatar  rounded-circle">
                                        <span class="avatar-child avatar-badge bg-warning"></span>
                                    </div>
                                </div>
                                <div class="flex-fill ml-3">
                                    <h6 class="text-sm mb-0">James Lewis</h6>
                                    <p class="text-sm mb-0">
                                        Working remotely
                                    </p>
                                </div>
                            </div>
                        </a>
                        <a href="#" class="list-group-item list-group-item-action">
                            <div class="d-flex align-items-center" data-toggle="tooltip" data-placement="right" data-title="">
                                <div>
                                    <div class="avatar-parent-child">
                                        <img alt="Image placeholder" src="../assets/img/theme/light/team-4-800x800.jpg" class="avatar  rounded-circle">
                                        <span class="avatar-child avatar-badge bg-warning"></span>
                                    </div>
                                </div>
                                <div class="flex-fill ml-3">
                                    <h6 class="text-sm mb-0">Martin Gray</h6>
                                    <p class="text-sm mb-0">
                                        Working remotely
                                    </p>
                                </div>
                            </div>
                        </a>
                        <a href="#" class="list-group-item list-group-item-action">
                            <div class="d-flex align-items-center" data-toggle="tooltip" data-placement="right" data-title="">
                                <div>
                                    <div class="avatar-parent-child">
                                        <img alt="Image placeholder" src="../assets/img/theme/light/team-5-800x800.jpg" class="avatar  rounded-circle">
                                        <span class="avatar-child avatar-badge bg-warning"></span>
                                    </div>
                                </div>
                                <div class="flex-fill ml-3">
                                    <h6 class="text-sm mb-0">John Snow</h6>
                                    <p class="text-sm mb-0">
                                        Working remotely
                                    </p>
                                </div>
                            </div>
                        </a>
                        <a href="#" class="list-group-item list-group-item-action">
                            <div class="d-flex align-items-center" data-toggle="tooltip" data-placement="right" data-title="">
                                <div>
                                    <div class="avatar-parent-child">
                                        <img alt="Image placeholder" src="../assets/img/theme/light/team-1-800x800.jpg" class="avatar  rounded-circle">
                                        <span class="avatar-child avatar-badge bg-warning"></span>
                                    </div>
                                </div>
                                <div class="flex-fill ml-3">
                                    <h6 class="text-sm mb-0">John Michael</h6>
                                    <p class="text-sm mb-0">
                                        Working remotely
                                    </p>
                                </div>
                            </div>
                        </a>
                        <a href="#" class="list-group-item list-group-item-action">
                            <div class="d-flex align-items-center" data-toggle="tooltip" data-placement="right" data-title="">
                                <div>
                                    <div class="avatar-parent-child">
                                        <img alt="Image placeholder" src="../assets/img/theme/light/team-2-800x800.jpg" class="avatar  rounded-circle">
                                        <span class="avatar-child avatar-badge bg-warning"></span>
                                    </div>
                                </div>
                                <div class="flex-fill ml-3">
                                    <h6 class="text-sm mb-0">Monroe Parker</h6>
                                    <p class="text-sm mb-0">
                                        Working remotely
                                    </p>
                                </div>
                            </div>
                        </a>
                        <a href="#" class="list-group-item list-group-item-action">
                            <div class="d-flex align-items-center" data-toggle="tooltip" data-placement="right" data-title="">
                                <div>
                                    <div class="avatar-parent-child">
                                        <img alt="Image placeholder" src="../assets/img/theme/light/team-3-800x800.jpg" class="avatar  rounded-circle">
                                        <span class="avatar-child avatar-badge bg-warning"></span>
                                    </div>
                                </div>
                                <div class="flex-fill ml-3">
                                    <h6 class="text-sm mb-0">Danielle Levin</h6>
                                    <p class="text-sm mb-0">
                                        Working remotely
                                    </p>
                                </div>
                            </div>
                        </a>
                        <a href="#" class="list-group-item list-group-item-action">
                            <div class="d-flex align-items-center" data-toggle="tooltip" data-placement="right" data-title="">
                                <div>
                                    <div class="avatar-parent-child">
                                        <img alt="Image placeholder" src="../assets/img/theme/light/team-4-800x800.jpg" class="avatar  rounded-circle">
                                        <span class="avatar-child avatar-badge bg-warning"></span>
                                    </div>
                                </div>
                                <div class="flex-fill ml-3">
                                    <h6 class="text-sm mb-0">Jesse Stevens</h6>
                                    <p class="text-sm mb-0">
                                        Working remotely
                                    </p>
                                </div>
                            </div>
                        </a>
                        <a href="#" class="list-group-item list-group-item-action">
                            <div class="d-flex align-items-center" data-toggle="tooltip" data-placement="right" data-title="">
                                <div>
                                    <div class="avatar-parent-child">
                                        <img alt="Image placeholder" src="../assets/img/theme/light/team-5-800x800.jpg" class="avatar  rounded-circle">
                                        <span class="avatar-child avatar-badge bg-warning"></span>
                                    </div>
                                </div>
                                <div class="flex-fill ml-3">
                                    <h6 class="text-sm mb-0">John Snow</h6>
                                    <p class="text-sm mb-0">
                                        Working remotely
                                    </p>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="modal-footer py-3 mt-auto">
                    <a href="#" class="btn btn-block btn-sm btn-neutral btn-icon rounded-pill">
                        <span class="btn-inner--icon"><i class="fab fa-facebook-messenger"></i></span>
                        <span class="btn-inner--text">Open Chat</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <!-- Application container -->
    <div class="container-fluid container-application">
        <!-- Sidenav -->
        <?php require_once('../partials/dashboard_sidenav.php'); ?>
        <!-- Content -->
        <div class="main-content position-relative">
            <!-- Main nav -->
            <?php require_once('../partials/dashboard_main_nav.php'); ?>
            <!-- Page content -->
            <div class="page-content">
                <!-- Page title -->
                <?php require_once('../partials/dashboard_ml.php'); ?>
                <div class="row">
                    <div class="col-xl-8 col-md-6">
                        <div class="card card-fluid">
                            <div class="card-header">
                                <h6 class="mb-0">Engagement</h6>
                            </div>
                            <div class="card-body">
                                <!-- Chart -->
                                <div id="apex-engagement" data-color="primary" data-height="280"></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4 col-md-6">
                        <div class="card card-fluid">
                            <div class="card-body text-center d-flex flex-column justify-content-center">
                                <h5 class="mb-4">Emails sent</h5>
                                <div class="progress-circle progress-lg mx-auto" id="progress-5" data-progress="50" data-text="98" data-textclass="h1" data-color="warning"></div>
                                <div class="d-flex mt-4">
                                    <div class="col">
                                        <span class="d-block badge badge-dot badge-lg h6">
                                            <i class="bg-danger"></i>30 not sent
                                        </span>
                                        <span class="d-block badge badge-dot badge-lg h6">
                                            <i class="bg-success"></i>68 success
                                        </span>
                                    </div>
                                    <div class="col">
                                        <span class="d-block badge badge-dot badge-lg h6">
                                            <i class="bg-warning"></i>38 opened
                                        </span>
                                        <span class="d-block badge badge-dot badge-lg h6">
                                            <i class="bg-danger"></i>SMTP error
                                        </span>
                                    </div>
                                </div>
                                <a href="#" class="btn btn-block btn-secondary mt-auto">Open insights</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-4 col-sm-6">
                        <div class="card card-fluid">
                            <div class="card-body">
                                <div class="row align-items-center mb-4">
                                    <div class="col-auto">
                                        <div class="progress-circle progress-sm" id="progress-1" data-progress="90" data-color="primary"></div>
                                    </div>
                                    <div class="col">
                                        <a href="#!" class="d-block h6 mb-0">98 tasks solved</a>
                                        <a href="#" class="text-sm text-muted">Purpose Website UI</a>
                                    </div>
                                </div>
                                <div class="row align-items-center mb-4">
                                    <div class="col-auto">
                                        <div class="progress-circle progress-sm" id="progress-2" data-progress="40" data-color="warning"></div>
                                    </div>
                                    <div class="col">
                                        <a href="#!" class="d-block h6 mb-0">13 tasks solved</a>
                                        <a href="#" class="text-sm text-muted">Webpixels website</a>
                                    </div>
                                </div>
                                <div class="row align-items-center">
                                    <div class="col-auto">
                                        <div class="progress-circle progress-sm" id="progress-3" data-progress="60" data-color="info"></div>
                                    </div>
                                    <div class="col">
                                        <a href="#!" class="d-block h6 mb-0">23 tasks solved</a>
                                        <a href="#" class="text-sm text-muted">Purpose Dashboard UI</a>
                                    </div>
                                </div>
                                <a href="#" class="btn btn-sm btn-block btn-secondary mt-5">Open insights</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-sm-6">
                        <div class="card card-fluid">
                            <div class="card-body text-center d-flex flex-column justify-content-center">
                                <h5 class="mb-4">Congratulations!</h5>
                                <div class="progress-circle progress-lg mx-auto" id="progress-4" data-progress="78" data-text="23" data-textclass="h1" data-color="primary"></div>
                                <p class="mt-4 mb-0">
                                    Github issues were closed this week.
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="card card-fluid bg-gradient-dark border-0">
                            <div class="card-header border-0 pb-0">
                                <h6 class="text-white mb-0"><span class="text-danger mr-2">●</span>Project at risk</h6>
                            </div>
                            <div class="card-body text-center">
                                <!-- Avatar -->
                                <a href="#" class="avatar avatar-lg rounded-circle">
                                    <img alt="Image placeholder" src="../assets/img/theme/light/brand-avatar-1.png">
                                </a>
                                <!-- Title -->
                                <h5 class="h6 mt-4 mb-0 text-white">Website redesign</h5>
                                <!-- Actions -->
                                <div class="actions actions-dark d-flex justify-content-between px-4 mt-4">
                                    <a href="#" class="action-item">
                                        <i class="far fa-chart-pie"></i>
                                    </a>
                                    <a href="#" class="action-item">
                                        <i class="far fa-user"></i>
                                    </a>
                                    <a href="#" class="action-item">
                                        <i class="far fa-info-circle"></i>
                                    </a>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="row justify-content-between align-items-center">
                                    <div class="col-6">
                                        <div style="max-width: 120px;">
                                            <div class="spark-chart" data-toggle="spark-chart" data-type="line" data-height="50" data-color="danger" data-dataset="[42, 55, 19, 16, 84, 24, 10, 11, 93, 15, 81]"></div>
                                        </div>
                                    </div>
                                    <div class="col-auto text-center">
                                        <span class="d-block h4 mb-0 text-white">8</span>
                                        <span class="d-block text-sm text-white opacity-8">Days delay</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xl-7 d-sm-flex flex-sm-column">
                        <div class="row flex-sm-fill">
                            <div class="col-sm-4">
                                <div class="card card-fluid">
                                    <div class="card-body text-center">
                                        <div class="avatar-parent-child">
                                            <a href="#" class="avatar avatar-lg rounded-circle">
                                                <img alt="Image placeholder" src="../assets/img/theme/light/team-1-800x800.jpg">
                                            </a>
                                            <span class="avatar-child avatar-badge bg-success"></span>
                                        </div>
                                        <h5 class="h6 mt-4 mb-0">John Sullivan</h5>
                                        <a href="#" class="d-block text-sm text-muted mb-3">@john.sullivan</a>
                                        <div class="actions d-flex justify-content-between px-4">
                                            <a href="#" class="action-item">
                                                <i class="far fa-envelope"></i>
                                            </a>
                                            <a href="#" class="action-item">
                                                <i class="far fa-phone"></i>
                                            </a>
                                            <a href="#" class="action-item">
                                                <i class="far fa-share-alt"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="card card-fluid">
                                    <div class="card-body text-center">
                                        <div class="avatar-parent-child">
                                            <a href="#" class="avatar avatar-lg rounded-circle">
                                                <img alt="Image placeholder" src="../assets/img/theme/light/team-2-800x800.jpg">
                                            </a>
                                            <span class="avatar-child avatar-badge bg-warning"></span>
                                        </div>
                                        <h5 class="h6 mt-4 mb-0">Heather Wright</h5>
                                        <a href="#" class="d-block text-sm text-muted mb-3">@heather.wright</a>
                                        <div class="actions d-flex justify-content-between px-4">
                                            <a href="#" class="action-item">
                                                <i class="far fa-envelope"></i>
                                            </a>
                                            <a href="#" class="action-item">
                                                <i class="far fa-phone"></i>
                                            </a>
                                            <a href="#" class="action-item">
                                                <i class="far fa-share-alt"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="card card-fluid">
                                    <div class="card-body text-center">
                                        <div class="avatar-parent-child">
                                            <a href="#" class="avatar avatar-lg rounded-circle">
                                                <img alt="Image placeholder" src="../assets/img/theme/light/team-3-800x800.jpg">
                                            </a>
                                            <span class="avatar-child avatar-badge bg-danger"></span>
                                        </div>
                                        <h5 class="h6 mt-4 mb-0">James Lewis</h5>
                                        <a href="#" class="d-block text-sm text-muted mb-3">@james.lewis</a>
                                        <div class="actions d-flex justify-content-between px-4">
                                            <a href="#" class="action-item">
                                                <i class="far fa-envelope"></i>
                                            </a>
                                            <a href="#" class="action-item">
                                                <i class="far fa-phone"></i>
                                            </a>
                                            <a href="#" class="action-item">
                                                <i class="far fa-share-alt"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row flex-sm-fill">
                            <div class="col-sm-4">
                                <div class="card card-fluid">
                                    <div class="card-body text-center">
                                        <div class="avatar-parent-child">
                                            <a href="#" class="avatar avatar-lg rounded-circle">
                                                <img alt="Image placeholder" src="../assets/img/theme/light/team-1-800x800.jpg">
                                            </a>
                                            <span class="avatar-child avatar-badge bg-success"></span>
                                        </div>
                                        <h5 class="h6 mt-4 mb-0">John Snow</h5>
                                        <a href="#" class="d-block text-sm text-muted mb-3">@john.snow</a>
                                        <div class="actions d-flex justify-content-between px-4">
                                            <a href="#" class="action-item">
                                                <i class="far fa-envelope"></i>
                                            </a>
                                            <a href="#" class="action-item">
                                                <i class="far fa-phone"></i>
                                            </a>
                                            <a href="#" class="action-item">
                                                <i class="far fa-share-alt"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="card card-fluid">
                                    <div class="card-body text-center">
                                        <div class="avatar-parent-child">
                                            <a href="#" class="avatar avatar-lg rounded-circle">
                                                <img alt="Image placeholder" src="../assets/img/theme/light/team-2-800x800.jpg">
                                            </a>
                                            <span class="avatar-child avatar-badge bg-success"></span>
                                        </div>
                                        <h5 class="h6 mt-4 mb-0">John Michael</h5>
                                        <a href="#" class="d-block text-sm text-muted mb-3">@john.michael</a>
                                        <div class="actions d-flex justify-content-between px-4">
                                            <a href="#" class="action-item">
                                                <i class="far fa-envelope"></i>
                                            </a>
                                            <a href="#" class="action-item">
                                                <i class="far fa-phone"></i>
                                            </a>
                                            <a href="#" class="action-item">
                                                <i class="far fa-share-alt"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="card card-fluid">
                                    <div class="card-body text-center">
                                        <div class="avatar-parent-child">
                                            <a href="#" class="avatar avatar-lg rounded-circle">
                                                <img alt="Image placeholder" src="../assets/img/theme/light/team-3-800x800.jpg">
                                            </a>
                                            <span class="avatar-child avatar-badge bg-warning"></span>
                                        </div>
                                        <h5 class="h6 mt-4 mb-0">Monroe Parker</h5>
                                        <a href="#" class="d-block text-sm text-muted mb-3">@monroe.parker</a>
                                        <div class="actions d-flex justify-content-between px-4">
                                            <a href="#" class="action-item">
                                                <i class="far fa-envelope"></i>
                                            </a>
                                            <a href="#" class="action-item">
                                                <i class="far fa-phone"></i>
                                            </a>
                                            <a href="#" class="action-item">
                                                <i class="far fa-share-alt"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-5">
                        <!-- Calendar -->
                        <div class="card widget-calendar">
                            <div class="card-header">
                                <div class="text-sm text-muted mb-1 widget-calendar-year"></div>
                                <div class="h5 mb-0 widget-calendar-day"></div>
                            </div>
                            <!-- Calendar -->
                            <div data-toggle="widget-calendar"></div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Footer -->
            <?php require_once('../partials/dashboard_footer.php'); ?>
        </div>
    </div>
    <!-- Scripts -->
    <?php require_once('../partials/dashboard_scripts.php'); ?>

</body>



</html>