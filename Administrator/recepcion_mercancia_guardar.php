<?php 

include("Lib/sesion.php");
error_reporting(E_ALL ^ E_NOTICE);
ini_set("display_errors", 1); 
include("Lib/display_error.php");
include("Lib/conexion.php");
include("Lib/formulas.php");
$IdUser=$_SESSION['IdUser'];

class Db {
	private static $instance = NULL;

	function __construct() {}

	public static function getConnect() {
		if (!isset(self::$instance)) {
			$pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
			self::$instance = new PDO('mysql:host=localhost;dbname=u316788375_espej', 'u316788375_espej', 'Tek@900710285', $pdo_options);
		}
		return self::$instance;
	}
}



//RECOGER INFORMACIÒN DE RECEPCION_MERCANCIA.PHP

if(isset($_POST['submit'])){
    $status = "RECIBIDO"; //STATUS DEL DESPACHO Y DE LAS REFERENCIAS EN LAS DIFERENTES TABLAS t_temporal_inventario,t_temporal_inventario_despacho

    $id_despacho = $_POST['ID'];
    $observaciones = $_POST['comentarios'];
    $TiempoActual = date('Y-m-d H:i:s');
    $idtienda = $_POST['ID_TIENDA'];
    $total_despacho = $_POST['TOTAL'];
    $error_guardar = 0;    
    

       //CONSULTAR EL ESTADO DEL PEDIDO EN T_Temporal_inventario.
    $sql ="SELECT status_recibido FROM t_temporal_inventario WHERE id_despacho='".$id_despacho."'";
                $result = $conexion->query($sql);
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) { 
                $validacionestado=$row['status_recibido'];                  
                 }
    
                }

