<?php
    require('requests/connection.php');
    include_once('assets/system/header.php');
    include_once('assets/system/navigation.php');

    if(isset($_SESSION['rmr_username'])) {
        header('Location: home.php');
    }
?>

<div class="particles"></div>
<div class="container">
    <div class="col-lg-4 col-lg-offset-4 col-md-4 col-md-offset-4">
        <div class="panel">
            <div class="panel-heading bg-dark">
                <h3 class="no-margin">Login</h3>
            </div>
            <div class="panel-body">
                <form id="login-form">
                    <div class="form-group">
                        <label for="">Username:</label>
                        <input type="text" class="form-control" name="username" placeholder="Enter username here..." required autofocus>
                    </div>
                    <div class="form-group">
                        <label for="">Password:</label>
                        <input type="password" class="form-control" name="password" placeholder="Enter password here..." required>
                    </div>
                    <input type="submit" class="btn btn-primary pull-right" value="Login">
                </form>
            </div>
        </div>
    </div>
</div>
<div id="modal" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header"></div>
            <div class="modal-body"></div>
        </div>
    </div>
</div>

<?php
    include_once('assets/system/footer.php');
?>