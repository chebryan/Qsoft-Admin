<?php                                                                                            
require("dao.php");
require_once("AfricasTalkingGateway.php");
date_default_timezone_set('Africa/Nairobi');
// new API key 3da4460be41731440bf42ac3e10e175030d9863615acad81d9a39473a3e745a6

         /*       
$number = '+245728369514';
$shortcode = '21441';
$keyword = 'jb';
$updateType = 'Addition';
*/

$number =$_POST['phoneNumber'];
$shortcode =$_POST['shortCode'];
$keyword =$_POST['keyword'];
$updateType =$_POST['updateType'];



//global variables
$dates = date("Y-m-d");
$today = date("H:i:s");
$currTime = date("Y-m-d H:i:s", time()); 
$outputString  = strtolower($keyword);
$status = "0"; //0 means the subscriber is Active. 1 means the user has unsubscribed
$sentsubstatus ="0"; //0 means its the first time sent message and 1 means the second time
global $dbh;  
$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$username    = "qsoft";
$apiKey      = "3da4460be41731440bf42ac3e10e175030d9863615acad81d9a39473a3e745a6";
$fromParam = "21441";
$recipients  = $number;
$bulkSMSMode = 0; //0 means the receiver is charged
$retryDurationInHours = 12; //retry for 12 hours
$enqueue = 1; //1 sent msgs to server and queue b4 getting response from safcom





//1. JB Stuff
$keyword_JB = 'jb';
$subscribeMessage_JB = "Click Here http://74.119.144.21/AM_JB_Miliano_by_Jose_Chameleone.mp3 to download the song as your ringtone. Looking for LOVE, sms PENZI or LOVE to 21441";
$unsubscribeMessage_JB ="You have been unsubscribed Qsoft Ringtones. Are you looking for LOVE, sms LOVE or PENZI to 21441 and meet your soulmate Today";
//2.  CASH
$keyword_CASH = 'cash';
$subscribeMessage_CASH = "You have succesfully been subscribed for the Competition. Wait for our Call response and be our winnner of the day. ";
$unsubscribeMessage_CASH ="You have been unsubscribed from the Promotion. To join, SMS cash to 21441 and stand a chance of winning";
// 3. KENYA
$keyword_KENYA = 'kenya';
$subscribeMessage_KENYA = "You have be subscribed to the NEW draw. Thank you for participating in the promotion. Wait for our Call";
$unsubscribeMessage_KENYA ="You have been unsubscribed from the Promotion. To join, SMS kenya to 21441 and stand a chance of winning";
//4. AM Stuff
$keyword_AM = 'am';
$subscribeMessage_AM = "Click Here http://74.119.144.21/AM_NitampataWapi_By_Diamond.mp3 to download the song as your ringtone. Looking for LOVE, sms PENZI or LOVE to 21441";
$unsubscribeMessage_AM ="You have been unsubscribed Qsoft Ringtones. Are you looking for LOVE, sms LOVE or PENZI to 21441 and meet your soulmate Today";
//5. KK Stuff
$keyword_KK = 'kk';
$subscribeMessage_KK = "Click Here http://74.119.144.21/FM_Facebook_RoseMuhando.mp3 to download the song as your ringtone. Looking for LOVE, sms PENZI or LOVE to 21441";
$unsubscribeMessage_KK ="You have been unsubscribed Qsoft Ringtones. Are you looking for LOVE, sms LOVE or PENZI to 21441 and meet your soulmate Today";
//6. SS Stuff
$keyword_SS = 'ss';
$subscribeMessage_SS = "Click here http://74.119.144.21/SS_Mwowon_bt_Superstar.mp3 to download the song as your ringtone. Looking for LOVE, sms PENZI or LOVE to 21441";
$unsubscribeMessage_SS ="You have been unsubscribed Qsoft Ringtones. Are you looking for LOVE, sms LOVE or PENZI to 21441 and meet your soulmate Today";
//7. MM Stuff
$keyword_MM = 'mm';
$subscribeMessage_MM = "Click Here http://74.119.144.21/MM_Outing_MikeRotich.mp3 to download the song as your ringtone. Looking for LOVE, sms PENZI or LOVE to 21441";
$unsubscribeMessage_MM ="You have been unsubscribed Qsoft Ringtones. Are you looking for LOVE, sms LOVE or PENZI to 21441 and meet your soulmate Today";
//8. FM Stuff
$keyword_FM = 'fm';
$subscribeMessage_FM = "Click Here http://74.119.144.21/FM_Facebook_RoseMuhando.mp3 to download the song as your ringtone. Looking for LOVE, sms PENZI or LOVE to 21441";
$unsubscribeMessage_FM ="You have been unsubscribed Qsoft Ringtones. Are you looking for LOVE, sms LOVE or PENZI to 21441 and meet your soulmate Today";
//9. KY Stuff
$keyword_KY = 'ky';
$subscribeMessage_KY = "Click Here http://74.119.144.21/KY_Mwana_by_Ali_Kiba.mp3 to download the song as your ringtone. Looking for LOVE, sms PENZI or LOVE to 21441";
$unsubscribeMessage_KY ="You have been unsubscribed Qsoft Ringtones. Are you looking for LOVE, sms LOVE or PENZI to 21441 and meet your soulmate Today";
//10. PENZI Stuff
$keyword_PENZI = 'penzi';
$subscribeMessage_PENZI = "The more i meet u the more u appear new...The more i know u the more i want to love u.Click Here: http://patampenzi.com/ to meet your soul mate today.";
$unsubscribeMessage_PENZI ="You have been unsubscribed Qsoft Ringtones. Are you looking for LOVE, sms LOVE or PENZI to 21441 and meet your soulmate Today";
//11. LOVE Stuff
$keyword_LOVE = 'love';
$subscribeMessage_LOVE = "The more i meet u the more u appear new...The more i know u the more i want to love u.Click Here: http://patampenzi.com/ to meet your soul mate today.";
$unsubscribeMessage_LOVE ="You have been unsubscribed Qsoft Ringtones. Are you looking for LOVE, sms LOVE or PENZI to 21441 and meet your soulmate Today";
//12. SHULE Stuff
$keyword_SHULE = 'shule';
$subscribeMessage_SHULE = "SHULE-You have be subscribed to the draw. Thank you for participating in the promotion. Wait for our Call";
$unsubscribeMessage_SHULE ="You have been unsubscribed from the Promotion. To join, SMS shule to 21441 and stand a chance of winning";

