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
if (!isset($_POST["category"]) || !isset($_POST["old_name"])) {
    header("location: ../admin?category=1&error=Not Defined");
    exit();
}
$name = $_POST["category"];
$old_name = $_POST["old_name"];

//verify if category exist
$sql = "SELECT * FROM `categories` WHERE `name` = ?";
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "s", $old_name);
mysqli_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$num = mysqli_num_rows($result);
if ($num == 0) {
    header("location: /?category=1&error=Category Not Found");
    exit();
}

//updating
$sql = "UPDATE `categories` SET `name` = ? WHERE `name` = ?";
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "ss", $name, $old_name);
mysqli_stmt_execute($stmt);

//updating product's categories
$sql = "UPDATE `products` SET `category` = ? WHERE `category` = ?";
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "ss", $name, $old_name);
mysqli_stmt_execute($stmt);

//reedirecting for normal
header("location: ../admin?category=1&alert=Updated Successfully");
exit();
