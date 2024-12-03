<?php include('db_connect.php'); ?>

<?php
if (isset($_POST['save_schedule'])) {
    // Get POST data
    $faculty_id = $_POST['faculty_id'];
    $subject = $_POST['subject'];
    $section = $_POST['section'];
    $location = $_POST['location'];
    $time_from = $_POST['time_from'];
    $time_to = $_POST['time_to'];

    // Check if faculty_id is selected
   if (isset($_POST['save_schedule'])) {
    // Get POST data
    $faculty_id = $_POST['faculty_id'];
    // Debugging output to confirm faculty_id
    echo "<script>console.log('Selected Faculty ID: $faculty_id');</script>";

    // Check if the faculty_id exists in the faculty table
    $faculty_check = $conn->query("SELECT * FROM faculty WHERE id = '$faculty_id'");
    
    if ($faculty_check->num_rows === 0) {
        echo "<script>alert('Selected faculty does not exist.');</script>";
    } else {
        // Proceed to insert the schedule
        $stmt = $conn->prepare("INSERT INTO schedules (faculty_id, subject, section, location, time_from, time_to) VALUES (?, ?, ?, ?, ?, ?)");
            
            if ($stmt) {
                $stmt->bind_param("ssssss", $faculty_id, $subject, $section, $location, $time_from, $time_to);
                if ($stmt->execute()) {
    echo "<script>alert('Schedule added successfully!');</script>";
} else {
    echo "<script>alert('Error adding schedule: " . $stmt->error . "');</script>";
}
                $stmt->close();
            } else {
                echo "<script>alert('Error preparing statement: " . $conn->error . "');</script>";
            }
        }
    }
}
?>

<form method="POST">
    <div class="form-group">
    <label for="faculty_id">Faculty</label>
    <select name="faculty_id" id="faculty_id" class="form-control" required>
        <option value="">Select Faculty</option>
        <?php
        $faculties = $conn->query("SELECT * FROM faculty");
        while ($row = $faculties->fetch_assoc()):
        ?>
            <option value="<?php echo $row['id']; ?>"><?php echo $row['lastname']; ?></option>
        <?php endwhile; ?>
    </select>
</div>
    <div class="form-group">
        <label for="subject">Subject</label>
        <input type="text" name="subject" id="subject" class="form-control" required>
    </div>
    <div class="form-group">
        <label for="section">Section</label>
        <input type="text" name="section" id="section" class="form-control" required>
    </div>
    <div class="form-group">
        <label for="location">Room</label>
        <select name="location" id="location" class="form-control" required>
            <option value="">Select Room</option>
            <option value="Lecture room">Lecture room</option>
            <option value="Lab">Lab</option>
            <option value="Seminar room">Seminar room</option>
            <!-- Add more room types as necessary -->
        </select>
    </div>
    <div class="form-group">
        <label for="time_from">Time From</label>
        <input type="time" name="time_from" id="time_from" class="form-control" required>
    </div>
    <div class="form-group">
        <label for="time_to">Time To</label>
        <input type="time" name="time_to" id="time_to" class="form-control" required>
    </div>
    <button type="submit" name="save_schedule" class="btn btn-primary">Save</button>
</form>