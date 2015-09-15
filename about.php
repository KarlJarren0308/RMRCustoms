<?php
    require('requests/connection.php');
    include_once('assets/system/header.php');
    include_once('assets/system/navigation.php');

    if(isset($_SESSION['rmr_username'])) {
        header('Location: admin/home.php');
    }
?>

<div class="container fg-white">
    <div class="col-lg-8 col-lg-offset-2 col-md-8 col-md-offset-2 text-center">
        <br>
        <span class="fa fa-comment-o fa-5x"></span>
        <br>
        <h3>About Us</h3>
        <p><strong>RMR CUSTOMS BROKERAGE CORPORATION</strong> is a corporation duly registered with the Securities and Exchange Commision. It was originally organized to provide a formal structure and framework to an already flourishing custom brokerage operation managed and manned by members of the close-knit circle of friends. On September 11, 1987 when the formal registration was done, benefiting much from the pre-registration experience and the on-the-job learning and training in all aspects of the customs brokerage business.</p>
        <p>Its clientele found in the company the kind of services that were  not just efficient but also effective, given that the customs brokerage business in the country has many factors to contend with, the positive and negative, the anticipated and the unanticipated, under which circumstances only an experienced and adaptable management can survive and progress.</p>
        <p>From its experience came the effort to choose its clientele with care and caution. It would rather have less, quantity-wise, than have more and suffer the fate of being part of or unknowingly abetting irregular practices. This outlook has probably been contributory to the apparent increase in its business prospects than affecting them negatively. In recent years, it has had to measure and calibrate its expansion, striking a decent balance between its clientele’s requirements and its capabilities, always aware that each and every client deserves the best.</p>
    </div>
</div>

<?php
    include_once('assets/system/footer.php');
?>