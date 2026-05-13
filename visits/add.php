<?php
require("../auth/verify_access.php");
require("../config/db.php");
require("../includes/header.php");

if(isset($_POST['submit'])){

    $patient_id = $_POST['patient_id'];
    $visit_date = $_POST['visit_date'];
    $consultation_fee = $_POST['consultation_fee'];
    $lab_fee = $_POST['lab_fee'];

    $sql = "INSERT INTO visits(patient_id, visit_date,
    consultation_fee,lab_fee,follow_up_due)

    VALUES(?,?,?,?,DATE_ADD(?,INTERVAL 7 DAY))";

    $stmt = mysqli_prepare($conn,$sql);

    mysqli_stmt_bind_param($stmt, "isdds",
    $patient_id, $visit_date, $consultation_fee,
    $lab_fee, $visit_date);

    mysqli_stmt_execute($stmt);

    echo "Visit Added Successfully...!!";
}

$patient_sql = "SELECT * FROM patients";
$patient_result = mysqli_query($conn,$patient_sql);
?>

<h2  class="bg-custom">Add Visit</h2>

<form method="POST">

<select name="patient_id" class="form-select">

<?php
while($patient = mysqli_fetch_assoc($patient_result)){
?>

<option value="<?php echo $patient['patient_id']; ?>">
    <?php echo $patient['name']; ?>
</option>

<?php
}
?>

</select>

<input type="date" name="visit_date" class="form-control" required>

<input type="number" step="0.01" name="consultation_fee" class="form-control" placeholder="Consultation Fee">

<input type="number" step="0.01" name="lab_fee" class="form-control" placeholder="Lab Fee">

<input type="submit" name="submit" value="Add Visit" class="btn btn-success">

</form>

<?php
include("../includes/footer.php");
?>