<?php function reqPage($page){ if($page == "" && !isset($_REQUEST['page'])){ echo 'active'; } if(isset($_REQUEST['page']) && $_REQUEST['page'] == $page){ echo 'active'; } } ?>
<div class="main-menu menu-fixed menu-light menu-accordion menu-shadow " data-scroll-to-active="true" data-img="theme-assets/images/backgrounds/02.jpg">
    <div class="navbar-header">
        <ul class="nav navbar-nav flex-row">       
            <li class="nav-item mr-auto"><a class="navbar-brand" href="index.php"><img class="brand-logo" alt="Chameleon admin logo" src="assets/custom-imgs/logo.png"/>
                <h3 class="brand-text" style="color:black;">Grocery Store</h3></a></li>
            <li class="nav-item d-md-none"><a class="nav-link close-navbar"><i class="ft-x"></i></a></li>
        </ul>
    </div>
    <div class="main-menu-content">
        <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
            <li class="nav-item <?php reqPage(""); ?>"><a href="index.php"><i class="ft-home"></i><span class="menu-title" data-i18n="">Dashboard</span></a></li>
            <li class="nav-item <?php reqPage("product-category-list"); reqPage("product-category-add"); reqPage("product-category-edit"); ?>"><a href="?page=product-category-list"><i class="ft-package"></i><span class="menu-title" data-i18n="">Product Category</span></a></li>
            <li class="nav-item <?php reqPage("product-list"); reqPage("product-add"); reqPage("product-edit");?>"><a href="?page=product-list"><i class="ft-tag"></i><span class="menu-title" data-i18n="">Products</span></a></li>
            <li class="nav-item <?php reqPage("hot-sale-list"); ?>"><a href="?page=hot-sale-list"><i class="la la-fire"></i><span class="menu-title" data-i18n="">Hot Sale List</span></a></li>
            <li class="nav-item <?php reqPage("top-sale-list"); ?>"><a href="?page=top-sale-list"><i class="la la-tags"></i><span class="menu-title" data-i18n="">Top Sale List</span></a></li>
            <li class="nav-item <?php reqPage("home-screen-slide"); ?>"><a href="?page=home-screen-slide"><i class="la la-file-movie-o"></i><span class="menu-title" data-i18n="">Home Screen Slide</span></a></li>
            <li class="nav-item <?php reqPage("product-order-list"); ?>"><a href="?page=product-order-list"><i class="la la-list-alt"></i><span class="menu-title" data-i18n="">Products Order</span></a></li>
            <li class="nav-item <?php reqPage("product-report"); ?>"><a href="?page=product-report"><i class="ft-file-text"></i><span class="menu-title" data-i18n="">Product Reports</span></a></li>
            <li class="nav-item <?php reqPage("user-lists"); ?>"><a href="?page=user-lists"><i class="ft-users"></i><span class="menu-title" data-i18n="">User Lists</span></a></li>
            <li class="nav-item <?php reqPage("profile-settings"); ?>"><a href="?page=profile-settings"><i class="ft-settings"></i><span class="menu-title" data-i18n="">Profile Settings</span></a></li>
            <li class="nav-item"><a href="logout.php"><i class="la la-power-off"></i><span class="menu-title" data-i18n="">Logout</span></a></li>
        </ul>
    </div>
    <div class="navigation-background"></div>
</div>