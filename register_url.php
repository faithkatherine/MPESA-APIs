<?php

	$consumerkey = "3ocIH6gitgAGQGa8OChkP5EwgwqzCYJ4";
	$consumersecret = "KAMriE9VEHqp9GQB";

	$headers = ['Content-Type: applications/json; char-set = UTF-8'];

	$url = 'https://sandbox.safaricom.co.ke/oauth/v1/generate?grant_type=client_credentials';

	$curl = curl_init($url);
	curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);

	curl_setopt($curl, CURLOPT_HEADER, FALSE);
	curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE);
	curl_setopt($curl, CURLOPT_USERPWD, $consumerkey.':'.$consumersecret);

	$result = curl_exec($curl);
	$status = curl_getinfo($ch, CURLINFO_HTTP_CODE);
	$result = json_decode($result);

	$access_token = $result->access_token;

	echo $access_token;

	$url = 'https://sandbox.safaricom.co.ke/mpesa/c2b/v1/registerurl';
	
	$curl = curl_init();
	curl_setopt($curl, CURLOPT_URL, $url);
	curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type:application/json','Authorization:Bearer ' .$access_token)); //setting custom header
	
	
	$curl_post_data = array(
		//Fill in the request parameters with valid values
		'ShortCode' => ' 174379 ',
		'ResponseType' => ' Confirmed ',
		'ConfirmationURL' => 'https://amazingpayment.herokuapp.com/confirmation_url.php',
		'ValidationURL' => 'https://amazingpayment.herokuapp.com/validation_url.php'
	);
	
	$data_string = json_encode($curl_post_data);
	
	curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($curl, CURLOPT_POST, true);
	curl_setopt($curl, CURLOPT_POSTFIELDS, $data_string);
	
	$curl_response = curl_exec($curl);
	print_r($curl_response);
	

	?>
	