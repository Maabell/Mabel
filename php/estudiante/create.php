<?php
    require_once('estudianteModel.php');
    $object = new estudianteModel();
    $cursos = $object->carcarDesplegable();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Taller 08</title>
    <link rel="stylesheet" href="../../css/bootstrap.min.css">
</head>
<body>
    <?php
      require_once('../navbar.php');
    ?>
    <div class="container">
        <div class="mb-3">
        <h2>Agregando nuevo registro</h2>
        </div>
        <form id="formPersona" action="store.php" method="post">
            <div class="mb-3">
                <label for="nombre" class="form-label">Nombre</label>
                <input type="text" class="form-control" id="nombre" name="nombre" autofocus require>
            </div>
            <div class="mb-3">
                <label for="apellido" class="form-label">Apellido</label>
                <input type="text" class="form-control" id="apellido" name="apellido" require>
            </div>
            <div class="mb-3">
                <label for="idCurso" class="form-label">Codigo Curso</label>
                <select class="form-control" name="idCurso" id="idCurso">
                    <option value="0">No especificado</option>
                    <?php foreach ($cursos as $curso) {?>
                        <option value="<?=$curso['idCurso']?>"><?=$curso['nombre']?></option>

                    <?php } ?>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Guardar</button>
            </form>
        </div>
</body>
<script src="../../js/bootstrap.bundle.min.js"></script>
<script src="../../js/jquery.min.js"></script>

</html>