if ($validacionestado=='RECIBIDO') {

    header("location:listado_recepcion.php?Mensaje=5&TxtTienda=".$idtienda."");
    
}else{


    /*3) TRASPASAR LAS REFERENCIAS A LA TABLA t_inventario_ref*/
    //SELECCIONAR TODOS LAS REFERENCIAS DEL DESPACHO PARA TRASPASAR AL INVENTARIO

    $sql="SELECT * FROM t_temporal_inventario WHERE id_despacho='".$id_despacho."'";
    $result= $conexion->query($sql) or die('Error en :'.$sql.mysqli_error($conexion));
	$cantidad = $result->num_rows;
	echo "CANTIDAD DE REGISTROS A PROCESAR = $cantidad";
	$db=Db::getConnect();
	$select2=$db->query("SELECT * FROM t_temporal_inventario WHERE id_despacho='".$id_despacho."'");
	$datosreferencia=$select2->fetchAll();
	foreach ($datosreferencia as $datos){
		$descripcion = $datos['cod_ref'];
		echo "<br>".$descripcion."<br>";
	}		
	
	$cantreci = $_POST['recibido'];
	foreach ($cantreci as $recibido){
		echo $recibido."<br>";
		if (empty($recibido)){
		$recibido = 0;
		}
		$varRecibido[]=$recibido;
	}
	//echo $var[0]." ".$var[1]." ".$var[2];
	//exit;
	$i = 0;
	if($result->num_rows>0){
		foreach ($datosreferencia as $fil){
    	//while ($fil = $result->fetch_assoc()) {
    	   $id_ref=$fil['id_ref'];
           $cod_ref_completo=$fil['cod_ref'];
           $cod_ref = explode("-", $cod_ref_completo);
           $cod_referencia=$cod_ref[0];
           $cantidad=$fil['cantidad'];
           $talla_id=$fil['talla_id'];
           $idtienda=$fil['id_tienda'];
           $cliente = strtoupper($fil['cliente']);
           $id_solicitud_prod= $fil['id_solicitud_prod'];
           $cliente=strtoupper($cliente);
			$cantidad = $varRecibido[$i];
           $Tipo_Mov_Inv="DESPACHO";
           //INSERTAR DATOS A LA TABLA t_inventario_ref
           $sql3="INSERT INTO t_inventario_ref(Tienda_Id_Tienda,Inv_Ref,Talla_Id_Talla,Ref_Completa,Cantidad_Inv,
           Fecha_Ingreso,Tipo_Mov_Inv,Responsable_Id_Usuario,Fecha_Registro_Modasof,cliente) 
           VALUES 
           ('".$idtienda."','".$cod_referencia."','".$talla_id."','".$cod_ref_completo."','".$cantidad."',
           '".$TiempoActual."','".$Tipo_Mov_Inv."','".$IdUser."','".$TiempoActual."','".$cliente."')";
           //echo "<br>".$sql3;
           //exit;			
           $EJECUTAR=$conexion->query($sql3) or die('Error en :'.$sql3.mysqli_error($conexion));

          
           if ($cliente=='NO'){


                //AGREGAR O ACTUALIZAR DATOS DE LA TABLA DEL INVENTARIO REAL           
                $sql1 ="SELECT Id_Tienda,Referencia_Completa FROM t_inventario WHERE Id_Tienda='".$idtienda."' and Referencia_Completa='".$cod_ref_completo."'" ;
                //echo "<br>ENTRO A NO CLIENTE: ".$sql1;
                $resultados = $conexion->query($sql1) or die (mysqli_error($conexion));

                //ACTUALIZAR LA SOLICITUD ESTADO A 7 (RECIBIDO)
                //$ssql="UPDATE t_solicitudes_prod SET Estado_Solicitud_Prod='7', Existencias_Ref=Existencias_Ref-'".$cantidad."' WHERE Id_Solicitud_Prod='".$id_solicitud_prod."'";
                //$ssresult = $conexion->query($ssql) or die('Error:'.mysqli_error($conexion));

                
                if ($resultados->num_rows>0){ //SI LA REFERENCIA YA ESTA CARGADA EN EL INVENTARIO.
                    $SqlActualizar ="UPDATE t_inventario SET Cantidad=Cantidad+'".$cantidad."' WHERE Id_Tienda='".$idtienda."' and Referencia_Completa='".$cod_ref_completo."'"; //ACTUALIZAMOS EL INVENTARIO
                    $ResultActualizar = $conexion->query($SqlActualizar)or die (mysqli_error($conexion));
					//echo "<br>ENTRO A NO CLIENTE Y REFERENCIA CARGADA EN INVENTARIO: ".$SqlActualizar;   
                }else{ //SI LA REFERENCIA NO ESTA CARGADA EN EL INVENTARIO
                    $SqlAgregar ="INSERT INTO t_inventario(Id,Id_Tienda,Referencia,Referencia_Completa,Cantidad,Id_Talla) VALUES ('','".$idtienda."','".$cod_referencia."','".$cod_ref_completo."','".$cantidad."','".$talla_id."')"; //AGREGAMOS LA NUEVA REFERENCIA AL INVENTARIO
                    $ResultInsertar = $conexion->query($SqlAgregar);
					//echo "<br>ENTRO A NO CLIENTE Y REFERENCIA NO ESTA CARGADA EN INVENTARIO: ".$SqlAgregar;
                }

                                //CONSULTAR EL PEDIDO DEL CLIENTE.
                $sql ="SELECT Pedido_Id_Pedido FROM t_temporal_sol WHERE Id_Temporal_Sol='".$id_solicitud_prod."'";
                $result = $conexion->query($sql);
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) { 
                $Pedido_Id_Pedido=$row['Pedido_Id_Pedido'];                  
                 }
                }

 //ACTUALIZAR LA SOLICITUDES A ESTADO 9 (RECIBIDO)
                $ssql="UPDATE t_temporal_sol SET Estado_Solicitud_Cliente='9' WHERE Pedido_Id_Pedido='".$Pedido_Id_Pedido."'";
                $ssresult = $conexion->query($ssql) or die('Error:'.mysqli_error($conexion));

  //ACTUALIZAR LA SOLICITUD ESTADO A 9 (RECIBIDO)
                $ssql="UPDATE t_pedido SET Estado_Pedido='9' WHERE Cod_Pedido='".$Pedido_Id_Pedido."'";
                $ssresult = $conexion->query($ssql) or die('Error:'.mysqli_error($conexion));

           } else {


              
                //CONSULTAR EL PEDIDO DEL CLIENTE.
                $sql ="SELECT Pedido_Id_Pedido FROM t_temporal_sol WHERE Id_Temporal_Sol='".$id_solicitud_prod."'";
                $result = $conexion->query($sql);
			   //echo "<br>ENTRO A CLIENTE Y CONSULTA EL PEDIDO: ".$sql;
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) { 
                $Pedido_Id_Pedido=$row['Pedido_Id_Pedido'];                  
                 }
                }

 //ACTUALIZAR LA SOLICITUDES A ESTADO 9 (RECIBIDO)
                $ssql="UPDATE t_temporal_sol SET Estado_Solicitud_Cliente='9' WHERE Pedido_Id_Pedido='".$Pedido_Id_Pedido."'";
                $ssresult = $conexion->query($ssql) or die('Error:'.mysqli_error($conexion));

  //ACTUALIZAR LA SOLICITUD ESTADO A 9 (RECIBIDO)
                $ssql="UPDATE t_pedido SET Estado_Pedido='9' WHERE Cod_Pedido='".$Pedido_Id_Pedido."'";
                $ssresult = $conexion->query($ssql) or die('Error:'.mysqli_error($conexion));



                  //AGREGAR O ACTUALIZAR DATOS DE LA TABLA DEL INVENTARIO REAL           
                $sql1 ="SELECT Id_Tienda,Referencia_Completa FROM t_inventario WHERE Id_Tienda='".$idtienda."' and Referencia_Completa='".$cod_ref_completo."'" ;
			    //echo "<br>ENTRO A CLIENTE Y BUSCAR EN t_inventario LA REF: ".$sql1;
                $resultados = $conexion->query($sql1) or die (mysqli_error($conexion));

                //ACTUALIZAR LA SOLICITUD ESTADO A 7 (RECIBIDO)
                //$ssql="UPDATE t_solicitudes_prod SET Estado_Solicitud_Prod='7', Existencias_Ref=Existencias_Ref-'".$cantidad."' WHERE Id_Solicitud_Prod='".$id_solicitud_prod."'";
                //$ssresult = $conexion->query($ssql) or die('Error:'.mysqli_error($conexion));

                
                if ($resultados->num_rows>0){ //SI LA REFERENCIA YA ESTA CARGADA EN EL INVENTARIO.
                    $SqlActualizar ="UPDATE t_inventario SET Cantidad=Cantidad+'".$cantidad."' WHERE Id_Tienda='".$idtienda."' and Referencia_Completa='".$cod_ref_completo."'"; //ACTUALIZAMOS EL INVENTARIO
                    $ResultActualizar = $conexion->query($SqlActualizar)or die (mysqli_error($conexion));
					//echo "<br>ENTRO A CLIENTE Y ENCONTRO LA REFERENCIA Y ACTUALIZA: ".$SqlActualizar;
                }else{ //SI LA REFERENCIA NO ESTA CARGADA EN EL INVENTARIO
                    $SqlAgregar ="INSERT INTO t_inventario(Id,Id_Tienda,Referencia,Referencia_Completa,Cantidad,Id_Talla) VALUES ('','".$idtienda."','".$cod_referencia."','".$cod_ref_completo."','".$cantidad."','".$talla_id."')"; //AGREGAMOS LA NUEVA REFERENCIA AL INVENTARIO
                    $ResultInsertar = $conexion->query($SqlAgregar);
					//echo "<br>ENTRO A CLIENTE Y AGREGA AL INVENTARIO, LA REFERENCIA ES NUEVA: ".$sql1;
                }



           }
           
           if (!$EJECUTAR){
                $error_guardar = 1;
                header("location:tiendas_recepcion.php?Mensaje=61");
           }
			$i = $i+1; //USADA PARA EL ARREGLO $varRecibido QUE GUARDA LAS CANTIDADES RECIBIDAS
        }
     }    
    
    
    /* REALIZA LA SUMA DEL INVENTARIO RECIBIDO*/
    $consulta_inventario ="SELECT sum(valor_total) as suma FROM t_temporal_inventario WHERE id_despacho='".$id_despacho."'";
    $resultados = $conexion->query($consulta_inventario) or die('Error:'.$consulta_inventario." ".mysqli_error($conexion));
    if($resultados->num_rows>0){
    	while ($row = $resultados->fetch_assoc()) {
    	   $suma = $row['suma'];
        }
     }    
    
    
    /*1) ACTUALIZAR LA TABLA DE T_TEMPORAL INVENTARIO*/
    $Actualizart_temporal_inventario="UPDATE t_temporal_inventario SET status_recibido='".$status."'
    WHERE
     status_recibido='ENVIADO' and id_despacho='".$id_despacho."'";
    $ejecutar2=$conexion->query($Actualizart_temporal_inventario) or die('Error:'.$Actualizart_temporal_inventario." ".mysqli_error($conexion));

    //CAMBIAR EL STATUS DE LA SOLICITUD A 9
    $ssql="UPDATE t_temporal_sol SET Estado_Solicitud_Cliente='9' WHERE Id_Temporal_Sol='".$Id_Produccion."'";
    $ssresult = $conexion->query($ssql) or die('Error:'.mysqli_error($conexion));


    // CONSULTAMOS EL NÚMERO DE PEDIDO
    $sql ="SELECT Pedido_Id_Pedido FROM t_temporal_sol WHERE Id_Temporal_Sol='".$Id_Produccion."'";
