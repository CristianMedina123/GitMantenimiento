function InsertarEstadoTicket(){
    //Se declaran las variables para extraer información del input.
    var estado = $('#txtEstadoTicket').val();
    if(estado.length == 0){
        alertify.alert('Ocurrió un error','No puede dejar campos vacíos', function(){ alertify.error('¡Error!'); }).set('closable', false);
    }else{
        datos = 'estado='+estado;//Se manda la cadena para ejecutar el query
        $.ajax({
            type: "POST",
              url: "../Modelo/InsertarEstadoTicket.php",//Se manda la cadena para la insercción del objeto
              data: datos,
              success: function (res){//En caso de que el Query se ejecute
                if (res == 1) {
                  alertify.success('¡Se insertó el registro!');//Se registra el objeto
                  setTimeout(function(){ location.reload(); }, 2000);// Y se actualiza la página.
                }else {
                    alertify.error('Ocurrió un error');//En caso de error, el query es incorrecto o lo devuelve Null.
                }
              },
        });
    }
}

function EliminarEstadoTicket(id) {
    //Se extrae la cadena para ejecutar el Query.
  cadena = "id=" + id;
  $.ajax({
    type: "POST",
    url: "../Modelo/EliminarEstadoTicket.php",//Se manda la cadena al query
    data: cadena,
    success: function (res) {//En caso de que se ejecute
      if (res == 1) {
        alertify.success('¡Se eliminó el registro!');//Se elimina el registro
        setTimeout(function(){ location.reload(); }, 2000);//Y se actualiza la página para mostrar cambios
      } else {
        alertify.error('Ocurrió un error');//En caso de error, la consulta es Incorrecta o lo devuelve Null.
      }
    },
  });
}

function EditarEstadoTicket(id) {
    //Se extrae la cadena para editar el objeto.
    
    cadena = "id=" + id;
    $.ajax({
      type: "POST",
        url: "../Modelo/MostrarEstadoTicket.php",//Se manda la cadena para ejecutar el Query.
        dataType: "json",
        data: cadena,
        success: function (res){//En caso de que el query se ejecute.
            //EstadoTicketObject = JSON.parse(res);
            // titulo.innerHTML = TipoIngredienteObject[0].nombre;
            $('#txtidestadoticket').val(res.idestadoticket);
            $('#txtestadoticketeditar').val(res.estadoticket);//Se extraen los datos del JSON y los extrae en el input.
            $("#ModalActualizarEstadoTicket").modal("show"); 
        }
    });
}

function ActualizarEstadoTicket() {
    //Se declaran las variables que obtendran los nuevos datos del objeto.
    var id = $("#txtidestadoticket").val();
    var estado = $("#txtestadoticketeditar").val();
    cadena = "id=" + id + "&estado=" + estado;//La cadena se extrae para ejecutar el query.
    $.ajax({
      type: "POST",
        url: "../Modelo/ActualizarEstadoTicket.php",//Se manda la cadena al query.
        data: cadena,
        success: function (res){//En caso de que la consulta sea correta
            if (res == 1) {
                $("#ModalActualizarEstadoTicket").modal("hide");//Se oculta el modal
                alertify.success('¡Se actualizó el registro!'); //Se actualiza el registro
                setTimeout(function(){ location.reload(); }, 2000);//Se actualiza la página para mostrar resultados.
            } else {
                alertify.success('¡Ocurrió un error! Intentelo más tarde');//En caso de error, el query es incorrecto o lo devuelve Null.
            }
        }
    });
}

//CODIGO DEL DATATABLE

$(document).ready(function () {
  $('#id_tabla_estadoticket').DataTable({
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