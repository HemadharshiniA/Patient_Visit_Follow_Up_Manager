<?php
require("../config/db.php");
require("../includes/header.php");

$id = $_POST['id'];

$sql = "SELECT patients.name,
COUNT(visits.visit_id) AS total_visits,
MIN(visit_date) AS first_visit,
MAX(visit_date) AS last_visit,
DATEDIFF(MAX(visit_date),MIN(visit_date)) AS total_days_between

FROM visits

INNER JOIN patients
ON visits.patient_id = patients.patient_id

WHERE patients.patient_id=?";

$stmt = mysqli_prepare($conn,$sql);

mysqli_stmt_bind_param($stmt,"i",$id);

mysqli_stmt_execute($stmt);

$result = mysqli_stmt_get_result($stmt);

$row = mysqli_fetch_assoc($result);
?>

<h2  class="bg-custom">Patient Visit History</h2>

<p>Name : <?php echo $row['name']; ?></p>
<p>Total Visits : <?php echo $row['total_visits']; ?></p>
<p>First Visit : <?php echo $row['first_visit']; ?></p>
<p>Last Visit : <?php echo $row['last_visit']; ?></p>
<p>Total Days Between : <?php echo $row['total_days_between']; ?></p>

<?php
include("../includes/footer.php");
?>