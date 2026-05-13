<?php
require("../config/db.php");
require("../includes/header.php");

$id = $_POST['id'];

$sql = "SELECT patients.name, patients.phone, patients.address,
TIMESTAMPDIFF(YEAR,dob,CURDATE()) AS age,
MAX(visits.visit_date) AS last_visit,
DATEDIFF(CURDATE(),MAX(visits.visit_date)) AS days_since_last_visit,
MAX(visits.follow_up_due) AS next_follow_up,
CASE
WHEN MAX(visits.follow_up_due) < CURDATE()
THEN 'Overdue'
ELSE 'Upcoming'
END AS follow_up_status

FROM patients

LEFT JOIN visits
ON patients.patient_id = visits.patient_id

WHERE patients.patient_id=?";

$stmt = mysqli_prepare($conn,$sql);

mysqli_stmt_bind_param($stmt,"i",$id);

mysqli_stmt_execute($stmt);

$result = mysqli_stmt_get_result($stmt);

$row = mysqli_fetch_assoc($result);
?>

<h2  class="bg-custom">Patient Details</h2>

<p>Name : <?php echo $row['name']; ?></p>
<p>Phone : <?php echo $row['phone']; ?></p>
<p>Address : <?php echo $row['address']; ?></p>
<p>Age : <?php echo $row['age']; ?></p>
<p>Last Visit : <?php echo $row['last_visit']; ?></p>
<p>Days Since Last Visit : <?php echo $row['days_since_last_visit']; ?></p>
<p>Next Follow_up : <?php echo $row['next_follow_up']; ?></p>
<p>Status : <?php echo $row['follow_up_status']; ?></p>

<?php
include("../includes/footer.php");
?>