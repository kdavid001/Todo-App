<?php
session_start();


include("../db/connect.php");
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // echo "hello";
    $email = $_POST["input-name"];
    $password = $_POST["input-password"];
    $hashed_password = md5($password);
    $query = "SELECT * FROM Log_in WHERE email = '$email' AND pass_word = '$hashed_password'";
    $result = mysqli_query($conn, $query);
    $rows = mysqli_num_rows($result);
    $row = mysqli_fetch_assoc($result);
    $id = mysqli_insert_id($conn);
    $user_id = $row["id"];
    $name = $row["last_name"];
    $_SESSION["user_id"] = $user_id;
    $_SESSION["user_name"] = $name;
    // $query = "SELECT hashed_password FROM users WHERE email = ?";
    // || password_verify($password, $hashed_password) == true
    if ($rows > 0) {
        header("Location: ./To-do.php");
    } else {
        header("Location: ../login.php?error=User not found");
    }
}
