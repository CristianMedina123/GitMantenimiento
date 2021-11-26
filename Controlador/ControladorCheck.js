$( document ).ready(function(){
    //Se selecciona el Select Padre
    $("#slccentroCheck").change(function () {
        $("#slccentroCheck option:selected").each(function () { //Se toma el dato seleccionado para mandarlo como parametro.
            id_centro = $(this).val();
            $.post("Modelo/SelectAsistenci.php", { id_centro: id_centro }, function(data){//El parametro se manda al query Hijo
                $("#slcusuarioCheck").html(data);//El query Hijo obtiene el dato.
            });            
        });
    })
});
//Se extrae la fecha y se le da formato.
var d = new Date();
var fecha = d.getFullYear() + "-" +(d.getMonth()+1)  + "-"+ d.getDate() + " " + d.getHours() + ":" + d.getMinutes();
document.getElementById("fechaAsis").value = fecha;
function InsertarAsistencia2(){
    //Se declara las variables que obtiene los datos del input
    var user = $('#txtusuario').val();
    var psw = $('#psw').val();
    var id = $('#slcusuarioCheck').val();
    var estado = $('#slcestado').val();
    var centro = $('#slccentroCheck').val();


    //Se declara las cadenas anidadas
    //Cadena: Datos= Esta cadena pasa los parametros del usuario para controlar Asistencia.
    //Cadena: DatosAsistencia= Se toman los datos para tomar la Asistencia.
    datos = 'user='+user+'&id='+id+'&psw='+psw;
    datosAsistencia = 'id='+id+'&estado='+estado+'&centro='+centro+'&fecha='+fecha;

        $.ajax({
            type: "POST",
              url: "Modelo/ValidarUsuarioAsistencia.php",//Se manda la primer cadena para validar datos
              data: datos,
              success: function (res){//En caso de que se ejecuta el query
                if (res != "null") {
                    $.ajax({
                        type: "POST",
                          url: "Modelo/InsertarAsistencia.php",//Se manda la segunda cadena para la insercción
                          data: datosAsistencia,
                          success: function (res){
                            if (res == 1) {
                              alertify.success('¡Se registró tu asistencia! Gracias');
                              setTimeout(function(){ location.reload(); }, 2000);//Una vez la insercción hecha se actualiza la página en 2s.
                            }else {
                                alertify.error('Ocurrió un error');
                            }
                          },
                    });
                }else {
                    //En caso de que el usuario no corresponde con la contraseña y persona, ocurre un error o devuelve null.
                    alertify.alert('Ocurrió un error','El Usuario no corresponde con el nombre de Empleado', function(){ alertify.error('¡Error!'); }).set('closable', false);
                }
              },
        });
}
