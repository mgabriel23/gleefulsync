<?php
    header('Content-Type: text/event-stream');
    header('Cache-Control: no-cache');

    set_time_limit(0);
    include 'connection.php';

    function fetchAttendanceCounts($pdo) {
        return [
            'locale_count' => $pdo->query("SELECT COUNT(*) FROM attendance_tbl a INNER JOIN locales_tbl b ON a.locale_id = b.id INNER JOIN members_tbl c ON a.member_id = c.id INNER JOIN batches_tbl d ON a.batch_id = d.id INNER JOIN platforms_tbl e ON a.platform_id = e.id INNER JOIN group_members_tbl f ON a.member_id = f.member_id WHERE e.short_name = 'Locale' AND CURRENT_TIME() BETWEEN d.start_time AND d.end_time AND d.day = (WEEKDAY(CURRENT_DATE())) AND DATE(a.date_created) = CURRENT_DATE() ORDER BY f.group_id ASC")->fetchColumn(),
            'youtube_count' => $pdo->query("SELECT COUNT(*) FROM attendance_tbl a INNER JOIN locales_tbl b ON a.locale_id = b.id INNER JOIN members_tbl c ON a.member_id = c.id INNER JOIN batches_tbl d ON a.batch_id = d.id INNER JOIN platforms_tbl e ON a.platform_id = e.id INNER JOIN group_members_tbl f ON a.member_id = f.member_id WHERE e.short_name = 'Youtube' AND CURRENT_TIME() BETWEEN d.start_time AND d.end_time AND d.day = (WEEKDAY(CURRENT_DATE())) AND DATE(a.date_created) = CURRENT_DATE() ORDER BY f.group_id ASC")->fetchColumn(),
            'zoom_count' => $pdo->query("SELECT COUNT(*) FROM attendance_tbl a INNER JOIN locales_tbl b ON a.locale_id = b.id INNER JOIN members_tbl c ON a.member_id = c.id INNER JOIN batches_tbl d ON a.batch_id = d.id INNER JOIN platforms_tbl e ON a.platform_id = e.id INNER JOIN group_members_tbl f ON a.member_id = f.member_id WHERE e.short_name = 'Zoom' AND CURRENT_TIME() BETWEEN d.start_time AND d.end_time AND d.day = (WEEKDAY(CURRENT_DATE())) AND DATE(a.date_created) = CURRENT_DATE() ORDER BY f.group_id ASC")->fetchColumn(),
            'others_count' => $pdo->query("SELECT COUNT(*) FROM attendance_tbl a INNER JOIN locales_tbl b ON a.locale_id = b.id INNER JOIN members_tbl c ON a.member_id = c.id INNER JOIN batches_tbl d ON a.batch_id = d.id INNER JOIN platforms_tbl e ON a.platform_id = e.id INNER JOIN group_members_tbl f ON a.member_id = f.member_id WHERE e.short_name = 'Others' AND CURRENT_TIME() BETWEEN d.start_time AND d.end_time AND d.day = (WEEKDAY(CURRENT_DATE())) AND DATE(a.date_created) = CURRENT_DATE() ORDER BY f.group_id ASC")->fetchColumn(),
        ];
    }

    while (true) {
        $attendanceCounts = fetchAttendanceCounts($pdo);
        echo "data: " . json_encode($attendanceCounts) . "\n\n";
        ob_flush();
        flush();
        sleep(5);
    }
?>