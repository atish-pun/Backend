<?php
class ProductModule extends DBconnectionModule{
    function __construct(){
        parent::__construct();
    }

    //Product Category
    function saveProductCategory($data, $image){
        if($image != "") $statement = $this->connection->prepare("insert into product_category (`name`, `image_path`) values (?, ?)");
        else $statement = $this->connection->prepare("insert into product_category (`name`) values (?)");
        
        if($statement){
            if($image != ""){
                $statement->bind_param("ss", $pname, $image); $pname = $data['productcategoryname']; $image = $image;
            }
            else{
                $statement->bind_param("s", $pname); $pname = $data['productcategoryname'];
            }
            $statement->execute();
            return true;
        }
        else{
            return false;
        }
    }

    function saveEditProductCategory($data, $image){
        if($image != "") $statement = $this->connection->prepare("update product_category set name=?,image_path=? where id=?");
        else $statement = $this->connection->prepare("update product_category set name=? where id=?");
        if($statement){
            if($image != ""){
                $statement->bind_param("sss", $pname, $image, $id); $pname = $data['productcategoryname']; $image = $image; $id = $data["edit"];
            }
            else{
                $statement->bind_param("ss", $pname, $id); $pname = $data['productcategoryname']; $id = $data["edit"];
            }
            $statement->execute();
            return true;
        }
        else{
            return false;
        }
    }

    function productCategoryInfo($id){
        $statement = $this->connection->prepare("select id, name from `product_category` where id=?");
        if($statement){
            $statement->bind_param("s", $id);
            if($statement->execute()){
                $statement->store_result();
                $statement->bind_result($id, $name);
                $statement->fetch();
                if($statement->num_rows > 0) return ['id' => $id, "name" => $name];
                else return false;
            }
            else return false;
        }
        else return false;
    }

    function removeProductCategory($data){
        $id = $data["id"];
        $statement = $this->connection->prepare("delete from product_category where id=?");
        if($statement){
            $statement->bind_param("i", $id);
            return $statement->execute();
        }
        else{
            return false;
        }
    }

    function listProductCategory(){
        $datalist = [ "data" => [] ];
        $statement = $this->connection->prepare("SELECT id, name, image_path, created_at FROM `product_category`");
        if($statement){
            $statement->execute();
            $statement->bind_result($id, $name, $image_path, $created_at);
            $sn = 0;
            while($statement->fetch()){
                $sn++;
                $edit = "<a href='?page=product-category-edit&pid=$id'>Edit</a> &nbsp; | &nbsp;";
                if($image_path != "") $image = "<a target='_blank' href='images/".$image_path."'>View Image</a>";
                else $image = "";
                
                $remove = "<a class='remove' data-id='".$id."' href='#'>Remove</a>";
                $action = $edit.$remove;
                $datalist["data"][] = [
                    "sn" => ($sn),
                    "cn" => $name,
                    "ip" => $image,
                    "ca" => $created_at,
                    "action" => $action
                ];
            }
        }
        return $datalist;
    }

    function listProductCategoryOption(){
        $catlist = [];
        $statement = $this->connection->prepare("SELECT `id`, `name` FROM `product_category`");
        if($statement){
            $statement->execute();
            $statement->bind_result($id, $name);
            while($statement->fetch()){
                $catlist []= ["id" => $id, "name" => $name];
            }
        }
        return $catlist;
    }

    //Product
    function saveProduct($data, $img){
        if($img != "") $statement = $this->connection->prepare("insert into `products` (category_id, name, image_path, price, unit, details) values (?, ?, ?, ?, ?, ?)");
        else $statement = $this->connection->prepare("insert into `products` (category_id, name, price, unit, details) values (?, ?, ?, ?, ?)");

        if($statement){
            if($img !=""){
                $statement->bind_param("ssssss", $category_id, $pname, $image, $price, $unit, $details);
                $category_id = $data["category_id"];
                $pname = $data["productname"];
                $image = $img;
                $price = $data["price"];
                $unit = $data["unit"];
                $details = $data["details"];
            }
            else{
                $statement->bind_param("sssss", $category_id, $pname, $price, $unit, $details);
                $category_id = $data["category_id"];
                $pname = $data["productname"];
                $price = $data["price"];
                $unit = $data["unit"];
                $details = $data["details"];
            }

            $statement->execute();
            return true;
        }
        else{
            return false;
        }
    }

