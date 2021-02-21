<?php
    include_once('../modules/DBConnectionModule.php');
    include_once('../modules/ProductModule.php');

    $productModule = new ProductModule();
    if($productModule->deActivatedTopSaleList($_POST)){
        header('Content-Type: application/json');
        echo json_encode(["status" => 200, "content" => "Item Deactivate."]);
    }
    else{
        header('Content-Type: application/json');
        echo json_encode(["status" => 404, "content" => "Server error."]);
    }
?>