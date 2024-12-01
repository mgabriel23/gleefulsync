<?php
    date_default_timezone_set('Asia/Manila');

    require_once 'library/vendor/autoload.php';
    include 'connection.php';

    $year = isset($_GET['year']) ? $_GET['year'] : '';
    $week_number = isset($_GET['week_number']) ? $_GET['week_number'] : '';
    $week_range = isset($_GET['week_range']) ? $_GET['week_range'] : '';

    $timestamp = date('YmdHis'); // Format: YYYYMMDDHHMMSS
    $filename  = $week_range . " " . $timestamp . ".pdf";

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
            .members-ctr { background-color: #113f67; text-align: center; color: white; font-weight: bold; }
        </style>
    ';

    $html .= '
        <h1>'. $week_range .'</h1>
        <h4>'. $year .'</h4>
        <br>
    ';

    $query = "SELECT id, group_no, group_servant FROM groups_tbl ORDER BY group_no ASC";
    $stmt  = $pdo->prepare($query);
    $stmt->execute();
    $groups = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $table_ctr = 1;
    $table_side = 'left';

    foreach ($groups as $group) {
        $html .= '
            <div style="width: 49%; float: '.($table_ctr % 2 == 0 ? "right" : "left").';">
                <table border="1" cellpadding="5" cellspacing="0" style="border-collapse: collapse; width: 100%; font-family: Arial; font-size: 12px;">
                    <thead>
                        <tr class="table-header">
                            <th colspan="2">GROUP '. htmlspecialchars($group["group_no"]) .'</th>
                            <th>WS</th>
                            <th>TG</th>
                            <th>PM</th>
                        </tr>
                    </thead>
                    <tbody>';

                        $query2 = "
                            SELECT b.name, 
                                (SELECT COUNT(*) FROM attendance_tbl a INNER JOIN batches_tbl b ON a.batch_id = b.id WHERE YEAR(a.date_created) = {$year} AND WEEK(a.date_created, 1) = {$week_number} AND a.member_id = gm.member_id AND b.gathering_id = '2') AS ws_attendance_flag, 
                                (SELECT COUNT(*) FROM attendance_tbl a INNER JOIN batches_tbl b ON a.batch_id = b.id WHERE YEAR(a.date_created) = {$year} AND WEEK(a.date_created, 1) = {$week_number} AND a.member_id = gm.member_id AND b.gathering_id = '3') AS tg_attendance_flag, 
                                (SELECT COUNT(*) FROM attendance_tbl a INNER JOIN batches_tbl b ON a.batch_id = b.id WHERE YEAR(a.date_created) = {$year} AND WEEK(a.date_created, 1) = {$week_number} AND a.member_id = gm.member_id AND b.gathering_id = '1') AS pm_attendance_flag 
                            FROM group_members_tbl gm 
                            INNER JOIN members_tbl b ON gm.member_id = b.id 
                            WHERE gm.group_id = :group_id 
                        ";
                        
                        $stmt2 = $pdo->prepare($query2);
                        $stmt2->bindParam(':group_id', $group["id"], PDO::PARAM_INT);
                        $stmt2->execute();
                        $members = $stmt2->fetchAll(PDO::FETCH_ASSOC);

                        if (empty($members)) {
                            $html .= '
                                <tr>
                                    <td colspan="5" style="text-align: center;">No members found for this group.</td>
                                </tr>
                            ';
                        } else {
                            $member_ctr = 1;
            
                            foreach ($members as $member) {
                                $ws_color_flag = $member["ws_attendance_flag"] == 1 
                                    ? "text-align: center; color: black;" 
                                    : "text-align: center; background-color: #A2A8d3; color: white;";

                                $tg_color_flag = $member["tg_attendance_flag"] == 1 
                                    ? "text-align: center; color: black;" 
                                    : "text-align: center; background-color: #A2A8d3; color: white;";
                                    
                                $pm_color_flag = $member["pm_attendance_flag"] == 1 
                                    ? "text-align: center; color: black;" 
                                    : "text-align: center; background-color: #A2A8d3; color: white;";

                                // Determine attendance status symbols
                                $ws_status = $member["ws_attendance_flag"] == 1 ? "P" : "A";
                                $tg_status = $member["tg_attendance_flag"] == 1 ? "P" : "A";
                                $pm_status = $member["pm_attendance_flag"] == 1 ? "P" : "A";
                                
                                $html .= '
                                    <tr>
                                        <td class="members-ctr">'. $member_ctr .'</td>
                                        <td>'. htmlspecialchars($member["name"]) .'</td>
                                        <td style="'. $ws_color_flag .'">'. $ws_status .'</td>
                                        <td style="'. $tg_color_flag .'">'. $tg_status .'</td>
                                        <td style="'. $pm_color_flag .'">'. $pm_status .'</td>
                                    </tr>
                                ';
                                $member_ctr++;
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