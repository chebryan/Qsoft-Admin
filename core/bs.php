<?php
require_once('AfricasTalkingGateway.php');
require_once 'dao.php';
                                      
$username= "546071648821";
$password= "admin1234";
$apiKey      = "3da4460be41731440bf42ac3e10e175030d9863615acad81d9a39473a3e745a6";
$shortcode = "22256";
$tag = "leobs04";
$keyword = "breakingnews";
   //select numbers from the database
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
  $counter = 0;
 foreach ($data as $row) {
  try {

  $val="http://best-messaging.com/public/api/subscription.php?operation=1&phone=".$row['gen_number']."&code=".$shortcode."&keyword=".$keyword."&user=".$username."&pass=".$password;
$curl= curl_init();
curl_setopt_array($curl,array(
CURLOPT_RETURNTRANSFER=>1,CURLOPT_URL=>$val,CURLOPT_USERAGENT=>''

));
$response=curl_exec($curl);
curl_close($curl);
// echo $val;
echo "News Subscription Sent----->".$row['gen_number']." count ID--->".$countno;
  } catch (AfricasTalkingGatewayException $e) {
   echo "Encountered an error while sending". $e->getMessage();

      }
      $counter++;
     }
    }
  




            ?>