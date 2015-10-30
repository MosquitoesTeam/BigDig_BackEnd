<?php session_start();
if (!empty($_SESSION['id'])) {
    header("Location:users");
}
/*
 * Following code will list all the products
 */

// array for JSON response
$response = array();


// include db connect class
require_once __DIR__ . '/db_connect.php';
require_once __DIR__ . '/functions.php';

// connecting to db
$db = new DB_CONNECT();

// get all products from products table

 ?>

<!DOCTYPE html>
<html lang="en">


<!-- Mirrored from startbootstrap.com/templates/sb-admin-2/login.html by HTTrack Website Copier/3.x [XR&CO'2013], Fri, 17 Oct 2014 14:32:11 GMT -->
<!-- Added by HTTrack --><meta http-equiv="content-type" content="text/html;charset=utf-8" /><!-- /Added by HTTrack -->
<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>SB Admin 2 - Bootstrap Admin Theme</title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="css/plugins/metisMenu/metisMenu.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/sb-admin-2.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="font-awesome-4.1.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">

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
            <div class="col-md-6 col-md-offset-3">
                <div class="login-panel panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Please Sign In <?php echo decrypt("XdPOuTFL9muZi8gvEY13qN/U4QkxDK17"); ?></h3>
                    </div>
                    <?php 

                            $response = array();
                            

                            if (!empty($_POST) ) {
                                
                            
                            if (!empty($_POST['email']) && !empty($_POST['password'])) {

                                $email=addslashes($_POST['email']);
                                $password=encrypt($_POST['password']);
                                
                                $result = mysql_query("SELECT * FROM bigdig_users where email='$email' and password='$password'") or die(mysql_error());

                                
                                if (mysql_num_rows($result) > 0) {
                                    $_SESSION['adm']=$result['id'];
                                    $response["success"] = 1;
                                    $response["message"] = "access success.";
                                    $result = mysql_fetch_array($result);
                                    $_SESSION['id']=$result['id'];
                                }else{
                                    $response["success"] = 2;
                                    $response["message"] = "user does not exist.";
                                }
                                
                                }else{

                                    $response["success"] = 2;
                                    $response["message"] = "all fields are mandatory.";

                                }
                            }
                         ?>
                    <div class="panel-body">

                                        <?php 
                                
                                if ($response["success"]==2) { ?>
                                    <div class="alert alert-danger alert-dismissable">
                                    <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                                    <?php echo $response["message"]; ?>
                                    </div>
                                    
                                    
                                <?php }
                                elseif($response["success"]==1){ ?>
                                    <div class="alert alert-success alert-dismissable">
                                    <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                                    <?php echo $response["message"]; ?>
                                    </div>
                                    <script type="text/javascript">
                                        // similar behavior as clicking on a link
                                        setTimeout("location.href = 'users';",1000);
                                    </script>
                                <?php } ?>

                            
                        <form role="form" method="POST">

                            <fieldset>
                                <div class="form-group">
                                    <input class="form-control" placeholder="E-mail" name="email" type="email" autofocus>
                                </div>
                                <div class="form-group">
                                    <input class="form-control" placeholder="Password" name="password" type="password" value="">
                                </div>

                                <input type="hidden" name="token" id="token" value="<?php echo generer_token('login');?>"/>
                                <!-- Change this to a button or input when using this as a form -->
                                <input type="submit"  name="Login" value="Login" class="btn btn-lg btn-success btn-block">

                            </fieldset>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- jQuery Version 1.11.0 -->
    <script src="js/jquery-1.11.0.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="js/plugins/metisMenu/metisMenu.min.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="js/sb-admin-2.js"></script>

</body>


</html>
