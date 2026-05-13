<?php
require("../config/db.php");
require("../includes/header.php");

$sql = "SELECT patients.name, visit_date, follow_up_due,
CASE
WHEN follow_up_due < CURDATE()
THEN 'Overdue'
WHEN follow_up_due BETWEEN CURDATE() AND DATE_ADD(CURDATE(),INTERVAL 7 DAY)
THEN 'Upcoming'
ELSE 'Normal'
END AS status

FROM visits

INNER JOIN patients
ON visits.patient_id = patients.patient_id";

$result = mysqli_query($conn,$sql);
?>

<h2  class="bg-custom">Follow_up Report</h2>

<table class="table table-bordered table-hover">
<tr>
    <th>Patient</th>
    <th>Visit Date</th>
    <th>Follow_up Due</th>
    <th>Status</th>
</tr>

<?php
while($row = mysqli_fetch_assoc($result)){
?>

<tr>
<td><?php echo $row['name']; ?></td>
<td><?php echo $row['visit_date']; ?></td>
<td><?php echo $row['follow_up_due']; ?></td>
<td><?php echo $row['status']; ?></td>
</tr>

<?php
}
?>

</table>

<?php
include("../includes/footer.php");
?>