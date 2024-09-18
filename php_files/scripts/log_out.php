<?php
session_start();
include("../db/connect.php");
$conn->close();
session_unset();
session_destroy();
header("location: ../login.php");
