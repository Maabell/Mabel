$(document).ready(function () {
    load(1); 
});

function load(page) {
    var url = 'estudiantePage.php';
    $('#loader').fadeIn('slow');
    var params = {
        'action': 'ajax',
        'page': page
    };

    $.ajax({
        url: url,
        data: params,
        beforeSend: function ( ) {
            $('#loader').html('<img width="5%" heigth="5%" src="../../assets/images/loader.gif" alt="Cargando...">');
        },
        success: function (data) {
            $('#loader').html('');
            $('#resultado').html(data).fadeIn('slow');
        }
    });
}