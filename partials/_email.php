<?php
//check if server method is post
if ($_SERVER["REQUEST_METHOD"] != "POST") {
    header("location:/?error=Access denied");
    exit();
}

//taking email and pass
$email = $_POST["email"];
$pass = $_POST["password"];

//checking if email and pass are empty
if ($email == "" || $pass == "") {
    header("location: /login?error=Invalid cresidentials");
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

//getting id
$id = $row["id"];

?>

<!DOCTYPE html>
<html lang="en" class="scroll-smooth">

<head>
    <meta charset="UTF-8" />
    <link href="../side/style.css" rel="stylesheet" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="shortcut icon" href="images/logo.jfif" type="image/x-icon" />
    <title>Bay Bakery</title>
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
</head>

<body>
    <div class="h-screen w-full flex flex-col justify-center items-center bg-gray-800 space-y-8">

        <img src="../images/spinner.png" alt="" class="w-32 h-32 invert animate-spin-slow">

        <ul class="space-y-3">
            <!-- request container -->
            <li class="grid grid-cols-[32px_1fr] space-x-3">
                <div class="bg-green-500 p-1 rounded-sm">
                    <img src="../images/tickwhite.png" alt="" class="w-6 h-6">
                </div>
                <p class="text-gray-300 text-lg">Request Recieved</p>
            </li>

            <!-- progress container -->
            <li class="progress grid grid-cols-[32px_1fr] space-x-3">
                <div class="bg-green-500 p-1 rounded-sm">
                    <img src="../images/spinner.png" alt="" class="w-6 h-6 invert animate-spin-slow">
                </div>
                <p class="text-gray-300 text-lg">Sending Email...</p>
            </li>

            <!-- Verification Successful -->
            <li class="success transition-all duration-1000 grid grid-cols-[32px_1fr] space-x-3 opacity-0">
                <div class="bg-green-500 p-1 rounded-sm">
                    <img src="../images/tickwhite.png" alt="" class="w-6 h-6">
                </div>
                <p class="text-gray-300 text-lg">Email has been sent!</p>
            </li>

        </ul>
        <p class="redirect text-white text-lg opacity-0 transition-all duration-1000">You will be redirectred to the
            website in 5
        </p>
    </div>


    <?php

    session_start();

    function random_str(
        $length,
        $keyspace = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ'
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

    //taking code
    $code = random_str(64);

    // Import PHPMailer classes into the global namespace
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;

    // Load Composer's autoloader
    require '../PHPMailer/Exception.php';
    require '../PHPMailer/PHPMailer.php';
    require '../PHPMailer/SMTP.php';

    // Create a PHPMailer instance; passing `true` enables exceptions
    $mail = new PHPMailer(true);

    try {
        // Server settings
        $mail->SMTPDebug = SMTP::DEBUG_CONNECTION;
        ; // Disable verbose debug output
        $mail->isSMTP(); // Send using SMTP
        $mail->Host = 'smtp.gmail.com'; // Set the SMTP server to send through
        $mail->SMTPAuth = true; // Enable SMTP authentication
        $mail->Username = 'meraki4446996@gmail.com'; // SMTP username
        $mail->Password = 'eqvv wxjk mkht rcxw'; // SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS; // Enable TLS encryption
        $mail->Port = 465; // TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
        $mail->Timeout = 1;

        // Recipients
        $mail->setFrom('meraki4446996@gmail.com', 'BayBakery');
        $mail->addAddress($email, "User");

        //not showing errors
        $mail->SMTPDebug = false;
        $mail->do_debug = 0;

        // Content
        $mail->isHTML(true); // Set email format to HTML
        $mail->Subject = 'Reset Password';
        $mail->Body = 'Change password through following link: 
        <a href="192.168.18.172/partials/_changepass?verificationcode=' . $code . '&email=' . $email . '&password=' . $pass . '">Verify</a>';

        // Send email
        $r = $mail->send();

        //updating id
        $sql = "UPDATE `verify` SET `code` = ? WHERE `id` = ?";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "ss", $code, $id);
        mysqli_stmt_execute($stmt);
    } catch (Exception $e) {
        echo '<script>
    document.querySelector(".success").innerHTML = `<div class="bg-red-500 p-1 rounded-sm">
                <img src="../images/close.png" alt="" class="w-6 h-6 invert">
        </div>
        <p class="text-gray-300 text-lg">Please try again later</p>`;
    </script>';
    }

    ?>
    <script>
        let redirect = document.querySelector(".redirect");

        //taking i for decreamenting
        let i = 5;

        setTimeout(() => {
            //showing what has to be shown
            document.querySelector(".success").classList.add("opacity-100");
            redirect.classList.add("opacity-100");


            //redirecting to profile
            setInterval(() => {
                //stopping if 1
                if (i == -1) {
                    document.location.assign("../?alert=Please Check Your Email Account");
                    return;
                }

                redirect.innerHTML = "You will be redirectred to the website in " + i;

                i--;
            }, 700);
        }, 500);

    </script>

</body>

</html>