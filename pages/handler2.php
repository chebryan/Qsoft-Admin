<?php 
require_once('../core/AfricasTalkingGateway.php');
include_once 'connect.php';
if (isset($_POST['do_dropdown'])) 
{
  $act = $_POST['do_dropdown'];
}
else
{
  $act = $_REQUEST['do'];
}


switch($act) {
  case 'newsUpdate': checkContent();
    break;
  default : doError() ;
    break;
}

function checkContent(){
  global $dbh;
  $msg = $_POST['messageHere'];
   $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
   $data = '';
   $sql = $dbh->prepare("SELECT content_status FROM tbl_content");
   try {      
    $sql->execute();    
  } catch(PDOException $e) {      
    echo $e->getMessage();
  }
  $data = $sql->fetchColumn();
  if ($data==0) {
    $sc= "<span class=\"alert alert-danger\" >Failed To Update . <button class=\"btn btn-warning\"> REASON:: </button> News not yet Sent by the System. Wait few Minutes</span><br><br>";
     echo json_encode($sc); 
  }
  else{
    updateNews($msg);
  }
}


function updateNews($msg)
{   
   
   global $dbh;
   $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
   $data = '';
   $key = 'news';
   $done = '0';
   $oops = 'none';

   $sql = $dbh->prepare("UPDATE tbl_content SET content_message = :msg, content_status=:done WHERE content_keyword=:grp");
   //$sql =$dbh->prepare("INSERT INTO tbl_content (content_message, content_keyword) VALUES (:msg,:key)");
   $sql->bindParam(":msg", $msg );   
   $sql->bindParam(":grp", $key);
   $sql->bindParam(":done", $done);
   try {      
    $data = $sql->execute();    
  } catch(PDOException $e) {      
    echo $e->getMessage();
  }
  
   if ($data) {
          $sc= "<span class=\"alert alert-success\" >You have Successfully Updated News content. Will be sent according to CRON JOB Set</span><br><br>";
   }
  else{
$sc= "<span class=\"alert alert-danger\" >Failed to update  $msg  ... Try Again</span><br><br>";
  }
    
   echo json_encode($sc);  
}

function doError() {
    echo 'error';
}
?>