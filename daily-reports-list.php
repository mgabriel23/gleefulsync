<?php
    header('Content-Type: application/json');
    header('Cache-Control: no-cache');

    include 'connection.php';

    $query = "
        SELECT 
            a.batch_id, 
            c.title AS batch_title, 
            DATE(a.date_created) AS report_date, 
            TIME(b.start_time) AS start_time 
        FROM 
            attendance_tbl a 
        INNER JOIN 
            batches_tbl b ON a.batch_id = b.id 
        INNER JOIN 
            gatherings_tbl c ON b.gathering_id = c.id 
        GROUP BY 
            report_date, a.batch_id, b.start_time 
        ORDER BY 
            start_time DESC 
        LIMIT 5;
    ";

    $stmt = $pdo->prepare($query);
    $stmt->execute();
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $data = [];
    foreach ($results as $row) {
        $time = DateTime::createFromFormat('H:i:s', $row['start_time']);
        $formattedTime = $time->format('h:i a');
    
        $data[] = [
            'batch_id' => htmlspecialchars($row['batch_id']),
            'batch_title' => htmlspecialchars($row['batch_title']),
            'report_date' => htmlspecialchars($row['report_date']),
            'start_time' => $formattedTime,
        ];
    }
    
    echo json_encode($data);
?>