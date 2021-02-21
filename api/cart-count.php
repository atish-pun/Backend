<?php
    include_once('../modules/DBConnectionModule.php');
    include_once('../modules/ProductModule.php');

    if(isset($_REQUEST['token'])){
        $productModule = new ProductModule();
        header('Content-Type: application/json');
        echo json_encode($productModule->API_cartCount($_REQUEST));
    }
    else {
        header('Content-Type: application/json');
        echo json_encode(["status" => 400, "content" => "Err"]);
    }
?>