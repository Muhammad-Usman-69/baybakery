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
if (!isset($_GET["id"]) || !isset($_GET["feature"])) {
    header("location: ../admin?product=1&error=Not Defined");
    exit();
}

$id = $_GET["id"];
$feature = $_GET["feature"];

//verify if product exist
$sql = "SELECT * FROM `products` WHERE `id` = ?";
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "s", $id);
mysqli_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$num = mysqli_num_rows($result);
if ($num == 0) {
    header("location: /admin?product=1&error=Product Not Found");
    exit();
}

//deleting
$sql = "UPDATE `products` SET `feature` = ? WHERE `id` = ?";
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "ss", $feature, $id);
$bool = mysqli_stmt_execute($stmt);
if ($bool) {
    //reedirecting for normal
    header("location: ../admin?product=1&alert=Changed Successfully");
    exit();
}