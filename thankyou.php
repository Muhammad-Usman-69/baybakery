<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8" />
    <link href="./side/style.css" rel="stylesheet" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="shortcut icon" href="images/logo.jfif" type="image/x-icon" />
    <title>Bay Bakery</title>
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
</head>

<body class="open-sans bg-gray-50">

    <div class="max-w-md mx-auto min-h-screen flex flex-col items-center justify-center">
        <img src="./images/thank.webp" alt="">
        <p class="mb-5 text-sm text-gray-500 dark:text-gray-400">Your order has been placed. Your order id is <b><?php echo $_GET["orderid"]; ?></b></p>
        <p class="mb-5 text-sm text-gray-500 dark:text-gray-400">Continue shopping with us</p>
        <a href="/"
            class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm  px-5 py-2.5 text-center">
            Return
        </a>
    </div>
</body>

</html>