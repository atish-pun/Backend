<?php
    include_once('../modules/DBConnectionModule.php');
    include_once('../modules/ProductModule.php');

    if(isset($_REQUEST['cid'])){ 
        $cid = $_REQUEST['cid']; 
        $productModule = new ProductModule();
        header('Content-Type: application/json');
        echo json_encode($productModule->API_categoryProduct($cid));
    }
    else {
        header('Content-Type: application/json');
        echo json_encode(["status" => 400, "content" => "Err"]);
    }
?>