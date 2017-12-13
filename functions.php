<?php
require 'vendor/autoload.php';

class Mpesa{
	
	public function __construct(){
		$publicKey = "PATH_TO_CERTICATE";
		//$plaintext = "Safaricom132!";
		$plaintext = "YOUR_PASSWORD";
		openssl_public_encrypt($plaintext, $encrypted, $publicKey, OPENSSL_PKCS1_PADDING);
		echo base64_encode($encrypted);
	}


	public function authenticate(){
		$url = 'https://sandbox.safaricom.co.ke/oauth/v1/generate?grant_type=client_credentials';
		$curl = curl_init();
		curl_setopt($curl, CURLOPT_URL, $url);
		$credentials = base64_encode('YOUR_APP_CONSUMER_KEY:YOUR_APP_CONSUMER_SECRET');
		curl_setopt($curl, CURLOPT_HTTPHEADER, array('Authorization: Basic '.$credentials)); //setting a custom header
		curl_setopt($curl, CURLOPT_HEADER, true);
		curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
		$curl_response = curl_exec($curl);
		return json_decode($curl_response);
	}

	public function c2b_request(){
		$url = 'https://sandbox.safaricom.co.ke/mpesa/c2b/v1/registerurl';
		$curl = curl_init();
		curl_setopt($curl, CURLOPT_URL, $url);
		curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type:application/json','Authorization:Bearer ACCESS_TOKEN')); //setting custom header
		$curl_post_data = array(
		  //Fill in the request parameters with valid values
		  'ShortCode' => ' ',
		  'ResponseType' => ' ',
		  'ConfirmationURL' => 'http://ip_address:port/confirmation',
		  'ValidationURL' => 'http://ip_address:port/validation_url'
		);
		$data_string = json_encode($curl_post_data);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($curl, CURLOPT_POST, true);
		curl_setopt($curl, CURLOPT_POSTFIELDS, $data_string);
		$curl_response = curl_exec($curl);
		print_r($curl_response);
		return $curl_response;
	}

	public function b2c_request(){
		$url = 'https://sandbox.safaricom.co.ke/mpesa/b2c/v1/paymentrequest';
		$curl = curl_init();
		curl_setopt($curl, CURLOPT_URL, $url);
		curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type:application/json','Authorization:Bearer ACCESS_TOKEN')); //setting custom header
		$curl_post_data = array(
		  //Fill in the request parameters with valid values
		  'InitiatorName' => ' ',
		  'SecurityCredential' => ' ',
		  'CommandID' => ' ',
		  'Amount' => ' ',
		  'PartyA' => ' ',
		  'PartyB' => ' ',
		  'Remarks' => ' ',
		  'QueueTimeOutURL' => 'http://your_timeout_url',
		  'ResultURL' => 'http://your_result_url',
		  'Occasion' => ' '
		);
		$data_string = json_encode($curl_post_data);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($curl, CURLOPT_POST, true);
		curl_setopt($curl, CURLOPT_POSTFIELDS, $data_string);
		$curl_response = curl_exec($curl);
		// print_r($curl_response);
		return $curl_response;
	}

	public function b2b_request(){
		$url = 'https://sandbox.safaricom.co.ke/mpesa/b2b/v1/paymentrequest';
		$curl = curl_init();
		curl_setopt($curl, CURLOPT_URL, $url);
		curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type:application/json','Authorization:Bearer ACCESS_TOKEN')); //setting custom header
		$curl_post_data = array(
		  //Fill in the request parameters with valid values
		  'Initiator' => ' ',
		  'SecurityCredential' => ' ',
		  'CommandID' => ' ',
		  'SenderIdentifierType' => ' ',
		  'RecieverIdentifierType' => ' ',
		  'Amount' => ' ',
		  'PartyA' => ' ',
		  'PartyB' => ' ',
		  'AccountReference' => ' ',
		  'Remarks' => ' ',
		  'QueueTimeOutURL' => 'http://your_timeout_url',
		  'ResultURL' => 'http://your_result_url'
		);
		$data_string = json_encode($curl_post_data);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($curl, CURLOPT_POST, true);
		curl_setopt($curl, CURLOPT_POSTFIELDS, $data_string);
		$curl_response = curl_exec($curl);
		print_r($curl_response);
		return $curl_response;
	}

	public function account_balance(){
		$url = 'https://sandbox.safaricom.co.ke/mpesa/accountbalance/v1/query';
		$curl = curl_init();
		curl_setopt($curl, CURLOPT_URL, $url);
		curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type:application/json','Authorization:Bearer ACCESS_TOKEN')); //setting custom header
		$curl_post_data = array(
		  //Fill in the request parameters with valid values
		  'CommandID' => ' ',
		  'Initiator' => ' ',
		  'SecurityCredential' => ' ',
		  'CommandID' => 'AccountBalance',
		  'PartyA' => ' ',
		  'IdentifierType' => '4',
		  'Remarks' => ' ',
		  'QueueTimeOutURL' => 'https://ip_address:port/timeout_url',
		  'ResultURL' => 'https://ip_address:port/result_url'
		);
		$data_string = json_encode($curl_post_data);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($curl, CURLOPT_POST, true);
		curl_setopt($curl, CURLOPT_POSTFIELDS, $data_string);
		$curl_response = curl_exec($curl);
		print_r($curl_response);
		return $curl_response;
	}

