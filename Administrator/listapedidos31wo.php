	<?php 
	$areapedido=$_GET['area'];
	$pendientetienda=$_GET['tienda'];
	if ($areapedido=="") {
		?>

		<a href='Pedidoswo.php?area=' style='margin:1px;' type='button' class='btn btn-danger'>Pendientes Taller</a>
	<a href='Pedidoswo.php?area=11' style='margin:1px;' type='button' class='btn btn-white btn-danger'>Recibidos Valledupar</a>
	<a href='Pedidoswo.php?area=12' style='margin:1px;' type='button' class='btn btn-white btn-danger'>Recibidos Barranquilla 2021</a>
	<a href='Pedidoswo.php?area=13' style='margin:1px;' type='button' class='btn btn-white btn-danger'>En tránsito</a>
	


		<?php
	}
	elseif ($areapedido==11) {
		?>

		<a href='Pedidoswo.php?area=' style='margin:1px;' type='button' class='btn btn-white btn-danger'>Pendientes Taller</a>
	<a href='Pedidoswo.php?area=11' style='margin:1px;' type='button' class='btn  btn-danger'>Recibidos Valledupar</a>
	<a href='Pedidoswo.php?area=12' style='margin:1px;' type='button' class='btn btn-white btn-danger'>Recibidos Barranquilla 2021</a>
	<a href='Pedidoswo.php?area=13' style='margin:1px;' type='button' class='btn btn-white btn-danger'>En tránsito</a>
		

		<?php
	}
	elseif ($areapedido==12) {
		?>

		<a href='Pedidoswo.php?area=' style='margin:1px;' type='button' class='btn btn-white btn-danger'>Pendientes Taller</a>
	<a href='Pedidoswo.php?area=11' style='margin:1px;' type='button' class='btn btn-white  btn-danger'>Recibidos Valledupar</a>
	<a href='Pedidoswo.php?area=12' style='margin:1px;' type='button' class='btn  btn-danger'>Recibidos Barranquilla 2021</a>
	<a href='Pedidoswo.php?area=13' style='margin:1px;' type='button' class='btn btn-white btn-danger'>En tránsito</a>
		
		<?php
	}
	elseif ($areapedido==13) {
		?>

		<a href='Pedidoswo.php?area=' style='margin:1px;' type='button' class='btn btn-white btn-danger'>Pendientes Taller</a>
	<a href='Pedidoswo.php?area=11' style='margin:1px;' type='button' class='btn btn-white  btn-danger'>Recibidos Valledupar</a>
	<a href='Pedidoswo.php?area=12' style='margin:1px;' type='button' class='btn btn-white btn-danger'>Recibidos Barranquilla 2021</a>
	<a href='Pedidoswo.php?area=13' style='margin:1px;' type='button' class='btn  btn-danger'>En tránsito</a>
		

		<?php
	}

	elseif ($areapedido==2) {
		?>

		<a href='Pedidoswo.php?area=' style='margin:1px;' type='button' class='btn btn-white btn-danger'>Pendientes Taller</a>
	<a href='Pedidoswo.php?area=11' style='margin:1px;' type='button' class='btn btn-white  btn-danger'>Recibidos Valledupar</a>
	<a href='Pedidoswo.php?area=12' style='margin:1px;' type='button' class='btn btn-white btn-danger'>Recibidos Barranquilla 2021</a>
	<a href='Pedidoswo.php?area=13' style='margin:1px;' type='button' class='btn btn-white btn-danger'>En tránsito</a>
		

		<?php
	}
	elseif ($areapedido==4) {
		?>

		<a href='Pedidoswo.php?area=' style='margin:1px;' type='button' class='btn btn-white btn-danger'>Pendientes Taller</a>
	<a href='Pedidoswo.php?area=11' style='margin:1px;' type='button' class='btn btn-white  btn-danger'>Recibidos Valledupar</a>
	<a href='Pedidoswo.php?area=12' style='margin:1px;' type='button' class='btn btn-white btn-danger'>Recibidos Barranquilla 2021</a>
	<a href='Pedidoswo.php?area=13' style='margin:1px;' type='button' class='btn btn-white btn-danger'>En tránsito</a>
		

		<?php
	}
	elseif ($areapedido==3) {
		?>
		<a href='Pedidoswo.php?area=' style='margin:1px;' type='button' class='btn btn-white btn-danger'>Pendientes Taller</a>
	<a href='Pedidoswo.php?area=11' style='margin:1px;' type='button' class='btn btn-white  btn-danger'>Recibidos Valledupar</a>
	<a href='Pedidoswo.php?area=12' style='margin:1px;' type='button' class='btn btn-white btn-danger'>Recibidos Barranquilla 2021</a>
	<a href='Pedidoswo.php?area=13' style='margin:1px;' type='button' class='btn btn-white btn-danger'>En tránsito</a>
		

		<?php
	}
	 ?>

	
