<?php 
$host = "localhost";
$user="root";
$password = "";
$db = "my_database";

$conn = mysqli_connect($host, $user, $password, $db);

if(mysqli_connect_errno()) {
    echo "Couldn't connect to database". mysqli_connect_error();
    die();
}
?>
