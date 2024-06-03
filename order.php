<?php
//check if req is post
if ($_SERVER["REQUEST_METHOD"] != "POST") {
    header("location: /signup?error=Access denied. Please try again later");
    exit();
}

session_start();
//checking if logged
if (!isset($_SESSION["logged"]) && $_SESSION["logged"] != true) {
    header("location:/?error=Not logged in");
    exit();
}

include ("partials/_dbconnect.php");

//str for order id
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

//taking diff values//time
date_default_timezone_set("Asia/Karachi");
$time = date("h:i:s a");
$order_id = random_str(12);
$userid = $_SESSION["id"];
$items = $_POST["item"];
$method = $_POST["method"];
$total = $_POST["totalprice"];
$delivery = $_POST["delivery"];
$location = $_POST["location"];
$status = 0;

//check if no item
if (!isset($_POST["item"])) {
    header("location:/cart?error=Item not specified.");
    exit();
}

//initiaing for order detials
$details = "";

//fetching item details
foreach ($items as $item) {
    $sql = "SELECT * FROM `products` WHERE `id` = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "s", $item);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    while ($row = mysqli_fetch_assoc($result)) {
        $title = $row["title"];
        $price = $row["new_price"];
        $id = $row["id"];
        $details .= "1x ($id) $title (Rs. $price) \n\n";
    }

    //removing from cart
    $sql = "DELETE FROM `cart` WHERE `product_id` = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "s", $item);
    mysqli_stmt_execute($stmt);
}

//inserting order to db
$sql = "INSERT INTO `orders` (`id`, `details`, `time`, `userid`, `method`, `price`, `delivery_price`, `delivery_location`, `status`) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "ssssssssi", $order_id, $details, $time, $userid, $method, $total, $delivery, $location, $status);
$result = mysqli_stmt_execute($stmt);
if (!$result) {
    header("location:/cart?error=An error occured. Plase try again later");
    exit();
}

//creating message
$message = "Your order has been placed\n\n" . $details . "Order ID: " . $order_id . "\nDelivery: Rs. " . $delivery . " \nTotal: Rs. " . $total . " \nPayment Method: " . $method . " \nLocation: " . $location . " \n\nThanks for shopping with us\nRegards, BayBakery";

echo $message;

header("content-type:json");
//sending message
// include ("sms.php");

header("location:/cart?alert=Your order has been placed. You will recieve a message soon");
exit();