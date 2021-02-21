<?php
    include_once('../modules/DBConnectionModule.php');
    include_once('../modules/AuthModule.php');
    include_once('../modules/UserModule.php');

    $userModule = new UserModule();
    header('Content-Type: application/json');
    echo json_encode($userModule->API_login($_REQUEST));
?>