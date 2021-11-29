<?php
include 'conexion.php';
mysqli_set_charset( $conn, "utf8" );
$id =  mysqli_real_escape_string($conn, utf8_decode($_POST['id']));
$obspendiente =  mysqli_real_escape_string($conn, utf8_decode($_POST['obspendiente']));
$estado =  mysqli_real_escape_string($conn, utf8_decode($_POST['estado']));

$query = "UPDATE ticket SET 
ObservacionProceso = '$obspendiente', 
EstadoTicket_IdEstadoTicket = $estado 
WHERE IdTicket = $id";
echo mysqli_query($conn, $query);
mysqli_close($conn);

?>