    function saveEditProduct($data, $img){
        if($img != "") $statement = $this->connection->prepare("update products set category_id=?, name=?, price=?, unit=?, image_path=?, details=? where id=?");
        else $statement = $this->connection->prepare("update products set category_id=?, name=?, price=?, unit=?, details=? where id=?");
        if($statement){
            if($img != ""){
                $statement->bind_param("sssssss", $category_id, $pname, $price, $unit, $image, $details, $id);
                $category_id = $data["category_id"];
                $pname = $data["productname"];
                $image = $img;
                $price = $data["price"];
                $unit = $data["unit"];
                $details = $data["details"];
                $id = $data["edit"];
            }
            else{
                $statement->bind_param("ssssss", $category_id, $pname, $price, $unit, $details, $id);
                $category_id = $data["category_id"];
                $pname = $data["productname"];
                $price = $data["price"];
                $unit = $data["unit"];
                $details = $data["details"];
                $id = $data["edit"];
            }
            $statement->execute();
            return true;
        }
        else{
            return false;
        }
    }

    function productInfo($id){
        $statement = $this->connection->prepare("select id, category_id, name, price, unit, image_path, details from `products` where id=?");
        if($statement){
            $statement->bind_param("s", $id);
            if($statement->execute()){
                $statement->store_result();
                $statement->bind_result($id, $category_id, $name, $price, $unit, $image_path, $details);
                $statement->fetch();
                if($statement->num_rows > 0) return ["id" => $id, "category_id" => $category_id, "name" => $name, "price" => $price, "unit" => $unit, "image_path" => $image_path, "details" => $details];
                else return false;
            }
            else return false;
        }
        else return false;
    }

    function removeProduct($data){
        $id = $data["id"];
        $statement = $this->connection->prepare("delete from products where id=?");
        if($statement){
            $statement->bind_param("i", $id);
            return $statement->execute();
        }
        else{
            return false;
        }
    }

    function listProduct(){
        $datalist = [ "data" => [] ];
        $qry = "select products.id as pid, product_category.name as pc_name, products.name as pname, products.image_path as p_ipath, price, unit, products.created_at as p_cat from `products` left join `product_category` on products.category_id=product_category.id";
        $statement = $this->connection->prepare($qry);
        if($statement){
            $statement->execute();
            $statement->bind_result($pid, $pc_name, $pname, $p_ipath, $price, $unit, $p_cat);
            $sn = 0;
            while($statement->fetch()){
                $sn++;
                $edit = "<a href='?page=product-edit&pid=$pid'>Edit</a> &nbsp; | &nbsp;";
                if($p_ipath != "") $image = "<a target='_blank' href='images/".$p_ipath."'>View Image</a>";
                else $image = "";
                $remove = "<a class='remove' data-id='".$pid."' href='#'>Remove</a>";
                $action = $edit.$remove;

                $datalist["data"][] = [
                    "sn" => ($sn),
                    "pc_name" => $pc_name,
                    "pname" => $pname,
                    "p_ipath" => $image,
                    "price" => $price,
                    "unit" => $unit,
                    "p_cat" => $p_cat,
                    "action" => $action
                ];
            }
        }
        return $datalist;
    }

    //Top Sale List
    function topSaleList(){
        $datalist = [ "data" => [] ];
        $qry = "select products.id as pid, product_category.name as pc_name, products.name as pname, products.top_sale from `products` left join `product_category` on products.category_id=product_category.id";
        $statement = $this->connection->prepare($qry);
        if($statement){
            $statement->execute();
            $statement->bind_result($pid, $pc_name, $pname, $top_sale);
            $sn = 0;
            while($statement->fetch()){
                $sn++;
                $active = "<a class='activate' data-id='$pid' href='#'>Active</a>";
                $deactive = "<a class='deactivate' data-id='$pid' href='#'>Deactive</a>";
                $action = ($top_sale == 1)?$deactive:$active;
                $topsalestat = ($top_sale==1)?"<span style='color:green;'>Top Sale Active</span>":"<span style='color:red;'>Deactive</span>";
                $datalist["data"][] = [
                    "sn" => ($sn),
                    "pc_name" => $pc_name,
                    "pname" => $pname,
                    "topsalestat" => $topsalestat,
                    "action" => $action
                ];
            }
        }
        return $datalist;
    }

    function activatedTopSaleList($data){
        $id = $data["id"];
        $statement = $this->connection->prepare("update products set top_sale=1 where id=?");
        if($statement){ $statement->bind_param("i", $id); return $statement->execute(); }
        else return false;
    }

    function deActivatedTopSaleList($data){
        $id = $data["id"];
        $statement = $this->connection->prepare("update products set top_sale=0 where id=?");
        if($statement){ $statement->bind_param("i", $id); return $statement->execute(); }
        else return false;
    }

