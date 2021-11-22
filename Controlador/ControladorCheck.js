$( document ).ready(function() {
   
    $("#slccentroCheck").change(function () {

        $("#slccentroCheck option:selected").each(function () {
            id_centro = $(this).val();
            $.post("Modelo/SelectAsistenci.php", { id_centro: id_centro }, function(data){
                $("#slcusuarioCheck").html(data);
            });            
        });
    })


});
var d = new Date();
var fecha = d.getFullYear() + "-" +(d.getMonth()+1)  + "-"+ d.getDate() + " " + d.getHours() + ":" + d.getMinutes();

//var datestring = d.getDate()  + "-" + (d.getMonth()+1) + "-" + d.getFullYear() + " " + d.getHours() + ":" + d.getMinutes();


// fecha.toLocaleDateString();
// fecha = new Date().toLocaleString();
// fechainicio = new Date();
// var fecha = fechainicio.getDate() + '/' + ( fechainicio.getMonth() + 1 ) + '/' + fechainicio.getFullYear();
document.getElementById("fechaAsis").value = fecha;
function InsertarAsistencia2(){
    var user = $('#txtusuario').val();
    var psw = $('#psw').val();
    var id = $('#slcusuarioCheck').val();

    var estado = $('#slcestado').val();
    var centro = $('#slccentroCheck').val();



    datos = 'user='+user+'&id='+id+'&psw='+psw;
    datosAsistencia = 'id='+id+'&estado='+estado+'&centro='+centro+'&fecha='+fecha;

        $.ajax({
            type: "POST",
              url: "Modelo/ValidarUsuarioAsistencia.php",
              data: datos,
              success: function (res){
                if (res != "null") {
                    $.ajax({
                        type: "POST",
                          url: "Modelo/InsertarAsistencia.php",
                          data: datosAsistencia,
                          success: function (res){
                            if (res == 1) {
                              alertify.success('¡Se registró tu asistencia! Gracias');
                              setTimeout(function(){ location.reload(); }, 2000);
                            }else {
                                alertify.error('Ocurrió un error');
                            }
                          },
                    });
                }else {
                    alertify.alert('Ocurrió un error','El Usuario no corresponde con el nombre de Empleado', function(){ alertify.error('¡Error!'); }).set('closable', false);
                }
              },
        });
}