<hr>
	<div id="tabs-1" class="tab-pane fade in active"><!-- Inicio Tab Número Uno -->
													<div class="clearfix">
											<div class="pull-left tableTools-container"></div>
										</div>
										<div class="table-header" style="background-color: #000;">
											Lista de Pedidos Clientes <?php Echo($MiTienda); ?>
										</div>
										
										<!-- div.table-responsive -->

										<!-- div.dataTables_borderWrap -->
										<div>
<?php 
$ano=date('Y');

// ************** Arreglo Pedidos ***************//
if ($MyIdTienda=="" && $areapedido=="") {
	$sql ="SELECT distinct(Id_Pedido) FROM t_pedido  WHERE Estado_Pedido='1' or Estado_Pedido='3' or Estado_Pedido='4' or Estado_Pedido='5' or Estado_Pedido='6' or Estado_Pedido='7' or Estado_Pedido='12' or Estado_Pedido='13' or Estado_Pedido='15' or Estado_Pedido='16' or Estado_Pedido='18' or Estado_Pedido='19' and  YEAR(Fecha_Pedido)='".$ano."' order by Fecha_Pedido  DESC";
	$result = $conexion->query($sql);
	if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) { 
	$Lista=$Lista.$row['Id_Pedido'].",";                  
 }
}
}
// Pedidos pendientes en el área Tienda
elseif ($MyIdTienda=="" && $areapedido=="11") {
	$sql ="SELECT distinct(Id_Pedido) FROM t_pedido  WHERE Estado_Pedido='9' and Tienda_Id_Tienda='1' and  YEAR(Fecha_Pedido)='".$ano."' order by Id_Pedido    DESC";
	$result = $conexion->query($sql);
	if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) { 
	$Lista=$Lista.$row['Id_Pedido'].",";                  
 }
}
}
// Pedidos pendientes en el área Tienda
elseif ($MyIdTienda=="" && $areapedido=="12") {
	$sql ="SELECT distinct(Id_Pedido) FROM t_pedido  WHERE Estado_Pedido='9' and Tienda_Id_Tienda='11'  and  YEAR(Fecha_Pedido)='".$ano."' order by Id_Pedido  DESC";
	$result = $conexion->query($sql);
	if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) { 
	$Lista=$Lista.$row['Id_Pedido'].",";                  
 }
}
}
// Pedidos pendientes en el área Tienda

