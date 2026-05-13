<?php
require("../config/db.php");
require("../includes/header.php");

$sql = "SELECT
DATE_FORMAT(visit_date,'%Y-%m') AS visit_month,
COUNT(visit_id) AS total_visits

FROM visits

GROUP BY DATE_FORMAT(visit_date,'%Y-%m')
ORDER BY visit_month DESC
LIMIT 6";

$result = mysqli_query($conn,$sql);
?>

<h2 class="bg-custom">Monthly Report</h2>

<table class="table table-bordered table-striped">
<tr>
    <th>Month</th>
    <th>Total Visits</th>
</tr>

<?php
while($row = mysqli_fetch_assoc($result)){
?>

<tr>
<td><?php echo $row['visit_month']; ?></td>
<td><?php echo $row['total_visits']; ?></td>
</tr>

<?php
}
?>

</table>

<?php
include("../includes/footer.php");
?>