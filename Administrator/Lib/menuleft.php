<?php 
 ?>
<ul class="nav nav-list">
					<li class="active">
					<?php 
					if ($IdRol==1) {
						?>
						<a href="index.php">
							<i class="menu-icon fa fa-tachometer"></i>
							<span class="menu-text"> Panel Principal </span>
						</a>
						<?php
					}
					elseif ($IdRol==2)
					{
						?>
						<a href="index-produccion.php">
							<i class="menu-icon fa fa-tachometer"></i>
							<span class="menu-text"> Panel Principal </span>
						</a>
						<?php
					}

					 ?>
						

						<b class="arrow"></b>
					</li>

					<li class="">
						<a href="" class="dropdown-toggle">
							<i class="menu-icon fa fa-users"></i>
							<span class="menu-text"> Clientes </span>

							<b class="arrow fa fa-angle-down"></b>
						</a>

						<b class="arrow"></b>

						<ul class="submenu">
						 <?php 
					if ($Menu_Clientes==1) {
						?>
						<?php 
						if ($IdUser!=57) {
							?>
							<li class="">
								<a href="Clientes.php">
									<i class="menu-icon fa fa-users"></i>
									Clientes
								</a>
							</li>

							<?php
						}
						 ?>
							
						<?php
					}
					 ?>	
					  <?php 
					if ($Menu_Clientes==1) {
						?>
						<li>
								<a href="Clientes2.php">
									<i class="menu-icon fa fa-search"></i>
									Buscar Cliente
								</a>

								<b class="arrow"></b>
							</li>
							<li class="">
								<a href="Informe-VentasTienda.php">
									<i class="menu-icon fa fa-map-pin"></i>
									Facturado
								</a>

								<b class="arrow"></b>
							</li>
							<li class="">
								<a href="Informe-salidacontable.php">
									<i class="menu-icon fa fa-map-pin"></i>
									Salidas Contables
								</a>

								<b class="arrow"></b>
							</li>
							<li class="">
								<a href="Cartera.php">
									<i class="menu-icon fa fa-dollar"></i>
									Cartera World Office
								</a>
								<b class="arrow"></b>
							</li>
							<li class="">
								<a href="Informe-RecibosdeCaja.php">
									<i class="menu-icon fa fa-map-pin"></i>
									Recibos Caja
								</a>

								<b class="arrow"></b>
							</li>
							<li class="">
								<a href="Informe-Bonos.php">
									<i class="menu-icon fa fa-map-pin"></i>
									Bonos
								</a>

								<b class="arrow"></b>
							</li>
							<li class="">
								<a href="Misventas.php">
									<i class="menu-icon fa fa-map-pin"></i>
									Detalle Ventas
								</a>

								<b class="arrow"></b>
							</li>
							<li class="">
								<a href="Misventasne.php">
									<i class="menu-icon fa fa-map-pin"></i>
									Detalle Salidas Contables
								</a>

								<b class="arrow"></b>
							</li>
							<li class="">
								<a href="Informe-RemisionesTienda.php">
									<i class="menu-icon fa fa-map-pin"></i>
									Remisiones
								</a>

								<b class="arrow"></b>
							</li>
							<li class="">
								<a href="cc_informe.php">
									<i class="menu-icon fa fa-map-pin"></i>
									Publicidad
								</a>

								<b class="arrow"></b>
							</li>
						<?php
					}
					 ?>	
					  <?php 
					if ($Menu_Clientes==1) {
						?>
							<li class="">
								<a href="Pedidos.php">
									<i class="menu-icon fa fa-dollar"></i>
									Pedidos Cliente
								</a>

								<b class="arrow"></b>
							</li>
							<li class="">
								<a href="PedidosEntregados.php">
									<i class="menu-icon fa fa-dollar"></i>
									Pedidos Entregados
								</a>

								<b class="arrow"></b>
							</li>
						<?php
					}
					 ?>		
					
						</ul>
					</li>

					<li class="">
						<a href="" class="dropdown-toggle">
							<i class="menu-icon fa fa-calendar"></i>
							<span class="menu-text"> Plan Separe </span>

							<b class="arrow fa fa-angle-down"></b>
						</a>

						<b class="arrow"></b>

						<ul class="submenu">
						
					  <?php 
					if ($Menu_Clientes==1) {
						?>
							<li class="">
								<a href="Informe-PlanSepare.php">
									<i class="menu-icon fa fa-map-pin"></i>
									Ver Planes Separe
								</a>

								<b class="arrow"></b>
							</li>
							<li class="">
								<a href="InventarioSeparado.php">
									<i class="menu-icon fa fa-map-pin"></i>
									Inventario Separado
								</a>

								<b class="arrow"></b>
							</li>
							
							
						<?php
					}
					 ?>	
					 
						</ul>
					</li>
					
	
					<li class="">
					
						<a href="panel-produccion.php" class="dropdown-toggle">
							<i class="menu-icon fa fa-cogs"></i>
							<span class="menu-text"> A. Producción </span>

							<b class="arrow fa fa-angle-down"></b>
						</a>
						

						<b class="arrow"></b>

						<ul class="submenu">
							
						<?php 
					if ($Menu_Produccion==1) {
						?>
						<li class="">
								<a href="SolicitudesProduccion.php">
									<i class="menu-icon fa fa-cogs"></i>
									Producción
								</a>
						<b class="arrow"></b>
							</li>

						<li class="">
								<a href="Produccion-Sastre.php">
									<i class="menu-icon fa fa-cogs"></i>
									Pedidos a Sastre
								</a>
						<b class="arrow"></b>
							</li>
							<li class="">
								<a href="Pedidos.php">
									<i class="menu-icon fa fa-cogs"></i>
									Pedidos Clientes
								</a>
						<b class="arrow"></b>
							</li>
					<?php
					}else{
						?>
							<li style="display: none;" class="">
								<a href="tabla_centrodis.php">
									<i class="menu-icon fa fa-cogs"></i>
									Inventario Talleres
								</a>
						<b class="arrow"></b>
							</li>

						<?php
					}


					 ?>

								
							
					<?php 
					if ($Menu_Proveedores==1) {
						?>
						<li class="">
								<a href="Proveedores.php">
									<i class="menu-icon fa fa-cogs"></i>
									Proveedores
								</a>
						<b class="arrow"></b>
							</li>
					<?php
					}
					 ?>

								
							
							
					<?php 
					if ($Menu_Insumos==1) {
						?>
						<li class="">
								<a href="Lista-Insumos.php">
									<i class="menu-icon fa fa-user"></i>
									Insumos
								</a>
						<b class="arrow"></b>
							</li>
					<?php
					}
					 ?>
					 <?php 
					if ($Menu_Bodegas==1) {
						?>
							<li class="">
								<a href="insumos-cargar.php">
									<i class="menu-icon fa fa-map-pin"></i>
									Cargar Insumos Inv.
								</a>

								<b class="arrow"></b>
							</li>
						<?php
					}
					 ?>	
					 <?php 
					if ($Menu_Insumos==1) {
						?>
						<li class="">
								<a href="insumos.php">
									<i class="menu-icon fa fa-user"></i>
									Categorias Insumos
								</a>
						<b class="arrow"></b>
							</li>
					<?php
					}
					 ?>
					<?php 
					if ($Menu_Compras==1) {
						?>	
							<li class="">
								<a href="Compras.php">
									<i class="menu-icon fa fa-user"></i>
									Compras
								</a>

								<b class="arrow"></b>
							</li>
					<?php
					}
					 ?>
					
						</ul>
					</li>

                   <li class="">
						<a href="#" class="dropdown-toggle">
						<i class="menu-icon glyphicon glyphicon-refresh"></i>
							<span class="menu-text"> Devoluciones </span>
							<b class="arrow fa fa-angle-down"></b>
						<b class="arrow"></b>
						</a>
                        <ul class="submenu">

                          <li class="">
								<a href="NotasCredito-Tienda.php">
									<i class="menu-icon fa fa-cogs"></i>
									Listado de Devoluciones - Notas Crédito
                                </a>
                                <b class="arrow"></b>
						  </li>
                        </ul>
                    </li>  

                    <li class="">
						<a href="#" class="dropdown-toggle">
						<i class="menu-icon fa fa-exchange"></i>
							<span class="menu-text"> Traslados </span>
							<b class="arrow fa fa-angle-down"></b>
						<b class="arrow"></b>
						</a>
                        <ul class="submenu">
                          <li class="">
								<a href="traslados.php">
									<i class="menu-icon fa fa-cogs"></i>
									Traslados de Referencias
                                </a>
                                <b class="arrow"></b>
						  </li>
                          <li class="">
								<a href="traslados_solicitudes.php?TxtTienda=<?php echo($MyIdTienda); ?>">

									<i class="menu-icon fa fa-cogs"></i>
									Aceptar Traslados
                                </a>
                                <b class="arrow"></b>
						  </li>
                          <li class="">
								<a href="traslados_recibir.php?TxtTienda=<?php echo($MyIdTienda); ?>">
									<i class="menu-icon fa fa-cogs"></i>
									Recibir Traslados
                                </a>
                                <b class="arrow"></b>
						  </li>
                        </ul>
                    </li>    					
					<li class="">
						<a href="#" class="dropdown-toggle">
						<i class="menu-icon fa fa-truck"></i>
							<span class="menu-text"> Despachos </span>
							<b class="arrow fa fa-angle-down"></b>
						<b class="arrow"></b>
						</a>

                        
						<ul class="submenu">
							<?php 
					if ($Menu_Produccion==1) {
						?>
							<li class="">
								<a href="tiendas_inventario.php">
									<i class="menu-icon fa fa-cogs"></i>
									Despachos de Producción
								</a>
								<b class="arrow"></b>
							</li>
								<li class="">
								<a href="VerInventario-Tienda.php?QueryCon=10">
									<i class="menu-icon fa fa-map-pin"></i>
									BODEGA Modasof
								</a>
								<b class="arrow"></b>
							</li>
							<li class="">
								<a href="tiendas_inventario2.php">
									<i class="menu-icon fa fa-cogs"></i>
									Despachos de Clientes
								</a>
								<b class="arrow"></b>
							</li>                            	
						
      	                 <li class="">
								<a href="listados_envios.php">
									<i class="menu-icon fa fa-cogs"></i>
									Envios en Camino
								</a>
								<b class="arrow"></b>
						  </li>	
                          <li class="">
								<a href="listado_despachos.php">
									<i class="menu-icon fa fa-cogs"></i>
									Listado de Despachos
                                </a>
                                <b class="arrow"></b>
						  </li>	
						   <li class="">
								<a href="detalle-despachos.php">
									<i class="menu-icon fa fa-cogs"></i>
									Detalle de Despachos
                                </a>
                                <b class="arrow"></b>
						  </li>	
						  
						 <?php 
						}
						  ?>
						   <?php 
					if ($Menu_Clientes==1) {
						?>
						 <li class="">
								<a href="despachos-costo.php">
									<i class="menu-icon fa fa-cogs"></i>
									Despachos - Costos
                                </a>
                                <b class="arrow"></b>
						  </li>	
						  <li class="">
								<a href="tiendas_recepcion.php">
									<i class="menu-icon fa fa-cogs"></i>
									Recepción de Despachos
								</a>
								<b class="arrow"></b>
							</li>	
                         
						  <li class="">
								<a href="tiendas_despachos_clientes.php">
									<i class="menu-icon fa fa-truck"></i>
									Despachos recibidos Cliente 
								</a>

								<b class="arrow"></b>
							</li> 
							
						  <?php 
}
						   ?>  
						    <li class="">
								<a href="Generar-CodigosBarra.php">
									<i class="menu-icon fa fa-cogs"></i>
									Generar Codigos de Barra
                                </a>
                                <b class="arrow"></b>
						  </li> 

                                                    
                        <!--   <li class="">
								<a href="#">
									<i class="menu-icon fa fa-cogs"></i>
									Devoluciones de Tiendas
                                </a>
                                <b class="arrow"></b>
						  </li>                                                    
                          <li class="">
								<a href="#">
									<i class="menu-icon fa fa-cogs"></i>
									Devoluciones de Clientes
                                </a>
                                <b class="arrow"></b>
						  </li>    -->                                                 
                                                                              
						</ul>
					</li>
				
					<li class="">
						<a href="panel-produccion.php" class="dropdown-toggle">
							<i class="menu-icon fa fa-barcode"></i>
							<span class="menu-text"> Productos </span>

							<b class="arrow fa fa-angle-down"></b>
						</a>

						<b class="arrow"></b>

						<ul class="submenu">
					<?php 
					if ($Menu_Prod_Config==1) {
						?>
							<li class="">
								<a href="Productos-Categoria.php">
									<i class="menu-icon fa fa-cogs"></i>
									Configuración
								</a>

								<b class="arrow"></b>
							</li>
					<?php
					}
					 ?>
					 <?php 
					if ($Menu_Prod_Colecciones==1) {
						?>
							<li class="">
								<a href="Productos-Coleccion.php">
									<i class="menu-icon fa fa-cogs"></i>
									Colecciones
								</a>

								<b class="arrow"></b>
							</li>
					<?php
					}
					 ?>
							<!-- id="Menu-Oculto-Iphone" -->
					<?php 
					if ($Menu_Prod_Crear==1) {
						?>
							<li  class="">
								<a href="Producto-Crear.php">
									<i class="menu-icon fa fa-cogs"></i>
									Crear Producto Interno
								</a>

								<b class="arrow"></b>
							</li>
					<?php
					}
					 ?>
					 <?php 
					if ($Menu_Prod_Crear==1) {
						?>
							<li  class="">
								<a href="Producto-CrearMaquila.php">
									<i class="menu-icon fa fa-cogs"></i>
									Crear Producto Externo
								</a>

								<b class="arrow"></b>
							</li>
					<?php
					}
					 ?>
					<?php 
					if ($Menu_Galeria==1) {
						?>
							<li class="">
								<a href="Lista-Referencias.php">
									<i class="menu-icon fa fa-cogs"></i>
									Ver Referencias
								</a>

								<b class="arrow"></b>
							</li>
					<?php
					}
					 ?>	
							
						</ul>
					</li>
					
					
					<li class="">
						<a href="panel-produccion.php" class="dropdown-toggle">
							<i class="menu-icon fa fa-list-alt"></i>
							<span class="menu-text"> Inventario </span>

							<b class="arrow fa fa-angle-down"></b>
						</a>

						<b class="arrow"></b>

						<ul class="submenu">
							                    
					<?php 
					if ($Menu_CentroDist==1) {
						?>
							<li class="">
								<a href="Centro-Distribucion.php?Stock=1">
									<i class="menu-icon fa fa-cogs"></i>
									Centro de Distribución
								</a>

								<b class="arrow"></b>
							</li>
							
					<?php
					}
					 ?>	
					 <?php 
					if ($Menu_Remisiones==1) {
						?>
							<li class="">
								<a href="Despachos.php">
									<i class="menu-icon fa fa-truck"></i>
									Despachos de Clientes 
								</a>

								<b class="arrow"></b>
							</li>
							<li class="">
								<a href="tiendas_inventario.php">
									<i class="menu-icon fa fa-cogs"></i>
									Despachos de Producción
								</a>
								<b class="arrow"></b>
							</li>		
						<li class="">
								<a href="tiendas_recepcion.php">
									<i class="menu-icon fa fa-cogs"></i>
									Recepción de Inventario
								</a>
								<b class="arrow"></b>
							</li>		
						<?php
					}
					 ?>		
						</ul>
					</li>
				
					<li class="">
						<a href="" class="dropdown-toggle">
							<i class="menu-icon fa fa-map-marker"></i>
							<span class="menu-text"> Tiendas-Talleres </span>

							<b class="arrow fa fa-angle-down"></b>
						</a>

						<b class="arrow"></b>

						<ul class="submenu">
						 <?php 
					if ($Menu_Bodegas==1) {
						?>
							<li class="">
								<a href="Bodegas.php">
									<i class="menu-icon fa fa-map-pin"></i>
									Talleres
								</a>

								<b class="arrow"></b>
							</li>
						<?php
					}
					 ?>	
					  <?php 
					if ($Menu_Bodegas==1) {
						?>
							<li class="">
								<a href="Tiendas.php">
									<i class="menu-icon fa fa-map-pin"></i>
									Tiendas
								</a>

								<b class="arrow"></b>
							</li>
						<?php
					}
					 ?>		
						</ul>
					</li>

					<li class="">
						<a href="" class="dropdown-toggle">
							<i class="menu-icon fa fa-line-chart"></i>
							<span class="menu-text"> Informes </span>

							<b class="arrow fa fa-angle-down"></b>
						</a>

						<b class="arrow"></b>

						<ul class="submenu">
							<li class="">
								<a href="Informe-salidacontablewo.php">
									<i class="menu-icon fa fa-map-pin"></i>
									Salidas Contables W.O
								</a>

								<b class="arrow"></b>
							</li>
							<li class="">
								<a href="Pedidoswo.php">
									<i class="menu-icon fa fa-map-pin"></i>
									Vista Pedidos W.O
								</a>

								<b class="arrow"></b>
							</li>
						 <?php 
					if ($Menu_Bodegas==1) {
						?>
							<li class="">
								<a href="Informe-Facturas.php">
									<i class="menu-icon fa fa-map-pin"></i>
									Facturación
								</a>

								<b class="arrow"></b>
							</li>
							<li class="">
								<a href="Informe-CostoVentas.php">
									<i class="menu-icon fa fa-money"></i>
									Costo vs Ventas
								</a>

								<b class="arrow"></b>
							</li>
							<li class="">
								<a href="Informe-Cartera.php">
									<i class="menu-icon fa fa-map-pin"></i>
									Cartera Wordl Office
								</a>

								<b class="arrow"></b>
							</li>
								<li class="">
								<a href="causales.php">
									<i class="menu-icon fa fa-map-pin"></i>
									Lista Causales
								</a>

								<b class="arrow"></b>
							</li>
							<li class="">
								<a href="Informe-NotasCredito.php">
									<i class="menu-icon fa fa-map-pin"></i>
									Devoluciones
								</a>

								<b class="arrow"></b>
							</li>
								
							<!-- <li class="">
								<a href="Informe-GastosTienda.php">
									<i class="menu-icon fa fa-map-pin"></i>
									Gastos
								</a>

								<b class="arrow"></b>
							</li> -->
						<?php
					}
					 ?>	

					  <?php 
					if ($Menu_Bodegas==1) {
						?>
							<li class="">
								<a href="Informe-Ingresos.php">
									<i class="menu-icon fa fa-money"></i>
									Ingresos en Dinero
								</a>

								<b class="arrow"></b>
							</li>
							<li class="">
								<a href="Informe-Cuadrecaja.php">
									<i class="menu-icon fa fa-money"></i>
									Arqueo Caja Diario
								</a>

								<b class="arrow"></b>
							</li>
							<li class="">
								<a href="Informe-GastosTienda.php">
									<i class="menu-icon fa fa-money"></i>
									Informe de gastos
								</a>

								<b class="arrow"></b>
							</li>
							<li class="">
								<a href="Informe-EgresosTienda.php">
									<i class="menu-icon fa fa-money"></i>
									Informe de Egresos
								</a>

								<b class="arrow"></b>
							</li>

						<?php
					}
					 ?>	

					  <?php 
					if ($Menu_Bodegas==1) {
						?>
							<li class="">
								<a href="Informe-Compras.php">
									<i class="menu-icon fa fa-map-pin"></i>
									Compras Producción
								</a>

								<b class="arrow"></b>
							</li>
						<?php
					}
					 ?>	
					  <?php 
					if ($Menu_Bodegas==1) {
						?>
							<li class="">
								<a href="Informe-Referencias.php">
									<i class="menu-icon fa fa-line-chart"></i>
									Costo - Referencias
								</a>

								<b class="arrow"></b>
							</li>
						<?php
					}
					 ?>	


					  <?php 
					if ($Menu_Bodegas==1) {
						?>
							<!-- <li class="">
								<a href="Inventario-Tienda.php">
									<i class="menu-icon fa fa-line-chart"></i>
									Inventario - Tiendas
								</a>

								<b class="arrow"></b>
							</li> -->
						<?php
					}
					 ?>		
						</ul>
					</li>


					<li class="">
						<a href="" class="dropdown-toggle">
							<i class="menu-icon fa fa-list"></i>
							<span class="menu-text"> Inventarios </span>

							<b class="arrow fa fa-angle-down"></b>
						</a>

						<b class="arrow"></b>

						<ul class="submenu">
						 <?php 
					if ($Menu_Prod_Crear==1) {
						?>
							<li class="">
								<a href="VerInventario-Tienda.php?QueryCon=1">
									<i class="menu-icon fa fa-map-pin"></i>
									Valledupar
								</a>

								<b class="arrow"></b>
							</li>
							<li class="">
								<a href="VerInventario-Tienda.php?QueryCon=11">
									<i class="menu-icon fa fa-map-pin"></i>
									Barranquilla 2021
								</a>
								<b class="arrow"></b>
							</li>
							<li class="">
								<a href="VerInventario-Tienda.php?QueryCon=17">
									<i class="menu-icon fa fa-map-pin"></i>
									WEB
								</a>
								<b class="arrow"></b>
							</li>
							<li class="">
								<a href="VerInventario-Tienda.php?QueryCon=10">
									<i class="menu-icon fa fa-map-pin"></i>
									BODEGA Modasof
								</a>
								<b class="arrow"></b>
							</li>
							
						<?php
					}
					 ?>	

						</ul>
					</li>
				

					<!-- <li class="">
						<a href="#" class="dropdown-toggle">
							<i class="menu-icon fa fa-pencil-square-o"></i>
							<span class="menu-text"> Forms </span>

							<b class="arrow fa fa-angle-down"></b>
						</a>

						<b class="arrow"></b>

						<ul class="submenu">
							<li class="">
								<a href="form-elements.html">
									<i class="menu-icon fa fa-caret-right"></i>
									Form Elements
								</a>

								<b class="arrow"></b>
							</li>

							<li class="">
								<a href="form-elements-2.html">
									<i class="menu-icon fa fa-caret-right"></i>
									Form Elements 2
								</a>

								<b class="arrow"></b>
							</li>

							<li class="">
								<a href="form-wizard.html">
									<i class="menu-icon fa fa-caret-right"></i>
									Wizard &amp; Validation
								</a>

								<b class="arrow"></b>
							</li>

							<li class="">
								<a href="wysiwyg.html">
									<i class="menu-icon fa fa-caret-right"></i>
									Wysiwyg &amp; Markdown
								</a>

								<b class="arrow"></b>
							</li>

							<li class="">
								<a href="dropzone.html">
									<i class="menu-icon fa fa-caret-right"></i>
									Dropzone File Upload
								</a>

								<b class="arrow"></b>
							</li>
						</ul>
					</li>

					<li class="">
						<a href="widgets.html">
							<i class="menu-icon fa fa-list-alt"></i>
							<span class="menu-text"> Widgets </span>
						</a>

						<b class="arrow"></b>
					</li>

					<li class="">
						<a href="calendar.html">
							<i class="menu-icon fa fa-calendar"></i>

							<span class="menu-text">
								Calendar

								<span class="badge badge-transparent tooltip-error" title="2 Important Events">
									<i class="ace-icon fa fa-exclamation-triangle red bigger-130"></i>
								</span>
							</span>
						</a>

						<b class="arrow"></b>
					</li>

					<li class="">
						<a href="gallery.html">
							<i class="menu-icon fa fa-picture-o"></i>
							<span class="menu-text"> Gallery </span>
						</a>

						<b class="arrow"></b>
					</li>

					<li class="">
						<a href="#" class="dropdown-toggle">
							<i class="menu-icon fa fa-tag"></i>
							<span class="menu-text"> More Pages </span>

							<b class="arrow fa fa-angle-down"></b>
						</a>

						<b class="arrow"></b>

						<ul class="submenu">
							<li class="">
								<a href="profile.html">
									<i class="menu-icon fa fa-caret-right"></i>
									User Profile
								</a>

								<b class="arrow"></b>
							</li>

							<li class="">
								<a href="inbox.html">
									<i class="menu-icon fa fa-caret-right"></i>
									Inbox
								</a>

								<b class="arrow"></b>
							</li>

							<li class="">
								<a href="pricing.html">
									<i class="menu-icon fa fa-caret-right"></i>
									Pricing Tables
								</a>

								<b class="arrow"></b>
							</li>

							<li class="">
								<a href="invoice.html">
									<i class="menu-icon fa fa-caret-right"></i>
									Invoice
								</a>

								<b class="arrow"></b>
							</li>

							<li class="">
								<a href="timeline.html">
									<i class="menu-icon fa fa-caret-right"></i>
									Timeline
								</a>

								<b class="arrow"></b>
							</li>

							<li class="">
								<a href="search.html">
									<i class="menu-icon fa fa-caret-right"></i>
									Search Results
								</a>

								<b class="arrow"></b>
							</li>

							<li class="">
								<a href="email.html">
									<i class="menu-icon fa fa-caret-right"></i>
									Email Templates
								</a>

								<b class="arrow"></b>
							</li>

							<li class="">
								<a href="login.html">
									<i class="menu-icon fa fa-caret-right"></i>
									Login &amp; Register
								</a>

								<b class="arrow"></b>
							</li>
						</ul>
					</li>

					<li class="">
						<a href="#" class="dropdown-toggle">
							<i class="menu-icon fa fa-file-o"></i>

							<span class="menu-text">
								Other Pages

								<span class="badge badge-primary">5</span>
							</span>

							<b class="arrow fa fa-angle-down"></b>
						</a>

						<b class="arrow"></b>

						<ul class="submenu">
							<li class="">
								<a href="faq.html">
									<i class="menu-icon fa fa-caret-right"></i>
									FAQ
								</a>

								<b class="arrow"></b>
							</li>

							<li class="">
								<a href="error-404.html">
									<i class="menu-icon fa fa-caret-right"></i>
									Error 404
								</a>

								<b class="arrow"></b>
							</li>

							<li class="">
								<a href="error-500.html">
									<i class="menu-icon fa fa-caret-right"></i>
									Error 500
								</a>

								<b class="arrow"></b>
							</li>

							<li class="">
								<a href="grid.html">
									<i class="menu-icon fa fa-caret-right"></i>
									Grid
								</a>

								<b class="arrow"></b>
							</li>

							<li class="">
								<a href="blank.html">
									<i class="menu-icon fa fa-caret-right"></i>
									Blank Page
								</a>

								<b class="arrow"></b>
							</li>
						</ul>
					</li> -->
				</ul><!-- /.nav-list -->