elseif ($MyIdTienda=="" && $areapedido=="13") {
	$ano2020=$ano-1;
	$sql ="SELECT distinct(Id_Pedido) FROM t_pedido  WHERE Estado_Pedido='8'  and  YEAR(Fecha_Pedido)='".$ano2020."' order by Id_Pedido  DESC";
	//echo($sql);
	$result = $conexion->query($sql);
	if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) { 
	$Lista=$Lista.$row['Id_Pedido'].",";                  
 }
}
}
// Pedidos Concluidos
elseif ($MyIdTienda=="" && $areapedido=="2") {

	$sql ="SELECT distinct(Id_Pedido) FROM t_pedido  WHERE Estado_Pedido='10' or Estado_Pedido='14' or Estado_Pedido='17' order by Id_Pedido  DESC LIMIT 2000";
	$result = $conexion->query($sql);
	if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) { 
	$Lista=$Lista.$row['Id_Pedido'].",";                  
 }
}
}
// Pedidos Concluidos NOTA ENTREGA
elseif ($MyIdTienda=="" && $areapedido=="4") {
	$sql ="SELECT distinct(Id_Pedido) FROM t_pedido  WHERE Estado_Pedido='10' and consecutivosc_id_consecutivosc<>'0' order by Id_Pedido  DESC";
	$result = $conexion->query($sql);
	if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) { 
	$Lista=$Lista.$row['Id_Pedido'].",";                  
 }
}
}
// Pedidos pendientes en el área Tienda
elseif ($MyIdTienda=="" && $areapedido=="3") {
	$sql ="SELECT distinct(Id_Pedido) FROM t_pedido  WHERE Estado_Pedido<>'1' and Estado_Pedido<>'3' and Estado_Pedido<>'4' and Estado_Pedido<>'5' and Estado_Pedido<>'6' and Estado_Pedido<>'7' and Estado_Pedido<>'10' and Estado_Pedido<>'11' and Estado_Pedido<>'12' and Estado_Pedido<>'13' and Estado_Pedido<>'14' and Estado_Pedido<>'15' and Estado_Pedido<>'16' and Estado_Pedido<>'17' and Tienda_Id_Tienda<>'1' and Tienda_Id_Tienda<>'2' and Tienda_Id_Tienda<>'4' and Tienda_Id_Tienda<>'5' and Tienda_Id_Tienda<>'6' and Tienda_Id_Tienda<>'8' and Tienda_Id_Tienda<>'9' and  YEAR(Fecha_Pedido)='".$ano."' order by Id_Pedido   DESC";
	$result = $conexion->query($sql);
	if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) { 
	$Lista=$Lista.$row['Id_Pedido'].",";                  
 }
}
}
else
{
	$sql ="SELECT distinct(Id_Pedido) FROM t_pedido  WHERE Estado_Pedido='1' or Estado_Pedido='3' or Estado_Pedido='4' or Estado_Pedido='5' or Estado_Pedido='6' or Estado_Pedido='7' or Estado_Pedido='12' or Estado_Pedido='13' or Estado_Pedido='15' or Estado_Pedido='16' or Estado_Pedido='18' or Estado_Pedido='19' and  YEAR(Fecha_Pedido)='".$ano."' order by Fecha_Pedido  DESC";
	$result = $conexion->query($sql);
	if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) { 
	$Lista=$Lista.$row['Id_Pedido'].",";                  
 }
}

}


$Cadena=explode(",", $Lista);
//Split al Arreglo
$longitud = count($Cadena);
$min=$longitud-1;
// ************** Arreglo Total Insumos ***************//
 ?>
									<table style="font-size: 12px;" id="dynamic-table"  class="table table-responsive table-striped table-bordered table-hover" width="100%">
									 <tfoot style="display: table-header-group;">
                                    <th class="success"></th>
                                    <th class="success"></th>
                                    <th class="success"></th>
                                    <th class="success"></th>
                                    <th class="success"></th>
                                    <th class="success"></th>
                                    <th class="success"></th>
                                    <th class="success"></th>
                                    <th class="success"></th>
                                    <th class="success"></th>
                                    <th class="success"></th>
                                    <th class="success"></th>
                                    <th class="success"></th>
                            </tfoot>
												<thead>

													<tr class="warning">
															<th class="tdcustom" style="width: 5%;">Vendedor</th>
														<th class="tdcustom" style="width: 5%;">Pedido Nº</th>
														<th class="tdcustom" style="width: 5%;">Estado</th>
														<th class="tdcustom" style="width: 10%;">Cliente</th>
														<th class="tdcustom" style="width: 20%;">Detalle</th>
														<th class="tdcustom" style="width: 10%;">Fecha Pedido</th>
														<th class="tdcustom" style="width: 10%;">Referencias</th>
														<th class="tdcustom" style="width: 7%;">Fecha Entrega</th>
														<th class="tdcustom" style="width: 7%;">Forma de Pago</th>
														<th class="tdcustom" style="width: 10%;">Valor Pedido</th>
														<th class="tdcustom" style="width: 10%;">Abonos</th>
														<th class="tdcustom" style="width: 10%;">Saldo</th>
														<th class="tdcustom" style="width: 20%;">Acción</th>	
													</tr>
													<tr>
														<th class="tdcustom" style="width: 5%;">Vendedor</th>
														<th class="tdcustom" style="width: 5%;">Pedido Nº</th>
														<th class="tdcustom" style="width: 5%;">Estado</th>
														<th class="tdcustom" style="width: 10%;">Cliente</th>
														<th class="tdcustom" style="width: 20%;">Detalle</th>
														<th class="tdcustom" style="width: 10%;">Fecha Pedido</th>
														<th class="tdcustom" style="width: 10%;">Referencias</th>
														<th class="tdcustom" style="width: 7%;">Fecha Entrega</th>
														<th class="tdcustom" style="width: 7%;">Forma de Pago</th>
														<th class="tdcustom" style="width: 10%;">Valor Pedido</th>
														<th class="tdcustom" style="width: 10%;">Abonos</th>
														<th class="tdcustom" style="width: 10%;">Saldo</th>
														<th class="tdcustom" style="width: 20%;">Acción</th>	
													</tr>
												</thead>

												<tbody>
