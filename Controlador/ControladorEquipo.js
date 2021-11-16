$( document ).ready(function() {
   
    $("#slccentro").change(function () {

        $("#slccentro option:selected").each(function () {
            id_centro = $(this).val();
            $.post("../Modelo/SelectEquipo.php", { id_centro: id_centro }, function(data){
                $("#slcarea").html(data);
            });            
        });
    })

    $("#slcCentrosEditar").change(function () {

        $("#slcCentrosEditar option:selected").each(function () {
            id_centroEditar = $(this).val();
            $.post("../Modelo/SelectEquipoEditar.php", { id_centroEditar: id_centroEditar }, function(data){
                $("#slcAreaEditar").html(data);
            });            
        });
    })


});


function InsertarEquipo(){

    var codigo = $('#txtcodigo').val();
    var equipo = $('#txtequipo').val();
    var marca = $('#txtmarca').val();
    var modelo = $('#txtmodelo').val();
    var desc = $('#txtdesc').val();
    var centro = $('#slccentro').val();
    var area = $('#slcarea').val();
    var estado = $('#slcestado').val();

    if(codigo.length == 0 || equipo.length == 0 || marca.length == 0 || modelo.length == 0 || desc.length == 0){
        alertify.alert('Ocurrió un error','No puede dejar campos vacíos', function(){ alertify.error('¡Error!'); }).set('closable', false);
    }else if(codigo.length > 60 || codigo.length < 3){
        alertify.alert('Ocurrió un error','El campo Código debe tener mas de 3 digitos y menos de 60', function(){ alertify.error('¡Error!'); }).set('closable', false);
    }else if(equipo.length > 60 || equipo.length < 3){
        alertify.alert('Ocurrió un error','El campo Equipo debe tener mas de 3 digitos y menos de 60', function(){ alertify.error('¡Error!'); }).set('closable', false);
    }else if(marca.length > 60 || marca.length < 3){
        alertify.alert('Ocurrió un error','El campo Marca debe tener mas de 3 digitos y menos de 60', function(){ alertify.error('¡Error!'); }).set('closable', false);
    }else if(modelo.length > 60 || modelo.length < 3){
        alertify.alert('Ocurrió un error','El campo Modelo debe tener mas de 3 digitos y menos de 60', function(){ alertify.error('¡Error!'); }).set('closable', false);
    }else if(desc.length > 120 || desc.length < 3){
        alertify.alert('Ocurrió un error','El campo Código debe tener mas de 3 digitos y menos de 120', function(){ alertify.error('¡Error!'); }).set('closable', false);
    }else if(centro.length == 0){
        alertify.alert('Ocurrió un error','Se debe de elegir un centro de negocios', function(){ alertify.error('¡Error!'); }).set('closable', false);
    }else if(area.length == 0){
        alertify.alert('Ocurrió un error','Se debe de elegir un Área', function(){ alertify.error('¡Error!'); }).set('closable', false);
    }else if(estado.length == 0){
        alertify.alert('Ocurrió un error','Se debe de elegir un Estado para el equipo', function(){ alertify.error('¡Error!'); }).set('closable', false);
    }else{


        datos = "codigo="+codigo+"&equipo="+equipo+
        "&marca="+marca+"&modelo="+modelo+"&desc="+desc+
        "&centro="+centro+"&area="+area+"&estado="+estado;
        
        $.ajax({
            type: "POST",
            url: "../Modelo/InsertarEquipo.php",
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

function EliminarEquipo(id) {
    cadena = "id=" + id;
    $.ajax({
      type: "POST",
      url: "../Modelo/EliminarEquipo.php",
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


  function EditarEquipo(id) {
    // var titulo = document.getElementById('tipoIngredientetitle');
    
    cadena = "id=" + id;
    $.ajax({
      type: "POST",
        url: "../Modelo/MostrarEquipo.php",
        dataType: "json",
        data: cadena,
        success: function (res){
            //EstadoTicketObject = JSON.parse(res);
            // titulo.innerHTML = TipoIngredienteObject[0].nombre;
            $('#txtIdEquipoEditar').val(res.IdEquipo);
            $('#txtCodigoEditar').val(res.Codigo);
            $('#txtEquipoEditar').val(res.Equipo);
            $('#txtMarcaEditar').val(res.Marca);
            $('#txtModeloEditar').val(res.Modelo);
            $('#txtDescripcionEditar').val(res.Descripcion);
            $('#slcCentrosEditar').val(res.IdCentroNegocio);
            $('#slcAreaEditar').val(res.IdArea);
            $('#slcEstadoEditar').val(res.IdTipoEstado);
            $("#ModalActualizarEquipo").modal("show"); 
        }
    });
}

function ActualizarEquipo() {
    var id = $('#txtIdEquipoEditar').val();
    var codigo = $("#txtCodigoEditar").val();
    var equipo = $("#txtEquipoEditar").val();
    var marca = $("#txtMarcaEditar").val();
    var modelo = $("#txtModeloEditar").val();
    var descripcion = $("#txtDescripcionEditar").val();
    var centro = $("#slcCentrosEditar").val();
    var area = $("#slcAreaEditar").val();
    var estado = $('#slcEstadoEditar').val();


    cadena = "id=" + id + "&codigo=" +codigo+'&equipo='+equipo+'&marca='+marca
    +'&modelo='+modelo+'&descripcion='+descripcion+'&centro='+centro+'&area='+area+
    '&estado='+estado;
    $.ajax({
      type: "POST",
        url: "../Modelo/ActualizarEquipo.php",
        data: cadena,
        success: function (res)
        {
            if (res == 1) {
                $("#ModalActualizarEquipo").modal("hide");
                alertify.success('¡Se actualizó el registro!'); 
                setTimeout(function(){ location.reload(); }, 2000);
            } else {
                alertify.success('¡Ocurrió un error! Intentelo más tarde');
            }
        }
    });
}

$(document).ready(function () {
    $('#id_tabla_equipo').DataTable({
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