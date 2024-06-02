<?php 
    session_start();
    include("partials/_dbconnect.php");
    if (isset($_SESSION["log"]) && $_SESSION["log"] == true) {
        //check if user has product in cart
        $muman_id = $_SESSION["muman_id"];
        $sql = "SELECT * FROM `cart` WHERE `muman_id` = ?";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "i", $muman_id);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        $num = mysqli_num_rows($result);
    } else {
        $num = 0;
    }
?>
<!DOCTYPE html>
<html lang="en" class="scroll-smooth">

<head>
    <meta charset="UTF-8">
    <meta name="author" content="Muhammad Usman">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        <?php
            if ($num <= 1) {
                echo $num . " item in cart";
            } else {
                echo $num . " items in cart";
            }
        ?>
    </title>
    <link rel="shortcut icon" href="images/main/favicon.ico" type="image/x-icon">
</head>

<body class="bg-[#f5f4f4] hide-scrollbar flex flex-col min-h-[100vh]">
    <?php include("partials/_header.php"); ?>
    <div class="mt-14 md:mt-0 md:mb-4">
        <h2 class="prod-cart text-3xl text-center py-8">Your Cart</h2>
        <div class="md:grid md:grid-cols-3">
            <form class="space-y-4 col-span-2" action="partials/_cd-handler.php" method="post">
                <div class="flex justify-between h-10 bg-white mx-4 px-4 py-2 border-black border ">
                    <div class="flex space-x-4 items-center">
                        <input type="checkbox" onclick="selectAllProd()" class="selectAll">
                        <p>SELECT ALL</p>
                    </div>
                    <?php
                    echo '<button type="submit">
                        <img class="h-6" src="images/main/delete.png" alt="">
                        </button>'
                        ?>

                </div>
                <?php
                if (isset($_SESSION["log"]) && $_SESSION["log"] == true) {
                    if ($num != 0) {
                        while ($row = mysqli_fetch_assoc($result)) {
                            //check for avaialable products
                            $prod_msin = $row["msin"];
                            $cart_id = $row["cart_id"];
                            $sql = "SELECT * FROM `products` WHERE `product_msin` = ?";
                            $stmt = mysqli_prepare($conn, $sql);
                            mysqli_stmt_bind_param($stmt, "i", $prod_msin);
                            mysqli_stmt_execute($stmt);
                            $result2 = mysqli_stmt_get_result($stmt);
                            $num = mysqli_num_rows($result2);
                            if ($num != 0) {
                                while ($row = mysqli_fetch_assoc($result2)) {
                                    $prod_name = $row["product_name"];
                                    $prod_old_price = $row["product_old_price"];
                                    $prod_new_price = $row["product_new_price"];
                                    $prod_del_price = $row["product_delivery_charges"];
                                    echo '<div class="item flex items-center px-4 py-2 bg-white mx-4 space-x-2 border-black border">
                                    <input class="select rounded-full" type="checkbox" name="delete[]" value="' . $cart_id . '">
                                    <img class="w-20 h-20" src="images/' . $prod_name . '/prod1.jpg" alt="">
                                    <div class="grid grod-rows-2 w-full">
                                        <a href="product.php?msin=' . $prod_msin . '" class="line-clamp-2">' . $prod_name . '</a>
                                        <div class="flex justify-between">
                                            <div class="grid grid-rows-2">
                                                <p class="text-base font-bold">$<span class="text-xl price">' . $prod_new_price . '</span></p>
                                                <p class="text-sm font-medium">Delivery: $<span class="deliveryPrice">' . $prod_del_price . '</span></p>
                                            </div>
                                            <div class="quantity flex items-center space-x-2 py-2 text-white">
                                                <button type="button"
                                                    class="minus bg-slate-600 w-8 h-8 hover:bg-slate-700 active:bg-slate-800 text-xl flex justify-center">&minus;</button>
                                                <p class="product-quantity text-black">1</p>
                                                <button type="button"
                                                    class="plus bg-slate-600 w-8 h-8 hover:bg-slate-700 active:bg-slate-800 text-xl flex justify-center">&plus;</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>';
                                }
                            }
                        }
                    } else {
                        echo '<h2 class="text-2xl font-medium mx-4 py-2 text-center">Your Cart is Empty.</h2>';
                        } 
                    } else {
                        echo '<div class="flex justify-center items-center">
                        <h2 class="text-xl font-medium mx-4 my-2 text-center">Please log in to see cart 
                        <button type="button" class="cursor-pointer text-white focus:outline-none bg-red-600 hover:bg-red-700 focus:ring-red-900 font-medium rounded-lg text-sm px-4 py-2" data-modal-target="log-modal"         data-modal-toggle="log-modal">Log in</button></h2>
                        </div>';
                    }
                ?>
            </form>
            <div class="checkout bg-white p-4 m-4 md:m-0 md:mr-4 h-fit">
                <p class="font-semibold">Order Summary</p>
                <ul class="py-2 space-y-4">
                    <li class="flex justify-between">
                        <p>Subtotal (<span class="totalItem">0</span> items)</p>
                        <p>$<span class="totalPrice">0.00</span></p>
                    </li>
                    <li class="shipping flex justify-between">
                        <p>Shipping Fee</p>
                        <p>$<span class="delivery">0.00</span></p>
                    </li>
                    <li class="flex justify-between">
                        <p>Total</p>
                        <p class="text-blue-600">$<span class="finalPrice">0.00</span></p>
                    </li>
                </ul>
                <button
                    class="bg-orange-500 text-white py-2 w-full mt-5 hover:bg-orange-600 active:bg-orange-500">Proceed
                    To Checkout (<span class="totalItem">0</span>)</button>
            </div>
        </div>
    </div>

    <?php include("partials/_footer.php"); ?>
    <?php include("partials/_script.php"); ?>

</body>

</html>