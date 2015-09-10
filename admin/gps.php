<?php
    require('requests/connection.php');
    require('requests/settings.php');
    include_once('assets/system/header.php');
    include_once('assets/system/navigation.php');

    if(!isset($_SESSION['rmr_username'])) {
        header('Location: ./');
    }

    $systemSettings = new RMRSettings($_SESSION['rmr_username']);
    echo $systemSettings->displayParticles();
?>

<div class="container-fluid">
    <div class="col-lg-3 col-md-3" style="position: fixed;">
        <div class="list-group">
            <a href="clients.php" class="list-group-item" data-log="Clients Module" data-toggle="popover" title="Clients" data-content="Displays all client information. This module also allows you to add, edit, or delete client information."><h4 class="no-margin">Clients</h4></a>
            <a href="ladings.php" class="list-group-item" data-log="Bill of Lading Module" data-toggle="popover" title="Bill of Lading" data-content="Displays all bill of lading made. This module also allows you to create new bill of lading."><h4 class="no-margin">Bill of Lading</h4></a>
            <a href="transactions.php" class="list-group-item" data-log="Transactions Module" data-toggle="popover" title="Transactions" data-content="Displays all active and inactive transactions made. This module also allows you to create new transactions."><h4 class="no-margin">Transactions</h4></a>
            <a href="trucks.php" class="list-group-item" data-log="Trucks Module" data-toggle="popover" title="Trucks" data-content="Displays information about the trucks."><h4 class="no-margin">Trucks</h4></a>
            <?php
                if($_SESSION['rmr_type'] == 'Administrator' || $_SESSION['rmr_type'] == 'President') {
                    echo '<a href="finances.php" class="list-group-item" data-log="Finances Module" data-toggle="popover" title="Finances" data-content="Tracks all credits and debits of the company."><h4 class="no-margin">Finances</h4></a>';
                }
            ?>
            <a href="gps.php" class="list-group-item active-dark" data-toggle="popover" title="Global Positioning System" data-content="Tracks all GPS-equipped trucks."><h4 class="no-margin">Global Positioning System</h4></a>
            <a href="users.php" class="list-group-item" data-log="Users Module" data-toggle="popover" title="Users" data-content="Manage users. This module allows you to add, edit or delete users. You may also set/unset modules he/she should/shouldn't use."><h4 class="no-margin">Users</h4></a>
            <?php
                if($_SESSION['rmr_type'] == 'Administrator') {
                    echo '<a href="charges.php" class="list-group-item" data-log="Company Fix Rate Charges Module" data-toggle="popover" title="Company Fix Rate Charges" data-content="This module allows you to modify values of different charges."><h4 class="no-margin">Company Fix Rate Charges</h4></a>';
                }
            ?>
        </div>
    </div>
    <div class="col-lg-9 col-lg-offset-3 col-md-9 col-md-offset-3 auto-next-line">
        <iframe id="gps-frame" frameborder="0" sandbox="allow-forms allow-same-origin allow-scripts" src="http://www.wetrack.ph/Login.aspx" __idm_frm__="3"></iframe>
    </div>
</div>

<?php
    include_once('assets/system/footer.php');
?>