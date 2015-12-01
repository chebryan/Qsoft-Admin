<?php
require_once('AfricasTalkingGateway.php');
require_once 'dao.php';
                                       
$username= "qsoft";
$apiKey      = "3da4460be41731440bf42ac3e10e175030d9863615acad81d9a39473a3e745a6";
$shortcode = "21441";
$keyword = "cash";
$tag = "f02";
 global $dbh;
  $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  $data ='';
  $stmt=$dbh->prepare("SELECT * FROM tbl_generated where gen_tag=:tag");
  $stmt->bindParam(":tag",$tag);
  try {
    $stmt->execute();
  } catch (PDOException $e) {
    echo $e->getMessage();
  }
  $data=$stmt->fetchAll(PDO::FETCH_ASSOC);

  $gateway = new AfricasTalkingGateway($username, $apiKey);

  if ($data) {
   foreach ($data as $row) {
    try {
      $results= $gateway->createSubscription($row['gen_number'], $shortcode, $keyword);
    } catch (AfricasTalkingGatewayException $e) {
      
    }
   }
   
  }


            
?>