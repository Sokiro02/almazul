<?php 
$sql ="SELECT Nom_App,Url_Web FROM t_config WHERE Desarrollador='TEKSYSTEM S.A.S'";  
$result = $conexion->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {                
        $NomApp=$row['Nom_App'];  
        $Url_Web=$row['Url_Web'];    
 }
}
?>

<?php 

//Validación de Permisos
	 ?>
	<div id="navbar" class="navbar navbar-default          ace-save-state">
			<div class="navbar-container ace-save-state" id="navbar-container">
				<button type="button" class="navbar-toggle menu-toggler pull-left" id="menu-toggler" data-target="#sidebar">
					<span class="sr-only">Toggle sidebar</span>

					<span class="icon-bar"></span>

					<span class="icon-bar"></span>

					<span class="icon-bar"></span>
				</button>

				<div class="navbar-header pull-left" >
			<?php 
				if ($IdRol==1) {
					?>
					<a href="index.php" class="navbar-brand">
						<small>
							<!-- <i class="fa fa-leaf"></i> -->
							<img id="LogoIndex" src="../Administrator/Images/Logos/icono.jpg" width="65px" height="36px">
							
						</small>
					</a>
					<?php
				}
				else if ($IdRol==2)
				{
					?>
					<a href="index-produccion.php" class="navbar-brand">
						<small>
							<!-- <i class="fa fa-leaf"></i> -->
							<img id="LogoIndex" src="../Administrator/Images/Logos/icono.jpg" width="65px" height="36px">
							
						</small>
					</a>
					<?php
				}
				else if ($IdRol==3)
				{
					?>
					<a href="index-ventas.php" class="navbar-brand">
						<small>
							<!-- <i class="fa fa-leaf"></i> -->
							<img id="LogoIndex" src="../Administrator/Images/Logos/icono.jpg" width="65px" height="36px">
							
						</small>
					</a>
					<?php

				}

			 ?>
					
				</div>
				<div class="navbar-header center" >
					
						<small>
							
							<h4 style="color:white;">
								<?php 

								$MyIdTienda=$_SESSION['IdTienda'];
								$Mitienda=$_SESSION['nicktienda'];

// CONFIGURACIÓN DE LA TIENDA. 
$sql="SELECT * From t_config_tienda where Tienda_Id_Tienda='".$MyIdTienda."'";
$result = $conexion->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {                
        $aplicaiva=utf8_encode($row['aplica_iva']);
    }
}


