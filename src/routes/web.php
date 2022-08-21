<?php

use App\Parser;
use App\Route;

(new Route)->get('/', function() {
	$parserUser = new Parser;
	$parserUser->processInput('user-channel.txt');
	$userMaxMonolog = $parserUser->get('max_monolog');
	$userArray = $parserUser->get('silences');
	$totalDuration = $parserUser->get('totalDuration');
	$userPercentage = ($userMaxMonolog / $totalDuration) * 100;

	$parserCustomer = new Parser;

	$parserCustomer->processInput('customer-channel.txt');
	$customerMaxMonolog = $parserCustomer->get('max_monolog');
	$customerArray = $parserCustomer->get('silences');

	$result = json_encode([
		"longest_user_monologue" =>  $userMaxMonolog,
		"longest_customer_monologue" => $customerMaxMonolog,
		"user_talk_percentage" => $userPercentage,
		"user" => $userArray,
		"customer" => $customerArray
	]);

	print_r($result);
});