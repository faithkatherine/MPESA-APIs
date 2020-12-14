<?php
  /* Obtain Access Token */
  include('access_token.php');

  /* Urls */
  $b2c_url = 'https://sandbox.safaricom.co.ke/mpesa/b2c/v1/paymentrequest';

  /* from the test credentials provided on you developers account */
  $InitiatorName = 'apiop46';      # Initiator
  $SecurityCredential ='MSkVcPIt95QTJffZhC4DxqZOE+qQ1mP9t1sprZX2PbZGnCkbHjsnNmc6tdZaOj1Uc3dz5+zJ8uzIWWBUDPMnOXR/chmN+tJk5JlfiBjzfFPZiRqxExLK927NLYb7hvB0KbcJsJVpbhQ61q+8C+iXmUoRE2dtBco4GMAKyZFoUrrBRQTWUxhiKcm45GLxkAhDMAP10x0F3ymMFks9rbi0Dd/VQVOgttEVauaV2DOWJpR3l4fZqgGkAwFRayPhTv3gu9FFfQ0GukSiRLo90hsusGJQ4exxtN7OHaaa90zqhBVMl0cXKzKIpePRhKLWv89p5Bd1c6NwXLBhBKpTKsvLSQ==';
  $CommandID = 'SalaryPayment';          # choose between SalaryPayment, BusinessPayment, PromotionPayment 
  $Amount = '1000';
  $PartyA = '603003';             # shortcode 1
  $PartyB = '254708374149';             # Phone number you're sending money to
  $Remarks = 'Salary';      # Remarks ** can not be empty
  $QueueTimeOutURL ='https://38c8690e8299.ngrok.io/MyPayment/b2cCallback_url.php';    # your QueueTimeOutURL
  $ResultURL ='https://38c8690e8299.ngrok.io/MyPayment/b2cCallback_url.php';          # your ResultURL
  $Occasion = 'salary November 2020';           # Occasion

  /* Main B2C Request to the API */
  $b2cHeader = ['Content-Type:application/json','Authorization:Bearer '.$access_token];
  $curl = curl_init();
  curl_setopt($curl, CURLOPT_URL, $b2c_url);
  curl_setopt($curl, CURLOPT_HTTPHEADER, $b2cHeader); //setting custom header

  $curl_post_data = array(
    //Fill in the request parameters with valid values
    'InitiatorName' => $InitiatorName,
    'SecurityCredential' => $SecurityCredential,
    'CommandID' => $CommandID,
    'Amount' => $Amount,
    'PartyA' => $PartyA,
    'PartyB' => $PartyB,
    'Remarks' => $Remarks,
    'QueueTimeOutURL' => $QueueTimeOutURL,
    'ResultURL' => $ResultURL,
    'Occasion' => $Occasion
  );

  $data_string = json_encode($curl_post_data);
  curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
  curl_setopt($curl, CURLOPT_POST, true);
  curl_setopt($curl, CURLOPT_POSTFIELDS, $data_string);
  $curl_response = curl_exec($curl);
  print_r($curl_response);
 
?>
