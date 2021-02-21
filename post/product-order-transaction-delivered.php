<?php
    include_once('../modules/DBConnectionModule.php');
    include_once('../modules/ProductModule.php');

    $productModule = new ProductModule();
    if($productModule->productOrderTransaction(4, $_POST)){//Delivered
        header('Content-Type: application/json');
        echo json_encode(["status" => 200, "content" => "Product order info updated to delivered."]);
    }
    else{
        header('Content-Type: application/json');
        echo json_encode(["status" => 404, "content" => "Server error."]);
    }
?>