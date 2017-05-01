$(document).ready(function(){
    $("#mostrarRegistroPeriodo").click(function(){
        var getUrl = $('#urlPeriodoNuevo').val();
        $.ajax({url: getUrl, success: function(result){
            $("#marcoPeriodos").html(result);
        }});
    });
});

$(document).ready(function(){
    $("#mostrarListaPeriodos").click(function(){
        var getUrl = $('#urlListaPeriodos').val();
        $.ajax({url: getUrl, success: function(result){
            $("#marcoPeriodos").html(result);
        }});
    });
});