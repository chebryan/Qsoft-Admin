<?php
//require("dao.php");
require_once("AfricasTalkingGateway.php");
  $username    = "qsoft";
	$apiKey      = "3da4460be41731440bf42ac3e10e175030d9863615acad81d9a39473a3e745a6";
	$shortCode = "21441";
	$keyword = "ss";
	$gateway = new AfricasTalkingGateway($username, $apiKey);
	$phoneno = "254790498850";
	try {
              $results= $gateway->createSubscription($phoneno, $shortCode, $keyword);
              echo "Keyword ".$keyword. "subscription Sent----->".$phoneno;
            } catch (AfricasTalkingGatewayException $e) {
              echo "Encountered an error while sending ".$e->getMessage();

            }

	//echo "Subscribers".$results;
?>
