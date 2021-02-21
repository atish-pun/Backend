<?php
    if(!isset($_REQUEST['pid'])){ header('location:404.php'); }
    
    include_once('modules/DBConnectionModule.php');
    include_once('modules/ProductModule.php');

    $product = new ProductModule();
    $pid = $_REQUEST['pid'];

    $catlist = $product->listProductCategoryOption();
    if(isset($_REQUEST['submit'])){
        include_once('modules/ImageModule.php');
        $fileName = ImageModule::upload('images/');
        $isSave = $product->saveEditProduct($_POST, $fileName);
    }
    $pinfo = $product->productInfo($pid);
?>
<div class="content-wrapper">
    <div class="content-wrapper-before"></div>
    <div class="content-header row">
        <div class="content-header-left col-md-4 col-12 mb-2">
            <h3 class="content-header-title">Product Edit</h3>
        </div>
        <div class="content-header-right col-md-8 col-12">
            <div class="breadcrumbs-top float-md-right">
                <div class="breadcrumb-wrapper mr-1">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
                        <li class="breadcrumb-item active"><a href="?page=product-list">Product List</a></li>
                        <li class="breadcrumb-item active"><a href="?page=product-edit&pid=<?php echo $pid ?>">Product Edit</a></li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <div class="content-body">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <form id="form" method="POST" action="" enctype="multipart/form-data">
                            <input type="hidden" value="<?php echo @$pinfo['id']; ?>" name="edit">
                            <div class="form-group">
                                <label for="category_id">Product Category *</label>
                                <select type="text" class="form-control field" id="category_id" name="category_id">
                                    <?php 
                                        foreach($catlist as $cat){ 
                                            $id =  $cat["id"];
                                            $name = $cat["name"];
                                            $select = ($pinfo["category_id"] == $id)?"selected":"";
                                            echo "<option $select value='$id'>$name</option>"; 
                                        } 
                                    ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="productname">Product Name *</label>
                                <input type="text" class="form-control field" id="productname" name="productname" value="<?php echo $pinfo["name"] ?>" placeholder="Enter product name">
                            </div>
                            <div class="form-group">
                                <label for="price">Price *</label>
                                <input type="number" class="form-control field" id="price" name="price" value="<?php echo $pinfo["price"] ?>" step="0.01">
                            </div>
                            <div class="form-group">
                                <label for="unit">Unit *</label>
                                <select class="form-control field" id="unit" name="unit">
                                    <option <?php echo ($pinfo["unit"] == "UNIT")? "selected":""; ?> value="UNIT">per Unit</option>
                                    <option <?php echo ($pinfo["unit"] == "PACK")? "selected":""; ?> value="PACK">per Pack</option>
                                    <option <?php echo ($pinfo["unit"] == "ITEM")? "selected":""; ?> value="ITEM">per Item</option>
                                    <option <?php echo ($pinfo["unit"] == "KG")? "selected":""; ?> value="KG">per KG</option>
                                    <option <?php echo ($pinfo["unit"] == "GRAM")? "selected":""; ?> value="GRAM">per Gram</option>
                                    <option <?php echo ($pinfo["unit"] == "LITER")? "selected":""; ?> value="LITER">per Liter</option>
                                    <option <?php echo ($pinfo["unit"] == "DOZEN")? "selected":""; ?> value="DOZEN">per Dozen</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="details">Details *</label>
                                <textarea class="form-control field" style="min-height:150px;" id="details" name="details" placeholder="Enter product details."><?php echo $pinfo["details"] ?></textarea>
                            </div>
                            <div class="input-group mb-3">
                                <div class="col-12 pl-0"> <label for="unit">Feature Image (16:9 or 1280x720)</label> </div>
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="image" name="uploadFile">
                                    <label class="custom-file-label" id="imagelabel" for="image">Upload Image</label>
                                </div>
                            </div>
                            <div class="form-group">
                                <button type="submit" value="submit" name="submit" class="btn btn-primary"><i class="la la-floppy-o"></i> Save</button>
                                <button type="button" id="reset-form" class="btn btn-warning"><i class="la la-refresh"></i> Reset</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {
        $("#reset-form").click(function(){
            $("#form").find(".field").val("");
            $("#imagelabel").html("Upload Image");
        });

        $("#image").change(function(e){
            $('#imagelabel').html(e.target.files[0].name);
        });

        <?php
            if(isset($_REQUEST['submit'])){
                if($isSave) echo 'swal("Info", "Product info updated", "info")';
                else echo 'swal("Error", "Server Error", "error")';
            }
        ?>
    });
</script>