    //Hot Sale List
    function hotSaleList(){
        $datalist = [ "data" => [] ];
        $qry = "select products.id as pid, product_category.name as pc_name, products.name as pname, products.hot_sale from `products` left join `product_category` on products.category_id=product_category.id";
        $statement = $this->connection->prepare($qry);
        if($statement){
            $statement->execute();
            $statement->bind_result($pid, $pc_name, $pname, $hot_sale);
            $sn = 0;
            while($statement->fetch()){
                $sn++;
                $active = "<a class='activate' data-id='$pid' href='#'>Active</a>";
                $deactive = "<a class='deactivate' data-id='$pid' href='#'>Deactive</a>";
                $action = ($hot_sale == 1)?$deactive:$active;
                $hotsalestat = ($hot_sale==1)?"<span style='color:green;'>Hot Sale Active</span>":"<span style='color:red;'>Deactive</span>";
                $datalist["data"][] = [
                    "sn" => ($sn),
                    "pc_name" => $pc_name,
                    "pname" => $pname,
                    "hotsalestat" => $hotsalestat,
                    "action" => $action
                ];
            }
        }
        return $datalist;
    }

    function activatedHotSaleList($data){
        $id = $data["id"];
        $statement = $this->connection->prepare("update products set hot_sale=1 where id=?");
        if($statement){ $statement->bind_param("i", $id); return $statement->execute(); }
        else return false;
    }

    function deActivatedHotSaleList($data){
        $id = $data["id"];
        $statement = $this->connection->prepare("update products set hot_sale=0 where id=?");
        if($statement){ $statement->bind_param("i", $id); return $statement->execute(); }
        else return false;
    }

    //Home Screen Slide List
    function homeScreenSlideList(){
        $datalist = [ "data" => [] ];
        $qry = "select products.id as pid, product_category.name as pc_name, products.name as pname, products.image_path, products.home_screen_slide, products.slide_image_path from `products` left join `product_category` on products.category_id=product_category.id";
        $statement = $this->connection->prepare($qry);
        if($statement){
            $statement->execute();
            $statement->bind_result($pid, $pc_name, $pname, $image_path, $home_screen_slide, $slide_image_path);
            $sn = 0;
            while($statement->fetch()){
                $sn++;
                $edit = "<a href='?page=home-screen-slide-edit&edit=$pid'>Edit</a>";
                $home_screen_slide_stat = ($home_screen_slide==1)?"<span style='color:green;'>Slide Active</span>":"<span style='color:red;'>Deactive</span>";
                $image = ($slide_image_path!=null)?"<a href='images/$slide_image_path' target='_blank'>View Image</a>":"";
                $pimage = ($image_path!=null)?"<a href='images/$image_path' target='_blank'>View Image</a>":"";
                $datalist["data"][] = [
                    "sn" => ($sn),
                    "pc_name" => $pc_name,
                    "pname" => $pname,
                    "pimage" => $pimage,
                    "home_screen_slide_stat" => $home_screen_slide_stat,
                    "image" => $image,
                    "action" => $edit
                ];
            }
        }
        return $datalist;
    }

    function homeScreenSlideInfo($id){
        $statement = $this->connection->prepare("select id, name, home_screen_slide, slide_image_path from `products` where id=?");
        if($statement){
            $statement->bind_param("s", $id);
            if($statement->execute()){
                $statement->store_result();
                $statement->bind_result($id, $name, $home_screen_slide, $slide_image_path);
                $statement->fetch();
                if($statement->num_rows > 0) return ["id" => $id, "name" => $name, "home_screen_slide" => $home_screen_slide, "slide_image_path" => $slide_image_path];
                else return false;
            }
            else return false;
        }
        else return false;
    }

    function homeScreenSlideUpdate($data, $img){
        if($img != "") $statement = $this->connection->prepare("update products set home_screen_slide=?, slide_image_path=? where id=?");
        else $statement = $this->connection->prepare("update products set home_screen_slide=? where id=?");
        if($statement){
            if($img != ""){
                $statement->bind_param("sss", $home_screen_slide, $image, $id);
                $home_screen_slide = $data["slidestatus"];
                $image = $img;
                $id = $data["edit"];
            }
            else{
                $statement->bind_param("ss", $home_screen_slide, $id);
                $home_screen_slide = $data["slidestatus"];
                $id = $data["edit"];
            }
            if($statement->execute()) return true;
            else return false;
        }
        else{
            return false;
        }
    }

    function activatedHomeScreenSlideList($data){
        $id = $data["id"];
        $statement = $this->connection->prepare("update products set home_screen_slide=1 where id=?");
        if($statement){ $statement->bind_param("i", $id); return $statement->execute(); }
        else return false;
    }

