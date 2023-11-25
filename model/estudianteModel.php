<?php
    class estudianteModel {
        private $PDO;

        public function __construct() {
            //require_once ('database.php');
            include_once($_SERVER['DOCUMENT_ROOT'].'/tallerphp15/routes.php');
            require_once(DAO_PATH.'database.php');
            $data = new dataConex();
            $this->PDO = $data->conexion();
        }

        public function insertar($nombre,$apellido,$idCurso) {
            $sql = 'INSERT INTO estudiantes VALUES (0,:nombre,:apellido,:idCurso)';
            $statement = $this->PDO->prepare($sql);
            $statement->bindParam(':nombre',$nombre);
            $statement->bindParam(':apellido',$apellido);
            $statement->bindParam(':idCurso',$idCurso);
            $statement->execute();
            return ($this->PDO->lastInsertId());
        }

        public function actualizar($idEstudiante,$nombre,$apellido,$idCurso) {
            $sql = 'UPDATE estudiantes SET nombre=:nombre,apellido=:apellido,idCurso=:idCurso WHERE idEstudiante= :idEstudiante';
            $statement = $this->PDO->prepare($sql);
            $statement->bindParam(':nombre',$nombre);
            $statement->bindParam(':apellido',$apellido);
            $statement->bindParam(':idCurso',$idCurso);
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
            $sql = 'SELECT e.idEstudiante,e.nombre,e.apellido,e.idCurso,c.nombre as curso FROM estudiantes e
            JOIN cursos c ON e.idCurso = c.idCurso ORDER BY idEstudiante DESC';
            $statement = $this->PDO->prepare($sql);
            return ($statement->execute()) ? $statement->fetchAll() : false; 
        }

        public function listarPage($offset,$per_page) {
            $sql = 'SELECT e.idEstudiante,e.nombre,e.apellido,e.idCurso,c.nombre as curso FROM estudiantes e
            JOIN cursos c ON e.idCurso = c.idCurso ORDER BY idEstudiante DESC LIMIT '.$offset.','.$per_page;
            $statement = $this->PDO->prepare($sql);
            return ($statement->execute()) ? $statement->fetchAll() : false; 
        }

        public function contar() {
            $sql = 'SELECT COUNT(*) as numRows FROM estudiantes';
            $statement = $this->PDO->prepare($sql);
            return ($statement->execute()) ? $statement->fetch() : false; 
        }

        public function cargarDesplegable() {
            $sql = 'SELECT idCurso,nombre FROM cursos ORDER BY idCurso ASC';
            $statement = $this->PDO->prepare($sql);
            return ($statement->execute()) ? $statement->fetchAll() : false; 
        }

        public function buscar($idEstudiante) {
            $sql = 'SELECT e.idEstudiante,e.nombre,e.apellido,e.idCurso,c.nombre as curso FROM estudiantes e
            JOIN cursos c ON e.idCurso = c.idCurso WHERE idEstudiante = :idEstudiante';
            $statement = $this->PDO->prepare($sql);
            $statement->bindParam(':idEstudiante', $idEstudiante);
            return ($statement->execute()) ? $statement->fetch() : false; 
        }
        
    }
?>