<?php 

include 'conexion.php';

$id = $_POST['id'];

$query = mysqli_query($conn, "SELECT IdTicket, TicketNom, Fecha, ObservacionPendiente,ObservacionProceso,ObservacionCompletado, EstadoTicket_IdEstadoTicket FROM Ticket WHERE IdTicket = $id");
echo json_encode(mysqli_fetch_assoc($query)); 
?>