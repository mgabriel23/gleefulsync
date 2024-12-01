<?php
    date_default_timezone_set('Asia/Manila');

    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    require_once 'library/vendor/autoload.php';
    include 'connection.php';

    $year = isset($_GET['year']) ? $_GET['year'] : '';
    $month_name = isset($_GET['month_name']) ? $_GET['month_name'] : '';
    $month_number = isset($_GET['month_number']) ? $_GET['month_number'] : '';

    $timestamp = date('YmdHis'); // Format: YYYYMMDDHHMMSS
    $filename  = $month_name . " " . $timestamp . ".pdf";

    $mpdf = new \Mpdf\Mpdf();

    // css styles
    $html = '
        <style>
            h1, h4 { text-align: center;  }
            h1 { color: #212A31; margin-bottom: 0; padding-bottom: 0; }
            h4 { color: #2E3944; margin-top: 0; padding-top: 0; }
            table { border-collapse: collapse; width: 100%; font-family: Arial; font-size: 12px; }
            table, thead tr th, tbody tr td { border: 2px solid white; }
            table thead tr { background-color: #113f67; }
            table thead tr th { color: white; }
            tr:nth-child(odd) { background-color: #F0F0F0; }
            tr:nth-child(even) { background-color: #FFFFFF; }
            .table-header th { font-size: 15px !important; }
            tr.gatherings-header td { background-color: #113f67; color: white; font-weight: bold; }
            .txt-center { text-align: center; }
        </style>
    ';

    $html .= '
        <h1>'. $month_name .'</h1>
        <h4>'. $year .'</h4>
        <br>
    ';

    $query = "
        SELECT 
            MONTH(a.date_created) AS month_number, 
            WEEK(a.date_created, 1) AS week_number, 
            CASE 
                WHEN MONTH(DATE_SUB(a.date_created, INTERVAL WEEKDAY(a.date_created) DAY)) = MONTH(DATE_ADD(DATE_SUB(a.date_created, INTERVAL WEEKDAY(a.date_created) DAY), INTERVAL 6 DAY))
                THEN CONCAT(
                    DATE_FORMAT(DATE_SUB(a.date_created, INTERVAL WEEKDAY(a.date_created) DAY), '%M %d'), 
                    ' - ', 
                    DATE_FORMAT(DATE_ADD(DATE_SUB(a.date_created, INTERVAL WEEKDAY(a.date_created) DAY), INTERVAL 6 DAY), '%d')
                )
                ELSE CONCAT(
                    DATE_FORMAT(DATE_SUB(a.date_created, INTERVAL WEEKDAY(a.date_created) DAY), '%M %d'), 
                    ' - ', 
                    DATE_FORMAT(DATE_ADD(DATE_SUB(a.date_created, INTERVAL WEEKDAY(a.date_created) DAY), INTERVAL 6 DAY), '%M %d')
                )
            END AS week_range 
        FROM 
            attendance_tbl a 
        WHERE 
            MONTH(a.date_created) = :month_number  
        GROUP BY 
            month_number, week_number, week_range
    ";
    $stmt  = $pdo->prepare($query);
    $stmt->bindParam(':month_number', $month_number, PDO::PARAM_INT);
    $stmt->execute();
    $weeks = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $table_ctr = 1;
    $table_side = 'left';

    foreach ($weeks as $week) {
        $html .= '
            <div style="width: 49%; float: '.($table_ctr % 2 == 0 ? "right" : "left").';">
                <table border="1" cellpadding="5" cellspacing="0" style="border-collapse: collapse; width: 100%; font-family: Arial; font-size: 12px;">
                    <thead>
                        <tr class="table-header">
                            <th colspan="4">'. htmlspecialchars(strtoupper($week["week_range"])) .'</th>
                        </tr>
                    </thead>
                    <tbody>';

                        $query2 = "SELECT a.id, a.title FROM gatherings_tbl a";
                        
                        $stmt2 = $pdo->prepare($query2);
                        $stmt2->execute();
                        $gatherings = $stmt2->fetchAll(PDO::FETCH_ASSOC);
                        
                        foreach ($gatherings as $gathering) {
                            $html .= '
                                <tr class="gatherings-header">
                                    <td>'. htmlspecialchars($gathering["title"]) .'</td>
                                    <td class="txt-center">LIVE</td>
                                    <td class="txt-center">VIEWING</td>
                                    <td class="txt-center">TOTAL</td>
                                </tr>
                            ';
                            
                            $week_number = (int)$week["week_number"];
                            $gathering_id = (int)$gathering["id"];

                            $query3 = "
                                SELECT 
                                    a.id, 
                                    a.short_name, 
                                    (SELECT COUNT(*) FROM attendance_tbl att INNER JOIN batches_tbl btch ON att.batch_id = btch.id WHERE att.platform_id = a.id AND btch.is_live = 1 AND btch.gathering_id = $gathering_id AND WEEK(att.date_created, 1) = $week_number) AS live_total, 
                                    (SELECT COUNT(*) FROM attendance_tbl att INNER JOIN batches_tbl btch ON att.batch_id = btch.id WHERE att.platform_id = a.id AND btch.is_live != 1 AND btch.gathering_id = $gathering_id AND WEEK(att.date_created, 1) = $week_number) AS viewing_total 
                                FROM platforms_tbl a 
                            ";
                        
                            $stmt3 = $pdo->prepare($query3);
                            $stmt3->execute();
                            $platforms = $stmt3->fetchAll(PDO::FETCH_ASSOC);

                            foreach ($platforms as $platform) {
                                $total = $platform["live_total"] + $platform["viewing_total"];
                                $html .= '
                                    <tr>
                                        <td>'. htmlspecialchars($platform["short_name"]) .'</td>
                                        <td class="txt-center">'. htmlspecialchars($platform["live_total"]) .'</td>
                                        <td class="txt-center">'. htmlspecialchars($platform["viewing_total"]) .'</td>
                                        <td class="txt-center">'. $total .'</td>
                                    </tr>
                                ';
                            }
                        }

        $html .= '
                    </tbody>
                </table>
            </div>
        ';

        // add break line every 2 tables
        if($table_ctr % 2 == 0) {
            $html .= '<div style="clear: both;"></div>';
            $html .= '<br>';
        }

        $table_ctr++;
    }

    $mpdf->WriteHTML($html);
    $mpdf->Output($filename, \Mpdf\Output\Destination::DOWNLOAD);
?>