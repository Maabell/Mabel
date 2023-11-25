<?php
    include_once($_SERVER['DOCUMENT_ROOT'].'/tallerphp15/routes.php');
    require_once(CONTROLLER_PATH.'estudianteController.php');
    $object = new estudianteController();
    $cursos = $object->combolist();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Taller 08</title>
    <link rel="stylesheet" href="../../assets/css/bootstrap.min.css">
</head>
<body>
    <?php
      require_once(VIEW_PATH.'navbar/navbar.php');
    ?>
    <div class="container">
        <div class="mb-3">
        <h2>Agregando nuevo registro</h2>
        </div>
        <form id="formPersona" action="store.php" method="post" class="g-3 needs-validation" novalidate>
            <div class="mb-3">
                <label for="nombre" class="form-label">Nombre</label>
                <input type="text" class="form-control" id="nombre" name="nombre" autofocus required>
                <div class="invalid-feedback">Ingrese un nombre valido</div>
            </div>
            <div class="mb-3">
                <label for="apellido" class="form-label">Apellido</label>
                <input type="text" class="form-control" id="apellido" name="apellido" required>
                <div class="invalid-feedback">Ingrese un apellido valido</div>
            </div>
            <div class="mb-3">
                <label for="idCurso" class="form-label">Codigo Curso</label>
                <select class="form-control" name="idCurso" id="idCurso" required>
                    <option selected disabled value="">No especificado</option>
                    <?php foreach ($cursos as $curso) { ?>
                        <option value="<?=$curso['idCurso']?>"><?=$curso['nombre']?></option>
                    <?php } ?>
                </select>
                <div class="invalid-feedback">Ingrese un elemento valido</div>
            </div>
            <button type="submit" class="btn btn-primary btn-lg col-3">Guardar</button>
            </form>
        </div>
</body>
<script src="../../assets/js/bootstrap.bundle.min.js"></script>
<script src="../../assets/js/jquery.min.js"></script>
<script src="../../assets/js/validate.js"></script>
</html>