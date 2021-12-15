<?php

include 'conexion.php';


$fecha1 = mysqli_real_escape_string($conn, utf8_decode($_POST['fecha1']));
$fecha2 = mysqli_real_escape_string($conn, utf8_decode($_POST['fecha2']));
$id = mysqli_real_escape_string($conn, utf8_decode($_POST['id']));



$query = "INSERT INTO periodo (`fecha1`, `fecha2`, `idusuario`,`tiempoperiodo` ) 
VALUES 
('$fecha1', '$fecha2', '$id',HOUR(TIMEDIFF('$fecha1','$fecha2')))";
echo mysqli_query($conn,$query);
mysqli_close($conn);

?>