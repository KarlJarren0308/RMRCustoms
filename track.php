<?php
    include_once('assets/system/header.php');
    include_once('assets/system/navigation.php');
?>

<div class="container">
    <div class="jumbotron bg-dark">
        <h2><span class="glyphicon glyphicon-map-marker"></span>&nbsp;Track Delivery</h2>
        <p>Want to know all necessary information? Want to know where your delivery is right now?</p>
    </div>
    <div class="col-lg-4 col-lg-offset-4 col-md-4 col-md-offset-4">
        <div class="panel">
            <div class="panel-heading bg-dark">
                <h3 class="no-margin">Track</h3>
            </div>
            <div class="panel-body">
                <form id="track-form" target="map-of-dora">
                    <label for="track-field">Waybill Number:</label>
                    <div class="input-group">
                        <input id="track-field" type="text" name="track" class="form-control" placeholder="Enter waybill number here..." onkeyup="isInputNumeric(this);" autofocus>
                        <span class="input-group-btn">
                            <button class="btn btn-default bg-dark"><span class="glyphicon glyphicon-search"></span></button>
                        </span>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<div id="modal" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-dark top-corners-round">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span class="glyphicon glyphicon-remove fg-white"></span></button>
                <h3 class="modal-title"></h3>
            </div>
            <div class="modal-body">
            </div>
            <div class="modal-footer">
            </div>
        </div>
    </div>
</div>

<?php
    include_once('assets/system/footer.php');
?>