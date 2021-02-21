<?php 
    ob_start(); 
    session_start(); 
?>
<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
        <title>Grocery Store - Dashboard</title>
        <link rel="apple-touch-icon" href="assets/custom-imgs/logo.png">
        <link rel="shortcut icon" type="image/x-icon" href="assets/custom-imgs/logo.png">
        <link href="https://fonts.googleapis.com/css?family=Muli:300,300i,400,400i,600,600i,700,700i%7CComfortaa:300,400,700" rel="stylesheet">
        <link href="https://maxcdn.icons8.com/fonts/line-awesome/1.1/css/line-awesome.min.css" rel="stylesheet">
        <link rel="stylesheet" type="text/css" href="theme-assets/css/vendors.css">
        <link rel="stylesheet" type="text/css" href="theme-assets/css/app-lite.css">
        <link rel="stylesheet" type="text/css" href="theme-assets/css/core/menu/menu-types/vertical-menu.css">
        <link rel="stylesheet" type="text/css" href="theme-assets/css/core/colors/palette-gradient.css">
        <link rel="stylesheet" type="text/css" href="theme-assets/css/pages/dashboard-ecommerce.css">
        <link rel="stylesheet" type="text/css" href="assets/css/main.css">
        <script src="theme-assets/vendors/js/vendors.min.js" type="text/javascript"></script>
        <script src="assets/js/sweetalert.min.js" type="text/javascript"></script>
        <script src="assets/js/jquery.loading.min.js" type="text/javascript"></script>
    </head>
    <body>
        <div class="content p-5">
            <div class="row justify-content-center">
                <div class="col-xl-4 col-lg-6 col-md-8 col-sm-12 pl-1 pr-1 pt-2 pb-2 justify-content-center">
                    <div class="card">
                        <div class="card-body">
                            <?php
                                include_once('modules/GlobalVariables.php');
                                include_once('modules/DBConnectionModule.php');
                                include_once('modules/UserModule.php');
                            
                                if(UserModule::CheckUser_CLIENT()){ header('location:myprofile.php'); }
                                if(isset($_REQUEST['submit'])){
                                    $email = $_REQUEST['email'];
                                    $pass = $_REQUEST['pass'];
                                    $user = new UserModule();
                                    if(!$user->login($email, $pass)){
                                        echo '<div class="alert alert-danger mb-2" role="alert">Email &amp; Password doesnot match.</div>';
                                    }
                                }
                            ?>
                            <form id="loginform" method="POST" action="">
                                <div align="center"><img src="assets/custom-imgs/logo.png" width="128px" height="128"/></div>
                                <h2 class="mt-3" style="text-align:center;color:gray;">LOGIN</h2>
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="email" class="form-control field" id="email" name="email">
                                </div>
                                <div class="form-group">
                                    <label for="pass">Password</label>
                                    <input type="password" class="form-control field" id="pass" name="pass">
                                </div>
                                <div class="form-group">
                                    <button type="submit" value="submit" name="submit" class="btn btn-primary">Login</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>