<?php 

include 'conexion.php';


$titulo = mysqli_real_escape_string($conn, utf8_decode($_POST['tituloTicket']));
$desc = mysqli_real_escape_string($conn, utf8_decode($_POST['descripcion']));
$fecha = mysqli_real_escape_string($conn, utf8_decode($_POST['fecha']));
$usuario = mysqli_real_escape_string($conn, utf8_decode($_POST['usuario']));
$estado = mysqli_real_escape_string($conn, utf8_decode($_POST['estado']));
$creador = mysqli_real_escape_string($conn, utf8_decode($_POST['creador']));

$query = "INSERT INTO ticket (Ticket, Descripcion, FechaTicket, UsuarioAsignado, Usuario_IdUsuario, EstadoTicket_IdEstadoTicket) VALUES 
('$titulo', '$desc', '$fecha','$usuario', '$creador', '$estado')";
echo mysqli_query($conn, $query);
mysqli_close($conn);
?> 