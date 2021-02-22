<?php
    include_once('../modules/DBConnectionModule.php');
    include_once('../modules/ProductModule.php');

    if(isset($_REQUEST['pid']) 
        && isset($_REQUEST['otoken']) 
        && isset($_REQUEST['uid'])){
        $productModule = new ProductModule();
        header('Content-Type: application/json');
        echo json_encode($productModule->API_addToCart($_REQUEST));
    }
    else{ 
        header('Content-Type: application/json');
        echo json_encode(["status" => 400, "content" => "Err"]);
    }
?>