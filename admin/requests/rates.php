<?php
    class RMRRates {
        var $xml;

        function RMRRates() {
            if(!file_exists('assets/data/xml/rates.xml')) {
                $configXML = fopen('assets/data/xml/rates.xml', 'w');

                fwrite($configXML, '<?xml version="1.0" encoding="UTF-8"?>' . PHP_EOL);
                fwrite($configXML, '<rates><rate name="pesoToDollar" value="43.898"/></rates>' . PHP_EOL);
                fclose($configXML);
            }

            $this->xml = simplexml_load_file('assets/data/xml/rates.xml');
        }

        function getChargeValue($name) {
            $returnValue = '';

            foreach($this->xml->rate as $rate) {
                if($rate['name'] == $name) {
                    $returnValue = $rate['value'];

                    break;
                }
            }

            return $returnValue;
        }
    }
?>