<?php
    session_start();
    include("partials/_dbconnect.php");
    if (isset($_GET["msin"]) && $_GET["msin"] != "") {
        $prod_msin = $_GET["msin"];
    } else {
        header("location:/?error=product not specified");
        exit();
    }
?>
<?php
    $sql = "SELECT * FROM `products` WHERE `product_msin` = '$prod_msin'";
    $result = mysqli_query($conn, $sql);
    $num = mysqli_num_rows($result);
    if ($num != 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $prod_name = $row["product_name"];
            $prod_color = $row["product_color"];
            $prod_weight = $row["product_weight"];
            $prod_brand = $row["product_brand"];
            $prod_image = $row["product_image"];
            $prod_dimension = $row["product_dimensions"];
            $prod_old_price = $row["product_old_price"];
            $prod_new_price = $row["product_new_price"];
            $prod_del_price = $row["product_delivery_charges"];
        }
    } else {
        header("location:/?error=unknown product");
        exit();
    }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="author" content="Muhammad Usman">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        <?php echo $prod_name; ?>
    </title>
    <link rel="shortcut icon" href="images/main/favicon.ico" type="image/x-icon">
    
</head>

<body class="bg-[#e8e8e8] hide-scrollbar flex flex-col min-h-[100vh]">

    <?php include("partials/_header.php"); ?>

    <div class="mt-14 sm:grid grid-cols-2 md:m-2 md:grid-cols-3 md:grid-rows-2">
        <div class="md:row-span-2 md:bg-blue-500">
            <div
                class="relative xl:w-[450px] 2xl:w-[520px] xl:left-1/2 xl:-translate-x-1/2 2xl:top-1/2 2xl:-translate-y-1/2">
                <div class="img-container sm:h-full md:h-auto md:p-6">
                    <button
                        class="group absolute bg-[grey] active:bg-opacity-30 bg-opacity-0 w-20 h-full top-1/2 left-0 -translate-y-1/2 grid place-items-center hover:bg-opacity-20 transition-all duration-300 md:h-20 md:left-5" onclick="scrollImgLeft()">
                        <img src="../images/main/left.png" class="hidden group-hover:block" alt="Scroll Icon">
                    </button>
                    <div class="flex overflow-x-scroll banner scroll-smooth hide-scrollbar sm:h-full md:h-auto">
                        <?php
                        for ($i = 1; $i <= $prod_image; $i++) {
                            echo '<img class="flex-shrink-0 h-full w-full sm:h-full" src="../images/' . $prod_name . '/prod' . $i . '.jpg" alt="">';
                        }
                        ?>
                    </div>
                    <button
                        class="group absolute bg-[grey] active:bg-opacity-30 bg-opacity-0 w-20 h-full top-1/2 right-0 -translate-y-1/2 grid place-items-center hover:bg-opacity-20 transition-all duration-300 md:h-20 md:right-5"
                        onclick="scrollImgRight()">
                        <img src="../images/main/right.png" class="hidden group-hover:block" alt="Scroll Icon">
                    </button>
                </div>
            </div>
        </div>
        <div class="intro bg-blue-500 p-6 border-white border-b pb-2 sm:h-full md:border-none md:pl-0">
            <p class="text-[#f5f4f4]">
                <?php echo $prod_name; ?>
            </p>
            <p class="text-base block font-extrabold text-[#f5f4f4]">$<span class="text-2xl">
                    <?php echo $prod_new_price; ?><span></p>
            <p class="text-sm text-[#f5f4f4]">$<del class="text-base">
                    <?php echo $prod_old_price; ?>
                </del></p>
            <div class="flex items-center">
                <svg class="w-4 h-4 text-yellow-300 me-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                    fill="currentColor" viewBox="0 0 22 20">
                    <path
                        d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044l-5.051-.734-2.259-4.577a1.534 1.534 0 0 0-2.752 0L7.365 5.847l-5.051.734A1.535 1.535 0 0 0 1.463 9.2l3.656 3.563-.863 5.031a1.532 1.532 0 0 0 2.226 1.616L11 17.033l4.518 2.375a1.534 1.534 0 0 0 2.226-1.617l-.863-5.03L20.537 9.2a1.523 1.523 0 0 0 .387-1.575Z" />
                </svg>
                <svg class="w-4 h-4 text-yellow-300 me-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                    fill="currentColor" viewBox="0 0 22 20">
                    <path
                        d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044l-5.051-.734-2.259-4.577a1.534 1.534 0 0 0-2.752 0L7.365 5.847l-5.051.734A1.535 1.535 0 0 0 1.463 9.2l3.656 3.563-.863 5.031a1.532 1.532 0 0 0 2.226 1.616L11 17.033l4.518 2.375a1.534 1.534 0 0 0 2.226-1.617l-.863-5.03L20.537 9.2a1.523 1.523 0 0 0 .387-1.575Z" />
                </svg>
                <svg class="w-4 h-4 text-yellow-300 me-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                    fill="currentColor" viewBox="0 0 22 20">
                    <path
                        d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044l-5.051-.734-2.259-4.577a1.534 1.534 0 0 0-2.752 0L7.365 5.847l-5.051.734A1.535 1.535 0 0 0 1.463 9.2l3.656 3.563-.863 5.031a1.532 1.532 0 0 0 2.226 1.616L11 17.033l4.518 2.375a1.534 1.534 0 0 0 2.226-1.617l-.863-5.03L20.537 9.2a1.523 1.523 0 0 0 .387-1.575Z" />
                </svg>
                <svg class="w-4 h-4 text-yellow-300 me-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                    fill="currentColor" viewBox="0 0 22 20">
                    <path
                        d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044l-5.051-.734-2.259-4.577a1.534 1.534 0 0 0-2.752 0L7.365 5.847l-5.051.734A1.535 1.535 0 0 0 1.463 9.2l3.656 3.563-.863 5.031a1.532 1.532 0 0 0 2.226 1.616L11 17.033l4.518 2.375a1.534 1.534 0 0 0 2.226-1.617l-.863-5.03L20.537 9.2a1.523 1.523 0 0 0 .387-1.575Z" />
                </svg>
                <svg class="w-4 h-4 text-gray-300 me-1 dark:text-gray-500" aria-hidden="true"
                    xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 20">
                    <path
                        d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044l-5.051-.734-2.259-4.577a1.534 1.534 0 0 0-2.752 0L7.365 5.847l-5.051.734A1.535 1.535 0 0 0 1.463 9.2l3.656 3.563-.863 5.031a1.532 1.532 0 0 0 2.226 1.616L11 17.033l4.518 2.375a1.534 1.534 0 0 0 2.226-1.617l-.863-5.03L20.537 9.2a1.523 1.523 0 0 0 .387-1.575Z" />
                </svg>
                <p class="ms-1 text-sm font-medium text-white">4.95</p>
                <p class="ms-1 text-sm font-medium text-white">out of</p>
                <p class="ms-1 text-sm font-medium text-white">5</p>
            </div>
            <div class="quantity flex space-x-4 items-center py-4 text-white">
                <button
                    class="minus bg-slate-600 p-2 w-12 h-12 hover:bg-slate-700 active:bg-slate-800 text-xl flex justify-center">&minus;</button>
                <p class="quantity-number">1</p>
                <button
                    class="plus bg-slate-600 p-2 w-12 h-12 hover:bg-slate-700 active:bg-slate-800 text-xl flex justify-center">&plus;</button>
            </div>
            <div class="buy grid grid-cols-2 space-x-1 pb-3">
                <button class="bg-cyan-400 text-white active:bg-cyan-500 p-4 font-semibold">Buy Now</button>
                <button <?php 
                    if (isset($_SESSION["log"]) && $_SESSION["log"] == true) {
                        echo 'onclick="window.open(`partials/_ca-handler.php?msin=' . $prod_msin . '`, `_self`);"';
                    } else {
                        echo 'data-modal-target="log-modal" data-modal-toggle="log-modal"';
                    }
                ?> class="bg-red-600 text-white active:bg-red-700 p-4 font-semibold">Add to Cart</button>
            </div>
        </div>
        <div
            class="details text-white bg-blue-500 p-6 border-white border-b grid md:row-start-2 md:col-start-2 md:py-0 md:pl-0 md:border-b-0">
            <p class="font-bold text-2xl">Product Details</p>
            <table class="grid grid-cols-1 py-5">
                <tbody>
                    <tr class="grid grid-cols-2 text-center">
                        <th class="bg-blue-700 text-white border-white border-x border-y p-2">Brand:</th>
                        <td class="bg-blue-600 text-white border-white border-x border-y p-2">
                            <?php echo $prod_brand; ?>
                        </td>
                    </tr>
                    <tr class="grid grid-cols-2 text-center">
                        <th class="bg-blue-700 text-white border-white border-x border-y p-2">Dimensions:</th>
                        <td class="bg-blue-600 text-white border-white border-x border-y p-2">
                            <?php echo $prod_dimension; ?> cm
                        </td>
                    </tr>
                    <tr class="grid grid-cols-2 text-center">
                        <th class="bg-blue-700 text-white border-white border-x border-y p-2">MSIN:</th>
                        <td class="bg-blue-600 text-white border-white border-x border-y p-2">
                            <?php echo $prod_msin; ?>
                        </td>
                    </tr>
                    <tr class="grid grid-cols-2 text-center">
                        <th class="bg-blue-700 text-white border-white border-x border-y p-2">Color:</th>
                        <td class="bg-blue-600 text-white border-white border-x border-y p-2">
                            <?php echo $prod_color; ?>
                        </td>
                    </tr>
                    <tr class="grid grid-cols-2 text-center">
                        <th class="bg-blue-700 text-white border-white border-x border-y p-2">Weight:</th>
                        <td class="bg-blue-600 text-white border-white border-x border-y p-2">
                            <?php echo $prod_weight; ?> Kg
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div
            class="shipping text-white bg-blue-500 p-6 border-white border-b sm:border-l md:row-start-1 md:row-end-3 md:col-start-3 md:border-b-0">
            <p class="font-bold text-2xl">Shipping</p>
            <table class="grid grid-cols-1 py-5">
                <tbody>
                    <tr class="grid grid-cols-3">
                        <th class="col-span-1 bg-blue-700 text-white border-white border-x border-y p-2">Delivery
                        </th>
                        <td class="col-span-2 bg-blue-600 text-white border-white border-x border-y p-2">
                            <ul>
                                <li><i class="fa fa-map-marker pr-2 text-base"></i>Sindh, Karachi - Gulshan-e-Iqbal,
                                    Block
                                    15</li>
                                <li class="pt-3"><span class="font-bold">$
                                        <?php echo $prod_del_price; ?> -
                                    </span> Standerd Delivery, 20 May - 24 May </li>
                                <li class="opacity-70">Enjoy free shipping promotion with minimum spend of $129.99 </li>
                            </ul>
                        </td>
                    </tr>
                    <tr class="grid my-6">
                        <td>
                            <hr class="h-px bg-bg-white ">
                        </td>
                    </tr>
                    <tr class="grid grid-cols-3">
                        <th class="col-span-1 bg-blue-700 text-white border-white border-x border-y p-2">Service
                        </th>
                        <td class="col-span-2 bg-blue-600 text-white border-white border-x border-y p-2">
                            <ul>
                                <li>28 days free return</li>
                            </ul>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    <div class="reviews text-white bg-blue-500 p-6 border-white border-b">
        <p class="font-bold text-2xl">Reviews</p>
        <ul class="py-5">
            <li class="bg-blue-600 border-white border-x border-y p-2">
                <div class="grid grid-cols-[48px_auto] space-x-4">
                    <img src="images/main/review.png" alt="" class="w-12 bg-[#f7941c] rounded-full">
                    <div>
                        <p>Mohan Daas</p>
                        <div class="flex w-full">
                            <svg class="w-4 h-4 text-yellow-300 me-1" aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 20">
                                <path
                                    d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044l-5.051-.734-2.259-4.577a1.534 1.534 0 0 0-2.752 0L7.365 5.847l-5.051.734A1.535 1.535 0 0 0 1.463 9.2l3.656 3.563-.863 5.031a1.532 1.532 0 0 0 2.226 1.616L11 17.033l4.518 2.375a1.534 1.534 0 0 0 2.226-1.617l-.863-5.03L20.537 9.2a1.523 1.523 0 0 0 .387-1.575Z" />
                            </svg>
                            <svg class="w-4 h-4 text-yellow-300 me-1" aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 20">
                                <path
                                    d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044l-5.051-.734-2.259-4.577a1.534 1.534 0 0 0-2.752 0L7.365 5.847l-5.051.734A1.535 1.535 0 0 0 1.463 9.2l3.656 3.563-.863 5.031a1.532 1.532 0 0 0 2.226 1.616L11 17.033l4.518 2.375a1.534 1.534 0 0 0 2.226-1.617l-.863-5.03L20.537 9.2a1.523 1.523 0 0 0 .387-1.575Z" />
                            </svg>
                            <svg class="w-4 h-4 text-yellow-300 me-1" aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 20">
                                <path
                                    d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044l-5.051-.734-2.259-4.577a1.534 1.534 0 0 0-2.752 0L7.365 5.847l-5.051.734A1.535 1.535 0 0 0 1.463 9.2l3.656 3.563-.863 5.031a1.532 1.532 0 0 0 2.226 1.616L11 17.033l4.518 2.375a1.534 1.534 0 0 0 2.226-1.617l-.863-5.03L20.537 9.2a1.523 1.523 0 0 0 .387-1.575Z" />
                            </svg>
                            <svg class="w-4 h-4 text-yellow-300 me-1" aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 20">
                                <path
                                    d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044l-5.051-.734-2.259-4.577a1.534 1.534 0 0 0-2.752 0L7.365 5.847l-5.051.734A1.535 1.535 0 0 0 1.463 9.2l3.656 3.563-.863 5.031a1.532 1.532 0 0 0 2.226 1.616L11 17.033l4.518 2.375a1.534 1.534 0 0 0 2.226-1.617l-.863-5.03L20.537 9.2a1.523 1.523 0 0 0 .387-1.575Z" />
                            </svg>
                            <svg class="w-4 h-4 text-gray-300 me-1 dark:text-gray-500" aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 20">
                                <path
                                    d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044l-5.051-.734-2.259-4.577a1.534 1.534 0 0 0-2.752 0L7.365 5.847l-5.051.734A1.535 1.535 0 0 0 1.463 9.2l3.656 3.563-.863 5.031a1.532 1.532 0 0 0 2.226 1.616L11 17.033l4.518 2.375a1.534 1.534 0 0 0 2.226-1.617l-.863-5.03L20.537 9.2a1.523 1.523 0 0 0 .387-1.575Z" />
                            </svg>
                        </div>
                        <div class="review pt-2">
                            <p>Before getting the Ruck Snack, I struggled my whole life with pulverized snacks, endless
                                crumbs, and other heartbreaking snack catastrophes. Now, I can play my games with
                                confidence and style!</p>
                        </div>
                    </div>
                </div>
            </li>
            <li class="bg-blue-600 border-white border-x border-y p-2">
                <div class="grid grid-cols-[48px_auto] space-x-4">
                    <img src="images/main/review.png" alt="" class="w-12 bg-[#f7941c] rounded-full">
                    <div>
                        <p>Xhao Mao</p>
                        <div class="flex w-full">
                            <svg class="w-4 h-4 text-yellow-300 me-1" aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 20">
                                <path
                                    d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044l-5.051-.734-2.259-4.577a1.534 1.534 0 0 0-2.752 0L7.365 5.847l-5.051.734A1.535 1.535 0 0 0 1.463 9.2l3.656 3.563-.863 5.031a1.532 1.532 0 0 0 2.226 1.616L11 17.033l4.518 2.375a1.534 1.534 0 0 0 2.226-1.617l-.863-5.03L20.537 9.2a1.523 1.523 0 0 0 .387-1.575Z" />
                            </svg>
                            <svg class="w-4 h-4 text-yellow-300 me-1" aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 20">
                                <path
                                    d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044l-5.051-.734-2.259-4.577a1.534 1.534 0 0 0-2.752 0L7.365 5.847l-5.051.734A1.535 1.535 0 0 0 1.463 9.2l3.656 3.563-.863 5.031a1.532 1.532 0 0 0 2.226 1.616L11 17.033l4.518 2.375a1.534 1.534 0 0 0 2.226-1.617l-.863-5.03L20.537 9.2a1.523 1.523 0 0 0 .387-1.575Z" />
                            </svg>
                            <svg class="w-4 h-4 text-yellow-300 me-1" aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 20">
                                <path
                                    d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044l-5.051-.734-2.259-4.577a1.534 1.534 0 0 0-2.752 0L7.365 5.847l-5.051.734A1.535 1.535 0 0 0 1.463 9.2l3.656 3.563-.863 5.031a1.532 1.532 0 0 0 2.226 1.616L11 17.033l4.518 2.375a1.534 1.534 0 0 0 2.226-1.617l-.863-5.03L20.537 9.2a1.523 1.523 0 0 0 .387-1.575Z" />
                            </svg>
                            <svg class="w-4 h-4 text-yellow-300 me-1" aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 20">
                                <path
                                    d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044l-5.051-.734-2.259-4.577a1.534 1.534 0 0 0-2.752 0L7.365 5.847l-5.051.734A1.535 1.535 0 0 0 1.463 9.2l3.656 3.563-.863 5.031a1.532 1.532 0 0 0 2.226 1.616L11 17.033l4.518 2.375a1.534 1.534 0 0 0 2.226-1.617l-.863-5.03L20.537 9.2a1.523 1.523 0 0 0 .387-1.575Z" />
                            </svg>
                            <svg class="w-4 h-4 text-gray-300 me-1 dark:text-gray-500" aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 20">
                                <path
                                    d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044l-5.051-.734-2.259-4.577a1.534 1.534 0 0 0-2.752 0L7.365 5.847l-5.051.734A1.535 1.535 0 0 0 1.463 9.2l3.656 3.563-.863 5.031a1.532 1.532 0 0 0 2.226 1.616L11 17.033l4.518 2.375a1.534 1.534 0 0 0 2.226-1.617l-.863-5.03L20.537 9.2a1.523 1.523 0 0 0 .387-1.575Z" />
                            </svg>
                        </div>
                        <div class="review pt-2">
                            <p>I love how tv screen this device is. It can hold anything ranging from cookies that
                                come in trays to cookies that come in tins.</p>
                        </div>
                    </div>
                </div>
            </li>
        </ul>
    </div>

    <div class="flex justify-between py-2 px-4 bg-white">
        <span class="font-bold text-lg">Connect</span>
    </div>

    <?php include("partials/_footer.php"); ?>
    <?php include("partials/_script.php") ?>
</body>

</html>