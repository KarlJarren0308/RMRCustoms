<?php
    require('requests/connection.php');
    include_once('assets/system/header.php');
    include_once('assets/system/navigation.php');

    if(isset($_SESSION['rmr_username'])) {
        header('Location: admin/home.php');
    }
?>

<div class="container fg-white">
    <div class="col-lg-12 col-md-12">
        <!-- Place Logo Here -->
    </div>
    <div class="col-lg-4 col-md-4 text-center">
        <br>
        <span class="fa fa-truck fa-5x"></span>
        <br>
        <h3>Track Delivery</h3>
        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
    </div>
    <div class="col-lg-4 col-md-4 text-center">
        <br>
        <span class="fa fa-comment-o fa-5x"></span>
        <br>
        <h3>About Us</h3>
        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
    </div>
    <div class="col-lg-4 col-md-4 text-center">
        <br>
        <span class="fa fa-power-off fa-5x"></span>
        <br>
        <h3>Admin Login</h3>
        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
    </div>
</div>

<?php
    include_once('assets/system/footer.php');
?>