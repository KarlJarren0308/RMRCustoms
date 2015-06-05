<?php
    class RMRCharges {
        var $xml;

        function RMRCharges() {
            if(!file_exists('../admin/assets/data/xml/charges.xml')) {
                $configXML = fopen('../admin/assets/data/xml/charges.xml', 'w');

                fwrite($configXML, '<?xml version="1.0" encoding="UTF-8"?>' . PHP_EOL);
                fwrite($configXML, '<charges><charge name="stampsOnEntry" value="10"/><charge name="customsStorage" value="10"/><charge name="xerox" value="10"/><charge name="notaryFee" value="10"/><charge name="stampsOnCarrierBonds" value="10"/><charge name="stampsOnChargeableBond" value="10"/><charge name="stampsOnExportDeclaration" value="10"/></charges>' . PHP_EOL);
                fclose($configXML);
            }

            $this->xml = simplexml_load_file('../admin/assets/data/xml/charges.xml');
        }

        function getChargeValue($name) {
            $returnValue = '';

            foreach($this->xml->charge as $charge) {
                if($charge['name'] == $name) {
                    $returnValue = $charge['value'];

                    break;
                }
            }

            return $returnValue;
        }
    }
?>