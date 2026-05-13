<?php
require("../config/db.php");
require("../includes/header.php");

$sql = "SELECT visits.*, patients.name,
DATEDIFF(CURDATE(),visit_date) AS days_since_visit,
CASE
WHEN follow_up_due < CURDATE() THEN 'Overdue'
WHEN follow_up_due = CURDATE() THEN 'Today'
ELSE 'Upcoming'
END AS followup_status

FROM visits

INNER JOIN patients
ON visits.patient_id = patients.patient_id";

$result = mysqli_query($conn,$sql);
?>

<h2  class="bg-custom">Visit List</h2>

<table class="table table-bordered table-striped">
<tr>
    <th>Visit ID</th>
    <th>Patient</th>
    <th>Visit Date</th>
    <th>Days Since Visit</th>
    <th>Followup Due</th>
    <th>Status</th>
    <th>Action</th>
</tr>

<?php
while($row = mysqli_fetch_assoc($result)){
?>

<tr>
<td><?php echo $row['visit_id']; ?></td>
<td><?php echo $row['name']; ?></td>
<td><?php echo $row['visit_date']; ?></td>
<td><?php echo $row['days_since_visit']; ?></td>
<td><?php echo $row['follow_up_due']; ?></td>
<td><?php echo $row['followup_status']; ?></td>

 <td>
        <form action="patient_visits.php" method="POST" class="d-inline">
        <input type="hidden" name="id" value="<?php echo $row['patient_id']; ?>">

        <button type="submit" 
        class="btn btn-success btn-sm me-4">Patient Visits</button>
    </form>
</td>
</tr>

<?php
}
?>

</table>

<!-- <a class="btn btn-outline-light btn-sm me-4" href="/patient_visit_follow_up/visits/patient_visits.php">
patient_visits
</a> -->

<?php
include("../includes/footer.php");
?>