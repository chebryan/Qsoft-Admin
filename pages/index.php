<?php


      require('connect.php');
      if (isset($_POST['email']) && isset($_POST['password']))  {
            $username = $_POST['email'];
            $password = $_POST['password'];
            $password_hash = md5($password);
             if (!empty($username)&& !empty($password))  {
                global $dbh;
                $data='';
                $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $sql ="SELECT * FROM tbl_users WHERE tbl_username=:username AND tbl_password=:password";
                $stmt= $dbh->prepare($sql);
                $stmt->bindParam(":username", $username);
                $stmt->bindParam(":password", $password_hash);
                try {
                    $stmt->execute();
                } catch (PDOException $e) {
                    echo $e->getMessage();
                }
              $data=$stmt->fetchAll();
              if ($data) {
              header('Location:home.php');
               session_start();
               $_SESSION['login_user']=$username; 
             }
           else {
            ?>
             <div class="container">
            <div class="alert alert-danger">
               echo "Username and Password Combination not correct"; 
               </div>
               </div>
               <?php
           }
             }else{
                echo "the fields for username and password empty ";
             }
      }
 
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

    <!-- Custom Fonts -->
    <link href="../bower_components/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->


</head>

<body>

    <div class="container">

        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <div class="login-panel panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Please Sign In</h3>
                    </div>
                    <div class="panel-body">
                        <form role="form" action="index.php" method="POST">
                            <fieldset>
                                <div class="form-group">
                                    <input class="form-control" placeholder="E-mail" name="email" type="email" autofocus>
                                </div>
                                <div class="form-group">
                                    <input class="form-control" placeholder="Password" name="password" type="password" value="">
                                </div>
                                <div class="checkbox">
                                    <label>
                                        <input name="remember" type="checkbox" value="Remember Me">Remember Me
                                    </label>
                                </div>
                                <!-- Change this to a button or input when using this as a form -->
                                <button type="submit" class="btn btn-lg btn-success btn-block" name="submit">Log In</button>
                            </fieldset>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- jQuery -->
    <script src="../bower_components/jquery/dist/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="../bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="../bower_components/metisMenu/dist/metisMenu.min.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="../dist/js/sb-admin-2.js"></script>

<script>
$(document).ready(function(){   
    $(".submit").click(function()
    {
        var uname = $("#myusername").val();
        var pwd =$("#mypassword").val();
        
        if(pwd=='' || uname == ''){ $(".error_message").text('Dude you have to put in everything').fadeIn(90000);}
    });
});
</script>

</body>

</html>
