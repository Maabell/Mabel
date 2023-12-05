<?php
require_once 'config/config.php';
require_once 'config/database.php';
require_once 'clases/clienteFunciones.php';

$user_id = $_GET['id'] ?? $_POST['user_id'] ?? '';
$token = $_GET['token'] ?? $_POST['token'] ?? '';

if ($user_id == '' || $token == '') {
    header("Location: index.php");
    exit;
}

$db = new Database();
$con = $db->conectar();

$errors = [];

if (!verificaTokenRequest($user_id, $token, $con)) {
    echo "No se pudo verificar la informacion";
    exit;
}

if (!empty($_POST)) {
    $password = trim($_POST['password']);
    $repassword = trim($_POST['repassword']);

    if (esNulo([$user_id, $token, $password, $repassword])) {
        $errors[] = "Debe llenar todos los campos";
    }

    if (!validaPassword($password, $repassword)) {
        $errors[] = "Las contraseñas no coinciden";
    }
    if (count($errors) == 0) {
        $pass_hast = password_hash($password, PASSWORD_DEFAULT);
        if (actualizarPassword($user_id, $pass_hast, $con)) {
            echo "Contraseña Modificada.<br><a href='login.php'>Iniciar sesión</a>";
            exit;
        } else {
            $errors[] = "Error al modificar contraseña. Intentalo nuevamente.";
        }
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
        <div class="container">
            <h3>Cambiar Contraseña</h3>
            <?php mostarMensajes($errors); ?>

            <form action="reset_password.php" method="post" class="row g-3" autocomplete="off">

                <input type="hidden" name="user_id" id="user_id" value="<?= $user_id; ?>" />
                <input type="hidden" name="token" id="token" value="<?= $token; ?>" />
                <div class="form-floating">
                    <input class="form-control" type="password" name="password" id="password" placeholder="Nueva Contraseña" required>
                    <label for="password">Nueva Contraseña</label>
                </div>

                <div class="form-floating">
                    <input class="form-control" type="password" name="repassword" id="repassword" placeholder="Confirmar Contraseña" required>
                    <label for="repassword">Confirmar Contraseña</label>
                </div>

                <div class="d-grid gap-3 col-12">
                    <button type="submit" class="btn btn-primary">Continuar</button>
                </div>
                <div class="col-12">
                    <a href="login.php">Inicar sesión</a>
                </div>
            </form>
        </div>

    </main>
    <script src="js/bootstrap.bundle.min.js"></script>
</body>

</html>