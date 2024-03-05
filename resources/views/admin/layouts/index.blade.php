<!DOCTYPE html>
<html lang="en">
<!-- Mirrored from codervent.com/rocker/demo/vertical/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 01 Feb 2024 09:31:57 GMT -->

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <!--favicon-->
    <link rel="icon" href="{{ asset('admin/assets/images/favicon-32x32.png') }}" type="image/png" />
    <!--plugins-->
    <link href="{{ asset('admin/assets/plugins/vectormap/jquery-jvectormap-2.0.2.css') }}" rel="stylesheet" />
    <link href="{{ asset('admin/assets/plugins/simplebar/css/simplebar.css') }}" rel="stylesheet" />
    <link href="{{ asset('admin/assets/plugins/perfect-scrollbar/css/perfect-scrollbar.css') }}" rel="stylesheet" />
    <link href="{{ asset('admin/assets/plugins/metismenu/css/metisMenu.min.css') }}" rel="stylesheet" />
    <!-- loader-->
    <link href="{{ asset('admin/assets/css/pace.min.css') }}" rel="stylesheet" />
    <script src="{{ asset('admin/assets/js/pace.min.js') }}"></script>
    <!-- Bootstrap CSS -->
    <link href="{{ asset('admin/assets/css/bootstrap.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('admin/assets/css/bootstrap-extended.css') }}" rel="stylesheet" />
    <link href="{{ asset('admin/assets/css/app.css') }}" rel="stylesheet" />
    <link href="{{ asset('admin/assets/css/icons.css') }}" rel="stylesheet" />
    <!-- Theme Style CSS -->
    <link rel="stylesheet" href="{{ asset('admin/assets/css/dark-theme.css') }}" />
    <link rel="stylesheet" href="{{ asset('admin/assets/css/semi-dark.css') }}" />
    <link rel="stylesheet" href="{{ asset('admin/assets/css/header-colors.css') }}" />
    {{-- <title>Karmic Admin Dashboard Panel</title> --}}
    <title>{{ config('app.name', 'Laravel') }}</title>
</head>

