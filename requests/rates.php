<?php
    class RMRRates {
        var $xml;

        function RMRRates() {
            if(!file_exists('../admin/assets/data/xml/rates.xml')) {
                $configXML = fopen('../admin/assets/data/xml/rates.xml', 'w');

                fwrite($configXML, '<?xml version="1.0" encoding="UTF-8"?>' . PHP_EOL);
                fwrite($configXML, '<rates><rate name="toDollar" value="45"/></rates>' . PHP_EOL);
                fclose($configXML);
            }

            $this->xml = simplexml_load_file('../admin/assets/data/xml/rates.xml');
        }

        function getPesoToDollarRate() {
            return $this->xml->rate['value'];
        }
    }
?>