<?php 
for($i=0; $i<$min; $i++)
{
$sql ="SELECT date_format(Fecha_Pedido,CONCAT(CONCAT(ELT(WEEKDAY(Fecha_Pedido) + 1, 'Lunes', 'Martes', 'Miercoles', 'Jueves', 'Viernes', 'Sábado', 'Domingo')),', %d - ',CONCAT(ELT(MONTH(Fecha_Pedido), 'Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Agos', 'Sep', 'Oct', 'Nov', 'Dic')),'- %Y')) AS FechaPedido,date_format(Fecha_Entrega,CONCAT(CONCAT(ELT(WEEKDAY(Fecha_Entrega) + 1, 'Lunes', 'Martes', 'Miercoles', 'Jueves', 'Viernes', 'Sábado', 'Domingo')),', %d - ',CONCAT(ELT(MONTH(Fecha_Entrega), 'Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Agos', 'Sep', 'Oct', 'Nov', 'Dic')),'- %Y')) AS FechaEntrega, Id_Pedido, Cod_Pedido, Cliente_Id_Cliente, Fecha_Pedido, Total_Pedido, Descuento, Estado_Pedido, Saldo_Abonado, Pedido_Id_Usuario, Fecha_Entrega,taller_id_taller FROM t_pedido  WHERE Id_Pedido='".$Cadena[$i]."'"; 
//Echo($sql);
$result = $conexion->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {                
        $FechaPedido=$row['FechaPedido'];
        $FechaEntrega=$row['FechaEntrega'];
        $Id_Pedido=$row['Id_Pedido'];
        $Cod_Pedido=$row['Cod_Pedido'];
        $Cliente_Id_Cliente=$row['Cliente_Id_Cliente'];
        $Fecha_Pedido=$row['Fecha_Pedido'];
        $Total_Pedido=$row['Total_Pedido'];
        $Descuento=$row['Descuento'];
        $Estado_Pedido=$row['Estado_Pedido'];
        $Saldo_Abonado=$row['Saldo_Abonado'];
        $Fecha_Entrega=$row['Fecha_Entrega'];
        $taller_id_taller=$row['taller_id_taller'];
        $Pedido_Id_Usuario=$row['Pedido_Id_Usuario'];
        $dateSol = new DateTime($Fecha_Pedido);
        $HoraSol=$dateSol->format('H:i:s a');
        $FechaSol=$dateSol->format('Y-m-d');

	}
}

$sql ="SELECT Nom_Tienda FROM t_pedido as A,t_tiendas as B WHERE Cod_Pedido='".$Cod_Pedido."' and A.Tienda_Id_Tienda=B.Id_Tienda"; 
//Echo($sql);
$result = $conexion->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {                
        $Nom_TiendaPedido=$row['Nom_Tienda'];
	}
}

