<?php
    header('Content-Type: application/json');
    header('Cache-Control: no-cache');

    include 'connection.php';

    $query = "
        SELECT 
            YEAR(a.date_created) AS year, 
            WEEK(a.date_created, 1) AS week_number, 
            MAX(CASE 
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
            END) AS week_range 
        FROM 
            attendance_tbl a 
        WHERE 
            YEAR(a.date_created) = YEAR(CURRENT_DATE()) 
        GROUP BY 
            year, week_number 
        ORDER BY 
            week_number DESC 
        LIMIT 5;
    ";

    $stmt = $pdo->prepare($query);
    $stmt->execute();
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $data = [];
    foreach ($results as $row) {
        $data[] = [
            'year' => htmlspecialchars($row['year']), 
            'week_number' => htmlspecialchars($row['week_number']), 
            'week_range' => htmlspecialchars($row['week_range'])
        ];
    }

    echo json_encode($data);
?>