$( document ).ready(function() {
   //El siguiente código son para los select en cascada
    $("#slccentro").change(function () {//Se toma el select Padre por su ID
        $("#slccentro option:selected").each(function () {//Cuando se selecciona una opcion lo manda como parametro
            id_centro = $(this).val();
            $.post("../Modelo/SelectAsistenci.php", { id_centro: id_centro }, function(data){//se realiza la consulta comprobando el parametro mandado
                $("#slcusuario").html(data);//Se manda el select del query hijo
            });            
        });
    });
    //Codigo en cascada en Reportes
    $("#slcCentroUsuarioPDF").change(function () {
        $("#slcCentroUsuarioPDF option:selected").each(function () {
            id_centro = $(this).val();
            $.post("../Modelo/SelectAsistenci.php", { id_centro: id_centro }, function(data){
                $("#slcusuarioReportePDF").html(data);
            });            
        });
    });
    //Codigo en cascada en Reportes
    $("#slcCentroUsuarioPDFMotivo").change(function () {
        $("#slcCentroUsuarioPDFMotivo option:selected").each(function () {
            id_centro = $(this).val();
            $.post("../Modelo/SelectAsistenci.php", { id_centro: id_centro }, function(data){
                $("#slcusuarioReportePDFMotivoUser").html(data);
            });            
        });
    });
    //Codigo en cascada en Reportes
    $("#slccentroCheck").change(function () {
        $("#slccentroCheck option:selected").each(function () {
            id_centro = $(this).val();
            $.post("Modelo/SelectAsistenci.php", { id_centro: id_centro }, function(data){
                $("#slcusuarioCheck").html(data);
            });            
        });
    })
});


//Se extrae el formato de la fecha YYYY-MM-DD-HH-MM-SS
var d = new Date();
var fecha = d.getFullYear() + "-" +(d.getMonth()+1)  + "-"+ d.getDate() + " " + d.getHours() + ":" + d.getMinutes();