$sql ="SELECT Nombres,Apellidos,Img_perfil FROM t_pedido as A,t_usuarios as B WHERE Cod_Pedido='".$Cod_Pedido."' and A.Pedido_Id_Usuario=B.Id_Usuario"; 
//Echo($sql);
$result = $conexion->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {                
        $Nombres=$row['Nombres'];
        $Apellidos=$row['Apellidos'];
        $AvatarVendedor=$row['Img_perfil'];
	}
}

$sql ="SELECT Avatar_Cliente,Nom_Cliente,Ape_Cliente,Documento_cliente FROM t_pedido as A, t_clientes as B WHERE Cod_Pedido='".$Cod_Pedido."' and A.Cliente_Id_Cliente=B.Id_Cliente"; 
//Echo($sql);
$result = $conexion->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {                
        $AvatarCliente=$row['Avatar_Cliente'];
        $Nom_Cliente=$row['Nom_Cliente'];
        $Ape_Cliente=$row['Ape_Cliente'];
        $Documento_cliente=$row['Documento_cliente'];
	}
}


$sql ="SELECT IFNULL(sum(Valor_Ingreso),0) AS TotalAbonos FROM t_ingresos WHERE Pedido_Id_Pedido='".$Cod_Pedido."'"; 
//Echo($sql);
$result = $conexion->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {                
        $TotalAbonos=$row['TotalAbonos'];
	}
}

if ($TotalAbonos!=0) {
	$CalculoAbono=1-($TotalAbonos/$Total_Pedido);
}
else
{
	$CalculoAbono=0;
}



        $PorcentajeAbonado=$CalculoAbono*100;
        $Saldo_Pendiente=$Total_Pedido-$TotalAbonos;

													 ?>
													 <?php 

														
					
						$DiasTotales=dias_transcurridos($FechaSol,$Fecha_Entrega);
										

															$DiasTranscurridos=dias_transcurridos($FechaSol,$FechaActual);
															$DiasPasados=dias_transcurridos($FechaActual,$Fecha_Entrega);

															if ($DiasTotales!=0) {
											$CalculoDias=$DiasPasados/$DiasTotales;
										}
										else{
											$CalculoDias=0;
										}
															$PorcentajeDias=round($CalculoDias*100,1);
															//Echo ("Dias pedido".$DiasTotales."<br> han pasado:".$DiasPasados); 

															?>

														<tr>
			<?php 
	if ($areapedido==2) {
		echo ("<td>".$Nombres." ".$Apellidos."</td>");
	}
	else
	{

	 ?>
														<td class="center">


						<img data-rel="tooltip" data-placement="top" title="<?php Echo($Nombres." ".$Apellidos."\r\n".$FechaPedido." ".$HoraSol) ?>" class="img-circle" src="<?php echo utf8_encode($AvatarVendedor); ?>" width="45px" height="45px">
														</td>
													<?php 
												}
													 ?>
														<td>
			<a data-rel="tooltip" data-placement="top" title="Detalles Pedido" href="Pedido-Ver.php?PedidoCliente=<?php Echo($Cod_Pedido); ?>">
															<?php echo utf8_encode($Cod_Pedido); ?>	<br>
															TIENDA <?php Echo utf8_encode($Nom_TiendaPedido); ?>
															
															
															</a>
														</td>
														<td>
													<?php 
    $sql ="SELECT `Id_Estado_Pedido`,Nom_Estado_Pedido, `Color_Estado`, `Desc_Estado`, `Rol_Id_Rol` FROM `t_estado_pedidos` WHERE Id_Estado_Pedido='".$Estado_Pedido."'"; 
    //Echo($sql); 
