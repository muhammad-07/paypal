<?php
require "app/start.php";

use PayPal\Api\Payment;
use PayPal\Api\PaymentExecution;

if(!isset($_GET["success"] , $_GET["paymentId"] , $_GET["PayerID"])){
	die('Invalid or incomplete transaction.');
}

if((bool) $_GET["success"] === false){
	die('Payment was not successful.');
}

$paymentId = $_GET["paymentId"];
$payerId = $_GET["PayerID"];

$payment = Payment::get($paymentId,$apiContext );
$execute = new PaymentExecution();
$execute->setPayerId($payerId);

try{
	$result = $payment->execute($execute , $apiContext );
	/* var_dump($result); */
	print "Thanks for Payment";
}
catch(Exception $e){
	$data = json_decode($e->getData());
	var_dump($data->message);
	die();
}
