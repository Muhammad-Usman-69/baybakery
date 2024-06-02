<?php
include ("partials/_dbconnect.php");
session_start();
?>
<!doctype html>
<html class="scroll-smooth">

<head>
    <meta charset="UTF-8">
    <link href="./side/style.css" rel="stylesheet">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="images/logo.jfif" type="image/x-icon">
    <title>Bay Bakery</title>
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
    <header class="min-h-31 lg:min-h-18 lg:max-h-18">
        <nav class="bg-white max-h-31 w-full z-10 flex justify-between items-center transition-all duration-300">
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
                echo '<a href="#' . $row["name"] . '"
                class="p-2 text-sm text-white bg-blue-950 transition-all duration-200 hover:bg-yellow-400 hover:text-black border-gray-700 border-r last:border-r-0">' . $row["name"] . '</a>';
            }
            ?>
        </div>
        <div class="min-w-7" onmousedown="scrollRightNav(1)" onmouseup="scrollRightNav(0)">
            <img src="images/carousel/right-arrow.png"
                class="h-9 absolute right-0 bg-blue-950 transition-all duration-200 hover:bg-yellow-400 active:bg-yellow-500 border-gray-700 border-l cursor-pointer p-1">
        </div>
    </div>
    <!-- carousel -->
    <div id="carousel" class="carousel carousel-dark slide" data-bs-ride="carousel">
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#carousel" data-bs-slide-to="0" class="active" aria-current="true"
                aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#carousel" data-bs-slide-to="1" aria-label="Slide 2"></button>
            <button type="button" data-bs-target="#carousel" data-bs-slide-to="2" aria-label="Slide 3"></button>
        </div>
        <div class="carousel-inner">
            <div class="carousel-item active" data-bs-interval="8000">
                <img src="images/carousel/pg1.jpg" class="d-block w-100" alt="...">
            </div>
            <div class="carousel-item" data-bs-interval="8000">
                <img src="images/carousel/pg2.jpg" class="d-block w-100" alt="...">
            </div>
            <div class="carousel-item" data-bs-interval="8000">
                <img src="images/carousel/pg3.jpg" class="d-block w-100" alt="...">
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carousel" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carousel" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
        </button>
    </div>
    <!-- products -->
    <div class="sm:mx-10 sm:my-6 lg:mx-12 lg:my-8 xl:mx-16 xl:my-12">
        <!-- featured products -->
        <div>
            <p class="bg-gray-200 text-slate-900 font-bold text-lg p-3">Featured Products</p>
            <div
                class="products grid grid-cols-1 gap-4 py-4 sm:py-5 md:py-6 lg:py-8 sm:grid-cols-2 sm:gap-6 md:grid-cols-3 lg:grid-cols-4 lg:gap-6 xl:grid-cols-5 xl:gap-10">
                <?php
                //fetching all products
                $sql = "SELECT * FROM `products`";
                $stmt = mysqli_prepare($conn, $sql);
                mysqli_stmt_execute($stmt);
                $result = mysqli_stmt_get_result($stmt);
                while ($row = mysqli_fetch_assoc($result)) {
                    $title = $row["title"];
                    $img = $row["img"];
                    $product_id = $row["id"];
                    $old_price = $row["old_price"];
                    $new_price = $row["new_price"];
                    $discount = $row["discount"];

                    $cart = "Add To Cart";
                    //check if present in cart if logged
                    if (isset($_SESSION["logged"]) && $_SESSION["logged"] == true) {
                        $id = $_SESSION["id"];
                        $sql = "SELECT * FROM `cart` WHERE `user_id` = ? && `product_id` = ?";
                        $stmt = mysqli_prepare($conn, $sql);
                        mysqli_stmt_bind_param($stmt, "ss", $id, $product_id);
                        mysqli_execute($stmt);
                        $result2 = mysqli_stmt_get_result($stmt);
                        $num = mysqli_num_rows($result2);

                        //check if user has anything in cart
                        if ($num != 0) {
                            $cart = "Already in cart";
                        }
                    }

                    echo '
                    <!-- product container -->
                    <div class="bg-gray-100 p-4 grid grid-cols-3 gap-2 last:border-b-0 sm:grid-cols-1">
                        <!-- img container -->
                        <div class="cursor-pointer relative">
                            <div class="min-h-34">
                                <img src="' . $img . '" class="max-h-34">
                            </div>
                            <!-- tag -->
                            <div
                                class="w-10 h-10 absolute top-0 right-0 grid place-items-center text-sm rounded-full bg-red-500 text-white font-bold">
                                <span class="">-' . $discount . '%</span>
                            </div>
                        </div>

                        <!-- text container -->
                        <div class="col-span-2 space-y-2 relative flex flex-col justify-between">
                            <p class="font-semibold text-justify text-slate-900">' . $title . '</p>
                            <div>
                                <span class="old-price text-xs line-through opacity-70">Rs ' . $old_price . '</span>
                                <span class="new-price font-semibold">Rs ' . $old_price . '</span>
                            </div>
                            <a href="cart?add=1&id=' . $product_id . '"
                                class="rounded-sm bg-gradient-to-t from-blue-950 to-blue-900 text-sm text-white px-3 py-1.5 hover:from-cyan-950 hover:to-cyan-900 active:bg-gradient-to-b">' . $cart . '</a>
                        </div>
                    </div>';
                }
                ?>

            </div>
        </div>

        <!-- categories wise products -->
        <?php
        //fetching categories
        $sql = "SELECT `name` FROM `categories`";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        while ($row = mysqli_fetch_assoc($result)) {
            $category = $row["name"];
            //category heading
            echo '<div class="scroll-mt-44" id="' . $category . '">
                <p class="bg-gray-200 text-slate-900 font-bold text-lg p-3">' . $category . '</p>
                <div
                    class="category-products gap-4 grid grid-cols-1 py-4 sm:py-5 md:py-6 lg:py-8 sm:grid-cols-2 sm:gap-6 md:grid-cols-3 lg:grid-cols-4 lg:gap-8 xl:grid-cols-5 xl:gap-10">';
            //fetching all products regarding categories
            $sql = "SELECT * FROM `products` WHERE `category` = '$category'";
            $stmt = mysqli_prepare($conn, $sql);
            mysqli_stmt_execute($stmt);
            $result2 = mysqli_stmt_get_result($stmt);
            while ($row = mysqli_fetch_assoc($result2)) {
                $title = $row["title"];
                $img = $row["img"];
                $product_id = $row["id"];
                $old_price = $row["old_price"];
                $new_price = $row["new_price"];
                $discount = $row["discount"];

                $cart = "Add To Cart";
                //check if present in cart if logged
                if (isset($_SESSION["logged"]) && $_SESSION["logged"] == true) {
                    $id = $_SESSION["id"];
                    $sql = "SELECT * FROM `cart` WHERE `user_id` = ? && `product_id` = ?";
                    $stmt = mysqli_prepare($conn, $sql);
                    mysqli_stmt_bind_param($stmt, "ss", $id, $product_id);
                    mysqli_execute($stmt);
                    $result3 = mysqli_stmt_get_result($stmt);
                    $num = mysqli_num_rows($result3);

                    //check if user has anything in cart
                    if ($num != 0) {
                        $cart = "Already in cart";
                    }
                }

                echo '
                <!-- product container -->
                <div class="bg-gray-100 p-4 grid grid-cols-3 gap-2 last:border-b-0 sm:grid-cols-1">
                    <!-- img container -->
                    <div class="cursor-pointer relative">
                        <div class="min-h-34">
                            <img src="' . $img . '" class="max-h-34">
                        </div>
                        <!-- tag -->
                        <div
                            class="w-10 h-10 absolute top-0 right-0 grid place-items-center text-sm rounded-full bg-red-500 text-white font-bold">
                            <span class="">-' . $discount . '%</span>
                        </div>
                    </div>

                    <!-- text container -->
                    <div class="col-span-2 space-y-2 relative flex flex-col justify-between">
                        <p class="font-semibold text-justify text-slate-900">' . $title . '</p>
                        <div>
                            <span class="old-price text-xs line-through opacity-70">Rs ' . $old_price . '</span>
                            <span class="new-price font-semibold">Rs ' . $old_price . '</span>
                        </div>
                        <a href="cart?add=1&id=' . $product_id . '"
                            class="rounded-sm bg-gradient-to-t from-blue-950 to-blue-900 text-sm text-white px-3 py-1.5 hover:from-cyan-950 hover:to-cyan-900 active:bg-gradient-to-b">'.$cart.'</a>
                    </div>
                </div>';
            }
            //ending container
            echo '</div>
            </div>';
        }
        ?>
    </div>

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
    <script src="side/script.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"
        integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy"
        crossorigin="anonymous"></script>
</body>

</html>