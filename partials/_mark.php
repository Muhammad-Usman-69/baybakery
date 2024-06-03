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
if (!isset($_GET["orderid"]) || !isset($_GET["mark"])) {
    header("location: ../admin?error=Not Defined");
    exit();
}

$id = $_GET["orderid"];

//updating
$sql = "UPDATE `orders` SET `status` = ? WHERE `id` = ?";
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "is", $_GET["mark"], $id);
$bool = mysqli_stmt_execute($stmt);
if ($bool) {
    //reedirecting for normal
    header("location: ../orderdetails?orderid=$id");
    exit();
}