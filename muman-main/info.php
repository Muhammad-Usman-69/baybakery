<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en" class="scroll-smooth">

<head>
    <meta charset="UTF-8">
    <meta name="author" content="Muhammad Usman">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>muman - Information</title>
    <link rel="shortcut icon" href="images/main/favicon.ico" type="image/x-icon">
</head>

<body class="bg-[#f5f4f4] hide-scrollbar flex flex-col min-h-[100vh]">
    <?php include("partials/_header.php"); ?>
    <?php 
        if (isset($_GET["t"]) && $_GET["t"] != "") {
            $type = $_GET["t"];
            if ($type == "about") {
                include("partials/_about.php");
            } else if ($type == "contact") {
                include("partials/_contact.php");
            } else if ($type == "faq") {
                include("partials/_faq.php");
            } else {
                echo "<script> window.location.href='/?error=Unknown info'; </script>";
            }
        } else {
            echo "<script> window.location.href='/?error=Info not specified'; </script>";
        }
    ?>
    <?php include("partials/_footer.php"); ?>
    <?php include("partials/_script.php"); ?>
</body>

</html>