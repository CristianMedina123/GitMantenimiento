$("#slccentro").change(function () {
    $("#slccentro option:selected").each(function () {
        id_centro = $(this).val();
        $.post("../Modelo/SelectUsuario.php", { id_centro: id_centro }, function(data){
            $("#slcArea").html(data);
        });            
    });
});






function InsertarUsuario(){
    var usuario = $('#txtusuario').val();
    var psw = $('#txtpsw').val();
    var nombre = $('#txtnombre').val();
    var ape_pat = $('#txtapepat').val();
    var ape_mat = $('#txtapemat').val();
    var centro = $('#slccentro').val();
    var area = $('#slcArea').val();
    var tipo = $('#stlUsuario').val();
    var ingreso = $('#txtfechaingreso').val();
    var cumple = $('#txtfechacumple').val();

    if(usuario.length == 0 || psw.length == 0 || nombre.length == 0 || ape_pat.length == 0 || ape_mat.length == 0 || centro.length == 0 || area.length == 0 || tipo.length == 0){
        alertify.alert('Ocurrió un error','No puede dejar campos vacíos', function(){ alertify.error('¡Error!'); }).set('closable', false);
    }else if(usuario.length > 60 || usuario.length < 3){
        alertify.alert('Ocurrió un error','El campo Usuario deben tener mas de 3 digitos y menos de 60', function(){ alertify.error('¡Error!'); }).set('closable', false);
    }else if(psw.length > 60 || psw.length < 3){
        alertify.alert('Ocurrió un error','El campo Contraseña deben tener mas de 3 digitos y menos de 60', function(){ alertify.error('¡Error!'); }).set('closable', false);
    }else if(nombre.length > 60 || nombre.length < 3){
        alertify.alert('Ocurrió un error','El campo Nombre deben tener mas de 3 digitos y menos de 60', function(){ alertify.error('¡Error!'); }).set('closable', false);
    }else if(ape_pat.length > 60 || ape_pat.length < 3){
        alertify.alert('Ocurrió un error','El campo Apellido Paterno deben tener mas de 3 digitos y menos de 60', function(){ alertify.error('¡Error!'); }).set('closable', false);
    }else if(ape_mat.length > 60 || ape_mat.length < 3){
        alertify.alert('Ocurrió un error','El campo Apellido Materno deben tener mas de 3 digitos y menos de 60', function(){ alertify.error('¡Error!'); }).set('closable', false);
    }else{

        datos = 'usuario='+usuario+ '&psw='+psw+
        '&nombre='+nombre+ '&ape_pat='+ape_pat+ 
        '&ape_mat='+ape_mat+'&centro='+centro+'&area='+area+'&tipo='+tipo+'&ingreso='+ingreso
        +'&cumple='+cumple; 

        $.ajax({
            type: "POST",
            url: "../Modelo/InsertarUsuario.php",
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

function EliminarUsuario(id) {
    cadena = "id=" + id;
    $.ajax({
      type: "POST",
      url: "../Modelo/EliminarUsuario.php",
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



  function EditarUsuario(id) {
    // var titulo = document.getElementById('tipoIngredientetitle');
    
    cadena = "id=" + id;
    $.ajax({
      type: "POST",
      data: cadena,
        url: "../Modelo/MostrarUsuario.php",
        success: function (res){
            var EstadoUsuariotObject = res;
            console.log(EstadoUsuariotObject);
            EstadoUsuariotObject = JSON.parse(res);
            // titulo.innerHTML = TipoIngredienteObject[0].nombre;
            $('#txtIdUsuarioEditar').val(EstadoUsuariotObject.idusuario);
            $('#txtUsuarioEditar').val(EstadoUsuariotObject.usuario);
            $('#txtPswEditar').val(EstadoUsuariotObject.psw);
            $('#txtNombreEditar').val(EstadoUsuariotObject.nombre);
            $('#txtApellidoPatEditar').val(EstadoUsuariotObject.apellidopa);
            $('#txtApellidoMatEditar').val(EstadoUsuariotObject.apellidoma);
            $('#txtfechaingresoEditar').val(EstadoUsuariotObject.fechaingreso);
            $('#txtfechacumpleEditar').val(EstadoUsuariotObject.fechacumple);
            $('#slcCentrosEditar').val(EstadoUsuariotObject.idcentronegocio);
            $('#slcAreaEditar').val(EstadoUsuariotObject.idarea);
            $('#slcEstadoEditar').val(EstadoUsuariotObject.idtipousuario);
            $("#ModalActualizarUsuario").modal("show"); 
        }
    });
  }
  $("#slcCentrosEditar").change(function () {
    $("#slcCentrosEditar option:selected").each(function () {
        id_centro = $(this).val();
        $.post("../Modelo/SelectUsuario.php", { id_centro: id_centro }, function(data){
            $("#slcAreaEditar").html(data);
        });            
    });
});
  function ActualizarUsuario() {
    var id = $("#txtIdUsuarioEditar").val();
    var usuario = $("#txtUsuarioEditar").val();
    var psw = $("#txtPswEditar").val();
    var nombre = $("#txtNombreEditar").val();
    var ape_pat = $("#txtApellidoPatEditar").val();
    var ape_mat = $("#txtApellidoMatEditar").val();
    var centros = $("#slcCentrosEditar").val();
    var area = $("#slcAreaEditar").val();
    var tipo = $("#slcEstadoEditar").val();
    var ingreso = $("#txtfechaingresoEditar").val();
    var cumple = $("#txtfechacumpleEditar").val();
  
  if(usuario.length < 3 || usuario.length === 0 || psw.length < 3 || psw.length === 0 
    || nombre.length < 3 || nombre.length === 0 || ape_pat.length < 3 || ape_pat.length === 0
    || ape_mat < 3 || ape_mat === 0){
        alertify.success('No debe haber campos vacios');
  }else {
        cadena = "id=" + id + "&usuario=" + usuario+ '&psw='+psw+'&nombre='+nombre+'&ape_pat='+ape_pat+
        '&ape_mat='+ape_mat+ '&centros='+centros+'&area='+area+'&tipo='+tipo+'&ingreso='+ingreso+'&cumple='+cumple;
        
        $.ajax({
        type: "POST",
            url: "../Modelo/ActualizarUsuario.php",
            data: cadena,
            success: function (res)
            {
                if (res == 1) {
                    $("#ModalActualizarUsuario").modal("hide");
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
    $('#id_tabla_usuario').DataTable({

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