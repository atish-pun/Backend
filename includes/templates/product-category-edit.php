<?php
    if(!isset($_REQUEST['pid'])){ header('location:404.php'); }

    include_once('modules/DBConnectionModule.php');
    include_once('modules/ProductModule.php');

    $product = new ProductModule();
    $pid = $_REQUEST['pid'];
   
    if(isset($_REQUEST['submit'])){
        include_once('modules/ImageModule.php');
        $fileName = ImageModule::upload('images/');
        $isSave = $product->saveEditProductCategory($_POST, $fileName);        
    }

    $pcinfo = $product->productCategoryInfo($pid);
?>

<div class="content-wrapper">
    <div class="content-wrapper-before"></div>
    <div class="content-header row">
        <div class="content-header-left col-md-4 col-12 mb-2">
            <h3 class="content-header-title">Product Category Edit</h3>
        </div>
        <div class="content-header-right col-md-8 col-12">
            <div class="breadcrumbs-top float-md-right">
                <div class="breadcrumb-wrapper mr-1">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
                        <li class="breadcrumb-item active"><a href="?page=product-category-list">Product Category List</a></li>
                        <li class="breadcrumb-item active"><a href="?page=product-category-edit&pid=<?php echo @$pid; ?>">Product Category Edit</a></li>
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
                            <input type="hidden" value="<?php echo @$pcinfo['id']; ?>" name="edit">
                            <div class="form-group">
                                <label for="productcategoryname">Product Category Name</label>
                                <input type="text" class="form-control field" id="productcategoryname" value="<?php echo @$pcinfo['name']; ?>" name="productcategoryname" placeholder="Enter product category name">
                            </div>
                            <div class="input-group mb-3">
                                <div class="col-12 pl-0"> <label for="unit">Image (128x128 Recommended)</label> </div>
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
                if($isSave) echo 'swal("Info", "Product Category Updated", "info")';
                else echo 'swal("Error", "Server Error", "error")';
            }
        ?>
    });
</script>