$sql ="SELECT IFNULL(SUM(Cantidad),0) as total FROM `t_inventario` WHERE Id_Tienda='".$MyIdTienda."'";  
$result = $conexion->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {   
    	$total=$row['total'];
 }
}
				if ($IdRol==3) {
					Echo($Mitienda." (".$total.")");
              						if ($aplicaiva!="Si") {
              							Echo("  *****  Tienda Facturando sin aplicar IVA ***** ");
              						}
				}
              						
								 ?>
							</h4>

							<h4 style="color:white;">
								<?php 
								 $Mitaller=$_SESSION['nicktaller'];
              						Echo($Mitaller);
								 ?>
							</h4>
						</small>
				
				</div>

				<div class="navbar-buttons navbar-header pull-right" role="navigation">
					<ul class="nav ace-nav">
						<?php 
					if ($IdRol==1) {
						?>
						<li class="green dropdown-modal">
							<a href="gastos-administrativos.php"> <i class="fa fa-plus-square"> Gasto</i></a>
						</li>
						<?php
					}
					 ?>
					<?php 
					if ($IdRol!=6) {
						?>
						<li class="dark dropdown-modal">
							<a href="Lista-Referencias.php"> <img width="40" class="img-circle" src="../Administrator/Images/Logos/logo-camara.jpg" alt="User Avatar"></a>
						</li>
						<?php
					}
					 ?>
						
					
		<?php 
		if ($Mitienda!="") {
			$MyIdTienda=$_SESSION['IdTienda'];
$ValorEfectivo=SumaMediosdePago($MyIdTienda,1); 
$ValorTarjeta=SumaMediosdePago($MyIdTienda,2);
$ValorTransferencia=SumaMediosdePago($MyIdTienda,3);
$ValorEfecty=SumaMediosdePago($MyIdTienda,4);
$ValorPaginaweb=SumaMediosdePago($MyIdTienda,6);
	 	?>

						<li  class="yellow dropdown-modal">
							<a data-toggle="dropdown" class="dropdown-toggle" href="#">
								<i class="ace-icon fa fa-money bigger-140"></i>
								<span class="badge badge-green"></span>
							</a>

							<ul class="dropdown-menu-left dropdown-navbar dropdown-menu dropdown-caret dropdown-close">
								<li class="dropdown-header">
									<i class="ace-icon fa fa-check"></i>
									CAJA <?php Echo($Mitienda); ?>
								</li>

								<li class="dropdown-content">
									<ul class="dropdown-menu dropdown-navbar">

										<li>
											<a href="CajaTienda.php">
												<div class="clearfix">
													<span class="pull-left">Efectivo</span>
													<span class="pull-right"><?php Echo(formatomoneda($ValorEfectivo))?></span>
												</div>

												
											</a>
										</li>
								
										<li>
											<a href="CajaTienda.php">
												<div class="clearfix">
													<span class="pull-left">Tarjeta</span>
													<span class="pull-right"><?php Echo(formatomoneda($ValorTarjeta)) ?></span>
												</div>
											</a>
										</li>

										<li>
											<a href="CajaTienda.php">
												<div class="clearfix">
													<span class="pull-left">Transferencias</span>
													<span class="pull-right"><?php Echo(formatomoneda($ValorTransferencia)) ?></span>
												</div>
											</a>
										</li>
										<li>
											<a href="CajaTienda.php">
												<div class="clearfix">
													<span class="pull-left">Página Web</span>
													<span class="pull-right"><?php Echo(formatomoneda($ValorPaginaweb)) ?></span>
												</div>
											</a>
										</li>
										<li>
											<a href="CajaTienda.php">
												<div class="clearfix">
													<span class="pull-left">Otros</span>
													<span class="pull-right"><?php Echo(formatomoneda($ValorEfecty)) ?></span>
												</div>
											</a>
										</li>

									</ul>
								</li>
								<li class="dropdown-footer">
									<a href="CajaTienda.php">
										Auditar Caja
										<i class="ace-icon fa fa-arrow-right"></i>
									</a>
								</li>
							</ul>
						</li>
		<?php 
	}
		 ?>
						
						
			 <?php
// Contador de LLamadas 
date_default_timezone_set("America/Bogota");
$TiempoActual = date('Y-m-d H:i:s');
$FechaActual = date('Y-m-d');

$fechainiciodia=$FechaActual." 00:00:00";
$fechafinaldia=$FechaActual." 23:59:59";

$sql ="SELECT Count(Id_Factura) as TotalLlamadas FROM t_facturas WHERE Tienda_Id_Tienda='11' AND Fecha_Factura>='".$fechainiciodia."' and Fecha_Factura<='".$fechafinaldia."' ";  
//echo($sql);
$result = $conexion->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {   
      $TotalLlamadas=$row['TotalLlamadas'];
 }
}

$sql ="SELECT Count(Id_Pedido) as TotalPedidos FROM t_pedido WHERE Fecha_Pedido>='".$fechainiciodia."' and Fecha_Pedido<='".$fechafinaldia."' ";  
//echo($sql);
$result = $conexion->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {   
      $TotalPedidos=$row['TotalPedidos'];
 }
}

$sql ="SELECT Count(Id_Factura) as TotalLlamadas FROM t_facturas WHERE Tienda_Id_Tienda='1' AND Fecha_Factura>='".$fechainiciodia."' and Fecha_Factura<='".$fechafinaldia."' ";  
//echo($sql);
$result = $conexion->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {   
      $TotalFacValledupar=$row['TotalLlamadas'];
 }
}

