<?php
    $stampsOnEntry = isset($_POST['stampsOnEntry']) && is_numeric($_POST['stampsOnEntry']) ? $_POST['stampsOnEntry'] : 0;
    $customsStorage = isset($_POST['customsStorage']) && is_numeric($_POST['customsStorage']) ? $_POST['customsStorage'] : 0;
    $xerox = isset($_POST['xerox']) && is_numeric($_POST['xerox']) ? $_POST['xerox'] : 0;
    $notaryFee = isset($_POST['notaryFee']) && is_numeric($_POST['notaryFee']) ? $_POST['notaryFee'] : 0;
    $stampsOnCarrierBonds = isset($_POST['stampsOnCarrierBonds']) && is_numeric($_POST['stampsOnCarrierBonds']) ? $_POST['stampsOnCarrierBonds'] : 0;
    $stampsOnChargeableBond = isset($_POST['stampsOnChargeableBond']) && is_numeric($_POST['stampsOnChargeableBond']) ? $_POST['stampsOnChargeableBond'] : 0;
    $stampsOnExportDeclaration = isset($_POST['stampsOnExportDeclaration']) && is_numeric($_POST['stampsOnExportDeclaration']) ? $_POST['stampsOnExportDeclaration'] : 0;
    $birExemption = isset($_POST['birExemption']) && is_numeric($_POST['birExemption']) ? $_POST['birExemption'] : 0;
    $documentation = isset($_POST['documentation']) && is_numeric($_POST['documentation']) ? $_POST['documentation'] : 0;
    $processing = isset($_POST['processing']) && is_numeric($_POST['processing']) ? $_POST['processing'] : 0;

    $xml = simplexml_load_file('../assets/data/xml/charges.xml');

    $xml->charge[0]['value'] = $stampsOnEntry;
    $xml->charge[1]['value'] = $customsStorage;
    $xml->charge[2]['value'] = $xerox;
    $xml->charge[3]['value'] = $notaryFee;
    $xml->charge[4]['value'] = $stampsOnCarrierBonds;
    $xml->charge[5]['value'] = $stampsOnChargeableBond;
    $xml->charge[6]['value'] = $stampsOnExportDeclaration;
    $xml->charge[7]['value'] = $birExemption;
    $xml->charge[8]['value'] = $documentation;
    $xml->charge[9]['value'] = $processing;

    $xml->asXML('../assets/data/xml/charges.xml');

    echo 'All changes has been saved.';
?>