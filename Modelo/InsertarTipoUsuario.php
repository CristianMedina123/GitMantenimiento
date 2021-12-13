<?php
include 'conexion.php';
mysqli_set_charset( $conn, "utf8" );
$tipo = mysqli_real_escape_string($conn, utf8_decode($_POST['tipo']));

$query = "INSERT INTO tipousuario (`tipousuario`) VALUES ('$tipo')";
// echo mysqli_query($conn, $query);
// mysqli_close($conn);

if (mysqli_query($conn, $query)) {
    echo "1";
}else{
    echo "Error: " . $query . "<br>" . mysqli_error($conn);
}
?>