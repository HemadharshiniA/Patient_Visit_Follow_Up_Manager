<!DOCTYPE html>
<html>
<head>
    <title>Healthcare Mini System</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>

        body{
            background-color:#f5f5f5;
        }

        .navbar{
            padding:15px;
        }
        #row{
            color:#f5f5f5;
        }
        .container-box{
            background:white;
            padding:20px;
            border-radius:10px;
            margin-top:20px;
            box-shadow:0px 0px 10px rgba(0,0,0,0.1);
        }
        .bg-custom{
            background-color:#d8f3dc;
        }
        .custom-bg{
            background-color:#d8f3dc;
        }
    </style>

</head>

<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-success">

<div class="container-fluid d-flex flex-column align-items-center">

<a class="navbar-brand text-light fs-2 fw-bold text-center mb-3" href="/patient_visit_follow_up/index.php">
Healthcare Mini System
</a>

<div>

<a class="btn btn-outline-light btn-sm me-4" href="/patient_visit_follow_up/index.php">
Home
</a>

<a class="btn btn-outline-light btn-sm me-4" href="/patient_visit_follow_up/patients/add.php">
Add Patient
</a>

<a class="btn btn-outline-light btn-sm me-4" href="/patient_visit_follow_up/patients/list.php">
Patients
</a>

<a class="btn btn-outline-light btn-sm me-4" href="/patient_visit_follow_up/visits/add.php">
Add Visit
</a>

<a class="btn btn-outline-light btn-sm me-4" href="/patient_visit_follow_up/visits/list.php">
Visits
</a>


<a class="btn btn-outline-light btn-sm me-4" href="/patient_visit_follow_up/reports/follow_ups.php">
Follow ups
</a>

<a class="btn btn-outline-light btn-sm me-4" href="/patient_visit_follow_up/reports/monthly.php">
Monthly
</a>

<a class="btn btn-outline-light btn-sm me-4" href="/patient_visit_follow_up/reports/birthdays.php">
Birthdays
</a>

<a class="btn btn-outline-light btn-sm me-4" href="/patient_visit_follow_up/reports/summary.php">
Summary
</a>

<a href="/Patient_Visit_Follow_Up/chart/visits_chart.php" class="btn btn-outline-light btn-sm me-4">
Visits Chart
</a>

<a href="/Patient_Visit_Follow_Up/auth/logout.php" class="btn btn-outline-light btn-sm me-8">
Logout
</a>

</div>

</div>

</nav>

<div class="container">

<div class="container-box">