<?php

//Parametros de la conexión
// $servername = "localhost";
// $database = "mantenimiento";
// $username = "root";
// $password = "";
// Creamos la conexión
// $conn = mysqli_connect($servername, $username, $password, $database);
$conn = new mysqli("localhost", "root", "", "mantenimientoAnli") or die('Error al conectar'. mysqli_errno($conn));
//Verificamos la si éxiste conexión
// if (!$conn) {
//     die("Conexón fallida: " . mysqli_connect_error());
// }
// echo "Conexión éxitosa";
// mysqli_close($conn);


?>