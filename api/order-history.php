<?php
    include_once('../modules/DBConnectionModule.php');
    include_once('../modules/ProductModule.php');

    $productModule = new ProductModule();
    
    if(isset($_REQUEST['uid'])){
        header('Content-Type: application/json');
        echo json_encode($productModule->API_hostoryList($_REQUEST));
    }
    else{
        header('Content-Type: application/json');
        echo json_encode(["status" => 400, "content" => "Err"]);
    }
?>