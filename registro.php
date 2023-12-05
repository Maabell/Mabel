<?php
require_once 'config/config.php';
require_once 'config/database.php';
require_once 'clases/clienteFunciones.php';
$db = new Database();
$con = $db->conectar();

$errors = [];

if (!empty($_POST)) {
    $nombres = trim($_POST['nombres']);
    $apellidos = trim($_POST['apellidos']);
    $email = trim($_POST['email']);
    $telefono = trim($_POST['telefono']);
    $cedula = trim($_POST['cedula']);
    $usuario = trim($_POST['usuario']);
    $password = trim($_POST['password']);
    $repassword = trim($_POST['repassword']);

    if (esNulo([$nombres, $apellidos, $email, $telefono, $cedula, $usuario, $password, $repassword])) {
        $errors[] = "Debe llenar todos los campos";
    }

    if (!esEmail($email)) {
        $errors[] = "La dirrecion de correo no es valida";
    }

    if (!validaPassword($password, $repassword)) {
        $errors[] = "Las contraseñas no coinciden";
    }

    if (usuarioExiste($usuario, $con)) {
        $errors[] = "El nombre de usuario $usuario ya existe";
    }

    if (emailExiste($email, $con)) {
        $errors[] = "El correo electrónico $email ya existe";
    }

    if (count($errors) == 0) {

        $id = registraCliente([$nombres, $apellidos, $email, $telefono, $cedula], $con);

        if ($id > 0) {

            require_once 'clases/Mailer.php';
            $mailer = new Mailer();
            $token = generarToken();


            $pass_hast = password_hash($password, PASSWORD_DEFAULT);

            $idUsuario = registraUsuario([$usuario, $pass_hast, $token, $id], $con);
            if ($idUsuario > 0) {

                $url = SITE_URL . '/activa_cliente.php?id=' . $idUsuario . '&token=' . $token;
                $asunto = "Activar cuenta - Tienda Online";
                $cuerpo = "Estimado $nombres: <br> Para continuar con el preceso de registro es indispensable de click en el siguiente liga <a href='$url'>Activar cuenta</a>";

                if ($mailer->enviarEmail($email, $asunto, $cuerpo)) {
                    echo "Para terminar el proceso de registro siga las instrucciones que le hemos enviado a la direccion de correo electronico $email";

                    exit;
                }
            } else {
                $errors[] = "Error al registrar usuario ";
            }
        } else {
            $errors[] = "Error al registrar cliente";
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

    <main>
        <div class="container">
            <h2>Datos del Cliente</h2>

            <?php mostarMensajes($errors); ?>

            <form class="row g-3" action="registro.php" method="post" autocomplete="off">
                <div class="col-md-6">
                    <label for="nombres"><span class="text-danger">*</span> Nombres</label>
                    <input type="text" name="nombres" id="nombres" class="form-control">
                </div>

                <div class="col-md-6">
                    <label for="apellidos"><span class="text-danger">*</span> Apellidos</label>
                    <input type="text" name="apellidos" id="apellidos" class="form-control">
                </div>

                <div class="col-md-6">
                    <label for="email"><span class="text-danger">*</span> Email</label>
                    <input type="email" name="email" id="email" class="form-control">
                    <span id="validaEmail" class="text-danger"></span>
                </div>

                <div class="col-md-6">
                    <label for="telefono"><span class="text-danger">*</span> Telefono</label>
                    <input type="tel" name="telefono" id="telefono" class="form-control">
                </div>

                <div class="col-md-6">
                    <label for="cedula"><span class="text-danger">*</span> Cedula</label>
                    <input type="text" name="cedula" id="cedula" class="form-control">
                </div>

                <div class="col-md-6">
                    <label for="usuario"><span class="text-danger">*</span> Usuario</label>
                    <input type="text" name="usuario" id="usuario" class="form-control">
                    <span id="validaUsuario" class="text-danger"></span>
                </div>

                <div class="col-md-6">
                    <label for="password"><span class="text-danger">*</span> Contraseña</label>
                    <input type="password" name="password" id="password" class="form-control">
                </div>

                <div class="col-md-6">
                    <label for="repassword"><span class="text-danger">*</span> Repetir Contraseña</label>
                    <input type="password" name="repassword" id="repassword" class="form-control">
                </div>

                <i><b>Nota:</b> Los campos con asterisco son obligatorios</i>

                <div class="col-12">
                    <button type="submit" class="btn btn-primary">Registrar</button>
                </div>
            </form>
        </div>
    </main>
    <script src="js/bootstrap.bundle.min.js"></script>

    <script>
        let txtUsuario = document.getElementById('usuario')
        txtUsuario.addEventListener("blur", function() {
            existeUsuario(txtUsuario.value)
        }, false)

        let txtEmail = document.getElementById('email')
        txtEmail.addEventListener("blur", function() {
            existeEmail(txtEmail.value)
        }, false)

        function existeUsuario(usuario) {
            let url = "clases/clienteAjax.php"
            let formData = new FormData()
            formData.append("action", "existeUsuario")
            formData.append("usuario", usuario)

            fetch(url, {
                    method: 'POST',
                    body: formData
                }).then(response => response.json())
                .then(data => {

                    if (data.ok) {
                        document.getElementById('usuario').value = ''
                        document.getElementById('validaUsuario').innerHTML = 'usuario no disponible'
                    } else {
                        document.getElementById('validaUsuario').innerHTML = ''
                    }
                })
        }

        function existeEmail(email) {
            let url = "clases/clienteAjax.php"
            let formData = new FormData()
            formData.append("action", "existeEmail")
            formData.append("email", email)

            fetch(url, {
                    method: 'POST',
                    body: formData
                }).then(response => response.json())
                .then(data => {

                    if (data.ok) {
                        document.getElementById('email').value = ''
                        document.getElementById('validaEmail').innerHTML = 'Email no disponible'
                    } else {
                        document.getElementById('validaEmail').innerHTML = ''
                    }
                })
        }
    </script>
</body>

</html>