$FacturasHoy=$TotalLlamadas+$TotalFacValledupar;

                                     ?>

						<li style="background-color: red;" class="yellow dropdown-modal">
							<?php 
					if ($IdRol==1 || $IdUser==61 || $IdUser==43 ) {
						?>
							<a data-toggle="dropdown" class="dropdown-toggle" href="#">
								<i class="ace-icon fa fa-dollar icon-animated-bell"></i>
								<span class="badge badge-warning"><?php Echo($FacturasHoy) ?></span>
							</a>
							<?php 
						}
							 ?>

							<ul class="dropdown-menu-right dropdown-navbar navbar-red dropdown-menu dropdown-caret dropdown-close">
								<li class="dropdown-header">
									<i class="ace-icon fa fa-info-circle"></i>
									<?php Echo("Facturas Barranquilla :<h3> Total Hoy ".$TotalLlamadas."</h3>") ?> 
								</li>
								<li class="dropdown-header">
									<i class="ace-icon fa fa-info-circle"></i>
									<?php Echo("Facturas Valledupar :<h3> Total Hoy ".$TotalFacValledupar."</h3>") ?> 
								</li>
								
								<li class="dropdown-footer">
									<a href="Informe-salidacontablewo.php">
										Ver Facturación
										<i class="ace-icon fa fa-arrow-right"></i>
									</a>
								</li>
							</ul>
						</li>





						<li class="red dropdown-modal">
							<?php 
					if ($IdRol==1 || $IdUser==61 || $IdUser==43 ) {
						?>
							<a data-toggle="dropdown" class="dropdown-toggle" href="#">
								<i class="ace-icon fa fa-list icon-animated-bell"></i>
								<span class="badge badge-warning"><?php Echo($TotalPedidos) ?></span>
							</a>
							<?php 
						}
							 ?>

							<ul class="dropdown-menu-right dropdown-navbar navbar-red dropdown-menu dropdown-caret dropdown-close">
								<li class="dropdown-header">
									<i class="ace-icon fa fa-info-circle"></i>
									<?php Echo("Pedidos Modasof :<h3> Total Hoy ".$TotalPedidos."</h3>") ?> 
								</li>
								
								<li class="dropdown-footer">
									<a href="Pedidoswo.php">
										Gestionar Pedidos W.O
										<i class="ace-icon fa fa-arrow-right"></i>
									</a>
								</li>
							</ul>
						</li>

<?php
// Contador de LLamadas 
$sql ="SELECT Count(Id_Temporal_Sol) as TotalPrendas FROM t_temporal_sol WHERE Solicitud_Id_Usuari='".$IdUser."'";  
$result = $conexion->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {   
      $TotalPrendas=$row['TotalPrendas'];
 }
}
                                     ?>
						<li class="blue dropdown-modal">
						<?php 
					if ($IdRol!=6) {
						?>
							<a data-toggle="dropdown" class="dropdown-toggle" href="#">
								<i class="ace-icon fa fa-cut icon-animated-bell"></i>
								<span class="badge badge-info"><?php Echo($TotalPrendas) ?></span>
							</a>
						<?php 
					}
						 ?>

							<ul class="dropdown-menu-right dropdown-navbar navbar-pink dropdown-menu dropdown-caret dropdown-close">
								<li class="dropdown-header">
									<i class="ace-icon fa fa-info-circle"></i>
									<?php Echo($TotalPrendas) ?> Referencias Seleccionadas
								</li>
								

								<li class="dropdown-content">
									<ul class="dropdown-menu dropdown-navbar navbar-pink">
									<li><!-- start message -->
			<?php 
$sql="SELECT C.Nom_Talla,B.Img_Referencia,Id_Temporal_Sol, Bodega_Id_Bodega, Cant_Solicitada, Talla_Solicitada, Tienda_Id_Tienda, Referencia_Id_Referencia, Fecha_Solicitud, Solicitud_Id_Usuari, Valor_Prenda, Observa_Cliente FROM t_temporal_sol as A, t_referencias as B, t_tallas as C  WHERE A.Referencia_Id_Referencia=B.Cod_Referencia and A.Talla_Solicitada=C.Id_Talla and Solicitud_Id_Usuari='".$IdUser."'";
//Echo($sql);
$result = $conexion->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) { 
$Id_Temporal_Sol=$row['Id_Temporal_Sol'];
$Nom_Talla=$row['Nom_Talla'];
$Img_Referencia=$row['Img_Referencia'];
$Bodega_Id_Bodega=$row['Bodega_Id_Bodega'];
$Cant_Solicitada=$row['Cant_Solicitada'];
$Talla_Solicitada=$row['Talla_Solicitada'];
$Tienda_Id_Tienda=$row['Tienda_Id_Tienda'];
$Referencia_Id_Referencia=$row['Referencia_Id_Referencia'];
$Fecha_Solicitud=$row['Fecha_Solicitud'];
$Solicitud_Id_Usuari=$row['Solicitud_Id_Usuari'];
$Valor_Prenda=$row['Valor_Prenda'];
$Observa_Cliente=$row['Observa_Cliente'];

$TotalPedido=$Cant_Solicitada*$Valor_Prenda;

                                     ?>
                    <a href="OrdenCliente.php">
                      <div class="pull-left">
                        <img style="margin: 10px;" src="<?php Echo($Img_Referencia) ?>" class="msg-photo" alt="User Image">
                      </div>
                      <h6>
                          <?php Echo($Referencia_Id_Referencia."-".$Nom_Talla); ?>
                        <br>
                        <small>  <?php Echo($Cant_Solicitada) ?> Und.</small>
                      </h6>
                     
                    </a>
                    <?php 
                }
            }

                     ?>
                  </li>
									</ul>
								</li>

								<li class="dropdown-footer">
									<a href="OrdenCliente.php">
										Crear Orden de Corte
										<i class="ace-icon fa fa-arrow-right"></i>
									</a>
								</li>

							</ul>
						</li>
