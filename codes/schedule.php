<?php include('db_connect.php'); ?>
<div class="container-fluid">
    <div class="col-lg-12">
        <div class="row mb-4 mt-4">
            <div class="col-md-12"></div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <b>Room Schedules</b>
                        <span class="float:right">
                            <button class="btn btn-primary btn-block btn-sm col-sm-2 float-right" id="new_schedule" data-toggle="modal" data-target="#scheduleModal">
                                <i class="fa fa-plus"></i> New Entry
                            </button>
                        </span>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Faculty</th>
                                    <th>Email</th>
                                    <th>Address</th>
                                    <th>Subject</th>
                                    <th>Section</th>
                                    <th>Room Type</th>
                                    <th>Time</th>
                                    <th>Status</th>
                                    <th>Action</th> <!-- Add Action column for delete -->
                                </tr>
                            </thead>
                            <tbody id="scheduleTableBody">
                                <?php
                                $schedules = $conn->query("SELECT schedules.*, faculty.lastname as faculty_name, faculty.email as faculty_email, faculty.address as faculty_address FROM schedules 
                                                            LEFT JOIN faculty ON schedules.faculty_id = faculty.id");

                                while ($row = $schedules->fetch_assoc()): ?>
                                    <tr id="row_<?php echo $row['id']; ?>">
                                        <td>
                                            <a href="view_schedule.php?id=<?php echo $row['id']; ?>">
                                                <?php echo $row['faculty_name'] ?>
                                            </a>
                                        </td>
                                        <td><?php echo $row['faculty_email']; ?></td>
                                        <td><?php echo $row['faculty_address']; ?></td>
                                        <td><?php echo $row['subject'] ?></td>
                                        <td><?php echo $row['section'] ?></td>
                                        <td><?php echo $row['location'] ?></td>
                                        <td><?php echo $row['time_from'] . ' - ' . $row['time_to'] ?></td>
                                        <td>
                                            <button class="btn btn-sm btn-outline-danger delete_schedule" type="button" onclick="deleteSchedule(<?php echo $row['id']; ?>)">Delete</button>
                                        </td>
                                    </tr>
                                <?php endwhile; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal for New Schedule -->
<div class="modal fade" id="scheduleModal" tabindex="-1" role="dialog" aria-labelledby="scheduleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="scheduleModalLabel">New Schedule</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <?php include 'manage_schedule.php'; ?>
            </div>
        </div>
    </div>
</div>

<script>
function deleteSchedule(id) {
    if (confirm("Are you sure you want to delete this schedule?")) {
        $.ajax({
            url: 'ajax.php?action=delete_schedule',
            method: 'POST',
            data: { id: id },
            success: function(response) {
                if (response == 1) {
                    alert('Schedule deleted successfully.');
                    // Remove the row from the table without reloading the page
                    $("#row_" + id).remove();
                } else {
                    alert('Error deleting schedule: ' + response);
                }
            }
        });
    }
}
</script>