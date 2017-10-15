<?php
    error_reporting(0);
    require_once '../share/Validations.php';

    class ManufacturerModel implements JsonSerializable {
            
        private $manufacturer_id;
        private $manufacturer_name;

        function __construct($params, &$errorInInput) {
            $this->setManufacturerID
             (array_key_exists("manufacturer_id", $params) ? $params["manufacturer_id"] : 0); 
            $this->setManufacturerName($params["manufacturer_name"], $errorInInput);
        }

        public function setManufacturerID($manu_id){
            $this->manufacturer_id = $manu_id;
        }

        public function setManufacturerName($manu_name, &$errorInInput){
            if(!Validations::nameOK($manu_name)){
                $errorInInput .= " Manufacturer Name must contain at least one letter\n";
            }

            $this->manufacturer_name = $manu_name;
        }

        public function getManufacturerID(){
            return $this->manufacturer_id;
        }

        public function getManufacturerName(){
            return $this->manufacturer_name;
        }

        public function jsonSerialize() {
            return  [
                        'manufacturer_id' => $this->getManufacturerID(),
                        'manufacturer_name' => $this->getManufacturerName()
                    ];
        }
    }

?>