    function deActivatedHomeScreenSlideList($data){
        $id = $data["id"];
        $statement = $this->connection->prepare("update products set home_screen_slide=0 where id=?");
        if($statement){ $statement->bind_param("i", $id); return $statement->execute(); }
        else return false;
    }

    //Product Order Lists
    function productOrderLists(){
        $datalist = [ "data" => [] ];
        $qry = "select product_order.id as order_id, token, product_id, user_id, users.name as fullname, users.email, qty, rate, payment_method, order_status, order_date, approved_date, shipping_date, delivered_date, paid, products.name as pname from product_order left join products on product_order.product_id=products.id left join users on product_order.user_id=users.id where (product_order.order_status>0 and product_order.order_status<5)";
        $statement = $this->connection->prepare($qry);
        if($statement){
            $statement->execute();
            $statement->bind_result($order_id, $token, $product_id, $user_id, $fullname, $email, $qty, $rate, $payment_method, $order_status, $order_date, $approved_date, $shipping_date, $delivered_date, $paid, $pname);
            $sn = 0;
            while($statement->fetch()){
                $sn++;
                
                $order_status_str = ""; 
                if($order_status == 0){ $order_status_str = "Canceled"; } 
                else if($order_status == 1){  $order_status_str = "Ordered"; }
                else if($order_status == 2){  $order_status_str = "Approved"; } 
                else if($order_status == 3){  $order_status_str = "Delivery"; } 
                else if($order_status == 4){  $order_status_str = "Delivered"; }
                
                $trate = ($qty * $rate);
                $total = number_format($trate, 2, '.', ',');
                $paidStatus = ($paid==0)?"UNPAID":"<h4 style='color:#000;'>PAID</h4>";
                
                $approved = "<a class='approved btn btn-secondary btn-sm' data-id='".$order_id."' href='#'><i class='la la-thumbs-o-up'></i> Approved</a> &nbsp;"; if($order_status > 1) $approved = "";
                $shipping = "<a class='shipped btn btn-secondary btn-sm' data-id='".$order_id."' href='#'><i class='la la-send'></i> Shipped</a> &nbsp;"; if($order_status > 2) $shipping = "";
                $delivered = "<a class='delivered btn btn-secondary btn-sm' data-id='".$order_id."' href='#'><i class='la la-truck'></i> Delivered</a> &nbsp;"; if($order_status > 3) $delivered = "";
                $cancled = "<a class='cancel btn btn-danger btn-sm' data-id='".$order_id."' href='#'><i class='la la-remove'></i> Cancel</a> &nbsp;";
                $close = "<a class='closetransaction btn btn-danger btn-sm' data-id='".$order_id."' href='#'><i class='la la-remove'></i> Close Transaction</a>"; if($order_status == 5){ $close = ""; }
                $paidbtn = "<a class='paid btn btn-warning btn-sm' data-id='".$order_id."' href='#' style='color:#000;'><i class='la la-money'></i> Paid</a> &nbsp;"; if($paid==1){ $paidbtn = ""; }

                $action = ($order_status==0)?"":$approved.$shipping.$delivered.$paidbtn.$cancled.$close;
                $datalist["data"][] = [
                    "sn" => ($sn),
                    "id" => $order_id,
                    "token" => $token,
                    "user_id" => $user_id,
                    "fullname" => $fullname.' ('.$email.')',

                    "product_id" => $product_id,
                    "pname" => $pname,
                    "qty" => $qty,
                    "rate" => $rate,
                    "total" => "Rs. ".$total,

                    "payment_method" => $payment_method, //ESEWA, CASH
                    "paid" => $paidStatus,

                    "order_status" => $order_status_str,
                    "order_date" => $order_date,
                    "approved_date" => $approved_date,
                    "shipping_date" => $shipping_date,
                    "delivered_date" => $delivered_date,

                    "action" => $action
                ];
            }
        }
        return $datalist;
    }

    //order_status => 0=Cancel, 1=Order, 2=Approved, 3=Shipping, 4=Delivered, 5=Close
    //payment_method => CASH_ON_DELIVERY, ESEWA
    function productOrderTransaction($status, $data){
        if($status == 2){ $statement = $this->connection->prepare("update product_order set order_status=?, approved_date=? where id=?"); } //Approved
        else if($status == 3){ $statement = $this->connection->prepare("update product_order set order_status=?, shipping_date=? where id=?"); } //Shipping
        else if($status == 4){ $statement = $this->connection->prepare("update product_order set order_status=?, delivered_date=? where id=?"); } //Delivered
        else{ $statement = $this->connection->prepare("update product_order set order_status=? where id=?"); }
        if($statement){
            if($status == 2 || $status == 3 || $status == 4){ $statement->bind_param("sss", $status, $date , $id); $date = date('Y-m-d H:i:s'); }
            else{ $statement->bind_param("ss", $status, $id); }
            $status = $status;
            $id = $data["id"];
            $statement->execute();
            return true;
        }
        else return false;
    }

