<?php

$host = "localhost";
$user = "root";
$password = "";
$database = "healthcare_mini_system";
$port = 3307; 

$conn = mysqli_connect($host, $user, $password, $database,$port);

if(!$conn)
{
    die("Connection Failed : " . mysqli_connect_error());
}
// else{
//     echo "Success";
// }

?>