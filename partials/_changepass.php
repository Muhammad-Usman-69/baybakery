<?php

//taking email and pass
$email = $_POST["email"];
$pass = $_POST["password"];
$code = $_POST["verificationcode"];

//checking if email and pass are empty
if ($email == "" || $pass == "" || $code = "") {
    header("location: /?error=Invalid cresidentials");
    exit();
}

//verfiying email
include ("_dbconnect.php");
$sql = "SELECT * FROM `users` WHERE `email` = ?";
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "s", $email);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$num = mysqli_num_rows($result);
$row = mysqli_fetch_assoc($result);

//check if email is inavlid
if ($num == 0) {
    header("location: /?error=Invalid email");
    exit();
}

//taking id
$id = $row["id"];

//verifying code
$sql = "SELECT `code` FROM `verify` WHERE `id` = ?";
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "s", $id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$num = mysqli_num_rows($result);
$row = mysqli_fetch_assoc($result);

if ($code != $row["code"]) {
    header("location: /?error=Invalid code");
    exit();
}

$pass_hash = password_hash($pass, PASSWORD_DEFAULT);

//updating id
$sql = "UPDATE `users` SET `password` = ? WHERE `email` = ?";
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "ss", $pass_hash, $email);
mysqli_stmt_execute($stmt);

$new_code = '';

//reseting verify code
$sql = "UPDATE `verify` SET `code` = ? WHERE `id` = ?";
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "ss", $new_code, $id);
mysqli_stmt_execute($stmt);
header("location:/?alert=Your password has been changed");
exit();