<?php
require 'vendor/autoload.php';

class Mpesa{
	private function __construct(){}
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
		$url  = "";
	}

	public function reverse_transaction(){
		$url  = "";
	}

	public function mobile_checkout(){
		$url  = "";
	}

	public function transaction_status(){
		$url  = "";
	}

	public function (){
		$url  = "";
	}


	public function notifications(){}
	public function callback_url(){}
}