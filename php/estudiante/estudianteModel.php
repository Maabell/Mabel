<?php
    class estudianteModel {
        private $PDO;

        public function __construct() {
            require_once ('../database.php');
            $data = new dataConex();
            $this->PDO = $data->conexion();
        }

        public function insertar($nombre,$apellido,$codigocurso) {
            $sql = 'INSERT INTO estudiantes VALUES (0,:nombre,:apellido,:codigocurso)';
            $statement = $this->PDO->prepare($sql);
            $statement->bindParam(':nombre',$nombre);
            $statement->bindParam(':apellido',$apellido);
            $statement->bindParam(':codigocurso',$codigocurso);
            $statement->execute();
            return ($this->PDO->lastInsertId());
        }

        public function actualizar($idEstudiante,$nombre,$apellido,$codigocurso) {
            $sql = 'UPDATE estudiantes SET nombre=:nombre,apellido=:apellido,codigocurso=:codigocurso WHERE idEstudiante= :idEstudiante';
            $statement = $this->PDO->prepare($sql);
            $statement->bindParam(':nombre',$nombre);
            $statement->bindParam(':apellido',$apellido);
            $statement->bindParam(':codigocurso',$codigocurso);
            $statement->bindParam(':idEstudiante',$idEstudiante);
            return ($statement->execute()) ? true : false;
        }

        public function eliminar($idEstudiante) {
            $sql = 'DELETE FROM estudiantes WHERE idEstudiante = :idEstudiante';
            $statement = $this->PDO->prepare($sql);
            $statement->bindParam(':idEstudiante',$idEstudiante);
            return ($statement->execute()) ? true : false;
        }

        public function listar() {
            $sql = 'SELECT idEstudiante,nombre,apellido,codigoCurso, if(codigoCurso=0,"No especificado", if(codigoCurso=1,"VUE",if(codigoCurso=2,"RUBY","PHP"))) as curso FROM estudiantes ORDER BY idEstudiante DESC';
            $statement = $this->PDO->prepare($sql);
            return ($statement->execute()) ? $statement->fetchAll() : false; 
        }

        public function buscar($idEstudiante) {
            $sql = 'SELECT idEstudiante,nombre,apellido,codigoCurso, if(codigoCurso=1,"VUE",if(codigoCurso=2,"RUBY","PHP")) as curso FROM estudiantes WHERE idEstudiante = :idEstudiante';
            $statement = $this->PDO->prepare($sql);
            $statement->bindParam(':idEstudiante', $idEstudiante);
            return ($statement->execute()) ?$statement->fetch() : false; 
        }
        
    }
?>