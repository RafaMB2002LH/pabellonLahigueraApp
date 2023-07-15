$(document).ready(function () {
    $("#buscar").on("keyup", function () {
        var valor = $(this).val().toLowerCase();
        $("table tbody tr").filter(function () {
            $(this).toggle($(this).text().toLowerCase().indexOf(valor) > -1);
        });
    });

    $('.btn-bono').click(function () {
        var userId = $(this).data('id');
        var url = 'http://127.0.0.1:8000/bono3/' + userId;
        window.open(url, '_blank');
    });
});