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
    <title>listado de registros</title>

</head>
<body>
    <?php
        require_once dirname(__FILE__,3).'/php/config/menu.php';

    ?>
    <div class="container-md">
        <?php
            $saltolinea ="";
            $linea= "";
            $fichero = fopen("../datos.txt","r") or die ("Problema al abrir fichero");
            while (!feof($fichero)){
                $linea =fgets($fichero);
                $saltolinea = nl2br($linea);
                echo "<h4>".$saltolinea."</h4>";
                

            }
            fclose($fichero);
            echo "Datos guardados correctamente!!";
        ?>
    </div>
    
</body>
    <?php
        require_once dirname(__FILE__,3).'/php/config/footer.php';
       # echo dirname(__FILE__,2).<br>;
       # echo dirname(__FILE__).'/php/config/header.php';

    ?>
</html>