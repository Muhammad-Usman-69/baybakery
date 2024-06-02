<?php 
    if (isset($_GET["msin"]) &&  $_GET["msin"] != "") {
        include("_dbconnect.php");
        session_start();
        $muman_id = $_SESSION["muman_id"];
        $msin = $_GET["msin"];
        $sql = "SELECT * FROM `cart` WHERE (`muman_id`, `msin`) = (?, ?)";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "ii", $muman_id, $msin);
        mysqli_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        $num = mysqli_num_rows($result);
        if ($num == 0) {
            $sql = "INSERT INTO `cart` (`muman_id`, `msin`) VALUES (?, ?)";
            $stmt = mysqli_prepare($conn, $sql);
            mysqli_stmt_bind_param($stmt, "ii", $muman_id, $msin);
            $result = mysqli_execute($stmt);
            if ($result) {
                session_write_close();
                echo '<script> window.location.href="/product.php?msin=' . $msin . '&alert=Product added to cart"; </script>';
                exit();
            } else {
                session_write_close();
                echo '<script> window.location.href="/product.php?msin=' . $msin . '&error=Unknown error occured. Please try again later"; </script>';
                exit();
            }
        } else {
            session_write_close();
            echo '<script> window.location.href="/product.php?msin=' . $msin . '&error=Product already in cart"; </script>';
            exit();
        }
    } else {
        echo '<script> window.location.href="/?error=Access denied"; </script>';
        exit();
    }
?>