$result = $conexion->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) { 
    $Id_Estado_Pedido=$row['Id_Estado_Pedido'];
    $Nom_Estado_Pedido=$row['Nom_Estado_Pedido'];
    $Color_Estado=$row['Color_Estado'];
      Echo("<span class='label' style='background-color:".$Color_Estado."'>".utf8_encode($Nom_Estado_Pedido)."</span> <span class='action-icons'></span>");
      }
    }
            ?>
            <?php echo(NomTaller($taller_id_taller)); ?>

														</td>
														
														
														
														<td class="tdcustom" style="text-transform:uppercase;"><?php echo utf8_encode($Nom_Cliente." ".$Ape_Cliente); ?><br><strong>C.C : <?php echo(number_format($Documento_cliente)); ?></strong></td>
	<?php 
	if ($areapedido==2) {
		echo ("<td></td>");
	}
	else
	{

	 ?>
														<td>
															<?php 

    $sql ="SELECT F.Img_Referencia, Estado_Solicitud_Cliente, G.Nom_Estado_Pedido,A.Referencia_Id_Referencia,D.Nom_Talla FROM t_temporal_sol AS A, t_tallas as D,t_referencias as F,t_estado_pedidos as G WHERE  A.Talla_Solicitada=D.Id_Talla and A.Referencia_Id_Referencia=F.Cod_Referencia and Pedido_Id_Pedido='".$Cod_Pedido."' and A.Estado_Solicitud_Cliente=G.Id_Estado_Pedido ORDER BY UNIX_TIMESTAMP(Fecha_Solicitud) DESC"; 
    //Echo($sql); 
$result = $conexion->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) { 
   
    $Img_Referencia=$row['Img_Referencia']; 
$Referencia_Id_Referencia=$row['Referencia_Id_Referencia']; 
$Nom_Talla=$row['Nom_Talla']; 
$ReferenciaCompleta=$Referencia_Id_Referencia."-".$Nom_Talla;
     $Estado_Solicitud_Cliente=$row['Estado_Solicitud_Cliente'];
     $Nom_Estado_Pedido=$row['Nom_Estado_Pedido'];

   
     ?>
     

   <a style="position: relative;" data-rel="tooltip" data-placement="top" title="<?php Echo utf8_encode($Nom_Estado_Pedido." ".$ReferenciaCompleta);?>" class="image-link" href="<?php echo utf8_encode($Img_Referencia); ?>"><img src="<?php echo utf8_encode($Img_Referencia); ?>" width="45px" height="45px" >
    	
    	<?php 
    	if ($Estado_Solicitud_Cliente<=5) {
    		?>
    		<div style="position: absolute; left: 10px; top: 2px;"><i class="fa  fa-times red fa-2x"></i></div>
    		<?php
    	}
    	else
    	{
    		?>
    		<div style="position: absolute; left: 10px; top: 2px;"><i class="fa  fa-check green fa-2x"></i></div>
    		<?php
    	}

    	 ?>

    	
    </a>

     <?php 
 }
}
      ?>
														</td>
														<?php } ?>
														<td class="center">
															<?php Echo($FechaPedido);?>		
														</td>
														<td>
<?php 
    $sql ="SELECT F.Img_Referencia, Estado_Solicitud_Cliente, G.Nom_Estado_Pedido,A.Referencia_Id_Referencia,D.Nom_Talla FROM t_temporal_sol AS A, t_tallas as D,t_referencias as F,t_estado_pedidos as G WHERE  A.Talla_Solicitada=D.Id_Talla and A.Referencia_Id_Referencia=F.Cod_Referencia and Pedido_Id_Pedido='".$Cod_Pedido."' and A.Estado_Solicitud_Cliente=G.Id_Estado_Pedido ORDER BY UNIX_TIMESTAMP(Fecha_Solicitud) DESC"; 
    //Echo($sql); 
$result = $conexion->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) { 
   
    $Img_Referencia=$row['Img_Referencia']; 
$Referencia_Id_Referencia=$row['Referencia_Id_Referencia']; 
$Nom_Talla=$row['Nom_Talla']; 
$ReferenciaCompleta=$Referencia_Id_Referencia."-".$Nom_Talla;
     $Estado_Solicitud_Cliente=$row['Estado_Solicitud_Cliente'];
     $Nom_Estado_Pedido=$row['Nom_Estado_Pedido'];

   
     ?>
     
   <?php echo($ReferenciaCompleta); ?>
    	
    </a>

     <?php 
 }
}
      ?>
														</td>
														
														<td>
															<?php Echo($FechaEntrega); ?> 
														</td>
														<td>
<?php 


    $sql ="SELECT * FROM t_ingresos WHERE Pedido_Id_Pedido='".$Cod_Pedido."'"; 
    //Echo($sql); 
