<?php
session_start();
include("../db/connect.php");
    $_SESSION["status"] = $status;
    $id = $_SESSION["user_id"];
    $query = "SELECT * FROM Tasks WHERE user_id = $id";

    $result = mysqli_query($conn, $query);
    $rows = mysqli_num_rows($result);

    $tasks = array();
    while($task = mysqli_fetch_assoc($result)){
        array_push($tasks, $task);
    }
    // var_dump($tasks);
    echo json_encode($tasks)


?>
