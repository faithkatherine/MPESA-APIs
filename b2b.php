<?php

  /* access token */
  include('access_token.php');

  /* variables from Test Credentials on your developer account */
  $Initiator = 'apiop46';                    # Initiator Name (Shortcode 1)
  $SecurityCredential = 'MSkVcPIt95QTJffZhC4DxqZOE+qQ1mP9t1sprZX2PbZGnCkbHjsnNmc6tdZaOj1Uc3dz5+zJ8uzIWWBUDPMnOXR/chmN+tJk5JlfiBjzfFPZiRqxExLK927NLYb7hvB0KbcJsJVpbhQ61q+8C+iXmUoRE2dtBco4GMAKyZFoUrrBRQTWUxhiKcm45GLxkAhDMAP10x0F3ymMFks9rbi0Dd/VQVOgttEVauaV2DOWJpR3l4fZqgGkAwFRayPhTv3gu9FFfQ0GukSiRLo90hsusGJQ4exxtN7OHaaa90zqhBVMl0cXKzKIpePRhKLWv89p5Bd1c6NwXLBhBKpTKsvLSQ==';           # SBase64 encoded string of the Security Credential, which is encrypted using M-Pesa public key
  $CommandID = 'BusinessPayBill';                    # possible values are: BusinessPayBill, MerchantToMerchantTransfer, MerchantTransferFromMerchantToWorking, MerchantServicesMMFAccountTransfer, AgencyFloatAdvance
  $SenderIdentifierType = '4';        # Type of organization sending the transaction.
  $Amount = '1050';
  $PartyA = '603003';                       # Shortcode 1
  $PartyB = '600000';                       # Shortcode 2
  $AccountReference = 'Bill Payment';             # Account Reference mandatory for “BusinessPaybill” CommandID.
  $Remarks = 'Pay For County Fines';                      # Anything Goes here/string/int/varchar
  $QueueTimeOutURL = 'https://38c8690e8299.ngrok.io/MyPayment/b2bCallback_url.php';              # QueueTimeOutURL
  //$ResultURL = 'https://38c8690e8299.ngrok.io/MyPayment/b2bCallback_url.php';                    # ResultURL
  $b2bHeader = ['Content-Type:application/json','Authorization:Bearer '.$access_token];

  /* Main B2B API Call Section */
  $b2b_url = 'https://sandbox.safaricom.co.ke/mpesa/b2b/v1/paymentrequest';
  $curl = curl_init();
  curl_setopt($curl, CURLOPT_URL, $b2b_url);
  curl_setopt($curl, CURLOPT_HTTPHEADER, $b2bHeader); //setting custom header

  $curl_post_data = array(
    //Fill in the request parameters with valid values
    'Initiator' => $Initiator,
    'SecurityCredential' => $SecurityCredential,
    'CommandID' => $CommandID,
    'SenderIdentifierType' => $SenderIdentifierType,
    'RecieverIdentifierType' => $SenderIdentifierType,
    'Amount' => $Amount,
    'PartyA' => $PartyA,
    'PartyB' => $PartyB,
    'AccountReference' => $AccountReference,
    'Remarks' => $Remarks,
    'QueueTimeOutURL' => $QueueTimeOutURL,
    'ResultURL' => $QueueTimeOutURL
  );

  $data_string = json_encode($curl_post_data);
  curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
  curl_setopt($curl, CURLOPT_POST, true);
  curl_setopt($curl, CURLOPT_POSTFIELDS, $data_string);
  $curl_response = curl_exec($curl);
  print_r($curl_response);

?>
