<?php
require_once('AfricasTalkingGateway.php');
require('dao.php');
    $tarehe = date('D');
    $today_date = date("Y-m-d");
    $sentsubstatus = "1"; //1 means its the second message, not a subscription msg
    $key = 'news';
    $active_status = '0';

    global $dbh;  
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = $dbh->prepare("SELECT content_status FROM tbl_content WHERE content_keyword=:key");
    $sql->bindParam(":key", $key);
     try {
	   	$sql->execute();
	   } catch (PDOException $e) {
	   	echo $e->getMessage();
	   }

	   $data = $sql->fetchColumn();
	   if ($data==0) { 

    global $dbh;  
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$data='';
	$data2='';
	$sql = $dbh->prepare("SELECT content_message FROM tbl_content WHERE  content_keyword=:keyword");
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
	//$sql2 = $dbh->("SELECT * FROM tbl_totalsubscribers WHERE total_status=:status");  
	$sql2 = $dbh->prepare("SELECT * FROM tbl_dummysubscribers WHERE total_status=:status");  
    $sql2->bindParam(":status", $active_status); 
    try {
    	$sql2->execute();
    } catch (PDOException $e) {
    	echo $e->getMessage();
    }
    $data2 = $sql2->fetchAll(PDO::FETCH_ASSOC);
    if ($data2) {
    	 echo "QSOFT ALL NEWS 1\n";
    	 $recipients = '';
    	 $ret = '';
    	foreach ($data2 as $rowm) {
    		$recipients .= "{$rowm['total_phoneno']},"; // create a string of telephone number 
    		$username    = "qsoft";
	        $apiKey      = "3da4460be41731440bf42ac3e10e175030d9863615acad81d9a39473a3e745a6";
	        $message = $msg;
			$keyword = $rowm['total_keyword'];
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
			             echo "Sent ##### ";
			              }
					 } 
					 
			 else {
				$errormessage = $gateway->getErrorMessage();
				echo 'oops, sending failed';
				}
    	
    }

		    else{
		    	echo "no numbers";
		    }
		     //call method to update status to 1 to show that the news have been sent to everyone
		updatestatus($key);
		}
		

		else{
			echo "No Message got";
		     }
	     }


	   else{
	   //	echo "Dont Send the news the second Time. #### UPDATE IS NEEDED. . .Not yet updated";
	   	}

    function updatestatus($key){
    	   global $dbh;  
           $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    	   $data='';
    	   $state = '1';
    	   $sql= $dbh->prepare("UPDATE tbl_content SET content_status = :state WHERE content_keyword=:key");
    	   $sql->bindParam(":key", $key );  
    	   $sql->bindParam(":state", $state);
    	   try {      
				    $data = $sql->execute();    
				  } catch(PDOException $e) {      
				    echo $e->getMessage();
				  }

				   if ($data) {
				   	echo "Updated to fully sent State";
				   }
				  else{
				  	echo "Failed to change the sending Status";
				  }

    }

//Function to send to DB
    function doInsertSMS($sNumber,$sMessageId,$message,$keyword,$sStatus,$sentsubstatus,$today_date){
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
			   echo "Inserted #### ";
			  }
			  else{
			  	 echo "Oooops #### ";
			  }
	}

 
?>