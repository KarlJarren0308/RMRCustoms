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
        <div id="rmr-carousel" class="carousel slide" data-ride="carousel" style="overflow: hidden; height: 300px;">
            <ol class="carousel-indicators">
                <li data-target="#rmr-carousel" data-slide-to="0" class="active"></li>
                <li data-target="#rmr-carousel" data-slide-to="1"></li>
                <li data-target="#rmr-carousel" data-slide-to="2"></li>
                <li data-target="#rmr-carousel" data-slide-to="3"></li>
            </ol>
            <div class="carousel-inner" role="listbox">
                <div class="item active">
                    <img src="assets/img/carousel01.jpg" style="margin-top: -200px; width: 100%;">
                </div>
                <div class="item">
                    <img src="assets/img/carousel02.jpg" style="margin-top: -200px; width: 100%;">
                </div>
                <div class="item">
                    <img src="assets/img/carousel03.jpg" style="margin-top: -200px; width: 100%;">
                </div>
                <div class="item">
                    <img src="assets/img/carousel04.jpg" style="margin-top: -200px; width: 100%;">
                </div>
            </div>
            <a class="left carousel-control" href="#rmr-carousel" role="button" data-slide="prev">
                <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="right carousel-control" href="#rmr-carousel" role="button" data-slide="next">
                <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>
    </div>
    <div class="col-lg-6 col-md-6 text-center">
        <br>
        <span class="fa fa-truck fa-5x"></span>
        <br>
        <h3>Track Delivery</h3>
        <p>Need to track your item and check your bills? Use our Online tracking system for cargo service to find out where your shipment is and to view your billing charges info.<br><br><a class="btn btn-success btn-lg" href="track.php">Track Now!</a></p>
    </div>
    <div class="col-lg-6 col-md-6 text-center">
        <br>
        <span class="fa fa-star fa-5x"></span>
        <br>
        <h3>Vision & Mission</h3>
        <p>The company’s VISION is to able to provide its clientele (Importers, Exporters, and others) the best customs brokerage services possible.</p>
        <p>Its MISSION is to harness all its resources to ensure the fulfillment of its Vision.</p>
    </div>
</div>

<?php
    include_once('assets/system/footer.php');
?>