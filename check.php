<?php

include 'Modelo/conexion.php';

$queryCentros = mysqli_query($conn, "SELECT IdCentroNegocio, CentroNegocio, Estado FROM centronegocio order by centronegocio ASC");
$queryEstado = mysqli_query($conn, "SELECT IdEstadoTiempo, Estado FROM estadotiempo");
$queryUsuario = mysqli_query($conn, "SELECT IdUsuario, Usuario, Nombre, ApellidoPat, ApellidoMat FROM usuario");
$queryTabla = mysqli_query($conn, "SELECT controltiempo.IdControlTiempo, controltiempo.Fecha, estadotiempo.Estado AS Tiempo, usuario.Nombre, usuario.ApellidoPat, usuario.ApellidoMat, centronegocio.CentroNegocio, centronegocio.Estado FROM controltiempo
INNER JOIN usuario
ON controltiempo.Usuario_IdUsuario = usuario.IdUsuario
INNER JOIN centronegocio
ON controltiempo.CentroNegocio_IdCentroNegocio = centronegocio.IdCentroNegocio
INNER JOIN estadotiempo
ON controltiempo.EstadoTiempo_IdEstadoTiempo = estadotiempo.IdEstadoTiempo");

?>
<!DOCTYPE html>
<html lang="es">
<head>
	<title>check</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<link rel="stylesheet" href="Vista/css/main.css">
	<!-- JavaScript -->
	<script src="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>
	<!-- CSS -->
	<link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/alertify.min.css"/>
	<!-- Default theme -->
	<link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/default.min.css"/>
	<!-- Semantic UI theme -->
	<link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/semantic.min.css"/>
	<!-- Bootstrap theme -->
	<link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/bootstrap.min.css"/>
	<!-- RTL version-->
	<link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/alertify.rtl.min.css"/>
	<!-- Default theme -->
	<link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/default.rtl.min.css"/>
	<!-- Semantic UI theme -->
	<link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/semantic.rtl.min.css"/>
	<!-- Bootstrap theme -->
	<link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/bootstrap.rtl.min.css"/>
	<!-- DATATABLE -->
	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.css">
</head>
<body class="cover" style="background-image: url(Vista/assets/img/loginFondoAux.jpg);">
	<form autocomplete="off" class="full-box logInFormCheck">
		<p class="text-center text-muted"><i class="zmdi zmdi-account-circle zmdi-hc-5x"></i></p>
		<p class="text-center text-muted text-uppercase">Ingrese Usuario Para Asistencia</p>
		<div class="form-group label-floating">
		<fieldset>Asistencias de ANLI</fieldset>
			<div class="form-group label-floating">
				<label class="control-label">Fecha y Hora</label>
				<input class="form-control" readonly type="text" id="fechaAsis">
			</div>
			<div class="form-group">
				<label class="control-label">Centro de Negocios</label>
				<select class="form-control" id="slccentroCheck">
					<option value="0" disabled="disabled" selected="true">-- Seleccione un Centro de Negocios --</option>
					<?php foreach($queryCentros as $centro){ ?>
					<option value="<?php echo $centro['IdCentroNegocio'] ?>"><?php echo utf8_encode($centro['CentroNegocio']) ?> / <?php echo utf8_encode($centro['Estado']) ?></option>
					<?php } ?>
				</select>
			</div>
			<div class="form-group">
				<label class="control-label">Usuario</label>
				<select class="form-control" id="slcusuarioCheck">
					<option value="0" disabled="disabled" selected="true">-- Seleccione un Usuario --</option>
					<?php foreach($queryUsuario as $usuario){ ?>
					<option value="<?php echo $usuario['IdUsuario'] ?>"><?php echo utf8_encode($usuario['Nombre']) ?> <?php echo utf8_encode($usuario['ApellidoPat']) ?> <?php echo utf8_encode($usuario['ApellidoMat']) ?></option>
					<?php } ?>
				</select>
			</div>
			<div class="form-group label-floating">
				<label class="control-label">Ingresa tu Usuario</label>
				<input class="form-control" type="text" id="txtusuario" autocomplete="off">
			</div>
			<div class="form-group">
				<label class="control-label">Asistencia: </label>
				<select class="form-control" id="slcestado">
					<option value="0" disabled="disabled" selected="true">-- Seleccione el Motivo de Asitencia --</option>
					<?php foreach($queryEstado as $estado){ ?>
					<option value="<?php echo $estado['IdEstadoTiempo'] ?>"><?php echo utf8_encode($estado['Estado']) ?></option>
					<?php } ?>
				</select>
			</div>
		<p class="text-center">
			<button type="button" onclick="InsertarAsistencia2()"  class="btn btn-danger btn-raised btn-sm"><i class="zmdi zmdi-floppy"></i> Save</button>
		</p>
	</form>
	<!--====== Scripts -->
	<script src="Vista/js/jquery-3.1.1.min.js"></script>
	<script src="Vista/js/bootstrap.min.js"></script>
	<script src="Vista/js/material.min.js"></script>
	<script src="Vista/js/ripples.min.js"></script>
	<script src="Vista/js/sweetalert2.min.js"></script>
	<script src="Vista/js/jquery.mCustomScrollbar.concat.min.js"></script>
	<script src="Vista/js/main.js"></script>
    <script src="Controlador/ControladorCheck.js"></script>
	<!-- <script src="Controlador/ControladorAsistencia.js"></script> -->
	<script>
		$.material.init();
	</script>
</body>
</html>