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
if (!isset($_GET["name"]) || !isset($_GET["status"])) {
    header("location: ../admin?error=Not Defined");
    exit();
}

$name = $_GET["name"];
$status = $_GET["status"];

//verify if product exist
$sql = "SELECT * FROM `categories` WHERE `name` = ?";
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "s", $name);
mysqli_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$num = mysqli_num_rows($result);
if ($num == 0) {
    header("location: /?error=Product Not Found");
    exit();
}

//updating category
$sql = "UPDATE `categories` SET `status` = ? WHERE `name` = ?";
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "ss", $status, $name);
mysqli_stmt_execute($stmt);

//updating status
$sql = "UPDATE `products` SET `status` = ? WHERE `category` = ?";
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "ss", $status, $name);
$bool = mysqli_stmt_execute($stmt);

//reedirecting for normal
header("location: ../admin?alert=Changed Successfully");
exit();