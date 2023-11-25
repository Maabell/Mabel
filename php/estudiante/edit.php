<?php
    require_once('estudianteModel.php');
    $object = new estudianteModel();
    $idEstudiante= $_GET['id'];
    $estudiante = $object->buscar($idEstudiante);
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
        <h2>Editando registro</h2>
        </div>
        <form id="formPersona" action="update.php" method="post">
            <div class="mb-3">
                <label for="id" class="form-label">ID Est.</label>
                <input value="<?=$estudiante[0]?>" type="text" class="form-control" id="id" name="id" readonly>
            </div>
            <div class="mb-3">
                <label for="nombre" class="form-label">Nombre</label>
                <input value="<?=$estudiante[1]?>" type="text" class="form-control" id="nombre" name="nombre" autofocus require>
            </div>
            <div class="mb-3">
                <label for="apellido" class="form-label">Apellido</label>
                <input value="<?=$estudiante[2]?>" type="text" class="form-control" id="apellido" name="apellido" require>
            </div>
            <div class="mb-3">
                <label for="Codigocurso" class="form-label">Codigo Curso</label>
                <select class="form-control" name="codigocurso" id="codigocurso">
                    <option value="0">No especificado</option>
                    <?php $cursos = array('1'=>'VUE', '2'=>'RUBY','3'=>'PHP',);
                        foreach ($cursos as $k => $v ){?>
                            <option value="<?=$k?>" <?php if ($v==$estudiante[4]){?> selected="selected"<?php }?>><?=$v?> </option>
                        <?php } ?>
                        
                </select> 
            </div>
            <button type="submit" class="btn btn-primary">Actualizar</button>
            </form>
        </div>
</body>
<script src="../../js/bootstrap.bundle.min.js"></script>
<script src="../../js/jquery.min.js"></script>
</html>