<?php
    include_once('modules/DBConnectionModule.php');
    include_once('modules/UserModule.php');

    $userModule = new UserModule();
    if(isset($_REQUEST['submit'])){ $isSave = $userModule->profileSave($_POST); }
    $profileInfo = $userModule->profileInfo();
?>
<div class="content-wrapper">
    <div class="content-wrapper-before"></div>
    <div class="content-header row">
        <div class="content-header-left col-md-4 col-12 mb-2">
            <h3 class="content-header-title">Profile Settings</h3>
        </div>
        <div class="content-header-right col-md-8 col-12">
            <div class="breadcrumbs-top float-md-right">
                <div class="breadcrumb-wrapper mr-1">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
                        <li class="breadcrumb-item active"><a href="?page=profile-settings">Profile Settings</a></li>
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
                        <form id="form" method="POST" action="">
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="text" id="email" value="<?php echo @$profileInfo["email"] ?>" class="form-control field" readonly/>
                            </div>
                            <div class="form-group">
                                <label for="fullname">Full Name</label>
                                <input type="text" class="form-control field" id="fullname" name="fullname" value="<?php echo @$profileInfo["name"] ?>">
                            </div>
                            <div class="form-group">
                                <label for="address">Address</label>
                                <input type="text" class="form-control field" id="address" name="address" value="<?php echo @$profileInfo["address"] ?>">
                            </div>
                            <div class="form-group">
                                <label for="phone">Phone</label>
                                <input type="text" class="form-control field" id="phone" name="phone" value="<?php echo @$profileInfo["phone"] ?>">
                            </div>
                            <div class="form-group">
                                <button type="submit" value="submit" name="submit" class="btn btn-primary"><i class="la la-floppy-o"></i> Update</button>
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
        <?php
            if(isset($_REQUEST['submit'])){
                if($isSave) echo 'swal("Info", "Profile Updated. It will take another refresh to page to active updated info.", "info")';
                else echo 'swal("Error", "Server Error", "error")';
            }
        ?>
    });
</script>