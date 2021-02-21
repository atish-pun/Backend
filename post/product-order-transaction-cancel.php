<?php
    include_once('../modules/DBConnectionModule.php');
    include_once('../modules/ProductModule.php');

    $productModule = new ProductModule();
    if($productModule->productOrderTransaction(0, $_POST)){//Canceled
        header('Content-Type: application/json');
        echo json_encode(["status" => 200, "content" => "Product order info updated to canceled."]);
    }
    else{
        header('Content-Type: application/json');
        echo json_encode(["status" => 404, "content" => "Server error."]);
    }
?>