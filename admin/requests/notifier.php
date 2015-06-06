<?php
    if(isset($_GET['value'])) {
        if(substr($_GET['value'], 0, 16) == 'C5U3qtr5ST46OM6S') {
            $text = substr($_GET['value'], 16); //C5U3qtr5ST46OM6S

            echo base64_decode($text);
        }
    }
?>