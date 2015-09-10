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

<div class="container">
    <div class="col-lg-12 alert alert-info"><strong>Note:</strong> All changes in the settings will be saved automatically and will be applied at the next refresh of the pages.</div>
    <div class="col-lg-4">
        <div class="thumbnail shadow">
            <img src="assets/img/particles.png">
            <div class="container-fluid">
                <h3>Display Particles</h3>
                <p>Allows you to display or hide particles on background.</p>
                <br>
                <div class="text-center">
                    <div class="btn-group" data-toggle="buttons">
                        <?php
                            if($systemSettings->checkSetting('displayParticles') == 'On') {
                                echo '<label onclick="configureSetting(\'displayParticles\', \'On\');" data-light-switch="switchOne" class="btn btn-success light-switch-on active">';
                                echo '<input type="radio" name="displayParticles" autocomplete="off" checked>On';
                                echo '</label>';
                                echo '<label onclick="configureSetting(\'displayParticles\', \'Off\');" data-light-switch="switchOne" class="btn btn-default light-switch-off">';
                                echo '<input type="radio" name="displayParticles" autocomplete="off">Off';
                                echo '</label>';
                            } else {
                                echo '<label onclick="configureSetting(\'displayParticles\', \'On\');" data-light-switch="switchOne" class="btn btn-default light-switch-on">';
                                echo '<input type="radio" name="displayParticles" autocomplete="off">On';
                                echo '</label>';
                                echo '<label onclick="configureSetting(\'displayParticles\', \'Off\');" data-light-switch="switchOne" class="btn btn-danger light-switch-off active">';
                                echo '<input type="radio" name="displayParticles" autocomplete="off" checked>Off';
                                echo '</label>';
                            }
                        ?>
                    </div>
                </div>
                <br>
            </div>
        </div>
    </div>
</div>
<script src="assets/js/settings.js"></script>

<?php
    include_once('assets/system/footer.php');
?>