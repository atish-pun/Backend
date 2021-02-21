<?php 
    ob_start(); 
    session_start();
    include_once('modules/GlobalVariables.php');
    include_once('modules/DBConnectionModule.php');
    include_once('modules/UserModule.php');
    if(!UserModule::CheckUser_CLIENT()){ header('location:login.php'); }
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
        <style>.dataTable td.dataTables_empty{ text-align: left !important; }</style>
    </head>
    <body class="vertical-layout vertical-menu 2-columns menu-expanded fixed-navbar" data-open="click" data-menu="vertical-menu" data-col="2-columns">

        <!-- Navigation -->
        <?php include('includes/partials/navbar.php'); ?>

        <!-- Sidebar -->
        <?php include('includes/partials/sidebar.php'); ?>

        <div class="content app-content">
            <div class="row">
                <div class="col pl-1 pr-1 pt-2 pb-2">
                    <?php
                        $dashboarPath = "includes/templates/dashboard.php";
                        if(isset($_REQUEST['page'])) {
                            $file_path = 'includes/templates/'.$_REQUEST['page'].'.php';
                            if(file_exists($file_path)) include($file_path);
                            else include($dashboarPath);
                        }
                        else include($dashboarPath);
                    ?>
                </div>
            </div>
        </div>

        <!-- Footer -->
        <?php include('includes/partials/footer.php'); ?>
        <script src="theme-assets/js/core/app-menu-lite.js" type="text/javascript"></script>
        <script src="theme-assets/js/core/app-lite.js" type="text/javascript"></script>
        <script src="assets/js/scripts.js" type="text/javascript"></script>
    </body>
</html>