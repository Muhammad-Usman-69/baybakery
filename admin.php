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
    <div class="m-5 my-6">
        <a href="/"
            class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
            Home
        </a>
    </div>

    <!-- order button -->
    <div class="m-5">
        <button type="button" onclick="document.getElementById('order').classList.toggle('hidden')"
            class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
            Show Orders
        </button>
    </div>
    <!-- order container -->
    <div class="m-4 p-4 bg-white rounded-md shadow-md hidden" id="order">
        <table class="w-full shadow-md">
            <thead>
                <tr class="border-b-gray-600 border-b bg-[#F3F2F7]">
                    <th scope="col" class="p-4">Order Id</th>
                    <th scope="col" class="p-4">User Id</th>
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
                $sql = "SELECT * FROM `orders`";
                $stmt = mysqli_prepare($conn, $sql);
                mysqli_stmt_execute($stmt);
                $result = mysqli_stmt_get_result($stmt);

                while ($row = mysqli_fetch_assoc($result)) {
                    if ($row["status"] == 1) {
                        $status = "Completed";
                    } else {
                        $status = "Uncompleted";
                    }

                    //echoing data
                    echo '<tr class="border-b-gray-500 border-b bg-[#F8F8F8] last:border-b-0">
                    <td class="text-center py-3">' . $row["id"] . '</td>
                    <td class="text-center py-3">' . $row["userid"] . '</td>
                    <td class="text-center py-3">' . $row["time"] . '</td>
                    <td class="text-center py-3">' . $row["method"] . '</td>
                    <td class="text-center py-3">' . $row["price"] . '</td>
                    <td class="text-center py-3">' . $row["delivery_price"] . '</td>
                    <td class="text-center py-3">' . $row["delivery_location"] . '</td>
                    <td class="text-center py-3">' . $status . '</td>
                    <td class="flex items-center justify-center py-3">
                        <button class="flex items-center p-2 text-white bg-cyan-500 shadow-md hover:bg-cyan-400 rounded-md"
                        onclick="window.location.assign(`orderdetails?orderid=' . $row["id"] . '`)">
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

    <!-- user button -->
    <div class="m-5">
        <button type="button" onclick="document.getElementById('user').classList.toggle('hidden')"
            class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
            Show Users
        </button>
    </div>
    <!-- user container -->
    <div class="m-4 p-4 bg-white rounded-md shadow-md hidden" id="user">
        <table class="w-full shadow-md">
            <thead>
                <tr class="border-b-gray-600 border-b bg-[#F3F2F7]">
                    <th scope="col" class="p-4">User Id</th>
                    <th scope="col" class="p-4">User Name</th>
                    <th scope="col" class="p-4">Email</th>
                    <th scope="col" class="p-4">Number</th>
                    <th scope="col" class="p-4">Status</th>
                    <th scope="col" class="p-4">Change Status</th>
                </tr>
            </thead>
            <tbody>
                <?php

                //getting data
                $sql = "SELECT * FROM `users`";
                $stmt = mysqli_prepare($conn, $sql);
                mysqli_stmt_execute($stmt);
                $result = mysqli_stmt_get_result($stmt);

                while ($row = mysqli_fetch_assoc($result)) {
                    //checking if admin
                    if ($row["admin"] == 1) {
                        $status = "Admin";
                        $change_status = "Buyer";
                        $change_status_id = 0;
                    } else {
                        $status = "Buyer";
                        $change_status = "Admin";
                        $change_status_id = 1;
                    }
                    //admin can't change himself
                    if ($_SESSION["id"] == $row["id"]) {
                        $change_status = "Can't Change";
                        $change_status_id = 2;
                    }
                    //_changeuserstatus
                    //echoing data
                    echo '<tr class="border-b-gray-500 border-b bg-[#F8F8F8] last:border-b-0">
                        <td class="text-center py-3">' . $row["id"] . '</td>
                        <td class="text-center py-3">' . $row["name"] . '</td>
                        <td class="text-center py-3">' . $row["email"] . '</td>
                        <td class="text-center py-3">' . $row["number"] . '</td>
                        <td class="text-center py-3">' . $status . '</td>
                        <td class="flex items-center justify-center py-3">
                            <button onclick="window.location.assign(`partials/_changeuserstatus?id=' . $row["id"] . '&status=' . $change_status_id . '`)" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm  px-5 py-2.5 text-center">
                                ' . $change_status . '
                            </button>
                        </td>
                    </tr>';
                }
                ?>
            </tbody>
        </table>
    </div>

    <!-- category button -->
    <div class="m-5">
        <button type="button" onclick="document.getElementById('category').classList.toggle('hidden')"
            class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
            Show Categories
        </button>
    </div>
    <!-- category container -->
    <div class="m-4 p-4 bg-white rounded-md shadow-md space-y-4 hidden" id="category">
        <form class="w-full shadow-md bg-[#F8F8F8] flex justify-between items-center" action="partials/_insertcategory"
            method="post">
            <input type="text" name="name" class="bg-transparent outline-none w-full inline-block p-3"
                placeholder="Category Name" minlength="4">
            <button type="Submit" href="/"
                class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center m-3">Insert</button>
        </form>
        <table class="w-full shadow-md">
            <thead>
                <tr class="border-b-gray-600 border-b bg-[#F3F2F7]">
                    <th scope="col" class="p-4">Category Name</th>
                    <th scope="col" class="p-4">Status</th>
                    <th scope="col" class="p-4">Change</th>
                    <th scope="col" class="p-4">Delete</th>
                    <th scope="col" class="p-4">Change Status</th>
                </tr>
            </thead>
            <tbody>
                <?php

                //getting data
                $sql = "SELECT * FROM `categories`";
                $stmt = mysqli_prepare($conn, $sql);
                mysqli_stmt_execute($stmt);
                $result = mysqli_stmt_get_result($stmt);

                while ($row = mysqli_fetch_assoc($result)) {
                    if ($row["status"] == 1) {
                        $status = "Active";
                        $change_status = "Unactive";
                        $change_status_id = 0;
                    } else {
                        $status = "Unactive";
                        $change_status = "Active";
                        $change_status_id = 1;
                    }
                    //echoing data
                    echo '<tr class="border-b-gray-500 border-b bg-[#F8F8F8] last:border-b-0">
                        <form action="partials/_updatecategory" method="post">
                            <td class="text-center py-3">
                                <input name="category" value="' . $row["name"] . '" class="bg-transparent text-center">
                            </td>
                            <input type="hidden" value="' . $row["name"] . '" name="old_name">
                            <td class="text-center py-3">' . $status . '</td>
                            <td class="py-3">
                                <div class="grid place-items-center">
                                    <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm  px-5 py-2.5 text-center">Change</button>
                                </div>
                            </td>
                            <td class="py-3">
                                <div class="grid place-items-center">
                                    <button type="button" onclick="window.location.assign(`partials/_deletecategory?name=' . $row["name"] . '`)" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm  px-5 py-2.5 text-center">Delete</button>
                                </div>
                            </td>
                            <td class="py-3">
                                <div class="grid place-items-center">
                                    <button type="button" onclick="window.location.assign(`partials/_changecategorystatus?name=' . $row["name"] . '&status=' . $change_status_id . '`)" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm  px-5 py-2.5 text-center m-auto">' . $change_status . '</button>
                                </div>
                            </td>
                        </form>
                    </tr>';
                }
                ?>
            </tbody>
        </table>
    </div>

    <!-- product button -->
    <div class="m-5">
        <button type="button" onclick="document.getElementById('product').classList.toggle('hidden')"
            class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
            Show Products
        </button>
    </div>
    <!-- product container -->
    <div class="m-4 p-4 bg-white rounded-md shadow-md space-y-4 hidden" id="product">
        <form class="w-full shadow-md bg-[#F8F8F8] flex justify-between items-center" action="partials/_insertproduct"
            method="post">
            <div class="flex m-4 space-x-3">
                <textarea type="text" name="title" class="bg-transparent outline-none resize-none" placeholder="Title"
                    rows="1" minlength="10" required></textarea>
                <textarea type="text" name="img" class="bg-transparent outline-none resize-none" placeholder="Image"
                    rows="1" minlength="14" required></textarea>
                <input type="number" name="old_price" placeholder="Old Price" class="bg-transparent outline-none w-24"
                    required>
                <input type="number" name="new_price" placeholder="New Price" class="bg-transparent outline-none w-24"
                    required>
                <select name="category" class="bg-transparent outline-none min-w-40 text-gray-400" oninput="this.style.color='black'" required>
                    <?php
                    //getting data
                    $sql = "SELECT * FROM `categories`";
                    $stmt = mysqli_prepare($conn, $sql);
                    mysqli_stmt_execute($stmt);
                    $result = mysqli_stmt_get_result($stmt);
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo '<option value="' . $row["name"] . '">' . $row["name"] . '</option>';
                    }
                    ?>
                </select>
                <input type="number" name="discount" placeholder="Discount" class="bg-transparent outline-none w-24"
                    required>
            </div>
            <button type="Submit" href="/"
                class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center m-3">Insert</button>
        </form>
        <table class="w-full shadow-md">
            <thead>
                <tr class="border-b-gray-600 border-b bg-[#F3F2F7]">
                    <th scope="col" class="p-4">Product Id</th>
                    <th scope="col" class="p-4">Product Name</th>
                    <th scope="col" class="p-4">Image</th>
                    <th scope="col" class="p-4">Old Price</th>
                    <th scope="col" class="p-4">New Price</th>
                    <th scope="col" class="p-4">Category</th>
                    <th scope="col" class="p-4">Discount</th>
                    <th scope="col" class="p-4">Change</th>
                    <th scope="col" class="p-4">Delete</th>
                    <th scope="col" class="p-4">Status</th>
                </tr>
            </thead>
            <tbody>
                <?php

                //getting data
                $sql = "SELECT * FROM `products`";
                $stmt = mysqli_prepare($conn, $sql);
                mysqli_stmt_execute($stmt);
                $result = mysqli_stmt_get_result($stmt);

                while ($row = mysqli_fetch_assoc($result)) {

                    if ($row["status"] == 1) {
                        $change_status = "Unactive";
                        $change_status_id = 0;
                    } else {
                        $change_status = "Active";
                        $change_status_id = 1;
                    }
                    //echoing data
                    echo '<tr class="border-b-gray-500 border-b bg-[#F8F8F8] last:border-b-0">
                        <form action="partials/_updateproduct" method="post">
                            <td class="py-3 text-center">
                                ' . $row["id"] . '
                            </td>
                            <input type="hidden" name="id" value="' . $row["id"] . '">
                            <td class="py-3">
                                <textarea class="bg-transparent text-center resize-none" name="title">' . $row["title"] . '</textarea>
                                </td>
                            <td class="py-3">
                                <textarea class="bg-transparent text-center resize-none" name="img">' . $row["img"] . '</textarea>
                            </td>
                            <td class="py-3">
                                <input type="number" class="bg-transparent text-center w-24" value="' . $row["old_price"] . '" name="old_price">
                            </td>
                            <td class="py-3">
                                <input type="number" class="bg-transparent text-center w-24" value="' . $row["new_price"] . '" name="new_price">
                            </td>
                            <td class="py-3">
                                <input type="text" class="bg-transparent text-center w-24" value="' . $row["category"] . '" name="category">
                            </td>
                            <td class="text-center py-3">
                                <input type="number" class="bg-transparent text-center w-24" value="' . $row["discount"] . '" name="discount">
                            </td>
                            <td class="py-3">
                                <div class="grid place-items-center">
                                    <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm  px-5 py-2.5 text-center">Change</button>
                                    </div>
                            </td>
                            <td class="py-3">
                                <div class="grid place-items-center">
                                    <button type="button" onclick="window.location.assign(`partials/_deleteproduct?id=' . $row["id"] . '`)" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm  px-5 py-2.5 text-center">Delete</button>
                                </div>
                            </td>
                            <td class="py-3">
                                <div class="grid place-items-center">
                                    <button type="button" onclick="window.location.assign(`partials/_changeproductstatus?id=' . $row["id"] . '&status=' . $change_status_id . '`)" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm  px-5 py-2.5 text-center">' . $change_status . '</button>
                                </div>
                            </td>
                        </form>
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

    <?php 
    //if redirecting to the previous page
    if (isset($_GET["order"]) && $_GET["order"] == 1) {
        echo '<script>
        document.getElementById("order").classList.toggle("hidden");
        </script>';
    } else if (isset($_GET["user"]) && $_GET["user"] == 1) {
        echo '<script>
        document.getElementById("user").classList.toggle("hidden");
        </script>';
    } else if (isset($_GET["product"]) && $_GET["product"] == 1) {
        echo '<script>
        document.getElementById("product").classList.toggle("hidden");
        </script>';
    } else if (isset($_GET["category"]) && $_GET["category"] == 1) {
        echo '<script>
        document.getElementById("category").classList.toggle("hidden");
        </script>';
    }
    ?>
</body>

</html>