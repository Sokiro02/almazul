<!-- Inicio Indicadores -->
							<div class="space-4"></div>
							<?php 
// ******************* Consulta Proveedor con máxima compra ************************** //
$sql ="SELECT MAX(Insumo_Cod_Insumo) as InsumoMax FROM t_orden_compra_insumos"; 
//Echo($sql);
$result = $conexion->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {                
        $InsumoMax=$row['InsumoMax'];
 }
}
// ******************* Consulta Insumo con máxima compra ************************** //
$sql ="SELECT IFNULL(sum(A.Costo_Insumo*Cantidad_Solicitada),0) as TotalMes,Nom_Insumo,Nom_Prov from t_orden_compra_insumos as A,t_insumos as B, t_proveedores as C WHERE  Insumo_Cod_Insumo='".$InsumoMax."' and A.Insumo_Cod_Insumo=B.Id_Insumo and A.Proveedor_Id_Proveedor=C.Id_Proveedor "; 
//Echo($sql);
$result = $conexion->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {                
        $Max_Compra=$row['TotalMes'];
        $Max_Nom_Insumo=$row['Nom_Prov'];
 }
}
// ******************* Consulta Insumo con máxima compra ************************** //
?>		
						<div class="col-xs-12 col-sm-3 widget-container-col" id="widget-container-col-5">
											<div class="widget-box" id="widget-box-5">
												<div class="widget-header">
													<h5 class="widget-title smaller"><?php Echo utf8_encode($Max_Nom_Insumo) ?> </h5>
													<div class="widget-toolbar">
													</div>
												</div>
												<div class="widget-body">
													<div class="widget-main padding-6">
														<div class="alert degrade-verde"> <strong><?php Echo(formatomoneda($Max_Compra)) ?></strong></div>
													</div>
												</div>
											</div>
						</div>

					<div class="col-xs-12 col-sm-3 widget-container-col" id="widget-container-col-5">
											<div class="widget-box" id="widget-box-5">
												<div class="widget-header">
													<h5 class="widget-title smaller">Pedidos Mes Actual </h5>

													<div class="widget-toolbar">
														<span class="label label-success">
															<?php Echo($V2); ?> %
															<i class="ace-icon fa fa-arrow-up"></i>
														</span>
													</div>
												</div>

												<div class="widget-body">
													<div class="widget-main padding-6">

														<div class="alert alert-success"><strong><?php Echo(formatomoneda(SumaporFechas("Costo_Insumo","t_orden_compra_insumos","Actual","Fecha_Solicitud","Cantidad_Solicitada"))) ?></strong></div>
													</div>
												</div>
											</div>
								</div>

						<div class="col-xs-12 col-sm-3 widget-container-col" id="widget-container-col-5">
											<div class="widget-box" id="widget-box-5">
												<div class="widget-header">
													<h5 class="widget-title smaller">Mes Anterior</h5>

													<div class="widget-toolbar">
															<!-- <span class="label label-success">
															33%
															<i class="ace-icon fa fa-arrow-up"></i>
														</span> -->
													</div>
												</div>

												<div class="widget-body">
													<div class="widget-main padding-6">
														<div class="alert alert-info"> <strong><strong><?php Echo(formatomoneda(SumaporFechas("Costo_Insumo","t_orden_compra_insumos","Anterior","Fecha_Solicitud","Cantidad_Solicitada"))) ?></strong></strong></div>
													</div>
												</div>
											</div>
										</div>

<?php 
//************Consulta Total Compras***************
$sql ="SELECT IFNULL(sum(Valor_Subtotal),0) as TotalCompras from t_orden_compra_insumos"; 
//Echo($sql);
$result = $conexion->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {                
        $TotalCompras=$row['TotalCompras'];
 }
}
//************Consulta Total Compras***************
?>
						<div class="col-xs-12 col-sm-3 widget-container-col" id="widget-container-col-5">
											<div class="widget-box" id="widget-box-5">
												<div class="widget-header">
													<h5 class="widget-title smaller">Total Pedidos</h5>

													<div class="widget-toolbar">
													
													</div>
												</div>

												<div class="widget-body">
													<div class="widget-main padding-6">
												
														<div class="alert alert-info"> <strong><?php Echo(formatomoneda($TotalCompras)) ?></strong></div>
													</div>
												</div>
											</div>
							</div>						
					</div>
				<!-- Fin Indicadores  -->