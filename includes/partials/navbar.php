<nav class="header-navbar navbar-expand-md navbar navbar-with-menu navbar-without-dd-arrow fixed-top navbar-semi-light">
    <div class="navbar-wrapper">
        <div class="navbar-container content">
            <div class="collapse navbar-collapse show" id="navbar-mobile">
            <ul class="nav navbar-nav mr-auto float-left">
                <li class="nav-item d-block d-md-none"><a class="nav-link nav-menu-main menu-toggle hidden-xs" href="#"><i class="ft-menu"></i></a></li>
                <li class="nav-item"><a class="nav-link" href="#">Hello, <?php echo @$_SESSION[GlobalVariables::$USER_SESSION_FULLNAME_STR_CLIENT]; ?></a></li>
            </ul>
            <ul class="nav navbar-nav float-right">
                <li class="dropdown dropdown-user nav-item">
                    <a class="dropdown-toggle nav-link dropdown-user-link" href="#" data-toggle="dropdown">
                        <span class="avatar avatar-online"><img src="assets/custom-imgs/user.png" alt="avatar"><i></i></span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right">
                        <div class="arrow_box_right">
                            <a class="dropdown-item" href="?page=profile-settings"><i class="ft-user"></i> Profile Settings</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="logout.php"><i class="ft-power"></i> Logout</a>
                        </div>
                    </div>
                </li>
            </ul>
            </div>
        </div>
    </div>
</nav>