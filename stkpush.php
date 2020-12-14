<?php
  //get access_token
  include('access_token.php');
  //defining variables
  $url = 'https://sandbox.safaricom.co.ke/mpesa/stkpush/v1/processrequest';
  /*provide the following details, this part is found on your test credentials on the developer account
  This are your info, for
  $PartyA should be the ACTUAL clients phone number or your phone number, format 2547********
  $AccountRefference, it maybe invoice number, account number etc on production systems, but for test just put anything
  TransactionDesc can be anything, probably a better description of or the transaction
  $Amount this is the total invoiced amount, Any amount here will be 
  actually deducted from a clients side/your test phone number once the PIN has been entered to authorize the transaction. 
  for developer/test accounts, this money will be reversed automatically by midnight.*/

  $BusinessShortCode = '174379';
  $PartyA = '254790517633'; // This is your phone number,254713350334 
  $Amount = '1';
  $AccountReference = 'TEST001';
  $TransactionDesc = 'my payment';
  $Passkey = 'bfb279f9aa9bdbcf158e97dd71a467cd2e0c893059b10f78e6b72ada1ed2c919';  
  $Timestamp = date('YmdHis');  //Get the timestamp, format YYYYmmddhms -> 20181004151020  
  $Password = base64_encode($BusinessShortCode.$Passkey.$Timestamp); //Get the base64 encoded string -> $password. The passkey is the M-PESA Public Key
  $CallBackURL = 'https://38c8690e8299.ngrok.io/MyPayment/stkCallback_url.php';

  $curl = curl_init();
  curl_setopt($curl, CURLOPT_URL, $url);
  curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type:application/json','Authorization:Bearer ' .$access_token)); //setting custom header
  
  
  $curl_post_data = array(
    //Fill in the request parameters with valid values
    'BusinessShortCode' => $BusinessShortCode,
    'Password' => $Password,
    'Timestamp' => $Timestamp,
    'TransactionType' => 'CustomerPayBillOnline',
    'Amount' => $Amount,
    'PartyA' => $PartyA,
    'PartyB' => $BusinessShortCode,
    'PhoneNumber' => $PartyA,
    'CallBackURL' => $CallBackURL,
    'AccountReference' => $AccountReference ,
    'TransactionDesc' => $TransactionDesc 
  );
  
  $data_string = json_encode($curl_post_data);
  
  curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
  curl_setopt($curl, CURLOPT_POST, true);
  curl_setopt($curl, CURLOPT_POSTFIELDS, $data_string);
  
  $curl_response = curl_exec($curl);
  print_r($curl_response);
  
  ?>