    function productOrderTransactionPaid($data){
        $statement = $this->connection->prepare("update product_order set paid=1 where id=?");
        if($statement){
            $statement->bind_param("s", $id);
            $id = $data['id'];
            $statement->execute();
            return true;
        }
        else return false;
    }

    //Product Report
    function productReport(){
        $datalist = [ "data" => [], "gtotal" => 0 ];
        $qry = "select product_order.id as order_id, token, product_id, user_id, users.name as fullname, users.email, qty, rate, payment_method, order_status, order_date, approved_date, shipping_date, delivered_date, paid, products.name as pname from product_order left join products on product_order.product_id=products.id left join users on product_order.user_id=users.id where product_order.paid=1";
        $statement = $this->connection->prepare($qry);
        if($statement){
            $statement->execute();
            $statement->bind_result($order_id, $token, $product_id, $user_id, $fullname, $email, $qty, $rate, $payment_method, $order_status, $order_date, $approved_date, $shipping_date, $delivered_date, $paid, $pname);
            $sn = 0;
            $gtotal = 0;
            while($statement->fetch()){
                $sn++;

                $trate = ($qty * $rate);
                $total = number_format($trate, 2, '.', ',');

                $order_status_str = ""; 
                if($order_status == 0){ $order_status_str = "Canceled"; } 
                else if($order_status == 1){  $order_status_str = "Ordered"; }
                else if($order_status == 2){  $order_status_str = "Approved"; } 
                else if($order_status == 3){  $order_status_str = "<span style='color:green;'>Delivery</span>"; } 
                else if($order_status == 4){  $order_status_str = "<span style='color:green;'>Delivered</span>"; }
                
                $datalist["data"][] = [
                    "sn" => ($sn),
                    "fullname" => $fullname.' ('.$email.')',

                    "pname" => $pname,
                    "qty" => $qty,
                    "rate" => $rate,
                    "total" => "<b>Rs. ".$total."</b>",

                    "ostatus" => $order_status_str,
                    "payment_method" => $payment_method, //ESEWA, CASH_ON_DELIVERY
                    "paid" => $paid,
                ];
                $gtotal += $trate;
            }
            $datalist["gtotal"] = "Rs. ".number_format($gtotal, 2, '.', ',').'/-';
        }
        return $datalist;
    }

    /*****************
    *****REST API*****
    ******************/
    function API_homeScreen(){
        $data = [ 
            "home_screen_slide" => ["status" => 400, "content" => []],
            "top_sale" => ["status" => 400, "content" => []],
            "hot_sale" => ["status" => 400, "content" => []],
            "latest_product" => ["status" => 400, "content" => []],
            "cart_count" => ["status" => 400, "content" => 0]
        ];

        //Home screen slide
        {
            $home_screen_slide_qry = "select `id`, `name`, `slide_image_path` from `products` where `home_screen_slide`=1";
            $home_screen_slide_statement = $this->connection->prepare($home_screen_slide_qry);
            if($home_screen_slide_statement){
                $isFoundHSS = false;
                $home_screen_slide_statement->execute();
                $home_screen_slide_statement->bind_result($id, $name, $slide_image_path);
                while($home_screen_slide_statement->fetch()){
                    $data["home_screen_slide"]["content"][] = ["id" => $id, "name" => $name, "image_path"=> $slide_image_path];
                    $isFoundHSS = true;
                }
                if($isFoundHSS) $data["home_screen_slide"]["status"] = 200;
            }
        }
        
        //Top sale
        {
            $top_sale_qry = "select `id`, `name`, `price`, `image_path` from `products` where `top_sale`=1";
            $top_sale_statement = $this->connection->prepare($top_sale_qry);
            if($top_sale_statement){
                $top_sale_statement->execute();
                $top_sale_statement->bind_result($id, $name, $price,$image_path);
                while($top_sale_statement->fetch()){
                    $data["top_sale"]["content"][] = ["id" => $id, "name"=> $name, "price"=> $price, "image_path"=> $image_path];
                    $isFoundTS = true;
                }
                if($isFoundTS) $data["top_sale"]["status"] = 200;
            }
        }

        //Hot sale
        {
            $hot_sale_qry = "select `id`, `name`, `price`, `image_path` from `products` where `hot_sale`=1";
            $hot_sale_statement = $this->connection->prepare($hot_sale_qry);
            if($hot_sale_statement){
                $hot_sale_statement->execute();
                $hot_sale_statement->bind_result($id, $name, $price,$image_path);
                while($hot_sale_statement->fetch()){
                    $data["hot_sale"]["content"][] = ["id" => $id, "name"=> $name, "price"=> $price, "image_path"=> $image_path];
                    $isFoundHS = true;
                }
                if($isFoundHS) $data["hot_sale"]["status"] = 200;
            }
        }

        //Latest Products
        {
            $latest_product_qry = "select `id`, `name`, `price`, `image_path` from `products` order by id desc limit 12";
            $latest_product_statement = $this->connection->prepare($latest_product_qry);
            if($latest_product_statement){
                $latest_product_statement->execute();
                $latest_product_statement->bind_result($id, $name, $price,$image_path);
                while($latest_product_statement->fetch()){
                    $data["latest_product"]["content"][] = ["id" => $id, "name"=> $name, "price"=> $price, "image_path"=> $image_path];
                    $isFoundLS = true;
                }
                if($isFoundLS) $data["latest_product"]["status"] = 200;
            }
        }

        return $data;
    }

