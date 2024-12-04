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
    <style>
        html {
            scroll-behavior: smooth; /* Enable smooth scrolling */
        }

        .link-disabled {
            pointer-events: none;
            cursor: not-allowed;
            color: gray !important;
        }

        #footer-bar .circle-nav-1::after, #footer-bar .circle-nav-2::before, #footer-bar .circle-nav-2::after {
            background-image: linear-gradient(to bottom, #ccced1, #939393) !important;
        }

        #notif-btn {
            pointer-events: none;
            cursor: not-allowed;
            background-color: gray !important;
        }
    </style>
</head>

<body class="theme-light">

<div id="preloader"><div class="spinner-border color-highlight" role="status"></div></div>

<!-- Page Wrapper-->
<div id="page">

    <!-- Footer Bar -->
    <div id="footer-bar" class="footer-bar-1 footer-bar-detached">
        <a href="#metrics"><i class="bi bi-bar-chart-fill"></i><span>Metrics</span></a>
        <a href="#recents"><i class="bi bi-file-earmark-text-fill"></i><span>Recents</span></a>

        <a href="#" class="circle-nav-2 link-disabled" data-bs-toggle="offcanvas" data-bs-target="#scanner-modal">
            <i class="bi bi-qr-code"></i>
            <span>QR</span>
        </a>

        <a href="#reports"><i class="bi bi-file-earmark-arrow-down-fill"></i><span>Reports</span></a>
        <a href="#settings" class="link-disabled" data-bs-toggle="offcanvas" data-bs-target="#menu-sidebar"><i class="bi bi-gear-fill"></i><span>Settings</span></a>
    </div>

    <!-- Header Bar-->
	<div class="header-bar header-fixed header-app header-auto-show" id="header-bar">
		<a href="#metrics"><i class="bi bi-chevron-up font-13"></i></a>
		<span class="header-title">Back to top</span>
	</div>

    <!-- Page Content - Only Page Elements Here-->
    <div class="page-content footer-clear">

        <!-- Page Title-->
        <div id="metrics" class="pt-3">
            <div class="page-title d-flex">
                <div class="align-self-center me-auto">
                    <p class="color-highlight header-date"></p>
                    <h1>Welcome</h1>
                </div>
                <div class="align-self-center ms-auto">
                    <a href="#"
                    id="notif-btn"
                    data-bs-toggle="offcanvas"
                    data-bs-target="#menu-notifications"
                    class="icon color-white shadow-bg shadow-bg-xs rounded-m">
                        <i class="bi bi-bell-fill font-17"></i>
                        <!-- <em class="badge bg-red-dark color-white scale-box">3</em> -->
                    </a>
                </div>
            </div>
        </div>

        <!-- active batch content -->
        <div class="pt-2 pb-4 text-center" id="batch-info">
            <h3 style="margin-bottom: 0;" id="gathering-type"></h3>
            <h5 id="day-name"></h5>
            <h4 class="color-highlight" id="start-time"></h4>
        </div>

        <!-- Quick Actions -->
        <div class="content" style="margin-top: 0; margin-bottom: 32px;">
            <div class="d-flex text-center">
                <div class="m-auto">
                    <a href="#" data-bs-toggle="offcanvas" data-bs-target="#locale-attendees" class="icon icon-xxl rounded-m bg-theme shadow-m">
                        <!-- <i class="font-28 color-green-dark bi bi-arrow-up-circle"></i> -->
                        <i class="font-28 color-yellow-dark bi bi-house-fill"></i>
                        <em class="badge bg-yellow-dark color-white font-12" style="border-radius: 8px;">0</em>
                    </a>
                    <h6 class="font-13 opacity-80 font-500 mb-0 pt-2">Locale</h6>
                </div>
                <div class="m-auto">
                    <a href="#" data-bs-toggle="offcanvas" data-bs-target="#youtube-attendees" class="icon icon-xxl rounded-m bg-theme shadow-m">
                        <!-- <i class="font-28 color-red-dark bi bi-arrow-down-circle"></i> -->
                        <i class="font-28 color-red-dark bi bi-youtube"></i>
                        <em class="badge bg-red-dark color-white font-12" style="border-radius: 8px;">0</em>
                    </a>
                    <h6 class="font-13 opacity-80 font-500 mb-0 pt-2">Youtube</h6>
                </div>
                <div data-bs-toggle="offcanvas" data-bs-target="#zoom-attendees" class="m-auto">
                    <a href="#" class="icon icon-xxl rounded-m bg-theme shadow-m">
                        <!-- <i class="font-28 color-blue-dark bi bi-arrow-repeat"></i> -->
                        <i class="font-28 color-blue-dark bi bi-camera-video-fill"></i>
                        <em class="badge bg-blue-dark color-white font-12" style="border-radius: 8px;">0</em>
                    </a>
                    <h6 class="font-13 opacity-80 font-500 mb-0 pt-2">Zoom</h6>
                </div>
                <div data-bs-toggle="offcanvas" data-bs-target="#others-attendees" class="m-auto">
                    <a href="#" class="icon icon-xxl rounded-m bg-theme shadow-m">
                        <!-- <i class="font-28 color-blue-dark bi bi-arrow-repeat"></i> -->
                        <i class="font-28 color-brown-dark bi bi-three-dots"></i>
                        <em class="badge bg-brown-dark color-white font-12" style="border-radius: 8px;">0</em>
                    </a>
                    <h6 class="font-13 opacity-80 font-500 mb-0 pt-2">Others</h6>
                </div>
            </div>
        </div>

        <!-- Recent Activity Title-->
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

        <!-- Recent Activity Cards-->
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

        <!--
        <div class="content my-0 mt-n2 px-1">
            <div class="d-flex">
                <div class="align-self-center">
                    <h3 class="font-16 mb-2">Masterfiles</h3>
                </div>
            </div>
        </div>

        <div class="content" style="margin-top: 0; margin-bottom: 32px;">
            <div class="row">
                <div class="col-6">
                    <a href="#" class="btn-full btn gradient-green shadow-bg shadow-bg-m" data-bs-toggle="offcanvas" data-bs-target="#modal">
                        Upload
                    </a>
                </div>
                <div class="col-6">
                    <a href="#" class="btn-full btn gradient-blue shadow-bg shadow-bg-m">Modify</a>
                </div>
            </div>
        </div>
        -->

        <!-- Recent Activity Title-->
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
    </div>
    <!-- End of Page Content-->

    <div id="modal"
        class="offcanvas offcanvas-start">
        <div style="width:100vw">
            <!-- Page Title-->
           <div class="pt-3">
               <div class="page-title d-flex">
                   <div class="align-self-center">
                       <a href="#"
                       data-bs-dismiss="offcanvas"
                       class="me-3 ms-0 icon icon-xxs bg-theme rounded-s shadow-m">
                           <i class="bi bi-chevron-left color-theme font-14"></i>
                       </a>
                   </div>
                   <div class="align-self-center me-auto">
                       <h1 class="color-theme mb-0 font-18">File Upload</h1>
                   </div>
                   <div class="align-self-center ms-auto">
                       <a href="#" data-bs-toggle="offcanvas" data-bs-target="#menu-sidebar"
                       class="icon icon-xxs gradient-highlight color-white shadow-bg shadow-bg-xs rounded-s">
                           <i class="bi bi-list font-20"></i>
                       </a>
                   </div>
               </div>
           </div>
           <div class="content mt-0">
               <h5 class="pb-3 pt-4">Masterfiles</h5>
               
               

               <a href="#" data-bs-dismiss="offcanvas" class="btn btn-full gradient-highlight shadow-bg shadow-bg-s mt-4">Apply Settings</a>
           </div>
        </div>
    </div>

    <div id="scanner-modal" data-menu-load="qr_scanner.html"
        class="offcanvas offcanvas-bottom offcanvas-detached rounded-m">
    </div>

	<div id="menu-highlights"
		data-menu-load="menu-highlights.html"
		class="offcanvas offcanvas-bottom offcanvas-detached rounded-m">
	</div>

	<div id="menu-notifications" data-menu-load="menu-notifications.html"
		class="offcanvas offcanvas-top offcanvas-detached rounded-m">
	</div>

    <div id="menu-card-more" data-menu-load="menu-card-settings.html"
        class="offcanvas offcanvas-bottom offcanvas-detached rounded-m">
    </div>

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

    <!-- add attendees -->
    <div id="add-attendees" data-menu-load="add-attendees.php"
        class="offcanvas offcanvas-bottom offcanvas-detached rounded-m">
    </div>

	<div class="offcanvas offcanvas-bottom rounded-m offcanvas-detached" id="menu-install-pwa-ios">
        <div class="content">
        <img src="app/icons/icon-128x128.png" alt="img" width="80" class="rounded-m mx-auto my-4">
            <h1 class="text-center">Install GleefulSync</h1>
            <p class="boxed-text-xl">
                Install PayApp on your home screen, and access it just like a regular app. Open your Safari menu and tap "Add to Home Screen".
            </p>
            <a href="#" class="pwa-dismiss close-menu color-theme text-uppercase font-900 opacity-50 font-11 text-center d-block mt-n2" data-bs-dismiss="offcanvas">Maybe Later</a>
        </div>
    </div>

    <div class="offcanvas offcanvas-bottom rounded-m offcanvas-detached" id="menu-install-pwa-android">
        <div class="content">
            <img src="app/icons/icon-128x128.png" alt="img" width="80" class="rounded-m mx-auto my-4">
            <h1 class="text-center">Install GleefulSync</h1>
            <p class="boxed-text-l">
                Install the App to your Home Screen to enjoy a unique and native experience.
            </p>
            <a href="#" class="pwa-install btn btn-m rounded-s text-uppercase font-900 gradient-highlight shadow-bg shadow-bg-s btn-full">Add to Home Screen</a><br>
            <a href="#" data-bs-dismiss="offcanvas" class="pwa-dismiss close-menu color-theme text-uppercase font-900 opacity-60 font-11 text-center d-block mt-n1">Maybe later</a>
        </div>
    </div>

