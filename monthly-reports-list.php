<?php
    header('Content-Type: application/json');
    header('Cache-Control: no-cache');

    include 'connection.php';

    $query = "
        SELECT 
            YEAR(a.date_created) AS year, 
            DATE_FORMAT(a.date_created, '%M') AS month_name, 
            DATE_FORMAT(a.date_created, '%m') AS month_number 
        FROM 
            attendance_tbl a 
        WHERE 
            YEAR(a.date_created) = YEAR(CURRENT_DATE()) 
        GROUP BY 
            year, month_name, month_number 
        ORDER BY 
            month_number DESC  
        LIMIT 5;
    ";

    $stmt = $pdo->prepare($query);
    $stmt->execute();
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $data = [];
    foreach ($results as $row) {
        $data[] = [
            'year' => htmlspecialchars($row['year']), 
            'month_name' => htmlspecialchars($row['month_name']), 
            'month_number' => htmlspecialchars($row['month_number'])
        ];
    }

    echo json_encode($data);
?>