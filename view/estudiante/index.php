<?php
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);
    include_once($_SERVER['DOCUMENT_ROOT'].'/tallerphp15/routes.php');
    require_once(CONTROLLER_PATH.'estudianteController.php');
    $object = new estudianteController();
    $rows = $object->select();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Estudiante</title>
    <link rel="stylesheet" href="../../assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="../../assets/css/table.css">
</head>
<body>
    <?php
      require_once(VIEW_PATH.'navbar/navbar.php');
    ?>
    <section class="intro">
        <div class="container">
            <div class="mb-3"></div>
            <div class="mb-3">
                <a href="create.php" class="btn btn-primary">Agregar</a>
                <a href="javascript:imprimirWindow('ventana')" class="btn btn-info">Imprimir</a>
            </div> <span id="loader"></span>
        <div id="resultado" class="table-responsive table-scroll" data-mdb-perfect-scrollbar="true" style="position: relative; height:700px;">
            
        </div>
    </div>
</section>
<!-- div area impresion -->
        <div class="container" id="ventana" style="display: none;">
            <div class="mb-3">
                <h2 style="font-size: 3.00rem;">Listado de Estudiantes</h2>
        </div>
        <div class="table-reponsive table-scroll" data-mdb-perfect-scrollbar="true" style="position: relative; height :700px;">
            <table class="table table-striped mb-0" style="font-size: 2.00rem;">
                <thead>
                    <tr>
                        <th scope="col" colspan="1" >ID</th>
                        <th scope="col" colspan="3" >NOMBRE</th>
                        <th scope="col" colspan="3" >APELLIDO</th>
                        <th scope="col" colspan="3" >CURSOS</th>
                    </tr>
            </thead>
            <tbody>
                    <?php foreach ($rows as $row) { ?>
                        <tr>
                            <td colspan="1"><?=$row['idEstudiante']?></td>
                            <td colspan="3"><?=$row['nombre']?></td>
                            <td colspan="3"><?=$row['apellido']?></td>
                            <td colspan="3"><?=$row['cursos']?></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
        <!-- fin area de impresion -->
</body>
<script src="../../assets/js/bootstrap.bundle.min.js"></script>
<script src="../../assets/js/jquery.min.js"></script>
<script src="../../assets/js/print.window.js"></script>
<script src="../../assets/js/estudiante.js"></script>
</html>