    function API_productSearch($search){
        $data = ["status" => 401, "content" => []];
        $search = "%$search%";
        $product_qry = "select `id`, `name`, `price`, `image_path` from `products` where `name` like ? order by `id` desc limit 25";
        $product_statement = $this->connection->prepare($product_qry);
        if($product_statement){
            $isFound = false;
            $product_statement->bind_param("s", $search);
            if($product_statement->execute()){
                $product_statement->bind_result($id, $name, $price, $image_path);
                while($product_statement->fetch()){
                    $data["content"][] = ["id" => $id, "name"=> $name, "price"=> $price, "image_path"=> $image_path];
                    $isFound = true;
                }
            }
            if($isFound) $data["status"] = 200;
        }
        return $data;
    }

    function API_categoryScreen(){
        $data = [ "category" => ["status" => 400, "content" => []] ];
        $category_qry = "select `id`, `name`, `image_path` from `product_category`";
        $category_statement = $this->connection->prepare($category_qry);
        if($category_statement){
            $category_statement->execute();
            $category_statement->bind_result($id, $name, $image_path);
            while($category_statement->fetch()){
                $data["category"]["content"][] = ["id" => $id, "name" => $name, "image_path" => $image_path];
                $isFoundC = true;
            }
            if($isFoundC) $data["category"]["status"] = 200;
        }
        return $data;
    }

    function API_productInfo($id){
        $statement = $this->connection->prepare("select `id`, `category_id`, `name`, `price`, `unit`, `image_path`, `details` from `products` where id=?");
        if($statement){
            $statement->bind_param("s", $id);
            if($statement->execute()){
                $statement->store_result();
                $statement->bind_result($id, $category_id, $name, $price, $unit, $image_path, $details);
                $statement->fetch();
                if($statement->num_rows > 0){
                    $content = ["id" => $id, "category_id" => $category_id, "name" => $name, "price" => $price, "unit" => $unit, "image_path" => $image_path, "details" => $details];
                    return ["status" => 200, "content" => $content];
                }
                else return ["status" => 400, "content" => "Product not found. Error code-0x703"];
            }
            else return ["status" => 400, "content" => "Product not found. Error code-0x702"];
        }
        else return ["status" => 400, "content" => "Product not found. Error code-0x701"];
    }

    function API_categoryProduct($id){
        $data = [ "status" => 400, "content" => []];
        $category_product_qry = "select `id`, `name`, `price`, `image_path` from `products` where `category_id`=? order by `id` desc";
        $category_product_statement = $this->connection->prepare($category_product_qry);
        if($category_product_statement){
            $isFoundCP = false;
            $category_product_statement->bind_param("s", $id);
            if($category_product_statement->execute()){
                $category_product_statement->bind_result($id, $name, $price, $image_path);
                while($category_product_statement->fetch()){
                    $data["content"][] = ["id" => $id, "name"=> $name, "price"=> $price, "image_path"=> $image_path];
                    $isFoundCP = true;
                }
            }
            if($isFoundCP) $data["status"] = 200;
        }
        return $data;
    }

