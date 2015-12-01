<?php
date_default_timezone_set("Africa/Nairobi");
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

<!-- <script src="../datatype/js/jquery.js"></script>
  <script src="../datatype/js/jquery.dataTables.js"></script>-->


<!-- <script src="../datatype/js/jquery.js"></script>
  <script src="../datatype/js/jquery.dataTables.js"></script>-->
 <script type="text/javascript">
        $(document).on("click", ".open-AddBookDialog", function (e) {
            var _self = $(this);
            e.preventDefault();
            console.log("I am here");

             var _self = $(this);
             $("#newsmsg").val();

            $(_self.attr('href')).modal('show');


          });
                $(document).on("click", ".open-newsDialog", function (e) {
            var _self = $(this);
            e.preventDefault();
            console.log("I am here");

             var _self = $(this);
             $("#newsmsg").val();

            $(_self.attr('href')).modal('show');


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
                <a class="navbar-brand" href="index.html">Qsoft Technologies Admin V1.6 <span class="label label-warning"> (BACK-UP SERVER) </span></a>
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
                <div class="col-lg-8">
                <div id="updateDone"></div>
                <!--<div id='loadingmessage' style='display:none'> <img src='img/ajax-loader.gif'/></div>-->
                    <h2 class="page-header">Welcome to Qsoft Technologies Dashboard</h2>
                </div>
                <div class="col-lg-4"> 
                  <row><a class="open-AddBookDialog btn btn-primary" href="#updatenews"> <h5> Send Breaking News </h5></a> 
                  <a class="open-newsDialog " href="#viewnews"> <h5> View Scheduled News </h5></a> </row>
                </div>
                <!-- /.col-lg-12 -->
            </div>
                        <!-- /.row -->
            <div class="row">
            <div class="wrap">
                <div class="col-lg-6 col-md-6">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-tasks fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                  <?php
                                 require('connect.php');
                                    global $dbh;
                                   $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                                   $data = $ret = '';   
                                   $service ="2";
                                   $status ="1";
                                   $datadead='';
                                   $sent ='';
                                   $dataactive='';
                                   $sql = $dbh->prepare("SELECT  count(*) AS Hesabu,sent_status FROM tbl_totalsentmessages ");
                                   try {
                                        $sql->execute();
                                    } catch(PDOException $e) {
                                        echo $e->getMessage();
                                    }
                                     $data = $sql->fetchAll(PDO::FETCH_ASSOC);

                                    if ($data) {
                                        //success msgs
                                         $zero ="Success";
                                         $sql = $dbh->prepare("SELECT count(sent_status) FROM tbl_totalsentmessages WHERE sent_status=:active");
                                         $sql->bindParam(":active",$zero);
                                         try {
                                                    $sql->execute();
                                                } catch(PDOException $e) {
                                                    echo $e->getMessage();
                                                }
                                                $dataactive = $sql->fetchColumn();
                                            //failed msgs
                                          $one ="Failed";
                                          $sql = $dbh->prepare("SELECT  count(sent_status) FROM tbl_totalsentmessages WHERE sent_status=:dead");
                                          $sql->bindParam(":dead",$one);
                                         try {
                                                    $sql->execute();
                                                } catch(PDOException $e) {
                                                    echo $e->getMessage();
                                                }
                                                 $datadead = $sql->fetchColumn();
                                                 //pending
                                          $sent ="Sent";
                                          $sql = $dbh->prepare("SELECT  count(sent_status) FROM tbl_totalsentmessages WHERE sent_status=:sent");
                                          $sql->bindParam(":sent",$sent);
                                         try {
                                                    $sql->execute();
                                                } catch(PDOException $e) {
                                                    echo $e->getMessage();
                                                }
                                                 $sent = $sql->fetchColumn();
                                             $ret .= 'Success : '.$dataactive.'</br> Failed : '.$datadead.'</br> Pending: '.$sent;
                                         
                                            
                                    } else {
                                        
                                        $ret = '<p>Nothing to display here!</p>';   
                                    
                                    }
                                    
                                   
                                
                              ?>
                                    <div class="medium"> <?php echo $ret ?></div>
                                    <div>Messages Sent</div>
                                </div>
                            </div>
                        </div>
                        <li><a href="messages.php">
                            <div class="panel-footer">
                                <span class="pull-left">View Detailed Messages</span> 
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a> </li>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6">
                    <div class="panel panel-green">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-tasks fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                 <?php
                                 require('connect.php');
                                    global $dbh;
                                   $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                                   $data = $ret = '';   
                                   $service ="2";
                                   $status ="1";
                                   $datadead='';
                                   $dataactive='';
                                   $sql = $dbh->prepare("SELECT  count(*) AS Hesabu,total_status FROM tbl_totalsubscribers");
                                   try {
                                        $sql->execute();
                                    } catch(PDOException $e) {
                                        echo $e->getMessage();
                                    }
                                     $data = $sql->fetchAll(PDO::FETCH_ASSOC);

                                    if ($data) {
                                      
                                         $zero ="0";
                                         $sql = $dbh->prepare("SELECT count(total_status) FROM tbl_totalsubscribers WHERE total_status=:active");
                                         $sql->bindParam(":active",$zero);
                                         try {
                                                    $sql->execute();
                                                } catch(PDOException $e) {
                                                    echo $e->getMessage();
                                                }
                                                $dataactive = $sql->fetchColumn();
                        
                                          $one ="1";
                                          $sql = $dbh->prepare("SELECT  count(total_status) FROM tbl_totalsubscribers WHERE total_status=:dead");
                                          $sql->bindParam(":dead",$one);
                                         try {
                                                    $sql->execute();
                                                } catch(PDOException $e) {
                                                    echo $e->getMessage();
                                                }
                                                 $datadead = $sql->fetchColumn();

                                             $ret .= 'Active : '.$dataactive.'</br> Not Active : '.$datadead;
                                         
                                            
                                    } else {
                                        
                                        $ret = '<p>Nothing to display here!</p>';   
                                    
                                    }
                                    
                                   
                                
                              ?>
                                    <div class="medium"><?php echo $ret?></div>
                                    <div>All Time Subscribers</div>
                                </div>
                            </div>
                        </div>
                        <li><a href="subscribers.php">
                            <div class="panel-footer">
                                <span class="pull-left">View Detailed Subscribers</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a></li>
                    </div>
                </div>

   
            </div>
            <!-- /.row -->
             <div class="row">
               <div class="divider"> </div>
                <div class="col-lg-12">
                <div class="panel panel-default">
                 <div class="panel-heading">
                 Last 10 Messages Sent 
                 </div>
                     <div class="panel-body">
                      <?php
                           require('connect.php');
                           global $dbh;
                           $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                           $data = $ret = '';  
                           $sql = $dbh->prepare("SELECT * FROM tbl_totalsentmessages ORDER BY sent_time DESC Limit 10");
                           try {
                                $sql->execute();
                            } catch(PDOException $e) {
                                echo $e->getMessage();
                            }
                             $data = $sql->fetchAll(PDO::FETCH_ASSOC);
                             if ($data) {
                            
                                $ret ='<table class="table table-striped table-bordered table-hover table-full-width"> ' ;
                                $ret .= '<tr><th>Date</th>';
                                $ret .='<th>Message</th> ';
                                $ret .='<th>Receiver</th> ';
                                $ret .='<th>keyword</th>';
                                $ret .='<th>Status</th></tr>';
                                foreach ($data as $row) {
                                    $date = $row['sent_time'];
                                    $msg = $row['sent_message'];
                                    $to = $row['sent_phoneno'];
                                    $keyword = $row['sent_keyword'];
                                    $status = $row['sent_status'];
                                    $nature = $row['sent_subscriptionstatus'];
                                    
                                    $tarehe=  date( "h:i A jS F Y", strtotime($date) );
                                    $reason = $row['failure_reason'];
                               // $ret .= ($row['room_status'] == '1') ? '<td id="sts"><span id="1" class="label label-success">Assigned</span></td>' : '<td id="sts"><span id="0" class="label label-danger">Not Yet Assigned</span></td>';
                                $ret .='<tr><td>'.$tarehe.'</td>' ;
                                $ret .='<td>'.$msg.' </td>'; 
                                $ret .='<td> '.$to.'</td>'; 
                                $ret .='<td> '.$keyword.' </td>'; 
                                $ret .=($status=='Success') ?'<td><span style="color:lightgreen">'.$status.'</span></td>':' <td><span style="color:red">'.$status.'</span>, <b>REASON:</b> <br/> <span style="color:red"> <b>'.$reason.'</b></span></td> </tr>';  
                                //$ret .=($nature=='0') ?'<td>Subscription Msg</td>':' <td> Daily Msg</td> </tr>'; 
                               // $ret .='<td>'.$reason.'</td>';
                                }
                                $ret .='</table></div>';
                             }
                             else
                             {
                                $ret = '<p>Nothing to display here!</p>';  
                             }
                             echo $ret;
                           ?>
                     </div>
                 </div>
                </div>

                </div>
                    </div>
                </div>
        </div>
        <!-- /#page-wrapper -->

        <div class="modal fade" id="updatenews" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="myModalLabel">Update Breaking News</h4>
                  </div>
                  <div class="modal-body">
                  <form class="news" name="news" action="handler2.php" >
                    <div class="form-group">
                    <label>Message </label>
                    </div>
                     <div class="form-group">
                      <textarea name="newsmsg" id="newsmsg" value="" rows="4" cols="50" placeholder="Message Here" ></textarea>
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

    <!--Start of modal2-->
 <div class="modal fade" id="viewnews" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel">Scheduled News</h4>
      </div>
      <div class="modal-body">
       <?php     
       date_default_timezone_set("Africa/Nairobi");
             global $dbh;
             $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
             $data = $ret = '';   
             //$today = date('Y-m-d');
             $today = date("Y-m-d H:i:s");
             $sql = $dbh->prepare("SELECT content_id, content_message,content_status, content_dateupdated, date(content_dateupdated) as datesubmited FROM tbl_content");
             try {
                  $sql->execute();
              } catch(PDOException $e) {
                  echo $e->getMessage();
              }
               $data = $sql->fetchAll(PDO::FETCH_ASSOC);

              if ($data) {
                  foreach($data as $row){
                     $msgId = $row['content_id'];
                     $msgStatus = $row['content_status'] ;
                     $msgText = $row['content_message'];
                     $time = $row['content_dateupdated'];
                     $date_updated = $row['datesubmited'];
                     $sweeyo = round((strtotime($time) - strtotime($today)) /60);
                     $tarehe=  date( "h:i A jS F Y", strtotime($time) );
                    ?>  <label><h4>Time Scheduled : </h4></label> <b><?php echo $tarehe ?> </b><br>
                    <label><h4><b>Status : </b></h4></label><?php echo ($msgStatus==1) ?'<span style="color:lightgreen">Sent Already </span>':' <td><span style="color:red"> Not Yet Sent </span>';  
?><br>
                     <label><h4><b>Time Elapsed : </b></h4></label><span class="label label-warning"> <?php echo $sweeyo ?> Minutes ago </span>  <br>
                    <label><h4><b>News Content : </b></h4></label><div class="alert alert-info"><h5> <?php echo $msgText ?> </h5></div><br><?php
                       
                  } 
                      
              } else {                
              
              }
 ?>
      </div>
      <div class="modal-footer">
     
        <button type="button" class="btn btn-default"  data-dismiss="modal">Close</button>
      </div>
    </div><!-- /.modal-content -->

  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

   <!-- Modal 2 for checking updated news hapa-->

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
      <!-- Custom Theme JavaScript -->
   <script>
   $(document).ready(function(){
    $("input#submit").click(function(){
        console.log("i am here");
        $.ajax({
            type: "POST",
            url: "handler2.php",
            dataType: "json",
            data: {
                 messageHere: $('#newsmsg').val(),
                do_dropdown: 'newsUpdate',
            },
            success: function(sc){
                console.log(sc);
                console.log("news updated correctly hapa!!!");
                $("#updateDone").html(sc);
                $("#updatenews").modal('hide');
            },
            error: function(sc){
                console.log(sc);
                alert("Failed");
                console.log("Failed to Update!");
            }
        });
    });

   });
   </script>
   
</body>

</html>
