<?php
   include('dao.php');
   global $dbh;
   $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
   $data = '';
   $id = $_POST['id'];
   $status = $_POST['status'];  

   if($status == "Failed" || $status == "Rejected"){
          $failureReason = $_POST['failureReason']; 
          $sql = $dbh->prepare("UPDATE tbl_totalsentmessages SET sent_status = :status, failure_reason=:reason WHERE sent_messageid = :id");
           $sql->bindParam(":status", $status ); 
            $sql->bindParam(":reason", $failureReason);  
           $sql->bindParam(":id", $id );   
           try {      
            $data = $sql->execute();
            
          } catch(PDOException $e) {      
            echo $e->getMessage();    
          }
          if ($data) {
            echo '1';   
          }
          else {
            echo '0';
          }
     }
     else {
           $sql = $dbh->prepare("UPDATE tbl_totalsentmessages SET sent_status = :status WHERE sent_messageid = :id");
           $sql->bindParam(":status", $status );   
           $sql->bindParam(":id", $id );   
           try {      
            $data = $sql->execute();
            
          } catch(PDOException $e) {      
            echo $e->getMessage();    
          }
          if ($data) {
            echo '1';   
          }
          else {
            echo '0';
          }

     }


?>