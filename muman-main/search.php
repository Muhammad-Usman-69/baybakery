<?php include("partials/_dbconnect.php"); ?>
<?php
    session_start();
    if (isset($_GET["q"]) && $_GET["q"] != "") {
        $query = $_GET["q"];
        $sql = "SELECT * FROM `products` WHERE MATCH(`product_name`, `product_category`, `product_color`, `product_brand`) AGAINST('$query')";
        $result = mysqli_query($conn, $sql);
        $num = mysqli_num_rows($result);
    } else {
        header("location:/?error=nothing to search");
        exit();
    }
?>
<!DOCTYPE html>
<html lang="en" class="scroll-smooth">

<head>
    <meta charset="UTF-8">
    <meta name="author" content="Muhammad Usman">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>
        <?php echo $query . " - "; if ($num > 1) {echo $num . " items found";} else {echo $num . " item found";} ?>
    </title>
    <link rel="shortcut icon" href="images/main/favicon.ico" type="image/x-icon">
    
    
</head>

<body class="bg-[#f5f4f4] hide-scrollbar flex flex-col min-h-[100vh]">
    
    <?php include("partials/_header.php"); ?>

    <div class="mt-14 mx-4 mb-4 rounded-md md:mt-1">
        <p class="mx-2 py-4">
            <?php if ($num > 1) {echo $num . " items found for ";} else {echo $num . " item found for ";} ?>
            <span class="text-orange-600">"<?php echo $query; ?>"</span>
        </p>

        <div class="grid gap-4 sm:grid-cols-2 sm:gap-4 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5">

            <?php
                if ($num != 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        $prod_name = $row["product_name"];
                        $prod_msin = $row["product_msin"];
                        $prod_old_price = $row["product_old_price"];
                        $prod_new_price = $row["product_new_price"];
                        echo '<a href="product.php?msin='.$prod_msin.'" class="bg-[#dcd9d9] inline-block p-2 rounded-md w-auto h-fit col-span-1">
                            <img class="rounded-md w-full" src="images/'.$prod_name.'/prod1.jpg" alt="">
                            <div>
                                <p class="line-clamp-2 leading-5 break-all mx-2 mt-2">'.$prod_name.'</p>
                                <p class="font-extrabold text-blue-700 mx-2 leading-none">
                                    <span class="text-xs">$</span><del>'.$prod_old_price.'</del>
                                    <span class="w-4"> </span>
                                    <span class="text-sm">$</span><span class="text-lg">'.$prod_new_price.'<span>
                                </p>
                            </div>
                        </a>';
                    }
                } else {
                    echo '<h3 class="text-2xl font-bold px-2">No Items Found</h3>';
                }
            ?>

        </div>
    </div>

    <?php include("partials/_footer.php"); ?>
    <?php include("partials/_script.php") ?>

    </body>
</html>