$result = $conexion->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) { 
$Pedido_Id_Pedido=$row['Pedido_Id_Pedido'];                
 }
}

//CAMBIAR EL STATUS DE LA SOLICITUD A 9
    $ssql="UPDATE t_pedido SET Estado_Pedido='9' WHERE Cod_Pedido='".$Pedido_Id_Pedido."'";
    $ssresult = $conexion->query($ssql) or die('Error:'.mysqli_error($conexion));


        
    if (!$ejecutar2){
        $error_guardar = 1;
    }
    
    /*2) ACTUALIZAR LA TABLA DE t_temporal_inventario_despachos*/
    $Actualizart_temporal_inventario_despacho="UPDATE t_temporal_inventario_despachos SET status_despacho='".$status."',
    fecha_recepcion='".$TiempoActual."',id_user_recepcion='".$IdUser."',total_despacho='".$suma."',observaciones='".$observaciones."'
    WHERE
    status_despacho='DESPACHADO' and id_despacho='".$id_despacho."'";
    $ejecutar3=$conexion->query($Actualizart_temporal_inventario_despacho) or die('Error:'.$Actualizart_temporal_inventario_despacho." ".mysqli_error($conexion));
    if (!$ejecutar3){
        $error_guardar = 1;
    }
    
    if ($error_guardar==0){
		// dormir durante 10 segundos
		//sleep(60);
		header("location:tiendas_recepcion.php?Mensaje=63");
    }
        
}
}
else{
    header("location:tiendas_recepcion.php?Mensaje=60");
}

?>