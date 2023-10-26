<?php
    require_once('insert.php');
    $objet = new DataInsert();
    $nombre = $_REQUEST['nombre'];
    $apellido = $_REQUEST['apellido'];
    $codigocurso = $_REQUEST['codigocurso'];
    $objet->insertar($nombre,$apellido,$codigocurso);

?>