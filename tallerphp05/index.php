<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Arreglos</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <?php
            $nombres[]="JUAN";
            $nombres[]="GLADYS";
            $nombres[]="JULIAN";
            $nombres[]="MANUEL";
            $nombres[]="LUCAS";
            //listar
            for($indice=0; $indice < count($nombres); $indice++){  
                echo "Nombre:" . $nombres[$indice]. "<br>";
            }
        ?>
            <table class ="table">
                <thead>
                    <th>Nombres</th>
                </thead>
                <tbody>
                    <?php
                        for ($i=0; $i < count($nombres); $i++) { ?>
                                 <tr><td><?=$nombres[$i];?></td></tr>
                            <?php
                             } ?>

                </tbody>
            </table>
            <table class ="table">
                <thead>
                    <th>Formas de pago</th>
                </thead>
                <tbody>
                    <?php
                    $fpagos = array("Efectivo", "Tarjeta", "Transferencia", "Paypal");
                        for ($i=0; $i < count($fpagos); $i++) { ?>
                             <tr><td><?=$fpagos[$i];?></td></tr>
                            <?php
                             } ?>

                </tbody>
            </table>

    </div>
    
</body>
<script src="js/bootstrap.bundle.min.js"></script>
<script src="js/jquery.min.js"></script>
</html>