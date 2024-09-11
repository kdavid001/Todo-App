<?php
include("../db/connect.php");
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $status = $_POST['status'];
    $query = "UPDATE Tasks SET status = '$status' WHERE id = $id";
    $results = mysqli_query($conn, $query);
    $rows = mysqli_num_rows($results);
    header("Location: ../scripts/To-do.php");
};
