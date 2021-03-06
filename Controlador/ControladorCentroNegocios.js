function InsertarCentroNegocio(){
    //Se declaran las variables y se extrae los datos del input
    var centro = $('#txtCentro').val();
    var estado = $('#txtEstado').val();

    if(centro.length == 0 || estado.length == 0){
        alertify.alert('Ocurrió un error','No puede dejar campos vacíos', function(){ alertify.error('¡Error!'); });
    }else if(centro.length > 60 || estado.length > 60){
        alertify.alert('Ocurrió un error','Los campos no deben ser mayores a 60 digitos', function(){ alertify.error('¡Error!'); });
    }else{
        //La cadena de datos se declara
        datos = 'centro='+centro+ '&estado='+estado; 
        $.ajax({
            type: "POST",
            url: "../Modelo/InsertarCentroNegocio.php",//Se manda la cadena al query
            data: datos,
            success: function (res){//Si el query es correto se inserta la cadena a la base datos.
            if (res == 1) {
                alertify.success('¡Se insertó el registro!');
                setTimeout(function(){ location.reload(); }, 2000);//Si se insertó se actualiza la página en 2s.
              }else {
                alertify.error('Ocurrió un error');//En caso de que el query es incorreto o devuelve null
              }
            },
        });
    }
}

function EliminarCentroNegocio(id) {
    cadena = "id=" + id;//Se extrae el ID mediante el botón.
    $.ajax({
      type: "POST",
      url: "../Modelo/EliminarCentroNegocio.php",//Se manda el ID para realizar el Query.
      data: cadena,
      success: function (res) {//En caso de que el query es correcto.
        if (res == 1) {
          alertify.success('¡Se eliminó el registro!');
          setTimeout(function(){ location.reload(); }, 2000);//Se actualiza la página en 2s.
        } else {
          alertify.error('Ocurrió un error');//En caso de error, es el query es incorrecto o devulve null.
        }
      },
    });
}


function EditarCentroNegocio(id) {
    // var titulo = document.getElementById('tipoIngredientetitle');
    //Se extrae la cadena para ejecutar el Query.
    cadena = "id=" + id;
    $.ajax({
      type: "POST",
        url: "../Modelo/MostrarCentroNegocio.php",//Se manda la cadena al query.
        data: cadena,
        success: function (res){//En caso de que el query es correcto se extraen los datos en JSON.
            centronegocioObject = JSON.parse(res);
            // titulo.innerHTML = TipoIngredienteObject[0].nombre;
            $('#txtIdCentroNegocioEditar').val(centronegocioObject.idcentronegocio);
            $('#txtCentroNegocioEditar').val(centronegocioObject.centronegocio);
            $('#txtEstadoEditar').val(centronegocioObject.estadocn);//Se extraen los datos del JSON y se lo asignan al input
            $("#ModalActualizarCentroNegocio").modal("show"); 
        },
        error: function(XMLHttpRequest, textStatus, errorThrown) {
           alert(errorThrown);
        }
    });
}

function ActualizarCentroNegocio() {
    //Se declaran variables para obtener los nuevos datos para actualizar.
    var id = $("#txtIdCentroNegocioEditar").val();
    var estado = $("#txtEstadoEditar").val();
    var centro = $("#txtCentroNegocioEditar").val();

    if(centro.length < 3 || estado.length === 0 || estado.length === 0){
        alertify.alert('Ocurrió un error','No puede dejar campos vacíos', function(){ alertify.error('¡Error!'); });
    }else{

        cadena = "id=" + id + "&estado=" + estado+ '&centro='+centro;//Se extrae la cadena para ejecutar Query.
        $.ajax({
        type: "POST",
            url: "../Modelo/ActualizarCentroNegocio.php",//Se manda los datos para ejecutar el Query.
            data: cadena,
            success: function (res){//En caso de que el Query es correcto se ejecuta.
                if (res == 1) {
                    $("#ModalActualizarCentroNegocio").modal("hide");
                    alertify.success('¡Se actualizó el registro!'); 
                    setTimeout(function(){ location.reload(); }, 2000);
                } else {
                    alertify.success('¡Ocurrió un error! Intentelo más tarde');//En caso de un error, El query es incorrecto o devuelve Null.
                }
            }
        });
    }
}





//------------------datatable--------------------------


$(document).ready(function () {
    $('#id_tabla_centronegocio').DataTable({
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