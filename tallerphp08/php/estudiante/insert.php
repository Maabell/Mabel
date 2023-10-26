<?php
    class DataInsert{
        private $PDO,
        public function__construct(){
            require_once ('../database.php');
            $data = new dataConex();
            $this->PDO = $data->conexion();


        }
        public function insertar($nombre,$apellido,$codigocurso){
            $sql = 'INSERT INTO estudiantes VALUES(0,:nombre,:apellido,:codigocurso)';
            $statement = $this->PDO->prepare($sql);
            $statement->bindParam(':nombre',$nombre);
            $statement->bindParam(':apellido',$apellido);
            $statement->bindParam(':codigocurso',$codigocurso);
            $statement->execute();
            return ($this->PDO->lastInsertId());
        }
    }

?>