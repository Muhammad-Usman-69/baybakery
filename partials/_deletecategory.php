<?php
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

//taking order id
if (!isset($_GET["name"])) {
    header("location: /admin?category=1&error=Not Defined");
    exit();
}

$name = $_GET["name"];

//verify if category exist
$sql = "SELECT * FROM `categories` WHERE `name` = ?";
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "s", $name);
mysqli_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$num = mysqli_num_rows($result);
if ($num == 0) {
    header("location: /admin?category=1&error=Category Not Found");
    exit();
}

//deleting
$sql = "DELETE FROM `categories` WHERE `name` = ?";
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "s", $name);
$bool = mysqli_stmt_execute($stmt);
if ($bool) {
    //reedirecting for normal
    header("location: ../admin?category=1&alert=Deleted Successfully");
    exit();
}