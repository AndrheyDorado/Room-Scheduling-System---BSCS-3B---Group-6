<?php
function check_conflict($schedule_id, $time_from, $time_to, $location) {
    global $conn;
    $conflict_query = $conn->query("
        SELECT * FROM schedules 
        WHERE location = '$location' 
        AND id != '$schedule_id' 
        AND (
            ('$time_from' BETWEEN time_from AND time_to) 
            OR ('$time_to' BETWEEN time_from AND time_to) 
            OR (time_from BETWEEN '$time_from' AND '$time_to')
        )
    ");
    return $conflict_query->num_rows > 0;
}
?>
