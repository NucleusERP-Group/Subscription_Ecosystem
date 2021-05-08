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
        <div class="sidenav" id="sidenav-main">
            <!-- Sidenav header -->
            <div class="sidenav-header d-flex align-items-center">
                <a class="navbar-brand" href="../index-2.html">
                    <img src="../assets/img/brand/white.png" class="navbar-brand-img" alt="...">
                </a>
                <div class="ml-auto">
                    <!-- Sidenav toggler -->
                    <div class="sidenav-toggler sidenav-toggler-dark d-md-none" data-action="sidenav-unpin" data-target="#sidenav-main">
                        <div class="sidenav-toggler-inner">
                            <i class="sidenav-toggler-line bg-white"></i>
                            <i class="sidenav-toggler-line bg-white"></i>
                            <i class="sidenav-toggler-line bg-white"></i>
                        </div>
                    </div>
                </div>
            </div>
            <!-- User mini profile -->
            <div class="sidenav-user d-flex flex-column align-items-center justify-content-between text-center">
                <!-- Avatar -->
                <div>
                    <a href="#" class="avatar rounded-circle avatar-xl">
                        <img alt="Image placeholder" src="../assets/img/theme/light/team-1-800x800.jpg" class="">
                    </a>
                    <div class="mt-4">
                        <h5 class="mb-0 text-white">Heather Parker</h5>
                        <span class="d-block text-sm text-white opacity-8 mb-3">Web Architect</span>
                        <a href="#" class="btn btn-sm btn-white btn-icon rounded-pill shadow hover-translate-y-n3">
                            <span class="btn-inner--icon"><i class="far fa-coins"></i></span>
                            <span class="btn-inner--text">$2.300</span>
                        </a>
                    </div>
                </div>
                <!-- User info -->
                <!-- Actions -->
                <div class="w-100 mt-4 actions d-flex justify-content-between">
                    <a href="user/profile.html" class="action-item action-item-lg text-white pl-0">
                        <i class="far fa-user"></i>
                    </a>
                    <a href="#modal-chat" class="action-item action-item-lg text-white" data-toggle="modal">
                        <i class="far fa-comment-alt"></i>
                    </a>
                    <a href="shop/invoices.html" class="action-item action-item-lg text-white pr-0">
                        <i class="far fa-receipt"></i>
                    </a>
                </div>
            </div>
            <!-- Application nav -->
            <div class="nav-application clearfix">
                <a href="home.html" class="btn btn-square text-sm active">
                    <span class="btn-inner--icon d-block"><i class="far fa-home fa-2x"></i></span>
                    <span class="btn-inner--icon d-block pt-2">Home</span>
                </a>
                <a href="project/card-listing.html" class="btn btn-square text-sm">
                    <span class="btn-inner--icon d-block"><i class="far fa-project-diagram fa-2x"></i></span>
                    <span class="btn-inner--icon d-block pt-2">Projects</span>
                </a>
                <a href="task/table-listing.html" class="btn btn-square text-sm">
                    <span class="btn-inner--icon d-block"><i class="far fa-tasks fa-2x"></i></span>
                    <span class="btn-inner--icon d-block pt-2">Tasks</span>
                </a>
                <a href="task/kanban-board.html" class="btn btn-square text-sm">
                    <span class="btn-inner--icon d-block"><i class="far fa-columns fa-2x"></i></span>
                    <span class="btn-inner--icon d-block pt-2">Kanban</span>
                </a>
                <a href="user/card-listing.html" class="btn btn-square text-sm">
                    <span class="btn-inner--icon d-block"><i class="far fa-users-cog fa-2x"></i></span>
                    <span class="btn-inner--icon d-block pt-2">Users</span>
                </a>
                <a href="user/profile.html" class="btn btn-square text-sm">
                    <span class="btn-inner--icon d-block"><i class="far fa-user-ninja fa-2x"></i></span>
                    <span class="btn-inner--icon d-block pt-2">Profile</span>
                </a>
                <a href="shop/invoices.html" class="btn btn-square text-sm">
                    <span class="btn-inner--icon d-block"><i class="far fa-receipt fa-2x"></i></span>
                    <span class="btn-inner--icon d-block pt-2">Invoices</span>
                </a>
                <a href="widgets.html" class="btn btn-square text-sm">
                    <span class="btn-inner--icon d-block"><i class="far fa-cogs fa-2x"></i></span>
                    <span class="btn-inner--icon d-block pt-2">Widgets</span>
                </a>
            </div>
            <!-- Misc area -->
            <div class="card bg-gradient-warning">
                <div class="card-body">
                    <h5 class="text-white">Hello, Friend!</h5>
                    <p class="text-white mb-4">
                        Why not start using Purpose Application UI Kit and create something amazing today?
                    </p>
                    <a href="https://themes.getbootstrap.com/product/purpose-application-ui-kit/" class="btn btn-sm btn-block btn-white rounded-pill" target="_blank">Get started</a>
                </div>
            </div>
        </div>
        <!-- Content -->
        <div class="main-content position-relative">
            <!-- Main nav -->
            <nav class="navbar navbar-main navbar-expand-lg navbar-dark bg-primary navbar-border" id="navbar-main">
                <div class="container-fluid">
                    <!-- Brand + Toggler (for mobile devices) -->
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar-main-collapse" aria-controls="navbar-main-collapse" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <!-- User's navbar -->
                    <div class="navbar-user d-lg-none ml-auto">
                        <ul class="navbar-nav flex-row align-items-center">
                            <li class="nav-item">
                                <a href="#" class="nav-link nav-link-icon sidenav-toggler" data-action="sidenav-pin" data-target="#sidenav-main"><i class="far fa-bars"></i></a>
                            </li>
                            <li class="nav-item">
                                <a href="#" class="nav-link nav-link-icon" data-action="omnisearch-open" data-target="#omnisearch"><i class="far fa-search"></i></a>
                            </li>
                            <li class="nav-item dropdown dropdown-animate">
                                <a class="nav-link nav-link-icon" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="far fa-bell"></i></a>
                                <div class="dropdown-menu dropdown-menu-right dropdown-menu-lg dropdown-menu-arrow p-0">
                                    <div class="py-3 px-3">
                                        <h5 class="heading h6 mb-0">Notifications</h5>
                                    </div>
                                    <div class="list-group list-group-flush">
                                        <a href="#" class="list-group-item list-group-item-action">
                                            <div class="d-flex align-items-center" data-toggle="tooltip" data-placement="right" data-title="2 hrs ago">
                                                <div>
                                                    <span class="avatar bg-primary text-white rounded-circle">AM</span>
                                                </div>
                                                <div class="flex-fill ml-3">
                                                    <div class="h6 text-sm mb-0">Alex Michael <small class="float-right text-muted">2 hrs ago</small></div>
                                                    <p class="text-sm lh-140 mb-0">
                                                        Some quick example text to build on the card title.
                                                    </p>
                                                </div>
                                            </div>
                                        </a>
                                        <a href="#" class="list-group-item list-group-item-action">
                                            <div class="d-flex align-items-center" data-toggle="tooltip" data-placement="right" data-title="3 hrs ago">
                                                <div>
                                                    <span class="avatar bg-warning text-white rounded-circle">SW</span>
                                                </div>
                                                <div class="flex-fill ml-3">
                                                    <div class="h6 text-sm mb-0">Sandra Wayne <small class="float-right text-muted">3 hrs ago</small></div>
                                                    <p class="text-sm lh-140 mb-0">
                                                        Some quick example text to build on the card title.
                                                    </p>
                                                </div>
                                            </div>
                                        </a>
                                        <a href="#" class="list-group-item list-group-item-action">
                                            <div class="d-flex align-items-center" data-toggle="tooltip" data-placement="right" data-title="5 hrs ago">
                                                <div>
                                                    <span class="avatar bg-info text-white rounded-circle">JM</span>
                                                </div>
                                                <div class="flex-fill ml-3">
                                                    <div class="h6 text-sm mb-0">Jason Miller <small class="float-right text-muted">5 hrs ago</small></div>
                                                    <p class="text-sm lh-140 mb-0">
                                                        Some quick example text to build on the card title.
                                                    </p>
                                                </div>
                                            </div>
                                        </a>
                                        <a href="#" class="list-group-item list-group-item-action">
                                            <div class="d-flex align-items-center" data-toggle="tooltip" data-placement="right" data-title="2 hrs ago">
                                                <div>
                                                    <span class="avatar bg-dark text-white rounded-circle">MJ</span>
                                                </div>
                                                <div class="flex-fill ml-3">
                                                    <div class="h6 text-sm mb-0">Mike Thomson <small class="float-right text-muted">2 hrs ago</small></div>
                                                    <p class="text-sm lh-140 mb-0">
                                                        Some quick example text to build on the card title.
                                                    </p>
                                                </div>
                                            </div>
                                        </a>
                                        <a href="#" class="list-group-item list-group-item-action">
                                            <div class="d-flex align-items-center" data-toggle="tooltip" data-placement="right" data-title="3 hrs ago">
                                                <div>
                                                    <span class="avatar bg-primary text-white rounded-circle">RN</span>
                                                </div>
                                                <div class="flex-fill ml-3">
                                                    <div class="h6 text-sm mb-0">Richard Nixon <small class="float-right text-muted">3 hrs ago</small></div>
                                                    <p class="text-sm lh-140 mb-0">
                                                        Some quick example text to build on the card title.
                                                    </p>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                    <div class="py-3 text-center">
                                        <a href="#" class="link link-sm link--style-3">View all notifications</a>
                                    </div>
                                </div>
                            </li>
                            <li class="nav-item dropdown dropdown-animate">
                                <a class="nav-link pr-lg-0" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <span class="avatar avatar-sm rounded-circle">
                                        <img alt="Image placeholder" src="../assets/img/theme/light/team-4-800x800.jpg">
                                    </span>
                                </a>
                                <div class="dropdown-menu dropdown-menu-sm dropdown-menu-right dropdown-menu-arrow">
                                    <h6 class="dropdown-header px-0">Hi, Heather!</h6>
                                    <a href="user/profile.html" class="dropdown-item">
                                        <i class="far fa-user"></i>
                                        <span>My profile</span>
                                    </a>
                                    <a href="account/settings.html" class="dropdown-item">
                                        <i class="far fa-cog"></i>
                                        <span>Settings</span>
                                    </a>
                                    <a href="account/billing.html" class="dropdown-item">
                                        <i class="far fa-credit-card"></i>
                                        <span>Billing</span>
                                    </a>
                                    <a href="shop/orders.html" class="dropdown-item">
                                        <i class="far fa-shopping-basket"></i>
                                        <span>Orders</span>
                                    </a>
                                    <div class="dropdown-divider"></div>
                                    <a href="authentication/login.html" class="dropdown-item">
                                        <i class="far fa-sign-out-alt"></i>
                                        <span>Logout</span>
                                    </a>
                                </div>
                            </li>
                        </ul>
                    </div>
                    <!-- Navbar nav -->
                    <div class="collapse navbar-collapse navbar-collapse-fade" id="navbar-main-collapse">
                        <ul class="navbar-nav align-items-lg-center">
                            <!-- Overview  -->
                            <li class="nav-item d-lg-none ">
                                <a class="nav-link" href="../index-2.html">
                                    Overview
                                </a>
                            </li>
                            <li class="border-top opacity-2 my-2"></li>
                            <!-- Home  -->
                            <li class="nav-item ">
                                <a class="nav-link pl-lg-0" href="home.html">
                                    Home
                                </a>
                            </li>
                            <!-- Application menu -->
                            <li class="nav-item dropdown dropdown-animate" data-toggle="hover">
                                <a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Application
                                </a>
                                <div class="dropdown-menu dropdown-menu-arrow p-lg-0">
                                    <!-- Top dropdown menu -->
                                    <div class="p-lg-4">
                                        <div class="dropdown dropdown-animate dropdown-submenu" data-toggle="hover">
                                            <a href="#" class="dropdown-item dropdown-toggle" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                Project
                                            </a>
                                            <div class="dropdown-menu"><a class="dropdown-item" href="project/card-listing.html">
                                                    Card listing
                                                </a>
                                                <a class="dropdown-item" href="project/table-listing.html">
                                                    Table listing
                                                </a>
                                                <a class="dropdown-item" href="project/overview.html">
                                                    Overview
                                                </a>
                                                <a class="dropdown-item" href="project/create-new.html">
                                                    Create new
                                                </a>
                                            </div>
                                        </div>
                                        <div class="dropdown dropdown-animate dropdown-submenu" data-toggle="hover">
                                            <a href="#" class="dropdown-item dropdown-toggle" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                Task
                                            </a>
                                            <div class="dropdown-menu"><a class="dropdown-item" href="task/table-listing.html">
                                                    Table listing
                                                </a>
                                                <a class="dropdown-item" href="task/kanban-board.html">
                                                    Kanban board
                                                </a>
                                                <a class="dropdown-item" href="task/create-new.html">
                                                    Create new
                                                </a>
                                            </div>
                                        </div>
                                        <div class="dropdown dropdown-animate dropdown-submenu" data-toggle="hover">
                                            <a href="#" class="dropdown-item dropdown-toggle" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                User
                                            </a>
                                            <div class="dropdown-menu"><a class="dropdown-item" href="user/card-listing.html">
                                                    Card listing
                                                </a>
                                                <a class="dropdown-item" href="user/table-listing.html">
                                                    Table listing
                                                </a>
                                                <a class="dropdown-item" href="user/profile.html">
                                                    Profile
                                                </a>
                                            </div>
                                        </div>
                                        <div class="dropdown dropdown-animate dropdown-submenu" data-toggle="hover">
                                            <a href="#" class="dropdown-item dropdown-toggle" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                Authentication
                                            </a>
                                            <div class="dropdown-menu"><a class="dropdown-item" href="authentication/login.html">
                                                    Login
                                                </a>
                                                <a class="dropdown-item" href="authentication/register.html">
                                                    Register
                                                </a>
                                                <a class="dropdown-item" href="authentication/recover.html">
                                                    Recover
                                                </a>
                                            </div>
                                        </div>
                                        <div class="dropdown dropdown-animate dropdown-submenu" data-toggle="hover">
                                            <a href="#" class="dropdown-item dropdown-toggle" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                Account
                                            </a>
                                            <div class="dropdown-menu"><a class="dropdown-item" href="account/profile.html">
                                                    Profile
                                                </a>
                                                <a class="dropdown-item" href="account/settings.html">
                                                    Settings
                                                </a>
                                                <a class="dropdown-item" href="account/billing.html">
                                                    Billing
                                                </a>
                                                <a class="dropdown-item" href="account/notifications.html">
                                                    Notifications
                                                </a>
                                                <a class="dropdown-item" href="account/addresses.html">
                                                    Addresses
                                                </a>
                                            </div>
                                        </div>
                                        <div class="dropdown dropdown-animate dropdown-submenu" data-toggle="hover">
                                            <a href="#" class="dropdown-item dropdown-toggle" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                Shop
                                            </a>
                                            <div class="dropdown-menu"><a class="dropdown-item" href="shop/card-listing.html">
                                                    Card listing
                                                </a>
                                                <a class="dropdown-item" href="shop/table-listing.html">
                                                    Table listing
                                                </a>
                                                <a class="dropdown-item" href="shop/product.html">
                                                    Product
                                                </a>
                                                <a class="dropdown-item" href="shop/orders.html">
                                                    Orders
                                                </a>
                                                <a class="dropdown-item" href="shop/order-description.html">
                                                    Order description
                                                </a>
                                                <a class="dropdown-item" href="shop/cart.html">
                                                    Cart
                                                </a>
                                                <a class="dropdown-item" href="shop/sellers.html">
                                                    Sellers
                                                </a>
                                                <a class="dropdown-item" href="shop/invoices.html">
                                                    Invoices
                                                </a>
                                                <a class="dropdown-item" href="shop/invoice-description.html">
                                                    Invoice description
                                                </a>
                                            </div>
                                        </div>
                                        <div class="dropdown dropdown-animate dropdown-submenu" data-toggle="hover">
                                            <a href="#" class="dropdown-item dropdown-toggle" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                Utility
                                            </a>
                                            <div class="dropdown-menu"><a class="dropdown-item" href="utility/error-404.html">
                                                    Error 404
                                                </a>
                                                <a class="dropdown-item" href="utility/error-500.html">
                                                    Error 500
                                                </a>
                                                <a class="dropdown-item" href="utility/maintenance-mode.html">
                                                    Maintenance mode
                                                </a>
                                                <a class="dropdown-item" href="utility/faq.html">
                                                    Faq
                                                </a>
                                                <a class="dropdown-item" href="utility/topic.html">
                                                    Topic
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Bottom dropdown menu -->
                                    <div class="dropdown-menu-links rounded-bottom delimiter-top p-lg-4">
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <a href="calendar.html" class="dropdown-item">Calendar</a>
                                                <a href="timeline.html" class="dropdown-item">Timeline</a>
                                            </div>
                                            <div class="col-sm-6">
                                                <a href="task/kanban-board.html" class="dropdown-item">Kanban board</a>
                                                <a href="google-map.html" class="dropdown-item">Google map</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="widgets.html">
                                    Widgets
                                </a>
                            </li>
                            <li class="nav-item dropdown dropdown-animate" data-toggle="hover">
                                <a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Docs</a>
                                <div class="dropdown-menu dropdown-menu-right dropdown-menu-lg dropdown-menu-arrow p-0">
                                    <ul class="list-group list-group-flush">
                                        <li>
                                            <a href="../docs/index.html" class="list-group-item list-group-item-action" role="button">
                                                <div class="media d-flex align-items-center">
                                                    <!-- SVG icon -->
                                                    <figure style="width: 50px;">
                                                        <img alt="Image placeholder" src="../assets/img/icons/essential/detailed/DOC_File.svg" class="svg-inject img-fluid" style="height: 50px;">
                                                    </figure>
                                                    <!-- Media body -->
                                                    <div class="media-body ml-3">
                                                        <h6 class="mb-1">Documentation</h6>
                                                        <p class="mb-0">Awesome section examples for any scenario.</p>
                                                    </div>
                                                </div>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="../docs/components/index.html" class="list-group-item list-group-item-action" role="button">
                                                <div class="media d-flex align-items-center">
                                                    <!-- SVG icon -->
                                                    <figure style="width: 50px;">
                                                        <img alt="Image placeholder" src="../assets/img/icons/essential/detailed/Mobile_UI.svg" class="svg-inject img-fluid" style="height: 50px;">
                                                    </figure>
                                                    <!-- Media body -->
                                                    <div class="media-body ml-3">
                                                        <h6 class="mb-1">Components</h6>
                                                        <p class="mb-0">Awesome section examples for any scenario.</p>
                                                    </div>
                                                </div>
                                            </a>
                                        </li>
                                    </ul>
                                    <div class="dropdown-menu-links rounded-bottom delimiter-top p-4">
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <a href="../docs/getting-started/installation.html" class="dropdown-item">Installation</a>
                                                <a href="../docs/getting-started/file-structure.html" class="dropdown-item">File structure</a>
                                                <a href="../docs/getting-started/build-tools.html" class="dropdown-item">Build tools</a>
                                                <a href="../docs/getting-started/customization.html" class="dropdown-item">Customization</a>
                                            </div>
                                            <div class="col-sm-6">
                                                <a href="../docs/getting-started/plugins.html" class="dropdown-item">Using plugins</a>
                                                <a href="../docs/components/index.html" class="dropdown-item">Components</a>
                                                <a href="../docs/plugins/animate.html" class="dropdown-item">Plugins</a>
                                                <a href="../docs/support.html" class="dropdown-item">Support</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li class="border-top opacity-2 my-2"></li>
                            <!-- Docs menu -->
                            <li class="nav-item d-lg-none">
                                <a class="nav-link" href="../docs/index.html">
                                    Docs
                                </a>
                            </li>
                            <li class="nav-item d-lg-none">
                                <a class="nav-link" href="authentication/register.html">
                                    Register
                                </a>
                            </li>
                            <li class="nav-item d-lg-none">
                                <a class="nav-link" href="authentication/login.html">
                                    Sign in
                                </a>
                            </li>
                        </ul><!-- Right menu -->
                        <ul class="navbar-nav ml-lg-auto align-items-center d-none d-lg-flex">
                            <li class="nav-item">
                                <a href="#" class="nav-link nav-link-icon sidenav-toggler" data-action="sidenav-pin" data-target="#sidenav-main"><i class="far fa-bars"></i></a>
                            </li>
                            <li class="nav-item">
                                <a href="#" class="nav-link nav-link-icon" data-action="omnisearch-open" data-target="#omnisearch"><i class="far fa-search"></i></a>
                            </li>
                            <li class="nav-item">
                                <a href="#modal-chat" class="nav-link nav-link-icon" data-toggle="modal"><i class="far fa-comment-alt"></i></a>
                            </li>
                            <li class="nav-item dropdown dropdown-animate">
                                <a class="nav-link nav-link-icon" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="far fa-bell"></i></a>
                                <div class="dropdown-menu dropdown-menu-right dropdown-menu-lg dropdown-menu-arrow p-0">
                                    <div class="py-3 px-3">
                                        <h5 class="heading h6 mb-0">Notifications</h5>
                                    </div>
                                    <div class="list-group list-group-flush">
                                        <a href="#" class="list-group-item list-group-item-action">
                                            <div class="d-flex align-items-center" data-toggle="tooltip" data-placement="right" data-title="2 hrs ago">
                                                <div>
                                                    <span class="avatar bg-primary text-white rounded-circle">AM</span>
                                                </div>
                                                <div class="flex-fill ml-3">
                                                    <div class="h6 text-sm mb-0">Alex Michael <small class="float-right text-muted">2 hrs ago</small></div>
                                                    <p class="text-sm lh-140 mb-0">
                                                        Some quick example text to build on the card title.
                                                    </p>
                                                </div>
                                            </div>
                                        </a>
                                        <a href="#" class="list-group-item list-group-item-action">
                                            <div class="d-flex align-items-center" data-toggle="tooltip" data-placement="right" data-title="3 hrs ago">
                                                <div>
                                                    <span class="avatar bg-warning text-white rounded-circle">SW</span>
                                                </div>
                                                <div class="flex-fill ml-3">
                                                    <div class="h6 text-sm mb-0">Sandra Wayne <small class="float-right text-muted">3 hrs ago</small></div>
                                                    <p class="text-sm lh-140 mb-0">
                                                        Some quick example text to build on the card title.
                                                    </p>
                                                </div>
                                            </div>
                                        </a>
                                        <a href="#" class="list-group-item list-group-item-action">
                                            <div class="d-flex align-items-center" data-toggle="tooltip" data-placement="right" data-title="5 hrs ago">
                                                <div>
                                                    <span class="avatar bg-info text-white rounded-circle">JM</span>
                                                </div>
                                                <div class="flex-fill ml-3">
                                                    <div class="h6 text-sm mb-0">Jason Miller <small class="float-right text-muted">5 hrs ago</small></div>
                                                    <p class="text-sm lh-140 mb-0">
                                                        Some quick example text to build on the card title.
                                                    </p>
                                                </div>
                                            </div>
                                        </a>
                                        <a href="#" class="list-group-item list-group-item-action">
                                            <div class="d-flex align-items-center" data-toggle="tooltip" data-placement="right" data-title="2 hrs ago">
                                                <div>
                                                    <span class="avatar bg-dark text-white rounded-circle">MJ</span>
                                                </div>
                                                <div class="flex-fill ml-3">
                                                    <div class="h6 text-sm mb-0">Mike Thomson <small class="float-right text-muted">2 hrs ago</small></div>
                                                    <p class="text-sm lh-140 mb-0">
                                                        Some quick example text to build on the card title.
                                                    </p>
                                                </div>
                                            </div>
                                        </a>
                                        <a href="#" class="list-group-item list-group-item-action">
                                            <div class="d-flex align-items-center" data-toggle="tooltip" data-placement="right" data-title="3 hrs ago">
                                                <div>
                                                    <span class="avatar bg-primary text-white rounded-circle">RN</span>
                                                </div>
                                                <div class="flex-fill ml-3">
                                                    <div class="h6 text-sm mb-0">Richard Nixon <small class="float-right text-muted">3 hrs ago</small></div>
                                                    <p class="text-sm lh-140 mb-0">
                                                        Some quick example text to build on the card title.
                                                    </p>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                    <div class="py-3 text-center">
                                        <a href="#" class="link link-sm link--style-3">View all notifications</a>
                                    </div>
                                </div>
                            </li>
                            <li class="nav-item dropdown dropdown-animate">
                                <a class="nav-link pr-lg-0" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <div class="media media-pill align-items-center">
                                        <span class="avatar rounded-circle">
                                            <img alt="Image placeholder" src="../assets/img/theme/light/team-4-800x800.jpg">
                                        </span>
                                        <div class="ml-2 d-none d-lg-block">
                                            <span class="mb-0 text-sm  font-weight-bold">John Snow</span>
                                        </div>
                                    </div>
                                </a>
                                <div class="dropdown-menu dropdown-menu-sm dropdown-menu-right dropdown-menu-arrow">
                                    <h6 class="dropdown-header px-0">Hi, John!</h6>
                                    <a href="#!" class="dropdown-item">
                                        <i class="far fa-user"></i>
                                        <span>My profile</span>
                                    </a>
                                    <a href="#!" class="dropdown-item">
                                        <i class="far fa-cog"></i>
                                        <span>Settings</span>
                                    </a>
                                    <a href="#!" class="dropdown-item">
                                        <i class="far fa-credit-card"></i>
                                        <span>Billing</span>
                                    </a>
                                    <a href="#!" class="dropdown-item">
                                        <i class="far fa-tasks"></i>
                                        <span>Activity</span>
                                    </a>
                                    <div class="dropdown-divider"></div>
                                    <a href="#!" class="dropdown-item">
                                        <i class="far fa-sign-out-alt"></i>
                                        <span>Logout</span>
                                    </a>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
            <!-- Omnisearch -->
            <div id="omnisearch" class="omnisearch">
                <div class="container">
                    <!-- Search form -->
                    <form class="omnisearch-form">
                        <div class="form-group">
                            <div class="input-group input-group-merge input-group-flush">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="far fa-search"></i></span>
                                </div>
                                <input type="text" class="form-control" placeholder="Type and hit enter ...">
                            </div>
                        </div>
                    </form>
                    <div class="omnisearch-suggestions">
                        <h6 class="heading">Search Suggestions</h6>
                        <div class="row">
                            <div class="col-sm-6">
                                <ul class="list-unstyled mb-0">
                                    <li>
                                        <a class="list-link" href="#">
                                            <i class="far fa-search"></i>
                                            <span>macbook pro</span> in Laptops
                                        </a>
                                    </li>
                                    <li>
                                        <a class="list-link" href="#">
                                            <i class="far fa-search"></i>
                                            <span>iphone 8</span> in Smartphones
                                        </a>
                                    </li>
                                    <li>
                                        <a class="list-link" href="#">
                                            <i class="far fa-search"></i>
                                            <span>macbook pro</span> in Laptops
                                        </a>
                                    </li>
                                    <li>
                                        <a class="list-link" href="#">
                                            <i class="far fa-search"></i>
                                            <span>beats pro solo 3</span> in Headphones
                                        </a>
                                    </li>
                                    <li>
                                        <a class="list-link" href="#">
                                            <i class="far fa-search"></i>
                                            <span>smasung galaxy 10</span> in Phones
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Page content -->
            <div class="page-content">
                <!-- Page title -->
                <div class="page-title">
                    <div class="row justify-content-between align-items-center">
                        <div class="col-md-6 mb-3 mb-md-0">
                            <h5 class="h3 font-weight-400 mb-0 text-white">Moning, Heather!</h5>
                            <span class="text-sm text-white opacity-8">Have a nice day!</span>
                        </div>
                    </div>
                </div>
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