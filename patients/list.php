<?php
session_start();

require("../config/db.php");
require("../includes/header.php");

//pagination

$limit = 5;
$page = isset($_GET['page']) ? $_GET['page'] : 1;

$start = ($page - 1) * $limit;
$search = "";

//filters
$search="";
$year="";

// if($_SERVER['REQUEST_METHOD'] == "POST")
//     {
        if(isset($_POST['search_btn'])){

            $search = $_POST['search'];
        }
    // }

if(isset($_POST['year']) && $_POST['year'] != ''){

    $year = $_POST['year'];
}

$sql = "SELECT patients.*,
TIMESTAMPDIFF(YEAR,dob,CURDATE()) AS age,
CONCAT(TIMESTAMPDIFF(YEAR,dob,CURDATE()),
' Years ',
TIMESTAMPDIFF(MONTH,dob,CURDATE()) % 12,
' Months') AS full_age,
YEAR(join_date) AS join_year,
MONTH(join_date) AS join_month,
DAY(join_date) AS join_day,
COUNT(visits.visit_id) AS total_visits

FROM patients

LEFT JOIN visits
ON patients.patient_id = visits.patient_id
WHERE patients.name LIKE '%$search%' ";

// -- GROUP BY patients.patient_id
// -- LIMIT $start,$limit";

//filter

if($year != "")
    {
        $sql.= " AND YEAR(join_date) = $year";
    }

//group by + limit

$sql.= " GROUP BY patients.patient_id
         LIMIT $start,$limit";

//execute

$result = mysqli_query($conn,$sql);
?>

<form method="POST" class="mb-3">

<div class="row g-2 align-items-center">

<div class="col-md-4">

<input type="text"
name="search"
class="form-control"
placeholder="Search Patient Name"
value="<?php echo $search; ?>">

</div>

<div class="col-md-3">

<select name="year" class="form-select">

<option value="">Select Join Year</option>
<option value="2025">2025</option>
<option value="2026">2026</option>

</select>

</div>

<div class="col-md-2">

<button type="submit" name="search_btn" class="btn btn-success w-100">
Search
</button>

</div>

</div>
</form>

<!-- 
<div class="d-flex align-items-center gap-4">
<button type="submit" class="btn btn-success ">
Filter
</button>
</div>
</form> -->

<h2  class="bg-custom">Patients List</h2>

<table class="table table-bordered table-striped table-hover">

<tr class="custom-bg">
    <th >ID</th>
    <th >Name</th>
    <th >Age</th>
    <th >Full Age</th>
    <th >Join Year</th>
    <th >Join Month</th>
    <th >Join Day</th>
    <th >Total Visits</th>
    <th >Action</th>
</tr>

<?php
while($row = mysqli_fetch_assoc($result)){
?>

<tr>
    <td><?php echo $row['patient_id']; ?></td>
    <td><?php echo $row['name']; ?></td>
    <td><?php echo $row['age']; ?></td>
    <td><?php echo $row['full_age']; ?></td>
    <td><?php echo $row['join_year']; ?></td>
    <td><?php echo $row['join_month']; ?></td>
    <td><?php echo $row['join_day']; ?></td>
    <td><?php echo $row['total_visits']; ?></td>

    <td>
        <form action="view.php" method="POST" class="d-inline">
        <input type="hidden" name="id" value="<?php echo $row['patient_id']; ?>">

        <button type="submit" 
        class="btn btn-success btn-sm me-4">View</button>
    </form>

        <form action="edit.php" method="POST" class="d-inline">
           <input type="hidden" name="patient_id" value="<?php echo $row['patient_id']; ?>">

            <button type="submit" 
             class="btn btn-success btn-sm me-4">Edit</button>
        </form>
        <!-- <a class="btn btn-success btn-sm me-4" href="view.php?id=<?php echo $row['patient_id']; ?>">View</a>
        <a class="btn btn-success btn-sm me-4" href="edit.php?id=<?php echo $row['patient_id']; ?>">Edit</a> -->
    </td>
</tr>

<?php
}
?>

</table>

<?php
include("../includes/footer.php");


$total_query = "SELECT COUNT(*) AS total FROM patients";

$total_result = mysqli_query($conn,$total_query);

$total_row = mysqli_fetch_assoc($total_result);

$total_pages = ceil($total_row['total'] / $limit);
?>

<div class="text-center mt-4">

<?php
for($i=1; $i<=$total_pages; $i++){
?>

<a href="list.php?page=<?php echo $i; ?>"
class="btn btn-outline-success btn-sm me-2">

<?php echo $i; ?>

</a>

<?php
}
?>
</div>