    function API_addToCart($data){
        //Select either item is already exists or not
        $token = $data["otoken"];
        $product_id = $data["pid"];
        $user_id = $data["uid"];
        $select_statement = $this->connection->prepare("select `token` as selecttoken from `product_order` where token=? and product_id=? and user_id=?");
        if($select_statement){
            $select_statement->bind_param("sss", $token, $product_id, $user_id);
            if($select_statement->execute()){
                $select_statement->store_result();
                $select_statement->bind_result($selecttoken);
                $select_statement->fetch();
                if($select_statement->num_rows > 0){
                    //Product already added to cart.
                    return ["status" => 200, "content" => "Product is already added to the cart. You can add quantity in cart section."];
                }
                else{
                    //Update token in user current cart section
                    $current_cart_token_statement = $this->connection->prepare("update users set current_cart_token=? where id=?");
                    if($current_cart_token_statement){
                        $current_cart_token_statement->bind_param("ss", $token, $user_id);
                        $current_cart_token_statement->execute();
                    }

                    //Add to cart if not found
                    $cart_statement = $this->connection->prepare("insert into product_order (token, product_id, user_id, qty, rate) values (?,?,?,?,?)");
                    if($cart_statement){
                        $cart_statement->bind_param("sssss", $token, $product_id, $user_id, $qty, $rate);
                        $qty = $data["qty"];
                        $rate = $data["rate"];
                        if($cart_statement->execute()) return ["status" => 200, "content" => "Product added to cart."];
                        return ["status" => 400, "content" => "Error . Code - 0x901"];
                    }
                    else return ["status" => 400, "content" => "Error . Code - 0x902"];
                }
            }
            else return ["status" => 400, "content" => "Error . Code - 0x910"];
        }
        else return ["status" => 400, "content" => "Error . Code - 0x903"];
    }

    function API_updateQty($data){
        $statement = $this->connection->prepare("update product_order set qty=? where id=? and token=? and user_id=?");
        if($statement){
            $statement->bind_param("ssss", $qty, $id, $token, $user_id);
            $token = $data["otoken"];
            $user_id = $data["uid"];
            $qty = $data["qty"];
            $id = $data["id"];
            if($statement->execute()) return ["status" => 200, "content" => "Product quantity updated."];
            return ["status" => 400, "content" => "Error . Code - 0x1001"];
        }
        else{
            return ["status" => 400, "content" => "Error . Code - 0x1002"];
        }
    }

    function API_removeOnCart($data){
        $statement = $this->connection->prepare("delete from product_order where id=? and token=? and user_id=?");
        if($statement){
            $statement->bind_param("sss", $id, $token, $uid);
            $id = $data["id"];
            $token = $data["otoken"];
            $uid = $data["uid"];
            if($statement->execute()) return ["status" => 200, "content" => "Product removed from cart."];
            return ["status" => 400, "content" => "Error . Code - 0x1101"];
        }
        else{
            return ["status" => 400, "content" => "Error . Code - 0x1102"];
        }
    }

    function API_cartList($data){
        $responseData = ["status" => 400, "content" => []];
        $statement = $this->connection->prepare("select product_order.id, product_order.token, product_order.product_id, product_order.qty, product_order.rate, products.name, products.image_path from product_order inner join products on product_order.product_id=products.id where product_order.token=? and product_order.user_id=? and product_order.order_status=10");
        if($statement){
            $statement->bind_param("ss", $otoken, $uid);
            $otoken = $data["otoken"];
            $uid = $data['uid'];
            if($statement->execute()){
                $statement->bind_result($id, $token, $product_id, $qty, $rate, $name, $image_path);
                $isFound = false;
                while($statement->fetch()){
                    $responseData["content"][] = ["id" => $id, "uid" => $uid, "token" => $token, "product_id" => $product_id, "qty" => $qty, "rate" => $rate, "name" => $name, "image_path" => $image_path];
                    $isFound = true;
                }
                if($isFound) $responseData["status"] = 200;
            }
        }
        return $responseData;
    }

    function API_cartCount($data){
        //Cart Count
        $cart_statement = $this->connection->prepare("select COUNT(token) as cart_count from `product_order` where token=? and order_status=10");
        if($cart_statement){
            $cart_statement->bind_param("s", $token);
            $token = $data["token"];
            if($cart_statement->execute()){
                $cart_statement->bind_result($cart_count);
                $cart_statement->fetch();
                return ["status" => 200, "content" => $cart_count];
            }
            return ["status" => 400, "content" => "Error . Code - 0x1402"];
        }
        return ["status" => 400, "content" => "Error . Code - 0x1401"];
    }

