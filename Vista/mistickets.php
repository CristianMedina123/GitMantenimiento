<?php
//HACER MULTI USUARIOS 
//ADMIN
//SUBADMIN
//EMPLEADO
session_start();//iniciar la sesion
include '../Modelo/conexion.php';

$queryTabla = mysqli_query($conn, "SELECT ticket.idticket, ticket.ticketnom, ticket.descripcion, ticket.fecha, ticket.observacionpendiente FROM ticket");
$queryEstado = mysqli_query($conn, "SELECT estadoticket.idestadoticket, estadoticket.estadoticket FROM estadoticket");


$varsesion = $_SESSION['IdUsuario'];

if($varsesion == null || $varsesion = ''){
	header("Location: ../index.html");
	die();
}

$topo = $_SESSION['IdUsuario'];
$query = "SELECT idusuario, usuario, nombre, apellidopa ,tipousuario_idtipousuario FROM usuario WHERE idusuario = $topo";
$resultado = mysqli_query($conn,$query);
$queryPendiente = mysqli_query($conn, "SELECT ticket.idticket, ticket.ticket, ticket.fechaticket, ticket.usuarioasignado, ticket.descripcion, estadoticket 
FROM ticket 
INNER JOIN estadoticket
ON ticket.estadoticket_idestadoticket = estadoticket.idestadoticket WHERE usuarioasignado = $topo AND estadoticket_idestadoticket = 1");
$queryProceso = mysqli_query($conn, "SELECT ticket.idticket, ticket.ticket, ticket.fechaticket, ticket.usuarioasignado, ticket.descripcion, ticket.observacionpendiente FROM ticket WHERE usuarioasignado = $topo AND estadoticket_idestadoticket = 2");
$queryHecho = mysqli_query($conn, "SELECT ticket.idticket, ticket.ticket, ticket.fechaticket, ticket.usuarioasignado, ticket.descripcion, ticket.observacionpendiente, ticket.observacionproceso FROM ticket WHERE usuarioasignado = $topo AND estadoticket_idestadoticket = 3");

?>
<!DOCTYPE html>
<html lang="es">
<head>
	<title>Mis Tickets</title>
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
					<img src="./assets/img/LogoHome.png" alt="UserIcon">
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
					</ul>
				</li>
				<?php } ?>
				<?php if( $datos['tipousuario_idtipousuario'] == '1' || $datos['tipousuario_idtipousuario'] == '2' || $datos['tipousuario_idtipousuario'] == '3'){ ?>
				<li>
					<a href="#!" class="btn-sideBar-SubMenu">
						<i class="zmdi zmdi-card zmdi-hc-fw"></i> Tickets <i class="zmdi zmdi-caret-down pull-right"></i>
					</a>
					<ul class="list-unstyled full-box">
					<?php if( $datos['tipousuario_idtipousuario'] == '1' || $datos['tipousuario_idtipousuario'] == '2' || $datos['tipousuario_idtipousuario'] == '3'){ ?>
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
							<a href="areas.php"><i class="zmdi zmdi-input-antenna"></i> Áreas</a>
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
				<?php } ?>	
			</ul>
		</div>
	</section>
	<?php } ?>
	
	<!-- Content page -->
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
	<div class="container-fluid">
			<div class="page-header">
			  <h1 class="text-titles"><i class="zmdi zmdi-graduation-cap zmdi-hc-fw"></i> Mis Tickets <small>Listado</small></h1>
			</div>
			<p class="lead">Estos son los tickets que tienes pendientes, en proceso y completados.</p>
		</div>
		<div class="container-fluid">
			<div class="row">
				<div class="col-xs-12">
					<ul class="nav nav-tabs" style="margin-bottom: 15px;">
					  	<li class="active"><a href="#new" data-toggle="tab">Pendientes</a></li>
						  <li><a href="#listaProceso" data-toggle="tab">En Proceso</a></li>
					  	<li><a href="#listaHechos" data-toggle="tab">Hechos</a></li>
					</ul>
					<div id="myTabContent" class="tab-content">
						<div class="tab-pane fade active in" id="new">
							<div class="container-fluid">
								<div class="row">
									<!-- <div class="col-xs-12 col-md-10 col-md-offset-1"> -->
										<div class="table-responsive">
											<table id="id_tabla_misticketPendiente" style="width: 100%" class="display table table-hover text-center">
												<thead>
													<tr>
														<th class="text-center"># Ticket</th>
														<th class="text-center">Ticket</th>
														<th class="text-center">Fecha</th>
														<th class="text-center">Descripción</th>
														<th class="text-center">Estado</th>
														<th class="text-center">Editar</th>
														<!-- <th class="text-center">Eliminar</th> -->
													</tr>
												</thead>
												<tbody>
													<?php foreach($queryPendiente as $tabla){?>
													<tr>
														<td style="width: 10%"><?php echo utf8_encode($tabla['idticket']) ?></td>
														<td style="width: 20%"><?php echo utf8_encode($tabla['ticket']) ?></td>
														<td style="width: 10%"><?php echo utf8_encode($tabla['fechaticket']) ?></td>
														<td style="width: 40%"><?php echo utf8_encode($tabla['descripcion']) ?></td>
														<td style="width: 40%"><?php echo utf8_encode($tabla['estadoticket']) ?></td>
														<td style="width: 10%"><a onclick="EditarMisTickets('<?php echo $tabla['idticket'] ?>')" class="btn btn-success btn-raised btn-xs"><i class="zmdi zmdi-refresh"></i></a></td>
														<!-- <td style="width: 10%"><button type="button" onclick="EliminarArea(<?php //echo $tabla['IdTicket'] ?>)" class="btn btn-danger btn-raised btn-xs"><i class="zmdi zmdi-delete"></i></button></td> -->
													</tr>
													<?php } ?>
												</tbody>
											</table>
										</div>
									<!-- </div> -->
								</div>
							</div>
						</div>
					  	<div class="tab-pane fade" id="listaProceso">
							<div class="table-responsive">
							<table id="id_tabla_misticket" style="width: 100%" class="display table table-hover text-center">
								<thead>
									<tr>
										<th class="text-center"># Ticket</th>
										<th class="text-center">Ticket</th>
										<th class="text-center">Fecha</th>
										<th class="text-center">Descripción</th>
										<th class="text-center">Observaciones Pendientes</th>
										<th class="text-center">Editar</th>
										<!-- <th class="text-center">Eliminar</th> -->
									</tr>
								</thead>
								<tbody>
									<?php foreach($queryProceso as $tabla){?>
									<tr>
										<td style="width: 10%"><?php echo utf8_encode($tabla['idticket']) ?></td>
										<td style="width: 20%"><?php echo utf8_encode($tabla['ticket']) ?></td>
										<td style="width: 10%"><?php echo utf8_encode($tabla['fechaticket']) ?></td>
										<td style="width: 30%"><?php echo utf8_encode($tabla['descripcion']) ?></td>
										<td style="width: 30%"><?php echo utf8_encode($tabla['observacionpendiente']) ?></td>
										<td style="width: 10%"><a onclick="EditarMisTicketsProceso('<?php echo $tabla['idticket'] ?>')" data-toggle="modal" data-target="#ModalActualizarProcesoTickets"   class="btn btn-success btn-raised btn-xs"><i class="zmdi zmdi-refresh"></i></a></td>
										<!-- <td style="width: 10%"><button type="button" onclick="EliminarArea(<?php // echo $tabla['IdTicket'] ?>)" class="btn btn-danger btn-raised btn-xs"><i class="zmdi zmdi-delete"></i></button></td> -->
									</tr>
									<?php } ?>
								</tbody>
							</table>
							</div>
					  	</div>
						  <div class="tab-pane fade" id="listaHechos">
							<div class="table-responsive">
							<table id="id_tabla_misticketHecho" class="display table table-hover text-center">
								<thead>
									<tr>
										<th class="text-center"># Ticket</th>
										<th class="text-center">Ticket</th>
										<th class="text-center">Fecha</th>
										<th class="text-center">Descripción</th>
										<th class="text-center">Observaciones Pendiente</th>
										<th class="text-center">Observaciones En Proceso</th>
										<th class="text-center">Editar</th>
										<th class="text-center">Eliminar</th>
									</tr>
								</thead>
								<tbody>
									<?php foreach($queryHecho as $tabla){?>
									<tr>
										<td style="width: 10%"><?php echo $tabla['idticket'] ?></td>
										<td style="width: 20%"><?php echo utf8_encode($tabla['ticket']) ?></td>
										<td style="width: 10%"><?php echo utf8_encode($tabla['fechaticket']) ?></td>
										<td style="width: 30%"><?php echo utf8_encode($tabla['descripcion']) ?></td>
										<td style="width: 30%"><?php echo utf8_encode($tabla['observacionpendiente']) ?></td>
										<td style="width: 30%"><?php echo utf8_encode($tabla['observacionproceso']) ?></td>
										<td><a onclick="EditarMisTicketsHecho('<?php echo $tabla['idticket'] ?>')"  class="btn btn-success btn-raised btn-xs"><i class="zmdi zmdi-refresh"></i></a></td>
										<td style="width: 10%"><button type="button" onclick="EliminarArea(<?php echo $tabla['idticket'] ?>)" class="btn btn-danger btn-raised btn-xs"><i class="zmdi zmdi-delete"></i></button></td>
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
	<!-- Content page-->
	<!-- Modal En HECHO EDITAR	-->
<div class="modal fade" id="ModalActualizarHechoTickets" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h2 class="modal-title" id="exampleModalLabel">Editar Ticket Hechos</h2>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
	  	<div class="form-group label-floating">
		  	<!-- <label class="control-label">ID</label> -->
		  	<input type="hidden"  class="form-control"  id="txtIdTicketEditarProcesoHecho">
			<div class="form-group">
				<h4><b>Ticket</b></h4>
			  	<input type="text" class="form-control" id="txtTicketEditarProcesoHecho" readonly autocomplete="off">
		</div>
		<div class="form-group label-floating">
				<h4><b>Observaciones en Pendiente</b></h4>
			  	<input type="text" class="form-control" id="txtObsPendienteEditarProcesoHecho" readonly autocomplete="off">
		</div>		
		<div class="form-group label-floating">		
				<h4><b>Observaciones en En proceso</b></h4>
			  	<input type="text" class="form-control" id="txtObsPendienteProcesoEditarProcesoHecho" readonly autocomplete="off">
		</div>
		<div class="form-group label-floating">	
				<h4><b>Observaciones en En Hecho</b></h4>
			  	<input type="text" class="form-control" id="txtObsPendienteHechosEditarProceso" autocomplete="off">
		</div>
		<div class="form-group label-floating">	
			<h4><b>Seleccione su Nuevo Estado de Ticket</b></h4>
			<div class="form-group">
				<label class="control-label">Seleccione su Nuevo Estado de Ticket</label>
				<select class="form-control" id="slcEstadoEditarHecho">
					<option value="0" disabled="disabled" selected="true">-- Seleccione su Nuevo Estado de Ticket --</option>
					<?php foreach($queryEstado as $estado){ ?>
					<option value="<?php echo $estado['idestadoticket'] ?>"><?php echo utf8_encode($estado['estadoticket']) ?></option>
				<?php } ?>
				</select>
			</div>
			</div>
		</div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
        <button type="button" onclick="ActualizarMisTicketsHecho()" class="btn btn-primary">Guardar Cambios</button>
      </div>
    </div>
  </div>
</div>	
		
	<!-- Modal PENDIENTE EDITAR-->
<div class="modal fade" id="ModalActualizarMisTickets" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h2 class="modal-title" id="exampleModalLabel">Editar Ticket Pendiente</h2>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
	  	<div class="form-group label-floating">
		  	<!-- <label class="control-label">ID</label> -->
		  	<input type="hidden"  class="form-control"  id="txtIdTicketEditar">
			<div class="form-group">
				<h4><b>Ticket</b></h4>
			  	<input type="text" class="form-control" id="txtTicketNom1Editar" readonly autocomplete="off">
			</div>
			<div class="form-group label-floating">
				<h4><b>Observaciones en Pendiente</b></h4>
			  	<input type="text" class="form-control" id="txtObsPendienteEditar" autocomplete="off">
			</div>
			<div class="form-group label-floating">
			<h4><b>Seleccione su Nuevo Estado de Ticket</b></h4>
			<div class="form-group">
				<label class="control-label">Seleccione su Nuevo Estado de Ticket</label>
				<select class="form-control" id="slcEstadoEditar">
					<option value="0" disabled="disabled" selected="true">-- Seleccione su Nuevo Estado de Ticket --</option>
					<?php foreach($queryEstado as $estado){ ?>
					<option value="<?php echo $estado['idestadoticket'] ?>"><?php echo utf8_encode($estado['estadoticket']) ?></option>
				<?php } ?>
				</select>
			</div>
		</div>
		</div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
        <button type="button" onclick="ActualizarMisTickets()" class="btn btn-primary">Guardar Cambios</button>
      </div>
    </div>
  </div>
</div>



<!-- Modal En Proceso EDITAR	-->
<div class="modal fade" id="ModalActualizarProcesoTickets" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h2 class="modal-title" id="exampleModalLabel">Editar Ticket En Proceso</h2>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
	  	<div class="form-group label-floating">
		  	<!-- <label class="control-label">ID</label> -->
		  	<input type="hidden"  class="form-control"  id="txtIdTicketEditarProceso">
			<div class="form-group">
				<h4><b>Ticket</b></h4>
			  	<input type="text" class="form-control" id="txtTicketEditarProceso" readonly autocomplete="off">
		</div>
		<div class="form-group label-floating">
				<h4><b>Observaciones en Pendiente</b></h4>
			  	<input type="text" class="form-control" id="txtObsPendienteEditarProceso" readonly autocomplete="off">
		</div>
		<div class="form-group label-floating">
				<h4><b>Observaciones en En proceso</b></h4>
			  	<input type="text" class="form-control" id="txtObsPendienteProcesoEditarProceso" autocomplete="off">
		</div>
		<div class="form-group label-floating">
			<h4><b>Seleccione su Nuevo Estado de Ticket</b></h4>
			<div class="form-group">
				<label class="control-label">Seleccione su Nuevo Estado de Ticket</label>
				<select class="form-control" id="slcEstadoEditarProceso">
					<option value="0" disabled="disabled" selected="true">-- Seleccione su Nuevo Estado de Ticket --</option>
					<?php foreach($queryEstado as $estado){ ?>
					<option value="<?php echo $estado['idestadoticket'] ?>"><?php echo utf8_encode($estado['estadoticket']) ?></option>
				<?php } ?>
				</select>
			</div>
		</div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
        <button type="button" onclick="ActualizarMisTicketsProceso()" class="btn btn-primary">Guardar Cambios</button>
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
	<script src="../Controlador/ControladorMisTickets.js"></script>
	<script src="../Controlador/Prueba.js"></script>
	<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.js"></script>
	<script src="./js/main.js"></script>
	<script>$.material.init();</script>
</body>
</html>



