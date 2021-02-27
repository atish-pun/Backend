<?php
    include_once('modules/DBConnectionModule.php');
    include_once('modules/ProductModule.php');

    if(!$_REQUEST['edit']) header("location:404.php");

    $product = new ProductModule();
    if(isset($_REQUEST['submit'])){
        include_once('modules/ImageModule.php');
        $fileName = ImageModule::upload('images/');
        $isSave = $product->homeScreenSlideUpdate($_POST, $fileName);
    }

    $productInfo = $product->homeScreenSlideInfo($_REQUEST['edit']);
    if(!$productInfo) header("location:404.php");
?>

<div class="content-wrapper">
    <div class="content-wrapper-before"></div>
    <div class="content-header row">
        <div class="content-header-left col-md-4 col-12 mb-2">
            <h3 class="content-header-title">Home Screen Slide</h3>
        </div>
        <div class="content-header-right col-md-8 col-12">
            <div class="breadcrumbs-top float-md-right">
                <div class="breadcrumb-wrapper mr-1">
                    <ol class="breadcrumb">
                    
                        <li class="breadcrumb-item active"><a href="?page=home-screen-slide">Home Screen Slide</a></li>
                        <li class="breadcrumb-item active"><a href="??page=home-screen-slide-edit&edit=<?php echo $productInfo["id"]; ?>">Edit Screen</a></li>
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
                            <input type="hidden" name="edit" value="<?php echo $productInfo["id"]; ?>"/>
                            <div class="form-group">
                                <div class="col-12 pl-0"> 
                                    <h4 for="unit" style="color:#000;"><?php echo $productInfo["name"] ?></h4> 
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-12 pl-0"> <label for="unit">Slide Image (1280x720)</label> </div>
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="image" name="uploadFile">
                                    <label class="custom-file-label" id="imagelabel" for="image">Upload Image</label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="productcategoryname">Slide Status</label>
                                <select class="form-control field" id="slidestatus" name="slidestatus">
                                    <option <?php echo ($productInfo["home_screen_slide"]==1)?"selected":""; ?> value="1">Active</option>
                                    <option <?php echo ($productInfo["home_screen_slide"]==0)?"selected":""; ?> value="0">De-Active</option>
                                </select>
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
                if($isSave) echo 'swal("Info", "Home screen slide info updated.", "info")';
                else echo 'swal("Error", "Server Error", "error")';
            }
        ?>
    });
</script>