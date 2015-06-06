<?php
    class RMRSettings {
        var $xml;
        var $username;

        function RMRSettings($username) {
            if(!file_exists('assets/data/xml/settings.xml')) {
                $configXML = fopen('assets/data/xml/settings.xml', 'w');

                fwrite($configXML, '<?xml version="1.0" encoding="UTF-8"?>' . PHP_EOL);
                fwrite($configXML, '<settings></settings>' . PHP_EOL);
                fclose($configXML);
            }

            $this->xml = simplexml_load_file('assets/data/xml/settings.xml');
            $this->username = $username;

            $this->checkUsername();
        }

        function checkUsername() {
            $found = false;
            
            foreach($this->xml->account as $account) {
                if($account['username'] == $this->username) {
                    $found = true;

                    break;
                }
            }

            if(!$found) {
                $newAccount = $this->xml->addChild('account');
                $newAccount->addAttribute('username', $_SESSION['rmr_username']);

                $newSetting = $newAccount->addChild('setting');
                $newSetting->addAttribute('name', 'displayParticles');
                $newSetting->addAttribute('value', 'On');

                $this->xml->asXML('assets/data/xml/settings.xml');
            }
        }

        function checkSetting($name) {
            $returnValue = '';

            foreach($this->xml->account as $account) {
                if($account['username'] == $this->username) {
                    foreach($account->setting as $setting) {
                        if($setting['name'] == $name) {
                            $returnValue = $setting['value'];
                        }
                    }
                }
            }

            return $returnValue;
        }

        function modifySetting($name, $value) {
            foreach($this->xml->account as $account) {
                if($account['username'] == $this->username) {
                    foreach($account->setting as $setting) {
                        if($setting['name'] == $name) {
                            $setting['value'] = $value;
                        }
                    }
                }
            }

            $this->xml->asXML('assets/data/xml/settings.xml');
        }

        function displayParticles() {
            $returnValue = '';

            foreach($this->xml->account as $account) {
                if($account['username'] == $this->username) {
                    foreach($account->setting as $setting) {
                        if($setting['name'] == 'displayParticles' && $setting['value'] == 'On') {
                            $returnValue = '<div class="particles"></div>';

                            break;
                        }
                    }

                    break;
                }
            }

            return $returnValue;
        }
    }
?>