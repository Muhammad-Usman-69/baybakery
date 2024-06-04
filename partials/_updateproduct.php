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

//taking id
if (!isset($_POST["id"])) {
    header("location: ../admin?product=1&error=Not Defined");
    exit();
}

$id = $_POST["id"];
$title = $_POST["title"];
$img = $_POST["img"];
$old_price = $_POST["old_price"];
$new_price = $_POST["new_price"];
$category = $_POST["category"];
$discount = $_POST["discount"];

//verify if product exist
$sql = "UPDATE `products` SET `title` = ?, `img` = ?, `old_price` = ?, `new_price` = ?, `category` = ?, `discount` = ? WHERE `id` = ?";
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "sssssss", $title, $img, $old_price, $new_price, $category, $discount, $id);
$bool = mysqli_stmt_execute($stmt);
if ($bool) {
    //reedirecting for normal
    header("location: ../admin?product=1&alert=Updated Successfully");
    exit();
}
