<?php
include_once 'connect.php';
    $loggedUser ="";   
    session_start(); 
    $loggedUser = $_SESSION['login_user'];  
    if ($loggedUser) {
    }
    else{
        ?> 
 <script type="text/javascript">
     alert("Dude!!! You need to log in First... "); 
  </script>
        <?php
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
            var oTable=  $('.graduation').dataTable();
           


        
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
                    <h1 class="page-header">Subscribers Statistics</h1>
                </div>
              
                <div class="col-lg-8">
                    <div class="panel panel-default">

                        <div class="panel-heading">
                          Select Dates To view Subscribers
                        </div>
                         <div class="panel-body">
                            
                             <form action="subscribers.php" method="get">
                             <div class="form-group">
                                <label>Start</label>
                                <input class="tcal" name="d1" id="deptname" type="text" value="">
                             </div>
                             <div class="form-group">
                                <label>END</label>
                                <input class="tcal" name="d2" id="deptname" type="text" value="">
                             </div>
                             <div class="form-group">
                                 <input type="submit" value="Search">

                                  <?php
                                            include('connect.php');
                                            if (isset($_GET["d1"])) { $d1  = $_GET["d1"]; } else { $d1=0; }; 
                                            if (isset($_GET["d2"])) { $d2  = $_GET["d2"]; } else { $d2=0; }; 


                                            if ($d1==0 || $d2==0) {
                                               
                                            }
                                            else{
                                                echo "<h4>Showing Subscibers From <span class='label label-primary'>".$d1."</span> To <span class='label label-primary'> ".$d2."</span> </h4>";
                                            }
                                              $data = $ret = '';   
                                              $result = $dbh->prepare("SELECT count(*) AS Hesabu,total_keyword,total_status FROM tbl_totalsubscribers WHERE total_date BETWEEN :a AND :b group by total_keyword");
                                            $result->bindParam(':a', $d1);
                                            $result->bindParam(':b', $d2);
                                            try {
                                                $result->execute();
                                            } catch (PDOException $e) {
                                                echo $e->getMessage();
                                            }
                                            $data=$result->fetchAll(PDO::FETCH_ASSOC);
                                            //$sql->fetchAll(PDO::FETCH_ASSOC);
                                            if ($data) {
                                                    $ret = '<table class="table"><thead>';
                                                    $ret .= '<tr><th>KEYWORD</th><th> ACTIVE </th><th>DEACTIVATED</th><th>Total</th></tr>';
                                                    $ret .= '</thead><tbody>';
                                            foreach ($data as $row) {
                                                            $keywordhapa = $row['total_keyword'];
                                                           $stats = $row['Hesabu'];
                                                           $state = $row['total_status'];

                                                                        $zero ="0";
                                                                         $sql = $dbh->prepare("SELECT count(total_status) FROM tbl_totalsubscribers WHERE total_status=:active AND total_keyword=:keyword  AND total_date BETWEEN :a AND :b Group by total_keyword");
                                                                         $sql->bindParam(":active",$zero);
                                                                          $sql->bindParam(":a", $d1);
                                                                          $sql->bindParam(":b", $d2);
                                                                          $sql->bindParam(":keyword",$keywordhapa);
                                                                         try {
                                                                                    $sql->execute();
                                                                                } catch(PDOException $e) {
                                                                                    echo $e->getMessage();
                                                                                }
                                                                                $dataactive = $sql->fetchColumn();
                                                        
                                                                          $one ="1";
                                                                          $sql = $dbh->prepare("SELECT  count(total_status) FROM tbl_totalsubscribers WHERE total_status=:dead AND total_keyword=:keyword  AND total_date BETWEEN :a AND :b Group by total_keyword");
                                                                          $sql->bindParam(":dead",$one);
                                                                          $sql->bindParam(":a", $d1);
                                                                          $sql->bindParam(":b", $d2);
                                                                          $sql->bindParam(":keyword",$keywordhapa);
                                                                         try {
                                                                                    $sql->execute();
                                                                                } catch(PDOException $e) {
                                                                                    echo $e->getMessage();
                                                                                }
                                                                                 $datadead = $sql->fetchColumn();
                                                         $ret .= '<tr><td>' . $keywordhapa . '</td><td>'.$dataactive.'</td> <td>'.$datadead.'</td> <td>'.$stats.'</td></tr>';
                                                    }

                                             $ret .= '</tbody></table>';

                                            }
                                            else {
                                                    if ($d1==0 || $d2==0) {
                                                               $ret ="<h4><span class='label label-info'>Please select dates</span> </h4>";
                                                            }
                                                            else{
                                                                
                                                               $ret ="<h4><span class='label label-warning'>No Subscribers For the selected Periods</span> </h4>";

                                                            }
                                                
                                                }
                                                
                                                echo $ret;


                                            ?>
                            </div>
                            </form>
                            
                         </div>
                    </div>
                  
                </div> 

                <div class="col-lg-4">
                    <div class="panel panel-default">

                        <div class="panel-heading">
                            All Time Statistics
                        </div>
                         <div class="panel-body">
                          <div class="row">
                             <div class="col-lg-4">

                              <?php
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
                                        $ret .= '<table class="table"><thead>';
                                        $ret .= '<tr><th>KEYWORD</th><th>ON</th><th>OFF</th><th>Total</th></tr>';
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

                                             $ret .= '<tr><td>' . $keywordhapa .'</td><td>  <button class="btn btn-success">'.$dataactive.'</button></td><td> <button class="btn btn-danger">'.$datadead.'</button></td></td><td>'.$stats.'</td></tr>';
                                           } 
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
                  
                </div>                

            </div>

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
   
   
</body>

</html>
