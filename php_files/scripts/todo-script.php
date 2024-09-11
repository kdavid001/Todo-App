<?php
session_start();
include("../db/connect.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $task = $_POST["name"];
    $status = $_POST["status"];
    if ($task == "") {
        header("Location: ../scripts/To-do.php?message=Task cannot be empty");
        exit();
    }
    $user_id = $_SESSION["user_id"];
    $query = "INSERT INTO Tasks(user_id, name, status) VALUES('$user_id' ,'$task', '$status')";
    $result = mysqli_query($conn, $query);
    $rows = mysqli_affected_rows($conn);
    $id = mysqli_insert_id($conn);
    echo json_encode(["id" => $id]);
    // var_dump($rows)
    // header("Location: ../scripts/To-do.php");
}
