<?php
    include_once($_SERVER['DOCUMENT_ROOT'].'/tallerphp15/routes.php');
    require_once(CONTROLLER_PATH.'estudianteController.php');
    $object = new estudianteController();

    $nombre = $_REQUEST['nombre'];
    $apellido = $_REQUEST['apellido'];
    $idCurso = $_REQUEST['idCurso'];
    
    $registro = $object->insert($nombre,$apellido,$idCurso);
?>