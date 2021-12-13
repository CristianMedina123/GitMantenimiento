<?php

include 'conexion.php';
mysqli_set_charset( $conn, "utf8" );

//CONSULTA CONTABLE PARA LOS EQUIPOS REGISTRADOS
$query_countEquipos = "SELECT COUNT(*) as numequipos FROM equipo";
$resultadoCountEquipos = mysqli_query($conn , $query_countEquipos);
$fila = mysqli_fetch_assoc($resultadoCountEquipos);

//CONSULTA CONTABLE PARA LOS CENTROS DE NEGOCIOS
$query_countCentros = "SELECT COUNT(*) AS numcentros FROM centronegocio";
$resultadoCountCentros = mysqli_query($conn, $query_countCentros);
$filaCentro = mysqli_fetch_assoc($resultadoCountCentros);

//CONSULATA PARA CONTAR LOS USUARIOS
$query_countUsuarios = "SELECT COUNT(*) AS usuario FROM usuario";
$resultadoCountUsuarios = mysqli_query($conn, $query_countUsuarios);
$filaUsuario = mysqli_fetch_assoc($resultadoCountUsuarios);

//CONSULTA CONTABLE PARA VER TICKET PENDIENTES
$query_countTicket = "SELECT COUNT(*) AS pendiente FROM ticket
INNER JOIN estadoticket
ON ticket.estadoticket_idestadoticket = estadoticket.idestadoticket WHERE estadoticket.estadoticket = 'pendiente'";
$resultadoCountTicket = mysqli_query($conn, $query_countTicket);
$filaTicket = mysqli_fetch_assoc($resultadoCountTicket);


// mysqli_close($conn);

?>