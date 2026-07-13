<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');

// WEKA CREDENTIALS ZAKO HAPA KUTOKA KWA SCREENSHOT
$BASIC_AUTH_TOKEN = "Basic ZUVhbGk1NGJGRkNkMWRIaUhuYVpSWDFnYjA1UGVNSEhOVVc4d1ZoWk4yOTVXakQyWnJSd2NIZHNjM1VtMXNYRGE1R05UbkE9PQ=="; 
$CHANNEL_ID = 10837; // ACCOUNT ID yako

$input = json_decode(file_get_contents('php://input'), true);
$amount = $input['amount'];
$phone = $input['phone'];

if(substr($phone, 0, 1) == '0'){ $phone = '254' . substr($phone, 1); }
$reference = "DEMO-".time();

$curl = curl_init();
curl_setopt_array($curl, [
  CURLOPT_URL => 'https://api.payhero.co.ke/api/v2/payments',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_POST => true,
  CURLOPT_HTTPHEADER => [
    'Authorization: ' . $BASIC_AUTH_TOKEN,
    'Content-Type: application/json'
  ],
  CURLOPT_POSTFIELDS => json_encode([
    "amount" => $amount,
    "phone_number" => $phone,
    "channel_id" => $CHANNEL_ID,
    "provider" => "mpesa",
    "external_reference" => $reference,
    "callback_url" => "https://your-app.onrender.com/callback.php" // BADILISHA HII
  ]),
]);
$response = curl_exec($curl);
curl_close($curl);
echo $response;
?>
