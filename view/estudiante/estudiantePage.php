<?php
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL); 
    include_once($_SERVER['DOCUMENT_ROOT'].'/tallerphp15/routes.php');
    require_once(CONTROLLER_PATH.'estudianteController.php');
    require_once(VIEW_PATH.'page/pagination.php');
    $object = new estudianteController();

    $page = (isset($_REQUEST['page']) && !empty($_REQUEST['page'])) ? $_REQUEST['page'] : 1;

    $per_page = 6;
    $adjacents = 3;
    $offset = ($page -1) * $per_page;
    $reload = 'index.php';

    $rows = $object->selectPage($offset,$per_page);
    $numfilas = $object->page();
    $numrows = $numfilas['numRows'];
    $total_pages = ceil($numrows / $per_page);  
?>

<table class="table table-striped mb-0">
    <thead style="background-color: #002d72;">
        <tr>
            <th scope="col">ID</th>
            <th scope="col">NOMBRE</th>
            <th scope="col">APELLIDO</th>
            <th scope="col">OPERACIONES</th>
        </tr>
    </thead>
    <tbody>
    <?php foreach ($rows as $row) { ?>
        <tr>
            <td><?= $row['idEstudiante'] ?></td>
            <td><?= $row['nombre'] ?></td>
            <td><?= $row['apellido'] ?></td>
        <td>
            <a class="btn btn-info" data-bs-toggle="modal" data-bs-target="#idver<?= $row['idEstudiante'] ?>">Ver</a>
            <a href="edit.php?id=<?= $row['idEstudiante'] ?>" class="btn btn-warning">Editar</a>
            <a class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#iddel<?= $row['idEstudiante'] ?>">Eliminar</a>
        </td>
        <!-- modal para ver y delete -->
        <?php 
        include ('viewModal.php');
        include ('deleteModal.php');          
        ?> 
    </tr>
    <?php } ?>
    <tr>
        <td colspan="7"><span class="float-right"><?php echo paginate($reload, $page, $total_pages, $adjacents);?></span> </td>
    </tr>
    </tbody>
</table>