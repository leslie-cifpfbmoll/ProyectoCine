
var duracion;
var fecha = $("#fecha").val();
var selectedSala;
var horafin;
var checkbox;
var ajaxurl = "http://localhost/ProyectoCine/public/admin/carteleras/";
var id_ocupados = [];

$(document).ready(function () {
    $("select#fpelicula").change(duracion_pelicula);
    $("select#fsala").change(horarios_sala);
    $("#horarios").hide();
});
//duración de la película seleccionada
function duracion_pelicula() {
    var id = $("#fpelicula").val();
    if (selectedSala) {
        document.getElementById("sselect").selected = "true";
    }
    $.get(ajaxurl + "get-duracion?id=" + id, function (respuesta, status) {
        if (status == 'success') {
            duracion = respuesta[0].duracion;
        }
    });
}
//sala seleccionada y sus horarios disponibles
function horarios_sala() {
    if (duracion = "undefined") {
        duracion_pelicula();
    }
    selectedSala = $("#fsala").val();
    $("#disponibles").empty();
    
    $.get(ajaxurl + "get-horarios?fecha=" + fecha, function (res, status) {
        if (status == 'success') {
            for (var i = 0; i < res.length; i++) {
                if (res[i].id == selectedSala) {
                    $("#disponibles").append('<input type="checkbox" id="' + res[i].horario_id + '" onclick=horarios_libres(' + res[i].horario_id + ',"' + res[i].hora + '") name="horarios[]" value="' + res[i].horario_id + '"> <label id="' + res[i].horario_id + 'lavel"> ' + res[i].hora + '</label> ');
                }
            }
        }
        $("#horarios").show();
    });
}

function horarios_libres(idhora, hora) {
    var hidecheck;
    var hidelavel;
    checkbox = document.getElementById(idhora);
    var isChecked = checkbox.checked;
    if (isChecked) {
        $.get(ajaxurl + "get-horarios?fecha=" + fecha, function (res_h, status) {
            if (status == 'success') {
                id_ocupados = [];
                for (var x = 0; x < res_h.length; x++) {
                    if ((horamin(res_h[x].hora) > (horamin(hora) - duracion)) && (horamin(res_h[x].hora) != horamin(hora)) && (horamin(res_h[x].hora) < horafin(hora)) && (res_h[x].id == selectedSala)) {
                        id_ocupados.push(res_h[x].horario_id);
                        hidecheck = document.getElementById(res_h[x].horario_id);
                        hidelavel = document.getElementById((res_h[x].horario_id) + "lavel");
                        hidecheck.style.display = "none";
                        hidelavel.style.display = "none";
                    }
                }
            }
        });
    } else {
        for (var i = 0; i < id_ocupados.length; i++) {
            hidecheck = document.getElementById(id_ocupados[i]);
            hidelavel = document.getElementById((id_ocupados[i]) + "lavel");
            hidecheck.style.display = "inline";
            hidelavel.style.display = "inline";
        }

    }

}
/*function uncheck(idhora, hora) {
 if ($('#'+idhora).prop("checked")) {
 alert(" checked.");
 } else{
 alert("unchecked.");
 }
 
 }*/

//pasar horas a min
function horamin(hora) {
    var a = hora.split(':');
    var minutes = (+a[0]) * 60 + (+a[1]);
    return (minutes);
}

function horafin(hora) {
    var a = hora.split(':');
    var minutes = (+a[0]) * 60 + (+a[1]) + (parseInt(duracion));
    return (minutes);
}