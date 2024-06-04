<?php
//check if req is fost
if ($_SERVER["REQUEST_METHOD"] != "POST") {
    header("location: /signup?error=Access denied. Please try again later");
    exit();
}

//adding db
include ("_dbconnect.php");

//str for id
function random_str(
    $length,
    $keyspace = '0123456789'
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

//taking diff values
$name = $_POST["name"];
$email = $_POST["email"];
$number = $_POST["number"];
$pass = $_POST["password"];
$id = strtolower($name);

//check if name is in use
$sql = "SELECT * FROM `users` WHERE `name` = ?";
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "s", $name);
mysqli_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$num = mysqli_num_rows($result);
if ($num != 0) {
    $id = $name . "-" . random_str(3);
}

if (substr($number, 0, 3) != "+92") {
    header("location:/signup?error=Wrong Number Format");
    exit();
}

//check if any input is empty
if ($name == "" || $email == "" || $number == "" || $pass == "") {
    header("location: /signupup?error=Invalid cresidentials.");
    exit();
}

//check if email already exists
$sql = "SELECT * FROM `users` WHERE `email` = ?";
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "s", $email);
mysqli_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$num = mysqli_num_rows($result);
if ($num != 0) {
    header("location: /signup?error=Email already in use");
    exit();
}

//check if number already exists
$sql = "SELECT * FROM `users` WHERE `number` = ?";
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "s", $number);
mysqli_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$num = mysqli_num_rows($result);
if ($num != 0) {
    header("location: /signup?error=Number already in use");
    exit();
}

//inserting accont to db
$email = htmlspecialchars($email, ENT_QUOTES, 'UTF-8');
$pass = htmlspecialchars($pass, ENT_QUOTES, 'UTF-8');
$pass_hash = password_hash($pass, PASSWORD_DEFAULT);
$sql = "INSERT INTO `users` (`id`, `name`, `email`, `number`, `password`) VALUES (?, ?, ?, ?, ?)";
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "sssss", $id, $name, $email, $number, $pass_hash);
$result = mysqli_stmt_execute($stmt);

//inserting into verify
$sql = "INSERT INTO `verify` (`id`) VALUES (?)";
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "s", $id);
$result = mysqli_stmt_execute($stmt);

//checking if error occured
if (!$result) {
    header("location: /signup?error=Error occured. Please try again later");
    exit();
}

header("location: /login?alert=You have been signed up. Kindly log in");
exit();