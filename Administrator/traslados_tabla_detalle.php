
    <table style="font-size: 12px;" id="dynamic-table"  class="table table-responsive table-striped table-bordered table-hover" width="100%">
    	<thead>
    		<tr class="warning">
    			<th class="tdcustom" style="width: 3%;">Foto</th>
    			<th class="tdcustom" style="width: 8%;">Código Referencia</th>
    			<th class="tdcustom" style="width: 15%;">Detalle Referencia</th>
    			<th class="tdcustom" style="width: 2%;">Talla</th>
    			<th class="tdcustom" style="width: 2%;">Cantidad</th>
    			<th class="tdcustom" style="width: 1%;">Acciones</th>
    		</tr>
    
    	</thead>
        <tbody>
<?php 
include("Lib/conexion.php");
include("Lib/sesion.php");
include("Lib/display_error.php");
include("Lib/formulas.php");
$IdUser=$_SESSION['IdUser'];
    $sql="SELECT * FROM t_traslados_detalle WHERE id_user='".$IdUser."' and status='PROCESANDO'";
    $result = $conexion->query($sql);
    if ($result->num_rows>0){
        while ($fil = $result->fetch_assoc()) {
            $id_detalle = $fil['id'];
            $foto = $fil['imagen'];
            $cod_ref_completa = $fil['cod_ref_completa'];
            $romper = explode("-",$cod_ref_completa);
            $Nom_Talla = $romper[1];
            $detalle = $fil['cod_ref_completa'];
            $cantidad = $fil['cantidad'];
            $talla = $fil['talla_id'];
            
			$ruta_img = utf8_encode($foto);
			$mostrar_img = "miniatura.php?x=50&y=50&file=".$ruta_img;
                        
            ?>
            <tr>
                <td><a class="image-link" href=""><img src="<?php echo utf8_encode($mostrar_img); ?>" width="45px" height="45px"></a></td>
                <td><?php echo $cod_ref_completa;?> </td>
                <td><?php echo $detalle;?> </td>
                <td><?php echo $Nom_Talla;?> </td>
                <td><?php echo $cantidad;?> </td>
                <td><a onclick="miFuncionEliminar(<?php echo $id_detalle;?>)"><i onclick="miFuncionEliminar(<?php echo $id_detalle;?>)" class="ace-icon fa fa-trash-o bigger-110"> </i> Eliminar</a></td>                
            </tr>
            <?php
        }
        
    }
?>        
        </tbody>
     </table>