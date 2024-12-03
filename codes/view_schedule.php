<?php include 'db_connect.php'; ?>
<?php
if (isset($_GET['id'])) {
    $qry = $conn->query("SELECT schedules.*, faculties.name as faculty_name FROM schedules 
        LEFT JOIN faculties ON schedules.faculty_id = faculties.id WHERE schedules.id=" . $_GET['id'])->fetch_array();
    
    foreach ($qry as $k => $v) {
        $$k = $v;
    }
}
?>

<div class="container-fluid">
    <p>Faculty: <b><?php echo ucwords($faculty_name) ?></b></p>
    <p>Subject: <b><?php echo $subject ?></b></p>
    <p>Section: <b><?php echo $section ?></b></p>
    <p>Room Type: <b><?php echo $location ?></b></p>
    <p>Time Start: <b><?php echo date('h:i A', strtotime($time_from)) ?></b></p>
    <p>Time End: <b><?php echo date('h:i A', strtotime($time_to)) ?></b></p>
</div>
