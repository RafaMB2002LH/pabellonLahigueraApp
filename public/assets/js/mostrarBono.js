$(document).ready(function () {
    // Simulación de datos del bono
    var bono = {
        tipo: 'Bono Simple',
        precio: 100,
        diasTotales: 10
    };

    // Simulación de datos del usuario
    var usuario = {
        nombre: 'Juan',
        apellidos: 'Pérez'
    };

    // Actualizar los elementos HTML con los datos del bono y usuario
    $('#nombreUsuario').text(usuario.nombre + ' ' + usuario.apellidos);
    $('#tipoBono').text(bono.tipo);
    $('#precioBono').text(bono.precio);
    $('#diasTotales').text(bono.diasTotales);
});
