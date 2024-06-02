<?php
include ("partials/_dbconnect.php");
session_start();
//checking if logged
if (!isset($_SESSION["logged"]) && $_SESSION["logged"] != true) {
    header("location:/?error=Not logged in");
    exit();
}

$user_id = $_SESSION["id"];

//checking if user is adding to cart
if (isset($_GET["add"]) && isset($_GET["id"]) && $_GET["add"] == 1) {

    $product_id = $_GET["id"];

    //check if already added
    $sql = "SELECT * FROM `cart` WHERE `user_id` = ? AND `product_id` = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "ss", $user_id, $product_id);
    mysqli_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $num = mysqli_num_rows($result);
    if ($num != 0) {
        header("location: /?error=Already added to cart");
        exit();
    }

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

    $cart_id = random_str(5);
    //adding into cart
    $sql = "INSERT INTO `cart` (`cart_id`, `user_id`, `product_id`) VALUES (?, ?, ?)";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "sss", $cart_id, $user_id, $product_id);
    $result = mysqli_stmt_execute($stmt);
    header("location:/?alert=Added to Cart");
    exit();
}

//checking if user is deleting from cart
if (isset($_POST["del"])) {
    //take array
    $product_ids = $_POST["del"];
    //check the value of each
    foreach ($product_ids as $product_id) {
        $sql = "DELETE FROM `cart` WHERE `product_id` = ?";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "s", $product_id);
        mysqli_stmt_execute($stmt);
    }
    header("location: /cart?&alert=Deleted successful");
    exit();
}
?>
<!doctype html>
<html class="scroll-smooth">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="side/style.css" rel="stylesheet">
    <link rel="shortcut icon" href="images/logo.jfif" type="image/x-icon">
    <title>Shopping Cart - XYZ - Ecommerce Pakistan</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital@0;1&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/1eeb4688e4.js" crossorigin="anonymous"></script>
</head>