<?php 
						$sql="SELECT count(Id_Notifica) as CuentaNot From t_notificaciones where  Usuario_Recibe='".$IdUser."'";
$result = $conexion->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {                
        $CuentaNot=$row['CuentaNot'];
    }
}
						 ?>
						<li class="green dropdown-modal">
							<?php 
					if ($IdRol!=6) {
						?>
							<a data-toggle="dropdown" class="dropdown-toggle" href="#">
								<i class="ace-icon fa fa-bell icon-animated-vertical"></i>
								<span class="badge badge-success">
									<?php 
									$MyIdTienda=$_SESSION['IdTienda'];
				$sql ="SELECT COUNT(Id_Traslado) as TotalTraslados From t_traslados Where id_tienda_desde='".$MyIdTienda."' AND status='SOLICITADO'";  
//echo ($sql);
$result = $conexion->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {                
        $TotalTraslados=$row['TotalTraslados'];
       Echo($TotalTraslados);
    }
}

									 ?>
								</span>
							</a>
					<?php 

				}
					 ?>

							<ul class="dropdown-menu-right dropdown-navbar dropdown-menu dropdown-caret dropdown-close">
								<li class="dropdown-header">
									<i class="ace-icon fa fa-exchange"></i>
						
									<?php 
									$MyIdTienda=$_SESSION['IdTienda'];
				$sql ="SELECT COUNT(Id_Traslado) as TotalTraslados From t_traslados Where id_tienda_desde='".$MyIdTienda."' AND status='SOLICITADO'";  
//echo ($sql);
$result = $conexion->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {                
        $TotalTraslados=$row['TotalTraslados'];
       Echo($TotalTraslados);
    }
}

									 ?> Notificación de Traslado
								</li>

								<li class="dropdown-content">
									<ul class="dropdown-menu dropdown-navbar">
										<?php 

$sql ="SELECT id_traslado,Nom_Tienda,Fecha_Solicitud,Nombres,Apellidos,Img_Perfil FROM t_traslados as A, t_usuarios as B,t_tiendas as C WHERE A.Id_User=B.Id_Usuario and A.id_tienda_hasta=C.Id_Tienda and status='SOLICITADO' and id_tienda_desde='".$MyIdTienda."' ";  
//echo ($sql);
$result = $conexion->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {                
        $Nom_Tienda=$row['Nom_Tienda'];
         $id_traslado=$row['id_traslado'];
        $Fecha_Solicitud=$row['Fecha_Solicitud'];
        $Nombres=$row['Nombres'];
        $Apellidos=$row['Apellidos'];
        $Qr_imgperfil=$row['Img_Perfil'];


?>

										<li>
											<a href="traslados_solicitudes.php?TxtTienda=<?php Echo($MyIdTienda) ?>&TxtNomTienda=<?php Echo($Mitienda) ?>" class="clearfix">
												<img src="../Administrator/<?php Echo($Qr_imgperfil); ?>" class="msg-photo" />
												<span class="msg-body">
													<span class="msg-title">
														<span class="blue"><?php Echo utf8_encode($Nombres." ".$Apellidos); ?></span><br>
														Ha solicitado un traslado para la tienda <?php Echo utf8_encode($Nom_Tienda); ?>
													</span>

													<span class="msg-time">
														<i class="ace-icon fa fa-clock-o"></i>
														<span>
															<?php 
															$date1 = new DateTime($Fecha_Solicitud);
$date2 = new DateTime("now");
$diff = $date1->diff($date2);
// 38 minutes to go [number is variable]
echo ($diff->invert == 1 ) ? ' passed ' : ' Hace ';
echo ( ($diff->days * 24 ) * 60 ) + ( $diff->i ) . ' minutos';
// passed means if its negative and to go means if its positive

															 ?>

														</span><br>
														<!-- <span class="blue">Actividad:<?php Echo utf8_encode($Qr_Cod+1300); ?></span> -->
													</span>
												</span>
											</a>
										</li>
										<?php 
									}
								}
										 ?>
									</ul>
								</li>

								<li class="dropdown-footer">
									<a href="traslados_solicitudes.php?TxtTienda=<?php Echo($MyIdTienda) ?>&TxtNomTienda=<?php Echo($Mitienda) ?>">
										Ver todas las notificaciones
										<i class="ace-icon fa fa-arrow-right"></i>
									</a>
								</li>
							</ul>
						</li>
