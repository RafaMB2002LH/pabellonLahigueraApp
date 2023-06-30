$(document).ready(function () {
    var totalDays = 10;
    var daysLeft = totalDays;
    var isDoubleBono = false;

    updateBonoType();

    $('#mark-day-btn').click(function () {
        if (daysLeft > 0) {
            daysLeft--;
            $('#days-left').text('Días Restantes: ' + daysLeft);
            $('#day-' + (totalDays - daysLeft)).addClass('day-marked');
            if (daysLeft === 0) {
                if (isDoubleBono) {
                    // Cambiar al bono simple después de completar el bono doble
                    $('#mark-day-btn').attr('disabled', 'disabled');
                    $('#days-left').text('Bono Simple - 10 Días');
                    setTimeout(function () {
                        $('#mark-day-btn').removeAttr('disabled');
                        daysLeft = totalDays;
                        isDoubleBono = false;
                        updateBonoType();
                        $('#days-left').text('Días Restantes: ' + daysLeft);
                        resetDayMarks();
                    }, 3000); // Tiempo de espera antes de cambiar al bono simple (3 segundos en este caso)
                } else {
                    // Cambiar al bono doble después de completar el bono simple
                    $('#mark-day-btn').attr('disabled', 'disabled');
                    $('#days-left').text('Bono Doble - 20 Días');
                    setTimeout(function () {
                        $('#mark-day-btn').removeAttr('disabled');
                        daysLeft = 2 * totalDays;
                        isDoubleBono = true;
                        updateBonoType();
                        $('#days-left').text('Días Restantes: ' + daysLeft);
                        resetDayMarks();
                        addExtraDayMarkers(totalDays);
                    }, 3000); // Tiempo de espera antes de cambiar al bono doble (3 segundos en este caso)
                }
            }
        }
    });

    function updateBonoType() {
        var bonoType = isDoubleBono ? 'Bono Doble' : 'Bono Simple';
        $('.card-title').text('Cliente: Juan Pérez - ' + bonoType);
    }

    function resetDayMarks() {
        $('.day-marker').removeClass('day-marked');
    }

    function addExtraDayMarkers(totalDays) {
        for (var i = 1; i <= totalDays; i++) {
            $('<div class="day-marker" id="day-' + (totalDays + i) + '"></div>').appendTo('.day-markers');
        }
    }
});
