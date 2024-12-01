<?php
    date_default_timezone_set('Asia/Manila');
    
    require_once 'library/vendor/autoload.php';
    include 'connection.php';

    $batch_id       = isset($_GET['batch_id']) ? $_GET['batch_id'] : '';
    $batch_title    = isset($_GET['batch_title']) ? $_GET['batch_title'] : '';
    $report_date    = isset($_GET['report_date']) ? $_GET['report_date'] : '';
    $start_time     = isset($_GET['start_time']) ? $_GET['start_time'] : '';

    $timestamp = date('YmdHis'); // Format: YYYYMMDDHHMMSS
    $filename  = $batch_title . " " . $timestamp . ".pdf";
    
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
            .grp-ctr { background-color: #113f67; text-align: center; color: white; font-weight: bold; }
        </style>
    ';

    // pdf report main header text
    $html .= '
        <h1>'. $batch_title .'</h1>
        <h4>'. $start_time .'</h4>
        <br>
    ';

    // get platforms list
    $query = "SELECT id, short_name, title FROM platforms_tbl";
    $stmt  = $pdo->prepare($query);
    $stmt->execute();
    $platforms = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $table_ctr = 1;
    $table_side = 'left';

    foreach ($platforms as $row) {
        $html .= '
            <div style="width: 49%; float: '.($table_ctr % 2 == 0 ? "right" : "left").';">
                <table cellpadding="5" cellspacing="0">
                    <thead>
                        <tr>
                            <th colspan="2">'. htmlspecialchars($row["short_name"]) .'</th>
                            <th>TIME IN</th>
                        </tr>
                    </thead>
                    <tbody>';

                        // get attendees per platform
                        $query2 = "
                            SELECT b.name, 
                                DATE_FORMAT(a.date_created, '%h:%i %p') AS formatted_time 
                            FROM attendance_tbl a 
                            INNER JOIN members_tbl b ON a.member_id = b.id 
                            WHERE a.batch_id = :batch_id 
                                AND a.platform_id = :platform_id 
                                AND DATE(a.date_created) = :report_date 
                            ORDER BY a.date_created ASC;
                        ";

                        $stmt2  = $pdo->prepare($query2);
                        $stmt2->bindParam(':batch_id', $batch_id, PDO::PARAM_STR);
                        $stmt2->bindParam(':platform_id', $row["id"], PDO::PARAM_STR);
                        $stmt2->bindParam(':report_date', $report_date, PDO::PARAM_STR);
                        $stmt2->execute();
                        $attendees = $stmt2->fetchAll(PDO::FETCH_ASSOC);

                        if (empty($attendees)) {
                            $html .= '
                                <tr class="row-stats">
                                    <td colspan="3" style="text-align: center;">No attendees found for this category.</td>
                                </tr>
                            ';
                        } else {
                            $attendee_ctr = 1;
            
                            foreach ($attendees as $attendee) {
                                $html .= '
                                    <tr class="row-stats">
                                        <td class="grp-ctr">'. $attendee_ctr .'</td>
                                        <td>'. htmlspecialchars($attendee["name"]) .'</td>
                                        <td style="text-align: center;">'. $attendee["formatted_time"] .'</td>
                                    </tr>
                                ';
                                $attendee_ctr++;
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