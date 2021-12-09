$( document ).ready(function() {
   
    $("#slcCentro").change(function () {

        $("#slcCentro option:selected").each(function () {
            id_centro = $(this).val();
            $.post("../Modelo/SelectMantenimiento.php", { id_centro: id_centro }, function(data){
                $("#slcEquipo").html(data);
            });            
        });
    });

    $("#slcCentroEditar").change(function () {

        $("#slcCentroEditar option:selected").each(function () {
            id_centro = $(this).val();
            $.post("../Modelo/SelectMantenimiento.php", { id_centro: id_centro }, function(data){
                $("#slcEquipoEditar").html(data);
            });            
        });
    });


    $("#slcCentroPDF").change(function () {

        $("#slcCentroPDF option:selected").each(function () {
            id_centro = $(this).val();
            $.post("../Modelo/SelectMantenimiento.php", { id_centro: id_centro }, function(data){
                $("#slcEquipoPDF").html(data);
            });            
        });
    })


});

function InsertarMantenimiento(){

    var mant = $('#txtmant').val();
    var fecha = $('#fechamant').val();
    var desc = $('#txtdesc').val();
    var equipo = $('#slcEquipo').val();
    var centro = $('#slcCentro').val();
    var tipo = $('#slcusuario').val();

    if(mant.length == 0 || fecha.length == 0 || desc.length == 0){
        alertify.alert('Ocurrió un error','No puede dejar campos vacíos', function(){ alertify.error('¡Error!'); }).set('closable', false);
    }else if(mant.length > 60 || mant.length < 3){
        alertify.alert('Ocurrió un error','El campo Mantenimiento debe tener mas de 3 digitos y menos de 60', function(){ alertify.error('¡Error!'); }).set('closable', false);
    }else if(desc.length > 120 || desc.length < 3){
        alertify.alert('Ocurrió un error','El campo Descripción debe tener mas de 3 digitos y menos de 120', function(){ alertify.error('¡Error!'); }).set('closable', false);
    }else{
        
        datos = "mant="+mant+"&fecha="+fecha+"&desc="+desc+"&equipo="+equipo+"&centro="+centro+"&tipo="+tipo;
        
        $.ajax({
            type: "POST",
            url: "../Modelo/InsertarMantenimiento.php",
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

function EliminarMantenimiento(id) {
    cadena = "id=" + id;
    $.ajax({
      type: "POST",
      url: "../Modelo/EliminarMantenimiento.php",
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


  function EditarMantenimiento(id) {
    // var titulo = document.getElementById('tipoIngredientetitle');
    
    cadena = "id=" + id;
    $.ajax({
      type: "POST",
        url: "../Modelo/MostrarMantenimiento.php",
        dataType: "json",
        data: cadena,
        success: function (res){
            //EstadoTicketObject = JSON.parse(res);
            // titulo.innerHTML = TipoIngredienteObject[0].nombre;
            $('#txtIdMantenimientoEditar').val(res.idmantenimiento);
            $('#txtMantenimientoEditar').val(res.mantenimiento);
            $('#txtFechaEditar').val(res.fechamantenimiento);
            $('#txtDescripcionEditar').val(res.descripcion);
            $('#slcCentroEditar').val(res.idcentronegocio);
            $('#slcEquipoEditar').val(res.idequipo);
            $('#slcUsuarioEditar').val(res.idusuario);
            $("#ModalActualizarMantenimiento").modal("show"); 
        }
    });
}

function ActualizarMantenimiento() {

    var id = $('#txtIdMantenimientoEditar').val();
    var mantenimiento = $("#txtMantenimientoEditar").val();
    var fehca = $("#txtFechaEditar").val();
    var descripcion = $("#txtDescripcionEditar").val();
    var centro = $("#slcCentroEditar").val();
    var equipo = $("#slcEquipoEditar").val();
    var usuario = $("#slcUsuarioEditar").val();

    if(mantenimiento.length < 3 || mantenimiento.length === 0 || fehca.length === 0 
        || descripcion.length < 3 || descripcion.length === 0){
        alertify.alert('Ocurrió un error','No puede dejar campos vacíos', function(){ alertify.error('¡Error!'); }).set('closable', false);
    }else if(centro === 0){
        alertify.alert('Ocurrió un error','Seleccione un centro de negocios', function(){ alertify.error('¡Error!'); }).set('closable', false);
    }else if(equipo.length === 0){
        alertify.alert('Ocurrió un error','Elija un Equipo', function(){ alertify.error('¡Error!'); }).set('closable', false);
    }else{

        cadena = "id=" + id + "&mantenimiento=" +mantenimiento+'&fehca='+fehca+'&descripcion='+descripcion
        +'&centro='+centro+'&equipo='+equipo+'&usuario='+usuario;
        $.ajax({
        type: "POST",
            url: "../Modelo/ActualizarMantenimiento.php",
            data: cadena,
            success: function (res)
            {
                if (res == 1) {
                    $("#ModalActualizarMantenimiento").modal("hide");
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
    $('#id_tabla_mant').DataTable({
        "order": [[ 2, "desc" ]],
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