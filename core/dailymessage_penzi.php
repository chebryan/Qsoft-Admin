<?php
require_once('AfricasTalkingGateway.php');
require('dao.php');
    $tarehe = date('D');
    $today_date = date("Y-m-d");
    $sentsubstatus = "1"; //1 means its the second message, not a subscription msg
    $key = 'love';
    $key2 = 'penzi';
    $active_status = '0';
    global $dbh;  
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$data='';
	$data2='';
	$sql = $dbh->prepare("SELECT message_msg FROM tbl_allmessages WHERE message_day=:day AND message_Keyword=:keyword");
	$sql->bindParam(":day", $tarehe);
    $sql->bindParam(":keyword", $key);
	   try {
	   	$sql->execute();
	   } catch (PDOException $e) {
	   	echo $e->getMessage();
	   }

	   $data = $sql->fetchColumn();
	   if ($data) {   
	
	   $msg = $data;
	//select subscribers now
	$sql2 = $dbh->prepare("SELECT * FROM tbl_totalsubscribers WHERE total_keyword=:keyword AND total_status=:status");  
	//$sql2 = $dbh->prepare("SELECT * FROM tbl_dummysubscribers WHERE total_keyword=:keyword AND total_status=:status");  
	$sql2->bindParam(":keyword", $key2);
    $sql2->bindParam(":status", $active_status); 
    try {
    	$sql2->execute();
    } catch (PDOException $e) {
    	echo $e->getMessage();
    }
    $data2 = $sql2->fetchAll(PDO::FETCH_ASSOC);
    if ($data2) {
		$recipients = '';
		$ret = '';
    	foreach ($data2 as $rowm) {
    		$recipients .= "{$rowm['total_phoneno']},"; // create a string of telephone number 
    		$username    = "qsoft";
	        $apiKey      = "3da4460be41731440bf42ac3e10e175030d9863615acad81d9a39473a3e745a6";
	        $message = $msg;
			$keyword = $key2;
			$from = "21441";
			$bulkSMSMode = 0; //0 means the receiver is charged
			$retryDurationInHours = 12; //retry for 12 hours
			$enqueue = 1; //1 sent msgs to server and queue b4 getting response from safcom
			$options     = array('keyword' => $keyword, 'retryDurationInHours'=>$retryDurationInHours);			
			$gateway  = new AfricaStalkingGateway($username, $apiKey);
			
    	}
		
		$recipients = rtrim($recipients.","); // should have a string '0722***','07223***'
			echo "\n Contacts Fetched Here::: ".$recipients;
		
		
		$results  = $gateway->sendMessage($recipients, $message,$from,$bulkSMSMode,$options);

			if ( count($results) ) {
			    foreach($results as $result) {
				$sNumber = $result->number;
				$sMessageId = $result->messageId;
				$sStatus = "Sent";
				doInsertSMS($sNumber,$sMessageId,$message,$keyword,$sStatus,$sentsubstatus,$today_date); //insert if sent by the gateway
			             $ret .= "Sent # ";
			              }
					 } 
					 
			 else {
				$errormessage = $gateway->getErrorMessage();
				 $ret .='oops, sending failed';
				}

				echo "\n Delivery Report: ".$ret;
    }
    else{
    	echo "no numbers";
    }
}
else{
	echo "No Message got";
}

//Function to send to DB for accountability on messages sent, delivered OR Failed
    function doInsertSMS($sNumber,$sMessageId,$message,$keyword,$sStatus,$sentsubstatus,$today_date){
    	   $report ='';
    	   $report .= 'Delivery Report: ';
    	   global $dbh;  
           $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    	   $data='';
 		   $sql = $dbh->prepare("INSERT INTO tbl_totalsentmessages(sent_phoneno,sent_messageid,sent_message,sent_keyword,sent_status,sent_subscriptionstatus,sent_datesent) VALUES (:phone,:id,:msg, :keyword,:status,:substatus,:tarehe)");
		   $sql->bindParam(":phone", $sNumber );   
  		   $sql->bindParam(":id", $sMessageId );
  		   $sql->bindParam(":msg", $message );   
  		   $sql->bindParam(":keyword", $keyword );
  		   $sql->bindParam(":status", $sStatus );
  		   $sql->bindParam(":substatus", $sentsubstatus );
  		   $sql->bindParam(":tarehe", $today_date );
		   try {      
			    $data = $sql->execute();			    
			  } catch(PDOException $e) {			      
			    echo $e->getMessage();			    
			  } 
			  if ($data) {
			   //$report.= "Accounted FOR #### ";
			  }
			  else{
			  	// $report.= "Oooops  Nothing Accounted FOR #### ";
			  }
			//  echo $report;
	}

 
?>