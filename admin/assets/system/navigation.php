<nav class="navbar navbar-inverse navbar-fixed-top shadow" role="navigation">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-menus">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a href="<?php echo isset($_SESSION['rmr_username']) ? 'javascript:void(0);' : './../' ; ?>" class="navbar-brand">RMR Customs Brokerage Corporation</a>
        </div>
        <div id="navbar-menus" class="navbar-right collapse navbar-collapse">
            <?php
                if(isset($_SESSION['rmr_username'])) {
                    echo '<ul class="nav navbar-nav">';
                    echo '<li><a href="home.php">Home</a></li>';
                    echo '<li><a class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" href="javascript:void(0);">' . $_SESSION['rmr_name'] . '&nbsp;&nbsp;<img class="profile-picture img-rounded pull-right" src="user_files/' . $_SESSION['rmr_profile'] . '"></a>';
                    echo '<ul class="dropdown-menu" role="menu">';
                    echo '<li><a href="settings.php"><span class="glyphicon glyphicon-cog"></span> Settings</a></li>';
                    echo '<li class="divider"></li>';
                    echo '<li><a data-log="Logout" href="requests/logout_request.php"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>';
                    echo '</ul>';
                    echo '</li>';
                    echo '</ul>';
                } else {
                    echo '<ul class="nav navbar-nav">';
                    echo '<li><a href="./../track.php">Track Delivery</a></li>';
                    echo '<li><a href="./">Admin Login</a></li>';
                    echo '</ul>';
                }
            ?>
        </div>
    </div>
</nav>