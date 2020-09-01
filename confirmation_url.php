<?php

header("Content-Type:application/json");

$response = '{  
       "ResultCode": 0
       "ResultDesc": "confirmation received successfully"
}';

//DATA
$mpesaResponse = file_get_contents('php://input');

//log the response

$logFile = "M_pesaConfirmationResponse.txt";
$jsonMpesaResponse = json_decode($mpesaResponse, true);

// write file

$log = fopen($logFile, "a");

fwrite($log, $jsonmpesaResponse);
fclose($log);

echo $response

?>