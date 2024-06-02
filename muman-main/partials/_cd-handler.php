<?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (isset($_POST["delete"]) && $_POST["delete"] == true && $_POST["delete"] != "") {
            include("_dbconnect.php");
            //take array
            $array = $_POST["delete"];
            //check the number selected checkbox
            $len = count($_POST["delete"]);
            //check the value of each
            for ($i = 0 ; $i < $len ; $i++) {
                $id = $array[$i];
                $sql = "DELETE FROM `cart` WHERE `cart_id` = ?";
                $stmt = mysqli_prepare($conn, $sql);
                mysqli_stmt_bind_param($stmt, "i", $id);
                mysqli_stmt_execute($stmt);
                if ($i == ($len - 1)) {
                    header("location: /cart.php?&alert=Delete successful");
                    exit();
                }
            }
        } else {
            header("location: /cart.php");
            exit();
        }
    } else {
        header("location: /?error=Access denied");
        exit();
    }
    
?>