<?php
require("../auth/verify_access.php");
require("../config/db.php");
require("../includes/header.php");

if(isset($_POST['submit'])){

    $name = $_POST['name'];
    $dob = $_POST['dob'];
    $join_date = $_POST['join_date'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];

    //validation

    // $sql_check = "SELECT dob FROM patients WHERE dob > CURDATE()";

    if($dob > date('Y-m-d')){
        echo "DOB cannot be future date";
    }
    else{

        $sql = "INSERT INTO patients(name,dob,join_date,phone,address)
                VALUES(?,?,?,?,?)";

        $stmt = mysqli_prepare($conn,$sql);

        mysqli_stmt_bind_param($stmt,"sssss",
        $name,
        $dob,
        $join_date,
        $phone,
        $address
        );

        mysqli_stmt_execute($stmt);

        echo "Patient Added Successfully...!!!";
    }
}
?>

<h2  class="bg-custom">Add Patient</h2>

<form method="POST" class="mt-4">

    Name
    <input type="text" name="name" class="form-control" required>

    DOB
    <input type="date" name="dob" class="form-control" required>

    Join Date
    <input type="date" name="join_date" class="form-control" required>

    Phone
    <input type="text" name="phone"  class="form-control" required>

    Address
    <textarea name="address" class="form-control" required></textarea>

    <input type="submit" name="submit" value="Add Patient" class="btn btn-success">

</form>

<?php
include("../includes/footer.php");
?>