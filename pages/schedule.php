<?php
include_once 'connect.php';
error_reporting(E_ALL & ~E_NOTICE);
    $loggedUser ="";   
    session_start(); 
    $loggedUser = $_SESSION['login_user'];  
    if ($loggedUser) {
    }
    else{
        echo "<script type=\"text/javascript\">";
        echo "window.alert('Hey Dude! Login First.....');".
             "window.document.location=('index.php');";
       echo  "</script>";
    }
    $s = ( isset($_GET['s']) )? $_GET['s'] : 'off'; 

?> 
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Qsoft Technologies Admin</title>

    <!-- Bootstrap Core CSS -->
    <link href="../bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="../bower_components/metisMenu/dist/metisMenu.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="../dist/css/sb-admin-2.css" rel="stylesheet">

    <!-- Select 2 -->
    <link href="../select2/select2.min.css" rel="stylesheet">
    <link href="../select2/select2-bootstrap.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="../bower_components/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

     <!-- DataTables CSS -->
<link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.5/css/jquery.dataTables.css">
  
<!-- jQuery -->
 
<script type="text/javascript" charset="utf8" src="//code.jquery.com/jquery-1.10.2.min.js"></script>
  
<!-- DataTables -->

<script type="text/javascript" charset="utf8" src="//cdn.datatables.net/1.10.5/js/jquery.dataTables.js"></script>


<link rel="stylesheet" type="text/css" href="../dist/css/tcal.css" />
<script type="text/javascript" src="../dist/js/tcal.js"></script>
<!-- <script src="../datatype/js/jquery.js"></script>
  <script src="../datatype/js/jquery.dataTables.js"></script>-->
<script type="text/javascript">
        var oTable;
      $(function(){
            console.log( "ready!" );
            // setup dataTables
           var oTable=  $('.footable-users').dataTable({
                responsive: true
                 });
           


        
});
        </script>
</head>

