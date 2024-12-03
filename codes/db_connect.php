<?php
$conn = new mysqli('localhost', 'root', '', 'scheduling_db');
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
