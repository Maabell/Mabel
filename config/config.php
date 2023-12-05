<?php

    $path = dirname(__FILE__);

    require_once $path. '/database.php';
    require_once $path.'/../admin/clases/cifrado.php';

    $db = new Database();
    $con = $db->conectar();
    
    $sql = "SELECT nombre, valor FROM configuracion";
    $resultado = $con->query($sql);
    $datos = $resultado->fetchAll(PDO:: FETCH_ASSOC);
    
    $config = [];
    
    foreach ($datos as $dato) {
        $config[$dato['nombre']] = $dato['valor'];
    }

    define("SITE_URL","http://localhost:8080/tienda_online");
    define("KEY_TOKEN", "APR.wqc-354*fdfsdfdsf");
    define("MAIL_HOST",$config['corre_smtp']);
    define("MAIL_USER",$config['correo_email']);
    define("MAIL_PASS",descifrar($config['correo_password']));
    define("MAIL_PORT",$config['correo_puerto']);
    define("MONEDA", "₲");
    define("MONEDA_PAYPAL", "USD");
    define("CLIENT_ID","AVYkPWJf3YIQfMTzx11BgB5PLjtwAWQts2lxNNzSL2oLZW1k5VRwm66jwAGnU61aGHhn17fCGv1CoYmw");
    //"dgfa jnej ebnu weob"

    session_start();

    $num_cart = 0;
    if(isset($_SESSION['carrito']['productos'])) {
        $num_cart = count($_SESSION['carrito']['productos']);
    }

?>