<body>

    <div id="wrapper">

   <!-- Navigation -->
        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.html">Qsoft Technologies Admin V1.6</a>
            </div>
            <!-- /.navbar-header -->

            <ul class="nav navbar-top-links navbar-right">
                <li>
                <?php 
                echo " Welcome ".$loggedUser;
                ?>
                </li>
                <!-- /.dropdown -->
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-user fa-fw"></i>  <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                        <li><a href="#"><i class="fa fa-user fa-fw"></i> User Profile</a>
                        </li>
                
                        <li><a href="home.php?do=logout"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
                        </li>
                    </ul>
                    <!-- /.dropdown-user -->
                </li>
                <!-- /.dropdown -->
            </ul>
            <!-- /.navbar-top-links -->

            <div class="navbar-default sidebar" role="navigation">
                <div class="sidebar-nav navbar-collapse">
                  <ul class="nav" id="side-menu">
                        <li class="sidebar-search">
                            <div class="input-group custom-search-form">
                                <input type="text" class="form-control" placeholder="Search...">
                                <span class="input-group-btn">
                                <button class="btn btn-default" type="button">
                                    <i class="fa fa-search"></i>
                                </button>
                            </span>
                            </div>
                            <!-- /input-group -->
                        </li>
                        <li><a href="home.php"><i class="fa fa-dashboard fa-fw"></i> <b>Dashboard</b></a></li>
                        <li><a href="subscribers.php"><i class="fa fa-edit fa-fw"></i><b>Subscribers</b></a></li>
                        <li><a href="messages.php"><i class="fa fa-files-o fa-fw"></i> <b>Messages</b></a></li>
                        <li><a href="schedule.php"><i class="fa fa-bar-chart-o fa-fw"></i><b> Schedule</b></a></li>
                        <li><a href="#"><i class="fa fa-sitemap fa-fw"></i> <b>Settings</b><span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                              <li><a href="deactivate.php"><b>Manage Contacts</b></a></li>
                               <li><a href="http://qsoft-technologies.com"><b>Visit Website</b></a></li>
                                 <li><a href="generate.php"><b>Generate Numbers</b></a></li>
                                 <li><a href="subscribe_users.php"><b>Subscriber Users</b></a></li>
                                <li><a href="home?do=logout"><b>Logout</b></a></li> 
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
                      
                    </ul>
                </div>
                <!-- /.sidebar-collapse -->
            </div>
            <!-- /.navbar-static-side -->
        </nav>
        <!-- Page Content -->
        <div id="page-wrapper">
         <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Schedule Content</h1>
                       <div id="thanks"></div>
                   
                </div>
              
                <div class="col-lg-12">
                    <div class="panel panel-default">

                        <div class="panel-heading">
                          Select Keyword to update
                        </div>
                         <div class="panel-body">
                            <?php 
                            
                                     global $dbh;
                                     $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                                     $data = $ret = '';   
                                     $today = date('Y-m-d');
                                     $sql = $dbh->prepare("SELECT message_id, message_day, message_msg, message_keyword, date(message_date_submited) as datesubmited FROM tbl_allmessages");
                                     try {
                                          $sql->execute();
                                      } catch(PDOException $e) {
                                          echo $e->getMessage();
                                      }
                                       $data = $sql->fetchAll(PDO::FETCH_ASSOC);

                                      if ($data) {

                                          $ret = '<table class="table footable-users table-striped" id="footable-users"><thead>';
                                          $ret .= '<tr><th> # </th><th>Day</th> <th> Keyword </th><th>Message</th><th>Date Updated</th><th>Action</th></tr>';
                                          $ret .= '</thead><tbody>';
                                          foreach($data as $row){
                                             $msgId = $row['message_id'];
                                             $msgDay = $row['message_day'] ;
                                             $msgKeyword = $row['message_keyword'];
                                             $msgText = $row['message_msg'];
                                             $time = $row['datesubmited'];
                                             $diff = abs(strtotime($today) - strtotime($time));
                                             $days = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24));
                                             
                                             if($days>=6){
                                                 $ret .="<tr><td>".$msgId."</td><td>".$msgDay."</td><td>".$msgKeyword."</td><td> <span style='color: #FF0000;'>".$msgText." </span></td><td> <b>".$days."</b> Days ago </br><span class='label label-warning'>Needs Update</span></td>";
                                                 $ret .= '<td><a data-day="' . $row['message_day'] . '"  data-keyword="'.$row['message_keyword'].'"  data-msg="'.$row['message_msg'].'" class="open-AddBookDialog btn btn-danger" href="#updateStuff">Update</a></td></tr>';
                                                }
                                                else {
                                                  $ret .= "<tr><td>".$msgId."</td><td>".$msgDay."</td><td>".$msgKeyword."</td><td>".$msgText." </td><td> <b>".$days."</b> Days ago</td>";
                                                  $ret .= '<td><a data-day="' . $row['message_day'] . '"  data-keyword="'.$row['message_keyword'].'"  data-msg="'.$row['message_msg'].'" class="open-AddBookDialog btn btn-success" href="#updateStuff">Update</a></td></tr>';
                                                 }



                                             // $ret .= '<tr><td>' . $row['message_id'] . '</td>';
                                             // $ret .= '<td>' . $row['message_day'] . '</td>';
                                             // $ret .= '<td>' . $row['message_keyword'] . '</td>';
                                             // $ret .= '<td>' . $row['message_msg'] . '</td>';
                                             // $ret .= '<td>' . date('D M d, Y', strtotime($row['message_date_submited'])) . '</td>';
                                              //$ret .= '<td><a data-day="' . $row['message_day'] . '"  data-keyword="'.$row['message_keyword'].'"  data-msg="'.$row['message_msg'].'" class="open-AddBookDialog btn btn-primary" href="#updateStuff">Update</a></td></tr>';
                                          } //?do=studentdetails
                                          $ret .= '</tbody></table>';
                                              
                                      } else {
                                          
                                          $ret = '<p>Nothing to display here!</p>';   
                                      
                                      }
                                      
                                      echo $ret;
                                      

                            ?>

                            
                         </div>
                    </div>
                  
                </div> 
              

            </div>

