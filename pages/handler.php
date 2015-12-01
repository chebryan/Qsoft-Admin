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
  //homepage send sms
  case 'sms': sendCampusUpdates();
    break;
   //new enrollment
  case 'new_student' : doAddStudent();
    break;
  case 'new_course' : doAddNewCourse();
    break;
  case 'new_dept' : doAddNewDept();
    break;
  case 'new_school' : doAddNewSchool();
    break;
  case 'new_campus' : doAddNewCampus();
    break;
  case 'new_lecturer' : doAddNewLecturer();
    break;
  case 'new_hostel' : doAddNewHostel();
    break;
  case 'new_unit' : doAddNewUnit();
    break;
    
    //fetch dropdown lists
  case 'updateContent' : updateContent();
    break;
  case 'done_campus' : schools();
    break;
  case 'newsUpdate': updateNews();
    break;
  case 'done_school' : courses();
    break;
  case 'done_newcourse_schoolchange' : newCourseFetchDept(); //fetch
    break;
  case 'done_newunit_schoolchange' : newUnitFetchDept(); //fetch departments on school change
    break;
  case 'done_newunit_deptchange' : newUnitFetchCourses(); //fetch departments on school change
    break;

  //reports
  case 'sts':doStatusChange();   
    break;
  case 'del' : doDeleteEnrollment();
    break;
  case 'detail': viewStudentDetails();
    break;
  case 'lec-sts': lecturerChange();
     break;
  case 'lec-roomchange':roomDeallocate();
    break;
  case 'lec-del': doDeleteLecturer();
    break;
  case 'lec-unit-sts': assignLecturer();
    break;
    
    default : doError() ;
    break;

    //online requests
    case 'graduation-state': graduationState();
        break;
    case 'graduation-delete': graduationDelete();
        break;
    case 'room-status': allocateRoom();
        break;
     case 'transcripts-state': transcriptsState();
        break;
    case 'cert-state': certState();
        break;

        //view units registered
    case 'view_units': viewUnitsRegistered();
      break;
    case 'fetchlecs':lecturerFetchOnDeptChange();
        break;
    //assign unitss
      case 'assign_units': assignLecture();      
        break;
       case 're-assign-unit': doLecStatusChange();      
        break;
      break;
        
}
function sendCampusUpdates(){
        global $dbh;
        $data='';
        $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $studentname= $_POST['updates'];
}
function updateNews()
{   
   
   global $dbh;
   $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
   $data = '';
   $msg = $_POST['messageHere'];
   $grp = $_POST['groupHere'];
   $key = 'news';
   $done = '0';
    $oops = 'none';
   if ($grp==$oops) {
    $sc= "<span class=\"alert alert-danger\" >OOOPS! Select the group of news to Update</span><br><br>";

   }
   else {
   $sql = $dbh->prepare("UPDATE tbl_content SET content_message = :msg, content_status=:done WHERE content_nature=:grp");
   //$sql =$dbh->prepare("INSERT INTO tbl_content (content_message, content_keyword) VALUES (:msg,:key)");
   $sql->bindParam(":msg", $msg );   
   $sql->bindParam(":grp", $grp);
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
    }
   echo json_encode($sc);  
}
function updateContent()
{   
   
   global $dbh;
   $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
   $data = '';
  $day = $_POST['dayhapa'] ;
  $keyword = $_POST['keywordhapa'] ;
  $msg = $_POST['txthapa'] ;
  
   $sql = $dbh->prepare("UPDATE tbl_allmessages SET message_msg = :msg WHERE message_keyword = :keyword AND message_day=:day");

   $sql->bindParam(":msg", $msg );   
   $sql->bindParam(":keyword", $keyword );
   $sql->bindParam(":day", $day );
   
   try {
      
    $data = $sql->execute();
    
  } catch(PDOException $e) {
      
    echo $e->getMessage();
    
  }
  
 
   $sc= "<span class=\"alert alert-success\" >You have Successfully Updated content for $day for keyword $keyword :</span><br><br>";
  echo json_encode($sc);  
}
function schools()
{   
    $campusId = $_POST['campus_id'] ;
    global $dbh;
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql ="SELECT * FROM tbl_allmessages WHERE message_keyword=:campo";
    $stmt= $dbh->prepare($sql);

    $stmt->bindParam(":campo", $campusId);
    try {
        $stmt->execute();
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
    $data=$stmt->fetchAll(PDO::FETCH_ASSOC);

    $sc = "<table>";
    foreach ($data as $row) 
    {
      $sc .= "<tr><td>=".$row['message_id'].">".$row['message_msg']."</td> </tr>";
    }     
    $sc .= "</table>";

    echo json_encode($sc);  
}
function courses()
{
    global $dbh;
    $schoolId = $_POST['school_id'];
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql ="SELECT * FROM tbl_courses WHERE school_id=:school_id";
    $stmt= $dbh->prepare($sql);

    $stmt->bindParam(":school_id", $schoolId);
    try {
        $stmt->execute();
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
    $data=$stmt->fetchAll(PDO::FETCH_ASSOC);
    $cor ="<option></option>";

    foreach ($data as $row) 
    {
      $cor.= "<option value=".$row['course_id'].">".$row['course_name']."</option>";
    }  

    echo json_encode($cor);                     
       
}
function newCourseFetchDept()
{  
 $schoolId = $_POST['school_id'];
    global $dbh;
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql ="SELECT * FROM tbl_department WHERE school_id=:school";
    $stmt= $dbh->prepare($sql);
    $stmt->bindParam(":school", $schoolId);
    try {
        $stmt->execute();
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
    $data=$stmt->fetchAll(PDO::FETCH_ASSOC);
                                          
    $hc = "<option></option>";
    foreach ($data as $row) 
    {
      $hc .= "<option value=".$row['dept_id'].">".$row['dept_name']."</option>";
    }     


    echo json_encode($hc);  
}
function newUnitFetchDept()
{  
    $schoolId = $_POST['school_id'];
    global $dbh;
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql ="SELECT * FROM tbl_department WHERE school_id=:school";
    $stmt= $dbh->prepare($sql);
    $stmt->bindParam(":school", $schoolId);
    try {
        $stmt->execute();
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
    $data=$stmt->fetchAll(PDO::FETCH_ASSOC);
                                          
    $fc = "<option></option>";
    foreach ($data as $row) 
    {
      $fc .= "<option value=".$row['dept_id'].">".$row['dept_name']."</option>";
    }     
  echo json_encode($fc);  
}
function newUnitFetchCourses()
{  
    $deptId = $_POST['dept_id'];
    global $dbh;
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql ="SELECT * FROM tbl_courses WHERE dept_id=:dept";
    $stmt= $dbh->prepare($sql);
    $stmt->bindParam(":dept", $deptId);
    try {
        $stmt->execute();
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
    $data=$stmt->fetchAll(PDO::FETCH_ASSOC);
                                          
    $sc = "<option></option>";
    foreach ($data as $row) 
    {
      $sc .= "<option value=".$row['course_id'].">".$row['course_name']."</option>";
    }     


    echo json_encode($sc);  
}
function lecturerFetchOnDeptChange()
{  
    $deptId = $_POST['dept_id'];
    global $dbh;
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql ="SELECT * FROM tbl_lecturer WHERE dept_id=:dept";
    $stmt= $dbh->prepare($sql);
    $stmt->bindParam(":dept", $deptId);
    try {
        $stmt->execute();
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
    $data=$stmt->fetchAll(PDO::FETCH_ASSOC);
                                          
    $sc = "<option></option>";
    foreach ($data as $row) 
    {
      $sc .= "<option value=".$row['lecturer_id'].">".$row['lecturer_name']."</option>";
    }     


    echo json_encode($sc);  
}
function viewUnitsRegistered(){
       $school =''; $department='';$course='';$year='';$semester='';
       $campo = $_POST['campus'];
       $school = $_POST['school'];
       $department = $_POST['department'];
       $course = $_POST['course'];
       $year = $_POST['year'];
       $semester = $_POST['semester'];

if (isset($campo) && isset($school) && isset($department) && isset($course) && isset($year) && isset($semester)) {
   header('location:registered_units.php?campus='.$campo.'&school='.$school.'&department='.$department.'&course='.$course.'&year='.$year.'&semester='.$semester);
}


}
function doAddStudent(){
      global $dbh;
        $data='';
        $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
       $studentname= $_POST['studentname'];
       $regno = $_POST['regno'];
       $campus = $_POST['campus'];
       $school = $_POST['school'];
       $course = $_POST['course'];
       $gender = $_POST['gender'];        
       $feepaid = $_POST['feepaid'];
       $status = "0";
       $regnotoupper  = strtoupper($regno);
        $sql ="INSERT INTO tbl_students (student_names,student_regno, course_id, campus_id, school_id, student_gender,student_active) VALUES (:name,:regno,:course,:campus,:school,:gender,:active)";
        $stmt= $dbh->prepare($sql);
        $stmt->bindParam(":name", $studentname);
        $stmt->bindParam(":regno", $regnotoupper);
        $stmt->bindParam(":course",$course );
        $stmt->bindParam(":campus", $campus);
        $stmt->bindParam(":school", $school);
        $stmt->bindParam(":gender", $gender);
        $stmt->bindParam(":active", $status);
        try {
            $data=$stmt->execute();
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        if ($data) {
          header('location:new_student.php?s=success');
          assignCourse($regno,$course);
          feePaid($regno,$feepaid);
        }
        else {
          header('location:new_student.php?s=fail');
        }

}
      function feePaid($regno,$feepaid) {
         global $dbh;
         $data='';
         $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
         $sql ="INSERT INTO tbl_feestatement(feestatement_balance,student_regno) VALUES (:balance,:regno)";
         $stmt= $dbh->prepare($sql);
         $stmt->bindParam(":balance", $feepaid);
         $stmt->bindParam(":regno", $regno);
          try {
                  $data=$stmt->execute();
              } catch (PDOException $e) {
                  echo $e->getMessage();
              }
              if ($data) {
              echo "fee paid updated --success";
              }
              else{
                echo "failed to update fee";
              }

        }
function assignCourse($regno,$course){
       global $dbh;
       $data='';
       $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
       $sql="SELECT unit_id FROM tbl_units WHERE course_id=:courseid";
       $stmt= $dbh->prepare($sql);
       $stmt->bindParam(":courseid", $course);
        try {
            $data=$stmt->execute();
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        $data=$stmt->fetchAll(PDO::FETCH_ASSOC);
        if ($data) {
        foreach ($data as $row) {
          $unitid = $row['unit_id'];
          $status ="5";
          $sql ="INSERT INTO tbl_units_students(student_regno,unit_id,unit_status) VALUES (:regno,:unitid,:status)";
          $stmt= $dbh->prepare($sql);
         $stmt->bindParam(":regno", $regno);
         $stmt->bindParam(":unitid", $unitid);
         $stmt->bindParam(":status", $status);
        try {
            $data=$stmt->execute();
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        if ($data) {
        echo "success";
        }
        else{
          echo "failed";
        }

        }  
        }
        else {
         echo "haijapata unit yoyote";
        }
}
function doAddNewCourse(){
     global $dbh;
       $data='';
       $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
     $name= $_POST['coursename'];
       $school = $_POST['school'];
       $dept = $_POST['department'];
       $coursetype = $_POST['coursetype'];
       $fee = $_POST['fee'];
       
        $sql ="INSERT INTO tbl_courses (course_name,school_id, fee_id, coursetype_id, dept_id) VALUES (:name,:school,:fee,:coursetype,:dept)";
        $stmt= $dbh->prepare($sql);
        $stmt->bindParam(":name", $name);
        $stmt->bindParam(":school", $school);
        $stmt->bindParam(":fee",$fee );
        $stmt->bindParam(":coursetype", $coursetype);
        $stmt->bindParam(":dept", $dept);
       
        try {
            $data=$stmt->execute();
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
  if ($data) {
          header('location:new_course.php?s=success');
        }
        else {
          header('location:new_course.php?s=fail');
        }
} 
function doAddNewDept(){
       global $dbh;
       $data='';
       $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
       $name= $_POST['deptname'];
       $school = $_POST['school'];
       
       
        $sql ="INSERT INTO tbl_department (dept_name,school_id) VALUES (:name,:school)";
        $stmt= $dbh->prepare($sql);
        $stmt->bindParam(":name", $name);
        $stmt->bindParam(":school", $school);
            
        try {
            $data=$stmt->execute();
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
  if ($data) {
          header('location:new_department.php?s=success');
        }
        else {
          header('location:new_department.php?s=fail');
        }
} 
function doAddNewSchool(){
       global $dbh;
       $data='';
       $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
       $school= $_POST['school'];
       $campus = $_POST['campus'];
       
       
        $sql ="INSERT INTO tbl_schools (school_name,campus_id) VALUES (:school,:campus)";
        $stmt= $dbh->prepare($sql);
        $stmt->bindParam(":school", $school);
        $stmt->bindParam(":campus", $campus);
            
        try {
            $data=$stmt->execute();
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
  if ($data) {
          header('location:new_school.php?s=success');
        }
        else {
          header('location:new_school.php?s=fail');
        }
} 
function doAddNewCampus(){
       global $dbh;
       $data='';
       $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
       $school= $_POST['school'];
       $contacts = $_POST['contacts'];
       $location = $_POST['location'];
       
       
        $sql ="INSERT INTO tbl_campus (campus_name,campus_contacts,campus_location) VALUES (:school,:contacts,:location)";
        $stmt= $dbh->prepare($sql);
        $stmt->bindParam(":school", $school);
        $stmt->bindParam(":contacts", $contacts);
        $stmt->bindParam(":location", $location);
            
        try {
            $data=$stmt->execute();
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
  if ($data) {
          header('location:new_campus.php?s=success');
        }
        else {
          header('location:new_campus.php?s=fail');
        }
} 
function doAddNewLecturer(){
       global $dbh;
       $data='';
       $status="1";
       $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
       $name= $_POST['lecname'];
       $department = $_POST['department'];
       
       
        $sql ="INSERT INTO tbl_lecturer (lecturer_name,dept_id,lecturer_status) VALUES (:name,:department,:status)";
        $stmt= $dbh->prepare($sql);
        $stmt->bindParam(":name", $name);
        $stmt->bindParam(":department", $department);
        $stmt->bindParam(":status", $status);
        try {
            $data=$stmt->execute();
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
  if ($data) {
          header('location:new_lecturer.php?s=success');
        }
        else {
          header('location:new_lecturer.php?s=fail');
        }
} 
function doAddNewHostel(){
       global $dbh;
       $data='';
       $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
       $name= $_POST['name'];
       $capacity = $_POST['capacity'];
       $gender = $_POST['gender'];
       
       
        $sql ="INSERT INTO tbl_hostel (hostel_name,hostel_capacity,hostel_status) VALUES (:name,:capacity,:gender)";
        $stmt= $dbh->prepare($sql);
        $stmt->bindParam(":name", $name);
        $stmt->bindParam(":capacity", $capacity);
        $stmt->bindParam(":gender", $gender);
            
        try {
            $data=$stmt->execute();
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
  if ($data) {
          header('location:new_hostel.php?s=success');
        }
        else {
          header('location:new_hostel.php?s=fail');
        }
} 
function doAddNewUnit(){
      global $dbh;
        $data='';
        $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
       $unitname= $_POST['unitname'];
       $unitcode = $_POST['unitcode'];
       $department = $_POST['department'];
       $course = $_POST['course'];
       $year = $_POST['year'];
       $semester = $_POST['semester'];        
        $unitcodeconverted  = strtoupper($unitcode);
        $sql ="INSERT INTO tbl_units(unit_name,unit_code, course_id, dept_id, year_id, semester_id) VALUES (:unitname,:unitcode,:course,:dept,:year,:semester)";
        $stmt= $dbh->prepare($sql);
        $stmt->bindParam(":unitname", $unitname);
        $stmt->bindParam(":unitcode", $unitcodeconverted);
        $stmt->bindParam(":course",$course );
        $stmt->bindParam(":dept", $department);
        $stmt->bindParam(":year", $year);
        $stmt->bindParam(":semester", $semester);
       
        try {
            $data=$stmt->execute();
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        if ($data) {
         header('location:new_unit.php?s=success');
        }
        else {
        header('location:new_unit.php?s=fail');
        }

}

function doStatusChange() {
   global $dbh;
   $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
   $data = '';
   $sts = $_REQUEST['sts'];   
   $uid = $_REQUEST['id'];
   $phone = $_REQUEST['phone'];
   $keyword = $_REQUEST['keyword'];
   $username    = "qsoft";
   $apiKey      = "3da4460be41731440bf42ac3e10e175030d9863615acad81d9a39473a3e745a6";
   $shortcode   = "21441";
   $gateway  = new AfricaStalkingGateway($username, $apiKey);
   
   if ($sts==0) { //deactivate
      $deactivateStatus = "1"; 
         $sql = $dbh->prepare("UPDATE tbl_totalsubscribers SET total_status = :status WHERE total_phoneno = :phone");
         $sql->bindParam(":status", $deactivateStatus );   
         $sql->bindParam(":phone", $phone );        
         try {
            $data = $sql->execute();          
        } catch(PDOException $e) {            
          echo $e->getMessage();          
        } 
        if ($data) {
          try {
            $result = $gateway->deleteSubscription($phone, $shortcode,$keyword);               
           }
           catch(AfricasTalkingGatewayException $e){
               echo $e->getMessage();
           }
        }
       
         echo "Deactivation sent- Sucess";
         }
   
  else{ //activate
           $ActivateStatus = "0"; 
         $sql = $dbh->prepare("UPDATE tbl_totalsubscribers SET total_status = :status WHERE total_phoneno = :phone");
         $sql->bindParam(":status", $ActivateStatus );   
         $sql->bindParam(":phone", $phone );        
         try {
            $data = $sql->execute();          
        } catch(PDOException $e) {            
          echo $e->getMessage();          
        } 
        if ($data) {
                 try {
                 $results= $gateway->createSubscription($phone, $shortcode, $keyword);
              }
              catch(AfricasTalkingGatewayException $e){
                       echo $e->getMessage();
                
              }
        }
     
      echo "Actvation Success-  Sent";
  }

} 
function doLecStatusChange() {

  
   global $dbh;
   $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
   $dbh->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
   $data = '';
   $lec=null;
   $sts = $_REQUEST['sts'];   
   $uid = $_REQUEST['id'];
   $sql = $dbh->prepare("UPDATE tbl_units SET lecturer_id = :null, unit_status=:status WHERE unit_id = :id");
   //$sql->bindValue(":lec", $lec);
   $sql->bindParam(":null", $lec, PDO::PARAM_NULL);
   $sql->bindParam(":status", $sts );   
   $sql->bindParam(":id", $uid );
   
   try {
      
    $data = $sql->execute();
    
  } catch(PDOException $e) {
      
    echo $e->getMessage();
    
  }
  
  echo $data;

} 

function lecturerChange() {
   global $dbh;
   $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
   $data = '';
   $sts = $_REQUEST['sts'];   
   $uid = $_REQUEST['id'];
   $sql = $dbh->prepare("UPDATE tbl_lecturer SET lecturer_status = :status WHERE lecturer_id = :id");

   $sql->bindParam(":status", $sts );   
   $sql->bindParam(":id", $uid );
   
   try {
      
    $data = $sql->execute();
    
  } catch(PDOException $e) {
      
    echo $e->getMessage();
    
  }
  
  echo $data;

} 
function roomDeallocate() {
   global $dbh;
   $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
   $data = '';
   $sts = $_REQUEST['sts'];   
   $uid = $_REQUEST['id'];
   $sql = $dbh->prepare("UPDATE tbl_roomallocation SET room_status = :status WHERE student_regno   = :id");

   $sql->bindParam(":status", $sts );   
   $sql->bindParam(":id", $uid );
   
   try {
      
    $data = $sql->execute();
    
  } catch(PDOException $e) {
      
    echo $e->getMessage();
    
  }
  
  echo $data;

} 
function doDeleteEnrollment() {
   global $dbh;
   $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
   $data = '';
   $uid = $_REQUEST['id'];
   $sql = $dbh->prepare("DELETE FROM tbl_students WHERE student_regno = :id");

   $sql->bindParam(":id", $uid );
   
   try {
      
    $data = $sql->execute();
    
  } catch(PDOException $e) {
      
    echo $e->getMessage();
    
  }
  
  echo $data;

}
function doDeleteLecturer() {
   global $dbh;
   $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
   $data = '';
   $uid = $_REQUEST['id'];
   $sql = $dbh->prepare("DELETE FROM tbl_lecturer WHERE lecturer_id = :id");

   $sql->bindParam(":id", $uid );
   
   try {
      
    $data = $sql->execute();
    
  } catch(PDOException $e) {
      
    echo $e->getMessage();
    
  }
  
  echo $data;

}
function graduationState() {
   global $dbh;
   $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
   $data = '';
   $sts = $_REQUEST['sts'];   
   $uid = $_REQUEST['id'];
   $sql = $dbh->prepare("UPDATE tbl_onlineservicerequests SET request_status = :status WHERE student_regno = :id");

   $sql->bindParam(":status", $sts );   
   $sql->bindParam(":id", $uid );
   
   try {
      
    $data = $sql->execute();
    
  } catch(PDOException $e) {
      
    echo $e->getMessage();
    
  }
  
  echo $data;

} 
function graduationDelete() {
   global $dbh;
   $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
   $data = '';
   $uid = $_REQUEST['id'];
   $sql = $dbh->prepare("DELETE FROM tbl_onlineservicerequests WHERE student_regno = :id");

   $sql->bindParam(":id", $uid );
   
   try {
      
    $data = $sql->execute();
    
  } catch(PDOException $e) {
      
    echo $e->getMessage();
    
  }
  
  echo $data;

}
function allocateRoom() {
   global $dbh;
   $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
   $data = '';
   $sts = $_REQUEST['sts'];   
   $uid = $_REQUEST['id'];
   $sql = $dbh->prepare("UPDATE tbl_roomallocation SET room_status = :status WHERE student_regno = :id");

   $sql->bindParam(":status", $sts );   
   $sql->bindParam(":id", $uid );
   
   try {
      
    $data = $sql->execute();
    
  } catch(PDOException $e) {
      
    echo $e->getMessage();
    
  }
  
  echo $data;

} 
function transcriptsState() {
   global $dbh;
   $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
   $data = '';
   $sts = $_REQUEST['sts'];   
   $uid = $_REQUEST['id'];
   $sql = $dbh->prepare("UPDATE tbl_onlineservicerequests SET request_status = :status WHERE student_regno = :id");

   $sql->bindParam(":status", $sts );   
   $sql->bindParam(":id", $uid );
   
   try {
      
    $data = $sql->execute();
    
  } catch(PDOException $e) {
      
    echo $e->getMessage();
    
  }
  
  echo $data;

} 
function certState() {
   global $dbh;
   $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
   $data = '';
   $sts = $_REQUEST['sts'];   
   $uid = $_REQUEST['id'];
   $sql = $dbh->prepare("UPDATE tbl_onlineservicerequests SET request_status = :status WHERE student_regno = :id");

   $sql->bindParam(":status", $sts );   
   $sql->bindParam(":id", $uid );
   
   try {
      
    $data = $sql->execute();
    
  } catch(PDOException $e) {
      
    echo $e->getMessage();
    
  }
  
  echo $data;

} 
function viewStudentDetails(){
     
   $data = $_REQUEST['id']; 
    echo $data;
  
}
function assignLecturer(){
     
   $data = $_REQUEST['id']; 
    echo $data;
  
}
function assignLecture(){
   $lecturerid = $_POST['lecturer'];
   $unitid = $_POST['unitid'];
   global $dbh;
   $status="1";
   $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
   $data = '';
   //$sql =$dbh->prepare("INSERT INTO tbl_units (lecturer_id) VALUES (:)");
   $sql = $dbh->prepare("UPDATE tbl_units SET lecturer_id=:lec, unit_status=:status WHERE unit_id=:id");

   $sql->bindParam(":lec", $lecturerid );   
   $sql->bindParam(":status", $status );   
   $sql->bindParam(":id", $unitid );
   
 try {
  $data= $sql->execute();
 } catch (PDOException $e) {
   echo $e->getMessage();
 }

if ($data) {
  //header('location:registered_units.php?s=success');
    echo  "<script type=\"text/javascript\">";
   echo "window.alert('Success. Unit Assigned Successfully!!!');".
         "window.document.location=('reports.php#lecturer_units');";
   echo "</script>";
}
else {
  header('location:registered_units.php?s=fail');
}
}
function doError() {
    echo 'error';
}
?>