<?php
    include_once('../modules/DBConnectionModule.php');
    include_once('../modules/ProductModule.php');

    $productModule = new ProductModule();
    if($productModule->productOrderTransaction(5, $_POST)){//Closed Transaction
        header('Content-Type: application/json');
        echo json_encode(["status" => 200, "content" => "Product order info updated to transaction."]);
    }
    else{
        header('Content-Type: application/json');
        echo json_encode(["status" => 404, "content" => "Server error."]);
    }
?>