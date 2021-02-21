<?php
    include_once('../modules/DBConnectionModule.php');
    include_once('../modules/UserModule.php');

    $userModule = new UserModule();
    echo json_encode($userModule->userList());
?>