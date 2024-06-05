<?php
session_start();
//checking if logged
if (!isset($_SESSION["logged"]) && $_SESSION["logged"] != true) {
    header("location:/?error=Not logged in");
    exit();
}

include ("_dbconnect.php");

//taking order id
if (!isset($_GET["orderid"])) {
    header("location: ../admin?order=1&error=Not Defined");
    exit();
}

$id = $_GET["orderid"];
$user_id = $_SESSION["id"];

//check if order exist and is uncomplete
$sql = "SELECT * FROM `orders` WHERE `id` = ? AND `status` = 0";
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "s", $id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$num = mysqli_num_rows($result);
if ($num == 0) {
    if ($_SESSION["status"] == "user") {
        header("location: ../user?error=Order doesn't exist or is completed");
        exit();
    }
    
    header("location: ../admin?order=1&error=Order doesn't exist or is completed");
    exit();
}

//deleting
if ($_SESSION["status"] == "user") {
    $sql = "DELETE FROM `orders` WHERE `id` = ? AND `userid` = ?";
} else {
    $sql = "DELETE FROM `orders` WHERE `id` = ?";
}

$stmt = mysqli_prepare($conn, $sql);

if ($_SESSION["status"] == "user") {
    mysqli_stmt_bind_param($stmt, "ss", $id, $user_id);
} else {
    mysqli_stmt_bind_param($stmt, "s", $id);
}

mysqli_stmt_execute($stmt);

if ($_SESSION["status"] == "user") {
    header("location: ../user?alert=Cancelled Successfully");
    exit();
}

header("location: ../admin?order=1&alert=Cancelled Successfully");
exit();