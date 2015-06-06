<?php
    require('connection.php');

    $username = $_SESSION['rmr_username'];
    $action = $_POST['action'];
    $name = $_POST['name'];
    $xml = simplexml_load_file('../assets/data/xml/settings.xml');

    if($action == 'Configure') {
        $value = $_POST['value'];

        foreach($xml->account as $account) {
            if($account['username'] == $username) {
                foreach($account->setting as $setting) {
                    if($setting['name'] == $name) {
                        $setting['value'] = $value;
                    }
                }
            }
        }

        $xml->asXML('../assets/data/xml/settings.xml');
    } else {
        echo 'Unknown or no action found.';
    }
?>