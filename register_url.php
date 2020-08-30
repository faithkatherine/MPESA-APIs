<?php
	$url = 'https://sandbox.safaricom.co.ke/oauth/v1/generate?grant_type=client_credentials';
	
	$curl = curl_init();
	curl_setopt($curl, CURLOPT_URL, $url);
	$credentials = base64_encode('3ocIH6gitgAGQGa8OChkP5EwgwqzCYJ4:KAMriE9VEHqp9GQB');
	curl_setopt($curl, CURLOPT_HTTPHEADER, array('Authorization: Basic '.$credentials)); //setting a custom header
	curl_setopt($curl, CURLOPT_HEADER, false);
	curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
	
	$curl_response = curl_exec($curl);
	
	echo"<pre> ACCESS_TOKEN" .json_decode($curl_response)->ACCESS_TOKEN. "</pre>";

	$url = 'https://sandbox.safaricom.co.ke/mpesa/c2b/v1/registerurl';
	
	$curl = curl_init();
	curl_setopt($curl, CURLOPT_URL, $url);
	curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type:application/json','Authorization:Bearer ACCESS_TOKEN')); //setting custom header
	
	
	$curl_post_data = array(
		//Fill in the request parameters with valid values
		'ShortCode' => ' 174379 ',
		'ResponseType' => ' Confirmed ',
		'ConfirmationURL' => 'https://mymppesa.herokuapp.com/confirmation_url.php',
		'ValidationURL' => 'https://mympesa.herokuapp.com/validation_url.php'
	);
	
	$data_string = json_encode($curl_post_data);
	
	curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($curl, CURLOPT_POST, true);
	curl_setopt($curl, CURLOPT_POSTFIELDS, $data_string);
	
	$curl_response = curl_exec($curl);
	print_r($curl_response);
	

	?>
	