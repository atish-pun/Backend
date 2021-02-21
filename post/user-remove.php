<?php
    include_once('../modules/DBConnectionModule.php');
    include_once('../modules/UserModule.php');

    $userModule = new UserModule();
    if($userModule->removeUser($_POST)){
        header('Content-Type: application/json');
        echo json_encode(["status" => 200, "content" => "User removed."]);
    }
    else{
        header('Content-Type: application/json');
        echo json_encode(["status" => 404, "content" => "Server error."]);
    }
?>