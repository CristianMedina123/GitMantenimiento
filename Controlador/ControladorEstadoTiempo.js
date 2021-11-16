function InsertarEstadoTiempo(){
    var estadoTiempo = $('#txtEstadoTiempo').val();

    if(estadoTiempo.length == 0){
        alertify.alert('Ocurrió un error','No puede dejar campos vacíos', function(){ alertify.error('¡Error!'); }).set('closable', false);
    }else if( estadoTiempo.length > 60){
        alertify.alert('Ocurrió un error','El campo no debe ser mayor a 60 digitos', function(){ alertify.error('¡Error!'); }).set('closable', false);
    }else{

        datos = "estadoTiempo="+estadoTiempo;

        $.ajax({
            type: "POST",
              url: "../Modelo/InsertarEstadoTiempo.php",
              data: datos,
              success: function (res)
              {
                if (res == 1) {
                  alertify.success('¡Se insertó el registro!');
                  setTimeout(function(){ location.reload(); }, 2000);
              } else {
                alertify.error('Ocurrió un error');
              }
            },
          });
    }
}



function EliminarEstadoTiempo(id) {
  cadena = "id=" + id;
  $.ajax({
    type: "POST",
    url: "../Modelo/EliminarEstadoTiempo.php",
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



function EditarEstadoTiempo(id) {
    // var titulo = document.getElementById('tipoIngredientetitle');
    
    cadena = "id=" + id;
    $.ajax({
      type: "POST",
        url: "../Modelo/MostrarEstadoTiempo.php",
        dataType: "json",
        data: cadena,
        success: function (res){
            //EstadoTicketObject = JSON.parse(res);
            // titulo.innerHTML = TipoIngredienteObject[0].nombre;
            $('#txtidEstadoTiempo').val(res.IdEstadoTiempo);
            $('#txtEstadoTiempoEditar').val(res.Estado);
            $("#ModalActualizarEstadoTiempo").modal("show"); 
        }
    });
}

function ActualizarEstadoTiempo() {
    var id = $("#txtidEstadoTiempo").val();
    var estado = $("#txtEstadoTiempoEditar").val();

    if(estado.length === 0 || estado.length < 3){
        alertify.alert('Ocurrió un error','El campo no debe ser mayor a 60 digitos', function(){ alertify.error('¡Error!'); }).set('closable', false);
    }else{
        cadena = "id=" + id + "&estado=" + estado;
        $.ajax({
        type: "POST",
            url: "../Modelo/ActualizarEstadoTiempo.php",
            data: cadena,
            success: function (res)
            {
                if (res == 1) {
                    $("#ModalActualizarEstadoTiempo").modal("hide");
                    alertify.success('¡Se actualizó el registro!'); 
                    setTimeout(function(){ location.reload(); }, 2000);
                } else {
                    alertify.success('¡Ocurrió un error! Intentelo más tarde');
                }
            }
        });
    }
}




$(document).ready(function () {
  $('#id_tabla_estadoTiempo').DataTable({
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