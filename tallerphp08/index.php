<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <title>Document</title>
</head>
    <div class="container">
    <form id="formPersona" action="php/estudiante/store.php" method="post">
  <div class="mb-3">
    <label for="nombre" class="form-label">Nombre</label>
    <input type="text" class="form-control" id="nombre" name="nombre">
  </div>
  <div class="mb-3">
    <label for="apellido" class="form-label" >Apellido</label>
    <input type="text" class="form-control" id="apellido" name="apellido">
  </div>
  <div class="mb-3">
    <label class="codigocurso" for="exampleCheck1">Codigo Curso</label>
    <select class="form-control" name="codigocurso" id="codigocurso">
        <option value="0">No especificado</option>
        <option value="1">Programacion WEB</option>
        <option value="2">Programacion RUBY</option>
        <option value="3">Programacion PHP</option>
    </select>
  </div>
  <button type="submit" class="btn btn-primary">Guardar</button>
</form>
    </div>
</body>
<script src="js/bootstrap.bundle.min.js"></script>
<script src="js/jquery.min.js"></script>
</html>