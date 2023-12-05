<?php
require_once 'config/config.php';
require_once 'config/database.php';
require_once 'clases/clienteFunciones.php';
$db = new Database();
$con = $db->conectar();

$errors = [];

if (!empty($_POST)) {
    $email = trim($_POST['email']);

    if (esNulo([$email])) {
        $errors[] = "Debe llenar todos los campos";
    }

    if (!esEmail($email)) {
        $errors[] = "La dirrecion de correo no es valida";
    }
    if (count($errors) == 0) {
        if (emailExiste($email, $con)) {
            $sql = $con->prepare("SELECT usuarios.id, clientes.nombres FROM usuarios INNER JOIN clientes ON usuarios.id_cliente=clientes.id WHERE clientes.email LIKE ? LIMIT 1");
            $sql->execute([$email]);
            $row = $sql->fetch(PDO::FETCH_ASSOC);
            $user_id = $row["id"];
            $nombres = $row["nombres"];

            $token = solicitaPassword($user_id, $con);
            if ($token !== null) {
                require_once 'clases/Mailer.php';
                $mailer = new Mailer();

                $url = SITE_URL . '/reset_password.php?id=' . $user_id . '&token=' . $token;

                $asunto = "Recuperar password - Tienda Online";
                $cuerpo = "Estimado $nombres: <br> Si has solicitado el cambio de tu contraseña da clic en el siguiente link <a href='$url'>$url</a>.";
                $cuerpo .= "<br> Si no hiciste esta solicitud puedes ingnorar este correo.";
                if ($mailer->enviarEmail($email, $asunto, $cuerpo)) {
                    echo "<p><br>Correo enviado </br></p>";
                    echo "<p>Hemos enviado un correo electrónico a este email $email para restablecer la contraseña.</p>";

                    exit;
                }
            }
        } else {
            $errors[] = "No existe una cuenta asociada a esta direccion de correo.";
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
            <h3>Recuperar Contraseña</h3>
            <?php mostarMensajes($errors); ?>

            <form action="recupera.php" method="post" class="row g-3" autocomplete="off">
                <div class="form-floating">
                    <input class="form-control" type="email" name="email" id="email" placeholder="Correo electrónico" required>
                    <label for="email">Correo eletrónico</label>
                </div>
                <div class="d-grid gap-3 col-12">
                    <button type="submit" class="btn btn-primary">Continuar</button>
                </div>
                <div class="col-12">
                    ¿No tienes cuenta? <a href="registro.php">Registrate aqui</a>
                </div>
            </form>
        </div>

    </main>
    <script src="js/bootstrap.bundle.min.js"></script>
</body>

</html>