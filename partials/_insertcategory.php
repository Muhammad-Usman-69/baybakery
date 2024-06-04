<?php

//check if server method is post
if ($_SERVER["REQUEST_METHOD"] != "POST") {
    header("location:/?error=Access denied");
    exit();
}

session_start();
//checking if logged
if (!isset($_SESSION["logged"]) && $_SESSION["logged"] != true) {
    header("location:/?error=Not logged in");
    exit();
}

//check if admin
if ($_SESSION["status"] != "admin") {
    header("location:/?error=Access Denied");
    exit();
}

include ("_dbconnect.php");

//taking name
if (!isset($_POST["name"])) {
    header("location: ../admin?error=Not Defined");
    exit();
}
$name = $_POST["name"];

//verify if category exist
$sql = "SELECT * FROM `categories` WHERE `name` = ?";
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "s", $name);
mysqli_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$num = mysqli_num_rows($result);
if ($num == 1) {
    header("location: /?error=Category Already Exists");
    exit();
}

//updating product's categories
$sql = "INSERT INTO `categories` (`name`) VALUE (?)";
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "s", $name);
mysqli_stmt_execute($stmt);

//reedirecting for normal
header("location: ../admin?alert=Inserted Successfully");
exit();
