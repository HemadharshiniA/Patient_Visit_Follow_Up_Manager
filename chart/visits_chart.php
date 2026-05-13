<?php
require("../config/db.php");

$sql = "SELECT
DATE_FORMAT(visit_date,'%Y-%m') AS month,
COUNT(visit_id) AS total_visits

FROM visits

GROUP BY DATE_FORMAT(visit_date,'%Y-%m')";

$result = mysqli_query($conn,$sql);

$months = [];
$visits = [];

while($row = mysqli_fetch_assoc($result)){

    $months[] = $row['month'];
    $visits[] = $row['total_visits'];
}
?>

<!DOCTYPE html>
<html>
<head>

<title>Visits Chart</title>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

</head>
<body>

<div class="container mt-5">

<h2 class="mb-4 text-center">
Monthly Visits Chart
</h2>

<canvas id="visits_Chart"></canvas>

</div>

<script>

const ctx = document.getElementById('visits_Chart');

new Chart(ctx, {
    type: 'bar',
    data: {
        labels: <?php echo json_encode($months); ?>,
        datasets: [{
            label: 'Visits',
            data: <?php echo json_encode($visits); ?>,
            borderWidth: 1
        }]
    }
});

</script>

</body>
</html>