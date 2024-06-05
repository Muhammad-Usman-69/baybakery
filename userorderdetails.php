<?php
session_start();
//checking if logged
if (!isset($_SESSION["logged"]) && $_SESSION["logged"] != true) {
    header("location:/?error=Not logged in");
    exit();
}

$user_id = $_SESSION["id"];

//check if admin
if ($_SESSION["status"] != "user" || !isset($_GET["orderid"])) {
    header("location:/?error=Access Denied");
    exit();
}

include ("partials/_dbconnect.php");

$order_id = $_GET["orderid"];


//check if user exist
$sql = "SELECT * FROM `users` WHERE `id` = ?";
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "s", $user_id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$num = mysqli_num_rows($result);
if ($num == 0) {
    header("location:/?error=User Doesn't Exist");
    exit();
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Panel</title>
    <link href="side/style.css" rel="stylesheet">
    <link rel="shortcut icon" href="images/logo.jfif" type="image/x-icon">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital@0;1&display=swap" rel="stylesheet">
</head>

<body class="open-sans bg-[#F8F8F8]">
    <!-- home link -->
    <div class="m-4">
        <div class="flex">
            <a href="user"
                class="text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
                Return
            </a>
        </div>
    </div>
    <!-- showing details -->
    <div class="m-4 p-4 space-y-4 bg-white rounded-md shadow-md">
        <?php
        $sql = "SELECT * FROM `orders` WHERE `id` = ? AND `userid` = ?";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "ss", $order_id, $user_id);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        $num = mysqli_num_rows($result);
        //check if no order
        if ($num == 0) {
            header("location:/user?error=No Such Order Exist");
        }
        while ($row = mysqli_fetch_assoc($result)) {
            $details = str_replace("\n\n", "<br>", $row["details"]);
            if ($row["status"] == 1) {
                echo '<div
                class="p-2 bg-green-100 border-green-600 border-2 flex items-center justify-between rounded-md shadow-md">
                    <p class="text-lg font-semibold px-2 text-green-700">' . $details . '</p>
                    <div class="flex space-x-2">
                </div>';
            } else {
                echo '<div
            class="p-2 bg-red-100 border-red-700 border-2 flex items-center justify-between rounded-md shadow-md">
                <p class="text-lg font-semibold px-2 text-red-700">' . $details . '</p>
                <div class="flex space-x-2">
                    <button type="button"
                        class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center"
                        onclick="window.location.assign(`partials/_cancelorder?orderid=' . $order_id . '`)">
                            Cancel
                    </button>
                </div>
            </div>';
            }
        }
        ?>
    </div>
</body>

</html>