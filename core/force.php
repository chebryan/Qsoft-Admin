<?php
    require_once('AfricasTalkingGateway.php');
    require('dao.php');
    date_default_timezone_set('Africa/Nairobi');
    $tarehe = date('D');
    $today_date = date("Y-m-d"); //today
    $sentsubstatus = "1"; //1 means its the second message, not a subscription msg   
    $active_status = '0';
    global $dbh;  
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $data =''; 
    $sql = $dbh->prepare("SELECT * FROM tbl_range WHERE range_date=:leo");
    $sql->bindParam(":leo",$today_date);
    try {
      $sql->execute();
    } catch (PDOException $e) {
      echo $e->getMessage();
    }
    $data = $sql->fetchall(PDO::FETCH_ASSOC);
    if ($data) {
      foreach ($data as $row) {
        $startdate = $row['range_start'];
        $enddate = $row['range_end'];
      
        wekaNdani($startdate,$enddate);
       
      }
    }else {
      echo "No Date Range Selected";
    }


function wekaNdani($startdate,$enddate){
      global $dbh;
      $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      $data =''; 
      $username    = "qsoft";
      $apiKey      = "3da4460be41731440bf42ac3e10e175030d9863615acad81d9a39473a3e745a6";
      $shortcode = "21441";
       $keyword = 'bible';
        $sql = $dbh->prepare("SELECT phonenumber FROM safaricom_nyanza WHERE id BETWEEN :a AND :b");
        $sql->bindParam(":a",$startdate);
        $sql->bindParam(":b",$enddate);
        try {
          $sql->execute();
        } catch (PDOException $e) {
          echo $e->getMessage();
        }
        $data=$sql->fetchAll(PDO::FETCH_ASSOC);
       
        if ($data) {
           $gateway = new AfricasTalkingGateway($username, $apiKey);
           foreach ($data as $row) {
            $phoneno = $row['phonenumber'];
            try {
              $results= $gateway->createSubscription($phoneno, $shortcode, $keyword);
              echo "Keyword ".$keyword. "subscription Sent----->".$phoneno;
            } catch (AfricasTalkingGatewayException $e) {
              echo "Encountered an error while sending ".$e->getMessage();

            }
            
          }
        }
          else{
      echo "No Phone Numbers Fetched";
   }
}

/* 
require("dao.php");
require_once("AfricasTalkingGateway.php");
    $username    = "qsoft";
	$apiKey      = "3da4460be41731440bf42ac3e10e175030d9863615acad81d9a39473a3e745a6";
	$shortcode = "21441";
	$keyword = "jb";
	$phoneno = '+254704544362';


   $recipients = $phoneno;
   $recipients = explode(",", $recipients);

  $gateway = new AfricasTalkingGateway($username, $apiKey);
  foreach ($recipients as $value) {
  	echo " Value is.. ".$value;
  	try {
  		$results= $gateway->createSubscription($value, $shortcode, $keyword);
  		echo "Subscription message Sent----->";
  	} catch (AfricasTalkingGatewayException $e) {
  		echo "Encountered an error while sending ".$e->getMessage();

  	}
  }
*/
?>