</div>
<!-- End of Page ID-->

<script src="scripts/bootstrap.min.js"></script>
<script src="scripts/custom.js"></script>

<script>
    // active batch event sse
    const activeBatchEvent = new EventSource('active_batch_sse.php');

    activeBatchEvent.onmessage = function(event) {
        const data = JSON.parse(event.data);
        
        if (data) {
            document.getElementById('gathering-type').textContent = data.gathering_type;
            document.getElementById('day-name').textContent = `(${data.day_name})`;
            document.getElementById('start-time').textContent = data.formatted_start_time;
        } else {
            document.getElementById('gathering-type').textContent = 'No Active Batch';
            document.getElementById('day-name').textContent = '';
            document.getElementById('start-time').textContent = '';
        }
    };

    activeBatchEvent.onerror = function() {
        console.error('Error with SSE connection');
        activeBatchEvent.close();
    };

    // live summary event sse
    const liveSummaryEvent = new EventSource('live_summary_sse.php');

    liveSummaryEvent.onmessage = function(event) {
        const data = JSON.parse(event.data);
        document.querySelector('.badge.bg-yellow-dark').textContent = data.locale_count;
        document.querySelector('.badge.bg-red-dark').textContent = data.youtube_count;
        document.querySelector('.badge.bg-blue-dark').textContent = data.zoom_count;
        document.querySelector('.badge.bg-brown-dark').textContent = data.others_count;
    };

    liveSummaryEvent.onerror = function(event) {
        console.error('Error occurred:', event);
        liveSummaryEvent.close();
    };

    function loadDailyReports() {
        fetch('daily-reports-list.php')
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                return response.json();
            })
            .then(data => {
                const contentsDiv = document.getElementById('daily-report-contents');
                contentsDiv.innerHTML = '';

                if (data.length === 0) {
                    contentsDiv.innerHTML = '<p>No records found for today.</p>';
                    return;
                }

                data.forEach(report => {
                    const reportElement = document.createElement('a');
                    reportElement.href = "#";
                    reportElement.className = "d-flex py-1";
                    reportElement.setAttribute("data-bs-toggle", "offcanvas");
                    reportElement.setAttribute("data-bs-target", "#menu-activity-5");
                    
                    reportElement.innerHTML = `
                        <div class="align-self-center ps-1">
                            <h5 class="pt-1 mb-n1">${report.batch_title}</h5>
                            <p class="mb-0 font-11 opacity-70">${report.start_time}</p>
                        </div>
                        <div class="align-self-center ms-auto text-end">
                            <span class="btn btn-xxs gradient-blue shadow-bg shadow-bg-xs" onclick="generateDailyReportPDF('${report.batch_id}', '${report.batch_title}', '${report.report_date}', '${report.start_time}')">View</span>
                        </div>
                    `;
                    
                    contentsDiv.appendChild(reportElement);
                });
            })
            .catch(error => {
                console.error('There was a problem with the fetch operation:', error);
            });
    }

    document.getElementById('day-tab-btn').addEventListener('click', function (event) {
        event.preventDefault();
        loadDailyReports();
    });

    function loadWeeklyReports() {
        fetch('weekly-reports-list.php')
            .then(response => {
                if (!response.ok) {
                    throw new Error(`HTTP error! status: ${response.status}`);
                }
                return response.text();
            })
            .then(rawText => {
                console.log('Raw response:', rawText); // Debug raw response
                return JSON.parse(rawText); // Parse JSON manually
            })
            .then(data => {
                const contentsDiv = document.getElementById('weekly-report-contents');
                contentsDiv.innerHTML = '';

                if (data.length === 0) {
                    contentsDiv.innerHTML = '<p>No records found for today.</p>';
                    return;
                }

                data.forEach(report => {
                    const reportElement = document.createElement('a');
                    reportElement.href = "#";
                    reportElement.className = "d-flex py-1";
                    reportElement.setAttribute("data-bs-toggle", "offcanvas");
                    reportElement.setAttribute("data-bs-target", "#menu-activity-6");
                    
                    reportElement.innerHTML = `
                        <div class="align-self-center ps-1">
                            <h5 class="pt-1 mb-n1">${report.week_range}</h5>
                            <p class="mb-0 font-11 opacity-70">PM / WS / TG</p>
                        </div>
                        <div class="align-self-center ms-auto text-end">
                            <span class="btn btn-xxs gradient-blue shadow-bg shadow-bg-xs" onclick="generateWeeklyReportPDF('${report.year}', '${report.week_number}', '${report.week_range}')">View</span>
                        </div>
                    `;
                    
                    contentsDiv.appendChild(reportElement);
                });
            })
            .catch(error => {
                console.error('There was a problem with the fetch operation:', error);
            });
    }

    document.getElementById('weekly-tab-btn').addEventListener('click', function (event) {
        event.preventDefault();
        loadWeeklyReports();
    });

    function loadMonthlyReports() {
        fetch('monthly-reports-list.php')
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                return response.json();
            })
            .then(data => {
                const contentsDiv = document.getElementById('monthly-report-contents');
                contentsDiv.innerHTML = '';

                if (data.length === 0) {
                    contentsDiv.innerHTML = '<p>No records found for today.</p>';
                    return;
                }

                data.forEach(report => {
                    const reportElement = document.createElement('div');
                    reportElement.className = "d-flex py-1";

                    // Set the inner HTML with content and button
                    reportElement.innerHTML = `
                        <div class="align-self-center ps-1">
                            <h5 class="pt-1 mb-n1">${report.month_name}</h5>
                            <p class="mb-0 font-11 opacity-70">PM / WS / TG</p>
                        </div>
                        <div class="align-self-center ms-auto text-end">
                            <span class="btn btn-xxs gradient-blue shadow-bg shadow-bg-xs" onclick="generateMonthlyReportPDF('${report.year}', '${report.month_name}', '${report.month_number}')">View</span>
                        </div>
                    `;

                    // Append the element to the contentsDiv
                    contentsDiv.appendChild(reportElement);
                });
            })
            .catch(error => {
                console.error('There was a problem with the fetch operation:', error);
            });
    }

    document.getElementById('monthly-tab-btn').addEventListener('click', function (event) {
        event.preventDefault();
        loadMonthlyReports();
    });

    // on-page load
    document.addEventListener('DOMContentLoaded', function () {
        loadDailyReports();
    });

    function generateDailyReportPDF(batch_id, batch_title, report_date, start_time) {
        window.location.href = `generateDailyReportPDF.php?batch_id=${encodeURIComponent(batch_id)}&batch_title=${encodeURIComponent(batch_title)}&report_date=${encodeURIComponent(report_date)}&start_time=${encodeURIComponent(start_time)}`;
    }

    function generateWeeklyReportPDF(year, week_number, week_range) {
        window.location.href = `generateWeeklyReportPDF.php?year=${encodeURIComponent(year)}&week_number=${encodeURIComponent(week_number)}&week_range=${encodeURIComponent(week_range)}`;
    }

    function generateMonthlyReportPDF(year, month_name, month_number) {
        window.location.href = `generateMonthlyReportPDF.php?year=${encodeURIComponent(year)}&month_name=${encodeURIComponent(month_name)}&month_number=${encodeURIComponent(month_number)}`;
    }
</script>

<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> -->

<!-- qr scanner -->
<!-- <script src="scripts/html5-qrcode.min.js"></script> -->

<!-- qr scanner page js (page-specific) -->
<!-- <script src="scripts/qr_scanner_page.js" defer></script> -->
</body>