<body class="open-sans bg-gray-50 flex flex-col min-h-screen">
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
    <!-- header -->
    <header class="min-h-18">
        <nav class="bg-white max-h-18 w-full z-10 flex justify-between items-center transition-all duration-300">
            <!-- main -->
            <div class="h-full grid place-items-center pl-5 py-2">
                <a href="/" class="flex items-center space-x-1 w-full">
                    <img src="images/logo-bg.png" class="w-14 rounded-full">
                    <span>Bay Bakery</span>
                </a>
            </div>
            <div class="mr-5 flex justify-center items-center space-x-4 lg:col-span-1 bg-transparent">
                <!-- account cart -->
                <a href="cart">
                    <img src="images/shopping-cart.png" class="w-7">
                </a>
                <?php
                if (isset($_SESSION["logged"]) && $_SESSION["logged"] == true) {
                    $link = "logout";
                } else {
                    $link = "login";
                }
                echo '<a href="' . $link . '">
                    <img src="images/user.png" class="w-7">
                </a>';
                ?>
            </div>
        </nav>
    </header>
    <hr>
    <!-- categories -->
    <div class="flex overflow-x-scroll scroll-smooth no-scrollbar bg-blue-950 relative">
        <div class="min-w-7" onmousedown="scrollLeftNav(1)" onmouseup="scrollLeftNav(0)">
            <img src="images/carousel/left-arrow.png"
                class="h-9 absolute left-0 bg-blue-950 transition-all duration-200 hover:bg-yellow-400 active:bg-yellow-500 border-gray-700 border-r cursor-pointer p-1">
        </div>
        <div class="flex scroll-container overflow-x-scroll no-scrollbar">
            <?php
            //fetching categories
            $sql = "SELECT `name` FROM `categories`";
            $stmt = mysqli_prepare($conn, $sql);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);
            while ($row = mysqli_fetch_assoc($result)) {
                echo '<a href="/#' . $row["name"] . '"
                class="p-2 text-sm text-white bg-blue-950 transition-all duration-200 hover:bg-yellow-400 hover:text-black border-gray-700 border-r last:border-r-0">' . $row["name"] . '</a>';
            }
            ?>
        </div>
        <div class="min-w-7" onmousedown="scrollRightNav(1)" onmouseup="scrollRightNav(0)">
            <img src="images/carousel/right-arrow.png"
                class="h-9 absolute right-0 bg-blue-950 transition-all duration-200 hover:bg-yellow-400 active:bg-yellow-500 border-gray-700 border-l cursor-pointer p-1">
        </div>
    </div>
    <!-- cart container -->
    <div class="m-5">
        <!-- breadcrumb -->
        <div class="p-3 text-sm border mb-5">
            <p class="space-x-3">
                <a href="/" class="text-cyan-600 font-bold underline">Home</a>
                <span class="opacity-70">/</span>
                <a href="/" class="text-red-600 font-bold underline">Cart</a>
            </p>
        </div>
        <div class="space-y-5 lg:grid lg:grid-cols-3 lg:gap-5 lg:space-y-0">
            <form class="lg:col-span-2" action="cart" method="post">
                <!-- cart title-->
                <div class="bg-gray-200 text-slate-900 font-bold text-lg p-3 flex justify-between">
                    <p>Cart</p>
                    <button type="submit">
                        <img src="images/delete.png" width="24">
                    </button>
                </div>
                <!-- cart -->
                <div>
                    <?php
                    //fetching product from cart
                    $sql = "SELECT * FROM `cart` WHERE `user_id` = ?";
                    $stmt = mysqli_prepare($conn, $sql);
                    mysqli_stmt_bind_param($stmt, "s", $user_id);
                    mysqli_execute($stmt);
                    $result = mysqli_stmt_get_result($stmt);
                    $num = mysqli_num_rows($result);
                    //check if user has anything in cart
                    if ($num != 0) {
                        //fetching product details
                        while ($row = mysqli_fetch_assoc($result)) {
                            $product_id = $row["product_id"];
                            $cart_id = $row["cart_id"];
                            $sql = "SELECT * FROM `products` WHERE `id` = ?";
                            $stmt = mysqli_prepare($conn, $sql);
                            mysqli_stmt_bind_param($stmt, "s", $product_id);
                            mysqli_execute($stmt);
                            $result2 = mysqli_stmt_get_result($stmt);
                            while ($row = mysqli_fetch_assoc($result2)) {
                                $img = $row["img"];
                                $title = $row["title"];
                                $old_price = $row["old_price"];
                                $new_price = $row["new_price"];
                                echo '<!-- product -->
                                <div class="item flex items-center p-3 border-b border-x space-x-2">
                                    <!-- product selector -->
                                    <input type="checkbox" name="del[]" value="' . $product_id . '" class="select">
                                    <!-- product img -->
                                    <img src="' . $img . '"
                                        class="max-h-20 max-w-20">
                                    <!-- product info -->
                                    <div class="space-y-1 flex flex-col w-full">
                                        <!-- product title -->
                                        <p class="text-sm">' . $title . '</p>
                                        <!-- product quantity and price -->
                                        <div class="flex justify-between items-center">
                                            <!-- price -->
                                            <div>
                                                <p class="text-xs line-through opacity-70">Rs. <span class="old-price">' . $old_price . '</span>
                                                </p>
                                                <p class="new-price font-semibold text-red-600">Rs. <span class="price">' . $new_price . '</span>
                                                </p>
                                            </div>
                                            <!-- quantity -->
                                            <div class="quantity flex items-center space-x-2 py-2 text-white">
                                                <button type="button"
                                                    class="minus bg-blue-950 text-yellow-400 w-8 h-8 active:bg-blue-900 text-xl">&minus;</button>
                                                <p class="product-quantity text-black">1</p>
                                                <button type="button"
                                                    class="plus bg-blue-950 text-yellow-400 w-8 h-8 active:bg-blue-900 text-xl">&plus;</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>';
                            }
                        }
                    } else {
                        echo '<p class="text-center py-3 text-lg border">Nothing in Cart</p>';
                    }
                    ?>

                </div>
            </form>
            <!-- checkout -->
            <div>
                <p class="bg-gray-200 text-slate-900 font-bold text-lg p-3">Checkout</p>
                <form action="order" class="p-4 border space-y-3" method="post">
                    <!-- delivery place -->
                    <h3 class="font-semibold"><i class="fa fa-truck text-yellow-500"></i> Delivery</h3>
                    <div action="" class="text-sm space-y-1">
                        <div>
                            <input type="radio" name="del" id="in" class="delivery" value="400" oninput="updateTotal()"
                                required>
                            <label for="in">Rs. 400 (Within Multan)</label>
                        </div>
                        <div>
                            <input type="radio" name="del" id="out" class="delivery" value="700" oninput="updateTotal()"
                                required>
                            <label for="out">Rs. 700 (Other Cities)</label>
                        </div>
                    </div>
                    <hr>
                    <!-- payment method -->
                    <h3 class="font-semibold"><i class="fa fa-wallet text-amber-950"></i> Payment Method</h3>
                    <div class="text-sm space-y-1">
                        <div>
                            <input type="radio" name="method" id="op" value="JazzCash" required>
                            <label for="op">Online Payment</label>
                        </div>
                        <div>
                            <input type="radio" name="method" id="cod" value="CashOnDelivery" required>
                            <label for="cod">Cash On Delivery</label>
                        </div>
                    </div>
                    <hr>
                    <!-- price -->
                    <div class="space-y-1">
                        <p class="flex space-x-1">
                            <span class="font-semibold">Delivery:</span>
                            <span>Rs.</span>
                            <input type="text" class="delivery-price bg-transparent outline-none border-none" value="0"
                                disabled />
                        </p>
                        <p>
                            <span class="font-semibold">Total:</span>
                            <span>Rs.</span>
                            <input type="text" class="total bg-transparent outline-none border-none" value="0"
                                disabled />
                            <input type="hidden" name="totalprice" id="totalprice" class="total">
                        </p>
                        <p>
                            <span class="font-semibold">Discount:</span>
                            <span>Rs.</span>
                            <span class="discount">0</span>
                        </p>
                    </div>
                    <hr>
                    <!-- hidden inputs -->
                    <input type="hidden" name="delivery" class="delivery-price" value="">
                    <div class="hidden-inputs">
                    </div>
                    <!-- checkout -->
                    <button type=" submit"
                            class="w-full bg-blue-950 transition-all duration-200 text-yellow-300 text-sm hover:bg-gray-800 active:bg-slate-900 py-2">Proceed
                        To Checkout (<span class="totalItem">0</span>)</button>

                </form>
            </div>
        </div>
    </div>
    <!-- footer -->
    <footer class="bg-blue-950 mt-auto">
        <!-- social email -->
        <div class="py-5 grid gap-4">
            <div class="social flex justify-center space-x-3">
                <a href="/">
                    <img src="images/facebook.png" class="w-9 h-9" alt="">
                </a>
                <a href="/">
                    <img src="images/instagram.png" class="w-9 h-9" alt="">
                </a>
                <a href="/">
                    <img src="images/whatsapp.png" class="w-9 h-9" alt="">
                </a>
            </div>
            <div class="email">
                <p class="capitalize text-center text-white text-sm">sign up to get latest sale <b>updates</b></p>
                <form action="" class="flex items-center justify-center py-2 rounded-sm text-sm">
                    <input type="search" name="e" id="e" placeholder="Enter Your Email"
                        class="outline-none border-none px-2 py-2 w-48 placeholder:italic" autocomplete="off">
                    <input type="submit" value="Submit"
                        class="bg-yellow-400 cursor-pointer px-2 py-2 hover:bg-yellow-300 active:bg-yellow-500">
                </form>
            </div>
        </div>
        <hr class="mx-5">
        <div class="grid grid-cols-1 md:grid-cols-3">
            <!-- products accounts -->
            <div class="px-5 py-5 text-white grid grid-cols-2 place-items-center md:col-span-2">
                <div>
                    <p class="font-semibold text-lg">PRODUCTS</p>
                    <div class="product-categories py-3 space-y-1 flex flex-col">
                        <?php
                        //fetching categories
                        $sql = "SELECT `name` FROM `categories`";
                        $stmt = mysqli_prepare($conn, $sql);
                        mysqli_stmt_execute($stmt);
                        $result = mysqli_stmt_get_result($stmt);
                        while ($row = mysqli_fetch_assoc($result)) {
                            $name = $row["name"];
                            echo '<a href="#' . $name . '" class="text-sm hover:underline">' . $name . '</a>';
                        }
                        ?>
                    </div>
                </div>
                <div>
                    <p class="font-semibold text-lg">ACCOUNT</p>
                    <div class="product-categories py-3 space-y-1 flex flex-col">
                        <a href="/" class="text-sm hover:underline">Sign Up</a>
                        <a href="/" class="text-sm hover:underline">Shopping Cart</a>
                    </div>
                </div>
            </div>
            <hr class="mx-5 md:hidden">
            <!-- contact -->
            <div class="px-5 py-5 text-white" id="contact">
                <p class="font-semibold text-lg">CONTACT US</p>
                <div class="py-3 space-y-2">
                    <div class="flex items-center space-x-2">
                        <i class="fa fa-map-marker text-yellow-400"></i>
                        <span class="text-sm">Shah Rukn E Alam Colony, 60000, Multan,
                            Pakistan</span>
                    </div>
                    <div class="flex items-center space-x-2">
                        <i class="fa fa-phone text-yellow-400"></i>
                        <span class="text-sm">+923081741428 | +923101281789</span>
                    </div>
                    <div class="flex items-center space-x-2">
                        <i class="fa fa-envelope-o text-yellow-400"></i>
                        <span class="text-sm">info@baybakery.com</span>
                    </div>
                </div>
            </div>
        </div>
        <hr class="mx-5">
        <!-- copyright -->
        <div class="py-3">
            <p class="text-center text-sm text-white">Copyright @ Bay Bakery 2024. All Rights Reserved</p>
        </div>
    </footer>
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
    <script src="side/cart.js"></script>
    <script src="side/script.js"></script>
</body>

</html>