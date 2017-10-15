<?php
    error_reporting(0);

    require_once '../share/Validations.php';
    
    class PhoneModel implements JsonSerializable {

        private $phone_id;
        private $phone_name;
        private $manufacturer_id;
        private $manufacturer_name;

        function __construct($params, &$errorInInput) {
            $this->setPhoneID
                (array_key_exists("phone_id", $params) ? $params["phone_id"] : 0); 
            $this->setPhoneName($params["phone_name"], $errorInInput);
            $this->setManufacturerID($params["manufacturer_id"], $errorInInput); 
            $this->setManufacturerName
                (array_key_exists("manufacturer_name", $params) ? $params["manufacturer_name"] : ""); 
        }  

        public function setPhoneID($ph_id){
            $this->phone_id = $ph_id;
        }

        public function setPhoneName($ph_name, &$errorInInput){
            if(!Validations::nameOK($ph_name)){
                $errorInInput .= " Phone Name must contain at least one letter\n";
            }
            $this->phone_name = $ph_name;
        }

        public function setManufacturerID($mfr_id, &$errorInInput){
            if(!Validations::optionSelected($mfr_id)){
                $errorInInput .= " Please select manufacturer\n";
            }
            $this->manufacturer_id = $mfr_id;
        }

        public function setManufacturerName($mfr_name){
            $this->manufacturer_name = $mfr_name;
        }

        public function getPhoneID(){
            return $this->phone_id;
        }

        public function getPhoneName(){
            return $this->phone_name;
        }

        public function getManufacturerID(){
            return $this->manufacturer_id;
        }

        public function getManufacturerName(){
            return $this->manufacturer_name;
        }

        public function jsonSerialize() {
            return  [
                        'phone_id' => $this->getPhoneID(),
                        'phone_name' => $this->getPhoneName(),
                        'manufacturer_id' => $this->getManufacturerID(),
                        'manufacturer_name' => $this->getManufacturerName()
                    ];
        }
    }

?>
