<?php
    $pesoToDollarRate = isset($_POST['pesoToDollarRate']) && is_numeric($_POST['pesoToDollarRate']) ? $_POST['pesoToDollarRate'] : 0;

    $xml = simplexml_load_file('../assets/data/xml/rates.xml');

    $xml->rate['value'] = $pesoToDollarRate;

    $xml->asXML('../assets/data/xml/rates.xml');

    echo 'All changes has been saved.';
?>