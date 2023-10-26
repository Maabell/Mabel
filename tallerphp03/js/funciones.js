jQuery("#Calcular").click(function () {
    var numero =jQuery("#numero").val();
    //console.log(numero); para imprimir.. y saber lo que tiene que valer
    var params = {"numerofactorial" : numero};

    //ajax
    $.ajax({
        data: params,
        url:'ajax/factorial.php',
        dataType:'html',
        type:'post',
        beforeSend: function () {
            jQuery("#resultado").hide();
            jQuery("#cargando").show();
        },
        success: function (response) {
            jQuery("#resultado").show();
            jQuery("#cargando").hide();
            jQuery("#resultado").html(response);
        }


    });
});