<?php
    class dataConex {
        private $hostname = "localhost";
        private $dbname = "base23";
        private $username= "root";
        private $password= "Pass.1234567";

        public function conexion(){
            try{
                $PDO = new PDO("mysql:host=".$this->hostname.";dbname=".$this->dbname,$this->username,$this->password);
                return $PDO;

            }catch (PDOException $ex){
                return $ex-getMenssage();

            }

        }
    }

?>