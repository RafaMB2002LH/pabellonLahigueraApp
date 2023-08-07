$(document).ready(function () {
    var idBike = null;
    // Función para mostrar el modal de confirmación de reserva
    function showConfirmModal() {
        $('#modalConfirm').modal('show');
    }

    // Capturar el clic en una bicicleta disponible
    $('.bike-icon i.available').click(function () {
        idBike = $(this).data('id');
        showConfirmModal();
    });

    // Capturar el clic en una bicicleta reservada o averiada
    $('.bike-icon i.reserved, .bike-icon i.broken').click(function () {
        var bikeStatus = $(this).hasClass('reserved') ? 'reserved' : 'broken';

        // Mostrar mensaje de error para bicicleta reservada o averiada
        var errorMessage = (bikeStatus === 'reserved') ? 'No puedes reservar esta bicicleta porque ya tiene una reserva.' : 'No puedes reservar esta bicicleta porque está averiada.';
        showModalMessage(errorMessage);
    });

    // Capturar el clic en el botón "Sí" del modal de confirmación
    $('#btnReservar').click(function () {

        // Realizar la solicitud AJAX al servidor para reservar la bicicleta
        $.ajax({
            type: 'POST',
            url: '/reservar_bicicleta', // Ruta a tu controlador de Symfony
            data: {
                bikeId: idBike
            },
            success: function (response) {
                $(".bike-icon i[data-id='" + response.idBicicleta + "']").addClass("reserved");
            },
            error: function (error) {
                // Manejar errores
                console.log(error);
            }
        });

        // Cerrar el modal de confirmación
        $('#modalConfirm').modal('hide');
    });

    // Función para mostrar el modal con un mensaje
    function showModalMessage(message) {
        $('#modalText').text(message);
        $('#modalMessage').modal('show');
    }

    $('#btnNo').click(function () {
        // Cerrar el modal
        $('#modalConfirm').modal('hide');
    });

    $('#modalMessage .close').click(function () {
        // Cerrar el modal
        $('#modalMessage').modal('hide');
    });

    $('#modalConfirm .close').click(function () {
        // Cerrar el modal
        $('#modalConfirm').modal('hide');
    });
});
