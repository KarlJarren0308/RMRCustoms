<?php
    require('requests/connection.php');
    require('requests/settings.php');
    require('requests/charges.php');
    require('requests/rates.php');
    include_once('assets/system/header.php');
    include_once('assets/system/navigation.php');

    if(!isset($_SESSION['rmr_username'])) {
        header('Location: ./');
    }

    $rmrCharges = new RMRCharges();
    $systemSettings = new RMRSettings($_SESSION['rmr_username']);
    $rmrRates = new RMRRates();
    echo $systemSettings->displayParticles();
?>

<div class="container-fluid">
    <div class="col-lg-3 col-md-3 fixed-position">
        <div class="list-group">
            <a href="clients.php" class="list-group-item" data-log="Clients Module" data-toggle="popover" title="Clients" data-content="Displays all client information. This module also allows you to add, edit, or delete client information."><h4 class="no-margin">Clients</h4></a>
            <a href="companies.php" class="list-group-item" data-log="Companies Module" data-toggle="popover" title="Companies" data-content="Displays all company information. This module also allows you to add, edit, or delete company information."><h4 class="no-margin">Companies</h4></a>
            <a href="ladings.php" class="list-group-item" data-log="Bill of Lading Module" data-toggle="popover" title="Bill of Lading" data-content="Displays all bill of lading made. This module also allows you to create new bill of lading."><h4 class="no-margin">Bill of Lading</h4></a>
            <a href="transactions.php" class="list-group-item" data-log="Transactions Module" data-toggle="popover" title="Transactions" data-content="Displays all active and inactive transactions made. This module also allows you to create new transactions."><h4 class="no-margin">Transactions</h4></a>
            <a href="trucks.php" class="list-group-item" data-log="Trucks Module" data-toggle="popover" title="Trucks" data-content="Displays information about the trucks."><h4 class="no-margin">Trucks</h4></a>
            <?php
                if($_SESSION['rmr_type'] == 'Administrator' || $_SESSION['rmr_type'] == 'President') {
                    echo '<a href="finances.php" class="list-group-item" data-log="Finances Module" data-toggle="popover" title="Finances" data-content="Tracks all credits and debits of the company."><h4 class="no-margin">Finances</h4></a>';
                }
            ?>
            <a href="gps.php" class="list-group-item" data-log="Global Positioning System Module" data-toggle="popover" title="Global Positioning System" data-content="Tracks all GPS-equipped trucks."><h4 class="no-margin">Global Positioning System</h4></a>
            <a href="users.php" class="list-group-item" data-log="Users Module" data-toggle="popover" title="Users" data-content="Manage users. This module allows you to add, edit or delete users. You may also set/unset modules he/she should/shouldn't use."><h4 class="no-margin">Users</h4></a>
            <?php
                if($_SESSION['rmr_type'] == 'Administrator') {
                    echo '<a href="charges.php" class="list-group-item active-dark" data-toggle="popover" title="Company Fix Rate Charges" data-content="This module allows you to modify values of different charges."><h4 class="no-margin">Company Fix Rate Charges</h4></a>';
                }
            ?>
        </div>
    </div>
    <div class="col-lg-9 col-lg-offset-3 col-md-9 col-md-offset-3 auto-next-line">
        <div class="col-lg-12 col-md-12">
            <div class="panel">
                <div class="panel-heading bg-dark">
                    <div class="panel-title">Charges Panel</div>
                </div>
                <div class="panel-body">
                    <form id="charges-panel-form">
                        <div class="form-group">
                            <label>Stamps on Entry [In Philippine Peso]:</label>
                            <div class="input-group">
                                <div class="input-group-addon">&#8369;</div>
                                <input type="text" class="form-control" name="stampsOnEntry" placeholder="Enter Stamps on Entry here..." value="<?php echo $rmrCharges->getChargeValue('stampsOnEntry'); ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Customs Storage [In Philippine Peso]:</label>
                            <div class="input-group">
                                <div class="input-group-addon">&#8369;</div>
                                <input type="text" class="form-control" name="customsStorage" placeholder="Enter Customs Storage here..." value="<?php echo $rmrCharges->getChargeValue('customsStorage'); ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Xerox [In Philippine Peso]:</label>
                            <div class="input-group">
                                <div class="input-group-addon">&#8369;</div>
                                <input type="text" class="form-control" name="xerox" placeholder="Enter Xerox here..." value="<?php echo $rmrCharges->getChargeValue('xerox'); ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Notary Fee [In Philippine Peso]:</label>
                            <div class="input-group">
                                <div class="input-group-addon">&#8369;</div>
                                <input type="text" class="form-control" name="notaryFee" placeholder="Enter Notary Fee here..." value="<?php echo $rmrCharges->getChargeValue('notaryFee'); ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Stamps on Carrier Bonds [In Philippine Peso]:</label>
                            <div class="input-group">
                                <div class="input-group-addon">&#8369;</div>
                                <input type="text" class="form-control" name="stampsOnCarrierBonds" placeholder="Enter Stamps on Carrier Bonds here..." value="<?php echo $rmrCharges->getChargeValue('stampsOnCarrierBonds'); ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Stamps on Chargeable Bond [In Philippine Peso]:</label>
                            <div class="input-group">
                                <div class="input-group-addon">&#8369;</div>
                                <input type="text" class="form-control" name="stampsOnChargeableBond" placeholder="Enter Stamps on Chargeable Bond here..." value="<?php echo $rmrCharges->getChargeValue('stampsOnChargeableBond'); ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Stamps on Export Declaration [In Philippine Peso]:</label>
                            <div class="input-group">
                                <div class="input-group-addon">&#8369;</div>
                                <input type="text" class="form-control" name="stampsOnExportDeclaration" placeholder="Enter Stamps on Export Declaration here..." value="<?php echo $rmrCharges->getChargeValue('stampsOnExportDeclaration'); ?>">
                            </div>
                        </div>
                        <div class="text-right">
                            <input type="submit" class="btn btn-primary" value="Save Changes">
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-lg-12 col-md-12">
            <div class="panel">
                <div class="panel-heading bg-dark">
                    <div class="panel-title">Exchange Rate Panel</div>
                </div>
                <div class="panel-body">
                    <form id="rates-panel-form">
                        <div class="form-group">
                            <label>Peso (&#8369;) to US Dollar (USD):</label>
                            <div class="input-group">
                                <div class="input-group-addon">&#8369;</div>
                                <input type="text" class="form-control" name="pesoToDollarRate" placeholder="Enter Stamps on Export Declaration here..." value="<?php echo $rmrRates->getChargeValue('pesoToDollar'); ?>">
                            </div>
                        </div>
                        <div class="text-right">
                            <input type="submit" class="btn btn-primary" value="Save Changes">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<div id="prompt" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-dark top-corners-round">
                <div class="modal-title"></div>
            </div>
            <div class="modal-body"></div>
        </div>
    </div>
</div>
<script>
    $('#charges-panel-form').submit(function() {
        $.ajax({
            url: 'requests/modify_charges.php',
            method: 'POST',
            data: $(this).serialize(),
            success: function(response) {
                $('#prompt').modal({
                    backdrop: 'static'
                });
                $('#prompt .modal-title').html('<h3 class="no-margin">Prompt</h3>')
                $('#prompt .modal-body').html(response);

                setTimeout(function() {
                    $('#prompt').modal('hide');

                    location.reload();
                }, 1500);
            }
        });

        return false;
    });

    $('#rates-panel-form').submit(function() {
        $.ajax({
            url: 'requests/modify_rates.php',
            method: 'POST',
            data: $(this).serialize(),
            success: function(response) {
                $('#prompt').modal({
                    backdrop: 'static'
                });
                $('#prompt .modal-title').html('<h3 class="no-margin">Prompt</h3>')
                $('#prompt .modal-body').html(response);

                setTimeout(function() {
                    $('#prompt').modal('hide');

                    location.reload();
                }, 1500);
            }
        });

        return false;
    });
</script>

<?php
    include_once('assets/system/footer.php');
?>