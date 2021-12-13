
//CONTROL DE TIEMPO--------------------- REPORTES ---------------------------------
$("#rptEntradasUsuario").on("click", function () {
  var usuario = $("#slcusuarioReportePDF").val();


  window.open(
    "../Modelo/Reportes/ControlUsuario.php?usuario=" +usuario,
    "_blank"
  );
});


$("#btnrptcumple").on("click", function () {
  var cumple = $("#slccumple").val();


  window.open(
    "../Modelo/Reportes/ControlCumple.php?cumple=" +cumple,
    "_blank"
  );
});

$("#btnrptFechaAsistencia").on("click", function () {
  var fecha = $("#idfechaasistenciarpt2fecha").val();
  var fecha2 = $("#idfechaasistenciarpt2fecha2").val();


  window.open(
    "../Modelo/Reportes/ControlFechas.php?fecha=" +fecha+"&fecha2="+fecha2,
    "_blank"
  );
});


$("#rptEntradasUsuarioMotivo").on("click", function () {
  var usuario = $("#slcusuarioReportePDFMotivoUser").val();
  var estado = $("#slcusuarioReportePDFMotivo").val();


  window.open(
    "../Modelo/Reportes/ControlMotivoIrComida.php?usuario=" +usuario+'&estado='+estado,
    "_blank"
  );
});


$("#rptEntradasUsuarioMotivoMotivoCN").on("click", function () {
  var fecha = $("#idfechaasistenciarptasistenciaMotivoCN").val();
  var fecha2 = $("#idfechaasistenciarpt2asistenciaMotivoCN").val();
  var estado = $("#slcusuarioReportePDFMotivoMotivoCN").val();
  window.open(
    "../Modelo/Reportes/ControlFechaMotivo.php?fecha="+fecha+"&fecha2="+fecha2+"&estado="+estado,
    "_blank"
  );
});

//POR CENTROS DE NEGOCIOS -------------------------------------------------

$("#rptEntradasCN").on("click", function () {
  var centro = $("#slccentroPDF").val();


  window.open(
    "../Modelo/Reportes/ControlCN.php?centro=" +centro,
    "_blank"
  );
});


//TICKETS --------------------------- REPORTES --------------------------------------
$("#rptTicketPendiente").on("click", function () {
  window.open(
    "../Modelo/Reportes/TicketPendiente.php",
    "_blank"
  );
});

$("#rptTicketProceso").on("click", function () {
  window.open(
    "../Modelo/Reportes/TicketProceso.php",
    "_blank"
  );
});

$("#rptTicketCompletos").on("click", function () {
  var estado = $("#slcestadoticketreportepdf").val();
  window.open(
    "../Modelo/Reportes/TicketHechos.php?estado="+estado,
    "_blank"
  );
});

$("#rptTicketUsuario").on("click", function () {
  var usuario = $("#slcusuarioPDF").val();


  window.open(
    "../Modelo/Reportes/TicketUsuario.php?usuario=" +usuario,
    "_blank"
  );
});

$("#rptTicketFechaPDFbtn").on("click", function () {
  var fecha = $("#rptTicketFechaPDF").val();
  var fecha2 = $("#rptTicketFechaPDF2").val();


  window.open(
    "../Modelo/Reportes/TicketFecha.php?fecha=" +fecha+"&fecha2="+fecha2,
    "_blank"
  );
});



$("#btnrptFechaCNAsistencia").on("click", function () {
  var fecha = $("#idfechaasistenciarptasistencia").val();
  var fecha2 = $("#idfechaasistenciarpt2asistencia").val();
  var cn = $("#slccentroAsistenciaPDF").val();
  window.open(
    "../Modelo/Reportes/ControlFechaCN.php?fecha="+fecha+"&fecha2="+fecha2+"&cn="+cn,
    "_blank"
  );
});



//Mantenimiento ----------------------- REPORTES -------------------------------------------
$("#rptMantEquipo").on("click", function () {
  var equipo = $("#slcEquipoPDF").val();


  window.open(
    "../Modelo/Reportes/MantenimientoEquipo.php?equipo=" +equipo,
    "_blank"
  );
});




$("#rptMantCN").on("click", function () {
  var cn = $("#slcCNPDF").val();


  window.open(
    "../Modelo/Reportes/MantenimientoCN.php?cn=" +cn,
    "_blank"
  );
});


$("#rptMantEquipoAsignados").on("click", function () {
  var estado = $("#slcestadomantenimientoreportepdf").val();
  window.open(
    "../Modelo/Reportes/EquiposAsignados.php?estado="+estado,
    "_blank"
  );
});


$("#rptMantEquipoInactivos").on("click", function () {
  window.open(
    "../Modelo/Reportes/EquiposInactivos.php",
    "_blank"
  );
});

$("#rptMantEquipoCamino").on("click", function () {
  window.open(
    "../Modelo/Reportes/EquiposEnCamino.php?",
    "_blank"
  );
});


$("#rptEquipoFechabtn").on("click", function () {
  var fecha = $("#idfechaequipopdf").val();
  var fecha2 = $("#idfechaequipopdf2").val();
  window.open(
    "../Modelo/Reportes/MantenimientoFecha.php?fecha=" +fecha+"&fecha2="+fecha2,
    "_blank"
  );
});


