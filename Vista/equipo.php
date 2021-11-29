<?php
	session_start();//iniciar la sesion
include '../Modelo/conexion.php';

$queryCentro = mysqli_query($conn, "SELECT idcentronegocio, centronegocio, estadocn FROM CentroNegocio");
$queryArea = mysqli_query($conn, "SELECT IdArea, AreaNombre FROM Area");
$queryEstado = mysqli_query($conn, "SELECT IdTipoEstado, TipoEstado FROM TipoEstado");


$queryTabla = mysqli_query($conn, "SELECT equipo.IdEquipo, equipo.Codigo, equipo.Equipo, equipo.Marca, equipo.Modelo, equipo.Descripcion, centronegocio.CentroNegocio, area.AreaNombre, tipoestado.TipoEstado FROM equipo
INNER JOIN centronegocio
ON equipo.CentroNegocio_idCentroNegocio = centronegocio.IdCentroNegocio
INNER JOIN area
ON equipo.Area_IdArea = area.IdArea
INNER JOIN tipoestado
ON equipo.TipoEstado_IdTipoEstado = tipoestado.IdTipoEstado");

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
	<title>Equipos</title>
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
							<a href="usuarios.php"><i class="zmdi zmdi-account zmdi-hc-fw"></i> Usuarios</a>
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
			  <h1 class="text-titles"><i class="zmdi zmdi-book zmdi-hc-fw"></i> Equipos en<small> ANLI</small></h1>
			</div>
			<p class="lead">Estos son los equipos de cómputos registrados en ANLI para mantener un control de asignación.</p>
		</div>
		<div class="container-fluid">
			<div class="row">
				<div class="col-xs-12">
					<ul class="nav nav-tabs" style="margin-bottom: 15px;">
					  	<li class="active"><a href="#new" data-toggle="tab">Nuevo Equipo</a></li>
					  	<li><a href="#list" data-toggle="tab">Lista de Equpos</a></li>
					</ul>
					<div id="myTabContent" class="tab-content">
						<div class="tab-pane fade active in" id="new">
							<div class="container-fluid">
								<div class="row">
									<div class="col-xs-12 col-md-6 ">
									    	<div class="form-group label-floating">
											  <label class="control-label">Código</label>
											  <input class="form-control" type="text" id="txtcodigo" autocomplete="off">
											</div>
									    	<div class="form-group label-floating">
											  <label class="control-label">Equipo</label>
											  <input class="form-control" type="text" id="txtequipo" autocomplete="off">
											</div>
											<div class="form-group label-floating">
												<label class="control-label">Marca</label>
												<input class="form-control" type="text" id="txtmarca" autocomplete="off">
											</div>
											<div class="form-group label-floating">
												<label class="control-label">Modelo</label>
												<input class="form-control" type="text" id="txtmodelo" autocomplete="off">
											</div>
											<div class="form-group label-floating">
												<label class="control-label">Descripción</label>
												<input class="form-control" type="text" id="txtdesc" autocomplete="off">
											</div>
											<!-- <div class="form-group">
												<label class="control-label">Foto del Equipo</label>
												<div>
												  <input type="text" readonly="" class="form-control" placeholder="Buscar...">
												  <input type="file" >
												</div>
											  </div> -->

									</div>
									<div class="col-xs-12 col-md-6">

											<div class="form-group">
										      	<label class="control-label">Status</label>
										        <select class="form-control" id="slcestado">
													<option value="0" disabled="disabled" selected="true">-- Seleccione un Estado del Equipo --</option>
													<?php foreach($queryEstado as $estado){ ?>
										        	<option value="<?php echo $estado['IdTipoEstado'] ?>"><?php echo utf8_encode($estado['TipoEstado']) ?></option>
										        	<?php } ?>
										    	</select>
											</div>
										<div class="form-group">
											<label class="control-label">Centro de Negocios</label>
											<select class="form-control" id="slccentro">
												<option value="0" disabled="disabled" selected="true">-- Seleccione un Centro de Negocios --</option>
												<?php foreach($queryCentro as $centro){ ?>
												<option value="<?php echo $centro['idcentronegocio'] ?>"><?php echo utf8_encode( $centro['centronegocio']) ?> / <?php echo utf8_encode($centro['estadocn']) ?></option>
												<?php } ?>
											</select>
										</div>
										<div class="form-group">
											<label class="control-label">Área</label>
											<select  class="form-control" id="slcarea">
												<option value="0" disabled="disabled" selected="true">-- Seleccione un Área --</option>
												<?php foreach($queryArea as $area){ ?>
												<option value="<?php echo $area['IdArea'] ?>"><?php echo utf8_encode($area['AreaNombre']) ?></option>
												<?php } ?>
											</select>
										</div>
										<p class="text-center">
										    <button type="button" onclick="InsertarEquipo()" class="btn btn-info btn-raised btn-sm"><i class="zmdi zmdi-floppy"></i> Save</button>
										</p>
									</div>
								</div>
							</div>
						</div>
					  	<div class="tab-pane fade" id="list">
							<div class="table-responsive">
								<table id="id_tabla_equipo" style="width:100%" class="display table table-hover text-center">
									<thead>
										<tr>
											<th class="text-center">Código</th>
											<th class="text-center">Equipo</th>
											<th class="text-center">Marca</th>
											<th class="text-center">Modelo</th>
											<th class="text-center">Descripción</th>
											<th class="text-center">Centro Negocio</th>
											<th class="text-center">Área</th>
											<th class="text-center">Estado</th>
											<th class="text-center">Editar</th>
											<th class="text-center">Eliminar</th>
										</tr>
									</thead>
									<tbody>
										<?php foreach($queryTabla as $tabla){ ?>
										<tr>
											<td><?php echo utf8_encode($tabla['Codigo']) ?></td>
											<td><?php echo utf8_encode($tabla['Equipo']) ?></td>
											<td><?php echo utf8_encode($tabla['Marca']) ?></td>
											<td><?php echo utf8_encode($tabla['Modelo']) ?></td>
											<td><?php echo utf8_encode($tabla['Descripcion']) ?></td>
											<td><?php echo utf8_encode($tabla['CentroNegocio']) ?></td>
											<td><?php echo utf8_encode($tabla['AreaNombre']) ?></td>
											<td><?php echo utf8_encode($tabla['TipoEstado']) ?></td>
											<td><a onclick="EditarEquipo('<?php echo $tabla['IdEquipo'] ?>')" data-toggle="modal" data-target="#ModalActualizarEquipo"   class="btn btn-success btn-raised btn-xs"><i class="zmdi zmdi-refresh"></i></a></td>
											<td><button type="button" onclick="EliminarEquipo(<?php echo $tabla['IdEquipo'] ?>)" class="btn btn-danger btn-raised btn-xs"><i class="zmdi zmdi-delete"></i></button></td>
										</tr>
										<?php } ?>
									</tbody>
								</table>
							</div>
					  	</div>
					</div>
				</div>
			</div>
		</div>
	</section>

		<!-- Modal -->
		<div class="modal fade" id="ModalActualizarEquipo" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
					<input type="hidden"  class="form-control"  id="txtIdEquipoEditar">
					
					<div class="form-group">
						<h4><b>Código del Equipo</b></h4>
					<input type="text" class="form-control" id="txtCodigoEditar" autocomplete="off">
					</div>
					<div class="form-group">
						<h4><b>Equipo</b></h4>
						<input type="text" class="form-control" id="txtEquipoEditar" autocomplete="off">
					</div>
					<div class="form-group">
						<h4><b>Marca del Equipo</b></h4>
						<input type="text" class="form-control" id="txtMarcaEditar" autocomplete="off">
					</div>
					<div class="form-group">
						<h4><b>Modelo del Equipo</b></h4>
						<input type="text" class="form-control" id="txtModeloEditar" autocomplete="off">
					</div>
					<div class="form-group">
						<h4><b>Descripción del Equipo</b></h4>
						<input type="text" class="form-control" id="txtDescripcionEditar" autocomplete="off">
					</div>
					<h4><b>Seleccione su Nuevo Centro de Negocios</b></h4>
					<div class="form-group">
						<select class="form-control" id="slcCentrosEditar">
							<option value="0" disabled="disabled" selected="true">-- Seleccione un Centro de Negocios --</option>
							<?php foreach($queryCentro as $centro){ ?>
							<option value="<?php echo $centro['idcentronegocio'] ?>"><?php echo utf8_encode($centro['centronegocio']) ?> / <?php echo utf8_encode($centro['estadocn']) ?></option>
						<?php } ?>
						</select>
					</div>
					<h4><b>Seleccione la Nueva Area</b></h4>
					<div class="form-group">
						<select class="form-control" id="slcAreaEditar">
							<option value="0" disabled="disabled" selected="true">-- Seleccione una Area --</option>
							<?php foreach($queryArea as $area){ ?>
							<option value="<?php echo $area['IdArea'] ?>"><?php echo utf8_encode($area['AreaNombre']) ?></option>
						<?php } ?>
						</select>
					</div>
					<h4><b>Selecione el Nuevo Estado</b></h4>
					<div class="form-group">
						<select class="form-control" id="slcEstadoEditar">
							<option value="0" disabled="disabled" selected="true">-- Seleccione un Estado --</option>
							<?php foreach($queryEstado as $estado){ ?>
							<option value="<?php echo $estado['IdTipoEstado'] ?>"><?php echo utf8_encode($estado['TipoEstado']) ?></option>
						<?php } ?>
						</select>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
				<button type="button" onclick="ActualizarEquipo()" class="btn btn-primary">Guardar Cambios</button>
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
	<script src="../Controlador/ControladorEquipo.js"></script>
	<script src="./js/main.js"></script>
	<script>
		$.material.init();
	</script>
</body>
</html>


