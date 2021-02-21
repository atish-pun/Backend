<?php
    ob_start(); 
    session_start(); 

    include_once('modules/GlobalVariables.php');
    include_once('modules/DBConnectionModule.php');
    include_once('modules/UserModule.php');
    UserModule::logout();
?>