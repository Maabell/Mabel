<?php
    require_once('estudianteModel.php');
    $object = new estudianteModel();

    $idEstudiante = $_REQUEST['id'];
    $object->eliminar($idEstudiante);

    header('location: index.php');
?>