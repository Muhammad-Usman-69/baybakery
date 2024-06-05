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
if (!isset($_POST["title"]) || !isset($_FILES["img"]) || !isset($_POST["old_price"]) || !isset($_POST["new_price"]) || !isset($_POST["category"]) || !isset($_POST["discount"])) {
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
// $img = $_POST["img"];
$old_price = $_POST["old_price"];
$new_price = $_POST["new_price"];
$category = $_POST["category"];
$discount = $_POST["discount"];

//taking file img
$file = $_FILES["img"];

//taking file properties
$fileName = $_FILES["img"]["name"];
$fileTmpName = $_FILES["img"]["tmp_name"]; //path of image
$fileSize = $_FILES["img"]["size"];
$fileError = $_FILES["img"]["error"];
$fileType = $_FILES["img"]["type"];

//take apart string when there is a punctation mark in filename
//we get an array for file name and extension
$fileExt = explode(".", $fileName);

//making it lower case and taking (last element) extension like .jpg
$fileActualExt = strtolower(end($fileExt));

//giving name of file type allowed
$allowed = ["jpg", "jpeg", "png"];

//check if file has extension which is allowed
if (!in_array($fileActualExt, $allowed)) {
    header("location: /admin?product=1&error=Unknown file type. Only allowed are jpg, jpeg and png");
    exit();
}

//check if there is any error in file uploaded
if ($fileError !== 0) {
    header("location: /admin?product=1&error=An error occured. Please upload again");
    exit();
}

//check file size
if ($fileSize > 5000000) {
    header("location: /admin?product=1&error=File too large. Maximum size is 5 MB");
    exit();
}

//giving file unique id (gives current time in number of ms) and adding ext to it
$fileNewName = uniqid("", true) . "." . $fileActualExt;

//giving destination for file
$fileDest = "../images/products/" . $fileNewName;

//now moving the file
$result = move_uploaded_file($fileTmpName, $fileDest);

//check if pasted
if ($result != true) {
    header("location: /admin?product=1&error=An error occured. Please upload again later");
    exit();
}

//updating product's categories
$sql = "INSERT INTO `products` (`id`, `title`, `img`, `old_price`, `new_price`, `category`, `discount`) VALUES (?, ?, ?, ?, ?, ?, ?)";
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "sssiisi", $id, $title, $fileDest, $old_price, $new_price, $category, $discount);
mysqli_stmt_execute($stmt);

//reedirecting for normal
header("location: ../admin?product=1&alert=Inserted Successfully");
exit();
