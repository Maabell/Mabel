<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TALLER 07</title>
</head>
<body>
    <?php
        include_once ('persona.php');
        $persona1 = new Persona ('Juan Pérez', 'Profesor');
        $persona2 = new Persona ('Lucas Eliezer', 'Piloto');
        $persona3 = new Persona ('Gladys Mabel', 'Inge');

        $persona1->presentar();
        $persona2->presentar();
        $persona3->presentar();
        echo "<br> Nombre1: ".$pernona1->getNombres();
        echo "<br> Nombre2: ".$pernona2->getNombres();
        echo "<br> Nombre3: ".$pernona3->getNombres();
        var_dump($persona1);
        var_dump($persona2);
        var_dump($persona3);



    ?>
    
</body>
</html>