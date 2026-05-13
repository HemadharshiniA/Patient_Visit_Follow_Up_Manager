<?php
require("../config/db.php");
require("../includes/header.php");

$sql = "SELECT name, dob,
TIMESTAMPDIFF(YEAR,dob,CURDATE()) AS current_age,
YEAR(CURDATE()) - YEAR(dob) AS turning_age

FROM patients

WHERE DATE_FORMAT(dob,'%m-%d')
BETWEEN DATE_FORMAT(CURDATE(),'%m-%d')
AND DATE_FORMAT(DATE_ADD(CURDATE(),INTERVAL 30 DAY),'%m-%d')";

$result = mysqli_query($conn,$sql);
?>

<h2  class="bg-custom">Birthday Report</h2>

<table class="table table-bordered table-hover">
<tr>
    <th>Name</th>
    <th>DOB</th>
    <th>Current Age</th>
    <th>Turning Age</th>
</tr>

<?php
while($row = mysqli_fetch_assoc($result)){
?>

<tr>
<td><?php echo $row['name']; ?></td>
<td><?php echo $row['dob']; ?></td>
<td><?php echo $row['current_age']; ?></td>
<td><?php echo $row['turning_age']; ?></td>
</tr>

<?php
}
?>

</table>

<?php
include("../includes/footer.php");
?>