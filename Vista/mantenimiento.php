<?php
session_start();//iniciar la sesion
include '../Modelo/conexion.php';

$query_centros = mysqli_query($conn, "SELECT IdCentroNegocio, CentroNegocio FROM centronegocio");
$query_usuario = mysqli_query($conn, "SELECT IdUsuario,Nombre, ApellidoPat, ApellidoMat FROM Usuario ORDER BY usuario ASC");
$query_equipo = mysqli_query($conn, "SELECT equipo.Equipo,equipo.Marca, equipo.Codigo, equipo.IdEquipo FROM equipo ORDER BY equipo ASC");
$queryTabla = mysqli_query($conn, "SELECT mantenimiento.IdMantenimiento, mantenimiento.mantenimiento, mantenimiento.FechaMantenimiento,  mantenimiento.Descripcion, equipo.Codigo, equipo.Equipo, usuario.Nombre, usuario.ApellidoPat, usuario.ApellidoMat,centronegocio.IdCentroNegocio, centronegocio.CentroNegocio,centronegocio.Estado  FROM mantenimiento
INNER JOIN equipo
ON mantenimiento.Equipo_idEquipo = equipo.IdEquipo
INNER JOIN usuario
ON mantenimiento.Usuario_IdUsuario = usuario.IdUsuario
INNER JOIN centronegocio
ON equipo.CentroNegocio_idCentroNegocio = centronegocio.IdCentroNegocio
ORDER BY mantenimiento.FechaMantenimiento DESC");


$varsesion = $_SESSION['IdUsuario'];

if($varsesion == null || $varsesion = ''){
	header("Location: ../index.html");
	die();
}

$topo = $_SESSION['IdUsuario'];
$query = "SELECT IdUsuario, Usuario, Nombre, ApellidoPat ,TipoUsuario_IdTipoUsuario FROM usuario WHERE IdUsuario = $topo";
$resultado = mysqli_query($conn,$query);	
?>
<!DOCTYPE html>
<html lang="es">
<head>
	<title>Mantenimiento</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<link rel="stylesheet" href="./css/main.css">
	<link rel="stylesheet" href="./css/btnReportes.css">
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
				<h4><?php echo utf8_encode($datos['Nombre'])?> <?php echo utf8_encode($datos['ApellidoPat'])?></h4>
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
				<?php if( $datos['TipoUsuario_IdTipoUsuario'] == '1' || $datos['TipoUsuario_IdTipoUsuario'] == '2' || $datos['TipoUsuario_IdTipoUsuario'] == '3'){ ?>
				<li>
					<a href="#!" class="btn-sideBar-SubMenu">
						<i class="zmdi zmdi-card zmdi-hc-fw"></i> Tickets <i class="zmdi zmdi-caret-down pull-right"></i>
					</a>
					<ul class="list-unstyled full-box">
						<?php if( $datos['TipoUsuario_IdTipoUsuario'] == '1'){ ?>
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
		<?php if( $datos['TipoUsuario_IdTipoUsuario'] == '1'){ ?>
		<div class="container-fluid">
			<div class="page-header">
			  <h1 class="text-titles"><i class="zmdi zmdi-timer zmdi-hc-fw"></i> Mantenimiento <small>a Equipos de Cómputo</small></h1>
			</div>
			<p class="lead">En este apartado se darán de alta los mantenimientos a los equipos de cómputo.</p>
		</div>
		<div class="container-fluid">
			<div class="row">
				<div class="col-xs-12">
					<ul class="nav nav-tabs" style="margin-bottom: 15px;">
					  	<li class="active"><a href="#new" data-toggle="tab">Nuevo Mantenimiento</a></li>
					  	<li><a href="#list" data-toggle="tab">Lista de Mantenimiento</a></li>
						  <li><a href="#reportes" data-toggle="tab">PDF</a></li>
					</ul>
					<div id="myTabContent" class="tab-content">
						<div class="tab-pane fade active in" id="new">
							<div class="container-fluid">
								<div class="row">
									<div class="col-xs-12 col-md-6">
											<div class="form-group">
												<label class="control-label">Centro de Negocios</label>
												  <select class="form-control" id="slcCentro">
													<option value="0" disabled="disabled" selected="true">-- Seleccione un CN --</option>
													<?php foreach($query_centros as $centro){ ?>
													<option value="<?php echo $centro['IdCentroNegocio'] ?>"><?php echo utf8_encode($centro['CentroNegocio']) ?></option>
													<?php } ?>
												  </select>
											  </div>
											  <div class="form-group">
												<label class="control-label">Seleccione el Equipo</label>
												  <select class="form-control" id="slcEquipo">
													<option value="0" disabled="disabled" selected="true" >-- Seleccione un Equipo --</option>
													<?php foreach($query_equipo as $equipo){ ?>
														<option value="<?php echo $equipo['IdEquipo'] ?>"><?php echo utf8_encode($equipo['Equipo']) ?> <?php echo utf8_encode($equipo['Marca']) ?> <?php echo utf8_encode($equipo['Codigo']) ?></option>
													<?php } ?>
												  </select>
											  </div>
											<div class="form-group">
											  <label class="control-label">Mantenimiento</label>
											  <input class="form-control" type="text" id="txtmant" autocomplete="off">
											</div>

											<!-- <div class="form-group">
										        <label class="control-label">Fecha</label>
										        <select class="form-control">
										          <option>2017</option>
										          <option>2016</option>
										        </select>
										    </div> -->

									</div>
									<div class="col-xs-12 col-md-6">
										<div class="form-group label-floating">
											<label class="control-label">Descripción</label>
											<input class="form-control" type="text" id="txtdesc" autocomplete="off">
										</div>
										<div class="form-group label-floating">
											<label>Fecha</label>
											<input class="form-control" type="date" id="fechamant" autocomplete="off">
											</div>
										<div class="form-group">
											<label class="control-label">Seleccione el Usuario que Hizo Mantenimiento</label>
											<select class="form-control" id="slcusuario">
												<option value="0" disabled="disabled" selected="true">-- Seleccione el Usuario que Hizo Mantenimiento --</option>
												<?php foreach($query_usuario as $usuario){ ?>
												<option value="<?php echo $usuario['IdUsuario'] ?>"><?php echo utf8_encode($usuario['Nombre']) ?> <?php echo utf8_encode($usuario['ApellidoPat']) ?> <?php echo utf8_encode($usuario['ApellidoMat']) ?></option>
												<?php } ?>
											</select>
										</div>
										<p class="text-center">
											<button type="button" onclick="InsertarMantenimiento()" class="btn btn-info btn-raised btn-sm"><i class="zmdi zmdi-floppy"></i> Save</button>
										</p>
									</div>
								</div>
							</div>
						</div>
					  	<div class="tab-pane fade" id="list">
							<div class="table-responsive">
								<table id="id_tabla_mant" style="width:100%" class="display table table-hover text-center">
									<thead>
										<tr>
											<th class="text-center">Equipo</th>
											<th class="text-center">Código Equipo</th>
											<th class="text-center">Mantenimiento</th>
											<th class="text-center">Descripción</th>
											<th class="text-center">Fecha</th>
											<th class="text-center">Centro Negocios</th>
											<th class="text-center">Usuario</th>
											<th class="text-center">Editar</th>
											<th class="text-center">Eliminar</th>
										</tr>
									</thead>
									<tbody>
										<?php foreach($queryTabla as $tabla){ ?>
										<tr>
											<td><?php echo utf8_encode($tabla['Equipo']) ?></td>
											<td><?php echo utf8_encode($tabla['Codigo']) ?></td>
											<td><?php echo utf8_encode($tabla['mantenimiento']) ?></td>
											<td><?php echo utf8_encode($tabla['Descripcion']) ?></td>
											<td><?php echo utf8_encode($tabla['FechaMantenimiento']) ?></td>
											<td><?php echo utf8_encode($tabla['CentroNegocio']) ?> / <?php echo $tabla['Estado'] ?></td>
											<td><?php echo utf8_encode($tabla['Nombre']) ?> <?php echo utf8_encode($tabla['ApellidoPat']) ?> <?php echo utf8_encode($tabla['ApellidoMat']) ?></td>
											<td><a onclick="EditarMantenimiento('<?php echo $tabla['IdMantenimiento'] ?>')" data-toggle="modal" data-target="#ModalActualizarMantenimiento"   class="btn btn-success btn-raised btn-xs"><i class="zmdi zmdi-refresh"></i></a></td>
											<td><button type="button" onclick="EliminarMantenimiento(<?php echo $tabla['IdMantenimiento'] ?>)" class="btn btn-danger btn-raised btn-xs"><i class="zmdi zmdi-delete"></i></button></td>
										</tr>
										<?php } ?>
									</tbody>
								</table>
							</div>
					  	</div>
						  <div class="tab-pane fade" id="reportes">
						  	<div class="container">
								<div class="row">
									<div class="col-md-6">
										<a type="button" data-toggle="modal" data-target="#ModalPdfEquipo" class="btn btn-warning btn-raised"><i class="zmdi zmdi-file-text"></i> Mantenimiento por Equipo </a>
									</div>
									<div class="col-md-6">
										<a data-toggle="modal" data-target="#ModalPdfEquiposFecha" class="btn btn-warning btn-raised"> <i class="zmdi zmdi-file-text"></i> Mantenimiento por Fecha</a>
									</div>
								</div>
								<div class="row">
									<div class="col-md-6">
										<a data-toggle="modal" data-target="#ModalPdfCN" class="btn btn-warning btn-raised"> <i class="zmdi zmdi-file-text"></i> Mantenimiento por CN</a>
									</div>
									<div class="col-md-6">
										<a data-toggle="modal" data-target="#ModalPdfEquiposAsignados" class="btn btn-warning btn-raised"> <i class="zmdi zmdi-file-text"></i> Equipos Asignados</a>
									</div>
								</div>
								<div class="row">
									<div class="col-md-6">
										<a data-toggle="modal" data-target="#ModalPdfEquiposInactivos" class="btn btn-warning btn-raised"> <i class="zmdi zmdi-file-text"></i> Equipos Inactivos</a>
									</div>
									<div class="col-md-6">
										<a data-toggle="modal" data-target="#ModalPdfEquiposCamino" class="btn btn-warning btn-raised"> <i class="zmdi zmdi-file-text"></i> Equipos En Camino</a>
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
<div class="modal fade" id="ModalPdfEquipo" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h2 class="modal-title" id="exampleModalLabel">Generar Reporte por Equipo</h2>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
	  	<label>Este es un reporte para ver todos los mantenimientos de un equipo.</label>
		  <div class="form-group">
				<label class="control-label">Centro de Negocios</label>
				<select class="form-control" id="slcCentroPDF">
					<option value="0" disabled="disabled" selected="true">-- Seleccione un CN --</option>
					<?php foreach($query_centros as $centro){ ?>
					<option value="<?php echo $centro['IdCentroNegocio'] ?>"><?php echo utf8_encode($centro['CentroNegocio']) ?></option>
					<?php } ?>
				</select>
			</div>
			<div class="form-group">
				<label class="control-label">Seleccione el Equipo</label>
				<select class="form-control" id="slcEquipoPDF">
					<option value="0" disabled="disabled" selected="true" >-- Seleccione un Equipo --</option>
					<?php foreach($query_equipo as $equipo){ ?>
					<option value="<?php echo $equipo['IdEquipo'] ?>"><?php echo utf8_encode($equipo['Equipo']) ?> <?php echo utf8_encode($equipo['Marca']) ?> <?php echo utf8_encode($equipo['Codigo']) ?></option>
					<?php } ?>
				</select>
			</div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
        <button type="button" id="rptMantEquipo" class="btn btn-primary"> <i class="zmdi zmdi-file-text"></i> Generar Reporte</button>
      </div>
    </div>
  </div>
</div>



<!-- Modal PDF TICKETS CN-->
<div class="modal fade" id="ModalPdfCN" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h2 class="modal-title" id="exampleModalLabel">Generar Reporte Mantenimiento CN</h2>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
	  	<label>Este es un reporte para ver todos los mantenimientos de un cn.</label>
		  <div class="form-group">
				<label class="control-label">Centro de Negocios</label>
				<select class="form-control" id="slcCNPDF">
					<option value="0" disabled="disabled" selected="true">-- Seleccione un CN --</option>
					<?php foreach($query_centros as $centro){ ?>
					<option value="<?php echo $centro['IdCentroNegocio'] ?>"><?php echo utf8_encode($centro['CentroNegocio']) ?></option>
					<?php } ?>
				</select>
			</div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
        <button type="button" id="rptMantCN" class="btn btn-primary"> <i class="zmdi zmdi-file-text"></i> Generar Reporte</button>
      </div>
    </div>
  </div>
</div>

<!-- Modal PDF TICKETS EQUIPOS ASIGNADOS-->
<div class="modal fade" id="ModalPdfEquiposAsignados" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h2 class="modal-title" id="exampleModalLabel">Generar Reporte Equipos Asignados</h2>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
	  	<label>Este es un reporte para ver todos los equipos "Asignados".</label>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
        <button type="button" id="rptMantEquipoAsignados" class="btn btn-primary"> <i class="zmdi zmdi-file-text"></i> Generar Reporte</button>
      </div>
    </div>
  </div>
</div>

<!-- Modal PDF TICKETS EQUIPOS INACTIVOS-->
<div class="modal fade" id="ModalPdfEquiposInactivos" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h2 class="modal-title" id="exampleModalLabel">Generar Reporte Equipos Inactivos</h2>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
	  	<label>Este es un reporte para ver todos los equipos "Inactivos".</label>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
        <button type="button" id="rptMantEquipoInactivos" class="btn btn-primary"> <i class="zmdi zmdi-file-text"></i> Generar Reporte</button>
      </div>
    </div>
  </div>
</div>



<!-- Modal PDF TICKETS EQUIPOS EN CAMINO-->
<div class="modal fade" id="ModalPdfEquiposCamino" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h2 class="modal-title" id="exampleModalLabel">Generar Reporte Equipos En Camino</h2>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
	  	<label>Este es un reporte para ver todos los equipos "En Camino".</label>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
        <button type="button" id="rptMantEquipoCamino" class="btn btn-primary"> <i class="zmdi zmdi-file-text"></i> Generar Reporte</button>
      </div>
    </div>
  </div>
</div>

<!-- Modal PDF TICKETS EQUIPOS FECHA-->
<div class="modal fade" id="ModalPdfEquiposFecha" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h2 class="modal-title" id="exampleModalLabel">Generar Reporte Equipos por Fecha</h2>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
	  	<label>Este es un reporte muestra una lista de mantenimiento del día seleccionado.</label>
		<h4>Fecha Incial</h4>
		<input type="date" id="idfechaequipopdf">
		<h4>Fecha Final</h4>
		<input type="date" id="idfechaequipopdf2">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
        <button type="button" id="rptEquipoFechabtn" class="btn btn-primary"> <i class="zmdi zmdi-file-text"></i> Generar Reporte</button>
      </div>
    </div>
  </div>
</div>


<!-- Modal -->
<div class="modal fade" id="ModalActualizarMantenimiento" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h2 class="modal-title" id="exampleModalLabel">Editar Equipo de ANLI</h2>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
	  	<div class="form-group label-floating">
		  	<!-- <label class="control-label">ID</label> -->
		  	<input type="hidden"  class="form-control"  id="txtIdMantenimientoEditar">
			  
	  		<div class="form-group">
				  <h4><b>Mantenimiento</b></h4>
			  <input type="text" class="form-control" id="txtMantenimientoEditar" autocomplete="off">
			</div>
			<div class="form-group">
				<h4><b>Fecha del Mantenimiento</b></h4>
				<input type="date" class="form-control" id="txtFechaEditar" autocomplete="off">
			</div>
			<div class="form-group">
				<h4><b>Descripción del Mantenimiento</b></h4>
				<input type="text" class="form-control" id="txtDescripcionEditar" autocomplete="off">
			</div>
			<h4><b>Seleccione su Nuevo Centro de Negocios</b></h4>
			<div class="form-group">
				<select class="form-control" id="slcCentroEditar">
					<option value="0" disabled="disabled" selected="true">-- Seleccione un Centro de Negocios --</option>
					<?php foreach($query_centros as $centro){ ?>
					<option value="<?php echo $centro['IdCentroNegocio'] ?>"><?php echo utf8_encode($centro['CentroNegocio']) ?></option>
				<?php } ?>
				</select>
			</div>
			<h4><b>Equipo</b></h4>
			<div class="form-group">
				<select class="form-control" id="slcEquipoEditar">
					<option value="0" disabled="disabled" selected="true">-- Seleccione Nuevo Equipo --</option>
					<?php foreach($query_equipo as $equipo){ ?>
					<option value="<?php echo $equipo['IdEquipo'] ?>"><?php echo utf8_encode($equipo['Equipo']) ?> <?php echo utf8_encode($equipo['Marca']) ?> <?php echo utf8_encode($equipo['Codigo']) ?></option>
				<?php } ?>
				</select>
			</div>
			<h4><b>Usuario Quien Realizó Mantenimiento</b></h4>
			<div class="form-group">
				<select class="form-control" id="slcUsuarioEditar">
					<option value="0" disabled="disabled" selected="true">-- Seleccione un Usuario--</option>
					<?php foreach($query_usuario as $usuario){ ?>
					<option value="<?php echo $usuario['IdUsuario'] ?>"><?php echo utf8_encode($usuario['Nombre']) ?> <?php echo utf8_encode($usuario['ApellidoPat']) ?> <?php echo utf8_encode($usuario['ApellidoMat']) ?></option>
				<?php } ?>
				</select>
			</div>
		</div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
        <button type="button" onclick="ActualizarMantenimiento()" class="btn btn-primary">Guardar Cambios</button>
      </div>
    </div>
  </div>
</div>
<?php } ?>
<?php if( $datos['TipoUsuario_IdTipoUsuario'] == '2' || $datos['TipoUsuario_IdTipoUsuario'] == '3'){ ?>
		<div class="container">
			<div class="row">
				<div class="col-md-11 text-center">
					<h2> No tienes acceso al contenido</h2>
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
	<script src="../Controlador/ControladorMantenimiento.js"></script>
	<script src="../Controlador/ReporteUsuario.js"></script>
	<script src="./js/main.js"></script>
	<script>
		$.material.init();
	</script>
</body>
</html>
