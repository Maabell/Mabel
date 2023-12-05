<?php
require_once '../config/database.php';
require_once '../config/config.php';
require_once '../header.php';


if(!isset($_SESSION['user_type'])) {
    header('Location: ../index.php');
    exit;
}

if($_SESSION['user_type'] != 'admin') {
    header('Location: ../../index.php');
    exit;
}

$db = new Database();
$con = $db->conectar();

$nombre = $_POST['nombre'];
$descripcion = $_POST['descripcion'];
$precio = $_POST['precio'];
$descuento = $_POST['descuento'];
$stock = $_POST['stock'];
$categorias = $_POST['categoria'];

$sql = "INSERT INTO productos (nombre, descripcion, precio, descuento, stock, id_categoria, activo) VALUES (?,?,?,?,?,?,1)" ;
$stm = $con->prepare($sql);
if($stm->execute([$nombre, $descripcion, $precio, $descuento, $stock, $categorias])) {
    $id = $con->lastInsertId();
}

//header('Location: index.php');

