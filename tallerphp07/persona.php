<?php
    class Persona{
        //atributos
        private $nombres;
        private $profesion;

        //contructor
        public function __construct($nom, $pro){
            $this->nombres = $nom;
            $this->profesion = $pro;
        }
        public function presentar(){
            echo "Hola, me llamo  ". $this->nombres;
            echo " y soy ". $this->profesion;
            echo " <br>";
        }
        public function getNombres(){
            return $this->nombres;
        
        }
        public function getProfesion(){
            return $this->profesion;
        
        }

    }
    



?>