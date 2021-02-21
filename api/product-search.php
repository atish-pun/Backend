<?php
    include_once('../modules/DBConnectionModule.php');
    include_once('../modules/ProductModule.php');

    $productModule = new ProductModule();
    
    if(isset($_REQUEST['search'])){ 
        $search = $_REQUEST['search'];
        header('Content-Type: application/json');
        echo json_encode($productModule->API_productSearch($search)); 
    }
    else {
        header('Content-Type: application/json');
        echo json_encode(["status" => 400, "content" => "Err"]);
    }
?>