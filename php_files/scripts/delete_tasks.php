<?php
include("../db/connect.php");
if (isset($_GET['id'])) {
    $task_id = $_GET['id'];
    $query = "DELETE FROM Tasks WHERE id = $task_id";
    $done = mysqli_query($conn, $query);
    echo"$query";
    header("Location: ../scripts/To-do.php");
}

// echo"5";
// echo"6"; 
// echo"7";