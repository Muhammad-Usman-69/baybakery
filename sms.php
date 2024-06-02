<?php
require __DIR__ . "/vendor/autoload.php";
use Infobip\Configuration;
use Infobip\Api\SmsApi;
use Infobip\Model\SmsDestination;
use Infobip\Model\SmsTextualMessage;
use Infobip\Model\SmsAdvancedTextualRequest;

$number = "+923176535345";
$message = "Hey from bay bakery";
$base_url = "y3m5nj.api.infobip.com";
$api_key = "a8b903ad34df83d00e5e1f566f076ad7-dd3d8000-b9b7-40a0-9a1a-73d5bf42b38b";


$configuration = new Configuration(host: $base_url, apiKey: $api_key);

$api = new SmsApi(config: $configuration);

$destination = new SmsDestination(to: $number);

$message = new SmsTextualMessage(
    destinations: [$destination],
    text: $message,
    from: "bay bakery"
);

$request = new SmsAdvancedTextualRequest(messages: [$message]);

$response = $api->sendSmsMessage($request);

echo "Done";