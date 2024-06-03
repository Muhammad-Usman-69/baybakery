<?php
session_start();
//checking if logged
if (!isset($_SESSION["logged"]) && $_SESSION["logged"] != true) {
    header("location:/?error=Not logged in");
    exit();
}

$user_id = $_SESSION["id"];

//check if admin
if ($_SESSION["status"] != "admin") {
    header("location:/?error=Access Denied");
    exit();
}

$user_status = $_SESSION["status"];
include ("partials/_dbconnect.php");

//taking order id
if (!isset($_GET["orderid"])) {
    header("location:/?admin=Order not defined");
    exit();
}

$id = $_GET["orderid"];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
    <link href="side/style.css" rel="stylesheet">
    <link rel="shortcut icon" href="images/logo.jfif" type="image/x-icon">
    <title>Shopping Cart - XYZ - Ecommerce Pakistan</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital@0;1&display=swap" rel="stylesheet">
</head>

<body class="open-sans bg-[#F8F8F8]">
    <!-- home link -->
    <div class="m-5">
        <a href="admin"
            class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
            Return
        </a>
    </div>
    <!-- showing details -->
    <div class="m-4 p-4 space-y-4 bg-white rounded-md shadow-md">
        <?php
        $sql = "SELECT * FROM `orders` WHERE `id` = ?";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "s", $id);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        $row = mysqli_fetch_assoc($result);
        //removing one \n
        $details = str_replace("\n\n", "<br>", $row["details"]);
        if ($row["status"] == 1) {
            echo '<div
                class="p-2 bg-green-100 border-green-600 border-2 flex items-center justify-between rounded-md shadow-md">
                    <p class="text-lg font-semibold px-2 text-green-700">' . $details . '</p>
                    <div class="flex space-x-2">
                        <!-- uncomplete -->
                        <button class="flex items-center bg-red-100 rounded-full"
                            onclick="window.location.assign(`partials/_mark?mark=0&orderid=' . $id . '`)">
                            <img src="images/close.png" class="w-10 h-10 p-1 border-2 border-red-700 rounded-full">
                        </button>
                        
                    </div>
                </div>';
        } else {
            echo '<div
            class="p-2 bg-red-100 border-red-700 border-2 flex items-center justify-between rounded-md shadow-md">
                <p class="text-lg font-semibold px-2 text-red-700">' . $details . '</p>
                <div class="flex space-x-2">
                    <!-- complete -->
                    <button class="flex items-center bg-green-100 rounded-full"
                        onclick="window.location.assign(`partials/_mark?mark=1&orderid=' . $id . '`)">
                        <img src="images/tick.png" class="w-10 h-10 p-1 border-2 border-green-700 rounded-full">
                    </button>
                    <!-- delete -->
                    <button class="py-2 px-4 rounded-md bg-blue-600 active:bg-blue-800 text-white shadow-md z-20"
                        onclick="window.location.assign(`partials/_cancelorder?id=' . $id . '`)">Cancel</button>
                </div>
            </div>';
        }
        ?>
    </div>
</body>

</html>