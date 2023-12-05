<?php
require_once 'config/config.php';
require_once 'config/database.php';
require_once 'clases/clienteFunciones.php';
$db = new Database();
$con = $db->conectar();

$proceso = isset($_GET['pago'])  ? 'pago' : 'login';

$errors = [];

if (!empty($_POST)) {

    $usuario = trim($_POST['usuario']);
    $password = trim($_POST['password']);
    $proceso = $_POST['proceso'] ??  'login';


    if (esNulo([$usuario, $password])) {
        $errors[] = "Debe llenar todos los campos";
    }

    if (count($errors) == 0) {
        $errors[] = login($usuario, $password, $con, $proceso);
    }
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
    <link href="css/font-awesome/css/font-awesome.min.css" rel="stylesheet">
</head>

<body>
    <header>
        <div class="navbar navbar-expand-lg navbar-dark bg-dark ">
            <div class="container">
                <a href="#" class="navbar-brand ">
                    <strong>Tienda en linea</strong>
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarHeader" aria-controls="navbarHeader" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarHeader">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a href="#" class="nav-link active">Catalogo</a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link ">Contacto</a>
                        </li>
                    </ul>
                    <a href="checkout.php" class="btn btn-primary">
                        Carrito <span id="num_cart" class="badge bg-secondary"><?php echo $num_cart; ?></span>
                    </a>
                </div>
            </div>
        </div>
    </header>

    <main class="form-login m-auto pt-4">
        <h2>Iniciar Sesión</h2>
        <?php mostarMensajes($errors); ?>

        <form class="row g-3" action="login.php" method="post" autocomplete="off">

        <input type="hidden" name="proceso" value="<?php echo $proceso;?>">
            <div class="form-floating">
                <input class="form-control" type="text" name="usuario" id="usuario" placeholder="Usuario" requiredaa>
                <label for="usuario">Usuario</label>
            </div>

            <div class="form-floating">
                <input class="form-control" type="password" name="password" id="password" placeholder="Contraseña" requiredaa>
                <label for="password">Contraseña</label>
            </div>

            <div class="col-12">
                <a href="recupera.php">¿Olvidaste tu contraseña?</a>
            </div>

            <div class="d-grid gap-3 col-12">
                <button type="submit" class="btn btn-primary">Ingresar</button>
            </div>
            <hr>

            <div class="col-12">
                ¿No tienes cuenta? <a href="registro.php">Registrate aqui</a>
            </div>
        </form>
    </main>
</body>
<script src="js/bootstrap.bundle.min.js"></script>
</html>