//13. NEWS Stuff
$keyword_NEWS = 'news';
$subscribeMessage_NEWS = "Welcme to the Latest Breaking News Content Provider. Get Breaking news as they unfold";
$unsubscribeMessage_NEWS ="You have been unsubscribed from News updates Alerts";

//14. BIBLE Stuff
$keyword_BIBLE = 'bible';
$subscribeMessage_BIBLE = "Welcome to daily inpirations hub. Stay Inpsired with great verses daily.";
$unsubscribeMessage_BIBLE ="You have been unsubscribed from Bible inspirational Alerts";


   /**
  *
  * Test PDO Subscription
  * Keyword JB
   */
//JB Keyword Subscription
if ($outputString == $keyword_JB) {
	 
	 if ( $updateType == 'Addition' ) {
	 	   $data = '';
	 	   $message = $subscribeMessage_JB;
	 	    $keyword = $keyword_JB;
		   $sql = $dbh->prepare("INSERT INTO tbl_totalsubscribers(total_phoneno,total_keyword,total_date,total_time,total_status) VALUES (:phone,:keyword,:tarehe, :currtime,:status)");
		   $sql->bindParam(":phone", $number );   
  		   $sql->bindParam(":keyword", $keyword );
  		   $sql->bindParam(":tarehe", $dates );   
  		   $sql->bindParam(":currtime", $currTime );
  		   $sql->bindParam(":status", $status );
		   try {      
			    $data = $sql->execute();			    
			  } catch(PDOException $e) {			      
			    echo $e->getMessage();			    
			  }
			if ($data) {
				$options  = array('keyword' => $keyword, 'retryDurationInHours'=>$retryDurationInHours);
				$gateway  = new AfricaStalkingGateway($username, $apiKey);	
	    		$results  = $gateway->sendMessage($recipients, $message, $fromParam, $bulkSMSMode,$options);
	    		if ( count($results) ) {
			    	foreach($results as $result){
			    		$sNumber = $result->number;
			    		$sMessageId = $result->messageId;
			    		$sStatus = "Sent";
	    				}
						AddToSentTable($sNumber,$sMessageId,$message,$keyword,$sStatus,$sentsubstatus,$dates); //submit to db after first subscription
				} else {
					echo "No Message Sent";
				}
		}
		  
 }
else if ( $updateType == 'Deletion' ) {
			   $data ='';
			   $message = $unsubscribeMessage_JB;
			    $keyword = $keyword_JB;
			   $sql = $dbh->prepare("UPDATE tbl_totalsubscribers SET total_status = :status WHERE total_phoneno = :phone");
			   $sql->bindParam(":status", $status );   
			   $sql->bindParam(":phone", $number );			   
			   try {
			      $data = $sql->execute();			    
			  } catch(PDOException $e) {			      
			    echo $e->getMessage();			    
			  }
			  if ($data) {
			  	 $options     = array('keyword' => $keyword, 'retryDurationInHours'=>$retryDurationInHours);
			  	 $gateway  = new AfricaStalkingGateway($username, $apiKey);	
	   			 $results  = $gateway->sendMessage($recipients, $message, $fromParam, $bulkSMSMode,$options);
			  	if ( count($results) ) {
					    	foreach($results as $result){
					    		$sNumber = $result->number;
					    		$sMessageId = $result->messageId;
					    		$sStatus = "Sent";
					    	}
					  AddToSentTable($sNumber,$sMessageId,$message,$keyword,$sStatus,$sentsubstatus,$dates); //submit to db after first subscription
					} else {
						
					}
			  }
	 }
}
//CASH Keyword Subscription
else if ($outputString == $keyword_CASH) {
	 
	 if ( $updateType == 'Addition' ) {
	 	   $data = '';
	 	   $message = $subscribeMessage_CASH;
	 	   $keyword = $keyword_CASH;
		   $sql = $dbh->prepare("INSERT INTO tbl_totalsubscribers(total_phoneno,total_keyword,total_date,total_time,total_status) VALUES (:phone,:keyword,:tarehe, :currtime,:status)");
		   $sql->bindParam(":phone", $number );   
  		   $sql->bindParam(":keyword", $keyword );
  		   $sql->bindParam(":tarehe", $dates );   
  		   $sql->bindParam(":currtime", $currTime );
  		   $sql->bindParam(":status", $status );
		   try {      
			    $data = $sql->execute();			    
			  } catch(PDOException $e) {			      
			    echo $e->getMessage();			    
			  }
			if ($data) {
				$options  = array('keyword' => $keyword, 'retryDurationInHours'=>$retryDurationInHours);
				$gateway  = new AfricaStalkingGateway($username, $apiKey);	
	    		$results  = $gateway->sendMessage($recipients, $message, $fromParam, $bulkSMSMode,$options);
	    		if ( count($results) ) {
			    	foreach($results as $result){
			    		$sNumber = $result->number;
			    		$sMessageId = $result->messageId;
			    		$sStatus = "Sent";
	    				}
						AddToSentTable($sNumber,$sMessageId,$message,$keyword,$sStatus,$sentsubstatus,$dates); //submit to db after first subscription
				} else {
					echo "No Message Sent";
				}
		}
		  
 }
else if ( $updateType == 'Deletion' ) {
			   $data ='';
			   $message = $unsubscribeMessage_CASH;
			   $keyword = $keyword_CASH;
			   $sql = $dbh->prepare("UPDATE tbl_totalsubscribers SET total_status = :status WHERE total_phoneno = :phone");
			   $sql->bindParam(":status", $status );   
			   $sql->bindParam(":phone", $number );			   
			   try {
			      $data = $sql->execute();			    
			  } catch(PDOException $e) {			      
			    echo $e->getMessage();			    
			  }
			  if ($data) {
			  	 $options     = array('keyword' => $keyword, 'retryDurationInHours'=>$retryDurationInHours);
			  	 $gateway  = new AfricaStalkingGateway($username, $apiKey);	
	   			 $results  = $gateway->sendMessage($recipients, $message, $fromParam, $bulkSMSMode,$options);
			  	if ( count($results) ) {
					    	foreach($results as $result){
					    		$sNumber = $result->number;
					    		$sMessageId = $result->messageId;
					    		$sStatus = "Sent";
					    	}
					  AddToSentTable($sNumber,$sMessageId,$message,$keyword,$sStatus,$sentsubstatus,$dates); //submit to db after first subscription
					} else {
						
					}
			  }
	 }
}
//KENYA Keyword Subscription
else if ($outputString == $keyword_KENYA) {
	 
	 if ( $updateType == 'Addition' ) {
	 	   $data = '';
	 	   $message = $subscribeMessage_KENYA;
	 	   $keyword = $keyword_KENYA;
		   $sql = $dbh->prepare("INSERT INTO tbl_totalsubscribers(total_phoneno,total_keyword,total_date,total_time,total_status) VALUES (:phone,:keyword,:tarehe, :currtime,:status)");
		   $sql->bindParam(":phone", $number );   
  		   $sql->bindParam(":keyword", $keyword );
  		   $sql->bindParam(":tarehe", $dates );   
  		   $sql->bindParam(":currtime", $currTime );
  		   $sql->bindParam(":status", $status );
		   try {      
			    $data = $sql->execute();			    
			  } catch(PDOException $e) {			      
			    echo $e->getMessage();			    
			  }
			if ($data) {
				$options  = array('keyword' => $keyword, 'retryDurationInHours'=>$retryDurationInHours);
				$gateway  = new AfricaStalkingGateway($username, $apiKey);	
	    		$results  = $gateway->sendMessage($recipients, $message, $fromParam, $bulkSMSMode,$options);
	    		if ( count($results) ) {
			    	foreach($results as $result){
			    		$sNumber = $result->number;
			    		$sMessageId = $result->messageId;
			    		$sStatus = "Sent";
	    				}
						AddToSentTable($sNumber,$sMessageId,$message,$keyword,$sStatus,$sentsubstatus,$dates); //submit to db after first subscription
				} else {
					echo "No Message Sent";
				}
		}
		  
 }
else if ( $updateType == 'Deletion' ) {
			   $data ='';
			   $message = $unsubscribeMessage_KENYA;
			   $keyword = $keyword_KENYA;
			   $sql = $dbh->prepare("UPDATE tbl_totalsubscribers SET total_status = :status WHERE total_phoneno = :phone");
			   $sql->bindParam(":status", $status );   
			   $sql->bindParam(":phone", $number );			   
			   try {
			      $data = $sql->execute();			    
			  } catch(PDOException $e) {			      
			    echo $e->getMessage();			    
			  }
			  if ($data) {
			  	 $options     = array('keyword' => $keyword, 'retryDurationInHours'=>$retryDurationInHours);
			  	 $gateway  = new AfricaStalkingGateway($username, $apiKey);	
	   			 $results  = $gateway->sendMessage($recipients, $message, $fromParam, $bulkSMSMode,$options);
			  	if ( count($results) ) {
					    	foreach($results as $result){
					    		$sNumber = $result->number;
					    		$sMessageId = $result->messageId;
					    		$sStatus = "Sent";
					    	}
					  AddToSentTable($sNumber,$sMessageId,$message,$keyword,$sStatus,$sentsubstatus,$dates); //submit to db after first subscription
					} else {
						
					}
			  }
	 }
}
//AM Keyword Subscription
else if ($outputString == $keyword_AM) {
	 
	 if ( $updateType == 'Addition' ) {
	 	   $data = '';
	 	   $message = $subscribeMessage_AM;
	 	   $keyword = $keyword_AM;
		   $sql = $dbh->prepare("INSERT INTO tbl_totalsubscribers(total_phoneno,total_keyword,total_date,total_time,total_status) VALUES (:phone,:keyword,:tarehe, :currtime,:status)");
		   $sql->bindParam(":phone", $number );   
  		   $sql->bindParam(":keyword", $keyword );
  		   $sql->bindParam(":tarehe", $dates );   
  		   $sql->bindParam(":currtime", $currTime );
  		   $sql->bindParam(":status", $status );
		   try {      
			    $data = $sql->execute();			    
			  } catch(PDOException $e) {			      
			    echo $e->getMessage();			    
			  }
			if ($data) {
				$options  = array('keyword' => $keyword, 'retryDurationInHours'=>$retryDurationInHours);
				$gateway  = new AfricaStalkingGateway($username, $apiKey);	
	    		$results  = $gateway->sendMessage($recipients, $message, $fromParam, $bulkSMSMode,$options);
	    		if ( count($results) ) {
			    	foreach($results as $result){
			    		$sNumber = $result->number;
			    		$sMessageId = $result->messageId;
			    		$sStatus = "Sent";
	    				}
						AddToSentTable($sNumber,$sMessageId,$message,$keyword,$sStatus,$sentsubstatus,$dates); //submit to db after first subscription
				} else {
					echo "No Message Sent";
				}
		}
		  
 }
else if ( $updateType == 'Deletion' ) {
			   $data ='';
			   $message = $unsubscribeMessage_AM;
			   $keyword = $keyword_AM;
			   $sql = $dbh->prepare("UPDATE tbl_totalsubscribers SET total_status = :status WHERE total_phoneno = :phone");
			   $sql->bindParam(":status", $status );   
			   $sql->bindParam(":phone", $number );			   
			   try {
			      $data = $sql->execute();			    
			  } catch(PDOException $e) {			      
			    echo $e->getMessage();			    
			  }
			  if ($data) {
			  	 $options     = array('keyword' => $keyword, 'retryDurationInHours'=>$retryDurationInHours);
			  	 $gateway  = new AfricaStalkingGateway($username, $apiKey);	
	   			 $results  = $gateway->sendMessage($recipients, $message, $fromParam, $bulkSMSMode,$options);
			  	if ( count($results) ) {
					    	foreach($results as $result){
					    		$sNumber = $result->number;
					    		$sMessageId = $result->messageId;
					    		$sStatus = "Sent";
					    	}
					  AddToSentTable($sNumber,$sMessageId,$message,$keyword,$sStatus,$sentsubstatus,$dates); //submit to db after first subscription
					} else {
						
					}
			  }
	 }
}
//KK Keyword Subscription
else if ($outputString == $keyword_KK) {
	 
	 if ( $updateType == 'Addition' ) {
	 	   $data = '';
	 	   $message = $subscribeMessage_KK;
	 	   $keyword = $keyword_KK;
		   $sql = $dbh->prepare("INSERT INTO tbl_totalsubscribers(total_phoneno,total_keyword,total_date,total_time,total_status) VALUES (:phone,:keyword,:tarehe, :currtime,:status)");
		   $sql->bindParam(":phone", $number );   
  		   $sql->bindParam(":keyword", $keyword );
  		   $sql->bindParam(":tarehe", $dates );   
  		   $sql->bindParam(":currtime", $currTime );
  		   $sql->bindParam(":status", $status );
		   try {      
			    $data = $sql->execute();			    
			  } catch(PDOException $e) {			      
			    echo $e->getMessage();			    
			  }
			if ($data) {
				$options  = array('keyword' => $keyword, 'retryDurationInHours'=>$retryDurationInHours);
				$gateway  = new AfricaStalkingGateway($username, $apiKey);	
	    		$results  = $gateway->sendMessage($recipients, $message, $fromParam, $bulkSMSMode,$options);
	    		if ( count($results) ) {
			    	foreach($results as $result){
			    		$sNumber = $result->number;
			    		$sMessageId = $result->messageId;
			    		$sStatus = "Sent";
	    				}
						AddToSentTable($sNumber,$sMessageId,$message,$keyword,$sStatus,$sentsubstatus,$dates); //submit to db after first subscription
				} else {
					echo "No Message Sent";
				}
		}
		  
 }
else if ( $updateType == 'Deletion' ) {
			   $data ='';
			   $message = $unsubscribeMessage_KK;
			   $keyword = $keyword_KK;
			   $sql = $dbh->prepare("UPDATE tbl_totalsubscribers SET total_status = :status WHERE total_phoneno = :phone");
			   $sql->bindParam(":status", $status );   
			   $sql->bindParam(":phone", $number );			   
			   try {
			      $data = $sql->execute();			    
			  } catch(PDOException $e) {			      
			    echo $e->getMessage();			    
			  }
			  if ($data) {
			  	 $options     = array('keyword' => $keyword, 'retryDurationInHours'=>$retryDurationInHours);
			  	 $gateway  = new AfricaStalkingGateway($username, $apiKey);	
	   			 $results  = $gateway->sendMessage($recipients, $message, $fromParam, $bulkSMSMode,$options);
			  	if ( count($results) ) {
					    	foreach($results as $result){
					    		$sNumber = $result->number;
					    		$sMessageId = $result->messageId;
					    		$sStatus = "Sent";
					    	}
					  AddToSentTable($sNumber,$sMessageId,$message,$keyword,$sStatus,$sentsubstatus,$dates); //submit to db after first subscription
					} else {
						
					}
			  }
	 }
}
//KY Keyword Subscription
else if ($outputString == $keyword_KY) {
	 
	 if ( $updateType == 'Addition' ) {
	 	   $data = '';
	 	   $message = $subscribeMessage_KY;
	 	   $keyword = $keyword_KY;
		   $sql = $dbh->prepare("INSERT INTO tbl_totalsubscribers(total_phoneno,total_keyword,total_date,total_time,total_status) VALUES (:phone,:keyword,:tarehe, :currtime,:status)");
		   $sql->bindParam(":phone", $number );   
  		   $sql->bindParam(":keyword", $keyword );
  		   $sql->bindParam(":tarehe", $dates );   
  		   $sql->bindParam(":currtime", $currTime );
  		   $sql->bindParam(":status", $status );
		   try {      
			    $data = $sql->execute();			    
			  } catch(PDOException $e) {			      
			    echo $e->getMessage();			    
			  }
			if ($data) {
				$options  = array('keyword' => $keyword, 'retryDurationInHours'=>$retryDurationInHours);
				$gateway  = new AfricaStalkingGateway($username, $apiKey);	
	    		$results  = $gateway->sendMessage($recipients, $message, $fromParam, $bulkSMSMode,$options);
	    		if ( count($results) ) {
			    	foreach($results as $result){
			    		$sNumber = $result->number;
			    		$sMessageId = $result->messageId;
			    		$sStatus = "Sent";
	    				}
						AddToSentTable($sNumber,$sMessageId,$message,$keyword,$sStatus,$sentsubstatus,$dates); //submit to db after first subscription
				} else {
					echo "No Message Sent";
				}
		}
		  
 }
else if ( $updateType == 'Deletion' ) {
			   $data ='';
			   $message = $unsubscribeMessage_KY;
			   $keyword = $keyword_KY;
			   $sql = $dbh->prepare("UPDATE tbl_totalsubscribers SET total_status = :status WHERE total_phoneno = :phone");
			   $sql->bindParam(":status", $status );   
			   $sql->bindParam(":phone", $number );			   
			   try {
			      $data = $sql->execute();			    
			  } catch(PDOException $e) {			      
			    echo $e->getMessage();			    
			  }
			  if ($data) {
			  	 $options     = array('keyword' => $keyword, 'retryDurationInHours'=>$retryDurationInHours);
			  	 $gateway  = new AfricaStalkingGateway($username, $apiKey);	
	   			 $results  = $gateway->sendMessage($recipients, $message, $fromParam, $bulkSMSMode,$options);
			  	if ( count($results) ) {
					    	foreach($results as $result){
					    		$sNumber = $result->number;
					    		$sMessageId = $result->messageId;
					    		$sStatus = "Sent";
					    	}
					  AddToSentTable($sNumber,$sMessageId,$message,$keyword,$sStatus,$sentsubstatus,$dates); //submit to db after first subscription
					} else {
						
					}
			  }
	 }
}
//SS Keyword Subscription
else if ($outputString == $keyword_SS) {
	 
	 if ( $updateType == 'Addition' ) {
	 	   $data = '';
	 	   $message = $subscribeMessage_SS;
	 	   $keyword = $keyword_SS;
		   $sql = $dbh->prepare("INSERT INTO tbl_totalsubscribers(total_phoneno,total_keyword,total_date,total_time,total_status) VALUES (:phone,:keyword,:tarehe, :currtime,:status)");
		   $sql->bindParam(":phone", $number );   
  		   $sql->bindParam(":keyword", $keyword );
  		   $sql->bindParam(":tarehe", $dates );   
  		   $sql->bindParam(":currtime", $currTime );
  		   $sql->bindParam(":status", $status );
		   try {      
			    $data = $sql->execute();			    
			  } catch(PDOException $e) {			      
			    echo $e->getMessage();			    
			  }
			if ($data) {
				$options  = array('keyword' => $keyword, 'retryDurationInHours'=>$retryDurationInHours);
				$gateway  = new AfricaStalkingGateway($username, $apiKey);	
	    		$results  = $gateway->sendMessage($recipients, $message, $fromParam, $bulkSMSMode,$options);
	    		if ( count($results) ) {
			    	foreach($results as $result){
			    		$sNumber = $result->number;
			    		$sMessageId = $result->messageId;
			    		$sStatus = "Sent";
	    				}
						AddToSentTable($sNumber,$sMessageId,$message,$keyword,$sStatus,$sentsubstatus,$dates); //submit to db after first subscription
				} else {
					echo "No Message Sent";
				}
		}
		  
 }
else if ( $updateType == 'Deletion' ) {
			   $data ='';
			   $message = $unsubscribeMessage_SS;
			   $keyword = $keyword_SS;
			   $sql = $dbh->prepare("UPDATE tbl_totalsubscribers SET total_status = :status WHERE total_phoneno = :phone");
			   $sql->bindParam(":status", $status );   
			   $sql->bindParam(":phone", $number );			   
			   try {
			      $data = $sql->execute();			    
			  } catch(PDOException $e) {			      
			    echo $e->getMessage();			    
			  }
			  if ($data) {
			  	 $options     = array('keyword' => $keyword, 'retryDurationInHours'=>$retryDurationInHours);
			  	 $gateway  = new AfricaStalkingGateway($username, $apiKey);	
	   			 $results  = $gateway->sendMessage($recipients, $message, $fromParam, $bulkSMSMode,$options);
			  	if ( count($results) ) {
					    	foreach($results as $result){
					    		$sNumber = $result->number;
					    		$sMessageId = $result->messageId;
					    		$sStatus = "Sent";
					    	}
					  AddToSentTable($sNumber,$sMessageId,$message,$keyword,$sStatus,$sentsubstatus,$dates); //submit to db after first subscription
					} else {
						
					}
			  }
	 }
}
//MM Keyword Subscription
else if ($outputString == $keyword_MM) {
	 
	 if ( $updateType == 'Addition' ) {
	 	   $data = '';
	 	   $message = $subscribeMessage_MM;
	 	   $keyword = $keyword_MM;
		   $sql = $dbh->prepare("INSERT INTO tbl_totalsubscribers(total_phoneno,total_keyword,total_date,total_time,total_status) VALUES (:phone,:keyword,:tarehe, :currtime,:status)");
		   $sql->bindParam(":phone", $number );   
  		   $sql->bindParam(":keyword", $keyword );
  		   $sql->bindParam(":tarehe", $dates );   
  		   $sql->bindParam(":currtime", $currTime );
  		   $sql->bindParam(":status", $status );
		   try {      
			    $data = $sql->execute();			    
			  } catch(PDOException $e) {			      
			    echo $e->getMessage();			    
			  }
			if ($data) {
				$options  = array('keyword' => $keyword, 'retryDurationInHours'=>$retryDurationInHours);
				$gateway  = new AfricaStalkingGateway($username, $apiKey);	
	    		$results  = $gateway->sendMessage($recipients, $message, $fromParam, $bulkSMSMode,$options);
	    		if ( count($results) ) {
			    	foreach($results as $result){
			    		$sNumber = $result->number;
			    		$sMessageId = $result->messageId;
			    		$sStatus = "Sent";
	    				}
						AddToSentTable($sNumber,$sMessageId,$message,$keyword,$sStatus,$sentsubstatus,$dates); //submit to db after first subscription
				} else {
					echo "No Message Sent";
				}
		}
		  
 }
else if ( $updateType == 'Deletion' ) {
			   $data ='';
			   $message = $unsubscribeMessage_MM;
			   $keyword = $keyword_MM;
			   $sql = $dbh->prepare("UPDATE tbl_totalsubscribers SET total_status = :status WHERE total_phoneno = :phone");
			   $sql->bindParam(":status", $status );   
			   $sql->bindParam(":phone", $number );			   
			   try {
			      $data = $sql->execute();			    
			  } catch(PDOException $e) {			      
			    echo $e->getMessage();			    
			  }
			  if ($data) {
			  	 $options     = array('keyword' => $keyword, 'retryDurationInHours'=>$retryDurationInHours);
			  	 $gateway  = new AfricaStalkingGateway($username, $apiKey);	
	   			 $results  = $gateway->sendMessage($recipients, $message, $fromParam, $bulkSMSMode,$options);
			  	if ( count($results) ) {
					    	foreach($results as $result){
					    		$sNumber = $result->number;
					    		$sMessageId = $result->messageId;
					    		$sStatus = "Sent";
					    	}
					  AddToSentTable($sNumber,$sMessageId,$message,$keyword,$sStatus,$sentsubstatus,$dates); //submit to db after first subscription
					} else {
						
					}
			  }
	 }
}
//FM Keyword Subscription
else if ($outputString == $keyword_FM) {
	 
	 if ( $updateType == 'Addition' ) {
	 	   $data = '';
	 	   $message = $subscribeMessage_FM;
	 	   $keyword = $keyword_FM;
		   $sql = $dbh->prepare("INSERT INTO tbl_totalsubscribers(total_phoneno,total_keyword,total_date,total_time,total_status) VALUES (:phone,:keyword,:tarehe, :currtime,:status)");
		   $sql->bindParam(":phone", $number );   
  		   $sql->bindParam(":keyword", $keyword );
  		   $sql->bindParam(":tarehe", $dates );   
  		   $sql->bindParam(":currtime", $currTime );
  		   $sql->bindParam(":status", $status );
		   try {      
			    $data = $sql->execute();			    
			  } catch(PDOException $e) {			      
			    echo $e->getMessage();			    
			  }
			if ($data) {
				$options  = array('keyword' => $keyword, 'retryDurationInHours'=>$retryDurationInHours);
				$gateway  = new AfricaStalkingGateway($username, $apiKey);	
	    		$results  = $gateway->sendMessage($recipients, $message, $fromParam, $bulkSMSMode,$options);
	    		if ( count($results) ) {
			    	foreach($results as $result){
			    		$sNumber = $result->number;
			    		$sMessageId = $result->messageId;
			    		$sStatus = "Sent";
	    				}
						AddToSentTable($sNumber,$sMessageId,$message,$keyword,$sStatus,$sentsubstatus,$dates); //submit to db after first subscription
				} else {
					echo "No Message Sent";
				}
		}
		  
 }
else if ( $updateType == 'Deletion' ) {
			   $data ='';
			   $message = $unsubscribeMessage_FM;
			   $keyword = $keyword_FM;
			   $sql = $dbh->prepare("UPDATE tbl_totalsubscribers SET total_status = :status WHERE total_phoneno = :phone");
			   $sql->bindParam(":status", $status );   
			   $sql->bindParam(":phone", $number );			   
			   try {
			      $data = $sql->execute();			    
			  } catch(PDOException $e) {			      
			    echo $e->getMessage();			    
			  }
			  if ($data) {
			  	 $options     = array('keyword' => $keyword, 'retryDurationInHours'=>$retryDurationInHours);
			  	 $gateway  = new AfricaStalkingGateway($username, $apiKey);	
	   			 $results  = $gateway->sendMessage($recipients, $message, $fromParam, $bulkSMSMode,$options);
			  	if ( count($results) ) {
					    	foreach($results as $result){
					    		$sNumber = $result->number;
					    		$sMessageId = $result->messageId;
					    		$sStatus = "Sent";
					    	}
					  AddToSentTable($sNumber,$sMessageId,$message,$keyword,$sStatus,$sentsubstatus,$dates); //submit to db after first subscription
					} else {
						
					}
			  }
	 }
}
//PENZI Keyword Subscription
else if ($outputString == $keyword_PENZI) {
	 
	 if ( $updateType == 'Addition' ) {
	 	   $data = '';
	 	   $message = $subscribeMessage_PENZI;
	 	   $keyword = $keyword_PENZI;
		   $sql = $dbh->prepare("INSERT INTO tbl_totalsubscribers(total_phoneno,total_keyword,total_date,total_time,total_status) VALUES (:phone,:keyword,:tarehe, :currtime,:status)");
		   $sql->bindParam(":phone", $number );   
  		   $sql->bindParam(":keyword", $keyword );
  		   $sql->bindParam(":tarehe", $dates );   
  		   $sql->bindParam(":currtime", $currTime );
  		   $sql->bindParam(":status", $status );
		   try {      
			    $data = $sql->execute();			    
			  } catch(PDOException $e) {			      
			    echo $e->getMessage();			    
			  }
			if ($data) {
				$options  = array('keyword' => $keyword, 'retryDurationInHours'=>$retryDurationInHours);
				$gateway  = new AfricaStalkingGateway($username, $apiKey);	
	    		$results  = $gateway->sendMessage($recipients, $message, $fromParam, $bulkSMSMode,$options);
	    		if ( count($results) ) {
			    	foreach($results as $result){
			    		$sNumber = $result->number;
			    		$sMessageId = $result->messageId;
			    		$sStatus = "Sent";
	    				}
						AddToSentTable($sNumber,$sMessageId,$message,$keyword,$sStatus,$sentsubstatus,$dates); //submit to db after first subscription
				} else {
					echo "No Message Sent";
				}
		}
		  
 }
else if ( $updateType == 'Deletion' ) {
			   $data ='';
			   $message = $unsubscribeMessage_PENZI;
			   $keyword = $keyword_PENZI;
			   $sql = $dbh->prepare("UPDATE tbl_totalsubscribers SET total_status = :status WHERE total_phoneno = :phone");
			   $sql->bindParam(":status", $status );   
			   $sql->bindParam(":phone", $number );			   
			   try {
			      $data = $sql->execute();			    
			  } catch(PDOException $e) {			      
			    echo $e->getMessage();			    
			  }
			  if ($data) {
			  	 $options     = array('keyword' => $keyword, 'retryDurationInHours'=>$retryDurationInHours);
			  	 $gateway  = new AfricaStalkingGateway($username, $apiKey);	
	   			 $results  = $gateway->sendMessage($recipients, $message, $fromParam, $bulkSMSMode,$options);
			  	if ( count($results) ) {
					    	foreach($results as $result){
					    		$sNumber = $result->number;
					    		$sMessageId = $result->messageId;
					    		$sStatus = "Sent";
					    	}
					  AddToSentTable($sNumber,$sMessageId,$message,$keyword,$sStatus,$sentsubstatus,$dates); //submit to db after first subscription
					} else {
						
					}
			  }
	 }
}
//LOVE Keyword Subscription
else if ($outputString == $keyword_LOVE) {
	 
	 if ( $updateType == 'Addition' ) {
	 	   $data = '';
	 	   $message = $subscribeMessage_LOVE;
	 	   $keyword = $keyword_LOVE;
		   $sql = $dbh->prepare("INSERT INTO tbl_totalsubscribers(total_phoneno,total_keyword,total_date,total_time,total_status) VALUES (:phone,:keyword,:tarehe, :currtime,:status)");
		   $sql->bindParam(":phone", $number );   
  		   $sql->bindParam(":keyword", $keyword );
  		   $sql->bindParam(":tarehe", $dates );   
  		   $sql->bindParam(":currtime", $currTime );
  		   $sql->bindParam(":status", $status );
		   try {      
			    $data = $sql->execute();			    
			  } catch(PDOException $e) {			      
			    echo $e->getMessage();			    
			  }
			if ($data) {
				$options  = array('keyword' => $keyword, 'retryDurationInHours'=>$retryDurationInHours);
				$gateway  = new AfricaStalkingGateway($username, $apiKey);	
	    		$results  = $gateway->sendMessage($recipients, $message, $fromParam, $bulkSMSMode,$options);
	    		if ( count($results) ) {
			    	foreach($results as $result){
			    		$sNumber = $result->number;
			    		$sMessageId = $result->messageId;
			    		$sStatus = "Sent";
	    				}
						AddToSentTable($sNumber,$sMessageId,$message,$keyword,$sStatus,$sentsubstatus,$dates); //submit to db after first subscription
				} else {
					echo "No Message Sent";
				}
		}
		  
 }
else if ( $updateType == 'Deletion' ) {
			   $data ='';
			   $message = $unsubscribeMessage_LOVE;
			   $keyword = $keyword_LOVE;
			   $sql = $dbh->prepare("UPDATE tbl_totalsubscribers SET total_status = :status WHERE total_phoneno = :phone");
			   $sql->bindParam(":status", $status );   
			   $sql->bindParam(":phone", $number );			   
			   try {
			      $data = $sql->execute();			    
			  } catch(PDOException $e) {			      
			    echo $e->getMessage();			    
			  }
			  if ($data) {
			  	 $options     = array('keyword' => $keyword, 'retryDurationInHours'=>$retryDurationInHours);
			  	 $gateway  = new AfricaStalkingGateway($username, $apiKey);	
	   			 $results  = $gateway->sendMessage($recipients, $message, $fromParam, $bulkSMSMode,$options);
			  	if ( count($results) ) {
					    	foreach($results as $result){
					    		$sNumber = $result->number;
					    		$sMessageId = $result->messageId;
					    		$sStatus = "Sent";
					    	}
					  AddToSentTable($sNumber,$sMessageId,$message,$keyword,$sStatus,$sentsubstatus,$dates); //submit to db after first subscription
					} else {
						
					}
			  }
	 }
}
//SHULE Keyword Subscription
else if ($outputString == $keyword_SHULE) {
	 
	 if ( $updateType == 'Addition' ) {
	 	   $data = '';
	 	   $message = $subscribeMessage_SHULE;
	 	   $keyword = $keyword_SHULE;
		   $sql = $dbh->prepare("INSERT INTO tbl_totalsubscribers(total_phoneno,total_keyword,total_date,total_time,total_status) VALUES (:phone,:keyword,:tarehe, :currtime,:status)");
		   $sql->bindParam(":phone", $number );   
  		   $sql->bindParam(":keyword", $keyword );
  		   $sql->bindParam(":tarehe", $dates );   
  		   $sql->bindParam(":currtime", $currTime );
  		   $sql->bindParam(":status", $status );
		   try {      
			    $data = $sql->execute();			    
			  } catch(PDOException $e) {			      
			    echo $e->getMessage();			    
			  }
			if ($data) {
				$options  = array('keyword' => $keyword, 'retryDurationInHours'=>$retryDurationInHours);
				$gateway  = new AfricaStalkingGateway($username, $apiKey);	
	    		$results  = $gateway->sendMessage($recipients, $message, $fromParam, $bulkSMSMode,$options);
	    		if ( count($results) ) {
			    	foreach($results as $result){
			    		$sNumber = $result->number;
			    		$sMessageId = $result->messageId;
			    		$sStatus = "Sent";
	    				}
						AddToSentTable($sNumber,$sMessageId,$message,$keyword,$sStatus,$sentsubstatus,$dates); //submit to db after first subscription
				} else {
					echo "No Message Sent";
				}
		}
		  
 }
else if ( $updateType == 'Deletion' ) {
			   $data ='';
			   $message = $unsubscribeMessage_SHULE;
			   $keyword = $keyword_SHULE;
			   $sql = $dbh->prepare("UPDATE tbl_totalsubscribers SET total_status = :status WHERE total_phoneno = :phone");
			   $sql->bindParam(":status", $status );   
			   $sql->bindParam(":phone", $number );			   
			   try {
			      $data = $sql->execute();			    
			  } catch(PDOException $e) {			      
			    echo $e->getMessage();			    
			  }
			  if ($data) {
			  	 $options     = array('keyword' => $keyword, 'retryDurationInHours'=>$retryDurationInHours);
			  	 $gateway  = new AfricaStalkingGateway($username, $apiKey);	
	   			 $results  = $gateway->sendMessage($recipients, $message, $fromParam, $bulkSMSMode,$options);
			  	if ( count($results) ) {
					    	foreach($results as $result){
					    		$sNumber = $result->number;
					    		$sMessageId = $result->messageId;
					    		$sStatus = "Sent";
					    	}
					  AddToSentTable($sNumber,$sMessageId,$message,$keyword,$sStatus,$sentsubstatus,$dates); //submit to db after first subscription
					} else {
						
					}
			  }
	 }
}
//NEWS Keyword Subscription
else if ($outputString == $keyword_NEWS) {
	 
	 if ( $updateType == 'Addition' ) {
	 	   $data = '';
	 	   $message = $subscribeMessage_NEWS;
	 	   $keyword = $keyword_NEWS;
		   $sql = $dbh->prepare("INSERT INTO tbl_totalsubscribers(total_phoneno,total_keyword,total_date,total_time,total_status) VALUES (:phone,:keyword,:tarehe, :currtime,:status)");
		   $sql->bindParam(":phone", $number );   
  		   $sql->bindParam(":keyword", $keyword );
  		   $sql->bindParam(":tarehe", $dates );   
  		   $sql->bindParam(":currtime", $currTime );
  		   $sql->bindParam(":status", $status );
		   try {      
			    $data = $sql->execute();			    
			  } catch(PDOException $e) {			      
			    echo $e->getMessage();			    
			  }
			if ($data) {
				$options  = array('keyword' => $keyword, 'retryDurationInHours'=>$retryDurationInHours);
				$gateway  = new AfricaStalkingGateway($username, $apiKey);	
	    		$results  = $gateway->sendMessage($recipients, $message, $fromParam, $bulkSMSMode,$options);
	    		if ( count($results) ) {
			    	foreach($results as $result){
			    		$sNumber = $result->number;
			    		$sMessageId = $result->messageId;
			    		$sStatus = "Sent";
	    				}
						AddToSentTable($sNumber,$sMessageId,$message,$keyword,$sStatus,$sentsubstatus,$dates); //submit to db after first subscription
				} else {
					echo "No Message Sent";
				}
		}
		  
 }
else if ( $updateType == 'Deletion' ) {
			   $data ='';
			   $message = $unsubscribeMessage_SHULE;
			   $keyword = $keyword_SHULE;
			   $sql = $dbh->prepare("UPDATE tbl_totalsubscribers SET total_status = :status WHERE total_phoneno = :phone");
			   $sql->bindParam(":status", $status );   
			   $sql->bindParam(":phone", $number );			   
			   try {
			      $data = $sql->execute();			    
			  } catch(PDOException $e) {			      
			    echo $e->getMessage();			    
			  }
			  if ($data) {
			  	 $options     = array('keyword' => $keyword, 'retryDurationInHours'=>$retryDurationInHours);
			  	 $gateway  = new AfricaStalkingGateway($username, $apiKey);	
	   			 $results  = $gateway->sendMessage($recipients, $message, $fromParam, $bulkSMSMode,$options);
			  	if ( count($results) ) {
					    	foreach($results as $result){
					    		$sNumber = $result->number;
					    		$sMessageId = $result->messageId;
					    		$sStatus = "Sent";
					    	}
					  AddToSentTable($sNumber,$sMessageId,$message,$keyword,$sStatus,$sentsubstatus,$dates); //submit to db after first subscription
					} else {
						
					}
			  }
	 }
}
//NEWS Keyword Subscription
else if ($outputString == $keyword_BIBLE) {
	 
	 if ( $updateType == 'Addition' ) {
	 	   $data = '';
	 	   $message = $subscribeMessage_BIBLE;
	 	   $keyword = $keyword_BIBLE;
		   $sql = $dbh->prepare("INSERT INTO tbl_totalsubscribers(total_phoneno,total_keyword,total_date,total_time,total_status) VALUES (:phone,:keyword,:tarehe, :currtime,:status)");
		   $sql->bindParam(":phone", $number );   
  		   $sql->bindParam(":keyword", $keyword );
  		   $sql->bindParam(":tarehe", $dates );   
  		   $sql->bindParam(":currtime", $currTime );
  		   $sql->bindParam(":status", $status );
		   try {      
			    $data = $sql->execute();			    
			  } catch(PDOException $e) {			      
			    echo $e->getMessage();			    
			  }
			if ($data) {
				$options  = array('keyword' => $keyword, 'retryDurationInHours'=>$retryDurationInHours);
				$gateway  = new AfricaStalkingGateway($username, $apiKey);	
	    		$results  = $gateway->sendMessage($recipients, $message, $fromParam, $bulkSMSMode,$options);
	    		if ( count($results) ) {
			    	foreach($results as $result){
			    		$sNumber = $result->number;
			    		$sMessageId = $result->messageId;
			    		$sStatus = "Sent";
	    				}
						AddToSentTable($sNumber,$sMessageId,$message,$keyword,$sStatus,$sentsubstatus,$dates); //submit to db after first subscription
				} else {
					echo "No Message Sent";
				}
		}
		  
 }
else if ( $updateType == 'Deletion' ) {
			   $data ='';
			   $message = $unsubscribeMessage_BIBLE;
			   $keyword = $keyword_BIBLE;
			   $sql = $dbh->prepare("UPDATE tbl_totalsubscribers SET total_status = :status WHERE total_phoneno = :phone");
			   $sql->bindParam(":status", $status );   
			   $sql->bindParam(":phone", $number );			   
			   try {
			      $data = $sql->execute();			    
			  } catch(PDOException $e) {			      
			    echo $e->getMessage();			    
			  }
			  if ($data) {
			  	 $options     = array('keyword' => $keyword, 'retryDurationInHours'=>$retryDurationInHours);
			  	 $gateway  = new AfricaStalkingGateway($username, $apiKey);	
	   			 $results  = $gateway->sendMessage($recipients, $message, $fromParam, $bulkSMSMode,$options);
			  	if ( count($results) ) {
					    	foreach($results as $result){
					    		$sNumber = $result->number;
					    		$sMessageId = $result->messageId;
					    		$sStatus = "Sent";
					    	}
					  AddToSentTable($sNumber,$sMessageId,$message,$keyword,$sStatus,$sentsubstatus,$dates); //submit to db after first subscription
					} else {
						
					}
			  }
	 }
}
function AddToSentTable($sNumber,$sMessageId,$message,$keyword,$sStatus,$sentsubstatus,$dates){
	    global $dbh;  
        $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	    $data='';
	    $sql = $dbh->prepare("INSERT INTO tbl_totalsentmessages(sent_phoneno,sent_messageid,sent_message,sent_keyword,sent_status,sent_subscriptionstatus,sent_datesent) VALUES (:no,:id,:msg,:keyword,:status,:sentstatus,:tarehe)");
        $sql->bindParam(":no", $sNumber);
        $sql->bindParam(":id", $sMessageId);
        $sql->bindParam(":msg",$message );
        $sql->bindParam(":keyword", $keyword);
        $sql->bindParam(":status", $sStatus);
        $sql->bindParam(":sentstatus", $sentsubstatus);
        $sql->bindParam(":tarehe", $dates);
        try {
            $data=$sql->execute();
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        if ($data) {
        	echo'Added to set Mesages';
        }
        else {
        	echo'Nothing Sent';
        }
 
}



?>