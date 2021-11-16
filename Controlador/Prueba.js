function EditarVA(id) {
    cadena = "id=" + id;
    $.ajax({
      type: "POST",
        url: "../Modelo/MostrarTicket2.php",
        dataType: "json",
        data: cadena,
        success: function (res){
            $('#txtIdTicketEditar').val(res.IdTicket);
            $('#txtTicketNom1Editar').val(res.TicketNom);
            $('#slcEstadoEditar').val(res.EstadoTicket_IdEstadoTicket);
            $("#ModalActualizarMisTickets").modal("show"); 
        }
    });
}

function ActualizarVa() {
    var id = $("#txtIdTicketEditar").val();
    var obspendiente = $("#txtTicketNom1Editar").val();
    var estado = $('#slcEstadoEditar').val();

    cadena = "id=" + id +'&obspendiente='+obspendiente+'&estado='+estado;
    $.ajax({
      type: "POST",
        url: "../Modelo/ActualizarArea.php",
        data: cadena,
        success: function (res)
        {
            if (res == 1) {
                $("#ModalActualizarMisTickets").modal("hide");
                alertify.success('¡Se actualizó el registro!'); 
                setTimeout(function(){ location.reload(); }, 2000);
            } else {
                alertify.success('¡Ocurrió un error! Intentelo más tarde');
            }
        }
    });
}