<?php 
						$sql="SELECT Nombres,Apellidos,Img_Perfil,Nombre_Rol From t_usuarios as A, t_rol_usuario as B where A.Rol_Id_Rol=B.Id_Rol and Id_Usuario='".$IdUser."'";
$result = $conexion->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {                
        $NomUser=$row['Nombres'];
        $ApeUser=$row['Apellidos'];
        $Img_Perfil=$row['Img_Perfil'];
        $NomSesion=$NomUser." ".$ApeUser;
        $NomRol=$row['Nombre_Rol'];
        
    }
}
						 ?>
						<li class="dark dropdown-modal">
							<a data-toggle="dropdown" href="#" class="dropdown-toggle">
								<img class="nav-user-photo" src="../Administrator/<?php Echo utf8_encode($Img_Perfil); ?>" alt="Jason's Photo" />
								<span class="user-info">
									<small>Bienvenido,</small>
									<?php Echo utf8_encode($NomUser." ".$ApeUser); ?>
								</span>
								<?php 
								$TipoNot=$_GET['TipoNot'];
								   Echo(Tiponotificacion($TipoNot,$NomSesion,$Img_Perfil,"index.php"));
								 ?>
								<i class="ace-icon fa fa-caret-down"></i>
							</a>

							<ul class="user-menu dropdown-menu-right dropdown-menu dropdown-yellow dropdown-caret dropdown-close">
							<?php 
					if ($Val_Sistema==1) {
					?>
								<li>
									<a href="config.php">
										<i class="ace-icon fa fa-cog"></i>
										Configuración
									</a>
								</li>
					<?php 
				}
					 ?>
<?php 
					if ($IdRol!=6) {
						?>
								<li>

									<a href="Perfil.php?TAB=tabs-3">
										<i class="ace-icon fa fa-user"></i>
										Perfil
									</a>
								</li>
			<?php 
		}
			 ?>
			 		<?php 
			 		if ($IdUser==72) {
			 			?>
			 			<li class="divider"></li>

								<li>
									<a href="../Login/cambioperfilventas.php">
										<i class="ace-icon fa fa-exchange"></i>
										Ir a Perfil Ventas
									</a>
								</li>
								<li>
									<a href="index.php">
										<i class="ace-icon fa fa-bar-chart"></i>
										Indicadores
									</a>
								</li>
			 			<?php
			 		}
			 		else if ($IdUser==73) {
			 			?>
			 			<li class="divider"></li>
								<li>
									<a href="../Login/cambioperfiltaller.php">
										<i class="ace-icon fa fa-exchange"></i>
										Ir a Perfil Taller
									</a>
								</li>
								<li>
									<a href="index.php">
										<i class="ace-icon fa fa-bar-chart"></i>
										Indicadores
									</a>
								</li>
			 			<?php
			 		}
			 		else if ($IdUser==54) {
			 		 ?>
			 		 <li class="divider"></li>
								<li>
									<a href="../Login/cambioperfilventasgerencia.php">
										<i class="ace-icon fa fa-exchange"></i>
										Ir a Perfil Ventas
									</a>
								</li>
								
							<?php 
						}
						 else if ($IdUser==58) {
						?>
						 <li class="divider"></li>
								<li>
									<a href="../Login/cambioperfiladmin.php">
										<i class="ace-icon fa fa-exchange"></i>
										Ir a Perfil Admin
									</a>
						</li>
					<?php } ?>


								
								<li class="divider"></li>

								<li>
									<a href="../Login/Logout.php">
									
										<i class="ace-icon fa fa-power-off"></i>
										Salir
									</a>
								</li>
							</ul>
						</li>
					</ul>
				</div>
			</div><!-- /.navbar-container -->
		</div>