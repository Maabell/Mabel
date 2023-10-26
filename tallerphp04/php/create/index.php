<?php
    error_reporting(E_ALL);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <?php
        require_once dirname(__FILE__,3).'/php/config/header.php';
       # echo dirname(__FILE__,2).<br>;
       # echo dirname(__FILE__).'/php/config/header.php';

    ?>
    <title>Creando reguistros</title>
    

</head>
<body>
    <?php
        require_once dirname(__FILE__,3).'/php/config/menu.php';

    ?>
    <div class="container-md">
        <h2>Index de creacion</h2>
        <form action="create.php" method="post" id="">
        <div class="mb-3">
            <label for="nombre" class="form-label">nombre</label>
            <input type="text" class="form-control" name="nombre" id="nombre" placeholder="Ingrese el nombre: " required autofocus>
        </div>
        <div class="mb-3">
            <label for="apellido" class="form-label">Apellido</label>
            <input type="text" class="form-control" name="apellido"id="apellido" placeholder="Ingrese el apellido:" required>
        </div>
        <div class="mb-3">
            <label for="telefono" class="form-label">Teléfono</label>
            <input type="tel" class="form-control" name="telefono"id="telefono" placeholder="Ingrese el nro telefono:" required>
        </div>
        <div class="mb-3">
            <label for="cedula" class="form-label">Cédula</label>
            <input type="number" class="form-control" name="cedula"id="cedula" placeholder="Ingrese el nro cedula:" required>
        </div>
        <div class="mb-3">
            <input class="btn btn-primary" type="submit" value="Guardar">
        </div>


    </form>

    </div>
    
</body>
    <?php
        require_once dirname(__FILE__,3).'/php/config/footer.php';
       # echo dirname(__FILE__,2).<br>;
       # echo dirname(__FILE__).'/php/config/header.php';

    ?>
</html>