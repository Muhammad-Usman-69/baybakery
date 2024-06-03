<?php
//checking if logged
if (!isset($_SESSION["logged"]) && $_SESSION["logged"] != true) {
    header("location:/?error=Not logged in");
    exit();
}

require __DIR__ . "/vendor/autoload.php";
use Infobip\Configuration;
use Infobip\Api\SmsApi;
use Infobip\Model\SmsDestination;
use Infobip\Model\SmsTextualMessage;
use Infobip\Model\SmsAdvancedTextualRequest;

//getting number from db
$sql = "SELECT `number` FROM `users` WHERE `id` = ?";
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "s", $userid);
mysqli_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$row = mysqli_fetch_assoc($result);
$number = $row["number"];
$base_url = "dknke1.api.infobip.com";
$api_key = "f01319ac328f735534c86a0c58462e49-846c2417-4d05-4073-b084-d3e1ae99fcea";


$configuration = new Configuration(host: $base_url, apiKey: $api_key);

$api = new SmsApi(config: $configuration);

$destination = new SmsDestination(to: $number);

$message = new SmsTextualMessage(
    destinations: [$destination],
    text: $message,
    from: "Bay Bakery"
);

$request = new SmsAdvancedTextualRequest(messages: [$message]);

$response = $api->sendSmsMessage($request);