	public function reverse_transaction(){
		$url  = "";$url = 'https://sandbox.safaricom.co.ke/mpesa/reversal/v1/request';
		$curl = curl_init();
		curl_setopt($curl, CURLOPT_URL, $url);
		curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type:application/json','Authorization:Bearer ACCESS_TOKEN')); //setting custom header
		$curl_post_data = array(
		  //Fill in the request parameters with valid values
		  'CommandID' => ' ',
		  'Initiator' => ' ',
		  'SecurityCredential' => ' ',
		  'CommandID' => 'TransactionReversal',
		  'TransactionID' => ' ',
		  'Amount' => ' ',
		  'ReceiverParty' => ' ',
		  'RecieverIdentifierType' => '4',
		  'ResultURL' => 'https://ip_address:port/result_url',
		  'QueueTimeOutURL' => 'https://ip_address:port/timeout_url',
		  'Remarks' => ' ',
		  'Occasion' => ' '
		);
		$data_string = json_encode($curl_post_data);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($curl, CURLOPT_POST, true);
		curl_setopt($curl, CURLOPT_POSTFIELDS, $data_string);
		$curl_response = curl_exec($curl);
		print_r($curl_response);
		return $curl_response;
	}

	public function mobile_checkout(){
		$url = 'https://sandbox.safaricom.co.ke/mpesa/stkpush/v1/processrequest';
		$curl = curl_init();
		curl_setopt($curl, CURLOPT_URL, $url);
		curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type:application/json','Authorization:Bearer ACCESS_TOKEN')); //setting custom header
		$curl_post_data = array(
		  //Fill in the request parameters with valid values
		  'BusinessShortCode' => ' ',
		  'Password' => ' ',
		  'Timestamp' => ' ',
		  'TransactionType' => 'CustomerPayBillOnline',
		  'Amount"' => ' ',
		  'PartyA' => ' ',
		  'PartyB' => ' ',
		  'PhoneNumber' => ' ',
		  'CallBackURL' => 'https://ip_address:port/callback',
		  'AccountReference' => ' ',
		  'TransactionDesc' => ' '
		);
		$data_string = json_encode($curl_post_data);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($curl, CURLOPT_POST, true);
		curl_setopt($curl, CURLOPT_POSTFIELDS, $data_string);
		$curl_response = curl_exec($curl);
		print_r($curl_response);
		return $curl_response;
	}

	public function mobile_checkout_query(){
		$url = 'https://sandbox.safaricom.co.ke/mpesa/stkpushquery/v1/query';
		$curl = curl_init();
		curl_setopt($curl, CURLOPT_URL, $url);
		curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type:application/json','Authorization:Bearer ACCESS_TOKEN')); //setting custom header
		$curl_post_data = array(
		  //Fill in the request parameters with valid values
		  'BusinessShortCode' => ' ',
		  'Password' => ' ',
		  'Timestamp' => ' ',
		  'CheckoutRequestID' => ' '
		);
		$data_string = json_encode($curl_post_data);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($curl, CURLOPT_POST, true);
		curl_setopt($curl, CURLOPT_POSTFIELDS, $data_string);
		$curl_response = curl_exec($curl);
		print_r($curl_response);
		return $curl_response;
	}

	public function transaction_status(){
		$url = 'https://sandbox.safaricom.co.ke/mpesa/transactionstatus/v1/query';
		$curl = curl_init();
		curl_setopt($curl, CURLOPT_URL, $url);
		curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type:application/json','Authorization:Bearer ACCESS_TOKEN')); //setting custom header
		$curl_post_data = array(
		  //Fill in the request parameters with valid values
		  'Initiator' => ' ',
		  'SecurityCredential' => ' ',
		  'CommandID' => 'TransactionStatusQuery',
		  'TransactionID' => ' ',
		  'PartyA' => ' ',
		  'IdentifierType' => '1',
		  'ResultURL' => 'https://ip_address:port/result_url',
		  'QueueTimeOutURL' => 'https://ip_address:port/timeout_url',
		  'Remarks' => ' ',
		  'Occasion' => ' '
		);
		$data_string = json_encode($curl_post_data);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($curl, CURLOPT_POST, true);
		curl_setopt($curl, CURLOPT_POSTFIELDS, $data_string);
		$curl_response = curl_exec($curl);
		print_r($curl_response);
		echo $curl_response;
	}
}