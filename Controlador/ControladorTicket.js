$("#slccnticket").change(function () {

    $("#slccnticket option:selected").each(function () {
        id_centro = $(this).val();
        $.post("../Modelo/SelectAsistenci.php", { id_centro: id_centro }, function(data){
            $("#slcticketusuario").html(data);
        });            
    });
})


$("#slccnticketcreador").change(function () {

    $("#slccnticketcreador option:selected").each(function () {
        id_centro = $(this).val();
        $.post("../Modelo/SelectAsistenci.php", { id_centro: id_centro }, function(data){
            $("#slccreador").html(data);
        });            
    });
})

function InsertarTicket(){

    var tituloTicket = $('#txtticket').val();
    var descripcion = $('#txtdesc').val();
    var fecha = $('#fecha').val();
    var usuario = $('#slcticketusuario').val();
    var estado = $('#slcestado').val();
    var creador = $('#slccreador').val();

    if(tituloTicket.length == 0 || descripcion.length == 0 || fecha.length == 0 || usuario.length == 0 || estado.length == 0){
        alertify.alert('Ocurrió un error','No puede dejar campos vacíos', function(){ alertify.error('¡Error!'); }).set('closable', false);
    }else if(tituloTicket.length > 60 || tituloTicket.length < 3){
        alertify.alert('Ocurrió un error','El campo Ticket no deben ser mayores a 60 digitos o menor a 3', function(){ alertify.error('¡Error!'); }).set('closable', false);
    }else if(descripcion.length > 60 || descripcion.length < 3){
        alertify.alert('Ocurrió un error','El campo Descripción no deben ser mayores a 60 digitos o menor a 3', function(){ alertify.error('¡Error!'); }).set('closable', false);
    }else{
        
        
        datos = 'tituloTicket=' +tituloTicket+ '&descripcion=' +descripcion+
        '&fecha=' +fecha+'&usuario=' +usuario+ '&estado=' +estado+ '&creador='+ creador; 
        $.ajax({
            type: "POST",
            url: "../Modelo/InsertarTicket.php",
            data: datos,
            success: function (res){
            if (res == 1) {
                alertify.success('¡Se insertó el registro!');
                setTimeout(function(){ location.reload(); }, 2000);
              }else {
                alertify.error('Ocurrió un error');
              }
            },
        });
    }
}

function EliminarTicket(id) {
    cadena = "id=" + id;
    $.ajax({
      type: "POST",
      url: "../Modelo/EliminarTicket.php",
      data: cadena,
      success: function (res) {
        if (res == 1) {
          alertify.success('¡Se eliminó el registro!');
          setTimeout(function(){ location.reload(); }, 2000);
        } else {
          alertify.error('Ocurrió un error');
        }
      },
    });
  }


function EditarTicket(id) {
    // var titulo = document.getElementById('tipoIngredientetitle');
    
    cadena = "id=" + id;
    $.ajax({
      type: "POST",
        url: "../Modelo/MostrarTicket.php",
        dataType: "json",
        data: cadena,
        success: function (res){
            //EstadoTicketObject = JSON.parse(res);
            // titulo.innerHTML = TipoIngredienteObject[0].nombre;
            $('#txtIdAreaEditar').val(res.IdArea);
            $('#txtAreaEditar').val(res.AreaNombre);
            $('#slcCentrosEditar').val(res.IdCentroNegocio);
            $("#ModalActualizarArea").modal("show"); 
        }
    });
}

function ActualizarTicket() {
    var id = $("#txtIdAreaEditar").val();
    var area = $("#txtAreaEditar").val();
    var centro = $('#slcCentrosEditar').val();


    cadena = "id=" + id + "&area=" + area+'&centro='+centro;
    $.ajax({
      type: "POST",
        url: "../Modelo/ActualizarArea.php",
        data: cadena,
        success: function (res)
        {
            if (res == 1) {
                $("#ModalActualizarArea").modal("hide");
                alertify.success('¡Se actualizó el registro!'); 
                setTimeout(function(){ location.reload(); }, 2000);
            } else {
                alertify.success('¡Ocurrió un error! Intentelo más tarde');
            }
        }
    });
}



$(document).ready(function () {
    $('#id_tabla_ticket').DataTable({
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