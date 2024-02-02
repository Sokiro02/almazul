<?php
include ("Lib/conexion.php");
for ($i=1;$i<=6;$i++){
    $tienda = $i;
    echo "<H1><B>TRABAJANDO CON LA TIENDA: ".$i."</B></H1>";
    $movimiento = "Ingreso Inicial";
    $SqlBuscar = "SELECT * FROM t_inventario_ref WHERE Tienda_Id_Tienda = '" . $tienda .
        "' and Tipo_Mov_Inv='" . $movimiento . "'";
    echo $SqlBuscar . "<br>";
    $Resultado = $conexion->query($SqlBuscar);
    if ($Resultado->num_rows > 0)
    {
        while ($row = $Resultado->fetch_assoc())
        {
            $id_tienda = $row['Tienda_Id_Tienda'];
            $Ref_Completa = $row['Ref_Completa'];
            $Ref_Inv = $row['Inv_Ref'];
            $Cantidad = $row['Cantidad_Inv'];
            $cliente = $row['cliente'];
            $id_talla = $row['Talla_Id_Talla'];
            $cliente = strtoupper($cliente);
            echo "Regitro a usar: ".$id_tienda." ".$Ref_Completa." ".$Cantidad."<br>";
            if ($cliente <> 'SI')
            {
                //AGREGAR O ACTUALIZAR DATOS DE LA TABLA DEL INVENTARIO REAL
                $sql1 = "SELECT Id_Tienda,Referencia_Completa FROM t_inventario WHERE Id_Tienda='" .$id_tienda . "' and Referencia_Completa='" . $Ref_Completa . "'";
                $resultados = $conexion->query($sql1) or die(mysqli_error($conexion));
                if ($resultados->num_rows > 0)
                { //SI LA REFERENCIA YA ESTA CARGADA EN EL INVENTARIO.
                    $SqlActualizar = "UPDATE t_inventario SET Cantidad=Cantidad+'".$Cantidad."' WHERE Id_Tienda='" . $id_tienda . "' and Referencia_Completa='" . $Ref_Completa ."'"; //ACTUALIZAMOS EL INVENTARIO
                    $ResultActualizar = $conexion->query($SqlActualizar) or die(mysqli_error($conexion));
                    echo "Actualizando: ".$SqlActualizar."<br>";
                } else
                { //SI LA REFERENCIA NO ESTA CARGADA EN EL INVENTARIO
                    $SqlAgregar = "INSERT INTO t_inventario(Id,Id_Tienda,Referencia,Referencia_Completa,Cantidad,Id_Talla) VALUES ('','" .$id_tienda . "','" . $Ref_Inv . "','" . $Ref_Completa . "','" . $Cantidad ."','".$id_talla."')"; //AGREGAMOS LA NUEVA REFERENCIA AL INVENTARIO
                    $ResultInsertar = $conexion->query($SqlAgregar);
                    echo "Agregando : ".$SqlAgregar."<br>";
                }
            }
        }
    }

    $movimiento = "DESPACHO";
    $SqlBuscar = "SELECT * FROM t_inventario_ref WHERE Tienda_Id_Tienda = '" . $tienda .
        "' and Tipo_Mov_Inv='" . $movimiento . "'";
    echo $SqlBuscar . "<br>";
    $Resultado = $conexion->query($SqlBuscar);
    if ($Resultado->num_rows > 0)
    {
        while ($row = $Resultado->fetch_assoc())
        {
            $id_tienda = $row['Tienda_Id_Tienda'];
            $Ref_Completa = $row['Ref_Completa'];
            $Ref_Inv = $row['Inv_Ref'];
            $Cantidad = $row['Cantidad_Inv'];
            $cliente = $row['cliente'];
            $id_talla = $row['Talla_Id_Talla'];
            $cliente = strtoupper($cliente);
            echo "Regitro a usar DESPACHO: ".$id_tienda." ".$Ref_Completa." ".$Cantidad."<br>";
            if ($cliente <> 'SI')
            {
                //AGREGAR O ACTUALIZAR DATOS DE LA TABLA DEL INVENTARIO REAL
                $sql1 = "SELECT Id_Tienda,Referencia_Completa FROM t_inventario WHERE Id_Tienda='" .$id_tienda . "' and Referencia_Completa='" . $Ref_Completa . "'";
                $resultados = $conexion->query($sql1) or die(mysqli_error($conexion));
                if ($resultados->num_rows > 0)
                { //SI LA REFERENCIA YA ESTA CARGADA EN EL INVENTARIO.
                    $SqlActualizar = "UPDATE t_inventario SET Cantidad=Cantidad+'".$Cantidad."' WHERE Id_Tienda='" . $id_tienda . "' and Referencia_Completa='" . $Ref_Completa ."'"; //ACTUALIZAMOS EL INVENTARIO
                    $ResultActualizar = $conexion->query($SqlActualizar) or die(mysqli_error($conexion));
                    echo "Actualizando DESPACHO: ".$SqlActualizar."<br>";
                } else
                { //SI LA REFERENCIA NO ESTA CARGADA EN EL INVENTARIO
                    $SqlAgregar = "INSERT INTO t_inventario(Id,Id_Tienda,Referencia,Referencia_Completa,Cantidad,Id_Talla) VALUES ('','" .$id_tienda . "','" . $Ref_Inv . "','" . $Ref_Completa . "','" . $Cantidad ."','".$id_talla."')"; //AGREGAMOS LA NUEVA REFERENCIA AL INVENTARIO
                    $ResultInsertar = $conexion->query($SqlAgregar);
                    echo "Agregando DESPACHO: ".$SqlAgregar."<br>";
                }
            }
        }
    }
    
    $movimiento = "Salida Venta";
    $SqlBuscar = "SELECT * FROM t_inventario_ref WHERE Tienda_Id_Tienda = '" . $tienda .
        "' and Tipo_Mov_Inv='" . $movimiento . "'";
    echo $SqlBuscar . "SALIDA VENTA <br>";
    $Resultado = $conexion->query($SqlBuscar);
    if ($Resultado->num_rows > 0)
    {
        while ($row = $Resultado->fetch_assoc())
        {
            $id_tienda = $row['Tienda_Id_Tienda'];
            $Ref_Completa = $row['Ref_Completa'];
            $Ref_Inv = $row['Inv_Ref'];
            $Cantidad = $row['Cantidad_Inv'];
            $cliente = $row['cliente'];
            $id_talla = $row['Talla_Id_Talla'];
            $cliente = strtoupper($cliente);
            echo "Regitro a usar SALIDA VENTA: ".$id_tienda." ".$Ref_Completa." ".$Cantidad."<br>";
            if ($cliente <> 'SI')
            {
                //AGREGAR O ACTUALIZAR DATOS DE LA TABLA DEL INVENTARIO REAL
                $sql1 = "SELECT Id_Tienda,Referencia_Completa FROM t_inventario WHERE Id_Tienda='" .$id_tienda . "' and Referencia_Completa='" . $Ref_Completa . "'";
                $resultados = $conexion->query($sql1) or die(mysqli_error($conexion));
                if ($resultados->num_rows > 0)
                { //SI LA REFERENCIA YA ESTA CARGADA EN EL INVENTARIO.
                    $SqlActualizar = "UPDATE t_inventario SET Cantidad=Cantidad-'".$Cantidad."' WHERE Id_Tienda='" . $id_tienda . "' and Referencia_Completa='" . $Ref_Completa ."'"; //ACTUALIZAMOS EL INVENTARIO
                    $ResultActualizar = $conexion->query($SqlActualizar) or die(mysqli_error($conexion));
                    echo "Actualizando SALIDA VENTA: ".$SqlActualizar."<br>";
                } else
                { //SI LA REFERENCIA NO ESTA CARGADA EN EL INVENTARIO
                    $SqlAgregar = "INSERT INTO t_inventario(Id,Id_Tienda,Referencia,Referencia_Completa,Cantidad,Id_Talla) VALUES ('','" .$id_tienda . "','" . $Ref_Inv . "','" . $Ref_Completa . "','" . $Cantidad ."','".$id_talla."')"; //AGREGAMOS LA NUEVA REFERENCIA AL INVENTARIO
                    $ResultInsertar = $conexion->query($SqlAgregar);
                    echo "Agregando : ".$SqlAgregar."<br>";
                }
            }
        }
    }
    
    $movimiento = "Salida Remision";
    $SqlBuscar = "SELECT * FROM t_inventario_ref WHERE Tienda_Id_Tienda = '" . $tienda .
        "' and Tipo_Mov_Inv='" . $movimiento . "'";
    echo $SqlBuscar . "SALIDA REMISIÓN <br>";
    $Resultado = $conexion->query($SqlBuscar);
    if ($Resultado->num_rows > 0)
    {
        while ($row = $Resultado->fetch_assoc())
        {
            $id_tienda = $row['Tienda_Id_Tienda'];
            $Ref_Completa = $row['Ref_Completa'];
            $Ref_Inv = $row['Inv_Ref'];
            $Cantidad = $row['Cantidad_Inv'];
            $cliente = $row['cliente'];
            $id_talla = $row['Talla_Id_Talla'];
            $cliente = strtoupper($cliente);
            echo "Regitro a usar SALIDA VENTA: ".$id_tienda." ".$Ref_Completa." ".$Cantidad."<br>";
            if ($cliente <> 'SI')
            {
                //AGREGAR O ACTUALIZAR DATOS DE LA TABLA DEL INVENTARIO REAL
                $sql1 = "SELECT Id_Tienda,Referencia_Completa FROM t_inventario WHERE Id_Tienda='" .$id_tienda . "' and Referencia_Completa='" . $Ref_Completa . "'";
                $resultados = $conexion->query($sql1) or die(mysqli_error($conexion));
                if ($resultados->num_rows > 0)
                { //SI LA REFERENCIA YA ESTA CARGADA EN EL INVENTARIO.
                    $SqlActualizar = "UPDATE t_inventario SET Cantidad=Cantidad-'".$Cantidad."' WHERE Id_Tienda='" . $id_tienda . "' and Referencia_Completa='" . $Ref_Completa ."'"; //ACTUALIZAMOS EL INVENTARIO
                    $ResultActualizar = $conexion->query($SqlActualizar) or die(mysqli_error($conexion));
                    echo "Actualizando SALIDA REMISION: ".$SqlActualizar."<br>";
                } else
                { //SI LA REFERENCIA NO ESTA CARGADA EN EL INVENTARIO
                    $SqlAgregar = "INSERT INTO t_inventario(Id,Id_Tienda,Referencia,Referencia_Completa,Cantidad,Id_Talla) VALUES ('','" .$id_tienda . "','" . $Ref_Inv . "','" . $Ref_Completa . "','" . $Cantidad ."','".$id_talla."')"; //AGREGAMOS LA NUEVA REFERENCIA AL INVENTARIO
                    $ResultInsertar = $conexion->query($SqlAgregar);
                    echo "Agregando : ".$SqlAgregar."<br>";
                }
            }
        }
    }
    

}
?>