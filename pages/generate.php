<?php
require_once('../core/AfricasTalkingGateway.php');
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
    //$do = ($_REQUEST) ? $_REQUEST['do'] : 'nothing' ;

?> 
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Dimension Admin</title>

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
<script type="text/javascript">
        var oTable;
      $(function(){
            console.log( "ready!" );
            // setup dataTables
             var oTable2= $('.graduation').dataTable({
                responsive: true
                 }); 
           
                        //change the student status
            $('.act').on('click',function(){
               console.log( "Clicked!" );
                // status span
                var status = $(this).parents('td').siblings('td#sts');
                // current status
                var csts = status.children('span').attr('id');
                // if current status == 1, new status = 0
                var nsts = (csts == 1) ? 0 : 1;
                var anc = $(this);

                $.ajax({
                    url: 'handler.php',
                    type: 'post',
                    data: {
                        do: 'sts',
                        sts: nsts,
                        phone: ($(this).attr('id-phone')),
                        keyword: ($(this).attr('id-keyword')),
                        id: ($(this).attr('id'))

                    },
                    success: function(msg){
                       console.log( msg);
                        if(nsts == '1') { 
                            status.empty().html('<span id="1"  class="label label-success">Active</span>');
                            anc.text('Deactivate');
                            console.log( "11111111" );
                        } else {
                            status.empty().html('<span id="0"  class="label label-warning">Not Active</span>');
                            anc.text('Activate');
                            console.log( "00000000" );
                        }
                                            
                    }
                });
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
                <a class="navbar-brand" href="index.html">Dimension Admin V1.6</a>
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
                                 <li><a href="best_messaging.php"><b>Best Messaging Subscribe</b></a></li>
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
                 <h1 class="page-header">Generate Random Numbers to database</h1>
                    <div class="panel panel-default">

                        <div class="panel-heading">
                           Simply fill the quantity of numbers to generate randomly and the type of the numbers. i.e 28, 29, 24,26 and enter a tag for future identification
                        </div>
                         <div class="panel-body">
                            
                             <form action="generate.php" method="GET" class="form-horizontal">
                             <div class="form-group">
                                <label for="inputEmail3" class="col-sm-2 control-label">Numbers to Generate</label>
                                <div class="col-sm-8">
                                  <input class="form-control" name="d1" id="d1" placeholder="500, 1000, 10000" type="text" >
                                </div>
                              </div>
                               <div class="form-group">
                                <label for="inputEmail3" class="col-sm-2 control-label">Nature of Contacts</label>
                                <div class="col-sm-8">
                                  <input class="form-control" name="d2" id="d2" placeholder="28,22,20,19,24" type="text" >
                                </div>
                              </div>
                               <div class="form-group">
                                <label for="inputEmail3" class="col-sm-2 control-label">Tag</label>
                                <div class="col-sm-8">
                                  <input class="form-control" name="d3" id="d3" placeholder="test, robert, brian, love" type="text" >
                                </div>
                              </div>
                               <div class="form-group">
                                <div class="col-sm-offset-2 col-sm-8">
                                 <!-- <button type="submit" class="btn btn-default">Sign in</button>-->
                                  <input type="submit" name="generate" id="generate" value="generate" >
                                </div>
                              </div>
                             <div class="form-group">
                                 
                                     </div>
                                  <?php
                                          set_time_limit(0);
                                       // include_once 'connect.php';
                                        $length = 6;
                                        $result = '2547';
                                        if (isset($_GET['generate'])) {

                                          if (isset($_GET["d1"])) { $quantity  = $_GET["d1"]; } else { $quantity=0; }; 
                                          if (isset($_GET["d2"])) { $nature  = $_GET["d2"]; } else { $nature=0; }; 
                                          if (isset($_GET["d3"])) { $tag  = $_GET["d3"]; } else { $tag="a"; }; 
                                          
                                          if ($tag=="a" || $quantity==0||$nature==0 ) {
                                            ?>
                                            <div class="alert alert-danger" role="alert">Hapa ni Ngoro. Enter all fields PLEASE</div>
                                            <?php
                                             //echo $tag."#".$quantity." #".$nature;
                                          }
                                          else{
                                                                                       
                                             lets_generate($quantity,$nature,$tag,$length,$result);
                                          }

                                        }
                                        else{
                                         ?> 
                                          <div class="alert alert-info" role="alert">Press the Button to generate random numbers</div>
                                          <?php
                                        }

                                        function lets_generate($quantity,$nature,$tag,$length,$result){

                                          for($i=1; $i<=$quantity; $i++){
                                           randomNumbers($length,$nature,$result,$tag); //calling the method to generate the last 6 numbers
                                            }
                                             ?> 
                                          <div class="alert alert-success" role="alert"> <span class="badge"><?php $quantity?></span> Numbers Generated</div>
                                          <?php
                                          }


                                        function randomNumbers($length,$nature,$result,$tag) {
                                            
                                            $result .= $nature;

                                            for($i = 0; $i < $length; $i++) {
                                                $result .= mt_rand(0, 9);
                                            
                                            }

                                             insertdb($result,$tag);
                                        }

                                        function insertdb($result,$tag){
                                         global $dbh;
                                         $data;
                                         $tarehe = date("Y-m-d");
                                         $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                                         $sql=$dbh->prepare("INSERT INTO tbl_generated (gen_number,gen_tag,gen_date) VALUES (:numbers,:tag,:tarehe)");
                                         $sql->bindParam(":numbers", $result);
                                         $sql->bindParam(":tag", $tag);
                                         $sql->bindParam(":tarehe",$tarehe);
                                         try {
                                          $data = $sql->execute();
                                         } catch (PDOException $e) {
                                          echo $e->getMessage();
                                         }
                                         if ($data) {
                                         
                                         }
                                         else{
                                          ?>
                                            <div class="alert alert-danger" role="alert">There was an error Submitting NUmbers to database..</div>
                                            <?php
                                         }

                                        }
        ?>


                           
                            </form>
                            
                         </div>
                    </div>
                  
                </div> 
             

         

             <div class="col-lg-4">
              <h1 class="page-header">Stats</h1>
                 <div class="panel panel-default">
                    <div class="panel-heading">History of Generated Numbers so far</div>
                   <div class="panel-body">
             <?php 
              global $dbh;
              $data ='';
              $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
              $sql = $dbh->prepare("SELECT  count(*) AS Hesabu, gen_date, gen_tag FROM tbl_generated Group by gen_tag  ORDER BY gen_date DESC");
              
              try {
                  $sql->execute();
              } catch(PDOException $e) {
                  echo $e->getMessage();
              }
              $data = $sql->fetchAll(PDO::FETCH_ASSOC);
                  if ($data) {
                  $ret = '<div>';
                  $ret .= '<table class="table table-hover"><thead>';
                  $ret .= '<tr><th>Date</th><th>Tag </th><th>No Generated</th></tr>';
                  $ret .= '</thead><tbody>';
                  foreach($data as $row){
                         $stats = $row['Hesabu'];
                         $tt = $row['gen_tag'];
                         $datee = $row['gen_date'];                         
                         $ret .= '<tr><td>' . $datee . '</td><td>'.$tt.'</td><td>'.$stats.'</td></tr>';
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
