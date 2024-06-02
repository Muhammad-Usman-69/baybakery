<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["c-name"];
    $email = $_POST["c-email"];
    $inquiry = $_POST["c-inquiry"];
    $detail = $_POST["c-detail"];
    if ($name != "" && $email != "" && $inquiry != "" && $detail != "") {
        include("_dbconnect.php");
        $sql = "INSERT INTO `contact` (`name`, `email`, `inquiry`, `detail`) VALUES (?, ?, ?, ?);";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "ssss", $name, $email, $inquiry, $detail);
        $result = mysqli_execute($stmt);
        if ($result) {
            header("location: /?alert=Your inquiry has been recieved. Please wait");
            exit();
        } else {
            header("location: /?error=Error occured. Please try again later");
            exit();
        }
    } else {
        header("location: /?error=Invalid cresidentials");
        exit();
    }
} else {
    header("location: /?error=Access Denied");
    exit();
}
?>