<body>
    <!--wrapper-->
    <div class="wrapper">
        <!--sidebar wrapper -->
        <div class="sidebar-wrapper" data-simplebar="true">
            <div class="sidebar-header">
                <div>
                    {{-- <img src="{{ asset('admin/assets/images/logo-icon.png') }}" class="logo-icon" alt="logo icon" /> --}}

                    <div class="fs-4">
                        <i class="bx bx-shopping-bag"></i>
                    </div>
                </div>
                <div>
                    <h4 class="logo-text">EM</h4>
                </div>
                <div class="toggle-icon ms-auto">
                    <i class="bx bx-menu"></i>
                </div>
            </div>
            <!--navigation-->
            <ul class="metismenu" id="menu">
                <li>
                    <a href="{{ route('dashboard') }}">
                        <div class="parent-icon"><i class="bx bx-home-alt"></i></div>
                        <div class="menu-title">Dashboard</div>
                    </a>
                </li>

                {{-- test starts --}}
                @hasrole('Admin')
                    <li>
                        <a href="javascript:;" class="has-arrow">
                            <div class="parent-icon"><i class="bx bx-user-circle"></i></div>
                            <div class="menu-title">User Management</div>
                        </a>
                        <ul>
                            <li>
                                <a href="#"><i class="bx bx-radio-circle"></i>Admin Lists</a>
                            </li>
                            <li>
                                <a href="#"><i class="bx bx-radio-circle"></i>Customer Lists</a>
                            </li>
                            <li>
                                <a href="{{ route('assign_role.index') }}"><i class="bx bx-radio-circle"></i>Permission</a>
                            </li>
                            <li>
                                <a href="{{ route('role.index') }}"><i class="bx bx-radio-circle"></i>Roles</a>
                            </li>
                            <li>
                                <a href="{{ route('user.index') }}"><i class="bx bx-radio-circle"></i>User List</a>
                            </li>
                        </ul>
                    </li>
                @endhasrole
                {{-- test starts --}}
            </ul>
            <!--end navigation-->
        </div>
        <!--end sidebar wrapper -->
        <!--start header -->
        <header>
            <div class="topbar d-flex align-items-center">
                <nav class="navbar navbar-expand gap-3">
                    <div class="mobile-toggle-menu"><i class="bx bx-menu"></i></div>
                    <div class="top-menu ms-auto">
                        <ul class="navbar-nav align-items-center gap-1">
                            <li class="nav-item mobile-search-icon d-flex d-lg-none" data-bs-toggle="modal"
                                data-bs-target="#SearchModal">
                                <a class="nav-link" href="avascript:;"><i class="bx bx-search"></i>
                                </a>
                            </li>

                            <li class="nav-item dark-mode d-none d-sm-flex">
                                <a class="nav-link dark-mode-icon" href="javascript:;"><i class="bx bx-moon"></i>
                                </a>
                            </li>

                            <li class="nav-item dropdown dropdown-large">
                                <a class="nav-link dropdown-toggle dropdown-toggle-nocaret position-relative"
                                    href="#" data-bs-toggle="dropdown"><span class="alert-count">7</span>
                                    <i class="bx bx-bell"></i>
                                </a>
                                <div class="dropdown-menu dropdown-menu-end">
                                    <div class="app-container p-2 my-2">
                                        <a href="javascript:;">
                                            <div class="msg-header">
                                                <p class="msg-header-title">Notifications</p>
                                                <p class="msg-header-badge">8 New</p>
                                            </div>
                                        </a>
                                        <div class="header-notifications-list">
                                            <a class="dropdown-item" href="javascript:;">
                                                <div class="d-flex align-items-center">
                                                    <div class="user-online">
                                                        <img src="{{ asset('admin/assets/images/avatars/avatar-1.png') }}"
                                                            class="msg-avatar" alt="user avatar" />
                                                    </div>
                                                    <div class="flex-grow-1">
                                                        <h6 class="msg-name">
                                                            Daisy Anderson<span class="msg-time float-end">5 sec
                                                                ago</span>
                                                        </h6>
                                                        <p class="msg-info">
                                                            The standard chunk of lorem
                                                        </p>
                                                    </div>
                                                </div>
                                            </a>
                                            <a class="dropdown-item" href="javascript:;">
                                                <div class="d-flex align-items-center">
                                                    <div class="notify bg-light-danger text-danger">
                                                        dc
                                                    </div>
                                                    <div class="flex-grow-1">
                                                        <h6 class="msg-name">
                                                            New Orders
                                                            <span class="msg-time float-end">2 min ago</span>
                                                        </h6>
                                                        <p class="msg-info">
                                                            You have recived new orders
                                                        </p>
                                                    </div>
                                                </div>
                                            </a>
                                            <a class="dropdown-item" href="javascript:;">
                                                <div class="d-flex align-items-center">
                                                    <div class="user-online">
                                                        <img src="{{ asset('admin/assets/images/avatars/avatar-2.png') }}"
                                                            class="msg-avatar" alt="user avatar" />
                                                    </div>
                                                    <div class="flex-grow-1">
                                                        <h6 class="msg-name">
                                                            Althea Cabardo
                                                            <span class="msg-time float-end">14 sec ago</span>
                                                        </h6>
                                                        <p class="msg-info">
                                                            Many desktop publishing packages
                                                        </p>
                                                    </div>
                                                </div>
                                            </a>
                                            <a class="dropdown-item" href="javascript:;">
                                                <div class="d-flex align-items-center">
                                                    <div class="notify bg-light-success text-success">
                                                        <img src="{{ asset('admin/assets/images/app/outlook.png') }}"
                                                            width="25" alt="user avatar" />
                                                    </div>
                                                    <div class="flex-grow-1">
                                                        <h6 class="msg-name">
                                                            Account Created<span class="msg-time float-end">28 min
                                                                ago</span>
                                                        </h6>
                                                        <p class="msg-info">
                                                            Successfully created new email
                                                        </p>
                                                    </div>
                                                </div>
                                            </a>
                                            <a class="dropdown-item" href="javascript:;">
                                                <div class="d-flex align-items-center">
                                                    <div class="notify bg-light-info text-info">Ss</div>
                                                    <div class="flex-grow-1">
                                                        <h6 class="msg-name">
                                                            New Product Approved
                                                            <span class="msg-time float-end">2 hrs ago</span>
                                                        </h6>
                                                        <p class="msg-info">
                                                            Your new product has approved
                                                        </p>
                                                    </div>
                                                </div>
                                            </a>
                                            <a class="dropdown-item" href="javascript:;">
                                                <div class="d-flex align-items-center">
                                                    <div class="user-online">
                                                        <img src="{{ asset('admin/assets/images/avatars/avatar-4.png') }}"
                                                            class="msg-avatar" alt="user avatar" />
                                                    </div>
                                                    <div class="flex-grow-1">
                                                        <h6 class="msg-name">
                                                            Katherine Pechon
                                                            <span class="msg-time float-end">15 min ago</span>
                                                        </h6>
                                                        <p class="msg-info">
                                                            Making this the first true generator
                                                        </p>
                                                    </div>
                                                </div>
                                            </a>
                                            <a class="dropdown-item" href="javascript:;">
                                                <div class="d-flex align-items-center">
                                                    <div class="notify bg-light-success text-success">
                                                        <i class="bx bx-check-square"></i>
                                                    </div>
                                                    <div class="flex-grow-1">
                                                        <h6 class="msg-name">
                                                            Your item is shipped
                                                            <span class="msg-time float-end">5 hrs ago</span>
                                                        </h6>
                                                        <p class="msg-info">
                                                            Successfully shipped your item
                                                        </p>
                                                    </div>
                                                </div>
                                            </a>
                                            <a class="dropdown-item" href="javascript:;">
                                                <div class="d-flex align-items-center">
                                                    <div class="notify bg-light-primary">
                                                        <img src="{{ asset('admin/assets/images/app/github.png') }}"
                                                            width="25" alt="user avatar" />
                                                    </div>
                                                    <div class="flex-grow-1">
                                                        <h6 class="msg-name">
                                                            New 24 authors<span class="msg-time float-end">1 day
                                                                ago</span>
                                                        </h6>
                                                        <p class="msg-info">
                                                            24 new authors joined last week
                                                        </p>
                                                    </div>
                                                </div>
                                            </a>
                                            <a class="dropdown-item" href="javascript:;">
                                                <div class="d-flex align-items-center">
                                                    <div class="user-online">
                                                        <img src="{{ asset('admin/assets/images/avatars/avatar-8.png') }}"
                                                            class="msg-avatar" alt="user avatar" />
                                                    </div>
                                                    <div class="flex-grow-1">
                                                        <h6 class="msg-name">
                                                            Peter Costanzo
                                                            <span class="msg-time float-end">6 hrs ago</span>
                                                        </h6>
                                                        <p class="msg-info">
                                                            It was popularised in the 1960s
                                                        </p>
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
                                        <a href="javascript:;">
                                            <div class="text-center msg-footer">
                                                <button class="btn btn-primary w-100">
                                                    View All Notifications
                                                </button>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                    <div class="user-box dropdown px-3">
                        <a class="d-flex align-items-center nav-link dropdown-toggle gap-3 dropdown-toggle-nocaret"
                            href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <img src="{{ asset('admin/assets/images/avatars/avatar-2.png') }}" class="user-img"
                                alt="user avatar" />
                            <!-- <div class="user-info">
                  <p class="user-name mb-0">Pauline Seitz</p>
                  <p class="designattion mb-0">Web Designer</p>
                </div> -->
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li>
                                <a class="dropdown-item d-flex align-items-center" href="javascript:;"><i
                                        class="bx bx-user fs-5"></i><span>Profile</span></a>
                            </li>
                            <li>
                                <a class="dropdown-item d-flex align-items-center" href="javascript:;"><i
                                        class="bx bx-cog fs-5"></i><span>Settings</span></a>
                            </li>
                            <li>
                                <a class="dropdown-item d-flex align-items-center" href="javascript:;"><i
                                        class="bx bx-home-circle fs-5"></i><span>Dashboard</span></a>
                            </li>
                            <li>
                                <a class="dropdown-item d-flex align-items-center" href="javascript:;"><i
                                        class="bx bx-dollar-circle fs-5"></i><span>Earnings</span></a>
                            </li>
                            <li>
                                <a class="dropdown-item d-flex align-items-center" href="javascript:;"><i
                                        class="bx bx-download fs-5"></i><span>Downloads</span></a>
                            </li>
                            <li>
                                <div class="dropdown-divider mb-0"></div>
                            </li>
                            <li>
                                <a class="dropdown-item d-flex align-items-center"
                                    href="{{ route('admin.logout') }}"><i
                                        class="bx bx-log-out-circle"></i><span>Logout</span></a>
                            </li>
                        </ul>
                    </div>
                </nav>
            </div>
        </header>
        <!--end header -->

        <!--start page wrapper -->
        @yield('content')
        <!--end page wrapper -->
        <!--start overlay-->
        <div class="overlay toggle-icon"></div>
        <!--end overlay-->
        <!--Start Back To Top Button-->
        <a href="javaScript:;" class="back-to-top"><i class="bx bxs-up-arrow-alt"></i></a>
        <!--End Back To Top Button-->
        <footer class="page-footer">
            <p class="mb-0">Copyright © 2022. All right reserved.</p>
        </footer>
    </div>
    <!--end wrapper-->

    <!-- search modal -->
    <div class="modal" id="SearchModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-fullscreen-md-down">
            <div class="modal-content">
                <div class="modal-header gap-2">
                    <div class="position-relative popup-search w-100">
                        <input class="form-control form-control-lg ps-5 border border-3 border-primary" type="search"
                            placeholder="Search" />
                        <span
                            class="position-absolute top-50 search-show ms-3 translate-middle-y start-0 top-50 fs-4"><i
                                class="bx bx-search"></i></span>
                    </div>
                    <button type="button" class="btn-close d-md-none" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="search-list">
                        <p class="mb-1">Html Templates</p>
                        <div class="list-group">
                            <a href="javascript:;"
                                class="list-group-item list-group-item-action active align-items-center d-flex gap-2 py-1"><i
                                    class="bx bxl-angular fs-4"></i>Best Html Templates</a>
                            <a href="javascript:;"
                                class="list-group-item list-group-item-action align-items-center d-flex gap-2 py-1"><i
                                    class="bx bxl-vuejs fs-4"></i>Html5 Templates</a>
                            <a href="javascript:;"
                                class="list-group-item list-group-item-action align-items-center d-flex gap-2 py-1"><i
                                    class="bx bxl-magento fs-4"></i>Responsive Html5
                                Templates</a>
                            <a href="javascript:;"
                                class="list-group-item list-group-item-action align-items-center d-flex gap-2 py-1"><i
                                    class="bx bxl-shopify fs-4"></i>eCommerce Html
                                Templates</a>
                        </div>
                        <p class="mb-1 mt-3">Web Designe Company</p>
                        <div class="list-group">
                            <a href="javascript:;"
                                class="list-group-item list-group-item-action align-items-center d-flex gap-2 py-1"><i
                                    class="bx bxl-windows fs-4"></i>Best Html Templates</a>
                            <a href="javascript:;"
                                class="list-group-item list-group-item-action align-items-center d-flex gap-2 py-1"><i
                                    class="bx bxl-dropbox fs-4"></i>Html5 Templates</a>
                            <a href="javascript:;"
                                class="list-group-item list-group-item-action align-items-center d-flex gap-2 py-1"><i
                                    class="bx bxl-opera fs-4"></i>Responsive Html5
                                Templates</a>
                            <a href="javascript:;"
                                class="list-group-item list-group-item-action align-items-center d-flex gap-2 py-1"><i
                                    class="bx bxl-wordpress fs-4"></i>eCommerce Html
                                Templates</a>
                        </div>
                        <p class="mb-1 mt-3">Software Development</p>
                        <div class="list-group">
                            <a href="javascript:;"
                                class="list-group-item list-group-item-action align-items-center d-flex gap-2 py-1"><i
                                    class="bx bxl-mailchimp fs-4"></i>Best Html Templates</a>
                            <a href="javascript:;"
                                class="list-group-item list-group-item-action align-items-center d-flex gap-2 py-1"><i
                                    class="bx bxl-zoom fs-4"></i>Html5 Templates</a>
                            <a href="javascript:;"
                                class="list-group-item list-group-item-action align-items-center d-flex gap-2 py-1"><i
                                    class="bx bxl-sass fs-4"></i>Responsive Html5 Templates</a>
                            <a href="javascript:;"
                                class="list-group-item list-group-item-action align-items-center d-flex gap-2 py-1"><i
                                    class="bx bxl-vk fs-4"></i>eCommerce Html Templates</a>
                        </div>
                        <p class="mb-1 mt-3">Online Shoping Portals</p>
                        <div class="list-group">
                            <a href="javascript:;"
                                class="list-group-item list-group-item-action align-items-center d-flex gap-2 py-1"><i
                                    class="bx bxl-slack fs-4"></i>Best Html Templates</a>
                            <a href="javascript:;"
                                class="list-group-item list-group-item-action align-items-center d-flex gap-2 py-1"><i
                                    class="bx bxl-skype fs-4"></i>Html5 Templates</a>
                            <a href="javascript:;"
                                class="list-group-item list-group-item-action align-items-center d-flex gap-2 py-1"><i
                                    class="bx bxl-twitter fs-4"></i>Responsive Html5
                                Templates</a>
                            <a href="javascript:;"
                                class="list-group-item list-group-item-action align-items-center d-flex gap-2 py-1"><i
                                    class="bx bxl-vimeo fs-4"></i>eCommerce Html Templates</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end search modal -->

    <!-- Bootstrap JS -->
    <script src="{{ asset('admin/assets/js/bootstrap.bundle.min.js') }}"></script>
    <!--plugins-->
    <script src="{{ asset('admin/assets/js/jquery.min.js') }}"></script>
    <script src="{{ asset('admin/assets/plugins/simplebar/js/simplebar.min.js') }}"></script>
    <script src="{{ asset('admin/assets/plugins/metismenu/js/metisMenu.min.js') }}"></script>
    <script src="{{ asset('admin/assets/plugins/perfect-scrollbar/js/perfect-scrollbar.js') }}"></script>
    <script src="{{ asset('admin/assets/plugins/vectormap/jquery-jvectormap-2.0.2.min.js') }}"></script>
    <script src="{{ asset('admin/assets/plugins/vectormap/jquery-jvectormap-world-mill-en.js') }}"></script>
    <script src="{{ asset('admin/assets/plugins/chartjs/js/chart.js') }}"></script>
    <script src="{{ asset('admin/assets/js/index.js') }}"></script>
    <!--app JS-->
    <script src="{{ asset('admin/assets/js/app.js') }}"></script>
    <!-- own Js -->
    <script src="{{ asset('admin/assets/js/own.js') }}"></script>
    <script>
        new PerfectScrollbar(".app-container");
    </script>
</body>

<!-- Mirrored from codervent.com/rocker/demo/vertical/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 01 Feb 2024 09:32:30 GMT -->

</html>
