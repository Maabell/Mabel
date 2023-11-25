<?php
    class dataConex {
        private $hostname = "localhost";
        private $dbname = "base23";
        private $username = "root";
        private $password = "12345678";

        public function conexion() {
            try {
                $PDO = new PDO("mysql:host=".$this->hostname.";dbname=".$this->dbname,$this->username,$this->password);
                return $PDO;
            } catch (PDOException $ex) {
                return $ex->getMessage();
            }
        }
    }
?>