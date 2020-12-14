<?php
/* access token */
include('access_token.php');

 
  /* main request */
  $bal_url = 'https://sandbox.safaricom.co.ke/mpesa/accountbalance/v1/query';

  $curl = curl_init();
  curl_setopt($curl, CURLOPT_URL, $bal_url);
  curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type:application/json','Authorization:Bearer '.$access_token)); //setting custom header

  $curl_post_data = array(
    //Fill in the request parameters with valid values
    /* variables from Test Credentials on your developer account */
    'Initiator'           => 'apiop46',                      # initiator name -> For test, use Initiator name(Shortcode 1)
    'SecurityCredential'  => 'MSkVcPIt95QTJffZhC4DxqZOE+qQ1mP9t1sprZX2PbZGnCkbHjsnNmc6tdZaOj1Uc3dz5+zJ8uzIWWBUDPMnOXR/chmN+tJk5JlfiBjzfFPZiRqxExLK927NLYb7hvB0KbcJsJVpbhQ61q+8C+iXmUoRE2dtBco4GMAKyZFoUrrBRQTWUxhiKcm45GLxkAhDMAP10x0F3ymMFks9rbi0Dd/VQVOgttEVauaV2DOWJpR3l4fZqgGkAwFRayPhTv3gu9FFfQ0GukSiRLo90hsusGJQ4exxtN7OHaaa90zqhBVMl0cXKzKIpePRhKLWv89p5Bd1c6NwXLBhBKpTKsvLSQ==',                      #Base64 encoded string of the Security Credential, which is encrypted using M-Pesa public key 
    'CommandID'           => 'AccountBalance',        # Command ID, Possible value AccountBalance             
    'PartyA'              => '603003',                      # ShortCode 1, or your Paybill(During Production) 
    'IdentifierType'      => '4',                      
    'Remarks'             => 'Balance',                      # Comments- Anything can go here
    'QueueTimeOutURL'     => 'https://38c8690e8299.ngrok.io/MyPayment/balanceCallback_url.php',                      # URL where Timeout Response will be sent to
    'ResultURL'           => 'https://38c8690e8299.ngrok.io/MyPayment/balanceCallback_url.php'                       # URL where Result Response will be sent to
  );

  $data_string = json_encode($curl_post_data);
  curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
  curl_setopt($curl, CURLOPT_POST, true);
  curl_setopt($curl, CURLOPT_POSTFIELDS, $data_string);
  $curl_response = curl_exec($curl);
  print_r($curl_response);
?>