//Se captura en la fecha y se asigna a una variable
document.getElementById("fechaAsis").value = fecha;
function InsertarAsistencia2(){
    //Se declaran las variables para extraer datos de los inputs
    var user = $('#txtusuario').val();
    var id = $('#slcusuario').val();
    var estado = $('#slcestado').val();
    var centro = $('#slccentro').val();

    //Se declaran dos cadenas
    //Cadena: Datos= Esta cadena extrae el usuario y lo manda como parametro para acceder a la siguiente consulta
    //Cadena= DatosAsistencia= Esta cadena extrae todos los datos faltantes para insertar la Asistencia.
    datos = 'user='+user+'&id='+id;
    datosAsistencia = 'id='+id+'&estado='+estado+'&centro='+centro+'&fecha='+fecha;

        $.ajax({
            type: "POST",
              url: "../Modelo/ValidarUsuarioAsistencia.php",//Se manda la primera cadena 
              data: datos,
              success: function (res){//Si la consulta es correcta, se valida los datos para insercción
                if (res != "null") {
                    $.ajax({
                        type: "POST",
                          url: "../Modelo/InsertarAsistencia.php",//Se inserta los datos con la segunda cadena
                          data: datosAsistencia,
                          success: function (res){
                            if (res == 1) {
                              alertify.success('¡Se insertó el registro!');
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

//CODIGO DEL DATATABLE
$(document).ready(function () {
    $('#id_tabla_asistencia').DataTable({
        "order": [[ 1, "desc" ]],
        language: {
            aria: {
                sortAscending: "Activar para ordenar la columna de manera ascendente",
                sortDescending: "Activar para ordenar la columna de manera descendente"
            },
            autoFill: {
                cancel: "Cancelar",
                fill: "Rellene todas las celdas con <i>%d&lt;\\\/i&gt;<\/i>",
                fillHorizontal: "Rellenar celdas horizontalmente",
                fillVertical: "Rellenar celdas verticalmentemente"
            },
            buttons: {
                collection: "Colección",
                colvis: "Visibilidad",
                colvisRestore: "Restaurar visibilidad",
                copy: "Copiar",
                copyKeys: "Presione ctrl o u2318 + C para copiar los datos de la tabla al portapapeles del sistema. <br \/> <br \/> Para cancelar, haga clic en este mensaje o presione escape.",
                copySuccess: {
                    1: "Copiada 1 fila al portapapeles",
                    _: "Copiadas %d fila al portapapeles"
                },
                copyTitle: "Copiar al portapapeles",
                csv: "CSV",
                excel: "Excel",
                pageLength: {
                    "-1": "Mostrar todas las filas",
                    1: "Mostrar 1 fila",
                    _: "Mostrar %d filas"
                },
                pdf: "PDF",
                print: "Imprimir"
            },
            decimal: ",",
            emptyTable: "No se encontraron resultados",
            info: "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
            infoEmpty: "Mostrando registros del 0 al 0 de un total de 0 registros",
            infoFiltered: "(filtrado de un total de _MAX_ registros)",
            infoThousands: ",",
            lengthMenu: "Mostrar _MENU_ registros",
            loadingRecords: "Cargando...",
            paginate: {
                "first": "Primero",
                "last": "Último",
                "next": "Siguiente",
                "previous": "Anterior"
            },
            processing: "Procesando...",
            search: "Buscar:",
            searchBuilder: {
                add: "Añadir condición",
                button: {
                    "0": "Constructor de búsqueda",
                    "_": "Constructor de búsqueda (%d)"
                },
                clearAll: "Borrar todo",
                condition: "Condición",
                data: "Data",
                deleteTitle: "Eliminar regla de filtrado",
                leftTitle: "Criterios anulados",
                logicAnd: "Y",
                logicOr: "O",
                rightTitle: "Criterios de sangría",
                title: {
                    "0": "Constructor de búsqueda",
                    "_": "Constructor de búsqueda (%d)"
                },
                value: "Valor"
            },
            searchPanes: {
                clearMessage: "Borrar todo",
                collapse: {
                    "0": "Paneles de búsqueda",
                    "_": "Paneles de búsqueda (%d)"
                },
                count: "{total}",
                countFiltered: "{shown} ({total}",
                emptyPanes: "Sin paneles de búsqueda",
                loadMessage: "Cargando paneles de búsqueda",
                title: "Filtros Activos - %d"
            },
            select: {
                1: "%d fila seleccionada",
                "_": "%d filas seleccionadas",
                cells: {
                    "1": "1 celda seleccionada",
                    "_": "$d celdas seleccionadas"
                },
                columns: {
                    "1": "1 columna seleccionada",
                    "_": "%d columnas seleccionadas"
                }
            },
            thousands: ",",
            zeroRecords: "No se encontraron resultados",
            datetime: {
                previous: "Anterior",
                next: "Proximo",
                hours: "Horas",
                minutes: "Minutos",
                seconds: "Segundos",
                unknown: "-",
                amPm: [
                    "am",
                    "pm"
                ]
            },
            editor: {
                close: "Cerrar",
                create: {
                    button: "Nuevo",
                    title: "Crear Nuevo Registro",
                    submit: "Crear"
                },
                edit: {
                    button: "Editar",
                    title: "Editar Registro",
                    submit: "Actualizar"
                },
                remove: {
                    button: "Eliminar",
                    title: "Eliminar Registro",
                    submit: "Eliminar",
                    confirm: {
                        "_": "¿Está seguro que desea eliminar %d filas?",
                        "1": "¿Está seguro que desea eliminar 1 fila?"
                    }
                },
                error: {
                    system: "Ha ocurrido un error en el sistema (<a target=\"\\\" rel=\"\\ nofollow\" href=\"\\\">Más información&lt;\\\\\\\/a&gt;).&lt;\\\/a&gt;<\/a>"
                },
                multi: {
                    title: "Múltiples Valores",
                    info: "Los elementos seleccionados contienen diferentes valores para este registro. Para editar y establecer todos los elementos de este registro con el mismo valor, hacer click o tap aquí, de lo contrario conservarán sus valores individuales.",
                    restore: "Deshacer Cambios",
                    noMulti: "Este registro puede ser editado individualmente, pero no como parte de un grupo."
                }
            }
        }
    }
    );
  });