<?php 
include("Lib/sesion.php");
include("Lib/display_error.php");
include("Lib/conexion.php");
include("Lib/formulas.php");
$IdUser=$_SESSION['IdUser'];
date_default_timezone_set("America/Bogota");
$TiempoActual = date('Y-m-d H:i:s');
$Aleaotorio=rand(0,99999);
$Id_Referencia=$_SESSION['Id_Referencia'];
if (isset($_POST['Modificar'])){  //si se envio modificar
    $query = mysqli_query($conexion, "SELECT * FROM t_referencias WHERE Id_Referencia='$Id_Referencia'")
                                  or die('error '.mysqli_error($mysqli));
        $data = mysqli_fetch_assoc($query);
        $Codigo_Referencia = $data['Cod_Referencia'];  
        $fotoportada=$_POST['fotoportada'];
    //SI LA FOTO HA SIDO MODIFICADA
    if($_FILES['fotoportada']['tmp_name']!=""){ 
        $Txtportada=$_FILES['fotoportada']['name'];
        $TxtTemporal=$_FILES['fotoportada']['tmp_name'];
         // Guardar Imagen
         //$target GUARDA LA RUTA DE DONDE SE GUARDO LA IMAGEN
        $target = "Images/Galeria-Produccion/";
        $target = $target.$Aleaotorio."-". basename( $_FILES['fotoportada']['name']);
        if ($_FILES['fotoportada']['type']=='image/jpeg') {
          $img_origen=imagecreatefromjpeg($TxtTemporal);
        }
        elseif ($_FILES['fotoportada']['type']=='image/png') {
          $img_origen=imagecreatefrompng($TxtTemporal);
        }
        elseif ($_FILES['fotoportada']['type']=='image/gif') {
          $img_origen=imagecreatefromgif($TxtTemporal);
        }
        $ancho_origen=imagesx($img_origen);
        $alto_origen=imagesy($img_origen);
        $ancho_limite=800;
        if ($ancho_origen>$alto_origen) {
          $ancho_origen=$ancho_limite;
          $alto_origen=$ancho_limite*imagesy($img_origen)/imagesx($img_origen);
        }
        else{
          $alto_origen=$ancho_limite;
          $ancho_origen=$ancho_limite*imagesx($img_origen)/imagesy($img_origen);
        }
        
        $img_destino=imagecreatetruecolor($ancho_origen, $alto_origen);
        imagecopyresized($img_destino, $img_origen, 0, 0, 0, 0, $ancho_origen, $alto_origen, imagesx($img_origen), imagesy($img_origen));
        
        imagejpeg($img_destino,$target,100);
        
        if(move_uploaded_file($_FILES['fotoportada']['tmp_name'], $target))
            {
            $uploadRes=true;// Si la imagen se guarda se ejecuta el guardar la referencia
            }        
        
        //OBTENER EL CODIGO DEL INSUMO SECUNDARIO
        $query = mysqli_query($conexion, "SELECT Cod_Insumo,Nom_Insumo FROM t_insumos WHERE Id_Insumo='$TxtInsumo2'")
                                  or die('error '.mysqli_error($mysqli));
            $data2 = mysqli_fetch_assoc($query);
            $Insumo2 = $data2['Cod_Insumo']; 
        //OBTENGO LAS VARIABLES QUE NECESITO ACTUALIZAR EN LA TABLA DE REFERENCIAS    
        $TxtInsumo2=$_POST['TxtInsumo2']; // De archivo reflistainsumos.php
        $TxtTotalCosto=$_POST['TxtTotalCosto']; // De archivo refcost.php
        $TxtManodeObra=$_POST['TxtManodeObra']; 
        $TxtColeccion=$_POST['TxtColeccion'];
        $PVP=$_POST['demo2']; // 
        $PMayor=$_POST['demo3'];
        $TxtDetalle=$_POST['TxtDetalle'];
        $TxtNomAnterior=$_POST['TxtNomAnterior'];
        $TxtDetalleAnterior=$_POST['TxtDetalleAnterior'];
        $Valor1=$_POST['demo2'];
        $PrecioVenta=FormatoMascara($Valor1);
        $Valor2=$_POST['demo3'];
        $PrecioMayor=FormatoMascara($Valor2);
        $PMayor1 =$_POST['demo3']; 
        //ACTUALIZO LA TABLA DE REFERENCIAS VERIFICANDO SI SE CAMBIO LA IMAGEN O NO
        //ACTUALIZAR TABLA REFERENCIAS
        $sql="UPDATE t_referencias SET Insumo_Sec='".$Insumo2."',Costo_Proyectado_Pref='".$TxtTotalCosto."',
        V_Mano_Obra_Ref='".$TxtManodeObra."',PVP_Ref='".$PrecioVenta."',P_Mayor='".$PrecioMayor."',
        Detalle_Referencia='".$TxtDetalle."',Detalle_Antiguo='".$TxtDetalleAnterior."',Ref_Antigua='".$TxtNomAnterior."',
        Modificado_Por='".$IdUser."',Img_Referencia='".$target."' 
        WHERE Id_Referencia='".$Id_Referencia."'";
        $result = $conexion->query($sql);
        //SI SE ACTUALIZO CORRECTAMENTE, ACTUALIZO LOS INSUMOS UTILIZADOS
        if ($result){
             //ELIMINO LOS ANTIGUOS INSUMOS UTILIZADOS
            $sql_elimina ="DELETE FROM t_insumos_ref WHERE Referencia_Cod_Referencia='".$Codigo_Referencia."'";
            $result=$conexion->query($sql_elimina);                

            $sql ="SELECT Id_Temporal FROM t_temporal_ref2 WHERE Orden_Temporal='".$IdUser."'"; 
            $result = $conexion->query($sql);
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {                
                    $ListaInsumos=$ListaInsumos.$row['Id_Temporal'].","; 
                }
              }
            $CadenaInsumos=explode(",", $ListaInsumos);
            //Split al Arreglo
            $longitud = count($CadenaInsumos);
            $min=$longitud-1;
            for($i=0; $i<$min; $i++){
                // Consulta del código 
                $sql ="SELECT Cod_Temporal FROM t_temporal_ref2 WHERE Id_Temporal='".$CadenaInsumos[$i]."'";  
                $result = $conexion->query($sql);
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {   
                      $Tb_Cod_Temporal=$row['Cod_Temporal'];            
                 }
                }
                 $sql ="SELECT Cant_Temporal FROM t_temporal_ref2 WHERE Id_Temporal='".$CadenaInsumos[$i]."'";  
                $result = $conexion->query($sql);
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {   
                       $Tb_Cant_Temporal=$row['Cant_Temporal'];           
                 }
                }
                 $sql ="SELECT Costo_Insumo FROM t_insumos WHERE Cod_Insumo='".$Tb_Cod_Temporal."'";  
                $result = $conexion->query($sql);
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {   
                      $Costo_Insumo=$row['Costo_Insumo'];            
                 }
                }
                // Guardar Insumos
                $sql_guarda=("INSERT INTO t_insumos_ref(Cod_Insumo, Costo_Insumo_Ref, Cant_Solicitada, Referencia_Cod_Referencia) VALUES('".$Tb_Cod_Temporal."','".$Costo_Insumo."','".$Tb_Cant_Temporal."','".$Codigo_Referencia."')");
                $result=$conexion->query($sql_guarda);
                }
            // Eliminar Diseño en Tabla Temporal 
            $sql ="DELETE FROM t_temporal_ref WHERE Orden_Temporal='".$IdUser."'";
            //Echo($sql);  
            $result = $conexion->query($sql);
   //        
        }else{ //SINO SE ACTUALIZO
            echo "ERROR EN ACTUALIZAR REFERENCIA";
        } 

    }else{
        echo "NO SE SELECCIONO NINGUNA IMAGEN...";
        $TxtInsumo2=$_POST['TxtInsumo2']; // De archivo reflistainsumos.php
        $TxtTotalCosto=$_POST['TxtTotalCosto']; // De archivo refcost.php
        $TxtManodeObra=$_POST['TxtManodeObra']; 
        $TxtColeccion=$_POST['TxtColeccion'];
        $PVP=$_POST['demo2']; // 
        $PMayor=$_POST['demo3'];
        $TxtDetalle=$_POST['TxtDetalle'];
        $TxtNomAnterior=$_POST['TxtNomAnterior'];
        $TxtDetalleAnterior=$_POST['TxtDetalleAnterior'];
        $Valor1=$_POST['demo2'];
        $PrecioVenta=FormatoMascara($Valor1);
        $Valor2=$_POST['demo3'];
        $PrecioMayor=FormatoMascara($Valor2);
        $PMayor1 =$_POST['demo3']; 
        //OBTENER EL CODIGO DEL INSUMO SECUNDARIO
        $query = mysqli_query($conexion, "SELECT Cod_Insumo,Nom_Insumo FROM t_insumos WHERE Id_Insumo='$TxtInsumo2'")
                                  or die('error '.mysqli_error($mysqli));
            $data2 = mysqli_fetch_assoc($query);
            $Insumo2 = $data2['Cod_Insumo'];
         echo "EL CODIGO DEL INSUMO SECUNDARIO ES ".$TxtInsumo2;  
         
        echo "ESTE ES EL INSUMO SECUNDARIO QUE NO GUARDA ".$TxtInsumo2." Y EL TOTAL DEL COSTO ES ".$TxtTotalCosto;        
        $sqlff="UPDATE t_referencias SET Insumo_Sec='".$Insumo2."',Costo_Proyectado_Pref='".$TxtTotalCosto."',
        V_Mano_Obra_Ref='".$TxtManodeObra."',PVP_Ref='".$PrecioVenta."',P_Mayor='".$PrecioMayor."',
        Detalle_Referencia='".$TxtDetalle."',Detalle_Antiguo='".$TxtDetalleAnterior."',Ref_Antigua='".$TxtNomAnterior."',
        Modificado_Por='".$IdUser."' 
        WHERE Id_Referencia='".$Id_Referencia."'";
          $query = mysqli_query($conexion,$sqlff)
                                  or die('error '.mysqli_error($conexion));

        //$result = $conexion->query($sql);
        //SI SE ACTUALIZO CORRECTAMENTE, ACTUALIZO LOS INSUMOS UTILIZADOS
        if ($query){
             //ELIMINO LOS ANTIGUOS INSUMOS UTILIZADOS
            $sql_elimina ="DELETE FROM t_insumos_ref WHERE Referencia_Cod_Referencia='".$Codigo_Referencia."'";
            $result=$conexion->query($sql_elimina);                

            $sql ="SELECT Id_Temporal FROM t_temporal_ref2 WHERE Orden_Temporal='".$IdUser."'"; 
            $result = $conexion->query($sql);
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {                
                    $ListaInsumos=$ListaInsumos.$row['Id_Temporal'].","; 
                }
              }
            $CadenaInsumos=explode(",", $ListaInsumos);
            //Split al Arreglo
            $longitud = count($CadenaInsumos);
            $min=$longitud-1;
            for($i=0; $i<$min; $i++){
                // Consulta del código 
                $sql ="SELECT Cod_Temporal FROM t_temporal_ref2 WHERE Id_Temporal='".$CadenaInsumos[$i]."'";  
                $result = $conexion->query($sql);
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {   
                      $Tb_Cod_Temporal=$row['Cod_Temporal'];            
                 }
                }
                 $sql ="SELECT Cant_Temporal FROM t_temporal_ref2 WHERE Id_Temporal='".$CadenaInsumos[$i]."'";  
                $result = $conexion->query($sql);
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {   
                       $Tb_Cant_Temporal=$row['Cant_Temporal'];           
                 }
                }
                 $sql ="SELECT avg(Costo_Insumo) as ValorPromedio FROM t_insumos WHERE Cod_Insumo='".$Tb_Cod_Temporal."'";  
                $result = $conexion->query($sql);
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {   
                      $Costo_Insumo=$row['ValorPromedio'];            
                 }
                }
                // Guardar Insumos
                $sql_guarda="INSERT INTO t_insumos_ref(Cod_Insumo, Costo_Insumo_Ref, Cant_Solicitada, Referencia_Cod_Referencia) VALUES('".$Tb_Cod_Temporal."','".$Costo_Insumo."','".$Tb_Cant_Temporal."','".$Codigo_Referencia."')";
                $result=$conexion->query($sql_guarda);
                }
            // Eliminar Diseño en Tabla Temporal 
            $sql ="DELETE FROM t_temporal_ref WHERE Orden_Temporal='".$IdUser."'";
            $result = $conexion->query($sql);
        }else{ //SINO SE ACTUALIZO
            echo "Error en actualizar referencias linea 193";            
        } //FIN IF $RESULT

    }
}else{
    echo "NO ENTRO CORRECTAMENTE A MODIFICAR";
}
 ?>
 