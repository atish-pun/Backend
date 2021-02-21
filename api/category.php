<?php
    include_once('../modules/DBConnectionModule.php');
    include_once('../modules/ProductModule.php');

    $productModule = new ProductModule();
    header('Content-Type: application/json');
    echo json_encode($productModule->API_categoryScreen());
?>