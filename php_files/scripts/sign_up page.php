<?php
include("../db/connect.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // echo "hello";
    $email = $_POST["input-name"];
    $password = $_POST["input-password"];
    $surname = $_POST["input-surname"];
    $lname = $_POST["input-lname"];
    $hashed_password = md5($password);

    if ($email == "" || $password == "" || $email == "" || $password == "") {
      header("Location: ../sign_up_page.php?error=ensure you the fill all the fields");
      exit();
    }

    $query = "SELECT * FROM Log_in WHERE email = '$email'";
    $result = mysqli_query($conn, $query);
    $rows = mysqli_num_rows($result);

    if($rows > 0){
      header("Location: ../sign_up_page.php?error=Email already Exist");
      exit();
    }
    
    $query = "INSERT INTO Log_in (surname, last_name, email, pass_word) VALUES ('$surname', '$lname', '$email', '$hashed_password');";
    $query_email = "SELECT email FROM Log_in WHERE email = '$email';";
    $result = mysqli_query($conn, $query);
    header("Location: ../return_to_login_page.html"); 
}