    function API_checkedOut($data){
        //Checked Out
        $payment_method = $data["payment_method"];
        $user_id = $data["uid"];

        if($payment_method == "CASH_ON_DELIVERY"){
            //Remove Current Cart Token From Server
            $current_cart_token_statement = $this->connection->prepare("update users set current_cart_token=null where id=?");
            if($current_cart_token_statement){
                $current_cart_token_statement->bind_param("s", $user_id);
                $current_cart_token_statement->execute();
            }

            //CASH IN DELIVERY
            $statement = $this->connection->prepare("update product_order set `payment_method`=?, `order_date`=?, `order_status`=1 where (`token`=? and `user_id`=? and `order_status`=10)");
            if($statement){
                $statement->bind_param("ssss", $payment_method, $date, $token, $user_id);
                $date = date('Y-m-d H:i:s');
                $token = $data["otoken"];
                
                if($statement->execute()) return ["status" => 200, "content" => "Check out complete. Please check your order status in My Orders."];
                return ["status" => 400, "content" => "Error . Code - 0x1001"];
            }
            else return ["status" => 400, "content" => "Error . Code - 0x1002"];
        }
        else if($payment_method == "ESEWA"){
            //Remove Current Cart Token From Server
            $current_cart_token_statement = $this->connection->prepare("update users set current_cart_token=null where id=?");
            if($current_cart_token_statement){
                $current_cart_token_statement->bind_param("s", $user_id);
                $current_cart_token_statement->execute();
            }
            
            //ESEWA
            $statement = $this->connection->prepare("update product_order set `payment_method`=?, order_date=?, order_status=1, paid=1, esewa_transaction=? where token=? and user_id=?");
            if($statement){
                $statement->bind_param("sssss", $payment_method, $date, $esewa_transaction, $token, $user_id);
                $date = date('Y-m-d H:i:s');
                $token = $data["otoken"];
                $esewa_transaction = $data["esewa_transaction"];
                $user_id = $data["uid"];
                if($statement->execute()) return ["status" => 200, "content" => "Check out complete. Please check your order status in Orders Screen."];
                return ["status" => 400, "content" => "Error . Code - 0x1001"];
            }
            else{
                return ["status" => 400, "content" => "Error . Code - 0x1002"];
            }
        }
        return ["status" => 400, "content" => "Error . Code - 0x1009"];
    }

    function API_orderList($data){
        $responseData = ["status" => 400, "content" => []];
        $statement = $this->connection->prepare("select product_order.id, product_order.token, product_order.product_id, products.name, product_order.qty, product_order.rate, products.image_path, product_order.payment_method, product_order.order_status, product_order.order_date, product_order.approved_date, product_order.shipping_date, product_order.delivered_date, product_order.paid from product_order inner join products on product_order.product_id=products.id where product_order.user_id=? and (product_order.order_status BETWEEN 1 and 4) order by id desc");
        if($statement){
            $statement->bind_param("s", $uid);
            $uid = $data['uid'];
            if($statement->execute()){
                $result = $statement->get_result();
                while($row = $result->fetch_array(MYSQLI_ASSOC)){
                    $responseData["content"][] = [
                        "id" => $row["id"], "token" => $row["token"], "user_id" => $uid, "product_id" => $row["product_id"], "name" => $row["name"], "qty" => $row["qty"], "rate" => $row["rate"],
                        "image_path" => $row["image_path"], "payment_method" => $row["payment_method"], "order_status" => $row["order_status"],
                        "order_date" => $row["order_date"], "approved_date" => $row["approved_date"], "shipping_date" => $row["shipping_date"],
                        "delivered_date" => $row["delivered_date"], "paid" => $row["paid"]
                    ];
                }
                $responseData["status"] = 200;
            }
        }
        return $responseData;
    }

    function API_hostoryList($data){
        $responseData = ["status" => 400, "content" => []];
        $statement = $this->connection->prepare("select product_order.id, product_order.token, product_order.product_id, products.name, product_order.qty, product_order.rate, products.image_path, product_order.payment_method, product_order.order_status, product_order.order_date, product_order.approved_date, product_order.shipping_date, product_order.delivered_date, product_order.paid from product_order inner join products on product_order.product_id=products.id where product_order.user_id=? and paid=1 and product_order.order_status=5 order by id desc");
        if($statement){
            $statement->bind_param("s", $uid);
            $uid = $data['uid'];
            if($statement->execute()){
                $result = $statement->get_result();
                while($row = $result->fetch_array(MYSQLI_ASSOC)){
                    $responseData["content"][] = [
                        "id" => $row["id"], "token" => $row["token"], "user_id" => $uid, "product_id" => $row["product_id"], "name" => $row["name"], "qty" => $row["qty"], "rate" => $row["rate"],
                        "image_path" => $row["image_path"], "payment_method" => $row["payment_method"], "order_status" => $row["order_status"],
                        "order_date" => $row["order_date"], "approved_date" => $row["approved_date"], "shipping_date" => $row["shipping_date"],
                        "delivered_date" => $row["delivered_date"], "paid" => $row["paid"]
                    ];
                }
                $responseData["status"] = 200;
            }
        }
        return $responseData;
    }
}
?>