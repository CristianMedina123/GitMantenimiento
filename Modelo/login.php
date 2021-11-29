<?php 
require 'conexion.php'; //Incluir el archivo de conexion a la bd
session_start(); //Iniciar una sesion

//Guardar los datos de los campos del formulario en variables
$usuario = $_POST['UserAnli'];
$psw = $_POST['pswAnli'];

if ($usuario == null || $usuario == undefined || $usuario == 'null' || $usuario == 'undefined' || $psw == null || $psw == undefined || $psw == 'null' || $psw == 'undefined') {
  header("location: ../index.html");
}
else {
   //Hacer una consulta de comparacion para saber si es Administrador registrado
   $query = "SELECT IdUsuario, TipoUsuario_IdTipoUsuario FROM usuario WHERE Usuario = '$usuario' AND Psw = '$psw'";
   $sql = mysqli_query($conn,$query); //Ejecutar consulta
   $array = mysqli_fetch_array($sql); //guardar los datos de la consulta en un array

   //Evaluar Administrador
   if($array['IdUsuario'] != null){ //Si la variable obtenida de la consulta 'contar' es mayor a 0 es administrador
      $_SESSION['IdUsuario'] = $array['IdUsuario']; //Guardar el correo del administrador
      header("location: ../Vista/home.php"); //Reedireccionar a la pagina principal de Admin
   }
   else{
      header("location: ../index.html");
   }
}
?>