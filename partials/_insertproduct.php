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
if (!isset($_POST["title"]) || !isset($_POST["img"]) || !isset($_POST["old_price"]) || !isset($_POST["new_price"]) || !isset($_POST["category"]) || !isset($_POST["discount"])) {
    header("location: ../admin?product=1&error=Not Defined");
    exit();
}

//str for id
function random_str(
    $length,
    $keyspace = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ'
) {
    $str = '';
    $max = mb_strlen($keyspace, '8bit') - 1;
    if ($max < 1) {
        throw new Exception('$keyspace must be at least two characters long');
    }
    for ($i = 0; $i < $length; ++$i) {
        $str .= $keyspace[random_int(0, $max)];
    }
    return $str;
}

//getting data
$id = random_str(4);
$title = $_POST["title"];
$img = $_POST["img"];
$old_price = $_POST["old_price"];
$new_price = $_POST["new_price"];
$category = $_POST["category"];
$discount = $_POST["discount"];

//updating product's categories
$sql = "INSERT INTO `products` (`id`, `title`, `img`, `old_price`, `new_price`, `category`, `discount`) VALUES (?, ?, ?, ?, ?, ?, ?)";
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "sssiisi", $id, $title, $img, $old_price, $new_price, $category, $discount);
mysqli_stmt_execute($stmt);

//reedirecting for normal
header("location: ../admin?product=1&alert=Inserted Successfully");
exit();
