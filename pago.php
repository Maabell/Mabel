<?php
require_once 'config/config.php';
require_once 'config/database.php';
$db = new Database();
$con = $db->conectar();

$productos = isset($_SESSION['carrito']['productos']) ? $_SESSION['carrito']['productos'] : null;

$lista_carrito = array();

if ($productos != null) {
    foreach ($productos as $clave => $cantidad) {
        $sql = $con->prepare("SELECT id, nombre, precio, descuento , $cantidad  AS cantidad FROM productos WHERE id=? AND activo=1");
        $sql->execute([$clave]);
        $lista_carrito[] = $sql->fetch(PDO::FETCH_ASSOC);
    }
} else {
    header("Location: index.php");
    exit;
}

?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tienda Online</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/estilos.css">
    <link rel="stylesheet" href="css/all.min.css">
</head>

<body>
    <?php include 'menu.php'; ?>

    <main>
        <div class="container">
            <div class="row">
                <div class="col-6">
                    <h4>Detalles del Pago</h4>
                    <div id="paypal-button-container"></div>
                </div>
                <div class="col-6">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Producto</th>
                                    <th>Subtotal</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if ($lista_carrito == null) {
                                    echo '<tr><td colspan="5" class="text-center"><b>Lista vacia</b></td></tr>';
                                } else {
                                    $total = 0;
                                    foreach ($lista_carrito as $productos) {
                                        $_id = $productos['id'];
                                        $nombre = $productos['nombre'];
                                        $precio = $productos['precio'];
                                        $descuento = $productos['descuento'];
                                        $cantidad = $productos['cantidad'];
                                        $precio_desc = $precio - (($precio * $descuento) / 100);
                                        $subtotal = $cantidad * $precio_desc;
                                        $total += $subtotal;
                                ?>
                                        <tr>
                                            <td>
                                                <?php echo $nombre; ?>
                                            </td>
                                            <td>
                                                <div id="subtotal_<?php echo $_id; ?>" name="subtotal[]">
                                                    <?php echo MONEDA . number_format($subtotal, 0, ',', '.'); ?>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php } ?>

                                    <tr>
                                        <td colspan="2">
                                            <p class="h3 text-end" id="total">
                                                <?php echo MONEDA . number_format($total, 0, ',', '.'); ?>
                                            </p>
                                        </td>
                                    </tr>
                            </tbody>
                        <?php } ?>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <script src="js/bootstrap.bundle.min.js"></script>
    <script src="https://www.paypal.com/sdk/js?client-id=<?php echo CLIENT_ID;?>&currency=<?php echo MONEDA_PAYPAL;?>"></script>

   <script>
    paypal.Buttons({
        style: {
            color: 'blue',
            shape: 'pill',
            label: 'pay'
        },
        createOrder:function(data, actions) {
            return actions.order.create({
                purchase_units: [{
                    amount: {
                        value: <?php echo $total; ?>
                    }
                }]
            });
        },
        onApprove:function(data, actions) {
            let URL = 'clases/captura.php'
            actions.order.capture().then(function (detalles) {
                console.log(detalles)
                let url = 'clases/captura.php'
                return fetch(url, {
                    method : 'post',
                    headers: {
                        'content-type': 'aplication/json'
                    },
                    body: JSON.stringify({
                        detalles:detalles
                    })
                })/* .then(function(response) {
                    window.location.href= "completado.php";
                }) */
            });
        },
        onCancel:function(data) {
            alert("Pago cancelado");
            consolo.log(data);
        }
    }).render('#paypal-button-container');
   </script>
</body>

</html>