<?php

session_start();
//checking if logged
if (!isset($_SESSION["logged"]) && $_SESSION["logged"] != true) {
    header("location:/?error=Not logged in");
    exit();
}

$user_id = $_SESSION["id"];

//check if user
if ($_SESSION["status"] != "user") {
    header("location:/?error=Access Denied");
    exit();
}

include ("partials/_dbconnect.php");

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

$user_status = $_SESSION["status"];
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
    <!-- alert and error  -->
    <div class="alert transition-all duration-200">
        <?php
        if (isset($_GET["alert"])) {
            echo '<div class="bg-green-100 border border-green-400 hover:bg-green-50 text-green-700 px-4 py-3 rounded space-x-4 flex items-center justify-between fixed bottom-5 right-5 ml-5 transition-all duration-200 z-20"
        role="alert">
                <strong class="font-bold text-sm">' . $_GET["alert"] . '.</strong>
                <span onclick="hideAlert(this);">
                    <svg class="fill-current h-6 w-6 text-green-600 border-2 border-green-700 rounded-full" role="button"
                        xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                        <title>Close</title>
                        <path
                            d="M14.348 14.849a1.2 1.2 0 0 1-1.697 0L10 11.819l-2.651 3.029a1.2 1.2 0 1 1-1.697-1.697l2.758-3.15-2.759-3.152a1.2 1.2 0 1 1 1.697-1.697L10 8.183l2.651-3.031a1.2 1.2 0 1 1 1.697 1.697l-2.758 3.152 2.758 3.15a1.2 1.2 0 0 1 0 1.698z" />
                    </svg>
                </span>
            </div>';
        } else if (isset($_GET["error"])) {
            echo '<div class="bg-red-100 border border-red-400 hover:bg-red-50 text-red-700 px-4 py-3 rounded space-x-4 flex items-center justify-between fixed bottom-5 right-5 ml-5 transition-all duration-200 z-20"
        role="alert">
                <strong class="font-bold text-sm">' . $_GET["error"] . '.</strong>
                <span onclick="hideAlert(this);">
                    <svg class="fill-current h-6 w-6 text-red-600 border-2 border-red-700 rounded-full" role="button"
                        xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                        <title>Close</title>
                        <path
                            d="M14.348 14.849a1.2 1.2 0 0 1-1.697 0L10 11.819l-2.651 3.029a1.2 1.2 0 1 1-1.697-1.697l2.758-3.15-2.759-3.152a1.2 1.2 0 1 1 1.697-1.697L10 8.183l2.651-3.031a1.2 1.2 0 1 1 1.697 1.697l-2.758 3.152 2.758 3.15a1.2 1.2 0 0 1 0 1.698z" />
                    </svg>
                </span>
            </div>';
        }
        ?>
    </div>
    <!-- home link -->
    <div class="m-4">
        <div class="flex">
            <a href="/"
                class="text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
                Home
            </a>
        </div>
    </div>

    <!-- user container -->
    <div class="m-4 p-4 bg-white rounded-md shadow-md container min-w-[calc(100%-32px)] max-w-[calc(100%-32px)]"
        id="user">
        <table class="w-full shadow-md">
            <thead>
                <tr class="border-b-gray-600 border-b bg-[#F3F2F7]">
                    <th scope="col" class="p-4">User Id</th>
                    <th scope="col" class="p-4">User Name</th>
                    <th scope="col" class="p-4">Email</th>
                    <th scope="col" class="p-4">Number</th>
                    <th scope="col" class="p-4">Total Orders</th>
                    <th scope="col" class="p-4">Completed</th>
                    <th scope="col" class="p-4">Pending</th>
                </tr>
            </thead>
            <tbody>
                <?php
                //declaring var
                $total = 0;
                $completed = 0;
                $pending = 0;

                //getting cresidentials
                $sql = "SELECT * FROM `orders` WHERE `userid` = ?";
                $stmt = mysqli_prepare($conn, $sql);
                mysqli_stmt_bind_param($stmt, "s", $user_id);
                mysqli_stmt_execute($stmt);
                $result = mysqli_stmt_get_result($stmt);
                while ($row = mysqli_fetch_assoc($result)) {
                    $total++;
                    if ($row["status"] == 0) {
                        $pending++;
                    } else if ($row["status"] == 1) {
                        $completed++;
                    }
                }

                //getting data
                $sql = "SELECT * FROM `users` WHERE `id` = ?";
                $stmt = mysqli_prepare($conn, $sql);
                mysqli_stmt_bind_param($stmt, "s", $user_id);
                mysqli_stmt_execute($stmt);
                $result = mysqli_stmt_get_result($stmt);

                while ($row = mysqli_fetch_assoc($result)) {
                    //echoing data
                    echo '<tr class="border-b-gray-500 border-b bg-[#F8F8F8] last:border-b-0">
                        <td class="text-center py-3">' . $row["id"] . '</td>
                        <td class="text-center py-3">' . $row["name"] . '</td>
                        <td class="text-center py-3">' . $row["email"] . '</td>
                        <td class="text-center py-3">' . $row["number"] . '</td>
                        <td class="text-center py-3">' . $total . '</td>
                        <td class="text-center py-3">' . $completed . '</td>
                        <td class="text-center py-3">' . $pending . '</td>
                    </tr>';
                }
                ?>
            </tbody>
        </table>
    </div>

    <!-- order container -->
    <div class="m-4 p-4 bg-white rounded-md shadow-md container min-w-[calc(100%-32px)] max-w-[calc(100%-32px)]"
        id="order">
        <table class="w-full shadow-md">
            <thead>
                <tr class="border-b-gray-600 border-b bg-[#F3F2F7]">
                    <th scope="col" class="p-4">Order Id</th>
                    <th scope="col" class="p-4">Time</th>
                    <th scope="col" class="p-4">Payment</th>
                    <th scope="col" class="p-4">Total</th>
                    <th scope="col" class="p-4">Delivery</th>
                    <th scope="col" class="p-4">Location</th>
                    <th scope="col" class="p-4">Status</th>
                    <th scope="col" class="p-4">Details</th>
                </tr>
            </thead>
            <tbody>
                <?php
                //getting data
                $sql = "SELECT * FROM `orders` WHERE `userid` = ? ORDER BY `arrange_order` ASC";
                $stmt = mysqli_prepare($conn, $sql);
                mysqli_stmt_bind_param($stmt, "s", $user_id);
                mysqli_stmt_execute($stmt);
                $result = mysqli_stmt_get_result($stmt);

                while ($row = mysqli_fetch_assoc($result)) {
                    if ($row["status"] == 1) {
                        $status = "Completed";
                    } else {
                        $status = "Pending";
                    }

                    //echoing data
                    echo '<tr class="border-b-gray-500 border-b bg-[#F8F8F8] last:border-b-0">
                    <td class="text-center py-3">' . $row["id"] . '</td>
                    <td class="text-center py-3">' . $row["time"] . '</td>
                    <td class="text-center py-3">' . $row["method"] . '</td>
                    <td class="text-center py-3">' . $row["price"] . '</td>
                    <td class="text-center py-3">' . $row["delivery_price"] . '</td>
                    <td class="text-center py-3">' . $row["delivery_location"] . '</td>
                    <td class="text-center py-3">' . $status . '</td>
                    <td class="flex items-center justify-center py-3">
                        <button class="flex items-center p-2 text-white bg-cyan-500 shadow-md hover:bg-cyan-400 rounded-md"
                        onclick="window.location.assign(`userorderdetails?orderid=' . $row["id"] . '`)">
                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                            class="feather feather-eye">
                            <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                            <circle cx="12" cy="12" r="3"></circle>
                        </svg>
                        </button>
                    </td>
                    </tr>';
                }
                ?>
            </tbody>
        </table>
    </div>
    <script>
        //alert
        function hideAlert(element) {
            //hiding alert
            element.parentNode.classList.add("opacity-0");

            //removing alert
            setTimeout(() => {
                element.parentNode.remove();
            }, 200);
        }
    </script>

</body>

</html>