<div class="modal fade" id="updateStuff" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel">Update Content</h4>
      </div>
      <div class="modal-body">
      <form class="contact" name="contact" action="handler.php" >
      <div class="form-group">
       <label>Day </label>
        <input type="text" name="dayID" id="dayID" value=""  disabled />
      
         <label>Keyword </label>
        <input type="text" name="keywordID" id="keywordID" value=""  disabled />
        </div>
        <div class="form-group">
        <label>Message to be Updated </label>
        <textarea name="txtID" id="txtID" value="" rows="4" cols="50"></textarea>
        </div>
        </form>
      </div>
      <div class="modal-footer">
     
        <button type="button" class="btn btn-default"  data-dismiss="modal">Close</button>
        <input class="btn btn-success" type="submit" value="Update!!" id="submit" name="submit">
      </div>
    </div><!-- /.modal-content -->

  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
    </div>
    <!-- /#wrapper -->

    <!-- jQuery -->

    <!-- Bootstrap Core JavaScript -->
    <script src="../bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="../bower_components/metisMenu/dist/metisMenu.min.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="../dist/js/sb-admin-2.js"></script>

    <!-- Select2 JS -->
    <script src="../select2/select2.min.js"></script>

    <!-- Custom Theme JavaScript -->

    <script>
    $(document).ready(function () {
      $("input#submit").click(function(){
         console.log('hapa');
        $.ajax({
          type: "POST",
          url: "handler.php",  
          dataType: 'json',
          data: 
              { 
                  dayhapa: $('#dayID').val(),
                  keywordhapa: $('#keywordID').val(),
                  txthapa: $('#txtID').val(),
                  do_dropdown: 'updateContent', 
              },
              
          success: function(school){
             console.log('sweeeeeeyo!!');
              console.log(school);
               location.reload(); 
            $("#thanks").html(school);
            $("#updateStuff").modal('hide'); 
          },
          error: function(){
            alert("failure");
            console.log('Failed')
          }
        });
      });
    });
    </script>

      <script type="text/javascript">
        $(document).on("click", ".open-AddBookDialog", function (e) {

            e.preventDefault();

            var _self = $(this);
            var _self2 = $(this);
            var _self3 = $(this);

            var myBookId = _self.data('day');
            $("#dayID").val(myBookId);

            var txtmsg = _self2.data('msg');
            $("#txtID").val(txtmsg);

             var keyword = _self2.data('keyword');
            $("#keywordID").val(keyword);

            $(_self.attr('href')).modal('show');
          });
      </script>
    <script type="text/javascript">
        $(document).ready(function()
        {
            $('#campus').select2({
                placeholder: "Select a Campus",
                allowClear: true
            });
            

            $('#campus').on('change', function()
            {
                console.log( $('#campus').val() );
                if ( parseInt($('#campus').val()) > 0 ) 
                {
                    $.ajax(
                    {
                        type: 'POST',
                        cache: false,
                        url: 'handler.php',
                        data: 
                        {
                            campus_id:  $('#campus').val(),
                            do_dropdown: 'done_campus',
                        },
                        dataType: 'json',
                        success: function(school)
                        {
                            console.log(school);

                            $('#school').removeAttr('disabled');
                            $('#school').empty();

                            $('#school').html(school);
                        }

                    });
                }else{
                      $('#school').attr('disabled', 'disabled');
                      $('#school').empty();
                     
                }
                
            });


        });

    </script>
  
</body>

</html>


<?php
 function allSubscribers(){
    global $dbh;
   $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
   $data = $ret = '';   
   $service ="2";
   $status ="1";
   $datadead='';
   $dataactive='';
   $sql = $dbh->prepare("SELECT  count(*) AS Hesabu, total_keyword,total_status FROM tbl_totalsubscribers  Group by total_keyword");
   //$sql->bindParam(":leo",$prev_date);
   //$sql->bindParam(":state",$status);
   try {
        $sql->execute();
    } catch(PDOException $e) {
        echo $e->getMessage();
    }
     $data = $sql->fetchAll(PDO::FETCH_ASSOC);

    if ($data) {
        $ret = '<div class="col-lg-4">';
        $ret .= '<table class="table graduation table-striped" id="graduation"><thead>';
        $ret .= '<tr><th>KEYWORD</th><th>Total</th></tr>';
        $ret .= '</thead><tbody>';
        foreach($data as $row){
               $keywordhapa = $row['total_keyword'];
               $stats = $row['Hesabu'];
               $state = $row['total_status'];                         
                           
                             $zero ="0";
                             $sql = $dbh->prepare("SELECT count(total_status) FROM tbl_totalsubscribers WHERE total_status=:active AND total_keyword=:keyword  Group by total_keyword");
                             $sql->bindParam(":active",$zero);
                              $sql->bindParam(":keyword",$keywordhapa);
                             try {
                                        $sql->execute();
                                    } catch(PDOException $e) {
                                        echo $e->getMessage();
                                    }
                                    $dataactive = $sql->fetchColumn();
            
                              $one ="1";
                              $sql = $dbh->prepare("SELECT  count(total_status) FROM tbl_totalsubscribers WHERE total_status=:dead AND total_keyword=:keyword  Group by total_keyword");
                              $sql->bindParam(":dead",$one);
                              $sql->bindParam(":keyword",$keywordhapa);
                             try {
                                        $sql->execute();
                                    } catch(PDOException $e) {
                                        echo $e->getMessage();
                                    }
                                     $datadead = $sql->fetchColumn();

             $ret .= '<tr><td>' . $keywordhapa . '</td> <td>'.$stats.'</td></tr>';
           } 
        $ret .= '</tbody></table>';
            
    } else {
        
        $ret = '<p>Nothing to display here!</p>';   
    
    }
    
    echo $ret;
 }
?>