$result = $conexion->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) { 
   
    $Valor_Ingreso=$row['Valor_Ingreso']; 
    $Medio_Pago=$row['Medio_Pago']; 
    $Cod_Recibo_Caja=$row['Cod_Recibo_Caja'];
    $Tienda_Id_Tienda=$row['Tienda_Id_Tienda'];
   	$mediodepago=Nombremediopago($Medio_Pago);
     ?>
     <a data-rel="tooltip" data-placement="top" title="Recibo Caja Nº <?php echo($Cod_Recibo_Caja); ?>" href="Pdf_ReciboCajaInmediatoCopiawo.php?AbonoCliente=<?php Echo($Cod_Recibo_Caja); ?>&latienda=<?php echo($Tienda_Id_Tienda); ?>">
     	<strong><?php echo($mediodepago) ?>:</strong><?php echo ("$".number_format($Valor_Ingreso));?>
	</a>
 	

     <?php 
 }
}
      ?>
															
														</td>
														
															<td class="center">
															<?php Echo utf8_encode("$ ".number_format($Total_Pedido));  ?>
														</td>
														<td class="center">
			
															<?php Echo utf8_encode("$ ".number_format($TotalAbonos));  ?>
														</td>
													
														<!-- <td class="center">
															<span class="badge bg-red">
																<?php echo (round($PorcentajeAbonado,0)); ?>%
															</span>
														</td> -->
														<td class="center">
															<?php Echo utf8_encode("$ ".number_format($Saldo_Pendiente));  ?>
														</td>
														<td class="center">
	<div class="btn-group">
												<button data-toggle="dropdown" class="btn btn-info btn-sm dropdown-toggle">
													Acción
													<span class="ace-icon fa fa-caret-down icon-on-right"></span>
												</button>

												<ul class="dropdown-menu dropdown-info dropdown-menu-right">
													<li>
														<a style="position: relative;" data-rel="tooltip" data-placement="top" title="Ver Pedido"  href="Pedido-Ver.php?PedidoCliente=<?php Echo($Cod_Pedido); ?>"><i class="fa fa-search blue "></i> Ver Pedido</a>
													</li>
											<?php 
													if ($Estado_Solicitud_Cliente==9) {
														?>
													<li>
														<a style="position: relative;" data-rel="tooltip" data-placement="top" title="Entregar Pedido"  href="OrdenCliente-Salida.php?Salida=<?php echo utf8_encode($Cod_Pedido); ?>"><i class="fa fa-file-pdf-o "></i> Salida Contable</a>
													</li>
											<?php
													}
													 ?>

													<li>
														<a style="position: relative;" data-rel="tooltip" data-placement="top" title="Ver/Agregar Abonos"  href="Clientes-AbonosOrdenes.php?NumPedido=<?php echo utf8_encode($Cod_Pedido); ?>"><i class="fa fa-dollar green"></i> Agregar Abono</a>
													</li>
												<?php 
													if ($Estado_Solicitud_Cliente==9) {
														?>
													<li>
														<a style="position: relative;" data-rel="tooltip" data-placement="top" title="Pedido no Entregado"  href="Pedidoswo.php?NumPedidoBaja=<?php echo utf8_encode($Cod_Pedido); ?>"><i class="fa fa-download green"></i> Pedido No Entregado</a>
													</li>
												<?php
													}
													 ?>
											
													<?php 
													if ($Estado_Solicitud_Cliente==1 && $IdRol=='1') {
														?>
														<li class="divider"></li>

													<li>
														<a style="position: relative;" data-rel="tooltip" data-placement="top" title="Eliminar Pedido"  href="Pedidoswo.php?NumPedidoDel=<?php echo utf8_encode($Cod_Pedido); ?>&ValorAbonos=<?php Echo($TotalAbonos) ;?>"><i class="fa fa-close red "></i> Eliminar Pedido</a>
													</li>
														<?php
													}
													 ?>
													
												</ul>
											</div><!-- /.btn-group -->
		

		
	

	
														</td>
														
														

														
													
													</tr>
													<?php 
													
}
													 ?>
												</tbody>
											</table>
										</div>

													
												</div><!-- Fin Tab Número Uno -->