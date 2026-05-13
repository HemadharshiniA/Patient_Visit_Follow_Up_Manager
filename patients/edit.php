<?php
// session_start();
require("../auth/verify_access.php");
require("../config/db.php");
require("../includes/header.php");

if(isset($_POST['patient_id']))
    {
       $_SESSION['patient_id'] = $_POST['patient_id'];
    }
if(isset($_SESSION['patient_id']))
    {
    $id = $_SESSION['patient_id'];
    }
else{
    header("Location: list.php");
    exit();
}

$sql = "SELECT * FROM patients WHERE patient_id=?";

$stmt = mysqli_prepare($conn,$sql);

mysqli_stmt_bind_param($stmt,"i",$id);

mysqli_stmt_execute($stmt);

$result = mysqli_stmt_get_result($stmt);

$row = mysqli_fetch_assoc($result);

if(isset($_POST['update'])){

    $name = $_POST['name'];
    $dob = $_POST['dob'];
    $join_date = $_POST['join_date'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];

    $update_sql = "UPDATE patients
    SET
    name=?,
    dob=?,
    join_date=?,
    phone=?,
    address=?
    WHERE patient_id=?";

    $update_stmt = mysqli_prepare($conn,$update_sql);

    mysqli_stmt_bind_param($update_stmt,
    "sssssi",
    $name,
    $dob,
    $join_date,
    $phone,
    $address,
    $id
    );

    mysqli_stmt_execute($update_stmt);

    header("Location:list.php");
}
?>

<h2  class="bg-custom">Edit Patient</h2>

<form method="POST">

<input type="text" name="name" class="form-control" value="<?php echo $row['name']; ?>">

<input type="date" name="dob" class="form-control" value="<?php echo $row['dob']; ?>">

<input type="date" name="join_date" class="form-control" value="<?php echo $row['join_date']; ?>">

<input type="text" name="phone" class="form-control" value="<?php echo $row['phone']; ?>">

<textarea name="address" class="form-control"><?php echo $row['address']; ?></textarea>

<input type="submit" name="update"
value="Update Patient"
class="btn btn-success">

</form>

<?php
include("../includes/footer.php");
?>