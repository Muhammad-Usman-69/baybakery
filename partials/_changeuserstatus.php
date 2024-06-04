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
    header("location: ../admin?user=1&error=Not Defined");
    exit();
}

$id = $_GET["id"];
$status = $_GET["status"];

//check if admin is doing it himself
if ($_GET["status"] != 1 && $_GET["status"] != 0) {
    header("location: ../admin?user=1&error=Can't Change");
    exit();
}

//deleting
$sql = "UPDATE `users` SET `admin` = ? WHERE `id` = ?";
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "ss", $status, $id);
$bool = mysqli_stmt_execute($stmt);
if ($bool) {
    //reedirecting for normal
    header("location: ../admin?user=1&alert=Changed Successfully");
    exit();
}