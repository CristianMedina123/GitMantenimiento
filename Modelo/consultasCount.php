<?php

include 'conexion.php';


//CONSULTA CONTABLE PARA LOS EQUIPOS REGISTRADOS
$query_countEquipos = "SELECT COUNT(*) as NumEquipos FROM equipo";
$resultadoCountEquipos = mysqli_query($conn , $query_countEquipos);
$fila = mysqli_fetch_assoc($resultadoCountEquipos);

//CONSULTA CONTABLE PARA LOS CENTROS DE NEGOCIOS
$query_countCentros = "SELECT COUNT(*) AS NumCentros FROM centronegocio";
$resultadoCountCentros = mysqli_query($conn, $query_countCentros);
$filaCentro = mysqli_fetch_assoc($resultadoCountCentros);

//CONSULATA PARA CONTAR LOS USUARIOS
$query_countUsuarios = "SELECT COUNT(*) AS usuario FROM usuario";
$resultadoCountUsuarios = mysqli_query($conn, $query_countUsuarios);
$filaUsuario = mysqli_fetch_assoc($resultadoCountUsuarios);

//CONSULTA CONTABLE PARA VER TICKET PENDIENTES
$query_countTicket = "SELECT COUNT(*) AS pendiente FROM ticket
INNER JOIN estadoticket
ON ticket.EstadoTicket_IdEstadoTicket = estadoticket.IdEstadoTicket WHERE estadoticket.EstadoTicket = 'Pendiente'";
$resultadoCountTicket = mysqli_query($conn, $query_countTicket);
$filaTicket = mysqli_fetch_assoc($resultadoCountTicket);


// mysqli_close($conn);

?>