<?php
    include_once('../modules/DBConnectionModule.php');
    include_once('../modules/ProductModule.php');

    $productModule = new ProductModule();
    if($productModule->productOrderTransactionPaid($_POST)){//Paid Transaction
        header('Content-Type: application/json');
        echo json_encode(["status" => 200, "content" => "Product order marked as PAID."]);
    }
    else{
        header('Content-Type: application/json');
        echo json_encode(["status" => 404, "content" => "Server error."]);
    }
?>