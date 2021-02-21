<?php
    include_once('modules/DBConnectionModule.php');
    include_once('modules/ProductModule.php');
    include_once('modules/ImageModule.php');

    $product = new ProductModule();
    $catlist = $product->listProductCategoryOption();
    if(isset($_REQUEST['submit'])){
        $fileName = ImageModule::upload('images/');
        $isSave = $product->saveProduct($_POST, $fileName); 
    }
?>
<div class="content-wrapper">
    <div class="content-wrapper-before"></div>
    <div class="content-header row">
        <div class="content-header-left col-md-4 col-12 mb-2">
            <h3 class="content-header-title">Product Add</h3>
        </div>
        <div class="content-header-right col-md-8 col-12">
            <div class="breadcrumbs-top float-md-right">
                <div class="breadcrumb-wrapper mr-1">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
                        <li class="breadcrumb-item active"><a href="?page=product-list">Product List</a></li>
                        <li class="breadcrumb-item active"><a href="?page=product-add">Product Add</a></li>
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
                            <div class="form-group">
                                <label for="category_id">Product Category *</label>
                                <select type="text" class="form-control field" id="category_id" name="category_id">
                                    <?php foreach($catlist as $cat){ $id =  $cat["id"]; $name = $cat["name"]; echo "<option value='$id'>$name</option>"; } ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="productname">Product Name *</label>
                                <input type="text" class="form-control field" id="productname" name="productname" placeholder="Enter product name">
                            </div>
                            <div class="form-group">
                                <label for="price">Price *</label>
                                <input type="number" class="form-control field" id="price" name="price" value="0.00" step="0.01">
                            </div>
                            <div class="form-group">
                                <label for="unit">Unit *</label>
                                <select class="form-control field" id="unit" name="unit">
                                    <option value="UNIT">per Unit</option>
                                    <option value="PACK">per Pack</option>
                                    <option value="ITEM">per Item</option>
                                    <option value="KG">per KG</option>
                                    <option value="GRAM">per Gram</option>
                                    <option value="LITER">per Liter</option>
                                    <option value="DOZEN">per Dozen</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="details">Details *</label>
                                <textarea class="form-control field" style="min-height:150px;" id="details" name="details" placeholder="Enter product details."></textarea>
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
                if($isSave) echo 'swal("Info", "Product Saved", "info")';
                else echo 'swal("Error", "Server Error", "error")';
            }
        ?>
    });
</script>