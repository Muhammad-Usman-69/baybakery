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
if (!isset($_GET["id"]) || !isset($_GET["status"])) {
    header("location: ../admin?error=Not Defined");
    exit();
}

$id = $_GET["id"];
$status = $_GET["status"];

//verify if product exist
$sql = "SELECT * FROM `products` WHERE `id` = ?";
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "s", $id);
mysqli_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$num = mysqli_num_rows($result);
if ($num == 0) {
    header("location: /?error=Product Not Found");
    exit();
}

//deleting
$sql = "UPDATE `products` SET `status` = ? WHERE `id` = ?";
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "ss", $status, $id);
$bool = mysqli_stmt_execute($stmt);
if ($bool) {
    //reedirecting for normal
    header("location: ../admin?alert=Changed Successfully");
    exit();
}