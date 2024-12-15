<!DOCTYPE HTML>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="default">
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1, viewport-fit=cover" />
    <title>GleefulSyncApp - Locale Attendance Monitoring</title>
    <link rel="stylesheet" type="text/css" href="styles/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="fonts/bootstrap-icons.css">
    <link rel="stylesheet" type="text/css" href="styles/style.css">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Source+Sans+Pro:wght@500;600;700&family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
    <link rel="manifest" href="_manifest.json">
    <meta id="theme-check" name="theme-color" content="#FFFFFF">
    <link rel="apple-touch-icon" sizes="180x180" href="app/icons/icon-192x192.png">
</head>

<body class="theme-dark">

    <div id="preloader"><div class="spinner-border color-highlight" role="status"></div></div>

    <!-- Page Wrapper-->
    <div id="page">
        <!-- Menu Bar -->
        <div id="footer-bar" class="footer-bar-1 footer-bar-detached">
            <a href="#metrics"><i class="bi bi-bar-chart-fill"></i><span>Metrics</span></a>
            <a href="#recents"><i class="bi bi-file-earmark-text-fill"></i><span>Recents</span></a>

            <a href="#" class="circle-nav-2">
                <i class="bi bi-qr-code"></i>
                <span>QR</span>
            </a>

            <a href="#reports"><i class="bi bi-file-earmark-arrow-down-fill"></i><span>Reports</span></a>
            <a href="#settings"><i class="bi bi-patch-check-fill"></i><span>Certif.</span></a>
        </div>

        <div class="page-content footer-clear">
            <!-- Page Header-->
            <div id="metrics" class="pt-3">
                <div class="page-title d-flex">
                    <div class="align-self-center me-auto">
                        <p class="color-highlight header-date2"></p>
                        <h1>Welcome</h1>
                    </div>
                    <div class="align-self-center ms-auto">
                        <a href="#"
                        id="notif-btn"
                        class="icon color-white shadow-bg shadow-bg-xs rounded-m">
                            <i class="bi bi-bell-fill font-17"></i>
                        </a>
                    </div>
                </div>
            </div>

            <!-- active batch part -->
            <div class="pt-2 pb-4 text-center" id="batch-info">
                <h3 style="margin-bottom: 0;" id="gathering-type">Worship Service</h3>
                <h5 id="day-name">(Sunday)</h5>
                <h4 class="color-highlight" id="batch-start-time">07:30am</h4>
            </div>

            <!-- attendance current batch summary part -->
            <div class="content" style="margin-top: 0; margin-bottom: 32px;">
                <div class="d-flex text-center">
                    <div class="m-auto">
                        <a href="#" data-bs-toggle="offcanvas" data-bs-target="#locale-attendees" class="icon icon-xxl rounded-m bg-theme shadow-m">
                            <i class="font-28 color-yellow-dark bi bi-house-fill"></i>
                            <em class="badge bg-yellow-dark color-white font-12" style="border-radius: 8px;">0</em>
                        </a>
                        <h6 class="font-13 opacity-80 font-500 mb-0 pt-2">Locale</h6>
                    </div>
                    <div class="m-auto">
                        <a href="#" data-bs-toggle="offcanvas" data-bs-target="#youtube-attendees" class="icon icon-xxl rounded-m bg-theme shadow-m">
                            <i class="font-28 color-red-dark bi bi-youtube"></i>
                            <em class="badge bg-red-dark color-white font-12" style="border-radius: 8px;">0</em>
                        </a>
                        <h6 class="font-13 opacity-80 font-500 mb-0 pt-2">Youtube</h6>
                    </div>
                    <div data-bs-toggle="offcanvas" data-bs-target="#zoom-attendees" class="m-auto">
                        <a href="#" class="icon icon-xxl rounded-m bg-theme shadow-m">
                            <i class="font-28 color-blue-dark bi bi-camera-video-fill"></i>
                            <em class="badge bg-blue-dark color-white font-12" style="border-radius: 8px;">0</em>
                        </a>
                        <h6 class="font-13 opacity-80 font-500 mb-0 pt-2">Zoom</h6>
                    </div>
                    <div data-bs-toggle="offcanvas" data-bs-target="#others-attendees" class="m-auto">
                        <a href="#" class="icon icon-xxl rounded-m bg-theme shadow-m">
                            <i class="font-28 color-brown-dark bi bi-three-dots"></i>
                            <em class="badge bg-brown-dark color-white font-12" style="border-radius: 8px;">0</em>
                        </a>
                        <h6 class="font-13 opacity-80 font-500 mb-0 pt-2">Others</h6>
                    </div>
                </div>
            </div>
            <!-- attendance current batch summary part end -->

            <!-- Recent Activity Title -->
            <div id="recents" class="content my-0 mt-n2 px-1">
                <div class="d-flex">
                    <div class="align-self-center">
                        <h3 class="font-16 mb-2">Recent Activity</h3>
                    </div>
                    <div class="align-self-center ms-auto">
                        <a href="#" class="font-12 pt-1">View All</a>
                    </div>
                </div>
            </div>

            <!-- Recent Activity History -->
            <div class="card card-style">
                <div class="content">
                    <a href="#" class="d-flex py-1">
                        <div class="align-self-center ps-1">
                            <h5 class="pt-1 mb-n1">Worship Service</h5>
                            <p class="mb-0 font-11 opacity-50">Attendance Record</p>
                        </div>
                        <div class="align-self-center ms-auto text-end">
                            <h4 class="pt-1 mb-n1 color-blue-dark">08:07 am</h4>
                            <p class="mb-0 font-11">Sis Ghia Masamoc</p>
                        </div>
                    </a>
                    <div class="divider my-2 opacity-50"></div>
                    <a href="#" class="d-flex py-1">
                        <div class="align-self-center ps-1">
                            <h5 class="pt-1 mb-n1">Worship Service</h5>
                            <p class="mb-0 font-11 opacity-50">Attendance Record</p>
                        </div>
                        <div class="align-self-center ms-auto text-end">
                            <h4 class="pt-1 mb-n1 color-blue-dark">07:58 am</h4>
                            <p class="mb-0 font-11">Sis Irma Emperado</p>
                        </div>
                    </a>
                    <div class="divider my-2 opacity-50"></div>
                    <a href="#" class="d-flex py-1">
                        <div class="align-self-center ps-1">
                            <h5 class="pt-1 mb-n1">Prayer Meeting</h5>
                            <p class="mb-0 font-11 opacity-50">Attendance Record</p>
                        </div>
                        <div class="align-self-center ms-auto text-end">
                            <h4 class="pt-1 mb-n1 color-blue-dark">07:42 pm</h4>
                            <p class="mb-0 font-11">Sis Ghia Masamoc</p>
                        </div>
                    </a>
                </div>
            </div>
            <!-- Recent Activity History End -->

            <!-- Reports Title -->
            <div class="content my-0 mt-n2 px-1">
                <div class="d-flex">
                    <div class="align-self-center">
                        <h3 class="font-16 mb-2">Reports</h3>
                    </div>
                </div>
            </div>

            <!-- reports content -->
            <div id="reports" class="card card-style">
                <div class="content">
                    <div class="tabs tabs-pill" id="tab-group-2">
                        <div class="tab-controls rounded-m p-1 overflow-visible">
                            <a class="font-13 rounded-m shadow-bg shadow-bg-s" data-bs-toggle="collapse" href="#tab-4" aria-expanded="true" id="day-tab-btn">Day</a>
                            <a class="font-13 rounded-m shadow-bg shadow-bg-s" data-bs-toggle="collapse" href="#tab-5" aria-expanded="false" id="weekly-tab-btn">Weekly</a>
                            <a class="font-13 rounded-m shadow-bg shadow-bg-s" data-bs-toggle="collapse" href="#tab-6" aria-expanded="false" id="monthly-tab-btn">Montly</a>
                        </div>
                        <div class="mt-3"></div>
                        <!-- daily report content -->
                        <div class="collapse show" id="tab-4" data-bs-parent="#tab-group-2">
                            <div class="divider my-2 opacity-50"></div>
                            <div id="daily-report-contents"></div>
                        </div>
                        <!-- Tab Group 2 -->
                        <div class="collapse" id="tab-5" data-bs-parent="#tab-group-2">
                            <div class="divider my-2 opacity-50"></div>
                            <div id="weekly-report-contents"></div>
                        </div>
                        <!-- Tab Group 3 -->
                        <div class="collapse" id="tab-6" data-bs-parent="#tab-group-2">
                            <div class="divider my-2 opacity-50"></div>
                            <div id="monthly-report-contents"></div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- reports content end -->

            <!-- Certificate Title -->
            <div class="content my-0 mt-n2 px-1">
                <div class="d-flex">
                    <div class="align-self-center">
                        <h3 class="font-16 mb-2">Certificate</h3>
                    </div>
                </div>
            </div>

            <!-- certificate content -->
            <div id="reports" class="card card-style">
                <div class="content">
                    <div class="divider my-2 opacity-50"></div>
                    <form action="">
                        <div class="form-custom form-label form-icon mb-3">
                            <i class="bi bi-person font-13"></i>
                            <select class="form-select rounded-xs" id="c6" aria-label="Floating label select example">
                                <option selected="">Bro. Mark Bryan Gabriel</option>
                            </select>
                            <label for="c6" class="color-theme">Select a member</label>
                            <div class="valid-feedback">HTML5 does not offer Dates Field Validation!<!-- text for field valid--></div>
                        </div>
                        <button class="btn btn-full bg-blue-dark rounded-xs text-uppercase font-700 w-100 btn-s mt-4" type="submit">Generate Certificate</button>
                    </form>
                </div>
            </div>
            <!-- certificate content end -->
        </div>

        <!-- modal / pop-ups part -->
        <div id="locale-attendees" data-menu-load="locale-attendees.php"
            class="offcanvas offcanvas-bottom offcanvas-detached rounded-m">
        </div>

        <div id="youtube-attendees" data-menu-load="youtube-attendees.php"
            class="offcanvas offcanvas-bottom offcanvas-detached rounded-m">
        </div>

        <div id="zoom-attendees" data-menu-load="zoom-attendees.php"
            class="offcanvas offcanvas-bottom offcanvas-detached rounded-m">
        </div>

        <div id="others-attendees" data-menu-load="others-attendees.php"
            class="offcanvas offcanvas-bottom offcanvas-detached rounded-m">
        </div>
    </div>

    <script src="scripts/bootstrap.min.js"></script>
    <script src="scripts/custom.js"></script>

    <!-- <script></script> -->
</body>