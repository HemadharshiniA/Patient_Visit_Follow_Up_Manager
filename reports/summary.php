<?php
require("../config/db.php");
require("../includes/header.php");

$sql = "SELECT patients.name,
TIMESTAMPDIFF(YEAR,dob,CURDATE()) AS age,
COUNT(visits.visit_id) AS total_visits,
MAX(visit_date) AS last_visit,
DATEDIFF(CURDATE(),MAX(visit_date)) AS days_since_last_visit,
MAX(follow_up_due) AS next_followup

FROM patients

LEFT JOIN visits
ON patients.patient_id = visits.patient_id

GROUP BY patients.patient_id";

$result = mysqli_query($conn,$sql);
?>

<h2 class="bg-custom">Full Summary Report</h2>

<table class="table table-bordered table-striped table-hover">
<tr>
    <th>Name</th>
    <th>Age</th>
    <th>Total Visits</th>
    <th>Last Visit</th>
    <th>Days Since Last Visit</th>
    <th>Next Followup</th>
</tr>

<?php
while($row = mysqli_fetch_assoc($result)){
?>

<tr>
<td><?php echo $row['name']; ?></td>
<td><?php echo $row['age']; ?></td>
<td><?php echo $row['total_visits']; ?></td>
<td><?php echo $row['last_visit']; ?></td>
<td><?php echo $row['days_since_last_visit']; ?></td>
<td><?php echo $row['next_followup']; ?></td>
</tr>

<?php
}
?>

</table>

<?php
include("../includes/footer.php");
?>