<?php
session_start();
include '../Modelo/conexion.php';
$queryCentros = mysqli_query($conn, "SELECT idcentronegocio, centronegocio, estadocn FROM centronegocio order by centronegocio ASC");
$queryEstado = mysqli_query($conn, "SELECT idestadotiempo, estadotiempo FROM estadotiempo ORDER BY estadotiempo ASC");
$queryUsuario = mysqli_query($conn, "SELECT idusuario, usuario, nombre, apellidopa, apellidoma FROM usuario ORDER BY nombre ASC");
$queryTabla = mysqli_query($conn, "SELECT controltiempo.idcontroltiempo, controltiempo.fechatiempo, controltiempo.horatiempo,estadotiempo.estadotiempo, usuario.nombre, usuario.apellidopa, usuario.apellidoma, centronegocio.centronegocio, centronegocio.estadocn FROM controltiempo
INNER JOIN usuario
ON controltiempo.usuario_idusuario = usuario.idusuario
INNER JOIN centronegocio
ON controltiempo.centronegocio_idcentronegocio = centronegocio.idcentronegocio
INNER JOIN estadotiempo
ON controltiempo.estadotiempo_idestadotiempo = estadotiempo.idestadotiempo
ORDER BY controltiempo.fechatiempo DESC");

$varsesion = $_SESSION['IdUsuario'];

if($varsesion == null || $varsesion = ''){
	header("Location: ../index.html");
	die();
}

$topo = $_SESSION['IdUsuario'];
$query = "SELECT idusuario, usuario, nombre, apellidopa ,tipousuario_idtipousuario FROM usuario WHERE idusuario = $topo";
$resultado = mysqli_query($conn,$query);
?>

<!DOCTYPE html>
<html lang="es">
<head>
	<title>Asistencia</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<link rel="shortcut icon" href="assets/img/iconweb.png">
	<link rel="stylesheet" href="./css/main.css">
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
<body>
<?php while($datos = mysqli_fetch_array($resultado)){ ?>
	<!-- SideBar -->
	<section class="full-box cover dashboard-sideBar">
		<div class="full-box dashboard-sideBar-bg btn-menu-dashboard"></div>
		<div class="full-box dashboard-sideBar-ct">
			<!--SideBar Title -->
			<div class="full-box text-uppercase text-center text-titles dashboard-sideBar-title">
				<h4><?php echo utf8_encode($datos['nombre'])?> <?php echo utf8_encode($datos['apellidopa'])?></h4>
				 <i class="zmdi zmdi-close btn-menu-dashboard visible-xs"></i>
			</div>
			<!-- SideBar User info -->
			<div class="full-box dashboard-sideBar-UserInfo">
				<figure class="full-box">
					<img src="./assets/img/home-icon.jpg" alt="UserIcon">
					<figcaption class="text-center text-titles">
						<h5><?php echo utf8_encode($datos['usuario'])?></h5>
					</figcaption>
				</figure>
				<ul class="full-box list-unstyled text-center">
					<li>
						<a href="#!" class="btn-exit-system">
							<i class="zmdi zmdi-power"></i>
						</a>
					</li>
				</ul>
			</div>
			<!-- SideBar Menu -->
			<ul class="list-unstyled full-box dashboard-sideBar-Menu">
			    <?php if($datos['tipousuario_idtipousuario'] == '1' || $datos['tipousuario_idtipousuario'] == '2' || $datos['tipousuario_idtipousuario'] == '3'){ ?>
				<li>
					<a href="home.php">
						<i class="zmdi zmdi-view-dashboard zmdi-hc-fw"></i> Dashboard
					</a>
				</li>
				<?php } ?>
				<?php  if($datos['tipousuario_idtipousuario'] == '1'){ ?>
				<li>
					<a href="#!" class="btn-sideBar-SubMenu">
						<i class="zmdi zmdi-case zmdi-hc-fw"></i> Mantenimiento <i class="zmdi zmdi-caret-down pull-right"></i>
					</a>
					<ul class="list-unstyled full-box">
						<li>
							<a href="mantenimiento.php"><i class="zmdi zmdi-wrench"></i> Mantenimiento a Equipo</a>
						</li>
						<li>
							<a href="equipo.php"><i class="zmdi zmdi-laptop-chromebook"></i> Equipo</a>
						</li>
						 <li>
							<a href="tipoestadoequipo.php"><i class="zmdi zmdi-flag"></i> Tipo Estado Equipo</a>
						</li>
						<!-- <li>
							<a href="salon.html"><i class="zmdi zmdi-font zmdi-hc-fw"></i> Salon</a>
						</li>  -->
					</ul>
				</li>
				<li>
					<a href="#!" class="btn-sideBar-SubMenu">
						<i class="zmdi zmdi-account-add zmdi-hc-fw"></i> Usuarios <i class="zmdi zmdi-caret-down pull-right"></i>
					</a>
					<ul class="list-unstyled full-box">
						<li>
							<a href="usuarios.php"><i class="zmdi zmdi-account zmdi-hc-fw"></i> Empleados</a>
						</li>
						<li>
							<a href="tipousuarios.php"><i class="zmdi zmdi-accounts-add"></i> Tipo Usuarios</a>
						</li>
						<!-- <li>
							<a href="student.html"><i class="zmdi zmdi-face zmdi-hc-fw"></i> Student</a>
						</li>
						<li>
							<a href="representative.html"><i class="zmdi zmdi-male-female zmdi-hc-fw"></i> Representative</a>
						</li> -->
					</ul>
				</li>
				<?php } ?>
				<?php if( $datos['tipousuario_idtipousuario'] == '1' || $datos['tipousuario_idtipousuario'] == '2' || $datos['tipousuario_idtipousuario'] == '3'){ ?>
				<li>
					<a href="#!" class="btn-sideBar-SubMenu">
						<i class="zmdi zmdi-card zmdi-hc-fw"></i> Tickets <i class="zmdi zmdi-caret-down pull-right"></i>
					</a>
					<ul class="list-unstyled full-box">
						<?php if( $datos['tipousuario_idtipousuario'] == '1'){ ?>
						<li>
							<a href="ticket.php"> <i class="zmdi zmdi-money-box zmdi-hc-fw"></i> Tickets</a>
						</li>
						<?php } ?>
						<?php if( $datos['tipousuario_idtipousuario'] == '1' || $datos['tipousuario_idtipousuario'] == '2' || $datos['tipousuario_idtipousuario'] == '3'){ ?>
						<li>
							<a href="mistickets.php"> <i class="zmdi zmdi-notifications"></i> Mis Tickets</a>
						</li>
						<?php } ?>
						<?php if( $datos['tipousuario_idtipousuario'] == '1'){ ?>
						<li>
							<a href="estadoticket.php"> <i class="zmdi zmdi-label"></i> Estado de Tickets</a>
						</li>
						<?php } ?>
					</ul>
				</li>
				<?php } ?>
				<?php if( $datos['tipousuario_idtipousuario'] == '1'){ ?>
				<li>
					<a href="#!" class="btn-sideBar-SubMenu">
						<i class="zmdi zmdi-store"></i> Centros de Negocios <i class="zmdi zmdi-caret-down pull-right"></i>
					</a>
					<ul class="list-unstyled full-box">
						<li>
							<a href="centros.php"><i class="zmdi zmdi-pin-drop"></i> Centros de Negocios</a>
						</li>
						<li>
							<a href="areas.php"><i class="zmdi zmdi-input-antenna"></i> ??reas</a>
						</li>
					</ul>
				</li>	
				<?php } ?>
				<?php if($datos['tipousuario_idtipousuario'] == '1' || $datos['tipousuario_idtipousuario'] == '3'){ ?>
				<li>
					<a href="#!" class="btn-sideBar-SubMenu">
						<i class="zmdi zmdi-time"></i> Asistencias <i class="zmdi zmdi-caret-down pull-right"></i>
					</a>
					<ul class="list-unstyled full-box">
					    <?php if($datos['tipousuario_idtipousuario'] == '1' || $datos['tipousuario_idtipousuario'] == '3'){ ?>
						<li>
							<a href="asistencia.php"><i class="zmdi zmdi-calendar-check"></i> Lista de Asistencias</a>
						</li>
						<?php } ?>
						<?php if($datos['tipousuario_idtipousuario'] == '1'){ ?>	
						<li>
							<a href="estadotiempo.php"><i class="zmdi zmdi-memory"></i> Estados Tiempo</a>
						</li>
						<?php } ?>
					</ul>
				</li>
				<?php if( $datos['tipousuario_idtipousuario'] == '1'){ ?>
				<li>
					<a href="#!" class="btn-sideBar-SubMenu">
					<i class="zmdi zmdi-file-text"></i> Reportes <i class="zmdi zmdi-caret-down pull-right"></i>
					</a>
					<ul class="list-unstyled full-box">
						<li>
							<a href="reportesgeneral.php"><i class="zmdi zmdi-folder"></i> Secci??n de Reportes</a>
						</li>
					</ul>
				</li>	
				<?php } ?>	
				<?php } ?>	
			</ul>
		</div>
	</section>
	<?php } ?>


	<!-- Content page-->
	<section class="full-box dashboard-contentPage">
		<!-- NavBar -->
		<nav class="full-box dashboard-Navbar">
			<ul class="full-box list-unstyled text-right">
				<li class="pull-left">
					<a href="#!" class="btn-menu-dashboard"><i class="zmdi zmdi-more-vert"></i></a>
				</li>
				<!-- <li>
					<a href="#!" class="btn-Notifications-area">
						<i class="zmdi zmdi-notifications-none"></i>
						<span class="badge">7</span>
					</a>
				</li>
				<li>
					<a href="#!" class="btn-search">
						<i class="zmdi zmdi-search"></i>
					</a>
				</li>
				<li>
					<a href="#!" class="btn-modal-help">
						<i class="zmdi zmdi-help-outline"></i>
					</a>
				</li> -->
			</ul>
		</nav>
		<!-- Content page -->
		<div class="container-fluid">
			<div class="page-header">
			  <h1 class="text-titles"><i class="zmdi zmdi-time"></i> Control de  <small>Tiempo</small></h1>
			</div>
			<p class="lead">Podr??s verificar tu asistencia y la de los empleados. Puedes realizar reportes de asistencia por usuario, fechas e incluso por centros de negocios.</p>
		</div>
		<div class="container-fluid">
			<div class="row">
				<div class="col-xs-12">
					<ul class="nav nav-tabs" style="margin-bottom: 15px;">
					  	<li class="active"><a href="#new" data-toggle="tab">Nueva Asistencia</a></li>
					  	<li><a href="#list" data-toggle="tab">Lista Asistencias</a></li>
						<li><a href="#reportes" data-toggle="tab">Reportes</a></li>
					</ul>
					<div id="myTabContent" class="tab-content">
						<div class="tab-pane fade active in" id="new">
							<div class="container-fluid">
							<fieldset class="text-center">Asistencias de ANLI</fieldset>
								<div class="row">
									<div class="col-md-4">
										<div class="form-group label-floating">
											<label class="control-label">Fecha y Hora</label>
											<input class="form-control" readonly type="text" id="fechaAsis">
										</div>
									</div>
									<div class="col-md-2"></div>
									<div class="col-md-4">
										<div class="form-group">
											<!-- <label class="control-label">Asistencia: </label> -->
											<select class="form-control" id="slcestado">
												<option value="0" disabled="disabled" selected="true">-- Seleccione el Motivo de Asitencia --</option>
												<?php foreach($queryEstado as $estado){ ?>
												<option value="<?php echo $estado['idestadotiempo'] ?>"><?php echo utf8_encode($estado['estadotiempo']) ?></option>
												<?php } ?>
											</select>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-4">
										<div class="form-group">
												<!-- <label class="control-label">Centro de Negocios</label> -->
											<select class="form-control" id="slccentro">
												<option value="0" disabled="disabled" selected="true">-- Seleccione un Centro de Negocios --</option>
												<?php foreach($queryCentros as $centro){ ?>
												<option value="<?php echo $centro['idcentronegocio'] ?>"><?php echo utf8_encode($centro['centronegocio']) ?> / <?php echo utf8_encode($centro['estadocn'])  ?></option>
												<?php } ?>
											</select>
										</div>
									</div>
									<div class="col-md-2"></div>
									<div class="col-md-4">
										<!-- <div class="form-group">
											<select class="form-control" id="slcusuario">
												  <option value="0" disabled="disabled" selected="true">-- Seleccione un Usuario --</option>
													<?php// foreach($queryUsuario as $usuario){ ?>
													<option value="<?php //echo $usuario['idusuario'] ?>"><?php// echo utf8_encode($usuario['nombre']) ?> <?php// echo utf8_encode($usuario['apellidopa']) ?> <?php // echo utf8_encode($usuario['apellidoma']) ?></option>
													<?php// } ?>
											</select>
										</div> -->
									</div>
								</div>
								<div class="row">
									<div class="col-md-4">
										<div class="form-group label-floating">
											  <label class="control-label">Ingresa tu Usuario</label>
											  <input class="form-control" type="text" id="txtusuario" autocomplete="off">
										</div>
									</div>
									<div class="col-md-2"></div>
									<div class="col-md-4">
										<div class="form-group label-floating">
											  <label class="control-label">Ingresa tu Contrase??a</label>
											  <input class="form-control" type="text" id="txtpsw" autocomplete="off">
										</div>
									</div>
								</div>
								<p class="text-center">
									<button type="button" onclick="InsertarAsistencia2()"  class="btn btn-info btn-raised btn-sm"><i class="zmdi zmdi-floppy"></i> Save</button>
								</p>
							</div>
						</div>
					  	<div class="tab-pane fade" id="list">
							<div class="table-responsive">
								<table id="id_tabla_asistencia" style="width: 100%" class="display table table-hover text-center">
									<thead>
										<tr>
											<th class="text-center">Empleado</th>
											<th class="text-center">Fecha y Hora</th>
											<th class="text-center">CN y Estado</th>
											<th class="text-center">Motivo</th>
											<!-- <th class="text-center">Update</th>
											<th class="text-center">Delete</th> -->
										</tr>
									</thead>
									<tbody>
										<?php foreach($queryTabla as $tabla){?>
										<tr>
											<td><?php echo utf8_encode($tabla['nombre']) ?> <?php echo utf8_encode($tabla['apellidopa']) ?> <?php echo utf8_encode($tabla['apellidoma'])?></td>
											<td><?php echo utf8_encode($tabla['fechatiempo']) ?>  <?php echo utf8_encode($tabla['horatiempo']) ?></td>
											<td><?php echo utf8_encode($tabla['centronegocio']) ?> / <?php echo utf8_encode($tabla['estadocn']) ?></td>
											<td><?php echo utf8_encode($tabla['estadotiempo']) ?></td>
											<!-- <td><a href="#!" class="btn btn-success btn-raised btn-xs"><i class="zmdi zmdi-refresh"></i></a></td>
											<td><a href="#!" class="btn btn-danger btn-raised btn-xs"><i class="zmdi zmdi-delete"></i></a></td> -->
										</tr>
										<?php } ?>
									</tbody>
								</table>
							</div>
					  	</div>
						  <div class="tab-pane fade" id="reportes">
							<!-- <div class="table-responsive"> -->
								<div class="container">
									<div class="row">
										<div class="col-md-6">
											<a data-toggle="modal" data-target="#ModalPdfUsuario" class="btn btn-success btn-raised ml-4"> <i class="zmdi zmdi-file-text"></i> Por Usuario</a>
										</div>
										<div class="col-md-6">
											<a data-toggle="modal" data-target="#ModalPdfCentros" class="btn btn-success btn-raised ml-4"> <i class="zmdi zmdi-file-text"></i> Por Centros de Negocios</a>
										</div>
									</div>
									<div class="row">
										<div class="col-md-6">
											<a data-toggle="modal" data-target="#ModalPdfFechaAsistencia" class="btn btn-success btn-raised ml-4"> <i class="zmdi zmdi-file-text"></i> Por Fecha</a>
										</div>
										<div class="col-md-6">
											<a data-toggle="modal" data-target="#ModalPdfFechaCNAsistencia" class="btn btn-success btn-raised ml-4"> <i class="zmdi zmdi-file-text"></i> Por Fecha y CN</a>
										</div>
									</div>
									<!-- POR MOTIVOS DE CHECK-->
									<div class="row">
										<div class="col-md-6">
											<a data-toggle="modal" data-target="#ModalPdfUsuarioIrComer" class="btn btn-success btn-raised ml-4"> <i class="zmdi zmdi-file-text"></i> Usuario y Motivo</a>
										</div>
										<div class="col-md-6">
											<a data-toggle="modal" data-target="#ModalPdfUsuarioFechaCN" class="btn btn-success btn-raised ml-4"> <i class="zmdi zmdi-file-text"></i> Motivos</a>
										</div>
									</div>
									<div class="row">
										<div class="col-md-6">
											<a data-toggle="modal" data-target="#ModalCumple" class="btn btn-success btn-raised ml-4"> <i class="zmdi zmdi-file-text"></i> Cumplea??os</a>
										</div>
									</div>
								</div>
							<!-- </div> -->
					  	</div>
					</div>
				</div>
			</div>
		</div>
	</section>



<!-- Modal PDF por Usuario-->
<div class="modal fade" id="ModalPdfUsuario" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h2 class="modal-title" id="exampleModalLabel">Generar Reporte por Usuario</h2>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
	  <div class="form-group label-floating">
			<div class="form-group">
				<select class="form-control" id="slcCentroUsuarioPDF">
					<option value="0" disabled="disabled" selected="true">-- Seleccione un CN --</option>
					<?php foreach($queryCentros as $centro){ ?>
					<option value="<?php echo $centro['idcentronegocio'] ?>"><?php echo utf8_encode($centro['centronegocio']) ?> / <?php echo utf8_encode($centro['estadocn'])  ?></option>
					<?php } ?>
				</select>
			</div>
		</div>
	  	<div class="form-group label-floating">
			<div class="form-group">
				<select class="form-control" id="slcusuarioReportePDF">
					<option value="0" disabled="disabled" selected="true">-- Seleccione un Usuario --</option>
					<?php foreach($queryUsuario as $usuario){ ?>
					<option value="<?php echo $usuario['idusuario'] ?>"><?php echo utf8_encode($usuario['nombre']) ?> <?php echo utf8_encode($usuario['apellidopa']) ?> <?php echo utf8_encode($usuario['apellidoma']) ?></option>
					<?php } ?>
				</select>
			</div>
		</div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
        <button type="button" id="rptEntradasUsuario" class="btn btn-primary"> <i class="zmdi zmdi-file-text"></i> Generar Reporte</button>
      </div>
    </div>
  </div>
</div>

<!-- Modal PDF por Usuario-->
<div class="modal fade" id="ModalCumple" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h2 class="modal-title" id="exampleModalLabel">Generar Reporte Cumplea??os</h2>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
	  <div class="form-group label-floating">
			<div class="form-group">
				<select class="form-control" id="slccumple">
					<option value="0" disabled="disabled" selected="true">-- Seleccione un mes --</option>
					<option value="1">Enero</option>
					<option value="2">Febrero</option>
					<option value="3">Marzo</option>
					<option value="4">Abril</option>
					<option value="5">Mayo</option>
					<option value="6">Junio</option>
					<option value="7">Julio</option>
					<option value="8">Agosto</option>
					<option value="9">Septiembre</option>
					<option value="10">Octubre</option>
					<option value="11">Noviembre</option>
					<option value="12">Diciembre</option>
				</select>
			</div>
		</div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
        <button type="button" id="btnrptcumple" class="btn btn-primary"> <i class="zmdi zmdi-file-text"></i> Generar Reporte</button>
      </div>
    </div>
  </div>
</div>

<!-- Modal PDF CN-->
<div class="modal fade" id="ModalPdfCentros" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h2 class="modal-title" id="exampleModalLabel">Generar Reporte por CN</h2>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
	  	<div class="form-group label-floating">
		  <div class="form-group">
				<!-- <label class="control-label">Centro de Negocios</label> -->
				<select class="form-control" id="slccentroPDF">
					<option value="0" disabled="disabled" selected="true">-- Seleccione un Centro de Negocios --</option>
					<?php foreach($queryCentros as $centro){ ?>
					<option value="<?php echo $centro['idcentronegocio'] ?>"><?php echo utf8_encode($centro['centronegocio']) ?> / <?php echo utf8_encode($centro['estadocn']) ?></option>
					<?php } ?>
				</select>
			</div>
		</div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
        <button type="button" id="rptEntradasCN" class="btn btn-primary"> <i class="zmdi zmdi-file-text"></i> Generar Reporte</button>
      </div>
    </div>
  </div>
</div>


<!-- Modal PDF FECHA-->
<div class="modal fade" id="ModalPdfFechaAsistencia" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h2 class="modal-title" id="exampleModalLabel">Generar Reporte por CN</h2>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
	  	<div class="form-group label-floating">
			<label>Este reporte genera una lista de asistencia por el d??a seleccionado</label>
			<input type="date" id="idfechaasistenciarpt2fecha">
			<input type="date" id="idfechaasistenciarpt2fecha2">
		</div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
        <button type="button" id="btnrptFechaAsistencia" class="btn btn-primary"> <i class="zmdi zmdi-file-text"></i> Generar Reporte</button>
      </div>
    </div>
  </div>
</div>


<!-- Modal PDF FECHA y CN-->
<div class="modal fade" id="ModalPdfFechaCNAsistencia" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h2 class="modal-title" id="exampleModalLabel">Generar Reporte por CN  FECHAS</h2>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
	  <div class="form-group label-floating">
		  <div class="form-group">
				<!-- <label class="control-label">Centro de Negocios</label> -->
				<select class="form-control" id="slccentroAsistenciaPDF">
					<option value="0" disabled="disabled" selected="true">-- Seleccione un Centro de Negocios --</option>
					<?php foreach($queryCentros as $centro){ ?>
					<option value="<?php echo $centro['idcentronegocio'] ?>"><?php echo utf8_encode($centro['centronegocio']) ?> / <?php echo utf8_encode($centro['estadocn']) ?></option>
					<?php } ?>
				</select>
			</div>
		</div>
	  	<div class="form-group label-floating">
			<label>Este reporte genera una lista de asistencia por el d??a seleccionado</label>
			<input type="date" id="idfechaasistenciarptasistencia">
			<input type="date" id="idfechaasistenciarpt2asistencia">
		</div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
        <button type="button" id="btnrptFechaCNAsistencia" class="btn btn-primary"> <i class="zmdi zmdi-file-text"></i> Generar Reporte</button>
      </div>
    </div>
  </div>
</div>



<!-- Modal PDF por MOTIVO IR A COMER-->
<div class="modal fade" id="ModalPdfUsuarioIrComer" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h2 class="modal-title" id="exampleModalLabel">Generar Reporte Ir a Comer</h2>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
	  <div class="form-group label-floating">
			<div class="form-group">
				<select class="form-control" id="slcCentroUsuarioPDFMotivo">
					<option value="0" disabled="disabled" selected="true">-- Seleccione un CN --</option>
					<?php foreach($queryCentros as $centro){ ?>
					<option value="<?php echo $centro['idcentronegocio'] ?>"><?php echo utf8_encode($centro['centronegocio']) ?> / <?php echo utf8_encode($centro['estadocn'])  ?></option>
					<?php } ?>
				</select>
			</div>
		</div>
	  	<div class="form-group label-floating">
			<div class="form-group">
				<select class="form-control" id="slcusuarioReportePDFMotivoUser">
					<option value="0" disabled="disabled" selected="true">-- Seleccione un Usuario --</option>
					<?php foreach($queryUsuario as $usuario){ ?>
					<option value="<?php echo $usuario['idusuario'] ?>"><?php echo utf8_encode($usuario['nombre']) ?> <?php echo utf8_encode($usuario['apellidopa']) ?> <?php echo utf8_encode($usuario['apellidoma']) ?></option>
					<?php } ?>
				</select>
			</div>
		</div>
		<div class="form-group label-floating">
			<div class="form-group">
				<select class="form-control" id="slcusuarioReportePDFMotivo">
					<option value="0" disabled="disabled" selected="true">-- Seleccione un Motivo --</option>
					<?php foreach($queryEstado as $estado){ ?>
					<option value="<?php echo $estado['idestadotiempo'] ?>"><?php echo utf8_encode($estado['estadotiempo']) ?></option>
					<?php } ?>
				</select>
			</div>
		</div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
        <button type="button" id="rptEntradasUsuarioMotivo" class="btn btn-primary"> <i class="zmdi zmdi-file-text"></i> Generar Reporte</button>
      </div>
    </div>
  </div>
</div>


<!-- Modal PDF por MOTIVO IR A COMER-->
<div class="modal fade" id="ModalPdfUsuarioFechaCN" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h2 class="modal-title" id="exampleModalLabel">Generar Reporte de Motivo en CN</h2>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
	  <div class="form-group label-floating">
	  <div class="form-group">
				<select class="form-control" id="slcusuarioReportePDFMotivoMotivoCN">
					<option value="0" disabled="disabled" selected="true">-- Seleccione un Motivo --</option>
					<?php foreach($queryEstado as $estado){ ?>
					<option value="<?php echo $estado['idestadotiempo'] ?>"><?php echo utf8_encode($estado['estadotiempo']) ?></option>
					<?php } ?>
				</select>
			</div>
		</div>
		<div class="form-group label-floating">
			<label>Este reporte genera una lista de asistencia por el d??a seleccionado</label>
			<input type="date" id="idfechaasistenciarptasistenciaMotivoCN">
			<input type="date" id="idfechaasistenciarpt2asistenciaMotivoCN">
		</div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
        <button type="button" id="rptEntradasUsuarioMotivoMotivoCN" class="btn btn-primary"> <i class="zmdi zmdi-file-text"></i> Generar Reporte</button>
      </div>
    </div>
  </div>
</div>


	<!--====== Scripts -->
	<script src="./js/jquery-3.1.1.min.js"></script>
	<script src="./js/sweetalert2.min.js"></script>
	<script src="./js/bootstrap.min.js"></script>
	<script src="./js/material.min.js"></script>
	<script src="./js/ripples.min.js"></script>
	<script src="./js/jquery.mCustomScrollbar.concat.min.js"></script>
	<script src="../Controlador/ControladorAsistencia.js"></script>
	<script src="../Controlador/ReporteUsuario.js"></script>
	<script src="./js/main.js"></script>
	<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.js"></script>
	<script>
		$.material.init();
	</script>
</body>
</html>