<?php
    include_once('../modules/DBConnectionModule.php');
    include_once('../modules/ProductModule.php');

    $productModule = new ProductModule();
    
    if(isset($_REQUEST['pid'])){ 
        $pid = $_REQUEST['pid']; 
        header('Content-Type: application/json');
        echo json_encode($productModule->API_productInfo($pid)); 
    }
    else{
        header('Content-Type: application/json');
        echo json_encode(["status" => 400, "content" => "Err"]);
    }
?>