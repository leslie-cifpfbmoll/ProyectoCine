//var ajaxurl = "http://127.0.0.1:8000/admin/reservas/";
//var ajaxurl = "http://3.22.174.23/admin/reservas/";
 var ajaxurl= "http://localhost/ProyectoCine/public/admin/reservas/";


$(document).ready(function () {
    aforo_sala();
    $('select#horario').change(aforo_sala);
});
function aforo_sala() {
    var horario_id = $('#horario').val();
    var cartelera_id = $('#cartelera_id').val();
    var cantidad = document.querySelector("#cantidad"); 
    alert();
    $.get(ajaxurl + "get-aforo?horario_id=" + horario_id + "&cartelera_id=" + cartelera_id, function (respuesta, status) {
       
     if (status == 'success') {
            cantidad.setAttribute("max", respuesta); 
        }              
        
        
    });
   

}

