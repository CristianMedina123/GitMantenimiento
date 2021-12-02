<?php
	session_start();//iniciar la sesion
include '../Modelo/conexion.php';
//Query Usuarios
$queryUsuario = mysqli_query($conn,"SELECT usuario.idusuario, usuario.nombre, usuario.apellidopa, usuario.apellidoma FROM usuario
INNER JOIN centronegocio
ON usuario.CentroNegocio_idCentroNegocio = centronegocio.IdCentroNegocio
WHERE usuario.CentroNegocio_idCentroNegocio = 1 ORDER BY nombre ASC");
//Query para extraer el estado del ticket
$queryEstado = mysqli_query($conn, "SELECT idestadoticket, estadoticket FROM estadoticket ORDER BY estadoticket ASC");

$queryTabla = mysqli_query($conn, "SELECT a.nombre, a.apellidopa,a.apellidoma, b.nombre as asignado, b.apellidopa as asignadoape, b.apellidoma as asignadoape2, ticket.idticket,ticket.ticket, estadoticket.estadoticket, ticket.descripcion, ticket.fechaticket, ticket.observacionpendiente, ticket.observacionproceso, ticket.observacioncompleto FROM ticket
INNER JOIN usuario as a
ON ticket.Usuario_IdUsuario = a.IdUsuario
INNER JOIN usuario as b
ON ticket.UsuarioAsignado = b.IdUsuario
INNER JOIN estadoticket
ON ticket.EstadoTicket_IdEstadoTicket = estadoticket.IdEstadoTicket ORDER BY ticket.fechaticket DESC");

$queryTablaAsignado = mysqli_query($conn,"SELECT ticket.idticket,ticket.usuarioasignado, usuario.nombre, usuario.apellidopa, usuario.apellidoma FROM ticket
INNER JOIN usuario
ON ticket.UsuarioAsignado = usuario.IdUsuario");

$queryCentroTepic = mysqli_query($conn, "SELECT usuario.idusuario, usuario.nombre, usuario.apellidopa, usuario.apellidoma FROM usuario
INNER JOIN centronegocio
ON usuario.CentroNegocio_idCentroNegocio = centronegocio.IdCentroNegocio
WHERE IdCentroNegocio = 1");

$queryCN = mysqli_query($conn, "SELECT idcentronegocio, centronegocio, estadocn FROM centronegocio ORDER BY centronegocio ASC");

$varsesion = $_SESSION['IdUsuario'];

if($varsesion == null || $varsesion = ''){
	header("Location: ../index.html");
	die();
}

$topo = $_SESSION['IdUsuario'];
$query = "SELECT IdUsuario, Usuario, Nombre, ApellidoPa ,TipoUsuario_IdTipoUsuario FROM usuario WHERE IdUsuario = $topo";
$resultado = mysqli_query($conn,$query);

?>
<!DOCTYPE html>
<html lang="es">
<head>
	<title>Tickets</title>
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
				<h4><?php echo utf8_encode($datos['Nombre'])?> <?php echo utf8_encode($datos['ApellidoPa'])?></h4>
				 <i class="zmdi zmdi-close btn-menu-dashboard visible-xs"></i>
			</div>
			<!-- SideBar User info -->
			<div class="full-box dashboard-sideBar-UserInfo">
				<figure class="full-box">
					<img src="./assets/img/LogoHome.png" alt="UserIcon">
					<figcaption class="text-center text-titles">
						<h5><?php echo utf8_encode($datos['Usuario'])?></h5>
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
			    <?php if($datos['TipoUsuario_IdTipoUsuario'] == '1' || $datos['TipoUsuario_IdTipoUsuario'] == '2' || $datos['TipoUsuario_IdTipoUsuario'] == '3'){ ?>
				<li>
					<a href="home.php">
						<i class="zmdi zmdi-view-dashboard zmdi-hc-fw"></i> Dashboard
					</a>
				</li>
				<?php } ?>
				<?php  if($datos['TipoUsuario_IdTipoUsuario'] == '1'){ ?>
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
					</ul>
				</li>
				<li>
					<a href="#!" class="btn-sideBar-SubMenu">
						<i class="zmdi zmdi-account-add zmdi-hc-fw"></i> Usuarios <i class="zmdi zmdi-caret-down pull-right"></i>
					</a>
					<ul class="list-unstyled full-box">
						<li>
							<a href="usuarios.php"><i class="zmdi zmdi-account zmdi-hc-fw"></i> Administradores</a>
						</li>
						<li>
							<a href="tipousuarios.php"><i class="zmdi zmdi-accounts-add"></i> Tipo Usuarios</a>
						</li>
					</ul>
				</li>
				<?php } ?>
				<?php if( $datos['TipoUsuario_IdTipoUsuario'] == '1' || $datos['TipoUsuario_IdTipoUsuario'] == '2' || $datos['TipoUsuario_IdTipoUsuario'] == '3'){ ?>
				<li>
					<a href="#!" class="btn-sideBar-SubMenu">
						<i class="zmdi zmdi-card zmdi-hc-fw"></i> Tickets <i class="zmdi zmdi-caret-down pull-right"></i>
					</a>
					<ul class="list-unstyled full-box">
						<?php if( $datos['TipoUsuario_IdTipoUsuario'] == '1' || $datos['TipoUsuario_IdTipoUsuario'] == '2' || $datos['TipoUsuario_IdTipoUsuario'] == '3'){ ?>
						<li>
							<a href="ticket.php"> <i class="zmdi zmdi-money-box zmdi-hc-fw"></i> Tickets</a>
						</li>
						<?php } ?>
						<?php if( $datos['TipoUsuario_IdTipoUsuario'] == '1' || $datos['TipoUsuario_IdTipoUsuario'] == '2' || $datos['TipoUsuario_IdTipoUsuario'] == '3'){ ?>
						<li>
							<a href="mistickets.php"> <i class="zmdi zmdi-notifications"></i> Mis Tickets</a>
						</li>
						<?php } ?>
						<?php if( $datos['TipoUsuario_IdTipoUsuario'] == '1'){ ?>
						<li>
							<a href="estadoticket.php"> <i class="zmdi zmdi-label"></i> Estado de Tickets</a>
						</li>
						<?php } ?>
					</ul>
				</li>
				<?php } ?>
				<?php if( $datos['TipoUsuario_IdTipoUsuario'] == '1'){ ?>
				<li>
					<a href="#!" class="btn-sideBar-SubMenu">
						<i class="zmdi zmdi-store"></i> Centros de Negocios <i class="zmdi zmdi-caret-down pull-right"></i>
					</a>
					<ul class="list-unstyled full-box">
						<li>
							<a href="centros.php"><i class="zmdi zmdi-pin-drop"></i> Centros de Negocios</a>
						</li>
						<li>
							<a href="areas.php"><i class="zmdi zmdi-input-antenna"></i> Áreas</a>
						</li>
					</ul>
				</li>	
				<?php } ?>
				<?php if($datos['TipoUsuario_IdTipoUsuario'] == '1' || $datos['TipoUsuario_IdTipoUsuario'] == '3'){ ?>
				<li>
					<a href="#!" class="btn-sideBar-SubMenu">
						<i class="zmdi zmdi-time"></i> Asistencias <i class="zmdi zmdi-caret-down pull-right"></i>
					</a>
					<ul class="list-unstyled full-box">
					    <?php if($datos['TipoUsuario_IdTipoUsuario'] == '1' || $datos['TipoUsuario_IdTipoUsuario'] == '3'){ ?>
						<li>
							<a href="asistencia.php"><i class="zmdi zmdi-calendar-check"></i> Lista de Asistencias</a>
						</li>
						<?php } ?>
						<?php if($datos['TipoUsuario_IdTipoUsuario'] == '1'){ ?>	
						<li>
							<a href="estadotiempo.php"><i class="zmdi zmdi-memory"></i> Estados Tiempo</a>
						</li>
						<?php } ?>
					</ul>
				</li>
				<?php } ?>	
			</ul>
		</div>
	</section>


	<!-- Content page-->
	<section class="full-box dashboard-contentPage">
		<!-- NavBar -->
		<nav class="full-box dashboard-Navbar">
			<ul class="full-box list-unstyled text-right">
				<li class="pull-left">
					<a href="#!" class="btn-menu-dashboard"><i class="zmdi zmdi-more-vert"></i></a>
				</li>
			</ul>
		</nav>
		<!-- Content page -->
		<?php if( $datos['TipoUsuario_IdTipoUsuario'] == '1' || $datos['TipoUsuario_IdTipoUsuario'] == '2' || $datos['TipoUsuario_IdTipoUsuario'] == '3' ){ ?>
		<div class="container-fluid">
			<div class="page-header">
			  <h1 class="text-titles"><i class="zmdi zmdi-money-box zmdi-hc-fw"></i> Ticket <small>de ANLI</small></h1>
			</div>
			<p class="lead">El apartado de los Tickets es para dar un mejor seguimiento de los procesos que son asignados al personal de ANLI.</p>
		</div>
		<div class="container-fluid">
			<div class="row">
				<div class="col-xs-12">
					<ul class="nav nav-tabs" style="margin-bottom: 15px;">
					  	<li class="active"><a href="#new" data-toggle="tab">Nuevo Ticket</a></li>
						  <?php if($datos['TipoUsuario_IdTipoUsuario'] == '1'){ ?>
					  		<li><a href="#list" data-toggle="tab">Lista de Tickets</a></li>
							<li><a href="#pdf" data-toggle="tab">PDF</a></li>
						  <?php } ?>	
					</ul>
					<div id="myTabContent" class="tab-content">
						<div class="tab-pane fade active in" id="new">
							<div class="container-fluid">
								<div class="row">
									<div class="col-xs-12 col-md-6 ">
									    <div class="form-group label-floating">
											<label class="control-label">Motivo Ticket</label>
											<input class="form-control" type="text" id="txtticket" autocomplete="off">
										</div>
										<div class="form-group label-floating">
											<label class="control-label">Descripción</label>
											<input class="form-control" type="text" id="txtdesc" autocomplete="off">
										</div>
										<div class="form-group label-floating">
											<input type="date" class="form-control" id="fecha" autocomplete="off">
										</div>
										<div class="form-group">
										    <label class="control-label">Estado de Ticket</label>
										    <select class="form-control" id="slcestado">
										        <option value="0" disabled="disabled" selected="true">-- Estado del Ticket --</option>
										        <?php foreach($queryEstado as $estado){?>
												<option value="<?php echo $estado['idestadoticket'] ?>"><?php echo utf8_encode($estado['estadoticket']) ?></option>
												<?php } ?>
										    </select>
										</div>
										<br />
										<p class="text-center">
										    <button type="button" onclick="InsertarTicket()" class="btn btn-info btn-raised btn-sm"><i class="zmdi zmdi-floppy"></i> Save</button>
										</p>
									</div>
									<div class="col-xs-12 col-md-6 ">
										<div class="form-group">
										    <label class="control-label">Seleccione un CN responsable</label>
										    <select class="form-control" id="slccnticket">
										        <option value="0" disabled="disabled" selected="true">-- Seleccione un CN --</option>
												<?php foreach($queryCN as $cn){ ?>
										        <option value="<?php echo $cn['idcentronegocio']  ?>"><?php echo utf8_encode($cn['centronegocio']) ?> / <?php echo utf8_encode($cn['estadocn']) ?></option>
												<?php } ?>
										    </select>
										</div>
									</div>	
									<div class="col-xs-12 col-md-6 ">
										<div class="form-group">
										    <label class="control-label">Seleccione al Usuario</label>
										    <select class="form-control" id="slcticketusuario">
										        <option value="0" disabled="disabled" selected="true">-- Seleccione al Usuario responsable --</option>
												<?php foreach($queryUsuario as $usuario){ ?>
										        <option value="<?php echo $usuario['idusuario']  ?>"><?php echo utf8_encode($usuario['nombre']) ?> <?php echo utf8_encode($usuario['apellidopa']) ?> <?php echo utf8_encode($usuario['apellidoma']) ?></option>
												<?php } ?>
										    </select>
										</div>
										<!-- <div class="form-group label-floating">
											<label class="control-label">Observación</label>
											<input type="text" class="form-control" id="txtobs" autocomplete="off">
										</div> -->

										<div class="form-group">
										    <label class="control-label">Seleccione un CN Creador</label>
										    <select class="form-control" id="slccnticketcreador">
										        <option value="0" disabled="disabled" selected="true">-- Seleccione un CN Creador --</option>
												<?php foreach($queryCN as $cn){ ?>
										        <option value="<?php echo $cn['idcentronegocio']  ?>"><?php echo utf8_encode($cn['centronegocio']) ?> / <?php echo utf8_encode($cn['estadocn']) ?></option>
												<?php } ?>
										    </select>
										</div>

										<div class="form-group">
										    <label class="control-label">Seleccione al Usuario</label>
										    <select class="form-control" id="slccreador">
										        <option value="0" disabled="disabled" selected="true">-- Seleccione al Usuario Creador Ticket --</option>
												<?php foreach($queryUsuario as $usuario){ ?>
										        <option value="<?php echo $usuario['idusuario']  ?>"><?php echo utf8_encode($usuario['nombre']) ?> <?php echo utf8_encode($usuario['apellidopa']) ?> <?php echo utf8_encode($usuario['apellidoma']) ?></option>
												<?php } ?>
										    </select>
										</div>
									</div>
								</div>
							</div>
						</div>
					  	<div class="tab-pane fade" id="list">
							<div class="table-responsive">
								<table id="id_tabla_ticket" style="width: 100%" class="table table-hover text-center">
									<thead>
										<tr>
											<th class="text-center">Creador</th>
											<th class="text-center">Ticket</th>
											<th class="text-center">Estado Ticket</th>
											<th class="text-center">Descripción</th>
											<th class="text-center">Fecha</th>
											<th class="text-center">Asignado</th>
											<th class="text-center">Antes</th>
											<th class="text-center">Durante</th>
											<th class="text-center">Después</th>
											<th class="text-center">Eliminar</th>
										</tr>
									</thead>
									<tbody>
										<?php foreach($queryTabla as $tabla){ ?>
										<tr>
											<td><?php echo utf8_encode( $tabla['nombre'] ) ?> <?php echo utf8_encode( $tabla['apellidopa']) ?> <?php echo utf8_encode( $tabla['apellidoma']) ?></td>
											<td><?php echo utf8_encode( $tabla['ticket']) ?></td>
											<td><?php echo utf8_encode( $tabla['estadoticket']) ?></td>
											<td><?php echo utf8_encode( $tabla['descripcion']) ?></td>
											<td><?php echo utf8_encode( $tabla['fechaticket']) ?></td>
											<td><?php echo utf8_encode( $tabla['asignado']) ?> <?php echo utf8_encode( $tabla['asignadoape']) ?> <?php echo utf8_encode( $tabla['asignadoape2']) ?></td>
											<td><?php echo utf8_encode( $tabla['observacionpendiente']) ?></td>
											<td><?php echo utf8_encode( $tabla['observacionproceso']) ?></td>
											<td><?php echo utf8_encode( $tabla['observacioncompleto']) ?></td>
										<td ><button type="button" onclick="EliminarTicket(<?php echo $tabla['idticket'] ?>)" class="btn btn-danger btn-raised btn-xs"><i class="zmdi zmdi-delete"></i></button></td>
										</tr>
										<?php } ?>
									</tbody>
								</table>
							</div>
					  	</div>
						  <div class="tab-pane fade" id="pdf">
								<div class="container">
									<div class="row">
										<div class="col-md-6">
											<a data-toggle="modal" data-target="#ModalPdfPendientes" class="btn btn-warning btn-raised ml-4"> <i class="zmdi zmdi-file-text"></i> Tickets Pendientes</a>
										</div>
										<div class="col-md-6">
											<a data-toggle="modal" data-target="#ModalPdfProceso" class="btn btn-warning btn-raised ml-4"> <i class="zmdi zmdi-file-text"></i> Tickets en Proceso</a>
										</div>
									</div>
									<div class="row">
										<div class="col-md-6">
											<a data-toggle="modal" data-target="#ModalPdfHechos" class="btn btn-warning btn-raised ml-4"> <i class="zmdi zmdi-file-text"></i> Ticket Hechos</a>
										</div>
										<div class="col-md-6">
											<a data-toggle="modal" data-target="#ModalPdfUsuario" class="btn btn-warning btn-raised ml-4"> <i class="zmdi zmdi-file-text"></i> Por Usuarios</a>
										</div>
									</div>
									<div class="row">
										<div class="col-md-6">
											<a data-toggle="modal" data-target="#ModalPdfFechaTicket" class="btn btn-warning btn-raised ml-4"> <i class="zmdi zmdi-file-text"></i> Ticket Fecha</a>
										</div>
									</div>
								</div>
							</div>
					  	</div>
					</div>
				</div>
			</div>
		</div>
	</section>

<!-- Modal PDF TICKETS PENDIENTES-->
<div class="modal fade" id="ModalPdfPendientes" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h2 class="modal-title" id="exampleModalLabel">Generar Reporte Tickets Pendientes</h2>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
	  	<label>Este es un reporte para ver todos los tickets "Pendientes".</label>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
        <button type="button" id="rptTicketPendiente" class="btn btn-primary"> <i class="zmdi zmdi-file-text"></i> Generar Reporte</button>
      </div>
    </div>
  </div>
</div>

<!-- Modal PDF TICKETS PROCESO-->
<div class="modal fade" id="ModalPdfProceso" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h2 class="modal-title" id="exampleModalLabel">Generar Reporte Tickets Pendientes</h2>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
	  	<label>Este es un reporte para ver todos los tickets "En Proceso".</label>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
        <button type="button" id="rptTicketProceso" class="btn btn-primary"> <i class="zmdi zmdi-file-text"></i> Generar Reporte</button>
      </div>
    </div>
  </div>
</div>

<!-- Modal PDF TICKETS PROCESO-->
<div class="modal fade" id="ModalPdfHechos" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h2 class="modal-title" id="exampleModalLabel">Generar Reporte Tickets Completados</h2>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
	  	<label>Este es un reporte para ver todos los tickets "Completados".</label>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
        <button type="button" id="rptTicketCompletos" class="btn btn-primary"> <i class="zmdi zmdi-file-text"></i> Generar Reporte</button>
      </div>
    </div>
  </div>
</div>

<!-- Modal PDF TICKETS USUARIOS-->
<div class="modal fade" id="ModalPdfUsuario" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h2 class="modal-title" id="exampleModalLabel">Generar Reporte Tickets de Usuarios</h2>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
	  	<label>Este es un reporte para ver todos los tickets del usuario seleccionado.</label>

		<div class="form-group">
			<label class="control-label">Seleccione al Usuario</label>
			<select class="form-control" id="slcusuarioPDF">
				<option value="0" disabled="disabled" selected="true">-- Seleccione al Usuario responsable --</option>
				<?php foreach($queryCentroTepic as $usuario){ ?>
				<option value="<?php echo $usuario['idusuario']  ?>"><?php echo utf8_encode($usuario['nombre']) ?> <?php echo utf8_encode($usuario['apellidopa']) ?> <?php echo utf8_encode($usuario['apellidoma']) ?></option>
				<?php } ?>
			</select>
		</div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
        <button type="button" id="rptTicketUsuario" class="btn btn-primary"> <i class="zmdi zmdi-file-text"></i> Generar Reporte</button>
      </div>
    </div>
  </div>
</div>


<!-- Modal PDF TICKETS FECHAS-->
<div class="modal fade" id="ModalPdfFechaTicket" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h2 class="modal-title" id="exampleModalLabel">Generar Reporte Tickets por Fecha</h2>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
	  	<label>Este es un reporte genera un listado del día seleccionado.</label>
		<h4>Fecha de Inicio</h4>
		<input type="date" id="rptTicketFechaPDF">	
		<h4>Fecha de Final</h4>
		<input type="date" id="rptTicketFechaPDF2">	
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
        <button type="button" id="rptTicketFechaPDFbtn" class="btn btn-primary"> <i class="zmdi zmdi-file-text"></i> Generar Reporte</button>
      </div>
    </div>
  </div>
</div>

<!-- Modal EDITAR TICKETS PENDIENTES-->
<div class="modal fade" id="ModalActualizarTicket" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h2 class="modal-title" id="exampleModalLabel">Editar Ticket</h2>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
	  	<label>Este es un reporte para ver todos los tickets "Pendientes".</label>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
        <button type="button" id="rptTicketPendiente" class="btn btn-primary"> <i class="zmdi zmdi-file-text"></i> Generar Reporte</button>
      </div>
    </div>
  </div>
</div>

<?php } ?>

<?php } ?>
	<!--====== Scripts -->
	<script src="./js/jquery-3.1.1.min.js"></script>
	<script src="./js/sweetalert2.min.js"></script>
	<script src="./js/bootstrap.min.js"></script>
	<script src="./js/material.min.js"></script>
	<script src="./js/ripples.min.js"></script>
	<script src="./js/jquery.mCustomScrollbar.concat.min.js"></script>
	<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.js"></script>
	<script src="../Controlador/ControladorTicket.js"></script>
	<script src="../Controlador/ReporteUsuario.js"></script>
	<script src="./js/main.js"></script>
	<script>
		$.material.init();
	</script>
</body>
</html>