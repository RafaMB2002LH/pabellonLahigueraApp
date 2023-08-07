$(document).ready(function () {
    $('.cuadrado').click(function () {
        var cuadrado = $(this);
        if (!cuadrado.hasClass('tachado')) {
            var bonoId = $('.card-header').attr('id');
            var data = {
                bonoId: bonoId
            }
            // Realiza una solicitud AJAX al servidor
            $.ajax({
                url: '/tacharDia', // La URL de tu controlador para crear un nuevo DiaTachado
                method: 'POST',
                data: JSON.stringify(data),
                success: function (response) {
                    cuadrado.addClass('tachado');
                    navigator.vibrate(100);
                },
                error: function (xhr, status, error) {
                    // Maneja los errores de la solicitud AJAX
                    console.error('Error al crear un nuevo DiaTachado:', error);
                }
            });
        }
    });
});