var opciones = ['Propia','Rentada','Otro'];
showVivienda('Propia');
var valor = 3000;
$("#monto").slider({
    range: "min",
    value: 3000,
    min: 500,
    step: 100,
    max: 15000,
    slide: function (event, ui) {
        $("#montoselected").val(ui.value);
        if (ui.value <= 7000) {
            $("#diascredito").val(30);
            $("#lblintereses").html(20+'% intereses');
            $("#intereses").val((ui.value)*.2);
            $("#pagodiario").val(Math.round((ui.value*1.2)/30));
        }else{
            if (ui.value <= 8100) {
                $("#diascredito").val(45);
                $("#lblintereses").html(30+'% intereses');
                $("#intereses").val((ui.value)*.3);
                $("#pagodiario").val(Math.round((ui.value*1.3)/45));
            }else{
                $("#diascredito").val(60);
                $("#lblintereses").html(40+'% intereses');
                $("#intereses").val((ui.value)*.4);
                $("#pagodiario").val(Math.round((ui.value*1.4)/60));
            }
        }
    },
    stop: function (event, ui) {
        $("#montoselected").val(ui.value);
        if (ui.value <= 7000) {
            $("#diascredito").val(30);
            $("#lblintereses").html(20+'% intereses');
            $("#intereses").val((ui.value)*.2);
            $("#pagodiario").val(Math.round((ui.value*1.2)/30));
        }else{
            if (ui.value <= 8100) {
                $("#diascredito").val(45);
                $("#lblintereses").html(30+'% intereses');
                $("#intereses").val((ui.value)*.3);
                $("#pagodiario").val(Math.round((ui.value*1.3)/45));
            }else{
                $("#diascredito").val(60);
                $("#lblintereses").html(40+'% intereses');
                $("#intereses").val((ui.value)*.4);
                $("#pagodiario").val(Math.round((ui.value*1.4)/60));
            }
        }
    }
});

$("#as_vivienda").change(function (){
    console.log('Entra aquí!!!');
    let tipo = $("#as_vivienda").val();
    showVivienda(tipo);
});

function showVivienda(tipo){
    for(i in opciones){
        if(opciones[i]==tipo)
            $("#as_g1_"+opciones[i]).show();
        else
            $("#as_g1_"+opciones[i]).hide();
    }
}
